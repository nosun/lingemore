<?

$uio_page = "product_view";

require("inc/php_inc.php");

require("inc/Smarty-2.6.26/libs/Smarty.class.php");

require("uio_pubdata.php");



$template_file = "lay_product_view.html";



$pid=getQueryInt("id",0);

$sql="select * from @@@product where id=$pid and state>0";

$rs=query($sql);

if( BOF($rs) )

	redirect(FOLDER."error.php?id=1");

$rows=fetch($rs);



//---读取产品的其他图片以及 CSS相关的属性图片

$sql="select * from @@@otherimage where pid=$pid order by sort asc";

$ors=query($sql);

$tmpcsspic = array();

$tmpcothervalue = array();

while($orows=fetch($ors))

{

	

	if( $orows["type"] == 1 )

	{

		$orows["csspic"] = $config[61] . getImageURL($orows["pic"],5,"otherImage/",$urltype);

		$orows["bigpic"] = $config[61] . getImageURL($orows["pic"],2,"otherImage/",$urltype);

		$tmpcsspic[] =  $orows["csspic"] . "|" .  $orows["bigpic"] ;

		$tmpcothervalue[] = $orows["name"] ;

	}

	else

	{

		$orows["realpic"]= $config[61] . getImageURL($orows["pic"],0,"otherImage/",$urltype);

		$orows["realpic1"]=getImageURL($orows["pic"],2,"otherImage/",$urltype);

		$orows["bigpic"] = $config[61] . getImageURL($orows["pic"],-1,"otherImage/",$urltype);

	}

	$var["rs_o"][$orows["type"]][]=$orows;

}

free($rs);



$rows["categoryName"] = $class[$rows["classid"]]["name"] ;

$rows["categoryRewrite"] = getRewrite($class[$rows["classid"]]["name"],$rows["classid"],3,$cfg["rewrite"]) ;



$var["title"] = $rows["name"] . " - " . $var["title"];

$rows["pic1"] = $config[61] . getImageURL($rows["pic"],-1,"uploadImage/",$urltype);

$rows["smallpic"] = $config[61] . getImageURL($rows["pic"],0,"uploadImage/",$urltype);



//

$rows["addtime"] = formatDate(strtotime($rows["addtime"]));

$rows["realpic"] = $config[61] . getImageURL($rows["pic"],2,"uploadImage/",$urltype);



//--- 计算批发价格的列表  以及 市场价格

$rows["arrnum"] =split( $cfg["split"] , $rows["pnum"] );

$rows["arrnum"]=array_filter($rows["arrnum"],callback_empty);

$rows["arrremark"] =split( $cfg["split"] , $rows["premark"] );

$rows["arrprice"] =split( $cfg["split"] , $rows["pprice"] );

if( $rows["arrnum"] )

{	$miniorder = dataDefault($rows["minnum"],1);

	$quantityprice_1 = $miniorder . " - " . $rows["arrnum"][0] ;

	$rows["wholesaleprice"][] = array("numitem"=>$quantityprice_1,"remark"=>$rows["arrremark"][0],"price"=>$rows["arrprice"][0]* $rate * $discount * $rows["price1"]/100);

	for($index=1;$index<count( $rows["arrnum"] );$index++)

	{

		$rows["wholesaleprice"][] = array("numitem"=> $rows["arrnum"][$index-1] . " - "  .  $rows["arrnum"][$index],"remark"=>$rows["arrremark"][$index],"price"=>$rows["arrprice"][$index] * $rate * $discount * $rows["price1"]/100);	

	}

	$rows["wholesaleprice"][] = array("numitem"=> $rows["arrnum"][$index-1] . " - max","remark"=>$rows["lastremark"],"price"=>$rows["lastprice"] * $rate * $discount * $rows["price1"]/100);

}



$rows["price1"] = $rows["price1"] * $rate * $discount;

$rows["price2"] = $rows["price2"] * $rate * $discount ;



if(!$rows["price2"] && ($config[300]!="")) eval("\$rows['price2']={$rows['price1']} {$config[299]} {$config[300]};");



r2n( $rows["price1"] );

r2n( $rows["price2"] );

r2n( $rows["lastprice"] );



//---  读取产品属性 以及 购物车的属性

$rows["pprice"] =split( $cfg["split"] , $rows["pprice"] );

$rows["pkey"] =split( $cfg["split"] , $rows["pkey"] );

$rows["pvalue"] =split( $cfg["split"] , $rows["pvalue"] );

$rows["ckey"] =split( $cfg["split"] , $rows["ckey"] );

$rows["cvalue"] =split( $cfg["split"] , $rows["cvalue"] );

$rows["ctype"] =split( $cfg["split"] , $rows["ctype"] );

$rows["cprice"] =split( $cfg["split"] , $rows["cprice"] );



