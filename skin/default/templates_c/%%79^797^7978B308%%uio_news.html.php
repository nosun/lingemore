<?php /* Smarty version 2.6.26, created on 2011-09-29 16:20:53
         compiled from uio_news.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<ul class="news_list">
    <?php $_from = $this->_tpl_vars['rs_n']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
      <li>
      	<div class="shield">
			<p class="date month<?php echo $this->_tpl_vars['rows']['monthsNumTime']; ?>
"><span><?php echo $this->_tpl_vars['rows']['monthsTime']; ?>
</span><?php echo $this->_tpl_vars['rows']['dayTime']; ?>
<span>th</span></p>
		</div>
          <h3><a title="<?php echo $this->_tpl_vars['rows']['name']; ?>
"  class="newsdiva" href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a></h3>
          <div class="news_base_info"><?php echo $this->_tpl_vars['rows']['s_content']; ?>

          </div>
      </li>
  <?php endforeach; endif; unset($_from); ?>
</ul>