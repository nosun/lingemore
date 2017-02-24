<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>邮件订阅</title>
</head>

<body>
<?php require("php_top.php")?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">邮件订阅</div>
</div>
</td></tr></table>
<br />
<script>
function CheckAll(formdel,str)
{
  for (var i=0;i<document.forms[formdel].elements.length;i++)
  {
    var e = document.forms[formdel].elements[i];
    if (str=="ON")
	   e.checked = true;
	else
		e.checked= false; 
  }
}
function asCallJsGetEmailList(id)
{
	return document.getElementById(id).value;
}
function asCallJsSetFailEmail(address)
{
	document.getElementById("failaddress").value=address;
	document.getElementById("failaddress").focus();
}
</script>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td><a href="?">邮件订阅</a></td>
  </tr>
</table><br />
<?php
isAuthorize($group[3]);
$action=getQuery("action");
switch($action)
{
case "p_handl":
	if( getRequest("do")=="deletepage" )
	{
		p_delete_save(0);
	}
	elseif ( getRequest("do")=="deleteall" )
	{
		p_delete_save(1);
	}
	elseif ( getRequest("do")=="exportpage" )
	{
		export_user_data(0);
	}
	elseif ( getRequest("do")=="exportall" )
	{
		export_user_data(1);
	}
	else
		showItem();
	break;
default:
	showItem();
	break;
}
?>

