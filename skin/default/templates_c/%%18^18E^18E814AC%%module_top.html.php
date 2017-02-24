<?php /* Smarty version 2.6.26, created on 2015-02-27 11:19:59
         compiled from module_top.html */ ?>
<link type="text/css" href="../pic/style.css?v2" rel="stylesheet">
<div id="overlay" style="width: 100%; height:100%; position:fixed; left:0; top: 0; background:#000; opacity:.6;z-index:1000001;display:none"></div>
<div id="wholesale-box" style="width:450px;height:490px;z-index:1000002;display:none;background:#fff;text-align:center;solid 1px #774A4A">
		<div>
	    	<h1 style="background-color: #D51341;color:#fff;padding:10px;">Retailer &amp; Wholesaler</h1>
                <div id="alert_info">
                    <p>If you are a wholesaler or want to become our retailer, please fill out this form and we'll reply the wholesale pricelist as soon as possible.</p>
                </div>
	        <div>
	        	<div id="message" style="display:none">
	        		<p style="font-size: 14px;font-weight: bold;margin-bottom: 10px;">Thanks for your interest in lingeriemore.com!</p>
	        		<p>If you are a wholesaler customer or want to become our retailer, please visit our wholesale price website:<a style="color:#f00;font-size: 14px;font-weight: bold;margin: 0px 5px;text-decoration: underline;" href="http://www.iwantlingerie.com/">http://www.iwantlingerie.com/</a>.For any other questions, please contact support@lingeriemore.com. Thank you!</p>
	        	</div>
	            <form method="post">
					<div>
		            	<div>
		                    <span>Name:</span><br />
		                    <input type="text" value="" name="name"  class="elmbBlur"/>*
		                </div>
		                <div>
		                	<span>Email:</span> <br />
		                    <input value="" name="email" class="elmbBlur"/>*
		                </div>
		                <div>
		                	<span>Country:</span> <br />
		                    <input value="" name="country" class="elmbBlur"/>*
		                </div>
		                <div>
		                	<span>Phone Number:</span> <br />
		                    <input value="" name="phone" class="elmbBlur"/>*
		                </div>
		                <div>
		                	<span>Website:</span> <br />
		                    <input value="" name="website" class="elmbBlur"/>
		                </div>
                        <div>
		                	<span>Comments:</span> <br />
		                    <textarea name="comment" style="border:1px solid #D9D9D9;width:200px;height:100px;color:#666;"></textarea>
		                </div>
	                </div>
	            </form>
	            <div style="margin-top:10px">
			        <input id="confirm-btn" type="button" class="button confirm" value="Confirm"/>
			        <input id="cancel-btn" type="button" class="button cancel" value="Close"/>
		        </div>
	        </div>
	    </div>
</div>
<div id="topbar">

  <div class="topbartext"><?php echo $this->_tpl_vars['content_68']; ?>
</div>

</div>

<div id="top">

	<div id="logo"><a title="<?php echo $this->_tpl_vars['rs_ad'][2]['title'][0]; ?>
" href="<?php echo $this->_tpl_vars['rs_ad'][2]['url'][0]; ?>
"><img src="<?php echo $this->_tpl_vars['rs_ad'][2]['pic'][0]; ?>
"  /></a></div>

    <div id="top_right_box">

      <table align="right" border="0" cellspacing="0" cellpadding="5">

      <tr>

        <td>

                 <span class="weight">Currencies:</span>

        <select style="width:100px; font-size:11px;" id="coin2" name="coin2" onChange="MM_jumpMenu3('parent',this,0)">

                      <?php unset($this->_sections['coin']);
$this->_sections['coin']['name'] = 'coin';
$this->_sections['coin']['start'] = (int)0;
$this->_sections['coin']['loop'] = is_array($_loop=9) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['coin']['show'] = true;
$this->_sections['coin']['max'] = $this->_sections['coin']['loop'];
$this->_sections['coin']['step'] = 1;
if ($this->_sections['coin']['start'] < 0)
    $this->_sections['coin']['start'] = max($this->_sections['coin']['step'] > 0 ? 0 : -1, $this->_sections['coin']['loop'] + $this->_sections['coin']['start']);
else
    $this->_sections['coin']['start'] = min($this->_sections['coin']['start'], $this->_sections['coin']['step'] > 0 ? $this->_sections['coin']['loop'] : $this->_sections['coin']['loop']-1);
