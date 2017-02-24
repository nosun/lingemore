<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SEO设置</title>
</head>

<body>

<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">SEO设置</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">SEO设置</a><span class="fontpadding"><a href="?action=sitemap">Sitemap与404 Page</a></span><span class="fontpadding"><a href="?action=robots">屏蔽收录</a></span><span class="fontpadding"><a href="?action=submit_url">提交收录</a></span></td>
  </tr>
</table><br />
<?php
isAuthorize($group[2]);
$action=getQuery("action");
switch($action)
{
case "edit":
	editItem();
	break;
case "show_config":
	show_config();
	break;
case "sitemap":
	show_sitemap();
	break;
case "create_xml":
	create_xml();
	break;
case "config_save":
	config_save();
	break;
case robots_content_save:
	robots_content_save();
	break;
case "submit_url":
	submit_url();
	break;
case "edit_save":
	edit_save();
	break;
case "robots":
	show_robots_content();
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
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td  >1. 为你的商店取一个响亮的名字吧，设置 <a href="?action=show_config">商店名称</a>。例：Wholesale - Buy China Wholesale Products  on xxx.com<br>
    2. 针对不同的页面进行默认的标题,关键字,描述的模板进行设置。 </td>
  </tr>
</table><br>

<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="4"  bgcolor="#F2F4F6"><strong>默认SEO模板设置</strong></td>
  </tr>

  <tr align="center" bgcolor="#FFFFE9">
    <td width="7%" align="center">ID</td><td width="7%">操作</td>
    <td align="left">名称</td>
    
  </tr>  <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
      <td align="center">0</td><td><a href="?action=show_config">设置</a> </td>
      <td align="left">商店名称</td>
  <?
  $sql="select * from @@@seo";
  $rs=query($sql);
  emptyList($rs,4);
  while($rows=fetch($rs))
  {
  ?>
    <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
      <td align="center"><?=$rows["id"]?></td><td><a href="?action=edit&id=<?=$rows["id"]?>">设置</a> </td>
      <td align="left"><?=$rows["name"]?></td>
    
  </tr>
 <?
 }
 free($rs);
 ?>
</table>
<?
}
?>
<?
function show_config()
{
global $config;
?><form name="formadd" action="?action=config_save" enctype="application/x-www-form-urlencoded" method="post">
<table  border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>商店名称</strong></td>
  </tr>
  
  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td>变量</td>
    <td>{VAR_domain} 网站域名</td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td width="230">商店名称：</td>
    <td><textarea name="config63" style="width:700px; height:70px"><?=$config[63]?></textarea> </td>
  </tr>
   <tr  bgcolor="#FFFFE9">
    <td  align="left">&nbsp;</td>
    <td  ><input type="submit"  class="button"  name="button" id="button" value="提交" onClick="showtips(this)" /></td>
  </tr>
  </table></form>
<?
}
?>
<?
function show_sitemap()
{
?>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td  >1. Sitemaps就是网站上所有网页的列表。创建并提交 Sitemap 有助于确保搜索引擎知道您网站上的所有网页，加速网页的查找。<br>
2. <a href="http://www.google.com/support/webmasters/bin/answer.py?hl=cn&answer=156184&from=40318&rd=1" target="_blank">点击这里查看Google关于sitemaps重要性的描述。</a><br>
3. 只要遵循Sitemap标准的搜索引擎都可以使用此Sitemaps。<br>
4. 当您有新的分类上架， 请点击下方按钮来更新sitemap.xml。
</td>
  </tr>
</table><br><form name="form2" method="post" action="?action=create_xml">
<table  border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>Sitemap 与 404 page </strong></td>
  </tr>
  
  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td>404 页面地址： </td>
    <td><a href="../404.html" target="_blank"> /404.html</a></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td width="230">Sitemap地址：</td>
    <td><a href="http://<?=$_SERVER['SERVER_NAME'].FOLDER?>sitemap.xml" target="_blank">http://<?=$_SERVER['SERVER_NAME'].FOLDER?>sitemap.xml</a></td>
  </tr>
   <tr  bgcolor="#FFFFE9">
    <td  align="left">&nbsp;</td>
    <td  ><input name=""  class="button"   value="生成Sitemap.xml" type="submit"></td>
  </tr>
  </table></form>
<?
}
?>
<?
function submit_url()
{
?>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td  >1.新站一般等框架确定下来，导航栏目以及首页关键词确定好了,网站内容更新完善了再提交。<br>
    2.确保网站Robots.txt 没有限制收录。<a href="?action=robots">点击查看</a><br>
3.可以了解SEO数据变化,使用 <a target="_blank" href="http://tool.chinaz.com/">站长工具</a></td>
  </tr>
</table><br>
<table  border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>提交地址</strong></td>
  </tr>
  
  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td>谷歌Google 提交入口： </td>
    <td><a href="http://www.google.com/addurl" target="_blank">http://www.google.com/addurl</a></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td width="230">必应 Bing 提交入口：</td>
    <td><a href="https://ssl.bing.com/webmaster/SubmitSitePage.aspx" target="_blank">https://ssl.bing.com/webmaster/SubmitSitePage.aspx</a></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td width="230">更多网站 提交入口：</td>
    <td><a href="http://www.freewebsubmission.com/" target="_blank">http://www.freewebsubmission.com/</a></td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td width="230">SEO工具 - 站长工具：</td>
    <td><a href="http://tool.chinaz.com/" target="_blank">http://tool.chinaz.com/</a></td>
  </tr>
  </table>
<?
}
?>
<?
function editItem()
{
global $glo;
global $supper;
$id=getQuerySQL("id");
$sql="select * from @@@seo where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
?><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td  >注意：若没有针对每个产品或者新闻进行设置，那么将使用 <strong>SEO模板默认值</strong></td>
  </tr>
</table>
<br>
<form name="formedit" action="?action=edit_save&id=<?=$id?>" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑SEO模板</strong></td>
  </tr>
  <tr  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">页面名称：</td>
    <td width="84%" ><?=$rows["name"]?></td>
  </tr>
      <tr bgcolor="#FFFFFF">
        <td align="left" valign="top">环境变量：</td>
        <td ><? if($supper==9){?><textarea name="varcontent" style="width:700px; height:70px"><?=$rows["varcontent"]?></textarea>
		<?
		}
		else
		{
		?>
		<?=nl2br($rows["varcontent"])?>
		<?
		}
		?>
		</td>
      </tr>
	  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >标题 Title：</td>
    <td ><textarea name="title" style="width:700px; height:70px"><?=$rows["title"]?></textarea></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>关键字 Keyword：</td>
    <td><textarea name="keywords" style="width:700px; height:70px"><?=$rows["keywords"]?></textarea></td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>描述 Description：</td>
    <td><textarea name="descript" style="width:700px; height:70px"><?=$rows["descript"]?></textarea></td>
  </tr>
<tr class="edit" bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input name="button2"  class="button"  type="submit" value="修改"  onClick="showtips(this)"/></td>
  </tr>
</table>
</form>
<?
free($rs);
}
?>
<?
function show_robots_content()
{
?>
<form name="formedit" action="?action=robots_content_save" enctype="application/x-www-form-urlencoded" method="post">
<table  border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>Robots.txt</strong></td>
  </tr>
  
  <tr  bgcolor="#FFFFFF" >
    <td valign="top">屏蔽访问：</td>
    <td>加上<br>
      User-agent: *<br>
        Disallow: /<br>
        可以屏蔽收录，去掉后可恢复收录</td>
  </tr>
  <tr  bgcolor="#FFFFFF" >
    <td  width="16%" valign="top">文件内容： </td>
    <td width="84%"><textarea name="content" style="width:700px; height:350px"><?=file_get_contents("../robots.txt")?></textarea></td>
  </tr>
  <tr   bgcolor="#FFFFFF" >
    <td>更多Robotx.txt用法：</td>
    <td><a href="http://www.clickability.co.uk/robotstxt.html" target="_blank">http://www.clickability.co.uk/robotstxt.html</a></td>
  </tr>
   <tr  bgcolor="#FFFFE9">
    <td  align="left">&nbsp;</td>
    <td  ><input name=""  class="button"  value="保存Robots.txt" type="submit"></td>
  </tr>
  </table>
</form>
<?
}
?>
<?

