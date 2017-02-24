<?php /* Smarty version 2.6.26, created on 2011-10-10 10:55:55
         compiled from uio_get_pwd.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div class="main_ct">
<?php if ($this->_tpl_vars['action'] == 'step_1'): ?>
 <fieldset>
<legend><?php echo $this->_tpl_vars['lg']['pwd_step1_title']; ?>
</legend>
            <table border="0" cellspacing="10">
              <form action="<?php echo $this->_tpl_vars['folder']; ?>
get-pwd.php?action=step_2" method="post" name="formadd" >
                <tr>
                  <td  width="130" align="right"><?php echo $this->_tpl_vars['lg']['your_user_id']; ?>
:</td>
                  <td><input name="name" type="text"  class="input001" id="userid" maxlength="30" /></td>
                </tr>
                <tr>
                  <td  align="right">&nbsp;</td>
                  <td><input  onclick="return CheckForm()"  class="profilebutton" type="submit" value="<?php echo $this->_tpl_vars['lg']['submit']; ?>
" /></td>
                </tr>
              </form>
  </table>
</fieldset>

            <script language="JavaScript" type="text/javascript">

  function CheckForm()
  { 
if(!CheckIsNull("formadd","name","<?php echo $this->_tpl_vars['lg']['msg_username_null']; ?>
")) return false;
}
            </script>
<?php elseif ($this->_tpl_vars['action'] == 'step_2'): ?>
<fieldset>
<legend><?php echo $this->_tpl_vars['lg']['pwd_step2_title']; ?>
</legend>
            <table border="0" cellspacing="10">
              <form action="<?php echo $this->_tpl_vars['folder']; ?>
get-pwd.php?action=step_3" method="post" name="formadd"   >
                <tr>
                  <td width="130" align="right"    ><?php echo $this->_tpl_vars['lg']['question']; ?>
:</td>
                  <td><?php echo $this->_tpl_vars['rows']['question']; ?>
 <input type="hidden" name="name" value="<?php echo $this->_tpl_vars['rows']['name']; ?>
" /></td>
                </tr>
                <tr>
                  <td align="right"   ><?php echo $this->_tpl_vars['lg']['answer']; ?>
:</td>
                  <td><input type="text"  class="input001" name="answer" /></td>
                </tr>
                <tr>
                  <td  ></td>
                  <td><input onclick="return CheckForm()" type="submit" class="profilebutton"  name="Submitgetpass1"   value="<?php echo $this->_tpl_vars['lg']['submit']; ?>
" /></td>
                </tr>
              </form>
  </table>
</fieldset>
           
            <script language="JavaScript" type="text/javascript">

function CheckForm()
  { 
if(!CheckIsNull("formadd","answer","<?php echo $this->_tpl_vars['lg']['msg_answer_null']; ?>
")) return false;
}
            </script>
<?php elseif ($this->_tpl_vars['action'] == 'step_3'): ?>
 <fieldset>
<legend><?php echo $this->_tpl_vars['lg']['pwd_step3_title']; ?>
</legend>
           <table border="0" cellspacing="10">
              <form action="<?php echo $this->_tpl_vars['folder']; ?>
get-pwd.php?action=step_4" method="post" name="formadd" >
                <tr>
                  <td width="140" align="right" ><?php echo $this->_tpl_vars['lg']['new_password']; ?>
 :</td>
                  <td><input name="pwd" type="password"  class="input001"  maxlength="30" />
                    <input name="name" type="hidden" value="<?php echo $this->_tpl_vars['rows']['name']; ?>
" />
                    <input name="answer" type="hidden" value="<?php echo $this->_tpl_vars['rows']['answer']; ?>
" /></td>
                </tr>
                <tr>
                  <td align="right"><?php echo $this->_tpl_vars['lg']['confirm_password']; ?>
:</td>
                  <td><input name="pwd1" type="password" id="userid" maxlength="30" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><input  onclick="return CheckForm()" class="profilebutton" type="submit" value="<?php echo $this->_tpl_vars['lg']['submit']; ?>
" /></td>
                </tr>
              </form>
  </table>
</fieldset>	
 
            <script language="JavaScript" type="text/javascript">
function CheckForm()
  { 
if(!CheckIsNull("formadd","pwd","<?php echo $this->_tpl_vars['lg']['msg_pwd_null']; ?>
")) return false;
if(!CheckIsNull("formadd","pwd1","<?php echo $this->_tpl_vars['lg']['msg_confirm_password_null']; ?>
")) return false;
if(!CheckIsSame("formadd","pwd","pwd1","password","confirm password","<?php echo $this->_tpl_vars['lg']['msg_passwordsame_null']; ?>
")) return false;
}
</script>
<?php endif; ?>
</div>