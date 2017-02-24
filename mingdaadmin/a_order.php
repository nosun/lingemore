<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>产品管理</title>
</head>

<body>
<?php require("php_top.php");?>
<script language="javascript">

 function showPaymentAccount(obj)
	 {
	 //	document.getElementById("span_" + obj.value).style.display = "block";
		$("#payment_account span").css("display","none")
		$("#span_" + obj.value).css("display","inline-block");
	 }
	 
	 function checkcss(obj,str)
	 {
	 	arrobj = document.getElementsByName(str);
		for(index=0;index<arrobj.length;index++)
		{
			obj = arrobj[index];
			if(obj.checked)
				$(obj).parent().addClass("oncheck");
			else
				$(obj).parent().removeClass("oncheck");
		}
	 }
</script>
<style>
.orderstatespan{ display:inline; width:150px; float:left; height:23px; margin-bottom:1px;  margin-right:1px; overflow:hidden; border:1px #FFFFFF dotted}
.oncheck{ border:1px #FFCC7F do; background-color:#FFFFE5}
.state0{ color:#00CC00}
.state1{ color:#FF0000}
.state2{ color:#0000FF}
.state3{ color:#000000}
.state4{ color:#666666}
</style>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">订单管理</div>
</div></td></tr></table><br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">订单列表</a></td>
  </tr>
</table><br />
<?php
isAuthorize($group[3]);
$action=getQuery("action");
switch($action)
{
case "edit":
	editItem();
	break;
case "delete_save": 
	delete_save();
	break;
case "edit_save":
	edit_save();
	break;
case "p_handl":
	if( getRequest("do")=="deletepage" )
	{
		p_delete_save(0);
	}
	elseif ( getRequest("do")=="deleteall" )
	{
		p_delete_save(1);
	}
	else
		showItem();
	break;
default:
	showItem();
	break;
}
?>

<?
function showItem()
{
	global $supper;
	global $adminid;
	$arr_order=array("all"=>0,0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0);
	$sql="select count(*) as t,state from `@@@order` group by state";
	$rs = query($sql);
	while($rows=fetch($rs))
	{
		$arr_order[$rows["state"]] = $rows["t"];
		$arr_order["all"] += $rows["t"] ;
	}

?>
<script>
function CheckAll(formdel,str)
{
  for (var i=0;i<document.forms[formdel].elements.length;i++)
  {
    var e = document.forms[formdel].elements[i];
    if (str=="ON")
	   e.checked = true;
	else
		e.checked= false; 
  }
}
</script><script language="javascript" type="text/javascript"   charset='gb2312' src="JSFile/DateJs.js"></script>
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>订单搜索</strong></td>
  </tr><form name="form2" method="get" action="?">
  <tr bgcolor="#FFFFFF">
    
      <td width="50%" class="a_fen">订单编号：
        <input name="itemno"  style="width:150px"  value="<?=getRequest("itemno")?>" type="text" id="keyword">
		<span class="fontpadding">用户搜索： <input name="username"  style="width:150px"  value="<?=getRequest("username")?>" type="text" id="username"></span>
		<span class="fontpadding">状态搜索：

        <select style="width:142px" name="state" id="state">
		<option value="">所有订单状态 (<?=$arr_order["all"]?>)</option>
	<option value="0">未确定 (<?=$arr_order[0]?>)</option>
	<option value="1">未付款 (<?=$arr_order[1]?>)</option>
	<option value="2">已付款 (<?=$arr_order[2]?>)</option>
	<option value="3">处理中 (<?=$arr_order[3]?>)</option>
	<option value="4">已配送 (<?=$arr_order[4]?>)</option>
	<option value="5">订单完成 (<?=$arr_order[5]?>)</option>
	<option value="6">订单作废 (<?=$arr_order[6]?>)</option>
        </select>
		<script language="javascript">
		EnterSelect("state","<?=getRequest("state")?>");
		</script>
		</span>
		
      </td></tr>
	  <tr bgcolor="#FFFFFF">
      <td width="50%" class="a_fen">
	  开始日期：
        <input name="starttime" style="width:150px" id="starttime"  onclick="javascript:ShowCalendar(this.id)"  value="<?=getRequest("starttime")?>" type="text" >
		<span class="fontpadding">结束日期： <input  style="width:150px"  onclick="javascript:ShowCalendar(this.id)"  id="endtime"  name="endtime" value="<?=getRequest("endtime")?>" type="text" >
		</span><span class="fontpadding">订单排序：
	    <select name="orderitem" id="orderitem">
	 <option value="id">按下单时间</option>
	 <option value="state">按订单状态</option>
	
    </select>
	<script>
		EnterSelect("orderitem","<?=getRequest("orderitem")?>")
	</script>
	<select name="orderby" id="orderby">
	 <option value="desc">降序</option>
	<option value="asc">升序</option>
    </select>
	<script>
		EnterSelect("orderby","<?=getRequest("orderby")?>")
	</script>
	</span>
      <span class="fontpadding"><input type="submit" name="Submit3" value="提交"  class="button" ></span>
	  </td>
	  </tr>
	 <?
       if($supper>5)
       {
     ?>
      <tr bgcolor="#FFFFFF">
     <td>
     业务员： <a href="?">全部</a>
     <?
     $sql="select * from `@@@admin` where supper<=8";
     $rs=query($sql);
     while($rows=fetch($rs))
     {
     ?> <a href="?server=<?=$rows["id"]?>"><?=$rows["name"]?></a> 
     <?
     }
     ?>
     </td>
      </tr>
     <?
     }
     ?>
    </form>
   
  
</table>
<br>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="11" bgcolor="#F2F4F6"><strong>订单管理</strong></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9"  >
  <td   >选择</td>
    <td   align="left" >IP/订单号码</td>
    <td  >用户</td>
    <td  >业务员</td>
    <td  >订单状态</td>
    <td>支付状态</td>
    <td  >配送状态</td>
    <td  >订单时间</td>
    <td   >支付总价</td>
    <td   >提交域名</td>
    <td  >操作</td>
  </tr>

<form name="formdel" method="post" action="?action=p_handl">
<?
$arrstate=array("还未确定","还未付款","已付款","处理中","已配送","订单完成","订单作废");
$arrpaymentstate=array("还未确定","还未付款","付款进行","付款失败","差额付款","付款完成","意向退款","进行退款","退款完成");
$arrshippingstate=array("还未确定","处理货物","备货完成","异常跟踪","已经配送","异常运送","成功签收","意向退货","进行退货","退货完成");
global $cfg;
$condition="where 1=1" ;
$pageurl="1=1" ;

if(getRequest("itemno")!="")
{
	$condition .=  " and itemno  like '%" . getRequest("itemno") . "%'" ;
	$pageurl .= "&itemno=" . getRequest("itemno") ;
}

if(getRequest("username")!="")
{
	$condition .=  " and username  like '%" . getRequest("username") . "%'" ;
	$pageurl .= "&username=" . getRequest("username") ;
}

if($supper>5)
{
	if(getRequest("server")!="")
	{
		$condition .= " and server=" . getRequest("server") ;
		$pageurl .=  "&server=" . getRequest("server") ;
	}
}
else
{
	if(getRequestDefault("server",$adminid)!="")
	{
		$condition .= " and server=" . getRequestDefault("server",$adminid) ;
		$pageurl .=  "&server=" . getRequestDefault("server",$adminid) ;
	}
}

if(getRequest("userid")!="")
{
	$condition .= " and userid=" . getRequest("userid") ;
	$pageurl .=  "&userid=" . getRequest("userid") ;
}

if(getRequest("starttime")!="")
{
	$condition .= " and TO_DAYS(addtime)>=TO_DAYS('" . getRequest("starttime") . "')" ;
	$pageurl .=  "&starttime=" . getRequest("starttime") ;
}

if(getRequest("endtime")!="")
{
	$condition .= " and TO_DAYS(addtime)<=TO_DAYS('" . getRequest("endtime") . "')" ;
	$pageurl .=  "&endtime=" . getRequest("endtime") ;
}

if(getRequest("orderitem")!="")
{
	$pageurl .= "&orderitem=" . getRequest("orderitem") ;
}

if(getRequest("orderby")!="")
{
	$pageurl .= "&orderby=" . getRequest("orderby") ;
}

if(getRequest("state")!="")
{
	$condition .= " and state=" . getRequest("state") ;
	$pageurl .=  "&state=" . getRequest("state") ;
}

$pagenow=getQueryInt("page");
$pagesize=20;
$rs=createPage("*","@@@order",$condition," order by ".getRequestDefault("orderitem","id"). " " .getRequestDefault("orderby","desc") .",id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
emptyList($rs,11);
while($rows=fetch($rs))
{
$totalprice = fetchValue("select sum(pnum*pprice) as v from @@@orderproduct where orderid=" . $rows["id"] , 0 );
$productprice =  $totalprice ;
$totalprice += $rows["sub1"] +  $rows["sub2"]  +  $rows["sub3"]  +  $rows["sub4"]  ;
r2n($totalprice);

$arraddress=split($cfg["split"],$rows["address"])
						
?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
   <td class="a_fen">
      <input name="cbid[]" type="checkbox" id="id" value="<?=$rows["id"]?>"></td>
    <td   align="left" class="a_fen"><img src="http://open.35zh.com/cgi-bin/?do=iptocountry&type=3&ip=<?=$rows["ip"]?>" align="absmiddle" hspace="2"> <a href="?action=edit&id=<?=$rows["id"]?>"  id="order<?=$rows["id"]?>" class="jTip" name="<?=$rows["itemno"]?>&nbsp;&nbsp;&nbsp;&nbsp;<span class=red>(<?=$rows["coin"]?> <?=$totalprice?>)<span>" rev="订单姓名：<?=$rows["username"]?><br />产品信息：<?=$rows["coin"]?> <?=$productprice?><br />配送信息：<?=$rows["coin"]?> <?=$rows["sub1"]?> &nbsp;&nbsp;(<?=$rows["express"]?>)<br />物流单号：<?=$rows["shipno"]?><br />付款信息：<?=$rows["coin"]?> <?=$rows["sub2"]?> &nbsp;&nbsp;(<?=$rows["payment"]?>)<br />其他优惠：<?=$rows["coin"]?> <?=$rows["sub3"]+$rows["sub4"]?><br />下载订单：<a target='_blank' href='a_excel.php?id=<?=$rows["id"]?>'>下载Excel</a>&nbsp;<a target='_blank' href='a_order_word.php?id=<?=$rows["id"]?>'>下载Word</a><br /><span class=red>配送地址：</span><br /><?=$arraddress[0]?> <?=$arraddress[8]?><br /><?=$arraddress[1]?><br /><?=$arraddress[2]?><br /><?=$arraddress[3]?> <?=$arraddress[4]?> <?=$arraddress[5]?><br /><?=$arraddress[6]?> <?=$arraddress[7]?>" ><?=$rows["itemno"]?></a></td>
    <td   class="a_fen">
	<? 
	if( $rows["userid"]!=-1 )
		echo "<a href='a_user.php?action=edit&id=" . $rows["userid"] . "'>" . $rows["username"] . "</a>";
	else
		echo $rows["username"];
	?></td>
    <td  class="a_fen"><?=fetchValue("select name as v from `@@@admin` where id=" . $rows["server"],"已删除")?></td>
    <td   class="a_fen"><span class="state<?=$rows["state"]?>"><?=$arrstate[$rows["state"]]?> <img src="images/orderstate-<?=$rows["state"]?>.jpg" align="absmiddle" /></span></td>
    <td  class="a_fen"><?=$arrpaymentstate[$rows["paymentstate"]]?> <img src="images/paymentstate-<?=$rows["paymentstate"]?>.jpg" align="absmiddle" /></td>
    <td  class="a_fen"><?=$arrshippingstate[$rows["shippingstate"]]?> <img src="images/shippingstate-<?=$rows["shippingstate"]?>.jpg" align="absmiddle" /></td>
    <td  class="a_fen"><?= formatDate(strtotime($rows["addtime"]))?></td>
    <td  class="a_fen"><span class="red"><?=$rows["coin"]?> <?=$totalprice?></span></td>
    <td  class="a_fen"><?=$rows["domain"]?></td>
    <td  class="a_fen"><a class="delete red" onClick="return confirm('确定要删除吗？')"  href="?action=p_handl&do=deletepage&cbid[]=<?=$rows["id"]?>">删除</a></td>
  </tr>
<?
}

?>
  <tr class="delete" bgcolor="#FFFFFF">
    <td colspan="11" class="a_fen">选择：<a  href="javascript:CheckAll('formdel','ON')">全选</a> 
      -
  <a  href="javascript:CheckAll('formdel','OFF')">取消</a>
  <span class="fontpadding">
  批量删除：
      <a href="javascript:submit_onClick('formdel','deletepage')" >当前所选</a>
	  <span class="hide"> - <a href="javascript:submit_onClick('formdel','deleteall')" class="red" >搜索到的<?=$recordcount?>个结果</a></span></span>
	   <input id="do" name="do" type="hidden" value="editpage" />
      <input type="hidden" name="condition" id="condition" value="<?=$condition?>" /></td>
	</tr>
</form>
  <tr bgcolor="#FFFFE9">
    <td colspan="11" align="right" ><? require("php_page.php")?></td>
  </tr>
</table>
<script>
function submit_onClick(formdel,strdo)
{
	if(strdo=="editpage"||strdo=="deletepage")
	{
		var inps=document.getElementsByName("cbid[]");
		var count=0;
		for(var i=0; i<inps.length;i++)
		{
			if(inps[i].checked==true)
			count++;
		}
		if(count<=0)
		{
			alert("请至少选择一项");
			return;
		}
	}
	document.getElementById("do").value=strdo;
	if(confirm("确定执行删除吗?"))
	{
		document.forms[formdel].submit();
	}
}

</script>
<?
}
?>
<?
function editItem()
{
$arrstate=array("未确定","未付款","已付款","处理中","已配送","订单完成","订单作废");
global $glo;
global $cfg;
global $config;
global $supper;
global $adminid;
$id=getQuerySQL("id");
if($supper>5)
$sql="select * from `order` where id=$id";
else
$sql="select * from `order` where id=$id and server=$adminid";

$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$coin=$rows["coin"];

$discount=$rows["discount"];
?> <script type="text/javascript">
    function Resetsize(obj)
	{
		var maxwith=80;
		var maxheight=80;
		var oldwidth=obj.width;
		var oldheight=obj.height;
		if(obj.width>maxwith)
		{
			var w=oldwidth-maxwith;
			var h=oldheight-maxheight;
			if(w>h)
			{
				obj.width=maxwith;
				obj.height=oldheight*(maxwith/oldwidth);
			}
			else
			{
				obj.height=maxheight;
				obj.width=oldwidth*(maxheight/oldheight);
			}
		}
		else if(obj.height>maxheight)
		{
			obj.height=maxheight;
			obj.width=oldwidth*(maxheight/oldheight);
		}
		//alert(obj.width);
	}
  </script>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="8" bgcolor="#F2F4F6"><strong>订单商品</strong></td>
  </tr>
  <tr align="center" bgcolor="#FFFFE9"  >
    <td>产品图片</td>
    <td bgcolor="#FFFFE9">产品样式</td>
    <td >产品编号</td>
    <td >产品重量</td>
    <td >产品单价</td>
    <td >订购数量</td>
    <td >重量小计</td>
    <td >价格小计</td>
  </tr>
 
  <?
  	$sql="select * from @@@orderproduct where orderid=$id";
	$ors=query($sql);
 	emptyList($ors,7);
	$totalprice=0;
	while($orows=fetch($ors))
  {
  $itemprice=$orows["pnum"]*$orows["pprice"];
  $totalprice+=$itemprice;
  $itemweight = $orows["pnum"]*$orows["pweight"];
   $totalweight+=$itemweight;
   $totalnum += $orows["pnum"];
  ?>
  <tr align="center" bgcolor="#FFFFFF" >
    <td align="center"><a href="../product-view.php?id=<?=$orows["pid"]?>" target="_blank"><img src="<?=getImageURL($orows["ppic"],3,"uploadImage/",IMAGE)?>" border="0" ></a></td>
    <td align="left" width="300"  class="wrap"><a class="order" href="../product-view.php?id=<?=$orows["pid"]?>" target="_blank"><?=$orows["pname"]?></a><br><em><?=$orows["pstyle"]?></em>
<? if($orows["premark"]!="") { ?>	<br>
备注：<?=$orows["premark"]?>	<? } ?></td>
    <td align="center"><?=$orows["pitemno"]?></td>
    <td align="center"><?=$orows["pweight"]?></td>
    <td align="center"><?=$coin?> <?=$orows["pprice"]?></td>
    <td align="center"><?=$orows["pnum"]?></td>
    <td align="center"><?=$itemweight?></td>
    <td align="center"><?=$coin?> <?=$itemprice?></td>
  </tr>
  <?
  
  }
  free($ors);
  ?>
  <tr align="center" bgcolor="#FFFFE9">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td class="red"><?=$totalnum?></td>
    <td class="red"><?=$totalweight?></td>
    <td class="red"><?=$coin?> <?=$totalprice?></td>
  </tr>
</table>
<br />
<form name="form2" method="post" enctype="application/x-www-form-urlencoded" action="?action=edit_save&id=<?=$id?>">

<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>订单统计</strong></td>
  </tr>

 
  <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="13%" align="left">产品总价：</td>
	<td width="87%" align="left"><?=$coin?> <?=$totalprice?>  <? if($rows["coin"]!=getCoinChar($config,0)){?><span class="fontpadding red">下单时汇率:  <?=$rows["rate"]?>  <?=$coin?> = 1 <?=getCoinChar($config,0)?> </span><? } ?>
	  <? if($rows["discount"]!=1){?><span class="fontpadding red">折扣=<?=$rows["discount"]*100?>%</span><? } ?></td>
  </tr>
  <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td align="left">运费价格：</td>
    <td align="left"> <?=$coin?>  <input name="sub1" value="<?=$rows["sub1"]?>" type="text" size="20"  />    格式：-10 即优惠 <?=$coin?>10</td>
  </tr>
  <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td align="left">支付手续：</td>
    <td align="left"> <?=$coin?>  <input name="sub2" value="<?=$rows["sub2"]?>" type="text" size="20"  /> 
    格式：-10 即优惠 <?=$coin?>10 </td>
  </tr> <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td align="left">折扣优惠：</td>
    <td align="left"><?=$coin?>  <input name="sub4" value="<?=$rows["sub4"]?>" type="text" size="20"  /> 
    格式：-10 即优惠 <?=$coin?>10 (批发打折或优惠券优惠)</td>
  </tr>
  <?
  if($rows["coupon_code"]!="")
  {
	  $coupon_rows = fetchRow("select * from @@@coupon where name='" . $rows["coupon_code"] . "'");
	   if($coupon_rows["endtime"])
	  		$strtime = formatDate(strtotime($coupon_rows["endtime"]));
	  else
	  	$strtime = "";
  ?>
  <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td align="left">使用优惠券：</td>
    <td align="left"><a  target="_blank" href="a_coupon.php?name=<?=$rows["coupon_code"]?>"><?=$rows["coupon_code"]?></a><span style=" background-color:#FFFFE6; margin-left:10px; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">可节省：<?=$config[90] . dataDefault($coupon_rows["price"],0)?>,有效期：<?=$strtime?>,备注：<?=$coupon_rows["descript"]?></span></td>
  </tr>
  <?
  }
  ?>
  <?
  if($rows["create_coupon_code"]!="")
  {
	  $coupon_rows = fetchRow("select * from @@@coupon where name='" . $rows["create_coupon_code"] . "'");
	   if($coupon_rows["endtime"])
	  		$strtime = formatDate(strtotime($coupon_rows["endtime"]));
	  else
	  	$strtime = "";
  ?>
  <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td align="left">系统生成优惠券：</td>
    <td align="left"><a target="_blank" href="a_coupon.php?name=<?=$rows["create_coupon_code"]?>"><?=$rows["create_coupon_code"]?></a><span style=" background-color:#FFFFE6; margin-left:10px; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">可节省：<?=$config[90] . dataDefault($coupon_rows["price"],0)?> , 有效期：<?=$strtime?>,备注：<?=$coupon_rows["descript"]?></span></td>
  </tr>
  <?
  }
  ?>
  
  <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td align="left">手动优惠：</td>
    <td align="left"> <?=$coin?>  <input name="sub3"  value="<?=$rows["sub3"]?>" type="text" size="20" /> 
    格式：-10 即优惠 <?=$coin?>10  (管理员手动优惠或者订单附加)</td>
  </tr>
 <? if($rows["syscontent"]!=""){ ?><tr align="center" bgcolor="#FFFFFF" >
    <td align="left">系统提示：</td>
    <td align="left">  <span style=" background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px"><?=join("<br />",split($cfg["split"],$rows["syscontent"]));?></span>  </td>
  </tr><? } ?>
  <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td align="left">订单总价：</td>
    <td align="left"><?=$coin?> <?=$rows["sub2"]+$rows["sub1"]+$rows["sub3"]+$rows["sub4"]+$totalprice?> 
</td>
  </tr>
  <tr align="center" bgcolor="#FFFFFF" >
    <td align="left">订单操作：</td>
    <td align="left"><div style="width:650px">
	<div class="orderstatespan"><input  onClick="checkcss(this,'state')" name="state" type="radio" value="0" /> 未确定</div>
	<div class="orderstatespan"><input  onClick="checkcss(this,'state')" name="state" type="radio" value="1" /> 
	未付款(付款异常)</div>
	<div class="orderstatespan"><input  onClick="checkcss(this,'state')" name="state" type="radio" value="2" /> 
	已付款(处理优惠券)</div>
	<div class="orderstatespan"><input onClick="checkcss(this,'state')" name="state" type="radio" value="3" /> 处理中</div>

	<div class="orderstatespan"><input onClick="checkcss(this,'state')" name="state" type="radio" value="4" /> 已配送</div>
	<div class="orderstatespan"><input onClick="checkcss(this,'state')" name="state" type="radio" value="5" /> 
	<span class="red">订单完成(真实消费)</span></div>
	<div class="orderstatespan"><input onClick="checkcss(this,'state')" name="state" type="radio" value="6" /> 
	<span style="color:#666666">异常订单</span></div>
	</div>	<script language="javascript">
	EnterRadio("state","<?=$rows["state"]?>");
	</script></td></tr>
     <tr align="center" bgcolor="#FFFFFF" >
    <td align="left">付款状态：</td>
    <td align="left"><div style="width:650px">
	<div class="orderstatespan"><input  onClick="checkcss(this,'paymentstate')"  name="paymentstate" type="radio" value="0" /> 未确定</div>
	<div class="orderstatespan"><input  onClick="checkcss(this,'paymentstate')" name="paymentstate" type="radio" value="1" /> 未付款</div>
	<div class="orderstatespan"><input  onClick="checkcss(this,'paymentstate')" name="paymentstate" type="radio" value="2" /> 付款中</div>
	<div class="orderstatespan"><input onClick="checkcss(this,'paymentstate')" name="paymentstate" type="radio" value="3" /> 付款失败 </div>

	<div class="orderstatespan"><input onClick="checkcss(this,'paymentstate')" name="paymentstate" type="radio" value="4" /> 差额付款 </div>
	<div class="orderstatespan"><input onClick="checkcss(this,'paymentstate')" name="paymentstate" type="radio" value="5" /> <span class="red">付款完成</span></div>
	<div class="orderstatespan"><input onClick="checkcss(this,'paymentstate')" name="paymentstate" type="radio" value="6" /> 意向退款</div>
	<div class="orderstatespan"><input onClick="checkcss(this,'paymentstate')" name="paymentstate" type="radio" value="7" /> 退款中  </div>
    <div class="orderstatespan"><input onClick="checkcss(this,'paymentstate')" name="paymentstate" type="radio" value="8" /> 退款完成</div>
    </div>	<script language="javascript">
	EnterRadio("paymentstate","<?=$rows["paymentstate"]?>");
	</script></td></tr>
    
      <tr align="center" bgcolor="#FFFFFF" >
    <td align="left">配送状态：</td>
    <td align="left"><div style="width:650px">
	<div class="orderstatespan"><input  onClick="checkcss(this,'shippingstate')"  name="shippingstate" type="radio" value="0" /> 未确定</div>
	<div class="orderstatespan"><input  onClick="checkcss(this,'shippingstate')" name="shippingstate" type="radio" value="1" /> 处理货物</div>
	<div class="orderstatespan"><input  onClick="checkcss(this,'shippingstate')" name="shippingstate" type="radio" value="2" /> 备货完成 </div>
	<div class="orderstatespan"><input onClick="checkcss(this,'shippingstate')" name="shippingstate" type="radio" value="3" /> 异常跟踪  </div>

	<div class="orderstatespan"><input onClick="checkcss(this,'shippingstate')" name="shippingstate" type="radio" value="4" /> <span class="red">已经配送</span>  </div>
	<div class="orderstatespan"><input onClick="checkcss(this,'shippingstate')" name="shippingstate" type="radio" value="5" /> 异常运送 </div>
	<div class="orderstatespan"><input onClick="checkcss(this,'shippingstate')" name="shippingstate" type="radio" value="6" /> <span class="red">成功签收</span> </div>
	<div class="orderstatespan"><input onClick="checkcss(this,'shippingstate')" name="shippingstate" type="radio" value="7" /> 意向退货  </div>
    <div class="orderstatespan"><input onClick="checkcss(this,'shippingstate')" name="shippingstate" type="radio" value="8" /> 退货中  </div>
    <div class="orderstatespan"><input onClick="checkcss(this,'shippingstate')" name="shippingstate" type="radio" value="9" /> 退货完成  </div>
    </div>	<script language="javascript">
	EnterRadio("shippingstate","<?=$rows["shippingstate"]?>");
	</script></td></tr>
    
	<tr align="center" class="hide" bgcolor="#FFFFFF" >
	  <td align="left">接口状态：</td>
	  <td align="left"><input name="payresult"  value="<?=$rows["payresult"]?>" type="text"  style=" width:600px" /></td>
    </tr>
	
	<tr align="center" bgcolor="#FFFFFF" >
    <td align="left">货运单号：</td>
    <td align="left"><textarea name="shipno" style="width:600px; height:80px"><?=$rows["shipno"]?></textarea></td></tr>
	<tr align="center" bgcolor="#FFFFFF" >
    <td align="left">后台备注：</td>
    <td align="left"><textarea name="remark" style="width:600px; height:80px"><?=$rows["remark"]?></textarea></td></tr>
   <tr class="edit" align="center" bgcolor="#FFFFE9"  >
    <td colspan="2"><input type="submit" name="Submit4" value="保存以上修改"  onClick="showtips(this)" class="button" /></td>
  </tr>
</table>
</form>
<br />
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>订单信息</strong></td>
  </tr>
   <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="13%" align="left">订单编号：</td>
    <td align="left"><?=$rows["itemno"]?> <span class="fontpadding"><a href="a_message.php?cid=4&pid=<?=$rows["id"]?>">查看该订单留言(<?=fetchValue("select count(*) as v from @@@message where cid = 4 and pid=" . $rows["id"] , 0 )?>)</a></span><span class="fontpadding" style="font-weight:bold"><a class="red" target="_blank" href="../profile.php?action=search_order&itemno=<?=$rows["itemno"]?>">前台详细订单</a></span><span class="fontpadding"><a href="../step.php?action=step_3&itemno=<?=$rows["itemno"]?>" target="_blank">付款页面</a></span>
	
	</td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td>会员名称：</td>
    <td><? 
	if( $rows["userid"]!=-1 )
		echo "<a href='a_user.php?action=edit&id=" . $rows["userid"] . "'>" . $rows["username"] . "</a>";
	else
		echo $rows["username"];
	?></td>
  </tr>
  <tr bgcolor="#FFFFFF" >
    <td>收货地址：<br /><span class="red"><strong>双击格子修改</strong></span> <img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td><? $arraddress=split($cfg["split"],$rows["address"]) ?>
	
	<table width="600" border="0" cellspacing="1" cellpadding="3" style=" background-color:#F2F4F6">

	 <tr>
    <td width="50" align="right" bgcolor="#FFFFFF">姓氏：</td>
    <td bgcolor="#FFFFFF" width="228" id="address8" class="point"><?=$arraddress[8]?></td>
    <td width="50" align="right" bgcolor="#FFFFFF">名字：</td>
    <td bgcolor="#FFFFFF" id="address0" class="point"><?=$arraddress[0]?></td>
  </tr>
  </table>
  <table width="600" border="0" cellspacing="0" cellpadding="3" style=" border-left:1px #F2F4F6 solid;border-right:1px #F2F4F6 solid;">
   <tr>
     <td width="50" style="border-right:1px #F2F4F6 solid;" align="right" bgcolor="#FFFFFF">地址：</td>
     <td bgcolor="#FFFFFF" id="address1" class="point"><?=$arraddress[1]?></td>
     </tr>
	 </table>
	 <table width="600" border="0" cellspacing="1" cellpadding="3" style=" background-color:#F2F4F6">
	 
   <tr>
    <td  width="50"  align="right" bgcolor="#FFFFFF">邮编：</td>
    <td width="228" bgcolor="#FFFFFF" id="address2" class="point"><?=$arraddress[2]?></td>
    <td width="50" align="right" bgcolor="#FFFFFF">城市：</td>
    <td bgcolor="#FFFFFF" id="address3" class="point"><?=$arraddress[3]?></td>
  </tr>
   <tr>
    <td align="right" bgcolor="#FFFFFF">省份：</td>
    <td bgcolor="#FFFFFF" id="address4" class="point"><?=$arraddress[4]?></td>
    <td align="right" bgcolor="#FFFFFF">国家：</td>
    <td bgcolor="#FFFFFF" id="address5" class="point"><?=$arraddress[5]?></td>
  </tr>
   <tr>
    <td align="right" bgcolor="#FFFFFF">电话：</td>
    <td bgcolor="#FFFFFF" id="address6" class="point"><?=$arraddress[6]?></td>
    <td align="right" bgcolor="#FFFFFF">邮箱：</td>
    <td bgcolor="#FFFFFF" id="address7" class="point"><?=$arraddress[7]?></td>
  </tr>
</table>
   <script language="javascript">
  $("#address0").bind("dblclick",function(){getAddressHTML('order','address',<?=$id?>,0,20,0)}); 
  $("#address1").bind("dblclick",function(){getAddressHTML('order','address',<?=$id?>,0,75,1)}); 
  $("#address2").bind("dblclick",function(){getAddressHTML('order','address',<?=$id?>,0,20,2)}); 
  $("#address3").bind("dblclick",function(){getAddressHTML('order','address',<?=$id?>,0,20,3)}); 
  $("#address4").bind("dblclick",function(){getAddressHTML('order','address',<?=$id?>,0,20,4)}); 
  $("#address5").bind("dblclick",function(){getAddressHTML('order','address',<?=$id?>,0,20,5)}); 
  $("#address6").bind("dblclick",function(){getAddressHTML('order','address',<?=$id?>,0,20,6)}); 
  $("#address7").bind("dblclick",function(){getAddressHTML('order','address',<?=$id?>,0,20,7)}); 
  $("#address8").bind("dblclick",function(){getAddressHTML('order','address',<?=$id?>,0,20,8)}); 
  
   </script>
	</td>
  </tr>
   
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td>订单的IP：</td>
    <td><?=$rows["ip"]?>  &nbsp;&nbsp;&nbsp; <script src="http://open.35zh.com/cgi-bin/?do=iptocountry&ip=<?=$rows["ip"]?>&type=2"></script> <span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px"><a target="_blank" href="http://www.melissadata.com/lookups/iplocation.asp?ipaddress=<?=$rows["ip"]?>">查看更为详细的IP地址</a></span></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td>付款方式：</td>
    <td><?=$rows["payment"]?> <span class="fontpadding">(在线支付状态：<?=datadefault($rows["result"],"离线支付")?>) <? if($rows["paypalaccount"]!=""){ ?>&nbsp;&nbsp;(客户Paypal账号:<?=$rows["paypalaccount"]?>)<? } ?></span></td>
  </tr>
 
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td>配送方式：</td>
    <td><?=$rows["express"]?></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td>附加说明：</td>
    <td><?=$rows["content"]?></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td>定单时间：</td>
    <td><?=$rows["addtime"]?></td>
  </tr><tr align="center" class="" bgcolor="#FFFFFF" >
	  <td align="left">邮件转发：</td>
	  <td align="left"><input name="" class="button" value="备份到收取邮箱" onClick="this.style.visibility='hidden';sendmail('email_order_admin','<?=$rows["id"]?>','<?=md5(md5($rows["id"]))?>')" type="button"> 
	  <input name="" class="button" value="通知客户付款" onClick="this.style.visibility='hidden';sendusermail('email_order_pay_user','<?=$rows["id"]?>','<?=md5(md5($rows["id"]))?>')" type="button"> 
	  <input class="button" name="" value="通知客户收到款" onClick="this.style.visibility='hidden';sendusermail('email_order_haspay_user','<?=$rows["id"]?>','<?=md5(md5($rows["id"]))?>')" type="button">
	   <input name=""  class="button" value="发送配送单号" onClick="this.style.visibility='hidden';sendusermail('email_order_shipno_user','<?=$rows["id"]?>','<?=md5(md5($rows["id"]))?>')" type="button"><script language="javascript">
	function sendmail(mail,id,key)
	{
		includeJsFile("Ajax_change"+mail,"../service/serviceForAddtoMailQueue.php?action=email_order_admin&id=" +id+ "&rnd=" + Math.random()) 
	}
	function sendusermail(mail,id,key)
	{
		includeJsFile("Ajax_change"+mail,"../service/serviceForAddtoMailQueue.php?action=email_order_user&html=" + mail + "&id=" +id+"&rnd=" + Math.random()) 
	}
	</script></td>
    </tr>
  <tr align="center" bgcolor="#ffffff" ><td align="left">下载订单：</td>
    <td align="left">【&nbsp;<a target="_blank" href="a_printorder.php?action=edit&id=<?=$rows["id"]?>"><img src="images/document-print.jpg" align="absmiddle"> 打印订单</a>&nbsp;】&nbsp;&nbsp;&nbsp; 【&nbsp;<a target="_blank" href="a_excel.php?id=<?=$rows["id"]?>"><img src="images/table_excel.jpg" align="absmiddle"> 下载Excel</a>&nbsp;】&nbsp;&nbsp;&nbsp; 【&nbsp;<a target="_blank" href="a_order_word.php?id=<?=$rows["id"]?>"><img src="images/table_word.jpg" align="absmiddle"> 下载Word</a>】</td>
    
  </tr>
</table>
<?
free($rs);
}
?>


<?
function edit_save()
{
	global $config;
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["state"]=getFormInt("state",1);
	$param["paymentstate"]=getFormInt("paymentstate",1);
	$param["shippingstate"]=getFormInt("shippingstate",1);
	
	$param["sub1"]=getFormInt("sub1",0,false);
	$param["sub3"]=getFormInt("sub3",0,false);
	$param["sub2"]=getFormInt("sub2",0,false);
	$param["sub4"]=getFormInt("sub4",0,false);
	
	$param["shipno"]=getForm("shipno");
	$param["remark"]=getForm("remark");
	$sql=updateSQL($param,"@@@order",$condition);
	query($sql);
	
	//------------ 纳入真实消费 iscompleted 字段是判断是否已经算入积分了
	$sql="select *  from `@@@order` where id=$id";
	$rs = query($sql);
	while($rows=fetch($rs))
	{
		if( $rows["state"]==2 )
		{
			$param=array();
			$param["state"]= "3" ;
			$param["descript"]= "Used on Order No.:" . $rows["itemno"] ;
			$condition=" where name='". $rows["coupon_code"]."'" ;
			$sql=updateSQL($param,"@@@coupon",$condition);
			query($sql);
			
			$param=array();
			$param["state"]= "1" ;
			$param["descript"]= "System automatically activated Order No.:" . $rows["itemno"] ;
			$condition=" where name='". $rows["create_coupon_code"]."'" ;
			$sql=updateSQL($param,"@@@coupon",$condition);
			query($sql);
		}
		
		
		if( $rows["state"]==5 &&  $rows["iscompleted"]==0 )
		{
			$productprice = fetchValue("select sum(pnum*pprice) as v from `@@@orderproduct` where orderid=$id",0);
			
			$baseprice = $productprice/$rows["rate"];
			r2n($baseprice);
			//---
			$param=array();
			$param["jifen"] = "@jifen+" . $baseprice;
			$condition="where id=" . $rows["userid"];
			$sql=updateSQL($param,"@@@user",$condition);
			query($sql);
			//
			$param=array();
			$param["iscompleted"] = "1";
			$condition="where id=" . $rows["id"];
			$sql=updateSQL($param,"@@@order",$condition);
			query($sql);
			//-------  自动升级部分
			$totaljifen = fetchValue("select jifen as v from `@@@user` where id=" . $rows["userid"],0);
			for($index=9;$index>=0;$index--)
			{
				if( $config[110+$index] &&  $config[240+$index] )
				{
					if( $totaljifen>=$config[240+$index])
					{
						$param=array();
						$param["level"] = $index;
						$condition="where id=" . $rows["userid"];
						$sql=updateSQL($param,"@@@user",$condition);
						query($sql);
						break;
					}
				}
			}
		}
	}
	pageRedirect("1",$_SERVER['HTTP_REFERER']);
}

function delete_save()
{
	$id=getQuerySQL("id");
	$sql="delete from `@@@order` where id=$id";
	query($sql);
	pageRedirect("2","a_order.php");
}

function p_delete_save($flag)
{
	if( $flag==0 )
	{
		$id=getRequestStr("cbid",0);
		$condition="where id in ($id)";
	}
	else
	{
		$condition=getForm("condition");
	}
	//deletePpic( "order", $condition , array("order_"),"../uploadImage/" );
	
	$rs=deleteRecord("@@@order","$condition");
	while( $rows=fetch($rs) )
	{
		$condition="where orderid=" . $rows["id"];
		deleteRecord("@@@orderproduct","$condition");
	}
	pageRedirect("2","a_order.php");
}
?>
<? require("php_bottom.php");?>
</body>
</html>
