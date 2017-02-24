<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_profile.html";

$action=getQuery("action");
if( $userid==-1 && $action!="search_order")
{
	//$action="login";
	$tmp_redirectURL = $_SERVER['REQUEST_URI'];
	redirect(FOLDER."register.php?do=sign&redirectURL=" . urlencode($tmp_redirectURL) );
	//redirect("register.php?do=sign");
}

$var["title"] =   "{$cfg['lg']['my_account']} - " . $var["title"];
$var["str_url_2"] = "{$cfg['lg']['my_account']}";
$arrstate=array("{$cfg['lg']['pending']}","{$cfg['lg']['unpaid']}","{$cfg['lg']['paid']}","{$cfg['lg']['processing']}","{$cfg['lg']['shipped']}","{$cfg['lg']['completed']}","{$cfg['lg']['canceled']}");

$var["arrstate"]=$arrstate;
if( $userid!=-1 )
{
	// --  读取会员的一些汇总
	$sql = "select count(*) as t,state from `@@@order` where userid=$userid group by state" ;
	$rs = query($sql);
	$var["sum_o"] = array(0,0,0,0,0,0,0);
	$var["sum_o"]["total"]=0;
	while( $rows = fetch($rs))
	{
		$rows["t"] = dataDefault($rows["t"],0);
		$var["sum_o"][$rows["state"]] = $rows["t"] ;
		$var["sum_o"]["total"] +=  $rows["t"] ;
	}
	
	$sql = "select count(*) as t,cid from @@@message where userid=$userid or userid=0 group by cid" ;
	$rs = query($sql);
	$var["sum_m"] = array(0,0,0,0,0,0);
	$var["sum_m"]["total"] = 0;
	while( $rows = fetch($rs))
	{
		$var["sum_m"][$rows["cid"]] = $rows["t"] ;
		$var["sum_m"]["total"] +=  $rows["t"] ;
	}
	
	$var["sum_f"]["total"]=0 ;
	$sql = "select count(*) as t from @@@favorite where userid=$userid" ;
	$rs = query($sql);
	while( $rows = fetch($rs))
	{
		$var["sum_f"]["total"] =  $rows["t"] ;
	}
	
	$var["sum_a"]["total"]=0 ;
	$sql = "select count(*) as t from @@@address where userid=$userid" ;
	$rs = query($sql);
	while( $rows = fetch($rs))
	{
		$var["sum_a"]["total"] =  $rows["t"] ;
	}
	$var["user"]["nowip"] =  getIP();
	
	$var["sum_c"]["total"]=0 ;
	$sql = "select count(*) as t from @@@coupon where userid=$userid" ;
	$rs = query($sql);
	while( $rows = fetch($rs))
	{
		$var["sum_c"]["total"] =  $rows["t"] ;
	}
	
}
//debug($var["sum_m"]);
switch($action)
{
	case "login":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['login']}";
		break;
	case "message_list":
		$arrcid = array("{$cfg['lg']['member_feedback']}","{$cfg['lg']['product_reviews']}","{$cfg['lg']['news_reviews']}","{$cfg['lg']['feedback']}","{$cfg['lg']['order_message']}","{$cfg['lg']['announcement']}");
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] .  " {$cfg['lg']['message_center']} " . $cfg["split_uri2"] ;
		$arrstate=array("<span style='color:#00CC00'>{$cfg['lg']['new_message']}</span>","{$cfg['lg']['already_readed']}");
		//"{$cfg['lg']['no_reply']}","{$cfg['lg']['resolved']}"
		$condition=" where (userid=0 or userid=" . $user["id"] . ")";
		$pagenow=getQueryInt("page",1);
		$pageurl="profile.php?action=message_list";
		

		if( getQuery("cid")!="" )
		{
			$pageurl .= "&cid=" . getQueryInt("cid",0) ;
			$condition .= " and cid=" .  getQueryInt("cid",0);
			$str_url.= " " . $arrcid[getQueryInt("cid",0)] ;	
		}
		else
		{
			$str_url.= " {$cfg['lg']['all_messages']}" ;	
		}
		
		$pagesize=15;
		$rs=createPage("*","@@@message",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
		loadPage($pagenow,$pagetotal,$pagesize,$recordcount,$var);
		$var["pageurl"]=$pageurl;
		while($rows=fetch($rs))
		{
			if( $rows["cid"]==0 )
			    $strp="{$cfg['lg']['msgtype0']}";
			else if( $rows["cid"] == "1" )
				$strp="<a href='product-view.php?id=" . $rows["pid"] . "'>{$cfg['lg']['msgtype1']}</a>" ;
			else if( $rows["cid"] == "2" )
				$strp="<a href='news-view.php?id=" . $rows["pid"] . "'>{$cfg['lg']['msgtype2']}</a>" ;
			else if( $rows["cid"] == "4" )
				$strp="<a href='profile.php?action=order_view&id=" . $rows["pid"] . "'>{$cfg['lg']['msgtype4']}</a>" ;
			else if( $rows["cid"] == "5" )
				$strp="{$cfg['lg']['msgtype5']}" ;
			else if( $rows["cid"] == "3" )
				$strp="{$cfg['lg']['msgtype3']}" ;
			$rows["stitle"]=$strp;
			
			if($rows["cid"]==5)
				$rows["displaystate"] = "&nbsp";
			else
			{
				
				$rows["displaystate"] = $arrstate[$rows['userread']];
			}
			$rs_mes[]=$rows;
		}
		free($rs);
		$var["rs_mes"]=$rs_mes;
		break;
	case "message_view":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> ". $cfg["split_uri2"]  . " {$cfg['lg']['message_center']} " . $cfg["split_uri2"] . " " . $cfg['lg']['viewmsg'] . " ";
		$id=getQueryInt("id",0);
		$sql="select * from @@@message where id=$id";
		$rs=query($sql);
		if( BOF($rs) )
			redirect(FOLDER."error.php?id=1");
		$rows=fetch($rs);
		if($rows["userid"]!=$userid && $rows["userid"]!=0)
			redirect(FOLDER."error.php?id=1");
		free($rs);
		if( $rows["cid"]==0 || $rows["cid"]==4  )
		{
			$strp="{$cfg['lg']['msgtype0']}";
			$sql="select * from @@@reply where mid=".$rows["id"]." order by id asc";
			$rs=query($sql);
			while($replyrows=fetch($rs))
			{
				$replyrows["content"]=nl2br($replyrows["content"]);
				if( $replyrows["replyid"]>0 )
				 $replyrows["color"] = "#008040";
			  else
			   	$replyrows["color"] = "#0000FF";	
				$var["rs_reply"][]=$replyrows;
			}
			if($rows["cid"]==4 )
				$strp="<a href='profile.php?action=order_view&id=" . $rows["pid"] . "'>{$cfg['lg']['msgtype4']}</a>" ;
		}
		else if( $rows["cid"] == "1" )
			$strp="<a href='product-view.php?id=" . $rows["pid"] . "'>{$cfg['lg']['msgtype1']}</a>" ;
		else if( $rows["cid"] == "2" )
			$strp="<a href='news-view.php?id=" . $rows["pid"] . "'>{$cfg['lg']['msgtype2']}</a>" ;
		else if( $rows["cid"] == "5" )
			$strp="{$cfg['lg']['msgtype5']}" ;
		else if( $rows["cid"] == "3" )
			$strp="{$cfg['lg']['msgtype3']}" ;
		$rows["stitle"]=$strp;
		$var["message"]=$rows;
		
		//----- 设置为已读
		if($rows["cid"]!=5 )
		{
			$condition="where id=$id";
			$param=array();
			$param["userread"]=1;
			$sql=updateSQL($param,"@@@message",$condition);
			query($sql);
		}
		break;
	case "coupon_view":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> ". $cfg["split_uri2"]  . " {$cfg['lg']['my_coupon']}";
		$arrstate = array($cfg["lg"]["my_coupon_state0"],$cfg["lg"]["my_coupon_state1"],$cfg["lg"]["my_coupon_state2"],$cfg["lg"]["my_coupon_state3"]);
		$name=filterSQL(getQuery("name"));
		$sql="select * from @@@coupon where name like '$name'";
		$rs=query($sql);
		if( BOF($rs) )
			redirect(FOLDER."error.php?id=1");
		$rows=fetch($rs);
		if($rows["userid"]!=$userid)
			redirect(FOLDER."error.php?id=1");
		free($rs);
		$rows["strstate"]=$arrstate[$rows["state"]];
		if($rows["endtime"])
	  		$rows["strtime"] = formatDate(strtotime($rows["endtime"]));
	 	 else
	  		$rows["strtime"] = "&nbsp;";
		
		$var["coupon"]=$rows;
		
		
		break;
	case "order_list":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['my_orders']} " . $cfg["split_uri2"] . " ";
		$arrstate=array("{$cfg['lg']['pending']}","{$cfg['lg']['unpaid']}","{$cfg['lg']['paid']}","{$cfg['lg']['processing']}","{$cfg['lg']['shipped']}","{$cfg['lg']['completed']}","{$cfg['lg']['canceled']}");
		
		$var["arrstate"]=$arrstate;
		$pagenow=getQueryInt("page");
		$pagesize=15;
		$pageurl="profile.php?action=order_list";
		$condition = " where userid=" . $user["id"] ;
		if( getQuery("state")!="" )
		{
			$pageurl .= "&state=" . getQueryInt("state",0) ;
			$condition .= " and state=" .  getQueryInt("state",0);
			$str_url.= $arrstate[getQueryInt("state",0)] ;
		}
		else
		{
			$str_url.= " {$cfg['lg']['all_orders']}";
		}
		$rs=createPage("*","@@@order",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
		loadPage($pagenow,$pagetotal,$pagesize,$recordcount,$var);
		$var["pageurl"]=$pageurl;
		while($rows=fetch($rs))
		{
			$rows["orderprice"]  = fetchValue("select sum(pnum*pprice) as v from @@@orderproduct where orderid=" . $rows["id"] , 0 ) + $rows["sub1"] + $rows["sub2"] + $rows["sub3"];
			$rs_o[]=$rows;
		}
		free($rs);
		$var["rs_o"]=$rs_o;
		break;
	case "favorite_list":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['my_wishlist']}";
		$pagenow=getQueryInt("page");
		$pagesize=15;
		$pageurl="profile.php?action=favorite_list";
		$condition = " where userid=" . $user["id"] ;
		$rs=createPage("*","@@@favorite",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
		loadPage($pagenow,$pagetotal,$pagesize,$recordcount,$var);
		$var["pageurl"]=$pageurl;
		while($rows=fetch($rs))
		{
			$rows["realpic"]= $config[61] . getImageURL($rows["ppic"],3,"uploadImage/",$urltype);
			$rows["rewrite"]="product-view.php?id=" . $rows["pid"];
			$rs_f[]=$rows;
		}
		free($rs);
		$var["rs_f"]=$rs_f;
		break;
	case "coupon_list":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['my_coupon']}";
		$arrstate = array($cfg["lg"]["my_coupon_state0"],$cfg["lg"]["my_coupon_state1"],$cfg["lg"]["my_coupon_state2"],$cfg["lg"]["my_coupon_state3"]);
		$pagenow=getQueryInt("page");
		$pagesize=15;
		$pageurl="profile.php?action=coupon_list";
		$condition = " where userid=" . $user["id"] ;
		$rs=createPage("*","@@@coupon",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
		loadPage($pagenow,$pagetotal,$pagesize,$recordcount,$var);
		$var["pageurl"]=$pageurl;
		while($rows=fetch($rs))
		{
			
			$rows["strstate"]=$arrstate[$rows["state"]];
			if($rows["endtime"])
	  			$rows["strtime"] = formatDate(strtotime($rows["endtime"]));
	 		 else
	  			$rows["strtime"] = "&nbsp;";
			$rows["descript"]=substr( strip_tags($rows["descript"]) , 0 , 42 ) . "...";
			$rs_coupon[]=$rows;
		}
		free($rs);
		$var["rs_coupon"]=$rs_coupon;
		break;
	case "invite_list":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['invite_list']}";
		$pagenow=getQueryInt("page");
		$arr_state = array($cfg["lg"]["no"],$cfg["lg"]["yes"]);
		$pagesize=15;
		$pageurl="profile.php?action=invite_list";
		$condition = " where userid=" . $user["id"] ;
		$rs=createPage("*","@@@invitation",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
		loadPage($pagenow,$pagetotal,$pagesize,$recordcount,$var);
		$var["pageurl"]=$pageurl;
		while($rows=fetch($rs))
		{
			
			$rows["reg_state"]=$arr_state[$rows["isregistered"]];
			$rows["rew_state"]=$arr_state[$rows["isrewarded"]];
			$rows["addtime"] = date("M j,Y",strtotime($rows["addtime"]));
			$var["rs_invite"][]=$rows;
		}
		free($rs);
		break;
	case "info_view":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['change_acount_info']}" ;
		break;
	case "account_view":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['change_my_account']}";
		break;
	case "order_view":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['msgtype4']}";
		$itemno=filterSQL(getQuery("itemno"));
		$arrstate=array("{$cfg['lg']['pending']}","{$cfg['lg']['unpaid']}","{$cfg['lg']['paid']}","{$cfg['lg']['processing']}","{$cfg['lg']['shipped']}","{$cfg['lg']['completed']}","{$cfg['lg']['canceled']}");
		$var["arrstate"]=$arrstate;
		$sql="select * from `@@@order` where itemno='$itemno'";
		$rs=query($sql);
		if( BOF($rs) )
			redirect(FOLDER."error.php?id=1");
		$rows=fetch($rs);
		$rows["arraddress"]=split( $cfg["split"]  ,$rows["address"] ) ;
		$rows["address"]=str_replace( $cfg["split"] , " " , $rows["address"] );
		$rows["shipno"] = nl2br($rows["shipno"]);
		$var["order"]=$rows;
		$id = $rows["id"] ;
		if($rows["userid"]!=$userid)
			redirect(FOLDER."error.php?id=1");
		free($rs);
		$sql="select * from @@@orderproduct where orderid=$id";
		$rs=query($sql);
		$totalprice=0;
		while($rows=fetch($rs))
	  	{
		 	$itemprice=$rows["pnum"]*$rows["pprice"];
			$totalprices+=$itemprice;
			$rows["itemprice"]=$itemprice;
			$rows["rewrite"]="product-view.php?id=" . $rows["pid"];
			$rows["realpic"]= $config[61] . getImageURL($rows["ppic"],3,"uploadImage/",$urltype);
			$var["order"]["productprice"] += $itemprice ;
  			$rs_o[]=$rows;
		}
		free($rs);
		$var["order"]["totalprices"]= $var["order"]["productprice"] + $var["order"]["sub1"] + $var["order"]["sub2"] + $var["order"]["sub3"] + $var["order"]["sub4"] ;
		$var["rs_o"]=$rs_o;
		
		break;
	case "search_order":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['search_order']}";
		$itemno=filterSQL(getRequest("itemno"));
		$arrstate=array("{$cfg['lg']['pending']}","{$cfg['lg']['pnpaid']}","{$cfg['lg']['Paid']}","{$cfg['lg']['Processing']}","{$cfg['lg']['Shipped']}","{$cfg['lg']['Completed']}","{$cfg['lg']['Cancelled']}");
		$var["arrstate"]=$arrstate;
		$sql="select * from `@@@order` where itemno='$itemno'";
		$rs=query($sql);
		if( BOF($rs) )
			redirect("error.php?id=1");
		$rows=fetch($rs);
		$id=$rows["id"];
		$rows["address"]=str_replace( $cfg["split"] , " " , $rows["address"] );
		$rows["shipno"] = nl2br($rows["shipno"]);
		$var["order"]=$rows;
		free($rs);
		$sql="select * from @@@orderproduct where orderid=$id";
		$rs=query($sql);
		$totalprice=0;
		while($rows=fetch($rs))
	  	{
		 	$itemprice=$rows["pnum"]*$rows["pprice"];
			$totalprices+=$itemprice;
			$rows["itemprice"]=$itemprice;
			$rows["rewrite"]="product-view.php?id=" . $rows["pid"];
			$rows["realpic"]= $config[61] . getImageURL($rows["ppic"],3,"uploadImage/",$urltype);
  			$var["order"]["productprice"] += $itemprice ;
			$rs_o[]=$rows;
		}
		free($rs);
		$var["rs_o"]=$rs_o;
		$var["order"]["totalprices"]= $var["order"]["productprice"] + $var["order"]["sub1"] + $var["order"]["sub2"] + $var["order"]["sub3"] + $var["order"]["sub4"];
		break;
	case "address_list":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . "{$cfg['lg']['my_address_books']}";
		$sql="select * from @@@address where userid=" . $user["id"] ;
		$rs=query($sql);
		while($rows=fetch($rs))
		{
			$address=split( $cfg["split"] , $rows["content"]);
			array_pad($address,20,"");
			$rows["address"]=$address;
			$rs_address[]=$rows;
		}
		$var["rs_address"]=$rs_address;
		break;
	case "address_edit":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['my_address_books']} " . $cfg["split_uri2"] . " {$cfg['lg']['edit_address']}";
		$id=getQueryInt("id",0);
		$sql="select * from @@@address where id=$id and userid=" . $user["id"];
		$rs=query($sql);
		if( BOF($rs) )
			redirect("".FOLDER."error.php?id=1");
		$rows=fetch($rs);
		$address=split( $cfg["split"] , $rows["content"]);
		array_pad($address,20,"");
		$var["addressid"]=$rows["id"];
		$var["address"]=$address;
		break;
	case "newsletter_sub":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['newsletter_sub']}";
		$sql="select * from @@@newsletter where name like '" . $user["name"] ."'";
		$rs=query($sql);
		if( BOF($rs) )
			$var["user"]["newsletter_exists"] = "no";
		else
			$var["user"]["newsletter_exists"] = "yes";
		break;
		
	case "leave_message":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['message_center']} ". $cfg["split_uri2"] . " {$cfg['lg']['leave_a_message']}";
		break;
	case "invite":
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " <a  href='".FOLDER."profile.php'><span class='daoa3' >{$cfg['lg']['my_account']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['invite_friends']}";
		break;
	case "address_delete_save":
		address_delete_save();
		break;
	case "favorite_delete_save":
		favorite_delete_save();
		break;
	case "address_edit_save":
		address_edit_save();
		break;
	case "address_add_save":
		address_add_save();
		break;
	case "newsletter_sub_save":
		newsletter_sub_save();
		break;
	case "info_edit_save":
		info_edit_save();
		break;
	case "sec_edit_save":
		sec_edit_save();
		break;
	case "order_state_change_save":
		order_state_change_save();
		break;
	case "invite_save":
		invite_save();
		break;
	case "add_message_reply_save": 
		add_message_reply_save();
		break;
	default :
		$action="";
		$str_url="<a  href='".FOLDER."'><span class='daoa3' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri2"] . " {$cfg['lg']['my_account']}";
		$sql="select * from @@@message  where userid=0 limit 5";
		$rs = query($sql);
		while ( $rows = fetch($rs) )
		{
			$rows["addtime"] = formatDate(strtotime($rows["addtime"]));
			$var["rs_mm"][] = $rows;
		}
		
		$tempuncomplete = 9 ;
		$arrcomplete = array("firstname","lastname","email","msn","street","postcode","city","province","country");
		for($index=0;$index<count($arrcomplete);$index++)
		{
			if($user[$arrcomplete[$index]]=="")
			{
				$tempuncomplete-- ;
			}
		}
		$var["pc"] = (int)($tempuncomplete*10/9)*10;
		$cfg["lg"]["profile_complete"] = str_replace("{0}",$var["pc"],$cfg["lg"]["profile_complete"]);
		$sql = "select * from `@@@order`  where userid=$userid order by id desc limit 5" ;
		$rs = query($sql);
		while( $rows = fetch($rs))
		{
			$rows["addtime"] = formatDate(strtotime($rows["addtime"]));
			$rows["shipno"] = nl2br($rows["shipno"]);
			$var["rs_ro"][] =  $rows ;
		}
		break;
}

