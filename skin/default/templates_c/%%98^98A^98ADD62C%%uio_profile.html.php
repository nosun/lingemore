<?php /* Smarty version 2.6.26, created on 2014-04-10 14:34:18
         compiled from uio_profile.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div class="main_ct3" id="main_profile">

<?php if ($this->_tpl_vars['action'] == ""): ?>
<div class="profilemain" style="margin-bottom:8px">
<div style="font-size:14px; font-weight:bold"><?php echo $this->_tpl_vars['lg']['hi']; ?>
, <span class="red"><?php echo $this->_tpl_vars['user']['name']; ?>
</span> <?php echo $this->_tpl_vars['lg']['from']; ?>
 <img src="http://open.35zh.com/cgi-bin/?do=iptocountry&type=3&ip=<?php echo $this->_tpl_vars['user']['nowip']; ?>
" align="absmiddle" hspace="2"> , <?php echo $this->_tpl_vars['lg']['welcome_to_our_website']; ?>
! </div>

<div  style="font-size:12px; line-height:19px; margin-left:10px; margin-top:5px">
<?php if ($this->_tpl_vars['pc'] != 100): ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px; margin-bottom:4px">
  <tr>
    <td width="6"><img src="../pic/profile_complete_left.gif" height="38" /></td>
    <td style="padding-left:8px; padding-right:8px;border-top:1px #D1DDEB solid;border-bottom:1px #D1DDEB solid; background-color:#FFFFFF"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><span style="font-size:11px"><?php echo $this->_tpl_vars['lg']['profile_complete']; ?>
</span></td>
        </tr>
        <tr>
          <td><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div style="border:1px #A2B4DA solid; width:140px;height:8px; line-height:8px; font-size:0px"><div style="width:<?php echo $this->_tpl_vars['pc']; ?>
%; background-color:#A2B4DA;height:8px;"></div></div></td>
    <td><span style="font-size:11px; padding-left:5px"><strong>100%</strong></span></td>
  </tr>
</table>
</td>
        </tr>
      </table></td>
    <td width="130" align="center" style="border-top:1px #D1DDEB solid;border-bottom:1px #D1DDEB solid; background-color:#FFFFFF"><a class="red normalfont weight" href="profile.php?action=info_view"><?php echo $this->_tpl_vars['lg']['complete_my_profile']; ?>
</a></td>
    <td width="6"><img src="../pic/profile_complete_right.gif"  height="38" /></td>
  </tr>
</table>
<?php endif; ?>
<div>
<div style="height:20px"><img src="../pic/order-biao.gif" />&nbsp;&nbsp; <?php echo $this->_tpl_vars['lg']['pending']; ?>
 : <a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=0"><?php echo $this->_tpl_vars['sum_o'][0]; ?>
 <?php echo $this->_tpl_vars['lg']['orders_s']; ?>
</a></div>
<div style="height:20px"><img src="../pic/order-biao.gif" />&nbsp;&nbsp; <?php echo $this->_tpl_vars['lg']['unpaid']; ?>
  :   <a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=1"><?php echo $this->_tpl_vars['sum_o'][1]; ?>
 <?php echo $this->_tpl_vars['lg']['orders_s']; ?>
</a></div>
<div style="height:20px"><img src="../pic/order-biao.gif" />&nbsp;&nbsp; <?php echo $this->_tpl_vars['lg']['paid']; ?>
  :  <a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=2"><?php echo $this->_tpl_vars['sum_o'][2]; ?>
 <?php echo $this->_tpl_vars['lg']['orders_s']; ?>
</a></div>
<div style="height:20px"><img src="../pic/order-biao.gif" />&nbsp;&nbsp; <?php echo $this->_tpl_vars['lg']['processing']; ?>
  :  <a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=3"><?php echo $this->_tpl_vars['sum_o'][3]; ?>
 <?php echo $this->_tpl_vars['lg']['orders_s']; ?>
</a></div>
<div style="height:20px"><img src="../pic/order-biao.gif" />&nbsp;&nbsp; <?php echo $this->_tpl_vars['lg']['shipped']; ?>
  : <a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=4"><?php echo $this->_tpl_vars['sum_o'][4]; ?>
 <?php echo $this->_tpl_vars['lg']['orders_s']; ?>
</a></div>
<div  style="height:20px"><img src="../pic/order-biao.gif" />&nbsp;&nbsp; <?php echo $this->_tpl_vars['lg']['completed']; ?>
 : <a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=5"><?php echo $this->_tpl_vars['sum_o'][5]; ?>
 <?php echo $this->_tpl_vars['lg']['orders_s']; ?>
</a></div>
</div>
</div>
</div>
<div class="profilemain" style="margin-bottom:8px"><?php echo $this->_tpl_vars['lg']['profile_default_msg1']; ?>
</div>
<div style="margin-bottom:8px; font-size:12px" class="red weight"><?php echo $this->_tpl_vars['lg']['my_recent_order']; ?>
 :</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable">
  <tr class="profiletabletitle">
    <td height="28" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['order_no']; ?>
 </td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="160" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['tracking_no']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="80" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['state']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="130" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['creation_date']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="100" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['action']; ?>
</td>
  </tr>
  <?php $_from = $this->_tpl_vars['rs_ro']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
  <tr class="profiletablelisttr">
    <td class="pad5px" height="32"><?php echo $this->_tpl_vars['rows']['itemno']; ?>
</td>
    <td></td>
    <td ><?php echo $this->_tpl_vars['rows']['shipno']; ?>
&nbsp;</td>
    <td></td>
    <td ><span class="red"><?php echo $this->_tpl_vars['arrstate'][$this->_tpl_vars['rows']['state']]; ?>
</span></td>
    <td></td>
    <td ><?php echo $this->_tpl_vars['rows']['addtime']; ?>
</td>
    <td ></td>
	<td><input type="button" onclick="javascript:location.href='profile.php?action=order_view&itemno=<?php echo $this->_tpl_vars['rows']['itemno']; ?>
'" class="profilebutton"  value="<?php echo $this->_tpl_vars['lg']['profile_detail']; ?>
" /></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>
<div style="margin-bottom:8px;margin-top:8px; font-size:12px" class="red weight"><?php echo $this->_tpl_vars['lg']['system_information']; ?>
:</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable">
  <tr class="profiletabletitle">
    <td height="28" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['subject']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="80" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['to']; ?>
</td>
   <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="130" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['creation_date']; ?>
</td>
	 <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="100" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['action']; ?>
</td>
  </tr>


			<?php $_from = $this->_tpl_vars['rs_mm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
    <tr class="profiletablelisttr">
	
              <td class="pad5px" height="32"><?php echo $this->_tpl_vars['rows']['name']; ?>
</td>
              <td></td>
			  <td ><?php echo $this->_tpl_vars['lg']['all_users']; ?>
</td>
              <td></td>
			  <td ><?php echo $this->_tpl_vars['rows']['addtime']; ?>
</td>
			   <td></td>
			  <td ><input type="button" onclick="javascript:location.href='profile.php?action=message_view&id=<?php echo $this->_tpl_vars['rows']['id']; ?>
'" class="profilebutton"  value="<?php echo $this->_tpl_vars['lg']['profile_detail']; ?>
" /></td>
    </tr>
           <?php endforeach; endif; unset($_from); ?>
</table>
<?php elseif ($this->_tpl_vars['action'] == 'login'): ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    
    <td height="150" width="360" valign="top" style="">
	<div style="background-color:#F9F9F9; border:1px #DBDBDB solid; padding:15px">
	<div style=" color:#D15400; font-weight:bold; font-size:18px; padding-left:45px"><?php echo $this->_tpl_vars['lg']['login']; ?>
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="10" >
  <form  name="formlogin"  onsubmit="return CheckForm()" enctype="application/x-www-form-urlencoded" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=login">
    <tr>
      <td width="90" align="right"><?php echo $this->_tpl_vars['lg']['your_account']; ?>
 :</td>
      <td><input name="name" type="text" class="input001" style="width:160px" maxlength="100" />      </td>
    </tr>
    <tr>
      <td align="right"><?php echo $this->_tpl_vars['lg']['password']; ?>
:</td>
      <td><input name="pwd" type="password"  class="input001" style="width:160px" maxlength="20" /></td>
    </tr>
	<?php if ($this->_tpl_vars['config'][42] != ""): ?>
    <tr>
      <td align="right"><?php echo $this->_tpl_vars['lg']['code']; ?>
:</td>
      <td><input name="code" type="text" size="4" maxlength="4" /> <img src="<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php" align="absmiddle" style="cursor:pointer" onclick="this.src='<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php?r=' + Math.random()" /></td>
    </tr>
	<?php endif; ?>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" class="profilebutton"  name="Submit" value="Sign in" />&nbsp;<a href="get-pwd.php"><span  style="padding-bottom:3px"><?php echo $this->_tpl_vars['lg']['forget_password']; ?>
?</span></a></td>
    </tr>
  </form>
</table>
</div>

	</td>
	<td width="50%" valign="top">
<div style=" color:#D15400; border-bottom:2px #D15400 solid ;font-weight:bold; font-size:18px; padding-bottom:4px">New Customer</div>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td>By creating an account ,you will be able to shop faster, be up to   date on an orders status, and keep track of the orders you have previously made.<br />
        <br />
        <a href="<?php echo $this->_tpl_vars['folder']; ?>
register.php"><span class="weight">Creating an account &gt;&gt;</span></a></td>
  </tr>
  <tr>
    <td>Don't want to register an account? Just proceed with purchase. <br />
        <br />
        <a class="red" href="<?php echo $this->_tpl_vars['folder']; ?>
step.php?action=step_1"><span class="weight">Checkout As Guest &gt;&gt;</span></a></td>
  </tr>
</table>
</td>
  </tr>
</table>
<script language="javascript">
function CheckForm()
{
	if(!CheckIsNull("formlogin","name","Username")) return false;
	if(!CheckIsNull("formlogin","pwd","Password")) return false;
<?php if ($this->_tpl_vars['config'][42] != ""): ?>	if(!CheckIsNull("formlogin","code","code")) return false; <?php endif; ?>
}
</script>

<?php elseif ($this->_tpl_vars['action'] == 'account_view'): ?>
<div class="profiletableform" >
<form name="formdel" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=sec_edit_save">

<table width="100%" border="0" cellpadding="0" cellspacing="10">
 <tr>
    <td  width="250" align="right"     ><?php echo $this->_tpl_vars['lg']['Username']; ?>
&nbsp;&nbsp;: </td>
    <td  ><?php echo $this->_tpl_vars['username']; ?>
</td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['new_password']; ?>
&nbsp;&nbsp;: </td>
    <td  ><input name="pwd" type="password"  class="input001" id="tbContent" maxlength="20" /></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['retype_password']; ?>
&nbsp;&nbsp;: </td>
    <td  ><input name="pwd1" type="password"  class="input001" id="tbContent" maxlength="20" /></td>
  </tr>
  <tr>
    <td align="right" ><?php echo $this->_tpl_vars['lg']['question']; ?>
&nbsp;&nbsp;: </td>
    <td  ><input name="question" type="text"  class="input001" value="<?php echo $this->_tpl_vars['user']['question']; ?>
" maxlength="50" /></td>
  </tr>
   <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['answer']; ?>
&nbsp;&nbsp;: </td>
    <td  ><input  name="answer" type="text"  class="input001"  maxlength="50"   /></td>
  </tr>
  
  
  <tr>
    <td align="right" >&nbsp;</td>
    <td ><input type="submit" name="Submit42" class="profilebutton"   onclick="return CheckForm();" value="<?php echo $this->_tpl_vars['lg']['change']; ?>
" />
    <script>
function CheckForm()
  { 
if(!CheckIsNull("formdel","pwd","<?php echo $this->_tpl_vars['lg']['msg_password_null']; ?>
")) return false;
if(!CheckLength("formdel","pwd","pwd",6,20)) return false;
if(!CheckIsSame("formdel","pwd","pwd1","password","confirm password")) return false;
if(!CheckIsNull("formdel","question","<?php echo $this->_tpl_vars['lg']['msg_question_null']; ?>
")) return false;
}
</script></td>
  </tr>
</table>
</form>
</div>
<?php elseif ($this->_tpl_vars['action'] == 'info_view'): ?>

<div class="profiletableform">
<form name="formreg" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=info_edit_save">
<table width="100%" border="0" cellpadding="0" cellspacing="10">

   <tr>
                <td width="250" align="right"  ><?php echo $this->_tpl_vars['lg']['first_name']; ?>
&nbsp;&nbsp;:</td>
                <td ><input name="firstname" type="text" value="<?php echo $this->_tpl_vars['user']['firstname']; ?>
"  class="input001" maxlength="50" /></td>
    </tr>
              <tr>
                <td align="right"  ><?php echo $this->_tpl_vars['lg']['last_name']; ?>
&nbsp;&nbsp;:</td>
                <td ><input name="lastname" type="text" value="<?php echo $this->_tpl_vars['user']['lastname']; ?>
"  class="input001" maxlength="50" /></td>
              </tr>
              <tr>
                <td align="right"  ><?php echo $this->_tpl_vars['lg']['gender']; ?>
&nbsp;&nbsp;:</td>
                <td >
				<input name="sex"  type="radio" checked="checked" value="1" /><?php echo $this->_tpl_vars['lg']['male']; ?>
 <input type="radio" name="sex"  value="0" /><?php echo $this->_tpl_vars['lg']['female']; ?>
				</td>
				<script>
				EnterRadio("sex","<?php echo $this->_tpl_vars['user']['sex']; ?>
");
				</script>
              </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['email']; ?>
&nbsp;&nbsp;:</td>
    <td ><input  name="email" type="text"  class="input001" id="email"  value="<?php echo $this->_tpl_vars['user']['email']; ?>
" maxlength="100" /></td>
  </tr>
  <tr>
    <td align="right"   >MSN&nbsp;&nbsp;:</td>
    <td ><input  name="msn" type="text"  class="input001" id="msn"  value="<?php echo $this->_tpl_vars['user']['msn']; ?>
" maxlength="100" /></td>
  </tr>
  
   
 <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['address']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="street"  type="text"  class="input001" id="street" value="<?php echo $this->_tpl_vars['user']['street']; ?>
" maxlength="200" /></td>
    <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['zip']; ?>
&nbsp;&nbsp;:</td>
    <td ><input  name="postcode"  type="text"  class="input001" id="postcode" value="<?php echo $this->_tpl_vars['user']['postcode']; ?>
" maxlength="20" /></td>
  </tr>
	 <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['city']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="city" type="text"   class="input001" id="city" value="<?php echo $this->_tpl_vars['user']['city']; ?>
" maxlength="50" /></td>
  </tr> 
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['province']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="province"  type="text"  class="input001" id="province" value="<?php echo $this->_tpl_vars['user']['province']; ?>
" maxlength="50" /></td>
  </tr>
  
  <tr>
    <td align="right"><?php echo $this->_tpl_vars['lg']['country']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="country" id="country" type="hidden" value="" /><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_country.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script>
function setCountryValue(str)
{
	$("#country").val(str);
}
changeCountry('<?php echo $this->_tpl_vars['user']['country']; ?>
');
  </script></td>
  </tr>
  

  <tr>
    <td   >&nbsp;</td>
    <td ><input type="submit"  class="profilebutton"   name="Submit74" value="<?php echo $this->_tpl_vars['lg']['change']; ?>
" />
 </td>
  </tr>
</table>
</form>
</div>
<?php elseif ($this->_tpl_vars['action'] == 'newsletter_sub'): ?>

<div class="profiletableform">
<form name="formreg" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=newsletter_sub_save">
<table width="100%" border="0" cellpadding="0" cellspacing="10">

   <tr>
        <td width="250" align="right"  ><?php echo $this->_tpl_vars['lg']['subscribe']; ?>
&nbsp;&nbsp;:</td>
        <td >
	    <input name="newsletter_exists"  type="radio"  value="yes" /> <?php echo $this->_tpl_vars['lg']['yes']; ?>
&nbsp;&nbsp;&nbsp;<input type="radio" name="newsletter_exists"  value="no" /> <?php echo $this->_tpl_vars['lg']['no']; ?>
				</td>
		<script>
				EnterRadio("newsletter_exists","<?php echo $this->_tpl_vars['user']['newsletter_exists']; ?>
");
				</script>
        </tr>
  

  <tr>
    <td   >&nbsp;</td>
    <td ><input type="submit"  class="profilebutton"   name="Submit74" value="<?php echo $this->_tpl_vars['lg']['change']; ?>
" />
      </td>
  </tr>
</table>
</form>
</div>
<?php elseif ($this->_tpl_vars['action'] == 'favorite_list'): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable">
  <tr class="profiletabletitle">
    <td height="28" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['product']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['product_name']; ?>
 </td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['creation_date']; ?>
</td>
	 <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['action']; ?>
</td>
  </tr>
<?php $_from = $this->_tpl_vars['rs_f']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
 <tr class="profiletablelisttr">
    <td height="100"><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0"></a></td>
    <td></td>
	<td ><a target="_blank" href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><span class="mainc"><?php echo $this->_tpl_vars['rows']['pname']; ?>
</span></a>
</td>
    <td></td>
	<td><?php echo $this->_tpl_vars['rows']['addtime']; ?>
</td>
    <td></td>
	<td >
	<input type="button" onclick="javascript:location.href='profile.php?action=favorite_delete_save&id=<?php echo $this->_tpl_vars['rows']['id']; ?>
'" class="profilebutton"  value="<?php echo $this->_tpl_vars['lg']['profile_remvoe']; ?>
" /></td>
  </tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_profile_page.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php elseif ($this->_tpl_vars['action'] == 'coupon_list'): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable">
  <tr class="profiletabletitle">
    <td width="80" height="28"  class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['code']; ?>
 </td>
   
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="70" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['state']; ?>
</td>
     <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="50" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['my_price']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="100" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['expired_time']; ?>
</td>
	 <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
      <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['descript']; ?>
</td>
	 <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="80" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['action']; ?>
</td>
  </tr>
<?php $_from = $this->_tpl_vars['rs_coupon']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
 <tr class="profiletablelisttr">
	<td  height="28" ><?php echo $this->_tpl_vars['rows']['name']; ?>
</td>
   
     <td></td>
	<td><?php echo $this->_tpl_vars['rows']['strstate']; ?>
</td>
     <td></td>
	<td><span class="red">$ <?php echo $this->_tpl_vars['rows']['price']; ?>
</span></td>
     <td></td>
	<td><?php echo $this->_tpl_vars['rows']['strtime']; ?>
</td>
    <td></td>
    <td><?php echo $this->_tpl_vars['rows']['descript']; ?>
</td>
    <td></td>
	<td >
	<input type="button" onclick="javascript:location.href='profile.php?action=coupon_view&name=<?php echo $this->_tpl_vars['rows']['name']; ?>
'" class="profilebutton"  value="<?php echo $this->_tpl_vars['lg']['profile_detail']; ?>
" /></td>
  </tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_profile_page.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['action'] == 'coupon_view'): ?>
<div class="profiletableform" style="margin-top:8px;">
<table width="100%" border="0" cellpadding="0" cellspacing="10">    
  <tr>
              <td width="150" align="right"   ><strong><?php echo $this->_tpl_vars['lg']['code']; ?>
 </strong>:</td>
              <td > 
             <?php echo $this->_tpl_vars['coupon']['name']; ?>
</td>
      </tr>
			  <tr>
			    <td align="right"   ><strong><?php echo $this->_tpl_vars['lg']['my_price']; ?>
</strong>:</td>
			    <td ><span class="red">$ <?php echo $this->_tpl_vars['coupon']['price']; ?>
</span></td>
    </tr>
			  <tr>
			    <td align="right"   ><strong><?php echo $this->_tpl_vars['lg']['state']; ?>
 </strong>:</td>
			    <td >
<?php echo $this->_tpl_vars['coupon']['strstate']; ?>
</td>
		      </tr>
			  
			  <tr>
			    <td align="right"   ><strong><?php echo $this->_tpl_vars['lg']['expired_time']; ?>
 </strong>:</td>
			    <td ><?php echo $this->_tpl_vars['coupon']['strtime']; ?>
</td>
      </tr>
			  <tr>
			    <td align="right" valign="top"  ><strong><?php echo $this->_tpl_vars['lg']['descript']; ?>
 </strong>:</td>
			    <td ><?php echo $this->_tpl_vars['coupon']['descript']; ?>
</td>
		      </tr>
			  <?php if ($this->_tpl_vars['message']['state'] == 1): ?>
			  <tr>
                <td   ></td>
                <td ><div class="div3"><?php echo $this->_tpl_vars['message']['replyname']; ?>
:<?php echo $this->_tpl_vars['message']['reply']; ?>
<span class="sec">[<?php echo $this->_tpl_vars['message']['replytime']; ?>
]</span></div>				</td>
              </tr>
			  <?php endif; ?>
 </table>
<?php elseif ($this->_tpl_vars['action'] == 'order_list'): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable">
  <tr class="profiletabletitle">
    <td height="28" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['order_no']; ?>
 </td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['state']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['order_price']; ?>
</td>
   <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['creation_date']; ?>
</td>
	 <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['action']; ?>
</td>
  </tr>
      <?php $_from = $this->_tpl_vars['rs_o']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>     
            <tr class="profiletablelisttr">
              <td height="28" ><a href="profile.php?action=order_view&itemno=<?php echo $this->_tpl_vars['rows']['itemno']; ?>
"><?php echo $this->_tpl_vars['rows']['itemno']; ?>
</a></td>
              <td></td>
			  <td><span class="red"><?php echo $this->_tpl_vars['arrstate'][$this->_tpl_vars['rows']['state']]; ?>
</span></td>
             <td></td>
			  <td ><span class="impc"><?php echo $this->_tpl_vars['rows']['coin']; ?>
<?php echo $this->_tpl_vars['rows']['orderprice']; ?>
</span></td>
              <td></td>
			  <td><?php echo $this->_tpl_vars['rows']['addtime']; ?>
</td>
			   <td></td>
    <td ><input type="button" onclick="javascript:location.href='profile.php?action=order_view&itemno=<?php echo $this->_tpl_vars['rows']['itemno']; ?>
'" class="profilebutton"  value="<?php echo $this->_tpl_vars['lg']['profile_detail']; ?>
" /></td>
            </tr>
         <?php endforeach; endif; unset($_from); ?>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_profile_page.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



<?php elseif ($this->_tpl_vars['action'] == 'order_view'): ?>
<div class="profiletableform" style="margin-bottom:8px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" valign="top"><table width="100%" border="0" cellspacing="8" cellpadding="0">
  <tr>
    <td width="110" align="right"><strong><?php echo $this->_tpl_vars['lg']['order_no']; ?>
 :</strong></td>
    <td><?php echo $this->_tpl_vars['order']['itemno']; ?>
 <?php if ($this->_tpl_vars['order']['state'] <= 1): ?> <span style="margin-left:10px">
	<input type="button" onclick="javascript:location.href='step.php?action=step_3&itemno=<?php echo $this->_tpl_vars['order']['itemno']; ?>
'" class="profilebutton impc"  value="<?php echo $this->_tpl_vars['lg']['checkout']; ?>
" />
	<?php endif; ?>
    <input type="button" onclick="scroll(0, $('#message_content').offset().top)" class="profilebutton"  value="<?php echo $this->_tpl_vars['lg']['leave_a_message']; ?>
" />
    
    </td>
    </tr> 
  <tr>
    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['total_price']; ?>
 :</strong></td>
    <td><span class="red weight"><?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></td>
  </tr>
  <tr>
    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['order_status']; ?>
 :</strong></td>
    <td><span class="red weight"><?php echo $this->_tpl_vars['arrstate'][$this->_tpl_vars['order']['state']]; ?>
</span></td>
  </tr>
 <tr>
    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['tracking_no']; ?>
 :</strong></td>
    <td><?php echo $this->_tpl_vars['order']['shipno']; ?>
</td>
  </tr>

  <tr>
    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['creation_date']; ?>
 :</strong></td>
    <td><?php echo $this->_tpl_vars['order']['addtime']; ?>
</td>
    </tr>
	 <tr>
    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['remark']; ?>
 :</strong></td>
    <td><?php echo $this->_tpl_vars['order']['content']; ?>
</td>
    </tr>
</table></td>
    </tr>
</table>


</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:8px">
  <tr>
    <td width="50%" style="padding-right:8px"  valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable" >
  <tr class="profiletabletitle">
    <td height="28" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['shipping_address']; ?>
 </td>
    </tr>
    <tr class="profiletablelisttr">
<td class="pad5px">
<div class="linh" style="color:#000000">
<strong><?php echo $this->_tpl_vars['order']['arraddress'][0]; ?>
 <?php echo $this->_tpl_vars['order']['arraddress'][8]; ?>
</strong><br /> 
<?php echo $this->_tpl_vars['lg']['street']; ?>
 : <?php echo $this->_tpl_vars['order']['arraddress'][1]; ?>
<br />
<?php echo $this->_tpl_vars['lg']['location']; ?>
 : <?php echo $this->_tpl_vars['order']['arraddress'][3]; ?>
 <?php echo $this->_tpl_vars['order']['arraddress'][4]; ?>
 <?php echo $this->_tpl_vars['order']['arraddress'][2]; ?>
 <br />
<?php echo $this->_tpl_vars['lg']['country']; ?>
 : <?php echo $this->_tpl_vars['order']['arraddress'][5]; ?>

<br />
<?php echo $this->_tpl_vars['lg']['tel']; ?>
 : <?php echo $this->_tpl_vars['order']['arraddress'][6]; ?>
 , <?php echo $this->_tpl_vars['lg']['email']; ?>
 : <?php echo $this->_tpl_vars['order']['arraddress'][7]; ?>

</div>
</td>
    </tr>
 </table></td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable" >
  <tr class="profiletabletitle">
    <td height="28" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['billing_information']; ?>
 </td>
    </tr>
    <tr class="profiletablelisttr">
<td class="pad5px">
<div class="linh">
<?php echo $this->_tpl_vars['lg']['products_price']; ?>
 : <span class="red weight"><?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['productprice']; ?>
</span><br />
<?php echo $this->_tpl_vars['lg']['shipping_price']; ?>
 : <span class="red weight"><?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['sub1']; ?>
</span><br />
<?php echo $this->_tpl_vars['lg']['payment_price']; ?>
 : <span class="red weight"><?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['sub2']; ?>
</span><br />
<?php echo $this->_tpl_vars['lg']['discount_price']; ?>
 : <span class="red weight"><?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['sub3']; ?>
</span><br />
<?php echo $this->_tpl_vars['lg']['system_discount']; ?>
 : <span class="red weight"><?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['sub4']; ?>
</span>
</div>
</td>
    </tr>
 </table></td>
  </tr>
</table><table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable" style="margin-bottom:8px">
  <tr class="profiletabletitle">
    <td height="28" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['shipping_information']; ?>
</td>
    </tr>
    <tr class="profiletablelisttr">
<td class="pad5px" height="28">
<?php echo $this->_tpl_vars['order']['express']; ?>
 <span class="red"><?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['sub1']; ?>
</span> 
</td>
    </tr>
 </table>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable" style="margin-bottom:8px">
  <tr class="profiletabletitle">
    <td height="28" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['payment_information']; ?>
</td>
    </tr>
    <tr class="profiletablelisttr">
<td class="pad5px" height="28">
<?php echo $this->_tpl_vars['order']['payment']; ?>
&nbsp;
</td>
    </tr>
 </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable">
  <tr class="profiletabletitle">
    <td height="28" width="110" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['items']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td >&nbsp;</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="80" align="center" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['unit_price']; ?>
</td>
   <td width="1" align="center"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="40"  align="center" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['qty']; ?>
</td>
	 <td width="1" align="center"><img src="../pic/profile_bg_shuxian.gif" /></td>
	  <td width="80"  align="center" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['sub_price']; ?>
</td>
    </tr>
                  <?php $_from = $this->_tpl_vars['rs_o']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
                 <tr class="profiletablelisttr">
    <td style="padding:8px"><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0"></a></td>
    <td></td>
	<td  ><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><span class="mainc"><?php echo $this->_tpl_vars['rows']['pname']; ?>
</span></a><br><em><?php echo $this->_tpl_vars['rows']['pstyle']; ?>
</em><br />
<?php echo $this->_tpl_vars['lg']['remark']; ?>
:<?php echo $this->_tpl_vars['rows']['premark']; ?>
</td>
    <td></td>
	<td align="center" class="pad5px"><span class="red"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['rows']['pprice']; ?>
</span></td>
    <td align="center"></td>
	<td align="center"  class="pad5px"><?php echo $this->_tpl_vars['rows']['pnum']; ?>
</td>
    <td align="center"></td>
	<td align="center"  class="pad5px"><span class="red"><?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['rows']['itemprice']; ?>
</span></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
 </table>

<div class="profiletableform" style="margin-top:8px"><table id="message_content" width="100%" border="0" cellspacing="10" cellpadding="0">

            <form name="messageadd" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=add_message_save" >
              <tr>
                <td width="250" align="right"   ><?php echo $this->_tpl_vars['lg']['topics']; ?>
&nbsp;&nbsp;:</td>
                <td ><input name="name" value="<?php echo $this->_tpl_vars['lg']['order_no']; ?>
:<?php echo $this->_tpl_vars['order']['itemno']; ?>
" type="text" id="name" class="input002" maxlength="50">
                    <input name="username" type="hidden" value="<?php echo $this->_tpl_vars['username']; ?>
">
                    <input name="userid" type="hidden" id="userid" value="<?php echo $this->_tpl_vars['userid']; ?>
">
                    <input name="cid" type="hidden" id="cid" value="4">
					<input name="pid" type="hidden" id="pid" value="<?php echo $this->_tpl_vars['order']['id']; ?>
"></td>
              </tr>
              <tr>
                <td align="right" ><?php echo $this->_tpl_vars['lg']['content']; ?>
&nbsp;&nbsp;:</td>
                <td ><textarea name="content" class="input003"   id="content"></textarea></td>
              </tr><?php if ($this->_tpl_vars['config'][43] != ""): ?>
			   <tr>
                <td align="right"   ><?php echo $this->_tpl_vars['lg']['code']; ?>
&nbsp;&nbsp;:</td>
                <td><input name="code" type="text" size="4" maxlength="4" /> <img src="<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php" align="absmiddle" style="cursor:pointer" onclick="this.src='<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php?r=' + Math.random()" /></td>
              </tr>
			   <?php endif; ?>
              <tr>
                <td >&nbsp;</td>
                <td ><input type="submit" name="Submitsend" class="profilebutton"   onclick="return CheckForm1();" value="<?php echo $this->_tpl_vars['lg']['submit']; ?>
"  >
               </td>
              </tr>
            </form>
 </table></div>

 <script language="javascript" type="text/javascript">
  function CheckForm1()
  { 
if(!CheckIsNull("messageadd","username","<?php echo $this->_tpl_vars['lg']['msg_username_null']; ?>
")) return false;
if(!CheckIsNull("messageadd","name","<?php echo $this->_tpl_vars['lg']['msg_title_null']; ?>
")) return false;
if(!CheckIsNull("messageadd","content","<?php echo $this->_tpl_vars['lg']['msg_content_null']; ?>
")) return false;
<?php if ($this->_tpl_vars['config'][43] != ""): ?> if(!CheckIsNull("messageadd","code","<?php echo $this->_tpl_vars['lg']['msg_code_null']; ?>
")) return false; <?php endif; ?>
}
  </script>	  

 <?php elseif ($this->_tpl_vars['action'] == 'search_order'): ?>
<div class="profiletableform" style="margin-bottom:8px"><table width="100%" border="0" cellspacing="8" cellpadding="0">
  <tr>
    <td width="110" align="right"><strong><?php echo $this->_tpl_vars['lg']['order_no']; ?>
 :</strong></td>
    <td><?php echo $this->_tpl_vars['order']['itemno']; ?>
</td>
    </tr> <tr>
    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['order_status']; ?>
:</strong></td>
    <td><?php echo $this->_tpl_vars['arrstate'][$this->_tpl_vars['order']['state']]; ?>
</td>
  </tr>

  <tr>
    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['creation_date']; ?>
 :</strong></td>
    <td><?php echo $this->_tpl_vars['order']['addtime']; ?>
</td>
    </tr>
	 <tr>
    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['total_price']; ?>
 :</strong></td>
    <td><span class="red weight"><?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></td>
    </tr>
	 <tr>
    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['tracking_no']; ?>
 :</strong></td>
    <td><span class="red weight"><?php echo $this->_tpl_vars['order']['shipno']; ?>
</span></td>
    </tr>
</table>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable">
  <tr class="profiletabletitle">
    <td height="28" width="110" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['items']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td >&nbsp;</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="80" align="center" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['unit_price']; ?>
</td>
   <td width="1" align="center"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="40"  align="center" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['qty']; ?>
</td>
	 <td width="1" align="center"><img src="../pic/profile_bg_shuxian.gif" /></td>
	  <td width="80"  align="center" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['sub_price']; ?>
</td>
    </tr>
                  <?php $_from = $this->_tpl_vars['rs_o']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
                 <tr class="profiletablelisttr">
    <td style="padding:8px"><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0"></a></td>
    <td></td>
	<td  ><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><span class="mainc"><?php echo $this->_tpl_vars['rows']['pname']; ?>
</span></a><br><em><?php echo $this->_tpl_vars['rows']['pstyle']; ?>
</em><br />
<?php echo $this->_tpl_vars['lg']['remark']; ?>
:<?php echo $this->_tpl_vars['rows']['premark']; ?>
</td>
    <td></td>
	<td align="center" class="pad5px"><span class="red"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['rows']['pprice']; ?>
</span></td>
    <td align="center"></td>
	<td align="center"  class="pad5px"><?php echo $this->_tpl_vars['rows']['pnum']; ?>
</td>
    <td align="center"></td>
	<td align="center"  class="pad5px"><span class="red"><?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['rows']['itemprice']; ?>
</span></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
 </table>
 <?php elseif ($this->_tpl_vars['action'] == 'leave_message'): ?>
 
 <div class="profiletableform" style="margin-top:8px">
<table width="100%" border="0" cellpadding="0" cellspacing="10">
            <form name="messageadd" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=add_message_save">
              <tr>
                <td width="250" align="right"   ><?php echo $this->_tpl_vars['lg']['username']; ?>
&nbsp;&nbsp;:</td>
                <td >  <input name="username" type="text"    class="input001"  maxlength="50"  value="<?php echo $this->_tpl_vars['user']['firstname']; ?>
 <?php echo $this->_tpl_vars['user']['lastname']; ?>
">
                    <input name="userid" type="hidden" id="userid" value="<?php echo $this->_tpl_vars['user']['id']; ?>
">
                    <input name="cid" type="hidden" id="cid" value="0">			    </td>
              </tr>
                <tr>
                <td align="right" ><?php echo $this->_tpl_vars['lg']['email']; ?>
&nbsp;&nbsp;:</td>
                <td ><input name="contact0"  value="<?php echo $this->_tpl_vars['user']['name']; ?>
"  type="text"  class="input001" maxlength="100">
                *</td>
              </tr>
              <tr>
                <td align="right" >Msn&nbsp;&nbsp;:</td>
                <td ><input name="contact1" value="<?php echo $this->_tpl_vars['user']['msn']; ?>
"  type="text"   class="input001" maxlength="100">                </td>
              </tr>
             
              <tr>
                <td align="right"   ><?php echo $this->_tpl_vars['lg']['topics']; ?>
&nbsp;&nbsp;:</td>
                <td ><input name="name" type="text" id="name" class="input002" maxlength="100"> 
                *                  </td>
              </tr>
              <tr>
                <td align="right"   ><?php echo $this->_tpl_vars['lg']['content']; ?>
&nbsp;&nbsp;:</td>
                <td ><textarea name="content" class="input003" id="content"></textarea></td>
              </tr><?php if ($this->_tpl_vars['config'][43] != ""): ?>
			   <tr>
                <td align="right"   ><?php echo $this->_tpl_vars['lg']['code']; ?>
&nbsp;&nbsp;:</td>
                <td><input name="code" type="text" size="4" maxlength="4" /> <img src="<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php" align="absmiddle" style="cursor:pointer" onclick="this.src='<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php?r=' + Math.random()" /></td>
              </tr><?php endif; ?>
              <tr>
                <td   >&nbsp;</td>
                <td ><input type="submit" class="profilebutton"   onclick="return CheckForm1();" name="Submitsend" value="<?php echo $this->_tpl_vars['lg']['add_new_message']; ?>
" >
               </td>
              </tr>
            </form>
 </table>
</div>
  <script language="javascript" type="text/javascript">
  function CheckForm1()
  { 
if(!CheckIsNull("messageadd","username","<?php echo $this->_tpl_vars['lg']['msg_username_null']; ?>
")) return false;
if(!CheckIsNull("messageadd","name","<?php echo $this->_tpl_vars['lg']['msg_title_null']; ?>
")) return false;
if(!CheckIsNull("messageadd","content","<?php echo $this->_tpl_vars['lg']['msg_content_null']; ?>
")) return false;
<?php if ($this->_tpl_vars['config'][43] != ""): ?> if(!CheckIsNull("messageadd","code","<?php echo $this->_tpl_vars['lg']['msg_code_null']; ?>
")) return false; <?php endif; ?>
}
  </script>	  
 <?php elseif ($this->_tpl_vars['action'] == 'message_list'): ?>


<table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable">
  <tr class="profiletabletitle">
    <td height="28" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['subject']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['type']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['state']; ?>
</td>
   <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['creation_date']; ?>
</td>
	 <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['action']; ?>
</td>
  </tr>


			<?php $_from = $this->_tpl_vars['rs_mes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
    <tr class="profiletablelisttr">
	
              <td class="pad5px" height="32"><?php echo $this->_tpl_vars['rows']['name']; ?>
</td>
              <td></td>
			  <td><?php echo $this->_tpl_vars['rows']['stitle']; ?>
</td>
              <td></td>
			  <td ><?php echo $this->_tpl_vars['rows']['displaystate']; ?>
</td>
              <td></td>
			  <td ><?php echo $this->_tpl_vars['rows']['addtime']; ?>
</td>
			   <td></td>
			  <td ><input type="button" onclick="javascript:location.href='profile.php?action=message_view&id=<?php echo $this->_tpl_vars['rows']['id']; ?>
'" class="profilebutton"  value="<?php echo $this->_tpl_vars['lg']['profile_detail']; ?>
" /></td>
    </tr>
           <?php endforeach; endif; unset($_from); ?>
 </table>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_profile_page.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



 <?php elseif ($this->_tpl_vars['action'] == 'message_view'): ?>
<?php if ($this->_tpl_vars['message']['cid'] != 0 && $this->_tpl_vars['message']['cid'] != 4): ?>
<div class="profiletableform" style="margin-top:8px;">
<table width="100%" border="0" cellpadding="0" cellspacing="10">    
  <tr>
              <td width="150" align="right"   ><strong><?php echo $this->_tpl_vars['lg']['topics']; ?>
 </strong>:</td>
              <td > 
             <?php echo $this->_tpl_vars['message']['name']; ?>
</td>
      </tr>
			  <tr>
			    <td align="right"   ><strong><?php echo $this->_tpl_vars['lg']['relate']; ?>
 </strong>:</td>
			    <td >
<?php echo $this->_tpl_vars['message']['stitle']; ?>
</td>
		      </tr>
			  
			  <tr>
			    <td align="right"   ><strong><?php echo $this->_tpl_vars['lg']['creation_date']; ?>
 </strong>:</td>
			    <td ><?php echo $this->_tpl_vars['message']['addtime']; ?>
</td>
      </tr>
			  <tr>
			    <td align="right" valign="top"  ><strong><?php echo $this->_tpl_vars['lg']['content']; ?>
 </strong>:</td>
			    <td ><?php echo $this->_tpl_vars['message']['content']; ?>
</td>
		      </tr>
			  <?php if ($this->_tpl_vars['message']['state'] == 1): ?>
			  <tr>
                <td   ></td>
                <td ><div class="div3"><?php echo $this->_tpl_vars['message']['replyname']; ?>
:<?php echo $this->_tpl_vars['message']['reply']; ?>
<span class="sec">[<?php echo $this->_tpl_vars['message']['replytime']; ?>
]</span></div>				</td>
              </tr>
			  <?php endif; ?>
 </table>
 </div>
 <?php else: ?>
 <div class="profiletableform" style="margin-top:8px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="10">    
        <tr>
          <td width="150" align="right"   ><strong><?php echo $this->_tpl_vars['lg']['topics']; ?>
  </strong>:</td>
          <td > 
         <?php echo $this->_tpl_vars['message']['name']; ?>
</td>
      </tr>
                  
          <tr>
            <td align="right"   ><strong><?php echo $this->_tpl_vars['lg']['creation_date']; ?>
 </strong>:</td>
            <td ><?php echo $this->_tpl_vars['message']['addtime']; ?>
</td>
          </tr>
          <tr>
            <td align="right"   ><strong><?php echo $this->_tpl_vars['lg']['content']; ?>
 </strong>:</td>
            <td ><?php echo $this->_tpl_vars['message']['content']; ?>
</td>
          </tr>  
        <tr>
          <td width="150" align="right" valign="top" style="line-height:25px;" ><strong><?php echo $this->_tpl_vars['lg']['reply_content']; ?>
 </strong>:</td>
          <td style="border:1px #CCC solid;"> 
          <div style="line-height:18px; padding:5px">
          <?php $_from = $this->_tpl_vars['rs_reply']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_reply'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_reply']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_reply']['iteration']++;
?>   
             <div style="color:<?php echo $this->_tpl_vars['rows']['color']; ?>
"><?php echo $this->_tpl_vars['rows']['replyname']; ?>
  &nbsp; <?php echo $this->_tpl_vars['rows']['addtime']; ?>
</div>
             <div style="padding-left:12px"><?php echo $this->_tpl_vars['rows']['content']; ?>
</div>
            
           <?php endforeach; endif; unset($_from); ?>     </div>  
          </td>
      </tr>
    </table>
  </div>
      <div class="profiletableform" style="margin-top:8px"><table width="100%" border="0" cellspacing="10" cellpadding="0">

            <form name="messageadd" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=add_message_reply_save&id=<?php echo $this->_tpl_vars['message']['id']; ?>
" >
            
              <tr>
                <td width="250" align="right" ><?php echo $this->_tpl_vars['lg']['content']; ?>
&nbsp;&nbsp;:</td>
                <td ><textarea name="content" class="input003"   id="content"></textarea><input name="name"  type="hidden" id="name" >
                    <input name="replyname" type="hidden" value="<?php echo $this->_tpl_vars['username']; ?>
">
                    <input name="replyid" type="hidden" id="replyid" value="<?php echo $this->_tpl_vars['userid']; ?>
">
                    <input name="cid" type="hidden" id="cid" value="<?php echo $this->_tpl_vars['message']['cid']; ?>
">
					<input name="mid" type="hidden" id="mid" value="<?php echo $this->_tpl_vars['message']['id']; ?>
"></td>
              </tr><?php if ($this->_tpl_vars['config'][43] != ""): ?>
			   <tr>
                <td align="right"   ><?php echo $this->_tpl_vars['lg']['code']; ?>
&nbsp;&nbsp;:</td>
                <td><input name="code" type="text" size="4" maxlength="4" /> <img src="<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php" align="absmiddle" style="cursor:pointer" onclick="this.src='<?php echo $this->_tpl_vars['folder']; ?>
inc/php_inc_code.php?r=' + Math.random()" /></td>
              </tr>
			   <?php endif; ?>
              <tr>
                <td >&nbsp;</td>
                <td ><input type="submit" name="Submitsend" class="profilebutton"   onclick="return CheckForm1();" value="<?php echo $this->_tpl_vars['lg']['reply']; ?>
"  >
               </td>
              </tr>
            </form>
 </table></div>
  
    
 <?php endif; ?>
 

  <?php elseif ($this->_tpl_vars['action'] == 'address_list'): ?>
 
   
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable">
  <tr class="profiletabletitle">
    <td height="28" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['full_name']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['address']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['email']; ?>
</td>
   <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['action']; ?>
</td>
  </tr>
  <?php $_from = $this->_tpl_vars['rs_address']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
  <tr class="profiletablelisttr">
    <td height="32"><?php echo $this->_tpl_vars['rows']['address'][0]; ?>
 <?php echo $this->_tpl_vars['rows']['address'][8]; ?>
</td>
    <td>&nbsp;</td>
    <td><?php echo $this->_tpl_vars['rows']['address'][1]; ?>
 (<?php echo $this->_tpl_vars['rows']['address'][2]; ?>
) <?php echo $this->_tpl_vars['rows']['address'][3]; ?>
 <?php echo $this->_tpl_vars['rows']['address'][4]; ?>
 <?php echo $this->_tpl_vars['rows']['address'][5]; ?>
</td>
    <td>&nbsp;</td>
    <td><?php echo $this->_tpl_vars['rows']['address'][7]; ?>
</td>
    <td>&nbsp;</td>
    <td><input type="button" onclick="javascript:location.href='profile.php?action=address_edit&id=<?php echo $this->_tpl_vars['rows']['id']; ?>
'" class="profilebutton"  value="<?php echo $this->_tpl_vars['lg']['profile_modify']; ?>
" />&nbsp;<input type="button" onclick="javascript:if(confirm('are you sure to delete?'))location.href='profile.php?action=address_delete_save&id=<?php echo $this->_tpl_vars['rows']['id']; ?>
'" class="profilebutton"  value="<?php echo $this->_tpl_vars['lg']['profile_remvoe']; ?>
" /></td>
  </tr> <?php endforeach; endif; unset($_from); ?>
</table>

<form id="form3" name="addressform" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=address_add_save">
<div class="profiletableform" style="margin-top:10px">
<table width="100%" border="0" cellpadding="0" cellspacing="10">
 <tr>
    <td width="250" align="right"   ><?php echo $this->_tpl_vars['lg']['first_name']; ?>
&nbsp;&nbsp;:</td>
    <td  ><input name="content0" type="text"  class="input001" maxlength="50" /></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['last_name']; ?>
&nbsp;&nbsp;:</td>
    <td  ><input name="content8" type="text"  class="input001" maxlength="50" /></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['address']; ?>
&nbsp;&nbsp;:</td>
    <td >
        <textarea name="content1" class="input003" style="color:#777" onblur="javascript:if($.trim(this.value).length == 0){this.value='<?php echo $this->_tpl_vars['lg']['address_input_place_holder']; ?>
';this.style.color='#777';}"
      onfocus="javascript:if($.trim(this.value)=='<?php echo $this->_tpl_vars['lg']['address_input_place_holder']; ?>
'){this.select();this.value='';this.style.color='#000';}"><?php echo $this->_tpl_vars['lg']['address_input_place_holder']; ?>
</textarea></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['zip']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="content2" type="text"  class="input001" maxlength="20" /></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['city']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="content3" type="text"  class="input001" maxlength="50" /></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['province']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="content4" type="text"  class="input001" maxlength="50" /></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['country']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="content5" id="content5" type="hidden" value="" /><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_country.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<script language="javascript">
	function setCountryValue(str)
{
	$("#content5").val(str);
}
	if(openapi!="")
		includeJsFile("script_api",openapi+"/cgi-bin/?do=iptocountryselect&verson=2&fun=changeCountry&param=2");
	</script>
	</td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['tel']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="content6" type="text"  class="input001" maxlength="20" /></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['email']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="content7" type="text"  class="input001" /></td>
  </tr>
  <tr>
    <td   >&nbsp;</td>
    <td >
      <input type="submit"  name="Submit2" class="profilebutton"   onclick="return CheckForm()" value="<?php echo $this->_tpl_vars['lg']['add_new']; ?>
" />
     </td>
  </tr>
</table>
</div>
</form>
<script language="javascript" type="text/javascript">
  function CheckForm()
  { 
   if(!CheckIsNull("addressform","content0","<?php echo $this->_tpl_vars['lg']['msg_firstname_null']; ?>
")) return false;
if(!CheckIsNull("addressform","content8","<?php echo $this->_tpl_vars['lg']['msg_lastname_null']; ?>
")) return false;
 if ($.trim(document.addressform.content1.value) == "<?php echo $this->_tpl_vars['lg']['address_input_place_holder']; ?>
") {
			document.addressform.content1.focus();
			alert('<?php echo $this->_tpl_vars['lg']['msg_address_null']; ?>
');
			return false;
		}
if(!CheckIsNull("addressform","content1","<?php echo $this->_tpl_vars['lg']['msg_address_null']; ?>
")) return false;
if(!CheckIsNull("addressform","content2","<?php echo $this->_tpl_vars['lg']['msg_zipcode_null']; ?>
")) return false;
if(!CheckIsNull("addressform","content3","<?php echo $this->_tpl_vars['lg']['msg_city_null']; ?>
")) return false;
if(!CheckIsNull("addressform","content5","<?php echo $this->_tpl_vars['lg']['msg_country_null']; ?>
")) return false;
if(!CheckIsNull("addressform","content6","<?php echo $this->_tpl_vars['lg']['msg_tel_null']; ?>
")) return false;
if(!CheckIsNull("addressform","content7","<?php echo $this->_tpl_vars['lg']['msg_email_null']; ?>
")) return false;
if(!CheckIsEmail("addressform","content7","<?php echo $this->_tpl_vars['lg']['msg_email_error']; ?>
")) return false;

}
</script>

<?php elseif ($this->_tpl_vars['action'] == 'address_edit'): ?>

<form id="form3" name="addressform" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=address_edit_save&id=<?php echo $this->_tpl_vars['addressid']; ?>
">
<div class="profiletableform">
<table width="100%" border="0" cellpadding="0" cellspacing="10">
 <tr>
    <td width="250" align="right"   ><?php echo $this->_tpl_vars['lg']['first_name']; ?>
&nbsp;&nbsp;:</td>
    <td  ><input name="content0" value="<?php echo $this->_tpl_vars['address'][0]; ?>
" type="text"  class="input001" maxlength="50" /></td>
  </tr>
  <tr>
    <td  align="right"   ><?php echo $this->_tpl_vars['lg']['last_name']; ?>
&nbsp;&nbsp;:</td>
    <td  ><input name="content8" value="<?php echo $this->_tpl_vars['address'][8]; ?>
" type="text"  class="input001" maxlength="50" /></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['address']; ?>
&nbsp;&nbsp;:</td>
    <td >
<textarea name="content1" class="input003" onblur="javascript:if($.trim(this.value).length == 0){this.value='<?php echo $this->_tpl_vars['lg']['address_input_place_holder']; ?>
';this.style.color='#777';}" 
    	onfocus="javascript:if($.trim(this.value)=='<?php echo $this->_tpl_vars['lg']['address_input_place_holder']; ?>
'){this.select();this.value='';this.style.color='#000';}"><?php echo $this->_tpl_vars['address'][1]; ?>
</textarea>
    </td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['zip']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="content2" type="text" value="<?php echo $this->_tpl_vars['address'][2]; ?>
"   class="input001" maxlength="20" /></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['city']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="content3" type="text"  value="<?php echo $this->_tpl_vars['address'][3]; ?>
"  class="input001" maxlength="50" /></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['province']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="content4" type="text"  value="<?php echo $this->_tpl_vars['address'][4]; ?>
"  class="input001" maxlength="50" /></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['country']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="content5" id="content5" type="hidden" value="" /><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_country.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><script>
function setCountryValue(str)
{
	$("#content5").val(str);
}
changeCountry('<?php echo $this->_tpl_vars['address'][5]; ?>
');
  </script></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['tel']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="content6" type="text" value="<?php echo $this->_tpl_vars['address'][6]; ?>
"   class="input001" maxlength="20" /></td>
  </tr>
  <tr>
    <td align="right"   ><?php echo $this->_tpl_vars['lg']['email']; ?>
&nbsp;&nbsp;:</td>
    <td ><input name="content7" value="<?php echo $this->_tpl_vars['address'][7]; ?>
"  type="text"  class="input001" /></td>
  </tr>
  <tr>
    <td   >&nbsp;</td>
    <td >
      <input type="submit" name="Submit2"  class="profilebutton"  onclick="return CheckForm()" value="<?php echo $this->_tpl_vars['lg']['submit']; ?>
" /><input name="redirectURL" type="hidden" value="<?php echo $this->_tpl_vars['refererURL']; ?>
" />
     </td>
  </tr>
</table>
</div>
</form>
<script language="javascript" type="text/javascript">
  function CheckForm()
  { 
if(!CheckIsNull("addressform","content0","<?php echo $this->_tpl_vars['lg']['msg_firstname_null']; ?>
")) return false;
if(!CheckIsNull("addressform","content8","<?php echo $this->_tpl_vars['lg']['msg_lastname_null']; ?>
")) return false;
if ($.trim(document.addressform.content1.value) == "<?php echo $this->_tpl_vars['lg']['address_input_place_holder']; ?>
") {
			document.addressform.content1.focus();
			alert('<?php echo $this->_tpl_vars['lg']['msg_address_null']; ?>
');
			return false;
		}
if(!CheckIsNull("addressform","content1","<?php echo $this->_tpl_vars['lg']['msg_address_null']; ?>
")) return false;
if(!CheckIsNull("addressform","content2","<?php echo $this->_tpl_vars['lg']['msg_zipcode_null']; ?>
")) return false;
if(!CheckIsNull("addressform","content3","<?php echo $this->_tpl_vars['lg']['msg_city_null']; ?>
")) return false;
if(!CheckIsNull("addressform","content5","<?php echo $this->_tpl_vars['lg']['msg_country_null']; ?>
")) return false;
if(!CheckIsNull("addressform","content6","<?php echo $this->_tpl_vars['lg']['msg_tel_null']; ?>
")) return false;
if(!CheckIsNull("addressform","content7","<?php echo $this->_tpl_vars['lg']['msg_email_null']; ?>
")) return false;
if(!CheckIsEmail("addressform","content7","<?php echo $this->_tpl_vars['lg']['msg_email_error']; ?>
")) return false;

}
</script>
<?php elseif ($this->_tpl_vars['action'] == 'invite'): ?>
<script language="javascript" type="text/javascript">
  function CheckForm1()
  { 
if(!CheckIsNull("addressform","username","<?php echo $this->_tpl_vars['lg']['username']; ?>
")) return false;
if(!CheckIsNull("addressform","emails","<?php echo $this->_tpl_vars['lg']['friends_e_mail']; ?>
")) return false;
}
</script>
<div class="profiletableform" style="margin-top:8px"><table width="100%" border="0" cellspacing="10" cellpadding="0">

            <form name="messageadd" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=invite_save" >
            
              <tr>
                <td align="right" ><?php echo $this->_tpl_vars['lg']['username']; ?>
&nbsp;&nbsp;:</td>
                <td ><input name="username" type="text" value="<?php echo $this->_tpl_vars['user']['firstname']; ?>
"   class="input001" maxlength="20" /></td>
              </tr>
              <tr>
                <td width="250" align="right" valign="top" ><?php echo $this->_tpl_vars['lg']['friends_e_mail']; ?>
&nbsp;&nbsp;:</td>
                <td ><textarea name="emails" class="input003" style="height:120px"   id="emails"></textarea><br />
<span class="red"><?php echo $this->_tpl_vars['lg']['invite_email_line']; ?>
</span></td>
              </tr>
              <tr>
                <td >&nbsp;</td>
                <td ><input type="submit" name="Submitsend" class="profilebutton"   onclick="return CheckForm1();" value="<?php echo $this->_tpl_vars['lg']['submit']; ?>
"  >
               </td>
              </tr>
            </form>
 </table></div>
 <?php elseif ($this->_tpl_vars['action'] == 'invite_list'): ?><table width="100%" border="0" cellspacing="0" cellpadding="0" class="profiletable">
  <tr class="profiletabletitle">
    <td height="28" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['friends_e_mail']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="90" align="center" class="profiletabletitle_td_nopad"><?php echo $this->_tpl_vars['lg']['registered']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="90" align="center" class="profiletabletitle_td_nopad"><?php echo $this->_tpl_vars['lg']['rewarded']; ?>
</td>
    <td width="1"><img src="../pic/profile_bg_shuxian.gif" /></td>
    <td width="120" class="profiletabletitle_td"><?php echo $this->_tpl_vars['lg']['creation_date']; ?>
</td>
    </tr>
  <?php $_from = $this->_tpl_vars['rs_invite']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
  <tr class="profiletablelisttr">
    <td height="32"><?php echo $this->_tpl_vars['rows']['name']; ?>
</td>
    <td>&nbsp;</td>
    <td align="center"><?php echo $this->_tpl_vars['rows']['reg_state']; ?>
</td>
    <td>&nbsp;</td>
    <td align="center"><?php echo $this->_tpl_vars['rows']['rew_state']; ?>
</td>
     <td>&nbsp;</td>
    <td><?php echo $this->_tpl_vars['rows']['addtime']; ?>
</td>
    </tr> <?php endforeach; endif; unset($_from); ?>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_profile_page.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
</div>