<?

require("inc/php_inc.php");

require("inc/Smarty-2.6.26/libs/Smarty.class.php");

require("uio_pubdata.php");

//--读取产品列表

$template_file = "";



$condition="where state>0" ;

$condition1="where state>0 and disp&4=4 " ;

$pageurl="products.php?1=1" ;

$pagerewrite="";

$classid=getRequestInt("classid",$proot);

$arr_url=split( ',' , $class[$classid]["url"] );

$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a>";

$var["str_url_2"]=$class[$arr_url[count($arr_url)-1]]["name"];

$var["title"] = $var["str_url_2"] . " - " . $var["title"];

$var["pagename"]="products.php";



$sql="select * from @@@productclass where id=$classid and state>0";

$rs=query($sql);

if( BOF($rs) )

	redirect(FOLDER."error.php?id=1");

$category_row=fetch($rs);

$classlevel = $category_row["level"] ;

$classorderfield = dataDefault($category_row["orderfield"],$config[220+2*($classlevel-1)] );

$classoderby = dataDefault($category_row["orderby"],$config[221+2*($classlevel-1)]) ;

$classorderfield = dataDefault($classorderfield,"id");

$classoderby = dataDefault($classoderby,"desc");

$classdetailmode = dataDefault($category_row["detailmode"],"1");

$var["categoryname"] = $category_row["name"] ;



$var["category"] = $category_row ;



if($classid!=$proot)

{

	$piclassid=$arr_url[1];

	$sql="select * from @@@productclass where id=$piclassid";

	$rsc=query($sql);

	$crows=fetch($rsc);

	

	$var["categorypic"]=getImageURL($crows["bigpic"],-1,"systemImage/",0);

	$var["categorybigpic"]=$crows["bigpic"];

	$var["categorypicurl"]=$crows["bigurl"];

	$var["categorybigname"]=$class[$piclassid]["name"];

}

else

{

	$piclassid=$arr_url[0];

	$sql="select * from @@@productclass where id=$piclassid";

	$rsc=query($sql);

	$crows=fetch($rsc);

	

	$var["categorypic"]=getImageURL($crows["bigpic"],-1,"systemImage/",0);

	$var["categorybigpic"]=$crows["bigpic"];

	$var["categorypicurl"]=$crows["bigurl"];

	$var["categorybigname"]=$class[$piclassid]["name"];

}



//--------加入搜索词

if( getRequest("is_search")!="" && getRequest("name")!="" )

{

	$var["statscript"][] = FOLDER."stat.php?action=stat&type=searchkey&name=" . urlencode( getRequest("name") );

}

//--- 读取分类的SEO模板

$sql = "select * from `@@@seo` where id=2";

$rs = query($sql);

while($seorows=fetch($rs))

{

	$tpl_seo_title = $seorows["title"];

	$tpl_seo_keywords = $seorows["keywords"];

	$tpl_seo_descript = $seorows["descript"];

}

$arr_seo_key[0] = "{VAR_shopname}"; $arr_seo_value[0] = $config[63] ;

$arr_seo_key[1] = "{VAR_catename}"; $arr_seo_value[1] = $class[$classid]["name"] ;

$arr_seo_key[2] = "{VAR_cateparent}"; $arr_seo_value[2] = $class[$class[$classid]["father"]]["name"] ;

$arr_seo_key[3] = "{VAR_catepath}";

for($index=0;$index<count($arr_url);$index++)

{

	$arr_seo_value[3] .= $class[$arr_url[$index]]["name"] . "," ;

}

$arr_seo_value[3] = substr($arr_seo_value[3],0,strlen($arr_seo_value[3])-1);

$var["title"] = ($category_row["title"]!="") ? $category_row["title"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_title) ;

$var["keywords"] = ($category_row["keywords"]!="") ? $category_row["keywords"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_keywords) ;

$var["descript"] = ($category_row["descript"]!="") ? $category_row["descript"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_descript) ;

//

for($index=0;$index<count($arr_url);$index++)

