<?
header('Content-Type: text/html; charset=utf-8');
if( $_SESSION["admin"]=="" )
{
	echo "alert('网络中断');";
	exit();
}

?>