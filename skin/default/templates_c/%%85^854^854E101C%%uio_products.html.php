<?php /* Smarty version 2.6.26, created on 2011-07-04 09:56:02
         compiled from uio_products.html */ ?>
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
<div class="main_ct">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_product_relative_class.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table width="100%" border="0" cellspacing="5" cellpadding="0" style="border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;">
  <tr>
    <td width="80"><a href="<?php echo $this->_tpl_vars['rewrite']['table']; ?>
"><img hspace="3"  src="../pic/table.gif"  /></a></td>
    <td><a href="<?php echo $this->_tpl_vars['rewrite'][12]; ?>
"><img id="imgNum0" src="../pic/ps_12_o.gif" hspace="3" /></a><a href="<?php echo $this->_tpl_vars['rewrite'][20]; ?>
"><img id="imgNum1"  src="../pic/ps_20_o.gif" hspace="3"  /></a><a href="<?php echo $this->_tpl_vars['rewrite'][40]; ?>
"><img id="imgNum2"  src="../pic/ps_40_o.gif" hspace="3"  /></a><a href="<?php echo $this->_tpl_vars['rewrite'][60]; ?>
"><img id="imgNum3"  src="../pic/ps_60_o.gif" hspace="3"  /></a><a href="<?php echo $this->_tpl_vars['rewrite'][80]; ?>
"><img id="imgNum4"  src="../pic/ps_80_o.gif" hspace="3"  /></a></td><td width="50">Order By </td>
    <td width="230">
    <select  id="orderitem" name="orderitem"   onchange="MM_jumpMenu('parent',this,0)">
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
      <select id="orderby" name="orderby"  onchange="MM_jumpMenu('parent',this,0)">
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
		  document.getElementById("imgNum" + <?php echo $this->_tpl_vars['numindex']; ?>
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
<div class="productdiv2">
<table width="150" border="0"  cellspacing="0" cellpadding="0" style="background:url(../pic/productbg.gif); ">  <tr>
    <td  height="150" align="center" style="border:1px #E7E7E7 solid;">
    <a  href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img title="<?php echo $this->_tpl_vars['rows']['name']; ?>
" alt="<?php echo $this->_tpl_vars['rows']['bigpic']; ?>
" src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
"  border="0"/></a>
    </td>
  </tr>
  <tr>
    <td class="linh" align="center">
	<a  href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['rows']['search_name']; ?>
</a><br />

	<span class="red"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price']; ?>
</span>(<?php echo $this->_tpl_vars['rows']['totalsale']; ?>
)<br />
<a  href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img vspace="3" src="../pic/addtocart.jpg" /></a>

</td>
  </tr>
</table>
</div>
<?php if ($this->_foreach['rs_p']['iteration']%4 == 0): ?>
<div class="clear1"></div>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</div>