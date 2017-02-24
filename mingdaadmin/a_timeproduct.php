<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>产品访问分析</title>
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
	<div class="bodytitletxt">产品访问分析</div>
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
    <td    ><a href="?">产品访问分析</a> </td>
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
    <td bgcolor="#F2F4F6" class="a_title"><strong>产品选择</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
      <td class="a_fen">
	   产品ID：
      <input name="pid" type="text" id="pid" value="<?=getRequest("pid")?>" style="width:150px"><span class="fontpadding">年份选择 ： 
		<select id="addtime" name="addtime">
		<option value="">请选择年份</option>
		<option value="2011-1-1">2011年</option>
		<option value="2012-1-1">2012年</option>
		<option value="2013-1-1">2013年</option>
		<option value="2014-1-1">2014年</option>
		<option value="2015-1-1">2015年</option>
		<option value="2016-1-1">2016年</option>
		</select>
		<script language="javascript">
		EnterSelect("addtime","<?=getRequest("addtime")?>")
		</script>
		
		</span>
		<span class="fontpadding"><input type="submit" name="Submit32" value="提交"  class="button"  /></span> </tr>
</table>  
</form>
<?
if( getRequest("pid")!="" )
{
$condition="where 1=1" ;
$pageurl="1=1" ;
$addtime = getRequestDefault("addtime",formatDate(time())) ;
$condition.= " and YEAR(addtime)=YEAR('" . $addtime . "')";
$condition.= " and pid='" . getRequest("pid") . "'";
$pageurl.="&addtime=" . $addtime ;
$title = "产品 " . fetchValue("select name as v from @@@product where id=".getRequest("pid"),"产品已删除") . " 1月-12月的访问的分布情况" ;
?><br>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="3" bgcolor="#F2F4F6"><strong>时间列表</strong><span class="fontpadding">条件：<?=$title ?></span></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9"  >
   <td width="4%"   >月份</td>
   <td width="8%"  >浏览次数</td>
    <td align="left"  >图形表示</td>
  
    
  </tr>

<?
$total = fetchValue("select count(*) as v from @@@productlog $condition",0);
if($total==0)
	$total=1;
$sql = "select month(addtime) as strmonth,count(*) as t from @@@productlog  $condition group by month(addtime) order by strmonth desc";
$rs = query($sql);
emptyList($rs,10);
while($rows=fetch($rs))
{
$index++;
$baifenbi = number_format($rows["t"]*100/$total,2,".",'') ;
?>
  <tr align="center"  bgcolor="#FFFFFF">
   <td  class="a_fen"><?=$rows["strmonth"]?>月</td> <td  class="a_fen"><?=$rows["t"]?></td>
    <td align="left"   class="a_fen"><div style="height:20px; background-color:#FC7001; color:#FFFFFF; padding-left:5px;padding-right:5px;  font-size:11px; width:<?=$baifenbi/100*450?>px"><?=$baifenbi?>%</div></td>
   
   
    </tr>
<?
}
free($rs);
?>
 
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
else
{
?><br>

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >请输入要生成进行细化分析的 产品的ID。例如： http://xxx.com/?nike-shoes-<span class="red">p520</span>.html 就输入 520</td>
  </tr>
</table>
<?
}
}
?>

<?php require("php_bottom.php")?>
</body>
</html>