for($index=0;$index<count($rows["ckey"]);$index++)

{

	$tmpctype = $rows["ctype"][$index] ;

	$tmpcvalue = $rows["cvalue"][$index] ;

	$tmpckey = $rows["ckey"][$index] ;

	$tmpcprice = $rows["cprice"][$index] ;

	if( $tmpctype==10)

	{

		$tmpcprice = join(',',$tmpcsspic) ;

		$tmpcvalue = join(',',$tmpcothervalue) ;

	}

	$rows["cHTML"][$index] = fetch_sc_HTML($tmpctype,$tmpcvalue,$index,$tmpckey,$tmpcprice,$coin,"");

}

$var["showAmount"]=true;

if( count($rows["ckey"])==1 && $rows["ctype"][0]==4 )

	$var["showAmount"]=false;

removeSplitEmpty($rows["pkey"]);

for($index=0;$index<count($rows["pkey"]);$index++)

{

	$tmp = split (':',$rows["pkey"][$index] );

	$rows["pkey2"][] = $tmp[0] ;

	$rows["pvalue2"][] = $tmp[1] ;

}

removeSplitEmpty($rows["ckey"]);





//--- 读取产品的 TAG 列表

$sql = "select * from @@@ptag where pid=" . $rows["id"] . " order by id asc";

$trs = query($sql);

while( $trows = fetch( $trs ) )

{

	$trows["rewrite"] = getRewrite($trows["name"],$trows["tid"],6  );

	$rows["tag"][] = $trows; 

}



//------ 读取产品被添加的个数



$rows["favorite"] = fetchValue("select count(1) as v from favorite where pid=".$rows["id"],0);





//------- 读取产品的推荐类型列表

$arrdisp = split(',' , c2tostr(decbin($rows["disp"])) );

for($index=0;$index<count( $arrdisp );$index++)

{

	if( $arrdisp[$index]!=0 )

	{

		//$rows["arrdisp"][] = array("name"=>$cfg["product"]["disp"][log($arrdisp[$index],2)],"rewrite"=>getRewrite($cfg["product"]["disp"][log($arrdisp[$index],2)],pow(2,$index),7)));

	}

}









//--  读取 标题，路径，二级标题

$pclassid=$rows["classid"];

$arr_url=split( ',' , $class[$pclassid]["url"] );

$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a>";

for($index=0;$index<count($arr_url);$index++)

{

	$var["str_url"] .= " " . $cfg["split_uri"] . " <a href='" .  getRewrite($class[$arr_url[$index]]["name"],$arr_url[$index],3,$cfg["rewrite"]) . "'><span class='daoa'>" . $class[$arr_url[$index]]["name"] . "</span></a>" ;



}

$var["str_url_2"]= $rows["name"] ;

$var["pid"]=$pid;

$var["statscript"][] = FOLDER."stat.php?action=stat&type=product&id=" . $pid;



free($rs);





//--- 读取商品详细页面的SEO模板并且设置title,descript,keywords

$sql = "select * from `@@@seo` where id=3";

$rs = query($sql);

while($seorows=fetch($rs))

{

	$tpl_seo_title = $seorows["title"];

	$tpl_seo_keywords = $seorows["keywords"];

	$tpl_seo_descript = $seorows["descript"];

}

$arr_seo_key[0] = "{VAR_shopname}"; $arr_seo_value[0] = $config[63] ;

$arr_seo_key[1] = "{VAR_pcatename}"; $arr_seo_value[1] = $class[$classid]["name"] ;

$arr_seo_key[3] = "{VAR_pname}"; $arr_seo_value[3] = $rows["name"] ;

$arr_seo_key[2] = "{VAR_pcatepath}";

for($index=0;$index<count($arr_url);$index++)

{

	$arr_seo_value[2] .= $class[$arr_url[$index]]["name"] . "," ;

}

$arr_seo_value[2] = substr($arr_seo_value[2],0,strlen($arr_seo_value[2])-1);

$var["title"] = ($rows["title"]!="") ? $rows["title"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_title) ;

$var["keywords"] = ($rows["keywords"]!="") ? $rows["keywords"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_keywords) ;

$var["descript"] = ($rows["descript"]!="") ? $rows["descript"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_descript) ;



/*

$strgroup =  fetchValueGroup("select a.pid as v from orderproduct as a inner join orderproduct as b on b.pid=$pid  where a.orderid = b.orderid order by a.id desc limit 30") ;

$sql="select * from product where id in ($strgroup) and id!=$pid and  state>=0 limit 7";

$rs=query($sql);

while($rows_also=fetch($rs))

{

	$rows_also["rewrite"]=getRewrite($rows_also["name"],$rows_also["id"],0,$cfg["rewrite"]);

	$rows_also["realpic"]=getImageURL($rows_also["pic"],0,"uploadImage/",$urltype);

	$rows_also["price"]=getPrice(1,$rows_also["price1"],$rows_also["pnum"],$rows_also["pprice"],$rows_also["lastprice"],$cfg) * $discount * $rate;

	$rows_also["price2"]=$rows_also["price2"]*$rate;

	$var["rs_p_also"][]=$rows_also;

}

*/



