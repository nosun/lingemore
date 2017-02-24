<?php /* Smarty version 2.6.26, created on 2011-05-13 11:37:15
         compiled from module_product_relative_class.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<?php if ($this->_tpl_vars['rs_relate']): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px #FFC44C dotted; margin-bottom:5px; padding:5px;">
  <tr>
    <td><div>
	<span style="font-size:14px; font-weight:bold">Search Results of "<span class="red weight"><?php echo $this->_tpl_vars['search_keywords']; ?>
</span>" from <?php echo $this->_tpl_vars['categoryname']; ?>
</span><br />
	<span style="font-size:11px; padding-left:10px"><img align="absmiddle" src="../pic/search_result.jpg" /> about <?php echo $this->_tpl_vars['search_totalnum']; ?>
 related products has been found</span>
</div>
	<?php $_from = $this->_tpl_vars['rs_relate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_relate'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_relate']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_relate']['iteration']++;
?>
        <div class="searchclassdiv">
         <a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
 <span>(<?php echo $this->_tpl_vars['rows']['t']; ?>
)</span></a>
        </div>
        <?php if ($this->_foreach['rs_relate']['iteration']%4 == 0): ?>
        <div class="clear1"></div>
        <?php endif; ?><?php endforeach; endif; unset($_from); ?>
	</td>
  </tr>
</table>
<?php endif; ?>