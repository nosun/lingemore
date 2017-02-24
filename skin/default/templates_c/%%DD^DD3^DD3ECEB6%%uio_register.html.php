<?php /* Smarty version 2.6.26, created on 2010-07-22 18:52:52
         compiled from uio_register.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div class="main_ct">
<script language="javascript" type="text/javascript">
  function CheckForm()
  { 
if(!CheckIsChar("reginfo","username","user name")) return false;
if(!CheckLength("reginfo","username","username",4,20)) return false;
if(!CheckLength("reginfo","pwd","pwd",6,20)) return false;
if(!CheckIsSame("reginfo","pwd","pwd1","password","confirm password")) return false;
if(!CheckIsNull("reginfo","question","question")) return false;
if(!CheckIsNull("reginfo","answer","answer")) return false;
if(!CheckIsNull("reginfo","firstname","firstname")) return false;
if(!CheckIsNull("reginfo","lastname","lastname")) return false;
if(!CheckIsEmail("reginfo","email","email")) return false;
if(!CheckIsNull("reginfo","street","street")) return false;
if(!CheckIsNull("reginfo","city","city")) return false;
if(!CheckIsNull("reginfo","province","province")) return false;
if(!CheckIsNull("reginfo","country","country")) return false;
<?php if ($this->_tpl_vars['config'][41] != ""): ?> if(!CheckIsNull("reginfo","code","code")) return false; <?php endif; ?>
}
function checkRegister(str,obj)
{
	if(!CheckIsChar("reginfo","username","user name")) return false;
	if(!CheckLength("reginfo","username","username",4,20)) return false;
	if(obj.value.length>=4)
	{
		var src="<?php echo $this->_tpl_vars['folder']; ?>
service/serviceForCheckRegister.php?action=check&name=" + escape(obj.value) + "&r="  + Math.random();
		includeJsFile("sssid",src)
	}
	else
	{
		var sobj=document.getElementById("divexists");
		var sobj2=document.getElementById("divnoexists");
		sobj.style.display='none';
		sobj2.style.display='none';
	}
}

function CheckRegisterResult(num)
{
	var obj=document.getElementById("divexists");
	var obj2=document.getElementById("divnoexists");
	if( num==1)
	{
		obj.style.display='block';
		obj2.style.display='none';
	}
	else
	{
		obj.style.display='none';
		obj2.style.display='block';
	}
}
  </script><form name="reginfo" onsubmit="return CheckForm();" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=register_save">
<fieldset>
<legend>Account Information</legend>
       <table width="100%" border="0" cellpadding="0" cellspacing="5">
<tr>
                <td width="130" align="left">Username: </td>
<td><input name="username" onblur="checkRegister('check',this)" type="text" id="username"  class="input001" maxlength="100">  <span class="impc">*</span>
        <span class="sec">4-20 characters (A-Z, a-z, 0-9)</span>
              
        <div id="divexists" style="display:none; color:#FF0000">Sorry , User name already exists</div>
		<div id="divnoexists" style="display:none; color:#00FF00">Congratulation, You can register this user name</div>
</td>
              </tr>
              <tr>
                <td align="left">Password:</td>
                <td><input name="pwd" type="password" id="password"  class="input001" maxlength="20"> 
                <span class="impc">*</span>
                <span class="sec">6-20 characters (A-Z, a-z, 0-9)</span></td>
              </tr>
              <tr>
                <td align="left">Retype password:</td>
                <td><input name="pwd1" type="password" id="password1"  class="input001" maxlength="20"> 
                <span class="impc">*</span></td>
              </tr>
              <tr>
                <td align="left">Question:</td>
                <td><input name="question" type="text"    class="input001" maxlength="20"> 
                <span class="impc">*</span></td>
              </tr>
              <tr>
                <td align="left">Secret answer:</td>
                <td><input name="answer" type="text"    class="input001" maxlength="20">
                <span class="impc">*</span>
              </td>
              </tr>
    </table>    
</fieldset>
 <fieldset>
<legend>Billing Information</legend>
<table width="100%" border="0" cellpadding="0" cellspacing="5">
<tr>
                <td width="130" align="left">First name:</td>
      <td><input name="firstname" type="text"   class="input001" maxlength="30" /><span class="impc">*</span></td>
    </tr>
              <tr>
                <td align="left">Last name:</td>
                <td><input name="lastname" type="text"    class="input001" maxlength="30" /><span class="impc">*</span></td>
              </tr>
              <tr>
                <td align="left">Gender:</td>
                <td>
				<input name="sex"  type="radio" checked="checked" value="1" />Male <input type="radio" name="sex"  value="0" />Female				</td>
              </tr>
			
              <tr>
                <td align="left">Email:</td>
                <td><input name="email" type="text" id="content3" onblur="checkRegister('email',this)"  class="input001" maxlength="100">
                <div id="divemail" style="display:none; color:#FF0000">Already exists</div>
                <span class="impc">*</span></td>
              </tr>
              <tr>
                <td align="left">MSN:</td>
                <td><input name="msn" type="text" id="content4"  class="input001" maxlength="100"></td>
              </tr>
              
			   <tr>
                <td align="left">Street/Address:</td>
                <td><input name="street" type="text" id="street"  class="input001" maxlength="200"><span class="impc">*</span></td>
              </tr> 
			  
			       <tr>
                <td align="left">Zip/Postcode:</td>
                <td><input name="postcode" type="text" id="postcode"  class="input001" maxlength="20"></td>
              </tr>
			  
              <tr>
                <td align="left">City:</td>
                <td><input name="city" type="text" id="city"  class="input001" maxlength="20"><span class="impc">*</span></td>
              </tr>
               <tr>
                <td align="left">State/Province:</td>
                <td><input name="province" type="text" id="province"  class="input001" maxlength="20"><span class="impc">*</span></td>
              </tr>
			  
              <tr>
                <td align="left">Country:</td>
                <td><?php $this->assign('country', 'country'); ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_country.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <span class="impc">*</span></td>
              </tr>
    <tr  >
    <td align="left">Mobile telephone:</td>
    <td><input name="content3" type="text"    class="input001" /></td>
  </tr>
              <tr>
                <td align="left">As a delivery address:</td>
                <td><input name="address" type="radio" value="1" checked="checked" /> 
                Yes <input type="radio" name="address" value="0" /> No</td>
              </tr>
  </table>    
</fieldset>
 <table width="100%" border="0" cellpadding="0" cellspacing="15">
 <?php if ($this->_tpl_vars['config'][41] != ""): ?> <tr  >
                <td width="250" align="left">Input the characters you see in this picture:</td>
                <td><input name="code" type="text" size="8" maxlength="4" /> <img src="<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php" align="absmiddle" style="cursor:pointer" onclick="this.src='<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php?r=' + Math.random()"  /></td>
    </tr>
<?php endif; ?>
    <tr >
    <td align="left">&nbsp;</td>
    <td><input type="submit" onclick="return CheckForm()" name="uiosubmit"  value="Register" /></td>
  </tr>
</table>
</form>

<script language="JavaScript" type="text/javascript">
/*
var secs = 3;
var wait = secs * 1000;
var regtext="Waiting";
var regtext1="Register";
///document.reginfo.uiosubmit.value = regtext+"(" + secs + ")second";
for(i = 1; i <= secs; i++) {
  window.setTimeout("update(" + i + ")", i * 1000);
}
//window.setTimeout("timer()", wait);
function update(num, value) {
  if(num == (wait/1000)) {
    document.reginfo.uiosubmit.value = regtext;
  } else {
    printnr = (wait / 1000)-num;
    document.reginfo.uiosubmit.value = regtext+"(" + printnr + ")second";
  }
}
function timer() {
  document.reginfo.uiosubmit.disabled = false;
  document.reginfo.uiosubmit.value = regtext1;
}
*/
</script>
</div>