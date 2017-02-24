<?
require("../inc/php_inc.php");
require("php_checkadmin.php");
$id=getQueryInt("id",0);
$value=getQuery("value");
$field=getQuery("field");
$table=getQuery("table");
$condition="where id=$id";

$param[$field]=$value;
$sql=updateSQL($param,$table,$condition);
query($sql);

$num=mysql_affected_rows();
echo "changeSuccess($num,'$table','$field',$id," . getQuery("isnum") . "," . getQuery("size") . ")";
?>