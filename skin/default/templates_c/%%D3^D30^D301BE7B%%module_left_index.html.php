<?php /* Smarty version 2.6.26, created on 2012-08-08 10:37:43
         compiled from module_left_index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'module_left_index.html', 18, false),)), $this); ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_class.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="w198 boxborder_gray" style="margin-bottom:10px; background:url(../pic/contactusbg.jpg) top repeat-x;">
  <div style="padding:5px;">
    <?php echo $this->_tpl_vars['content_71']; ?>

  </div>
</div>


<div class="w198  boxborder_gray" style="margin-bottom:10px;">
  <div class="pinkboxtop_198">What's News</div>
  <div class="w198">
         <ul class="newsul">         
         <?php $_from = $this->_tpl_vars['rs_n_1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_n_1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_n_1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_n_1']['iteration']++;
?>
            <li style="line-height:22px;"><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
" title="<?php echo $this->_tpl_vars['rows']['name']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['rows']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>
</a></li>
         <?php endforeach; endif; unset($_from); ?>
         </ul>
  </div>
</div>

<div class="w198 boxborder_gray" style="margin-bottom:10px; background:url(../pic/newsletterbg.jpg) top repeat-x #DBDBDB;">
   <div class="w198" style="height:47px;"><img src="../pic/newslettertop.jpg" /></div>
   <div style="padding:12px; font-size:11px;">
      <div style="margin-bottom:20px;">
      <strong>Specail Offers</strong> - Enjoy specail offers available only to our email subscribers.
      </div>
      <div style="margin-bottom:10px;">
      <strong>Get In The Know</strong> - Be the first to see ther latest styles and more events
      </div>
      <form onsubmit="return CheckNewsletterForm()" action="<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=add_newsletter" name="newletterform" method="post"  enctype="application/x-www-form-urlencoded">
      <div style="margin-bottom:10px;">
        <input name="email" id="email" style="width:150px; height:18px; border:1px #BEBEBE solid;  padding:0px; line-height:18px; background:#FFF;" value="Your Email Address" onfocus="if(this.value=='Your Email Address') this.value=''" onblur="if(this.value=='') this.value='Your Email Address'" />
      </div>
      <div><input type="image" src="../pic/newsletterbtn.jpg" /></div>
      </form>
      <script language="javascript">
        function CheckNewsletterForm()
        { 
            if(!CheckIsEmail("newletterform","email","<?php echo $this->_tpl_vars['lg']['msg_email_error']; ?>
")) return false;
        }
        </script>
   </div>
</div>


<div class="w198  boxborder_gray" style="margin-bottom:10px;">
  <div class="pinkboxtop_198">Payment And Shipping</div>
  <div class="w198">
       <?php echo $this->_tpl_vars['content_158']; ?>

  </div>
</div>