<?php /* Smarty version 2.6.26, created on 2011-10-10 09:27:16
         compiled from uio_search.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div class="main_ct">
<script language="javascript" type="text/javascript">
  function CheckForm()
  { 
if(!CheckIsNull("formadd","itemno","<?php echo $this->_tpl_vars['lg']['msg_orderno_null']; ?>
")) return false;
}

  </script>

<fieldset>
<legend><?php echo $this->_tpl_vars['lg']['order_search']; ?>
</legend>
<table width="100%" border="0" cellpadding="0" cellspacing="10">
<form action="<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=search_order" name="formadd" method="post"  enctype="application/x-www-form-urlencoded">
<tr>
                <td width="130" align="left"><?php echo $this->_tpl_vars['lg']['order_no']; ?>
: </td>
                <td><input name="itemno"  type="text"   class="input001" maxlength="100"> 
               <span class="impc">*</span></td>
</tr>
              

			   <tr>
                <td align="left">&nbsp;</td>
                <td><input type="submit" name="Submit" class="inputButton" onclick="return CheckForm()" value="<?php echo $this->_tpl_vars['lg']['search_order']; ?>
 &gt;&gt;"></td>
              </tr>
</form>
  </table>
</fieldset>

</div>