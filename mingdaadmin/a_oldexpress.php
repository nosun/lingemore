<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>配送方式</title>
</head>
<body>
<script language="javascript">
function changeImage(path)
{
	document.getElementById("imgupload").src=path;
}
</script>
<?php require("php_top.php")?>
<link href="php_css.php?a=<?=$perm[4][2]?>&e=<?=$perm[4][1]?>&d=<?=$perm[4][3]?>" type="text/css" rel="stylesheet" />
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">配送方式管理</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">配送方式管理</a><span class="fontpadding"><a class="add" href="?action=add">添加配送方式</a></span></td>
  </tr>
</table><br /><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >注意：添加的配送方式将直接在前台计算并显示，请设置好参数。</td>
  </tr>
</table><br>

<?php
permview($perm,4);
$action=getQuery("action");
switch($action)
{
case "add":
	permadd($perm,4);
	addItem();
	break;
case "edit":
	editItem();
	break;
case "add_save":
	permadd($perm,4);
	add_save();
	break;
case "delete_save":
	permdel($perm,4);
	delete_save();
	break;
case "edit_save":
	permedit($perm,4);
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
    <td colspan="7"  bgcolor="#F2F4F6"><strong>配送方式</strong><span class="fontpadding2">带 <img src="images/qianbi.gif"  align="absmiddle"> 的列可<span class="red weight">"直接点击格子修改"</span></span></td>
  </tr>

  <tr align="center" bgcolor="#FFFFE9">
    <td width="4%" align="center">ID</td>
    <td width="15%" align="center">图片</td>
    <td align="left">名称</td>
    <td width="15%">首价格(<?=getCoinChar($config,0)?>)<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="15%">续价格(<?=getCoinChar($config,0)?>)<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="15%">排序<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="15%">操作</td>
  </tr>
  <?
  $sql="select * from @@@express";
  $rs=query($sql);
  emptyList($rs,4);
  while($rows=fetch($rs))
  {
  ?>
    
    <tr align="center" bgcolor="#FFFFFF"  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
      <td align="center"><?=$rows["id"]?></td>
      <td align="center"><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>" vspace="4" /></td>
      <td align="left"><a href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a></td>
      <td class="point"  id="price1<?=$rows["id"]?>"><?=$rows["price1"]?></td>
      <td class="point"  id="price2<?=$rows["id"]?>" ><?=$rows["price2"]?></td>
      <td class="point"  id="sort<?=$rows["id"]?>" ><?=$rows["sort"]?></td>
    <td><a href="?action=edit&id=<?=$rows["id"]?>">编辑</a> <a class="delete red" onClick="return confirm('确定要删除吗？')"  href="?action=delete_save&id=<?=$rows["id"]?>">删除</a></td>
  </tr>
   <script language="javascript">
  $("#price1<?=$rows["id"]?>").bind("click",function(){getValueHTML('express','price1',<?=$rows["id"]?>,1,8)}); 
  $("#price2<?=$rows["id"]?>").bind("click",function(){getValueHTML('express','price2',<?=$rows["id"]?>,1,8)});
  $("#sort<?=$rows["id"]?>").bind("click",function(){getValueHTML('express','sort',<?=$rows["id"]?>,1,8)});
  </script>
 <?
 }
 free($rs);
 ?>
</table><table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="6"  bgcolor="#F2F4F6"><strong>配送方式素材下载</strong></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" align="center">
	<img src="images/EMS.gif" hspace="4" />	<img src="images/DHL.gif" hspace="4" />	 <img src="images/fedex.gif" hspace="4" />	 <img src="images/TNT.gif" hspace="4" />	<img src="images/ups.gif" hspace="4" />	</td>
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
    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加配送方式</strong></td>
  </tr>
  
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">名称：</td>
    <td width="84%" >
      <input name="name" type="text" id="textfield" size="40" />  </td>
  </tr>
   <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" >
    <td width="16%" align="left">图片地址：</td>
    <td width="84%" ><img src="images/noimg.gif"  border="0"  vspace="4"  id="imgupload"><br>
<input name="pic" size="60" id="pic" type="text" />    </td>
  </tr>
  
   <tr bgcolor="#FFFFFF" >
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
	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d",time())?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d",time())?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object>	 </td>
   </tr>
   <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">域名链接：</td>
    <td width="84%" ><input name="url" type="text"   size="40"/>    </td>
  </tr>
   <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  class="hide">
    <td width="16%" align="left">国家/地区：</td>
    <td width="84%" ><select name="country" id="country">
		<option value="0">请选择区域</option>
		<?
		$sql="select id as v,name as k from @@@countryclass where level=1";
		writeSelect($sql);
		?>
        </select> </td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  class="hide">
    <td width="16%" align="left">计算公式：</td>
    <td width="84%" ><select name="type" id="type">
		<option value="0">按件数</option>
		<option value="1">按重量</option>
		<option value="2">自定义函数</option>
        </select> </td>
  </tr>
      <tr bgcolor="#FFFFFF"  onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  class="hide">
        <td align="left">起重量：</td>
        <td ><input name="firstweight" type="text" id="tbPrice1" value="0"   size="10" maxlength="10"/> KG</td>
      </tr>
      <tr bgcolor="#FFFFFF"  onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" >
        <td align="left">首价格：</td>
        <td >  <?=getCoinChar($config,0)?>  <input name="price1" type="text" id="tbPrice1" value="0"   size="10" maxlength="10"/></td>
      </tr>
      <tr bgcolor="#FFFFFF"   onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">续价格：</td>
        <td >  <?=getCoinChar($config,0)?> 
          <input name="price2" type="text" id="price2" value="0"   size="10" maxlength="10"/></td></tr>
      <tr  bgcolor="#FFFFFF"   onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" class="hide">
        <td align="left">运费折扣：</td>
        <td ><input name="discount" type="text" id="discount" value="1"   size="10" maxlength="10"/>
         1为不打折，0.9 为 打9折</td>
      </tr>
      <tr  bgcolor="#FFFFFF" class="hide"  onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">排序：</td>
    <td width="84%" ><input name="sort" type="text"  value="0" size="6" maxlength="6"/>    </td>
  </tr>
      <tr bgcolor="#FFFFFF"  class="hide">
        <td align="left" valign="top">智能公式：</td>
        <td ><textarea name="function" cols="50" rows="10" id="title"></textarea>
        <br>
        变量描述： <span class="red">$eprice</span>(运费价格) , <span class="red">$totalprice</span>(产品总价) , <span class="red">$totalweight</span>(总重量) , <span class="red">$totalnum</span>(总件数) , <span class="red">$rate</span>(汇率) </td>
      </tr>
      <tr bgcolor="#FFFFFF" >
        <td align="left" valign="top">内容：</td>
        <td >
		<?
		$oFCKeditor = $glo["fck"] ;
		$oFCKeditor->Value = '' ;
		$oFCKeditor->Create() ;
		?>		</td>
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
$config=$glo["config"];
$id=getQuerySQL("id");
$sql="select * from @@@express where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
?>
<form name="formedit" action="?action=edit_save&id=<?=$id?>" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑配送方式</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">名称：</td>
    <td width="84%" ><input name="name" type="text" value="<?=$rows["name"]?>" size="40"/>    </td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" >
    <td width="16%" align="left">图片地址：</td>
    <td width="84%" ><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>" vspace="4" id="imgupload"/><br>
      <input name="pic" type="text" id="pic" size="60"   value="<?=$rows["pic"]?>" />    </td>
  </tr>
  
   <tr bgcolor="#FFFFFF" >
     <td align="left"><? $path_parts = pathinfo( $rows["pic"] );
	$todir = $path_parts["dirname"] ; 
	$todir = dataDefault($todir,strftime("%Y-%m-%d",time()));
	?></td>
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
	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object>	 </td>
   </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">域名链接：</td>
    <td width="84%" ><input name="url" type="text"  value="<?=$rows["url"]?>" size="40"/>    </td>
  </tr>
   <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" class="hide">
    <td width="16%" align="left">国家/地区：</td>
    <td width="84%" ><select name="country" id="country">
		<option value="0">请选择区域</option>
		<?
		$sql="select id as v,name as k from @@@countryclass where level=1";
		writeSelect($sql);
		?>
        </select><script language="javascript">
		
		EnterSelect("country","<?=$rows["country"]?>");
		</script> </td>
  </tr>
   <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" class="hide">
    <td width="16%" align="left">计算公式：</td>
    <td width="84%" ><select name="type" id="type">
		<option value="0">按件数</option>
		<option value="1">按重量</option>
		<option value="2">自定义函数</option>
        </select> <script language="javascript">
		
		EnterSelect("type","<?=$rows["type"]?>");
		</script></td>
  </tr>
   <tr bgcolor="#FFFFFF"  onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" class="hide">
     <td align="left">起重量：</td>
     <td ><input name="firstweight" type="text" id="tbPrice1" value="<?=$rows["firstweight"]?>"   size="10" maxlength="10"/> KG</td>
   </tr>
   <tr bgcolor="#FFFFFF"  onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">首价格：</td>
    <td >  <?=getCoinChar($config,0)?> 
          <input name="price1" type="text" id="tbPrice1" value="<?=$rows["price1"]?>"   size="10" maxlength="10"/></td></tr>
      <tr bgcolor="#FFFFFF"  onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">续价格：</td>
        <td >  <?=getCoinChar($config,0)?> 
          <input name="price2" type="text" id="tbPrice2" value="<?=$rows["price2"]?>" size="10" maxlength="10"/></td></tr>
 <tr  bgcolor="#FFFFFF"   onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" class="hide">
        <td align="left">运费折扣：</td>
        <td ><input name="discount" value="<?=$rows["discount"]?>" type="text" id="discount"   size="10" maxlength="10"/>
