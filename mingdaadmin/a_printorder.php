<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>订单打印</title>
</head>

<body>
<?php require("php_top.php");?>

<style>
.state0{ color:#00CC00}
.state1{ color:#FF0000}
.state2{ color:#0000FF}
.state3{ color:#000000}
.state4{ color:#666666}
.wrap{word-wrap : break-word ;word-break:break-all;}
.table_border{  border:1px #333333 solid;border-right:0px;border-bottom:0px;}
.table_td_border{  border:1px #333333 solid;border-right:0px;border-top:0px;}
.table_td_border_right{  border-right:1px #333333 solid;}
.table_td_border_top{  border-top:1px #333333 solid;}
</style>
<?php
isAuthorize($group[3]);
$action=getQuery("action");
switch($action)
{
case "edit":
	editItem();
	break;
default:
	showItem();
	break;
}
?>
<?
function editItem()
{
$arrstate=array("等待买家付款","等待卖家发货","等待买家收货","订单完成","订单作废");
global $glo;
global $cfg;
$id=getQuerySQL("id");
$sql="select * from `@@@order` where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$coin=$rows["coin"];
$discount=$rows["discount"];
?>
<table  align="center" border="0" style="width:600px"  cellpadding="1" cellspacing="0" class="tbtitle">
  <tr>
    <td colspan="4" align="center" style="border:1px #333333 solid" bgcolor="#F2F4F6"><strong>订单号：<?=$rows["itemno"]?></strong></td>
  </tr>
  <tr align="center" bgcolor="#FFFFE9"  >
    <td class="table_td_border"  width="100">产品图片</td>
    <td class="table_td_border"  width="130" bgcolor="#FFFFE9">产品名称</td>
    <td class="table_td_border"  width="40" >数量</td>
    <td class="table_td_border table_td_border_right" >备注</td> 
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
  ?>
  <tr align="center" bgcolor="#FFFFFF" >
    <td class="table_td_border" align="center"><img src="<?=getImageURL($orows["ppic"],3,"uploadImage/",IMAGE)?>" border="0" ></td>
    <td class="table_td_border" align="left"><div style="width:130px; font-size:11px" class="wrap"><?=$orows["pname"]?><br>
<em><?=$orows["pstyle"]?></em></div></td>
    <td class="table_td_border" align="center"><?=$orows["pnum"]?></td>
    <td class="table_td_border table_td_border_right" align="center"><?=$orows["premark"]?>&nbsp; </td>
  </tr>
  <?
  
  }
  free($ors);
  ?>
</table>
<br />
<table  align="center"  style="width:600px" cellpadding="1" border="0"  cellspacing="0"  class="tbtitle">
  <tr>
    <td colspan="2"  style="border:1px #333333 solid"  bgcolor="#F2F4F6"><strong>订单信息</strong></td>
  </tr>
   
  
  <tr bgcolor="#FFFFFF" >
    <td class="table_td_border table_td_border_right"  colspan="2">
      <? $arraddress=split($cfg["split"],$rows["address"]) ?>
	  <table width="100%"  border="0"  cellspacing="0" bordercolor="#E3E6EB" cellpadding="3">
	    <tr>
	      <td  class="table_td_border table_td_border_top" width="50" align="right" bgcolor="#FFFFFF">姓名：</td>
      <td class="table_td_border table_td_border_top" bgcolor="#FFFFFF">姓:<?=$arraddress[8]?> 名:<?=$arraddress[0]?></td>
      <td class="table_td_border table_td_border_top" width="50" align="right" bgcolor="#FFFFFF">地址：</td>
      <td class="table_td_border table_td_border_top table_td_border_right"  bgcolor="#FFFFFF"><?=$arraddress[1]?></td>
    </tr>
	    <tr>
	      <td class="table_td_border" align="right" bgcolor="#FFFFFF">邮编：</td>
      <td class="table_td_border" bgcolor="#FFFFFF"><?=$arraddress[2]?></td>
      <td class="table_td_border" align="right" bgcolor="#FFFFFF">城市：</td>
      <td class="table_td_border table_td_border_right"  bgcolor="#FFFFFF"><?=$arraddress[3]?></td>
    </tr>
	    <tr>
	      <td class="table_td_border" align="right" bgcolor="#FFFFFF">省份：</td>
      <td class="table_td_border" bgcolor="#FFFFFF"><?=$arraddress[4]?></td>
      <td class="table_td_border" align="right" bgcolor="#FFFFFF">国家：</td>
      <td class="table_td_border table_td_border_right" bgcolor="#FFFFFF"><?=$arraddress[5]?></td>
    </tr>
	    <tr>
	      <td class="table_td_border" align="right" bgcolor="#FFFFFF">电话：</td>
      <td class="table_td_border" bgcolor="#FFFFFF"><?=$arraddress[6]?></td>
      <td class="table_td_border" align="right" bgcolor="#FFFFFF">邮箱：</td>
      <td class="table_td_border table_td_border_right" bgcolor="#FFFFFF"><?=$arraddress[7]?></td>
    </tr>
      </table></td>
  </tr>
   
  
 
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td class="table_td_border" width="13%">配送：</td>
    <td class="table_td_border table_td_border_right" ><?=$rows["express"]?></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td class="table_td_border">日期：</td>
    <td class="table_td_border table_td_border_right" ><?=$rows["addtime"]?></td>
  </tr>
</table>
<?
free($rs);
}
?>
</body>
</html>
