<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻设置</title>
</head>

<body>
<?php require("php_top.php");?>
<?
$tmp_name="";
$tmp_classroot="newsclass";
$tmp_table="newsclass";
$tmp_maxlevel=5;
$tmp_redirect="";
?>

<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">新闻管理</div>
</div>
</td></tr></table>
<br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle">
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">新闻列表</a> <span class="fontpadding"><a class="add" href="?action=add">添加新闻</a></span> </td>
  </tr>
</table><br />
<?php
isAuthorize($group[2]);
$action=getQuery("action");
$u1=new unlimClass("@@@newsclass");
$proot=$u1->create("新闻分类");
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
    <td bgcolor="#F2F4F6" class="a_title"><strong>新闻搜索</strong></td>
  </tr> 
  <form name="form2" method="get" action="?">
  <tr  bgcolor="#FFFFFF">
   
      <td class="a_fen">输入标题：
        <input name="name" value="<?=getRequest("name")?>" type="text" size="40" id="keyword">
      <span class="fontpadding">分类搜索：
        <select name="classid" id="classid">
          <option value="">请选择分类</option>
 			<?
			$class=fetchAllClass("@@@newsclass");
			classOptionNoRoot($proot,$class,$proot);
			?>
        </select>
        <script>EnterSelect("classid","<?=getRequest("classid")?>")</script>	
		</span>
         <span class="fontpadding hide">新闻类型
          <select name="cid" id="cid">
          <option value="">请选择分类</option>
 		 <option value="1">产品新闻</option>
        </select>
        
                <script>EnterSelect("cid","<?=getRequest("cid")?>")</script>	
         </span>
		
    <input type="submit" name="Submit4"  value="提交"  class="button" >      </tr></form>
</table>
<br>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle" >
  <tr>
    <td colspan="5" bgcolor="#F2F4F6"><strong>新闻列表</strong></td>
  </tr>
  <tr   bgcolor="#FFFFE9">
  <td width="7%"  align="center"  >选择</td>
    <td  >新闻名称 </td>
    <td  align="center" >分类名称</td>
    <td width="10%" align="center" >访问量</td>
    <td width="10%" align="center"  >操作</td>
    
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
	$classid=fetchValue("select tree as v from @@@newsclass where id=" . getRequest("classid") , 0);
	$condition .= " and classid in ($classid)" ;
	$pageurl .=  "&classid=" . getRequest("classid") ;
}

if(getRequest("pid")!="")
{
	$condition .= " and pid=" . getRequest("pid") ;
	$pageurl .=  "&pid=" . getRequest("pid") ;
}

$class=fetchAllClass("@@@newsclass");

