<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>采集数据</title></head>

<body>
<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">采集数据</div>
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

function countPage()
{

}

function getProductUrl(type,obj)
{
	startpage = $("#startpage").val();
	endpage = $("#endpage").val();
	if(type==2)
	{
		totalnum = $("#totalnum").val();
		pagesize = $("#pagesize").val();
		if( !CheckIsNum("formadd","totalnum","产品总个数") ) 
			return false ;
		if( !CheckIsNum("formadd","pagesize","每页的产品个数") ) 
			return false ;
		startpage = 1;
		endpage = parseInt(totalnum/pagesize) ;
		if( totalnum % pagesize !=0 )
			endpage ++ ;
	}
	
	if($("#rule").val()=="")
	{
		alert("规则不能为空");
		return;
	}
	if($("#categoryurl").val()=="")
	{
		alert("分类链接不能为空");
		return;
	}
	obj.value="采集产品链接中。。请耐心等待";
	obj.disabled=true;
	xmlhttp.open("POST","php_getProductUrl.php?url="+ $("#categoryurl").val() + "&rule=" + escape($("#rule").val())+"&startpage="+startpage+"&endpage="+endpage,true);
	xmlhttp.onreadystatechange=function(){sth_getProperty()};
    xmlhttp.send(null);
}

function sth_getProperty()
{
 if(xmlhttp.readyState==4)
		   if(xmlhttp.status==200)
		      {   
				  $("#producturl").val(xmlhttp.responseText);
				  strtemp = xmlhttp.responseText.split('\n') ;
				  alert("采集成功，总共采集到产品链接数:"+ strtemp.length);
		       }
}

</script>

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="a_caiji.php">采集数据</a><span class="fontpadding"><a href="a_caiji.php?action=log">采集日志</a></span></td>
  </tr>
