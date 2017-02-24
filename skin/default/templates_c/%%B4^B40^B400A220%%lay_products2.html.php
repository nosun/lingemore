<?php /* Smarty version 2.6.26, created on 2012-06-07 15:48:08
         compiled from lay_products2.html */ ?>
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
</div><div class="bigdao"><?php echo $this->_tpl_vars['str_url_2']; ?>
</div>
        <?php if ($this->_tpl_vars['categorybigpic'] != ""): ?>
        <div style="margin-bottom:10px;">
         <a href="<?php echo $this->_tpl_vars['categorypicurl']; ?>
"><img border="0" src="<?php echo $this->_tpl_vars['categorypic']; ?>
" /></a></span></a>
        </div>
        <?php endif; ?>
        <div style="line-height:30px; font-size:14px;" class="weight">Best Seller Products</div>
        <div class="w888 boxborder_gray" style="background:#FFF; margin-bottom:10px;">
            <table width="100%" border="0" align="center" cellspacing="0" cellpadding="0" style="margin-top:10px; margin-bottom:10px;">
              <tr>
                <td width="23" align="center"><img style="cursor:pointer" onmousemove="javascript:gogo=true;bln=false;"  src="../pic/goleft.jpg" /></td>
                <td height="85" valign="middle"><div id=demo style="overflow:hidden;width:826px; margin:auto;">
              <table  border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td id=demo1 valign="top">
                  <table  border="0" cellspacing="0" cellpadding="0">
              <tr>
            <?php $_from = $this->_tpl_vars['rs_bestseller']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_bestseller'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_bestseller']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_bestseller']['iteration']++;
?>
            <td>
            <table width="118" border="0"  cellspacing="0" cellpadding="0" style="margin-left:5px; margin-right:5px;">  <tr>
                <td  height="150"  align="center" style=""><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img  src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
"  lazy_data_src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0"/></a></td>
              </tr>
              <tr>
                <td align="center" height="25">
                <a class="producta" href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a><br />
                <span class="price"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price']; ?>
</span>
                </td>
              </tr>
            </table>
            </td>
            <?php endforeach; endif; unset($_from); ?>
            </tr>
                  </table></td>
                  <td id=demo2 valign="top"></td>
                </tr>
              </table>
            </div></td>
                <td width="23" align="center"><img style="cursor:pointer" onmousemove="javascript:gogo=true;bln=true;" src="../pic/goright.jpg" /></td>
              </tr>
            </table>
					<script language="javascript">
                      var speed=10;
                      var gogo= true;
                      var bln=true;
                      var demo = document.getElementById("demo");
                      var demo1 = document.getElementById("demo1");
                      var demo2 = document.getElementById("demo2");
                      
                      demo2.innerHTML=demo1.innerHTML
                      function Marquee(){
                      if(!gogo)
                        return ;
                      if(bln)
                      {
                          if(demo.scrollWidth-demo.scrollLeft-demo1.offsetWidth<=0)
                          {
                          
                          demo.scrollLeft=0;
                           }
                           else{
                          demo.scrollLeft++
                          //alert(demo.offsetWidth+" "+demo.scrollWidth+" "+demo.scrollLeft);
                          }
                        }
                        else
                        {
                            if(demo.scrollLeft<=0)
                                 {
                                 demo.scrollLeft=demo1.scrollWidth
                                 }
                             else
                             {
                                demo.scrollLeft--;
                             }
                        }
                      }
                      var MyMar=setInterval(Marquee,speed)
                      demo.onmouseover=function() {clearInterval(MyMar)}
                      demo.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
                    </script>
        </div>
        <div class="w888 boxborder_darkgray" style="background:#FFF; margin-bottom:10px;">
           <div>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_page.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
              <div style="height:30px; line-height:30px; float:right; display:inline-block;">
                  Show:
                  <?php $_from = $this->_tpl_vars['mode']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mode'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mode']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['mode']['iteration']++;
?>
                  <a class="mode <?php if ($this->_tpl_vars['key1'] == $this->_tpl_vars['numindex']): ?>mode_now<?php endif; ?>" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite'][$this->_tpl_vars['rows']]; ?>
"><?php echo $this->_tpl_vars['rows']; ?>
</a>
                  <?php endforeach; endif; unset($_from); ?>
              </div>
              <div class="clear1"></div>
           </div>
           <div>
                <table width="100%" border="0" cellspacing="5" cellpadding="0" style="border-top:1px solid #cccccc;background:#FAFAFA;">
                  <tr>
                    <td width="200">View as: <a class="list_on" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['list']; ?>
"></a> List <a class="grid" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['grid']; ?>
"></a> Grid<!-- <a class="gallery" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['gallery']; ?>
"></a>--></td>
                    <td width="250">
                     Filter:
                     <?php if ($this->_tpl_vars['filteritem'] == 1 || $this->_tpl_vars['filteritem'] == 2): ?>
                      <a class="filter" href="<?php echo $this->_tpl_vars['rewrite']['filter0']; ?>
">All</a>
                      <?php else: ?>
                      <span class="filteron">All</span> 
                      <?php endif; ?>
                     <?php if ($this->_tpl_vars['filteritem'] == 1): ?>
                     <span class="filteron">Spical Offers</span>
                     <?php else: ?>
                     <a class="filter" href="<?php echo $this->_tpl_vars['rewrite']['filter1']; ?>
">Spical Offers</a>
                     <?php endif; ?>
                    </td>
                    <td></td>
                    <td width="74">Order By </td>
                    <td width="240">
                    <select rel="nofollow" id="orderitem" name="orderitem"   onchange="MM_jumpMenu('parent',this,0)">
                    <option value="<?php echo $this->_tpl_vars['rewrite']['orderid']; ?>
