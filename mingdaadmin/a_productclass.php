<? require("php_admin_include.php");?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>产品分类管理</title>

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

function changeImage(path)

{

	document.getElementById("imgupload").src=path;

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

	<div class="bodytitletxt">产品分类管理</div>

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

    <td    ><a href="?">产品分类列表</a>&nbsp;</td>

  </tr>

</table>

<br />

<?

isAuthorize($group[2]);

$maxlevel=5;

$table="@@@productclass";

$rootname="产品分类";

$page="a_productclass.php";



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

global $cfg;

global $maxlevel;

global $table;

?>

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">

  <tr  bgcolor="#FFFFE6">

    <td >

1. 当操作 “删除，添加，批量添加，移动” 这4个操作时尽量不要同时操作。<br>

2. 当修改过分类或者商品推荐的时候，退出时候进行更新

<input name="" onClick="location.href='a_config.php?action=clean'" value="更新服务器缓存"  class="button"  type="button"></td>

  </tr>

</table>

<br>

<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">

  <tr>

    <td  bgcolor="#F2F4F6" colspan="4"><strong>分类列表</strong></td>

  </tr>

 <Tr>

  <td  style="padding:0">

  

  <?

  

  $class=fetchAllClass("$table");

  $classurl = split(',', $class[getQueryDefault("id",$root)]["url"] );

  fetchTreeNum($root,$class,"@@@product");

  function classShow($class,$id,$maxlevel,$url)

  {

  $arrstate=array("隐藏","显示");

  $name=$class[$id]["name"];

  $son=$class[$id]["son"];

  $level=(int)$class[$id]["level"];

  $state=$class[$id]["state"];

  $sort=$class[$id]["sort"];

  $productnum = $class[$id]["item"];

  $father=$class[$id]["father"];

   if($level>1)

  {

	if( $father!=$url[$level-1] )

		//debug($father.$url[$level-1]);

		return ;

		//$a=3;

  }

  $rartime = filemtime("../download/".makeRewrite($name)."-c$id".".zip");

  ?>

  

   <div id="item<?=$id?>" class='c<?=$level?>'>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" >

	<tr  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">

    <td  height="18" align="left" style="padding-left:<?=20*$level+5?>px;line-height:18px; ">

	

	<? 

	if( $son!="" && $id==$url[$level] ) 

	{

		$str='display:block';

	?>

		<a href="?id=<?=$id?>"><img id="img<?=$id?>" border="0" align="absmiddle" src="images/opened.gif" class="cur2"></a> <a href="?action=edit&id=<?=$id?>"><?=$name?> (<span class="STYLE1"><?=$productnum?></span>)</a>

	<? 

	}

	else if( $son!=""   ) 

	{

		$str='display:block';

	?>

		<a href="?id=<?=$id?>"><img id="img<?=$id?>" border="0" align="absmiddle" src="images/closed.gif" class="cur"></a> <a href="?action=edit&id=<?=$id?>"><?=$name?> (<span class="STYLE1"><?=$productnum?></span>)</a>

	<? 

	}

	else 

	{

	?>

		<img id="img<?=$id?>" border="0" align="absmiddle" src="images/empty.gif">  <a href="?action=edit&id=<?=$id?>"><?=$name?> (<span class="STYLE1"><?=$productnum?></span>)</a>

	<? 

	}

	?>

	<a href="../rss.php?classid=<?=$id?>" target="_blank"><img src="images/rss.gif" border="0"></a></td>

	<td class="" align="left" width="180">

	<? if($level>=1 ) { ?>

	<a href="a_classzip.php?action=createzip&id=<?=$id?>">压缩</a> <? if($rartime!=0) {?>( <a href="<?="../download/".makeRewrite($name)."-$id".".zip"?>" target="_blank"><img src="images/downloadrar.gif"   align="absmiddle"></a> <?=formatDate($rartime)?> <a href="a_classzip.php?action=deletezip&file=<?=urlencode(makeRewrite($name)."-c$id".".zip")?>"><img src="images/dialog-close.gif"></a>)<? } ?> <? } ?> </td>

	<td align="center" width="60"><?=$arrstate[$state]?>

	

	</td>

	<td align="center" width="60"><?=$sort?></td>

    <td align="center" width="300">

<? if ($maxlevel>$level){ ?><a class="add" onClick="return checkLevel(<?=$level?>,<?=$maxlevel?>)" href="?action=add&id=<?=$id?>">添加</a><? } ?> 

<a href="?action=edit&id=<?=$id?>">编辑</a>

<a href="?action=p_edit&id=<?=$id?>" <? if( $son==""){ ?> style="visibility:hidden"<? } ?>>批量编辑</a> 

<a class="delete red" onClick="return confirm('确定删除吗？？？点击确定，您将会删除【<?=$productnum?>】件产品，该操作不可还原！')" href="?action=delete_save&id=<?=$id?>">删除</a>

<a href="?action=move&id=<?=$id?>">移动</a>

<a href="a_product.php?action=add&classid=<?=$id?>">添加产品</a>

<a class="hide" target="_blank" href="a_caiji.php?classid=<?=$id?>">采集产品</a>

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

				classShow($class,$arrson[$index],$maxlevel,$url);

			}

			echo "</div>";

		}

	}

	  classShow($class,$root,$maxlevel,$classurl);

	?>

	

	</td></Tr>

