<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>图片管理</title>
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
<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">图片管理</div>
</div>
</td></tr></table>
<br />
<?
isAuthorize($group[2]);
$pid = getQuery("pid");
$sql="select * from @@@product where id=$pid";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$pname=$rows["name"];
free($rs);
?>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td >
	你选择了
	 <a href="a_product.php?id=<?=$pid?>&action=edit"><span class="STYLE1"><?=$pname?></span> </a>
	 。	</td>
  </tr>
</table><br />
<script>
function asCallJsSubmitFormData(str)
{
	//alert(str);
	document.getElementById("pic").value=str;
	document.getElementById("formadd").submit();
}

function CheckAll(formdel,str)
{
  for (var i=0;i<document.forms[formdel].elements.length;i++)
  {
    var e = document.forms[formdel].elements[i];
    if (str=="ON")
	   e.checked = true;
	else
		e.checked= false; 
  }
}

function changeImage(path)
{
	document.getElementById("imgupload").src=path;
}

</script>
<?php
$pid=getQuerySQL("pid");
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
global $pid;

?>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >排序越小,排列时候排名越前面</td>
  </tr>
</table><br>

<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="5" bgcolor="#F2F4F6"><strong>图片列表</strong><span class="fontpadding"><a href="?action=add&pid=<?=$pid?>">添加图片</a></span></td>
  </tr>
  <tr align="center" bgcolor="#FFFFE9">
   <td width="15%" align="center"  > 图片</td>
    <td width="49%" align="left" >名称<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="11%" align="center"  >类型</td>
    <td width="13%" align="center"  >排序<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="12%" align="center"  >操作</td>
  </tr>

<form name="formdel" method="post" action="?action=p_del&pid=<?=$pid?>">
<?
$condition="where 1=1" ;
$pageurl="1=1" ;
$arr = array("细节图片","属性模板图片");
if(getRequest("pid")!="")
{
	$condition .= " and pid=" . getRequest("pid") ;
	$pageurl .=  "&pid=" . getRequest("pid") ;
}

$sql="select * from @@@otherimage $condition order by type asc,id desc";
$rs=query($sql);
emptyList($rs,5);
while($rows=fetch($rs))
 {
?>
  <tr bgcolor="#FFFFFF">
  <td   align="center" class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>&pid=<?=$pid?>"><img src="<?=getImageURL($rows["pic"],3,"otherImage/",IMAGE)?>" border="0"></a></td>
    <td  class="a_fen point" id="name<?=$rows["id"]?>"><?=$rows["name"]?></td>
    <td   align="center" ><?=$arr[$rows["type"]]?></td>
    <td   align="center"  class="a_fen point" id="sort<?=$rows["id"]?>" ><?=$rows["sort"]?></td>
    <td   align="center" class="a_fen"><a onClick="return confirm('确定要删除吗？')"  class="red" href="?action=delete_save&id=<?=$rows["id"]?>&pid=<?=$pid?>">删除</a> <a href="?action=edit&id=<?=$rows["id"]?>&pid=<?=$pid?>">编辑</a></td>
  </tr>
  <script language="javascript">
  $("#name<?=$rows["id"]?>").bind("click",function(){getValueHTML('otherimage','name',<?=$rows["id"]?>,0,30)}); 
  $("#sort<?=$rows["id"]?>").bind("click",function(){getValueHTML('otherimage','sort',<?=$rows["id"]?>,1)}); 
  </script>
<?
}
?>
</form>
</table>
<script>
function submit_onClick(formdel,strdo)
{
	document.getElementById("do").value=strdo;
	if(confirm("确定执行删除吗?"))
	{
		document.forms[formdel].submit();
	}
}
</script>
<?
}
?>