1为不打折，0.9 为 打9折</td>
      </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" >
    <td width="16%" align="left">排序：</td>
    <td width="84%" ><input name="sort" type="text"  value="<?=$rows["sort"]?>" size="6" maxlength="6"/> <span class="red">(当填入数字小于0时候,那么将不会出现在前台订单流程)</span></td>
  </tr>
  
      <tr  class="hide" bgcolor="#FFFFFF" >
        <td align="left" valign="top">智能公式：</td>
        <td ><textarea name="function" cols="50" rows="10" id="title"><?=$rows["function"]?></textarea> <br>
        变量描述： <span class="red">$eprice</span>(运费价格)  , <span class="red">$totalprice</span>(产品总价) , <span class="red">$totalweight</span>(总重量) , <span class="red">$totalnum</span>(总件数) , <span class="red">$rate</span>(汇率)</td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="left" valign="top">内容</td>
        <td >
		<?
		$oFCKeditor = $glo["fck"] ;
		$oFCKeditor->Value = $rows["content"] ;
		$oFCKeditor->Create() ;
		?>		</td>
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
	$sql="delete from @@@express where id=$id";
	
	deleteImage( fetchPic("@@@express",$id) , $cfg["deleteImageAll"] , "../systemImage/",0 );
	
	query($sql);
	pageRedirect("2","a_express.php");
}

