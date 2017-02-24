<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
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
	<div class="bodytitletxt">会员管理</div>
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
    <td    ><a href="?">会员列表</a></td>
  </tr>
</table><br />
<?php
isAuthorize($group[3]);
$action=getQuery("action");
switch($action)
{
case "add":
	addItem();
	break;
case "edit":
	editItem();
	break;
case "favorite":
	user_favorite();
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
global $config;
global $cfg;
global $supper;
global $adminid;
?>
<form name="form2" method="get" action="?">
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>会员搜索</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    
      <td class="a_fen">会员名称：
        <input name="name"  style="width:150px" value="<?=getRequest("name")?>" type="text" >
       <span class="fontpadding"> 开始日期：
        <input name="starttime" style="width:150px" id="starttime"  onclick="javascript:ShowCalendar(this.id)"  value="<?=getRequest("starttime")?>" type="text" ></span>
		<span class="fontpadding">结束日期： <input  style="width:150px"  onclick="javascript:ShowCalendar(this.id)"  id="endtime"  name="endtime" value="<?=getRequest("endtime")?>" type="text" >
		</span>
</td>
         </tr>
    <tr bgcolor="#FFFFFF">
      <td  class="a_fen">	
		登录状态：
		<select name="state" id="state" style="width:150px">
	<option value="">----请选择登录状态----</option>
	<option value="0">禁止</option>
	<option value="1">启用</option>
    </select>
	<script>
	EnterSelect("state","<?=getRequest("state")?>")
	</script>
	 <span class="fontpadding">会员等级：
	 <select name="level" id="level" style="width:150px">
	 <option value="">----请选择会员等级----</option>
	<?
	for($index=1;$index<=9;$index++)
	{
	if( $config[110+$index] != "" )
	{
	?>
	<option value="<?=$index?>"><?=$config[110+$index]?></option>
	<?
	}
	else
		break;
	}
	?>
	
    </select>
	<script>
		EnterSelect("level","<?=getRequest("level")?>")
	</script>
		</span>
   <span class="fontpadding">会员排序：
	 <select name="orderitem"  style="width:90px" id="orderitem">
	 <option value="">注册时间</option>
	<option value="lasttime">登录时间</option>
    </select>
	<script>
		EnterSelect("orderitem","<?=getRequest("orderitem")?>")
	</script>
	<select name="orderby"  style="width:56px" id="orderby">
	 <option value="">降序</option>
	<option value="asc">升序</option>
    </select>
	<script>
		EnterSelect("orderby","<?=getRequest("orderby")?>")
	</script>
		</span>
	 
      <span class="fontpadding"><input type="submit" name="Submit3" value="提交"  class="button" ></span>
	  </td>
	  </tr>
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
    <td colspan="10" bgcolor="#F2F4F6"><strong>会员列表</strong></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9"  >
   <td   >选择</td>
    <td align="left"  >IP/名称</td>
  
    <td  >状态</td>
    <td>业务员</td>
    <td  >真实消费/等级</td>
    <td  >登入次数</td>
    <td     >相关数据</td>
    <td     >注册时间</td>
     <td   >提交域名</td>
     <td >操作</td>
  </tr>

<form name="formdel" method="post" action="?action=p_handl">
<?
$condition="where 1=1" ;
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
if(getRequest("level")!="")
{
	$condition .=   " and level=" . getRequest("level") ;
	$pageurl .= $pageurl . "&level=" . getRequest("level") ;
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

if(getRequest("orderitem")!="")
{
	$pageurl .= "&orderitem=" . getRequest("orderitem") ;
}

if(getRequest("orderby")!="")
{
	$pageurl .= "&orderby=" . getRequest("orderby") ;
}

$pagenow=getQueryInt("page");
$pagesize=20;
$rs=createPage("*","@@@user",$condition," order by ".getRequestDefault("orderitem","id"). " " .getRequestDefault("orderby","desc") .",id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
emptyList($rs,10);
while($rows=fetch($rs))
{
	r2n($rows["jifen"]);
	$address = array();
	$sql="select * from @@@address where userid=" . $rows["id"];
    $ars=query($sql);
	while($arows=fetch($ars))
	{
		$address[] = split( $cfg["split"] , $arows["content"]); ;
	}
	?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
   <td  class="a_fen"><input name="cbid[]" type="checkbox"  value="<?=$rows["id"]?>"></td>
    <td align="left"   class="a_fen"><img src="http://open.35zh.com/cgi-bin/?do=iptocountry&type=3&ip=<?=$rows["ip"]?>" align="absmiddle" hspace="2"> <a id="user<?=$rows["id"]?>" class="jTip" name="<?=$rows["name"]?>" rev="密码：<?=$rows["realpwd"]?><br />姓名：<?=$rows["firstname"]?> <?=$rows["lastname"]?><br />国家：<?=$rows["country"]?>
    <? for($index=0;$index<count($address);$index++) { ?>
    <br /><span class=red>地址<?=$index+1?>：</span><br /><?=$address[$index][0]?> <?=$address[$index][8]?><br /><?=$address[$index][1]?><br /><?=$address[$index][2]?><br /><?=$address[$index][3]?> <?=$address[$index][4]?> <?=$address[$index][5]?><br />
<?=$address[$index][6]?> <?=$address[$index][7]?>
    <? 
	}
	?>" href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a></td>
   
    <td  class="a_fen"><span class="state<?=$rows["state"]?>"><?=$arrstate[$rows["state"]]?></span></td>
    <td  class="a_fen"><?=fetchValue("select name as v from `@@@admin` where id=" . $rows["server"],"已删除")?></td>
    <td  class="a_fen"><span class="red weight"><?=$config[90]?> <?=$rows["jifen"]?></span><br>
<?=$config[110+$rows["level"]]?></td>
    <td  class="a_fen"><?=$rows["counts"]?></td>
    <td  class="a_fen"><a href="a_order.php?userid=<?=$rows["id"]?>">查看订单</a>(<?=fetchValue("select count(*) as v from `@@@order` where userid=" . $rows["id"] , 0 );?>)<br>
<a href="a_message.php?userid=<?=$rows["id"]?>">查看留言</a>(<?=fetchValue("select count(*) as v from @@@message where userid=" . $rows["id"] , 0 );?>)<br>
<a href="a_shopcart.php?action=view_cart&userid=<?=$rows["id"]?>">查看购物车</a>(<?=fetchValue("select sum(pnum) as v from @@@shopcart where userid=" . $rows["id"] , 0 );?>)<br>
<a href="a_user.php?action=favorite&userid=<?=$rows["id"]?>">查看收藏</a>(<?=fetchValue("select count(*) as v from @@@favorite where userid=" . $rows["id"] , 0 );?>)
</td>
    <td  class="a_fen">注册：<?=$rows["addtime"]?><br>
登录：<?=$rows["lasttime"]?>
</td>
    <td  class="a_fen"><?=$rows["domain"]?></td>
    <td  class="a_fen"><a href="a_message.php?action=add&id=<?=$rows["id"]?>">发信息</a>  <a class="delete red" onClick="return confirm('确定要删除吗？')" href="?action=p_handl&do=deletepage&cbid[]=<?=$rows["id"]?>">删除</a> </td>
  </tr>
<?
}
free($rs);
?>
  <tr class="delete" bgcolor="#FFFFFF">
    <td colspan="10" class="a_fen">选择：<a  href="javascript:CheckAll('formdel','ON')">全选</a> 
      -
  <a  href="javascript:CheckAll('formdel','OFF')">取消</a>
  <span class="fontpadding">
  批量删除：
      <a href="javascript:submit_onClick('formdel','deletepage')">当前所选</a>
	  <span class="hide"> - <a href="javascript:submit_onClick('formdel','deleteall')" class="red" >搜索到的<?=$recordcount?>个结果</a></span></span><span class="fontpadding">
  导出数据：
      <a href="javascript:submit_export_onClick('formdel','exportpage')">当前所选</a>
	  <span> - <a href="javascript:submit_export_onClick('formdel','exportall')" class="red" >搜索到的<?=$recordcount?>个结果</a></span></span>
	   <input id="do" name="do" type="hidden" value="editpage" />
      <input type="hidden" name="condition" id="condition" value="<?=$condition?>" /></td>
	</tr>
</form>
  <tr bgcolor="#FFFFE9">
    <td colspan="10" align="right" ><? require("php_page.php")?></td>
  </tr>
</table>
<script>
function submit_export_onClick(formdel,strdo)
{
	document.getElementById("do").value=strdo;
	document.forms[formdel].submit();
}

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
function editItem()
{
global $cfg;
global $config;
$id=getQuerySQL("id");
$sql="select * from @@@user where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$content=split( $cfg["split"] , $rows["content"] );
array_pad($content,50,"");
?>
<form name="formdel" method="post" action="?action=edit_save&id=<?=$id?>">
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>修改注册信息</strong></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="19%">用户名</td>
    <td width="81%"><?=$rows["name"]?></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>业务员</td>
    <td><?=fetchValue("select name as v from `@@@admin` where id=" . $rows["server"],"已删除")?></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>总消费<span class="red"><?=$config[90]?></span></td>
    <td><input  size="40"  name="jifen" type="text" id="jifen"  value="<?=$rows["jifen"]?>" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>密码</td>
    <td><input size="40"  name="pwd" value="<?=$rows["realpwd"]?>" type="text" id="tbContent" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>密码问题</td>
    <td><input  size="40"  name="question" type="text" value="<?=$rows["question"]?>"   /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>密码回答</td>
    <td><input size="40"  name="answer" type="text" value="<?=$rows["answer"]?>"   /></td>
  </tr>
  
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>姓</td>
    <td><input  size="40"  name="firstname" type="text"  value="<?=$rows["firstname"]?>" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>名字</td>
    <td><input  size="40"  name="lastname" type="text"  value="<?=$rows["lastname"]?>" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>性别</td>
    <td><input name="sex"  type="radio" checked="checked" value="1" />
    男 
    <input type="radio" name="sex"  value="0" />
    女&nbsp;
    <script>
EnterRadio("sex","<?=$rows["sex"]?>");
</script></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>邮箱</td>
    <td><input  size="40"  name="email" type="text" id="email"  value="<?=$rows["email"]?>" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>MSN</td>
    <td><input  size="40"  name="msn" type="text" id="msn"  value="<?=$rows["msn"]?>" /></td>
  </tr>
  
  
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>邮编</td>
    <td><input  name="postcode" type="text" value="<?=$rows["postcode"]?>" /></td>
  </tr>
  
  
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>国家</td>
    <td>
	
	<?
	$country="country";
	require("../inc/php_inc_country.php");
	?>
	<script>
  EnterSelect("country","<?=$rows["country"]?>");
  </script></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>省份</td>
    <td><input  size="40" name="province" type="text" id="province" value="<?=$rows["province"]?>" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>城市</td>
    <td><input  size="40" name="city" type="text" id="city" value="<?=$rows["city"]?>" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>街道</td>
    <td><input size="40"  name="street" type="text" id="street" value="<?=$rows["street"]?>" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>上次登陆IP</td>
    <td><?=$rows["ip"]?>   &nbsp;&nbsp;&nbsp; <script src="http://open.35zh.com/cgi-bin/?do=iptocountry&ip=<?=$rows["ip"]?>&type=2"></script> <span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px"><a target="_blank" href="http://www.melissadata.com/lookups/iplocation.asp?ipaddress=<?=$rows["ip"]?>">查看更为详细的IP地址</a></span></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>状态</td>
    <td>
	<select name="state" id="state">
	<option value="0">禁止</option>
	<option value="1">启用</option>
    </select>
	 <script language="javascript">
		 EnterSelect("state",'<?=$rows["state"]?>')
		 </script>	</td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>等级</td>
    <td><select name="level" id="level">
	<?
	for($index=0;$index<=9;$index++)
	{
	if( $config[110+$index] != "" )
	{
	?>
	<option value="<?=$index?>"><?=$config[110+$index]?></option>
	<?
	}
	else
		break;
	}
	?>
	
    </select>
    <script language="javascript">
		 EnterSelect("level",'<?=$rows["level"]?>')
		 </script>	</td>
  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>登陆次数</td>
    <td><?=$rows["counts"]?></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>最后登录</td>
    <td><?=$rows["lasttime"]?></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>注册时间</td>
    <td><?=$rows["addtime"]?></td>
  </tr>
</table>
<br />

<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>其他信息</strong></td>
  </tr>
  
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="19%">Skype</td>
    <td width="81%"><input size="40"  type="text" name="content0" value="<?=$content[0]?>" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>手机</td>
    <td><input size="40"  type="text" name="content1" value="<?=$content[1]?>" /></td>
  </tr>
  
   <tr class="edit"   bgcolor="#FFFFE9">
    <td>&nbsp;</td>
    <td><input type="submit"  onClick="showtips(this)" name="Submit4" value="提交"  class="button"  /></td>
  </tr>
</table>
<br />

<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">

  <tr>
    <td colspan="8" bgcolor="#F2F4F6"><strong>收货地址</strong></td>
  </tr>
 
  <tr align="center"  bgcolor="#FFFFE9" >
    <td width="8%">名字</td>
    <td width="24%">地址</td>
    <td width="7%">邮编</td>
    <td width="9%">城市</td>
    <td width="10%">省份</td>
    <td width="13%">国家</td>
    <td width="12%">电话</td>
    <td width="17%">邮箱</td>
  </tr>
  <?
  free($rs);
  $sql="select * from @@@address where userid=$id";
  $rs=query($sql);
  emptyList($rs,8);
	while($rows=fetch($rs))
	{
	$address=split( $cfg["split"] , $rows["content"]);
	array_pad($address,20,"");
  ?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
  
    <td  >名:<?=$address[0]?>  <br>
      姓:<?=$address[8]?></td>
    <td  ><?=$address[1]?></td>
    <td  ><?=$address[2]?></td>
    <td  ><?=$address[3]?></td>
    <td  ><?=$address[4]?></td>
    <td  ><?=$address[5]?></td>
	<td><?=$address[6]?></td>
	<td><?=$address[7]?></td>
  </tr> 
 <?
 }
 ?>
</table>
</form>
<?

}
?>


<?
function user_favorite()
{
global $config;
global $cfg;
$userid = getQueryInt("userid",0);
$sql="select * from @@@user where id=$userid";
$rs=query($sql);
isItemNotExist($rs);
$user=fetch($rs);
?><table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="3" bgcolor="#F2F4F6"><strong>会员: <span class="red"><?=$user["name"]?></span> 收藏的商品</strong></td>
  </tr>
  <tr align="center" bgcolor="#FFFFE9"  >
    <td width="119">产品图片</td>
    <td align="left" bgcolor="#FFFFE9">产品名称</td>
    <td align="center" bgcolor="#FFFFE9">添加时间</td>
  </tr>
 
  <?
  	$condition="where userid=$userid";
	$pageurl="action=favorite&userid=$userid" ;
	$pagenow=getQueryInt("page");
	$pagesize=20;
	$rs=createPage("*","@@@favorite",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
	emptyList($rs,10);
	while($orows=fetch($rs))
  {

  ?>
  <tr align="center" bgcolor="#FFFFFF" >
    <td align="center"><img src="<?=getImageURL($orows["ppic"],3,"uploadImage/",IMAGE)?>" border="0" ></td>
    <td align="left" width="734"  class="wrap">名称：<a target="_blank" href="../product-view.php?id=<?=$orows["pid"]?>"><?=$orows["pname"]?></a><br>编号：<?=$orows["pitemno"]?>
</td>
    <td align="center" width="169"  class="wrap"><?=$orows["addtime"]?></td>
  </tr>
  <?
  
  }
  free($ors);
  ?>
  <tr bgcolor="#FFFFE9">
    <td colspan="9" align="right" ><? require("php_page.php")?></td>
  </tr>
</table>
<?

}
?>

<?
function addItem()
{
global $config;
global $cfg;
?>
<form name="formadd" method="post" action="?action=add_save">
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>添加注册信息</strong></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="19%">用户名</td>
    <td width="81%"><input size="40"  type="text" name="name" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>密码</td>
    <td><input   size="40"   name="pwd" type="text" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>密码问题</td>
    <td><input size="40"   name="question" type="text"    /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>密码回答</td>
    <td><input  size="40" name="answer" type="text"  /></td>
  </tr>
    <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>姓</td>
    <td><input  size="40"  name="firstname" type="text"   /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>名字</td>
    <td><input  size="40"  name="lastname" type="text"   /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>性别</td>
    <td><input name="sex"  type="radio" checked="checked" value="1" />
    男 
    <input type="radio" name="sex"  value="0" />
    女&nbsp; </td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>邮箱</td>
    <td><input size="40"   name="email" type="text" id="email"  /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>MSN</td>
    <td><input size="40"   name="msn" type="text" id="msn"   /></td>
  </tr>
  
  
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>邮编</td>
    <td><input  name="postcode" type="text" id="postcode"   /></td>
  </tr>
  
  
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>国家</td>
    <td><?
	$country="country";
	require("../inc/php_inc_country.php");
	?></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>省份</td>
    <td><input  size="40" name="province" type="text" id="province"   /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>城市</td>
    <td><input size="40"  name="city" type="text" id="city"  /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>街道</td>
    <td><input  size="40" name="street" type="text" id="street"  /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>状态</td>
    <td>
	<select name="state">
	<option value="0">禁止</option>
	<option value="1">启用</option>
    </select>
 	  </td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>等级</td>
    <td><select name="level" id="level">
	<?
	for($index=1;$index<=9;$index++)
	{
	if( $config[110+$index] != "" )
	{
	?>
	<option value="<?=$index?>"><?=$config[110+$index]?></option>
	<?
	}
	else
		break;
	}
	?>
	
    </select>
   	  </td>
  </tr>
 
 
</table>
<br />
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6">其他信息</td>
  </tr>
  
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td width="19%">Skype</td>
    <td width="81%"><input  size="40" type="text" name="content0"   /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>手机</td>
    <td><input size="40"  type="text" name="content1"  /></td>
  </tr>
   <tr  class="add"   bgcolor="#FFFFE9">
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit4"  onClick="showtips(this)" value="提交" /></td>
  </tr>

</table>
</form>
<?
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
$num=fetchCount("@@@user",$condition);
?>
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >
    总共选择了 <span class="red" style="font-size:24px; font-weight:bold;"><?=$num?>
    </span> 
    个会员！</td>
  </tr>
</table><br>

  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
<form name="formadd" method="post"  action="a_data_export.php?action=do&type=user_txt">  <tr>
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
</table><br>
<form name="formadd" method="post"  action="a_data_export.php?action=do&type=user_excel">
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6">导出 Excel 格式(导出全部个人信息)</td>
  </tr>
  <tr  class="add"   bgcolor="#FFFFE9">
    <td width="19%">&nbsp;</td>
    <td><input type="submit" name="Submit4" class="button"   value="下载Excel" /><input type="hidden" name="condition" value="<?=$condition?>" /></td>
  </tr>

</table>
</form>
<?
}
?>


<?
function delete_save()
{
	$id=getQuerySQL("id");
	$sql="delete from @@@user where id=$id";
	query($sql);
	pageRedirect("删除成功","a_user.php");
}

function add_save()
{
	global $cfg;
	$name=getForm("name");
	$sql="select * from @@@user where name='$name'";
	$rs=query($sql);
	isItemExist($rs);
	free($rs);
	$param["name"]=getForm("name");
	if(getForm("pwd")!="")
		$param["pwd"]=md5(md5(getForm("pwd")));
	$param["state"]=getFormInt("state",1);
	$param["question"]=getForm("question");
	$param["sex"]=getFormInt("sex",1);
	$param["answer"]=getForm("answer");
	$param["firstname"]=getForm("firstname");
	$param["lastname"]=getForm("lastname");
	$param["email"]=getForm("email");
	$param["msn"]=getForm("msn");
	$param["postcode"]=getForm("postcode");
	$param["country"]=getForm("country");
	$param["province"]=getForm("province");
	$param["city"]=getForm("city");
	$param["street"]=getForm("street");
	$param["level"]=getFormInt("level",1);
	$param["ip"]=getIP();
	$param["addtime"]=formatDateTime(time());
	$content=array();
	for($indexI=0;$indexI<=49;$indexI++)
	{
		$content[$indexI]= getForm("content$indexI") ;
	}
	array_pad($content,50,"");
	$param["content"]=join( $cfg["split"] , $content ) ;
	$sql=insertSQL($param,"@@@user");
	query($sql);
	pageRedirect("添加成功","a_user.php");
}

function edit_save()
{
	global $adminname;
	global $cfg;
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["state"]=getFormInt("state",1);
	$param["sex"]=getFormInt("sex",1);
	$param["jifen"]=getFormInt("jifen",0,false);
	$param["question"]=getForm("question");
	$param["answer"]=getForm("answer");
	$param["pwd"]=md5(md5(getForm("pwd")));
	$param["realpwd"]=getForm("pwd");
	$param["firstname"]=getForm("firstname");
	$param["lastname"]=getForm("lastname");
	$param["email"]=getForm("email");
	$param["msn"]=getForm("msn");
	$param["postcode"]=getForm("postcode");
	$param["country"]=getForm("country");
	$param["province"]=getForm("province");
	$param["city"]=getForm("city");
	$param["street"]=getForm("street");
	$param["level"]=getFormInt("level",1);
	$content=array();
	for($indexI=0;$indexI<=49;$indexI++)
	{
		$content[$indexI]= getForm("content$indexI") ;
	}
	array_pad($content,50,"");
	$param["content"]=join( $cfg["split"] , $content ) ;
	$sql=updateSQL($param,"@@@user",$condition);
	query($sql);
	//debug($sql);
	pageRedirect("修改成功","a_user.php?id=$id&action=edit");
}

function p_delete_save($flag)
{
	if( $flag==0 )
	{
		$id=getRequestStr("cbid",0,0);
		$condition="where id in ($id)";
	}
	else
	{
		$condition=getForm("condition");
	}
	$rs=deleteRecord("@@@user","$condition");
	while( $rows=fetch($rs) )
	{
		$condition="where userid=" . $rows["id"];
		deleteRecord("@@@address","$condition");
		$condition="where userid=" . $rows["id"];
		deleteRecord("@@@favorite","$condition");
	}
	pageRedirect("2","a_user.php");
}
?>
<?php require("php_bottom.php")?>
</body>
</html>
