<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>黑名单管理</title>
</head>

<body>
<?php require("php_top.php")?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">黑名单管理</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="a_config.php">网站配置</a><span class="fontpadding"><a href="a_ip.php">黑名单设置</a></span></td>
  </tr>
</table><br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >注意: 这里是黑名单列表，添加的IP将不能正常访问您的网站。</td>
  </tr>
</table><br>

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
    <td colspan="7"  bgcolor="#F2F4F6"><strong>黑名单</strong>
      <span class="fontpadding"><a class="add" href="?action=add">新添加</a></span></td>
  </tr>

  <tr align="center" bgcolor="#FFFFE9">
    <td width="4%" align="center">ID</td>
    <td width="10%" align="center">起始IP</td>
    <td width="10%">结束IP</td>
    <td width="16%">备注</td>
    <td width="19%">添加时间</td>
    <td width="26%">地理位置</td>
    <td width="15%">操作</td>
  </tr>
  <?
  $sql="select * from @@@ip";
  $rs=query($sql);
  emptyList($rs,4);
  while($rows=fetch($rs))
  {
  ?>
    
    <tr align="center"  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
      <td align="center"><?=$rows["id"]?></td>
      <td><img src="http://open.35zh.com/cgi-bin/?do=iptocountry&type=3&ip=<?= long2ip( $rows["startip"] )?>" align="absmiddle" hspace="2"><?= long2ip( $rows["startip"] )?></td>
      <td><img src="http://open.35zh.com/cgi-bin/?do=iptocountry&type=3&ip=<?= long2ip( $rows["endip"] )?>" align="absmiddle" hspace="2"><?= long2ip( $rows["endip"] )?></td>
	  <td><?= ( $rows["content"] )?></td>
      <td><?= ( $rows["addtime"] )?></td>
      <td><script src="http://open.35zh.com/cgi-bin/?do=iptoqqwry&ip=<?= long2ip( $rows["startip"] )?>"></script></td>
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
    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加黑名单</strong></td>
  </tr>
  
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">起始IP：</td>
    <td width="84%" >
      <input name="startip" type="text" id="textfield" size="30" /> 
      （格式127.0.0.1） </td>
  </tr>
   
   <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">结束IP：</td>
    <td width="84%" ><input name="endip" type="text"   size="30"/>
    （格式127.0.0.1）  </td>
  </tr>
      
      
      <tr bgcolor="#FFFFFF" >
        <td align="left" valign="top">备注：</td>
        <td ><textarea name="content" cols="50" rows="5" id="title"></textarea></td>
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
$sql="select * from @@@ip where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
?>
<form name="formedit" action="?action=edit_save&id=<?=$id?>" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑黑名单</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">起始IP：</td>
    <td width="84%" ><input name="startip" type="text" value="<?= long2ip( $rows["startip"] )?>" size="40"/>    </td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  >
    <td width="16%" align="left">结束IP：</td>
    <td width="84%" ><input name="endip" type="text"  value="<?= long2ip( $rows["endip"] )?>" size="40"/>    </td>
  </tr>
  
      <tr bgcolor="#FFFFFF">
        <td align="left" valign="top">备注：</td>
        <td >
		<textarea name="content" cols="50" rows="5" id="title"><?=  $rows["content"] ?></textarea></td>
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
	$sql="delete from @@@ip where id=$id";
	query($sql);
	pageRedirect("2","a_ip.php");
}

function add_save()
{
	$param["startip"]=sprintf("%u",ip2long( getForm("startip") ) );
	$param["endip"]=sprintf("%u",ip2long( getForm("endip") ) );
	$param["addtime"]=formatDateTime(time());
	$param["content"]=$_POST["content"];
	$sql=insertSQL($param,"@@@ip");
	//debug($sql);
	query($sql);
	pageRedirect("0","a_ip.php");
}

function edit_save()
{
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["startip"]=sprintf("%u",ip2long( getForm("startip") ) );
	$param["endip"]=sprintf("%u",ip2long( getForm("endip") ) );
	$param["addtime"]=formatDateTime(time());
	$param["content"]=$_POST["content"];
	$sql=updateSQL($param,"@@@ip",$condition);
	query($sql);
	pageRedirect("1","a_ip.php");
}
?>
<?php require("php_bottom.php")?>
</body>
</html>