function add_save()
{
	$param["name"]=getForm("name");
	$param["sort"]=getForm("sort");
	$param["url"]=getForm("url");
	$param["pic"]=getForm("pic");
	$param["price1"]=getFormInt("price1",0,false);
	$param["price2"]=getFormInt("price2",0,false);
	$param["type"]=getFormInt("type",0);
	$param["firstweight"]=getFormInt("firstweight",0,false);
	$param["discount"]=getFormInt("discount",0,false);
	$param["content"]=getHTML("content");
	$param["function"]=$_POST["function"];
	$param["country"]=getFormInt("country",0);
	$sql=insertSQL($param,"@@@express");
	query($sql);
	$param=array();
	$param["sort"]="@id";
	$condition = "where id=" . mysql_insert_id();
	$sql=updateSQL($param,"@@@express",$condition);
	query($sql);
	pageRedirect("0","a_express.php");
}

function edit_save()
{
	global $cfg;
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["name"]=getForm("name");
	$param["sort"]=getForm("sort");
	$param["url"]=getForm("url");
	$param["pic"]=getForm("pic");
	$param["function"]=$_POST["function"];
	$oldpic = fetchPic("@@@express",$id);
	if( $oldpic != getForm("pic") )
	{
		deleteImage( $oldpic , $cfg["deleteImageAll"], "../systemImage/",0 );
	}
	
	$param["price1"]=getFormInt("price1",0,false);
	$param["price2"]=getFormInt("price2",0,false);
	$param["firstweight"]=getFormInt("firstweight",0,false);
	$param["discount"]=getFormInt("discount",0,false);
	$param["content"]=getHTML("content");
	$param["type"]=getFormInt("type",0);
	$param["country"]=getFormInt("country",0);
	$sql=updateSQL($param,"@@@express",$condition);
	query($sql);
	pageRedirect("1","a_express.php");
}
?>
<?php require("php_bottom.php")?>
</body>
</html>
