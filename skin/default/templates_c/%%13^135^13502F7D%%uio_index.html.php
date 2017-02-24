<?php /* Smarty version 2.6.26, created on 2012-10-11 15:34:21
         compiled from uio_index.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">

<div class="w772" style="margin-bottom:10px;">
  <div class="boxtop_772">
    <div class="boxtop_772_left">New Products</div>
    <div class="boxtop_772_right"><a class="more" href="<?php echo $this->_tpl_vars['folder']; ?>
?New-Products-s1.html">More&gt;&gt;</a></div>
  </div>
  <div class="w770 boxborder1_pink">
  <?php $_from = $this->_tpl_vars['rs_p_1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_p_1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_p_1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_p_1']['iteration']++;
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
        <?php if ($this->_foreach['rs_p_1']['iteration']%5 == 0): ?>
        <div class="clear1"></div>
        <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
        <div class="clear1"></div>
  </div>
</div>

<div class="w772" style="margin-bottom:10px;">
  <div class="boxtop_772">
    <div class="boxtop_772_left">Hot Products</div>
    <div class="boxtop_772_right"><a class="more" href="<?php echo $this->_tpl_vars['folder']; ?>
?Hot-Products-s2.html">More&gt;&gt;</a></div>
  </div>
  <div class="w770 boxborder1_pink">
  <?php $_from = $this->_tpl_vars['rs_p_2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_p_2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_p_2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_p_2']['iteration']++;
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
        <?php if ($this->_foreach['rs_p_2']['iteration']%5 == 0): ?>
        <div class="clear1"></div>
        <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
        <div class="clear1"></div>
  </div>
</div>

<div class="w772" style="">
  <div class="boxtop_772">
    <div class="boxtop_772_left">Why Choose Us?</div>
    <div class="boxtop_772_right"></div>
  </div>
  <div class="w770 boxborder1_pink">
   <div style="padding:8px;"><?php echo $this->_tpl_vars['content_159']; ?>
</div>
  </div>
</div>