</table>



<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle  margintop">

  <tr>

    <td  bgcolor="#F2F4F6"><strong>商品扩展类别</strong></td>

  </tr>

 <Tr>

  <td  style="padding:0">

  

  <?

    $sql = "select * from @@@productdisp order by value asc";

	$d_rs = query($sql);

	while($d_rows=fetch($d_rs))

	{



	$disp = $d_rows["id"];

	$name = $d_rows["name"] ;

  	$rartime = filemtime("../download/".makeRewrite($d_rows["name"])."-s".$d_rows["id"]."".".zip");

  

  ?>

  

   <div id="item" class='c1'>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" >

	<tr  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">

    <td width=""  height="18" align="left" style="padding-left:25px;line-height:18px; "><img  border="0" align="absmiddle" src="images/empty.gif">  <?=$name?> <a href="../rss.php?disp=<?=$disp?>" target="_blank"><img src="images/rss.gif" border="0"></a>

</td>

	<td align="left" width="180" class="">

	<a href="a_classzip.php?action=createzip&disp=<?=$disp?>">压缩</a> <? if($rartime!=0) {?>( <a href="<?="../download/".makeRewrite($name)."-s$disp".".zip"?>" target="_blank"><img src="images/downloadrar.gif"   align="absmiddle"></a> <?=formatDate($rartime);?>

	<a href="a_classzip.php?action=deletezip&file=<?=urlencode(makeRewrite($name)."-s$disp".".zip")?>"><img src="images/dialog-close.gif"></a>)<? } ?></td>

	<td align="center" width="60">&nbsp;  </td>

	<td align="center" width="60">&nbsp; </td>

    <td align="center" width="240">&nbsp;

 </td>

  </tr>

  </table>

  </div>

  

	<?

	}

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

 for($index=1;$index<=30;$index++)

 {

 ?>

  <tr  bgcolor="#FFFFFF">

    <td colspan="4" align="left" bgcolor="#FFFFE9"><?=$index?> . 分类名称：

      <input type="text" value="" size="40" name="name<?=$index?>"/>  &nbsp;

      排序：

      <input name="sort<?=$index?>" type="text"  value="<?=$startsort+10*$index?>" size="5" maxlength="5"/>

     <span class="hide"> &nbsp;

      分类图片：

      <input name="pic<?=$index?>" type="text" id="pic " size="40" /></span></td>

    </tr>

   <tr   class="hide" bgcolor="#FFFFFF">

     <td colspan="4" align="left">

	 <IFRAME ID="uppic" SRC="php_upload.php?form=formadd&input=pic<?=$index?>&path=systemImage" FRAMEBORDER="0"  SCROLLING="no" WIDTH="700" HEIGHT="35" ></IFRAME>

	 </td>

    </tr>

  <?

}

  ?>

   <tr class="add"  bgcolor="#FFFFE9">

    <td width="13%" align="left">&nbsp;</td>

    <td colspan="3" ><input type="submit"  onClick="showtips(this)" name="button"  class="button"  id="button" value="提交" /></td>

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

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">

  <tr  bgcolor="#FFFFE6">

    <td ><strong>批量编辑<span class="STYLE1"> <?=$name?> </span> 子分类</strong>。 <input type="submit" class="button"  onClick="showtips(this)" name="Submit" value="点击此处统一提交" />

      </td>

  </tr>