{

	$var["str_url"] .= " " . $cfg["split_uri"] . " <a title='".$class[$arr_url[$index]]["name"]."' href='"  . getRewrite($class[$arr_url[$index]]["name"],$arr_url[$index],3,$cfg["rewrite"]) . "'><span class='daoa'>" . $class[$arr_url[$index]]["name"] . "</span></a>" ;

}



$arrQuery = split( '-' , getQuery("query") );

$sql_param["classid"]   = getRequestInt("classid",$proot) ;

$sql_param["disp"]    	= filterSQL(dataDefault($arrQuery[0],getRequest("disp"))) ;

$sql_param["name"]   	= str_replace('-','|' , trim (dataDefault($arrQuery[1],getRequest("name")) ) ) ;

$sql_param["name"]   	= str_replace('+',' ' , $sql_param["name"]) ;

$sql_param["name"]   	= filterSQL(urldecode( $sql_param["name"] )) ;

$sql_param["brandid"]	= filterSQL(dataDefault($arrQuery[2],getRequest("brandid")));

$sql_param["pfrom"]  	= filterSQL(dataDefault($arrQuery[3],getRequest("pfrom")));

$sql_param["pto"]     	= filterSQL(dataDefault($arrQuery[4],getRequest("pto")));

$sql_param["p1"] 		= filterSQL(dataDefault($arrQuery[5],getRequest("p1")));

$sql_param["p2"] 		= filterSQL(dataDefault($arrQuery[6],getRequest("p2" )));

$sql_param["p3"] 		= filterSQL(dataDefault($arrQuery[7],getRequest("p3" )));

$sql_param["p4"] 		= filterSQL(dataDefault($arrQuery[8],getRequest("p4" )));

$sql_param["p5"] 		= filterSQL(dataDefault($arrQuery[9],getRequest("p5")));

$sql_param["p6"] 		= filterSQL(dataDefault($arrQuery[10],getRequest("p6")));

$var["filteritem"]      = $sql_param["p6"];



$rewriteParam["pagesize"] = dataDefault($sql_param["p2"],$config[81] ) ;

$rewriteParam["orderitem"] = dataDefault($sql_param["p3"],$classorderfield);

$rewriteParam["orderby"] = dataDefault($sql_param["p4"],$classoderby) ;

$rewriteParam["detail"] = dataDefault($sql_param["p5"],$classdetailmode);



$template_file = 'lay_products' . $rewriteParam["detail"] . '.html';



if($classid!=$proot)

{

	$p1=$sql_param["p1"];

	if(empty($p1))

	{

		$tree=get_id_tree($class,$classid);

		$condition .=  " and classid in (" . $tree . ")" ;

		$condition1 .= " and classid in (" . $tree . ")" ;

	}

	else

	{

		$condition .=  " and classid=" . $classid ;

	}

}



if($sql_param["p6"])

{

	if($sql_param["p6"]==1)

	{

		$sql_param["disp"]=6;

	}

	else

	{

		$condition .=  " and freeshipping=1" ;

		$sql_param["disp"]="";

	}

}



if($sql_param["disp"])

{

	$sql="select * from @@@productdisp where id='".$sql_param["disp"]."'";

	$rs=query($sql);

	if( BOF($rs) )

		redirect(FOLDER."error.php?id=1");

	$disp_rows = fetch($rs);

	$condition .=  " and disp & " . $disp_rows["value"] . " = " . $disp_rows["value"] ;

	$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " <a href='".FOLDER."products.php'><span class='daoa' >Products</span></a> " . $cfg["split_uri"] . " " . $disp_rows["name"] ;

	$var["str_url_2"] = $disp_rows["name"] ;

	$var["title"] = dataDefault($disp_rows["title"],$disp_rows["name"] . " - " . $config[63]);

	$var["keywords"] = dataDefault($disp_rows["keywords"],$disp_rows["name"] . " - " . $config[63]);

	$var["descript"] = dataDefault($disp_rows["descript"],$disp_rows["name"] . " - " . $config[63]);

}



