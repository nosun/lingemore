<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>收藏统计</title>
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
	<div class="bodytitletxt">收藏统计</div>
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
    <td    ><a href="?">收藏统计</a> </td>
  </tr>
</table><br />
<?php
isAuthorize($group[4]);
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
		$title = date("Y",strtotime(getRequest("addtime"))) . "年份 的收藏夹" ;
	}
	else if(getRequest("timetype")=="d")
	{
		$timesql = "date(addtime)=date('" . getRequest("addtime") . "')";
		$title = getRequest("addtime")  . " 的搜索词" ;
	}
	else if(getRequest("timetype")=="q")
	{
		$timesql = "YEAR(addtime)=YEAR('" . getRequest("addtime") . "') and QUARTER(addtime)=QUARTER('" . getRequest("addtime") . "')";
		$title = date("Y",strtotime(getRequest("addtime"))) . "年" . $arrq[date("n",strtotime(getRequest("addtime")))-1] . " 的收藏夹" ; 
	}
	else if(getRequest("timetype")=="m")
	{
		$timesql = "YEAR(addtime)=YEAR('" . getRequest("addtime") . "') and MONTH(addtime)=MONTH('" . getRequest("addtime") . "')";
		$title = date("Y",strtotime(getRequest("addtime"))) . "年" . date("n",strtotime(getRequest("addtime"))) . "月 的收藏夹" ;
	}
	//mysql> SELECT QUARTER(’98-04-01’); 1-4

	$condition.=" and $timesql" ;
	$pageurl.="&addtime=" . getRequest("addtime") ;
}
else
{
	$title = "全部的收藏夹";
}
$pageurl.="&timetype=" . getRequest("timetype") ;
$condition.=" group by pid" ;
?>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="4" bgcolor="#F2F4F6"><strong>收藏统计</strong><span class="fontpadding">条件：<?=$title ?></span></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9"  >
   <td width="4%"   >序号</td>
   <td width="8%"  >收藏次数</td>
    <td width="13%" align="center"  >产品图片</td>
    <td width="71%" align="left"  >名称</td>
  </tr>



<?
$pagenow=getQueryInt("page");
$pagesize=20;

$rs=createGroupPage("count(pid) as c,pid,max(id) as id","@@@favorite",$condition," order by c desc",$pagesize,$pagenow,$pagetotal,$recordcount);
emptyList($rs,10);
while($rows=fetch($rs))
{
$rows["pname"] = fetchValue("select pname as v from @@@favorite where id=".$rows["id"],0);
$sql="select * from  @@@favorite where id=".$rows["id"] ;
$trs = query($sql);
if(!BOF($trs))
	$trows = fetch($trs);
else
	$trows = array();
$index++;
?>
  <tr align="center"  bgcolor="#FFFFFF">
   <td  class="a_fen"><?=$index?></td
   ><td  class="a_fen"><?=$rows["c"]?></td>
    <td align="center"   class="a_fen"><img src="<?=getImageURL($trows["ppic"],3,"uploadImage/",IMAGE)?>" border="0" ></td>
    <td align="left"   class="a_fen">产品名称：<strong><a href="../product-view.php?id=<?=$trows["pid"]?>" target="_blank"><?=$trows["pname"]?></a></strong><br>产品编号：<?=$trows["pitemno"]?>
<br></td>
    </tr>
<?
}
free($rs);
?>

  <tr bgcolor="#FFFFE9">
    <td colspan="4" align="right" ><? require("php_page.php")?></td>
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
