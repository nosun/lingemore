<?php /* Smarty version 2.6.26, created on 2012-04-30 18:06:33
         compiled from uio_get_pwd2.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div class="main_ct">
<?php if ($this->_tpl_vars['action'] == 'step_1'): ?>
 <fieldset>
<legend><?php echo $this->_tpl_vars['lg']['pwd2_step1_title']; ?>
</legend>
            <table border="0" cellspacing="8">
              <form action="<?php echo $this->_tpl_vars['folder']; ?>
get-pwd2.php?action=step_2" method="post" name="formadd" >
                <tr>
                  <td  width="130" align="right"><?php echo $this->_tpl_vars['lg']['your_email_address']; ?>
 :</td>
                  <td><input name="name" type="text"  class="input001" id="userid" maxlength="30" /></td>
                </tr>
                <tr>
                <td align="right"   ><?php echo $this->_tpl_vars['lg']['code']; ?>
 :</td>
                <td><input name="code" type="text" size="4" maxlength="4" /> <img src="inc/php_inc_code.php" align="absmiddle" style="cursor:pointer" onclick="this.src='inc/php_inc_code.php?r=' + Math.random()" /></td>
              </tr>
                <tr>
                  <td  align="right">&nbsp;</td>
                  <td><input  class="inputButton" onclick="return CheckForm()" type="submit" value="<?php echo $this->_tpl_vars['lg']['submit']; ?>
" /></td>
                </tr>
              </form>
            </table>
</fieldset>

            <script language="JavaScript" type="text/javascript">

  function CheckForm()
  { 
if(!CheckIsNull("formadd","name","<?php echo $this->_tpl_vars['lg']['msg_your_email_null']; ?>
")) return false;
if(!CheckIsEmail("formadd","name","<?php echo $this->_tpl_vars['lg']['msg_email_error']; ?>
")) return false;
if(!CheckIsNull("formadd","code","<?php echo $this->_tpl_vars['lg']['msg_code_null']; ?>
")) return false;
}
            </script>
<?php elseif ($this->_tpl_vars['action'] == 'step_3'): ?>
<div style="background:url(../pic/checkmail_right.jpg) no-repeat center left; font-size:16px; height:50px; line-height:50px; font-weight:bold; padding-left:40px"><?php echo $this->_tpl_vars['lg']['checkyouremail']; ?>
</div>
<div style="line-height:22px"><?php echo $this->_tpl_vars['lg']['checkyouremail_content']; ?>
</div>
<?php endif; ?>
</div>