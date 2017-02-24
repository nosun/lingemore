<?php /* Smarty version 2.6.26, created on 2014-04-10 14:47:01
         compiled from uio_step.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<style type="text/css">
.submitbtn{padding:5px 20px; font-size:14px; font-weight:bold;}
</style>
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

var isAjax = false ;

function getNewAddress(obj)

{

	if(parseInt(obj.value)==0)

	{

		document.getElementById("divAdress").style.display='block';

		if(openapi!="")

			includeJsFile("script_api",openapi+"/cgi-bin/?do=iptocountryselect&verson=2&fun=changeCountry&param=2");

		else

			changeCountry(""); 

	}

	else

	{

		document.getElementById("divAdress").style.display='none';

	}

}

function changeExpressPrice(sub1)

{

	document.getElementById("sub1").value=sub1;

}

function getAjaxExpress(str)

{

	

	$('#sumbitbutton').css('cursor','wait');

	var country;

	if(str=="")

	{

		$('#address5').val("");

		$('#sub1').val(0);

		$('#expressdiv').html("Please Select Country");

		$('#sumbitbutton').css('cursor','pointer');

		return ;

	} 

	else

	{

		if( str==$('#address5').val())

			return ;

		country = str ;

	}

	isAjax = true ;

	$('#expressdiv').html( $('#expressdivloading').html() );

	$('#address5').val(country);

	var url="express.php";

	var query='country=' + escape(country) + "&totalnum=" + totalnum + "&weight=" + weight + "&coin=" + escape(coin) +"&rate=" + rate;

	//alert(query);

	var ajax=new Ajax(url,query,function(xml){sth_changeState(xml);});

	ajax.get();

	

}



function sth_changeState(xml)

{

	isAjax = false ;

	$('#sumbitbutton').css('cursor','pointer');

	$('#expressdiv').html(xml.responseText);

	//executeScript(xml.responseText);

}





</script>



<style>

.r1{

position:fixed !important; top/**/:0px; 

position:absolute; top:expression(offsetParent.scrollTop); } 

</style>

<div class="main_ct2">

<?php if ($this->_tpl_vars['action'] == 'step_1'): ?>

<div style="margin-top:5px; margin-bottom:10px; font-size:14px; font-weight:bold"><img src="../pic/step1-pic.gif" align="absmiddle" />&nbsp;&nbsp;<?php echo $this->_tpl_vars['lg']['step1_tips']; ?>
</div>

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

<form name="stepinfo" method="post" onsubmit="return CheckForm()" action="<?php echo $this->_tpl_vars['folder']; ?>
step.php?action=step_confirm">

<div class="step_div_header"><span style="margin-left:20px;"><?php echo $this->_tpl_vars['lg']['shipping_address']; ?>
</span></div>

<div style="padding:8px">

 		 <?php $_from = $this->_tpl_vars['rs_address']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['rows']):
?>

		<div> <input name="address"   onclick="getAjaxExpress('<?php echo $this->_tpl_vars['rows']['arraddress'][5]; ?>
');getNewAddress(this)"  type="radio" value="<?php echo $this->_tpl_vars['rows']['id']; ?>
" /> <strong><?php echo $this->_tpl_vars['rows']['arraddress'][0]; ?>
 <?php echo $this->_tpl_vars['rows']['arraddress'][8]; ?>
</strong> <a href="profile.php?action=address_edit&id=<?php echo $this->_tpl_vars['rows']['id']; ?>
"><img src="../pic/edit_address.gif" hspace="10" align="absmiddle" /></a>

<div style="margin-left:23px; font-size:11px">

<?php echo $this->_tpl_vars['lg']['address']; ?>
 : <?php echo $this->_tpl_vars['rows']['arraddress'][1]; ?>
 <?php echo $this->_tpl_vars['rows']['arraddress'][3]; ?>
 <?php echo $this->_tpl_vars['rows']['arraddress'][4]; ?>
 <?php echo $this->_tpl_vars['rows']['arraddress'][5]; ?>
 <br /> 

<?php echo $this->_tpl_vars['lg']['zip']; ?>
 : <?php echo $this->_tpl_vars['rows']['arraddress'][2]; ?>
 <br />

<?php echo $this->_tpl_vars['lg']['tel']; ?>
 : <?php echo $this->_tpl_vars['rows']['arraddress'][6]; ?>
 , <?php echo $this->_tpl_vars['lg']['email']; ?>
 : <?php echo $this->_tpl_vars['rows']['arraddress'][7]; ?>


</div></div>

		<?php endforeach; endif; unset($_from); ?>

         <?php if ($this->_tpl_vars['user']['id'] == -1): ?> <?php echo $this->_tpl_vars['lg']['step1__newaddress_tips']; ?>
<?php endif; ?>

        <div > <input name="address"  onclick="getNewAddress(this)"  type="radio" value="0" /><strong> <?php echo $this->_tpl_vars['lg']['new_shipping_address']; ?>
</strong>&nbsp;&nbsp;<span class="red weight">* <?php echo $this->_tpl_vars['lg']['required_information']; ?>
</span></div>

		<div id="divAdress"  style=" background-color:#F1F8FF;  padding:0; margin:0">

  <table width="95%" border="0" cellpadding="0" cellspacing="6">

  <tr>

    <td width="130" align="right"><strong><?php echo $this->_tpl_vars['lg']['first_name']; ?>
 : </strong> <span class="red">*</span></td>

    <td><input name="address0" type="text" class="input001" maxlength="50" /></td>

  </tr>

   <tr>

    <td width="130" align="right"><strong><?php echo $this->_tpl_vars['lg']['last_name']; ?>
 : </strong> <span class="red">*</span></td>

    <td><input name="address8" type="text" class="input001" maxlength="50" /></td>

  </tr>

  <tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['address']; ?>
 : </strong> <span class="red">*</span></td>

    <td>
    <textarea name="address1" class="input003" style="color:#777" onblur="javascript:if($.trim(this.value).length == 0){this.value='<?php echo $this->_tpl_vars['lg']['address_input_place_holder']; ?>
';this.style.color='#777';}"
      onfocus="javascript:if($.trim(this.value)=='<?php echo $this->_tpl_vars['lg']['address_input_place_holder']; ?>
