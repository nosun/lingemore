<?php /* Smarty version 2.6.26, created on 2014-04-18 15:49:01
         compiled from uio_product_view.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">



<div class="main_ct">



<script language="javascript"  src="../pic/jquery.lightbox-0.5.min.js" type="text/javascript"></script>



<script language="javascript">



function _ajax_quick_addtoshopcart()



{



if( ! checkShopCartStyle() )



	return ;



var pars = ''; 



$('#ajax_result_div').html("<?php echo $this->_tpl_vars['lg']['loading']; ?>
");



var surl = '<?php echo $this->_tpl_vars['folder']; ?>
miniShopcart.php?action=add&alert=1'; 



for(var i=0;i<document.formshopcart.elements.length;i++ )



{



	if( document.formshopcart.elements[i].type.toLowerCase()!="checkbox" )



		pars += document.formshopcart.elements[i].name + "=" + document.formshopcart.elements[i].value + "&";



	else if( document.formshopcart.elements[i].checked )



	{



		pars += document.formshopcart.elements[i].name + "=" + document.formshopcart.elements[i].value + "&";



	}



}



$.ajax({ url: surl,async: true,cache: false,data:pars,type:'post',success: ajax_getResultContent}); 



var p = $("#btn_quick");



var offset = p.offset();



var top2 = offset.top + $("#btn_quick").height() + 1 ;



$("#_divShoppingcart").css("left",offset.left - 213 + "px");



$("#_divShoppingcart").css("top",top2 + "px");



$("#_divShoppingcart").show();



return false;



}







function ajax_getResultContent(xmlhttp)



{



	$('#ajax_result_div').html(xmlhttp);



	//xmlhttp.evalScripts();



	//executeScript(xmlhttp);



	//window.setTimeout( "_close_divShoppingcart()" , 2000 );



}







function _close_divShoppingcart()



{



	$("#_divShoppingcart").hide();



}







function span_style_chekck2(obj,style,indexm,total,pic)



{



	for(index=0;index<total;index++)



	{



		//$("#span_style_" +indexm + "_" + index).attr('class','span_bg');



		$("#span_style_" +indexm + "_" + index).removeClass('span_bg_check2');



	}



	$(obj).addClass('span_bg_check2');



	//obj.style.border="2px #FF6701 solid";



	//obj.style.border="2px #FF6701 solid";



	document.formshopcart["style" + indexm].value = style;



	strs="";



	for(index=0;index<=10;index++)



	{



		var sobj = $FF("formshopcart","style" + index) ;



		if( sobj )



		{



			if(sobj!="")



			{



				strs += "\"" + sobj + "\" " ;



			}



		}



		//else



			//break;



	}



	//$('#img1').src(pic);



	$('#img1').attr('src',pic);



	$('#span_select').html(strs);



}







function span_style_chekck(obj,style,indexm,total)



{



	for(index=0;index<total;index++)



	{



		$("#span_style_" +indexm + "_" + index).attr('class','span_bg');



	}



	$(obj).attr('class','span_bg_check')



	document.formshopcart["style" + indexm].value = style;



	strs="";



	for(index=0;index<=10;index++)



	{



		var sobj = $FF("formshopcart","style" + index) ;



		if( sobj )



		{



			if(sobj!="")



			{



				strs += "\"" + sobj + "\" " ;



			}



		}



		//else



			//break;



	}



	$('#span_select').html(strs);



}







function $FF(form,name)



{



	var objform = document.forms[form] ;



	var arr = document.getElementsByName( name );



	if( arr.length>0 )



	{



		if( arr[0].type=="hidden" )



		{



			return arr[0].value ;



		}



		else if( arr[0].type=="select-one" )



		{



			return arr[0].value ;



		}



		else if( arr[0].type=="checkbox" )



		{



			var arrosj = [] ; 



			for(sindex=0;sindex<arr.length;sindex++)



			{



				if( arr[sindex].checked )



				{



					arrosj.push( arr[sindex].value );



				}



			}



			//return arrosj.join(',');



			return "@";



		}



		else if( arr[0].type=="radio" )



		{



			for(sindex=0;sindex<arr.length;sindex++)



			{



				if( arr[sindex].checked )



				{



					return arr[0].value ;



				}



			}



		}



		else if( arr[0].type=="text" )



		{



			return arr[0].value ;



		}



	}



	else



	{



		return null;



	}



}







function checkShopCartStyle()



{



	var allcheck = false ;



	if( document.getElementById('paddtocart') )



	{



		for(index=0;index<=30;index++)



		{



			if( $('#property'+index) )



			{



				if( $('#property'+index).attr("checked") )



				{



					allcheck = true;



					break;



				}



			}



			else



				break;



		}



		if( !allcheck )



		{



			alert("Please Select " +  document.formshopcart["key0"].value );



			return false;



		}



	}



	for(index=0;index<=10;index++)



	{



		var obj = $FF("formshopcart","style" + index) ;



		if(obj!=null)



		{



			if(obj=="")



			{



				alert("<?php echo $this->_tpl_vars['lg']['please_select']; ?>
 " +  document.formshopcart["key" + index].value );



				return false;



			}



		}



		else



			return true;



	}



}







function changePnum(action)



{



	var pnum=document.getElementById("num").value;



	if(pnum=="" || isNaN(pnum))



	{



		document.getElementById("num").value=1;



		return;



	}



	pnum=parseInt(pnum);



	if(action=="add")



	{



		if(pnum<1)



		{



			document.getElementById("num").value=1;



		}



		else



		{



			pnum++;



			document.getElementById("num").value=pnum;



		}



	}



	else



	{



		if(pnum>=2)



		{



			pnum--;



			document.getElementById("num").value=pnum;



		}



		else if(pnum<1)



		{



			document.getElementById("num").value=1;



		}		



	}



}



function numOnblur(obj)



{



	if(obj.value=="")



	{obj.value=1;}



	else if(isNaN(obj.value))



	{obj.value=1;}



	else



	{



		obj.value=parseInt(obj.value);



		if(obj.value<1)



		{



			obj.value=1;



		}



	}



}



</script>



<div class="w770 boxborder_pink" style="margin-bottom:10px;">

  <div style="padding:8px;">

    <div id="pro_bese_info">



        <div class="pro_bese_info_left">



        	<a title="<?php echo $this->_tpl_vars['p']['name']; ?>
" id="lightbox"  href="<?php echo $this->_tpl_vars['p']['pic1']; ?>
"  ><img  alt="<?php echo $this->_tpl_vars['p']['name']; ?>
" src="<?php echo $this->_tpl_vars['p']['realpic']; ?>
" name="img1"  border="0" id="img1"></a>



            <?php if ($this->_tpl_vars['rs_o'][0] != ""): ?>   



              	<div class="small_img_box">



                	<div class="small_img_box_left"><img style="cursor:pointer;" onmouseout="javascript:gogo=false;bln=false;" onmousemove="javascript:gogo=true;bln=false;"  src="../pic/gundong_left1.jpg" /></div>



                    <div class="small_img_box_main">



                    	<div id=demo style="overflow:hidden;width:300px;">



               			   <table  border="0" cellpadding="0" cellspacing="0">



                              <tr>



                                <td id=demo1 valign="top">



                                <table  border="0" cellspacing="0" cellpadding="0">



                                    <tr>



                                      <td>



                                      <table width="65" border="0"  cellspacing="0" cellpadding="0" style="margin-left:5px; margin-right:5px;">  <tr>



                                          <td class="otherimagelist" width="65" height="74"  align="center" style="padding:12px 5px 5px 5px;"><a href="<?php echo $this->_tpl_vars['p']['pic1']; ?>
" title="<?php echo $this->_tpl_vars['p']['name']; ?>
" rel="lightbox[roadtrip]">



                                  <img alt="<?php echo $this->_tpl_vars['p']['name']; ?>
" src="<?php echo $this->_tpl_vars['p']['smallpic']; ?>
"  />



                                         <input type="hidden" value="<?php echo $this->_tpl_vars['p']['realpic']; ?>
" />



                                         </a></td>



                                        </tr>



                                      </table>



                                      </td>



                                      <?php $_from = $this->_tpl_vars['rs_o'][0]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['otherimage'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['otherimage']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['otherimage']['iteration']++;
?>



                                      <td>



                                      <table width="65" border="0"  cellspacing="0" cellpadding="0" style="margin-left:5px; margin-right:5px;">  <tr>



                                          <td class="otherimagelist" width="65" height="74"  align="center" style="padding:12px 5px 5px 5px;"><a href="<?php echo $this->_tpl_vars['rows']['bigpic']; ?>
" title="<?php echo $this->_tpl_vars['rows']['name']; ?>
"   rel="lightbox[roadtrip]" >



                                  <img alt="<?php echo $this->_tpl_vars['rows']['name']; ?>
" src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
"  />



                                         <input type="hidden" value="<?php echo $this->_tpl_vars['rows']['realpic1']; ?>
" />



                                         </a></td>



                                        </tr>



                                      </table>



                                      </td>



                                      <?php endforeach; endif; unset($_from); ?>



                                    </tr>



                                </table>



                                </td>



                              </tr>



                            </table>



             			</div>



              		</div>



                    <div class="small_img_box_right"><img style="cursor:pointer" onmouseout="javascript:gogo=false;bln=true;" onmousemove="javascript:gogo=true;bln=true;" src="../pic/gundong_right1.jpg" /></div>



                </div>             



              <script language="javascript">



                $(".otherimagelist").hover(



                   function(){



                      $(this).css("background","url(../pic/gundong_picbg.jpg) no-repeat"); 



                   },



                   function(){$(this).css("background",""); }



                );



                var speed=10;



                var gogo= false;



                var bln=true;



                var demo = document.getElementById("demo");



                var demo1 = document.getElementById("demo1");



                //var demo2 = document.getElementById("demo2");



                



                //demo2.innerHTML=demo1.innerHTML



                function Marquee(){



                if(!gogo)



                  return ;



                if(bln)



                {



                    if(demo.offsetWidth-demo.scrollLeft<=0)



                    {



                    



                    //demo.scrollLeft-=demo1.offsetWidth



                    demo.scrollLeft=demo1.offsetWidth



                     }



                     else{



                    demo.scrollLeft++



                    }



                  }



                  else



                  {



                      if(demo.scrollLeft<=0)



                           {



                           demo.scrollLeft=0;//demo1.offsetWidth



                           }



                       else



                       {



                          demo.scrollLeft--;



                       }



                  }



                }



                var MyMar=setInterval(Marquee,speed)



                demo.onmouseover=function() {clearInterval(MyMar)}



                demo.onmouseout=function() {MyMar=setInterval(Marquee,speed)}



              </script>	



            <?php endif; ?> 



        </div>



        <div class="pro_bese_info_right">



             <div class="pro_base_info">



            <ul class="pro_base_info_list">



                <li style="border-bottom:1px dashed #D56E26;"><h1><?php echo $this->_tpl_vars['p']['name']; ?>
 <a rel="nofollow" href="<?php echo $this->_tpl_vars['folder']; ?>
index.php?action=add_favorite&pid=<?php echo $this->_tpl_vars['p']['id']; ?>
"><img src="../pic/file.gif" alt="Add to Favorites" hspace="10" border="0" /></a></h1></li>



                <li>

                <span class="gray" style="text-decoration:line-through;font-weight:bold; font-size:14px; "><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['p']['price2']; ?>
</span> 

                <span style="font-weight:bold; font-size:14px; color:#333; padding-right:10px;"><?php echo $this->_tpl_vars['coin']; ?>
 <?php echo $this->_tpl_vars['p']['price1']; ?>
</span></li>





                <li><?php echo $this->_tpl_vars['lg']['itemno']; ?>
 :  <?php echo $this->_tpl_vars['p']['itemno']; ?>
</li>



                <li><?php echo $this->_tpl_vars['lg']['category']; ?>
 : <a target="_blank" href="<?php echo $this->_tpl_vars['p']['categoryRewrite']; ?>
"><?php echo $this->_tpl_vars['p']['categoryName']; ?>
</a></li>



                <?php if ($this->_tpl_vars['p']['store'] != ""): ?><li>Fabric  : <?php echo $this->_tpl_vars['p']['store']; ?>
</li><?php endif; ?>



                <li style=" overflow:hidden;"><?php $_from = $this->_tpl_vars['p']['pkey2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['rows']):
?><div style="line-height:22px"><?php echo $this->_tpl_vars['p']['pkey2'][$this->_tpl_vars['index']]; ?>
 : <?php echo $this->_tpl_vars['p']['pvalue2'][$this->_tpl_vars['index']]; ?>
</div><?php endforeach; endif; unset($_from); ?></li>



                



                <li><span style="color:#FF3300; "><?php echo $this->_tpl_vars['lg']['pls']; ?>
</span></li>



            </ul>



        </div>



            <div class="clear"></div>



            <form method="post" name="formshopcart" action="<?php echo $this->_tpl_vars['folder']; ?>
shopcart.php?action=add" enctype="application/x-www-form-urlencoded">					  



                <div class="check_order_box">



                    <ul>



                        <?php $_from = $this->_tpl_vars['p']['ckey']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['rows']):
?>



                        <li>



                            <div class="check_order_box_left"><?php echo $this->_tpl_vars['p']['ckey'][$this->_tpl_vars['index']]; ?>
 : <input name="key<?php echo $this->_tpl_vars['index']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['p']['ckey'][$this->_tpl_vars['index']]; ?>
" /></div>



                            <div class="check_order_box_right"><?php echo $this->_tpl_vars['p']['cHTML'][$this->_tpl_vars['index']]; ?>
</div>



                        </li>



                        <?php endforeach; endif; unset($_from); ?>

			<li>
                            <div class="check_order_box_left">Color :</div>
                            <div class="check_order_box_right">As Shown</div>
                        </li>

                        <?php if ($this->_tpl_vars['showAmount']): ?> 



                         <li>



                            <div class="check_order_box_left"><?php echo $this->_tpl_vars['lg']['iselect']; ?>
 : </div>



                            <div class="check_order_box_right red" id="span_select"><?php echo $this->_tpl_vars['lg']['pls1']; ?>
</div>



                        </li>



                        <li>



                            <div class="check_order_box_left"><?php echo $this->_tpl_vars['lg']['quantity']; ?>
 : </div>



                            <div class="check_order_box_right">



                               <div style="height:19px; border:1px #D3D3D1 solid;display:inline;float:left;">



                                <div style="display:inline;float:left;height:19px;"><img style="cursor:pointer;" src="../pic/p_num_mius.jpg" onclick="changePnum('minus');" /></div>



                                <div style="display:inline;float:left;height:19px; padding-right:5px; padding-left:5px; background:#FFF;"><input style="border:0px; padding:0px; height:18px; margin:0; width:28px; line-height:18px;" id="num" name="num" value="1"  maxlength="5" type="text" onblur="numOnblur(this)" /></div>



<div style="display:inline;float:left;height:19px;"><img style="cursor:pointer;" src="../pic/p_num_add.jpg" onclick="changePnum('add');" /></div>



                              </div>



                            </div>



                        </li>



                        <?php endif; ?>



                        <li class="liClear">&nbsp;</li>



                        <li>



                            <div class="check_order_box_left">&nbsp;</div>



                            <div class="check_order_box_right">

                              <a href="javascript:void(0)" onclick="_ajax_quick_addtoshopcart()"><img id="btn_quick" src="../pic/addtocart.gif"  /></a>

                             </div>



                        </li>



                        <li class="liClear">&nbsp;</li>





                        <li>



                            <div class="check_order_box_left">&nbsp;</div>



                            <div class="check_order_box_right">

                            <a href="products.php?classid=<?php echo $this->_tpl_vars['p']['classid']; ?>
"><img src="../pic/continueshopping.gif" border="0"  /></a>

                             <a href="shopcart.php"><img src="../pic/2checkout.gif" border="0"  /></a>

                                <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['pid']; ?>
" />

                             </div>



                        </li>



                    </ul>



                </div>	  



            </form>



            <div class="clear"></div>



            <div class="divShoppingcart" id="_divShoppingcart">



                <div class="divShoppingcart_inner">



                    <div id="ajax_result_div"></div>



                </div>



            </div>



        </div>



    </div>



    <div class="clear"></div>



	<div style=" border-bottom:1px dashed #D56E26; font-size:18px; margin-bottom:8px; height:27px; font-weight:bold;">Product Description:</div>



    <div class="linh" style=" line-height:1.5em; overflow:hidden;"><?php echo $this->_tpl_vars['p']['content']; ?>
</div>



    



    <table align="center" border="0" cellpadding="0" cellspacing="8">



      <tr>



        <td colspan="3" align="center">Product <?php echo $this->_tpl_vars['pindex']; ?>
/<?php echo $this->_tpl_vars['ptotal']; ?>
</td>



      </tr>



      <tr>



        <td><a href="<?php echo $this->_tpl_vars['prev']; ?>
"><img src="../pic/button_prev.gif" border="0" /></a></td>



        <td><a href="<?php echo $this->_tpl_vars['listing']; ?>
"><img src="../pic/button_return_to_product_list.gif" border="0" /></a></td>



        <td><a href="<?php echo $this->_tpl_vars['next']; ?>
"><img src="../pic/button_next.gif" border="0" /></a></td>



      </tr>



    </table>

  

 </div>

</div>

  

    <div class="w772" style="margin-bottom:10px;">

      <div class="boxtop_772">

        <div class="boxtop_772_left">Similar Products</div>

        <div class="boxtop_772_right"></div>

      </div>

      <div class="w770 boxborder1_pink">

    <?php $_from = $this->_tpl_vars['rs_relative']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_relative'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_relative']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_relative']['iteration']++;
?>



       <div class="productdiv1">

         <div class="productdiv1box">

             <div class="productdiv1img">

              <p><a  href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img title="<?php echo $this->_tpl_vars['rows']['name']; ?>
" alt="<?php echo $this->_tpl_vars['rows']['name']; ?>
" lazy_data_src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
"  src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
"  border="0"/></a></p>

             </div>

              <?php if ($this->_tpl_vars['rows']['showicon'] == 1): ?><div class="phot"></div><?php endif; ?>

              <?php if ($this->_tpl_vars['rows']['showicon'] == 2): ?><div class="pnew"></div><?php endif; ?>

              <div class="productdiv1info">

                 <a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a>

                 <span class="gray" style="text-decoration:line-through;"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price2']; ?>
</span> <span class="price"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price']; ?>
</span>

                 <a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img src="../pic/smallcart.jpg" border="0" style="vertical-align:middle;" /></a>

              </div>

          </div>

        </div>



        <?php if ($this->_foreach['rs_relative']['iteration']%5 == 0): ?>



        <div class="clear1"></div>



        <?php endif; ?>

    <?php endforeach; endif; unset($_from); ?>

        <div class="clear1"></div>

    </div>

  </div>

  

  <div class="w770 boxborder_pink">

      <table width="100%" border="0" cellspacing="10" cellpadding="0">

    

        <tr>

    

           <td align="left"><img src="../pic/button_write_review.gif" border="0" /></td>

    

           <td align="right"><a href="<?php echo $this->_tpl_vars['folder']; ?>
share.php?pid=<?php echo $this->_tpl_vars['p']['id']; ?>
"><img src="../pic/button_TellAFriend.gif" border="0" /></a></td>

    

        </tr>

    

      </table>

      

      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module_product_comment.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

      

  </div>

  

  



</div>



<script type="text/javascript">



	$('#lightbox').lightBox();



	//$('#demo a').lightBox();



	



var data=$("#img1").attr("src");



$(document).ready(function(){	



   $('#demo a').click(function(){



      $('#lightbox').attr("href",$(this).attr("href"));



	  $("img[id=img1]").attr("src",$(this).find("input:first").val());



//	  $('.jqzoom').attr("href",$(this).attr("href"));



//	  //$('.jqzoom img:first').attr("src",$(this).find("input:first").val());



//      $(".jqZoomWindow").remove();//关键操作1   



//      $(".jqZoomPup").remove(); //关键操作2   



//      $("img[id=img1]").attr("src",$(this).find("input:first").val());   



//      $("a[id=jqzoom]").unbind(); //关键操作3   



//      $("img[id=img1]").unbind(); //关键操作4   



//  



//      $("a[id=jqzoom]").attr("href",$(this).attr("href")).attr("title","<?php echo $this->_tpl_vars['p']['name']; ?>
").jqzoom();    







	  //$(".jqzoom").jqzoom();



	  //data=$("img[id=img1]").attr("src");



	  return false;



   });



   



});



</script>