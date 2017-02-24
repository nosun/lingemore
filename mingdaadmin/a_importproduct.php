<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>导入远程数据</title></head>

<body>
<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">导入远程数据</div>
</div>
</td></tr></table>
<br />
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


</script>

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="a_importproduct.php">导入远程数据</a><span class="fontpadding"><a href="a_importproduct.php?action=step_4">直接采集图片</a></span></td>
  </tr>
</table><br />
<?php
isAuthorize($group[2]);
$action=getQuery("action");
$u1=new unlimClass("@@@productclass");
$u1->connect($conn);
$proot=$u1->create("产品分类");
$u2=new unlimClass("@@@brandclass");
$broot=$u2->create("品牌分类");
switch($action)
{
case "step_4":
	step_4();
	break;
case "step_3":
	step_3();
	break;
case "step_image":
	step_image();
	break;
case "step_2":
	step_2();
	break;
default:
	step_1();
	break;
}
?><?
function step_1()
{
global $cfg;
global $proot;
global $broot;
global $glo;
$config=$glo["config"];
$classid = getQueryInt("classid",$proot);
?><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td ><p>1 导入的时间请选择在网络稳定良好的时候!避免出现中断的情况。<br>
      2 第一步： 输入需要采集网站的MYSQL账户信息以及对方网站的域名。<br>
    3 第二步：选择你所想要导入远程网站的分类，以及要导入到本站的哪个分类。<br>
    4 第四步：采集图片。</p></td>
  </tr>
</table><br>

<form action="?action=step_2" method="post" enctype="application/x-www-form-urlencoded" id="formadd" name="formadd">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>第一步：输入目标网站的信息</strong><span class="fontpadding"><a target="_blank" href="http://open.35zh.com/download/p_download_caiji.rar" class="red weight"><img src="images/shipin.gif" hspace="4" align="absmiddle"> 强烈建议下载3分钟的视频教程</a></span></td>
    </tr>
  
   <tr    bgcolor="#FFFFFF">
     <td valign="top">Mysql地址：</td>
     <td><input type="text" name="mysqlip" value="127.0.0.1" style="width:150px"></td>
   </tr>
   <tr    bgcolor="#FFFFFF">
     <td width="18%" valign="top">Mysql用户：</td>
     <td width="82%"><input type="text" name="mysqluser" value="sq_aaaluxcaiji" style="width:150px"></td>
   </tr>
   <tr  bgcolor="#FFFFFF">
     <td valign="top">Mysql密码：</td>
     <td><input type="text" name="mysqlpwd" value="5d3b25d5559e8a2d" style="width:150px">
	</td>
   </tr>
  
   <tr    bgcolor="#FFFFFF">
     <td valign="top">Mysql库名：</td>
     <td><input type="text" name="mysqldbname" value="sq_aaaluxcaiji" style="width:150px"></td>
   </tr>
   <tr    bgcolor="#FFFFFF">
     <td valign="top">表明前缀：</td>
     <td><input type="text" name="mysqltbpre" value="" style="width:150px"></td>
   </tr>
   <tr    bgcolor="#FFFFFF">
     <td valign="top">图片域名：</td>
     <td><input type="text" name="imagedomain" value="www.baidu.com" style="width:150px"></td>
   </tr>
    <tr    bgcolor="#FFFFFF">
     <td valign="top"></td>
     <td><input type="submit" name="Submit5"  onClick="return gotostep2(this);" class="button"  value="第二步:选择所要导入的分类" /></td>
   </tr>
</table>
<script language="javascript">
function gotostep2(obj)
{
	if($('#producturl').val()=="")
	{
		var a = confirm("检测到采集的产品详细链接有空？是否确定进入第二步，需要您手动收入产品详细链接");
		if(!a)
			return false;
	}
	showtips(obj);

}
</script>
</form>
<?
}
?>
<?
function step_2()
{
global $cfg;
global $proot;
$classid = $proot;
$mysqlip = getForm("mysqlip");
$mysqluser = getForm("mysqluser");
$mysqlpwd = getForm("mysqlpwd");
$mysqldbname = getForm("mysqldbname");
$mysqltbpre = getForm("mysqltbpre");
$imagedomain = getForm("imagedomain");
?>
<form action="?action=step_3" method="post" enctype="application/x-www-form-urlencoded" id="formadd" name="formadd">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>第二步：选择目标站的分类以及本站的分类</strong></td>
    </tr>
  <tr   bgcolor="#FFFFFF">
    <td width="18%">目标站的分类：</td>
    <td width="82%"><select name="remoteclassid" id="remoteclassid">
      <?
	  $conn2=mysql_connect($mysqlip,$mysqluser,$mysqlpwd,true);
	  if(!$conn2)
	  	 alertRedirect("Mysql用户名或者密码错误","a_importproduct.php");
	  if(!mysql_select_db($mysqldbname,$conn2))
	  	alertRedirect("Mysql数据库名错误","a_importproduct.php");
	  mysql_query("set names UTF8",$conn2);
	  $sql = "select id  from {$mysqltbpre}productclass order by id asc limit 1";
	  $rs=mysql_query($sql,$conn2);
	 if(BOF($rs))
	  	alertRedirect("数据库分类表为空","a_importproduct.php");
	  $rows=fetch($rs);
	  $remote_proot = $rows["id"];
	  $sql = "select id,name,son,1 as state,level from {$mysqltbpre}productclass";
	  $rs=mysql_query($sql,$conn2);
	  while($rows=fetch($rs))
	  {
			$remoteclass[$rows["id"]]=$rows;  
	  }
	// debug($remoteclass);
	   classOption($remote_proot,$remoteclass);
	  ?>
    </select>
    下面的所有子类,<span class="red"><strong>但不包括目前选中的分类</strong></span>
    <input name="mysqlip" type="hidden"  value="<?=$mysqlip?>" />
    <input name="mysqluser" type="hidden" value="<?=$mysqluser?>" />
    <input name="mysqlpwd" type="hidden" value="<?=$mysqlpwd?>" />
    <input name="mysqldbname" type="hidden"  value="<?=$mysqldbname?>" />
    <input name="mysqltbpre" type="hidden" value="<?=$mysqltbpre?>" />
    <input name="imagedomain" type="hidden"  value="<?=$imagedomain?>" /></td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
     <td>自己站的父类：</td>
     <td><? classRelation($classid,8,"@@@productclass"); ?></td>
   </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>&nbsp;</td>
    <td><input id="classname" style="width:200px" type="text" readonly="" value="<?=fetchValue("select name as v from @@@productclass where id=$classid","分类已被删除")?>" />
      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>
  </tr>
    <tr    bgcolor="#FFFFFF">
     <td valign="top"></td>
     <td><input type="submit" name="Submit5"  onClick="return gotostep2(this);" class="button"  value="第二步:导入分类和产品" /></td>
   </tr>
</table>

</form>
<?
}
?>

