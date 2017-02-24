<?php /* Smarty version 2.6.26, created on 2011-10-31 11:42:41
         compiled from module_coupon.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<div  class="step_div_header"><span style="margin-left:20px;"><?php echo $this->_tpl_vars['lg']['use_coupon']; ?>
</span></div>
<div style="padding:8px">
<div style="padding-bottom:7px; font-size:14px;">Please key in Coupon code if you have or select on code below</div>

<?php if ($this->_tpl_vars['rs_coupon']): ?>
<div style="padding-bottom:7px"><select style="width:167px" name="slt_coupon_type" id="slt_coupon_type" onchange="select_coupon_code(this)">
<option value="1">Don't want to use now</option>
<option value="">Input new Coupon code</option>
<?php $_from = $this->_tpl_vars['rs_coupon']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['rows']):
?> 
<option value="<?php echo $this->_tpl_vars['rows']['name']; ?>
,<?php echo $this->_tpl_vars['rows']['price']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
 (save <?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['rows']['price']; ?>
)</option>
<?php endforeach; endif; unset($_from); ?>
</select></div>
<?php endif; ?>
<div id="div_coupon_content" style="padding-bottom:7px;">
<input type="input" id="coupon_code" name="coupon_code" onKeyDown="setCouponPrice(0)" style=" border:1px #CCCCCC solid; height:16px; line-height:16px; color:#1C437E; font-size:11px; width:163px"  value="" /> <input type="button"  class="profilebutton" onClick="use_coupon()" value="<?php echo $this->_tpl_vars['lg']['use_this_coupon']; ?>
" /></div>
<div style=" font-size:14px;" class="red weight">You Can save : <?php echo $this->_tpl_vars['coin']; ?>
 <span id="savecouponprice">0</span><input id="sub_coupon" name="sub_coupon" type="hidden" value="0"></div>

</div>
<script language="javascript">
function select_coupon_code(obj)
{
	if(obj.value=="")
	{
		$('#div_coupon_content').show();
		setCouponPrice(0);
		$('#coupon_code').val('');
	}
	else if(obj.value=="1")
	{
		$('#div_coupon_content').hide();
		setCouponPrice(0);
		$('#coupon_code').val('');
	}
	else
	{
		$('#div_coupon_content').hide();
		strtemp = obj.value.split(',');
		setCouponPrice(strtemp[1]);
		$('#coupon_code').val(strtemp[0]);
	}
}

function use_coupon()
{
	setCouponPrice(0);
	if(!CheckIsNull("stepinfo","coupon_code","<?php echo $this->_tpl_vars['lg']['msg_coupon_null']; ?>
"))  return false;
	var surl = '<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=coupon';
	var pars = "coupon_code=" + $('#coupon_code').val();
	$.ajax({ url: surl,async: true,cache: false,data:pars,type:'post',success: ajax_getCouponResultContent}); 
}


function setCouponPrice(str)
{
	$('#sub_coupon').val(str);
	$('#savecouponprice').html(str);
}

function ajax_getCouponResultContent(xmlhttp)
{
	executeScript(xmlhttp);
}

<?php if ($this->_tpl_vars['rs_coupon']): ?>
	EnterSelectIndex("slt_coupon_type",2);
	select_coupon_code(document.getElementById('slt_coupon_type'));
<?php endif; ?>
</script>