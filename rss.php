<? header('Content-Type: text/xml');
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");
//--读取产品列表

$var["str_url"]="<a  href='".FOLDER."index.php'><span class='daoa' >Home</span></a> " . $cfg["split_uri"] . " Sitemap";
$var["str_url_2"]="Sitemap";

$condition = "where  state>0 ";
$classid = getQueryInt("classid",$proot);
if($classid!=$proot)
{
	$tree=get_id_tree($class,$classid);
	$condition .=  " and classid in (" . $tree . ")" ;
}

if(getQueryInt("disp",0)!=0)
{
	$sql="select * from @@@productdisp where id=".getQueryInt("disp",0);
	$rs=query($sql);
	if( BOF($rs) )
		redirect(FOLDER."error.php?id=1");
	$disp_rows = fetch($rs);
	
	$condition .=  " and disp & " . $disp_rows["value"] . " = " . $disp_rows["value"] ;
}

$sql="select * from @@@product $condition order by addtime desc limit 0," . getQueryInt("size",30);
$rs=query($sql);
$tmp=array(0);
while($rows=fetch($rs))
{
	$rows["rewrite"]= getRewrite($rows["name"],$rows["id"],0,$cfg["rewrite"]);
	$rows["realpic"]=getImageURL($rows["pic"],1,"uploadImage/");
	//$rows["bigpic"]=getImageURL($rows["pic"],2,"uploadImage/");
	$rows["price"]=getPrice(1,$rows["price1"],$rows["pnum"],$rows["pprice"],$rows["lastprice"],$cfg) * $discount * $rate;
	r2n( $rows["price"] );
	$tmp[]=$rows["id"];
	$var["rs_p"][]=$rows;
}
free($rs);
$app->data[$str]=join(',',$tmp);

$var["lastBuildDate"] = formatDateTime(time());
$var["linkhref"] = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

$sql="select content,id from @@@infoclass where id in ("  . dataDefault(join(',',$info),0) . ")" ;
$rs=query($sql);
while($rows=fetch($rs))
{
	$var["content_" . $rows["id"] ] = $rows["content"];
}
free($rs);
//----加载SMARTY变量------------
//-----------------------------
$var["process"]=formatNumber(timing_current()*1000);
$var["memry"]=formatNumber(memory_get_usage()/1024);
foreach ($var as $key=>$value)
{
	$smarty->assign($key,$value);
}
unset($var);
$smarty->register_outputfilter('remove_dw_comments');
timing_stop();
$smarty->debugging = false;
ob_clean();
$smarty->display('lay_rss.xml');
require("uio_bomdata.php");
?>