$var["action"]=$action;
$var["str_url"]=$str_url ;

require("uio_bomdata.php");
?>
<?

 function sec_edit_save()
 {
 	global $user;
	global $cfg;
	$id=$user["id"];
	$condition="where id=$id";
	$param["question"]=getForm("question");
	$param["answer"]=getForm("answer");
	if(getForm("pwd")!="")
	{
		$param["realpwd"]=getForm("pwd");
		$param["pwd"]=md5(md5(getForm("pwd")));
	}
	$sql=updateSQL($param,"@@@user",$condition);
	query($sql);
	alertRedirect("{$cfg['lg']['sec_edit_ok']}","profile.php?action=account_view");
 }
 
 function info_edit_save()
 {
 	global $user;
	global $cfg;
	$id=$user["id"];
	$condition="where id=$id";
	$param["sex"]=getFormInt("sex",1);
	$param["firstname"]=getForm("firstname");
	$param["lastname"]=getForm("lastname");
	$param["email"]=getForm("email");
	$param["msn"]=getForm("msn");
	$param["postcode"]=getForm("postcode");
	$param["country"]=getForm("country");
	$param["province"]=getForm("province");
	$param["city"]=getForm("city");
	$param["street"]=getForm("street");
	$sql=updateSQL($param,"@@@user",$condition);
	query($sql);
	alertRedirect("{$cfg['lg']['info_edit_ok']}","profile.php?action=info_view");
 }
 
 function order_state_change_save()
 {
 	global $user;
	global $cfg;
	$itemno=filterSQL(getRequest("itemno"));
	$condition="where itemno='$itemno' and userid = " . $user["id"];
	if( getForm("state")!="" )
	{
		$param["state"]=getFormInt("state",1);
		$sql=updateSQL($param,"@@@order",$condition);
		query($sql);
	}
	alertRedirect("{$cfg['lg']['order_state_ok']}","profile.php?action=order_view&itemno=" . $itemno);
 }
 
 function address_delete_save()
 {
	global $user;
	global $cfg;
	$id=getQueryInt("id",0);
	$rs=deleteRecord("@@@address","where id=$id and userid =". $user["id"]);
	alertRedirect(" {$cfg['lg']['delete_address_ok']}","profile.php?action=address_list");
 }
 
 function favorite_delete_save()
 {
 	global $user;
	global $cfg;
	$id=getQueryInt("id",0);
	$rs=deleteRecord("@@@favorite","where id=$id and userid = ". $user["id"]);
	alertRedirect(" {$cfg['lg']['delete_favorites_ok']}","profile.php?action=favorite_list");
 }
 
 function address_edit_save()
 {
	global $cfg;
	global $user;
	$id=getQueryInt("id",0);
	$arrconfig=array();
	for($indexI=0;$indexI<20;$indexI++)
	{
		$arrconfig[$indexI]=getForm("content$indexI");
	}
	$param["content"]=join( $cfg["split"] , $arrconfig ) ;
	$condition="where id=$id and userid = ". $user["id"];
	$sql=updateSQL($param,"@@@address",$condition);
	query($sql);
	$tmp_redirectURL = getFormDefault("redirectURL","profile.php?action=address_edit&id=$id");
	alertRedirect(" {$cfg['lg']['edit_address_ok']}",$tmp_redirectURL);
 }
 
 function address_add_save()
 {
	global $userid;
	global $cfg;
	$arrconfig=array();
	for($indexI=0;$indexI<20;$indexI++)
	{
		$arrconfig[$indexI]=getForm("content$indexI");
	}
	$param["content"]=join( $cfg["split"] , $arrconfig ) ;
	$param["userid"] = $userid ;
	$sql=insertSQL($param,"@@@address");
	query($sql);
	alertRedirect(" {$cfg['lg']['ad_address_ok']}","profile.php?action=address_list");
 }
 
 function newsletter_sub_save()
 {
	 global $var;
	 global $cfg;
	 if($var["user"]["id"]>0)
	 {
		 if(getForm("newsletter_exists")=="yes")
		 {
		 	$param = array();
			$param["name"] = $var["user"]["name"] ;
			$param["ip"]=getIP();
			$param["domain"] = $_SERVER['SERVER_NAME'];
			$param["addtime"] = formatDateTime(time());
			$sql = replaceIntoSQL($param,"@@@newsletter");
		 }
		 else if(getForm("newsletter_exists")=="no")
		 	$sql = "delete from @@@newsletter where name like '".$var["user"]["name"]."'";
		 query($sql);
	 }
	 alertRedirect("{$cfg['lg']['msg_newsletter_success']}","profile.php?action=newsletter_sub");
 }	
 
 function add_message_reply_save()
{
	global $config;
	global $cfg;
	
	if( $config[43]!="")
	{
		if (getForm("code")!=$_SESSION["code"] || $_SESSION["code"]=="" || getForm("code")=="")
		{
			echo "<script> alert('Sorry , Code is Error') ;history.back(); </script>";
			exit();
		}
	}
	
	$param["replyid"]=getFormInt("replyid",0);
	$param["replyname"]=getFormSafe("replyname");
	$param["mid"]=getFormInt("mid",0);
	$param["ip"]=getIP();
	$param["addtime"]=formatDateTime(time());
	$param["content"]=getFormSafe("content");
	$sql=insertSQL($param,"@@@reply");
	query($sql);
	//debug($sql);
	
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param1=array();
	$param1["state"]=2;
	$param1["adminread"]=0;
	$param1["replytime"]=formatDateTime(time());
	$sql=updateSQL($param1,"@@@message",$condition);
	query($sql);
	alertRedirect(" {$cfg['lg']['msg_add_message_success']}",$_SERVER['HTTP_REFERER']);
}

