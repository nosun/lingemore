<?php /* Smarty version 2.6.26, created on 2012-10-26 15:08:54
         compiled from module_class.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">

<script language=javascript>

function cshow(id)

{

var obj=document.getElementById(id);

if (obj.style.display=="none")

 {obj.style.display="block";}

else

 {obj.style.display="none";}

}

</script>

<!-- x y  -->

<style>

.c1{ line-height:24px;  background:url(../pic/c1_bg.jpg) 12px center no-repeat; }

.c2{ line-height:24px;}

.c3{ line-height:24px; }

.c4{ padding-left:45px; }

.c5{margin-left:40px; padding-left:55px; line-height:23px;}

a.a1{color:#151515;font-weight:bold; padding-left:25px; display:block;}

a.a1:hover{color:#666;font-weight:bold;padding-left:25px; background:#EEEEEE; text-decoration:none;}



a.a2{color:#151515; padding-left:25px; display:block;}

a.a2:hover{color:#666; padding-left:25px; background:#EEEEEE; text-decoration:none;}



a.a3{color: #151515; padding-left:45px; display:block;}

a.a3:hover{color:#666; padding-left:45px; background:#EEEEEE; text-decoration:none;}



a.a4{color: #666; padding-left:45px; display:block;}

a.a4:hover{color:#666; padding-left:45px; background:#EEEEEE; text-decoration:none;}



a.a5{color: #999; padding-left:55px; display:block;}

a.a5:hover{color:#999; background:#EEEEEE; text-decoration:none;}

</style>



<div class="w220" style="margin-bottom:10px;">

    <div class="w220" style="height:32px; background:url(../pic/cate_top.jpg) no-repeat;"></div>

    <div class="w218 boxborder_gray1">

        <div class="c1"><a class="a1" href="<?php echo $this->_tpl_vars['folder']; ?>
New-Items-s1.html">New Items</a></div>

        <div class="c1"><a class="a1" href="<?php echo $this->_tpl_vars['folder']; ?>
Hot-Items-s2.html">Hot Items</a></div>

        <?php echo $this->_tpl_vars['class_html']; ?>


    </div>

</div>
