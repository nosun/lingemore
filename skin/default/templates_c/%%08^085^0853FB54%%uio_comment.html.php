<?php /* Smarty version 2.6.26, created on 2012-10-11 17:48:17
         compiled from uio_comment.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
 <link href="../pic/rating_star.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="../pic/rating_star.js"></script> 
<div class="main_ct">
<?php $_from = $this->_tpl_vars['rs_comment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
			 <div class="comment_item">
             <div class="rating_div"><img height="11" src="../pic/star-<?php echo $this->_tpl_vars['rows']['rating']; ?>
.gif" /></div>
             <div>
             <div class="comment_left"><div><span class="gray">By</span> <span class="username"><?php echo $this->_tpl_vars['rows']['username']; ?>
</span></div><div class="gray" style="padding-top:3px"><?php echo $this->_tpl_vars['rows']['addtime']; ?>
</div><img vspace="5" width="16" height="11" src="http://img01.open.35zh.com/cgi-bin/?do=iptocountry&type=3&ip=<?php echo $this->_tpl_vars['rows']['ip']; ?>
" align="absmiddle" hspace="2">
</div>
             <div  class="comment_content"><?php echo $this->_tpl_vars['rows']['content']; ?>

             <?php if ($this->_tpl_vars['rows']['state'] == 1): ?>
                    <div class="servicereply">Service's Reply</div>
                    <div class="servicereplycontent"><?php echo $this->_tpl_vars['rows']['reply']; ?>
</div><?php endif; ?>
             </div><div class="clear"></div></div></div>
	<?php endforeach; endif; unset($_from); ?>
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_norewritepage.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   <div class="clear"></div>
   <table  border="0" cellspacing="0" cellpadding="0" style="display:none;">
  <tr>
    <td style=" font-size:18px; height:27px; font-weight:bold; color:#205194"><?php echo $this->_tpl_vars['lg']['write_a_review']; ?>
:</td>
  </tr><tr>
    <td class="linh">
	<table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="linh" style="padding-top:20px; padding-left:20px;"><?php echo $this->_tpl_vars['lg']['comment_tips']; ?>
</td>
  </tr>
  <tr>
    <td>
	<table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="240" align="center"><img src="../pic/write_a_review.jpg" /></td>
    <td valign="top"><table border="0" cellpadding="0" cellspacing="5">
            <form name="reginfo" enctype="multipart/form-data" onsubmit="return CheckForm()" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=add_message_save" >
                <tr>
                  <td colspan="2"><?php echo $this->_tpl_vars['lg']['indicates_required_fields']; ?>
 <span class="red">*</span></td>
                  </tr>
                <tr>
                  <td><?php echo $this->_tpl_vars['lg']['rating']; ?>
:</td>
                  <td>
                  <input name="rating" value="0" id="rating_simple1" type="hidden" />
                  </td>
                </tr>
                <tr>
                <td width="130"><?php echo $this->_tpl_vars['lg']['username']; ?>
 : <span class="red">*	</span></td>
                <td width="300">
                  <input name="username" type="text" value="<?php echo $this->_tpl_vars['user']['firstname']; ?>
"  class="input001" maxlength="100" />
                  			  
                  <input name="userid" type="hidden" id="userid" value="<?php echo $this->_tpl_vars['userid']; ?>
" />
                  <input name="cid" type="hidden" id="cid" value="1" />
                  <input name="pid" type="hidden" id="pid" value="<?php echo $this->_tpl_vars['pid']; ?>
" /></td>
              </tr>
              <tr>
                <td   ><?php echo $this->_tpl_vars['lg']['youremail']; ?>
: <span class="red">*	</span></td>
                <td><input name="contact0"  value="<?php echo $this->_tpl_vars['user']['name']; ?>
"  type="text"  class="input001" maxlength="100"></td>
              </tr>
              
              <tr style="display:none;">
                <td   ><?php echo $this->_tpl_vars['lg']['review_title']; ?>
 : <span class="red">*	</span></td>
                <td><input name="name"  type="hidden" id="name" value="Review:<?php echo $this->_tpl_vars['pname']; ?>
"  class="input002" maxlength="100"></td>
</tr>
             
              <tr>
                <td colspan="2"   ><textarea name="content"  class="input003" style="width:370px" id="content"></textarea></td>
                </tr> 
			   
			   <tr>
			  <?php if ($this->_tpl_vars['config'][43] != ""): ?>
			  
                <td   ><?php echo $this->_tpl_vars['lg']['code']; ?>
:</td>
                <td><input name="code" type="text" size="4" maxlength="4" /> <img src="<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php" align="absmiddle" style="cursor:pointer" onclick="this.src='<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php?r=' + Math.random()" /></td>
              </tr>
			  <?php endif; ?>
              <tr>
                <td   >&nbsp;</td>
                <td><input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lg']['submit']; ?>
"  ></td>
              </tr>
            </form>
          </table></td>
  </tr>
 
</table>

	</td>
  </tr>
</table>

	</td>
  </tr>
</table>
<script language="javascript" type="text/javascript">
  function CheckForm()
  { 
if(!CheckIsNull("reginfo","username","<?php echo $this->_tpl_vars['lg']['msg_username_null']; ?>
")) 
	return false;
if(!CheckIsNull("reginfo","contact0","<?php echo $this->_tpl_vars['lg']['msg_email_null']; ?>
")) return false;
if(!CheckIsEmail("reginfo","contact0","<?php echo $this->_tpl_vars['lg']['msg_email_error']; ?>
")) return false;
if(!CheckIsNull("reginfo","content","<?php echo $this->_tpl_vars['lg']['msg_content_null']; ?>
")) return false;
 <?php if ($this->_tpl_vars['config'][43] != ""): ?> if(!CheckIsNull("reginfo","code","<?php echo $this->_tpl_vars['lg']['msg_code_null']; ?>
")) return false; <?php endif; ?>
}
  </script>	  
<script language="javascript" type="text/javascript">
            $(function() {
                $("#rating_simple1").webwidget_rating_sex({
                    rating_star_length: '5',
                    rating_initial_value: '3',
                    rating_function_name: '',//this is function name for click
                    directory: '../pic/'
                });
            });
        </script>
</div>