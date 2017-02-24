<?php /* Smarty version 2.6.26, created on 2010-11-22 15:42:10
         compiled from uio_download.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div class="main_ct">
<table border="0" cellspacing="0" class="list_table">
              <tr>
              <td > 
			<?php $_from = $this->_tpl_vars['rs_d']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_d'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_d']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_d']['iteration']++;
?>
			  <div class="divitem">
			  		<div class="div1"><div class="div11"><?php echo $this->_tpl_vars['rows']['name']; ?>
</div><div class="div12"><?php echo $this->_tpl_vars['rows']['addtime']; ?>
</div><div class="div12"><a target="_blank" href="<?php echo $this->_tpl_vars['folder']; ?>
download/<?php echo $this->_tpl_vars['rows']['path']; ?>
"><strong>Download</strong></a></div></div>
			  </div>
			<?php endforeach; endif; unset($_from); ?>
			  </td>
            </tr>
			
          </table>
</div>