<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>优惠券管理</title>
</head><script language="javascript" type="text/javascript"   charset='gb2312' src="JSFile/DateJs.js"></script>
<body>
<?php require("php_top.php");
isAuthorize($group[2]);
?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">优惠券管理</div>
</div>
</td></tr></table>
<br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle">
  <tr  bgcolor="#F2F4F6">
    <td  ><a href="a_coupon.php">优惠券管理</a><span class="fontpadding"><a href="a_coupon.php?action=add">添加优惠券</a></span><span class="fontpadding"><a href="a_coupon.php?action=p_add">批量添加</a></span></td>
  </tr>
</table><br>
<script type="text/javascript">
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
<?php
$action=getQuery("action");
switch($action)
{
case "delete_save":
	delete_save();
	break;
case "add":
	addItem();
	break;
case "add_save":
	add_save();
	break;
case "edit_save":
	edit_save();
	break;
case "p_add":
	p_addItem();
	break;
case "p_add_save":
	p_add_save();
case "p_edit":
	p_edit();
	break;
case "p_edit_save":
	p_edit_save();
	break;
case "edit":
	editItem();
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
global $config;
global $glo;
?><table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>优惠券搜索</strong></td>
  </tr><form name="form2" method="get" action="?">
  <tr bgcolor="#FFFFFF">
    
      <td width="50%" class="a_fen">优惠券码：
        <input name="name"  style="width:150px"  value="<?=getRequest("name")?>" type="text" id="name">
		<span class="fontpadding">用户搜索： <input name="username"  style="width:150px"  value="<?=getRequest("username")?>" type="text" id="username"></span>
		<span class="fontpadding">状态搜索：

        <select style="width:142px" name="state" id="state">
		<option value="">所有状态 </option>
	<option value="0">未激活</option>
	<option value="1">正常</option>
	<option value="2">冻结</option>
	<option value="3">已使用</option>

        </select>
		<script language="javascript">
		EnterSelect("state","<?=getRequest("state")?>");
		</script>
		</span>
		
      </td></tr>
	  <tr bgcolor="#FFFFFF">
      <td width="50%" class="a_fen">
	  开始日期：
        <input name="starttime" style="width:150px" id="starttime"  onclick="javascript:ShowCalendar(this.id)"  value="<?=getRequest("starttime")?>" type="text" >
		<span class="fontpadding">结束日期： <input  style="width:150px"  onclick="javascript:ShowCalendar(this.id)"  id="endtime"  name="endtime" value="<?=getRequest("endtime")?>" type="text" >
		</span>
      <span class="fontpadding"><input type="submit" name="Submit3" value="提交"  class="button" ></span>
	  </td>
	  </tr>
    </form>
   
  
</table><br>

<form name="formdel" method="post" action="?action=p_edit">
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="8" bgcolor="#F2F4F6"><strong>优惠券</strong></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9" >
    <td width="3%" align="center" >ID</td>
    <td width="9%" align="left" >优惠券码</td>
    
    <td width="14%" align="center"   ><span class="a_fen">使用者</span></td>
    <td width="10%"   >节省（<?=$config[90]?>）</td>
    <td width="7%"   >状态</td>
    <td width="14%" align="center"   >使用期限</td>
    <td width="35%" align="left"   >描述</td>
    <td width="8%"   >操作</td> 
  </tr>
  <?
  $arrstate = array("未激活","正常","冻结","已使用");
  global $glo;
  $condition="where 1=1" ;
$pageurl="1=1" ;

if(getRequest("name")!="")
{
	$condition .=  " and name  like '%" . getRequest("name") . "%'" ;
	$pageurl .= "&name=" . getRequest("name") ;
}

if(getRequest("username")!="")
{
	$condition .=  " and username  like '%" . getRequest("username") . "%'" ;
	$pageurl .= "&username=" . getRequest("username") ;
}

if(getRequest("state")!="")
{
	$condition .= " and state=" . getRequest("state") ;
	$pageurl .=  "&state=" . getRequest("state") ;
}

if(getRequest("starttime")!="")
{
	$condition .= " and TO_DAYS(endtime)>=TO_DAYS('" . getRequest("starttime") . "')" ;
	$pageurl .=  "&starttime=" . getRequest("starttime") ;
}

if(getRequest("endtime")!="")
{
	$condition .= " and TO_DAYS(endtime)<=TO_DAYS('" . getRequest("endtime") . "')" ;
	$pageurl .=  "&endtime=" . getRequest("endtime") ;
}

  $orderby=" order by id desc";
	$pagenow=getQueryInt("page");
	$pageurl="1=1";
	$pagesize=20;
	$rs=createPage("*","@@@coupon",$condition,$orderby,$pagesize,$pagenow,$pagetotal,$recordcount);
  emptyList($rs,4);
  while($rows=fetch($rs))
  {
	  if($rows["endtime"])
	  $strtime = formatDate(strtotime($rows["endtime"]));
	  else
	  	$strtime = "";
  //$times = (strtotime($rows["lasttime"])-strtotime($rows["addtime"]))/60 ;
  ?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td   align="center" class="a_fen"><input name="cbid[]" type="checkbox" id="id" value="<?=$rows["id"]?>"></td>
    <td   align="left" class="a_fen"><?=$rows["name"]?></td>
    
    <td align="center"   class="a_fen"><?=$rows["username"]?></td>
    <td   class="a_fen"><?=$rows["price"]?></td>
    <td   class="a_fen"><?=$arrstate[$rows["state"]]?></td>
    <td align="center"   class="a_fen"><?=$strtime?></td>
   
    <td align="left"   class="a_fen"><?=$rows["descript"]?></td>
    <td   class="a_fen"><? if($rows["state"]<=1) { ?><a href="?action=edit&name=<?=$rows["name"]?>">编辑</a> <? } ?> <a onClick="return confirm('确定是否删除？')" class="red" href="?action=delete_save&id=<?=$rows["id"]?>">删除</a></td> 
  </tr>
 <?
 }
 free($rs);
 ?> <tr bgcolor="#FFFFFF">
    <td colspan="10" class="a_fen">选择：<a  href="javascript:CheckAll('formdel','ON')">全选</a> 
      -
  <a href="javascript:CheckAll('formdel','OFF')">取消</a>
	   
	    <span class="fontpadding edit">
  批量编辑：
      <a href="javascript:submit_onClick('formdel','editpage')" >当前所选</a> 
	  </span>
      <input id="do" name="do" type="hidden" value="editpage" />
      <input type="hidden" name="condition" id="condition" value="<?=$condition?>" /></td>
	</tr>
   <tr bgcolor="#FFFFE9">
     <td colspan="8" align="right" ><? require("php_page.php")?></td>
   </tr>
</table><script>
function submit_onClick(formdel,strdo)
{
	if(strdo=="editpage"||strdo=="deletepage")
	{
		var inps=document.getElementsByName("cbid[]");
		var count=0;
		for(var i=0; i<inps.length;i++)
		{
			if(inps[i].checked==true)
			count++;
		}
		if(count<=0)
		{
			alert("请至少选择一项");
			return;
		}
	}
	document.getElementById("do").value=strdo;
	if(confirm("确定执行该操作吗?"))
	{
		document.forms[formdel].submit();
	}
}
</script>
</form>
<?
}
?>