</table><br>





  

  <?

emptyList($rs,4);

$index=0;

while($rows=fetch($rs))

{

  ?><table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle"><tr>

    <td colspan="2"  bgcolor="#F2F4F6"><strong>分类： <span class="STYLE1"> <?=$rows["name"]?> </span></strong> </td>

  </tr>

    <tr align="center" bgcolor="#FFFFFF">

    <td width="16%" align="left" bgcolor="#FFFFE9">分类名称：</td>

    <td width="84%" align="left" bgcolor="#FFFFE9"><input name="id<?=$index?>" type="hidden" value="<?=$rows["id"]?>" /><input type="text" name="name<?=$index?>" value="<?=$rows["name"]?>" size="60"  id="textfield" /></td>

    </tr>

	<tr align="center" bgcolor="#FFFFFF">

    <td width="16%" align="left" bgcolor="#FFFFE9">分类排序：</td>

    <td width="84%" align="left" bgcolor="#FFFFE9"><input name="sort<?=$index?>" type="text"  value="<?=$rows["sort"]?>" size="5" maxlength="5"/></td>

    </tr>	<tr bgcolor="#FFFFFF">

    <td>图片地址：</td>

    <td><img  src="<?=getImageURL($arrpic[$index],-1,"systemImage/",0)?>"   id="imgupload<?=$index?>" vspace="4" /><br>

<input name="pic<?=$index?>" type="text"  id="pic<?=$index?>"  value="<?=$rows["pic"]?>" size="60" />

<a href="javascript:void(0)" onClick="$('#tr_upload<?=$index?>').removeClass('hide');">点击本地浏览上传</a></td>

  </tr>

  <tr bgcolor="#FFFFFF" class="hide" id="tr_upload<?=$index?>">

    <td>

	&nbsp;

	<?

	$todir = dataDefault("",strftime("%Y-%m-%d-%H",time()));

	?></td>

    <td><script language="javascript">

	 function asCallOnePic<?=$index?>(pic,filename,uploadfolder)

	 {

	 	//alert(pic);

		document.getElementById("pic<?=$index?>").value = pic ;

		document.getElementById("imgupload<?=$index?>").src = "../image.php?pic=" + escape(pic) + "&style=-1&folder=" + escape(uploadfolder);

	 }

	 </script>

	 <object id="uploadsystem<?=$index?>" name="uploadsystem<?=$index?>"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">

	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic<?=$index?>&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" />

			<param name="quality" value="high" />

			<param name='allowScriptAccess'  value='always' />

			<param name='allowNetworking' value='all' />

			<param name="bgcolor" value="#869ca7" />

			<param name="wmode" value="opaque">

			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic<?=$index?>&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>

	</object></td>

    </tr></table><br>



 <?

 $index++;

 }

 ?>





<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">

  <tr  bgcolor="#FFFFE6">

    <td align="center"><input type="submit" class="button"  onClick="showtips(this)" name="Submit" value="点击此处统一提交" /></td>

  </tr>

</table><br>

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

global $cfg;

$id=getQuerySQL("id");

$sql="select * from $table where id=$id";

$rs=query($sql);

isItemNotExist($rs);

$rows=fetch($rs);



$sql="select type from @@@cate_tag where classid=$id";

$rs=query($sql);

$ctype=array();

while($ctrows=fetch($rs))

{

	$ctype[]=$ctrows["type"];

}

