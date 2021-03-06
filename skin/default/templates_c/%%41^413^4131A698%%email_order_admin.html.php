<?php /* Smarty version 2.6.26, created on 2015-01-12 16:22:18
         compiled from email_order_admin.html */ ?>
<div style="border-bottom: #9edcf4 1px solid; border-left: #9edcf4 1px solid; padding-bottom: 3px; background-color: #c7ecff; padding-left: 3px; width: 700px; padding-right: 3px; border-top: #9edcf4 1px solid; border-right: #9edcf4 1px solid; padding-top: 3px">
<div style="border-bottom: #88bedc 1px solid; border-left: #88bedc 1px solid; padding-bottom: 3px; background-color: #ffffff; padding-left: 3px; padding-right: 3px; border-top: #88bedc 1px solid; border-right: #88bedc 1px solid; padding-top: 3px">
<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tbody>
        <tr>
            <td colspan="2">
            <div style="border-bottom: #5ecbef 1px dotted; border-left: #5ecbef 1px dotted; padding-bottom: 4px; background-color: #f3fcff; padding-left: 4px; padding-right: 4px; border-top: #5ecbef 1px dotted; border-right: #5ecbef 1px dotted; padding-top: 4px">Dear <strong><?php echo $this->_tpl_vars['order']['username']; ?>
</strong><br />
            <br />
            Thank you for your order on <?php echo $this->_tpl_vars['domain']; ?>
! <br />
            <br />
            Order number: <span style="color: #f00; font-weight: bold"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span>.<br />
            Order information:&nbsp;<a target="_blank" href="<?php echo $this->_tpl_vars['httpdomain']; ?>
profile.php?action=search_order&amp;itemno=<?php echo $this->_tpl_vars['order']['itemno']; ?>
"><span style="color: rgb(255, 0, 0); font-weight: bold;">Click Here</span></a>.&nbsp;<br />
            <br />
            If you have any questions, please contact us by&nbsp;<span style="color: rgb(255, 0, 0);"><strong><a href="mailto:mingdatrade@hotmail.com">mingdatrade@hotmail.com</a></strong></span>&nbsp;or our online agent. Please tell us your order number for inquiry. Thanks!<br />
            <br />
            <span style="padding-left: 4px; font-family: Verdana; font-size: 16px"><strong>Product Detail: </strong></span><br />
            <table border="0" cellspacing="0" cellpadding="2" width="680" style="border-bottom: #6b6a6f 1px solid; margin-top: 4px; border-top: #6b6a6f 1px solid">
                <tbody>
                    <tr>
                        <td class="shixian weight" width="70" align="center">Item(s)</td>
                        <td class="shixian weight" width="270">&nbsp;</td>
                        <td class="shixian weight" width="100" align="center">Unit price</td>
                        <td class="shixian weight" width="100" align="center">Qty</td>
                        <td class="shixian weight" width="100" align="center">Sub price</td>
                    </tr>
                </tbody>
            </table>
            <?php $_from = $this->_tpl_vars['rs_o']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
?>
            <table border="0" cellspacing="0" cellpadding="5" width="680" style="border-bottom: #6b6a6f 1px dashed">
                <tbody>
                    <tr>
                        <td class="xuxian" bgcolor="#ffffff" width="70" align="center"><a href="<?php echo $this->_tpl_vars['httpdomain']; ?>
product-view.php?id=<?php echo $this->_tpl_vars['rows']['pid']; ?>
"><img border="0" alt="" src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" /></a></td>
                        <td class="xuxian" bgcolor="#ffffff" width="270"><a target="_blank" href="<?php echo $this->_tpl_vars['httpdomain']; ?>
product-view.php?id=<?php echo $this->_tpl_vars['rows']['pid']; ?>
"><span class="mainc"><?php echo $this->_tpl_vars['rows']['pname']; ?>
</span></a><br />
                        <em><?php echo $this->_tpl_vars['rows']['pstyle']; ?>
</em> <br />
                        <em>Remark:<?php echo $this->_tpl_vars['rows']['premark']; ?>
</em></td>
                        <td bgcolor="#ffffff" width="100" align="center"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['rows']['pprice']; ?>
</td>
                        <td bgcolor="#ffffff" width="100" align="center"><?php echo $this->_tpl_vars['rows']['pnum']; ?>
</td>
                        <td bgcolor="#ffffff" width="100" align="center"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['rows']['itemprice']; ?>
