<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>支付方式</title>
<style>
#payment_td img{ float:left}
</style>
</head>

<body>
<script language="javascript">
function changeImage(path)
{
	document.getElementById("imgupload").src=path;
}
 function showPaymentAccount(obj)
	 {
	 //	document.getElementById("span_" + obj.value).style.display = "block";
		$("#payment_account span").css("display","none")
		$("#span_" + obj.value).css("display","inline-block");
	 }
</script>
<?php require("php_top.php")?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">支付方式管理</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">支付方式管理</a><span class="fontpadding"><a class="add" href="?action=add">添加支付方式</a></span></td>
  </tr>
</table><br>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >注意：添加的配送方式将直接在前台计算并显示，请设置好参数。<span class="red"><strong>排序小于0的将不会出现在前台</strong></span></td>
  </tr>
</table><br />
<?php
isAuthorize($group[1]);
$action=getQuery("action");
switch($action)
{
case "add":
	addItem();
	break;
case "edit":
	editItem();
	break;
case "add_save":
	add_save();
	break;
case "delete_save":
	delete_save();
	break;
case "edit_save":
	edit_save();
	break;
default:
	showItem();
	break;
}
?>
<?
function showItem()
{
?>
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="6"  bgcolor="#F2F4F6"><strong>支付方式</strong><span class="fontpadding2">带 <img src="images/qianbi.gif"   align="absmiddle"> 的列可<span class="red weight">"直接点击格子修改"</span></span></td>
  </tr>

  <tr align="center" bgcolor="#FFFFE9">
    <td width="4%" align="center">ID</td>
    <td width="15%" align="center">图片</td>
    <td align="left">名称</td>
    <td width="20%">手续费(单位<span class="red weight">%</span>)<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="20%">排序<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="20%">操作</td>
  </tr>
  <?
  $sql="select * from @@@payment";
  $rs=query($sql);
  emptyList($rs,4);
  while($rows=fetch($rs))
  {
  ?>
    
    <tr align="center"  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
      <td align="center"><?=$rows["id"]?></td>
      <td align="center"><a href="?action=edit&id=<?=$rows["id"]?>"><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>" vspace="4" /></a></td>
      <td align="left"><a href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a> (在线接口:<?=dataDefault( $rows["interface"],"不使用接口")?>)</td>
      <td class="point"  id="fee<?=$rows["id"]?>" ><?=$rows["fee"]?></td>
      <td class="point"  id="sort<?=$rows["id"]?>"><?=$rows["sort"]?></td>
    <td><a href="?action=edit&id=<?=$rows["id"]?>">编辑</a>  <a class="delete red" href="?action=delete_save&id=<?=$rows["id"]?>" onClick="return confirm('确定要删除吗？')" >删除</a>	</td>
  </tr>
  <script language="javascript">
  $("#fee<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@payment','fee',<?=$rows["id"]?>,true)}); 
  $("#sort<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@payment','sort',<?=$rows["id"]?>,true)});
  </script>
 <?
 }
 free($rs);
 ?>
</table>
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="6"  bgcolor="#F2F4F6"><strong>支付方式素材下载</strong></td>
  </tr>
    <td bgcolor="#FFFFFF" id="payment_td">
	<img src="images/2checkout.jpg" hspace="2" vspace="2" /><img src="images/95epay.jpg" hspace="2" vspace="2" /><img src="images/ccnow.jpg" hspace="2" vspace="2" /><img src="images/ctopay.jpg" hspace="2" vspace="2" /><img src="images/gspay.jpg" hspace="2" vspace="2" /><img src="images/ikobo.jpg" hspace="2" vspace="2" /><img src="images/moneybookers.jpg" hspace="2" vspace="2" /><img src="images/moneygram.gif" hspace="2" vspace="2" /><img src="images/nps.jpg" hspace="2" vspace="2" /><img src="images/paypal.gif" hspace="2" vspace="2" /> <img src="images/westernunion.gif" hspace="2" vspace="2" /><img src="images/zgyh.gif" hspace="2" vspace="2" /><img hspace="2" vspace="2" src="images/ips.jpg"> <img hspace="2" vspace="2"  src="images/ttopay.gif"><img src="images/visacard.jpg"  hspace="2" vspace="2"><img  hspace="2" vspace="2" src="images/creditcard2.jpg"></td>
  </tr>
</table>
<?
}
?>
<?
function addItem()
{
global $glo;
$config=$glo["config"];
?>
<form action="?action=add_save" name="formadd" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加支付方式</strong></td>
  </tr>
  
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">支付名称：</td>
    <td width="84%" >
      <input name="name" type="text" id="textfield" size="40" />  </td>
  </tr>
   <tr bgcolor="#FFFFFF"  onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">图片地址：</td>
    <td width="84%" ><img src="images/noimg.gif"  border="0"  vspace="4"  id="imgupload"><br><input name="pic" type="text" id="pic"  size="60"/> </td>
  </tr>
   <tr bgcolor="#FFFFFF" >
     <td align="left">图片选择：</td>
     <td ><a href="javascript:asCallOnePic('payment-pic/creditcard2.jpg','','systemImage/')"><img src="../systemImage/payment-pic/creditcard2.jpg" border="0" align="absmiddle" style="margin-right:5px"></a><a href="javascript:asCallOnePic('payment-pic/visacard.jpg','','systemImage/')"><img src="../systemImage/payment-pic/visacard.jpg" border="0" align="absmiddle"></a><a href="javascript:asCallOnePic('payment-pic/visa_payment.gif','','systemImage/')"><img src="../systemImage/payment-pic/visa_payment.gif" border="0" align="absmiddle"></a></td>
  
   </tr>
   <tr id="tr_upload"  bgcolor="#FFFFFF" >
     <td align="left">&nbsp;</td>
     <td > 
 <script language="javascript">
	 function asCallOnePic(pic,filename,uploadfolder)
	 {
	 	//alert(pic);
		document.getElementById("pic").value = pic ;
		document.getElementById("imgupload").src = "../image.php?pic=" + escape(pic) + "&style=-1&folder=" + escape(uploadfolder);
	 }
	
	 </script>
	 <object id="uploadsystem" name="uploadsystem"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
   </tr>
   <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" class="hide">
    <td width="16%" align="left">域名链接：</td>
    <td width="84%" ><input name="url" type="text"   size="40"/>    </td>
  </tr>
      <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">手续费用：</td>
        <td ><input name="fee" type="text" id="tbprice" value="0" size="6" /> 
        %</td>
      </tr>
      <tr bgcolor="#FFFFFF"  onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">支付接口：</td>
        <td ><select name="interface" onChange="showPaymentAccount(this)" id="interface">
        <option value="">不使用</option>
		<option value="paypal">PAYPAL</option>
		<option value="paypaloff">PAYPAL离线(客户留PAYPAL)</option>
		<option value="paypalto">PAYPAL跳转</option>
		<option value="gspay">GSPAY</option>
		<option value="payease">首信易PAYEASE</option>
		<option value="95epay">95epay</option>
		<option value="ctopay">Ctopay</option>
		<option value="moneybookers">MoneyBookers</option>
		<option value="ips">IPS环迅支付</option>
		<option value="ecpss">ecpss-E汇通</option>
		<option value="ttopay">ttopay</option>
		<option value="yourspay">yourspay</option>
		<option value="fashionpay">fashionpay</option>
		<option value="rppay">rppay</option>
		<option value="wedopay">wedopay</option>
		<option value="99bill">快钱99bill</option>
		</select>
<span class="fontpadding">支付账号：(<span id="payment_account"><span id="span_">无需填写</span><span id="span_paypal" class="hide">Paypal账号：<input name="config18" type="text" value="<?=$config[18]?>" size="30" /></span><span id="span_paypaloff" class="hide">无需填写</span><span id="span_gspay" class="hide">Gspay商户：<input name="config59" type="text" value="<?=$config[59]?>" size="10" /></span><span id="span_payease" class="hide">Payease商户：<input name="config72" type="text" value="<?=$config[72]?>" size="10" /> 
Key：<input name="config73" type="text" value="<?=$config[73]?>" size="30" />
</span><span id="span_95epay" class="hide">95EPAY商户：<input name="config74" type="text" value="<?=$config[74]?>" size="10" /> Key：<input name="config75" type="text" value="<?=$config[75]?>" size="30" /></span><span id="span_ctopay" class="hide">CTOPAY商户：<input name="config76" type="text" value="<?=$config[76]?>" size="10" /> 
Key：<input name="config77" type="text" value="<?=$config[77]?>" size="30" />
</span><span id="span_moneybookers" class="hide">MoneyBookers账号：<input name="config78" type="text" value="<?=$config[78]?>" size="30" /></span><span id="span_ips" class="hide">Ips环迅商户：<input name="config79" type="text" value="<?=$config[79]?>" size="10" /> Key：<input name="config69" type="text" value="<?=$config[69]?>" size="30" /> 1美元=<input name="config302" type="text" value="<?=$config[302]?>" size="10" />人民币
</span><span id="span_ecpss" class="hide">ecpss汇通商户：
<input name="config70" type="text" value="<?=$config[70]?>" size="10" /> Key：<input name="config71" type="text" value="<?=$config[71]?>" size="30" />
</span><span id="span_ttopay" class="hide">ttopay商户：
<input name="config31" type="text" value="<?=$config[31]?>" size="10" /> Key：<input name="config32" type="text" value="<?=$config[32]?>" size="30" />
</span><span id="span_paypalto" class="hide">Paypal：<input name="config34" type="text" value="<?=$config[34]?>" size="20" /> 跳转：
<input name="config33" type="text" value="<?=$config[33]?>" size="30" /></span><span id="span_yourspay" class="hide">Yourspay商户：<input name="config35" type="text" value="<?=$config[35]?>" size="20" /> Key：<input name="config36" type="text" value="<?=$config[36]?>" size="10" /></span><span id="span_fashionpay" class="hide">Fashionpay商户：<input name="config170" type="text" value="<?=$config[170]?>" size="20" /> Key：<input name="config171" type="text" value="<?=$config[171]?>" size="10" />
</span><span id="span_rppay" class="hide">Realpay SiteID：
<input name="config65" type="text" value="<?=$config[65]?>" size="20" /> Key：<input name="config66" type="text" value="<?=$config[66]?>" size="10" /></span> <span id="span_wedopay" class="hide">Wedopay 商户号：
<input name="config68" type="text" value="<?=$config[68]?>" size="10" /> Key：<input name="config86" type="text" value="<?=$config[86]?>" size="20" /></span>

<span id="span_99bill" class="hide">99bill外卡账号：<input name="config296" type="text" value="<?=$config[296]?>" size="20" /> 终端编号：<input name="config297" type="text" value="<?=$config[297]?>" size="10" /></span>
)</span></span></td>
      </tr>
      
      <tr bgcolor="#FFFFFF" class="" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">价格限制：</td>
        <td ><?=$config[90]?> <input name="minprice" type="text" id="minprice" value="0" size="6" /> - <?=$config[90]?> <input name="maxprice" type="text" id="maxprice" value="0" size="6" /> 价格区间内出现 (不需要请填0)</td>
      </tr>
      <tr bgcolor="#FFFFFF" class="hide" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">前台排序：</td>
    <td width="84%" ><input name="sort" type="text"  value="0" size="6" maxlength="6"/>  <span class="red">(当填入数字小于0时候,那么将不会出现在前台订单流程)</span></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td>文本描述：</td>
    <td><textarea name="descript" style="width:700px; height:90px" cols="50" rows="5" id="title"></textarea></td>
  </tr>
      <tr bgcolor="#FFFFFF" >
        <td align="left" valign="top">支付账号：</td>
        <td ><?
		$oFCKeditor = $glo["fck"] ;
		$oFCKeditor->Value = '' ;
		$oFCKeditor->Create() ;
		?></td>
      </tr>
    <tr class="add" bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input type="submit"  onClick="showtips(this)" name="button" id="button"  class="button"  value="提交" /></td>
  </tr>
</table>
</form>
<?
}
?>

<?
function editItem()
{
global $glo;
$config=$glo["config"];
$id=getQuerySQL("id");
$sql="select * from @@@payment where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
?>
<form name="formedit" action="?action=edit_save&id=<?=$id?>" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑支付方式</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">支付名称：</td>
    <td width="84%" ><input name="name" type="text" value="<?=$rows["name"]?>" size="40"/>    </td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  >
    <td width="16%" align="left">图片地址：</td>
    <td width="84%" ><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>"   id="imgupload" vspace="4" /><br>
<input name="pic" type="text" id="pic"   value="<?=$rows["pic"]?>" size="60"/>  </td>
  </tr>
   <tr bgcolor="#FFFFFF" >
     <td align="left">图片选择：</td>
     <td ><a href="javascript:asCallOnePic('payment-pic/creditcard2.jpg','','systemImage/')"><img src="../systemImage/payment-pic/creditcard2.jpg" border="0" align="absmiddle" style="margin-right:5px"></a><a href="javascript:asCallOnePic('payment-pic/visacard.jpg','','systemImage/')"><img src="../systemImage/payment-pic/visacard.jpg" border="0" align="absmiddle"></a><a href="javascript:asCallOnePic('payment-pic/visa_payment.gif','','systemImage/')"><img src="../systemImage/payment-pic/visa_payment.gif" border="0" align="absmiddle"></a></td>
   </tr>
  <tr bgcolor="#FFFFFF" >
     <td align="left"><? $path_parts = pathinfo( $rows["pic"] );
	$todir = $path_parts["dirname"] ; 
	$todir = dataDefault($todir,strftime("%Y-%m-%d-%H",time()));
	?></td>
     <td >
	 <script language="javascript">
	 function asCallOnePic(pic,filename,uploadfolder)
	 {
	 	//alert(pic);
		document.getElementById("pic").value = pic ;
		document.getElementById("imgupload").src = "../image.php?pic=" + escape(pic) + "&style=-1&folder=" + escape(uploadfolder);
	 }
	 </script>
	 <object id="uploadsystem" name="uploadsystem"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object>

</td>
   </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  class="hide">
    <td width="16%" align="left">域名链接：</td>
    <td width="84%" ><input name="url" type="text"  value="<?=$rows["url"]?>" size="40"/>    </td>
  </tr>
    <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">手续费用：</td>
        <td ><input name="fee" type="text" value="<?=$rows["fee"]?>" id="tbprice" size="6" />
        %</td>
    </tr>
      <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">支付接口：</td>
        <td ><select id="interface" name="interface"  onChange="showPaymentAccount(this)" >
        <option value="">不使用</option>
		<option value="paypal">PAYPAL</option>
		<option value="paypaloff">PAYPAL离线(客户留PAYPAL)</option>
		<option value="paypalto">PAYPAL跳转</option>
		<option value="gspay">GSPAY</option>
		<option value="payease">首信易PAYEASE</option>
		<option value="95epay">95epay</option>
		<option value="ctopay">Ctopay</option>
		<option value="moneybookers">MoneyBookers</option>
		<option value="ips">IPS环迅支付</option>
		<option value="ecpss">ecpss-E汇通</option>
		<option value="ttopay">ttopay</option>
		<option value="yourspay">yourspay</option>
		<option value="fashionpay">fashionpay</option>
		<option value="rppay">rppay</option>
		<option value="wedopay">wedopay</option>
		<option value="99bill">快钱99bill</option>
		</select><span class="fontpadding">支付账号：(<span id="payment_account"><span id="span_" class="hide">无需填写</span><span id="span_paypal" class="hide">Paypal账号：<input name="config18" type="text" value="<?=$config[18]?>" size="30" /></span><span id="span_paypaloff" class="hide">无需填写</span><span id="span_gspay" class="hide">Gspay商户：<input name="config59" type="text" value="<?=$config[59]?>" size="10" /></span><span id="span_payease" class="hide">Payease商户：<input name="config72" type="text" value="<?=$config[72]?>" size="10" /> 
Key：<input name="config73" type="text" value="<?=$config[73]?>" size="30" />
</span><span id="span_95epay" class="hide">95EPAY商户：<input name="config74" type="text" value="<?=$config[74]?>" size="10" /> Key：<input name="config75" type="text" value="<?=$config[75]?>" size="30" /></span><span id="span_ctopay" class="hide">CTOPAY商户：<input name="config76" type="text" value="<?=$config[76]?>" size="10" /> 
Key：<input name="config77" type="text" value="<?=$config[77]?>" size="30" />
</span><span id="span_moneybookers" class="hide">MoneyBookers账号：<input name="config78" type="text" value="<?=$config[78]?>" size="30" /></span><span id="span_ips" class="hide">Ips环迅商户：<input name="config79" type="text" value="<?=$config[79]?>" size="10" /> Key：<input name="config69" type="text" value="<?=$config[69]?>" size="30" /> 1美元=<input name="config302" type="text" value="<?=$config[302]?>" size="10" />人民币
</span><span id="span_ecpss" class="hide">ecpss汇通商户：
<input name="config70" type="text" value="<?=$config[70]?>" size="10" /> Key：<input name="config71" type="text" value="<?=$config[71]?>" size="30" />
</span><span id="span_ttopay" class="hide">ttopay商户：
<input name="config31" type="text" value="<?=$config[31]?>" size="10" /> Key：<input name="config32" type="text" value="<?=$config[32]?>" size="30" />
</span><span id="span_paypalto" class="hide">Paypal：<input name="config34" type="text" value="<?=$config[34]?>" size="20" /> 跳转：
<input name="config33" type="text" value="<?=$config[33]?>" size="30" /></span><span id="span_yourspay" class="hide">Yourspay商户：<input name="config35" type="text" value="<?=$config[35]?>" size="20" /> Key：<input name="config36" type="text" value="<?=$config[36]?>" size="10" /></span><span id="span_fashionpay" class="hide">Fashionpay商户：<input name="config170" type="text" value="<?=$config[170]?>" size="20" /> Key：<input name="config171" type="text" value="<?=$config[171]?>" size="10" />
</span><span id="span_rppay" class="hide">Realpay SiteID：
<input name="config65" type="text" value="<?=$config[65]?>" size="10" /> Key：<input name="config66" type="text" value="<?=$config[66]?>" size="20" /></span><span id="span_wedopay" class="hide">Wedopay 商户号：
<input name="config68" type="text" value="<?=$config[68]?>" size="10" /> Key：<input name="config86" type="text" value="<?=$config[86]?>" size="20" /></span>

<span id="span_99bill" class="hide">99bill外卡账号：<input name="config296" type="text" value="<?=$config[296]?>" size="20" /> 终端编号：<input name="config297" type="text" value="<?=$config[297]?>" size="10" /></span>
)</span></span>
		<script language="javascript">
		EnterSelect("interface","<?=$rows["interface"]?>");
		$('#span_<?=$rows["interface"]?>').css("display","inline-block")
		</script>
        </td>
      </tr>
       <tr bgcolor="#FFFFFF" class="" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">价格限制：</td>
        <td ><?=$config[90]?> <input name="minprice" type="text" id="minprice" value="<?=$rows["minprice"]?>" size="6" /> - <?=$config[90]?> <input name="maxprice" type="text" id="maxprice" value="<?=$rows["maxprice"]?>" size="6" /> 价格区间内出现 (不需要请填0)</td>
      </tr>
    <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">前台排序：</td>
    <td width="84%" ><input name="sort" type="text"  value="<?=$rows["sort"]?>" size="6" maxlength="6"/> <span class="red">(当填入数字小于0时候,那么将不会出现在前台订单流程)</span></td>
  </tr> <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td>支付说明：</td>
    <td><textarea name="descript" style="width:700px; height:90px" id="title"><?=$rows["descript"]?></textarea></td>
  </tr>
      <tr bgcolor="#FFFFFF">
        <td align="left" valign="top">支付账号：</td>
        <td >
		<?
		$oFCKeditor = $glo["fck"] ;
		$oFCKeditor->Value = $rows["content"] ;
		$oFCKeditor->Create() ;
		?>		</td>
      </tr>
	  
      <tr class="edit" bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input  class="button"  onClick="showtips(this)" name="button2" type="submit" value="修改" /></td>
  </tr>
</table>
</form>
<?
free($rs);
}
?>

<?
function delete_save()
{
	global $cfg;
	$id=getQuerySQL("id");
	$sql="delete from @@@payment where id=$id";
	if( strpos(fetchPic("@@@payment",$id),"payment-pic") === false )
		deleteImage( fetchPic("@@@payment",$id) , $cfg["deleteImageAll"] , "../systemImage/",0 );
	
	query($sql);
	pageRedirect("2","a_payment.php");
}

function add_save()
{
	global $config;
	global $cfg;
	$param["name"]=getForm("name");
	$param["sort"]=getForm("sort");
	$param["url"]=getForm("url");
	$param["pic"]=getForm("pic");
	$param["minprice"]=getFormInt("minprice",0,false);
	$param["maxprice"]=getFormInt("maxprice",0,false);
	$param["fee"]=getFormInt("fee",0,false);
	$param["descript"]=getForm("descript");
	$param["content"]=getHTML("content");
	$param["interface"]=getForm("interface");
	$sql=insertSQL($param,"@@@payment");
	//debug($sql);
	query($sql);
	$param=array();
	$param["sort"]="@id";
	$condition = "where id=" . mysql_insert_id();
	$sql=updateSQL($param,"@@@payment",$condition);
	query($sql);
	//-------账号
	$param=array();
	$condition="where id=1";
	for($indexI=0;$indexI<1023;$indexI++)
	{
		$config[$indexI]=$config[$indexI];
	}
	
	$arraccount=array(18,59,72,73,74,75,76,77,78,79,69,70,71,31,32,33,34,35,36,170,171,65,66,68,86,296,297,302);
	for($index=0;$index<count($arraccount);$index++)
	{
		$config[$arraccount[$index]] = getForm("config".$arraccount[$index]);
		//print_r($config[$arraccount[$index]]);
	}
	ksort($config);
	$param["content"]=join( $cfg["split"] , $config ) ;
	$sql=updateSQL( $param,"@@@config",$condition );
	//debug($config);
	query($sql);
	pageRedirect("0","a_payment.php");
}

function edit_save()
{
	global $cfg;
	global $config;
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["name"]=getForm("name");
	$param["sort"]=getForm("sort");
	$param["url"]=getForm("url");
	$param["pic"]=getForm("pic");
	$param["descript"]=getForm("descript");
	$param["interface"]=getForm("interface");
	$oldpic = fetchPic("@@@payment",$id);
	if( $oldpic != getForm("pic") )
	{
		deleteImage( $oldpic , $cfg["deleteImageAll"] , "../systemImage/",0 );
	}
	
	$param["fee"]=getFormInt("fee",0,false);
	$param["minprice"]=getFormInt("minprice",0,false);
	$param["maxprice"]=getFormInt("maxprice",0,false);
	$param["content"]=getHTML("content");
	$sql=updateSQL($param,"@@@payment",$condition);
	query($sql);
	//-------账号
	$param=array();
	$condition="where id=1";
	for($indexI=0;$indexI<1023;$indexI++)
	{
		$config[$indexI]=$config[$indexI];
	}
	
	$arraccount=array(18,59,72,73,74,75,76,77,78,79,69,70,71,31,32,33,34,35,36,170,171,65,66,68,86,296,297,302);
	for($index=0;$index<count($arraccount);$index++)
	{
		$config[$arraccount[$index]] = getForm("config".$arraccount[$index]);
		//print_r($config[$arraccount[$index]]);
	}
	ksort($config);
	$param["content"]=join( $cfg["split"] , $config ) ;
	$sql=updateSQL( $param,"@@@config",$condition );
	//debug($config);
	query($sql);
	pageRedirect("1","a_payment.php");
}
?>
<?php require("php_bottom.php")?>
</body>
</html>
