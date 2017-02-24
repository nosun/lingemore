<?php /* Smarty version 2.6.26, created on 2012-10-19 08:51:02
         compiled from module_product_comment.html */ ?>

 <?php if ($this->_tpl_vars['rs_comment']): ?>
 <div style="width:100%;">
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

             <?php if ($this->_tpl_vars['rows']['state'] == 1 && $this->_tpl_vars['rows']['reply'] != ""): ?>
                    <div class="servicereply" >Service's Reply</div>
                    <div class="servicereplycontent" ><?php echo $this->_tpl_vars['rows']['reply']; ?>
</div><?php endif; ?>
             </div><div class="clear"></div></div></div>
	<?php endforeach; endif; unset($_from); ?>
   <div style="text-align:right; height:25px; line-height:25px"><a href="<?php echo $this->_tpl_vars['folder']; ?>
comment.php?cid=1&pid=<?php echo $this->_tpl_vars['p']['id']; ?>
">More&gt;&gt;</a></div>
</div>
<?php endif; ?>
<link href="../pic/rating_star.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../pic/rating_star.js"></script> 
<table  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style=" font-size:16px; height:27px; font-weight:bold; text-indent:20px; color:#AB0000; font-family:Georgia, 'Times New Roman', Times, serif"><?php echo $this->_tpl_vars['lg']['write_a_review']; ?>
:</td>
  </tr><tr>
    <td class="linh">
	<table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table border="0" cellpadding="0" cellspacing="10">
            <form name="reginfo" enctype="multipart/form-data" onsubmit="return CheckForm()" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=add_message_save" >
                <tr>
                  <td width="60"><?php echo $this->_tpl_vars['lg']['rating']; ?>
:</td>
                  <td align="left">
                  <input name="rating" value="0" id="rating_simple1" type="hidden" />
                  </td>
                </tr>
              <tr>
                <td  colspan="2" >Name : </td>
                </tr>
              <tr style="">
                <td colspan="2"   >
                  <input name="username" type="text" value="<?php echo $this->_tpl_vars['user']['firstname']; ?>
"  class="review_input" maxlength="100" />
                  			  
                  <input name="userid" type="hidden" id="userid" value="<?php echo $this->_tpl_vars['userid']; ?>
" />
                  <input name="cid" type="hidden" id="cid" value="1" />
                  <input name="pid" type="hidden" id="pid" value="<?php echo $this->_tpl_vars['p']['id']; ?>
" /></td>
              </tr>
              <tr style="display:none;">
                <td colspan="2"   ><?php echo $this->_tpl_vars['lg']['youremail']; ?>
: <span class="red">*	</span></td>
                </tr>
              <tr style="display:none;">
                <td colspan="2"   >
                <input name="contact0"  value="<?php echo $this->_tpl_vars['user']['name']; ?>
"  type="text"  class="input001" maxlength="100"></td>
              </tr>
              
              <tr style="display:none;">
                <td  colspan="2" ><?php echo $this->_tpl_vars['lg']['review_title']; ?>
 : </td>
                </tr>
              <tr style="display:none;">
                <td colspan="2"   >
                <input name="name"  type="text" id="name" value="Review:<?php echo $this->_tpl_vars['p']['name']; ?>
"  class="review_input" maxlength="100"></td>
</tr>
             
              <tr>
                <td  colspan="2" ><?php echo $this->_tpl_vars['lg']['review_content']; ?>
 :</td>
                </tr>
              <tr>
                <td colspan="2"   ><textarea name="content"  class="review_content" id="content"></textarea></td>
                </tr> 
              <tr>
                <td  colspan="2" >
                Remaining characters:3000 Please don't exceed 3,000 characters.
                </td>
                </tr>
              <?php if (1 == 2): ?>
              <tr>
                <td  colspan="2" >
                <input name="pic"  type="file" > 
                </td>
                </tr>
              <tr>
                <td  colspan="2" >
                <input name="pic1"  type="file" > 
                </td>
                </tr>
              <tr>
                <td  colspan="2" >
                Please only provide JPG files. Individual photo size cannot exceed 2MB
                </td>
                </tr>
			   <?php endif; ?>
			   <tr>
			  <?php if ($this->_tpl_vars['config'][43] != ""): ?>
			  
                <td   ><?php echo $this->_tpl_vars['lg']['code']; ?>
:</td>
                <td align="left"><input name="code" type="text" size="4" maxlength="4" /> <img src="<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php" align="absmiddle" style="cursor:pointer" onclick="this.src='<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php?r=' + Math.random()" /></td>
              </tr>
			  <?php endif; ?>
              <tr>
                <td   ><input type="image" src="../pic/submit_review.jpg" /></td>
                <td><input type="reset" value="Cancel" style="background:none; border:none; text-decoration:underline;" /></td>
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
if(!CheckIsNull("reginfo","username","Sorry, Name cannot be left blank!!!")) 
	return false;
//if(!CheckIsNull("reginfo","contact0","<?php echo $this->_tpl_vars['lg']['msg_email_null']; ?>
")) return false;
//if(!CheckIsEmail("reginfo","contact0","<?php echo $this->_tpl_vars['lg']['msg_email_error']; ?>
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
                    rating_initial_value: '0',
                    rating_function_name: '',//this is function name for click
                    directory: '../pic/'
                });
            });
        </script>