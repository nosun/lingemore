<?php /* Smarty version 2.6.26, created on 2011-10-09 17:40:29
         compiled from lay_minishopcart.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div style="margin-bottom:5px">
<div style="text-align:right; padding:2px"><a href="javascript:void(0)" onclick="_close_divShoppingcart()"><strong><?php echo $this->_tpl_vars['lg']['close']; ?>
</strong></a></div>
<span style="font-size:14px; font-weight:bold"><?php echo $this->_tpl_vars['lg']['success_add_cart']; ?>
</span>  
<div style="font-size:11px">

<?php echo $this->_tpl_vars['lg']['minicart_items']; ?>
 , <?php echo $this->_tpl_vars['lg']['sub_total']; ?>
: <span class="red"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['totalprice']; ?>
</span><br />

</div>
<a style="text-decoration:underline;" href='<?php echo $this->_tpl_vars['folder']; ?>
shopcart.php'><strong><?php echo $this->_tpl_vars['lg']['go_cart_settle']; ?>
</strong></a>
<script language="javascript">
try
{
$('#_ajax_div_items').html("<?php echo $this->_tpl_vars['totalnum']; ?>
");
}
catch(e)
{

}
</script></div>