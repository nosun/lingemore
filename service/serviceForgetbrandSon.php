<?
require("../inc/php_inc.php");
require("php_checkadmin.php");
$table=getQuery("table");
$id=getQueryInt("id",0);
classSonSelect($id,0,$table,"brand");
?>