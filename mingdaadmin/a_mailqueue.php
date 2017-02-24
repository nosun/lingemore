<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>邮件发送队列</title>
<style>
.state0{ color:#0F0}
.state1{ color:#FF0000}
.state2{ color:#000000}
.state3{ color:#F00}
.state4{ color:#666666}
</style>
</head>

<body>
<?php require("php_top.php");?>
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
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">邮件发送队列</div>
</div>
</td></tr></table>
<br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle">
  <tr  bgcolor="#F2F4F6">
    <td  ><a href="a_mailqueue.php">邮件发送队列</a></td>
  </tr>
</table><br />
<?php
isAuthorize($group[1]);
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
global $glo;
$arr_queue=array("all"=>0,0=>0,1=>0,2=>0,3=>0,4=>0);
$sql="select count(*) as t,state from `@@@mailqueue` group by state";
$rs = query($sql);
while($rows=fetch($rs))
{
	$arr_queue[$rows["state"]] += $rows["t"];
	$arr_queue["all"] += $rows["t"] ;
}
?><table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>队列搜索</strong></td>
  </tr><form name="form2" method="get" action="?">
  <tr bgcolor="#FFFFFF">
    <td class="a_fen">当邮件服务器发送电子邮件的时候，由于硬件设备或者网络限制，会出现部分邮件退信的情况。</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    
      <td width="50%" class="a_fen">
		发送邮箱： <input name="toemail"  style="width:150px"  value="<?=getRequest("toemail")?>" type="text" id="toemail">
		<span class="fontpadding">状态搜索：

        <select style="width:142px" name="state" id="state">
		<option value="">所有订单状态 (<?=$arr_queue["all"]?>)</option>
	<option value="0">新邮件 (<?=$arr_queue[0]?>)</option>
	<option value="1">发送队列中 (<?=$arr_queue[1]?>)</option>
	<option value="2">发送成功 (<?=$arr_queue[2]?>)</option>
	<option value="3">异常 (<?=$arr_queue[3]?>)</option>
        </select>
		<script language="javascript">
		EnterSelect("state","<?=getRequest("state")?>");
		</script>
		</span>
		 <span class="fontpadding"><input type="submit" name="Submit3" value="提交"  class="button" ></span>
      </td></tr>
	 
    </form>
  </table><br>
<form name="formdel" method="post" action="?action=p_handl">
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="6" bgcolor="#F2F4F6"><strong>邮件发送队列</strong></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9" >
    <td  align="center" >ID</td>
    <td  align="left" >邮件名称</td>
    <td  align="left"   >状态</td>
    <td  align="left"   >发送状态相关信息</td>
    <td    >更新时间</td>
    
    <td width="10%"   >操作</td> 
  </tr>
  <?
  $arrstate = array("新邮件","发送队列中","发送成功","异常");
  $orderby=" order by id desc";
  $pagenow=getQueryInt("page",0);
  $condition="where 1=1" ;
  $pageurl="1=1" ;
  
  if(getRequest("toemail")!="")
	{
		$condition .=  " and toemail  like '%" . getRequest("toemail") . "%'" ;
		$pageurl .= "&toemail=" . getRequest("toemail") ;
	}
  
  if(getRequest("state")!="")
{
	$condition .= " and state=" . getRequest("state") ;
	$pageurl .=  "&state=" . getRequest("state") ;
}
  
	$pagesize=20;
	$rs=createPage("*","@@@mailqueue",$condition,$orderby,$pagesize,$pagenow,$pagetotal,$recordcount);
  emptyList($rs,4);
  while($rows=fetch($rs))
  {
  $times = (strtotime($rows["lasttime"])-strtotime($rows["addtime"]))/60 ;
  ?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td   align="center" class="a_fen"><input name="cbid[]" type="checkbox" id="id" value="<?=$rows["id"]?>"></td>
    <td   align="left" class="a_fen">类型 : <?=$rows["name"]?>
    <br>
    相关 : 
    <? if($rows["cid"]==0){?>
    无相关项目
    <? }else if($rows["cid"]==1){ ?>
    会员-<a target="_blank" href="a_user.php?action=edit&id=<?=$rows["pid"]?>"><?=fetchValue("select name as v from @@@user where id=".$rows["pid"],"已删除")?></a>
   <? }else if($rows["cid"]==2){ ?>
     订单-<a target="_blank" href="a_order.php?action=edit&id=<?=$rows["pid"]?>"><?=fetchValue("select itemno as v from `@@@order` where id=".$rows["pid"],"已删除")?></a>
     <? }else if($rows["cid"]==3){ ?>
     留言-<a target="_blank" href="a_message.php?action=edit&id=<?=$rows["pid"]?>"><?=fetchValue("select name as v from @@@message where id=".$rows["pid"],"已删除")?></a>
      <? }else if($rows["cid"]==4){ ?>
     产品-<a target="_blank" href="../product-view.php?id=<?=$rows["pid"]?>"><?=fetchValue("select name as v from @@@product where id=".$rows["pid"],"已删除")?></a>
     <? } ?>
    </td>
    <td align="left"   class="a_fen">状态:<span class="state<?=$rows["state"]?>"><?=$arrstate[$rows["state"]]?></span>
    <br>对方:<?=$rows["toemail"]?></td>
    <td align="left"   class="a_fen"><?=$rows["content"]?></td>
    <td   class="a_fen"><?=formatDate(strtotime($rows["addtime"]))?><br><?=date("H:i",strtotime($rows["addtime"]))?></td>
   
    <td   class="a_fen"><a  href="javascript:void()" onClick="includeJsFile('Ajax_change','../service/serviceForAddtoMailQueue.php?action=trigger&id=<?=$rows["id"]?>')" >重发</a> <a  href="?action=p_handl&do=deletepage&cbid[]=<?=$rows["id"]?>" class="red">删除</a></td> 
  </tr>
 <?
 }
 free($rs);
 ?><tr class="delete" bgcolor="#FFFFFF">
    <td colspan="9" class="a_fen">选择：<a  href="javascript:CheckAll('formdel','ON')">全选</a> 
      -
  <a  href="javascript:CheckAll('formdel','OFF')">取消</a>
  <span class="fontpadding">
  批量删除：
      <a href="javascript:submit_onClick('formdel','deletepage')" >当前所选</a>
	  <span class="hide"> - <a href="javascript:submit_onClick('formdel','deleteall')" class="red" >搜索到的<?=$recordcount?>个结果</a></span></span>
	   <input id="do" name="do" type="hidden" value="editpage" />
      <input type="hidden" name="condition" id="condition" value="<?=$condition?>" /></td>
	</tr>
<tr bgcolor="#FFFFE9">
    <td colspan="6" align="right" ><? require("php_page.php")?></td>
  </tr>
</table></form>
<script>
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
	
	$rs=deleteRecord("@@@mailqueue","$condition");
	pageRedirect("2","a_mailqueue.php");
}
?>
<?php require("php_bottom.php");?>
</body>
</html>
