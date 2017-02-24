<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员配置</title>
</head>

<body>
<?php require("php_top.php");?>
<style>
.state0{}
.state1{ color:#FF0000; font-weight:bold}
</style>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">管理员配置</div>
</div>
</td></tr></table>
<br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle">
  <tr  bgcolor="#F2F4F6">
    <td><a href="a_admin.php">管理员列表</a><span class="fontpadding"><a class="add" href="a_admin.php?action=add">添加管理员</a></span></td>
  </tr>
</table><br />
<?php
isAuthorize($group[0]);
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
global $cfg;
global $supper;
?>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="4" bgcolor="#F2F4F6"><strong>管理员设置</strong></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9" >
    <td width="45%"  align="left" >管理员名称</td>
    <td width="14%"   >状态</td>
    <td width="17%"   >修改时间</td> 
	<td width="24%"   >操作</td>
  </tr>
  <?
  $arrstate= array("允许登陆","禁止登陆");
  if($supper==9)
  	$sql="select * from @@@admin";
  else
  	$sql="select * from @@@admin where supper<>9";
  $rs=query($sql);
  emptyList($rs,3);
  while($rows=fetch($rs))
  {
  ?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td   align="left" class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a></td>
    
    <td   class="a_fen"><span class="state<?=$rows["state"]?>"><?=$arrstate[$rows["state"]]?></span></td>
    <td   class="a_fen"><?=$rows["addtime"]?></td>
	<td   class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>">修改</a> 
	<? if($rows["supper"]<7) { ?>  <a  onClick="return confirm('确定要删除吗？')"  class="delete red" href="?action=delete_save&id=<?=$rows["id"]?>">删除</a> <? } ?></td>
  </tr>
 <?
 }
 free($rs);
 ?>
 <tr align="center"  bgcolor="#FFFFE9"  >
    <td colspan="4"  align="right" >你无法删除默认管理员admin，但可以修改其名称及密码</td>
  </tr>
</table>
<?
}
?>

<?
function editItem()
{
global $cfg;
$id=getQuerySQL("id");
$sql="select * from @@@admin where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
?>
<script language="javascript" type="text/javascript">
function CheckForm()
{ 
if(!CheckLength("myform","name","管理员名字",5,16)) return false;
}

  </script>

  <table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
   <form id="myform" name="myform" method="post" action="?action=edit_save&id=<?=$id?>"> <tr>
      <td   colspan="2"   bgcolor="#F2F4F6"><strong>修改管理员</strong></td>
    </tr>
    <tr onMouseOver="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
      <td  >管理员名称：</td>
      <td><input name="name" type="text" id="name" value="<?=$rows["name"]?>" maxlength="16" />
    <? if($rows["supper"]<8) { ?>   <span class="fontpadding"><a onClick="return confirm('确认删除吗？')" href="?action=delete_save&id=<?=$rows["id"]?>">删除</a></span> <? } ?> <br>
为确保登录安全，请记的 1.不要用 admin 的用户名 2.密码英文+数字
 </td> 
    </tr>
    <tr onMouseOver="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
      <td  >管理员昵称：</td>
      <td><input name="nickname" type="text" id="nickname" value="<?=$rows["nickname"]?>" maxlength="16" /></td>
    </tr>
    <tr onMouseOver="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
      <td  >状态：</td>
      <td><input type="radio" name="state" value="0">
        允许登陆 
        <input type="radio" name="state" value="1"> 禁止登陆
	  <script>  EnterRadio("state","<?=$rows["state"]?>")</script>	  </td>
    </tr>
    <tr onMouseOver="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
      <td width="22%"  >新密码：</td>
      <td width="78%"><input name="pwd" id="pwd" type="password"    /></td>
    </tr>
	<tr onMouseOver="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
      <td width="22%"  >确认密码：</td>
      <td width="78%"><input name="tbPWD1"  type="password" id="textfield"  /></td>
    </tr>
    <tr class="" bgcolor="#FFFFFF" >
      <td >权限组别：</td>
      <td>默认 admin 管理的权限不可修改。<br>
<?
	  for($index=0;$index<count($cfg["admin"]["group"]);$index++)
		echo "<input name='group[]' class='groupclass' type='checkbox' value='" . pow(2,$index) . "' /> " . $cfg["admin"]["group"][$index] . " ";
	  ?>
	    <script language="javascript">
		EnterCheckBox("group[]","<?=c2tostr(decbin($rows["groupid"]))?>");
	</script>
	<? if($rows["supper"]>=8) { ?>
		 <script language="javascript">
		$('.groupclass').attr("disabled","disabled")
	</script>
	<? } ?>
	<div style="background-color:#FFFFE6; margin-top:3px; border:1px #FEDF63 dotted; padding:3px; padding-left:7px; width:470px">
	<strong>账户设置组</strong>: 添加,修改,删除管理员账户的权限,网站最高权限<br>
 <strong> 网站维护组</strong>: 修改与设置 Logo与广告，运费，支付，页面管理等权限 <br>  
  <strong>信息管理组</strong>: 上传，编辑，管理产品，新闻的发布<br>
    <strong>业务管理组</strong>: 用于查看订单，会员，留言的业务信息<br>
	 <strong> 数据分析组</strong>:   用于查看分析 产品，分类，关注词的数据情况
	</div>
	</td>
    </tr>
    
    <tr class="edit" bgcolor="#FFFFE9">
      <td  >&nbsp;</td>
      <td><input type="submit" class="button"    onClick="return CheckForm()"  id="button2" value="提交" /></td>
    </tr>
	</form>
  </table>
<?
free($rs);
}
?>

