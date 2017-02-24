<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改密码</title>
</head>

<body>
<?php require("php_top.php")?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">修改密码</div>
</div>
</td></tr></table>
<br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle">
  <tr  bgcolor="#F2F4F6">
    <td  ><a href="a_password.php">修改密码</a></td>
  </tr>
</table><br />
<?php
$action=getQuery("action");
switch($action)
{
case "edit_save":
	edit_save();
	break;
default:
	editItem();
	break;
}
?>

<?
function editItem()
{
global $cfg;
$id=$_SESSION["admin"];
$sql="select * from @@@admin where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
?>
<script language="javascript" type="text/javascript">
function CheckForm()
{ 
if(!CheckLength("myform","name","管理员名字",5,16)) return false;
if(!CheckIsSame("myform","pwd","pwd1","管理员密码","确认密码")) return false;
}

  </script>

  <table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
   <form id="myform" name="myform" method="post" action="?action=edit_save"> <tr>
      <td   colspan="2"   bgcolor="#F2F4F6"><strong>修改个人密码</strong></td>
    </tr>
    <tr onMouseOver="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
      <td  >管理员名称：</td>
      <td><?=$rows["name"]?>
      </td>
    </tr>
    <tr onMouseOver="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
      <td width="22%"  >新密码：</td>
      <td width="78%"><input name="pwd" id="pwd" type="password"   /> <span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">提醒您： 密码建议设置在 10位 以上字母跟数字</span></td>
    </tr>
	<tr onMouseOver="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
      <td width="22%"  >确认密码：</td>
      <td width="78%"><input name="pwd1" type="password" id="pwd1" /></td>
    </tr>
    
    <tr    bgcolor="#FFFFE9">
      <td  >&nbsp;</td>
      <td><input type="submit"  class="button"  onClick="return CheckForm()"  id="button2" value="提交" /></td>
    </tr>
	</form>
  </table>
<?
	free($rs);
	}
?>

<?
function edit_save()
{
	global $cfg;
	$id=$_SESSION["admin"];
	$condition="where id=$id";
	if(getForm("pwd")!="")
		$param["pwd"]=md5(md5(getForm("pwd")));
	$param["addtime"]=formatDateTime(time());
	$sql=updateSQL($param,"@@@admin",$condition);
	query($sql);
	pageRedirect("1","a_password.php");
	
}
?>

<?php require("php_bottom.php")?>
</body>
</html>
