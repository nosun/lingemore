<?php /* Smarty version 2.6.26, created on 2011-10-08 11:04:14
         compiled from module_wholesale_price.html */ ?>
<table id="priceTable"  style="background-color:#cccccc; " width="100%" border="0" b cellpadding="2" cellspacing="1">
<tr bgcolor="#EBEBEB">
<td style="font-size:11px;" ><?php echo $this->_tpl_vars['lg']['quantity_piece']; ?>
</td>
<td style="font-size:11px;"><?php echo $this->_tpl_vars['lg']['price_per_piece']; ?>
</td>
<td style="font-size:11px;"><?php echo $this->_tpl_vars['lg']['processing_time']; ?>
</td>
</tr>
<?php $_from = $this->_tpl_vars['p']['wholesaleprice']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['wholesaleprice'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['wholesaleprice']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['rows']):
        $this->_foreach['wholesaleprice']['iteration']++;
?>
<tr style="font-size:11px">
<td align="center" style="font-size:11px; background-color:#FFF" ><?php echo $this->_tpl_vars['rows']['numitem']; ?>
</td>
<td align="center" style="font-size:11px; background-color:#FFF" >
<span class="red"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['rows']['price']; ?>
</span>
</td>
<td  align="center" style="font-size:11px; background-color:#FFF"><?php echo $this->_tpl_vars['rows']['remark']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?></table>