<?
function step_3()
{
global $cfg;
global $proot;
global $glo;
global $u1;
global $conn;
$config=$glo["config"];
$classid = getFormInt("classid",$proot);
$remoteclassid = getFormInt("remoteclassid",0);
$mysqlip = getForm("mysqlip");
$mysqluser = getForm("mysqluser");
$mysqlpwd = getForm("mysqlpwd");
$mysqldbname = getForm("mysqldbname");
$mysqltbpre = getForm("mysqltbpre");
$imagedomain = getForm("imagedomain");
$conn2=mysql_connect($mysqlip,$mysqluser,$mysqlpwd,true);
if(!$conn2)
	alertRedirect("Mysql用户名或者密码错误","a_importproduct.php");
if(!mysql_select_db($mysqldbname,$conn2))
	alertRedirect("Mysql数据库名错误","a_importproduct.php");
mysql_query("set names UTF8",$conn2);
$sql = "select id  from {$mysqltbpre}productclass order by id asc limit 1";
$rs=mysql_query($sql,$conn2);
if(BOF($rs))
	alertRedirect("数据库分类表为空","a_importproduct.php");
$rows=fetch($rs);
$remote_proot = $rows["id"];
$sql = "select id,name,son,1 as state,level,name,content,title,descript,keywords from {$mysqltbpre}productclass";
$rs=mysql_query($sql,$conn2);
while($rows=fetch($rs))
{
	$remote_class[$rows["id"]]=$rows;  
}
	  
?>
<form action="?action=step_4&id=<?=$id?>" method="post" enctype="application/x-www-form-urlencoded" id="formadd" name="formadd">
  <table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>第三步：产品图片列表</strong></td>
    </tr>
  <tr   bgcolor="#FFFFFF">
    <td width="18%" valign="top">操作记录：</td>
    <td width="82%"><? startImportData($conn2,$remoteclassid,$remote_class,true,$conn,$u1,$classid,$arr_image,$arr_otherimage,$mysqltbpre);
	//echo join(',',$arr_image);
	?></td>
  </tr>
   <tr   bgcolor="#FFFFFF">
    <td width="18%" valign="top">图片列表：</td>
    <td width="82%"><?=count($arr_image);?> 张主图  <?=count($arr_otherimage);?> 张细节图 
      <input name="productpic" type="hidden"  value="<?=join(',',$arr_image)?>" />
      <input name="otherimagepic" type="hidden"  value="<?=join(',',$arr_otherimage)?>" /><input name="imagedomain" type="hidden"  value="<?=$imagedomain?>" /></td>
  </tr>
   <tr    bgcolor="#FFFFFF">
     <td valign="top"></td>
     <td><input type="submit" name="Submit5"  onClick="return gotostep2(this);" class="button"  value="第三步:下载图片" /></td>
   </tr>
  </table>

</form>
<?
}
?>
<?
function step_4()
{

$imagedomain = getForm("imagedomain");
$productpic = getForm("productpic");
$otherimagepic = getForm("otherimagepic");

$arrproductpic = split(",",$productpic);
$arrotherimagepic = split(",",$otherimagepic);
removeSplitEmpty($arrproductpic);
removeSplitEmpty($arrotherimagepic);
?>
<script language="javascript">
function asCallJsLoadUrl()
{

	var urllist= $.trim($('#producturl').val());
	if(urllist=="")
	{
		alert("任务不能为空");
		return "";
	}
	arrurl=urllist.split('\n');
	for(index=0;index<arrurl.length;index++)
	{
		arrurl[index] = "php_importproductimage.php?url="+escape(arrurl[index])+"&<?=REMOTECOMMAND?>";	
	}
	return arrurl.join('@');
}
</script>
<form action="?action=step_4&id=<?=$id?>" method="post" enctype="application/x-www-form-urlencoded" id="formadd2" name="formadd">
  <table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
    <tr>
      <td  bgcolor="#F2F4F6" colspan="2"><strong>第四步：下载产品图片</strong></td>
    </tr>
    <tr   bgcolor="#FFFFFF">
      <td width="18%" valign="top">图片列表：</td>
      <td width="82%"><textarea name="producturl" id="producturl"  style="width:700px; height:400px; font-size:11px"><?
      for($index=0;$index<count($arrproductpic);$index++)
	  {
			echo "http://" .  $imagedomain . "/"."|uploadImage/|" . $arrproductpic[$index] ."\n";
	  }
	  for($index=0;$index<count($arrotherimagepic);$index++)
	  {
			echo "http://" .  $imagedomain . "/"."|otherImage/|" . $arrotherimagepic[$index] ."\n";
	  }
	  ?></textarea></td>
    </tr>
    <tr    bgcolor="#FFFFFF">
     <td valign="top">&nbsp;</td>
     <td><div style="color:#FF0000">若批量上传模块不能正常工作!请更新 FLASH for IE版本 到 9  <a target="_blank" href="http://www.skycn.com/soft/5671.html">更新</a></div>
	<object  id="uploadsystem" name="uploadsystem" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="450" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="queuesystem.swf?rnd=<?=time()?>&<?=REMOTECOMMAND?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="queuesystem.swf?rnd=<?=time()?>&<?=REMOTECOMMAND?>" quality="high" bgcolor="#869ca7" width="700" height="450" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
   </tr>
  </table>
</form>
<?
}
?>

