<?php require("../inc/php_inc.php")?>
<?
$cfg["domain"] = getShortDomain();
if(  getQuery("name")!="" )
{
	//$sql="select * from @@@admin where name='"  . getQuery("name") . "' and pwd='" . getQuery("pwd") . "'";
	//$rs=query($sql);
	//if( BOF($rs) )
	if( getQuery("name")!=CDNKEY)
	{
		die("Reg Error");
	}
}
else
{
	die("Reg Error");
}

$action=getQuery("action");
switch($action)
{
	case "upload":
		upload(0);
		break;
	case "flashupload":
		upload(1);
		break;
	default:
		main("");
		break;
}

function upload($flash=0)
{
	global $cfg;
	$filetype = getQueryDefault("filetype","image");
	$path_parts = pathinfo($_FILES['file1']['name']);
	$path_name_array = split("\." , $path_parts["basename"] ) ;
	$path_name_array_name = $path_name_array[0];
	$newname=getRandomname() . "." . $path_parts["extension"] ;
	$folder = getFormDefault("folder", strftime("%Y-%m-%d-%H",time()). "/" )  ;
	//----
	$arr_check = array('&','"',"'",'`','.',',','(',')','+','#',":"," ","<",">","*","?","|",'\\','%');
	$arr_replace = array_fill ( 0 , count( $arr_check ) , '-');
	$folder=str_replace($arr_check,$arr_replace,$folder);
	$_POST["filepath"] = str_replace($arr_check,$arr_replace,trim($_POST["filepath"]));
	$_GET["filepath"] = str_replace($arr_check,$arr_replace,trim($_GET["filepath"]));
	$_REQUEST["filepath"] = str_replace($arr_check,$arr_replace,trim($_REQUEST["filepath"]));
	//----
	if( substr($folder, -1)!="/" )
		   $folder .= "/";
	$formname = getForm("FormName");
	$editname = getForm("EditName");
	$store_dir="../" . getFormDefault("filepath","uploadImage/") . $folder ;
	
	//die($_FILES["file1"]['type']);
	if( ! in_array( strtolower($path_parts["extension"]) , $cfg["upload_".$filetype."Type"]) )
	{
		Msg("文件格式错误",$flash);
		return ;
	}
	
	if (is_array($_FILES)) 
	{
		foreach($_FILES AS $name => $value)
		{
			${$name} = $value['tmp_name'];
			$fp = @fopen(${$name},'r');
			$fstr = @fread($fp,filesize(${$name}));
			@fclose($fp);
			if($fstr!='' && (ereg("<\?",$fstr) || ereg("<\%",$fstr) ) )
			{
				  Msg("文件格式错误",$flash);
				 return ;
			}
		}
	}

	
	$filesize=$_FILES["file1"]["size"];
	$upload_file = $_FILES['file1']['tmp_name'];
	if($filesize ==0)
	{
		Msg("没有选择文件",$flash);
		return ;
	}
	if($filesize >= $cfg["upload_maxsize"] * 1024 * 1024 )
	{
		Msg("文件过大",$flash);
		return ;
	}
	if( !file_exists($store_dir) )
	{
		makedir($store_dir);
	}
	//debug($store_dir.$newname);
	if (!move_uploaded_file($upload_file,$store_dir.$newname)) 
	{
		Msg("复制文件失败",$flash);
		return ;
	}
	$dir = strtolower( getFormDefault("filepath","uploadImage/") );
	if( $cfg["Gimage"]["type"]!=0 && ( $dir=="uploadImage/" || $dir=="otherImage/"  ) )
	{
		$to =  $dir . $folder . $newname ;
		
		$img = new Gimage();
		if($cfg["Gimage"]["type"]==1) 
		{
			$img->wm_text = $cfg["Gimage"]["text"];
			$img->wm_text_font = ROOT . FOLDER . "font/tahoma.ttf";
		}
		else if ($cfg["Gimage"]["type"]==2)
		{
			$img->wm_image_name = ROOT . FOLDER . $cfg["Gimage"]["pic"];
		}
		$img->save_file=ROOT . FOLDER  . $to;
		$img->create(ROOT . FOLDER . $to);
	}
	
	if ( $flash == 0 )
	{
		$tmp = "" ;
		$tmp .= "<script>parent.$formname.$editname.value='$folder$newname';</script>";
		if ( getQuery("fun")!="" )
		{
			$fun=getQuery("fun");
			$tmp.="<script>parent.$fun('"  . FOLDER ."image.php?pic=$folder$newname&style=" . getQuery("funstyle") . "&folder=$dir" . "','$path_name_array_name');</script>";
		}
	}
	else
	{
		echo $folder . $newname;
		die();
	}
	Msg("$tmp 成功上传",$flash);
}

function Msg($str,$flash=0)
{
 	if($flash==0)
		main(" $str <a href='javascript:history.back()'>点击返回</a> ",1);
	else
		echo $str;
}

?>

<?
function main($str,$flag=0)
{
	echo "Error";
}
?>
