<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文件管理</title>
<script language="javascript">
function asCallJsSubmitFormData(spic)
{
	document.formadd.path.value=spic;
}
</script>
</head>

<body>
<?php require("php_top.php");?>
<?
$tmp_name="";
$tmp_classroot="downclass";
$tmp_table="downclass";
$tmp_maxlevel=5;
$tmp_redirect="";
?>

<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">文件管理</div>
</div>
</td></tr></table>
<br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle">
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">文件列表</a> <span class="fontpadding"><a class="add" href="?action=add">添加文件</a></span> </td>
  </tr>
</table><br />
<?php
isAuthorize($group[2]);
$action=getQuery("action");
$u1=new unlimClass("@@@downclass");
$proot=$u1->create("文件分类");
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
case "p_handl":
	if( getRequest("do")=="deletepage" )
	{
		p_delete_save(0);
	}
	elseif ( getRequest("do")=="deleteall" )
	{
		p_delete_save(1);
	}
	else
		showItem();
	break;
default:
	showItem();
	break;
}
?>
<script language="javascript">
   var xmlhttp;
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")

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
function fetch_Property_Div(obj)
{
	if(obj.value!=0)
	{
			xmlhttp.open("POST","../Service/ServiceForgetProperty.asp?id="+ obj.value,true);
	        xmlhttp.onreadystatechange=function(){sth_getProperty()};
            xmlhttp.send(null);
	}
}

