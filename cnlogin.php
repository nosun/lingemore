<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Plz login</title>
<link href="skin/default/pic/style.css" type="text/css"  rel="stylesheet">
<meta name="robots" content="none">
<script language="javascript"  src="skin/default/pic/fun_normal2.js"></script>
</head>

<body>
<?
require("inc/php_inc.php");
?>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="5">
<form id="form1" name="form1" method="post" enctype="application/x-www-form-urlencoded"  onsubmit="return CheckForm()" action="index.php?action=cn_login">
  <tr>
    <td align="right">Username:</td>
    <td>
      <input name="name" type="text" id="username" maxlength="20" /></td>
  </tr>
  <tr>
    <td align="right">Password:</td>
    <td><input name="pwd" type="password" id="password" maxlength="20" /></td>
  </tr>
  <? if($config[40]!="") { ?>
  <tr>
    <td align="right">Code:</td>
    <td><input name="code" type="text" size="8" maxlength="4" /> <img src="inc/php_inc_code.php" align="absmiddle" style="cursor:pointer" onclick="this.src='inc/php_inc_code.php?r=' + Math.random()"  /></td>
  </tr>
  <? } ?>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Submit" /></td>
  </tr>
</form>
</table>
<script language="javascript" type="text/javascript">
  function CheckForm()
  { 
if(!CheckIsNull("form1","name","user name")) return false;
if(!CheckIsNull("form1","pwd","password")) return false;
<? if($config[40]!="") { ?> if(!CheckIsNull("form1","code","code")) return false; <? } ?>
}
  </script>	  
</body>
</html>
