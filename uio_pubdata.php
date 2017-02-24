<?

ob_start();

header('Content-Type: text/html; charset=utf-8');



//--------- 屏蔽图片域名直接访问网站。

if("http://".$_SERVER['SERVER_NAME']==$config[61])

{

	die("<h1>Bad Request (Invalid Hostname)</h1>");	

}

$web=$config[23];



$var["kfcode"]=$config[303];

$var["tjcode"]=$config[304];

$var["isnotice"]=$config[307];

if($var["isnotice"]==1)

{

	$var["webnotice_title"]=fetchValue("select name as v from @@@infoclass where id=105","Notice");

}

//------ 读取 模板语言

$template_language = dataDefault($config[89],"english");

require("inc/language-pack/{$template_language}.php");



//   seo 默认标题

$config[63] = str_replace("{VAR_domain}",$_SERVER['SERVER_NAME'],$config[63]);

$var["title"]=$config[63];

$var["keywords"]="";

$var["descript"]="";



$var["config"]=$config;

$var["cfg"]=$cfg;



$arr_syscontent = array();  // 用来保存 订单备注的数组。



$skin=datadefault($config[30],"default");

$info=array();

//debug($_SERVER['REQUEST_METHOD']);



if($_COOKIE[ WEBID ."_SKIN"]!="")

{

	$skin = $_COOKIE[ WEBID. "_SKIN" ] ;

}

define("SKIN",$skin);

//define("FOLDER",$cfg["folder"] ) ;

$var["statscript"] = array();



$var["folder"] = FOLDER ;

$cfg["rewrite"] = $config[38] ;

$var["rewrite"] = $config[38] ;

$var["isRewrite"] =  $config[38] ;

$var["hostname"] = $_SERVER['SERVER_NAME'];

$var["refererURL"] = $_SERVER['HTTP_REFERER'];



define("WEBID" , $cfg["webname"]);

define("REWRITE",$cfg["rewrite"] ) ;

define("LONGURL",$config[50]);

define("LAZY",$config[51] );

$var["lazy"] = LAZY ;







//----读取货币相关信息--------------

$coinIndex=0;

$coinIndex=dataDefault($_COOKIE[ WEBID . "_coinIndex" ],$config[162]);



$rate = getCoin($config,$coinIndex) ;

r2n($rate);

$coin = getCoinChar($config,$coinIndex);

$var["coin"] = $coin;  // 网站页面货币符号

$var["coin_title"] = $config[150 + $coinIndex]; // 货币文本

$var["interface_coin"] = $config[250 + $coinIndex];

$interface_coin = $var["interface_coin"]  ;

$coin_title = $var["coin_title"] ;

$var["rate"] = $rate ;

$var["coinIndex"] = $coinIndex;

$var["coinpic"] = $config[64] . "/pic/country/".$config[230 + $coinIndex].".gif" ;



for($index=0;$index<=9;$index++)

{

	if( $config[150 + $index]=="" )

		break;

	$rows = array();

	$rows["pic"] = $config[64] . "/pic/country/".$config[230 + $index].".gif" ;

	$rows["title"] = $config[150 + $index] ;

	$rows["href"] = FOLDER . "index.php?action=change_coin&index=" . $index ;

	$rows["index"] = $index ;

	$var["rs_coin"][] = $rows ;

}



//---处理函数

$action=getQuery("action");

switch($action)

{

	case "add_message_save":

		add_message_save();

		break;

	case "change_coin":

		change_coin();

		break;

	case "add_newsletter":

		add_newsletter();

		break;

	case "change_skin":

		change_skin();

		break;

	case "login":

		login();

		break;

	case "logout":

		logout();

		break;

	case "register_save":

		register_save();

		break;

	case "cn_login":

		cn_login();

		break;

}

//--获取缓存。。。。

$app=new application();

$app->CACHE_TIME=$cfg["cache_time"];

$app->load();

//--判断是否需要中文，或者 IP 验证-----

$cnlogin=$_COOKIE[WEBID . "_CNLOGIN"];

$cnpwd=$_COOKIE[WEBID . "_CNPWD"];

$check_ok="ok";

$arr_page_redirect = array( "", "cnlogin.php" , "close.php" , $config[60]);

$authPage = $arr_page_redirect[ $config[7] ] ;





if( $cnlogin!=$config[8] && $cnpwd!=$config[9] )

{

	$check_ok="";

}



if( $_SESSION["admin"]!=""  )

{

	$check_ok="ok";

	setcookie( WEBID . "_CNLOGIN", $config[8] );

	setcookie( WEBID . "_CNPWD", $config[9] );

}



if( $config[3]=="1" && $check_ok!="ok" )

{

	goPage( $authPage );

}

$browserlang=strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']);

$langcount=preg_match("/zh-cn/i",$browserlang);

if( $config[5]=="1" && $langcount==1 && $check_ok!="ok" )

{

	goPage( $authPage );

}



if( $config[55]=="1" && ( $_SERVER['HTTP_X_FORWARDED_FOR']!="" || $_SERVER['HTTP_VIA']!="" ) && $check_ok!="ok" )

{

	goPage( $authPage );

}



if( $config[44]=="1" &&  $check_ok!="ok" )

{

	$myip =  sprintf("%u",ip2long( getIP() ) ); 

	if( fetchCount("ip","where startip<=$myip and endip>=$myip")>=1 )

	{

		goPage( $authPage );

	}

}



if( $config[6]=="1" &&  $check_ok!="ok")

{

	$var["cnlogin_script"] = "<script language='javascript' type='text/javascript' src='".$config[64]."/cgi-bin/?do=jquery&code=".$config[67]."&page=" . urlencode( $authPage ) . "'></script>";

}



//跳转到页面



//------读广告图片

$sql="select * from @@@ad";

$rs=query($sql);

$arrlist = split(';',SERVER) ;

while( $rows = fetch($rs) )

