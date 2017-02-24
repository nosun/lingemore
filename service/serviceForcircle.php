<?
require("../inc/php_inc.php");
require("php_checkadmin.php");

$id=getQueryInt("id",0);
$condition="where id=$id";
$param["state"]="@state*-1";
$sql=updateSQL($param,"@@@product",$condition);
query($sql);
die("removeproducttrresult('$id')");
?>