<?
require("../inc/php_inc.php");
require("php_checkadmin.php");
$id=getQueryInt("id",0);
$index=getQuery("index");
$value=getQuery("value");
$field=getQuery("field");
$table=getQuery("table");

$sql="select * from `@@@order` where id='$id'";
$rs=query($sql);
if( BOF($rs) )
{
	
	echo "alert('订单不存在');";
	exit();
}
$rows=fetch($rs);
$arraddress=split( $cfg["split"]  ,$rows["$field"] ) ;

$arraddress[$index]=$value;


$condition="where id=$id";

$param[$field]=join($cfg["split"],$arraddress);
$sql=updateSQL($param,$table,$condition);
query($sql);

$num=mysql_affected_rows();
echo "changeAddressSuccess($num,'$table','$field',$id," . getQuery("isnum") . "," . getQuery("size") . "," . getQuery("index") . ")";
?>