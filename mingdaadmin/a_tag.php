<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>标签管理</title>
</head>

<body>
<?php require("php_top.php");
isAuthorize($group[2]);
?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">标签管理</div>
</div>
</td></tr></table>
<br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle">
  <tr  bgcolor="#F2F4F6">
    <td  ><a href="a_tag.php">标签管理</a><span class="fontpadding"><a href="a_tagtype.php" class="red">标签类型管理</a></span></td>
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
global $glo;
?><form name="form2" method="get" action="a_tag.php">
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>搜索条件</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td  >
      名称搜索：
        <input name="name" type="text" style="width:150px" id="keyword" value="<?=getRequest("name")?>" size="40">
    
      <span class="fontpadding">标签类型：
        <select name="type" id="type"  style="width:150px">
         <option value="">所有标签类型</option>
    <option value="-1">未配分</option>
   <?
    $sql = "select * from @@@ptaglist where type=0";
	$rs = query($sql);
	while($rows=fetch($rs))
	{
	?>
     <option value="<?=$rows["id"]?>"><?=$rows["name"]?></option>
     <?
	}
	 ?>
      </select>
        <script > EnterSelect("type","<?=getRequest("type")?>"); </script>
        </span>
       <span class="fontpadding">
      <input type="submit" name="Submit4" value="提交"  class="button" >	</span></td>
  </tr>
  </table>
</form><br>

<form name="formdel" method="post" action="?action=p_edit">
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="8" bgcolor="#F2F4F6"><strong>标签管理</strong><span class="fontpadding"><a href="a_tag.php?action=add">添加标签</a></span><span class="fontpadding"><a href="a_tag.php?action=p_add">批量添加标签</a></span></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9" >
    <td width="3%" align="center" >ID</td>
    <td width="23%" align="left" >标签名称</td>
    <td width="13%" align="center"   >排序<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="23%" align="left"   >前台链接</td>
    <td width="9%"   ><span class="a_fen">关联产品数</span></td>
    <td width="7%"   >标签类型</td>
    <td width="12%"   >添加时间</td>
    <td width="10%"   >操作</td> 
  </tr>
  <?
  $sql = "select * from @@@ptaglist where type=0";
	$rs = query($sql);
	while($rows=fetch($rs))
	{
		$tagtype[$rows["id"]] = $rows ;	
	}

  $condition = "where type!=0";
  $pageurl="1=1" ;
  if(getRequest("name")!="")
{
	$condition .=  " and name like '%" . filterSQL(getRequest("name")) . "%'" ;
	$pageurl .= "&name=" . getRequest("name") ;
}

