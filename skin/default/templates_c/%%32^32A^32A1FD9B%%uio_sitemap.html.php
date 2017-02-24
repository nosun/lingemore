<?php /* Smarty version 2.6.26, created on 2012-06-05 17:05:11
         compiled from uio_sitemap.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<style>
.smc1{ line-height:25px; padding-left:5px; height:25px;   }
.smc2{padding-left:20px; line-height:23px; }
.smc3{padding-left:35px;  line-height:23px;}
.smc4{ padding-left:45px; line-height:23px;}
.smc5{padding-left:60px; line-height:23px;}
a.sma1{color: #686868;font-weight:bold; font-size:14px; padding:5px;}
a.sma1:hover{color:#686868;font-weight:bold; font-size:14px}

a.sma2{color:#686868;}
a.sma2:hover{color: #686868;}

a.sma3{color: #ffffff;}
a.sma3:hover{color:#ffffff;}

a.sma4{color: #ffffff;}
a.sma4:hover{color:#ffffff;}

a.sma5{color: #ffffff;}
a.sma5:hover{color:#ffffff;}
</style>
<div class="main_ct">
<div style="text-align:center">
<?php $_from = $this->_tpl_vars['rs_top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_top'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_top']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_top']['iteration']++;
?>
<a href="<?php echo $this->_tpl_vars['rows']['url']; ?>
" class="sma1"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a>
<?php endforeach; endif; unset($_from); ?>
</div>
<div style=" margin-top:30px">

<?php $_from = $this->_tpl_vars['rs_index']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_index'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_index']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_index']['iteration']++;
?>
	 <div style="float:left; width:185px; margin-top:10px;">
	<div style="line-height:21px; width:185px;   height:21px;  "> <a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
" class="a1"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a></div>
	 <?php $_from = $this->_tpl_vars['rows']['arrson']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_help'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_help']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['orows']):
        $this->_foreach['rs_help']['iteration']++;
?>
	 <div style="line-height:26px;   height:26px;"><a href="<?php echo $this->_tpl_vars['orows']['rewrite']; ?>
" class="a2"><?php echo $this->_tpl_vars['orows']['name']; ?>
</a></div>
	  <?php endforeach; endif; unset($_from); ?>
	  </div>
	  <?php if ($this->_foreach['rs_index']['iteration']%4 == 0): ?>
<div class="clear1" style="border-bottom:1px #cccccc solid"></div>
<?php endif; ?>
	 <?php endforeach; endif; unset($_from); ?>
<div class="clear1"></div>
</div>
<div class="clear1"></div>
</div>