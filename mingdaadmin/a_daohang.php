<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站管理</title>
</head>

<body>
<style>
.marginbottom{ margin-bottom:15px}
</style>
<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">网站管理</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="a_daohang.php">网站管理</a></td>
  </tr>
</table><br />

  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>你想做什么呢？</strong></td>
  </tr>
    <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >后台账户设置：</td>
    <td ><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a class="red" href="a_admin.php">账户管理</a> <a href="a_log.php">登录日记</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">设置管理员的账号。</span></td>
  </tr>
   <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td  width="20%">修改广告或者LOGO：</td>
    <td width="80%"><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_advertisement.php">广告上传</a> <a href="a_advertisement.php?action=editad&id=2">Logo上传</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">设置网站的LOGO,广告,Favicon.ico的上传</span></td>
  </tr>
   <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >SEO设置：</td>
    <td ><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_seo.php">SEO设置</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">设置首页,产品分类页等页面的标题，关键字，描述的SEO模板</span></td>
  </tr>
   <tr class=""   onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >内置BLOG：</td>
    <td ><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_blog.php">Blog设置</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">设置网站内置的BLOG，开启以及搬家（更换域名时候）的功能</span></td>
  </tr>
  <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td  width="20%">杂项配置：</td>
    <td width="80%"><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_config.php">杂项配置</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">设置屏蔽国内访问，产品显示个数，时区，货币等配置</span></td>
  </tr>
   <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >文字区域或者页面特定：</td>
    <td ><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_infoclass.php">页面设置</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">设置Contact us等特殊页面以及页面一些可后台修改的特定区域</span></td>
  </tr>
   <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >Paypal,信用卡等支付设置：</td>
    <td ><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_payment.php">支付管理</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">设置在下单过程，Paypal,第三方支付接口等支付方式的手续费.</span></td>
  </tr>
  <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >EMS,DHL等运费设置：</td>
    <td ><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_express.php">配送管理</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">设置在下单过程，EMS,DHL,UPS,Fedex等配送方式的价格等</span></td>
  </tr>
   
   <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >EMS,DHL配送区域：</td>
    <td ><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_deliveryarea.php">配送区域</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">设置EMS,DHL,UPS,Fedex的派送区域</span></td>
  </tr>
   
  
 
  <tr    class=""   onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >下订单，注册等邮件转发：</td>
    <td ><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_email.php">邮件转发</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">设置在下单,注册，留言等邮件转发的内容以及账号设置等</span></td>
  </tr>
   
   <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >会员注册国家设置：</td>
    <td ><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_country.php">国家设置</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">设置会员在注册或者下单过程中，国家的排列顺序</span></td>
  </tr>
   <tr class="hide"    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >优惠活动：</td>
    <td ><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_discount.php">优惠活动</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">设置一些常见的优惠活动，最小订单，运费清0，批发打折，等。</span></td>
  </tr>
   <tr class="hide"    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >优惠券：</td>
    <td ><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_coupon.php">优惠券码</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">管理优惠券列表功能等。</span></td>
  </tr>
</table>


<script language="javascript">

function testEmail()
{
	var src="../service/serviceForcheckEmailConfig.php";
	includeJsFile("Ajax_change",src) 
}
</script>


<?php require("php_bottom.php");?>
</body>
</html>