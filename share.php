<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_share.html";

$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['email_a_friend']}";
$var["str_url_2"]="{$cfg['lg']['email_a_friend']}";
$var["title"] =  "{$cfg['lg']['email_a_friend']} - " . $var["title"];

$action=getQuery("action");
switch($action)
{
	case "step_2":
		$action="step_2";
		$vartmp = array();
		$vartmp["action"] = "email_to";
		$vartmp["pid"] = getFormInt("pid",0) ;
		$vartmp["toemail"] = getFormSafe("toemail") ;
		$vartmp["toname"] = getFormSafe("toname") ;
		$vartmp["fromname"] = getFormSafe("fromname") ;
		$vartmp["content"] = getFormSafe("content") ;
		$vartmp["fromemail"] = getFormSafe("fromemail") ;
		addToMailQueue($vartmp);
		goPage("share.php?action=step_3");
		break;
	case "step_3":
		$action="step_3";
		break;
	default:
		$action="step_1";
		if( getQuery("pid")=="" )
			goPage(FOLDER);
		$var["pid"] = getQueryInt("pid",0);
		$info[] = 98 ;
		break;
}
$var["action"]=$action;
require("uio_bomdata.php");

?>