$arrkeyword=array();

$arrreplace=array();

if($sql_param["name"])

{

	$arrkeyword = split(' ' , str_replace('|','-' , $sql_param["name"]) );

	$var["search_keywords"] = stripslashes(str_replace('|','-' , $sql_param["name"])) ;

	$arrlikesql = array();

	for($index=0;$index<count($arrkeyword);$index++)

	{

		$arrstr[]="name like '%" . $arrkeyword[$index] . "%'";

		$arrreplace[] = "<span class='replace_span'>" . $arrkeyword[$index] . "</span>" ;

		//$arrppdsql[] = pow(2,count($arrkeyword)-$index) . "*(length(name)-length(replace(name,'{$arrkeyword[$index]}','')))" ;

		$arrppdsql[] =  "(length(name)-length(replace(lower(name),'".strtolower($arrkeyword[$index])."','')))" ;

	}

	if( count($arrkeyword)>1 )

	{

		$searchfield = ",(". join('+',$arrppdsql) .") as ppd";

		$searchorderby = "ppd desc," ;

	} 

	$condition .=  " and ( (" . join(' or ' ,$arrstr ) . ") or itemno like '%" .  str_replace('|','-' , $sql_param["name"]) . "%')" ;

	

	$pageurl .= "&name=" . $sql_param["name"] ;

}

if( $sql_param["brandid"] )

{

	$condition .=  " and brandid='" . $sql_param["brandid"]."'" ;

	$brandname=fetchValue("select name as v from @@@brandclass where id=" . $sql_param["brandid"] , "NULL");

	$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " <a href='products.php'><span class='daoa' >Products</span></a> " . $cfg["split_uri"] . " " . $brandname;

	$var["str_url_2"]=$brandname;

}

if( $sql_param["pfrom"] )

{

	$condition .=  " and price1>='" . $sql_param["pfrom"]."'";

}

if( $sql_param["pto"] )

{

	$condition .=  " and price1<='" . $sql_param["pto"]."'";

}





//debug($condition);



if(true && $sql_param["name"])

{

	$sql = "select count(classid) as t,classid from `@@@product` $condition group by classid order by t desc";

	

	$rs = query($sql);

	$displayleve = $class[$classid]["level"] + 1 ;

	while($rows=fetch($rs))

	{

		

		$arrtmp = split(',' , $class[$rows["classid"]]["url"] );

		if( $displayleve>=count($arrtmp) )

			continue;

		$tmpclassid = $arrtmp[$displayleve] ;

		$var["search_totalnum"] += $rows["t"] ;

		$var["rs_relate"][$tmpclassid]["name"] = $class[$tmpclassid]["name"] ;

		$var["rs_relate"][$tmpclassid]["t"] += $rows["t"] ;

		$var["rs_relate"][$tmpclassid]["rewrite"] = FOLDER . "products.php?classid={$tmpclassid}&name=" . urlencode($sql_param["name"]) ;

	}

}

//select product.id,sum(orderproduct.pnum) as total  from product left join orderproduct on (orderproduct.pid=product.id) and 1=1 group by product.id order by total desc,id desc ;

//debug($var["rs_relate"]);

$pagenow=getQueryInt("page",1);

if($pagenow==1 && $classid != $proot)

{

	$var["statscript"][] = FOLDER."stat.php?action=stat&type=category&id=" . $classid;

}

$pagesize=dataDefault($rewriteParam["pagesize"],$config[81]);

$var["pagesize"] = $pagesize;



if( $rewriteParam["orderitem"]=="sale" )

{

	//$rs = query("select @@@product.*,sum(@@@orderproduct.pnum) as total  from @@@product left join @@@orderproduct on (@@@orderproduct.pid=@@@product.id) where 1=1 and classid=521 group by @@@product.id order by total desc,id desc");

	$joinsql = "left join @@@orderproduct on (@@@orderproduct.pid=@@@product.id)";

	$rs=createSalePage("@@@product.*,sum(@@@orderproduct.pnum) as totalsale","@@@product",$joinsql,$condition," group by product.id order by totalsale desc,id desc" ,$pagesize,$pagenow,$pagetotal,$recordcount);

}

