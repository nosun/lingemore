<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>派送单模板</title>
</head><script language="javascript" type="text/javascript"   charset='gb2312' src="JSFile/DateJs.js"></script>
<body>
<?php require("php_top.php");
isAuthorize($group[2]);
?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">派送单模板</div>
</div>
</td></tr></table>
<br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle">
  <tr  bgcolor="#F2F4F6">
    <td  ><a href="a_expresstpl.php">派送单模板</a><span class="fontpadding"><a href="?action=add">添加派送单模板</a></span></td>
  </tr>
</table><br>
<?php
$action=getQuery("action");
switch($action)
{
case "delete_save":
	delete_save();
	break;
case "add":
	addItem();
	break;
case "add_save":
	add_save();
	break;
case "edit_save":
	edit_save();
	break;
case "p_add":
	p_addItem();
	break;
case "p_add_save":
	p_add_save();
case "p_edit":
	p_edit();
	break;
case "p_edit_save":
	p_edit_save();
	break;
case "edit":
	editItem();
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
global $config;
global $glo;
?>
<form name="formdel" method="post" action="?action=p_edit">
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="3" bgcolor="#F2F4F6"><strong>派送单模板列表</strong></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9" >
    <td width="6%" align="center" >ID</td>
    <td width="82%" align="left" >物流公司</td>
    <td width="12%"   >操作</td> 
  </tr>
  <?
	$sql = "select * from @@@expresstpl";
	$rs=query($sql);
	emptyList($rs,4);
  while($rows=fetch($rs))
  {起
	 
  //$times = (strtotime($rows["lasttime"])-strtotime($rows["addtime"]))/60 ;
  ?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td   align="center" class="a_fen"><?=$rows["id"]?></td>
    <td   align="left" class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a></td>
    <td   class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>">编辑</a> <a onClick="return confirm('确定是否删除？')" class="red" href="?action=delete_save&id=<?=$rows["id"]?>">删除</a></td> 
  </tr>
 <?
 }
 free($rs);
 ?> 
 </table><script>
function submit_onClick(formdel,strdo)
{
	if(strdo=="editpage"||strdo=="deletepage")
	{
		var inps=document.getElementsByName("cbid[]");
		var count=0;
		for(var i=0; i<inps.length;i++)
		{
			if(inps[i].checked==true)
			count++;
		}
		if(count<=0)
		{
			alert("请至少选择一项");
			return;
		}
	}
	document.getElementById("do").value=strdo;
	if(confirm("确定执行该操作吗?"))
	{
		document.forms[formdel].submit();
	}
}
</script>
</form>
<?
}
?>


<?
function editItem()
{
global $glo;
global $cfg;
global $config;
$id=getQuerySQL("id");
$sql="select * from @@@expresstpl where id='$id'";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);

?>
<form action="?action=edit_save&id=<?=$id?>" name="formedit" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>修改派送单模板</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">物流公司：</td>
    <td width="84%" >
    <input type="text" style="width:350px" name="name" value="<?=$rows["name"]?>" id="name">  </tr> 
    <tr bgcolor="#FFFFFF" >
      <td width="16%" align="left">图片地址：</td>
      <td width="84%" ><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>" width="200" vspace="4" id="imgupload"/><br>
  <input name="pic" size="60" id="pic" value="<?=$rows["pic"]?>" type="text" />    </td>
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
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
     <td >自定义变量：</td>
     <td ><textarea name="varcontent" style="width:700px; height:70px"><?=$rows["varcontent"]?></textarea></td>
   </tr>
  <tr class="edit"  bgcolor="#FFFFE9">
      <td width="16%" align="left">&nbsp;</td>
      <td width="84%" ><input name="button2"  onClick="showtips(this)" class="button"  type="submit" value="修改" />    </td>
    </tr>
</table>
</form>
<?
}
?>

<?
function addItem()
{
global $glo;
global $cfg;
global $config;
?>
<form action="?action=add_save" name="formeadd" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加派送单模板</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">物流公司：</td>
    <td width="84%" >
      <input type="text" style="width:350px" name="name" value="" id="name"></td>
  </tr> 
   <tr bgcolor="#FFFFFF" >
     <td width="16%" align="left">图片地址：</td>
     <td width="84%" ><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>" vspace="4" id="imgupload"/><br>
      <input name="pic" type="text" id="pic" size="60"   value="<?=$rows["pic"]?>" />    </td>
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
		document.getElementById("pic").width = 200 ;
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
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>自定义变量：</td>
    <td><textarea name="varcontent" style="width:700px; height:70px"><?=$rows["varcontent"]?></textarea></td>
  </tr>
  <tr class="edit"  bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input name="button2"  onClick="showtips(this)" class="button"  type="submit" value="修改" />    </td>
  </tr>
</table>
</form>
<?
}
?>
<?
function delete_save()
{
	$id=getQuerySQL("id");
	$condition = "where  id ='$id'";
	deleteRecord("@@@expresstpl",$condition);
				
	pageRedirect("2","a_expresstpl.php");
}

function add_save()
{
	
	$param=array();
	$param["name"]=getForm("name");
	$param["varcontent"]=getForm("varcontent");
	$param["pic"]=getForm("pic");
	$param["addtime"]=formatDateTime(time());
	$sql=insertSQL($param,"@@@expresstpl");
	query($sql);
	pageRedirect("2","a_expresstpl.php");
}


function edit_save()
{
	$id=getQuerySQL("id");
	$condition = "where  id ='$id'";
	$param=array();
	$param["name"]=getForm("name");
	$param["pic"]=getForm("pic");
	$param["varcontent"]=getForm("varcontent");
	$param["addtime"]=formatDateTime(time());
	$sql=updateSQL($param,"@@@expresstpl",$condition);
	query($sql);
	pageRedirect("修改成功",$_SERVER['HTTP_REFERER']);
}
?>

<?php require("php_bottom.php");?>
</body>
</html>
