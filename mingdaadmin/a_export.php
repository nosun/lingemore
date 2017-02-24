<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站管理</title>
</head>

<body>
<style>
.marginbottom{ margin-bottom:15px}
</style>
<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">网站管理</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="a_daohang.php">网站管理</a></td>
  </tr>
</table><br />
<?php
isAuthorize($group[2]);
$action=getQuery("action");
$u1=new unlimClass("@@@productclass");
$proot=$u1->create("产品分类");
switch($action)
{
case "export":
	export_data();
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
global $proot;
global $glo;
$config=$glo["config"];
$classid = $proot;
?>
<form name="form2" method="post" action="?action=export">
  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>导出分类产品</strong></td>
  </tr>
    <tr   bgcolor="#FFFFFF">
    <td width="18%">选择分类：</td>
    <td width="82%"><? classRelation($classid,8,"@@@productclass"); ?></td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>选中分类：</td>
    <td><input id="classname" style="width:200px" type="text" readonly="" value="<?=fetchValue("select name as v from @@@productclass where id=$classid","分类已被删除")?>" />
      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>
  </tr>
    <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="20%" >导出后ID：</td>
    <td width="80%" ><input type="text" name="newclassid" id="textfield"></td>
  </tr> 
    <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
      <td >新文件夹：</td>
      <td  ><input name="newfolder" type="text" id="textfield" value="newpic/"></td>
    </tr>
  <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td >&nbsp;</td>
    <td  ><input type="submit" name="Submit3" value="提交"  class="button" ></td>
  </tr>
</table>
</form>
<?
}
?>
<?
function export_data()
{
	global $proot;
	$strsql = "";
	$productnum = 0;
	if(getForm("newclassid")!="" && getForm("classid")!=$proot)
	{
		
		$strsql = "SET @newclassid=".getFormInt("newclassid",0).";\n\n" ;
		$sql = "select id,name,content,pkey,pvalue,itemno,price1,price2,ckey,cvalue,ctype,cprice,pprice,pnum,lastprice,title,descript,keywords,weight from product where classid=" . getFormInt("classid",0);
		$rs  = query($sql);
		while($rows = fetch($rs))
		{
			$productnum ++ ;
			$pid = $rows["id"] ; 
			$rows["classid"] = "@@newclassid";
			$rows["pic"] = $strfolder . $rows["pic"] ;
			unset($rows["id"]); 
			$strsql .= insertSQL($rows,"product").";\n";
			$strsql .= "select  @productid:=max(id) from product;\n";
			$strsql .= "update product set state=id where id=@productid;\n";
			$sql = "select name,cid,pic,type from otherimage where pid=".$pid;
			$ors  = query($sql) ;
			while($orows = fetch($ors))
			{
				$orows["pid"] = "@@productid";
				$orows["pic"] = $strfolder . $orows["pic"] ;
				$strsql.= insertSQL($orows,"otherimage").";\n";
			}
		$strsql .="\n";
		}
	}
?>
<br>
<table border="0" width="96%" align="center" cellpadding="4" cellspacing="1" class="tbtitle marginbottom">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>SQL语句 <span class="red">(<?=$productnum?>个产品)</span></strong></td>
  </tr>
  <tr>
    <td bgcolor="#ffffff">
    
    <textarea style=" width:100%; height:400px"><?=$strsql?></textarea>
    </td>
  </tr></table>
<?
	
}
?>
<?php require("php_bottom.php");?>
</body>
</html>