<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据分析</title></head>

<body>
<script language="javascript" type="text/javascript"   charset='gb2312' src="JSFile/DateJs.js"></script>
<style>
.marginbottom{ margin-bottom:15px}
</style>
<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">报表管理</div>
</div>
</td></tr></table>
<br />
<?php
isAuthorize($group[4]);
$action=getQuery("action");
switch($action)
{
case "clean_searchkey":
	clean_searchkey();
	break;
case "clean_category":
	clean_category();
	break;
case "clean_product":
	clean_product();
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
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="a_shujuwajue.php">报表管理</a></td>
  </tr>
</table><br />
<form name="form2" method="post" action="?action=clean_searchkey">
  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>关键词</strong></td>
  </tr>
   <tr    bgcolor="#FFFFFF">
    <td  width="20%">搜索词语：</td>
    <td width="80%"><input name="name" type="text" value="<?=getRequest("name")?>" style="width:153px">
      留空为选择所有搜索词</td>
  </tr>
    <tr   bgcolor="#FFFFFF">
    <td >选择时间：</td>
    <td ><input name="addtime" value=""   onclick="javascript:ShowCalendar(this.id)"   type="text" id="seachkeyaddtime" style="width:153px;">
      留空为选择所有时间</td>
  </tr>
  <tr    bgcolor="#FFFFFF">
    <td  width="20%">&nbsp;</td>
    <td width="80%"><input type="submit" name="Submit32" onClick="return confirm('确认清空当前选择的吗？')" value="清空访问报表"  class="button"  /></td>
  </tr>
</table>
</form><br>
<form name="form2" method="post" action="?action=clean_category">
  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>产品分类</strong></td>
  </tr>
   <tr    bgcolor="#FFFFFF">
    <td  width="20%">分类ID：</td>
    <td width="80%"><input name="classid" type="text" value="<?=getRequest("name")?>" style="width:153px">
      留空为选择所有分类，nike-shoes-c520.html 就输入 520</td>
  </tr>
    <tr   bgcolor="#FFFFFF">
    <td >选择时间：</td>
    <td ><input name="addtime" value=""   onclick="javascript:ShowCalendar(this.id)"   type="text" id="categoryaddtime" style="width:153px;">
      留空为选择所有时间</td>
  </tr>
  <tr    bgcolor="#FFFFFF">
    <td  width="20%">&nbsp;</td>
    <td width="80%"><input type="submit" name="Submit32" onClick="return confirm('确认清空当前选择的吗？')" value="清空访问报表"  class="button"  /></td>
  </tr>
</table>
</form><br>
<form name="form2" method="post" action="?action=clean_product">
  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>产品</strong></td>
  </tr>
   <tr    bgcolor="#FFFFFF">
    <td  width="20%">产品ID：</td>
    <td width="80%"><input name="pid" type="text" value="<?=getRequest("name")?>" style="width:153px">
      留空为选择所有产品，nike-shoes-p520.html 就输入 520</td>
  </tr>
    <tr   bgcolor="#FFFFFF">
    <td >选择时间：</td>
    <td ><input name="addtime" value=""   onclick="javascript:ShowCalendar(this.id)"   type="text" id="productaddtime" style="width:153px;">
      留空为选择所有时间</td>
  </tr>
  <tr    bgcolor="#FFFFFF">
    <td  width="20%">&nbsp;</td>
    <td width="80%"><input type="submit" name="Submit32" onClick="return confirm('确认清空当前选择的吗？')" value="清空访问报表"  class="button"  /></td>
  </tr>
</table>
</form>
<?
}
?>
<?
function clean_searchkey()
{
	$condition = " where 1=1";
	if( getForm("name")!="" )
	{
		$condition .= " and name='" .  filterSQL(getForm("name")) . "'";
	}
	if( getForm("addtime")!="" )
	{
		$condition .= " and TO_DAYS(addtime) - TO_DAYS('" . getForm("addtime") . "') <= 0" ;
	}
	$rs=deleteRecord("@@@searchlog","$condition");
	pageRedirect("清空报表成功","a_cleanreport.php");
}
function clean_category()
{
	$condition = " where 1=1";
	if( getForm("classid")!="" )
	{
		$condition .= " and classid=" . getFormInt("classid",0);
	}
	if( getForm("addtime")!="" )
	{
		$condition .= " and TO_DAYS(addtime) - TO_DAYS('" . getForm("addtime") . "') <= 0" ;
	}
	$rs=deleteRecord("@@@categorylog","$condition");
	pageRedirect("清空报表成功","a_cleanreport.php");
}
function clean_product()
{
	$condition = " where 1=1";
	if( getForm("pid")!="" )
	{
		$condition .= " and pid=" . getFormInt("pid",0);
	}
	if( getForm("addtime")!="" )
	{
		$condition .= " and TO_DAYS(addtime) - TO_DAYS('" . getForm("addtime") . "') <= 0" ;
	}
	$rs=deleteRecord("@@@productlog","$condition");
	pageRedirect("清空报表成功","a_cleanreport.php");
}
?>
<?php require("php_bottom.php");?>
</body>
</html>