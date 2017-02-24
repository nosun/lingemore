<?
require("../inc/php_inc.php");
if( $_SESSION["admin"]=="" )
	die("请登录");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>menu</title>

<link href="Style/css_menu.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<script language="javascript">


function getObject(objectId) {
 if(document.getElementById && document.getElementById(objectId)) {
 // W3C DOM
 return document.getElementById(objectId);
 }
 else if (document.all && document.all(objectId)) {
 // MSIE 4 DOM
 return document.all(objectId);
 }
 else if (document.layers && document.layers[objectId]) {
 // NN 4 DOM.. note: this won't find nested layers
 return document.layers[objectId];
 }
 else {
 return false;
 }
}

function showHide(objname){
    var obj = getObject(objname);
    if(obj.style.display == "none"){
		obj.style.display = "block";
		
	}else{
		obj.style.display = "none";
	}
}
</script>
<base target="main">
<body>
<div class="menu">
<dl>
    <dt><a href="###" onclick="showHide('items1');" target="_self">网站设置</a></dt>
    <dd id="items1" style="display:block;">
			<ul>
<li><a href='a_index_body.php' target='main'>网站状态</a></li>
<li><a href='a_password.php' target='main'>修改密码</a></li>
<li><a href='a_daohang.php' target='main'>系统配置<img src="images/config.gif" hspace="22" vspace="5" border="0" align="absmiddle" /></a></li>
<li><a href='a_shujuwajue.php' target='main'>数据分析<img src="images/tongji.gif" hspace="22" vspace="5" border="0"  align="absmiddle" /></a></li>
<!--<li><a href='a_link.php' target='main'>友情链接</a></li>-->
  			</ul>
		</dd>
<dt><a href="###" onclick="showHide('items3');" target="_self">业务管理</a></dt>
    <dd id="items3" >
	<ul>

<li><a href='a_order.php' target='main'>订单管理<img src="images/order.gif" hspace="22" vspace="5" border="0"  align="absmiddle" /></a></li>
<li><a href='a_user.php' target='main'>会员管理<img src="images/group.gif" hspace="22" vspace="5" border="0"  align="absmiddle" /></a></li>
<li><a href='a_message.php' target='main'>留言管理<img src="images/message.gif" hspace="22" vspace="5" border="0"  align="absmiddle" /></a></li>
  </ul>
</dd>
    		

<dt><a href="###" onclick="showHide('items2');" target="_self">信息管理</a></dt>
    <dd id="items2" >
			<ul>

<li><a href='a_product.php' target='main'>商品管理<img src="images/goods.gif" hspace="22" vspace="5" border="0"  align="absmiddle" /></a></li>
<li><a href='a_productclass.php' target='main'>商品分类</a></li>
<li><a href='a_propertyclass.php' target='main'>商品属性</a></li>
<li><a href='a_news.php' target='main'>新闻管理</a></li>
<li><a href='a_newsclass.php' target='main'>新闻分类</a></li>

			</ul>
	</dd>  


		
	</dl><!-- Item 2 End -->
<!-- Item 17 Strat -->



</div>
</body>
</html>
