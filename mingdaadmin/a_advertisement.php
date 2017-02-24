<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logo与广告</title>
</head>

<body>
<? $isAd = true; ?>
<?php require("php_top.php")?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">Logo与广告</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td   ><a href="?">Logo与广告</a><span class="fontpadding"><a href="?action=edit_favicon">修改ICO图标</a></span><span class="fontpadding"><a class="hide" href="?action=add">添加图片广告</a></span></td>
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
case "edit_favicon":
	edit_favicon();
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
case "editad":
	editad();
	break;
case "editad_save":
	editad_save();
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
    <td colspan="4"  bgcolor="#F2F4F6"><strong>Logo与广告上传</strong>
       </td>
  </tr>

  <tr align="center" bgcolor="#FFFFE9">
    <td width="7%" align="center">ID</td>
    <td width="59%" align="left">名称</td>
    <td width="13%">图片数量</td>
    <td width="21%">操作</td>
  </tr>
   <?
  $sql="select * from @@@ad";
  $rs=query($sql);
  emptyList($rs,4);
  while($rows=mysql_fetch_array($rs))
  {
  ?>
    
    <tr align="center"  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
      <td align="center"><?=$rows["id"]?></td>
      <td align="left"><a href="?action=editad&id=<?=$rows["id"]?>"><?=$rows["name"]?></a></td>
    <td><?=$rows["num"]?></td>
    <td><a href="?action=editad&id=<?=$rows["id"]?>">上传图片</a> <a class="hide red" href="?action=delete_save&id=<?=$rows["id"]?>" onClick="return confirm('确定要删除吗？')" >删除</a>
	<a class="hide" href="?action=edit&id=<?=$rows["id"]?>">编辑</a>
	</td>
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
global $glo;
?>
<form action="?action=add_save" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加图片广告</strong></td>
  </tr>
  
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">标题：</td>
    <td width="84%" >
      <input name="name" type="text" id="tbtitle" size="40" />  </td>
  </tr>
      <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" class="hide">
    <td width="16%" align="left">图片数量：</td>
    <td width="84%" ><input name="num" type="text"  value="0" size="6" maxlength="6"/>    </td>
  </tr>
     
    <tr bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input type="submit"  onClick="showtips(this)" class="button" name="button" id="button" value="提交" /></td>
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
$sql="select * from @@@ad where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=mysql_fetch_array($rs);
?>
<form action="?action=edit_save&id=<?=$id?>" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>修改图片广告</strong></td>
  </tr>
  
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">标题：</td>
    <td width="84%" >
      <input name="name" type="text" value="<?=$rows["name"]?>" size="40" />  </td>
  </tr>
      <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" class="hide">
    <td width="16%" align="left">图片数量：</td>
    <td width="84%" ><input name="num" type="text"  value="<?=$rows["num"]?>" size="6" maxlength="6"/>    </td>
  </tr>
     
    <tr bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input type="submit"  onClick="showtips(this)" class="button" name="button" id="button" value="提交" /></td>
  </tr>
</table>
</form>
<?
free($rs);
}
?>

<?
function edit_favicon()
{
	if( $_SERVER['REQUEST_METHOD']=="POST" )
	 {
		$path_parts = pathinfo($_FILES['file1']['name']);
		if( strtolower($path_parts["extension"])!="ico" )
		{
			$strmsg = "文件格式错误";
		}	
		if ($strmsg=="" && is_array($_FILES) ) 
		{
			foreach($_FILES AS $name => $value)
			{
				${$name} = $value['tmp_name'];
				$fp = @fopen(${$name},'r');
				$fstr = @fread($fp,filesize(${$name}));
				@fclose($fp);
				if($fstr!='' && (ereg("<\?",$fstr) || ereg("<\%",$fstr) ) )
				{
					 $strmsg = "文件内容错误";
					 return ;
				}
			}
		}
		$filesize=$_FILES["file1"]["size"];
		$upload_file = $_FILES['file1']['tmp_name'];
		if($strmsg=="" && $filesize ==0 )
		{
			$strmsg = "没有选择文件";
		}
		
		if ($strmsg=="" && !move_uploaded_file($upload_file,"../favicon.ico")) 
		{
			$strmsg = "上传失败";
		}
		$strmsg = dataDefault($strmsg,"上传成功");
	}	
?><table width="96%" border="0" cellspacing="0" cellpadding="1" align="center" class="tbtitle" style="border:1px #FEDF63 dotted;">
  <tr  bgcolor="#FFFFE6">
    <td >
	1. 网站使用：ICO图标可以作为标志，目前主流的浏览器都支持ICO图标，它显示于浏览器的地址栏、标签及收藏夹上。<br>
	例如：<img src="../skin/default/pic/ico_example.jpg" hspace="4" align="absmiddle">
	<br>
2. 一般情况下，作为把能作为代表网站内容的网站标志的图片制作成 16x16 或者 32x32 。<br>
	3. 也可用 <a href="http://tool.lanrentuku.com/favicon" target="_blank">在线生成器生成</a> 将JPG,GIF的图片转换成 ICO格式。
	<br>
4. 下面区域上传网站标志，格式必须为ICO。
	</td>
  </tr>
</table><br>

<form action="?action=edit_favicon&type=upload" enctype="multipart/form-data" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>修改Favicon.ico</strong></td>
  </tr>
  
  <tr bgcolor="#FFFFFF">
    <td width="16%" align="left">已上传ICO：</td>
    <td width="84%" ><? if(file_exists("../favicon.ico"))
	{
	?><img src="../favicon.ico" /><?
	}
	else
		echo "未探测到上传的Favicon.ico ";
	?></td>
  </tr>
 <?
 if( $strmsg!="" )
 {
 ?>
    <tr bgcolor="#ffffff">
      <td align="left">上传提示：</td>
      <td ><?=$strmsg?></td>
    </tr>
	<?
	}
	?>
	 <tr bgcolor="#ffffff">
      <td align="left">ICO上传：</td>
      <td ><input type="file"  name="file1" style="width:220px;"></td>
    </tr>
    <tr bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input type="submit"  onClick="showtips(this)" class="button" name="button" id="button" value="提交" /></td>
  </tr>
</table>
</form>
<?
free($rs);
}
?>

