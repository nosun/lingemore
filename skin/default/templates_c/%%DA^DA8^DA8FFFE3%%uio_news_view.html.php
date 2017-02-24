<?php /* Smarty version 2.6.26, created on 2011-09-28 16:18:05
         compiled from uio_news_view.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div class="right_info_box">
    <h1 class="title"><?php echo $this->_tpl_vars['n']['name']; ?>
</h1>
    <?php echo $this->_tpl_vars['n']['pagecontent']; ?>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_news_page.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>