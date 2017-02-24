<?
require("../inc/php_inc.php");
require("php_checkadmin.php");

$id=getQueryInt("id",0);
$condition="where id=$id";
$param["addtime"]=formatDateTime(time());
$sql=updateSQL($param,"@@@product",$condition);
query($sql);
die("alert('推荐置顶成功,退出登录前记得清空缓存');");
?>