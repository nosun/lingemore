<?php /* Smarty version 2.6.26, created on 2011-09-28 15:19:26
         compiled from module_right.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div class="right_box">
	<?php echo $this->_tpl_vars['content_68']; ?>

</div>
<div class="clear"></div>
<div class="right_box">
	<div class="right_box_title">Hot Wholesale Products</div>
    <div class="right_box_main">
    	<ul class="hot_pro_list">
    	<?php $_from = $this->_tpl_vars['rs_p_8']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_p_8'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_p_8']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_p_8']['iteration']++;
?>
        	<li>
            	<a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
" class="pic"><img src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0"/></a>
                <div class="info">
                	<div class="info_top"><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a></div>
                    <div class="info_bottom red"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price']; ?>
</div>
                </div>
            </li>
        <?php endforeach; endif; unset($_from); ?>
        </ul>
    </div>
    <div class="right_box_bottom"></div>
</div>
<div class="clear"></div>
<div class="right_box">
	<?php echo $this->_tpl_vars['content_69']; ?>

</div>