//------  读取产品的统一分类下的相关产品

srand((float)microtime()*10000000);

$grouporderp = fetchValueGroup("select id as v from @@@product where state>=0 and classid=$pclassid limit 100");

$arrgrouporderp = split(',',$grouporderp) ;

shuffle($arrgrouporderp);

$rand_keys = array_slice  ( $arrgrouporderp , 0 , 10);

$sql="select * from @@@product where state>=0 and id in (".dataDefault(join(',',$rand_keys),0).")";

$rs=query($sql);

$tmp=array(0);

while($rows_relative=fetch($rs))

{

	$rows_relative["rewrite"]= getRewrite($rows_relative["name"],$rows_relative["id"],0,$cfg["rewrite"]);

	$rows_relative["realpic"]=getImageURL($rows_relative["pic"],1,"uploadImage/",$urltype);

	$rows_relative["price2"]=$rows_relative["price2"] * $rate * $discount;

	//$rows["bigpic"]=getImageURL($rows["pic"],2,"uploadImage/",$urltype);

	$rows_relative["price"]= $rows_relative["price1"] * $discount * $rate;

	r2n( $rows_relative["price"] );

	$var["rs_relative"][]=$rows_relative;

}





$var["p"]=$rows;



//前后产品

$pclassid=$rows["classid"];

$sql="select * from @@@product where id>$pid and classid=$pclassid and state>=0 order by id asc limit 1";

$pnrs=query($sql);

if( BOF($pnrs) )

{

	$var["prev"]="javascript:alert('Has no');";

}

else

{

    $pnrows=fetch($pnrs);

	$var["prev"]= getRewrite($pnrows["name"],$pnrows["id"],0,$cfg["rewrite"]);

}

free($pnrs);

$sql="select * from @@@product where id<$pid and classid=$pclassid and state>=0 order by id desc limit 1";

$pnrs=query($sql);

if( BOF($pnrs) )

{

	$var["next"]="javascript:alert('Has no');";

}

else

{

    $pnrows=fetch($pnrs);

	$var["next"]= getRewrite($pnrows["name"],$pnrows["id"],0,$cfg["rewrite"]);

}

free($pnrs);



$var["listing"]=  getRewrite($class[$pclassid]["name"],$pclassid,3,$cfg["rewrite"]);



$sql="select id from @@@product where classid=$pclassid and state>=0 order by id desc";

$rs=query($sql);

$ptotal=mysql_num_rows($rs);

$pindex=0;

while($rows=fetch($rs))

{

   $pindex++;

   if($rows["id"]==$pid)

   break;

}

free($rs);

$var["pindex"]=$pindex;

$var["ptotal"]=$ptotal;





//-------加载评论。。。

$sql="select * from @@@message where cid=1 and state>0 and pid=$pid order by id desc limit 5";

$rs=query($sql);

while($srows=fetch($rs))

{

	$srows["content"]=nl2br($srows["content"]);

	$srows["addtime"] = date("M j,Y",strtotime($srows["addtime"]));

	$var["rs_comment"][]=$srows;

}

free($rs);



//extendsUnlim($class,$classid,$proot,$class_html);

//$var["class_html"]=$class_html;



$var['rating'] = getRating($pid);



function getRating($pid = 0){

	$ratNum = fetchValue("select count(*) as v from @@@message where cid=1 and state>0 and pid=$pid" , "0");

	$ratSum = fetchValue("select sum(rating) as v from @@@message where cid=1 and state>0 and pid=$pid" , "0");

	$arr[0] = sprintf("%.1f", $ratSum/$ratNum);

	$arr[6] = round($arr[0]);

	$arr[7] = fetchValue("select count(*) as v from @@@message where cid=1 and state>0 and pid=$pid" , "0");

	$arr[1] = fetchValue("select count(*) as v from @@@message where cid=1 and state>0 and pid=$pid and rating = 1" , "0");

	$arr[2] = fetchValue("select count(*) as v from @@@message where cid=1 and state>0 and pid=$pid and rating = 2" , "0");

	$arr[3] = fetchValue("select count(*) as v from @@@message where cid=1 and state>0 and pid=$pid and rating = 3" , "0");

	$arr[4] = fetchValue("select count(*) as v from @@@message where cid=1 and state>0 and pid=$pid and rating = 4" , "0");

	$arr[5] = fetchValue("select count(*) as v from @@@message where cid=1 and state>0 and pid=$pid and rating = 5" , "0");

	

	return $arr;

}





require("uio_bomdata.php");

?>