<?php 
require("../inc/php_inc_config.php");
require("../inc/php_inc_request.php");
require("../inc/php_inc_function.php");

ignore_user_abort(true);
set_time_limit(0);

$url = getQuery("url");
$startpage = getQueryInt("startpage",1);
$endpage = getQueryInt("endpage",100);
$rule = getQuery("rule");
if($url=="")
	die("链接不能为空");
if( $rule=="" || !file_exists("../inc/rule/category/{$rule}.php") )
{
	die("规则错误");
}
require("../inc/rule/category/{$rule}.php");
$arr_product_url = array();
for($index=$startpage;$index<=$endpage;$index++)
{
	$url_now = make_real_url($url,$index) ;
	$html = getRemoteData($url_now);
	$arrmatch = preg_product_url($html);
	$result = array_merge ($arr_product_url, $arrmatch);
	$arr_product_url = $result ;
}
$arr_product_url=array_unique($arr_product_url);
array_remove_empty($arr_product_url);
echo join("\n",$arr_product_url);
?>