if ($this->_sections['coin']['show']) {
    $this->_sections['coin']['total'] = min(ceil(($this->_sections['coin']['step'] > 0 ? $this->_sections['coin']['loop'] - $this->_sections['coin']['start'] : $this->_sections['coin']['start']+1)/abs($this->_sections['coin']['step'])), $this->_sections['coin']['max']);
    if ($this->_sections['coin']['total'] == 0)
        $this->_sections['coin']['show'] = false;
} else
    $this->_sections['coin']['total'] = 0;
if ($this->_sections['coin']['show']):

            for ($this->_sections['coin']['index'] = $this->_sections['coin']['start'], $this->_sections['coin']['iteration'] = 1;
                 $this->_sections['coin']['iteration'] <= $this->_sections['coin']['total'];
                 $this->_sections['coin']['index'] += $this->_sections['coin']['step'], $this->_sections['coin']['iteration']++):
$this->_sections['coin']['rownum'] = $this->_sections['coin']['iteration'];
$this->_sections['coin']['index_prev'] = $this->_sections['coin']['index'] - $this->_sections['coin']['step'];
$this->_sections['coin']['index_next'] = $this->_sections['coin']['index'] + $this->_sections['coin']['step'];
$this->_sections['coin']['first']      = ($this->_sections['coin']['iteration'] == 1);
$this->_sections['coin']['last']       = ($this->_sections['coin']['iteration'] == $this->_sections['coin']['total']);
?>

                      <?php $this->assign('coinindex', $this->_sections['coin']['index']+90); ?>

                      <?php $this->assign('cointitle', $this->_sections['coin']['index']+150); ?>

                      <?php if ($this->_tpl_vars['config'][$this->_tpl_vars['coinindex']] != ""): ?>

                          <option value="<?php echo $this->_sections['coin']['index']; ?>
"> <?php echo $this->_tpl_vars['config'][$this->_tpl_vars['cointitle']]; ?>
 </option>

                      <?php endif; ?>

                      <?php endfor; endif; ?>

        </select><Script>

                  EnterSelect("coin2","<?php echo $this->_tpl_vars['coinIndex']; ?>
");

                  </script> 

        </td>

        <td style="">

        <?php if ($this->_tpl_vars['userid'] == -1): ?>

        <a class="menu1" href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php">Login</a> | 

        <a class="menu1" href="<?php echo $this->_tpl_vars['folder']; ?>
register.php">Register</a> | 

        <?php else: ?>

        <span>Welcome! <?php echo $this->_tpl_vars['username']; ?>
</span>

        <?php endif; ?>

        <a class="menu1" href="<?php echo $this->_tpl_vars['folder']; ?>
profile.php">My Account</a> | 

        <a class="menu1" href="<?php echo $this->_tpl_vars['folder']; ?>
?help-i185.html">Help</a>

        </td>

      </tr>

      </table>

       <div class="clear1"></div>



       <table align="right" border="0" cellspacing="3" cellpadding="0">

          <tr>

            <td><img src="../pic/cart.jpg" /></td>

            <td style="min-width:185px;" align="left"><a class="menu1" href="<?php echo $this->_tpl_vars['folder']; ?>
shopcart.php"><span >You have <span style="color:#FF0000;" id="_ajax_div_items"><?php echo $this->_tpl_vars['totalnum']; ?>
</span> items</span> in your cart</a></td>

            <td><img src="../pic/topli.jpg" /></td>

            <td><a class="menu1" href="<?php echo $this->_tpl_vars['folder']; ?>
shopcart.php">Checkout</a></td>

            <td><img src="../pic/topli.jpg" /></td>

            <td><a class="menu1" href="<?php echo $this->_tpl_vars['folder']; ?>
shopcart.php">View Shopping Cart</a></td>

          </tr>

       </table>

       <div class="clear1"></div>

    </div>

</div>



<div id="nav_box">

    <div id="nav">

         <ul class="menulist">

           <li class="item"><a class="first" href="<?php echo $this->_tpl_vars['folder']; ?>
"><?php echo $this->_tpl_vars['lg']['home']; ?>
</a></li>

         <?php $_from = $this->_tpl_vars['rs_top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_top'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_top']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_top']['iteration']++;
?>

           <li class="item"><a class="first" href="<?php echo $this->_tpl_vars['rows']['url']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a></li>

         <?php endforeach; endif; unset($_from); ?>
         </ul>

         <script type="text/javascript">
	$.fn.center = function () {
        	    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
        	                                                $(window).scrollTop()) + "px");
        	    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
        	                                                $(window).scrollLeft()) + "px");
        	    this.css("position","absolute");
        	    return this;
        	};
        
        	function setCookie(cname, cvalue) {
	        	var d = new Date();
	        	d.setTime(d.getTime() + (4*60*60*1000));
	        	var expires = "expires="+d.toUTCString();
	        	document.cookie = cname + "=" + cvalue + "; " + expires;
        	}

	        function getCookie(cname) {
	            var name = cname + "=";
	            var ca = document.cookie.split(';');
	            for(var i=0; i<ca.length; i++) {
	                var c = ca[i];
	                while (c.charAt(0)==' ') c = c.substring(1);
	                if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
	            }
	            return "";
        	}
        
