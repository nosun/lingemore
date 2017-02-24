<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_shopcart.html";

$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['shopping_cart']}";
$var["str_url_2"]="{$cfg['lg']['shopping_cart']}";
$var["title"] = $var["str_url_2"] . " - " . $var["title"];


require("uio_bomdata.php");
?>