{

	$rows["pic"]=split( $cfg["split"] , $rows["pic"] );

	$rows["url"]=split( $cfg["split"] , $rows["url"] );

	$rows["title"]=split( $cfg["split"] , $rows["title"] );

	$rows["url"]=array_filter($rows["url"]);

	$rows["pic"]=array_filter($rows["pic"]);

	for($index=0;$index<count($rows["pic"]);$index++)

	{

		//$rows["pic"][$index] = "http://" . $arrlist[0] . FOLDER . "systemImage/" . $rows["pic"][$index] ;

		$rows["pic"][$index] = getImageURL($rows["pic"][$index],-1,"systemImage/",2);

	}

	$rows["treepic"] = join( '|' , $rows["pic"] );

	$rows["treeurl"] = join( '|' , $rows["url"] );

	$var["rs_ad"][ $rows["id"] ] = $rows;

}

free($rs);

//-----读取后台配置的联系方式--------------------------

$var["msn"] = split (';' , $config[13] );

$var["skype"] = split (';' , $config[15] );

$var["yahoo"] = split (';' , $config[16] );

$var["email"] = split (';' , $config[12] );

$var["paypal"] = split (';' , $config[18] );

$var["qq"] = split (';' , $config[14] );

$var["fax"] = split (';' , $config[11] );

$var["tel"] = split (';' , $config[10] );

$imgserver = split (';' , $config[56] );







//-----获取游客或者会员相关信息

$userid=-1;

$userlevel=0;

$username="Guest";

$user=array();

$user["name"] = "Guest" ; 

$user["id"] = -1 ;

if( $_SESSION["username"]!="" && $_SESSION["userpwd"]!="" )

{

	$name=filterSQL($_SESSION["username"]);

	$pwd=filterSQL($_SESSION["userpwd"]);

	$sql="select * from @@@user where name like '$name' and pwd like '$pwd'";

	$rs=query($sql);

	if( mysql_num_rows($rs)!=0 )

	{

		$user=fetch($rs);

		$userid=$user["id"];

		$userlevel=$user["level"];

		$username=$user["name"];

		

	}

	else

	{

		$_SESSION["userpwd"]="";

		$_SESSION["username"]="";

	}

	mysql_free_result($rs);

}

else

{

	$_SESSION["userpwd"]="";

	$_SESSION["username"]="";

}

$discount = getDiscount($config,$userlevel)/100;

$var["discount"] = $discount ; 

$var["userid"] = $userid;

$var["username"] = $username;

$var["user"] = $user;



if($userlevel>=1 && $discount!=1)

{

	$arr_syscontent[] = "会员等级: ". $config[110+$userlevel] .",折扣： " . ($discount*10) . " 折"	;

}

if(getQuery("action")=="coupon")

	use_coupon();

//-----读取友情链接

/*

$sql="select * from @@@link";

$rs=query($sql);

while($rows=fetch($rs))

{

	$rs_l[]=$rows;

}

free($rs);

$var["rs_l"]=$rs_l;

*/

//----读取品牌分类

/*

$sql="select name,id,pic from @@@brandclass where level=1";

$rs=query($sql);

while($rows=fetch($rs))

{

	$rs_b[]=$rows;

}

free($rs);

$var["rs_b"]=$rs_b;

*/

//---------读取无限极分类

$u1=new unlimClass("@@@productclass");

$proot=$u1->create("产品分类");

$var["proot"]=$proot;





$u2=new unlimClass("@@@newsclass");

$nroot=$u2->create("新闻分类");

$var["nroot"]=$nroot;

/*

$u3=new unlimClass("@@@downclass");

$droot=$u3->create("下载分类");

$var["droot"]=$droot;

*/

if($app->get("class"))

{

	$class = $app->data["class"] ;

}

else

{

	$class=fetchAllClass("@@@productclass",",css");

	fetchTreeNum($proot,$class,"product");

	$app->data["class"] = $class ;

	//debug($class);

}





if($app->get("nclass"))

{

	$nclass = $app->data["nclass"] ;

}

else

{

	$nclass=fetchAllClass("@@@newsclass");

	$app->data["nclass"] = $nclass ;

}

/*

$nclass=fetchAllClass("@@@newsclass");

$dclass=fetchAllClass("@@@downclass");

$class_html="";

$nclass_html="";

$dclass_html="";

*/

$classid=getRequestInt("classid",proot);

$dclassid=getRequestInt("dclassid",droot);

$nclassid=getRequestInt("nclassid",nroot);





//---------购物车读取



if( $userid>0 )

{

	$sc = new shopCartDatabase($userid);

	$sc->fetch();

}	

else

{

	$sc=new shopCartCookie(WEBID,"sc"); 

	$sc->fetch();

}

$sc_h=new History(WEBID,"history");

switch($action)