function invite_save()
 {
	 global $userid;
	 global $user;
	global $cfg;
	 $stremail=str_replace("\r","",getFormStr("emails"));
	 $stremail=str_replace("\n",",",$stremail);
	 $arr_mail = split(',',$stremail);
	 for($index=0;$index<count($arr_mail);$index++)
	 {
		$arr_mail[$index] = trim($arr_mail[$index]);
		if($arr_mail[$index]=="")
			continue;
		$param = array();
		$param["userid"]=$user["id"];
		$param["name"]=$arr_mail[$index];
		$param["isregistered"]=0;
		$param["isrewarded"]=0;
		$param["addtime"]=formatDateTime(time());
		$sql=insertSQL($param,"@@@invitation");
		query($sql);
		$inviteid=mysql_insert_id();
		
		
		$vartmp = array();
		$vartmp["action"] = "email_invite";
		$vartmp["username"] = getFormDefault("username",$user["firstname"]) ;
		$vartmp["useremail"] = getFormDefault("useremail",$user["name"]) ;
		$vartmp["id"] = $inviteid;
		$arr_var[] = $vartmp ;
	 }
	 if(count($arr_var)>0)
	 	addToMailQueue($arr_var,true);
	alertRedirect(" {$cfg['lg']['msg_invite_success']}",$_SERVER['HTTP_REFERER']);
 }
 ?>
