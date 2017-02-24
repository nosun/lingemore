<?php /* Smarty version 2.6.26, created on 2012-06-05 08:41:29
         compiled from uio_shopcart.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">

<div class="main_ct2" style="margin-top:6px">
<div style="height:24px; line-height:24px; font-weight:bold; background:#666;"><span style="margin-left:20px; color:#ffffff"><?php echo $this->_tpl_vars['lg']['cart_title']; ?>
</span></div>
<?php if ($this->_tpl_vars['items'] != 0): ?>
<script language="javascript">
function submit_shopcart_data()
{
	$("#gonextpage").val("yes");
	$("#uio_order").submit();
}
</script><form name="uio_order" id="uio_order" action="<?php echo $this->_tpl_vars['folder']; ?>
shopcart.php?action=edit" method="post"><input id="gonextpage" name="gonextpage" type="hidden" value="" />
<table width="100%" border="0" cellpadding="5" cellspacing="0" style="border:0px #E7E7E7 solid;">

			  <tr>
                <td width="470" height="16"  align="left" bgcolor="#eeeeee" class="weight"><?php echo $this->_tpl_vars['lg']['products']; ?>
</td>
                <td align="center" bgcolor="#eeeeee" class="weight"><?php echo $this->_tpl_vars['lg']['unit_price']; ?>
</td>
                <td align="center"  bgcolor="#eeeeee" class="weight"><?php echo $this->_tpl_vars['lg']['quantity']; ?>
</td>
                <td align="center"  bgcolor="#eeeeee" class="weight"><?php echo $this->_tpl_vars['lg']['sub_total']; ?>
</td>
                <td align="center" width="120"  bgcolor="#eeeeee" class="weight">&nbsp;</td>
    </tr>
            
 <?php $_from = $this->_tpl_vars['rs_sc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['rows']):
?>
                <tr>
                  <td align="center" class="xuxian">
				  
				  <table width="100%" border="0" cellspacing="8" cellpadding="0">
  <tr>
    <td width="100" align="center" valign="top"> <a  target="_blank" class="shopcartimga"  href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img alt="<?php echo $this->_tpl_vars['rows']['name']; ?>
" title="<?php echo $this->_tpl_vars['rows']['name']; ?>
" src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0" /></a></td>
    <td align="left" valign="top" class="linh"><a target="_blank" class="shopcartas"  href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
">
      <span ><?php echo $this->_tpl_vars['rows']['name']; ?>
</span>
    </a><br />
    <em>
    <?php echo $this->_tpl_vars['rows']['pstyle']; ?>
</em><br>
<textarea name="content<?php echo $this->_tpl_vars['index']; ?>
" style="width:200px; height:50px; border:1px #7F9DB9 solid; overflow-y:scroll"><?php echo $this->_tpl_vars['rows']['pcontent']; ?>
</textarea></td>
  </tr>
</table>				 </td>
<td align="center" valign="top" class="xuxian shopcartpadding"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['rows']['price']; ?>
</td>
                  <td align="center" valign="top" class="xuxian shopcartpadding">  <input class="shopcartinput" style="text-align:center" name="num<?php echo $this->_tpl_vars['index']; ?>
" type="text"  value="<?php echo $this->_tpl_vars['rows']['pnum']; ?>
" size="16" maxlength="16" ></td>
                  <td align="center" valign="top"  class="xuxian shopcartpadding"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['rows']['itemprice']; ?>
</td>
                  <td align="center" valign="top" class="xuxian shopcartpadding"><a href="<?php echo $this->_tpl_vars['folder']; ?>
shopcart.php?action=delete&index=<?php echo $this->_tpl_vars['index']; ?>
"><span class="red"><?php echo $this->_tpl_vars['lg']['remove_item']; ?>
</span></a></td>
                </tr>
                
				<?php endforeach; endif; unset($_from); ?>
                <tr>
                  <td colspan="2" align="right" ></td>
                  <td align="center" valign="top" ><input name="cqtysubmit" class="profilebutton" type="submit" value="<?php echo $this->_tpl_vars['lg']['update_qty_remark']; ?>
" /></td>
                  <td colspan="2" align="right"  ><input name="cqtysubmit" class="profilebutton" onclick="location.href='<?php echo $this->_tpl_vars['folder']; ?>
shopcart.php?action=clean'" type="button" value="<?php echo $this->_tpl_vars['lg']['remove_all']; ?>
" />
</td>
      </tr>
 
</table><table width="100%" border="0">
  <tr>
    <td align="right"><div style="font-size:14px; margin-top:8px; color:#666666" class="weight"><?php echo $this->_tpl_vars['lg']['products_price']; ?>
: <span class="red"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['totalprice']; ?>
</span></div>
<div style="font-size:14px; margin-top:8px; color:#666666" class="weight"> <?php echo $this->_tpl_vars['lg']['discount_price']; ?>
: <span class="red"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['sub4']; ?>
</span></div>

 <?php if ($this->_tpl_vars['sub3'] != 0): ?>
    
                   <div style="font-size:14px; margin-top:8px; color:#666666" class="weight"> <?php echo $this->_tpl_vars['lg']['order_additional_price']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['sub3']; ?>
</span></div>
                 <?php endif; ?>

<div style="font-size:14px; margin-top:8px; color:#666666" class="weight"><?php echo $this->_tpl_vars['lg']['sub_total']; ?>
 : <span class="red"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['totalprice']+$this->_tpl_vars['sub3']+$this->_tpl_vars['sub4']; ?>
</span></div></td>
  </tr>
</table>
 
<div style="margin-top:20px; border-bottom:2px #cccccc solid;"></div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:20px;">
<tr>
	<td  align="right" ><a href="products.php"><img src="../pic/continueshopping.jpg" /></a></td>
    <td width="160"  >&nbsp; </td>
    <td  align="left" ><a  href="javascript:submit_shopcart_data()"><img src="../pic/checkout_button1.gif" width="169" height="31" border="0" /></a></td>
</tr>
  </table></form>
<?php else: ?>
<div style="padding:10px">
<span class="weight"><?php echo $this->_tpl_vars['lg']['cart_is_empty']; ?>
</span><br>
<br>
<?php echo $this->_tpl_vars['lg']['cart_is_empty_content']; ?>

</div>
<?php endif; ?>
</div>