<?php /* Smarty version 2.6.26, created on 2011-10-22 14:39:22
         compiled from uio_attribute.html */ ?>
<ul class="pro_list">
   <?php $_from = $this->_tpl_vars['rs_p']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_p'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_p']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_p']['iteration']++;
?>
        <li>
        <a class="pic" title="<?php echo $this->_tpl_vars['rows']['name']; ?>
" href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img title="<?php echo $this->_tpl_vars['rows']['name']; ?>
" alt="<?php echo $this->_tpl_vars['rows']['name']; ?>
" src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0"/></a>
        <div class="pro_info">
            <a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
" title="<?php echo $this->_tpl_vars['rows']['name']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a><br />
            <span class="red"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price']; ?>
</span>
        </div>
         </li>
    <?php endforeach; endif; unset($_from); ?>
</ul>