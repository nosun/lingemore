<?php /* Smarty version 2.6.26, created on 2012-10-25 23:36:24
         compiled from email_order_pay_user.html */ ?>
<div style="border-bottom: #9edcf4 1px solid; border-left: #9edcf4 1px solid; padding-bottom: 3px; background-color: #c7ecff; padding-left: 3px; width: 700px; padding-right: 3px; border-top: #9edcf4 1px solid; border-right: #9edcf4 1px solid; padding-top: 3px">
<div style="border-bottom: #88bedc 1px solid; border-left: #88bedc 1px solid; padding-bottom: 3px; background-color: #ffffff; padding-left: 3px; padding-right: 3px; border-top: #88bedc 1px solid; border-right: #88bedc 1px solid; padding-top: 3px">
<table border="0" align="center" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td colspan="2">
            <div style="border-bottom: #5ecbef 1px dotted; border-left: #5ecbef 1px dotted; padding-bottom: 4px; background-color: #f3fcff; padding-left: 4px; padding-right: 4px; border-top: #5ecbef 1px dotted; border-right: #5ecbef 1px dotted; padding-top: 4px">Dear <strong><?php echo $this->_tpl_vars['order']['username']; ?>
</strong><br />
            <br />
            Thank you for placing an order on <?php echo $this->_tpl_vars['domain']; ?>
 . <a target="_blank" href="<?php echo $this->_tpl_vars['httpdomain']; ?>
profile.php?action=search_order&amp;itemno=<?php echo $this->_tpl_vars['order']['itemno']; ?>
"><span style="color: #f00">Click Here</span></a> to see your order information.<br />
            Our records indicate that the payment for this order <span style="color: #f00"><strong><?php echo $this->_tpl_vars['order']['itemno']; ?>
</strong></span> is still pending. <br />
            If you have any questions, please feel free to contact us. <br />
            <br />
            Safety Notice: We make every effort to ensure that all of our emails are subject to virus check before delivery, and pursuant to our policy, any &quot;.exe&quot; files or files containing any form of potential risks are not allowed to be sent out. Please do not attempt to open any attachments containing these file extensions without prior confirmation with the sender.</div>
            </td>
        </tr>
    </tbody>
</table>
</div>
</div>