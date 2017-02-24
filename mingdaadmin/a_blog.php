<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>站内Blog</title>
</head>

<body>

<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">站内Blog</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">站内Blog</a></td>
  </tr>
</table><br />
<?php
isAuthorize($group[2]);
$action=getQuery("action");
switch($action)
{
case "config_save":
	config_save();
	break;
case "reset_blogpwd":
	reset_blogpwd();
	break;
case "change_domain":
	change_domain();
	break;
default:
	show_config();
	break;
}
?>
<?
function show_config()
{
global $config;
?><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >1 中恒外贸系统内置了目前最主流的 Wordpress博客系统。<br>
2 <strong class="red">当BLOG的域名发生变化时候,请记得使用下面 博客搬家 的功能哦。</strong></td>
  </tr>
</table><br>

<form name="formadd" action="?action=config_save" enctype="application/x-www-form-urlencoded" method="post">
<table  border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>站内Blog设置</strong></td>
  </tr>
  
  <tr  bgcolor="#FFFFFF" >
    <td>Blog默认密码</td>
    <td>默认用户名：admin  默认密码：admin888<div style="background-color:#FFFFE6; margin-top:3px; border:1px #FEDF63 dotted; padding:3px; padding-left:7px; width:470px">
	若启用后,请登录 Blog 后台修改密码并牢记登录密码。<br>
	忘记密码？ <a href="?action=reset_blogpwd" class="red">点击此处</a> 将密码重置为BLOG默认密码</span>。</td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td width="230">Blog状态</td>
    <td><input type="radio" name="config118" value="1">
      <span class="red">开启Blog</span> 
        <input type="radio" name="config118" value="">
      关闭
      <script language="javascript">
	  EnterRadio("config118","<?=$config[118]?>")
	  </script>
      </td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td  align="left">Blog路径</td>
    <td  ><a target="_blank" href="http://<?=$config[119]?>"><?=$config[119]?></a></td>
  </tr>
   <tr  bgcolor="#FFFFE9">
     <td  align="left">Blog后台</td>
     <td  ><a target="_blank" href="http://<?=$config[119]?>/wp-login.php"><?=$config[119]?>/wp-login.php</a></td>
   </tr>
   <tr  bgcolor="#FFFFE9">
    <td  align="left">&nbsp;</td>
    <td  ><input type="submit"  class="button"  name="button" id="button" value="保存" onClick="showtips(this)" /></td>
  </tr>
</table></form>
  <form name="formadd" action="?action=change_domain" enctype="application/x-www-form-urlencoded" method="post">
<table  border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>Blog搬家</strong></td>
  </tr>
  
  <tr   bgcolor="#FFFFFF" >
    <td width="230">现Blog路径</td>
    <td>http:// <input type="text" style="width:300px; background-color:#eeeeee; border:1px #cccccc solid; height:21px" name="oldblogpath" value="<?=$config[119]?>" readonly></td>
  </tr>
 <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td width="230">新Blog路径</td>
    <td>http://
      <input type="text" style="width:300px" name="newblogpath" value="" ></td>
  </tr>
  <tr  bgcolor="#FFFFE9">
    <td  align="left">&nbsp;</td>
    <td  ><input type="submit"  class="button"  name="button" id="button" value="更换域名" onClick="return confirm('确定执行 Wordpress 更换域名吗？更换后BLOG内的所有旧域名将更换为新链接');showtips(this)" /></td>
  </tr>
  </table></form>
<?
}
?>

<?

function change_domain()
{
	global $cfg;
	global $config;
	if(getForm("newblogpath")!="")
	{
	//-------账号
		$param=array();
		$condition="where id=1";
		for($indexI=0;$indexI<1023;$indexI++)
		{
			$config[$indexI]=$config[$indexI];
		}
		$config[119] = getForm("newblogpath");
		ksort($config);
		$param["content"]=join( $cfg["split"] , $config ) ;
		$sql=updateSQL( $param,"@@@config",$condition );
		query($sql); 
		
		$old_blog = trim(getForm("oldblogpath"));
		$new_blog = trim(getForm("newblogpath"));
		if( $old_blog!="" && $new_blog!="")
		{
			$sql="UPDATE wp_posts SET post_content = replace(post_content, 'http://$old_blog', 'http://$new_blog');";
			query($sql);
			$sql="UPDATE wp_posts SET guid = replace(guid, 'http://$old_blog', 'http://$new_blog');";
			query($sql);
			$sql="UPDATE wp_options SET option_value = 'http://$new_blog'  where option_name='siteurl'";
			query($sql);
			$sql="UPDATE wp_options SET option_value = 'http://$new_blog'  where option_name='home'";
			query($sql);
		}
	}
	pageRedirect("1","a_blog.php");
}

function reset_blogpwd()
{
	$sql='UPDATE wp_users SET user_pass = \'$P$BG6T4N05LeJ8iQvC5mu3nlDTn9j9Z9.\' where id=1';
	query($sql);
	pageRedirect("1","a_blog.php");
}

function config_save()
{
	global $cfg;
	global $config;
	//-------账号
	$param=array();
	$condition="where id=1";
	for($indexI=0;$indexI<1023;$indexI++)
	{
		$config[$indexI]=$config[$indexI];
	}
	
	$config[118] = getForm("config118");
	if($config[118]=="")
		file_put_contents(ROOT.FOLDER."blog/wp-zhtx.php","<? die('close'); ?>");
	else
		file_put_contents(ROOT.FOLDER."blog/wp-zhtx.php","<? // ?>");
	ksort($config);
	$param["content"]=join( $cfg["split"] , $config ) ;
	$sql=updateSQL( $param,"@@@config",$condition );
	query($sql);
	pageRedirect("1","a_blog.php");
}
?>
<?php require("php_bottom.php");?>

</body>
</html>
