<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻分类管理</title>
<script language="javascript" src="../JSFile/base.js"></script>
<script>
function cshow(id)
{
	var obj=document.getElementById("sc"+id);
	if(obj!=null)
	{
		if (obj.style.display=="none")
		 {
			obj.style.display="block";
			document.getElementById("img"+id).src="images/opened.gif"
		 }
		else
		 {
			 obj.style.display="none";
			 document.getElementById("img"+id).src="images/closed.gif"
		 }
	}
	
}

function sth_getsondiv(xml,id)
{
	document.getElementById("img"+id).src="images/opened.gif"
	var newobj=document.createElement("div");
	newobj.id="sc"+id;
	newobj.innerHTML=xml.responseText;
	var objItem=document.getElementById("item"+id);
	insertAfter(newobj,objItem);
}
</script>
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
-->
</style>
</head>
<style>
.c0 {line-height:18px; }
.c1{line-height:18px;  }
.c2{  line-height:18px;}
.c3{ line-height:18px; }
.c4{  line-height:18px; }
.c5{  line-height:18px; }


a.a1:link{color: #990000;font-weight:bold; font-size:14px;}
a.a1:visited{color:#990000;font-weight:bold;font-size:14px}
a.a1:hover{color:#990000;font-weight:bold;font-size:14px}
a.a1:active{color:#990000;font-weight:bold;font-size:14px}

a.a2:link{color:#000000;}
a.a2:visited{color:#000000;}
a.a2:hover{color:#000000;}
a.a2:active{color:#000000;}

a.a3:link{color: #CC0000;}
a.a3:visited{color:#CC0000;}
a.a3:hover{color:#CC0000;}
a.a3:active{color:#CC0000;}

a.a4:link{color: #CC0000;}
a.a4:visited{color:#CC0000;}
a.a4:hover{color:#CC0000;}
a.a4:active{color:#CC0000;}

a.a5:link{color: #CC0000;}
a.a5:visited{color:#CC0000;}
a.a5:hover{color:#CC0000;}
a.a5:active{color:#CC0000;}
</style>
<body>
<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">文件分类管理</div>
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
    <td    ><a href="?">新闻分类列表</a>&nbsp;</td>
  </tr>
</table>
<br />
<?
isAuthorize($group[2]);
$maxlevel=2;
$table="downclass";
$rootname="下载文件分类";
$page="a_downclass.php";

$u=new unlimClass($table);
$root=$u->create("$rootname");
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
case "p_edit_save":
	p_edit_save();
	break;
case "p_edit":
	p_editItem();
	break;
case "move":
	moveItem();	
	break;
case "move_save":
	move_save();
	break;
default:
	showItem();
	break;
}
?>
<?
function showItem()
{
global $root;
global $maxlevel;
global $table;
?>
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="4"  bgcolor="#F2F4F6"><strong>分类列表</strong></td>
  </tr>
 <Tr>
  <td  style="padding:0">
  
  <?
  
  $class=fetchAllClass("$table");
  function classShow($class,$id,$maxlevel)
  {
  $arrstate=array("隐藏","显示");
  $name=$class[$id]["name"];
  $son=$class[$id]["son"];
  $level=(int)$class[$id]["level"];
  $state=$class[$id]["state"];
  $sort=$class[$id]["sort"];
  ?>
  
   <div id="item<?=$id?>" class='c<?=$level?>'>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" >
	<tr  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td height="18" align="left" style="padding-left:<?=20*$level+5?>px;line-height:18px; ">
	
	<? 
	if( $son!="" && $level<2 ) 
	{
		$str='display:block';
	?>
		<img id="img<?=$id?>" border="0" align="absmiddle" onClick="javascript:cshow('<?=$id?>')" src="images/opened.gif" class="cur2"> <a href="?action=edit&id=<?=$id?>"><?=$name?></a>
	<? 
	}
	else if( $son!="" && $level>=2)
	{
		$str='display:none';
	?>
		<img id="img<?=$id?>" border="0" align="absmiddle" onClick="javascript:cshow('<?=$id?>')" src="images/closed.gif" class="cur"> <a href="?action=edit&id=<?=$id?>"><?=$name?></a>
	<? 
	}
	else 
	{
	?>
		<img id="img<?=$id?>" border="0" align="absmiddle" src="images/empty.gif">  <a href="?action=edit&id=<?=$id?>"><?=$name?></a>
	<? 
	}
	?>
	</td>
	<td align="center" width="60"><?=$arrstate[$state]?></td>
	<td align="center" width="60"><?=$sort?></td>
    <td align="center" width="300">
<a class="add" onClick="return checkLevel(<?=$level?>,<?=$maxlevel?>)" href="?action=add&id=<?=$id?>">添加</a>
<a href="?action=edit&id=<?=$id?>">编辑</a>
<a href="?action=p_edit&id=<?=$id?>">批量编辑</a>
<a class="delete" onClick="return confirm('确定删除吗')" href="?action=delete_save&id=<?=$id?>">删除</a>
<a href="?action=move&id=<?=$id?>">移动</a>
<a href="a_download.php?action=add&classid=<?=$id?>">添加文件</a></td>
  </tr>
  </table>
  </div>
  
	<?
		
		if($son!="")
		{
			echo "<div id='sc$id' style='$str'>";
			$arrson=split(',',$son);
			for($index=0;$index<count($arrson);$index++)
			{
				classShow($class,$arrson[$index],$maxlevel);
			}
			echo "</div>";
		}
	}
	  classShow($class,$root,$maxlevel);
	?>
	
	</td></Tr>
</table>
<?
}
?>

<?
function addItem()
{
global $maxlevel;
global $table;
$id=getQuerySQL("id");
$sql="select * from $table where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$name=$rows["name"];
free( $rs );

$sql="select sort from $table where father=$id order by sort desc limit 0,1";
$startsort=0;
$rs=query($sql);
if( mysql_num_rows($rs)!=0 )
{
	$rows=fetch($rs);
	$startsort=$rows["sort"];
}
free( $rs );
?>
<form action="?action=add_save" enctype="application/x-www-form-urlencoded" name="formadd" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="4"  bgcolor="#F2F4F6"><strong>添加分类</strong></td>
  </tr>
  <tr   bgcolor="#FFFFFF">
    <td colspan="4" align="left">上级分类：<span class="STYLE1">
     <?=$name?> </span>
	 <input name="father" type="hidden" value="<?=$id?>" />
    </td>
    </tr>
 <?
 for($index=1;$index<=10;$index++)
 {
 ?>
  <tr  bgcolor="#FFFFFF">
    <td colspan="4" align="left" bgcolor="#FFFFE9"><?=$index?> . 分类名称：
      <input type="text" value="" name="name<?=$index?>"/>  &nbsp;
      排序：
      <input name="sort<?=$index?>" type="text"  value="<?=$startsort+10*$index?>" size="5" maxlength="5"/>
      &nbsp;
      分类图片：
      <input name="pic<?=$index?>" type="text" id="pic " size="40" /></td>
    </tr>
   <tr   bgcolor="#FFFFFF">
     <td colspan="4" align="left">
	 <IFRAME ID="uppic" SRC="php_upload.php?form=formadd&input=pic<?=$index?>&path=systemImage" FRAMEBORDER="0"  SCROLLING="no" WIDTH="700" HEIGHT="35" ></IFRAME>
	 </td>
    </tr>
  <?
}
  ?>
   <tr   class="add"  bgcolor="#FFFFE9">
    <td width="13%" align="left">&nbsp;</td>
    <td colspan="3" ><input type="submit"  class="button"  name="button" id="button" value="提交" /></td>
  </tr>
</table>
</form>
<?
}
?>

<?

function p_editItem()
{
global $maxlevel;
global $table;
$id=getQuerySQL("id");
$sql="select * from $table where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$name=$rows["name"];
$son=$rows["son"];
free( $rs );

if($son=="")
	$son=0;
$sql="select * from $table where id in ($son) order by sort asc";
$rs=query($sql);
?>
<form action="?action=p_edit_save" enctype="application/x-www-form-urlencoded" name="formadd" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="4"  bgcolor="#F2F4F6"><strong>批量编辑<span class="STYLE1"> <?=$name?> </span> 子分类</strong> </td>
  </tr>
  <?
emptyList($rs,4);
$index=0;
while($rows=fetch($rs))
{
  ?>
  <tr  bgcolor="#FFFFFF">
    <td colspan="4" align="left" bgcolor="#FFFFE9"> 分类名称：
      <input type="text" name="name<?=$index?>" value="<?=$rows["name"]?>" id="textfield" />  &nbsp;
      排序：
      <input name="sort<?=$index?>" type="text"  value="<?=$rows["sort"]?>" size="5" maxlength="5"/>
      &nbsp;
      分类图片：
      <input name="pic<?=$index?>" type="text" value="<?=$rows["pic"]?>" size="40" />
	   <input name="id<?=$index?>" type="hidden" value="<?=$rows["id"]?>" />
	  </td>
    </tr>
	<tr   bgcolor="#FFFFFF">
     <td colspan="4" align="left"><IFRAME ID="uppic" SRC="php_upload.php?form=formadd&input=pic<?=$index?>&path=systemImage" FRAMEBORDER="0"  SCROLLING="no" WIDTH="700" HEIGHT="35" ></IFRAME></td>
    </tr>
 <?
 $index++;
 }
 ?>
   <tr   class="edit"  bgcolor="#FFFFE9">
    <td width="13%" align="left">&nbsp;</td>
    <td colspan="3" ><input type="submit"   class="button"   name="button" id="button" value="提交" /></td>
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
global $maxlevel;
global $table;
$id=getQuerySQL("id");
$sql="select * from $table where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
?>
<form action="?action=edit_save&id=<?=$id?>" name="formedit" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑分类</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">分类名称：</td>
    <td width="84%" ><input type="text" name="name" value="<?=$rows["name"]?>"/>    </td>
  </tr> 
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td align="left">分类显示：</td>
    <td ><select name="state" id="state">
      <option value="0">隐藏</option>
      <option value="1">显示</option>
    </select>
	 <script language="javascript">
       EnterSelect("state","<?=$rows["state"]?>");
		</script>  </td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="16%" align="left">分类排序：</td>
    <td width="84%" ><input type="text" name="sort"  value="<?=$rows["sort"]?>"/></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td align="left" valign="top">分类图片：</td>
    <td ><input name="pic" type="text" id="pic" value="<?=$rows["pic"]?>" size="40" /></td>
  </tr>
  <tr   bgcolor="#FFFFFF">
    <td align="left" valign="top">&nbsp;</td>
    <td >
	<IFRAME ID="uppic" SRC="php_upload.php?form=formedit&input=pic&path=systemImage" FRAMEBORDER="0"  SCROLLING="no" WIDTH="700" HEIGHT="35" ></IFRAME>
	</td>
  </tr>
  <tr   bgcolor="#FFFFFF">
    <td width="16%" align="left" valign="top">分类介绍：</td>
    <td width="84%" >
		<?
		$oFCKeditor = $glo["fck"] ;
		$oFCKeditor->Value = $rows["content"] ;
		$oFCKeditor->Create() ;
		?>
	</td>
  </tr>
  
      <tr  class="edit" bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input name="button2"  class="button"  type="submit" value="修改" />    </td>
  </tr>
  
</table>
</form>
<?
}
?>


<?
function moveItem()
{
global $maxlevel;
global $table;
global $root;
$id=getQuerySQL("id");
$sql="select * from $table where id=$id";
$rs=query($sql);
isItemNotExist($rs);
free($rs);
?>
<script language="javascript">
   var xmlhttp;
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")
   function getSonSelect()
   { 
       document.getElementById("selecttd").innerText="查找中....";
	   var tempselect=document.getElementById("from");
	   
	   xmlhttp.open("POST","../service/serviceForgetMove.php?root=<?=$root?>&id="+ document.getElementById("from").value + "&table=<?=$table?>" ,true);
	   xmlhttp.onreadystatechange=dosomething;
       xmlhttp.send(null);
	}
	function dosomething()
	{
	    if(xmlhttp.readystate==4)
		   if(xmlhttp.status==200)
		      {   
			      var html=xmlhttp.responseText;
				  document.getElementById("selecttd").innerHTML=html
		       }
	}
</script>
<form action="?action=move_save" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>移动分类</strong></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="16%" align="left">选择分类：</td>
    <td width="84%" >
	<select name="from"  id="from" onChange="getSonSelect()">
	<?
	$class=fetchAllClass("$table");
	classOptionNoRoot($root,$class,$root);
	?>
    </select>
	
    </td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="16%" align="left">移动到：</td>
    <td width="84%"  id="selecttd" >
	
    </td>
  </tr>
	   <script language="javascript">
       EnterSelect("from",<?=$id?>);
	   getSonSelect();
		</script>
   <tr   class="edit" bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input type="submit"  class="button"  name="button" id="button" value="提交" /></td>
  </tr>
</table>
</form>
<?
}
?>

<?
function delete_save()
{
	global $u;
	global $page;
	$id=getQuerySQL("id");
	$u->delete($id);
	pageRedirect("删除成功","$page");
}

function add_save()
{
	global $u;
	global $page;
	$father=getFormSQL("father");
	for($index=1;$index<=1000;$index++)
	{
		if ( getForm("name$index")!="" )
		{
			$name=getForm("name$index");
			$sort=getFormInt("sort$index",0);
			$state=1;
			$content="";
			$pic=getForm("pic$index");
			$u->add($father,$name,$sort,$state,$content,$pic);
		}
		else
			break;
	}
	pageRedirect("添加成功","$page");
}

function p_edit_save()
{
	global $u;
	global $page;
	$index=0;
	while(true)
	{
		$id=getForm("id$index");
		if($id=="")
			break;
		$name=getForm("name$index");
		$sort=getFormInt("sort$index",0);
		$pic=getForm("pic$index");
		$u->edit($id,$name,$sort,"!","!",$pic);
		$index++;
	}
	pageRedirect("批量编辑成功","$page");
}

function edit_save()
{
	global $u;
	global $page;
	$id=getQuerySQL("id");
	$name=getForm("name");
	$sort=getFormInt("sort",0);
	$state=getFormInt("state",0);
	$content=getHTML("content");
	$pic=getForm("pic");
	$u->edit($id,$name,$sort,$state,$content,$pic);
	pageRedirect("修改成功","$page");
}

function move_save()
{
	global $u;
	global $page;
	$a=getFormSQL("from");
	$b=getFormSQL("to");
	$u->move($a,$b);
	pageRedirect("移动成功","$page");
}
?>
<? require("php_bottom.php");?>
</body>
</html>