<?
function editItem()
{
global $glo;
global $cfg;
global $config;
$name=getQuery("name");
$sql="select * from @@@coupon where name='$name'";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$id = $rows["id"] ;
 if($rows["endtime"])
	  $strtime = formatDate(strtotime($rows["endtime"]));
	  else
	  	$strtime = "";
?>
<form action="?action=edit_save&id=<?=$id?>" name="formedit" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>修改优惠券</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">优惠券码：</td>
    <td width="84%" >
<?=$rows["name"]?>  </tr> 
  
   <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
     <td align="left">优惠价格：</td>
     <td ><?=$config[90]?>  <input  name="price" type="text"  value="<?=$rows["price"]?>" size="8" maxlength="8" /></td>
   </tr>
   <tr   bgcolor="#FFFFFF">
    <td width="16%" align="left">可使用者：</td>
    <td width="84%" ><?=$rows["username"]?></td>
  </tr>
   <tr   bgcolor="#FFFFFF">
     <td align="left">使用状态：</td>
     <td ><select id="state" name="state">
       <option value="0">未激活</option>
     <option value="1">正常</option>
     <option value="2">冻结</option>
     <option value="3">已使用</option>
     </select><script language="javascript">
	 EnterSelect("state","<?=$rows["state"]?>");
	 </script></td>
   </tr>
   <tr   bgcolor="#FFFFFF">
    <td width="16%" align="left">附加描述：</td>
    <td width="84%" ><textarea name="descript"  style="width:700px; height:70px" id="descript"><?=$rows["descript"]?></textarea></td>
  </tr>
   <tr   bgcolor="#FFFFFF">
     <td width="16%" align="left">有效期限：</td>
     <td width="84%" ><input  style="width:150px"  onclick="javascript:ShowCalendar(this.id)"  id="endtime"  name="endtime" value="<?=$strtime?>" type="text" ></td>
   </tr>
  <tr class="edit"  bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input name="button2"  onClick="showtips(this)" class="button"  type="submit" value="修改" />    </td>
  </tr>
</table>
</form>
<?
}
?>

