<?php /* Smarty version 2.6.26, created on 2015-04-23 14:56:34
         compiled from module_head.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->_tpl_vars['cnlogin_script']; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="robots" content="all" />
<?php if ($this->_tpl_vars['keywords'] != ""): ?><meta name="keywords" content="<?php echo $this->_tpl_vars['keywords']; ?>
" /><?php endif; ?>
<?php if ($this->_tpl_vars['descript'] != ""): ?><meta name="description" content="<?php echo $this->_tpl_vars['descript']; ?>
" /><?php endif; ?>
<link href="../pic/style.css" type="text/css"  rel="stylesheet" />
<meta name="google-site-verification" content="ebREanKIBvD0amfiSSEhBt_L43VhXu3GbIJZTxSMxbQ" />
<link rel="shortcut icon" href="<?php echo $this->_tpl_vars['folder']; ?>
favicon.ico"/>
<link rel="stylesheet" href="../pic/jquery.lightbox-0.5.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../pic/jquery.autocomplete.css" type="text/css" media="screen" />
<?php $_from = $this->_tpl_vars['statscript']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['statscript'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['statscript']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rows']):
        $this->_foreach['statscript']['iteration']++;
?> 
<script language="javascript" type="text/javascript" src="<?php echo $this->_tpl_vars['rows']; ?>
"></script>
<?php endforeach; endif; unset($_from); ?>
<script language="javascript">
var openapi = "<?php echo $this->_tpl_vars['config'][64]; ?>
";
</script>
<script language="javascript" type="text/javascript" src="../pic/codetocountry.js"></script>
<script language="javascript" type="text/javascript" src="../pic/fun_normal2.js"></script>
<script language="javascript" type="text/javascript" src="../pic/jquery.min.js"></script>
<script type="text/javascript">
//$(document).ready(function (){$("input[type='submit']").addClass("inputSubmit");});
//$(document).ready(function (){$("input[type='button']").addClass("inputButton");});
</script>

<?php if ($this->_tpl_vars['config'][48] != ""): ?>
<script type="text/javascript">

function clickIE4(){
        if (event.button==2){
                return false;
        }//end if
}//end func
 
function clickNS4(e){
        if (document.layers||document.getElementById&&!document.all){
                if (e.which==2||e.which==3){
                        return false;
                }//end if
        }//end if
}//end func
 
function OnDeny(){
        if(event.ctrlKey || event.keyCode==78 && event.ctrlKey || event.altKey || event.altKey && event.keyCode==115){
                return false;
        }//end if
}
 
if (document.layers){
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown=clickNS4;
        document.onkeydown=OnDeny();
}else if (document.all&&!document.getElementById){
        document.onmousedown=clickIE4;
        document.onkeydown=OnDeny();
}//end if
 
document.oncontextmenu=new Function("return false");
</script>
<?php endif; ?>
</head>
<body  <?php if ($this->_tpl_vars['config'][49] != ""): ?> ondragstart="return false" onselectstart="return false" onselect="document.selection.empty()" oncopy="document.selection.empty()" onbeforecopy="return false" <?php endif; ?>  >
<noscript><style type="text/css">body{display:none;}</style></script></noscript>
<div style="height:0px; overflow:hidden; width:1px; font-size:1px; line-height:1px; background:url(../pic/country_all.gif)"></div>