">Product ID</option>
                    <option value="<?php echo $this->_tpl_vars['rewrite']['orderitemno']; ?>
">Itemno ID</option>
                    <option value="<?php echo $this->_tpl_vars['rewrite']['ordername']; ?>
">Product Name</option>
                    <option value="<?php echo $this->_tpl_vars['rewrite']['orderprice']; ?>
">Product Price</option>
                    <option value="<?php echo $this->_tpl_vars['rewrite']['ordertime']; ?>
">Product Addtime</option>
                    <option value="<?php echo $this->_tpl_vars['rewrite']['ordersort']; ?>
">Product Sort</option>
                    <option value="<?php echo $this->_tpl_vars['rewrite']['orderview']; ?>
">Product Views</option>
                      </select>
                      <select rel="nofollow" id="orderby" name="orderby"  onchange="MM_jumpMenu('parent',this,0)">
                      <option value="<?php echo $this->_tpl_vars['rewrite']['bydesc']; ?>
">Descendingly</option>
                       <option value="<?php echo $this->_tpl_vars['rewrite']['byasc']; ?>
">Ascendingly</option>
                      
                      </select>
                      <script language="javascript">
                      try{
                          EnterSelectIndex("orderitem",<?php echo $this->_tpl_vars['orderindex']; ?>
);
                          EnterSelectIndex("orderby",<?php echo $this->_tpl_vars['orderbyindex']; ?>
);
                          //document.getElementById("imgNum" + <?php echo $this->_tpl_vars['numindex']; ?>
).src="../pic/ps_<?php echo $this->_tpl_vars['pagesize']; ?>
_i.gif";
                         }
                         catch(e)
                         {}
                      </script> </td>
                  </tr>
                </table>
           </div>
        </div>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "uio_products2.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <div class="w888 boxborder_darkgray" style="background:#FFF; margin-top:10px;">
           <div>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_page.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
              <div style="height:30px; line-height:30px; float:right; display:inline-block;">
                  Show:
                  <?php $_from = $this->_tpl_vars['mode']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mode'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mode']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['mode']['iteration']++;
?>
                  <a class="mode <?php if ($this->_tpl_vars['key1'] == $this->_tpl_vars['numindex']): ?>mode_now<?php endif; ?>" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite'][$this->_tpl_vars['rows']]; ?>
"><?php echo $this->_tpl_vars['rows']; ?>
</a>
                  <?php endforeach; endif; unset($_from); ?>
              </div>
              <div class="clear1"></div>
           </div>
           <div>
                <table width="100%" border="0" cellspacing="5" cellpadding="0" style="border-top:1px solid #cccccc;background:#FAFAFA;">
                  <tr>
                    <td width="200">View as: <a class="list_on" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['list']; ?>
"></a> List <a class="grid" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['grid']; ?>
"></a> Grid<!-- <a class="gallery" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['gallery']; ?>
"></a>--></td>
                    <td width="250">
                     Filter:
                     <?php if ($this->_tpl_vars['filteritem'] == 1 || $this->_tpl_vars['filteritem'] == 2): ?>
                      <a class="filter" href="<?php echo $this->_tpl_vars['rewrite']['filter0']; ?>
">All</a>
                      <?php else: ?>
                      <span class="filteron">All</span> 
                      <?php endif; ?>
                     <?php if ($this->_tpl_vars['filteritem'] == 1): ?>
                     <span class="filteron">Spical Offers</span>
                     <?php else: ?>
                     <a class="filter" href="<?php echo $this->_tpl_vars['rewrite']['filter1']; ?>
">Spical Offers</a>
                     <?php endif; ?>
                    </td>
                    <td></td>
                    <td width="74">Order By </td>
                    <td width="240">
                    <select rel="nofollow" id="orderitem1" name="orderitem"   onchange="MM_jumpMenu('parent',this,0)">
                    <option value="<?php echo $this->_tpl_vars['rewrite']['orderid']; ?>
">Product ID</option>
                    <option value="<?php echo $this->_tpl_vars['rewrite']['orderitemno']; ?>
">Itemno ID</option>
                    <option value="<?php echo $this->_tpl_vars['rewrite']['ordername']; ?>
">Product Name</option>
                    <option value="<?php echo $this->_tpl_vars['rewrite']['orderprice']; ?>
">Product Price</option>
                    <option value="<?php echo $this->_tpl_vars['rewrite']['ordertime']; ?>
">Product Addtime</option>
                    <option value="<?php echo $this->_tpl_vars['rewrite']['ordersort']; ?>
">Product Sort</option>
                    <option value="<?php echo $this->_tpl_vars['rewrite']['orderview']; ?>
">Product Views</option>
                      </select>
                      <select rel="nofollow" id="orderby" name="orderby"  onchange="MM_jumpMenu('parent',this,0)">
                      <option value="<?php echo $this->_tpl_vars['rewrite']['bydesc']; ?>
">Descendingly</option>
                       <option value="<?php echo $this->_tpl_vars['rewrite']['byasc']; ?>
">Ascendingly</option>
                      
                      </select>
                      <script language="javascript">
                      try{
                          EnterSelectIndex("orderitem1",<?php echo $this->_tpl_vars['orderindex']; ?>
);
                          EnterSelectIndex("orderby1",<?php echo $this->_tpl_vars['orderbyindex']; ?>
);
                          //document.getElementById("imgNum" + <?php echo $this->_tpl_vars['numindex']; ?>
).src="../pic/ps_<?php echo $this->_tpl_vars['pagesize']; ?>
_i.gif";
                         }
                         catch(e)
                         {}
                      </script> </td>
                  </tr>
                </table>
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