{

	case "add":

		$id=getRequestInt("id");

		$sql="select ctype,cvalue,cprice,minnum,name from @@@product where id=$id";

		$rs=query($sql);

		if( mysql_num_rows($rs)>0 )

		{

			$rows = fetch( $rs );

			if(getForm("paddtocart")=="")

			{

				if( $rows["minnum"]>=1 && getRequestInt("num",1) < $rows["minnum"] )

				{

					echo "<script>_close_divShoppingcart()</script>";

					//alertRedirect("Sorry ,The minimum order quantity of " . $rows["name"] . " is " . $rows["minnum"] , $_SERVER['HTTP_REFERER'],getQuery("alert"));

					$cfg["lg"]["msg_cart_minimum"] = str_replace("{0}",$rows["name"],$cfg["lg"]["msg_cart_minimum"]);

					$cfg["lg"]["msg_cart_minimum"] = str_replace("{1}",$rows["minnum"],$cfg["lg"]["msg_cart_minimum"]);

					alertRedirect($cfg["lg"]["msg_cart_minimum"], $_SERVER['HTTP_REFERER'],getQuery("alert"));

				}

				$arr=split( $cfg["split"] , $rows["ctype"] );

				$arrcprice = split( $cfg["split"] , $rows["cprice"] );

				$arrvalue = split( $cfg["split"] , $rows["cvalue"] );

				removeSplitEmpty($arr);

				$arrstyle=array();

				$totaladd = 0 ;

				//debug(3);

				for($index=0;$index<count($arr);$index++)

				{

					$arrstyle[$index]= getForm("key$index") . ":" . getFormStr("style$index","","") ;

				}

				$sc->add($id,getRequestInt("num",1), datadefault(join("^",$arrstyle)," " ) , "" , $totaladd );

				$sc->save();

			}

			else

			{

				$ordernum = 0 ;

				for($index=0;$index<20;$index++)

				{

					if( getForm("property$index")!="" )

						$ordernum+=getRequestInt("num$index",1);

				}

				if( $rows["minnum"]>=1 && $ordernum < $rows["minnum"] )

				{

					$cfg["lg"]["msg_cart_minimum"] = str_replace("{0}",$rows["name"],$cfg["lg"]["msg_cart_minimum"]);

					$cfg["lg"]["msg_cart_minimum"] = str_replace("{1}",$rows["minnum"],$cfg["lg"]["msg_cart_minimum"]);

					alertRedirect($cfg["lg"]["msg_cart_minimum"], $_SERVER['HTTP_REFERER'],getQuery("alert"));

				}

				for($index=0;$index<20;$index++)

				{

					if( getForm("property$index")!="" )

					{

						$style=getForm("key0") . ":" . getForm("property$index") ;

						$num=getRequestInt("num$index",1) ; 

						$sc->add($id , $num , $style , "" , 0);

					}

				}

				$sc->save();

			}

		}

		break;

	case "delete":

		$sc->delete( $sc->indexID(getRequestInt("index",-1)) );

		$sc->save();

		break;

	case "add_favorite":

		if($userid==-1)

			AlertRedirect("Please Login",$_SERVER['HTTP_REFERER']);

		$pid = getRequestInt("pid",0);

		$sql="select pic,name,id,itemno from @@@product where id=$pid";

		$rs=query($sql);

		if(!BOF($rs))

		{

			$num = fetchCount("@@@favorite","where pid=$pid and userid=$userid") ;

			if($num!=0)

				AlertRedirect($cfg["lg"]["msg_favorites_exist"],FOLDER."profile.php?action=favorite_list");

			$rows=fetch($rs);

			$param=array();

			$param["pid"]= $rows["id"] ;

			$param["pname"]= $rows["name"] ;

			$param["ppic"]= $rows["pic"];

			$param["pitemno"]= $rows["itemno"];

			$param["userid"]= $userid;

			$param["addtime"]= formatDateTime(time());

			$sql=insertSQL($param,"@@@favorite");

			query($sql);

			AlertRedirect($cfg["lg"]["msg_addfavorites_success"],FOLDER."profile.php?action=favorite_list");

		}

		else

		{

			redirect(FOLDER."error.php?id=1");

		}

		break;

	case "clean":

		$sc->clean();

		$sc->save();

		break;

	case "edit":

		

		for($index=0;$index<$sc->length;$index++)

		{

			$sc->edit( $sc->indexID($index) , getRequestInt("num$index",1) , getFormSafe("content$index") );

		}

		

		for($index=0;$index<$sc->length;$index++)

		{

			$ordernum = $sc->getIDnum( $sc->pid[$index] ) ;
            
			$sql="select ctype,minnum,name from @@@product where id=" . $sc->pid[$index] ;

			$rs=query($sql);

			if( BOF($rs) )

				redirect(FOLDER."error.php?id=1");

			$rows = fetch( $rs );

			if( $rows["minnum"]>=1 && $ordernum < $rows["minnum"] )

			{

					$cfg["lg"]["msg_cart_minimum"] = str_replace("{0}",$rows["name"],$cfg["lg"]["msg_cart_minimum"]);

					$cfg["lg"]["msg_cart_minimum"] = str_replace("{1}",$rows["minnum"],$cfg["lg"]["msg_cart_minimum"]);

				alertRedirect($cfg["lg"]["msg_cart_minimum"] , FOLDER . "shopcart.php",getQuery("alert"));

			}

			

			free($rs);

		}

		$sc->save();

		if( getForm("gonextpage")!="" )

			goPage(FOLDER."step.php");

		break;

}

$totalprice=0;

$totalweight = 0;

$totalnum = 0;

$shippingnum = 0;

$shippingweight = 0 ;

$var["totalnum"] = 0;

$var["totalweight"] = 0 ;



$sc->fetch();

for($index=0;$index<$sc->length;$index++)

