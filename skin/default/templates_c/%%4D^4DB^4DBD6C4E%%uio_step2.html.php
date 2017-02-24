<?php /* Smarty version 2.6.26, created on 2010-07-07 18:10:37
         compiled from uio_step2.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<script>
var weight = "<?php echo $this->_tpl_vars['totalweight']; ?>
" ; 
var totalnum = "<?php echo $this->_tpl_vars['totalnum']; ?>
" ;
var totalprice = "<?php echo $this->_tpl_vars['totalprice']; ?>
";
var coin = "<?php echo $this->_tpl_vars['coin']; ?>
" ;
var rate = <?php echo $this->_tpl_vars['rate']; ?>
 ;
function getNewAddress(obj)
{
	if(parseInt(obj.value)==0)
	{
		document.getElementById("divAdress").style.display='block';
		//getAjaxExpress("");
	}
	else
	{
		document.getElementById("divAdress").style.display='none';
	}
	var slt=document.getElementsByName("address");
   for(var indexJ=0;indexJ<=slt.length-1;indexJ++)
   {
	     //  slt[indexJ].parentElement.className='addressoff';
   }
	//obj.parentElement.className='addresson';
}
function changeExpressPrice(sub1)
{
	document.getElementById("sub1").value=sub1;
}
function getAjaxExpress(str)
{
	var country;
	if(str=="")
	{
		var obj = document.getElementById('countryid') ;
		if(obj.value=="")
		{
			$('expressdiv').innerHTML="Please Select Country";
			$('address5').value="";
			//EnterSelect("countryid","");
			document.getElementById("sub1").value="";
			return ;
		}
		country =  obj.options[obj.selectedIndex].text ;
	}
	else
	{
		country = str ;
	}
	document.getElementById('address5').value=country;
	//alert(3);
	$('expressdiv').innerHTML="";
	var url="express.php";
	var query='country=' + country + "&totalnum=" + totalnum + "&weight=" + weight + "&coin=" + escape(coin) +"&rate=" + rate;
	//alert(query);
	var ajax=new Ajax(url,query,function(xml){sth_changeState(xml);});
	ajax.get();
}

function sth_changeState(xml)
{
	//alert(xml.responseText);
	//alert(xml.responseText);
	document.getElementById('expressdiv').innerHTML = xml.responseText ;
	executeScript(xml.responseText);
	//setInnerHTML(document.getElementById('expressdiv') , xml.responseText );
}

</script>

<?php if ($this->_tpl_vars['action'] == 'step_1'): ?>
<div class="main_ct">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td width="25%" align="center" class="stepimp3">1.Delivery Information</td>
    <td width="25%" align="center" class="stepmain3">2.Confirm Information</td>
    <td width="25%" align="center" class="stepmain3">3.Payment Information</td>
    <td width="25%" align="center" class="stepmain3">4.Order Complete</td>
  </tr>
</table>
<script>function showOrHideProdcut()
{
	for(var indexI=4;indexI<=4;indexI++)
	{
		var obj=document.getElementById("tr_"+indexI);
		if(obj.style.display=="none")
			obj.style.display="block"
		else
			obj.style.display="none"
	}
}
</script>
<form name="stepinfo" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
step.php?action=step_confirm">

<fieldset>
<legend>Shipping Address</legend>
 		 <?php $_from = $this->_tpl_vars['rs_address']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['rows']):
?>
		<div> <input name="address"   onclick="getAjaxExpress('<?php echo $this->_tpl_vars['rows']['arraddress'][5]; ?>
');getNewAddress(this)"  type="radio" value="<?php echo $this->_tpl_vars['rows']['id']; ?>
" /> <?php echo $this->_tpl_vars['rows']['arraddress'][0]; ?>
 <?php echo $this->_tpl_vars['rows']['arraddress'][8]; ?>

<div style="margin-left:23px;">
address : <?php echo $this->_tpl_vars['rows']['arraddress'][1]; ?>
 <?php echo $this->_tpl_vars['rows']['arraddress'][3]; ?>
 <?php echo $this->_tpl_vars['rows']['arraddress'][4]; ?>
 <?php echo $this->_tpl_vars['rows']['arraddress'][5]; ?>
 <br /> 
postCode : <?php echo $this->_tpl_vars['rows']['arraddress'][2]; ?>
 <br />
tel : <?php echo $this->_tpl_vars['rows']['arraddress'][6]; ?>
 , E-mail : <?php echo $this->_tpl_vars['rows']['arraddress'][7]; ?>

</div></div>
		<?php endforeach; endif; unset($_from); ?>
        <div > <input name="address"  onclick="getAjaxExpress('');getNewAddress(this)"  type="radio" value="0" /> New shipping address</div>
		<div id="divAdress"  style=" background-color:#F1F8FF; display:none; padding:0; margin:0">
  <table width="95%" border="0" cellpadding="0" cellspacing="5">
  <tr>
    <td width="130" align="left">First Name:</td>
    <td><input name="address0" type="text" class="input001" maxlength="50" /></td>
  </tr>
   <tr>
    <td width="130" align="left">Last Name:</td>
    <td><input name="address8" type="text" class="input001" maxlength="50" /></td>
  </tr>
  <tr>
    <td align="left">Address:</td>
    <td><input name="address1" type="text" class="input001" maxlength="200" /></td>
  </tr>
  <tr>
    <td align="left">ZIP / Postal code:</td>
    <td><input name="address2" type="text" class="input001" maxlength="20" /></td>
  </tr>
  <tr>
    <td align="left">City:</td>
    <td><input name="address3" type="text" class="input001" maxlength="50" /></td>
  </tr>
  
  <tr>
    <td align="left">State / Province:</td>
    <td><input name="address4" type="text" class="input001" maxlength="50" /></td>
  </tr>
  
  <tr>
    <td align="left">Country:</td>
    <td>
	<?php $this->assign('country', 'countryid'); ?><?php $this->assign('countryfun', "onchange=getAjaxExpress('')"); ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_country.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	<input name="address5" id="address5" type="hidden" value="" /></td>
  </tr>
  <tr>
    <td align="left">Phone number :</td>
    <td><input name="address6" type="text" class="input001" maxlength="50" /></td>
  </tr>
 <tr>
    <td align="left">E-mail :</td>
    <td><input name="address7" type="text" class="input001" maxlength="50" /></td>
  </tr>
<?php if ($this->_tpl_vars['userid'] != -1): ?>
  <tr>
    <td align="left">&nbsp;</td>
    <td>
      <input name="addressupdate" type="checkbox" checked="checked" value="1" /> Whether or not to join the address book? </td>
  </tr>
<?php endif; ?> 
</table>
  </div>
  
</fieldset>

 <fieldset>
<legend>Shipping Method</legend>
 <div>Total Weight: <span class="impc"><?php echo $this->_tpl_vars['totalweight']; ?>
</span> KG <input type="hidden" id="sub1" name="sub1" value="0" />
    </div>
 <div id="expressdiv">
 Please Select Country
 </div>
	 <script language="javascript">
   EnterRadioIndex("address",0); 
   </script>
</fieldset>
 <fieldset>
<legend>Comments</legend>
<textarea name="content"  class="input003" id="content" style="width:95%;"></textarea>
</fieldset>

<script language="javascript" type="text/javascript">
  function CheckForm()
  { 
var temp=document.getElementsByName("address");
var strtemp="";
  for (i=0;i<temp.length;i++)
  //遍历Radio
    if(temp[i].checked)
     	strtemp=temp[i].value;
	if((strtemp+"")=="0")
	{
		if(!CheckIsNull("stepinfo","address0","First name")) return false;
		if(!CheckIsNull("stepinfo","address8","Last name")) return false;
		if(!CheckIsNull("stepinfo","address1","street")) return false;
		if(!CheckIsNull("stepinfo","address2","zip")) return false;
		if(!CheckIsNull("stepinfo","address3","city")) return false;
		if(!CheckIsNull("stepinfo","address4","state")) return false;
		if(!CheckIsNull("stepinfo","address5","country")) return false;
		if(!CheckIsNull("stepinfo","address6","Phone Number")) return false;
		if(!CheckIsEmail("stepinfo","address7","E-mail")) return false;
	}
}
  </script>
<br />
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:20px;">
  <tr>
    <td width="50%" height="26" align="left" ><input type="button" onclick="javascript:history.back();" value="&lt;&lt; Back to Shopcart" /></td>
    <td width="50%" align="right" ><input name="checkform0" type="submit" onclick="return CheckForm()" value="Continue checkout &gt;&gt;"/></td>
  </tr>
</table>

</form>

<?php elseif ($this->_tpl_vars['action'] == 'step_confirm'): ?>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td width="25%" align="center" class="stepmain3">1.Delivery Information</td>
    <td width="25%" align="center" class="stepimp3">2.Confirm Information</td>
    <td width="25%" align="center" class="stepmain3">3.Payment Information</td>
    <td width="25%" align="center" class="stepmain3">4.Order Complete</td>
  </tr>
</table>
<form name="stepinfo" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
step.php?action=step_2">

<fieldset>
<legend>Items ordered</legend>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <?php $_from = $this->_tpl_vars['rs_sc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['rows']):
?>
                <tr>
                  <td align="center"  >
				  
				  <table width="100%" border="0" cellspacing="0" cellpadding="5" class="xuxian">
  <tr>
    <td width="100" align="center" valign="top"> <a  href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img  title="<?php echo $this->_tpl_vars['rows']['name']; ?>
" src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0" /></a></td>
    <td align="left" valign="top"><a  href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
" style="font-weight:bold;">
     <span class="mainc"><?php echo $this->_tpl_vars['rows']['name']; ?>
</span>
    </a><br />
    <br />
    <em>
    <?php echo $this->_tpl_vars['rows']['pstyle']; ?>
<br />
Remark:<?php echo $this->_tpl_vars['rows']['pcontent']; ?>
<input name="content<?php echo $this->_tpl_vars['index']; ?>
" type="hidden" style="width:50px; height:50px" value="<?php echo $this->_tpl_vars['rows']['pcontent']; ?>
" /></em></td>
    <td align="right"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price']; ?>
 x <?php echo $this->_tpl_vars['rows']['pnum']; ?>
 = <span><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['itemprice']; ?>
</span>
      <input name="num<?php echo $this->_tpl_vars['index']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['rows']['pnum']; ?>
"></td>
  </tr>
</table>				 </td>
                </tr>
				<?php endforeach; endif; unset($_from); ?>
               <tr><td align="right">
               <table border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td height="20" align="right"><span class="impc weight"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['totalprice']; ?>
</span></td>
                </tr>
                 <tr>
                  <td height="20" align="right" class="shixian">+ Express fee (<span class="impc"><?php echo $this->_tpl_vars['express']; ?>
</span>): <span class="impc"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['sub1']; ?>
</span></td>
                </tr> 
                <tr>
                  <td align="right" ><input value="<?php echo $this->_tpl_vars['express']; ?>
" type="hidden" name="express" />
                    <input name="sub1" type="hidden" value="<?php echo $this->_tpl_vars['sub1']; ?>
" />
                  Total: <span class="impc weight bigs"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['sub1']+$this->_tpl_vars['totalprice']; ?>
</span></td>
                </tr>
                </table>
                </td>
               </tr>
</table>
</fieldset>
<fieldset>
<legend>Shipping Address</legend>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
      <td width="130" align="left">First name:</td>
        <td align="left"><?php echo $this->_tpl_vars['address'][0]; ?>
<input type="hidden" name="address0" value="<?php echo $this->_tpl_vars['address'][0]; ?>
" />
        <input type="hidden" name="address" value="<?php echo $this->_tpl_vars['addressid']; ?>
" /> <input name="addressupdate" type="hidden" value="<?php echo $this->_tpl_vars['addressupdate']; ?>
" /></td>
        </tr>
		<tr>
    <td align="left">Last name:</td>
    <td align="left"><?php echo $this->_tpl_vars['address'][8]; ?>
<input type="hidden" name="address1" value="<?php echo $this->_tpl_vars['address'][8]; ?>
" /></td>
  </tr>
		<tr>
    <td align="left">Street:</td>
    <td align="left"><?php echo $this->_tpl_vars['address'][1]; ?>
<input type="hidden" name="address1" value="<?php echo $this->_tpl_vars['address'][1]; ?>
" /></td>
  </tr>
  
  <tr>
    <td align="left">ZIP / Postal code:</td>
    <td align="left"><?php echo $this->_tpl_vars['address'][2]; ?>
<input type="hidden" name="address2" value="<?php echo $this->_tpl_vars['address'][2]; ?>
" /></td>
    </tr><tr>
    <td align="left">City:</td>
    <td align="left"><?php echo $this->_tpl_vars['address'][3]; ?>
<input type="hidden" name="address3" value="<?php echo $this->_tpl_vars['address'][3]; ?>
" /></td>
  </tr>
  <tr>
    <td align="left">State / Province:</td>
    <td align="left"><?php echo $this->_tpl_vars['address'][4]; ?>
<input type="hidden" name="address4" value="<?php echo $this->_tpl_vars['address'][4]; ?>
" /></td>
    </tr><tr>
    <td align="left">Country:</td>
    <td align="left"><?php echo $this->_tpl_vars['address'][5]; ?>
<input type="hidden" name="address5" value="<?php echo $this->_tpl_vars['address'][5]; ?>
" /></td>
  </tr>
  <tr>
    <td align="left">Phone number:</td>
    <td align="left"><?php echo $this->_tpl_vars['address'][6]; ?>
<input type="hidden" name="address6" value="<?php echo $this->_tpl_vars['address'][6]; ?>
" /></td>
    </tr><tr>
    <td align="left">E-mail:</td>
    <td align="left"><?php echo $this->_tpl_vars['address'][7]; ?>
<input type="hidden" name="address7" value="<?php echo $this->_tpl_vars['address'][7]; ?>
" /></td>
  </tr>
</table>
</fieldset>

<fieldset>
<legend>Comments</legend>
<?php echo $this->_tpl_vars['content']; ?>

<input name="content" type="hidden" class="input003" id="content" style="width:99%;" value="<?php echo $this->_tpl_vars['content']; ?>
" />
</fieldset>
 <script language="javascript" type="text/javascript">
  function CheckForm()
  { 
var temp=document.getElementsByName("address");
var strtemp="";
  for (i=0;i<temp.length;i++)
  //遍历Radio
    if(temp[i].checked)
     	strtemp=temp[i].value;
	if((strtemp+"")=="0")
	{
		if(!CheckIsNull("stepinfo","address0","name")) return false;
		if(!CheckIsNull("stepinfo","address1","country")) return false;
		if(!CheckIsNull("stepinfo","address2","province")) return false;
		if(!CheckIsNull("stepinfo","address3","city")) return false;
		if(!CheckIsNull("stepinfo","address4","street")) return false;
		if(!CheckIsNull("stepinfo","address5","postcode")) return false;
		if(!CheckIsNull("stepinfo","address6","Tel")) return false;
		if(!CheckIsNull("stepinfo","address7","E-mail")) return false;
	}
}
  </script>	 
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:20px;">
  <tr>
    <td width="50%" height="26" align="left" ><input type="button" onclick="javascript:history.back();" value="&lt;&lt; Back to change" /></td>
    <td width="50%" align="right" ><input name="checkform0" type="submit" onclick="return CheckForm()" value="Continue checkout &gt;&gt;"/></td>
  </tr>
</table>
</form>


<?php elseif ($this->_tpl_vars['action'] == 'step_3'): ?>
<?php echo $this->_tpl_vars['mailscript1']; ?>

<?php echo $this->_tpl_vars['mailscript2']; ?>

<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td width="25%" align="center" class="stepmain3">1.Delivery Information</td>
    <td width="25%" align="center" class="stepmain3">2.Confirm Information</td>
    <td width="25%" align="center" class="stepimp3">3.Payment Information</td>
    <td width="25%" align="center" class="stepmain3">4.Order Complete</td>
  </tr>
</table>
<form name="stepinfo" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
step.php?action=step_4&itemno=<?php echo $this->_tpl_vars['order']['itemno']; ?>
">
 <fieldset>
<legend>Payment Method</legend>

<div style="padding-left:15px">Order ID: <span class="impc sbigs"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>
<div style="padding-left:15px">Pay price: <span class="impc bigs"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>
<br />
<table width="100%" border="0" cellspacing="10" cellpadding="0">
 <?php $_from = $this->_tpl_vars['rs_payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['rows']):
?> 
  <tr>
    <td width="30"><input type="radio"  onclick="changeFees('<?php echo $this->_tpl_vars['rows']['pprice']; ?>
')" name="payment" value="<?php echo $this->_tpl_vars['rows']['name']; ?>
" /></td>
    <td align="center" width="120"><a target="_blank" href="<?php echo $this->_tpl_vars['rows']['url']; ?>
"><img src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0" /></a></td>
    <td><div class="linh"><?php echo $this->_tpl_vars['rows']['name']; ?>
 ( Payment Fees:  <span class="impc"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['rows']['pprice']; ?>
</span> )</div>
	<div class="linh" style="margin-left:20px"><?php echo $this->_tpl_vars['rows']['content']; ?>
</div>
	</td>
  </tr>
   <?php endforeach; endif; unset($_from); ?>
</table>
	   <input name="sub2" id="sub2" type="hidden" value="<?php echo $this->_tpl_vars['rs_payment'][0]['pprice']; ?>
" />
	   <script language="javascript">
	   EnterRadio("payment","<?php echo $this->_tpl_vars['rs_payment'][0]['name']; ?>
");
	   </script>
</fieldset>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:20px;">
  <tr>
    <td width="50%" height="26" align="left" >&nbsp;</td>
    <td width="50%" align="right" ><input name="checkform0" type="submit" value="Pay now &gt;&gt;"/></td>
  </tr>
</table>
</form>
<script>
	function changeFees(pri)
	{
		document.getElementById("sub2").value=pri;
	}
</script>


<?php elseif ($this->_tpl_vars['action'] == 'step_5'): ?>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td width="25%" align="center" class="stepmain3">1.Delivery Information</td>
    <td width="25%" align="center" class="stepmain3">2.Confirm Information</td>
    <td width="25%" align="center" class="stepimp3">3.Payment Information</td>
    <td width="25%" align="center" class="stepmain3">4.Order Complete</td>
  </tr>
</table>


<?php if ($this->_tpl_vars['paymenttype'] == 'paypal'): ?>
<fieldset><legend>Paypal</legend>
<div>Order ID: <span class="impc sbigs"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>
<div>Total price: <span class="impc bigs"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>
<div>
<form action="https://www.paypal.com/row/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo $this->_tpl_vars['config'][18]; ?>
">
<input type="hidden" name="item_name" value="<?php echo $this->_tpl_vars['order']['itemno']; ?>
">
<input type="hidden" name="currency_code" value="<?php echo $this->_tpl_vars['order']['paypalcoin']; ?>
">
<input type="hidden" name="return" value="<?php echo $this->_tpl_vars['cfg']['paypalURL']; ?>
&itemno=<?php echo $this->_tpl_vars['order']['itemno']; ?>
">
<input type="hidden" name="amount" value="<?php echo $this->_tpl_vars['order']['totalprices']; ?>
">
<input type="submit" name="Submit3" value="Click here to send payment Via paypal">
</form></div>
</fieldset>
<?php elseif ($this->_tpl_vars['paymenttype'] == 'creditcard'): ?>
<fieldset>
<legend>Credit Card</legend>
<div>Order ID: <span class="impc sbigs"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>
<div>Total price: <span class="impc bigs"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>
<div>
<form method="POST" action="https://secure.sslgateways.com/payment/index.php" target="_blank">
<input type="hidden" name="siteID" value="<?php echo $this->_tpl_vars['config'][59]; ?>
">
<input type="hidden" name="OrderID" value="<?php echo $this->_tpl_vars['order']['itemno']; ?>
">
<input type="hidden" name="OrderDescription" value="<?php echo $this->_tpl_vars['order']['itemno']; ?>
">
<input type="hidden" name="Amount" value="<?php echo $this->_tpl_vars['order']['totalprices']; ?>
">
<input type="hidden" name="Qty" value="1">
<input type="submit" value="Use Credit-Card payment ">
</form>
</div></fieldset>
<?php elseif ($this->_tpl_vars['paymenttype'] == 'creditcard'): ?>
<fieldset>
<legend>Moneybookers</legend>
<div>Order ID: <span class="impc sbigs"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>
<div>Total price: <span class="impc bigs"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>
<div>
<form action="https://www.moneybookers.com/app/payment.pl" method="post" target="_blank">
<input type="hidden" name="pay_to_email" value="ENTER_YOUR_USER_EMAIL@MERCHANT.COM">
<input type="hidden" name="status_url" value="EMAIL_TO_RECEIVE_PAYMENT_NOTIFICATION@MERCHANT.COM"> 
<input type="hidden" name="language" value="EN">
<input type="hidden" name="amount" value="<?php echo $this->_tpl_vars['order']['totalprices']; ?>
">
<input type="hidden" name="currency" value="<?php echo $this->_tpl_vars['order']['paypalcoin']; ?>
">
<input type="hidden" name="detail1_description" value="<?php echo $this->_tpl_vars['order']['itemno']; ?>
">
<input type="hidden" name="detail1_text" value="<?php echo $this->_tpl_vars['order']['itemno']; ?>
">
<input type="submit" value="MoneyBookers Pay!">
</form> 
</div>
<?php endif; ?>
</fieldset>
<?php elseif ($this->_tpl_vars['action'] == 'step_paypal'): ?>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td width="25%" align="center" class="stepmain3">1.Delivery Information</td>
    <td width="25%" align="center" class="stepmain3">2.Confirm Information</td>
    <td width="25%" align="center" class="stepimp3">3.Payment Information</td>
    <td width="25%" align="center" class="stepmain3">4.Order Complete</td>
  </tr>
</table>
<fieldset>
<legend>Paypal Payment Status</legend>
<div>Order ID: <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>
<div>Paypal Status: <span class="impc sbigs"><?php echo $this->_tpl_vars['paypal']['payment_status']; ?>

<?php if ($this->_tpl_vars['paypal']['payment_status'] == 'Pending'): ?>
<span style=" padding-left:15px">Pending Reason : <?php echo $this->_tpl_vars['paypal']['pending_reason']; ?>
</span>
<?php endif; ?>
</span> </div>
<div>Total price: <span class="impc bigs"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>
</fieldset>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:20px;">
  <tr>
    <td width="50%" height="26" align="left" >&nbsp;</td>
    <td width="50%" align="right" ><input name="checkform0" type="button" onclick="location.href='<?php echo $this->_tpl_vars['folder']; ?>
profile.php?action=order_list'"  value="My Account &gt;&gt;"/></td>
  </tr>
</table>
<?php endif; ?>
</div>