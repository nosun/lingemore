<?
// 入口页面。 处理伪静态的URL
//--  读取url-item 


//

$queryString=$_SERVER['QUERY_STRING'];
$requesturi = explode("/",$_SERVER['REQUEST_URI']);
$queryString = $requesturi[count($requesturi)-1];
if(preg_match("/(.*)-i([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["id"]=$matches[2];
	require_once($dd."info-view.php");
}
else if(preg_match("/(.*)-i([0-9]*)-([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["id"]=$matches[2];
	$_GET["page"]=$matches[3];
	require_once($dd."info-view.php");
}
else if(preg_match("/(.*)-p([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["id"]=$matches[2];
	require_once($dd."product-view.php");
}
else if(preg_match("/(.*)-n([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["id"]=$matches[2];
	require_once($dd."news-view.php");
}
else if(preg_match("/(.*)-n([0-9]*)-([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["id"]=$matches[2];
	$_GET["page"]=$matches[3];
	require_once($dd."news-view.php");
}
else if(preg_match("/(.*)-nc([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["nclassid"]=$matches[2];
	$_REQUEST["nclassid"]=$matches[2];
	require_once($dd."news.php");
}
else if(preg_match("/(.*)-nc([0-9]*)-([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["nclassid"]=$matches[2];
	$_REQUEST["nclassid"]=$matches[2];
	$_GET["page"]=$matches[3];
	require_once($dd."news.php");
}
else if(preg_match("/(.*)-c([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["classid"]=$matches[2];
	$_REQUEST["classid"]=$matches[2];
	require_once($dd."products.php");
}

else if(preg_match("/(.*)-c([0-9]*)-([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["classid"]=$matches[2];
	$_REQUEST["classid"]=$matches[2];
	$_GET["page"]=$matches[3];
	require_once($dd."products.php");
}
else if(preg_match("/(.*)-c([0-9]*)-(.*)-([0-9]*)\.html/",$queryString,$matches))
{
	//die();
	$_REQUEST["classid"]=$matches[2];
	$_GET["classid"]=$matches[2];
	$_GET["page"]=$matches[4];
	$_GET["query"]=$matches[3];
	require_once($dd."products.php");
}
else if(preg_match("/(.*)-nc([0-9]*)-(.*)-([0-9]*)\.html/",$queryString,$matches))
{
	$_REQUEST["nclassid"]=$matches[2];
	$_GET["nclassid"]=$matches[2];
	$_GET["page"]=$matches[4];
	$_GET["query"]=$matches[3];
	require_once($dd."news.php");	
}
else if(preg_match("/(.*)-s([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["disp"]=$matches[2];
	$_REQUEST["disp"]=$matches[2];
	require_once($dd."products.php");
}

else if(preg_match("/(.*)-s([0-9]*)-([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["disp"]=$matches[2];
	$_REQUEST["disp"]=$matches[2];
	$_GET["page"]=$matches[3];
	require_once($dd."products.php");
}

else if(preg_match("/(.*)-ptag([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["id"]=$matches[2];
	$_REQUEST["id"]=$matches[2];
	require_once($dd."tag-view.php");
}

else if(preg_match("/(.*)-ptag([0-9]*)-([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["id"]=$matches[2];
	$_REQUEST["id"]=$matches[2];
	$_GET["page"]=$matches[3];
	require_once($dd."tag-view.php");
}
else if(preg_match("/attr-([0-9]*)-(.*)-([0-9]*)\.html/",$queryString,$matches))
{
	$_GET["classid"]=$matches[1];
	$_GET["tags"]=$matches[2];
	$_GET["page"]=$matches[3];
	require_once($dd."attribute.php");
}
else
{
	require_once($a."default.php");
}
die("");
?>