{

	$id=$sc->pid[$index];

	$sql="select * from @@@product where id=$id";

	$rs=query($sql);

	if( mysql_num_rows($rs)>0 )

	{

		$rows = fetch( $rs );

		$oneprice = getPrice((int)$sc->getIDnum($sc->pid[$index]),$rows["price1"],$rows["pnum"],$rows["pprice"],$rows["lastprice"],$cfg) * $rate * $discount;

		

		$arrctype=split( $cfg["split"] , $rows["ctype"] );

		$arrcprice = split( $cfg["split"] , $rows["cprice"] );

		$arrcvalue = split( $cfg["split"] , $rows["cvalue"] );

		$arrcartstyle = explode( '^' , $sc->pstyle[$index] ) ;

		//debug($sc->pstyle[$index]);

		removeSplitEmpty($arrctype);

		$totaladd = 0;

		$arrstyle = array() ;

		for($indexj=0;$indexj<count($arrctype);$indexj++)

		{

			$extendpricestr = "";

			$tmpstyle = split( ':', $arrcartstyle[$indexj] );

			$tmpprice = split( ',', $arrcprice[$indexj] );

			$tmpvalue = split( ',', $arrcvalue[$indexj] );

			$arrstyle[$indexj]= $tmpstyle[0] . ":" . $tmpstyle[1];

			if( $arrctype[$indexj]==8 && $tmpstyle[1]!="" )

			{

				$indexFind = array_search( $tmpstyle[1] , $tmpvalue );

				$indexPrice =  $tmpprice[ $indexFind ] ;

				$totaladd = $totaladd + $indexPrice;

				$extendpricestr = " +<span class='red'>$coin" . $indexPrice ."</span>";

				$arrstyle[$indexj]= $tmpstyle[0] . ":" . $tmpstyle[1] . $extendpricestr;

			}

			if( $arrctype[$indexj]==9 && $tmpstyle[1]!="" )

			{

				$arrcheckbox = split( ',', $tmpstyle[1] ) ;

				$arrincart = array() ;

				for($indexk=0;$indexk<count($arrcheckbox);$indexk++)

				{

					//debug($arrcheckbox);

					//$indexFind = array_search( $arrcheckbox[$indexk] , $tmpvalue );

					//2012.2.10 更新，jp

					$teampcheckarr=split("_",$arrcheckbox[$indexk]);

					$indexFind = array_search( $teampcheckarr[0] , $tmpvalue );

					

					$indexPrice =  $tmpprice[ $indexFind ] ;

					$arrincart[$indexk] =  $arrcheckbox[$indexk] . " +<span class='red'>$coin" . $indexPrice ."</span>";

					$totaladd = $totaladd + $indexPrice;

				}

				$arrstyle[$indexj]= $tmpstyle[0] . ":" . join( '<br />' , $arrincart );

			}

		}

		$oneprice += $totaladd * $rate * $discount ;

		r2n( $oneprice );

		$itemprice = (int)$sc->pnum[$index] * $oneprice ;

		$itemweight = (int)$sc->pnum[$index] * $rows["weight"] ;



		$sc_rows = array();

		$sc_rows["id"]=$rows["id"];

		$sc_rows["name"]=$rows["name"];

		$sc_rows["weight"]=$rows["weight"];

		$sc_rows["itemno"]=$rows["itemno"];

		$sc_rows["pic"]=$rows["pic"];

		$sc_rows["itemprice"]=$itemprice;

		$sc_rows["itemweight"]=$itemweight;

		$sc_rows["rewrite"]=  getRewrite($rows["name"],$rows["id"],0,$cfg["rewrite"]);

		$sc_rows["realpic"]= $config[61] . getImageURL($rows["pic"],3,"uploadImage/",$urltype);

		$sc_rows["price"]=$oneprice;

		$sc_rows["pstyle"]= join( '<br />' , $arrstyle ) ;

		//$rows["pstyle"]=$sc->pstyle[$index];

		$sc_rows["pcontent"]=$sc->pcontent[$index];

		$sc_rows["pnum"]=$sc->pnum[$index];

		$totalnum += $sc->pnum[$index] ;

		$totalprice += $itemprice;

		$totalweight += $itemweight ;

		if( $rows["freeshipping"]==0 )

		{

			$shippingnum += $sc->pnum[$index] ;

			$shippingweight += $itemweight ;

		}

		$var["rs_sc"][]=$sc_rows;

	}

	free($rs);

	

}

$rs_sc=$var["rs_sc"];

$var["totalprice"]=$totalprice;

$var["totalnum"]=$totalnum;

$var["totalweight"]=$totalweight;

$var["items"]=$sc->length;

//------------初始化 运费 优惠 

$var["sub1"] = 0 ;

$var["sub3"] = 0 ;

$var["sub4"] = 0 ;

if( $totalprice <= $config[47] * $rate && $config[47]>0 )

{

	$var["sub3"] = $config[46] * $rate ;

	$arr_syscontent[] = "订单附加：价格<= " . $config[90] . $config[47] . " , 附加金额： " . $config[90] . $config[46];

}

for($i=9;$i>=0;$i--)

{

	if($totalprice>=$config[180+$i] * $rate && $config[180+$i]!="" && $config[200+$i]!="")

	{

		$var["sub4"] -= $totalprice*(100-$config[200+$i])/100 ;

		$arr_syscontent[] = "批发打折：价格({$config[90]})在[".$config[180+$i].",".dataDefault($config[180+$i+1],"max")."]之间 , 折扣: " . ($config[200+$i]/100) . "折";

		//print_r($var["sub4"]);

		break; 

	}

}

r2n( $var["sub3"] );

r2n( $var["sub4"] );



//------------

$items = $var["items"];

if( $uio_page == "product_view")

{

	$sc_h->add(getQueryInt("id",0));

	$sc_h->save();

	//debug(3);

}

for($index=0;$index< min($sc_h->length,10);$index++)

{

	$id=$sc_h->pid[$index];

	$sql="select price1,price2,name,id,pnum,pprice,pic,lastprice,classid from @@@product where id=$id";

	$rs=query($sql);

	if(  !BOF($rs) )

	{

		$rows = fetch( $rs );

		$rows["rewrite"]= getRewrite($rows["name"],$rows["id"],0,$cfg["rewrite"]);

		$rows["realpic"]= $config[61] . getImageURL($rows["pic"],1,"uploadImage/",$urltype);

		//$rows["bigpic"]= $config[61] . getImageURL($rows["pic"],4,"uploadImage/",$urltype);

		$rows["price"]=getPrice(1,$rows["price1"],$rows["pnum"],$rows["pprice"],$rows["lastprice"],$cfg) * $discount * $rate;

		r2n( $rows["price"] );

		$var["rs_h"][]=$rows;

	}

	free($rs);

}



//-------读取$disp相关产品信息

/*

$disp=1;

if($app->get("p_disp_$disp"))

	$sql="select * from @@@product where id in (" . dataDefault($app->data["p_disp_$disp"],0) . ")  order by id desc limit " . $config[85] ;

else

{

	$sql="select * from @@@product where disp & $disp = $disp and stock>=0  order by id desc  limit " . $config[85];

}

$rs=query($sql);

$tmp=array(0);

while($rows=fetch($rs))

{

	$rows["rewrite"]=getRewrite($rows["name"],$rows["id"],0,$cfg["rewrite"]);

	$rows["realpic"]=$config[61] . getImageURL($rows["pic"],1,"uploadImage/",$urltype);

	$rows["price"]=getPrice(1,$rows["price1"],$rows["pnum"],$rows["pprice"],$rows["lastprice"],$cfg) * $discount * $rate;

	$tmp[]=$rows["id"];

	r2n( $rows["price"] );

	$var["rs_p1"][]=$rows;

}

free($rs);

$app->data["p_disp_$disp"]=join(',',$tmp);



*/





