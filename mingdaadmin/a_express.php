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
<script language="javascript">
function changeNextValue(id,obj)
{
	var obj2 = document.getElementById("pnumpre"+id);
	if(obj2)
	{
		obj2.value = obj.value;
	}
	var objdiv = document.getElementById("pifadiv"+id);
	if(objdiv)
	{
		objdiv.style.display="block";
		
	}
}
</script>
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
    <td >注意：添加的配送方式将直接在前台计算并显示，请设置好参数。<span class="red"><strong>排序小于0的将不会出现在前台</strong></span></td>
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
global $config;
?>
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="10"  bgcolor="#F2F4F6"><strong>配送方式</strong><span class="fontpadding2">带 <img src="images/qianbi.gif"  align="absmiddle"> 的列可<span class="red weight">"直接点击格子修改"</span></span></td>
  </tr>

  <tr align="center" bgcolor="#FFFFE9">
    <td width="4%" align="center">ID</td>
    <td width="12%" align="center">图片</td>
    <td width="12%" align="left">名称</td>
	  <td width="16%">首价格(<?=getCoinChar($config,0)?>)<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="16%">续价格(<?=getCoinChar($config,0)?>)<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="15%">折扣(单位<span class="red weight">%</span>)<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="16%">排序<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="9%">操作</td>
  </tr>
  <?
  $sql="select * from @@@express";
  $rs=query($sql);
  emptyList($rs,4);
  while($rows=fetch($rs))
  {
  if( $rows["country"]==-1 )
  		$title = "未分配的国家";
  else if( $rows["country"]==0 )
  		$title = "全部国家";
  else 
  		$title = fetchValue("select name as v from @@@deliveryarea where id=" . $rows["country"],"区域:已经删除");
  ?>
    
    <tr align="center" bgcolor="#FFFFFF"  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
      <td align="center"><?=$rows["id"]?></td>
      <td align="center"><a href="?action=edit&id=<?=$rows["id"]?>"><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>" vspace="4" /></a></td>
      <td align="left"><a href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a> <?=$title?></td>
	    <td class="point"  id="price1<?=$rows["id"]?>"><?=$rows["price1"]?></td>
      <td class="point"  id="price2<?=$rows["id"]?>" ><?=$rows["price2"]?></td>
      <td class="point"  id="discount<?=$rows["id"]?>" ><?=$rows["discount"]?></td>
      <td class="point"  id="sort<?=$rows["id"]?>" ><?=$rows["sort"]?></td>
    <td><a href="?action=edit&id=<?=$rows["id"]?>">编辑</a> <a class="delete red" onClick="return confirm('确定要删除吗？')"  href="?action=delete_save&id=<?=$rows["id"]?>">删除</a></td>
  </tr>
   <script language="javascript">
  $("#price1<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@express','price1',<?=$rows["id"]?>,1,8)}); 
  $("#price2<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@express','price2',<?=$rows["id"]?>,1,8)});
  $("#sort<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@express','sort',<?=$rows["id"]?>,1,8)});
   $("#discount<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@express','discount',<?=$rows["id"]?>,1,8)});
  </script>
 <?
 }
 free($rs);
 ?>
</table>
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
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
    <td width="16%" align="left">物流名称：</td>
    <td width="84%" >
      <input name="name" type="text" id="textfield" size="40" />  </td>
  </tr>
   <tr bgcolor="#FFFFFF" >
    <td width="16%" align="left">图片地址：</td>
    <td width="84%" ><img src="images/noimg.gif"  border="0"  vspace="4"  id="imgupload"><br>
<input name="pic" size="60" id="pic" type="text" />    </td>
  </tr>
  
   <tr bgcolor="#FFFFFF" >
     <td align="left">图片选择：</td>
     <td ><a href="javascript:asCallOnePic('express-pic/ems.gif','','systemImage/')"><img src="../systemImage/express-pic/ems.gif" border="0" style="margin-right:5px"></a><a href="javascript:asCallOnePic('express-pic/DHL.gif','','systemImage/')"><img src="../systemImage/express-pic/DHL.gif" border="0" style="margin-right:5px"></a><a href="javascript:asCallOnePic('express-pic/fedex.gif','','systemImage/')"><img src="../systemImage/express-pic/fedex.gif" border="0" style="margin-right:5px"></a><a href="javascript:asCallOnePic('express-pic/tnt.gif','','systemImage/')"><img src="../systemImage/express-pic/tnt.gif" border="0" style="margin-right:5px"></a><a href="javascript:asCallOnePic('express-pic/ups.gif','','systemImage/')"><img src="../systemImage/express-pic/ups.gif" border="0" style="margin-right:5px"></a></td>
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
	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object>	 </td>
   </tr>
   <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">域名链接：</td>
    <td width="84%" ><input name="url" type="text"   size="40"/>    </td>
  </tr>
   <tr bgcolor="#FFFFFF" class="" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" >
    <td width="16%" align="left">派送范围：</td>
    <td width="84%" ><select name="country" id="country">
		<option selected="selected" value="0">所有国家</option>
		<option value="-1">未分配的地区</option>
		<?
		$sql="select id as v,name as k from @@@deliveryarea where level=1";
		writeSelect($sql);
		?>
        </select> &nbsp;&nbsp;&nbsp;&nbsp;<a class="red" href="a_deliveryarea.php"><strong>配送区域</strong></a></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  class="hide">
    <td width="16%" align="left">计算公式：</td>
    <td width="84%" ><select name="type" id="type">
		<option value="0">按件数</option>
		<option selected="selected" value="1">按重量</option>
		<option value="2">自定义函数</option>
        </select> </td>
  </tr>
      <tr bgcolor="#FFFFFF"   onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)">
        <td align="left">起始数值：</td>
        <td ><input name="firstweight" type="text" id="tbPrice1" value="0.5"   size="10" maxlength="10"/>          （KG或者件）</td>
      </tr>
      <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" >
        <td align="left">首价格：</td>
        <td >  <?=getCoinChar($config,0)?>  <input name="price1" type="text" id="tbPrice1" value="0"   size="10" maxlength="10"/></td>
      </tr>
	   <tr bgcolor="#FFFFFF"   onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">续价格：</td>
        <td >  <?=getCoinChar($config,0)?> 
          <input name="price2" type="text" id="price2" value="0"   size="10" maxlength="10"/></td></tr>
      <tr bgcolor="#FFFFFF" class="hide"  >
        <td align="left">价格表：</td>
        <td >  (续价格如果是重量则是按 0.5KG 算，如果是件数 则按 1 件)<div style="background-color:#F2F4F6; border:1px #E3E6EB dotted; width:540px; padding-top:3px ">
		<div style="width:700px; padding:2px; line-height:30px; height:30px;">
	  <div style="float:left; width:120px"> ＞:
    
	    <input id="pnumpre0"  readonly="" class="readonly" value="0" type="text" style="width:70px"   />
      </div>
	  <div style="float:left; width:120px"> ≤:
	 
	    <input name="pnum0" value="" onKeyUp="changeNextValue(1,this)" type="text" style="width:70px;border:1px #CC0033 solid"   />
      </div>
	   
	  <div style="float:left;  ">
        首价格:  <?=getCoinChar($config,0)?> 
        <input name="pprice0"  value="0" style="width:70px"  type="text" /></div> 
      </div>
		<? 
	  $pnumpre = array();
	  $pnumpre[1] = 0.5 ;
	  for($index=1;$index<10;$index++)
	  {
	  ?>
	  <div id="pifadiv<?=$index?>" <? if($index>=2) { ?> class="hide" <? } ?> style="width:700px; padding:2px; line-height:30px; height:30px;">
	  <div style="float:left; width:120px"> ＞:
    
	    <input id="pnumpre<?=$index?>"   class="readonly"  readonly="" value="<?=$pnumpre[$index]?>" type="text" style="width:70px"   />
      </div>
	  <div style="float:left; width:120px"> ≤:
	    <input name="pnum<?=$index?>" value="<?=$pifanum[$index]?>"   onKeyUp="changeNextValue(<?=$index+1?>,this)" type="text" style="width:70px; border:1px #CC0033 solid"   />
      </div>
	   
	  <div style="float:left;  ">
        续价格:  <?=getCoinChar($config,0)?>
        <input name="pprice<?=$index?>" style="width:70px"   type="text" />
        &nbsp;不需要留空"<span style=" color:#CC0000; font-weight:bold">红色文本框</span>"</div> 
      </div>
	    
	  <?
	  }
	  ?>
    </div> </td></tr>
      <tr  bgcolor="#FFFFFF"   onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" >
        <td align="left">运费折扣：</td>
        <td ><input name="discount" type="text" id="discount" value="100"   size="10" maxlength="10"/>
        % （90% 为打9折）</td>
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
        <td align="left" valign="top">文本描述：</td>
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
global $cfg;
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
    <td width="16%" align="left">物流名称：</td>
    <td width="84%" ><input name="name" type="text" value="<?=$rows["name"]?>" size="40"/>    </td>
  </tr>
  <tr bgcolor="#FFFFFF" >
    <td width="16%" align="left">图片地址：</td>
    <td width="84%" ><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>" vspace="4" id="imgupload"/><br>
      <input name="pic" type="text" id="pic" size="60"   value="<?=$rows["pic"]?>" />    </td>
  </tr>
   <tr bgcolor="#FFFFFF" >
     <td align="left">图片选择：</td>
     <td ><a href="javascript:asCallOnePic('express-pic/ems.gif','','systemImage/')"><img src="../systemImage/express-pic/ems.gif" border="0" style="margin-right:5px"></a><a href="javascript:asCallOnePic('express-pic/DHL.gif','','systemImage/')"><img src="../systemImage/express-pic/DHL.gif" border="0" style="margin-right:5px"></a><a href="javascript:asCallOnePic('express-pic/fedex.gif','','systemImage/')"><img src="../systemImage/express-pic/fedex.gif" border="0" style="margin-right:5px"></a><a href="javascript:asCallOnePic('express-pic/tnt.gif','','systemImage/')"><img src="../systemImage/express-pic/tnt.gif" border="0" style="margin-right:5px"></a><a href="javascript:asCallOnePic('express-pic/ups.gif','','systemImage/')"><img src="../systemImage/express-pic/ups.gif" border="0" style="margin-right:5px"></a></td>
   </tr>
   <tr bgcolor="#FFFFFF" >
     <td align="left"><? $path_parts = pathinfo( $rows["pic"] );
	$todir = $path_parts["dirname"] ; 
	$todir = dataDefault($todir,strftime("%Y-%m-%d-%H",time()));
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
   <tr bgcolor="#FFFFFF" class=""  onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">派送范围：</td>
    <td width="84%" ><select name="country" id="country">
		<option value="0">所有国家</option>
		<option value="-1">未分配的地区</option>
		<?
		$sql="select id as v,name as k from @@@deliveryarea where level=1";
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
    </select>
    <script language="javascript">
		
		EnterSelect("type","<?=$rows["type"]?>");
		</script></td>
  </tr>
   <tr bgcolor="#FFFFFF"  onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" >
     <td align="left">起始数：</td>
     <td ><input name="firstweight" type="text" id="tbPrice1" value="<?=$rows["firstweight"]?>"   size="10" maxlength="10"/> （KG或者件）</td>
   </tr>
   <tr bgcolor="#FFFFFF"   onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">首价格：</td>
    <td >  <?=getCoinChar($config,0)?> 
          <input name="price1" type="text" id="tbPrice1" value="<?=$rows["price1"]?>"   size="10" maxlength="10"/></td></tr>
		   <tr bgcolor="#FFFFFF"  onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">续价格：</td>
        <td >  <?=getCoinChar($config,0)?> 
          <input name="price2" type="text" id="tbPrice2" value="<?=$rows["price2"]?>" size="10" maxlength="10"/></td></tr>
 <tr  bgcolor="#FFFFFF"   onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">运费折扣：</td>
      <td ><input name="discount" value="<?=$rows["discount"]?>" type="text" id="discount"   size="10" maxlength="10"/>
        % （90% 为打9折）</td>
    </tr>
     <tr bgcolor="#FFFFFF" class="hide"  >
        <td align="left">价格表：</td>
        <td >  
		 (续价格如果是重量则是按 0.5KG 算，如果是件数 则按 1 件)
	     <div style="background-color:#F2F4F6; border:1px #E3E6EB dotted; width:540px; padding-top:3px ">  <?
		   $pifanum=split($cfg["split"],$rows["pnum"]);
	  $pifaprice=split($cfg["split"],$rows["pprice"]);
	  array_pad($pifanum,20,"");
	  array_pad($pifaprice,20,"");
		   ?>
		   <div style="width:700px; padding:2px; line-height:30px; height:30px;">
	  <div style="float:left; width:120px"> ＞:
    
	    <input id="pnumpre0"  readonly="" class="readonly" value="0" type="text" style="width:70px"   />
      </div>
	  <div style="float:left; width:120px"> ≤:
	 
	    <input name="pnum0" value="<?=$pifanum[0]?>" onKeyUp="changeNextValue(1,this)" type="text" style="width:70px;border:1px #CC0033 solid"   />
      </div>
	   
	  <div style="float:left;  ">
        首价格:  <?=getCoinChar($config,0)?> 
        <input name="pprice0"  value="<?=$pifaprice[0]?>" style="width:70px"  type="text" /></div> 
      </div>
		  <?
	  
	  for($index=1;$index<10;$index++)
	  {

	  ?>
	      <div  id="pifadiv<?=$index?>" <? if($index>=2 && $pifanum[$index-1]=="") { ?> class="hide" <? } ?> style="width:700px; padding:2px; line-height:30px; height:30px;">
	  <div style="float:left; width:120px"> ＞:
    
	    <input id="pnumpre<?=$index?>"   class="readonly"  readonly="" value="<?=$pifanum[$index-1]?>" type="text" style="width:70px"   />
      </div>
	  <div style="float:left; width:120px"> ≤:
	    <input name="pnum<?=$index?>" value="<?=$pifanum[$index]?>"   onKeyUp="changeNextValue(<?=$index+1?>,this)" type="text" style="width:70px; border:1px #CC0033 solid"   />
      </div>
	   
	  <div style="float:left;  ">
        续价格:  <?=getCoinChar($config,0)?>
        <input name="pprice<?=$index?>" style="width:70px"  value="<?=$pifaprice[$index]?>"  type="text" />
        &nbsp;不需要留空"<span style=" color:#CC0000; font-weight:bold">红色文本框</span>"</div> 
      </div>
	  <?
	  }
	  ?>
	  </div> </td></tr>
 
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
        <td align="left" valign="top">文本描述：</td>
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
	
	if( strpos(fetchPic("@@@express",$id),"express-pic") === false )
		deleteImage( fetchPic("@@@express",$id) , $cfg["deleteImageAll"] , "../systemImage/",0 );
	
	query($sql);
	pageRedirect("2","a_express.php");
}

function add_save()
{
	global $cfg;
	$param["name"]=getForm("name");
	$param["sort"]=getForm("sort");
	$param["url"]=getForm("url");
	$param["pic"]=getForm("pic");
	$param["price1"]=getFormInt("price1",0,false);
	$param["price2"]=getFormInt("price2",0,false);
	
	$arrprice=array();
	$arrnum=array();
	for($indexI=0;$indexI<50;$indexI++)
	{
		$arrprice[$indexI]=getForm("pprice$indexI");
		$arrnum[$indexI]=getForm("pnum$indexI");
	}
	$param["pprice"]=join( $cfg["split"] , $arrprice ) ;
	$param["pnum"]=join( $cfg["split"] , $arrnum ) ;
	
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
	
	$arrprice=array();
	$arrnum=array();
	for($indexI=0;$indexI<50;$indexI++)
	{
		$arrprice[$indexI]=getForm("pprice$indexI");
		$arrnum[$indexI]=getForm("pnum$indexI");
	}
	$param["pprice"]=join( $cfg["split"] , $arrprice ) ;
	$param["pnum"]=join( $cfg["split"] , $arrnum ) ;
	
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
