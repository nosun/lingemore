<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>配送区域管理</title>
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


    
    function addItem(From,To){  
	var objFrom=document.getElementById(From+"");
	var objTo=document.getElementById(To+"");
    var flag = false;     
        for(var i = 0; i < objFrom.options.length;i++){      
            if(objFrom.options[i].selected == true){   
        flag = true;      
                var selectItem = new Option(objFrom.options[i].text,objFrom.options[i].value);      
                objTo.options.add(selectItem);      
                objFrom.options.remove(i);
				i--;    
            }      
        }   
    if(!flag){alert("请选择要转移的国家");}      
        sortItem(To);      
    }      
    function allAddItem(From,To){   
		var objFrom=document.getElementById(From+"");
		var objTo=document.getElementById(To+"");   
        for(var i = objFrom.options.length - 1;i>=0;i--){      
            var objItem = new Option(objFrom.options[i].text,objFrom.options[i].value);      
            objTo.options.add(objItem);      
            objFrom.options.remove(i);          
        }      
        sortItem(objTo);      
    }    
         
    function sortItem(To){  
	    var objTo=document.getElementById(To+"");    
        var ln = objTo.options.length;      
        var arrText = new Array();      
        var arrValue = new Array();      
        for(var i=0;i<ln;i++){      
            arrText[i] = objTo.options[i].text;      
        }      
        arrText.sort();      
        for(var i=0;i<ln;i++){      
            for(var j = 0;j<objTo.options.length;j++){      
                if(arrText[i] == objTo.options[j].text){      
                   arrValue[i] = objTo.options[j].value;      
                   break;      
                }      
           }      
        }      
        while(ln--){      
            objTo.options[ln] = null;      
        }      
        for(i = 0;i<arrText.length;i++){    
		    var tempOption=document.createElement("option");
			tempOption.value=arrValue[i];
			tempOption.text=arrText[i];
			objTo.options.add(tempOption);
            //objTo.add(new Option(arrText[i],arrValue[i]));      
        }      
    }    
    function swapItem(option1,option2){   
        var tempStr = option1.value;   
        option1.value = option2.value;   
        option2.value = tempStr;   
           
        tempStr = option1.text;   
        option1.text = option2.text;   
        option2.text = tempStr;   
           
        tempStr = option1.selected;   
        option1.selected = option2.selected;   
        option2.selected = tempStr;   
    }    
   
   function checkcountryidall()
   {
		//$("#selectSo").each(function(){this.selected=true;})
		var objFrom=document.getElementById("selectSo");
		for(var i = 0; i < objFrom.options.length;i++)
		{      
            objFrom.options[i].selected = true
        }   
		return true;
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
	<div class="bodytitletxt">配送区域管理</div>
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
    <td    ><a href="?">配送区域管理</a><span class="fontpadding"><a href="a_country.php">国家列表</a></span></td>
  </tr>
</table>
<br />
<?
isAuthorize($group[1]);
$maxlevel=1;
$table="deliveryarea";
$rootname="配送区域列表";
$page="a_deliveryarea.php";

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
case "fenpei":
	fenpei();
	break;
case "fenpei_save":
	fenpei_save();
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
    <td colspan="4"  bgcolor="#F2F4F6"><strong>配送区域列表</strong></td>
  </tr>
 <Tr>
  <td  style="padding:0">
  
  <?
  
  $class=fetchAllClass("$table");
  function classShow($class,$id,$maxlevel)
  {
  $arrdisp=array("隐藏","显示");
  $name=$class[$id]["name"];
  $son=$class[$id]["son"];
  $level=(int)$class[$id]["level"];
  $disp=$class[$id]["disp"];
  $sort=$class[$id]["sort"];
  ?>
  
   <div id="item<?=$id?>" class='c<?=$level?>'>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" >
	<tr  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td height="18" align="left" style="padding-left:<?=20*$level+5?>px;line-height:18px; ">
	
	<? 
	if( $son!="" && $level<1 ) 
	{
		$str='display:block';
	?>
		<img id="img<?=$id?>" border="0" align="absmiddle" onClick="javascript:cshow('<?=$id?>')" src="images/opened.gif" class="cur2"> <a href="?action=edit&id=<?=$id?>"><?=$name?></a>
	<? 
	}
	else if( $son!="" && $level>=1)
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
	<td align="center" width="60"><?=$arrdisp[$disp]?></td>
	<td align="center" width="60"><?=$sort?></td>
    <td align="center" width="300">
<? if($level<$maxlevel){ ?>
<a class="add" onClick="return checkLevel(<?=$level?>,<?=$maxlevel?>)" href="?action=add&id=<?=$id?>">添加区域</a>
<? }else{ ?>
<a   href="?action=fenpei&id=<?=$id?>">分配国家</a>
<? } ?> 
<a class="edit" href="?action=edit&id=<?=$id?>">编辑</a>
<a class="delete red" onClick="return confirm('确定删除吗')" href="?action=delete_save&id=<?=$id?>">删除</a>
</td>
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
    <td colspan="4"  bgcolor="#F2F4F6"><strong>添加配送区域</strong></td>
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
     <span class="hide" > &nbsp;
      分类图片：
      <input name="pic<?=$index?>" type="text" id="pic " size="40" /></span></td>
    </tr>
   <tr class="hide"  bgcolor="#FFFFFF">
     <td colspan="4" align="left">
	 <IFRAME ID="uppic" SRC="php_upload.php?form=formadd&input=pic&path=systemImage" FRAMEBORDER="0"  SCROLLING="no" WIDTH="700" HEIGHT="35" ></IFRAME>
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
    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑国家</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">分类名称：</td>
    <td width="84%" ><input type="text" name="name" style="width:200px" value="<?=$rows["name"]?>"/>    </td>
  </tr> 
  <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td align="left">分类显示：</td>
    <td ><select name="disp" id="disp">
      <option value="0">隐藏</option>
      <option value="1">显示</option>
    </select>
	 <script language="javascript">
       EnterSelect("disp","<?=$rows["disp"]?>");
		</script>  </td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="16%" align="left">分类排序：</td>
    <td width="84%" ><input type="text" name="sort"  value="<?=$rows["sort"]?>"/></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
    <td align="left" valign="top">分类图片：</td>
    <td ><input name="pic" type="text" id="pic" value="<?=$rows["pic"]?>" size="40" /></td>
  </tr>
  <tr   bgcolor="#FFFFFF"  class="hide">
    <td align="left" valign="top">&nbsp;</td>
    <td >
	<IFRAME ID="uppic" SRC="php_upload.php?form=formedit&input=pic&path=systemImage" FRAMEBORDER="0"  SCROLLING="no" WIDTH="700" HEIGHT="35" ></IFRAME>
	</td>
  </tr>
     <tr onMouseMove="tr_onMouseOver(this)" class="hide" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="16%" align="left">SEO(标题Title)：</td>
    <td width="84%" ><textarea name="title" cols="50" rows="5" id="title"><?=$rows["title"]?></textarea></td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)"  class="hide" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="16%" align="left">SEO(关键字Keywords)：</td>
    <td width="84%" ><textarea name="keywords" cols="50" rows="5" id="title"><?=$rows["keywords"]?></textarea></td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="16%" align="left">SEO(描述Descript)：</td>
    <td width="84%" ><textarea name="descript" cols="50" rows="5" id="title"><?=$rows["descript"]?></textarea></td>
  </tr>
  <tr   bgcolor="#FFFFFF" class="hide">
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
function fenpei()
{
global $glo;
global $maxlevel;
global $table;
$id=getQuerySQL("id");
$sql="select * from $table where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$areaid = $rows["id"] ;
?>
<form action="?action=fenpei_save&id=<?=$id?>" name="formedit" onSubmit="return checkcountryidall()" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>为【<span class="red"><?=$rows["name"]?></span>】分配国家</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">配送区域名称：</td>
    <td width="84%" ><?=$rows["name"]?></td>
  </tr> 
   <tr bgcolor="#FFFFFF">
    <td width="16%" align="left">全球所有国家：</td>
    <td width="84%" >
	<?
	$arr_list=array();
	$sql="select * from @@@country where id not in (select countryid from @@@areacountry where areaid=" . $areaid . ")  order by id asc";
	$rs = query($sql);
	while($rows = fetch($rs))
	{
			$arr_all_list[]=$rows;
	}
	
	$sql="select * from @@@country where id in (select countryid from @@@areacountry where areaid=" . $areaid . ") order by id asc";
	$rs = query($sql);
	while($rows = fetch($rs))
	{
			$arr_check_list[]=$rows;
	}
	?>
	可以按 <span class="red">"CTRL"</span> 或者  <span class="red">拖动鼠标</span> 进行多选
	<table cellpadding="1" cellspacing="1" class="tbtitle">      
    <tr>      
        <td  bgcolor="#F2F4F6">所有国家</td>      
        <td bgcolor="#F2F4F6"></td>      
        <td bgcolor="#F2F4F6">已选中的国家</td>     
        </tr>      
    <tr>      
        <td bgcolor="#FFFFFF">      
            <select id="selectColor" multiple="multiple" style="width:200px;height:400px;">      
				<? for($index=0;$index<count($arr_all_list);$index++) {?>
				<option value="<?=$arr_all_list[$index]["id"]?>"><?=ucwords(strtolower($arr_all_list[$index]["name"]))?> <?=(($arr_all_list[$index]["cnname"]))?></option>      
                <? } ?>
            </select>        </td>      
        <td bgcolor="#FFFFFF">      
            <table>      
                <tr>      
                    <td><input type="button" id="btn1" class="button"   value="添加选中 >" onClick="addItem('selectColor','selectSo')"/></td>      
                </tr> 
                 <tr>      
                    <td>------------------------------</td>      
                </tr>     
                <tr>      
                    <td><input type="button" id="btn2" class="button"  value="添加全部 >" onClick="allAddItem('selectColor','selectSo')"/></td>      
                </tr>      
                <tr>      
                    <td><input type="button" id="btn3" class="button"  value="< 撤回全部" onClick="allAddItem('selectSo','selectColor')"/></td>      
                </tr>      
                <tr>      
                    <td><input type="button" id="btn4" class="button"  value="< 撤回选中" onClick="addItem('selectSo','selectColor')"/></td>      
                </tr>      
            </table>        </td>      
        <td bgcolor="#FFFFFF">      
            <select id="selectSo" name="countryid[]" multiple="multiple" style="width:200px;height:400px;">      
            <? for($index=0;$index<count($arr_check_list);$index++) {?>
				<option value="<?=$arr_check_list[$index]["id"]?>"><?=ucwords(strtolower($arr_check_list[$index]["name"]))?></option>      
                <? } ?>
			</select>        </td>    
        </tr>     
</table>	</td>
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
function delete_save()
{
	global $u;
	global $page;
	$id=getQuerySQL("id");
	$tree=fetchValue("select tree as v from @@@deliveryarea where id=$id","0");
	$condition=" where areaid in ($tree)";
	$rs=deleteRecord("@@@areacountry","$condition");
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
			$disp=1;
			$content="";
			$pic=getForm("pic$index");
			$u->add($father,$name,$sort,$disp,$content,$pic);
		}
		else
			break;
	}
	pageRedirect("添加成功","$page");
}

function fenpei_save()
{
	global $page;
	$arrcountryid=getForm("countryid");
	$id=getQuerySQL("id");
	$sql="delete from @@@areacountry where areaid=$id";
	query($sql);
	if(is_array($arrcountryid))
	{
		for($index=0;$index<count($arrcountryid);$index++)
		{
			$param=array();
			$param["areaid"]=$id;
			$param["countryid"]=$arrcountryid[$index];
			$sql=insertSQL($param,"@@@areacountry");
			query($sql);
		}
	}
	pageRedirect("修改成功",$_SERVER['HTTP_REFERER']);
}

function edit_save()
{
	global $u;
	global $page;
	$id=getQuerySQL("id");
	$name=getForm("name");
	$sort=getFormInt("sort",0);
	$disp=getFormInt("disp",0);
	$content=$_POST["content"];
	$pic=getForm("pic");
	$u->edit($id,$name,$sort,$disp,$content,$pic);
	pageRedirect("修改成功","$page");
}


?>
<? require("php_bottom.php");?>
</body>
</html>