function edit_save()
{
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["title"]=getForm("title");
	$param["keywords"]=getForm("keywords");
	$param["descript"]=getForm("descript");
	if( getForm("varcontent")!="" )
		$param["varcontent"]=getForm("varcontent");
	$sql=updateSQL($param,"@@@seo",$condition);
	query($sql);
	pageRedirect("1","a_seo.php");
}

function robots_content_save()
{
	file_put_contents("../robots.txt", getHTML("content") );
	pageRedirect("1","a_seo.php?action=robots");
}

function create_xml()
{
	$str_url = "http://".$_SERVER['SERVER_NAME'] .  FOLDER . "sitemap.php?file=".urlencode("lay_sitemap.xml") ;
	$html = getRemoteData($str_url,"","",60);
	file_put_contents("../sitemap.xml", $html );
	pageRedirect("1","a_seo.php?action=sitemap");
}

function config_save()
{
	global $cfg;
	global $config;
	//-------账号
	$param=array();
	$condition="where id=1";
	for($indexI=0;$indexI<1023;$indexI++)
	{
		$config[$indexI]=$config[$indexI];
	}
	
	$config[63] = getForm("config63") ;
	ksort($config);
	$param["content"]=join( $cfg["split"] , $config ) ;
	$sql=updateSQL( $param,"@@@config",$condition );
	//debug($config);
	query($sql);
	pageRedirect("1","a_seo.php?action=show_config");
}
?>
<?php require("php_bottom.php");?>

</body>
</html>