function sth_getProperty()
{
 if(xmlhttp.readystate==4)
		   if(xmlhttp.status==200)
		      {   
	              document.getElementById("propertyDiv").innerHTML=xmlhttp.responseText;
		       }
}
</script>
<?
function showItem()
{
global $proot;
?>
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>文件搜索</strong></td>
  </tr> 
  <form name="form2" method="post" action="?">
  <tr  bgcolor="#FFFFFF">
   
      <td class="a_fen">输入标题：
        <input name="name" value="<?=getRequest("name")?>" type="text" id="keyword">
      <span class="fontpadding">分类搜索：
        <select name="classid" id="classid">
          <option value="">请选择分类</option>
 			<?
			$class=fetchAllClass("@@@downclass");
			classOptionNoRoot($proot,$class,$proot);
			?>
        </select>
        <script>EnterSelect("classid","<?=getRequest("classid")?>")</script>	
		</span>
        
		
    <input type="submit"   name="Submit4" value="提交"  class="button" >      </tr></form>
</table>
<br>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle" >
  <tr>
    <td colspan="4" bgcolor="#F2F4F6"><strong>文件列表</strong></td>
  </tr>
  <tr   bgcolor="#FFFFE9">
  <td width="7%"  align="center"  >选择</td>
    <td width="46%"  >文件名称 </td>
    <td width="20%"  align="center" >分类名称</td>
    <td width="27%" align="center"  >操作</td>
  </tr>

<form name="formdel" method="post" action="?action=p_handl">
<?
$condition="where 1=1" ;
$pageurl="1=1" ;

if(getRequest("name")!="")
{
	$condition .=  " and name  like '%" . getRequest("name") . "%'" ;
	$pageurl .= "&name=" . getRequest("name") ;
}

if(getRequest("cid")!="")
{
	$condition .= " and cid=" . getRequest("cid") ;
	$pageurl .=  "&cid=" . getRequest("cid") ;
}

if(getRequest("classid")!="")
{
	$classid=fetchValue("select tree as v from @@@downclass where id=" . getRequest("classid") , 0);
	$condition .= " and classid in ($classid)" ;
	$pageurl .=  "&classid=" . getRequest("classid") ;
}

if(getRequest("pid")!="")
{
	$condition .= " and pid=" . getRequest("pid") ;
	$pageurl .=  "&pid=" . getRequest("pid") ;
}

$class=fetchAllClass("@@@downclass");

$pagenow=getQueryInt("page");
$pagesize=20;
$rs=createPage("*","@@@download",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
emptyList($rs,5);
while($rows=fetch($rs))
{
?>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
   <td   align="center" class="a_fen">
      <input name="cbid[]" type="checkbox" id="id" value="<?=$rows["id"]?>"></td>
    <td  class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a> </td>
    <td   align="center" class="a_fen"><?=fetchClassValue($class,$rows["classid"])?></td>
    <td align="center" class="a_fen">
	<a href="?action=edit&id=<?=$rows["id"]?>">编辑</a> <a class="delete red" href="?action=p_handl&do=deletepage&cbid[]=<?=$rows["id"]?>" onClick="return confirm('确定要删除吗？')" >删除</a> </td>
  </tr>
<?
}
mysql_free_result($rs);
?>
  <tr  class="delete" bgcolor="#FFFFFF">
    <td colspan="4" class="a_fen">
	
  选择：<a onClick="CheckAll('formdel','ON')" href="#">全选</a> 
      -
  <a onClick="CheckAll('formdel','OFF')" href="#">取消</a>
  <span class="fontpadding">
  批量删除：
      <a href="#" class="red" onClick="submit_onClick('formdel','deletepage')">当前所选</a> - 
	  <a href="#" class="red" onClick="submit_onClick('formdel','deleteall')">搜索到的<?=$recordcount?>个结果</a>	  </span>
	   <input id="do" name="do" type="hidden" value="editpage" />
      <input type="hidden" name="condition" id="condition" value="<?=$condition?>" /></td>
	</tr>
</form>
  <tr bgcolor="#FFFFE9">
    <td colspan="4" align="right" ><? require("php_page.php")?></td>
  </tr>
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
global $glo;
global $cfg;
global $proot;
$classid=getRequestInt("classid",$proot);
?>
<form action="?action=add_save" method="post" enctype="application/x-www-form-urlencoded" name="formadd"><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >1 若文件引用其他网站!请在【文件路径】输入 类似#http://test/test.rar,格式为#加上链接<br>
2 文件支持格式：<?=join(',',$cfg["upload_fileType"])?></td>
  </tr>
</table><br>

<table width="96%" border="0" align="center" cellpadding="0" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>添加文件</strong></td>
    </tr>
  
  <tr    bgcolor="#ffffff">
    <td>文件分类</td>
    <td><? classRelation($classid,8,"@@@downclass"); ?></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>当前分类：</td>
    <td><input id="classname" type="text" readonly="" value="<?=fetchValue("select name as v from @@@downclass where id=$classid","分类已被删除")?>" />
      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>
  </tr>
 <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="18%">标题：</td>
    <td width="82%"><input name="name" type="text" id="tbName" size="60" /><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px"><strong>!</strong>留空将使用上传的文件名作为标题</span></td>
  </tr>
  <tr  class="hide"   bgcolor="#FFFFFF">
    <td valign="top">显示图片：</td>
    <td><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>" vspace="4" id="imgupload"/><br><input type="text" name="pic" size="60"  id="textfield" /></td>
  </tr>
 <tr  class="hide" bgcolor="#FFFFFF">
     <td align="left"><? $path_parts = pathinfo( $rows["pic"] );
	$todir = $path_parts["dirname"] ; 
	$todir = dataDefault($todir,strftime("%Y-%m-%d-%H",time()));
	?></td>
     <td ><script language="javascript">
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
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
   </tr>
  
    <tr   bgcolor="#FFFFFF">
      <td valign="top">文件路径：</td>
      <td><input type="text" name="path"  size="60"  id="textfield" /></td>
    </tr>
    
    <tr   bgcolor="#FFFFFF">
      <td ><?
	$todir = dataDefault($todir,strftime("%Y-%m-%d-%H",time()));
	?></td>
      <td><div style="color:#FF0000">若文件模块不能正常工作!请更新 FLASH for IE版本 到 9  <a target="_blank" href="http://www.skycn.com/soft/5671.html">更新</a></div>
	<script language="javascript">
	 function asCallDown(pic,filename,uploadfolder)
	 {
	 	//alert(pic);
		if( document.getElementById("name").value=="" )
		{
			arr = filename.split('.');
			document.getElementById("name").value = arr[0] ;
		}
		document.getElementById("path").value = pic ;
	 }
	 </script><object id="downloadsystem" name="downloadsystem"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="downloadupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallDown&filepath=download&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="downloadupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallDown&filepath=download&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
    </tr>
    <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
      <td valign="top">排序：</td>
      <td><input name="sort" value="0" type="text" size="5" maxlength="6" /></td>
    </tr>
  <tr  bgcolor="#FFFFFF">
    <td valign="top">说明：</td>
    <td><?
		$oFCKeditor = $glo["fck"] ;
		$oFCKeditor->Value = "" ;
		$oFCKeditor->Create() ;
		?>	</td>
  </tr>

  <tr  class="add"  bgcolor="#FFFFE9">
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit5"  class="button"  value="提交" /></td>
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
$id=getQuerySQL("id");
$sql="select * from @@@download where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$classid=$rows["classid"];
?>
<form action="?action=edit_save&id=<?=$id?>" method="post" enctype="application/x-www-form-urlencoded" name="formadd"><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >1 若文件引用其他网站!请在【文件路径】输入 类似#http://test/test.rar,格式为#加上链接<br>
2 文件支持格式：<?=join(',',$cfg["upload_fileType"])?></td>
  </tr>
</table><br>

<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>编辑文件</strong></td>
    </tr>
  
  <tr  bgcolor="#FFFFFF">
    <td>文件分类：</td>
    <td><? classRelation($classid,8,"@@@downclass"); ?></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>当前分类：</td>
    <td><input id="classname" type="text" readonly="" value="<?=fetchValue("select name as v from @@@downclass where id=$classid","分类已被删除")?>" />
      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="18%">标题：</td>
    <td width="82%"><input name="name" type="text" id="name" value="<?=$rows["name"]?>" size="60" /><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px"><strong>!</strong>留空将使用上传的文件名作为标题</span></td>
  </tr>
   <tr class="hide"   bgcolor="#FFFFFF">
    <td valign="top">显示图片：</td>
    <td><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>" vspace="4" id="imgupload"/><br>
<input type="text" name="pic" id="textfield" size="60"  value="<?=$rows["pic"]?>" />&nbsp;</td>
  </tr>
 <tr class="hide" bgcolor="#FFFFFF">
     <td align="left"><? $path_parts = pathinfo( $rows["pic"] );
	$todir = $path_parts["dirname"] ; 
	$todir = dataDefault($todir,strftime("%Y-%m-%d-%H",time()));
	?></td>
     <td ><script language="javascript">
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
			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
   </tr>
  <tr bgcolor="#FFFFFF">
      <td valign="top">文件路径：</td>
      <td><? if(substr($rows["path"],0,1)!="#")
				$rows["downloadpath"]="../download/" . $rows["path"];
			else
				$rows["downloadpath"]=substr($rows["path"],1);
		 ?><a href="<?=$rows["downloadpath"]?>" target="_blank">点击下载</a><br>
<input type="text" size="60"  name="path" id="textfield" value="<?=$rows["path"]?>"  /></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td ><?
	$todir = dataDefault($todir,strftime("%Y-%m-%d-%H",time()));
	?></td>
      <td><div style="color:#FF0000">若大文件模块不能正常工作!请更新 FLASH for IE版本 到 9  <a target="_blank" href="http://www.skycn.com/soft/5671.html">更新</a></div>
	<script language="javascript">
	 function asCallDown(pic,filename,uploadfolder)
	 {
	 	if( document.getElementById("name").value=="" )
		{
			arr = filename.split('.');
			document.getElementById("name").value = arr[0] ;
		}
		document.getElementById("path").value = pic ;
	 }
	 </script><object id="downloadsystem" name="downloadsystem"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="downloadupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallDown&filepath=download&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="downloadupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallDown&filepath=download&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
    </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td valign="top">排序：</td>
    <td><input name="sort" type="text" value="<?=$rows["sort"]?>" size="5" maxlength="6" /></td>
  </tr>
  <tr    bgcolor="#ffffff">
    <td valign="top">说明：</td>
    <td><?
		$oFCKeditor = $glo["fck"] ;
		$oFCKeditor->Value = $rows["content"] ;
		$oFCKeditor->Create() ;
		?></td>
  </tr>
  <tr  class="edit"   bgcolor="#FFFFE9">
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit5"  class="button"  value="修改" /></td>
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
	$path=fetchValue("select path as v from @@@download where id=$id","");
	if ( @file_exists(  "../download/$path" ) )
	{
		@unlink( "../download/$path" ) ;
	}
	$sql="delete from @@@download where id=$id";
	query($sql);
	pageRedirect("2","a_download.php");
}

function add_save()
{
	global $proot;
	$param["name"]=getForm("name");
	$param["sort"]=getFormInt("sort",1);
	$param["classid"]=getFormInt("classid",$proot);
	$param["content"]=$_POST["content"];
	$param["path"]=trim(getForm("path"));
	$param["pic"]=getForm("pic");
	$param["addtime"]=formatDateTime(time());
	$sql=insertSQL($param,"@@@download");
	query($sql);
	pageRedirect("0","a_download.php");
}

function edit_save()
{
	global $proot;
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["name"]=getForm("name");
	$param["sort"]=getFormInt("sort",1);
	$param["classid"]=getFormInt("classid",$proot);
	$param["content"]=$_POST["content"];
	$param["pic"]=getForm("pic");
	$param["path"]=trim(getForm("path"));
	$param["addtime"]=formatDateTime(time());
	$sql=updateSQL($param,"@@@download",$condition);
	query($sql);
	pageRedirect("1","a_download.php");
}

function p_delete_save($flag)
{
	if( $flag==0 )
	{
		$id=getRequestStr("cbid",0,0);
		$condition="where id in ($id)";
	}
	else
	{
		$condition=$_POST["condition"];
	}
	$rs=deleteRecord("@@@download","$condition");
	pageRedirect("2","a_download.php");
}
?>
<? require("php_bottom.php");?>
</body>
</html>