'){this.select();this.value='';this.style.color='#000';}"><?php echo $this->_tpl_vars['lg']['address_input_place_holder']; ?>
</textarea>
    </td>

  </tr>

  <tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['zip']; ?>
 : </strong> <span class="red">*</span></td>

    <td><input name="address2" type="text" class="input001" maxlength="20" /></td>

  </tr>

  <tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['city']; ?>
 : </strong> <span class="red">*</span></td>

    <td><input name="address3" type="text" class="input001" maxlength="50" /></td>

  </tr>

  

  <tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['province']; ?>
: </strong> <span class="white">*</span></td>

    <td><input name="address4" type="text" class="input001" maxlength="50" /></td>

  </tr>

  

  <tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['country']; ?>
 : </strong> <span class="red">*</span></td>

    <td><input name="address5" id="address5" type="hidden" value="" autocomplete="off" /><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_country.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<script language="javascript">

	function setCountryValue(str)

{

	//$("#address5").val(str);

	getAjaxExpress(str);	// ---------------------

}

	</script>

	</td>

  </tr>

  <tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['tel']; ?>
 : </strong> <span class="red">*</span></td>

    <td><input name="address6" type="text" class="input001" maxlength="50" /></td>

  </tr>

 <tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['email']; ?>
 : </strong> <span class="red">*</span></td>

    <td><input name="address7" type="text" class="input001" maxlength="50" /></td>

  </tr>

<?php if ($this->_tpl_vars['userid'] != -1): ?>

  <tr>

    <td align="left">&nbsp;</td>

    <td>

      <input name="addressupdate" type="checkbox" checked="checked" value="1" /> <?php echo $this->_tpl_vars['lg']['is_addto_addressbook']; ?>
 </td>

  </tr>

<?php endif; ?> 

</table>

  </div>

   <script language="javascript">

  

   EnterRadioIndex("address",0); 

   </script>

</div>

<div  class="step_div_header"><span style="margin-left:20px;"><?php echo $this->_tpl_vars['lg']['shipping_method']; ?>
</span></div>

<div style="padding:8px">

 <div id="expressdiv"></div>

	  <input name="sub1" id="sub1" type="hidden" value="0" />

	 <script language="javascript">

   EnterRadioIndex("express",0); 

</script>

</div>

<div style="display:none" id="expressdivloading">

<div style=" background:url(../pic/loadingpic.gif) 9px 8px #FFFBD1 no-repeat; font-size:11px; color:#000000; border:1px #FDDC9B solid; padding:5px; padding-left:40px">

The system now is on calculating the delivery charge . <br />

please wait. If your page has no response for a long time, please <a class="red" href="#" style="text-decoration:underline" onclick="getAjaxExpress($('#address5').val())">click here</a> to refresh the page</div>

</div>

<div  class="step_div_header"><span style="margin-left:20px;"><?php echo $this->_tpl_vars['lg']['add_remark']; ?>
</span></div>

<div style="padding:8px">

<textarea name="content"  class="input003" id="content" style="width:98%;"></textarea>

</div>

<div style="margin-top:20px; border-bottom:2px #cccccc solid;"></div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:20px;">

<tr>

	<td align="right" ><a href="products.php"><img src="../pic/continueshopping.jpg" /></a></td>

    <td width="100" align="center" >&nbsp;</td>

    <td align="left" ><input id="sumbitbutton" src="../pic/checkout_button1.gif" type="image" /></td>

</tr>

  </table>



