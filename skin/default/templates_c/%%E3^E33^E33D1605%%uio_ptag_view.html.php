<?php /* Smarty version 2.6.26, created on 2010-07-25 11:58:52
         compiled from uio_ptag_view.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<script src="../pic/prototype.js" type="text/javascript"></script>
<div class="main_ct">
<?php $_from = $this->_tpl_vars['rs_p']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_p'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_p']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_p']['iteration']++;
?>
<div class="productdiv3">
<table width="100%" border="0"  cellspacing="10" cellpadding="0" style="border-bottom:1px #999999 dotted">

  <tr>
    <td width="140" height="125"  align="center" valign="middle" style="border:1px #E7E7E7 solid;"><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0"/></a></td>
    <td  align="left" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="0">
      <tr>
        <td><a class="weight" href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a></td>
      </tr>
       <tr>
        <td><span class="red weight"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price']; ?>
</span></td>
      </tr>
      <tr>
        <td><span>Itemno :  <?php echo $this->_tpl_vars['rows']['itemno']; ?>
</span></td>
      </tr> 
      <tr>
        <td>Tag : <?php $_from = $this->_tpl_vars['rows']['tag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rowstag'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rowstag']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['orows']):
        $this->_foreach['rowstag']['iteration']++;
?>
<a href="<?php echo $this->_tpl_vars['orows']['rewrite']; ?>
"  class="tag"><?php echo $this->_tpl_vars['orows']['name']; ?>
</a>
<?php endforeach; endif; unset($_from); ?></td>
      </tr>
      <tr>
        <td><?php echo $this->_tpl_vars['rows']['s_content']; ?>
</td>
      </tr>
      <tr>
        <td align="right">
		<a  href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img src="../pic/big_addto.jpg" width="117" height="24" style="margin-top:5px" /></a>		</td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
<?php endforeach; endif; unset($_from); ?>
 <div style=" position:absolute; display:none; z-index:500; background-color:#FFFFFF" id="_divShoppingcart">
  <table width="350"  border="0" cellpadding="5" cellspacing="0" style="border:1px #BADBF2 solid" >
    <tr>
      <td bgcolor="#EDF7FD" style="border-bottom:1px dotted #CCCCCC"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../pic/right.jpg" width="16" height="16" hspace="5" align="absmiddle" />Add Success </td>
    <td width="30" align="center"><a href="javascript:void(0)" onclick="_close_divShoppingcart()"><strong>X</strong></a></td>
  </tr>
</table>
 </td>
    </tr>
    <tr>
      <td align="center" id="ajax_result_div"> </td>
    </tr>
	<tr>
      <td align="center"><input type="button" onclick="location.href='<?php echo $this->_tpl_vars['folder']; ?>
shopcart.html'" name="Submit2" value="Shopping Cart" />
        &nbsp;&nbsp; &nbsp;<input onclick="_close_divShoppingcart()" type="button" value="Continue" /></td>
    </tr>
  </table> 
  </div>
</div>