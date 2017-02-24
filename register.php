<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_register.html";

if( $userid>0)
{
	redirect(FOLDER."profile.php");
}

header("Cache-control: private");
$action=getQuery("action");
$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['reg']}";
$var["str_url_2"]="{$cfg['lg']['reg']}";
$var["title"] =  "{$cfg['lg']['reg']} - " . $var["title"];

$sql="select * from `@@@admin` where supper<=8 order by rand() desc";
$rs=query($sql);
while( $rows=fetch($rs) )
{ 
	$var["rs_server"][]=$rows;
}

if( getQuery("do")=="sign" )
	$var["td_name"] = "td_register";
else
	$var["td_name"] = "td_login";

$var["page_redirectURL"] = getQuery("redirectURL");


require("uio_bomdata.php");
?>