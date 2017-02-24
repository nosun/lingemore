<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>语言管理</title>
</head>

<body>
<?php require("php_top.php")?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">语言管理</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><span class="fontpadding"><a href="a_langlist.php">语言设置</a></span></td>
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
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="7"  bgcolor="#F2F4F6"><strong>语言</strong>
      <span class="fontpadding"><a class="add" href="?action=add">新添加</a></span></td>
  </tr>

  <tr align="center" bgcolor="#FFFFE9">
    <td width="4%" align="center">ID</td>
    <td width="10%" align="center">名称</td>
    <td width="19%">添加时间</td>
    <td width="15%">操作</td>
  </tr>
  <?
  $sql="select * from @@@langlist";
  $rs=query($sql);
  emptyList($rs,4);
  while($rows=fetch($rs))
  {
  ?>
    
    <tr align="center"  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
      <td align="center"><?=$rows["id"]?></td>
      <td align="center"><?=$rows["name"]?></td>
      <td><?= ( $rows["addtime"] )?></td>
      <td><a href="?action=edit&id=<?=$rows["id"]?>">编辑</a>  <a class="delete red" href="?action=delete_save&id=<?=$rows["id"]?>" onClick="return confirm('确定要删除吗？')" >删除</a>	</td>
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
function addItem()
{
?>
<form action="?action=add_save" name="formadd" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加语言</strong></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>名字</td>
    <td><input  size="40"  name="name" type="text"  value="" /></td>
  </tr>
  
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>国家</td>
    <td>
	
	<?
	$country="scountry";
	$scountry="s";
	require("../inc/php_inc_country.php");
	?>
	<script>
  EnterSelect("scountry","<?=$rows["scountry"]?>");
  </script></td>
  </tr>
    <tr class="add" bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input type="submit" name="button" id="button"  onClick="showtips(this)" class="button"  value="提交" /></td>
  </tr>
</table>
</form>
<?
}
?>

<?
function editItem()
{
$id=getQuerySQL("id");
$sql="select * from @@@langlist where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
?>
<form name="formedit" action="?action=edit_save&id=<?=$id?>" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑语言</strong></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>名字</td>
    <td><input  size="40"  name="name" type="text"  value="<?=$rows["name"]?>" /></td>
  </tr>
  
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>国家</td>
    <td>
	
	<?
	$country="scountry";
	$scountry="s";
	require("../inc/php_inc_country.php");
	?>
	<script>
  EnterSelect("scountry","<?=$rows["scountry"]?>");
  </script></td>
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
	$id=getQuerySQL("id");
	$sql="delete from @@@langlist where id=$id";
	query($sql);
	pageRedirect("2","a_langlist.php");
}

function add_save()
{
	$param["name"]=getForm("name");
	$param["scountry"]=getForm("scountry");
	$param["addtime"]=formatDateTime(time());
	$sql=insertSQL($param,"@@@langlist");
	//debug($sql);
	query($sql);
	pageRedirect("0","a_langlist.php");
}

function edit_save()
{
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["name"]=getForm("name");
	$param["scountry"]=getForm("scountry");
	$sql=updateSQL($param,"@@@langlist",$condition);
	query($sql);
	pageRedirect("1","a_langlist.php");
}
?>
<?php require("php_bottom.php")?>
</body>
</html>
