<?php /* Smarty version 2.6.26, created on 2012-11-20 17:23:03
         compiled from module_bom.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">

<div class="w998 boxborder_gray" style="border-top-width:5px; margin:auto; margin-bottom:10px;">

    <?php $_from = $this->_tpl_vars['rs_help']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_help'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_help']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_help']['iteration']++;
?>

     <div style="width:180px; padding-left:50px; padding-right:5px; float:left; margin-bottom:10px;">

        <div style="height:30px; text-align:left; line-height:30px; font-weight:bold; background:url(../pic/fkwhite.jpg) no-repeat 0px center;">

           <a style="font-weight:bold; color:#B50000;" href="<?php echo $this->_tpl_vars['rows']['url']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a>

        </div>

        <div style="<?php if ($this->_foreach['rs_help']['iteration']%4 != 0): ?>background:url(../pic/bomsplit.jpg) no-repeat right center;<?php endif; ?>">

            <?php $_from = $this->_tpl_vars['rows']['arrson']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_arrson'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_arrson']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['orows']):
        $this->_foreach['rs_arrson']['iteration']++;
?>

               <div style=" line-height:20px; text-align:left;; background:url(../pic/bomlistli.jpg) left center no-repeat;">

               <a title="<?php echo $this->_tpl_vars['orows']['name']; ?>
" href="<?php echo $this->_tpl_vars['orows']['url']; ?>
"><?php echo $this->_tpl_vars['orows']['name']; ?>
</a>

               </div>

            <?php endforeach; endif; unset($_from); ?>

        </div>

     </div>

       <?php if ($this->_foreach['rs_help']['iteration']%4 == 0): ?>

        <div class="clear1"></div>

       <?php endif; ?>

    <?php endforeach; endif; unset($_from); ?>

</div>

<div class="w1000" style="margin-bottom:10px; text-align:center"><?php echo $this->_tpl_vars['content_67']; ?>
</div>

<div class="w1000 weight" style="margin-bottom:10px; color:#B50000; text-align:center;">

           <a class="bom" href="<?php echo $this->_tpl_vars['folder']; ?>
"><?php echo $this->_tpl_vars['lg']['home']; ?>
</a>

         <?php $_from = $this->_tpl_vars['rs_bom']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_bom'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_bom']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_bom']['iteration']++;
?>

           |

           <a class="bom" href="<?php echo $this->_tpl_vars['rows']['url']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a>

         <?php endforeach; endif; unset($_from); ?>

</div>

<div class="w998" style="">

    <div class="text-align-center">        

        <?php echo $this->_tpl_vars['content_25']; ?>


        <div style="display:none;"><br />Process Time:<?php echo $this->_tpl_vars['process']; ?>
 ms , Memery:<?php echo $this->_tpl_vars['memry']; ?>
K ,  <br />

         <?php echo $this->_tpl_vars['queryHTML']; ?>
</div>

         <div style="display:none;"><?php echo $this->_tpl_vars['kfcode']; ?>
<?php echo $this->_tpl_vars['tjcode']; ?>
</div>

         <div class="clear"></div>

    </div>

</div>