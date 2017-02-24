<?php
header('Content-Type: text/html; charset=utf-8');
require("../inc/php_inc.php");
require("../inc/php_inc_client.php");
$domain = $_SERVER['SERVER_NAME'] ;
$url = $_SERVER['REQUEST_URI'];
$arrdomain = split("\." , $domain);
if( count($arrdomain)==2 )
{
	redirect("http://www.{$domain}{$url}");
}
$action=getQuery("action");

if( $_COOKIE["admin_name"]!="" &&  $_COOKIE["admin_pwd"]!="")
{
	$sql="select * from @@@admin where name='" . filterSQL($_COOKIE["admin_name"]) . "' and pwd='" . filterSQL($_COOKIE["admin_pwd"]) . "' limit 1";
	$rs=query($sql);
	if( mysql_num_rows($rs)!=0 )
	{
		$rows=mysql_fetch_array($rs);
		$_SESSION["admin"] = $rows["id"];
		if($rows["supper"]!=9)
		{
			$param=array();
			$param["addtime"]=formatDateTime(time());
			$param["ip"]=getIP();
			$param["os"]=getClientOS();
			$param["browser"]=getClientBrowser();
			$param["name"]=$rows["name"];
			$param["useragent"]=$_SERVER['HTTP_USER_AGENT'];
			$sql=insertSQL($param,"@@@log");
		}
		redirect("a_index.php");
	}
	setcookie("admin_name","", time() - 3600);
	setcookie("admin_pwd","", time() - 3600);
}

switch($action)
{
	case "login":
		login();
		break;
	default:
		main();
		break;
}
?>
<?
function main()
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="none">
<title>中恒天下网站管理系统</title>
<meta http-equiv="Pragma" content="no-cache">
<style type="text/css">
body,html{font-size:12px; font-family: "宋体",Arial, Helvetica, sans-serif;}
body{margin:0px; background:url(images/new/bg.jpg) repeat-x top #F2F3F7;}
.main_mid{height:auto; padding-top:74px; top:0px; bottom:46px; left:0px; right:0px;}
.maim_content{position:absolute; left:0px; right:0px; top:35%;}
.bom{background:url(images/new/bom.jpg) repeat-x; height:46px; width:100%; position:absolute; bottom:0px; left:0px; right:0px; z-index:100;}
.contenturl{list-style:none; margin:0px; padding:0px;}
.contenturl li{list-style:none; line-height:25px; padding-left:8px; background:url(images/new/li_icon.jpg) left 8px no-repeat; color:#7A787B;}
.wenben{ color:#7A787B }
.input01{width:150px; height:20px; border:1px #C6BAC8 solid; line-height:20px;}
.input02{width:96px; height:30px; border:none; background:url(images/new/login_submit.gif) no-repeat; cursor:pointer;}
</style>
<script language="javascript" src="JSFile/ie6.js"></script>
</head>

<body>
<div style="height:74px; background:url(images/new/bg.jpg) repeat-x;"><div style="height:74px; width:100%; clear:both; overflow:hidden; background:url(images/new/topbg.jpg) no-repeat center;"></div></div>
<div class="main_mid">
 <div class="maim_content">
  <div style="width:565px; margin:auto; height:200px;">
    <div style="width:290px; background:url(images/new/boxsplit.jpg) right no-repeat; padding-right:10px; float:left;">
       <div style="overflow:hidden;"><img src="images/new/logo.jpg" /></div>
       <div style="overflow:hidden;">
         <ul class="contenturl">
           <li>请不要在公共场所设定计算机记住您的个人信息。</li>
           <li>在公共场所使用本产品后请务必退出系统，以避免造成不必要的损失。</li>
           <li>尽量避免多人使用同一账号。</li>
         </ul>
       </div>
    </div>
    <div style="width:225px;  padding-left:40px; float:left;">
       <div style="overflow:hidden; height:25px; line-height:25px; padding-top:30px; font-size:15px;"><strong>欢迎使用中恒天下网站管理系统</strong></div>
       <div style="overflow:hidden;">
		<form action="index.php?action=login" method="post">
         <table border="0" cellpadding="0" cellspacing="0">
           <tr>
             <td width="50" height="30" class="wenben">用户名：</td>
             <td><input class="input01" name="name" type="text" id="name" size="20" /></td>
           </tr>
           <tr>
             <td height="30" class="wenben">密　码：</td>
             <td><input class="input01" name="pwd" type="password" size="20" /></td>
           </tr>
           <tr>
             <td height="30" class="wenben">验证码：</td>
             <td>
             <div class="input01" style="background:#FFF; overflow:hidden; padding-right:2px">
              <div style="display:inline-block; float:left;"><img height="20" src="../inc/php_inc_code.php"  onclick="this.src='../inc/php_inc_code.php?r=' + Math.random()"  /></div>
              <div style="display:inline-block; float:left; overflow:hidden;">
                <input name="code" type="text" size="4" maxlength="4" style="height:20px; padding-left:2px; background-color:#ffffff; margin-top:-1px; line-height:20px; width:80px;  border:0px;" /></div>
             </div>
             
			 </td>
           </tr>
           <tr>
             <td height="30" class="wenben">保　持：</td>
             <td><select name="rememberlogin"><option value="">退出浏览器</option><option value="1">一天</option><option value="7">一个礼拜</option><option value="30">一个月</option></select><input name="redirect_url" type="hidden" value="<?=getQuery("redirect_url")?>" /></td>
           </tr>
           <tr>
             <td height="50" colspan="2"><input name="submit" type="submit" value="" class="input02" /></td>
           </tr>
         </table>
         </form>
       </div>
    </div>
  </div>
 </div>
</div>
<div class="bom"></div>
</body>
</html>

<?
}
?><?
function login()
{
	global $cfg;
	if( getForm("code")!=$_SESSION["code"] or $_SESSION["code"]=="" or getForm("code")=="" )
		alertRedirect("验证码错误","index.php");
	if(  getForm("name")=="" or getForm("pwd")=="" )
		alertRedirect("用户名,密码不能为空","index.php");
	$name=filterSQL(getForm("name"));
	$pwd=md5(md5(getForm("pwd")));
	$sql="select * from @@@admin where name='$name' and pwd='$pwd'";
	//debug($sql);
	$rs=query($sql);
	if( mysql_num_rows($rs)!=0 )
	{
		$rows=mysql_fetch_array($rs);
		if( $rows["state"] ==1 )
			alertRedirect("对不起,您已经禁止登陆","index.php");
		if( getForm("rememberlogin")!="" )
		{
			setcookie("admin_name",$name,time()+getFormInt("rememberlogin",0)*24*3600);
			setcookie("admin_pwd",$pwd,time()+getFormInt("rememberlogin",0)*24*3600);
		}
		else
		{
			setcookie("admin_name",$name,0);
			setcookie("admin_pwd",$pwd,0);
		}
		$_SESSION["admin"] = $rows["id"];
		if($rows["supper"]!=9)
		{
			$param=array();
			$param["addtime"]=formatDateTime(time());
			$param["ip"]=getIP();
			$param["os"]=getClientOS();
			$param["browser"]=getClientBrowser();
			$param["name"]=$rows["name"];
			$param["useragent"]=$_SERVER['HTTP_USER_AGENT'];
			$sql=insertSQL($param,"@@@log");
			query($sql);
		}
		redirect("a_index.php?main_page=".getForm("redirect_url"));
	}
	else
		alertRedirect("用户名,密码错误","index.php");
}
?>