?>

<form action="?action=edit_save&id=<?=$id?>" name="formedit" enctype="application/x-www-form-urlencoded" method="post">

<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">

  <tr>

    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑分类</strong></td>

  </tr>

  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">

    <td width="16%" align="left">分类名称：</td>

    <td width="84%" ><input type="text" name="name" size="40" value="<?=$rows["name"]?>"/>    </td>

  </tr> 

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td align="left">分类显示：</td>

    <td ><select name="state" id="state" onChange="setChangeState(this)">

      <option value="0">隐藏分类</option>

      <option value="1">显示分类</option>

    </select>

	 <script>

     //--- 代码移到了  上下架的部分了。。

     </script>

	</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td align="left">上架下架：</td>

    <td ><input type="radio" name="pupdate" value="">

	 保持该分类下商品上下架状态不变<br>



	 <input type="radio" checked="checked" name="pupdate" value="1"> 

	 更新该分类下商品(包括仓库和上架的)的状态为 “<span class="red weight" id="statediv">显示</span>” 

     

      <script language="javascript">

	  function setChangeState(obj)

	  {

		  if(obj.value==0)

		  	$('#statediv').html("隐藏");

		  else

		  	$('#statediv').html("显示");

	  }

	  EnterSelect("state","<?=$rows["state"]?>");

		</script>  

     </td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td align="left">特殊外观：</td>

    <td >外观：<input name="css[]" type="checkbox" value="cate_bold"> <strong>加粗 english</strong> <input name="css[]" type="checkbox" value="cate_through"> <span style=" text-decoration:line-through">贯穿线 english</span>  <input name="css[]" type="checkbox" value="cate_italic"> <span style="font-style:italic">斜体 english</span>

	<br>

	颜色：<input name="css[]" type="checkbox" value="cate_red"> <span style="color:#FE1011">加红</span>  

	<input name="css[]" type="checkbox" value="cate_orange"> <span style="color:#FC7001;">加橙</span>

	<input name="css[]" type="checkbox" value="cate_green"> <span style="color:green;">绿色</span>

	<input name="css[]" type="checkbox" value="cate_yellow"> <span style="color:yellow;">黄色</span>

	<input name="css[]" type="checkbox" value="cate_blue"> <span style="color:blue;">蓝色</span>

	<input name="css[]" type="checkbox" value="cate_gray"> <span style="color:gray;">灰色</span>

	<input name="css[]" type="checkbox" value="cate_black"> <span style="color:black;">黑色</span>

	<input name="css[]" type="checkbox" value="cate_brown"> <span style="color:brown;">棕色</span>

	<input name="css[]" type="checkbox" value="cate_purple"> <span style="color:purple;">紫色</span>

	<script language="javascript">

	EnterCheckBox("css[]","<?=str_replace(" ",",",$rows["css"])?>")

	</script>	</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="16%" align="left">分类排序：</td>

    <td width="84%" ><input type="text" name="sort"  value="<?=$rows["sort"]?>"/></td>

  </tr><tr class="hide" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>显示类型：</td>

    <td><? showDisp($cfg["productclass"]["disp"])?>

	<script language="javascript">

		EnterCheckBox("disp[]","<?=c2tostr(decbin($rows["disp"]))?>");

	</script>	</td>

  </tr>

  <tr  onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td align="left" valign="top">列表排列：</td>

    <td >按字段 <select name="orderfield" id="orderfield">

	<option value="">默认级别的设置</option>

	<option value="id">上传时间</option>

	<option value="itemno">Item ID</option>

	<option value="price1">价格</option>

	<option value="sort">手动排序</option>

	<option value="addtime">更新时间</option>

	<option value="hits">产品访问量</option></select> <select  name="orderby" id="orderby">

	<option value="">默认级别的设置</option>

	<option value="desc">降序</option><option value="asc">升序</option>

	

	</select>

	<script language="javascript">EnterSelect("orderfield","<?=$rows["orderfield"]?>");</script>  

	<script language="javascript">EnterSelect("orderby","<?=$rows["orderby"]?>");</script>  </td>

  </tr>

  <tr class="hide" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td align="left" valign="top">排版模式：</td>

    <td ><input name="detailmode" type="radio" value=""><img align="absmiddle" src="images/table.gif" > &nbsp;&nbsp;<input name="detailmode" type="radio" value="2"><img align="absmiddle" src="images/list.gif" ><script language="javascript">

	EnterRadio("detailmode","<?=$rows["detailmode"]?>")

	</script></td>

  </tr>

  <tr class="hide" onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td align="left" valign="top">搜索标签：</td>

    <td>

    <? 

		for($index=1;$index<=count($cfg["product"]["tagtype"])-1;$index++)

		{

			

	?>

       <input name="tag[]" type="checkbox" value="<?=$index;?>" /> <?=$cfg["product"]["tagtype"][$index ];?>

    <?

		}

	?>

	<script language="javascript">

		EnterCheckBox("tag[]","<?=$rows["filtergroup"]?>");

	</script>    

    

    </td>

  </tr>

  

  <tr onMouseMove="tr_onMouseOver(this)"  class="hide" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td align="left" valign="top">分类图片：</td>

    <td ><img src="<?=getImageURL($rows["pic"],-1,"systemImage/",0)?>" vspace="4" id="imgupload"/><br><input name="pic" type="text" id="pic" value="<?=$rows["pic"]?>" size="60" /></td>

  </tr>

  <tr  class="hide"  bgcolor="#FFFFFF">

    <td align="left" valign="top"><? $path_parts = pathinfo( $rows["pic"] );

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

			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>

	</object>	</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  class="" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td align="left" valign="top">大图片：</td>

    <td ><img src="<?=getImageURL($rows["bigpic"],-1,"systemImage/",0)?>" vspace="4" id="imguploadbig"/><br><input name="bigpic" type="text" id="bigpic" value="<?=$rows["bigpic"]?>" size="60" /></td>

  </tr>

  <tr  class=""  bgcolor="#FFFFFF">

    <td align="left" valign="top"><? $path_parts = pathinfo( $rows["bigpic"] );

	$todir = $path_parts["dirname"] ; 

	$todir = dataDefault($todir,strftime("%Y-%m-%d-%H",time()));

	?></td>

    <td >

	<script language="javascript">

	 function asCallOnePic1(pic,filename,uploadfolder)

	 {

	 	//alert(pic);

		document.getElementById("bigpic").value = pic ;

		document.getElementById("imguploadbig").src = "../image.php?pic=" + escape(pic) + "&style=-1&folder=" + escape(uploadfolder);

	 }

	 </script>

	 <object id="uploadsystem1" name="uploadsystem1"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">

	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic1&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(LOCALCGIBIN)?>" />

			<param name="quality" value="high" />

			<param name='allowScriptAccess'  value='always' />

			<param name='allowNetworking' value='all' />

			<param name="bgcolor" value="#869ca7" />

			<param name="wmode" value="opaque">

			<embed   id="uploadsystem1" name="uploadsystem1" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic1&filepath=systemImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>

	</object>	</td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="16%" align="left">SEO(标题Title)：</td>

    <td width="84%" ><textarea name="title" style="width:700px; height:70px" id="title"><?=$rows["title"]?></textarea></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="16%" align="left">SEO(关键字Keywords)：</td>

    <td width="84%" ><textarea name="keywords" style="width:700px; height:70px" id="title"><?=$rows["keywords"]?></textarea></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="16%" align="left">SEO(描述Descript)：</td>

    <td width="84%" ><textarea name="descript" style="width:700px; height:70px" id="title"><?=$rows["descript"]?></textarea></td>

  </tr>

  <tr  class=""  bgcolor="#FFFFFF">

    <td width="16%" align="left" valign="top">分类介绍：</td>

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

  var ff="ie";