/*

$sql = "select post_title,post_name,guid from wp_posts where post_type = 'post' and post_status='publish' order by id desc limit 0,6" ;

$rs  =query($sql);

while($rows = mysql_fetch_array($rs))

{

	$rows['name'] = $rows['post_title'];

	$rows['rewrite'] = $rows['guid'] ;

	$var["rs_blog"][]=	$rows;	

}

*/



$rs=query("select * from @@@news  order by id desc limit 6"); 

while($rows=fetch($rs))

{

	$rows["addtime"]=formatDate( strtotime( $rows["addtime"] ) );

	$rows["rewrite"]= getRewrite($rows["name"],$rows["id"],1,$cfg["rewrite"]);

	$var["rs_n_1"][]=$rows;

}

free($rs);

$rs=query("select * from @@@link  order by id desc"); 

while($rows=fetch($rs))

{

	$rows["realpic"]=$config[61] . getImageURL($rows["pic"],8,"systemImage/",$urltype);

	$var["rs_link"][]=$rows;

}

free($rs);





$var["rs_p_4"] = getDispProduct(4,$config[85],1) ;

//--------读取信息内容标题



$var["rs_top"] = getInfoList(6);

$var["rs_top_2"] = getInfoList(212);

$var["rs_bom"] = getInfoList(178);

//--------读取底部内容

$sql="select son from @@@infoclass where id=161";

$rows=fetch(query($sql));

$sql = "select name,id,son from @@@infoclass where id in (" . $rows["son"] . ") order by sort asc" ; 

$rs = query($sql);

while($rows=fetch($rs))

{

	$sqls="select son from @@@infoclass where id=" . $rows["id"];

	$temprows=fetch(query($sqls));

	$sql = "select name,id,son,left(content,500) as content from @@@infoclass where id in (" . $temprows["son"] . ") order by sort asc" ; 

	$srs = query($sql);

	while($temprows=fetch($srs))

	{

		if( strpos($temprows["content"],"{#url}")===false )

			$temprows["url"]=  getRewrite($temprows["name"],$temprows["id"],2,$cfg["rewrite"]) ;

		else

		{

			if( strpos($temprows["content"],"{#url}http")===true )

				$temprows["url"]=  str_replace("{#url}","",$temprows["content"]);

			else

				$temprows["url"]= str_replace("{#url}","",$temprows["content"]);

		}

		$rows["arrson"][]=$temprows;

	}

	free($srs);

	$var["rs_help"][] = $rows;

	

}





if( !$app->get2('allclassselect') )

{

	get_class_html($proot,$class,$allclassselect,false);

	$app->bigdata['allclassselect'] = $allclassselect ;

}

else

	$allclassselect = $app->bigdata['allclassselect'] ;

$var["allclassselect"]=$allclassselect;





if( !$app->get2('countryhtml') )

{

	$var["countryhtml"] = getCountryHTML();

 	$app->bigdata['countryhtml'] = $var["countryhtml"];

}

else

	$var["countryhtml"] = $app->bigdata['countryhtml'] ;



$rs=query("select id,content from @@@infoclass where father=9"); 

while($rows=fetch($rs))

{

	$var["content_".$rows["id"]] = $rows["content"] ;

}

free($rs);



//--------生成分类的HTML 其中包括DIV,UL,LI。。。

/*if( !$app->get2('pclass') )

{

	showUnlimHeng($class,$proot,$proot,3,$class_html,0,$cfg["rewrite"]);

	$app->bigdata['pclass'] = $class_html ;

}

else

	$class_html = $app->bigdata['pclass'] ;*/



$arr_tem=explode(",",$class[$classid]["url"]);

if(count($arr_tem)>1)

{

	$firstlevelid=$arr_tem[1];

}

else

{

	$firstlevelid=0;

}	

showUnlim($class,$proot,$proot,3,$class_html,0,$cfg["rewrite"],$class[$classid]["level"],$firstlevelid,$classid);

//showUnlim($nclass,$nroot,false,3,$nclass_html,1,$cfg["rewrite"]);

//showUnlim($dclass,$droot,false,3,$dclass_html,2,$cfg["rewrite"]);

//extendsUnlim($class,$classid,$proot,$class_html);

//extendsUnlim($nclass,$nclassid,$nroot,$nclass_html);

//extendsUnlim($dclass,$dclassid,$droot,$dclass_html);



$var["class_html"]=$class_html;

unset($class_html);

//$var["nclass_html"]=$nclass_html;

//$var["dclass_html"]=$dclass_html;



$arr_son=array_filter(split( ',' , $class[$proot]["son"] ),callback_empty);

for($index=0;$index<count($arr_son);$index++)

{

	$rows=array();

	$rows["id"]=$arr_son[$index];

	if( $class[$arr_son[$index]]["state"]==0 )

		continue;

	$rows["name"] = $class[$arr_son[$index]]["name"] ;

	$rows["rewrite"] =  getRewrite($class[$arr_son[$index]]["name"],$arr_son[$index],3,$cfg["rewrite"]);

	$arr_son2=array_filter(split( ',' , $class[$rows["id"]]["son"] ),callback_empty);

	for($indexj=0;$indexj<count($arr_son2);$indexj++)

	{

		if( $class[$arr_son2[$index]]["state"]==0 )

			continue;

		$rows2=array();

		$rows2["id"]=$arr_son2[$indexj];

		$rows2["name"] = $class[$arr_son2[$indexj]]["name"] ;

		$rows2["rewrite"] =  getRewrite($class[$arr_son2[$indexj]]["name"],$arr_son2[$indexj],3,$cfg["rewrite"]);

		$rows["arrson"][]=$rows2;

	}

	$var["rs_catetop"][]=$rows;

}



