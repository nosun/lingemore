<?php /* Smarty version 2.6.26, created on 2012-04-30 22:53:44
         compiled from email_feedback_reply.html */ ?>
<style type="text/css">
*{color: #000000; margin:0px; font-family:   Arial,Tahoma, Helvetica, sans-serif; font-size:12px;}</style>
<div style="border:1px #9EDCF4 solid; background-color:#C7ECFF; padding:3px; width:700px"><div style="border:1px #FA92CC solid; background-color:#ffffff; border:1px #88BEDC solid; padding:3px"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="2"><div style="border:1px #5ECBEF dotted; background-color:#F3FCFF; padding:4px;  ">Dear  
        <strong><?php echo $this->_tpl_vars['message']['username']; ?>
</strong> , You have a new message from Customer Service of <?php echo $this->_tpl_vars['domain']; ?>
<br />
          <br />
<table width="100%" border="0" cellspacing="1" cellpadding="2" style=" background-color:#CCCCCC">
  <tr>
    <td width="97" align="right" bgcolor="#FFFFFF">Title:</td>
    <td width="566" bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['message']['name']; ?>
</td>
  </tr>
 
   <tr>
     <td width="97" align="right" valign="top" bgcolor="#FFFFFF">Content:</td>
     <td bgcolor="#FFFFFF"><?php echo $this->_tpl_vars['message']['content']; ?>
</td>
   </tr>
    <tr>
            <td bgcolor="#ffffff" width="100" align="right">Admin Reply:</td>
            <td bgcolor="#ffffff"><?php echo $this->_tpl_vars['message']['reply']; ?>
</td>
        </tr>
</table>
    </div></td>
  </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="405"  style="padding-left:10px"><div style="line-height:18px">Best regards , <br>
Add : Street 250 Xia He Road Xiamen Fujian China<br>
Zip : 363600<br>
Tel : +86 159888888888<br>
Fax : +86 0592-5950000<br>
MSN : wholesale-test@test.com<br>
E-mail : wholesale-test@test.com<br>
Website : <?php echo $this->_tpl_vars['domain']; ?>
</div></td>
<td width="279"  align="center" valign="middle"><img src="<?php echo $this->_tpl_vars['httpdomain']; ?>
systemImage/email_bom_bg.jpg" /></td>
</tr>
</table></div></div>