</td>
                    </tr>
                </tbody>
            </table>
            <?php endforeach; endif; unset($_from); ?>
            <table border="0" cellspacing="0" cellpadding="5" width="680">
                <tbody>
                    <tr>
                        <td class="xuxian" bgcolor="#ffffff" width="70" align="center">&nbsp;</td>
                        <td class="xuxian" bgcolor="#ffffff" width="270">&nbsp;</td>
                        <td bgcolor="#ffffff" width="100" align="center">&nbsp;</td>
                        <td bgcolor="#ffffff" width="100" align="center"><?php echo $this->_tpl_vars['order']['productnum']; ?>
</td>
                        <td bgcolor="#ffffff" width="100" align="center"><span style="color: #f00; font-weight: bold"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['order']['productprice']; ?>
</span></td>
                    </tr>
                </tbody>
            </table>
            <br />
            <span style="padding-left: 4px; font-family: Verdana; font-size: 16px"><strong>Shipping Address:</strong></span><br />
            <table border="0" cellspacing="1" cellpadding="2" width="100%" style="background-color: #cccccc; margin-top: 5px">
                <tbody>
                    <tr>
                        <td bgcolor="#ffffff" width="101" align="right">First name :</td>
                        <td bgcolor="#ffffff" width="265"><?php echo $this->_tpl_vars['order']['arraddress'][0]; ?>
</td>
                        <td bgcolor="#ffffff" width="122" align="right">Last name :</td>
                        <td bgcolor="#ffffff" width="294"><?php echo $this->_tpl_vars['order']['arraddress'][8]; ?>
</td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" width="101" align="right">Street :</td>
                        <td bgcolor="#ffffff" colspan="3"><?php echo $this->_tpl_vars['order']['arraddress'][1]; ?>
</td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" width="101" align="right">Postcode :</td>
                        <td bgcolor="#ffffff"><?php echo $this->_tpl_vars['order']['arraddress'][2]; ?>
</td>
                        <td bgcolor="#ffffff" align="right">City :</td>
                        <td bgcolor="#ffffff"><?php echo $this->_tpl_vars['order']['arraddress'][3]; ?>
</td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" width="101" align="right">Province :</td>
                        <td bgcolor="#ffffff"><?php echo $this->_tpl_vars['order']['arraddress'][4]; ?>
</td>
                        <td bgcolor="#ffffff" align="right">Country :</td>
                        <td bgcolor="#ffffff"><?php echo $this->_tpl_vars['order']['arraddress'][5]; ?>
</td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" width="101" align="right">Telphone :</td>
                        <td bgcolor="#ffffff"><?php echo $this->_tpl_vars['order']['arraddress'][6]; ?>
</td>
                        <td bgcolor="#ffffff" align="right">E-mail :</td>
                        <td bgcolor="#ffffff"><?php echo $this->_tpl_vars['order']['arraddress'][7]; ?>
</td>
                    </tr>
                </tbody>
            </table>
            <br />
            <span style="padding-left: 4px; font-family: Verdana; font-size: 16px"><strong>Order Infomation:</strong></span><br />
            <table border="0" cellspacing="1" cellpadding="2" width="100%" style="background-color: #cccccc; margin-top: 5px">
                <tbody>
                    <tr>
                        <td bgcolor="#ffffff" width="101" align="right">Shipment :</td>
                        <td bgcolor="#ffffff" width="265"><?php echo $this->_tpl_vars['order']['express']; ?>
</td>
                        <td bgcolor="#ffffff" width="122" align="right">Shipping Price :</td>
                        <td bgcolor="#ffffff" width="294"><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['order']['sub1']; ?>
</td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" width="101" align="right">Subtotal :</td>
                        <td bgcolor="#ffffff"><span><?php echo $this->_tpl_vars['order']['coin']; ?>
<?php echo $this->_tpl_vars['order']['productprice']+$this->_tpl_vars['order']['sub1']; ?>
</span> <a target="_blank" href="<?php echo $this->_tpl_vars['httpdomain']; ?>
step.php?action=step_3&amp;itemno=<?php echo $this->_tpl_vars['order']['itemno']; ?>
"><span style="color: #f00; font-weight: bold; text-decoration: none">Pay for Order &gt;&gt;&gt;</span></a></td>
                        <td bgcolor="#ffffff" align="right">OrderTime :</td>
                        <td bgcolor="#ffffff"><?php echo $this->_tpl_vars['order']['addtime']; ?>
</td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" width="101" align="right">Remark :</td>
                        <td bgcolor="#ffffff" colspan="3"><?php echo $this->_tpl_vars['order']['content']; ?>
</td>
                    </tr>
                </tbody>
            </table>
            </div>
            </td>
        </tr>
    </tbody>
</table>
</div>
</div>