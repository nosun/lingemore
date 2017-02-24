<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据分析</title>
</head>

<body>
<style>
.marginbottom{ margin-bottom:15px}
</style>
<?php require("php_top.php");
isAuthorize($group[4]);
?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">数据分析</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="a_shujuwajue.php">数据分析</a><span class="fontpadding"><a href="a_cleanreport.php">数据清空</a></span></td>
  </tr>
</table><br />

  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>你想知道你网站的哪些数据统计呢？</strong></td>
  </tr>
   <tr    bgcolor="#FFFFFF">
    <td  width="20%">产品订购排行：</td>
    <td width="80%"><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_orderproduct.php">销售排行</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">查看以及分析我的订单产品每个季度的订购量以及转化率</span></td>
  </tr>
    <tr   bgcolor="#FFFFFF">
    <td >搜索关注排行：</td>
    <td ><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_searchlog.php">搜索词关注</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">我的客户都在我的网站搜索什么产品呢？</span></td>
  </tr>
  <tr    bgcolor="#FFFFFF">
    <td  width="20%">分类关注排行：</td>
    <td width="80%"><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_categorylog.php">分类关注度</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">分析网站上我的产品分类的关注度</span></td>
  </tr>
  <tr   bgcolor="#FFFFFF">
    <td  width="20%">产品关注排行：</td>
    <td width="80%"><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_productlog.php">产品关注度</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">分析网站上我的产品关注度</span></td>
  </tr>
   <tr    bgcolor="#FFFFFF">
    <td  width="20%">市场分布排行：</td>
    <td width="80%"><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_tjorder.php">市场分析</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">分析我的订单在全球200多个国家的分布</span></td>
  </tr>
   <tr    bgcolor="#FFFFFF">
    <td  width="20%">营销时间统计：</td>
    <td width="80%"><span style="display:inline-block; width:220px">从这里进入&gt;&gt; <a href="a_timeorder.php">营销统计</a></span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">分析统计年度里每月的订单总额，实际下单总额等</span></td>
  </tr>
</table>
<br>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">
  <tr>
    <td bgcolor="#F2F4F6"><strong>流量统计</strong></td>
  </tr>
   <tr    bgcolor="#FFFFFF">
    <td ><a href="http://www.cnzz.com/" target="_blank"><img src="images/cnzz_log.gif" hspace="3" vspace="3" border="0"></a><a href="http://tongji.baidu.com/hm-web/welcome/login" target="_blank"><img src="images/baidu_logo.gif" hspace="3" vspace="3" border="0"></a><a href="http://www.google.com/analytics/" target="_blank"><img src="images/analytics_logo.gif" hspace="3" vspace="3" border="0"></a><a href="http://www.51.la/" target="_blank"><img src="images/51la_logo.gif" hspace="3" vspace="3" border="0"></a></td>
  </tr>
</table>

<?php require("php_bottom.php");?>
</body>
</html>