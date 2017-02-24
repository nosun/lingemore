<?
header('Content-Type: text/html; charset=utf-8');
require("../inc/php_inc.php");
setcookie("admin_name","", time() - 3600);
setcookie("admin_pwd","", time() - 3600);
unlink("orderExcel.xls");
$condition="where id=2";
$arr["verson"]=1;
$param["content"]= json_encode( $arr ) ;
$sql=updateSQL( $param,"@@@config",$condition );
query($sql);
echo "<script>alert('您已安全退出，感谢您的使用!');parent.document.location.href='index.php'</script>" ;
?>