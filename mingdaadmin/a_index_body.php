<? require("php_admin_include.php");?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎使用中恒天下网站管理系统</title>
</head>
<style>
.style2{ color:#FF0000; font-weight:bold}
</style>
<body>
<?php 
require("php_top.php") ;
$arr = gethostbynamel($_SERVER['SERVER_NAME']) ;
$gdinfo    = gd_info();   
$gdversion = $gdinfo['GD Version'];  
?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">网站状态</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" >
  <tr  bgcolor="#F2F4F6">
    <td >
	  <a href="a_index_body.php">网站状态</a></td>
  </tr>
</table>
<br>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td ><input name=""  class="button"   onClick="location.href='a_config.php?action=clean'" value="更新服务器缓存" type="button"> (当修改过分类或者商品推荐的时候，退出时候进行更新) </td>
  </tr>
</table>


<br><table align="center" width="96%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" style="padding-right:13px" valign="top"><table width="100%" border="0"  cellpadding="1" cellspacing="1" class="tbtitle">
		<tr>
				<td bgcolor="#F2F4F6"><strong>服务信息</strong></td>
		</tr>
		
		<tr>
		  <td bgcolor="#FFFFFF" >软件著作：<a target="_blank" href="http://www.35zh.com/company.html">厦门中恒天下网络科技有限公司所有</a></td>
  </tr>
  <tr>
		  <td bgcolor="#FFFFFF" >投诉电话：0592-5950110</td>
  </tr>
		<tr>
		  <td bgcolor="#FFFFFF" >技术支持：<strong>厦门中恒天下网络科技有限公司</strong>（<a href="http://35zh.com/" target="_blank">35zh.com</a>）  </td>
  </tr>
</table><br>
<iframe id="iframeSRC" scrolling="no" frameborder="0" height="155" width="100%"></iframe><br>
<br>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
		<tr>
				<td width="78%" bgcolor="#F2F4F6"><strong>系统信息</strong></td>
		</tr>
		<tr>
		  <td bgcolor="#FFFFFF" >版本号：<span style="color:#FF0000; padding-left:10px; font-weight:bold">Biz-shop 3.1.2 </span>( UTF-8版本 )</td>
  </tr>
		<tr>
		  <td bgcolor="#FFFFFF" >服务器IP：<?=$arr[0]?> <span style="color:#FF0000; padding-left:10px">(<script src="http://open.35zh.com/cgi-bin/?do=iptocountry&ip=<?=$arr[0]?>&type=2"></script>)</span></td>
  </tr>
  <tr>
		  <td bgcolor="#FFFFFF" >服务器软件：<?=$_SERVER["SERVER_SOFTWARE"]?> <span class="fontpadding">操作系统：<?=PHP_OS;?></span></td>
  </tr>
  
  <tr>
		  <td bgcolor="#FFFFFF" >MySQL 版本：<?=mysql_get_server_info(); ?></td>
  </tr>
  
  <tr>
		  <td bgcolor="#FFFFFF" >GD 版本：<?=$gdversion?></td>
  </tr>
</table></td>
    <td width="50%" valign="top" style="border:1px #dddddd solid"><iframe frameborder="0" scrolling="no" src=" http://v.t.qq.com/show/show.php?n=chengj&w=0&h=515&fl=1&l=30&o=1&c=4&si=babf5c8021e3c716cb5cc86db9b7a2034bf59add&cs=D1D1C3_F2F4F6_000000_E3E6EB" width="100%" height="490"></iframe></td>
  </tr>
</table>


<script language="javascript">
function includeJsFile(id,src)
{
	var scriptTag = document.getElementById( id ); 
    var oHead = document.getElementsByTagName('HEAD')[0];
    while (tempScript = document.getElementById(id)) 
	{
		tempScript.parentNode.removeChild(tempScript);
		for (var prop in tempScript) 
		{
		  try
		  {
		  	delete tempScript[prop];
		  }
		  catch(e)
		  {
		  
		  }
		}
    }
    var oScript= document.createElement("script");
	oScript.id = id;
	oScript.charset='utf-8';
    oScript.type = "text/javascript"; 
    oScript.src=src;
    oHead.appendChild( oScript);
}
var src="http://oa.uio.cc/Service/serviceForWritePhp.asp?domain="+ location.hostname;
includeJsFile("AJax_Script_Request",src);
document.getElementById("iframeSRC").src = "http://open.35zh.com/cgi-bin/?do=iframe&domain="+ location.hostname;
</script>
<?php require("php_bottom.php")?></body>
</html>
