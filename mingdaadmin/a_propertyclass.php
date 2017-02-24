<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>属性分类管理</title>
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

function showp(str)
{
	if(str==0)
	{
		document.getElementById("tr_front").style.display="none";
	}
	else if (str==1)
	{
		document.getElementById("tr_front").style.display="";
	}
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

.span_bg_check { width:50px; font-size:11px; border:2px #FF6701 solid; display:inline-block; text-align:center; line-height:18px; padding:4px; height:18px; background:url(../skin/default/pic/span_bg.jpg) #FFFFFF right bottom no-repeat; margin-right:4px;margin-bottom:4px;  cursor:pointer}
.span_bg {  width:50px; font-size:11px;  border:1px #C8C9CD solid; display:inline-block; text-align:center; line-height:18px; padding:5px; height:18px; background-color:#FFFFFF; margin-right:4px; margin-bottom:4px; cursor:pointer }
</style>
<body>
<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">属性模板管理</div>
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
    <td    ><a href="?">属性模板列表</a>&nbsp;</td>
  </tr>
</table>
<br />
<?
isAuthorize($group[2]);
$maxlevel=1;
$table="@@@propertyclass";
$rootname="属性分类";
$page="a_propertyclass.php";

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
case "pp":
	showPItem();
	break;
case "pp_add":
	pp_add();
	break;
case "pp_edit":
	pp_edit();
	break;
case "update_property":
	update_property();
	break;
case "pp_delete_save":
	pp_delete_save();
	break;
case "pp_add_save":
	pp_add_save();
	break;
case "pp_edit_save":
	pp_edit_save();
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
    <td colspan="4"  bgcolor="#F2F4F6"><strong>属性模板列表</strong></td>
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
		<img id="img<?=$id?>" border="0" align="absmiddle" onClick="javascript:cshow('<?=$id?>')" src="images/opened.gif" class="cur2"> <a href="?action=pp&classid=<?=$id?>"><?=$name?></a>
	<? 
	}
	else if( $son!="" && $level>=2)
	{
		$str='display:none';
	?>
		<img id="img<?=$id?>" border="0" align="absmiddle" onClick="javascript:cshow('<?=$id?>')" src="images/closed.gif" class="cur"> <a href="?action=pp&classid=<?=$id?>"><?=$name?></a>
	<? 
	}
	else 
	{
	?>
		<img id="img<?=$id?>" border="0" align="absmiddle" src="images/empty.gif">  <a href="?action=pp&classid=<?=$id?>"><?=$name?></a>
	<? 
	}
	?>
	</td>
	<td align="center" width="60"></td>
	<td align="center" width="60"><?=$sort?></td>
    <td align="center" width="300">
<? if ($maxlevel>$level){ ?><a class="add" onClick="return checkLevel(<?=$level?>,<?=$maxlevel?>)" href="?action=add&id=<?=$id?>">添加</a><? } ?> 
<a href="?action=edit&id=<?=$id?>">编辑</a>
<a onClick="return confirm('确定删除吗')" class="red delete" href="?action=delete_save&id=<?=$id?>">删除</a>
<a href="?action=pp&classid=<?=$id?>">编辑属性</a></td>
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
    <td colspan="4"  bgcolor="#F2F4F6"><strong>添加属性模板</strong></td>
  </tr>
  <tr   bgcolor="#FFFFFF">
    <td colspan="4" align="left">上级属性模板：<span class="STYLE1">
     <?=$name?> </span>
	  <input name="father" type="hidden" value="<?=$id?>" />    </td>
    </tr>
 <?
 for($index=1;$index<=10;$index++)
 {
 ?>
  <tr  bgcolor="#FFFFFF">
    <td colspan="4" align="left" bgcolor="#FFFFE9"><?=$index?>
       . 名称：
      <input type="text" value="" name="name<?=$index?>"/>  &nbsp;
      排序：
      <input name="sort<?=$index?>" type="text"  value="<?=$startsort+10*$index?>" size="5" maxlength="5"/></td>
    </tr>
   
  <?
}
  ?>
   <tr    bgcolor="#FFFFE9" class="add">
    <td width="13%" align="left">&nbsp;</td>
    <td colspan="3" ><input type="submit"  onClick="showtips(this)" class="button"  name="button" id="button" value="提交" /></td>
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
    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑属性模板</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">名称：</td>
    <td width="84%" ><input type="text" name="name" value="<?=$rows["name"]?>"/>    </td>
  </tr> 
  
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="16%" align="left">排序：</td>
    <td width="84%" ><input type="text" name="sort"  value="<?=$rows["sort"]?>"/></td>
  </tr>
  

      <tr  bgcolor="#FFFFE9" class="edit">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input  class="button"  onClick="showtips(this)" name="button2" type="submit" value="修改" />    </td>
  </tr>
</table>
</form>
<?
}
?>
<?
function showPItem()
{
global $table;
global $config;
$classid=getQuerySQL("classid");
$sql="select * from $table where id=$classid";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$name=$rows["name"];
free( $rs );
$sql="select * from @@@property where classid=$classid order by sort asc";
$rs=query($sql);
?><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#CC0000;">
  <tr  bgcolor="#FFD0D0">
    <td >警告：属性模板的 【默认值】 禁止使用  ^ ' " : |  &lt; &gt; % 等各种特殊符号，请一定记的。 但是可以使用 - = ( ) + ; * / </td>
  </tr>
</table><br>

<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="7"  bgcolor="#F2F4F6"><strong>属性参数 （<span class="STYLE1"> <?=$name?> </span>）</strong><span class="fontpadding"><a href="?action=pp_add&classid=<?=$classid?>">添加参数</a></span><span class="fontpadding2">带 <img src="images/qianbi.gif"   align="absmiddle"> 的列可<span class="red weight">"直接点击格子修改"</span></span></td>
  </tr>
  <tr align="center" bgcolor="#FFFFE9">
    <td>编号</td>
    <td>参数名称</td>
    <td width="450">默认值<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>
    <td>前台显示样式</td>
    
    <td>参数类型</td>
    <td>排序</td>
    <td>操作</td>
  </tr>
    <?
emptyList($rs,7);
$index=0;
$arrtype=array("手工输入","多行输入","从列表选择","多选");
$arrcarts=array("手工输入","","下拉列表","多选","批量购买","单选框","隐藏域","CSS美化","单选可附加价格","多选可附件价格","CSS美化单选(关联到其他图片)");
$arrcart=array("产品参数","购物参数");
while($rows=fetch($rs))
{
   
  ?>  <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td><?=$rows["id"]?></td>
    <td><?=$rows["name"]?></td>
    
    <td width="450"  class="a_fen point wrap" id="value<?=$rows["id"]?>"><?=$rows["value"]?></td>
    <td><? if($rows["cart"]!=0) {?><?=$arrcarts[$rows["type2"]]?><? } ?></td>
    <td><?=$arrcart[$rows["cart"]]?></td>
    <td><?=$rows["sort"]?></td>
    <td>
		&nbsp;&nbsp;<a href="?action=pp_edit&id=<?=$rows["id"]?>">编辑</a>
		&nbsp;&nbsp;<a class="delete red" href="?action=pp_delete_save&id=<?=$rows["id"]?>"  onClick="return confirm('确定要删除吗？')" >删除</a>	</td>
  </tr>
  <script language="javascript">
  $("#value<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@property','value',<?=$rows["id"]?>,0,50)}); 
  </script>
 <?
 }
 ?>
</table><br>
<?
$profile_product = fetchCount("@@@product","where propertyid = " . $classid) ;
?>
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
   <td  bgcolor="#F2F4F6"><strong>同步属性模板</strong> </td>
  </tr>
   <tr bgcolor="#FFFFFF">
    <td>
	将当前页面的[<span class="STYLE1"><?=$name?></span>]的设置 同步 到选择了[<span class="STYLE1"><?=$name?></span>]的共（<span style="color: #FF0000;font-weight: bold;font-size:24px" ><?=$profile_product?></span>）件商品！<input name=""  class="button"   onClick="if(confirm('是否确定同步数据!!!!!')) location.href='a_propertyclass.php?action=update_property&classid=<?=$classid?>'" value="开始同步到商品数据" type="button">
	</td>
  </tr>
</table>
<br>
<script language="javascript">
function span_style_chekck(obj,style,indexm,total)
{
	for(index=0;index<total;index++)
	{
		$("span_style_" +indexm + "_" + index).className = 'span_bg';
	}
	obj.className = 'span_bg_check';
}
</script>
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
   <td  bgcolor="#F2F4F6"><strong>预览效果</strong> </td>
  </tr>
   <tr bgcolor="#FFFFFF">
    <td><table width="440" align="center" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFF3D9" style="border:1px #FCBB29 solid; color:#000000">
	<?
	$sql="select * from @@@property where classid=$classid and cart=1 order by sort asc";
	$rs=query($sql);
	while($rows=fetch($rs))
	{
	?>					
<tr><td width="100" align="right" ><?=$rows["name"]?> : </td>
<td> <?=fetch_sc_HTML((int)$rows["type2"],$rows["value"],$index,$rows["name"],$rows["price"],getCoinChar($config,0),"")?> </td>
            </tr>
<?
 }
?>
			<tr>
				<td align="right" class="weight">I Select : </td>
		        <td id="span_select" style="color:#FF3300; font-weight:bold">Please select the Style</td>
		  	</tr>
			
			<tr>
				<td align="right">Quantity : </td>
		        <td><input name="num" value="1" size="5" maxlength="5" type="text" /></td>
		  	</tr>
			
		  	<tr>
				<td>&nbsp;</td>
	          <td><img id="btn_quick" src="../skin/default/pic/addtocart.gif"  /> <img id="btn_quick" src="../skin/default/pic/checkorder.gif"  /></td>
		  	</tr>
		  </table></td>
  </tr>
</table>

<?
}
?>

<?
function pp_add()
{
global $table;
$classid=getQuerySQL("classid");
$sql="select * from $table where id=$classid";
$rs=query($sql);
isItemNotExist($rs);
?>
<form action="?action=pp_add_save&classid=<?=$classid?>" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加属性参数</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="20%" align="left">参数名称：</td>
    <td >
      <input type="text" name="name" id="textfield" /> 
      *  </td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" class="hide">
    <td width="16%" align="left">后台输入方式：</td>
    <td width="84%" ><select name="type1" id="sltProperty">
      <option value="0">手工输入</option>
      <option value="1" selected="selected">多行输入</option>
      <option value="2">从列表选择</option>
	  <option value="3">多选选择</option>
	   <option value="4">禁止输入</option>
    </select>
    1.手工：文本框输入,单行 2.多行：文本框输入,可以多行 3.列表,列表选择,只能单选 4.多选,可以多选 </td>
  </tr>
      <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">默认值：</td>
    <td width="84%" ><textarea name="value" cols="60" rows="5"></textarea>      
   <br>
 默认值将节省您后台添加产品时间，多个参数用英文","号分隔，如:红色,绿色</td>
  </tr>
      <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">参数排序：</td>
        <td ><input name="sort" type="text" id="tbsort"  value="0" size="5"/></td>
      </tr>
      <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">参数类型：</td>
        <td ><input type="radio" onClick="showp(0)" name="cart" value="0" />
        产品参数
          <input type="radio" onClick="showp(1)" name="cart"  value="1" />
        购物参数
		<script language="javascript">
		EnterRadio("cart",1);
		</script>
		</td>
      </tr>
      <tr bgcolor="#FFFFFF" id="tr_front" >
        <td align="left">前台购物参数样式：</td>
        <td ><select name="type2" id="type2">
      <!--<option value="0">手工输入</option>-->
      <option value="2">下拉单选</option>
	   <option value="5">单选框</option>
	  <!--<option value="3">多选</option>-->
	  <option value="4">多选批发</option>
	  <!--<option value="6">隐藏域</option>-->
	  <option value="7" selected="selected">CSS美化单选</option>
	  <!-- <option value="8">单选(可附加价格)</option>-->
	  <!--<option value="9">多选(可附加价格)</option>-->
	<!--  <option value="10">CSS美化单选(关联到其他图片)</option>-->
       </select></td>
      </tr>
	  <tr bgcolor="#FFFFFF" class="hide" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" >
    <td width="16%" align="left">附加参数：</td>
    <td width="84%" ><textarea name="price" cols="60" rows="5"></textarea>      </td>
  </tr>
    <tr bgcolor="#FFFFE9" class="add">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input type="submit"  onClick="showtips(this)" name="button" id="button" value="提交" /></td>
  </tr>
</table>
</form>
<?
}
?>
<?
function pp_edit()
{
global $table;
$id=getQuerySQL("id");
$sql="select * from @@@property where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$classid=$rows["classid"];
?>

<form action="?action=pp_edit_save&id=<?=$id?>&classid=<?=$classid?>" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑属性参数</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="20%" align="left">参数名称：</td>
    <td  >
      <input type="text" name="name" value="<?=$rows["name"]?>" id="textfield" /> 
      *  </td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" class="hide">
    <td width="16%" align="left">后台输入方式：</td>
    <td width="84%" ><select name="type1" id="type1">
      <option value="0" selected="selected">手工输入</option>
      <option value="1">多行输入</option>
      <option value="2">从列表选择</option>
	  <option value="3">多选</option>
	  <option value="4">禁止输入</option>
    </select>
	<script language="javascript">
	EnterSelect("type1","<?=$rows["type1"]?>");
	</script>
	1.手工：文本框输入,单行 2.多行：文本框输入,可以多行 3.列表,列表选择,只能单选 4.多选,可以多选</td>
  </tr>
      <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left">默认值：</td>
    <td width="84%" ><textarea name="value" cols="60" rows="5"><?=$rows["value"]?></textarea>      
      <br>
      默认值将节省您后台添加产品时间，多个参数用英文","号分隔，如:红色,绿色</td>
  </tr>
      <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">参数排序：</td>
        <td ><input name="sort" type="text"   value="<?=$rows["sort"]?>" size="5"/></td>
      </tr>
      <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
        <td align="left">参数类型：</td>
        <td ><input type="radio"  onClick="showp(0)"  name="cart" value="0" />
        产品参数
          <input type="radio"  onClick="showp(1)"  name="cart" value="1" />
        购物参数
		<script language="javascript">
		EnterRadio("cart","<?=$rows["cart"]?>");
		</script>
		</td>
      </tr>
      <tr bgcolor="#FFFFFF" id="tr_front" >
        <td align="left">前台购物参数样式：</td>
        <td ><select name="type2" id="type2">
      <!--<option value="0">手工输入</option>-->
      <option value="2">下拉单选</option>
	   <option value="5">单选框</option>
	  <!--<option value="3">多选</option>-->
	  <option value="4">多选批发</option>
	  <!--<option value="6">隐藏域</option>-->
	  <option value="7" selected="selected">CSS美化单选</option>
	  <!-- <option value="8">单选(可附加价格)</option>-->
	  <!-- <option value="9">多选(可附加价格)</option>-->
	<!--  <option value="10">CSS美化单选(关联到其他图片)</option>-->
       </select>
       <script language="javascript">
		EnterSelect("type2","<?=$rows["type2"]?>");
		</script></td>
      </tr>
	   <tr bgcolor="#FFFFFF" class="hide" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" >
    <td width="16%" align="left">附加价格表：</td>
    <td width="84%" ><textarea name="price" cols="60" rows="5"><?=$rows["price"]?></textarea>      </td>
  </tr>
    <tr bgcolor="#FFFFE9" class="edit">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input  class="button"  onClick="showtips(this)" type="submit" name="button" id="button" value="提交" /></td>
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
	$condition = "where classid = " . $id;
	$rs=deleteRecord("@@@property","$condition");
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

function edit_save()
{
	global $u;
	global $page;
	$id=getQuerySQL("id");
	$name=getForm("name");
	$sort=getFormInt("sort",0);
	$state=getFormInt("state",0);
	$content=$_POST["content"];
	$pic=getForm("pic");
	$u->edit($id,$name,$sort,$state,$content,$pic);
	pageRedirect("修改成功","$page");
}


function pp_add_save()
{
	global $page;
	$param["name"]=getForm("name");
	$param["value"]=getForm("value");
	$param["price"]=getForm("price");
	$param["sort"]=getFormInt("sort",1);
	$param["type2"]=getFormInt("type2",1);
	$param["type1"]=getFormInt("type1",1);
	$param["cart"]=getFormInt("cart",0);
	$param["classid"]=getQueryInt("classid",0);
	$sql=insertSQL($param,"@@@property");
	query($sql);
	pageRedirect("添加成功","$page?action=pp&classid=".getQueryInt("classid",0));
}

function pp_edit_save()
{
	global $page;
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["name"]=getForm("name");
	$param["value"]=getForm("value");
	$param["price"]=getForm("price");
	$param["sort"]=getFormInt("sort",1);
	$param["type2"]=getFormInt("type2",1);
	$param["type1"]=getFormInt("type1",1);
	$param["cart"]=getFormInt("cart",0);
	$sql=updateSQL($param,"@@@property",$condition);
	query($sql);
	pageRedirect("编辑成功","$page?action=pp&classid=".getQueryInt("classid",0));
}

function pp_delete_save()
{
	global $page;
	$id=getQuerySQL("id");
	$sql="delete from @@@property where id=$id";
	query($sql);
	pageRedirect("删除成功","$page");
}

function update_property()
{
	global $page;
	global $cfg;
	$classid=getQuerySQL("classid");
	$sql="select * from @@@propertyclass where id=$classid";
	$rs=query($sql);
	isItemNotExist($rs);
	free( $rs );
		
	$sql="select * from @@@property where classid=$classid and cart=1 order by sort asc";
	$rs=query($sql);
	$arrckey=array();
	$arrcvalue=array();
	$arrctype=array();
	$arrcprice=array();
	while($rows=fetch($rs))
	{
		$arrckey[] = $rows["name"];
		$arrcvalue[] = $rows["value"];
		$arrctype[] = $rows["type2"];
		$arrcprice[] = $rows["price"];
	}
	$param = array();
	$param["ckey"] = join( $cfg["split"] , $arrckey );
	$param["cvalue"] = join( $cfg["split"] , $arrcvalue );
	$param["ctype"] = join( $cfg["split"] , $arrctype );
	$param["cprice"] = join( $cfg["split"] , $arrcprice );
	$condition = "where propertyid = " . $classid ;
	$sql=updateSQL($param,"@@@product",$condition);
	query($sql);
	pageRedirect("修改成功","$page");
}
?>
<? require("php_bottom.php");?>
</body>
</html>