<?
function addItem()
{
global $pid;
global $cfg;
?>
<form action="?action=add_save&pid=<?=$pid?>" method="post" enctype="application/x-www-form-urlencoded" name="formadd" id="formadd">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="6"><strong>批量添加图片</strong></td>
    </tr>
	<tr  bgcolor="#FFFFFF">
    <td>商品名称：</td>
    <td><span style="background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px"><input name="nametype" onClick="showorhide(this)" checked="checked" type="checkbox" value="1"> 
    使用上传的图片名名称</span><script language="javascript">
	function showorhide(obj)
	{
		if(obj.checked)
			document.getElementById("tr_name").style.display="none";
		else
			document.getElementById("tr_name").style.display="block";
	}
	</script></td>
  </tr>
  <tr id="tr_name" style="display:none" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td>&nbsp;</td>
    <td><input name="name" type="text" size="30" />
      （
        <input name="nstart" type="text" size="10" /> 
        该框必须填入 <span style="color:#FF0000; font-weight:bold">数字</span>,可留空 ; 开始递增的第一个数; 格式类似 : 0001 或者 10 
      ）</td>
  </tr>
<tr class="hide" bgcolor="#FFFFFF" >
    <td>图片类型：</td>
    <td><select name="type" id="type">
      <option selected="selected" value="0">细节图片</option>
      <option value="1">属性模板图片</option>
    </select>
	
	</td>
  </tr>
  
  <tr    bgcolor="#FFFFFF">
    <td width="20%" valign="top">批量上传：</td>
    <td>
	<div style="color:#FF0000">若批量上传模块不能正常工作!请更新 FLASH for IE版本 到 9  <a target="_blank" href="http://www.skycn.com/soft/5671.html">更新</a></div>
	
	
	<object  id="uploadsystem" name="uploadsystem" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="450" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="uploadsystem1.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&filepath=otherImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&server=<?=urlencode(CGIBIN)?>&<?=REMOTECOMMAND?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="uploadsystem1.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&maxsize=<?=$cfg["upload_maxsize"]*1024?>&filepath=otherImage&server=<?=urlencode(CGIBIN)?>&<?=REMOTECOMMAND?>" quality="high" bgcolor="#869ca7" width="700" height="450" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object>
      <input type="hidden" id="pic" name="pic" /></td>
  </tr>
</table>

</form>
<?
}
?>
<?
function editItem()
{
	global $pid;
	$id=getQuerySQL("id");
	$sql="select * from @@@otherimage where id=$id";
	$rs=query($sql);
	isItemNotExist($rs);
	$rows=fetch($rs);
?>
<form action="?action=edit_save&id=<?=$id?>&pid=<?=$pid?>" method="post" enctype="application/x-www-form-urlencoded" name="formadd">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>图片编辑</strong></td>
    </tr>
  <tr bgcolor="#FFFFFF">
    <td width="18%">图片名称：</td>
    <td width="82%"><input size="60" name="name" value="<?=$rows["name"]?>" type="text"  /></td>
  </tr>
  <tr   class="hide" bgcolor="#FFFFFF" >
    <td>图片类型：</td>
    <td><select name="type" id="type">
      <option value="0">细节图片</option>
      <option value="1">属性模板图片</option>
    </select>
	<script language="javascript">
		EnterSelect("type","<?=$rows["type"]?>");
	</script>
	</td>
  </tr>
  <tr bgcolor="#FFFFFF" class="hide">
    <td>图片排序：</td>
    <td><input id="tbsort" name="sort"  type="text"  value="<?=$rows["sort"]?>"/>
      </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td valign="top">图片：</td>
    <td><img src="<?=getImageURL($rows["pic"],3,"otherImage/",IMAGE)?>" id="imgupload"  vspace="4"  border="0"><br>
<input name="pic" type="text" id="pic" value="<?=$rows["pic"]?>" size="60" class="readonly"  /></td>
  </tr>
  
  <tr bgcolor="#FFFFFF">
    <td><? $path_parts = pathinfo( $rows["pic"] );
	$todir = $path_parts["dirname"] ;
	$todir = dataDefault($todir,strftime("%Y-%m-%d-%G",time()));
	 ?></td>
    <td> <script language="javascript">
	 function asCallOnePic(pic,filename,uploadfolder)
	 {
	 	//alert(pic);
		document.getElementById("pic").value = pic ;
		document.getElementById("imgupload").src = "<?=REMOTE?>image.php?pic=" + escape(pic) + "&style=1&folder=" + escape(uploadfolder);
	 }
	 </script><object id="uploadsystem" name="uploadsystem"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic&filepath=otherImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic&filepath=otherImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
  </tr>
  <tr bgcolor="#FFFFE9">
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit5"  class="button"  value="修改" /></td>
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
	global $pid;
	global $cfg;
	$id=getQuerySQL("id");
	
	$arr=$cfg["deleteImageAll"];
	deleteImage( fetchPic("@@@otherimage",$id) , $arr , "../otherImage/",IMAGE );
	
	$rs=deleteRecord("@@@otherimage","where id=$id");
	if( mysql_num_rows($rs)!=0 )
	{
		$rows=fetch($rs);
		
	}
	free($rs);
	pageRedirect("2","a_image.php?pid=$pid");
}

function add_save()
{
	global $pid;
	global $cfg;
	$pic=split('\|',getForm("pic"));
	//debug($pic);
	for($index=0;$index<count($pic);$index++)
	{
		$param=array();
		if( getForm("nstart")!=""  )
		{
			$strid=getForm("nstart");
			$strname = str_pad((int)$strid+$index,strlen($strid),0,STR_PAD_LEFT);
		}
		
		if( getForm("nametype")=="" )
		{
			$param["name"]=getForm("name") . $strname ;
			$arrcontent=split( '\^',$pic[$index] );
			$tempname= explode("." , $arrcontent[1]);
			$param["pic"]=trim(clear_php_bom($arrcontent[0]));
		}
		else
		{
			$arrcontent=split( '\^',$pic[$index] );
			$tempname= explode("." , $arrcontent[1]);
			$param["name"]=trim(clear_php_bom($tempname[0]));
			$param["pic"]=trim(clear_php_bom($arrcontent[0]));
		}
		
		//$param["name"]=getForm("name$index");
		$param["cid"]=getFormInt("cid",0);
		$param["pid"]=getFormInt("pid",$pid);
		$param["sort"]=getFormInt("sort$index",0);
		$param["type"]=getFormInt("type",0);
		$sql=insertSQL($param,"@@@otherimage");
		query($sql);
		$param=array();
		$param["sort"]="@id";
		$condition = "where id=" . mysql_insert_id();
		$sql=updateSQL($param,"@@@otherimage",$condition);
		query($sql);
	}
	pageRedirect("0","a_image.php?pid=$pid");
}

function edit_save()
{
	global $pid;
	global $cfg;
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["name"]=getForm("name");
	$param["pic"]=getForm("pic");
	
	$oldpic = fetchPic("@@@otherimage",$id);
	if( $oldpic != getForm("pic") )
	{
		$arr=$cfg["deleteImageAll"];
		deleteImage( $oldpic , $arr , "../otherImage/",IMAGE );
	}
	
	$param["pid"]=getFormInt("pid",$pid);
	$param["sort"]=getFormInt("sort",0);
	$param["type"]=getFormInt("type",0);
	$sql=updateSQL($param,"@@@otherimage",$condition);
	query($sql);
	
	
	pageRedirect("1","a_image.php?pid=$pid");
}
?>

<?php require("php_bottom.php");?>
</body>
</html>