//---------生成SKIN列表



//$var["strskin"]=$strskin;

//---------初始化SMARTY



$smarty = new Smarty(); 

$smarty->template_dir = 'skin/' . SKIN . '/templates/'; 

$smarty->compile_dir = 'skin/'. SKIN .'/templates_c/'; 

$smarty->config_dir = 'skin/'. SKIN .'/configs/'; 

$smarty->cache_dir = 'skin/'. SKIN .'/cache/'; 

$smarty->caching = false;

$smarty->compile_check = $cfg["smarty"]["compile_check"];

$smarty->left_delimiter = $cfg["smarty"]["left_delimiter"];

$smarty->right_delimiter = $cfg["smarty"]["right_delimiter"];

?><?

function add_message_save()

{

	global $config;

	global $cfg;

	

	if( $config[43]!=""&&getQuery("front")!="front" )

	{

		if (getForm("code")!=$_SESSION["code"] || $_SESSION["code"]=="" || getForm("code")=="")

		{

			echo "<script> alert('{$cfg['lg']['msg_user_or_password_error']}') ;history.back(); </script>";

			exit();

		}

	}

	

	$param["name"]=getFormSafe("name");

	$param["userid"]=getFormInt("userid",-1);

	$param["rating"]=getFormInt("rating",1);

	$param["username"]=getFormSafe("username");

	$param["cid"]=getFormInt("cid",3);

	$param["pid"]=getFormInt("pid",0);

	$param["userread"]=1;

	$param["adminread"]=0;

	$param["state"]=0;

	$param["domain"] = $_SERVER['SERVER_NAME'];

	$param["ip"]=getIP();

	$param["addtime"]=formatDateTime(time());

	$param["content"]=getFormSafe("content");

	$param["pic"]=upload1();

	$param["pic1"]=upload2();

	$arrconfig=array();

	for($indexI=0;$indexI<10;$indexI++)

	{

		$arrconfig[$indexI]=getFormSafe("contact$indexI");

	}

	$param["contact"]=join( $cfg["split"] , $arrconfig ) ;

	$sql=insertSQL($param,"@@@message");

	query($sql);

	$messageid=mysql_insert_id();

	if( $config[133]!="" )

	{

		$vartmp = array();

		$vartmp["action"] = "email_feedback_admin";

		$vartmp["id"] = $messageid ;

		addToMailQueue($vartmp);

	}

	//----------- 加入最近发生

	

	alertRedirect("{$cfg['lg']['msg_add_message_success']}",$_SERVER['HTTP_REFERER']);

}







function change_coin() 

{

	global $web;

	setcookie( WEBID . "_coinIndex" , getQueryInt("index",0) ,0 );

		$redirectURL = getQueryDefault("page",$_SERVER['HTTP_REFERER']);

		goPage($redirectURL);

}



function logout()

{

	global $cfg;

	$_SESSION["username"]="";

	$_SESSION["userpwd"]="";

	alertRedirect($cfg['lg']['msg_user_logout'],FOLDER);

	

}



function login()

{

	global $config;

	global $cfg;

	if(  getFormSafe("name")=="" or getFormSafe("pwd")=="" )

		alertRedirect("{$cfg['lg']['msg_user_or_password_error']}","register.php");

	$name=filterSQL(getFormSafe("name"));

	$pwd=md5(md5(getFormSafe("pwd")));

	$sql="select * from @@@user where name='$name' and pwd='$pwd'";

	$rs=query($sql);

	if( mysql_num_rows($rs)!=0 )

	{

		$rows=fetch($rs);

		if($rows["state"]==0)

		{

			alertRedirect("{$cfg['lg']['msg_banned_landing']}","register.php");

		}

		$_SESSION["username"]=$rows["name"];

		$_SESSION["userpwd"]=$rows["pwd"];

		free($rs);

		$param=array();

		$param["ip"]=getIP();

		$param["lasttime"]=formatDateTime(time());

		$param["counts"]="@counts+1";

		$condition=" where id=" . $rows["id"];

		$sql=updateSQL($param,"@@@user",$condition);

		query($sql);

		

		$sc=new shopCartCookie(WEBID,"sc"); 

		$scuser = new shopCartDatabase($rows["id"]);

		for($index=0;$index<$sc->length;$index++)

		{

			$scuser->add( $sc->pid[$index] , $sc->pnum[$index] , $sc->pstyle[$index] , $sc->pcontent[$index] , 0);

		}

		$sc->clean();

		$sc->save();

		

		$redirectURL = getQueryDefault("redirectURL",FOLDER."profile.php");

		goPage($redirectURL);

	}

	else

		alertRedirect("{$cfg['lg']['msg_user_or_password_error']}",FOLDER."register.php");

}



function change_skin()

{

	global $web;

	if( getQuery("skin")!="" )

	{

		setcookie( WEBID . "_SKIN" , getQueryDefault("skin","default") , 0 );

		goPage(FOLDER);

	}

}



function cn_login()

{

	global $web;

	global $config;

	global $cfg;

	if($config[40]!="" && (getFormSafe("code")!=$_SESSION["code"] || $_SESSION["code"]=="" || getFormSafe("code")=="") )

	{

		echo "<script> alert('{$cfg['lg']['msg_code_error']}') ;history.back(); </script>";

		exit();

	}

	

	$name=getFormSafe("name");

	$pwd=getFormSafe("pwd");

	if(  $name=="" || $pwd=="" )

		redirect("cnlogin.php");

	if( $name==$config[8] && $pwd==$config[9] )

	{

		setcookie( WEBID . "_CNLOGIN",$name ,0);

		setcookie( WEBID . "_CNPWD",$pwd,0);

		goPage(FOLDER);

	}

	else

		AlertRedirect("{$cfg['lg']['msg_user_or_password_error']}",FOLDER."cnlogin.php");

}





function add_newsletter()

