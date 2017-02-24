<?php /* Smarty version 2.6.26, created on 2012-06-07 09:45:45
         compiled from uio_products2.html */ ?>
<link type="text/css" href="../pic/style.css" rel="stylesheet">
<script src="../pic/prototype.js" type="text/javascript"></script>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function getLastChild(obj)
{
	var c = obj.getElementsByTagName("UL") ;
	return c[0];
}

function _ajax_quick_addtoshopcart(obj,index)
{
//if( ! checkShopCartStyle() )
	//return false
var pars = ''; 
$('ajax_result_div').innerHTML = "loading...";
var url = '<?php echo $this->_tpl_vars['folder']; ?>
miniShopcart.php?action=add'; 
var form = document.forms["formshopcart" + index] ;
for(var i=0;i<form.elements.length;i++ )
{
	if( form.elements[i].type.toLowerCase()!="checkbox" )
		pars += form.elements[i].name + "=" + form.elements[i].value + "&";
	else if( form.elements[i].checked )
	{
		pars += form.elements[i].name + "=" + form.elements[i].value + "&";
	}
}
var myAjax = new Ajax.Request( url, { method: 'post', parameters: pars, onComplete:ajax_getResultContent} ); 
var p = Position.cumulativeOffset(obj) ;
$("_divShoppingcart").style.left = p[0] + 'px';
$("_divShoppingcart").style.top = p[1] + obj.offsetHeight + 2 + 'px';
$("_divShoppingcart").style.display='block';
}

function ajax_getResultContent(xmlhttp)
{
	$('ajax_result_div').innerHTML=xmlhttp.responseText;
	xmlhttp.responseText.evalScripts();
	window.setTimeout( "_close_divShoppingcart()" , 2000 );
}
function checkShopCartStyle()
{
	for(index=0;index<=10;index++)
	{
		var obj = document.formshopcart["style" + index] ;
		if(obj!=null)
		{
			if(obj.value=="")
			{
				alert("Please Select " +  document.formshopcart["key" + index].value );
				return false;
			}
		}
		else
			return true;
	}
}

function _close_divShoppingcart()
{
	$("_divShoppingcart").style.display="none";
}

//-->
</script>
<style>
.list{
   
} 
.menushow{ display:none;
position:absolute;
z-index:100;
background-color:#F5F4EC;
border:2px #E5DDC7 solid;
left:2px;
top:29px;
width:200px;
margin:0px;
text-align:left;
padding:0px;
}
.menuhide{ display:none;
position:absolute;
left:2px;
top:28px;
width:200px;
padding:0px;
text-align:left;
}
.styleli{ list-style-type:none;
width:120px;
position:relative;
padding:0px;
}
</style>
<div class="main_ct">
<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;">
  <tr>
    <td width="431"><a class="list_on" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['list']; ?>
"></a> <a class="grid" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['grid']; ?>
"></a> <a class="gallery" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite']['gallery']; ?>
"></a></td>
    <td width="176" >    
    <?php $_from = $this->_tpl_vars['mode']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mode'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mode']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['mode']['iteration']++;
?>
    <a class="mode <?php if ($this->_tpl_vars['key1'] == $this->_tpl_vars['numindex']): ?>mode_now<?php endif; ?>" rel="nofollow" href="<?php echo $this->_tpl_vars['rewrite'][$this->_tpl_vars['rows']]; ?>
"><?php echo $this->_tpl_vars['rows']; ?>
</a>
    <?php endforeach; endif; unset($_from); ?>
    </td>
    <td width="74">Order By 
      </td>
    <td width="323">
    <select  id="orderitem" name="orderitem"   onchange="MM_jumpMenu('parent',this,0)">
	<option value="<?php echo $this->_tpl_vars['rewrite']['orderid']; ?>
">Product ID</option>
	<option value="<?php echo $this->_tpl_vars['rewrite']['ordername']; ?>
">Product Name</option>
	<option value="<?php echo $this->_tpl_vars['rewrite']['orderprice']; ?>
">Product Price</option>
	<option value="<?php echo $this->_tpl_vars['rewrite']['ordertime']; ?>
">Product Addtime</option>
	<option value="<?php echo $this->_tpl_vars['rewrite']['orderview']; ?>
">Product Views</option>
      </select>
      <select id="orderby" name="orderby"  onchange="MM_jumpMenu('parent',this,0)">
	  <option value="<?php echo $this->_tpl_vars['rewrite']['bydesc']; ?>
">Descendingly</option>
	   <option value="<?php echo $this->_tpl_vars['rewrite']['byasc']; ?>
">Ascendingly</option>
	  
      </select>
	  <script language="javascript">
	  EnterSelectIndex("orderitem",<?php echo $this->_tpl_vars['orderindex']; ?>
);
	  EnterSelectIndex("orderby",<?php echo $this->_tpl_vars['orderbyindex']; ?>
);
	  //document.getElementById("imgNum" + <?php echo $this->_tpl_vars['numindex']; ?>
).src="../pic/ps_<?php echo $this->_tpl_vars['pagesize']; ?>
_i.gif";
	  </script>
	  </td>
  </tr>
</table>


<?php $_from = $this->_tpl_vars['rs_p']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_p'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_p']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['rows']):
        $this->_foreach['rs_p']['iteration']++;
?>
<div class="productdiv2">
<table width="100%" border="0"  cellspacing="10" cellpadding="0" style="border-bottom:1px #999999 dotted">

  <tr>
    <td width="140" height="125"  align="center" valign="middle" style="border:1px #E7E7E7 solid;"><a href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img width="164" height="220" src="<?php echo $this->_tpl_vars['rows']['realpic']; ?>
" border="0"/></a></td>
    <td  align="left" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="0">
      <tr>
        <td><a class="weight" href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><?php echo $this->_tpl_vars['rows']['name']; ?>
</a></td>
      </tr>
       <tr>
        <td><span class="red weight"><?php echo $this->_tpl_vars['coin']; ?>
<?php echo $this->_tpl_vars['rows']['price']; ?>
</span></td>
      </tr>
      <tr>
        <td><span>Itemno :  <?php echo $this->_tpl_vars['rows']['itemno']; ?>
</span></td>
      </tr> <tr>
        <td><?php echo $this->_tpl_vars['rows']['s_content']; ?>
</td>
      </tr>
      <tr>
        <td align="right">
		<a  href="<?php echo $this->_tpl_vars['rows']['rewrite']; ?>
"><img src="../pic/big_addto.jpg" width="117" height="24" style="margin-top:5px" /></a>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
<?php endforeach; endif; unset($_from); ?>
 <div style=" position:absolute; display:none; z-index:500; background-color:#FFFFFF" id="_divShoppingcart">
  <table width="350"  border="0" cellpadding="5" cellspacing="0" style="border:1px #BADBF2 solid" >
    <tr>
      <td bgcolor="#EDF7FD" style="border-bottom:1px dotted #CCCCCC"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="../pic/right.jpg" width="16" height="16" hspace="5" align="absmiddle" />Add Success </td>
    <td width="30" align="center"><a href="javascript:void(0)" onclick="_close_divShoppingcart()"><strong>X</strong></a></td>
  </tr>
</table>
 </td>
    </tr>
    <tr>
      <td align="center" id="ajax_result_div"> </td>
    </tr>
	<tr>
      <td align="center"><input type="button" onclick="location.href='<?php echo $this->_tpl_vars['folder']; ?>
shopcart.html'" name="Submit2" value="Shopping Cart" />
        &nbsp;&nbsp; &nbsp;<input onclick="_close_divShoppingcart()" type="button" value="Continue" /></td>
    </tr>
  </table> 
  </div>
</div>