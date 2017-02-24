<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>压缩文件管理</title>
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
<?php 
require("../inc/php_inc_zip.php");
require("php_top.php");
?>
<link href="php_css.php?a=<?=$perm[6][2]?>&e=<?=$perm[6][1]?>&d=<?=$perm[6][3]?>" type="text/css" rel="stylesheet" />
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">压缩管理</div>
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
    <td    ><a href="?">压缩管理</a>&nbsp;</td>
  </tr>
</table>
<br />
<?
$maxlevel=5;
$table="productclass";
$rootname="产品分类";
$page="a_productclass.php";

$u=new unlimClass($table);
$root=$u->create("$rootname");
$action=getQuery("action");
switch($action)
{
case "unzip":
	unzip();
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
    <td  bgcolor="#F2F4F6" colspan="4"><strong>文件夹</strong> <?=getQueryDefault("prefolder","root_products/")?></td>
  </tr>
 <Tr>
  <td  style="padding:0">
  <div id="item1" class='c1'>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" >
	<tr  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td height="18" align="left" style="line-height:18px; ">
	<a href="?folder=<?=urlencode( getQueryDefault("prefolder","root_products/")  )?>"><img src="images/folder.jpg" hspace="4" align="absmiddle">返回上一级</a></td>
	<td align="center" width="60">&nbsp;</td>
	<td align="center" width="60">&nbsp;</td>
    <td align="center" width="300">&nbsp;</td>
  </tr>
  </table>
  </div>
  <?
  
  //$class=fetchAllClass("$table");
  function folderShow($folder)
  {
	$handle = opendir( ROOT . FOLDER . $folder ); 
	$tmpdir = array();
	$filenum = 0 ;
	while ( $file = readdir($handle) )
	{ 
		if ($file <> '.' && $file <> '..') 
		{ 
			$bdir = ROOT . FOLDER .  $folder . $file  ;
			
  ?>
  
   
	<?
	if( is_dir($bdir) )
	{
	?>
	<div id="item1" class='c1'>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" >
	<tr  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td height="18" align="left" style="line-height:18px; ">
	<a href="?folder=<?=urlencode( $folder . $file . "/" )?>&prefolder=<?=urlencode( $folder  )?>"><img src="images/folder.jpg" hspace="4" align="absmiddle"><?=$file?></a></td>
	<td align="center" width="60"></td>
	<td align="center" width="60"></td>
    <td align="center" width="300"></td>
	</tr>
	</table></div>
	<?
	}
	else
	{
		$source = ROOT . FOLDER . $directory . '' . $file ;
		$path_parts = pathinfo( $source );
		$ext = $path_parts["extension"] ;
		if( $ext=="rar" || $ext=="zip" )
		{
	?>
	<div id="item1" class='c1'>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" >
	<tr  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td height="18" align="left" style="line-height:18px; ">
	<a href="#"><img src="images/rar.jpg" hspace="4" align="absmiddle"><?=$file?></a>
	</td>
	<td align="center" width="60">&nbsp;</td>
	<td align="center" width="60">&nbsp;</td>
    <td align="center" width="300"><a href="?action=unzip&file=<?=urlencode( $folder . $file  )?>&todir=<?=urlencode( $folder   )?>">解压开</a></td>
  </tr>
  </table>
  </div>
	<?
		}
	}
	?>
	
  
	<?
		}
	}
	closedir( $handle ); //关闭目录
}
	folderShow(getQueryDefault("folder","root_products/"));
	?>
	
	</td></Tr>
</table>
<?
}
?>

<?
function unzip()
{
	$source = "../"  . getQuery("file") ;
	$archive = new PclZip($source); 
	if ($archive->extract(PCLZIP_OPT_PATH, "../" . getQuery("todir")) == 0) 
	{
    	die("Error : ".$archive->errorInfo(true));
    }
	pageRedirect("修改成功","a_zip.php");
}
?>
<? require("php_bottom.php");?>
</body>
</html>
