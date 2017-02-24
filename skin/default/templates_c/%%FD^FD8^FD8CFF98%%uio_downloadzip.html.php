<?php /* Smarty version 2.6.26, created on 2011-06-24 16:37:51
         compiled from uio_downloadzip.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<style>
.smc1{padding-left:5px; clear:both; line-height:24px; height:24px; border-bottom:1px #E6E6E6 solid; }
.smc2{padding-left:20px; line-height:24px;clear:both; height:24px; border-bottom:1px #E6E6E6 dotted; background-color:#FFF9E9; }
.smc3{padding-left:35px;  line-height:23px;}
.smc1 .namediv{ width:230px; float:left;background:url(../pic/cd1_bg.jpg)  9px no-repeat ;}
.smc1 .downloaddiv{width:20px; float:right; display:inline-block; text-align:center;}
.smc1 .timediv{ width:100px; float:right; text-align:center;}
.smc2 .namediv{ width:230px; float:left;background:url(../pic/cd2_bg.jpg) 8px 9px no-repeat ;}
.smc2 .downloaddiv{ width:20px; display:inline-block; float:right;text-align:center}
.smc2 .timediv{ width:100px; float:right; text-align:center; }
a.sma1{color: #000000;font-weight:bold; margin-left:25px }
a.sma1:hover{color:#000000;font-weight:bold;margin-left:25px }

a.sma2{color:#000000;margin-left:20px; }
a.sma2:hover{color: #000000;margin-left:20px; }

a.sma3{color: #ffffff;}
a.sma3:hover{color:#ffffff;}

</style>
<script language="javascript">
function showdownloadidv(id)
{
	var obj=document.getElementById(id);
	if (obj.style.display=="none")
	 {obj.style.display="block";}
	else
	 {obj.style.display="none";}
}
</script>
<div class="main_ct">
<div style=" border:1px #CACACA solid; width:748px; overflow:hidden;">

<?php $_from = $this->_tpl_vars['rs_zip']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_zip'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_zip']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_zip']['iteration']++;
?>
	<div class="smc1"> 
	<div class="namediv"><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
" class="sma1"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a></div>
    <?php if ($this->_tpl_vars['rows']['rartime'] != '1970-01-01'): ?>
	<div class="timediv"><?php echo $this->_tpl_vars['rows']['rartime']; ?>
</div>
	<div class="downloaddiv"><a target="_blank" href="<?php echo $this->_tpl_vars['rows']['download']; ?>
"><img align="absmiddle" src="../pic/downloadpic.jpg" vspace="5" /></a></div>
	<?php endif; ?>
	</div>
	<div style="display:none" id="downloadidv<?php echo $this->_tpl_vars['rows']['id']; ?>
" >
	 <?php $_from = $this->_tpl_vars['rows']['arrson']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_help'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_help']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['orows']):
        $this->_foreach['rs_help']['iteration']++;
?>
	 <div class="smc2">
	  <div class="namediv"><a href="<?php echo $this->_tpl_vars['orows']['rewrite']; ?>
" class="sma2"><?php echo $this->_tpl_vars['orows']['name']; ?>
</a></div>
	<?php if ($this->_tpl_vars['orows']['rartime'] != '1970-01-01'): ?>
	<div class="timediv"><?php echo $this->_tpl_vars['orows']['rartime']; ?>
</div>
	<div class="downloaddiv"><a target="_blank" href="<?php echo $this->_tpl_vars['orows']['download']; ?>
"><img align="absmiddle" src="../pic/downloadpic.jpg" vspace="5" /></a></div>
	<?php endif; ?>
	  </div>
	  <?php endforeach; endif; unset($_from); ?>
	</div>
	 <?php endforeach; endif; unset($_from); ?>

</div>

</div>