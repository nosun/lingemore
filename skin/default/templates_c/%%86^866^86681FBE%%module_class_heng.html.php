<?php /* Smarty version 2.6.26, created on 2011-11-10 11:43:50
         compiled from module_class_heng.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<style>
.aul {margin:0px;padding:0px;width:186px; position:relative; z-index:10;}
.aliul1 {margin:0px;padding:0px;position:absolute;left:188px; display:none; top:-1px;width:188px; border:1px #CCCCCC solid; border-bottom:0px;}
.aliul2 {margin:0px;padding:0px;position:absolute;left:188px; display:none; top:-1px;width:188px; border:1px #CCCCCC solid; border-bottom:0px}
.aliul3 {margin:0px;padding:0px;position:absolute;left:188px; display:none; top:2px;width:188px; border:1px #CCCCCC solid;}
.aliul4 {margin:0px;padding:0px;position:absolute;left:188px; display:none; top:2px;width:188px; border:1px #CCCCCC solid;}

.aulli { list-style-type:none; margin:0px;float:left;width:188px; background:url(../pic/c1_bg.jpg) no-repeat center left; }
.aulli1 {list-style-type:none; ;margin:0px;float:left; position:relative; width:188px;background-image:url(../pic/c1_bg.jpg); }
.aulli2 {list-style-type:none; ;margin:0px;float:left;position:relative;border-bottom:1px #D6D6D6 solid;background:#FAFAFA;width:188px; }
.aulli3 {list-style-type:none; ;margin:0px;float:left;position:relative;border-bottom:1px #D6D6D6 solid;background:#FAFAFA;width:188px; }
.aulli4 { list-style-type:none;padding-left:20px;margin:0px;float:left;position:relative; border-top:1px #ffffff solid;border-bottom:1px #dddddd solid;background:#eeeeee;width:178px; }

a.a1{color: #686868;font-weight:bold; padding-left:15px; display:block; height:24px; padding-top:2px;  }
a.a1:hover{color:#686868;font-weight:bold;padding-left:15px;display:block; height:24px;padding-top:2px;  }

a.a2{color:#686868;padding-left:15px;display:block; height:23px;padding-top:2px;  }
a.a2:hover{color: #686868;padding-left:15px;display:block; height:23px;padding-top:2px;  }

a.a3{color:#686868;margin-left:15px;display:block; height:23px;padding-top:2px;  }
a.a3:hover{color:#686868;margin-left:15px;display:block; height:23px; padding-top:2px; }

a.a4{color: #cccccc;}
a.a4:hover{color:#cccccc;}

a.a5{color: #cccccc;}
a.a5:hover{color:#cccccc;}

a.cate_bold{ font-weight:bold}
a.cate_through{ text-decoration:line-through}
a.cate_italic{ font-style:italic}
a.cate_red{ color:#FE1011}
a.cate_orange{ color:#FC7001}
a.cate_green{ color:green;}
a.cate_yellow{ color:yellow;}
a.cate_blue{color:blue;}
a.cate_gray{ color:gray;}
a.cate_black{color:black;}
a.cate_brown{ color:brown;}
a.cate_purple{ color:purple;}

.class_box{
	width:190px;
}
.class_box_title{
	width:190px; height:25px; line-height:25px;
	font-weight:bold; color:#fff; text-align:center;
	background:url(../pic/cate_top.jpg) no-repeat;
}
.class_box_main{
	width:188px;
	border-left:1px #D6D6D6 solid;border-right:1px #D6D6D6 solid;
}
.clear2{
	width:100%; height:1px; overflow:hidden; clear:both; font-size:1px;
}
</style>
<div class="class_box">
	<div class="class_box_title"><?php echo $this->_tpl_vars['lg']['cate_top_title']; ?>
</div>
    <div class="class_box_main">
        <ul id='nav_class_heng' class='aul'>
       	 <?php echo $this->_tpl_vars['class_html']; ?>

        </ul>
        <div class="clear2"></div>
        <script language=javascript>
function cshow(id)
{
var obj=document.getElementById(id);
if (obj.style.display=="none")
 {obj.style.display="";}
else
 {obj.style.display="none";}
}
function startlist(root)
{  
	//alert(root.getElementsByTagName("li"));
  var objSon = new Array();
  var objSon = root.getElementsByTagName("li") ;
  for(var i=0;i<=objSon.length-1;i++)
    {
          if(objSon[i].lastChild.nodeName.toLowerCase()=="ul")
	        { 
			  objSon[i].onmouseover=function(){  this.lastChild.style.display='block';}
	          objSon[i].onmouseout=function(){  this.lastChild.style.display='none'; }
			  startlist(objSon[i].lastChild);
			}
	}
}
</script>

        <script language="javascript">
        startlist(document.getElementById("nav_class_heng"));
    </script>
	</div>
</div>
<div class="clear"></div>