if(getRequest("type")!="")
{
	$condition .=  " and type = " . getRequest("type") ;
	$pageurl .= "&type=" . getRequest("type") ;
}
  
  $orderby=" order by id desc";
	$pagenow=getQueryInt("page");
	$pageurl="1=1";
	$pagesize=20;
	$rs=createPage("*","@@@ptaglist",$condition,$orderby,$pagesize,$pagenow,$pagetotal,$recordcount);
  emptyList($rs,4);
  while($rows=fetch($rs))
  {
 $rows["rewrite"] = getRewritePre()  .  makeRewrite( $rows["name"]  ) . "-ptag" .$rows["id"]. ".html" ;
  //$times = (strtotime($rows["lasttime"])-strtotime($rows["addtime"]))/60 ;
  ?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td   align="center" class="a_fen"><input name="cbid[]" type="checkbox" id="id" value="<?=$rows["id"]?>"></td>
    <td   align="left" class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a></td>
   <td class="point"  id="sort<?=$rows["id"]?>"><?=$rows["sort"]?></td>
    
    <td align="left"   class="a_fen"><a target="_blank" href="<?=$rows["rewrite"]?>"><?=$rows["rewrite"]?></a></td>
    <td   class="a_fen"><?=$rows["count"]?></td>
    <td   class="a_fen"><?=$tagtype[$rows["type"]]["name"]?></td>
   
    <td   class="a_fen"><?=formatDate(strtotime($rows["addtime"]))?></td>
    <td   class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>">编辑</a> <a onClick="return confirm('确定是否删除？')" href="?action=delete_save&id=<?=$rows["id"]?>">删除</a></td> 
  </tr>
   <script language="javascript">
  $("#sort<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@ptaglist','sort',<?=$rows["id"]?>,true)});
  </script>
 <?
 }
 free($rs);
 ?> <tr bgcolor="#FFFFFF">
    <td colspan="10" class="a_fen">选择：<a  href="javascript:CheckAll('formdel','ON')">全选</a> 
      -
  <a href="javascript:CheckAll('formdel','OFF')">取消</a>
	   
	    <span class="fontpadding edit">
  批量编辑：
      <a href="javascript:submit_onClick('formdel','editpage')" >当前所选</a> 
	  </span>
      <input id="do" name="do" type="hidden" value="editpage" />
      <input type="hidden" name="condition" id="condition" value="<?=$condition?>" /></td>
	</tr>
   <tr bgcolor="#FFFFE9">
     <td colspan="8" align="right" ><? require("php_page.php")?></td>
   </tr>
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
$id=getQuerySQL("id");
$sql="select * from @@@ptaglist where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
?>
<form action="?action=edit_save&id=<?=$id?>" name="formedit" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑标签</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">标签名称：</td>
    <td width="84%" >
      <input type="text" style="width:350px" name="name" value="<?=$rows["name"]?>" id="name"></td>
  </tr> 
  
   <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
     <td align="left">标签类型：</td>
     <td ><select name="type" id="type">
    <option value="-1">未配分</option>
   <?
    $sql = "select * from @@@ptaglist where type=0";
	$rs = query($sql);
	while($srows=fetch($rs))
	{
	?>
     <option value="<?=$srows["id"]?>"><?=$srows["name"]?></option>
     <?
	}
	 ?>
      </select>
     <script language="javascript">
	 EnterSelect("type","<?=$rows["type"]?>");
	 </script></td>
   </tr> <tr   bgcolor="#FFFFFF">
     <td align="left">标签附加值：</td>
     <td ><input type="text" style="width:350px" value="<?=$rows["displayvalue"]?>" name="displayvalue" id="displayvalue"></td>
   </tr>
     <tr   bgcolor="#FFFFFF">
    <td>&nbsp;</td>
    <td>
	 <script language="javascript">
	 function asCallOnePic(pic,filename,uploadfolder)
	 {
	 	//alert(pic);
		document.getElementById("displayvalue").value = pic ;
	 }
	 </script>
	 <object id="uploadsystem" name="uploadsystem"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=uploadImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=uploadImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
  </tr>
   <tr   bgcolor="#FFFFFF">
    <td width="16%" align="left">SEO(标题Title)：</td>
    <td width="84%" ><textarea name="title"  style="width:700px; height:70px" id="title"><?=$rows["title"]?></textarea></td>
  </tr>
   <tr   bgcolor="#FFFFFF">
    <td width="16%" align="left">SEO(关键字Keywords)：</td>
    <td width="84%" ><textarea name="keywords"  style="width:700px; height:70px" id="title"><?=$rows["keywords"]?></textarea></td>
  </tr>
   <tr   bgcolor="#FFFFFF">
    <td width="16%" align="left">SEO(描述Descript)：</td>
    <td width="84%" ><textarea name="descript"  style="width:700px; height:70px" id="title"><?=$rows["descript"]?></textarea></td>
  </tr>
  <tr  class="hide"  bgcolor="#FFFFFF">
    <td width="16%" align="left" valign="top">标签介绍：</td>
    <td width="84%" >
		<?
		$oFCKeditor = $glo["fck"] ;
		$oFCKeditor->Value = $rows["content"] ;
		$oFCKeditor->Create() ;
		?>	</td>
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

?>
<form action="?action=add_save" name="formeadd" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加标签</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">标签名称：</td>
    <td width="84%" >
      <input type="text" style="width:350px" name="name" id="name"></td>
  </tr> 
  
   <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
     <td align="left">标签类型：</td>
     <td ><select name="type" id="type">
    <option value="-1">未配分</option>
   <?
    $sql = "select * from @@@ptaglist where type=0";
	$rs = query($sql);
	while($rows=fetch($rs))
	{
	?>
     <option value="<?=$rows["id"]?>"><?=$rows["name"]?></option>
     <?
	}
	 ?>
      </select>
   </td>
   </tr>
   <tr   bgcolor="#FFFFFF">
     <td align="left">标签附加值：</td>
     <td ><input type="text" style="width:350px" name="displayvalue" id="displayvalue"></td>
   </tr>
     <tr   bgcolor="#FFFFFF">
    <td>&nbsp;</td>
    <td>
	 <script language="javascript">
	 function asCallOnePic(pic,filename,uploadfolder)
	 {
	 	//alert(pic);
		document.getElementById("displayvalue").value = pic ;
	 }
	 </script>
	 <object id="uploadsystem" name="uploadsystem"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=uploadImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=uploadImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
  </tr>
   <tr   bgcolor="#FFFFFF">
    <td width="16%" align="left">SEO(标题Title)：</td>
    <td width="84%" ><textarea name="title"  style="width:700px; height:70px" id="title"></textarea></td>
  </tr>
   <tr   bgcolor="#FFFFFF">
    <td width="16%" align="left">SEO(关键字Keywords)：</td>
    <td width="84%" ><textarea name="keywords"  style="width:700px; height:70px" id="title"></textarea></td>
  </tr>
   <tr   bgcolor="#FFFFFF">
    <td width="16%" align="left">SEO(描述Descript)：</td>
    <td width="84%" ><textarea name="descript"  style="width:700px; height:70px" id="title"></textarea></td>
  </tr>
  <tr  class="hide"  bgcolor="#FFFFFF">
    <td width="16%" align="left" valign="top">标签介绍：</td>
    <td width="84%" >
		<?
		$oFCKeditor = $glo["fck"] ;
		$oFCKeditor->Value = '' ;
		$oFCKeditor->Create() ;
		?>	</td>
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
function p_edit()
{
	global $cfg;
	$strid=getRequestStr("cbid",0,0);
	$condition = "where id in ($strid)";
	$sql="select * from @@@ptaglist $condition";
	$rs = query($sql);
	
?><form action="?action=p_edit_save" method="post" enctype="application/x-www-form-urlencoded" name="formadd">
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td >
    选择了 
    <? while($rows=fetch($rs)) { ?><?=$rows["name"]?>,<? } ?> <input type="hidden" name="condition" value="<?=$condition?>" /> 
    </td>
  </tr>
</table>
<br />

<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>批量修改标签</strong></td>
    </tr>
    <tr  bgcolor="#FFFFFF">
    <td align="left">统一类型：</td>
    <td ><select name="type" id="type">
      <?
    for($index=0;$index<=count($cfg["product"]["tagtype"])-1;$index++)
	{
	?>
      <option value="<?=$index?>"><?=$cfg["product"]["tagtype"][$index]?></option>
      <?
	}
	 ?>
      </select>
      </td>
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
function p_addItem()
{
global $glo;
global $cfg;

?>
<form action="?action=p_add_save" name="formeadd" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>批量添加标签</strong></td>
  </tr>
  <? for($index=0;$index<=29;$index++)
  {
  ?>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">标签名称<?=$index?>：</td>
    <td width="84%" >
      <input type="text" style="width:350px" name="name<?=$index?>" id=""></td>
  </tr> 
  <?
  }
  ?>
  </table><br>

  <table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td align="left">统一类型：</td>
    <td ><select name="type" id="type">
    <option value="-1">未配分</option>
   <?
    $sql = "select * from @@@ptaglist where type=0";
	$rs = query($sql);
	while($rows=fetch($rs))
	{
	?>
     <option value="<?=$rows["id"]?>"><?=$rows["name"]?></option>
     <?
	}
	 ?>
      </select>
      </td>
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
	deleteRecord("@@@ptaglist",$condition);
				
	$condition = "where tid = '$id'";
	deleteRecord("@@@ptag",$condition);
	pageRedirect("2","a_tag.php");
}

function add_save()
{
	$name=getForm("name");
	$sql="select * from @@@ptaglist where name like '$name'";
	$rs=query($sql);
	isItemExist($rs);
	free($rs);
	
	$param=array();
	$param["name"]=getForm("name");
	$param["title"]=getForm("title");
	$param["keywords"]=getForm("keywords");
	$param["descript"]=getForm("descript");
	$param["displayvalue"]=getForm("displayvalue");
	$param["content"]=getHTML("content");
	$param["type"]=getFormInt("type",0);
	$param["addtime"] = formatDateTime(time());
	$sql=insertSQL($param,"@@@ptaglist");
	query($sql);
	
	
	pageRedirect("2","a_tag.php");
}

function p_add_save()
{
	for($index=0;$index<=29;$index++)
	{
		$name=getForm("name$index");
		if($name=="")
			continue;
		$sql="select * from @@@ptaglist where name like '$name'";
		$rs=query($sql);
		if(!BOF($rs))
			continue;
		free($rs);
		$param=array();
		$param["name"]=$name;
		$param["title"]=getForm("title");
		$param["keywords"]=getForm("keywords");
		$param["descript"]=getForm("descript");
		$param["displayvalue"]=getForm("displayvalue");
		$param["content"]=getHTML("content");
		$param["type"]=getFormInt("type",0);
		$param["addtime"] = formatDateTime(time());
		$sql=insertSQL($param,"@@@ptaglist");
		query($sql);
	}
	
	pageRedirect("2","a_tag.php");
}


function p_edit_save()
{
	$condition=$_POST["condition"];
	if($condition!="")
	{
		$param["type"]=getFormInt("type",0);
		$sql=updateSQL($param,"@@@ptaglist",$condition);
		query($sql);
	}
	pageRedirect("2","a_tag.php");
}

function edit_save()
{
	$id=getQuerySQL("id");
	$condition = "where  id ='$id'";
	$param=array();
	$param["name"]=getForm("name");
	$param["title"]=getForm("title");
	$param["keywords"]=getForm("keywords");
	$param["descript"]=getForm("descript");
	$param["displayvalue"]=getForm("displayvalue");
	$param["content"]=getHTML("content");
	$param["type"]=getFormInt("type",0);
	$param["addtime"] = formatDateTime(time());
	$sql=updateSQL($param,"@@@ptaglist",$condition);
	
	query($sql);
	
	$condition = "where  tid ='$id'";
	$param=array();
	$param["name"]=getForm("name");
	$sql=updateSQL($param,"@@@ptag",$condition);
	query($sql);
	
	pageRedirect("修改成功",$_SERVER['HTTP_REFERER']);
}
?>

<?php require("php_bottom.php");?>
</body>
</html>
