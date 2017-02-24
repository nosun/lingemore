<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登陆日记</title>
</head>

<body>
<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">登陆日记</div>
</div>
</td></tr></table>
<br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle">
  <tr  bgcolor="#F2F4F6">
    <td  ><a href="a_log.php">登陆日记</a></td>
  </tr>
</table><br />
<?php
isAuthorize($group[1]);
$action=getQuery("action");
switch($action)
{
default:
	showItem();
	break;
}
?>

<?
function showItem()
{
global $glo;
?>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="6" bgcolor="#F2F4F6"><strong>登陆日记</strong></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9" >
    <td width="11%"  align="left" >管理员名称</td>
    <td width="13%"   >IP</td>
    <td width="12%"   >操作系统</td>
    <td width="12%"   >浏览器</td>
    <td width="36%"   >客户端信息</td>
    
    <td width="16%"   >登陆时间</td> 
  </tr>
  <?
  global $glo;
  $orderby=" order by id desc";
	$pagenow=getQueryInt("page");
	$pageurl="1=1";
	$pagesize=20;
	$rs=createPage("*","@@@log",$condition,$orderby,$pagesize,$pagenow,$pagetotal,$recordcount);
  emptyList($rs,4);
  while($rows=fetch($rs))
  {
  $times = (strtotime($rows["lasttime"])-strtotime($rows["addtime"]))/60 ;
  ?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td   align="left" class="a_fen"><?=$rows["name"]?></td>
    
    <td   class="a_fen"><?=$rows["ip"]?><br>
<script src="http://open.35zh.com/cgi-bin/?do=iptoqqwry&ip=<?=$rows["ip"]?>"></script></td>
    <td   class="a_fen"><?=$rows["os"]?></td>
    <td   class="a_fen"><?=$rows["browser"]?></td>
    <td   class="a_fen"><?=$rows["useragent"]?></td>
   
    <td   class="a_fen"><?=$rows["addtime"]?></td> 
  </tr>
 <?
 }
 free($rs);
 ?>
<tr bgcolor="#FFFFE9">
    <td colspan="6" align="right" ><? require("php_page.php")?></td>
  </tr>
</table>
<?
}
?>


<?php require("php_bottom.php");?>
</body>
</html>
