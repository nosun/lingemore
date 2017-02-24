<?
require("../inc/php_inc.php");
require("php_checkadmin.php");
$id=getQueryInt("id",0);
$condition="where id=$id";
$table=getQuery("table");
$disp=getQueryInt("disp",0);

$param["disp"]=$disp;
$sql=updateSQL($param,$table,$condition);
query($sql);

?>