{



	global $cfg;

	if( getFormSafe("email")!="" && !ereg("/^[1-9A-Za-z_]+@[1-9A-Za-z_]+.[1-9A-Za-z_]$/",getFormSafe("email")))

	{

		$param=array();

		$param["name"] = getFormSafe("email");

		$param["ip"]=getIP();

		$param["domain"] = $_SERVER['SERVER_NAME'];

		$param["addtime"]=formatDateTime(time());

		$sql=insertSQL($param,"@@@newsletter");

		query($sql);

		alertRedirect("{$cfg['lg']['msg_newsletter_success']}",FOLDER);

	}

}



function register_save()

{

	global $cfg;

	global $config;

	global $items;

	global $coin;

	global $rate;

	if($config[41]!="" && (getFormSafe("code")!=$_SESSION["code"] || $_SESSION["code"]=="" || getFormSafe("code")=="") )

	{

		echo "<script> alert('{$cfg['lg']['msg_code_error']}') ;history.back(); </script>";

		exit();

	}

	

	$redirectURL = getQueryDefault("redirectURL",FOLDER."profile.php");

	

	$name = filterSQL( strtolower( getFormSafe("username") ) );

	if( strlen( $name ) <= 3)

	{

		echo "<script> alert('{$cfg['lg']['msg_Username_less']}') ;history.back(); </script>";

		exit();

	}

	$sql="select * from @@@user where name='$name'";

	$rs=query($sql);

	if(!BOF($rs))

	{

		echo "<script> alert('{$cfg['lg']['msg_member_exists']}') ;history.back(); </script>";

		exit();

	}

	mysql_free_result($rs);

	$param["name"]=getFormSafe("username");

	$pwd=md5(md5(getFormSafe("pwd")));

	$param["pwd"]=$pwd;

	$param["realpwd"]=getFormSafe("pwd");

	$param["state"]=getFormInt("state",1);

	$param["question"]=getFormSafe("question");

	$param["sex"]=getFormInt("sex",1);

	$param["answer"]=getFormSafe("answer");

	$param["firstname"]=getFormSafe("firstname");

	$param["lastname"]=getFormSafe("lastname");

	$param["server"]=getFormInt("server",5);

	$param["email"]=getFormSafe("email");

	$param["msn"]=getFormSafe("msn");

	$param["postcode"]=getFormSafe("postcode");

	$param["country"]=getFormSafe("country");

	$param["province"]=getFormSafe("province");

	$param["city"]=getFormSafe("city");

	$param["street"]=getFormSafe("street");

	$param["level"]=1;

	$param["domain"] = $_SERVER['SERVER_NAME'];

	$param["ip"]=getIP();

	$param["addtime"]=formatDateTime(time());

	$param["lasttime"]=formatDateTime(time());

	$content=array();

	for($indexI=0;$indexI<=49;$indexI++)

	{

		$content[$indexI]= getFormStr("content$indexI") ;

	}

	array_pad($content,50,"");

	$param["content"]=join( $cfg["split"] , $content ) ;

	$sql=insertSQL($param,"@@@user");

	query($sql);

	$userid=mysql_insert_id();

	if( getForm("address")!="")

	{

		$param=array();

		$arrconfig=array();

		$arrconfig[0] = getFormSafe("firstname") ;

		$arrconfig[1] = getFormSafe("street") ;

		$arrconfig[2] = getFormSafe("postcode") ;

		$arrconfig[3] = getFormSafe("city") ;

		$arrconfig[4] = getFormSafe("province") ;

		$arrconfig[5] = getFormSafe("country") ;

		$arrconfig[6] = getFormSafe("content3") ;

		$arrconfig[7] = getFormSafe("email") ;

		$arrconfig[8] = getFormSafe("lastname") ;

		$param["userid"] = $userid ;

		$param["content"]=join( $cfg["split"] , $arrconfig ) ;

		$sql=insertSQL($param,"@@@address");

		query($sql);

	}

	

	if( getFormSafe("newsletter")!="")

	{

		$param=array();

		$param["name"] = getFormSafe("username");

		$param["ip"]=getIP();

		$param["addtime"]=formatDateTime(time());

		$param["domain"] = $_SERVER['SERVER_NAME'];

		$sql=insertSQL($param,"@@@newsletter");

		query($sql);

	}

	$_SESSION["username"]=$name;

	$_SESSION["userpwd"]=$pwd;

	

	//  生成优惠码

	if( $config[290]!="" )

	{

		$param=array();

		$param["name"] = getOnlyCode();

		$str_code = $param["name"];

		$param["state"]= "1" ;

		$param["descript"]= "Registration automatically generated!" ;

		//$param["endtime"]= dataDefault($config[292],"@NULL") ;

		$param["endtime"]= dataDefault($config[292],7) ;

		$param["endtime"]=date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+$param["endtime"], date("Y")));

		$param["price"] = dataDefault($config[291],0) ;

		$param["userid"] = $userid ;

		if($useridf<0)

			$param["username"] = "所有人";

		else

			$param["username"] = getFormSafe("username");;

		$sql=insertSQL($param,"@@@coupon");

		$coupon_save_price = $param["price"] * $rate;

		r2n($coupon_save_price);

		$str_coupon_word = str_replace("{0}",$str_code,$cfg["lg"]["msg_coupon_register"]);

		$str_coupon_word = str_replace("{1}",$coin . " " . $coupon_save_price,$str_coupon_word);

		query($sql);

	}

	

		$sc=new shopCartCookie(WEBID,"sc"); 

		$scuser = new shopCartDatabase($userid);

		for($index=0;$index<$sc->length;$index++)

		{

			$scuser->add( $sc->pid[$index] , $sc->pnum[$index] , $sc->pstyle[$index] , $sc->pcontent[$index] , 0);

		}

		$sc->clean();

		$sc->save();

		

		if( $config[130]!="" )

		{

			$vartmp = array();

			$vartmp["action"] = "email_register_admin";

			$vartmp["id"] = $userid ;

			addToMailQueue($vartmp);

		}

		if( $config[140]!="" )

		{

			$vartmp = array();

			$vartmp["action"] = "email_register_user";

			$vartmp["id"] = $userid ;

			addToMailQueue($vartmp);

		}

	//----------- 加入最近发生

	

	alertRedirect("{$cfg['lg']['msg_registered_success_tips']}{$str_coupon_word}",$redirectURL);

} 