</table><br />
<?php
isAuthorize($group[2]);
$action=getQuery("action");
$u1=new unlimClass("@@@productclass");
$proot=$u1->create("产品分类");
$u2=new unlimClass("@@@brandclass");
$broot=$u2->create("品牌分类");
switch($action)
{
case "step_edit_save":
	step_edit_save();
	break;
case "add_save":
	add_save();
	break;
case "log":
	show_log();
	break;
case "step_edit":
	step_edit();
	break;
case "deletelogfile":
	deletelogfile();
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
    <td >1 采集的时间请选择在网络稳定良好的时候!避免出现中断的情况<br>
2 第一步： 输入需要采集的产品分类链接。并填写页码,点击 "采集链接",等到获取到 产品详细链接的 内容后，点击 "第二步:采集产品信息" 。<br>
3 第二步： 请务必选择 "产品分类", 点击 "加载链接" 后再点击 "开始采集"</td>
  </tr>
</table><br>

<form action="?action=step_2" method="post" enctype="application/x-www-form-urlencoded" id="formadd" name="formadd">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>第一步：采集产品链接</strong><span class="fontpadding"><a target="_blank" href="http://open.35zh.com/download/p_download_caiji.rar" class="red weight"><img src="images/shipin.gif" hspace="4" align="absmiddle"> 强烈建议下载3分钟的视频教程</a></span></td>
    </tr>
  
   <tr    bgcolor="#FFFFFF">
     <td valign="top">分类规则：</td>
     <td><select name="rule" id="rule">
	 <?
	 $dir="../inc/rule/category/";
	 $redir=opendir($dir);
	 while($folder=readdir($redir))
	 {
		 if($folder!="." && $folder!="..")
		 {
		 $rulename = str_replace(".php","",$folder);
	 ?>
       <option value="<?=$rulename?>"><?=$rulename?></option>
	  <?
	 	 }
	 }
	 ?></select><input name="classid" type="hidden" value="<?=getQuery("classid")?>"></td>
   </tr>
   <tr    bgcolor="#FFFFFF">
     <td width="18%" valign="top">分类链接：</td>
     <td width="82%"><input type="text" name="categoryurl" id="categoryurl" style="width:700px"></td>
   </tr>
   <tr  bgcolor="#FFFFFF">
     <td valign="top">页码范围：</td>
     <td>
	 <script language="javascript">
	 function showTr(obj)
	 {
	 	if(obj.value==1)
		{
			$("#tr_type_1").removeClass("hide");
			$("#tr_type_2").addClass("hide");
		}
		else if(obj.value==2)
		{
			$("#tr_type_1").addClass("hide");
			$("#tr_type_2").removeClass("hide");
		}
	 }
	 </script>
	 <select name="select" id="select" onChange="showTr(this)">
       <option value="">请选择 页码的页面的形式</option>
	 
       <option value="1">输入开始页数 和 结束的页数</option>
       <option value="2">输入产品总数 和 每页的产品数</option>
     </select>   </td>
   </tr>
   <tr id="tr_type_1"   class="hide"    bgcolor="#FFFFFF">
     <td valign="top">&nbsp;</td>
     <td>第 <input type="text" name="startpage" id="startpage" value="1" style="width:80px"> 页 到 第 <input type="text" id="endpage" name="endpage" value="" style="width:80px"> 页 &nbsp;&nbsp;<input  name="" onClick="getProductUrl(1,this)" value="采集链接" type="button">&nbsp;&nbsp;<span class="red">不指定最后一页将只采集到第100页，并过滤重复。</span></td>
   </tr>
   <tr  id="tr_type_2"   class="hide"    bgcolor="#FFFFFF">
     <td valign="top">&nbsp;</td>
     <td>产品总个数：<input type="text" id="totalnum" name="totalnum" value="" style="width:80px">
&nbsp;&nbsp;每页显示数：<input type="text" name="pagesize" id="pagesize" value="20" style="width:80px"> <input name="" onClick="getProductUrl(2,this)" value="采集链接" type="button"></td>
   </tr>
  
   <tr    bgcolor="#FFFFFF">
     <td valign="top">采集结果：</td>
     <td><textarea readonly="readonly" name="producturl" id="producturl"  style="width:700px; height:400px; font-size:11px"></textarea></td>
   </tr>
    <tr    bgcolor="#FFFFFF">
     <td valign="top"></td>
     <td><input type="submit" name="Submit5"  onClick="return gotostep2(this);" class="button"  value="第二步:采集产品信息" /></td>
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
function show_log()
{
?>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >注意：采集日志只记录采集失败的URL或者插入失败的数据。确认无误后请记的删除!</td>
  </tr>
</table><br>

<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="7"><strong>采集日志</strong></td>
  </tr><tr  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
	  <td  align="left">日志名称</td>
	  <td align="left" style="line-height:18px; ">对应分类</td>
	  <td align="center" style="line-height:18px; ">文件大小</td>
	  <td align="center" style="line-height:18px; ">修改时间</td>
	  <td align="center" >操作</td>
  </tr>
  <?
  
  //$class=fetchAllClass("$table");
	$class=fetchAllClass("@@@productclass");
	$handle = opendir(  "log/" ); 
	$tmpdir = array();
	$filenum = 0 ;
	getDirSize("log/",$a,$filenum);
	if( $filenum==0 )
		echo "<tr  align='center'  bgcolor='#FFFFFF'   ><td colspan='4' align='center'>对不起,尚未有相关数据</td></tr>";
	while ( $file = readdir($handle) )
	{ 
		if ($file <> '.' && $file <> '..') 
		{ 
		$rartime = filemtime("log/".$file);
		$logtimesize = filesize("log/".$file);
		preg_match("/([\d])+/i",$file,$matches_final);
		$classid = $matches_final[0];
		$classname = "All";
		if( $classid!="" )
		{
			$classurl = split(',', $class[$classid]["url"] );
			for($index=1;$index<count($classurl);$index++)
			{
				$classname.= " &gt; ". $class[$classurl[$index]]["name"] ; 
			}
		}
		else
		{
			$classname = "不存在";
		}
	?>

	
	<tr  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="21%" align="left">
	<a href="log/<?=$file?>" target="_blank"><?=$file?></a>	</td>
	<td width="45%" align="left"><?=$classname?></td>
	<td width="13%" align="center"><?=$logtimesize?> Byte</td>
	<td width="9%" align="center"><?=formatDate($rartime)?></td>
	<td width="12%" align="center" ><a href="?action=deletelogfile&logfile=<?=urlencode( $file  )?>">删除</a></td>
  </tr>
	<?
		}
	}
	closedir( $handle ); //关闭目录
	
	?>
</table>
<?
}
?>
<?
function step_2()
{
global $cfg;
global $proot;
global $broot;
global $glo;
$config=$glo["config"];
$classid = getFormInt("classid",$proot);
$url_content = explode("\n",getForm("producturl"));
$arrurl = array_reverse($url_content);
?>
<form action="?action=p_add_save" method="post" enctype="application/x-www-form-urlencoded" id="formadd" name="formadd"><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >1 采集的时间请选择在网络稳定良好的时候!避免出现中断的情况<br>
2 第一步： 输入需要采集的产品分类链接。并填写页码,点击 "采集链接",等到获取到 产品详细链接的 内容后，点击 "第二步:采集产品信息" 。<br>
3 第二步： 请务必选择 "产品分类", 点击 "加载链接" 后再点击 "开始采集"</td>
  </tr>
</table><br>
<script language="javascript">
var classrootid = <?=$proot?> ;
function asCallJsLoadUrl()
{
	if( $("#rule").val()=="" )
	{
		alert("请选择采集规则");
		return false;
	}
	 
	if( $("#classid").val()=="" || $("#classid").val()==classrootid )
	{
		alert("请选择分类");
		return false;
	}
	var urllist= $.trim($('#categoryurl').val());
	if(urllist=="")
	{
		alert("产品链接不能为空");
		return "";
	}
	//alert(urllist);
	arrurl=urllist.split('\n');
	return arrurl.join('|')+"@"+$("#classid").val()+"@"+$("#rule").val();
}
</script>
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>第二步：采集产品数据</strong><span class="fontpadding"><a target="_blank" href="http://ts.uio.cc/download/p_download_caiji.rar" class="red weight"><img src="images/shipin.gif" hspace="4" align="absmiddle"> 强烈建议下载3分钟的视频教程</a></span></td>
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
   <tr    bgcolor="#FFFFFF">
     <td valign="top">采集规则：</td>
     <td>
	 <select name="rule" id="rule">
	 <?
	 $dir="../inc/rule/product/";
	 $redir=opendir($dir);
	 while($folder=readdir($redir))
	 {
		 if($folder!="." && $folder!="..")
		 {
		 $rulename = str_replace(".php","",$folder);
	 ?>
       <option value="<?=$rulename?>"><?=$rulename?></option>
	  <?
	 	 }
	 }
	 ?></select></td>
   </tr>
   <tr    bgcolor="#FFFFFF">
     <td valign="top">采集链接：</td>
     <td>
	 
	 <textarea name="categoryurl" id="categoryurl"  style="width:700px; height:400px; font-size:11px"><?=implode("\n",$arrurl)?></textarea>	 </td>
   </tr>
   <tr    bgcolor="#FFFFFF">
     <td valign="top">&nbsp;</td>
     <td><div style="color:#FF0000">若批量上传模块不能正常工作!请更新 FLASH for IE版本 到 9  <a target="_blank" href="http://www.skycn.com/soft/5671.html">更新</a></div>
	<object  id="uploadsystem" name="uploadsystem" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="450" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">
	<param name="movie" value="collectionsystem.swf?rnd=<?=time()?>&server=<?=urlencode(CGIBIN)?>&<?=REMOTECOMMAND?>" />
			<param name="quality" value="high" />
			<param name='allowScriptAccess'  value='always' />
			<param name='allowNetworking' value='all' />
			<param name="bgcolor" value="#869ca7" />
			<param name="wmode" value="opaque">
			<embed   id="uploadsystem" name="uploadsystem" src="collectionsystem.swf?rnd=<?=time()?>&server=<?=urlencode(CGIBIN)?>&<?=REMOTECOMMAND?>" quality="high" bgcolor="#869ca7" width="700" height="450" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>
	</object></td>
   </tr>
</table>

</form>
<?
}
?>

<?
function step_edit()
{
global $cfg;
global $proot;
global $broot;
global $glo;
$config=$glo["config"];
$id=getQuerySQL("id");
$sql="select * from @@@product where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$classid = $rows["classid"];
?>
<form action="?action=step_edit_save&id=<?=$id?>" method="post" enctype="application/x-www-form-urlencoded" id="formadd" name="formadd"><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >1 采集的时间请选择在网络稳定良好的时候!避免出现中断的情况</td>
  </tr>
</table><br>
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>辅助：修复产品数据</strong></td>
    </tr>
  <tr   bgcolor="#FFFFFF">
    <td width="18%">产品名称：</td>
    <td width="82%"><?=$rows["name"]?></td>
  </tr>
   
   <tr    bgcolor="#FFFFFF">
     <td valign="top">采集规则：</td>
     <td>
	 <select name="rule" id="rule">
	 <?
	 $dir="../inc/rule/product/";
	 $redir=opendir($dir);
	 while($folder=readdir($redir))
	 {
		 if($folder!="." && $folder!="..")
		 {
		 $rulename = str_replace(".php","",$folder);
	 ?>
       <option value="<?=$rulename?>"><?=$rulename?></option>
	  <?
	 	 }
	 }
	 ?></select></td>
   </tr>
   <tr    bgcolor="#FFFFFF">
     <td valign="top">采集链接：</td>
     <td><input name="url" type="text" id="url" value="<?=$rows["remoteurl"]?>" size="90" /></td>
   </tr> <tr  class="add" bgcolor="#FFFFE9">
    <td>&nbsp;</td>
    <td><input type="submit"  class="button"  onClick="showtips(this)"  value="采集修复" /></td>
 </tr>
</table>

</form>
<?
}
?>

<?
function deletelogfile()
{
	$logfile = "log/". getQuery("logfile");
	if ( is_file( $logfile ) )
	{
		@unlink( $logfile ) ;
	}
	pageRedirect("修改成功",$_SERVER['HTTP_REFERER']);
}

function step_edit_save()
{
	echo "<table width=\"96%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\" align=\"center\" class=\"tbtitle\"><tr  bgcolor=\"#F2F4F6\"><td bgcolor=\"#ffffff\">";
	$id = getQueryInt("id");
	$rule = getForm("rule");
	$url = getForm("url");
	if( $rule=="" || !file_exists("../inc/rule/product/{$rule}.php") )
	{
		die("请选择规则");
	}
	
	require("../inc/rule/product/{$rule}.php");
	
	$html = getRemoteData($url);
	if( $html==false )
	{
		die("网络中断");
	}

	$condition="where id=$id";
	$param = array();
	$param["name"] = preg_p_name($html);
	$param["itemno"] = preg_p_itemno($html);
	$param["price1"] = preg_p_price1($html);
	$param["price2"] = preg_p_price2($html);
	$param["weight"] = preg_p_weight($html);
	$param["pic"] = GrabRemoteImage(preg_p_pic($html),"../uploadImage/");
	$param["content"] = preg_p_content($html);
	$sql=updateSQL($param,"@@@product",$condition);
	query($sql);
	echo "name:" . $param["name"] . "<br />";
	echo "itemno:" . $param["itemno"] . "<br />";
	echo "price1:" . $param["price1"] . "<br />";
	echo "price2:" . $param["price2"] . "<br />";
	echo "weight:" . $param["weight"] . "<br />";
	echo "Pic:" . $param["pic"] . "<br />";
	echo "Content:" . $param["content"] . "<br />";
	$condition="where pid =" . $id ;
	$rs=deleteRecord("@@@otherimage","$condition");
	$num=mysql_affected_rows();
	while($rows=fetch($rs))
	{
		deleteImage( $rows["pic"] , $cfg["deleteImage"] , "../otherimage/",IMAGE );
	}
	
	$arr_otherpic = preg_p_otherpic($html);
	echo "OtherPic:" . join(',',$arr_otherpic) . "<br />";
	for($index=0;$index<count($arr_otherpic);$index++)
	{
		$param = array();
		$param["pid"] = $pid;
		$param["pic"] = GrabRemoteImage($arr_otherpic[$index],"../otherImage/");
		$sql=insertSQL($param,"@@@otherimage");
		query($sql);
	}
	echo "影响到产品数目:$num";
	echo "</td></tr></table>";
	}
?>
<? require("php_bottom.php");?>
</body>
</html>
