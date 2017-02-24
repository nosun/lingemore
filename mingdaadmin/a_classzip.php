<?php 
require("php_admin_include.php");
require("../inc/php_inc_zip.php");
require("php_top.php");


$action=getQuery("action");
switch($action)
{
case "createzip":
	createzip();
	break;
case "deletezip":
	deletezip();
	break;
default:
	die("error");
	break;
}
?>

<?

function createzip()
{
	global $table;
	global $cfg;
	$id=getQueryInt("id",0);
	$disp=getQueryInt("disp",0);
	if( $id!=0 )
	{
		$sql="select id,pic,name,tree from @@@productclass where id=$id";
		$rs=query($sql);
		isItemNotExist($rs);
		$rows=fetch($rs);
		$archive = new PclZip("../download/".makeRewrite($rows["name"])."-c".$rows["id"].'.zip');
		//debug(FOLDER."adminba/zip/".urlencode($rows["name"]).'.zip');
		$sql="select name,pic,itemno,id from @@@product where state>0 and classid in(".$rows["tree"].")";
	}
	if( $disp!=0 )
	{
		$sql="select * from @@@productdisp where id=".$disp;
		$rs=query($sql);
		isItemNotExist($rs);
		$rows=fetch($rs);
		$dname = $rows["name"];
		$archive = new PclZip("../download/".makeRewrite($rows["name"])."-s".$rows["id"].'.zip');
		$sql="select name,pic,itemno,id from @@@product where state>0 and disp & ".$rows["value"]." = ".$rows["value"];
	}
	$rs=query($sql);
	$picstr=array();
	while($orows=fetch($rs))
    {
	   
	   $path=pathinfo($orows["pic"]);
	   $ext=$path["extension"];
	   if(!file_exists("../uploadImage/".$orows["pic"]))
	   {
		   continue;
	   }
	   copy("../uploadImage/".$orows["pic"],"../tempfile/".makeRewrite($orows["name"]).".".$ext);
	   //debug("../tempimg/".urlencode(str_replace(" ","",$orows["name"].".")).$ext);

	   $picstr[]="../tempfile/".makeRewrite($orows["name"]).".".$ext;
	}
	//debug(join(',',$picstr));
	$v_list = $archive->create(join(',',$picstr),PCLZIP_OPT_REMOVE_ALL_PATH);
	if ($v_list == 0) {
		die("Error : ".$archive->errorInfo(true));
	    //debug($picstr);
	    //pageRedirect("压缩失败",$_SERVER['HTTP_REFERER']);
	}
	
	removeDir("../tempfile/");
	makedir("../tempfile/");
	
	pageRedirect("修改成功",$_SERVER['HTTP_REFERER']);
}

function deletezip()
{
	$source = getQuery("file") ;
	if(file_exists(ROOT.FOLDER."download/".$source))
	{
		unlink(ROOT.FOLDER."download/".$source);
	}
	pageRedirect("删除成功",$_SERVER['HTTP_REFERER']);
}
?>
</body>
</html>