//         	$(function() {
//        	 	var username=getCookie("promote");
//        	 	if (username == '') {
//        			$('#overlay').show();
//        			$('#wholesale-box').center().show();
//        			setCookie('promote', 'shown');
//        	 	}
//        		$(window).resize(function() {
//        			$('#wholesale-box').center();
//        		});
//
//        		$('#wholesale-link').click(function(event){
//        			event.preventDefault();
//        			$('#overlay').show();
//        			$('#wholesale-box').center().fadeIn();
//        		});
//
//        		$('#confirm-btn').click(function(event){
//        			event.preventDefault();
//        			$.ajax({
//        				type: "POST",
//        		        url: "/addwholesaleuser.php",
//        		    	data: $("#wholesale-box form").serialize(), // serializes the form's elements.
//        		        success: function(data) {
//        				var ret = JSON.parse(data);
//        		       		if (ret.success) {
//        		       			$('#wholesale-box form').hide();
//        		       			$('#alert_info').hide();
//        						$('#wholesale-box #message').show();
//        						$('#confirm-btn').hide();
//        		       		} else {
//        			       		alert(ret.message);
//        		       		}
//        		       }
//        			});
//        		});
//
//        		$('#cancel-btn').click(function(event){
//        			event.preventDefault();
//        			$('#overlay').hide();
//        			$('#wholesale-box').fadeOut();
//        		});
//        	});
         </script>

    </div>

</div>



<div id="subnav_box">

    <div id="subnav">

         <?php $_from = $this->_tpl_vars['rs_top_2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_top_2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_top_2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_top_2']['iteration']++;
?>

           <?php if ($this->_tpl_vars['key1'] > 0): ?>|<?php endif; ?>

           <a class="top2" href="<?php echo $this->_tpl_vars['rows']['url']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a>

         <?php endforeach; endif; unset($_from); ?>

    </div>

</div>



<div class="w998" style="height:32px; border:1px #FFD1E0 solid;; background:url(../pic/searchbg.jpg) repeat-x; margin:auto;">

      <form action="<?php echo $this->_tpl_vars['folder']; ?>
products.php" method="get" enctype="application/x-www-form-urlencoded">

       <table height="32" border="0" cellspacing="3" cellpadding="0">

          <tr>

             <td width="35" align="right">

             <img src="../pic/searchpic.jpg" />

             </td>

             <td>

		        <select name="classid" style="width:160px; font-size:14px; margin-left:5px;">

                <option value="">All Categories</option>

				<?php echo $this->_tpl_vars['allclassselect']; ?>


				</select><input name="is_search" type="hidden" value="1" />

             

             </td>

             <td>

             <input type="text"  style="width:250px; height:14px; margin-left:5px;" name="name"  id="name" value="<?php echo $this->_tpl_vars['search_keywords']; ?>
" />

             </td>

             <td><input type="image" style="margin-left:5px;"  src="../pic/searchbtn.jpg" /></td>

             <td width="110" align="center"><a style="color:#B50000; text-decoration:underline; font-weight:bold;" href="<?php echo $this->_tpl_vars['folder']; ?>
search.php">Advance Search</a></td>

             <td width="350" align="center"><?php echo $this->_tpl_vars['content_32']; ?>
</td>

          </tr>

       </table>

       </form>

</div>

<script type="text/JavaScript">

function MM_jumpMenu3(targ,selObj,restore){ //v3.0

  eval(targ+".location='<?php echo $this->_tpl_vars['folder']; ?>
?action=change_coin&index="+selObj.options[selObj.selectedIndex].value+"&page=" + escape(location.href) + "'");

  if (restore) selObj.selectedIndex=0;

}



</script>