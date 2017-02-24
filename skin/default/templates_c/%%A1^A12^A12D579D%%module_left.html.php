<?php /* Smarty version 2.6.26, created on 2012-11-05 17:10:04
         compiled from module_left.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'module_left.html', 35, false),)), $this); ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_class.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (1 == 2): ?>

<div class="w220" style="margin-bottom:10px;">

  <div class="boxtop_220">Service Online</div>

  <div class="w218 boxborder_gray1">

    <?php echo $this->_tpl_vars['content_71']; ?>


  </div>

</div>

<?php endif; ?>





<div class="w220" style="margin-bottom:10px;">

  <div class="boxtop_220">News</div>

  <div class="w218 boxborder_gray1">

        <ul class="newsul">         

         <?php $_from = $this->_tpl_vars['rs_n_1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_n_1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_n_1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_n_1']['iteration']++;
?>

            <li style="line-height:22px;"><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
" title="<?php echo $this->_tpl_vars['rows']['name']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['rows']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 35, "...", true) : smarty_modifier_truncate($_tmp, 35, "...", true)); ?>
</a></li>

         <?php endforeach; endif; unset($_from); ?>

         </ul>

  </div>

</div>





<div class="w220" style="">

  <div class="boxtop_220">Best Sellers</div>

  <div class="w218 boxborder_gray1">

	<?php $_from = $this->_tpl_vars['rs_p_4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_p_4'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_p_4']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_p_4']['iteration']++;
?>

    <table width="168" border="0"  cellspacing="5" cellpadding="0" style="background:url(../pic/productbg.gif); margin:auto; border-bottom:1px #DEDBDB solid; margin-bottom:10px;">  

       <tr>

        <td align="center" valign="top"><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img  width="60"  src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0"/></a></td>

        <td class="linh" valign="top">

          <a class="producta" href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a><br />

          <span class="gray" style="text-decoration:line-through;"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price2']; ?>
</span><br />

          <span class="price"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price']; ?>
</span>

    </td>

      </tr>

    </table>

    <?php if ($this->_foreach['rs_p_4']['iteration']%5 == 0): ?>

    <div class="clear1"></div>

    <?php endif; ?>

    <?php endforeach; endif; unset($_from); ?>
    <div style="text-align:right; padding-right:10px; line-height:25px;">
     <a style="color:#F69" href="<?php echo $this->_tpl_vars['folder']; ?>
Best-Sellers-s3.html">more &raquo;</a>
    </div>
  </div>

</div>
