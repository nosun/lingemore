<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>营销统计</title>
</head>

<body>
<?php require("php_top.php");?>
<style>
.state0{ color:#000000}
.state1{ color:#00CC00}
</style>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">营销统计</div>
</div>
 </td>
 </tr>
</table>
<br />
<script language="javascript" type="text/javascript"   charset='gb2312' src="JSFile/DateJs.js"></script>
<script language="javascript">
 
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
</script>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">营销统计</a> </td>
  </tr>
</table><br />
<?php
$action=getQuery("action");
isAuthorize($group[4]);
switch($action)
{
default:
	showItem();
	break;
}
?>

<?
function showItem()
{
global $config;
?>
<form name="form2" method="get" action="?">
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>条件选择</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
      <td class="a_fen">
	   网站域名：
      <input name="domain" type="text" id="domain" value="<?=getRequest("domain")?>" style="width:150px"><span class="fontpadding">年份选择 ： 
		<select id="addtime" name="addtime">
		<option value="">请选择年份</option>
		<option value="2011-1-1">2011年</option>
		<option value="2012-1-1">2012年</option>
		<option value="2013-1-1">2013年</option>
		<option value="2014-1-1">2014年</option>
		<option value="2015-1-1">2015年</option>
		<option value="2016-1-1">2016年</option>
		</select>
		<script language="javascript">
		EnterSelect("addtime","<?=getRequest("addtime")?>")
		</script>
		
		</span>
		<span class="fontpadding"><input type="submit" name="Submit32" value="提交"  class="button"  /></span> </tr>
</table>  
</form>
<?
$condition=" 1=1" ;
$pageurl="1=1" ;
$addtime = getRequestDefault("addtime",formatDate(time())) ;
$condition.= " and YEAR(addtime)=YEAR('" . $addtime . "')";
$year = date("Y",strtotime($addtime));
if( getRequest("domain")!="" )
{
	$pageurl.="&domain=" . getRequest("domain") ;
	$condition.= " and domain like '" . getRequest("domain") . "'";
}

$pageurl.="&addtime=" . $addtime ;
$title = getRequestDefault("domain","所有") . " 网站".$year."年1月-12月的营销的分布情况" ;
?><br>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="6" bgcolor="#F2F4F6"><strong>时间列表</strong><span class="fontpadding">条件：<?=$title ?></span></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9"  >
   <td width="5%"   >月份</td>
   <td width="11%" align="center"  >实际订单</td>
   <td width="11%" align="center"  >订单总数</td>
   <td width="9%" align="center"  >实际金额(<?=$config[90]?>)</td>
   <td width="14%" align="center"  >下单总额(<?=$config[90]?>)</td>
    <td width="50%" align="left"  >&nbsp;</td>
  
    
  </tr>

<?
//$total = fetchValue("select sum(pnum*pprice*rate) as v from `@@@orderproduct` inner join `@@@order` on $condition and @@@orderproduct.orderid=@@@order.id",0);

$sql = "select month(addtime) as strmonth,sum(pnum*pprice*rate)+sub1+sub2+sub3+sub4 as t from `@@@orderproduct` inner join `@@@order` on $condition and  @@@orderproduct.orderid=@@@order.id  group by month(addtime) order by strmonth desc";
$rs = query($sql);
while($rows=fetch($rs))
{
	r2n($rows["t"]);
	$arrdata["order_money_all"][$rows["strmonth"]] = $rows ;
}

$sql = "select month(addtime) as strmonth,sum(pnum*pprice*rate)+sub1+sub2+sub3+sub4 as t from `@@@orderproduct` inner join `@@@order` on $condition and  @@@orderproduct.orderid=@@@order.id  and   state>=2   group by month(addtime) order by strmonth desc";
$rs = query($sql);
while($rows=fetch($rs))
{
	r2n($rows["t"]);
	$arrdata["order_money_pay"][$rows["strmonth"]] = $rows ;
}

$sql = "select month(addtime) as strmonth,count(*) as t from  `@@@order` where $condition   group by month(addtime) order by strmonth desc";
$rs = query($sql);
while($rows=fetch($rs))
{
	$arrdata["order_num_all"][$rows["strmonth"]] = $rows ;
}

$sql = "select month(addtime) as strmonth,count(*) as t from  `@@@order` where $condition and   state>=2  group by month(addtime) order by strmonth desc";
$rs = query($sql);
while($rows=fetch($rs))
{
	$arrdata["order_num_pay"][$rows["strmonth"]] = $rows ;
}
for($index=12;$index>=1;$index--)
{
?>
  <tr align="center"  bgcolor="#FFFFFF">
   <td  class="a_fen"><?=$index?>月</td>
   <td align="center"  class="a_fen"><?=$arrdata["order_num_pay"][$index]["t"]?></td>
   <td align="center"  class="a_fen"><a href="a_order.php?starttime=<?="$year-$index-1"?>&endtime=<?=date('Y-m-d', strtotime("$year-$index-1 +1 month -1 day"))?>"> <?=$arrdata["order_num_all"][$index]["t"]?> </a></td>
   <td align="center"  class="a_fen"><?=$arrdata["order_money_pay"][$index]["t"]?></td> 
   <td align="center"  class="a_fen"><?=$arrdata["order_money_all"][$index]["t"]?></td>
    <td align="left"   class="a_fen">&nbsp;</td>
   
    </tr>
<?
$sum["order_num_pay"] += $arrdata["order_num_pay"][$index]["t"];
$sum["order_num_all"] += $arrdata["order_num_all"][$index]["t"];
$sum["order_money_all"] += $arrdata["order_money_all"][$index]["t"];
$sum["order_money_pay"] += $arrdata["order_money_pay"][$index]["t"];
}
?>
 <tr align="center"  bgcolor="#FFFFFF">
   <td  class="a_fen">汇总</td>
   <td align="center"  class="a_fen"><?=datadefault($sum["order_num_pay"],0)?></td>
   <td align="center"  class="a_fen"><?=datadefault($sum["order_num_all"],0)?></td>
   <td align="center"  class="a_fen"><?=datadefault($sum["order_money_pay"],0)?></td> 
   <td align="center"  class="a_fen"><?=datadefault($sum["order_money_all"],0)?></td>
    <td align="left"   class="a_fen">&nbsp;</td>
   
    </tr>
<?
free($rs);
?>
 
</table>
<script>
function submit_onClick(formdel,strdo)
{
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

<?php require("php_bottom.php")?>
</body>
</html>
