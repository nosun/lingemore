<?php /* Smarty version 2.6.26, created on 2012-10-17 14:14:09
         compiled from uio_register1.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<link type="text/css" href="../aaaaa/demo/css/screen.css" rel="stylesheet">
<div class="main_ct">
	<div style="width:350px; overflow:hidden; float:left">
    <td id="td_login" width="40%"  bgcolor="#FFFFFF" valign="top"><div style="background-color:#F9F9F9; border:1px #DBDBDB solid; padding:15px; margin-right:10px">
	<div style=" color:#D15400; font-weight:bold; font-size:18px; padding-left:45px"><?php echo $this->_tpl_vars['lg']['login']; ?>
</div><table width="100%" border="0" cellpadding="0" cellspacing="10" >
  <form  name="formlogin"  onsubmit="return CheckForm()" enctype="application/x-www-form-urlencoded" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=login&redirectURL=<?php echo $this->_tpl_vars['page_redirectURL']; ?>
">
    <tr>
      <td width="100" align="right"><?php echo $this->_tpl_vars['lg']['email']; ?>
&nbsp;&nbsp;:</td>
      <td><input name="name" type="text" class="input001" style="width:160px" maxlength="100" />      </td>
    </tr>
    <tr>
      <td align="right"><?php echo $this->_tpl_vars['lg']['password']; ?>
&nbsp;&nbsp;:</td>
      <td><input name="pwd" type="password"  class="input001" style="width:160px" maxlength="20" /></td>
    </tr>
   
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" class="profilebutton"  name="Submit" value="<?php echo $this->_tpl_vars['lg']['login']; ?>
" /><br />
<a href="get-pwd.php"><span  style="padding-bottom:3px"><?php echo $this->_tpl_vars['lg']['porget_password']; ?>
</span></a></td>
    </tr> 
	<?php if ($this->_tpl_vars['items'] != 0): ?>

	  <?php endif; ?>
  </form>
</table>
    </div></td>
    </div>
    <div style="width:580px; overflow:hidden; float:right">
    <form id="reginfo"  method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=register_save&redirectURL=<?php echo $this->_tpl_vars['page_redirectURL']; ?>
">
    <td  id="td_register"  ><div style=" color:#D15400; border-bottom:2px #ED8C1A solid ;font-weight:bold; font-size:18px; padding-bottom:4px">Registration</div><table width="100%" border="0" cellpadding="0" cellspacing="10">
<tr>
              <td width="120" align="right" valign="top"><div style="margin-top:5px"><?php echo $this->_tpl_vars['lg']['email']; ?>
&nbsp;&nbsp;:</div></td>
<td><input name="username" type="text" id="username"  class="sinput001" maxlength="100">  <br />
<span class="registerspan"><?php echo $this->_tpl_vars['lg']['username_format_tips']; ?>
</span>
      
        <div id="divexists" style="display:none; color:#FF0000"><?php echo $this->_tpl_vars['lg']['msg_user_exists']; ?>
</div>
		<div id="divnoexists" style="display:none; color:#00FF00"><?php echo $this->_tpl_vars['lg']['msg_user_ok']; ?>
</div>
</td>
         </tr>
              <tr>
                <td align="right" valign="top"><div style="margin-top:5px"><?php echo $this->_tpl_vars['lg']['password']; ?>
&nbsp;&nbsp;:</div></td>
                <td><input name="pwd" type="password" id="pwd"  class="sinput001" maxlength="20"> <br />
<span class="registerspan"><?php echo $this->_tpl_vars['lg']['password_tips']; ?>
</span>
              </td>
              </tr>
              <tr>
                <td align="right"><?php echo $this->_tpl_vars['lg']['retype_password']; ?>
&nbsp;&nbsp;:</td>
                <td><input name="pwd1" type="password" id="pwd1"  class="sinput001" maxlength="20"> 
               </td>
              </tr>
              <tr>
                <td align="right"><?php echo $this->_tpl_vars['lg']['question']; ?>
&nbsp;&nbsp;:</td>
                <td><input name="question" id="cquestion" type="text"    class="sinput001" maxlength="20"> 
              </td>
              </tr>
              <tr>
                <td align="right"><?php echo $this->_tpl_vars['lg']['answer']; ?>
&nbsp;&nbsp;:</td>
                <td><input name="answer" id="canswer" type="text"    class="sinput001" maxlength="20">

              </td>
              </tr>
			   <tr style="display:none;" >
                  <td align="right">Choose Server:</td>
                  <td><?php $_from = $this->_tpl_vars['rs_server']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['rows']):
?>
                <input <?php if ($this->_tpl_vars['index'] == 0): ?>checked="checked"<?php endif; ?>  name="server" id="server"  value="<?php echo $this->_tpl_vars['rows']['id']; ?>
" type="radio" /> <?php echo $this->_tpl_vars['rows']['nickname']; ?>
 <br />
                  
                  <?php endforeach; endif; unset($_from); ?><br />
            will provide professional services for you</td>
                </tr>
			  
			    <?php if ($this->_tpl_vars['config'][41] != ""): ?> <tr  >
                <td align="right"><?php echo $this->_tpl_vars['lg']['code']; ?>
&nbsp;&nbsp;:</td>
                <td>
				<img id="registercode" align="absmiddle" style="cursor:pointer" onclick="this.src='<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php?r=' + Math.random()"  /> &nbsp; <input name="code" id="ccode" type="text" size="8" maxlength="4" /> </td>
    </tr>
<?php endif; ?>
    <tr >
    <td align="left">&nbsp;</td>
    <td><input type="image" src="../pic/reg_ok.gif"  name="uiosubmit"  value="<?php echo $this->_tpl_vars['lg']['reg']; ?>
" /><input name="newsletter" type="hidden" value="yes" /></td>
  </tr>
    </table></td>
    </form>       
    </div>


<script language="JavaScript" type="text/javascript">
document.getElementById("registercode").src = '<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php?r=' + Math.random() ;

function CheckForm()
{
	if(!CheckIsEmail("formlogin","name","<?php echo $this->_tpl_vars['lg']['msg_email_error']; ?>
")) return false;
	if(!CheckIsNull("formlogin","pwd","<?php echo $this->_tpl_vars['lg']['msg_pwd_null']; ?>
")) return false;
<?php if ($this->_tpl_vars['config'][42] != ""): ?>	if(!CheckIsNull("formlogin","code","<?php echo $this->_tpl_vars['lg']['code']; ?>
")) return false; <?php endif; ?>
}
</script>
</div>

<script type="text/javascript" src="../pic/jquery.validate.min.js"></script>
<script type="text/javascript">


 $(document).ready(function(){
	$("#reginfo").validate({
			rules: {
				username: {
					required: true,
					minlength: 5 ,
					email: true ,
					remote: {
						type: "post",
						url: "service/serviceForCheckRegister.php?action=check",
						data: {
							name: function() {
								return escape($("#username").val());
							}
						},
					dataType: "html",
					dataFilter: function(data, type) {
							if (data == "true")
								return true;
							else
								return false;
						   }
					}
				},
				pwd: {
					required: true,
					minlength: 5
				},
				pwd1: {
					required: true,
					minlength: 5,
					equalTo: "#pwd"
				},
				question: "required",
				answer: "required",
				server: "required",
				code: "required"
			},
			messages: {
				username: {
					required: "<?php echo $this->_tpl_vars['lg']['pl_enter_email']; ?>
",
					minlength: "<?php echo $this->_tpl_vars['lg']['pl_user_length']; ?>
",
					email: "<?php echo $this->_tpl_vars['lg']['pl_enter_valid_email']; ?>
",
					remote: {
						remote: "<?php echo $this->_tpl_vars['lg']['pl_user_used']; ?>
"
						},
					dataType: "",
					dataFilter: ""
				},
				pwd: {
					required: "<?php echo $this->_tpl_vars['lg']['pl_enter_password']; ?>
",
					minlength: "<?php echo $this->_tpl_vars['lg']['pl_password_lenght']; ?>
"
				},
				pwd1: {
					required: "<?php echo $this->_tpl_vars['lg']['pl_enter_password']; ?>
",
					minlength: "<?php echo $this->_tpl_vars['lg']['pl_password_lenght']; ?>
",
					equalTo: "<?php echo $this->_tpl_vars['lg']['pl_enter_samepassword']; ?>
"
				},
				question: "<?php echo $this->_tpl_vars['lg']['pl_enter_question']; ?>
",
				answer: "<?php echo $this->_tpl_vars['lg']['pl_enter_answer']; ?>
",
				server: "Please choose server",
				code: "<?php echo $this->_tpl_vars['lg']['pl_enter_code']; ?>
"
			}
		});
	});

  </script>
<style type="text/css">
#reginfo {}
#reginfo input.error{ border:1px #FF0000 dotted;background-color:#FFFBDC;height:21px; line-height:21px; }
#reginfo input.valid{ }
#reginfo label.error {
	margin-left: 10px;
	color: red; font-size:12px;
	font-style: italic;
	width: auto;
	display: inline;
	height:16px
}
.registerspan{ color:#999999; font-size:11px; padding-top:2px }
</style>