<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_minishopcart.html";

$var["str_url"]="<a  href='".FOLDER."index.php'><span class='daoa' >Home</span></a> " . $cfg["split_uri"] . " The Shopping Cart";
$var["str_url_2"]="Your Shopping Cart Contents";
$var["title"] = $var["str_url_2"] . " - " . $var["title"];

$cfg["lg"]["minicart_items"] = str_replace("{0}",$totalnum,$cfg["lg"]["minicart_items"]);

require("uio_bomdata.php");
?>