function DefineRequest()

{	

	//开始初始化XMLHttpRequest对象

	var xmlRequest;



    try{

     if(window.ActiveXObject)

     {

      var MSXML = new Array('MSXML2.XMLHTTP','Microsoft.XMLHTTP','MSXML2.XMLHTTP.3.0','MSXML2.XMLHTTP.4.0','MSXML2.XMLHTTP.5.0');

      for(var i=0;i<MSXML.length;i++)

      {

       try

       {  

        xmlRequest = new ActiveXObject(MSXML[i]);

        break;

       }

       catch(e)

       {

        xmlRequest = null;

       } 

      }

     }

     else if(window.XMLHttpRequest)

     {ff="ff";

      xmlRequest = new XMLHttpRequest();

      if(xmlRequest.overrideMimeType)

      {

       xmlRequest.overrideMimeType('text/xml');

      }

     } 

        if(xmlRequest == null)

        { // 异常，创建对象实例失败

        window.alert("不能创建XMLHttpRequest对象实例.");

        return false;

        }

    }

    catch(e){}

    return xmlRequest;

}



var xmlhttp=DefineRequest();

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

	    if(xmlhttp.readyState==4)

		   if(xmlhttp.status==200)

		      {   

			      var html=xmlhttp.responseText;

				  

				  document.getElementById("selecttd").innerHTML=html

		       }

	}