$pagenow=getQueryInt("page");
$pagesize=20;
$rs=createPage("*","@@@news",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
emptyList($rs,5);
while($rows=fetch($rs))
{
?>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
   <td   align="center" class="a_fen">
      <input name="cbid[]" type="checkbox" id="id" value="<?=$rows["id"]?>"></td>
    <td  class="a_fen"><a href="a_news.php?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a> </td>
    <td   align="center" class="a_fen"><?=fetchClassValue($class,$rows["classid"])?></td>
    <td   align="center" class="a_fen"><?=$rows["hits"]?></td>
    <td align="center" class="a_fen">
	<a href="?action=edit&id=<?=$rows["id"]?>">编辑</a> <a  onClick="return confirm('确定要删除吗？')"  class="delete red" href="?action=p_handl&do=deletepage&cbid[]=<?=$rows["id"]?>">删除</a> </td>
   
  </tr>
<?
}
mysql_free_result($rs);
?>
  <tr class="delete" bgcolor="#FFFFFF">
    <td colspan="8" class="a_fen">选择：<a  href="javascript:CheckAll('formdel','ON')">全选</a> 
      -
  <a  href="javascript:CheckAll('formdel','OFF')">取消</a>
  <span class="fontpadding">
  批量删除：
      <a href="javascript:submit_onClick('formdel','deletepage')" >当前所选</a> - 
	  <a href="javascript:submit_onClick('formdel','deleteall')" class="red" >搜索到的<?=$recordcount?>个结果</a>	  </span>
	   <input id="do" name="do" type="hidden" value="editpage" />
      <input type="hidden" name="condition" id="condition" value="<?=$condition?>" /></td>
	</tr>

</form>
  <tr bgcolor="#FFFFE9">
    <td colspan="5" align="right" ><? require("php_page.php")?></td>
  </tr>
</table>
<script>
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
<form action="?action=add_save" method="post" enctype="application/x-www-form-urlencoded" name="formadd">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>添加新闻</strong></td>
    </tr>
  
  <tr    bgcolor="#ffffff">
    <td>选择分类</td>
    <td><? classRelation($classid,8,"@@@newsclass"); ?></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>当前分类：</td>
    <td><input id="classname" type="text" readonly="" value="<?=fetchValue("select name as v from @@@newsclass where id=$classid","分类已被删除")?>" />
      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>
  </tr>
 <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="18%">标题：</td>
    <td width="82%"><input name="name" type="text" id="tbName"  style=" width:700px" /></td>
  </tr>
  <tr bgcolor="#FFFFFF"  onMouseMove="tr_onMouseOver(this)" class="hide" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">图片地址：</td>
    <td width="84%" ><img src="images/noimg.gif"  border="0"  vspace="4"  id="imgupload"><br><input name="pic" type="text" id="pic"  size="60"/>    </td>
  </tr>
  
   <tr bgcolor="#FFFFFF" class="hide" >
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
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
    <td valign="top">新闻类型：</td>
    <td><select name="cid" id="cid">
          <option value="0">站内新闻</option>
 		 <option value="1">产品新闻</option>
        </select>
		<Script>
		EnterSelect("cid","<?=getQueryInt("cid",0)?>")
		</script>		</td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
    <td valign="top">产品关联ID：</td>
    <td> <input name="pid" type="text" value="<?=getQueryInt("pid",0)?>" size="5" maxlength="6" /> </td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
    <td>显示类型：</td>
    <td><? showDisp($cfg["news"]["disp"]) ?></td>
  </tr>
  
    <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
      <td valign="top">排序：</td>
      <td><input name="sort" value="0" type="text" size="5" maxlength="6" /></td>
    </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
    <td valign="top">点击量：</td>
    <td><input name="hits" type="text" value="0" size="5" maxlength="6" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide" >
    <td valign="top">标题Title：</td>
    <td><textarea name="title" cols="50" rows="5" id="title"></textarea>
      <br />
      (文章页的标题,适当使用关键字,建议40-60英文之间)</td>
  </tr>
    <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"   class="hide" >
    <td valign="top">关键字Keyword：</td>
    <td><textarea name="keywords" cols="50" rows="5" id="keywords"></textarea>
      <br />
(文章的关键字,重点突出若干个相关关键字，避免使用不相关的，不超过20个)</td>
  </tr><tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide"  >
    <td valign="top">描述Description：</td>
    <td><textarea name="descript" cols="50" rows="5" id="descript"></textarea>
      <br />
      (简要的描述文章介绍,适当使用关键字造句(避免过度频繁使用),建议250英文之内)</td>
  </tr>
  
  <tr  bgcolor="#FFFFFF">
    <td valign="top">产品说明：</td>
    <td><?
		$oFCKeditor = $glo["fck"] ;
		$oFCKeditor->Value = "" ;
		$oFCKeditor->Create() ;
		?>	</td>
  </tr>

  <tr  class="add"  bgcolor="#FFFFE9">
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit5"  class="button" value="提交"  onClick="showtips(this)"/></td>
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
$sql="select * from @@@news where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$classid=$rows["classid"];
?>
<form action="?action=edit_save&id=<?=$id?>" method="post" enctype="application/x-www-form-urlencoded" name="formadd">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>编辑新闻</strong></td>
    </tr>
  
  <tr  bgcolor="#FFFFFF">
    <td>文章分类：</td>
    <td><? classRelation($classid,8,"@@@newsclass"); ?></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>当前分类：</td>
    <td><input id="classname" type="text" readonly="" value="<?=fetchValue("select name as v from @@@newsclass where id=$classid","分类已被删除")?>" />
      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="18%">标题：</td>
    <td width="82%"><input name="name" type="text" id="name" value="<?=$rows["name"]?>" style=" width:700px"/></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" class="hide" onMouseOut="tr_onMouseOut(this)"  >
    <td width="16%" align="left">图片地址：</td>
    <td width="84%" ><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>"   id="imgupload" vspace="4" /><br>
<input name="pic" type="text" id="pic"   value="<?=$rows["pic"]?>" size="60"/>    </td>
  </tr>
  <tr bgcolor="#FFFFFF" class="hide" >
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
	</object>

</td>
   </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
    <td valign="top">新闻类型：</td>
    <td><select name="cid" id="cid">
          <option value="0">站内新闻</option>
 		 <option value="1">产品新闻</option>
        </select>
		<Script>
		EnterSelect("cid","<?=$rows["cid"]?>")
		</script>		</td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide">
    <td valign="top">产品关联ID：</td>
    <td> <input name="pid" type="text" value="<?=$rows["pid"]?>" size="5" maxlength="6" /> </td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide">
    <td>显示类型：</td>
    <td><? showDisp($cfg["news"]["disp"]) ?>
	<script language="javascript">
		EnterCheckBox("disp[]","<?=c2tostr(decbin($rows["disp"]))?>");
	</script>
	</td>
  </tr>
  
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide" >
    <td valign="top">排序：</td>
    <td><input name="sort" type="text" value="<?=$rows["sort"]?>" size="5" maxlength="6" /></td>
  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
    <td valign="top">点击量：</td>
    <td><input name="hits" type="text" value="<?=$rows["hits"]?>" size="5" maxlength="6" /></td>
  </tr>
  </tr><tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide"  >
    <td valign="top">标题Title：</td>
    <td><textarea name="title" cols="50" rows="5" id="title"><?=$rows["title"]?></textarea>
      <br />
      (文章页的标题,适当使用关键字,建议40-60英文之间)</td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide" >
    <td valign="top">关键字Keyword：</td>
    <td><textarea name="keywords" cols="50" rows="5" id="keywords"><?=$rows["keywords"]?></textarea>
      <br />
(文章的关键字,重点突出若干个相关关键字，避免使用不相关的，不超过20个)</td>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide" >
    <td valign="top">描述Description：</td>
    <td><textarea name="descript" cols="50" rows="5" id="description"><?=$rows["descript"]?></textarea>
      <br />
      (简要的描述文章介绍,适当使用关键字造句(避免过度频繁使用),建议250英文之内)</td>
  </tr>
    
  <tr    bgcolor="#ffffff">
    <td valign="top">文章说明：</td>
    <td><?
		$oFCKeditor = $glo["fck"] ;
		$oFCKeditor->Value = $rows["content"] ;
		$oFCKeditor->Create() ;
		?></td>
  </tr>
    <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="">
    <td>是否更新：</td>
    <td>更新添加时间：<?=$rows["addtime"]?>  <br />
<input name="update" type="radio" value="0" checked >
      否
        <input type="radio" name="update" value="1">
      是</td>
  </tr>
  <tr  class="edit"   bgcolor="#FFFFE9">
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit5"  class="button" value="修改"  onClick="showtips(this)"/></td>
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
	$sql="delete from @@@news where id=$id";
	
	$arr=array("","mid_","small_","_big");
	//deleteImage( fetchPic("@@@news",$id) , $arr , "../ariticleImage/" );
	
	query($sql);
	pageRedirect("2","a_news.php");
}