<?
function showItem()
{
?>
<script language="javascript" type="text/javascript"   charset='gb2312' src="JSFile/DateJs.js"></script>
<form name="form2" method="post" action="?">
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>邮件订阅</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    
      <td class="a_fen">邮件地址：
        <input name="name" style="width:150px" size="20" value="<?=getRequest("name")?>" type="text" id="tbName">
      <span class="fontpadding"> 开始日期：
        <input name="starttime" style="width:150px" id="starttime"  onclick="javascript:ShowCalendar(this.id)"  value="<?=getRequest("starttime")?>" type="text" ></span>
		<span class="fontpadding">结束日期： <input  style="width:150px"  onclick="javascript:ShowCalendar(this.id)"  id="endtime"  name="endtime" value="<?=getRequest("endtime")?>" type="text" >
		</span>
		
    <input type="submit" name="Submit32" value="提交"  class="button"  />      </tr>
</table>  
</form>
<br />
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="5"  bgcolor="#F2F4F6"><strong>邮件列表</strong></td>
  </tr>

  <tr align="center" bgcolor="#FFFFE9">
   <td width="4%" align="center">选择</td>
    <td  align="left">IP/邮箱地址</td>
    <td width="8%" align="center"  >添加时间</td>
    <td width="15%" align="center"  >提交域名</td>
    <td width="6%" align="center"  >操作</td>
  </tr>
    <form name="formdel" enctype="application/x-www-form-urlencoded" method="post" action="?action=p_handl">

  <?
$condition="where 1=1";
$pageurl="1=1";
if(getRequest("name")!="")
{
	$condition .= " and name  like '%" . getRequest("name") . "%'";
	$pageurl .= "name=" . getRequest("name");
}

if(getRequest("starttime")!="")
{
	$condition .= " and TO_DAYS(addtime)>=TO_DAYS('" . getRequest("starttime") . "')" ;
	$pageurl .=  "&starttime=" . getRequest("starttime") ;
}

if(getRequest("endtime")!="")
{
	$condition .= " and TO_DAYS(addtime)<=TO_DAYS('" . getRequest("endtime") . "')" ;
	$pageurl .=  "&endtime=" . getRequest("endtime") ;
}

$pagenow=getQueryInt("page");
$pagesize=20;
$rs=createPage("*","@@@newsletter",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
emptyList($rs,6);
while($rows=fetch($rs))
{
 ?>
    
    <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
	 <td align="center"  class="a_fen">
      <input name="cbid[]" type="checkbox"   value="<?=$rows["id"]?>"></td>
      <td align="left"><img src="http://open.35zh.com/cgi-bin/?do=iptocountry&type=3&ip=<?=$rows["ip"]?>" align="absmiddle" hspace="2"> <?=$rows["name"]?></td>
      <td align="center"><?= formatDate(strtotime($rows["addtime"]))?></td>
      <td align="center"><?=$rows["domain"]?></td>
      <td align="center"><a class="delete" onClick="return confirm('确定要删除吗？')"  href="?action=p_handl&do=deletepage&cbid[]=<?=$rows["id"]?>">删除</a> </td>
  </tr>
 <?
 }
 ?>

  <tr class="delete" bgcolor="#FFFFFF">
    <td colspan="7" class="a_fen">选择：<a  href="javascript:CheckAll('formdel','ON')">全选</a> 
      -
  <a  href="javascript:CheckAll('formdel','OFF')">取消</a>
  <span class="fontpadding">
  批量删除：
      <a href="javascript:submit_onClick('formdel','deletepage')" class="red" >当前所选</a> - 
	  <a href="javascript:submit_onClick('formdel','deleteall')" class="red" >搜索到的<?=$recordcount?>个结果</a>	  </span><span class="fontpadding">
  导出数据：
      <a href="javascript:submit_export_onClick('formdel','exportpage')">当前所选</a>
	  <span> - <a href="javascript:submit_export_onClick('formdel','exportall')" class="red" >搜索到的<?=$recordcount?>个结果</a></span></span>
	   <input id="do" name="do" type="hidden" value="editpage" />
      <input type="hidden" name="condition" id="condition" value="<?=$condition?>" /></td>
	</tr>
    </form>
    
  <tr bgcolor="#FFFFE9">
    <td colspan="6" align="right" ><? require("php_page.php")?></td>
  </tr>
</table>
<script>
function submit_onClick(formdel,strdo)
{
	document.getElementById("do").value=strdo;
	if(confirm("确定执行该操作吗?"))
	{
		document.forms[formdel].submit();
	}
}

function submit_export_onClick(formdel,strdo)
{
	document.getElementById("do").value=strdo;
	document.forms[formdel].submit();
}

</script>
<?
mysql_free_result($rs);
}
?>
<?
function export_user_data($type)
{
global $cfg;
global $glo;
$config=$glo["config"];
if( $type==0 )
{
	$id=getRequestStr("cbid",0,0);
	$condition="where id in ($id)";
}
else
{
	$condition=$_POST["condition"];
}
$num=fetchCount("@@@newsletter",$condition);
?>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >
    总共选择了 <span class="red" style="font-size:24px; font-weight:bold;"><?=$num?>
    </span> 
    个邮件订阅！</td>
  </tr>
</table><br>

  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
<form name="formadd" method="post"  action="a_data_export.php?action=do&type=newsletter">  <tr>
    <td colspan="2" bgcolor="#F2F4F6">导出 TxT 格式(中恒电子商务二次营销导入格式)</td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="19%">分隔符</td>
    <td><select name="split" >
    <option selected value="0">换行符号</option>
    <option value="1">竖线 '|'</option>
    <option value="2">分好 ';'</option>
    <option value="3">逗号 ','</option>
    </select><input type="hidden" name="condition" value="<?=$condition?>" /></td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="19%"></td>
    <td>导出后，我要做些什么？ 了解更多的 <a href="http://www.usavps.cn/tuiguang.asp" target="_blank">关于邮件营销&gt;&gt;</a></td>
  </tr>
   <tr  class="add"   bgcolor="#FFFFE9">
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit4" class="button"   value="下载Txt" /></td>
  </tr>
</form>
</table><br><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td ><strong class="red">电子商务二次营销</strong>是一种用来减少购物车废弃率的营销技术。 <br>
    我们使用传统的营销手段把访客吸引到我们的网站，如果他最终没有购买，我们就使用二次营销的战略把访客重新带回到我们网站并且把他转化成付费的消费者。<br>
    当一个访客放弃购物车时会留下一些信息，至少会留下注册时填写的的e-mail地址，我们就可以利用这些资料来跟踪访客，主要是为我们的二次营销做准备。这种类型的交互就叫做转化营销或者是电子商务二次营销。</td>
  </tr>
</table>
<?
}
?>



<?
function addItem()
{
?>
<form name="formadd" action="?action=add_save" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加邮件</strong></td>
  </tr>
  <?
  for($index=0;$index<=9;$index++)
  {
  ?>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="16%" align="left"><?=$index+1?> . 名称：</td>
    <td width="84%" >
      <input name="name<?=$index?>" type="text" size="40" />  </td>
  </tr>
  <?
  }
  ?>
    <tr class="add" bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input type="submit" name="button" id="button" value="提交"  class="button"  /></td>
  </tr>
</table>
</form>
<?
}
?>

<?
function p_delete_save($flag)
{
	if( $flag==0 )
	{
		$id=getRequestStr("cbid",0);
		$condition="where id in ($id)";
	}
	else
	{
		$condition=getForm("condition");
	}
	//debug($condition);
	$rs=deleteRecord("@@@newsletter","$condition");
	pageRedirect("2","a_newsletter.php");
}
?>
</body>
</html>
