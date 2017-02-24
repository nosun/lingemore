<?php /* Smarty version 2.6.26, created on 2012-05-08 11:12:34
         compiled from uio_products3.html */ ?>
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

<table width="100%" border="0" cellspacing="5" cellpadding="0" style="border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;">
  <tr>
    <td width="431"><a class="list" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['list']; ?>
"></a> <a class="grid" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['grid']; ?>
"></a> <a class="gallery_on" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['gallery']; ?>
"></a></td>
    <td width="176" id="pronumbersel">
    <?php $_from = $this->_tpl_vars['mode']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mode'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mode']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['mode']['iteration']++;
?>
    <a class="mode <?php if ($this->_tpl_vars['key1'] == $this->_tpl_vars['numindex']): ?>mode_now<?php endif; ?>" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite'][$this->_tpl_vars['rows']]; ?>
"><?php echo $this->_tpl_vars['rows']; ?>
</a>
    <?php endforeach; endif; unset($_from); ?>
    </td>
    <td width="74">Order By </td>
    <td width="323">
    <select rel="nofollow" id="orderitem" name="orderitem"   onchange="MM_jumpMenu('parent',this,0)">
	<option value="<?php echo $this->_tpl_vars['rewrite']['orderid']; ?>
">Product ID</option>
	<option value="<?php echo $this->_tpl_vars['rewrite']['orderitemno']; ?>
">Itemno ID</option>
	<option value="<?php echo $this->_tpl_vars['rewrite']['ordername']; ?>
">Product Name</option>
	<option value="<?php echo $this->_tpl_vars['rewrite']['orderprice']; ?>
">Product Price</option>
	<option value="<?php echo $this->_tpl_vars['rewrite']['ordertime']; ?>
">Product Addtime</option>
	<option value="<?php echo $this->_tpl_vars['rewrite']['ordersort']; ?>
">Product Sort</option>
	<option value="<?php echo $this->_tpl_vars['rewrite']['orderview']; ?>
">Product Views</option>
      </select>
      <select rel="nofollow" id="orderby" name="orderby"  onchange="MM_jumpMenu('parent',this,0)">
	  <option value="<?php echo $this->_tpl_vars['rewrite']['bydesc']; ?>
">Descendingly</option>
	   <option value="<?php echo $this->_tpl_vars['rewrite']['byasc']; ?>
">Ascendingly</option>
	  
      </select>
	  <script language="javascript">
	  try{
		  EnterSelectIndex("orderitem",<?php echo $this->_tpl_vars['orderindex']; ?>
);
		  EnterSelectIndex("orderby",<?php echo $this->_tpl_vars['orderbyindex']; ?>
);
		  //document.getElementById("imgNum" + <?php echo $this->_tpl_vars['numindex']; ?>
).src="../pic/ps_<?php echo $this->_tpl_vars['pagesize']; ?>
_i.gif";
		 }
		 catch(e)
		 {}
	  </script> </td>
  </tr>
</table>

  <?php $_from = $this->_tpl_vars['rs_p']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_p'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_p']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_p']['iteration']++;
?>
      <div class="productdiv3">
             <div class="productdiv3img">
              <p><a  href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img title="<?php echo $this->_tpl_vars['rows']['name']; ?>
" alt="<?php echo $this->_tpl_vars['rows']['largerpic']; ?>
" lazy_data_src="<?php echo $this->_tpl_vars['rows']['largerpic']; ?>
"  src="../pic/blankpic.gif"  border="0"/></a></p>
             </div>
              <div class="productdiv3info">
                 <a class="producta" href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a><br />
                 <span class="red weight"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['rows']['price']; ?>
</span>
              </div>
          </div>
          <?php if ($this->_foreach['rs_p']['iteration']%3 == 0): ?>
          <div class="clear1"></div>
          <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
 <div class="clear1"></div>