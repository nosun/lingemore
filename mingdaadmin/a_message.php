<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>消息管理</title>
</head>

<body>
<?php require("php_top.php")?>
<style>
.state0{ color:#00CC00}
.state1{ color:#000000}
</style>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">消息管理</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
 
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">消息列表</a> <span class="fontpadding"><a class="add" href="?action=add&cid=5">添加系统公告</a></span> </td>
  </tr>
  
 
</table>
<br />
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
case "edit2":
	editItem2();
	break;
case "add_save":
	add_save();
	break;
case "add_reply_save":
	add_reply_save();
	break;
case "close_reply_save":
	close_reply_save();
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
$sql="select count(cid) as t,cid from @@@message group by cid";
$rs=query($sql);
$arrmessage = array(0,0,0,0,0,0,0,0);
while($rows=fetch($rs))
{
	$arrmessage[$rows["cid"]] = $rows["t"] ;
}
$arrmessage["all"] = $arrmessage[0] + $arrmessage[1] + $arrmessage[2] + $arrmessage[3] + $arrmessage[4] + $arrmessage[5];
?>
<script language="javascript" charset='gb2312' src="JSFile/DateJs.js"></script>
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
</script>
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>消息搜索</strong></td>
  </tr>  

      <tr bgcolor="#FFFFFF">
    <td  >
	<a href="?">全部留言(<span class="red"><?=$arrmessage["all"]?></span>)</a><span class="fontpadding"><a href="?cid=0">站内消息(<span class="red"><?=$arrmessage[0]?></span>)</a></span><span class="fontpadding"><a href="?cid=1">产品评论(<span class="red"><?=$arrmessage[1]?></span>)</a></span><span class="fontpadding  hide"><a href="?cid=2">文章评论(<span class="red"><?=$arrmessage[2]?></span>)</a></span><span class="fontpadding"><a href="?cid=3">反馈留言(<span class="red"><?=$arrmessage[3]?></span>)</a></span><span class="fontpadding"><a href="?cid=4">订单留言(<span class="red"><?=$arrmessage[4]?></span>)</a></span><span class="fontpadding"><a href="?cid=5">系统公告(<span class="red"><?=$arrmessage[5]?></span>)</a></span>
	</td>
  </tr>  <form name="form2" method="get" action="?">
    <tr bgcolor="#FFFFFF">
      <td >  标题：
        <input name="name" value="<?=getRequest("name")?>" type="text" id="keyword">
		<span class="fontpadding">
	  状态：
		<select name="adminread" id="adminread">
		<option value="">所有</option>
		<option value="0">新消息</option>
		<option value="1">已阅读</option>		
		</select>
		<script>
		EnterSelect("adminread",'<?=getRequest("adminread")?>');
		</script>
		</span>
		<span class="fontpadding">
	  类型：
		<select name="cid" id="cid">
		<option value="">所有</option>
		<option value="0">站内消息</option>
		<option value="1">产品评论</option>
		<option value="2">文章评论</option>		
		<option value="3">反馈留言</option>
		<option value="4">订单留言</option>
		<option value="5">站内公告</option>
		</select>
		<script>
		EnterSelect("cid",'<?=getRequest("cid")?>');
		</script>
		</span>
	    <span class="fontpadding">
	日期：
        <input name="addtime" value="<?=getRequest("addtime")?>" id="addtime" onClick="javascript:ShowCalendar(this.id)" type="text">
	<input type="submit" name="Submit3" value="提交"  class="button" ></span></tr></form>
</table>
<br>

<?
$arrstate=array("新消息","已阅读");
$condition="where 1=1";
$pageurl="1=1";
if( getRequest("addtime")!="" )
{
	$condition.= " and datediff(addtime,'" . getRequest("addtime") . "')=0";
	$pageurl.= "&addtime=" . getRequest("addtime");
}
if(getRequest("name")!="")
{
	$condition .= " and name  like '%" . getRequest("name") . "%'";
	$pageurl .= "&name=" . getRequest("name");
}

if(getRequest("cid")!="")
{
	$condition .=  " and cid=" . getRequest("cid");
	$pageurl .=   "&cid=" . getRequest("cid");
}

if(getRequest("userid")!="")
{
	$condition .=  " and userid=" . getRequest("userid");
	$pageurl .=   "&userid=" . getRequest("userid");
}


if(getRequest("pid")!="")
{
	$condition.=  " and pid=" . getRequest("pid");
	$pageurl.=  "&pid=" . getRequest("pid");
}
if(getRequest("adminread")!="")
{
	$condition .= " and adminread=" . getRequest("adminread");
	$condition .= " and cid!=5" ;
	$pageurl .= "&adminread=" . getRequest("adminread");
}

if( getRequest("cid")=="0" )
	$title="站内消息";
else if( getRequest("cid")=="1" ) 
	$title="产品评论";
else if( getRequest("cid")=="2" ) 
	$title="文章评论";
else if( getRequest("cid")=="3" ) 
	$title="反馈留言";
else if( getRequest("cid")=="4" )
	$title="订单留言";
else if( getRequest("cid")=="5" ) 
	$title="站内公告";

?>

<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="8" bgcolor="#F2F4F6"><strong>消息管理</strong>  <span class="fontpadding"><?=$title?></span></td>
  </tr>
  <tr align="center"  bgcolor="#FFFFE9"  >
  <td width="5%"  >选择</td>
    <td width="23%"  >IP/标题</td>
    <td width="12%"  >用户</td>
    <td width="11%" >相关</td>
    <td width="7%" >状态</td>
    <td width="14%">发表时间</td>
    <?php
    if( getRequest("cid")=="1" ) 
	{
	?>    
    <td width="21%" >产品展示</td>
    <?php
	}
	else
	{
	?>
    <td width="21%" >产品展示</td>
    <?php
	}
	?>
    <td width="7%" >操作</td>
  </tr>

<form name="formdel" method="post" action="?action=p_handl">
<?
$pagenow=getQueryInt("page");
$pagesize=20;
$rs=createPage("*","@@@message",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
emptyList($rs,8);
while($rows=fetch($rs))
{
	if( $rows["cid"]==0 )
		$strp="站内消息";
	else if( $rows["cid"] == "1" )
		{
		$strp="<a href='a_product.php?action=edit&id=" . $rows["pid"] . "'>产品配置</a>" ;
		$strp .="<br />评分: <img src='../skin/default/pic/star-{$rows['rating']}.gif'";
		}
	else if( $rows["cid"] == "2" )
		$strp="<a href='a_news.php?action=edit&id=" . $rows["pid"] . "'>查看文章</a>" ;
	else if( $rows["cid"] == "4" )
		$strp="<a href='a_order.php?action=edit&id=" . $rows["pid"] . "'>查看订单</a>" ;
	else if( $rows["cid"] == "5" )
		$strp="站内公告" ;
	else if( $rows["cid"] == "3" )
		$strp="反馈留言" ;
	
	if( $rows["cid"] == "0" ||  $rows["cid"] == "4")
		$rows["display_href"] = "?action=edit2&id=".$rows["id"]; 
	else
		$rows["display_href"]  =  "?action=edit&id=".$rows["id"]; 
		
	
	if($rows["cid"]==5)
		$strstate = "&nbsp;";
	else
		$strstate = $arrstate[$rows["adminread"]];
?>
  <tr align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
  <td  class="a_fen">
      <input name="cbid[]" type="checkbox" id="id" value="<?=$rows["id"]?>"></td>
    <td align="left" class="a_fen"><img src="http://open.35zh.com/cgi-bin/?do=iptocountry&type=3&ip=<?=$rows["ip"]?>" align="absmiddle" hspace="2"> <a href="<?=$rows["display_href"]?>"><?=$rows["name"]?></a></td>
    <td class="a_fen"><?
	if( $rows["userid"] > 0 )
		echo "<a href='a_user.php?action=edit&id=" . $rows["userid"] . "'>". $rows["username"] . "</a>";
	else if( $rows["userid"] ==-1 )
		echo $rows["username"];
	else
		echo "站内公告";
	?></td>
    <td  class="a_fen"><?=$strp?></td>
    <td  class="a_fen"><span class='state<?=$rows["adminread"]?>'><?=$strstate?></span></td>
    <td  class="a_fen"><?=formatDate(strtotime($rows["addtime"]))?><br><?=date("H:i",strtotime($rows["addtime"]))?></td>
    <td  class="a_fen">
	<?
    if($rows["cid"]==1)
	{
		echo "<a target='_blank' href='../product-view.php?id=".$rows["pid"]."'>".$rows["domain"]."</a>";
	}
	else
	{
	?>
	<?=$rows["domain"]?>
    <?
	}
	?>
    </td>
    <td  class="a_fen"><a class="delete red" onClick="return confirm('确定要删除吗？')"  href="?action=p_handl&do=deletepage&cbid[]=<?=$rows["id"]?>">删除</a></td>
  </tr>
<?
}
?>
  <tr class="delete" bgcolor="#FFFFFF">
    <td colspan="8" class="a_fen">选择：<a  href="javascript:CheckAll('formdel','ON')">全选</a> 
      -
  <a  href="javascript:CheckAll('formdel','OFF')">取消</a>
  <span class="fontpadding">
  批量删除：
      <a href="javascript:submit_onClick('formdel','deletepage')" >当前所选</a> - 
	  <a href="javascript:submit_onClick('formdel','deleteall')" class="red" >搜索到的<?=$recordcount?>个结果</a>	  </span>
	   <input id="do" name="do" type="hidden" value="editpage" />
      <input type="hidden" name="condition" id="condition" value="<?=$condition?>" /></td>
	</tr>
</form>
  <tr bgcolor="#FFFFE9">
    <td colspan="8" align="right" ><? require("php_page.php")?></td>
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
function editItem()
{
global $cfg;
$id=getQuerySQL("id");
$sql="select * from @@@message where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$arrstate=array("新消息","已回复","未回复","已解决");
$contact=split( $cfg["split"] , $rows["contact"] );
array_pad($contact,50,"");
//--  设置已读
if($rows["cid"]!=5 )
{
	$condition="where id=$id";
	$param=array();
	$param["adminread"]=1;
	$sql=updateSQL($param,"@@@message",$condition);
	query($sql);	
}

?>
<form name="form2" method="post" action="?action=edit_save&id=<?=$id?>">
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>查看消息</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="17%">发布者：</td>
    <td>
	<?
	if( $rows["userid"] > 0 )
		echo "<a href='a_user.php?action=edit&id=" . $rows["userid"] . "'>". $rows["username"] . "</a>";
	else if( $rows["userid"] ==-1 )
		echo $rows["username"];
	else
		echo "站内公告";
	?>	</td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="17%">消息标题：</td>
    <td><?=$rows["name"]?></td>
  </tr>
   <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="17%">状态：</td>
	<td><?=$arrstate[$rows["state"]]?></td>
  </tr>
  <tr bgcolor="#FFFFFF" >
    <td width="17%">消息内容：</td>
    <td><?=nl2br($rows["content"])?></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td valign="top">回复时间：</td>
    <td><?=$rows["replytime"]?></td>
  </tr>
  <?
  if ( $rows["cid"]!=5 &&  $rows["cid"]!=0)
  {
  ?>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="17%" valign="top">回复留言：</td>
    <td><textarea name="reply" style="width:700px; height:70px"><?=$rows["reply"]?></textarea></td>
  </tr>
  <tr class="hide" bgcolor="#ffffff"  >
    <td></td>
    <td><input name="cbemail" type="checkbox" value="1">
      同时发送到对方邮箱 <?=$contact[0]?> </td>
  </tr>
  <tr bgcolor="#FFFFE9"  class="edit" >
    <td width="17%">&nbsp;</td>
    <td><input type="submit"  class="button"  name="Submit4" value="回复"  onClick="showtips(this)"/></td>
  </tr>
  <?
  }
  ?>
</table>
<br />
<?
if ( $rows["cid"] !=5 )
{
?>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px;">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>附加信息</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="17%">Email：</td>
    <td><?=$contact[0]?></td>
  </tr>
  
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td>MSN：</td>
    <td><?=$contact[1]?></td>
  </tr>
   <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td>IP：</td>
    <td><?=$rows["ip"]?>  &nbsp;&nbsp;&nbsp; <script src="http://open.35zh.com/cgi-bin/?do=iptocountry&ip=<?=$rows["ip"]?>&type=2"></script> <span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px"><a target="_blank" href="http://www.melissadata.com/lookups/iplocation.asp?ipaddress=<?=$rows["ip"]?>">查看更为详细的IP地址</a></span></td>
  </tr>
</table>
<?
}
?>
</form>

<?
free($rs);
}
?>


<?
function editItem2()
{
global $cfg;
$id=getQuerySQL("id");
$sql="select * from @@@message where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);
$arrstate=array("新消息","已回复","未回复","已解决");
$contact=split( $cfg["split"] , $rows["contact"] );
array_pad($contact,50,"");
//--  设置已读取

$condition="where id=$id";
$param=array();
$param["adminread"]=1;
$sql=updateSQL($param,"@@@message",$condition);
query($sql);	
?>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>查看消息</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="17%">会员名称：</td>
    <td>
	<?
		echo "<a href='a_user.php?action=edit&id=" . $rows["userid"] . "'>". $rows["username"] . "</a>";
	?>	</td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="17%">消息标题：</td>
    <td><?=$rows["name"]?></td>
  </tr>
   <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="17%">状态：</td>
	<td><?=$arrstate[$rows["state"]]?></td>
  </tr>
  <tr bgcolor="#FFFFFF" >
    <td width="17%">消息内容：</td>
    <td><?=nl2br($rows["content"])?></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td valign="top">回复时间：</td>
    <td><?=$rows["replytime"]?></td>
  </tr>

  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td>IP：</td>
    <td><?=$rows["ip"]?>  &nbsp;&nbsp;&nbsp; <script src="http://open.35zh.com/cgi-bin/?do=iptocountry&ip=<?=$rows["ip"]?>&type=2"></script> <span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px"><a target="_blank" href="http://www.melissadata.com/lookups/iplocation.asp?ipaddress=<?=$rows["ip"]?>">查看更为详细的IP地址</a></span></td>
  </tr>
  </table>
<br>

  <!--leave message-->
 
 <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
     <tr style="background-color:#FFF">
       <td align="left" width="17%" valign="top" >回复内容：</td>
       <td><div style="line-height:18px">
       <?
		  $sql="select * from @@@reply where mid=".$id." order by id asc";
		  $rs=query($sql);
		  while($replyrows=fetch($rs))
		  {
			  $replyrows["content"]=nl2br($replyrows["content"]);
			  //$var["rs_reply"][]=$replyrows;
			  if( $replyrows["replyid"]>0 )
				 $strcolor = "#008040";
			  else
			   	 $strcolor = "#0000FF";	
	   ?>
             <div style="color:<?=$strcolor?>"><?=$replyrows["replyname"]?>  &nbsp; <?=$replyrows["addtime"]?></div>
             <div style="padding-left:12px"><?=nl2br($replyrows["content"])?></div>
			<?
          }
            ?></div>
       </td>
     </tr>
  </table><br>

    <form name="form2" method="post" action="?action=add_reply_save&id=<?=$id?>">
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="17%" valign="top">回复留言：</td>
    <td>
    <input type="hidden" name="mid" value="<?=$id?>" />
    <input type="hidden" name="replyname" value="<?=$adminnickname?>" />
    <textarea name="content" cols="50" rows="4"></textarea></td>
  </tr>
  <tr bgcolor="#FFFFE9"  class="edit" >
    <td width="17%">&nbsp;</td>
    <td><input type="submit"  class="button"  name="Submit4" value="回复"  onClick="showtips(this)"/></td>
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
if( getQuery("cid")=="5" )
{
	$userid=0;
	$username="站内公告";
	$cid= 5 ;
}
else
{
	$userid=getQuerySQL("id");
	$sql="select * from @@@user where id=$userid";
	$rs=query($sql);
	isItemNotExist($rs);
	$rows=fetch($rs);
	$username=$rows["name"];
	$cid="0";
}
?>
<form name="form2" method="post" action="?action=add_save">
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>发布消息</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="17%">发给会员：</td>
    <td>
	<?=$username?>
	<input name="username" type="hidden" value="<?=$username?>"  />
      <input name="userid" type="hidden" value="<?=$userid?>" />
	  <input name="cid" type="hidden" value="<?=$cid?>" />
    </a></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="17%">消息标题：</td>
    <td><input name="name" type="text"  style="width:400px;" /></td>
  </tr>
  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
    <td width="17%" valign="top">消息内容：</td>
    <td><textarea name="content"  style="width:700px; height:70px"></textarea></td>
  </tr>
  <tr bgcolor="#FFFFE9" class="add"  >
    <td width="17%">&nbsp;</td>
    <td><input type="submit"  class="button"  name="Submit4" value="发送"  onClick="showtips(this)"/></td>
  </tr>
</table>
</form>

<?
free($rs);
}
?>
<?
function delete_save()
{
	$id=getQuerySQL("id");
	$sql="delete from @@@message where id=$id";
	query($sql);
	$sql="delete from @@@reply where mid=$id";
	query($sql);
	pageRedirect("2","a_message.php");
}

function add_save()
{
	$param["name"]=getForm("name");
	$param["userid"]=getFormSQL("userid");
	$param["username"]=getForm("username");
	$param["cid"]=getFormInt("cid",5);
	$param["state"]=0;
	$param["userread"]=0;
	$param["adminread"]=1;
	$param["ip"]=getIP();
	$param["addtime"]=formatDateTime(time());
	$param["content"]=$_POST["content"];
	$sql=insertSQL($param,"@@@message");
	query($sql);
	pageRedirect("0","a_message.php");
}

function edit_save()
{
	global $adminname;
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["state"]=1;
	$param["userread"]=0;
	$param["reply"]=getForm("reply");
	$param["replytime"]=formatDateTime(time());
	$param["replyname"]=$adminname;
	$sql=updateSQL($param,"@@@message",$condition);
	query($sql);
	if(getForm("cbemail"))
	{
		$vartmp = array();
		$vartmp["action"] = "email_feedback_reply";
		$vartmp["id"] = $id;
		addToMailQueue($vartmp);	
	}
	pageRedirect("1",$_SERVER['HTTP_REFERER']);
}

function add_reply_save()
{
	global $config;
	global $cfg;
	global $adminnickname;
	$param["replyid"]=getFormInt("replyid",-1);
	$param["replyname"]=$adminnickname;
	$param["mid"]=getFormInt("mid",0);
	$param["ip"]=getIP();
	$param["addtime"]=formatDateTime(time());
	$param["content"]=getFormSafe("content");
	$sql=insertSQL($param,"@@@reply");
	query($sql);
	//debug();
	
	
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param=array();
	$param["state"]=1;
	$param["isclose"]=0;
	$param["userread"]=0;
	$param["replytime"]=formatDateTime(time());
	$sql=updateSQL($param,"@@@message",$condition);
	query($sql);
	
	alertRedirect("成功的留言",$_SERVER['HTTP_REFERER']);
}
function close_reply_save()
{
	global $config;
	global $cfg;
	
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param["isclose"]=1;
	$sql=updateSQL($param,"@@@message",$condition);
	query($sql);
	//debug();
	$id=getQuerySQL("id");
	$condition="where id=$id";
	$param=array();
	$param["state"]=3;
	$param["replytime"]=formatDateTime(time());
	$sql=updateSQL($param,"@@@message",$condition);
	query($sql);
	
	alertRedirect("Close Reply Success",$_SERVER['HTTP_REFERER']);
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
	$rs=deleteRecord("@@@message","$condition");
	pageRedirect("2","a_message.php");
}
?>
<?php require("php_bottom.php")?>

</body>
</html>
