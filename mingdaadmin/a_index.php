<?
if($_GET["main_page"]=="")
	$main_page = "a_index_body.php";
else
	$main_page = $_GET["main_page"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>欢迎使用中恒天下网站管理系统</title>
<link href="Style/css_top.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="JSFile/jquery.min.js"></script>
<script>
function reinitIframe(id){
	var iframe = document.getElementById(id);

try{
iframe.height =  document.documentElement.clientHeight-100-1;
}catch (ex){}

}
var mainInterval=window.setInterval("reinitIframe('main')",200);
var mainleftInterval=window.setInterval("reinitIframe('menu')",200);
</script>
<style type="text/css">
a.leftframesj{width:7px; height:88px; display: block; background:url(images/framesj_1.jpg) no-repeat; text-decoration:none; cursor:pointer;}
a.leftframesj:hover{width:7px; height:88px; display: block; background:url(images/framesj_2.jpg) no-repeat; text-decoration:none; cursor:pointer;}
a.leftframeshow{width:7px; height:88px; display: block; background:url(images/frameshow_1.jpg) no-repeat; text-decoration:none; cursor:pointer;}
a.leftframeshow:hover{width:7px; height:88px; display: block; background:url(images/frameshow_2.jpg) no-repeat; text-decoration:none; cursor:pointer;}
</style>
<script type="text/javascript">
function hideframe()
{
	$(".leftframesj").css("display","none");
	$(".leftframeshow").css("display","block");
	$("#leftframe").css("display","none");
}
function showframe()
{
	$(".leftframesj").css("display","block");
	$(".leftframeshow").css("display","none");
	$("#leftframe").css("display","");
}
</script>
</head>
<body style="margin:0px; overflow-y:hidden;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
     <div style="height:100px;	background:url(images/top_bg_hr.jpg) left top repeat-x;">
     <?php require("a_index_top.php");?>
     </div>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td id="leftframe" width="176" valign="top" style="width:176px; overflow:hidden;">
            <iframe style="margin:0px; padding:0px;" width="176" allowtransparency="true" frameborder="0" src="a_index_menu.php" id="menu"  name="menu" onload="reinitIframe('menu')"></iframe>
            </td>
            <td width="7" style="background:#A1D8FF;">
             <a class="leftframesj" href="javascript:;" onclick="hideframe()">&nbsp;</a>
             <a class="leftframeshow" href="javascript:;" style="display:none;"  onclick="showframe()">&nbsp;</a>
            </td>
            <td valign="top">
              <iframe style="margin:0px; padding:0px; border-top:1px #3EB2E2 solid;border-left:1px #3EB2E2 solid" width="100%" allowtransparency="true" frameborder="0" src="<?=$main_page?>" id="main" name="main" onload="reinitIframe('main')"></iframe>
            </td>
          </tr>      
      </table>
    </td>
  </tr>

</table>
</body>
</html>