</script>

<form action="?action=move_save" enctype="application/x-www-form-urlencoded" method="post">



<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#CC0000;">

  <tr  bgcolor="#FFD0D0">

    <td  >

提示：移动分类只能一个分类一个分类进行，避免出现调用数据失败的情况。</td>

  </tr>

</table>

<br>



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

   <tr class="edit"   bgcolor="#FFFFE9">

    <td width="16%" align="left">&nbsp;</td>

    <td width="84%" ><input type="submit"  onClick="showtips(this)" class="button"  name="button" id="button" value="提交" /></td>

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

	global $cfg;

	$id=getQuerySQL("id");

	

	$tree=fetchValue("select tree as v from @@@productclass where id=$id","0");

	$condition=" where classid in ($tree)";

	//deletePpic( "product",$condition , $cfg["deleteImage"] ,"../uploadImage/",IMAGE );

	$rs=deleteRecord("@@@product","$condition");

	$arrid = array();

	while($rows=fetch($rs))

	{

		$arrid[]=$rows["id"] ; 

		deleteImage( $rows["pic"] , $cfg["deleteImage"] , "../uploadImage/",IMAGE );

	}

	$condition="where pid in (" . dataDefault( join(',',$arrid) ,0) . ")";

	$rs=deleteRecord("@@@otherimage","$condition");

	while($rows=fetch($rs))

	{

		deleteImage( $rows["pic"] , $cfg["deleteImage"] , "../otherImage/",IMAGE );

	}

	//deletePpic( "otherimage",$condition , $cfg["deleteImage"] ,"../otherimage/",IMAGE );

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

		$u->edit($id,$name,$sort,"!","!",$pic,false);

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

	$param=array();

	$param["title"]=getForm("title");

	$param["css"]= str_replace(","," ",getFormStr("css"));

	$param["keywords"]=getForm("keywords");

	$param["descript"]=getForm("descript");

	$param["orderfield"]=getForm("orderfield");

	$param["orderby"]=getForm("orderby");

	$param["detailmode"]=getForm("detailmode");

	$param["disp"] = strtoint( getForm("disp") );

	$param["filtergroup"]=join(",",getForm("tag"));

	$param["bigpic"]=getForm("bigpic");

	$condition=" where id=$id";

	$sql=updateSQL($param,"@@@productclass",$condition);

	query($sql);

	if( getForm("pupdate")!="")

	{

		$param=array();

		if( $state==0 )

		{

			$param["state"]="@id*-1";

		}

		else

		{

			$param["state"]="@id";

		}

		

		$tree=fetchValue("select tree as v from @@@productclass where id=$id","0");

		

		$condition=" where classid in ($tree)";

		$sql=updateSQL($param,"@@@product",$condition);

	}

	

	query($sql);

	

	

	pageRedirect("修改成功",($_SERVER['HTTP_REFERER']));

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