else

{

	$rs=createPage("*".$searchfield,"@@@product",$condition," order by " . $searchorderby . dataDefault($rewriteParam["orderitem"],$config[160]) . " " . dataDefault($rewriteParam["orderby"],$config[161]) ,$pagesize,$pagenow,$pagetotal,$recordcount);

}



loadPage($pagenow,$pagetotal,$pagesize,$recordcount,$var);

while($rows=fetch($rs))

{

	$rows["rewrite"] =  getRewrite($rows["name"],$rows["id"],0,$cfg["rewrite"]);

	$rows["realpic"] = $config[61] .  getImageURL($rows["pic"],1,"uploadImage/",$urltype);

	$rows["bigpic"] = $config[61] . getImageURL($rows["pic"],4,"uploadImage/",$urltype);

	$rows["largerpic"] = $config[61] . getImageURL($rows["pic"],7,"uploadImage/",$urltype);

	$rows["search_name"] = str_ireplace( $arrkeyword,$arrreplace,$rows["name"] );

	//$rows["bigpic"]= $config[61] . getImageURL($rows["pic"],2,"uploadImage/",$urltype);

	$rows["pvalue"] =split( $cfg["split"] , $rows["pvalue"] );

	$rows["price"]= $rows["price1"] * $discount * $rate;

	r2n( $rows["price"] );

	if(!$rows["price2"] && ($config[300]!="")) 

		eval("\$rows['price2']={$rows['price']} {$config[299]} {$config[300]};");

	$rows["s_content"] = substr( strip_tags($rows["content"]) , 0 , 200 ) . "...";

	$rows["pkey"] =split( $cfg["split"] , $rows["pkey"] );

	$rows["pvalue"] =split( $cfg["split"] , $rows["pvalue"] );

	$rows["ckey"] =split( $cfg["split"] , $rows["ckey"] );

	$rows["cvalue"] =split( $cfg["split"] , $rows["cvalue"] );

	$rows["ctype"] =split( $cfg["split"] , $rows["ctype"] );

	$rows["totalsale"] = dataDefault($rows["totalsale"],0);

	

	$var["rs_p"][]=$rows; 

} 



free($rs);

$grouporderp = fetchValueGroup("select id as v from @@@product $condition limit 1000");