<?
function addItem()
{
global $glo;
global $cfg;
global $config;
?>
<form action="?action=add_save" name="formeadd" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加优惠券</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td width="16%" align="left">优惠券码：</td>
    <td width="84%" >
      <input type="text" style="width:180px" name="name" value="<?=getOnlyCode()?>" id="name"></td>
  </tr> 
  
   <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
     <td align="left">优惠价格：</td>
     <td ><?=$config[90]?>  <input  name="price" type="text"  value="5" size="8" maxlength="8" /></td>
   </tr>
   <tr   bgcolor="#FFFFFF">
    <td width="16%" align="left">可使用者：</td>
    <td width="84%" ><select id="userid" name="userid">
    <option value="-1">所有人(会员+游客)</option>
     <option value="0">会员</option>
     <?
     $sql = "select id,name from `@@@user` order by id desc";
	 $rs = query($sql);
	 while($rows=fetch($rs))
	 {
	 ?>
     <option value="<?=$rows["id"]?>"><?=$rows["name"]?></option>
     <?
	 }
	 ?>
    </select></td>
  </tr>
   <tr   bgcolor="#FFFFFF">
    <td width="16%" align="left">附加描述：</td>
    <td width="84%" ><textarea name="descript"  style="width:700px; height:70px" id="descript"></textarea></td>
  </tr>
   <tr   bgcolor="#FFFFFF">
     <td width="16%" align="left">有效期限：</td>
     <td width="84%" ><input  style="width:150px"  onclick="javascript:ShowCalendar(this.id)"  id="endtime"  name="endtime" value="" type="text" ></td>
   </tr>
  <tr class="edit"  bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input name="button2"  onClick="showtips(this)" class="button"  type="submit" value="修改" />    </td>
  </tr>
</table>
</form>
<?
}
?>
<?
function p_addItem()
{
global $glo;
global $cfg;
global $config;
?>
<form action="?action=p_add_save" name="formeadd" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>批量添加优惠券</strong></td>
  </tr>

 <tr  bgcolor="#FFFFFF">
     <td width="16%">批量类型</td>
     <td>
	 <script language="javascript">
	 function showTr(obj)
	 {
	 	if(obj.value==1)
		{
			$("#tr_type_1").removeClass("hide");
		}
		else if(obj.value==2)
		{
			$("#tr_type_1").addClass("hide");
		}
	 }
	 </script>
	 <select name="select" id="select" onChange="showTr(this)">
       <option selected value="1">输入生成的个数</option>
       <option value="2">所有会员分配一张</option>
     </select>   </td>
   </tr>
   <tr id="tr_type_1"    bgcolor="#FFFFFF">
     <td valign="top">&nbsp;</td>
     <td>使用范围：
       <select id="userid" name="userid">
         <option value="-1">所有人(会员+游客)</option>
         <option value="0">仅限会员</option>
        </select> 
       个数：
  <input type="text" name="number" id="number" value="20" style="width:80px"></td>
   </tr>
  </table><br>

  
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>统一类型</strong></td>
  </tr>
  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td align="left">优惠价格：</td>
    <td ><?=$config[90]?>  <input  name="price" type="text"  value="5" size="8" maxlength="8" /></td>
  </tr>
   <tr   bgcolor="#FFFFFF">
     <td width="16%" align="left">附加描述：</td>
     <td width="84%" ><textarea name="descript"  style="width:700px; height:70px" id="descript"></textarea></td>
   </tr>
   <tr   bgcolor="#FFFFFF">
     <td width="16%" align="left">有效期限：</td>
     <td width="84%" ><input  style="width:150px"  onclick="javascript:ShowCalendar(this.id)"  id="endtime"  name="endtime" value="" type="text" ></td>
   </tr>
  <tr class="edit"  bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input name="button2"  onClick="showtips(this)" class="button"  type="submit" value="修改" />    </td>
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
	$condition = "where  id ='$id'";
	deleteRecord("@@@coupon",$condition);
				
	$condition = "where tid = '$id'";
	deleteRecord("@@@ptag",$condition);
	pageRedirect("2","a_coupon.php");
}

