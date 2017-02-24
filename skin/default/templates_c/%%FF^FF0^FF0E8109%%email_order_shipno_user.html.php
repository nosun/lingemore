<?php /* Smarty version 2.6.26, created on 2013-03-19 17:11:33
         compiled from email_order_shipno_user.html */ ?>
<div style="border-bottom: #9edcf4 1px solid; border-left: #9edcf4 1px solid; padding-bottom: 3px; background-color: #c7ecff; padding-left: 3px; width: 700px; padding-right: 3px; border-top: #9edcf4 1px solid; border-right: #9edcf4 1px solid; padding-top: 3px">
<div style="border-bottom: #88bedc 1px solid; border-left: #88bedc 1px solid; padding-bottom: 3px; background-color: #ffffff; padding-left: 3px; padding-right: 3px; border-top: #88bedc 1px solid; border-right: #88bedc 1px solid; padding-top: 3px">
<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tbody>
        <tr>
            <td colspan="2">
            <div style="border-bottom: #5ecbef 1px dotted; border-left: #5ecbef 1px dotted; padding-bottom: 4px; background-color: #f3fcff; padding-left: 4px; padding-right: 4px; border-top: #5ecbef 1px dotted; border-right: #5ecbef 1px dotted; padding-top: 4px">Dear <strong><?php echo $this->_tpl_vars['order']['username']; ?>
</strong><br />
            <br />
            We have sent out your order on <?php echo $this->_tpl_vars['domain']; ?>
!<br />
            <br />
            Tracking number:&nbsp;<span style="color: rgb(255, 0, 0);"><strong><?php echo $this->_tpl_vars['order']['shipno']; ?>
<br />
            </strong></span><br />
            Order number:&nbsp;<span style="color: rgb(255, 0, 0); font-weight: bold;"><?php echo $this->_tpl_vars['order']['itemno']; ?>
</span>.<br />
            Order information:&nbsp;<a target="_blank" href="<?php echo $this->_tpl_vars['httpdomain']; ?>
profile.php?action=search_order&amp;itemno=<?php echo $this->_tpl_vars['order']['itemno']; ?>
"><span style="color: rgb(255, 0, 0); font-weight: bold;">Click Here</span></a>.&nbsp;<br />
            <br />
            If you have any questions, please contact us by&nbsp;<span style="color: rgb(255, 0, 0);"><strong><a href="mailto:mingdatrade@gmail.com">mingdatrade@gmail.com</a></strong></span>&nbsp;or our online agent. Please tell us your order number for inquiry. <br />
            <br />
            Best Wishes,<br />
            Thanks!</div>
            </td>
        </tr>
    </tbody>
</table>
</div>
</div>