<?php /* Smarty version 2.6.26, created on 2010-07-09 14:20:21
         compiled from module_norewritepage.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'module_norewritepage.html', 13, false),)), $this); ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<table width="100%" border="0" cellspacing="0" cellpadding="5" style="margin-top:10px;">
<tr>
	<td  style="padding:2"  align="left">
	<?php echo $this->_tpl_vars['recordcount']; ?>
 Item(s) Page <?php echo $this->_tpl_vars['pagenow']; ?>
 of <?php echo $this->_tpl_vars['pagetotal']; ?>

	</td>
	<td  style="padding:2"  align="right">
<?php if ($this->_tpl_vars['pagenow'] >= 2): ?>
	<a class="page"  href="<?php echo $this->_tpl_vars['pageurl']; ?>
&page=<?php echo $this->_tpl_vars['pagepre']; ?>
">&lt;</a> 
<?php endif; ?>

<?php if ($this->_tpl_vars['pagetmp'] >= 1): ?> 
 <a class="page"  href="<?php echo $this->_tpl_vars['pageurl']; ?>
&page=<?php echo smarty_function_math(array('equation' => 'x * y','x' => $this->_tpl_vars['pagetmp'],'y' => 10), $this);?>
">&lt;&lt;</a> 
<?php endif; ?>

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
<?php if ($this->_tpl_vars['pagenow'] != ( $this->_tpl_vars['pagetmp']*10 + $this->_sections['page']['index'] )): ?> 
 <a class="page"  href="<?php echo $this->_tpl_vars['pageurl']; ?>
&page=<?php echo smarty_function_math(array('equation' => 'x * 10 + y','x' => $this->_tpl_vars['pagetmp'],'y' => $this->_sections['page']['index']), $this);?>
"><?php echo smarty_function_math(array('equation' => 'x * 10 + y','x' => $this->_tpl_vars['pagetmp'],'y' => $this->_sections['page']['index']), $this);?>
</a> 
<?php else: ?>
	<span class="pageon"><?php echo $this->_tpl_vars['pagenow']; ?>
</span>
<?php endif; ?>
<?php endfor; endif; ?>

<?php if ($this->_tpl_vars['pagenow'] < $this->_tpl_vars['pagetotal']): ?>
 <a class="page"  href="<?php echo $this->_tpl_vars['pageurl']; ?>
&page=<?php echo smarty_function_math(array('equation' => 'x + y','x' => $this->_tpl_vars['pagenow'],'y' => 1), $this);?>
">&gt;</a> 
<?php endif; ?>

<?php if ($this->_tpl_vars['pagetmp'] < $this->_tpl_vars['pagemaxnum']): ?> 
 <a class="page" href="<?php echo $this->_tpl_vars['pageurl']; ?>
&page=<?php echo smarty_function_math(array('equation' => ' ( x + 1 ) * 10 + 1','x' => $this->_tpl_vars['pagetmp']), $this);?>
">&gt;&gt;</a> 
<?php endif; ?>
<input name="pagenow" value="<?php echo $this->_tpl_vars['pagenow']; ?>
" id="tb_page" type="text" size="3" class="pageinput"  /><input onclick="gotoPage()" class="pagebutton" value="GO" type="button" />
<script language="javascript">
function gotoPage()
{
	var page = $2("tb_page").value ;
	if( isNaN(page) )
	{
		alert("You should enter a number");
		return ;
	}
	location.href = "<?php echo $this->_tpl_vars['pageurl']; ?>
&page=" + parseInt(page);
}
</script>
	</td>
  </tr> 
</table>