function add_save()
{
	$name=getForm("name");
	$sql="select * from @@@coupon where name like '$name'";
	$rs=query($sql);
	isItemExist($rs);
	free($rs);
	
	$param=array();
	$param["name"]=getForm("name");
	$param["descript"]=getForm("descript");
	
	$param["endtime"] = getFormDefault("endtime","@NULL");
	$param["price"]=getFormInt("price",0,false,0);
	$param["state"] = 1;
	$param["userid"]=getFormInt("userid",-1);
	if($param["userid"]==0)
		$param["username"] = "所有会员";
	else if($param["userid"]==-1)
		$param["username"] = "所有人";
	else 
	{
		$param["username"] = fetchValue("select name as v from `@@@user` where id=".$param["userid"],"找不到会员");
	}
	$sql=insertSQL($param,"@@@coupon");
	query($sql);
	
	pageRedirect("2","a_coupon.php");
}

function p_add_save()
{
	$arr_num = array();
	if(getForm("select")==1)
	{
		for($index=1;$index<getFormInt("number",20);$index++)	
			$arr_num[] = getFormInt("userid",-1);
	}
	else
	{
		$sql = "select id from `@@@user`";
		$rs = query($sql);
		while($rows=fetch($rs))
		{
			$arr_num[] = $rows["id"] ;	
		}
	}
	for($index=0;$index<count($arr_num);$index++)
	{
		$param=array();
		$param["name"]=getOnlyCode();
		$param["descript"]=getForm("descript");
		
		$param["endtime"] = getFormDefault("endtime","@NULL");
		$param["price"]=getFormInt("price",0,false,0);
		$param["state"] = 1;
		$param["userid"]=$arr_num[$index];
		if($param["userid"]==0)
			$param["username"] = "所有会员";
		else if($param["userid"]==-1)
			$param["username"] = "所有人";
		else 
		{
			$param["username"] = fetchValue("select name as v from `@@@user` where id=".$param["userid"],"找不到会员");
		}
		$sql=insertSQL($param,"@@@coupon");
		query($sql);
	}
	
	pageRedirect("2","a_coupon.php");
}


function edit_save()
{
	$id=getQuerySQL("id");
	$condition = "where  id ='$id'";
	$param=array();
	$param["descript"]=getForm("descript");
	$param["endtime"] = getFormDefault("endtime","@NULL");
	$param["price"]=getFormInt("price",0,false,0);
	$param["state"] = getFormInt("state",0);
	$sql=updateSQL($param,"@@@coupon",$condition);
	query($sql);
	pageRedirect("修改成功",$_SERVER['HTTP_REFERER']);
}
?>

<?php require("php_bottom.php");?>
</body>
</html>
