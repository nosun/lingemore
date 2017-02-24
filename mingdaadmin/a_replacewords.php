<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>优化词库</title></head>
<body>
<script language="javascript">
function changeImage(path)
{
	document.getElementById("imgupload").src=path;
}
</script>
<?php require("php_top.php")?>
<script language="javascript">
function changeNextValue(id,obj)
{
	var obj2 = document.getElementById("pnumpre"+id);
	if(obj2)
	{
		obj2.value = obj.value;
	}
	var objdiv = document.getElementById("pifadiv"+id);
	if(objdiv)
	{
		objdiv.style.display="block";
		
	}
}
</script>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">优化词库</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">优化词库</a><span class="fontpadding"><a class="add" href="?action=add">添加词库</a></span></td>
  </tr>
</table><br>

<?php
isAuthorize($group[2]);
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
global $config;
?>
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="6"  bgcolor="#F2F4F6"><strong>优化词库</strong><span class="fontpadding2">带 <img src="images/qianbi.gif"  align="absmiddle"> 的列可<span class="red weight">"直接点击格子修改"</span></span></td>
  </tr>

  <tr align="center" bgcolor="#FFFFE9">
    <td width="4%" align="center">ID</td>
    <td width="11%" align="left">名称</td>
    <td width="75%" align="left">词库内容<img src="images/qianbi.gif"  align="absmiddle"></td>
    <td width="10%">操作</td>
  </tr>
  <?
  $condition="where 1=1" ;
$pageurl="1=1" ;
  $pagenow=getQueryInt("page");
	$pagesize=getRequestDefault("size",20);
	$rs=createPage("*","@@@replacewords",$condition,$orderby,$pagesize,$pagenow,$pagetotal,$recordcount);
  emptyList($rs,4);
  while($rows=fetch($rs))
  {
  ?>
    
    <tr align="center" bgcolor="#FFFFFF"  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
      <td align="center"><?=$rows["id"]?></td>
      <td align="left"><a href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a></td>
       <td  align="left" class="point a_fen" id="content<?=$rows["id"]?>" ><?=$rows["content"]?></td>
      <td><a href="?action=edit&id=<?=$rows["id"]?>">编辑</a> <a class="delete red" onClick="return confirm('确定要删除吗？')"  href="?action=delete_save&id=<?=$rows["id"]?>">删除</a></td>
  </tr>
   <script language="javascript">
  $("#content<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@replacewords','content',<?=$rows["id"]?>,0,70)}); 
  </script>
 <?
 }
 free($rs);
 ?>
   <tr bgcolor="#FFFFE9">
    <td colspan="8" align="right" ><? require("php_page.php")?></td>
  </tr>
</table>
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="6"  bgcolor="#F2F4F6"><strong>使用优化词库的使用</strong></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" align="left">
	1. 使用优化词库，将不至于是你的产品名称重复性太高。更利于SEO优化。<br>
1. 例如在 批量添加产品 或者 批量编辑产品 ！<br>
ID = 1 : 帽子  词库内容 hat,cap,headgear<br>
ID = 2 : 质量好的  词库内容good,great,nice,best<br>
输入产品名称输入：<img align="absmiddle" src="images/words_example.jpg"><br>
则产品名称可能出现 hat backhams great in stock 或者 cap backhams nice in stock等等
</td>
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
<form name="formadd" action="?action=add_save" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加替换词库</strong></td>
  </tr>
  
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">词库标识：</td>
    <td width="84%" >
      <input name="name" type="text" id="textfield" size="40" /> 
      例如 帽子 </td>
  </tr>
   
      <tr bgcolor="#FFFFFF" >
        <td align="left" valign="top">词库内容：</td>
        <td ><textarea name="content" cols="100" rows="10" id="title"></textarea>
        <br>
        词库内容用英文的逗号 , 隔开 例如: hat,cap,headgear</td>
      </tr>
    <tr class="add" bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input type="submit"  class="button"  onClick="showtips(this)" name="button" id="button" value="提交" /></td>
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
global $cfg;
$id=getQuerySQL("id");
$sql="select * from @@@replacewords where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);

?>
<form name="formedit" action="?action=edit_save&id=<?=$id?>" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑替换词库</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">词库标识：</td>
    <td width="84%" ><input name="name" type="text" value="<?=$rows["name"]?>" size="40"/>
      例如 帽子 </td>
  </tr>
  
      <tr  bgcolor="#FFFFFF" >
        <td align="left" valign="top">词库内容：</td>
        <td ><textarea name="content" cols="100" rows="10" id="title"><?=$rows["content"]?></textarea> <br>
        词库内容用英文的逗号 , 隔开 例如: hat,cap,headgear</td>
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
function delete_save()
{
	global $cfg;
	$id=getQuerySQL("id");
	$sql="delete from @@@replacewords where id=$id";
	query($sql);
	pageRedirect("2","a_replacewords.php");
}

function add_save()
{
	global $cfg;
	$param["name"]=getForm("name");
	$param["content"]=getForm("content");
	$sql=insertSQL($param,"@@@replacewords");
	query($sql);
	pageRedirect("0","a_replacewords.php");
}

function edit_save()
{
	global $cfg;
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["name"]=getForm("name");
	$param["content"]=getForm("content");
	$sql=updateSQL($param,"@@@replacewords",$condition);
	query($sql);
	pageRedirect("1","a_replacewords.php");
}
?>
<?php require("php_bottom.php")?>
</body>
</html>