<?
function editad()
{
global $cfg;
$id=getQuerySQL("id");
$sql="select * from @@@ad where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=mysql_fetch_array($rs);
?><form name="formadd" action="?action=editad_save&id=<?=$id?>" enctype="application/x-www-form-urlencoded" method="post"><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td  >链接地址使用绝对路径。例如： 链接地址为 <span style="font-weight:bold; color:#FF0000">index.php</span>
      <input type="submit" class="button"  onClick="showtips(this)" name="Submit" value="点击此处统一提交" />
  </td>
  </tr>
</table>
<br />

 <?

	$arrpic=split( $cfg["split"] , $rows["pic"] );
	$arrurl=split( $cfg["split"] , $rows["url"] );
	$arrcontent=split( $cfg["split"] , $rows["content"] );
    $arrtitle=split( $cfg["split"] , $rows["title"] );
	array_pad($arrpic,50,"");
	array_pad($arrurl,50,"");
	array_pad($arrcontent,50,"");
	array_pad($arrtitle,50,"");
  for($indexI=0;$indexI <= $rows["num"]-1;$indexI++)
  {
  ?><table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>上传【<?=$rows["name"]?>】之<?=$indexI+1?>
    </strong>	</td>
    </tr>
 
  <tr align="center" bgcolor="#FFFFFF">
    <td width="16%" align="left" bgcolor="#FFFFE9">图片标题：</td>
    <td width="84%" align="left" bgcolor="#FFFFE9"><input name="title<?=$indexI?>" value="<?=$arrtitle[$indexI]?>"  type="text"   size="30" />&nbsp; 

    </td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td>链接地址：</td>
    <td><input name="url<?=$indexI?>"  value="<?=$arrurl[$indexI]?>"   type="text" size="50" /></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>图片地址：</td>
    <td><img  src="<?=getImageURL($arrpic[$indexI],-1,"systemImage/",0)?>"   id="imgupload<?=$indexI?>" vspace="4" /><br>
<input name="pic<?=$indexI?>" type="text" id="pic<?=$indexI?>"   value="<?=$arrpic[$indexI]?>" size="60"/> <a href="javascript:void(0)" onClick="$('#tr_upload<?=$indexI?>').removeClass('hide');">点击本地浏览上传</a></td>
  </tr>
  <tr bgcolor="#FFFFFF" class="hide" id="tr_upload<?=$indexI?>">
    <td>
	&nbsp;
	<?
	$path_parts = pathinfo( $arrpic[$indexI] );
	$todir = $path_parts["dirname"] ; 
	$todir = dataDefault("",strftime("%Y-%m-%d-%H",time()));
	?></td>
    <td><script language="javascript">
	 function asCallOnePic<?=$indexI?>(pic,filename,uploadfolder)
	 {
	 	//alert(pic);
		document.getElementById("pic<?=$indexI?>").value = pic ;
		document.getElementById("imgupload<?=$indexI?>").src = "../image.php?pic=" + escape(pic) + "&style=-1&folder=" + escape(uploadfolder);
	 }
	 </script>
	 <object id="uploadsystem<?=$indexI?>" name="uploadsystem<?=$indexI?>"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic<?=$indexI?>&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic<?=$indexI?>&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
    </tr>
</table> <br>
 <?
 }
 ?>
 <table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td align="center" ><input type="submit" class="button"  onClick="showtips(this)" name="Submit" value="提交" />
  </td>
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
	$sql="delete from @@@ad where id=$id";
	query($sql);
	pageRedirect("2","a_advertisement.php");
}

function add_save()
{
	$param["name"]=getForm("name");
	$param["num"]=getForm("num");
	$sql=insertSQL($param,"@@@ad");
	query($sql);
	pageRedirect("0","a_advertisement.php");
}

function editad_save()
{
	global $cfg;
	$id=getQuerySQL("id");
	$condition="where id=$id";
	for($indexI=0;$indexI<=49;$indexI++)
	{
		$arrpic[$indexI]=getForm("pic$indexI") ;
		$arrurl[$indexI]=getForm("url$indexI") ;
		$arrtitle[$indexI]=getForm("title$indexI") ;
		$arrcontent[$indexI]=getForm("content$indexI") ;
	}
	array_pad($arrpic,50,"");
	array_pad($arrurl,50,"");
	array_pad($arrtitle,50,"");
	array_pad($arrcontent,50,"");
	$param["pic"]=join( $cfg["split"] , $arrpic ) ;
	$param["title"]=join( $cfg["split"] , $arrtitle ) ;
	$param["url"]=join( $cfg["split"] , $arrurl ) ;
	$param["content"]=join( $cfg["split"] , $arrcontent ) ;
	$sql=updateSQL($param,"@@@ad",$condition);
	//debug($sql);
	query($sql);
	pageRedirect("1","a_advertisement.php");
}

function edit_save()
{
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["name"]=getForm("name");
	$param["num"]=getForm("num");
	$sql=updateSQL($param,"@@@ad",$condition);
	query($sql);
	pageRedirect("1","a_advertisement.php");
}
?>
<?php require("php_bottom.php")?>

</body>
</html>