</form>





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

		if(!CheckIsNull("stepinfo","address0","<?php echo $this->_tpl_vars['lg']['msg_firstname_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address8","<?php echo $this->_tpl_vars['lg']['msg_lastname_null']; ?>
")) return false;

		if ($.trim(document.stepinfo.address1.value) == "<?php echo $this->_tpl_vars['lg']['address_input_place_holder']; ?>
") {
			document.stepinfo.address1.focus();
			alert('<?php echo $this->_tpl_vars['lg']['msg_address_null']; ?>
');
			return false;
		}

		if(!CheckIsNull("stepinfo","address1","<?php echo $this->_tpl_vars['lg']['msg_address_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address2","<?php echo $this->_tpl_vars['lg']['msg_zipcode_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address3","<?php echo $this->_tpl_vars['lg']['msg_city_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address5","<?php echo $this->_tpl_vars['lg']['msg_country_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address6","<?php echo $this->_tpl_vars['lg']['msg_tel_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address7","<?php echo $this->_tpl_vars['lg']['msg_email_null']; ?>
")) return false;

		if(!CheckIsEmail("stepinfo","address7","<?php echo $this->_tpl_vars['lg']['msg_email_error']; ?>
")) return false;

	}

}

  </script>	

<?php elseif ($this->_tpl_vars['action'] == 'step_confirm'): ?>

<div style="margin-top:5px; margin-bottom:10px; font-size:14px; font-weight:bold"><img src="../pic/step1-pic.gif"  align="absmiddle" />&nbsp;&nbsp;<?php echo $this->_tpl_vars['lg']['step2_tips']; ?>
</div>

<form name="stepinfo" method="post" onsubmit="return CheckForm()" action="<?php echo $this->_tpl_vars['folder']; ?>
step.php?action=step_2">

<div  class="step_div_header"><span style="margin-left:20px;"><?php echo $this->_tpl_vars['lg']['items_ordered']; ?>
</span></div>

<div style="padding:8px">



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

<?php echo $this->_tpl_vars['lg']['remark']; ?>
:<?php echo $this->_tpl_vars['rows']['pcontent']; ?>
</em></td>

    <td align="right"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price']; ?>
 x <?php echo $this->_tpl_vars['rows']['pnum']; ?>
 = <span><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['itemprice']; ?>
</span></td>

  </tr>

</table>				 </td>

                </tr>

				<?php endforeach; endif; unset($_from); ?>

               <tr><td align="right">

               <table border="0" cellspacing="0" cellpadding="5">

                <tr>

                  <td height="20" align="right"><span class="impc weight"><?php echo $this->_tpl_vars['lg']['products_price']; ?>
 : <?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['totalprice']; ?>
</span></td>

                </tr>

                 <tr>

                  <td height="20" align="right">+ <?php echo $this->_tpl_vars['lg']['express_fee']; ?>
 (<span class="impc"><?php echo $this->_tpl_vars['express']; ?>
</span>) : <span class="impc"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['sub1']; ?>
</span></td>

                </tr> 

                <?php if ($this->_tpl_vars['sub3'] != 0): ?>

                 <tr>

                   <td align="right" >+ <?php echo $this->_tpl_vars['lg']['order_additional_price']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['sub3']; ?>
</span></td>

                 </tr>

                 <?php endif; ?>

                 <tr>

                   <td align="right"  class="shixian">+ <?php echo $this->_tpl_vars['lg']['discount_price']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['sub4']; ?>
</span></td>

                 </tr>

                   <?php if ($this->_tpl_vars['sub_coupon'] != 0): ?>

                  <tr>

                   <td align="right"  class="shixian">- <?php echo $this->_tpl_vars['lg']['coupon_price']; ?>
 (<span class="red"><?php echo $this->_tpl_vars['coupon_code']; ?>
</span>) : <span class="impc"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['sub_coupon']; ?>
</span></td>

                 </tr>

                  <?php endif; ?>

                 <tr>

                  <td align="right" ><input value="<?php echo $this->_tpl_vars['express']; ?>
" type="hidden" name="express" />

                    <input name="sub1" type="hidden" value="<?php echo $this->_tpl_vars['sub1']; ?>
" /><input name="sub3" type="hidden" value="<?php echo $this->_tpl_vars['sub3']; ?>
" /><input name="sub4" type="hidden" value="<?php echo $this->_tpl_vars['sub4']-$this->_tpl_vars['sub_coupon']; ?>
" /><input name="coupon_code" type="hidden" value="<?php echo $this->_tpl_vars['coupon_code']; ?>
" />

                  <?php echo $this->_tpl_vars['lg']['total']; ?>
: <span class="impc weight bigs"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['sub1']+$this->_tpl_vars['totalprice']+$this->_tpl_vars['sub3']+$this->_tpl_vars['sub4']-$this->_tpl_vars['sub_coupon']; ?>
</span></td>

                </tr>

                </table>

                </td>

               </tr>

</table>

</div>

<div  class="step_div_header"><span style="margin-left:20px;"><?php echo $this->_tpl_vars['lg']['shipping_address']; ?>
</span></div>

<div style="background-color:#F1F8FF;">

<table width="100%" border="0" cellpadding="0" cellspacing="13">

      <td width="130" align="right"><strong><?php echo $this->_tpl_vars['lg']['first_name']; ?>
 : </strong></td>

        <td align="left"><?php echo $this->_tpl_vars['address'][0]; ?>
<input type="hidden" name="address0" value="<?php echo $this->_tpl_vars['address'][0]; ?>
" />

        <input type="hidden" name="address" value="<?php echo $this->_tpl_vars['addressid']; ?>
" /> <input name="addressupdate" type="hidden" value="<?php echo $this->_tpl_vars['addressupdate']; ?>
" /></td>

        </tr>

		<tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['last_name']; ?>
 : </strong></td>

    <td align="left"><?php echo $this->_tpl_vars['address'][8]; ?>
<input type="hidden" name="address8" value="<?php echo $this->_tpl_vars['address'][8]; ?>
" /></td>

  </tr>

		<tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['address']; ?>
 : </strong></td>

    <td align="left"><?php echo $this->_tpl_vars['address'][1]; ?>
<input type="hidden" name="address1" value="<?php echo $this->_tpl_vars['address'][1]; ?>
" /></td>

  </tr>

  

  <tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['zip']; ?>
 : </strong></td>

    <td align="left"><?php echo $this->_tpl_vars['address'][2]; ?>
<input type="hidden" name="address2" value="<?php echo $this->_tpl_vars['address'][2]; ?>
" /></td>

    </tr><tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['city']; ?>
 : </strong></td>

    <td align="left"><?php echo $this->_tpl_vars['address'][3]; ?>
<input type="hidden" name="address3" value="<?php echo $this->_tpl_vars['address'][3]; ?>
" /></td>

  </tr>

  <tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['province']; ?>
 : </strong></td>

    <td align="left"><?php echo $this->_tpl_vars['address'][4]; ?>
<input type="hidden" name="address4" value="<?php echo $this->_tpl_vars['address'][4]; ?>
" /></td>

    </tr><tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['country']; ?>
 : </strong></td>

    <td align="left"><?php echo $this->_tpl_vars['address'][5]; ?>
<input type="hidden" name="address5" value="<?php echo $this->_tpl_vars['address'][5]; ?>
" /></td>

  </tr>

  <tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['tel']; ?>
 : </strong></td>

    <td align="left"><?php echo $this->_tpl_vars['address'][6]; ?>
<input type="hidden" name="address6" value="<?php echo $this->_tpl_vars['address'][6]; ?>
" /></td>

    </tr><tr>

    <td align="right"><strong><?php echo $this->_tpl_vars['lg']['email']; ?>
 : </strong></td>

    <td align="left"><?php echo $this->_tpl_vars['address'][7]; ?>
<input type="hidden" name="address7" value="<?php echo $this->_tpl_vars['address'][7]; ?>
" /></td>

  </tr>

</table>

</div>

<div  class="step_div_header"><span style="margin-left:20px;"><?php echo $this->_tpl_vars['lg']['your_remark']; ?>
</span></div>

<div style="padding:8px">

<?php echo $this->_tpl_vars['content']; ?>


<input name="content" type="hidden" class="input003" id="content" style="width:99%;" value="<?php echo $this->_tpl_vars['content']; ?>
" />

</div>



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

		if(!CheckIsNull("stepinfo","address0","<?php echo $this->_tpl_vars['lg']['msg_firstname_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address8","<?php echo $this->_tpl_vars['lg']['msg_lastname_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address1","<?php echo $this->_tpl_vars['lg']['msg_address_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address2","<?php echo $this->_tpl_vars['lg']['msg_zipcode_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address3","<?php echo $this->_tpl_vars['lg']['msg_city_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address5","<?php echo $this->_tpl_vars['lg']['msg_country_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address6","<?php echo $this->_tpl_vars['lg']['msg_tel_null']; ?>
")) return false;

		if(!CheckIsNull("stepinfo","address7","<?php echo $this->_tpl_vars['lg']['msg_email_null']; ?>
")) return false;

		if(!CheckIsEmail("stepinfo","address7","<?php echo $this->_tpl_vars['lg']['msg_email_error']; ?>
")) return false;

	}

}

  </script>	 <div style="margin-top:20px; border-bottom:2px #cccccc solid;"></div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:20px;">

<tr>

	<td align="right" ><a href="javascript:history.back();"><img src="../pic/backtochange.gif" /></a></td>

    <td width="160"  >&nbsp;</td>

    <td align="left" ><input src="../pic/check_out_new_btn3.gif" type="image" /></td>

</tr>

  </table><br />

<br />



</form>





<?php elseif ($this->_tpl_vars['action'] == 'step_3'): ?>

<?php echo $this->_tpl_vars['mailscript1']; ?>


<?php echo $this->_tpl_vars['mailscript2']; ?>


<div style="background:url(../pic/check_out_new_success_bg.gif) #F5F5F5 left top no-repeat;padding-left:70px; margin-bottom:10px; padding-top:15px; padding-bottom:20px">

<div>

 <span style=" color:#F67A16; font-weight:bold; font-size:18px"><?php echo $this->_tpl_vars['lg']['step3_tips']; ?>
</span><br /><br />



  <span style="font-size:14px"><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
: <?php echo $this->_tpl_vars['order']['itemno']; ?>
</span><br /><br />



<span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span><br />



<?php if ($this->_tpl_vars['order']['create_coupon_code'] != ""): ?><span class="linh"><?php echo $this->_tpl_vars['lg']['msg_coupon_system']; ?>
</span><?php endif; ?>



<div></div>

</div>

</div>



<form name="stepinfo" method="post" action="<?php echo $this->_tpl_vars['folder']; ?>
step.php?action=step_4&itemno=<?php echo $this->_tpl_vars['order']['itemno']; ?>
">

 <div  class="step_div_header"><span style="margin-left:20px;"><?php echo $this->_tpl_vars['lg']['payment_method']; ?>
</span></div>

<div style="padding:8px">

<table width="100%" border="0" cellspacing="1" cellpadding="3" style="background-color:#CCCCCC">

   <?php $_from = $this->_tpl_vars['rs_payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['rows']):
?> 

  <tr>

    <td width="8%" align="center" bgcolor="#EEEEEE"><input type="radio"  onclick="changeFees('<?php echo $this->_tpl_vars['rows']['pprice']; ?>
')" name="payment" value="<?php echo $this->_tpl_vars['rows']['name']; ?>
" /></td>

    <td width="92%" bgcolor="#EEEEEE"><a target="_blank" href="<?php echo $this->_tpl_vars['rows']['url']; ?>
"><img src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0" align="absmiddle" /></a> <strong><?php echo $this->_tpl_vars['rows']['name']; ?>
</strong> ( <?php echo $this->_tpl_vars['lg']['payment_fees']; ?>
:  <span class="impc"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['rows']['pprice']; ?>
</span> )</td>

  </tr>

  <?php if ($this->_tpl_vars['rows']['descript'] != ""): ?>

  <tr>

    <td colspan="2" bgcolor="#FFFFFF"><div class="linh small"><?php echo $this->_tpl_vars['rows']['descript']; ?>
</div></td>

    </tr>

	<?php endif; ?>

	 <?php endforeach; endif; unset($_from); ?>

</table>

	   <input name="sub2" id="sub2" type="hidden" value="<?php echo $this->_tpl_vars['rs_payment'][0]['pprice']; ?>
" />

	    <script language="javascript">

   EnterRadioIndex("payment",0); 

   </script>

</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:20px;">

<tr>

    <td align="center" ><input name="image" type="image" src="../pic/check_out_new_btn2.gif" /></td>

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

<div  class="step_div_header"><span style="margin-left:20px;"><?php echo $this->_tpl_vars['lg']['checkout']; ?>
 &gt;&gt; <?php echo $this->_tpl_vars['paymenttype']; ?>
</span></div>

<div style="padding:8px; background-color: #F5F5F5; font-size:14px; line-height:20px">

<?php if ($this->_tpl_vars['paymenttype'] == 'paypal'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form action="https://www.paypal.com/row/cgi-bin/webscr" method="post" target="_blank">

<input type="hidden" name="cmd" value="_xclick">

<input type="hidden" name="business" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['business']; ?>
">

<input type="hidden" name="item_name" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['item_name']; ?>
">

<input type="hidden" name="currency_code" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['currency_code']; ?>
">

<input type="hidden" name="return" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['return']; ?>
">

<input type="hidden" name="notify_url" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['return']; ?>
">

<input type="hidden" name="amount" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['amount']; ?>
">

<input type="hidden" name="item_number" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['item_name']; ?>
">

<input type="hidden" name="invoice" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['item_name']; ?>
">

<input type="hidden" name="charset" value="utf-8">

<input type="hidden" name="no_note" value="1">

<input type="hidden" name="rm" value="2">

<input class="submitbtn" type="submit" name="Submit3" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form></div>



<?php elseif ($this->_tpl_vars['paymenttype'] == 'gspay'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form method="POST" action="https://secure.sslgateways.com/payment/index.php" target="_blank">

<input type="hidden" name="returnUrl" value="<?php echo $this->_tpl_vars['order']['payonline']['gspay']['returnUrl']; ?>
">

<input type="hidden" name="siteID" value="<?php echo $this->_tpl_vars['order']['payonline']['gspay']['siteID']; ?>
">

<input type="hidden" name="OrderID" value="<?php echo $this->_tpl_vars['order']['payonline']['gspay']['OrderID']; ?>
">

<input type="hidden" name="OrderDescription" value="<?php echo $this->_tpl_vars['order']['payonline']['gspay']['OrderDescription']; ?>
">

<input type="hidden" name="Amount" value="<?php echo $this->_tpl_vars['order']['payonline']['gspay']['Amount']; ?>
">

<input type="hidden" name="Qty" value="<?php echo $this->_tpl_vars['order']['payonline']['gspay']['Qty']; ?>
">

<input class="submitbtn" type="submit" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form>

</div>

<?php elseif ($this->_tpl_vars['paymenttype'] == 'ctopay'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form name="payForm" target="_blank" action="https://payment.ttopay.com/payment/Interface" method="post">

    <input type="hidden" name="MerNo" value="<?php echo $this->_tpl_vars['order']['payonline']['ctopay']['MerNo']; ?>
">

    <input type="hidden" name="BillNo" value="<?php echo $this->_tpl_vars['order']['payonline']['ctopay']['BillNo']; ?>
">

    <input type="hidden" name="Amount" value="<?php echo $this->_tpl_vars['order']['payonline']['ctopay']['Amount']; ?>
">

    <input type="hidden" name="ReturnURL" value="<?php echo $this->_tpl_vars['order']['payonline']['ctopay']['ReturnURL']; ?>
">

    <input type="hidden" name="Language" value="<?php echo $this->_tpl_vars['order']['payonline']['ctopay']['Language']; ?>
">

    <input type="hidden" name="Currency" value="<?php echo $this->_tpl_vars['order']['payonline']['ctopay']['Currency']; ?>
">

    <input type="hidden" name="MD5info" value="<?php echo $this->_tpl_vars['order']['payonline']['ctopay']['MD5info']; ?>
">

    <input type="hidden" name="Remark" value="<?php echo $this->_tpl_vars['order']['payonline']['ctopay']['Remark']; ?>
"><input class="submitbtn" type="submit" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form>

</div>

<?php elseif ($this->_tpl_vars['paymenttype'] == 'moneybookers'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
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

<input class="submitbtn" type="submit" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form> 

</div>

<?php elseif ($this->_tpl_vars['paymenttype'] == 'payease'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form name="form" method="post" target="_blank" action="http://pay.beijing.com.cn/prs/e_user_payment.checkit">

 <input type="hidden" name="v_mid" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_mid']; ?>
">

 <input type="hidden" name="v_oid" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_oid']; ?>
">

 <input type="hidden" name="v_rcvname" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_rcvname']; ?>
">

 <input type="hidden" name="v_rcvaddr" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_rcvaddr']; ?>
">

 <input type="hidden" name="v_rcvtel" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_rcvtel']; ?>
">

 <input type="hidden" name="v_rcvpost" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_rcvpost']; ?>
">	

 <input type="hidden" name="v_amount" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_amount']; ?>
">

 <input type="hidden" name="v_ymd" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_ymd']; ?>
">

 <input type="hidden" name="v_orderstatus" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_orderstatus']; ?>
">

 <input type="hidden" name="v_ordername" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_ordername']; ?>
">

 <input type="hidden" name="v_moneytype" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_moneytype']; ?>
">         

 <input type="hidden" name="v_url" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_url']; ?>
">

 <input type="hidden" name="v_md5info" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_md5info']; ?>
">

<input type="hidden" name="v_shipstreet" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_shipstreet']; ?>
">

<input type="hidden" name="v_shipcity" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_shipcity']; ?>
">

<input type="hidden" name="v_shipstate" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_shipstate']; ?>
">

<input type="hidden" name="v_shippost" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_shippost']; ?>
">

<input type="hidden" name="v_shipcountry" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_shipcountry']; ?>
">

<input type="hidden" name="v_shipphone" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_shipphone']; ?>
">

<input type="hidden" name="v_shipemail" value="<?php echo $this->_tpl_vars['order']['payonline']['payease']['v_shipemail']; ?>
">

 <input class="submitbtn" name="" type="submit" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
"  />

 </form>



</div>





<?php elseif ($this->_tpl_vars['paymenttype'] == '95epay'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form action="https://www.95epay.com/PayReduceRequestAction.action" target="_blank" method="post">

	<input type="hidden" name="MerNo" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['MerNo']; ?>
" />

	<input type="hidden" name="BillNo" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['BillNo']; ?>
" />

	<input type="hidden" name="Currency" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['Currency']; ?>
" />

	<input type="hidden" name="Amount" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['Amount']; ?>
" />

	

	<input type="hidden" name="Language" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['Language']; ?>
" />

	<input type="hidden" name="MerWebsite" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['MerWebsite']; ?>
" />

	<input type="hidden" name="Remark" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['Remark']; ?>
" />

	<input type="hidden" name="ReturnURL" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['ReturnURL']; ?>
"/>

	<input type="hidden" name="MD5info" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['MD5info']; ?>
" />

	

	<!--收货人信息-->

	<input name="DeliveryFirstName" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['DeliveryFirstName']; ?>
">

	<input name="DeliveryLastName" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['DeliveryLastName']; ?>
">

	<input name="DeliveryEmail" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['DeliveryEmail']; ?>
">

	<input name="DeliveryPhone" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['DeliveryPhone']; ?>
">

	<input name="DeliveryZipCode" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['DeliveryZipCode']; ?>
">

	<input name="DeliveryAddress" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['DeliveryAddress']; ?>
">

	<input name="DeliveryCity" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['DeliveryCity']; ?>
">

	<input name="DeliveryState" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['DeliveryState']; ?>
">

	<input name="DeliveryCountry" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['DeliveryCountry']; ?>
">

    

    <input name="FirstName" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['FirstName']; ?>
">

	<input name="LastName" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['LastName']; ?>
">

	<input name="Email" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['Email']; ?>
">

	<input name="Phone" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['Phone']; ?>
">

	<input name="ZipCode" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['ZipCode']; ?>
">

	<input name="Address" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['Address']; ?>
">

	<input name="City" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['City']; ?>
">

	<input name="State" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['State']; ?>
">

	<input name="Country" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['payonline']['95epay']['Country']; ?>
">

    <input name="Products" type="hidden" class="input" value="<?php echo $this->_tpl_vars['order']['products']; ?>
">

    <input class="submitbtn" type="submit" name="b1" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form>

</div>

<?php elseif ($this->_tpl_vars['paymenttype'] == 'ips'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form name="payForm" target="_blank" action="https://pay.ips.com.cn/icpay/customization/foreigntrade/payment.aspx" method="post">

<input type="hidden" name="pMerchantCode" value="<?php echo $this->_tpl_vars['order']['payonline']['ips']['pMerchantCode']; ?>
" />

<input type="hidden" name="pICPayReq" value="<?php echo $this->_tpl_vars['order']['payonline']['ips']['pICPayReq']; ?>
" />

<input type="hidden" name="pICPayReqHashValue" value="<?php echo $this->_tpl_vars['order']['payonline']['ips']['pICPayReqHashValue']; ?>
" />

<input type="hidden" name="pAFSReq" value="<?php echo $this->_tpl_vars['order']['payonline']['ips']['pAFSReq']; ?>
" />

<input type="hidden" name="pAFSReqHashValue" value="<?php echo $this->_tpl_vars['order']['payonline']['ips']['pAFSReqHashValue']; ?>
" />

<input class="submitbtn" type="submit" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form>

</div>

<?php elseif ($this->_tpl_vars['paymenttype'] == 'ecpss'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form action="https://security.sslepay.com/sslpayment" target="_blank" method="post" name="E_FORM">

	<input type="hidden" name="MerNo" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['MerNo']; ?>
">

	  <input type="hidden" name="Currency" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['Currency']; ?>
">

	  <input type="hidden" name="BillNo" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['BillNo']; ?>
">

	  <input type="hidden" name="Amount" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['Amount']; ?>
">

	  <input type="hidden" name="ReturnURL" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['ReturnURL']; ?>
" >

	  <input type="hidden" name="Language" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['Language']; ?>
">

	  <input type="hidden" name="MD5info" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['MD5info']; ?>
">

	  <input type="hidden" name="Remark" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['Remark']; ?>
">

	  <input type="hidden" name="shippingFirstName" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['shippingFirstName']; ?>
">

	  <input type="hidden" name="shippingLastName" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['shippingLastName']; ?>
">

	  <input type="hidden" name="shippingEmail" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['shippingEmail']; ?>
">

	  <input type="hidden" name="shippingPhone" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['shippingPhone']; ?>
">

	  <input type="hidden" name="shippingZipcode" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['shippingZipcode']; ?>
">

	  <input type="hidden" name="shippingAddress" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['shippingAddress']; ?>
">

	  <input type="hidden" name="shippingCity" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['shippingCity']; ?>
">

	  <input type="hidden" name="shippingSstate" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['shippingSstate']; ?>
">

	  <input type="hidden" name="shippingCountry" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['shippingCountry']; ?>
">

	  <input type="hidden" name="products" value="<?php echo $this->_tpl_vars['order']['payonline']['ecpss']['products']; ?>
">

<input class="submitbtn" type="submit" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form>

</div>

<?php elseif ($this->_tpl_vars['paymenttype'] == 'ttopay'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form name="payForm" target="_blank" action="<?php echo $this->_tpl_vars['order']['payonline']['ttopay']['actionUrl']; ?>
" method="post">

    <input type="hidden" name="MerNo" value="<?php echo $this->_tpl_vars['order']['payonline']['ttopay']['MerNo']; ?>
">

    <input type="hidden" name="BillNo" value="<?php echo $this->_tpl_vars['order']['payonline']['ttopay']['BillNo']; ?>
">

    <input type="hidden" name="Amount" value="<?php echo $this->_tpl_vars['order']['payonline']['ttopay']['Amount']; ?>
">

    <input type="hidden" name="ReturnURL" value="<?php echo $this->_tpl_vars['order']['payonline']['ttopay']['ReturnURL']; ?>
">

    <input type="hidden" name="Language" value="<?php echo $this->_tpl_vars['order']['payonline']['ttopay']['Language']; ?>
">

    <input type="hidden" name="Currency" value="<?php echo $this->_tpl_vars['order']['payonline']['ttopay']['Currency']; ?>
">

    <input type="hidden" name="MD5info" value="<?php echo $this->_tpl_vars['order']['payonline']['ttopay']['MD5info']; ?>
">

    <input type="hidden" name="Remark" value="<?php echo $this->_tpl_vars['order']['payonline']['ttopay']['Remark']; ?>
">

	<input class="submitbtn" type="submit" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form>

</div>

<?php elseif ($this->_tpl_vars['paymenttype'] == 'paypaloff'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form action="<?php echo $this->_tpl_vars['folder']; ?>
step.php?action=paypaloff_save&itemno=<?php echo $this->_tpl_vars['order']['itemno']; ?>
" method="post" name="E_FORM">

<span style="font-size:14px; color:#FF0000; font-weight:bold"><?php echo $this->_tpl_vars['payment_content']; ?>
</span>

<br />

<input name="payment" type="hidden" value="paypal" /><input type="text" style="width:200px" name="paypalaccount" >

<input class="submitbtn" type="submit" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form>

</div>

<?php elseif ($this->_tpl_vars['paymenttype'] == 'yourspay'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form name="payForm" target="_blank" action="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['actionUrl']; ?>
" method="post">

    <input type="hidden" name="MerNo" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['MerNo']; ?>
">

    <input type="hidden" name="BillNo" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['BillNo']; ?>
">

    <input type="hidden" name="Amount" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['Amount']; ?>
">

    <input type="hidden" name="ReturnURL" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['ReturnURL']; ?>
">

    <input type="hidden" name="Language" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['Language']; ?>
">

    <input type="hidden" name="Currency" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['Currency']; ?>
">

    <input type="hidden" name="MD5info" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['MD5info']; ?>
">

    <input type="hidden" name="Remark" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['Remark']; ?>
">

	<input type="hidden" name="CurrencyCode" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['CurrencyCode']; ?>
">

	<input type="hidden" name="GoodsName" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['GoodsName']; ?>
">

	<input type="hidden" name="shipAddress" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['shipAddress']; ?>
">

	<input type="hidden" name="shipCity" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['shipCity']; ?>
">

	<input type="hidden" name="shipState" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['shipState']; ?>
">

	<input type="hidden" name="shipCountry" value="<?php echo $this->_tpl_vars['order']['payonline']['yourspay']['shipCountry']; ?>
">

	<input class="submitbtn" type="submit" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form>

</div>

<?php elseif ($this->_tpl_vars['paymenttype'] == 'fashionpay'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : USD$ <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form action="https://www.fashionpay.com/fashionpayRequestAction.action" target="_blank" method="post" name="E_FORM">

	<input type="hidden" name="MerNo" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['MerNo']; ?>
">

	  <input type="hidden" name="Currency" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['Currency']; ?>
">

	  <input type="hidden" name="BillNo" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['BillNo']; ?>
">

	  <input type="hidden" name="Amount" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['Amount']; ?>
">

	  <input type="hidden" name="ReturnURL" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['ReturnURL']; ?>
" >

	  <input type="hidden" name="Language" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['Language']; ?>
">

	  <input type="hidden" name="MD5info" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['MD5info']; ?>
">

	  <input type="hidden" name="Remark" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['Remark']; ?>
">

	  <input type="hidden" name="DeliveryFirstName" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['DeliveryFirstName']; ?>
">

	  <input type="hidden" name="DeliveryLastName" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['DeliveryLastName']; ?>
">

	  <input type="hidden" name="DeliveryEmail" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['DeliveryEmail']; ?>
">

	  <input type="hidden" name="DeliveryPhone" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['DeliveryPhone']; ?>
">

	  <input type="hidden" name="DeliveryZipCode" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['DeliveryZipCode']; ?>
">

	  <input type="hidden" name="DeliveryAddress" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['DeliveryAddress']; ?>
">

	  <input type="hidden" name="DeliveryCity" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['DeliveryCity']; ?>
">

	  <input type="hidden" name="DeliveryState" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['DeliveryState']; ?>
">

	  <input type="hidden" name="DeliveryCountry" value="<?php echo $this->_tpl_vars['order']['payonline']['fashionpay']['DeliveryCountry']; ?>
">

<input class="submitbtn" type="submit" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form>

</div>

<?php elseif ($this->_tpl_vars['paymenttype'] == 'rppay'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : USD$ <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form action="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['submit_url']; ?>
" method="post" target="_blank" id="rppay_form" class="hidden">

			<input type="hidden" name="order_sn" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['order_sn']; ?>
" />

			<input type="hidden" name="siteid" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['siteid']; ?>
" />

			<input type="hidden" name="verifyCode" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['verifyCode']; ?>
" />

			<input type="hidden" name="ShippingFee" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['ShippingFee']; ?>
" />

			<input type="hidden" name="currency" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['currency']; ?>
" />

			<input type="hidden" name="returnUrl" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['returnUrl']; ?>
" />

			<input type="hidden" name="backurl" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['backurl']; ?>
" />

			<input type="hidden" name="product_no[1]" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['product_no']; ?>
" />

			<input type="hidden" name="product_name[1]" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['product_name']; ?>
" />

			<input type="hidden" name="price_unit[1]" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['price_unit']; ?>
" />

			<input type="hidden" name="quantity[1]" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['quantity']; ?>
" />

			

			<input type="hidden" name="email" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['email']; ?>
" />

			<input type="hidden" name="customername" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['customername']; ?>
" />

			<input type="hidden" name="state" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['state']; ?>
" />

			<input type="hidden" name="city" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['city']; ?>
" />

			<input type="hidden" name="address" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['address']; ?>
" />

			<input type="hidden" name="country" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['country']; ?>
" />

			<input type="hidden" name="postcode" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['postcode']; ?>
" />

			<input type="hidden" name="tel" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['tel']; ?>
" />

			<input type="hidden" name="mobile" value="<?php echo $this->_tpl_vars['order']['payonline']['rppay']['mobile']; ?>
" />

<input class="submitbtn" type="submit" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

		</form>



</div>

<?php elseif ($this->_tpl_vars['paymenttype'] == 'wedopay'): ?>



<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : USD$ <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form action="https://secure.wedopay.net/sslpayment" target="_blank" method="post" name="E_FORM">

		<input type="hidden" name="MerNo" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['MerNo']; ?>
">

		<input type="hidden" name="Currency" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['Currency']; ?>
">

	  <input type="hidden" name="BillNo" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['BillNo']; ?>
">

	  <input type="hidden" name="Amount" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['Amount']; ?>
">

	  <input type="hidden" name="ReturnURL" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['ReturnURL']; ?>
" >

	  <input type="hidden" name="Language" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['Language']; ?>
">

	  <input type="hidden" name="MD5info" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['MD5info']; ?>
">

	  <input type="hidden" name="Remark" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['Remark']; ?>
">

	  <input type="hidden" name="shippingFirstName" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['shippingFirstName']; ?>
">

	  <input type="hidden" name="shippingLastName" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['shippingLastName']; ?>
">

	  <input type="hidden" name="shippingEmail" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['shippingEmail']; ?>
">

	  <input type="hidden" name="shippingPhone" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['shippingPhone']; ?>
">

	  <input type="hidden" name="shippingZipcode" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['shippingZipcode']; ?>
">

	  <input type="hidden" name="shippingAddress" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['shippingAddress']; ?>
">

	  <input type="hidden" name="shippingCity" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['shippingCity']; ?>
">

	  <input type="hidden" name="shippingSstate" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['shippingSstate']; ?>
">

	  <input type="hidden" name="shippingCountry" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['shippingCountry']; ?>
">

	  <input type="hidden" name="products" value="<?php echo $this->_tpl_vars['order']['payonline']['wedopay']['products']; ?>
">

	  <input class="submitbtn" type="submit" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form>



</div>

<?php elseif ($this->_tpl_vars['paymenttype'] == '99bill'): ?>



<div>Order number is : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight">Subtotal : USD$ <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

		<form name="kqPay" method="post" target="_blank" action="https://cpay.99bill.com/fgw/payment/purchase.htm">

			<input type="hidden" name="inputCharset" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['inputCharset']; ?>
"/>

            <input type="hidden" name="pageUrl" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['pageUrl']; ?>
"/>

			<input type="hidden" name="bgUrl" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['bgUrl']; ?>
"/>

			<input type="hidden" name="version" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['version']; ?>
"/>

			<input type="hidden" name="language" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['language']; ?>
"/>

			<input type="hidden" name="signType" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['signType']; ?>
"/>

			<input type="hidden" name="signMsg" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['signMsg']; ?>
"/>

			<input type="hidden" name="merchantAcctId" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['merchantAcctId']; ?>
"/>

            <input type="hidden" name="termId" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['termId']; ?>
"/>

            <input type="hidden" name="firstName" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['firstName']; ?>
"/>

            <input type="hidden" name="lastName" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['lastName']; ?>
"/>

            <input type="hidden" name="fullName" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['fullName']; ?>
"/>

            <input type="hidden" name="issuingBank" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['issuingBank']; ?>
"/>

            <input type="hidden" name="issuingCountry" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['issuingCountry']; ?>
"/>

            <input type="hidden" name="email" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['email']; ?>
"/>

            <input type="hidden" name="phoneNumber" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['phoneNumber']; ?>
"/>

            <input type="hidden" name="zipCode" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['zipCode']; ?>
"/>

            <input type="hidden" name="shippingAddress" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['shippingAddress']; ?>
"/>

            <input type="hidden" name="billingAddress" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['billingAddress']; ?>
"/>

            <input type="hidden" name="billingCity" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['billingCity']; ?>
"/>

            <input type="hidden" name="billingState" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['billingState']; ?>
"/>

            <input type="hidden" name="billingCountry" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['billingCountry']; ?>
"/>

            <input type="hidden" name="orderId" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['orderId']; ?>
"/>

            <input type="hidden" name="pricingCurrency" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['pricingCurrency']; ?>
"/>

            <input type="hidden" name="pricingAmount" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['pricingAmount']; ?>
"/>

            <input type="hidden" name="billingCurrency" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['billingCurrency']; ?>
"/>

            <input type="hidden" name="billingAmount" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['billingAmount']; ?>
"/>

            <input type="hidden" name="exchangeRateFlag" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['exchangeRateFlag']; ?>
"/>

            <input type="hidden" name="exchangeRateDirection" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['exchangeRateDirection']; ?>
"/>

            <input type="hidden" name="exchangeRate" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['exchangeRate']; ?>
"/>

            <input type="hidden" name="orderTime" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['orderTime']; ?>
"/>

            <input type="hidden" name="productName" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['productName']; ?>
"/>

            <input type="hidden" name="productNum" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['productNum']; ?>
"/>

            <input type="hidden" name="productId" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['productId']; ?>
"/>

            <input type="hidden" name="productDesc" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['productDesc']; ?>
"/>

            <input type="hidden" name="payType" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['payType']; ?>
"/>

            <input type="hidden" name="bankId" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['bankId']; ?>
"/>

            <input type="hidden" name="redoFlag" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['redoFlag']; ?>
"/>

            <input type="hidden" name="ext1" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['ext1']; ?>
"/>

			<input type="hidden" name="ext2" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['ext2']; ?>
"/>

            <input type="hidden" name="pid" value="<?php echo $this->_tpl_vars['order']['payonline']['99bill']['pid']; ?>
"/>

			<input class="submitbtn" type="submit" name="submit" value="Use 99bill payment">

		</form>

</div>

<?php endif; ?>

</div>

<?php elseif ($this->_tpl_vars['action'] == 'step_6'): ?>

<div  class="step_div_header"><span style="margin-left:20px;"><?php echo $this->_tpl_vars['lg']['checkout']; ?>
 &gt;&gt; <?php echo $this->_tpl_vars['lg']['order_complete']; ?>
</span></div>

<div style="padding:8px; background-color: #F5F5F5; font-size:14px; line-height:20px">

<div><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : <?php echo $this->_tpl_vars['order']['coin']; ?>
 <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div class="linh"><?php echo $this->_tpl_vars['payment_content']; ?>
</div>

</div>



<?php elseif ($this->_tpl_vars['action'] == 'step_paypalto'): ?>

<div  class="step_div_header"><span style="margin-left:20px;"><?php echo $this->_tpl_vars['lg']['checkout']; ?>
 &gt;&gt; <?php echo $this->_tpl_vars['lg']['go_to_paypal']; ?>
</span></div>

<div style="padding:8px; background-color: #F5F5F5; font-size:14px; line-height:20px">

<div ><?php echo $this->_tpl_vars['lg']['order_number_is']; ?>
 : <span class="impc"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span></div>

<div><span style="font-size:14px" class="red weight"><?php echo $this->_tpl_vars['lg']['subtotal']; ?>
 : USD <?php echo $this->_tpl_vars['order']['totalprices']; ?>
</span></div>

<div>

<form action="https://www.paypal.com/row/cgi-bin/webscr" method="post" target="_blank">

<input type="hidden" name="cmd" value="_xclick">

<input type="hidden" name="business" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['business']; ?>
">

<input type="hidden" name="item_name" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['item_name']; ?>
">

<input type="hidden" name="currency_code" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['currency_code']; ?>
">

<input type="hidden" name="return" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['return']; ?>
">

<input type="hidden" name="notify_url" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['return']; ?>
">

<input type="hidden" name="amount" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['amount']; ?>
">

<input type="hidden" name="item_number" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['item_name']; ?>
">

<input type="hidden" name="invoice" value="<?php echo $this->_tpl_vars['order']['payonline']['paypal']['item_name']; ?>
">

<input type="hidden" name="charset" value="utf-8">

<input type="hidden" name="no_note" value="1">

<input type="hidden" name="rm" value="2">

<input class="submitbtn" type="submit" name="Submit3" value="<?php echo $this->_tpl_vars['lg']['use_cc_payment']; ?>
">

</form></div>

</div>

<?php elseif ($this->_tpl_vars['action'] == 'step_return'): ?>

<div  class="step_div_header"><span style="margin-left:20px;"><?php echo $this->_tpl_vars['lg']['checkout']; ?>
 &gt;&gt; <?php echo $this->_tpl_vars['lg']['order_complete']; ?>
</span></div>

<div style="padding:8px; background-color: #F5F5F5; font-size:14px; line-height:20px">

<div class="linh"><?php echo $this->_tpl_vars['payment_content']; ?>
</div>

<?php endif; ?>

</div>