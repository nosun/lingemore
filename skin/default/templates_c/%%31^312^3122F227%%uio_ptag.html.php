<?php /* Smarty version 2.6.26, created on 2010-07-25 11:29:12
         compiled from uio_ptag.html */ ?>
<div class="main_ct">
<?php $_from = $this->_tpl_vars['rs_tag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_tag'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_tag']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_tag']['iteration']++;
?>
<a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
" style=" font-size:<?php echo $this->_tpl_vars['rows']['font']; ?>
pt" class="tag"><?php echo $this->_tpl_vars['rows']['name']; ?>
 (<?php echo $this->_tpl_vars['rows']['count']; ?>
)</a>
<?php endforeach; endif; unset($_from); ?>
</div>