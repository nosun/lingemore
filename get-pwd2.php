<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_get_pwd2.html";

//--读取产品列表
$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['forgotten_password']}";
$var["str_url_2"]="{$cfg['lg']['forgotten_password']}";
$var["title"] =  "{$cfg['lg']['forgotten_password']} - " . $var["title"];
			$action=getQuery("action");
			switch($action)
			{
				case "step_2":
					$var["str_url_2"]="";
					
					if(getFormSafe("code")!=$_SESSION["code"] || $_SESSION["code"]=="" || getFormSafe("code")=="" )
					{
						echo "<script> alert('{$cfg['lg']['msg_code_error']}') ;history.back(); </script>";
						exit();
					}
					
					$name=filterSQL(getForm("name"));
					if($name=="")
						alertRedirect("{$cfg['lg']['msg_useridexist_null']}","get-pwd.php");
					$sql="select id from @@@user where name like '$name'";
					$rs = query($sql);
					if(BOF($rs))
						alertRedirect("{$cfg['lg']['msg_useridexist_null']}","get-pwd.php");
					$rows = fetch($rs);
					$userid = $rows["id"] ;
			
					$vartmp = array();
					$vartmp["action"] = "forgetpwd_from_email";
					$vartmp["id"] = $userid ;
					addToMailQueue($vartmp);
					redirect(FOLDER."get-pwd2.php?action=step_3");
					break;
				case "step_3":
					
					break;
				default:
					$action="step_1";
					break;
			}
$var["action"]=$action;

require("uio_bomdata.php");
?>