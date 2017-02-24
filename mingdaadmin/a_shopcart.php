<? require("php_admin_include.php");?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员管理</title>
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
	<div class="bodytitletxt">会员购物车</div>
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
    <td    ><a href="?">会员购物车</a></td>
  </tr>
</table><br />
<?php
$action=getQuery("action");
switch($action)
{
case "add":
	permadd($perm,15);
	addItem();
	break;
case "edit":
	editItem();
	break;
case "add_save":
	permadd($perm,15);
	add_save();
	break;
case "delete_save":
	permdel($perm,15);
	delete_save();
	break;
case "edit_save":
	permedit($perm,15);
	edit_save();
	break;
case "view_cart":
	view_cart();
	break;
case "emptycart":
	emptycart();
	break;
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
global $supper;
global $adminid;
?>
<form name="form2" method="post" action="?">
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>会员搜索</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    
      <td class="a_fen">会员名称：
        <input name="name" style="width:150px" value="<?=getRequest("name")?>" type="text" >
       
		<span class="fontpadding">
		登录状态：<select name="state" id="state">
	<option value="">请选择</option>
	<option value="0">禁止</option>
	<option value="1">启用</option>
    </select>
	<script>
	EnterSelect("state","<?=getRequest("state")?>")
	</script>
	</span>
	 <span class="fontpadding">更新日期：
	 <input name="lasttime" id="lasttime"  value="<?=getRequest("lasttime")?>"  onClick="javascript:ShowCalendar(this.id)"  type="text" style="width:152px"    />
		</span>
   <input type="submit" name="Submit32" value="提交"  class="button"  />      </tr>
 <?
   if($supper>5)
   {
 ?>
   <tr bgcolor="#FFFFFF">
 <td>
 业务员： <a href="?">全部</a>
 <?
 $sql="select * from `admin` where supper<=8";
 $rs=query($sql);
 while($rows=fetch($rs))
 {
 ?> <a href="?server=<?=$rows["id"]?>"><?=$rows["name"]?></a> 
 <?
 }
 ?>
 </td>
  </tr>
 <?
 }
 ?>
</table>  
</form><br>

<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="7" bgcolor="#F2F4F6"><strong>购物车管理列表</strong></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9"  >
   <td   >选择</td>
    <td align="left"  >会员名称</td>
  
    <td  >状态</td>
    <td  >登入次数</td>
    <td     >相关数据</td>
    <td     >最后登录</td>
     <td   >IP/地址</td>
  </tr>

<form name="formdel" method="post" action="?action=p_handl">
<?
//$struserid = fetchValueGroup("select userid as v from shopcart group by userid",0);
$condition="WHERE EXISTS (SELECT * FROM @@@shopcart WHERE @@@user.id = @@@shopcart.userid)";
$pageurl="1=1" ;
$arrstate=array("禁用","启用");
if(getRequest("name")!="")
{
	$condition .=  " and name  like '%" . getRequest("name") . "%'" ;
	$pageurl .= "&name=" . getRequest("name") ;
}

if($supper>5)
{
	if(getRequest("server")!="")
	{
		$condition .= " and server=" . getRequest("server") ;
		$pageurl .=  "&server=" . getRequest("server") ;
	}
}
else
{
	if(getRequestDefault("server",$adminid)!="")
	{
		$condition .= " and server=" . getRequestDefault("server",$adminid) ;
		$pageurl .=  "&server=" . getRequestDefault("server",$adminid) ;
	}
}
if(getRequest("state")!="")
{
	$condition .= " and state=" . getRequest("state") ;
	$pageurl .=  "&state=" . getRequest("state") ;
}

if(getRequest("lasttime")!="")
{
	$condition .= " and TO_DAYS(lasttime)=TO_DAYS('" . getRequest("lasttime") . "')";
	$pageurl .=  "&lasttime=" . getRequest("lasttime") ;
}


if(getRequest("level")!="")
{
	$condition .=   " and level=" . getRequest("level") ;
	$pageurl .= $pageurl . "&level=" . getRequest("level") ;
}
$pagenow=getQueryInt("page");
$pagesize=20;
$rs=createPage("*","@@@user",$condition," order by lasttime desc",$pagesize,$pagenow,$pagetotal,$recordcount);
emptyList($rs,10);
while($rows=fetch($rs))
{
?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
   <td  class="a_fen"><input name="cbid[]" type="checkbox"  value="<?=$rows["id"]?>"></td>
    <td align="left"   class="a_fen"><img src="http://open.35zh.com/cgi-bin/?do=iptocountry&type=3&ip=<?=$rows["ip"]?>" align="absmiddle" hspace="2"> <a href="a_user.php?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a></td>
   
    <td  class="a_fen"><span class="state<?=$rows["state"]?>"><?=$arrstate[$rows["state"]]?></span></td>
    <td  class="a_fen"><?=$rows["counts"]?></td>
    <td  class="a_fen"><a href="a_shopcart.php?action=view_cart&userid=<?=$rows["id"]?>">查看购物车</a>(<?=fetchValue("select sum(pnum) as v from `shopcart` where userid=" . $rows["id"] , 0 );?>)</td>
    <td  class="a_fen"><?=$rows["lasttime"]?></td>
    <td  class="a_fen"><?=$rows["ip"]?></td>
    </tr>
<?
}
free($rs);
?>
  <tr class="delete" bgcolor="#FFFFFF">
    <td colspan="7" class="a_fen">选择：<a  href="javascript:CheckAll('formdel','ON')">全选</a> 
      -
  <a  href="javascript:CheckAll('formdel','OFF')">取消</a>
  <span class="fontpadding">
  批量删除：
      <a href="javascript:submit_onClick('formdel','deletepage')">当前所选</a>
	  <span class="hide"> - <a href="javascript:submit_onClick('formdel','deleteall')" class="red" >搜索到的<?=$recordcount?>个结果</a></span></span>
	   <input id="do" name="do" type="hidden" value="editpage" />
      <input type="hidden" name="condition" id="condition" value="<?=$condition?>" /></td>
	</tr>
</form>
  <tr bgcolor="#FFFFE9">
    <td colspan="7" align="right" ><? require("php_page.php")?></td>
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

<?
function view_cart()
{
global $cfg;
global $config;
global $glo;
$coin=$glo["coin"];
$id=getQuerySQL("userid");

$sql="select * from @@@user where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$user=fetch($rs);
?>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="8" bgcolor="#F2F4F6"><strong>【<?=$user["name"]?>】 购物车商品</strong> <span class="fontpadding"><a href="?action=emptycart&userid=<?=$user["id"]?>">清空购物车</a></span></td>
  </tr>
  <tr align="center" bgcolor="#FFFFE9"  >
    <td>产品图片</td>
    <td bgcolor="#FFFFE9">产品样式</td>
    <td >产品编号</td>
    <td >产品重量</td>
    <td >产品单价</td>
    <td >订购数量</td>
    <td >重量小计</td>
    <td >价格小计</td>
  </tr>
 
  <?
  	$sql="select * from @@@shopcart where userid=$id";
	$ors=query($sql);
 	emptyList($ors,10);
	$totalprice=0;
	while($orows=fetch($ors))
  {
  $prs=query("select * from @@@product where id=" . $orows["pid"]);
  if(BOF($prs))
  	continue;
  $prows = fetch($prs);
  
  $orows["pstyle"] = str_replace("^","<br />",$orows["pstyle"]);
  $itemprice=$orows["pnum"]*$prows["price1"];
  $totalprice+=$itemprice;
   $itemweight=$orows["pnum"]*$prows["weight"];
  $totalweight+=$itemweight;
  ?>
<tr align="center" bgcolor="#FFFFFF" >
    <td align="center"><a href="../product-view.php?id=<?=$orows["pid"]?>" target="_blank"><img src="<?=getImageURL($prows["pic"],3,"uploadImage/",IMAGE)?>" border="0" ></a></td>
    <td align="left" width="300"  class="wrap"><a class="order" href="../product-view.php?id=<?=$prows["id"]?>" target="_blank"><?=$prows["name"]?></a><br><em><?=$orows["pstyle"]?></em>
<? if($orows["premark"]!="") { ?>	<br>
备注：<?=$orows["premark"]?>	<? } ?></td>
    <td align="center"><?=$prows["itemno"]?></td>
    <td align="center"><?=$prows["weight"]?></td>
    <td align="center"><?=$config[90]?> <?=$prows["price1"]?></td>
    <td align="center"><?=$orows["pnum"]?></td>
    <td align="center"><?=$itemweight?></td>
    <td align="center"><?=$config[90]?> <?=$itemprice?></td>
  </tr>
  <?
  
  }
  free($ors);
  ?>
  <tr align="center" bgcolor="#FFFFE9">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td class="red"><?=$totalnum?></td>
    <td class="red"><?=$totalweight?></td>
    <td class="red"><?=$config[90]?> <?=$totalprice?></td>
  </tr>
</table>
<?
}
?>

<?

function emptycart()
{
	$id = getQueryInt("userid",0);
	//debug($id);
	$sql="delete from @@@shopcart where userid<=0 or userid=" . $id;
	query($sql);
	pageRedirect(1,"a_shopcart.php");
}

?>
<?php require("php_bottom.php")?>
</body>
</html>
