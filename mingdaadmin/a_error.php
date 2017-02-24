<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提示管理</title>
<?php require("php_top.php");?>
<META HTTP-EQUIV="Refresh" CONTENT="2; URL=<?=getQueryDefault("page","a_index_body.php")?>"> 
<style type="text/css">
<!--
.STYLE1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>
<body>

<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">提示管理</div>
</div>
</td></tr></table>
<br />
<?
$action=getQuery("action");
switch($action)
{
	case "":
		$id=getQueryInt("id",6);
		errorMSG($id);
		break;
	case "ok":
		$id=getQueryInt("id",0);
		okMSG($id);
		break;
}
?>

<? 
function errorMSG($id)
{
$arrmsg[0]="对不起,该记录已经存在";
$arrmsg[1]="对不起,该记录不存在或者已被删除";
$arrmsg[2]="对不起,传递非法的ID";
$arrmsg[3]="对不起,不允许跨域提交数据";
$arrmsg[4]="对不起,试图删除已经不存在的记录";
$arrmsg[5]="对不起,试图更新已经不存在的记录";
$arrmsg[6]="非法进入该页面";
$arrmsg[7]="对不起,没有该模块的 [查看] 权限";
$arrmsg[8]="对不起,没有该模块的 [更新] 权限";
$arrmsg[9]="对不起,没有该模块的 [添加] 权限";
$arrmsg[10]="对不起,没有该模块的 [删除] 权限";
$arrmsg[11]="对不起,没有该模块的操作权限";
?>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#CC0000;">
  <tr  bgcolor="#FFD0D0">
    <td align="center"  ><a href="<?=getQueryDefault("page","a_index_body.php")?>"><?=$arrmsg[$id]?> ！<span class="STYLE1" id="span">2</span>秒后将自动跳转,若浏览器没有反应,请 点击</a></td>
  </tr>
</table>
<?
}
?>

<? 
function okMSG($id=0)
{
$arrmsg[0]="更新成功";
$arrmsg[1]="更新成功";
$arrmsg[2]="更新成功";
$arrmsg[3]="更新成功";
$arrmsg[4]="批量添加成功";
$arrmsg[5]="批量更新成功";
?>

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td align="center"  ><a href="<?=getQueryDefault("page","a_index_body.php")?>"><?=$arrmsg[$id]?> ！<span class="STYLE1" id="span">2</span>秒后将自动跳转,若浏览器没有反应,请点击</a></td>
  </tr>
</table>
	<?
	if( getQuery("isemail")!="" )
	{
	?>
		<script language='javascript' type='text/javascript' defer='defer' src='../mail.php?action=email_feedback_reply&id=<?=getQuery("emailid")?>&key=<?=md5(md5( getQuery("emailid") ) ) ?>'></script>
	<?
	}
	?>
<?
}
?>
<script language="javascript">
function daojishi()
{
	var obj=document.getElementById('span');
	if( parseInt(obj.innerText) > 0 )
	{
		obj.innerText = parseInt(obj.innerText) - 1;
		window.setTimeout(daojishi,1000);
	}
}
daojishi();
</script>
<?php require("php_bottom.php");?>
</body>
</html>