function use_coupon()

{

	global $cfg ;

	global $userid;

	global $rate;

	echo "<script>";

	$coupon_code = filterSQL(getRequest("coupon_code"));

	$sql = "select * from @@@coupon where name like '$coupon_code'";

	$rs = query($sql);

	if(!BOF($rs))

	{

		$rows = fetch($rs);

		if($rows["state"]==1)

		{

			if($rows["userid"]==0 && $userid<0)

				echo "alert('".str_replace("{0}",$coupon_code,$cfg["lg"]["msg_coupon_block"])."')";	

			else if($rows["userid"]>0 && $userid!=$rows["userid"])

			{

				echo "alert('".str_replace("{0}",$coupon_code,$cfg["lg"]["msg_coupon_block"])."')";	

			}

			else

			{

				$endtime = strtotime($rows["endtime"]);

				if($endtime>0 && time()>=$endtime)

					echo "alert('".str_replace("{0}",$coupon_code,$cfg["lg"]["msg_coupon_expired"])."')";	

				else

					echo "setCouponPrice(".$rows["price"]*$rate.")";

			}

		}

		else

		{

			echo "alert('".str_replace("{0}",$coupon_code,$cfg["lg"]["msg_coupon_block"])."')";	

		}

	}

	else

	{

		echo "alert('".str_replace("{0}",$coupon_code,$cfg["lg"]["msg_coupon_error"])."')";	

	}

	echo "</script>";

	die();

}

//debug();

function upload1($flash=0)

{

	global $cfg;

	$path_parts = pathinfo($_FILES['pic']['name']);

	$path_name_array = split("\." , $path_parts["basename"] ) ;

	$path_name_array_name = $path_name_array[0];

	$newname=getRandomname() . "." . $path_parts["extension"] ;

	$folder = getFormDefault("folder", strftime("%Y-%m-%d",time()). "/" )  ;

	if( substr($folder, -1)!="/" )

		   $folder .= "/";

	$formname = getForm("FormName");

	$editname = getForm("EditName");

	$store_dir = getFormDefault("filepath","Attachment/") . $folder ;

	//debug($path_parts);

	$upload_imageType=array("jpg","jpeg");

	$upload_maxsize=2;

	if( ! in_array( strtolower($path_parts["extension"]) , $upload_imageType) )

	{

		//echo strtolower($path_parts["extension"]);

		//echo "文件格式错误1";

		return ;

	}

	$filesize=$_FILES["pic"]["size"];

	$upload_file = $_FILES['pic']['tmp_name'];

	if($filesize ==0)

	{

		//echo "没有选择文件";

		return ;

	}

	if (is_array($_FILES)) 

	{

		foreach($_FILES AS $name => $value)

		{

			${$name} = $value['tmp_name'];

			$fp = @fopen(${$name},'r');

			$fstr = @fread($fp,filesize(${$name}));

			@fclose($fp);

			if($fstr!='' && (ereg("<\?",$fstr) || ereg("<\%",$fstr) ) )

			{

				 //echo "文件格式错误";

				 return ;

			}

		}

	}

	

	if($filesize >= $upload_maxsize * 1024 * 1024 )

	{

	    //echo "文件过大";

		return ;

	}

	if( !file_exists($store_dir) )

	{

		makedir($store_dir);

	}

	//debug($store_dir.$newname);

	if (!move_uploaded_file($upload_file,$store_dir.$newname)) 

	{

		//echo "复制文件失败";

		return ;

	}

	$dir = strtolower( getFormDefault("filepath","Attachment/") );

	

	return $folder . $newname;

	

	//Msg("$tmp 成功上传",$flash);

}

function upload2($flash=0)

{

	global $cfg;

	$path_parts = pathinfo($_FILES['pic1']['name']);

	$path_name_array = split("\." , $path_parts["basename"] ) ;

	$path_name_array_name = $path_name_array[0];

	$newname=getRandomname() . "." . $path_parts["extension"] ;

	$folder = getFormDefault("folder", strftime("%Y-%m-%d",time()). "/" )  ;

	if( substr($folder, -1)!="/" )

		   $folder .= "/";

	$formname = getForm("FormName");

	$editname = getForm("EditName");

	$store_dir = getFormDefault("filepath","Attachment/") . $folder ;

	//debug($path_parts);

	$upload_imageType=array("jpg","jpeg");

	$upload_maxsize=2;

	if( ! in_array( strtolower($path_parts["extension"]) , $upload_imageType) )

	{

		//echo strtolower($path_parts["extension"]);

		//echo "文件格式错误1";

		return ;

	}

	$filesize=$_FILES["pic1"]["size"];

	$upload_file = $_FILES['pic1']['tmp_name'];

	if($filesize ==0)

	{

		//echo "没有选择文件";

		return ;

	}

	if (is_array($_FILES)) 

	{

		foreach($_FILES AS $name => $value)

		{

			${$name} = $value['tmp_name'];

			$fp = @fopen(${$name},'r');

			$fstr = @fread($fp,filesize(${$name}));

			@fclose($fp);

			if($fstr!='' && (ereg("<\?",$fstr) || ereg("<\%",$fstr) ) )

			{

				 //echo "文件格式错误";

				 return ;

			}

		}

	}

	

	if($filesize >= $upload_maxsize * 1024 * 1024 )

	{

	    //echo "文件过大";

		return ;

	}

	if( !file_exists($store_dir) )

	{

		makedir($store_dir);

	}

	//debug($store_dir.$newname);

	if (!move_uploaded_file($upload_file,$store_dir.$newname)) 

	{

		//echo "复制文件失败";

		return ;

	}

	$dir = strtolower( getFormDefault("filepath","Attachment/") );

	

	return $folder . $newname;

	

	//Msg("$tmp 成功上传",$flash);

}

?>