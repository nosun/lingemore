<?php /* Smarty version 2.6.26, created on 2012-07-24 16:41:57
         compiled from module_profile.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<?php if ($this->_tpl_vars['userid'] != -1): ?>
<script language="javascript">
function CheckProfileForm()
{
	if(!CheckIsNull("ProfileForm","name","Username")) return false;
	if(!CheckIsNull("ProfileForm","pwd","Password")) return false;
	if(!CheckIsNull("ProfileForm","code","code")) return false;
}
</script>
<table width="200" border="0" style="border:1px #FFD27B solid; background-color:#FFFCE8" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<div style="background:url(../pic/module_profile_main.jpg) repeat-x; height:22px; line-height:22px; margin-bottom:10px; text-align:center; color:#FF0000"><strong><?php echo $this->_tpl_vars['lg']['my_summary']; ?>
</strong></div>
	<div style=" height:20px; line-height:20px; margin-bottom:10px; text-align:center; background-color:#FFF7D5; border-bottom:1px #FFDB96 solid;border-top:1px #FFDB96 solid; "><strong><?php echo $this->_tpl_vars['lg']['my_account']; ?>
</strong></div>
	<div  style="margin-left:22px;line-height:22px; margin-bottom:5px">
	<div><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php"><?php echo $this->_tpl_vars['lg']['account_summary']; ?>
</a></div>
	<div><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=info_view"><?php echo $this->_tpl_vars['lg']['my_profile']; ?>
</a></div>
	<div><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=account_view"><?php echo $this->_tpl_vars['lg']['change_password']; ?>
</a></div>
     <div><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=newsletter_sub"><?php echo $this->_tpl_vars['lg']['newsletter_sub']; ?>
</a></div>
	<div><a target="_blank" href="<?php echo $this->_tpl_vars['folder']; ?>
shopcart.php"><?php echo $this->_tpl_vars['lg']['my_shopping_cart']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['totalnum']; ?>
</span>)</a> </div>
	<div><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=address_list"><?php echo $this->_tpl_vars['lg']['my_address_books']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['sum_a']['total']; ?>
</span>)</a></div>
	
    <div><a href="<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=logout"><?php echo $this->_tpl_vars['lg']['log_out']; ?>
</a></div>
   
	</div>
	<div style=" height:20px; line-height:20px; margin-bottom:10px; text-align:center; background-color:#FFF7D5; border-bottom:1px #FFDB96 solid;border-top:1px #FFDB96 solid; "><strong><?php echo $this->_tpl_vars['lg']['my_orders']; ?>
</strong></div>
	<div style="margin-left:15px; margin-bottom:5px">
	<div style="margin-left:5px; line-height:22px"><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list"><?php echo $this->_tpl_vars['lg']['all_orders']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['sum_o']['total']; ?>
</span>)</a></div>
	<div><img align="absmiddle" hspace="5" src="../pic/module_order_pre.jpg" /><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=0"><?php echo $this->_tpl_vars['lg']['pending']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['sum_o'][0]; ?>
</span>)</a></div>
	<div><img align="absmiddle"  hspace="5"src="../pic/module_order_pre.jpg" /><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=1"><?php echo $this->_tpl_vars['lg']['unpaid']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['sum_o'][1]; ?>
</span>)</a></div>
	<div><img align="absmiddle" hspace="5" src="../pic/module_order_pre.jpg" /><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=2"><?php echo $this->_tpl_vars['lg']['paid']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['sum_o'][2]; ?>
</span>)</a></div>
	<div><img align="absmiddle" hspace="5" src="../pic/module_order_pre.jpg" /><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=3"><?php echo $this->_tpl_vars['lg']['processing']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['sum_o'][3]; ?>
</span>)</a></div>
	<div><img align="absmiddle" hspace="5" src="../pic/module_order_pre.jpg" /><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=4"><?php echo $this->_tpl_vars['lg']['shipped']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['sum_o'][3]; ?>
</span>)</a></div>
	<div><img align="absmiddle" hspace="5" src="../pic/module_order_pre.jpg" /><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=5"><?php echo $this->_tpl_vars['lg']['completed']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['sum_o'][5]; ?>
</span>)</a></div>
	<div><img align="absmiddle" hspace="5" src="../pic/module_order_pre_last.jpg" /><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list&state=6"><?php echo $this->_tpl_vars['lg']['canceled']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['sum_o'][4]; ?>
</span>)</a></div>
	</div>
	<div style=" height:20px; line-height:20px; margin-bottom:10px; text-align:center; background-color:#FFF7D5; border-bottom:1px #FFDB96 solid;border-top:1px #FFDB96 solid; "><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=favorite_list"><strong><?php echo $this->_tpl_vars['lg']['my_wishlist']; ?>
</strong> (<span class="red"><?php echo $this->_tpl_vars['sum_f']['total']; ?>
</span>)</a></div>
    
    <div style=" height:20px; display:none; line-height:20px; margin-bottom:10px; text-align:center; background-color:#FFF7D5; border-bottom:1px #FFDB96 solid;border-top:1px #FFDB96 solid; "><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=coupon_list"><strong><?php echo $this->_tpl_vars['lg']['my_coupon']; ?>
</strong> (<span class="red"><?php echo $this->_tpl_vars['sum_c']['total']; ?>
</span>)</a></div>
    
	<div style=" height:20px; line-height:20px; margin-bottom:10px; text-align:center; background-color:#FFF7D5; border-bottom:1px #FFDB96 solid;border-top:1px #FFDB96 solid; "><strong><?php echo $this->_tpl_vars['lg']['message_center']; ?>
</strong></div>
	
	<div style="margin-left:15px; margin-bottom:5px">
    <div style="margin-left:5px; line-height:22px"><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=leave_message"><?php echo $this->_tpl_vars['lg']['leave_a_message']; ?>
</a></div>
	<div style="margin-left:5px; line-height:22px"><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=message_list"><?php echo $this->_tpl_vars['lg']['all_messages']; ?>
  (<span class="red"><?php echo $this->_tpl_vars['sum_m']['total']; ?>
</span>)</a></div>
	<div><img align="absmiddle" hspace="5" src="../pic/module_order_pre.jpg" /><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=message_list&cid=5"><?php echo $this->_tpl_vars['lg']['announcement']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['sum_m'][5]; ?>
</span>)</a></div>
    <div><img align="absmiddle"  hspace="5"src="../pic/module_order_pre.jpg" /><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=message_list&cid=0"><?php echo $this->_tpl_vars['lg']['member_feedback']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['sum_m'][0]; ?>
</span>)</a></div>
	<div><img align="absmiddle" hspace="5" src="../pic/module_order_pre_last.jpg" /><a href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=message_list&cid=4"><?php echo $this->_tpl_vars['lg']['orders']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['sum_m'][4]; ?>
</span>)</a></div>
	</div>
	
	
	</td>
  </tr>
</table>
<?php else: ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

