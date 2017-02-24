<?php /* Smarty version 2.6.26, created on 2012-10-11 16:07:40
         compiled from uio_products1.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">

<style>

.zoom2 { border:1px #A6A6A6 solid}

</style>

<script type="text/JavaScript">

<!--

function MM_jumpMenu(targ,selObj,restore){ //v3.0

  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");

  if (restore) selObj.selectedIndex=0;

}

//-->

</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_product_relative_class.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>











  <?php $_from = $this->_tpl_vars['rs_p']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_p'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_p']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_p']['iteration']++;
?>

       <div class="productdiv1">
         <div class="productdiv1box">
             <div class="productdiv1img">
              <p><a  href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img title="<?php echo $this->_tpl_vars['rows']['name']; ?>
" alt="<?php echo $this->_tpl_vars['rows']['name']; ?>
" lazy_data_src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
"  src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
"  border="0"/></a></p>
             </div>
              <?php if ($this->_tpl_vars['rows']['showicon'] == 1): ?><div class="phot"></div><?php endif; ?>
              <?php if ($this->_tpl_vars['rows']['showicon'] == 2): ?><div class="pnew"></div><?php endif; ?>
              <div class="productdiv1info">
                 <a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a>
                 <span class="gray" style="text-decoration:line-through;"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price2']; ?>
</span> <span class="price"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price']; ?>
</span>
                 <a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img src="../pic/smallcart.jpg" border="0" style="vertical-align:middle;" /></a>
              </div>
          </div>
        </div>

        <?php if ($this->_foreach['rs_p']['iteration']%5 == 0): ?>

        <div class="clear1"></div>

        <?php endif; ?>

  <?php endforeach; endif; unset($_from); ?>

 <div class="clear1"></div>
