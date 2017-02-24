<?php /* Smarty version 2.6.26, created on 2012-06-05 11:16:01
         compiled from module_coin.html */ ?>
<div id="currency" style="width:60px; display:inline-block; float:left; overflow:hidden; background:url(../pic/tabs_3_.gif) no-repeat;">
                    <div style="width:140px; float:none; clear:both; text-align:left;"><span style="color:#333;padding-left:12px; line-height:20px; text-align:left;"><span style="text-decoration:underline"><?php echo $this->_tpl_vars['coin']; ?>
</span> <img style="vertical-align:middle" align="absmiddle" width="16" height="12" src="<?php echo $this->_tpl_vars['coinpic']; ?>
" border="0" /></span>
                    </div>
                    <div id="currencybox" style="width:128px; clear:both; padding:5px;  z-index:1000; border:1px #979797 solid; border-top:0px; position:absolute; margin-left:0px;  margin-top:0px; display:none; background:#FFF;">
                        <?php $_from = $this->_tpl_vars['rs_coin']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_coin'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_coin']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_coin']['iteration']++;
?>
                           <div style="line-height:20px; font-size:11px; text-align:left; margin-left:6px">
                             <img align="absmiddle" hspace="3" src="<?php echo $this->_tpl_vars['rows']['pic']; ?>
"> <a rel="nofollow" href="<?php echo $this->_tpl_vars['rows']['href']; ?>
"><?php echo $this->_tpl_vars['rows']['title']; ?>
</a>
                           </div>
                        <?php endforeach; endif; unset($_from); ?>
                    </div>   
                    <script type="text/javascript">

$("#currency").hover(
   function(){
	   $("#currencybox").css("display","");
	   $("#currency").css("width","140px");
	   $(this).css("background","url(../pic/tabs_3_.gif) 0px -28px no-repeat");
   },			
   function(){
	   $("#currencybox").css("display","none");
	   $("#currency").css("width","60px");
	   $(this).css("background","url(../pic/tabs_3_.gif) no-repeat");
   }			 
);
</script>                 
                   </div>