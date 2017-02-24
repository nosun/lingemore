<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>产品关注度</title>
</head>

<body>
<?php require("php_top.php");?>
<style>
.state0{ color:#000000}
.state1{ color:#00CC00}
</style>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">产品关注度</div>
</div>
 </td>
 </tr>
</table>
<br />
<script language="javascript" type="text/javascript"   charset='gb2312' src="JSFile/DateJs.js"></script>
<script language="javascript">
 
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
</script>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">产品关注度</a> (该功能由前台客户查看产品时统计,<span class="red weight">登入管理员后不列入统计</span>)</td>
  </tr>
</table><br />
<?php
$action=getQuery("action");
isAuthorize($group[4]);
switch($action)
{
default:
	showItem();
	break;
}
?>

<?
function showItem()
{
global $config;
?>
<form name="form2" method="post" action="?">
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>时间选择</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
      <td class="a_fen">时间选择：
	<input name="addtime" value="<?=getRequest("addtime")?>"   onclick="javascript:ShowCalendar(this.id)"   type="text" id="addtime" style="width:153px;">
       <select name="timetype" id="timetype">
		 <option value="y">同年</option>
		 <option value="d">同日</option>
		 <option value="q">同一个季度</option>
		 <option value="m">同月</option>
        </select>
		<script>EnterSelect("timetype","<?=getRequest("timetype")?>")</script> 
		<span class="fontpadding"><input type="submit" name="Submit32" value="提交"  class="button"  /></span> </tr>
</table>  
</form><br>
<?
$condition="where 1=1" ;
$pageurl="1=1" ;
$arrq = array("春季","春季","春季","夏季","夏季","夏季","秋季","秋季","秋季","冬季","冬季","冬季") ;
if(getRequest("addtime"))
{
	
	if(getRequest("timetype")=="y")
	{
		$timesql = "YEAR(addtime)=YEAR('" . getRequest("addtime") . "')";
		$title = date("Y",strtotime(getRequest("addtime"))) . "年份 的产品访问记录" ;
	}
	else if(getRequest("timetype")=="d")
	{
		$timesql = "date(addtime)=date('" . getRequest("addtime") . "')";
		$title = getRequest("addtime")  . " 的产品访问记录" ;
	}
	else if(getRequest("timetype")=="q")
	{
		$timesql = "YEAR(addtime)=YEAR('" . getRequest("addtime") . "') and QUARTER(addtime)=QUARTER('" . getRequest("addtime") . "')";
		$title = date("Y",strtotime(getRequest("addtime"))) . "年" . $arrq[date("n",strtotime(getRequest("addtime")))-1] . " 的产品访问记录" ; 
	}
	else if(getRequest("timetype")=="m")
	{
		$timesql = "YEAR(addtime)=YEAR('" . getRequest("addtime") . "') and MONTH(addtime)=MONTH('" . getRequest("addtime") . "')";
		$title = date("Y",strtotime(getRequest("addtime"))) . "年" . date("n",strtotime(getRequest("addtime"))) . "月 的产品访问记录" ;
	}
	//mysql> SELECT QUARTER(’98-04-01’); 1-4

	$condition.=" and $timesql" ;
	$pageurl.="&addtime=" . getRequest("addtime") ;
}
else
	$title = "全部产品访问记录";

$pageurl.="&timetype=" . getRequest("timetype") ;


$condition.=" group by pid" ;
?>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="5" bgcolor="#F2F4F6"><strong>产品关注度</strong><span class="fontpadding">条件：<?=$title ?></span></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9"  >
   <td width="4%"   >序号</td>  <td width="8%"  >查看次数</td>
    <td align="center"  width="8%"   >时间报表</td>
    <td align="center"  width="12%"   >产品图片</td>
    <td align="left"  >产品名称</td>
  </tr>

<form name="formdel" method="post" action="?action=p_handl">
<?
$pagenow=getQueryInt("page");
$pagesize=20;

$rs=createGroupPage("count(name) as t,pid,max(name) as name","@@@productlog",$condition," order by t desc",$pagesize,$pagenow,$pagetotal,$recordcount);
emptyList($rs,10);
while($rows=fetch($rs))
{
$index++;
$rows["pic"] = fetchValue("select pic as v from @@@product where id = ".$rows["pid"],"");
?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
   <td  class="a_fen"><?=$index?></td>  <td  class="a_fen"><?=$rows["t"]?></td>
    <td align="center"   class="a_fen"><a href="a_timeproduct.php?pid=<?=($rows["pid"])?>">详细报表</a></td>
    <td align="center"   class="a_fen"><a  target="_blank" href="../product-view.php?id=<?=$rows["pid"]?>"><img src="<?=getImageURL($rows["pic"],3,"uploadImage/",IMAGE)?>" border="0"></a></td>
    <td align="left"   class="a_fen"><a target="_blank" href="../product-view.php?id=<?=$rows["pid"]?>"><?=$rows["name"]?></a></td>
    </tr>
<?
}
free($rs);
?>
</form>
  <tr bgcolor="#FFFFE9">
    <td colspan="5" align="right" ><? require("php_page.php")?></td>
  </tr>
</table>
<script>
function submit_onClick(formdel,strdo)
{
	document.getElementById("do").value=strdo;
	if(confirm("确定执行删除吗?"))
	{
		document.forms[formdel].submit();
	}
}
</script>
<?
}
?>

<?php require("php_bottom.php")?>
</body>
</html>
