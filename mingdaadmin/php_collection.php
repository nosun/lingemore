<?php 
require("../inc/php_inc_config.php");
require("../inc/php_inc_request.php");
require("../inc/php_inc_function.php");
require("../inc/php_inc_database.php");
set_time_limit(0);
ignore_user_abort(true);
if(  getQuery("name")!="" )
{
	//$sql="select * from @@@admin where name='"  . getQuery("name") . "' and pwd='" . getQuery("pwd") . "'";
	//$rs=query($sql);
	//if( BOF($rs) )
	if( getQuery("name")!=CDNKEY)
	{
		die("Reg Error");
	}
}
else
{
	die("Reg Error");
}





$classid = getQueryInt("classid",0);
$rule = getQuery("rule");
$url = getForm("url");

if( $classid==0 )
{
	log_result("分类错误:".$url,"class",$classid);
	die("no");
}


if( $rule=="" || !file_exists("../inc/rule/product/{$rule}.php") )
{
	log_result("规则错误:".$url,"class",$classid);
	die("no");
}

require("../inc/rule/product/{$rule}.php");

$html = getRemoteData($url);
if( $html==false )
{
	log_result("网络错误:".$url,"class",$classid);
	die("no");
}
$param = array();

//$param["pic"] = preg_p_name($html);
$param["name"] = preg_p_name($html);
$param["classid"] = $classid;
$param["itemno"] = preg_p_itemno($html);
$param["price1"] = preg_p_price1($html);
$param["price2"] = dataDefault(preg_p_price2($html),0);
$param["remoteurl"] = $url ;
$param["weight"] = preg_p_weight($html);
$param["pic"] = GrabRemoteImage(preg_p_pic($html),"../uploadImage/");
$param["content"] = preg_p_content($html);
$psql=insertSQL($param,"@@@product");

$arr_otherpic = preg_p_otherpic($html);



//--- 运行插入数据库
$conn=mysql_connect($cfg["db_server"],$cfg["db_username"],$cfg["db_userpwd"]);
mysql_select_db($cfg["db_name"]);
query("set names " . $cfg["db_charset"] ) . "";

 // 产品插入SQL
query($psql);
$pid=mysql_insert_id();
if( $pid==0 )
{
	//file_put_contents("log/a.txt" , $psql) ;
	log_result("产品插入:".$url,"class",$classid);
	log_result($psql.";","class",$classid);
	die("no");
}

for($index=0;$index<count($arr_otherpic);$index++)
{
	$param = array();
	$param["pid"] = $pid;
	$param["pic"] = GrabRemoteImage($arr_otherpic[$index],"../otherImage/");
	$sql=insertSQL($param,"@@@otherimage");
	query($sql);
}

query("update @@@product set state=id where id=".$pid);
die("yes");
?>