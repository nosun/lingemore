<?
echo 999;exit;
require("../inc/php_inc.php");

$arr = split(',',getQuery("id"));

for($index=0;$index<count($arr);$index++)

{

	$mailid = (int)$arr[$index];

	$param = array();

	$param["state"] = 0;

	$param["content"] = "";

	$param["addtime"]=formatDateTime(time());

	$condition = "where id=" . $mailid ;

	$sql=updateSQL($param,"@@@mailqueue",$condition);

	query($sql);

	$str_url = "http://".$_SERVER['SERVER_NAME'] .  FOLDER . "mail.php?queueid=" . $mailid ;

	getRemoteData($str_url,"","",2);

}

?>