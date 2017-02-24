<?php /* Smarty version 2.6.26, created on 2013-07-20 16:21:38
         compiled from lay_products1.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!--头部开始-->

<div id="header_box">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_top.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>

<!--头部结束-->

<!--主体开始-->

<div id="body_box">

	<div id="left_box"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>

    <div id="inner_main_box">

    	<div class="daohang"><?php echo $this->_tpl_vars['str_url']; ?>
</div>

        <div class="w770 boxborder_pink" style="margin-bottom:10px;">

             <div class="pbigdao"><?php echo $this->_tpl_vars['str_url_2']; ?>
</div>

            <?php if ($this->_tpl_vars['category']['content'] != ""): ?>

             <div style="padding:10px;"><?php echo $this->_tpl_vars['category']['content']; ?>
</div>

            <?php endif; ?>

            <?php if ($this->_tpl_vars['recordcount'] > 0): ?>

              <div style="padding-left:10px;">

                <form action="products.php" enctype="application/x-www-form-urlencoded">

                Filter Results by:

                <select onchange="this.form.submit()" name="p1" id="p1">

                  <option value="">Items starting with ...</option>

                  <option value="a">A</option>

                  <option value="b">B</option>

                  <option value="c">C</option>

                  <option value="d">D</option>

                  <option value="e">E</option>

                  <option value="f">F</option>

                  <option value="g">G</option>

                  <option value="h">H</option>

                  <option value="i">I</option>

                  <option value="j">J</option>

                  <option value="k">K</option>

                  <option value="l">L</option>

                  <option value="m">M</option>

                  <option value="n">N</option>

                  <option value="o">O</option>

                  <option value="p">P</option>

                  <option value="q">Q</option>

                  <option value="r">R</option>

                  <option value="s">S</option>

                  <option value="t">T</option>

                  <option value="u">U</option>

                  <option value="v">V</option>

                  <option value="w">W</option>

                  <option value="x">X</option>

                  <option value="y">Y</option>

                  <option value="z">Z</option>

                  <option value="0">0</option>

                  <option value="1">1</option>

                  <option value="2">2</option>

                  <option value="3">3</option>

                  <option value="4">4</option>

                  <option value="5">5</option>

                  <option value="6">6</option>

                  <option value="7">7</option>

                  <option value="8">8</option>

                  <option value="9">9</option>

                </select>

                <input type="hidden" name="classid" value="<?php echo $this->_tpl_vars['classid']; ?>
">

                </form>

                <script>

                EnterSelect("p1","<?php echo $this->_tpl_vars['p1']; ?>
");

                </script>

                </div>

            <?php endif; ?>

            <div>

                <table width="100%" border="0" cellspacing="5" cellpadding="0" style="">

                  <tr>

                    <td width="200"><a class="grid_on" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['grid']; ?>
"></a><!-- <a class="gallery" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['gallery']; ?>
"></a>--></td>

                    <td width="250">

                   <?php $_from = $this->_tpl_vars['mode']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mode'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mode']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['mode']['iteration']++;
?>

                  <a class="mode <?php if ($this->_tpl_vars['key1'] == $this->_tpl_vars['numindex']): ?>mode_now<?php endif; ?>" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite'][$this->_tpl_vars['rows']]; ?>
"><?php echo $this->_tpl_vars['rows']; ?>
</a>

                  <?php endforeach; endif; unset($_from); ?>

                    </td>

                    <td></td>



                  </tr>

                </table>

           </div>

           <div>

              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_page.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

           </div>

           <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "uio_products1.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

           <div>

              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_page.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

           </div>

        </div>
        

    </div>

</div>

<!--主体结束-->

<!--底部开始-->

<div id="bottom_box"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_bom.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>

<!--底部结束-->

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_foot.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>