function add_save()
{
	global $proot;
	$param["name"]=getForm("name");
	$param["sort"]=getFormInt("sort",1);
	$param["cid"]=getFormInt("cid",1);
	$param["pid"]=getFormInt("pid",1);
	$param["hits"]=getFormInt("hits",1);
	$param["disp"] = strtoint( getForm("disp") );
	$param["classid"]=getFormInt("classid",$proot);
	$param["disp"]=strtoint( getForm("disp") );
	$param["content"]=getHTML("content");
	$param["title"]=getForm("title");
	$param["descript"]=getForm("descript");
	$param["keywords"]=getForm("keywords");
	$param["pic"]=getForm("pic");
	$param["addtime"]=formatDateTime(time());
	$sql=insertSQL($param,"@@@news");
	query($sql);
	pageRedirect("0","a_news.php");
}

function edit_save()
{
	global $proot;
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["name"]=getForm("name");
	$param["sort"]=getFormInt("sort",1);
	$param["cid"]=getFormInt("cid",1);
	$param["pid"]=getFormInt("pid",1);
	$param["hits"]=getFormInt("hits",1);
	$param["disp"] = strtoint( getForm("disp") );
	//$param["disp"]=getFormInt("disp",1);
	$param["classid"]=getFormInt("classid",$proot);
	$param["content"]=getHTML("content");
	$param["title"]=getForm("title");
	$param["descript"]=getForm("descript");
	$param["keywords"]=getForm("keywords");
	$param["pic"]=getForm("pic");
	if ( getForm("update") !="1" )
	{
		$param["addtime"]=formatDateTime(time());
	}
	$sql=updateSQL($param,"@@@news",$condition);
	query($sql);
	pageRedirect("1","a_news.php");
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
		$condition=getForm("condition");
	}
	//deletePpic( "news" , $condition , array("","mid_","small_","_big"),"../articleImage/" );
	$rs=deleteRecord("@@@news","$condition");
	pageRedirect("2","a_news.php");
}
?>
<? require("php_bottom.php");?>
</body>
</html>