$arrgrouporderp = split(',',$grouporderp) ;
$sql="select p.*,m.name as r_name,m.content as r_content,m.pic as r_pic,m.pic1 as r_pic1,m.username,m.addtime as r_addtime,m.rating from @@@product as p join @@@message as m on p.id=m.pid and m.pid in({$grouporderp}) group by p.id order by m.addtime desc,m.rating desc  limit 15";
$rs=query($sql);
while($rows=fetch($rs))
{
	$rows["rewrite"] =  getRewrite($rows["name"],$rows["id"],0,$cfg["rewrite"]);
	$rows["realpic"] = $config[61] .  getImageURL($rows["pic"],1,"uploadImage/",$urltype);
	$rows["r_realpic"] = $config[61] .  getImageURL($rows["r_pic"],1,"Attachment/",$urltype);
	$rows["r_realpic1"] = $config[61] .  getImageURL($rows["r_pic1"],1,"Attachment/",$urltype);
	$var["rs_p_review"][]=$rows; 
}
//var_dump($var["rs_p_review"]);
/*$sql="select * from @@@product $condition1 limit 20";

$rs=query($sql);

while($rows=fetch($rs))

{

	$rows["rewrite"] =  getRewrite($rows["name"],$rows["id"],0,$cfg["rewrite"]);

	$rows["realpic"] = $config[61] .  getImageURL($rows["pic"],8,"uploadImage/",$urltype);

	$rows["bigpic"] = $config[61] . getImageURL($rows["pic"],4,"uploadImage/",$urltype);

	$rows["largerpic"] = $config[61] . getImageURL($rows["pic"],7,"uploadImage/",$urltype);

	$rows["search_name"] = str_ireplace( $arrkeyword,$arrreplace,$rows["name"] );

	//$rows["bigpic"]= $config[61] . getImageURL($rows["pic"],2,"uploadImage/",$urltype);

	$rows["pvalue"] =split( $cfg["split"] , $rows["pvalue"] );

	$rows["price"]= $rows["price1"] * $discount * $rate;

	r2n( $rows["price"] );

	if(!$rows["price2"] && ($config[300]!="")) 

		eval("\$rows['price2']={$rows['price']} {$config[299]} {$config[300]};");

	$rows["s_content"] = substr( strip_tags($rows["content"]) , 0 , 200 ) . "...";

	$rows["pkey"] =split( $cfg["split"] , $rows["pkey"] );

	$rows["pvalue"] =split( $cfg["split"] , $rows["pvalue"] );

	$rows["ckey"] =split( $cfg["split"] , $rows["ckey"] );

	$rows["cvalue"] =split( $cfg["split"] , $rows["cvalue"] );

	$rows["ctype"] =split( $cfg["split"] , $rows["ctype"] );

	$rows["totalsale"] = dataDefault($rows["totalsale"],0);

	

	$var["rs_bestseller"][]=$rows; 

} 



free($rs);
*/


function getSwitchURL($index,$value)

{

	global $rewriteParam;

	global $sql_param;

	$param[0] = $sql_param["disp"];

	$param[1] = urlencode($sql_param["name"]) ;

	$param[2] = $sql_param["brandid"] ;

	$param[3] = $sql_param["pfrom"] ;

	$param[4] = $sql_param["pto"] ;

	$param[5] = $sql_param["p1"] ;

	$param[6] = $rewriteParam["pagesize"] ;

	$param[7] = $rewriteParam["orderitem"] ;

	$param[8] = $rewriteParam["orderby"] ;

	$param[9] = $rewriteParam["detail"] ;

	$param[10] = $sql_param["p6"] ;

	$param[11] = 1 ;

	$param[$index] = $value ;

	return  join('-' , $param) . ".html";

}



function getSwitchURL2($index,$value,$index1,$value1)

{

	global $rewriteParam;

	global $sql_param;

	$param[0] = $sql_param["disp"];

	$param[1] = urlencode($sql_param["name"]) ;

	$param[2] = $sql_param["brandid"] ;

	$param[3] = $sql_param["pfrom"] ;

	$param[4] = $sql_param["pto"] ;

	$param[5] = $sql_param["p1"] ;

	$param[6] = $rewriteParam["pagesize"] ;

	$param[7] = $rewriteParam["orderitem"] ;

	$param[8] = $rewriteParam["orderby"] ;

	$param[9] = $rewriteParam["detail"] ;

	$param[10] = $sql_param["p6"] ;

	$param[11] = 1 ;

	$param[$index] = $value ;

	$param[$index1] = $value1 ;

	return  join('-' , $param) . ".html";

}



$tmprewrite = getRewritePre() .  makeRewrite( $var["str_url_2"]) ; 

$str_switch = $tmprewrite . "-c$classid-" ;

$var["rewriteurl"] =  $tmprewrite . "-c$classid-" . $sql_param["disp"] . "-" . urlencode($sql_param["name"]) . "-" . $sql_param["brandid"] . "-" . $sql_param["pfrom"] . "-" . $sql_param["pto"] . "-" . $sql_param["p1"] . "-" . $rewriteParam["pagesize"] . "-" . $rewriteParam["orderitem"]. "-" . $rewriteParam["orderby"] . "-" . $rewriteParam["detail"];



