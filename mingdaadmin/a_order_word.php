<?php
require("php_admin_include.php");
isAuthorize($group[3]);

$var=array();
$id=getQuerySQL("id");
$sql="select * from `@@@order` where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$order=fetch($rs);
$coin=$order["coin"];
$discount=$order["discount"];
$itemno = $order["itemno"];
$order["domain"] = $_SERVER['SERVER_NAME'];
$sql="select * from @@@orderproduct where orderid=$id";
$ors=query($sql);
$totalprice=0;
$totalweight=0;
$totalnum=0;
while($rows=fetch($ors))
{
	$rows["pstyle"]=str_replace("<br />"," " , $rows["pstyle"]);
	$rows["realpic"]=getImageURL($rows["ppic"],-1,"uploadImage/",0);
	$rows["realpic1"]=getImageURL($rows["ppic"],1,"uploadImage/",0);
	$file="../uploadImage/".$rows["ppic"];
	if($fp = fopen($file, 'rb', 0))
	{
	   $rows["base64"]=base64_encode(fread($fp,filesize($file)));
	 $size=getimagesize(ROOT.FOLDER.$rows["realpic1"]);
	  $size=str_replace("=\"",":",$size[3]);
	  $size=str_replace("\"","px;",$size);
	  $rows["size"]=$size;
	}
	$rows["pname"] = str_replace("&"," ",$rows["pname"] )  ;
	$rows["pitemno"] = str_replace("&"," ",$rows["pitemno"] )  ;
	$rows["pstyle"] = str_replace("&"," ",$rows["pstyle"] )  ;
	$itemweight = $rows["pweight"] * $rows["pnum"] ;
	$itemprice = $rows["pnum"] * $rows["pprice"] ;
	//r2n($itemprice);
	$totalprice += $itemprice;
	$totalweight += $itemweight;
	$totalnum += $rows["pnum"];
	$var["rs_p"][]=$rows;
}
//debug($var["rs_p"]);
$order["productprice"]=$totalprice;
$totalprice=$totalprice+$order["sub1"]+$order["sub2"]+$order["sub3"]+$order["sub4"];
$order["totalprice"]=$totalprice;
$order["totalnum"]=$totalnum;
$order["arraddress"]=explode($cfg["split"] ,$order["address"] );
$var["order"]=$order;

$skin=datadefault($config[30],"default");
if($_COOKIE[ WEBID ."_SKIN"]!="")
{
	$skin = $_COOKIE[ WEBID. "_SKIN" ] ;
}
define("SKIN",$skin);

$var["folder"] = $cfg["folder"]  ;

require '../inc/Smarty-2.6.26/libs/Smarty.class.php';
$smarty = new Smarty(); 

$smarty->template_dir = '../skin/' . SKIN . '/templates/'; 
$smarty->compile_dir = '../skin/'. SKIN .'/templates_c/'; 
$smarty->config_dir = '../skin/'. SKIN .'/configs/'; 
$smarty->cache_dir = '../skin/'. SKIN .'/cache/'; 
$smarty->caching = false;
$smarty->compile_check = $cfg["smarty"]["compile_check"];
/*$smarty->left_delimiter = $cfg["smarty"]["left_delimiter"];
$smarty->right_delimiter = $cfg["smarty"]["right_delimiter"];*/
$smarty->left_delimiter = "{{";
$smarty->right_delimiter = "}}";

header("Cache-Control: public");
header('content-type:application/vnd.ms-word');
header("Content-Disposition:attachment; filename=".$itemno.".doc"); 

foreach ($var as $key=>$value)
{
	$smarty->assign($key,$value);
}
unset($var);
//echo $smarty->template_dir;
//echo $smarty->fetch("lay_feedback.html");
$smarty->display('Order_detail.xml');
?>