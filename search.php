<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_search.html";

$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['advanced_search']}";
$var["str_url_2"]="{$cfg['lg']['advanced_search']}";
$allclassselect="";


get_class_html($nroot,$nclass,$allnewsclassselect,false);


$var["allnewsclassselect"]=$allnewsclassselect;


require("uio_bomdata.php");
?>