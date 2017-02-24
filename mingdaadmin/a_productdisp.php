<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品扩展</title>
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
	<div class="bodytitletxt">商品扩展</div>
</div>
</td></tr></table>
<br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle">
  <tr  bgcolor="#F2F4F6">
    <td  ><a href="a_productdisp.php">商品扩展</a><span class="fontpadding"><a href="a_productdisp.php?action=add">添加商品扩展</a></span></td>
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
    <td colspan="4" bgcolor="#F2F4F6"><strong>扩展列表</strong></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9" >
    <td width="4%" align="center" >ID</td>
    <td width="22%" align="left" >扩展名称</td>
    <td width="61%" align="left"   >访问链接</td>
    
    <td width="13%"   >操作</td> 
  </tr>
  <?
	$sql = "select * from @@@productdisp";
	$rs=query($sql);
	emptyList($rs,4);
  while($rows=fetch($rs))
  {起
	 
  //$times = (strtotime($rows["lasttime"])-strtotime($rows["addtime"]))/60 ;
  ?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td   align="center" class="a_fen"><?=$rows["id"]?></td>
    <td   align="left" class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a></td>
    <td align="left"   class="a_fen"><a target="_blank" href="<?=getRewrite($rows["name"],$rows["id"],7)?>"><?=getRewrite($rows["name"],$rows["id"],7)?></a></td>
    
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
$sql="select * from @@@productdisp where id='$id'";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);

?>
<form action="?action=edit_save&id=<?=$id?>" name="formedit" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>修改商品扩展</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">扩展名称：</td>
    <td width="84%" >
    <input type="text" style="width:350px" name="name" value="<?=$rows["name"]?>" id="name">  </tr> 
  
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >标题 Title：</td>
    <td ><textarea name="title" style="width:700px; height:70px"><?=$rows["title"]?></textarea></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>关键字 Keyword：</td>
    <td><textarea name="keywords" style="width:700px; height:70px"><?=$rows["keywords"]?></textarea></td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>描述 Description：</td>
    <td><textarea name="descript" style="width:700px; height:70px"><?=$rows["descript"]?></textarea></td>
  </tr>
    <tr   bgcolor="#FFFFFF" class="hide">
     <td valign="top">二进制因子：</td>
     <td><input type="text" style="width:50px" name="value" value="<?=$rows["value"]?>" id="value"></td>
   </tr>
    <tr   bgcolor="#FFFFFF" class="hide">
     <td valign="top">累计次数：</td>
     <td><input type="text" style="width:50px" name="addcounts" value="<?=$rows["addcounts"]?>" id="value"></td>
   </tr>
   <tr   bgcolor="#FFFFFF">
    <td valign="top">扩展说明：</td>
    <td>
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
global $config;
$this_time = fetchValue("select addcounts as v from @@@productdisp order by addcounts desc limit 1",1);
?>
<form action="?action=add_save" name="formeadd" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加商品扩展</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">扩展名称：</td>
    <td width="84%" >
      <input type="text" style="width:350px" name="name" value="" id="name"></td>
  </tr> 
  
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >标题 Title：</td>
    <td ><textarea name="title" style="width:700px; height:70px"><?=$rows["title"]?></textarea></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>关键字 Keyword：</td>
    <td><textarea name="keywords" style="width:700px; height:70px"><?=$rows["keywords"]?></textarea></td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>描述 Description：</td>
    <td><textarea name="descript" style="width:700px; height:70px"><?=$rows["descript"]?></textarea></td>
  </tr>
  <tr   bgcolor="#FFFFFF" class="hide">
     <td valign="top">二进制因子：</td>
     <td><input type="text" style="width:50px" name="value" value="<?=pow(2,$this_time)?>" id="value"></td>
   </tr>
    <tr   bgcolor="#FFFFFF" class="hide">
     <td valign="top">累计次数：</td>
     <td><input type="text" style="width:50px" name="addcounts" value="<?=$this_time+1?>" id="addcounts"></td>
   </tr>
   <tr   bgcolor="#FFFFFF">
    <td valign="top">扩展说明：</td>
    <td>
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
function delete_save()
{
	$id=getQuerySQL("id");
	$condition = "where  id ='$id'";
	deleteRecord("@@@productdisp",$condition);
				
	pageRedirect("2","a_productdisp.php");
}

function add_save()
{
	
	$param=array();
	$param["name"]=getForm("name");
	$param["title"]=getForm("title");
	$param["keywords"]=getForm("keywords");
	$param["descript"]=getForm("descript");
	$param["content"]=getHTML("content");
	$param["value"] = getFormInt("value",0);
	$param["addcounts"] = getFormInt("addcounts",0);
	$sql=insertSQL($param,"@@@productdisp");
	query($sql);
	
	pageRedirect("2","a_productdisp.php");
}


function edit_save()
{
	$id=getQuerySQL("id");
	$condition = "where  id ='$id'";
	$param=array();
	$param=array();
	$param["name"]=getForm("name");
	$param["title"]=getForm("title");
	$param["keywords"]=getForm("keywords");
	$param["descript"]=getForm("descript");
	$param["content"]=getHTML("content");
	$param["value"] = getFormInt("value",0);
	$param["addcounts"] = getFormInt("addcounts",0);
	$sql=updateSQL($param,"@@@productdisp",$condition);
	query($sql);
	pageRedirect("修改成功",$_SERVER['HTTP_REFERER']);
}
?>

<?php require("php_bottom.php");?>
</body>
</html>