<?
function addItem()
{
global $cfg;
?>
<script language="javascript" type="text/javascript">
  function CheckForm()
  { 
if(!CheckLength("myform","name","管理员名字",5,16)) return false;
if(!CheckIsSame("myform","pwd","pwd1","管理员密码","确认密码")) return false;
}

  </script>

    <table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
     <form id="form" name="myform" method="post" action="?action=add_save"> <tr>
        <td   colspan="2"   bgcolor="#F2F4F6"><strong>增加新管理员</strong></td>
      </tr>
      <tr onMouseOver="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
        <td width="22%"  >管理员名称：</td>
        <td width="78%"><input name="name" type="text" id="name" maxlength="16" />
        <br>
        为确保登录安全，请记的 1.不要用 admin 的用户名 2.密码英文+数字</td>
      </tr> <tr onMouseOver="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
      <td  >管理员昵称：</td>
      <td><input name="nickname" type="text" id="nickname" value="<?=$rows["nickname"]?>" maxlength="16" /></td>
    </tr>
      <tr  onmouseover="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
        <td  >状态：</td>
        <td><input name="state" type="radio" value="0" checked>
          允许登陆 
          <input type="radio" name="state" value="1"> 禁止登陆		</td>
      </tr>
      <tr  onmouseover="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
        <td  >输入密码：</td>
        <td><input name="pwd" type="password" id="pwd"  /></td>
      </tr>
	  <tr onMouseOver="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
      <td width="22%"  >确认密码：</td>
      <td width="78%"><input name="pwd1"  type="password" id="pwd1"  /></td>
    </tr>
	<tr  class=""  bgcolor="#FFFFFF" >
      <td >权限组别：</td>
      <td>
默认 admin 管理的权限不可修改。	  
	  <br>
<?
	  for($index=0;$index<count($cfg["admin"]["group"]);$index++)
		echo "<input name='group[]' checked='checked' type='checkbox' value='" . pow(2,$index) . "' /> " . $cfg["admin"]["group"][$index] . " ";
	  ?><div style="background-color:#FFFFE6; margin-top:3px; border:1px #FEDF63 dotted; padding:3px; padding-left:7px; width:470px">
	<strong>账户设置组</strong>: 添加,修改,删除管理员账户的权限,网站最高权限<br>
 <strong> 网站维护组</strong>: 修改与设置 Logo与广告，运费，支付，页面管理等权限 <br>  
  <strong>信息管理组</strong>: 上传，编辑，管理产品，新闻的发布<br>
    <strong>业务管理组</strong>: 用于查看订单，会员，留言的业务信息<br>
	 <strong> 数据分析组</strong>:   用于查看分析 产品，分类，关注词的数据情况
	</div></td>
    </tr>
      
      <tr  class="add"  bgcolor="#FFFFE9">
        <td  >&nbsp;</td>
        <td><input type="submit"  class="button" onClick="return CheckForm()"    id="button" value="提交" /></td>
      </tr></form>
    </table>
<?
}
?>

<?
function delete_save()
{
	$id=getQuerySQL("id");
	$sql="delete from @@@admin where id=$id";
	query($sql);
	pageRedirect("3","a_admin.php");
}

function add_save()
{
	global $cfg;
	$name=getForm("name");
	$sql="select * from @@@admin where name='$name'";
	$rs=query($sql);
	isItemExist($rs);
	free($rs);
	$param["pwd"]=md5(md5(getForm("pwd")));
	$param["name"]=getForm("name");
	$param["nickname"]=getForm("nickname");
	$param["state"]=getFormInt("state",0);
	$param["groupid"] = strtoint( getForm("group") );
	$param["addtime"]=formatDateTime(time());
	$sql=insertSQL($param,"@@@admin");
	query($sql);
	pageRedirect("0","a_admin.php");
}

function edit_save()
{
	global $cfg;
	$id=getQuerySQL("id");
	$condition="where id=$id";
	if(getForm("pwd")!="")
		$param["pwd"]=md5(md5(getForm("pwd")));
	$param["name"]=getForm("name");
	$param["nickname"]=getForm("nickname");
	$param["state"]=getFormInt("state",0);
	if( $id<=6 )
		$param["groupid"] =  1023 ;
	else
		$param["groupid"] = strtoint( getForm("group") );
	
	$param["addtime"]=formatDateTime(time());
	
	$sql=updateSQL($param,"@@@admin",$condition);
	query($sql);
	pageRedirect("1",$_SERVER['HTTP_REFERER']);
}
?>

<?php require("php_bottom.php");?>
</body>
</html>
