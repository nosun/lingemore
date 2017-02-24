<?php /* Smarty version 2.6.26, created on 2012-05-11 15:53:50
         compiled from uio_feedback.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div class="main_ct">
         <div class="feedbacktopbox">
             <div class="feedbacktopbox_con">
                <?php echo $this->_tpl_vars['content_98']; ?>

             </div>
         </div>


        <form name="reginfo" onsubmit="return CheckForm()" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=add_message_save" >
         <div class="feedbackformbox">
		 <table border="0" cellpadding="0" cellspacing="10">
                <tr>
                  <td width="150" align="right" class="weight"><span class="feedbacktitle"><?php echo $this->_tpl_vars['lg']['contactinfo']; ?>
&nbsp;&nbsp;:</span></td>
                  <td></td>
                </tr>
                <tr>
                <td  align="right" class="weight"><?php echo $this->_tpl_vars['lg']['username']; ?>
&nbsp;&nbsp;:</td>
                <td>
                  <input name="username" value="<?php echo $this->_tpl_vars['user']['lastname']; ?>
 <?php echo $this->_tpl_vars['user']['firstname']; ?>
" type="text"   class="contactinput" maxlength="100" />
                  *				  
                  <input name="userid" type="hidden" id="userid" value="<?php echo $this->_tpl_vars['userid']; ?>
" />
                  <input name="cid" type="hidden" id="cid" value="3" />
                  <input name="pid" type="hidden" id="pid" value="0" /></td>
              </tr>
              <tr>
                <td align="right"   class="weight"><?php echo $this->_tpl_vars['lg']['email']; ?>
&nbsp;&nbsp;:</td>
                <td><input name="contact0"  value=""  type="text"  class="contactinput" maxlength="100">
                *</td>
              </tr>
              <tr>
                <td align="right"  class="weight" >Msn&nbsp;&nbsp;:</td>
                <td><input name="contact1" value="<?php echo $this->_tpl_vars['user']['msn']; ?>
"  type="text"   class="contactinput" maxlength="100">               </td>
              </tr>
                <tr>
                  <td width="130" align="right"><span class="feedbacktitle"><?php echo $this->_tpl_vars['lg']['feedbackinfo']; ?>
:</span></td>
                  <td></td>
                </tr>
              <tr>
                <td align="right" class="weight"  ><?php echo $this->_tpl_vars['lg']['title']; ?>
&nbsp;&nbsp;:</td>
                <td><input name="name"  type="text" id="name"  class="feedbackinput" maxlength="100">
                    *                  </td>
              </tr>
             
              <tr>
                <td align="right" valign="top"  class="weight" ><?php echo $this->_tpl_vars['lg']['content']; ?>
&nbsp;&nbsp;:</td>
                <td><textarea name="content"  class="feedbacktextarea" id="content"></textarea>
                *</td>
              </tr> 
			  <?php if ($this->_tpl_vars['config'][43] != ""): ?>
			   <tr>
                <td align="right" class="weight" ><?php echo $this->_tpl_vars['lg']['code']; ?>
&nbsp;&nbsp;:</td>
                <td><input name="code" type="text" class="feedbackCode" maxlength="4" /> <img src="inc/php_inc_code.php" align="absmiddle" style="cursor:pointer" onclick="this.src='inc/php_inc_code.php?r=' + Math.random()" /></td>
              </tr>
			  <?php endif; ?>
          </table>
         </div>
         <div class="feedbacksubmitbox">
            <div class="feedbacksubmitbox_left"><?php echo $this->_tpl_vars['lg']['feedbacknotice']; ?>
</div>
            <div class="feedbacksubmitbox_right"><input class="inputButton" type="submit" name="submit" value="<?php echo $this->_tpl_vars['lg']['submit']; ?>
"  ></div>
            <div class="clear1"></div>
         </div>
         </form>
<script language="javascript" type="text/javascript">
  function CheckForm()
  { 
if(!CheckIsNull("reginfo","username","<?php echo $this->_tpl_vars['lg']['msg_username_null']; ?>
")) 
	return false;
if(!CheckIsEmail("reginfo","contact0","<?php echo $this->_tpl_vars['lg']['msg_email_error']; ?>
")) return false;
if(!CheckIsNull("reginfo","name","<?php echo $this->_tpl_vars['lg']['msg_title_null']; ?>
")) return false;
if(!CheckIsNull("reginfo","content","<?php echo $this->_tpl_vars['lg']['msg_content_null']; ?>
")) return false;
 <?php if ($this->_tpl_vars['config'][43] != ""): ?> if(!CheckIsNull("reginfo","code","<?php echo $this->_tpl_vars['lg']['msg_code_null']; ?>
")) return false; <?php endif; ?>
}
  </script>	  
</div>