<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>友情链接</title>
</head>

<body>
<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">友情链接</div>
</div>
 </td>
 </tr>
</table>
<br />
<script>
function checkLevel(levelnow,levelmax)
{
	if(levelnow>=levelmax)
	{
		alert("最多只能添加到" + levelmax + "级");
		return false;
	}
	else
		return true;
}
</script>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td ><a href="?">友情链接</a></td>
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
    <td colspan="5"  bgcolor="#F2F4F6"><strong>*友情链接</strong> <span class="fontpadding"><a class="add" href="?action=add">新添加</a></span> </td>
  </tr>

  <tr align="center" bgcolor="#FFFFE9">
    <td  width="7%" >ID</td>
    <td width="44%" align="left">名称</td>
    <td width="21%">域名</td>
    <td width="12%">排序</td>
    <td width="16%">操作</td>
  </tr>
  <?
  $sql="select * from @@@link";
  $rs=query($sql);
  emptyList($rs,4);
  while($rows=fetch($rs))
  {
  ?>
    <tr align="center" bgcolor="#FFFFFF">
      <td><?=$rows["id"]?></td>
      <td align="left"><a href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a></td>
    <td><?=$rows["url"]?></td>
    <td><?=$rows["sort"]?></td>
    <td><a href="?action=edit&id=<?=$rows["id"]?>">编辑</a>    <a class="delete red" onClick="return confirm('确定要删除吗？')"  href="?action=delete_save&id=<?=$rows["id"]?>">删除</a> </td>
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
<form action="?action=add_save" enctype="application/x-www-form-urlencoded" name="formadd" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>*添加友情链接</strong></td>
  </tr>
  
  <tr bgcolor="#FFFFFF">
    <td width="16%" align="left">网站名称：</td>
    <td width="84%" >
      <input type="text" name="name" id="name" />  </td>
  </tr>
  <tr bgcolor="#FFFFFF"  onMouseMove="tr_onMouseOver(this)" class="" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">图片地址：</td>
    <td width="84%" ><img src="images/noimg.gif"  border="0"  vspace="4"  id="imgupload"><br><input name="pic" type="text" id="pic"  size="60"/>    </td>
  </tr>
  
   <tr bgcolor="#FFFFFF" class="" >
     <td align="left">&nbsp;</td>
     <td > 
 <script language="javascript">
	 function asCallOnePic(pic,filename,uploadfolder)
	 {
	 	//alert(pic);
		document.getElementById("pic").value = pic ;
		document.getElementById("imgupload").src = "../image.php?pic=" + escape(pic) + "&style=-1&folder=" + escape(uploadfolder);
	 }
	 </script>
	 <object id="uploadsystem" name="uploadsystem"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
   </tr>
  <tr bgcolor="#FFFFFF">
    <td width="16%" align="left">链接域名：</td>
    <td width="84%" >
      <input name="url" type="text" id="url" size="40" />  </td>
  </tr>
      <tr bgcolor="#FFFFFF">
        <td align="left">链接类型：</td>
        <td ><select name="cid" id="cid">
		<option value="0">图片链接</option>
		<option value="1">文本链接</option>
        </select>
        </td>
      </tr>
      <tr bgcolor="#FFFFFF">
    <td width="16%" align="left">排序：</td>
    <td width="84%" ><input name="sort" type="text"  value="0" size="6" maxlength="6"/>    </td>
  </tr>
   <tr class="add" bgcolor="#FFFFFF">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input  class="button"  type="submit" name="button" id="button" value="提交" /></td>
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
$sql="select * from @@@link where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
?>
<form action="?action=edit_save&id=<?=getQuery("id")?>" enctype="application/x-www-form-urlencoded" name="formedit" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>*编辑友情链接</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="16%" align="left">网站名称：</td>
    <td width="84%" ><input type="text" name="name" value="<?=$rows["name"]?>"/>    </td>
  </tr>

  <tr bgcolor="#FFFFFF"  onMouseMove="tr_onMouseOver(this)" class="" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">图片地址：</td>
    <td width="84%" ><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>"  border="0"  vspace="4"  id="imgupload"><br><input name="pic" type="text" id="pic"  size="60" value="<?=$rows["pic"]?>"/>    </td>
  </tr>
  
   <tr bgcolor="#FFFFFF" class="" >
     <td align="left">&nbsp;</td>
     <td > 
 <script language="javascript">
	 function asCallOnePic(pic,filename,uploadfolder)
	 {
	 	//alert(pic);
		document.getElementById("pic").value = pic ;
		document.getElementById("imgupload").src = "../image.php?pic=" + escape(pic) + "&style=-1&folder=" + escape(uploadfolder);
	 }
	 </script>
	 <object id="uploadsystem" name="uploadsystem"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
   </tr>
  <tr bgcolor="#FFFFFF">
    <td width="16%" align="left">链接域名：</td>
    <td width="84%" ><input name="url" type="text"  value="<?=$rows["url"]?>" size="40"/>    </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left">链接类型：</td>
    <td ><select name="cid" id="cid">
		<option value="0">图片链接</option>
		<option value="1">文本链接</option>
        </select>&nbsp;
		<script language="javascript">
		EnterSelect("cid","<?=$rows["cid"]?>");
		</script>
	  </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="16%" align="left">排序：</td>
    <td width="84%" ><input name="sort" type="text"  value="<?=$rows["sort"]?>" size="6" maxlength="6"/></td>
  </tr>
  
   <tr class="edit" bgcolor="#FFFFFF">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input  class="button"  name="button2" type="submit" value="修改" />    </td>
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
	$sql="delete from @@@link where id=$id";
	
	$arr=array("","mid_","small_","_big");
	deleteImage( fetchPic("@@@link",$id) , $arr , "../systemImage/" );
	
	query($sql);
	pageRedirect("2","a_link.php");
}

function add_save()
{
	$param["name"]=getForm("name");
	$param["sort"]=getForm("sort");
	$param["url"]=getForm("url");
	$param["pic"]=getForm("pic");
	$param["cid"]=getForm("cid");
	$sql=insertSQL($param,"@@@link");
	query($sql);
	pageRedirect("0","a_link.php");
}

function edit_save()
{
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["name"]=getForm("name");
	$param["sort"]=getForm("sort");
	$param["url"]=getForm("url");
	$param["pic"]=getForm("pic");
	
	$oldpic = fetchPic("@@@link",$id);
	if( $oldpic != getForm("pic") )
	{
		$arr=array("","mid_","small_","_big");
		deleteImage( $oldpic , $arr , "../systemImage/" );
	}
	
	$param["cid"]=getForm("cid");
	$sql=updateSQL($param,"@@@link",$condition);
	query($sql);
	pageRedirect("1","a_link.php");
}
?>

<?php require("php_bottom.php");?>
</body>
</html>
