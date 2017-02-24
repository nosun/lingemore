<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>国家管理</title>
<style>
#payment_td img{ float:left}
</style>
</head>

<body>
<script language="javascript">
function changeImage(path)
{
	document.getElementById("imgupload").src=path;
}
 function showPaymentAccount(obj)
	 {
	 //	document.getElementById("span_" + obj.value).style.display = "block";
		$("#payment_account span").css("display","none")
		$("#span_" + obj.value).css("display","inline-block");
	 }
</script>
<?php require("php_top.php")?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">国家管理</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">国家管理</a></td>
  </tr>
</table><br /><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >1. <span class="red weight">您无法删除国家</span>,但可以更改排列顺序以及隐藏部分国家。<br>
    2. 排序越小排名越前面，请设置好参数。<br>
    3. <span class="red"><strong>排序小于&lt;= 0</strong></span> ，将不会出现在前台的注册以及订单页面<br>
    4.
    全部修改完毕后，点击 <a href="a_config.php?action=clean">清空缓存</span></a></td>
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
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="5"  bgcolor="#F2F4F6"><strong>国家管理</strong><span class="fontpadding2">带 <img src="images/qianbi.gif"   align="absmiddle"> 的列可<span class="red weight">"直接点击格子修改"</span></span></td>
  </tr>

  <tr align="center" bgcolor="#FFFFE9">
    <td width="45" align="center">序列</td>
   <td align="center" width="145">排序<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
   <td width="400" align="left">名称/缩写</td><td width="445" align="left">已分配到</td>
  </tr>
  <?
  $sql="select name,id from @@@deliveryarea where level=1";
  $rs=query($sql);
  while($rows=fetch($rs))
  {
  	$deliveryarea[$rows["id"]]=$rows["name"] ;
  }
  $sql="select * from @@@areacountry";
  $rs=query($sql);
  while($rows=fetch($rs))
  {
  	$countryarea[$rows["countryid"]][]= $deliveryarea[$rows["areaid"]]  ;
  }
  
  
  $sql="select * from @@@country where sort>0 order by sort asc";
  $rs=query($sql);
  while($trows=fetch($rs))
  {
  	$arr_rows[] = $trows ;
  }
  $sql="select * from @@@country where sort<=0 order by sort asc";
  $rs=query($sql);
  while($trows=fetch($rs))
  {
  	$arr_rows[] = $trows ;
  }
  for($index=0;$index<count($arr_rows);$index++)
  { 
  $rows = $arr_rows[$index] ;
  if($rows["sort"]>0)
  	$bgcolor = "#ffffff";
  else
  	$bgcolor = "#eeeeee";
  ?> <tr align="center" bgcolor="<?=$bgcolor?>">
      <td align="center"><?=$index+1?></td><td class="point" id="sort<?=$rows["id"]?>"><?=$rows["sort"]?></td>
      <td align="left"><?=$rows["cnname"]?><br>
  <img src="http://open.35zh.com/pic/country/<?=$rows["shortname"]?>.gif" align="absmiddle"/> <?=$rows["name"]?> (<span class="red"><?=$rows["shortname"]?></span>) </td> <td align="left"><?=join(',',$countryarea[$rows["id"]])?></td>
  </tr>
  <script language="javascript">
  $("#sort<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@country','sort',<?=$rows["id"]?>,true)});
  </script>
  <?
 }
 free($rs);
 ?>
</table>

<?
}
?>
<?php require("php_bottom.php")?>
</body>
</html>
