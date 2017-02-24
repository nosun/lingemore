<?php /* Smarty version 2.6.26, created on 2011-10-18 14:58:14
         compiled from module_profile_page.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'module_profile_page.html', 11, false),)), $this); ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<table width="100%" border="0" cellspacing="0" cellpadding="6" class="profilepagetable">
<tr>
	<td  style="padding:2"  align="left">
	<?php echo $this->_tpl_vars['lg']['total']; ?>
 <?php echo $this->_tpl_vars['recordcount']; ?>
 <?php echo $this->_tpl_vars['lg']['page_record']; ?>
 , <?php echo $this->_tpl_vars['pagenow']; ?>
 / <?php echo $this->_tpl_vars['pagetotal']; ?>

	</td>
	<td  style="padding:2"  align="right">
	<a class="profilepage"  href="<?php echo $this->_tpl_vars['pageurl']; ?>
&page=<?php echo $this->_tpl_vars['pagepre']; ?>
"><?php echo $this->_tpl_vars['lg']['page_pre']; ?>
</a> 
<?php unset($this->_sections['page']);
$this->_sections['page']['name'] = 'page';
$this->_sections['page']['start'] = (int)1;
$this->_sections['page']['loop'] = is_array($_loop=$this->_tpl_vars['maxpagenum']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['page']['show'] = true;
$this->_sections['page']['max'] = $this->_sections['page']['loop'];
$this->_sections['page']['step'] = 1;
if ($this->_sections['page']['start'] < 0)
    $this->_sections['page']['start'] = max($this->_sections['page']['step'] > 0 ? 0 : -1, $this->_sections['page']['loop'] + $this->_sections['page']['start']);
else
    $this->_sections['page']['start'] = min($this->_sections['page']['start'], $this->_sections['page']['step'] > 0 ? $this->_sections['page']['loop'] : $this->_sections['page']['loop']-1);
if ($this->_sections['page']['show']) {
    $this->_sections['page']['total'] = min(ceil(($this->_sections['page']['step'] > 0 ? $this->_sections['page']['loop'] - $this->_sections['page']['start'] : $this->_sections['page']['start']+1)/abs($this->_sections['page']['step'])), $this->_sections['page']['max']);
    if ($this->_sections['page']['total'] == 0)
        $this->_sections['page']['show'] = false;
} else
    $this->_sections['page']['total'] = 0;
if ($this->_sections['page']['show']):

            for ($this->_sections['page']['index'] = $this->_sections['page']['start'], $this->_sections['page']['iteration'] = 1;
                 $this->_sections['page']['iteration'] <= $this->_sections['page']['total'];
                 $this->_sections['page']['index'] += $this->_sections['page']['step'], $this->_sections['page']['iteration']++):
$this->_sections['page']['rownum'] = $this->_sections['page']['iteration'];
$this->_sections['page']['index_prev'] = $this->_sections['page']['index'] - $this->_sections['page']['step'];
$this->_sections['page']['index_next'] = $this->_sections['page']['index'] + $this->_sections['page']['step'];
$this->_sections['page']['first']      = ($this->_sections['page']['iteration'] == 1);
$this->_sections['page']['last']       = ($this->_sections['page']['iteration'] == $this->_sections['page']['total']);
?>

 <a class="profilepage"  href="<?php echo $this->_tpl_vars['pageurl']; ?>
&page=<?php echo smarty_function_math(array('equation' => 'x * 10 + y','x' => $this->_tpl_vars['pagetmp'],'y' => $this->_sections['page']['index']), $this);?>
"><?php echo smarty_function_math(array('equation' => 'x * 10 + y','x' => $this->_tpl_vars['pagetmp'],'y' => $this->_sections['page']['index']), $this);?>
</a> 
<?php endfor; endif; ?>
 <a class="profilepage"  href="<?php echo $this->_tpl_vars['pageurl']; ?>
&page=<?php echo smarty_function_math(array('equation' => 'x + y','x' => $this->_tpl_vars['pagenow'],'y' => 1), $this);?>
"><?php echo $this->_tpl_vars['lg']['page_next']; ?>
</a> 
	</td>
  </tr> 
</table>