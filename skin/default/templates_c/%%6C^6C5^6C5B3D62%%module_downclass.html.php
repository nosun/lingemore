<?php /* Smarty version 2.6.26, created on 2011-09-29 09:29:41
         compiled from module_downclass.html */ ?>
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
<style>
.c1{ line-height:23px; padding-left:10px; font-weight:bold ; height:23px; background:url(../pic/cata_bg.gif) no-repeat center left; border-bottom:1px #D0D0D0 dotted }
.c2{ padding-left:20px; line-height:23px;font-weight:bold}
.c3{ padding-left:30px; line-height:23px;font-weight:bold}
.c4{ padding-left:40px; line-height:23px;font-weight:bold}
.c5{ padding-left:50px; line-height:23px;font-weight:bold}
a.a1{color: #4E5255;}
a.a1:hover{color:#4E5255;}

a.a2{color:#4E5255;}
a.a2:hover{color: #4E5255;}

a.a3{color: #4E5255;}
a.a3:hover{color:#4E5255;}

a.a4{color: #4E5255;}
a.a4:hover{color:#4E5255;}

a.a5:link{color: #000000;}
a.a5:visited{color:#000000;}
a.a5:hover{color:#CC0000;}
a.a5:active{color:#000000;}

.class_box{
	width:190px; overflow:hidden;
}
.class_box_title{
	width:190px; height:25px; line-height:25px;
	font-weight:bold; color:#fff; text-align:center;
	background:url(../pic/cate_top.jpg) no-repeat;
}
.class_box_main{
	width:188px; overflow:hidden;
	border-left:1px #D6D6D6 solid;border-right:1px #D6D6D6 solid;
}
</style>
<div class="class_box">
	<div class="class_box_title">Categories</div>
    <div class="class_box_main">
        <?php echo $this->_tpl_vars['dclass_html']; ?>

	</div>
</div>
<div class="clear"></div>