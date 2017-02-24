<?php /* Smarty version 2.6.26, created on 2012-05-10 09:02:35
         compiled from module_foot.html */ ?>
<?php if ($this->_tpl_vars['isnotice'] == 1): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_notice.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['lazy'] != ""): ?>
<script language="javascript" type="text/javascript" src="../pic/lazy_image.js"></script>
<script language="javascript">
lazyLoad.init();
</script>
<?php endif; ?>
</body>
</html>