if( !$sql_param["disp"] && !$sql_param["name"] && !$sql_param["brandid"] && !$sql_param["pfrom"]  && !$sql_param["pto"]  && !$sql_param["p1"] && !$sql_param["p2"] && !$sql_param["p3"] && !$sql_param["p4"] && !$sql_param["p5"] )

{

	$var["rewriteurl"] = $tmprewrite . "-c$classid" ;

}



if( $sql_param["disp"] && $sql_param["classid"]==$proot && !$sql_param["name"] && !$sql_param["brandid"] && !$sql_param["pfrom"]  && !$sql_param["pto"]  && !$sql_param["p1"] && !$sql_param["p2"] && !$sql_param["p3"] && !$sql_param["p4"] && !$sql_param["p5"] )

{

	$var["rewriteurl"] = getRewritePre() . makeRewrite( $var["str_url_2"]) . "-s" . $sql_param["disp"] ;

}



$mode = split (',' , $config[306] );

$var["mode"] = $mode;



$var["rewrite"]=array();

for($index=0; $index<count($var["mode"]);$index++)

{

    $var["rewrite"][$var["mode"][$index]] = $str_switch . getSwitchURL(6,$var["mode"][$index]) ;	

}

$var["rewrite"]["orderid"] = $str_switch . getSwitchURL(7,"id") ;

$var["rewrite"]["ordername"] = $str_switch . getSwitchURL(7,"name");

$var["rewrite"]["orderprice"] = $str_switch . getSwitchURL(7,"price1");

$var["rewrite"]["ordertime"] = $str_switch . getSwitchURL(7,"addtime") ;

$var["rewrite"]["ordersort"] =  $str_switch . getSwitchURL(7,"state") ;

$var["rewrite"]["orderitemno"] =$str_switch . getSwitchURL(7,"itemno");

$var["rewrite"]["orderview"] = $str_switch . getSwitchURL(7,"hits");

$var["rewrite"]["ordersale"] = $str_switch . getSwitchURL(7,"sale") ;

$var["rewrite"]["bydesc"] = $str_switch . getSwitchURL(8,"desc");

$var["rewrite"]["byasc"] = $str_switch . getSwitchURL(8,"asc");

$var["rewrite"]["grid"] =$str_switch . getSwitchURL(9,"");

$var["rewrite"]["list"] = $str_switch . getSwitchURL(9,"2");

$var["rewrite"]["gallery"] = $str_switch . getSwitchURL(9,"3");



$var["rewrite"]["filter0"] = $str_switch . getSwitchURL2(0,"",10,"") ;

$var["rewrite"]["filter1"] = $str_switch . getSwitchURL(10,"1") ;

$var["rewrite"]["filter2"] = $str_switch . getSwitchURL(10,"2") ;



$var["orderindex"] = array_search( $rewriteParam["orderitem"] , array("id","itemno","name","price1","addtime","sort","hits","sale") ) ;

$var["orderbyindex"] = array_search( $rewriteParam["orderby"] , array("desc","asc") ) ;

$var["numindex"] = array_search( $rewriteParam["pagesize"] , $mode ) ;



//------ 读取 分类关联的标签。



if($classid!=$proot)

{

	$sql="select * from @@@ptaglist where type>=0";

	$rs=query($sql);

	while($ctrows=fetch($rs))

	{

		$tag[$ctrows["id"]]=$ctrows;

	}

		

	$sql = "select tid,count(tid) as num from @@@ptag inner join @@@product on pid=@@@product.id and state>=0 and classid in($tree) group by tid" ;

	$rs = query($sql);

	while($rows=fetch($rs))

	{

		$type = $tag[$rows["tid"]]["type"] ;

		if(!$type)

			continue;	

		$rows["name"] = $tag[$rows["tid"]]["name"] ;

		$rows["rewrite"] = getRewritePre() . "attr-$classid-" . $rows["tid"] ."-1.html";

		$var["rs_filter"][$type]["name"] = $tag[$type]["name"] ;

		$var["rs_filter"][$type]["son"][] = $rows ;

	}

}



require("uio_bomdata.php");

?>



