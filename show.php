<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_show.html";

$id=getQueryInt("id",1);
$message[1]=$cfg["lg"]["error_1"];
$var["message"]=$message[$id];
$str_url="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['error']}";
$str_url_2="{$cfg['lg']['error']}";
$var["title"] = "{$cfg['lg']['error']} - " . $var["title"];
$var["str_url"]=$str_url;
$var["str_url_2"]=$str_url_2;


require("uio_bomdata.php");
?>