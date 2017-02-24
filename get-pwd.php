<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_get_pwd.html";
//--读取产品列表
$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['forgotten_password']}";
$var["str_url_2"]="{$cfg['lg']['forgotten_password']}";
$var["title"] =  "{$cfg['lg']['forgotten_password']} - " . $var["title"];
			$action=getQuery("action");
			switch($action)
			{
				case "step_2":
					$var["str_url_2"]="";
					$name=getFormSafe("name");
					if($name=="")
						alertRedirect("{$cfg['lg']['msg_useridempty_null']}","get-pwd.php");
					$sql="select question,name from @@@user where name='$name'";
					$rs=query($sql);
					if( BOF($rs) )
						alertRedirect("{$cfg['lg']['msg_useridexist_null']}","get-pwd.php");
					$rows=fetch($rs);
					free($rs);
					$var["rows"]=$rows;
					break;
				case "step_3":
					$name=getFormSafe("name");
					$answer=getFormSafe("answer");
					if($name=="")
						alertRedirect("{$cfg['lg']['msg_useridempty_null']}","get-pwd.php");
					$sql="select answer,name from @@@user where name='$name' and answer='$answer'";
					$rs=query($sql);
					if( BOF($rs) )
						alertRedirect("{$cfg['lg']['msg_answer_wrong']}","get-pwd.php");
					$rows=fetch($rs);
					$var["rows"]=$rows;
					free($rs);
					break;
				case "step_4":
					step_4();
					break;
				default:
					$action="step_1";
					break;
			}
$var["action"]=$action;

require("uio_bomdata.php");
?>
<?
function step_4()
{
	global $cfg;
	$name=getFormSafe("name");
	$answer=getFormSafe("answer");
	if($name=="" || $answer=="")
		alertRedirect("{$cfg['lg']['msg_useridempty_null']}","get-pwd.php");
	$sql="select answer,name from @@@user where name='$name' and answer='$answer'";
	$rs=query($sql);
	if( BOF($rs) )
		alertRedirect("{$cfg['lg']['msg_useridexist_null']}","get-pwd.php");
	free($rs);
	$condition="where name='$name'";
	$param["pwd"]=md5(md5(getFormSafe("pwd")));
	$sql=updateSQL($param,"@@@user",$condition);
	query($sql);
	alertRedirect("{$cfg['lg']['msg_pwd_reset']}","get-pwd.php");
}
?>
