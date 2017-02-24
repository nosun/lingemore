<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");


$template_file = "lay_attribute.html";

$var["str_url_2"]="Tag";

$classid = getQueryInt("classid",0);

//获取tids
$tags=getQuery("tags");
$tags_url=explode(".",$tags);
$tags_url=array_filter($tags_url);

$sql="select * from @@@ptaglist where type>=0";
$rs=query($sql);
while($ctrows=fetch($rs))
{
	$tag[$ctrows["id"]]=$ctrows;
}

$product_condition = "where product.state>=0";

//----  创建左边的过滤器。
if($classid!=0 && $classid !=$proot)
{
	$tree=get_id_tree($class,$classid);
	$sql_leftfilter = "select mainptag.tid,count(mainptag.tid) as num from @@@ptag as mainptag inner join @@@product on @@@mainptag.pid=@@@product.id and @@@product.state>=0 and @@@product.classid in (" . $tree . ")  group by tid" ;	
}
else
	$sql_leftfilter = "select mainptag.tid,count(mainptag.tid) as num from @@@ptag as mainptag inner join @@@product on mainptag.pid=@@@product.id and @@@product.state>=0 group by tid" ;
$rs = query($sql_leftfilter);
while($rows=fetch($rs))
{
	$type = $tag[$rows["tid"]]["type"];
	if($tag[$rows["tid"]]["type"]==0)
		continue;
	$rows["name"] = $tag[$rows["tid"]]["name"] ;
	if(in_array($rows["tid"],$tags_url))
	{
		$rows["rewrite"] = getRewritePre() . "attr-$classid-" . join('.',array_diff($tags_url,array($rows["tid"]))) ."-1.html";
		$rows["checked"] = true;
	}
	else
	{	
		if($tags=="")
			$rows["rewrite"] = getRewritePre() . "attr-$classid-" . $rows["tid"] ."-1.html";
		else
			$rows["rewrite"] = getRewritePre() . "attr-$classid-$tags." . $rows["tid"] ."-1.html";
		$rows["checked"] = false;
	}
	$rows["sort"] = $tag[$rows["tid"]]["sort"] ;
	$rows["displayvalue"] = $tag[$rows["tid"]]["displayvalue"] ;
	$rs_leftfilter[$type]["name"] = $tag[$type]["name"] ;
	$rs_leftfilter[$type]["sort"] = $tag[$type]["sort"] ;
	$rs_leftfilter[$type]["displaytype"] = $tag[$type]["displaytype"] ;
	$rs_leftfilter[$type]["son"][] = $rows ;
}

sort_rows($rs_leftfilter,"sort",SORT_ASC);
foreach($arrfiltertype as $key=>$value)
{
	sort_rows($value["son"],"sort",SORT_ASC);	
}

$var["rs_leftfilter"] = $rs_leftfilter;

for($index=0;$index<count($tags_url);$index++)
{
	$arrfiltertype[ $tag[$tags_url[$index]]["type"] ][] = $tags_url[$index];
}
foreach($arrfiltertype as $key=>$value)
{
	//$joinsql.=" inner join @@@ptag as t$index on product.id = t$index.pid and (t$index.tid=".$tags_url[$index];
	$joinsql.=" inner join @@@ptag as t$key on @@@product.id = t$key.pid and (1=0 ";
	for($index=0;$index<count($value);$index++)
	{
		$joinsql.=" or t$key.tid=" . $arrfiltertype[$key][$index];
	}
	$joinsql.= ")";
}
	

$pagesize = $config[81]  ;
$pagenow=getQueryInt("page",1);
$rs=createJoinPage("product.*","@@@product",$joinsql,$product_condition," order by product.id desc" ,$pagesize,$pagenow,$pagetotal,$recordcount);
loadPage($pagenow,$pagetotal,$pagesize,$recordcount,$var);
while ( $rows = fetch($rs) )
{
	$rows["rewrite"]=getRewrite($rows["name"],$rows["id"],0,$cfg["rewrite"]);
	$rows["realpic"]=getImageURL($rows["pic"],1,"uploadImage/",$urltype);
	$rows["price"]=getPrice(1,$rows["price1"],$rows["pnum"],$rows["pprice"],$rows["lastprice"],$cfg) * $discount * $rate;
	r2n( $rows["price"] );
	if(!$rows["price2"] && ($config[117]!="")) 
		eval("\$rows['price2']={$rows['price']} {$config[116]} {$config[117]};");
	$var["rs_p"][]=$rows;
}
free($rs);

$var["rewriteurl"] =  getRewritePre() . "attr-$classid-" . $tags ;

require("uio_bomdata.php");

?>