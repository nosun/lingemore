<?php /* Smarty version 2.6.26, created on 2013-01-02 15:32:57
         compiled from email_order_haspay_user.html */ ?>
<div style="border-bottom: #9edcf4 1px solid; border-left: #9edcf4 1px solid; padding-bottom: 3px; background-color: #c7ecff; padding-left: 3px; width: 700px; padding-right: 3px; border-top: #9edcf4 1px solid; border-right: #9edcf4 1px solid; padding-top: 3px">
<div style="border-bottom: #88bedc 1px solid; border-left: #88bedc 1px solid; padding-bottom: 3px; background-color: #ffffff; padding-left: 3px; padding-right: 3px; border-top: #88bedc 1px solid; border-right: #88bedc 1px solid; padding-top: 3px">
<table border="0" align="center" width="100%" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td colspan="2">
            <div style="border-bottom: #5ecbef 1px dotted; border-left: #5ecbef 1px dotted; padding-bottom: 4px; background-color: #f3fcff; padding-left: 4px; padding-right: 4px; border-top: #5ecbef 1px dotted; border-right: #5ecbef 1px dotted; padding-top: 4px">Dear <strong><?php echo $this->_tpl_vars['order']['username']; ?>
</strong><br />
            We have received your payment for <span style="color: #f00"><strong><?php echo $this->_tpl_vars['order']['itemno']; ?>
</strong></span>, and we'll delivery the goods&nbsp;ASAP! <br />
            If your want to see your order information , please <a target="_blank" href="<?php echo $this->_tpl_vars['httpdomain']; ?>
profile.php?action=search_order&amp;itemno=<?php echo $this->_tpl_vars['order']['itemno']; ?>
"><span style="color: #f00">Click Here</span></a> .<br />
            If you have any questions, please feel free to <a target="_blank" href="<?php echo $this->_tpl_vars['httpdomain']; ?>
feedback.php"><span style="color: #f00">Contact Us</span></a> . <br />
            <br />
            Safety Notice: We make every effort to ensure that all of our emails are subject to virus check before delivery, and pursuant to our policy, any &quot;.exe&quot; files or files containing any form of potential risks are not allowed to be sent out. Please do not attempt to open any attachments containing these file extensions without prior confirmation with the sender.</div>
            </td>
        </tr>
    </tbody>
</table>
</div>
</div>