<?php /* Smarty version 2.6.26, created on 2012-06-05 10:26:09
         compiled from uio_share.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div class="main_ct">
<?php if ($this->_tpl_vars['action'] == 'step_1'): ?>
		 <table border="0" cellpadding="0" cellspacing="10">
            <form name="reginfo" onsubmit="return CheckForm()" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
share.php?action=step_2" >

              <tr>
                <td align="right"   ><?php echo $this->_tpl_vars['lg']['username']; ?>
&nbsp;:</td>
                <td><input name="fromname" value="<?php echo $this->_tpl_vars['user']['firstname']; ?>
"  type="text"  class="input001" maxlength="100"></td>
              </tr>
              <tr>
                <td align="right"   ><?php echo $this->_tpl_vars['lg']['your_e_mail']; ?>
&nbsp;:</td>
                <td><input name="fromemail"  value="<?php echo $this->_tpl_vars['user']['name']; ?>
"  type="text"  class="input001" maxlength="100"><input name="pid" type="hidden" value="<?php echo $this->_tpl_vars['pid']; ?>
" />
                *</td>
              </tr>
              <tr>
                <td align="right"   ><?php echo $this->_tpl_vars['lg']['friends_name']; ?>
&nbsp;:</td>
                <td><input name="toname"    type="text"  class="input001" maxlength="100"></td>
              </tr>
              <tr>
                <td align="right"   ><?php echo $this->_tpl_vars['lg']['friends_e_mail']; ?>
&nbsp;:</td>
                <td><input name="toemail"  type="text"   class="input001" maxlength="100">
                    *                  </td>
              </tr>
             
              <tr>
                <td align="right"   ><?php echo $this->_tpl_vars['lg']['content']; ?>
&nbsp;:</td>
                <td><textarea name="content"  class="input003" id="content"></textarea>
                *</td>
              </tr> 
			  <?php if ($this->_tpl_vars['config'][43] != ""): ?>
			   <tr>
                <td align="right"   ><?php echo $this->_tpl_vars['lg']['code']; ?>
:</td>
                <td><input name="code" type="text" size="4" maxlength="4" /> <img src="inc/php_inc_code.php" align="absmiddle" style="cursor:pointer" onclick="this.src='inc/php_inc_code.php?r=' + Math.random()" /></td>
              </tr>
			  <?php endif; ?>
              <tr>
                <td   >&nbsp;</td>
                <td><input class="inputButton" type="submit" name="submit" value="<?php echo $this->_tpl_vars['lg']['submit']; ?>
"  ></td>
              </tr>
            </form>
  </table>

<script language="javascript" type="text/javascript">
  function CheckForm()
  { 
if(!CheckIsNull("reginfo","fromemail","<?php echo $this->_tpl_vars['lg']['msg_your_email_null']; ?>
")) return false;
if(!CheckIsEmail("reginfo","fromemail","<?php echo $this->_tpl_vars['lg']['msg_email_error']; ?>
")) return false;
if(!CheckIsNull("reginfo","toemail","<?php echo $this->_tpl_vars['lg']['msg_friends_email_null']; ?>
")) return false;
if(!CheckIsEmail("reginfo","toemail","<?php echo $this->_tpl_vars['lg']['msg_friends_email_error']; ?>
")) return false;
if(!CheckIsNull("reginfo","content","<?php echo $this->_tpl_vars['lg']['msg_content_null']; ?>
")) return false;
 <?php if ($this->_tpl_vars['config'][43] != ""): ?> if(!CheckIsNull("reginfo","code","<?php echo $this->_tpl_vars['lg']['msg_code_null']; ?>
")) return false; <?php endif; ?>
}
  </script>	 
  <?php elseif ($this->_tpl_vars['action'] == 'step_3'): ?>
<div style="background:url(../pic/checkmail_right.jpg) no-repeat center left; font-size:16px; height:50px; line-height:50px; font-weight:bold; padding-left:40px"><?php echo $this->_tpl_vars['lg']['shareproductsuccess']; ?>
</div>
<div style="line-height:22px"><?php echo $this->_tpl_vars['lg']['shareproductcontent']; ?>
</div>
<?php endif; ?>
</div>