<?
function startImportData($conn2,$remote_id,$remote_class,$isroot,$conn,$punlim,$classid,&$arr_image,&$arr_otherimage,$mysqltbpre)
{
	//print_r($remote_id);
	if(!$isroot)
	{
		$name = $remote_class[$remote_id]["name"];
		$newclassid = $punlim->add($classid,$name,0,1,"","");
		echo "创建分类 : " . $name . " ";
		$classid = $newclassid;
		$param = array();
		$param["title"] = $remote_class[$remote_id]["name"];
		$param["keywords"] = $remote_class[$remote_id]["keywords"];
		$param["descript"] = $remote_class[$remote_id]["descript"];
		$param["content"] = $remote_class[$remote_id]["content"];
		$condition = "where id=" . $newclassid;
		$sql=updateSQL($param,"@@@productclass",$condition);
		query($sql);
	}
	$sql = "select id,name,itemno,name,content,pkey,pvalue,itemno,pic,ckey,price1,price2,cvalue,ctype,pprice,pnum,lastprice,title,descript,keywords,weight from {$mysqltbpre}product where classid=" . $remote_id;
    $rs = mysql_query($sql,$conn2);
	echo "导入该分类 : " . mysql_num_rows($rs) . " 张图片<br/>";
	while($rows=fetch($rs))
	{
		$oldpid =  $rows["id"];
		unset($rows["id"]);
		$param = array();
		$arr_image[] = $rows["pic"];
		$rows["classid"] = $classid ;
		$param = $rows;
		$sql=insertSQL($param,"@@@product");
		query($sql);
		$newpid =mysql_insert_id($conn);
		$param=array();
		$param["state"]="@id";
		$condition = "where id=" . $newpid;
		$sql=updateSQL($param,"@@@product",$condition);	
		query($sql);
		$sql = "select name,cid,pic,type from {$mysqltbpre}otherimage where pid=".$oldpid;
		$ors = mysql_query($sql,$conn2);
		while($orows=fetch($ors))
		{
			$param = array();
			$arr_otherimage[] = $orows["pic"];
			$orows["pid"] = $newpid ;
			$param = $orows;
			$sql=insertSQL($param,"@@@otherimage");
			query($sql);
		}
	}
  
  $son=$remote_class[$remote_id]["son"];
  if($son!="")
  {
		$arrson=split(',',$son);
		for($index=0;$index<count($arrson);$index++)
		{
			startImportData($conn2,$arrson[$index],$remote_class,false,$conn,$punlim,$classid,$arr_image,$arr_otherimage,$mysqltbpre);
		}
	}
}

?>
<? require("php_bottom.php");?>
</body>
</html>
