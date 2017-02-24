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
	<div class="bodytitletxt">标签类型管理</div>
</div>
</td></tr></table>
<br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle">
  <tr  bgcolor="#F2F4F6">
    <td  ><a href="a_tagtype.php">标签类型管理</a><span class="fontpadding"><a href="a_tag.php?action=add_type" class="red">标签管理</a></span></td>
  </tr>
</table><br />
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
case "add_type":
	p_addtype();
	break;
case "p_add_save":
	p_add_save();
case "p_edit":
	p_edit();
	break;
case "p_edit_save":
	p_edit_save();
	break;
case "p_add_type_save":
	p_add_type_save();
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
?>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >注意：删除标签，会删除相关的子标签以及产品的标签 <strong class="red">而不会删除产品 </strong>。<br>
      同时：修改排序将修改前台的排列数序，<span class="red"><strong>数值越小越前面</strong>。</span></td>
  </tr>
</table><br>

<form name="formdel" method="post" action="?action=p_edit">
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="5" bgcolor="#F2F4F6"><strong>标签类型列表</strong><span class="fontpadding"><a href="?action=add_type">添加标签类型</a></span></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9" >
    <td width="4%" align="center" >ID</td>
    <td width="16%" align="center" >排序<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td width="60%" align="left" >标签类型名称</td>
    <td width="11%"   >添加时间</td>
    <td width="9%"   >操作</td> 
  </tr>
  <?
  global $glo;
  $condition = "where type=0";
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
    <td   align="center" class="a_fen"><?=$rows["id"]?></td>
    <td class="point"  id="sort<?=$rows["id"]?>"><?=$rows["sort"]?></td>
    <td   align="left" class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a></td>
    
    <td   class="a_fen"><?=formatDate(strtotime($rows["addtime"]))?></td>
    <td   class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>">编辑</a> <a onClick="return confirm('确定是否删除？')" href="?action=delete_save&id=<?=$rows["id"]?>">删除</a></td> 
  </tr>
  <script language="javascript">
  $("#sort<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@ptaglist','sort',<?=$rows["id"]?>,true)});
  </script>
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
    <td width="84%" ><input type="text" style="width:175px" name="name" value="<?=$rows["name"]?>" id="name"></td>
  </tr>
  
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
        <td align="left">显示类型：</td>
        <td ><select name="displaytype" id="displaytype">
        <option value="0">普通文本</option>
        <option value="1">图片显示</option>
      </select></td>
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
function p_addtype()
{
global $glo;
global $cfg;

?>
<form action="?action=p_add_type_save" name="formeadd" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>批量添加标签类型</strong><input name="type" type="hidden" value="0"></td>
  </tr>
  <? for($index=0;$index<=9;$index++)
  {
  ?>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">标签类型名称<?=$index?>：</td>
    <td width="84%" >
      <input type="text" style="width:175px" name="name<?=$index?>" id=""></td>
  </tr> 
  <?
  }
  ?>
  
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
	
	$condition = "where  type = " . $id;
	$rs = deleteRecord("@@@ptaglist",$condition);
	while($rows=fetch($rs))
	{
		$condition = "where tid =" . $rows["id"];
		deleteRecord("@@@ptag",$condition);
	}
	
	
	pageRedirect("2","a_tagtype.php");
}

function p_add_type_save()
{
	for($index=0;$index<=10;$index++)
	{
		$name=getForm("name$index");
		if($name=="")
			continue;

		$param=array();
		$param["name"]=$name;
		$param["type"]=0;
		$param["addtime"] = formatDateTime(time());
		$sql=insertSQL($param,"@@@ptaglist");
		query($sql);
	}
	
	pageRedirect("2","a_tagtype.php");
}


function edit_save()
{
	$id=getQuerySQL("id");
	$condition = "where  id ='$id'";
	$param=array();
	$param["name"]=getForm("name");
	$param["displaytype"]=getQueryInt("displaytype",0);
	$sql=updateSQL($param,"@@@ptaglist",$condition);
	query($sql);
	pageRedirect("修改成功",$_SERVER['HTTP_REFERER']);
}
?>

<?php require("php_bottom.php");?>
</body>
</html>
