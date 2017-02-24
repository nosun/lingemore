<?php /* Smarty version 2.6.26, created on 2011-10-23 20:08:46
         compiled from module_category_attr.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div>
<?php $_from = $this->_tpl_vars['rs_filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
  <div class="filtertitle">Refine by <?php echo $this->_tpl_vars['rows']['name']; ?>
</div>
  <div class="filtercontent">
<?php $_from = $this->_tpl_vars['rows']['son']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['srows']):
?>
  <div class="filtertitem"><a href="<?php echo $this->_tpl_vars['srows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['srows']['name']; ?>
</a><span class="filtercount">(<?php echo $this->_tpl_vars['srows']['num']; ?>
)</span></div>
<?php endforeach; endif; unset($_from); ?>
</div>
<?php endforeach; endif; unset($_from); ?>
</div>