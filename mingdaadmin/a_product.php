<? require("php_admin_include.php");?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>商品管理</title>

<style type="text/css">

<!--

.STYLE1 {

	color: #FF0000;

	font-weight: bold;

	font-size:24px

}

-->



.countryspan{ display:inline; width:173px; float:left; height:23px; margin-bottom:1px;  margin-right:1px; overflow:hidden; border:1px #FFFFFF dotted}

.oncheck{ border:1px #FEDF63 dotted; background-color:#FFFFE6}

.clear{ clear:both; font-size:0px; line-height:1px; height:1px}

</style>

</head>



<body>

<?php require("php_top.php");?>

<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >

<tr >

    <td  >

<div class="bodytitle">

	<div class="bodytitleleft"></div>

	<div class="bodytitletxt">商品管理</div>

</div>

</td></tr></table>

<br />

<script language="javascript">

function freshProduct(id)

{

	includeJsFile("script_fresh","../service/serviceForfreshproduct.php?id="+id)

}





function changePrice1(obj)

{

	var obj2 = document.getElementById("pifaprice0");

	if(obj2)

	{

		obj2.value = obj.value;

	}

}



function changeLastPrice()

{

	var obj2 = document.getElementById("lastprice");

	for(index=0;index<=20;index++)

	{

		var objprice = document.getElementById("pifaprice"+index)

		if( objprice && objprice.value!="" )

			obj2.value = objprice.value;

	}

	

}



function changeNextValue(id,obj)

{

	var obj2 = document.getElementById("pnumpre"+id);

	if(obj2)

	{

		obj2.value = obj.value;

	}

	var objdiv = document.getElementById("pifadiv"+id);

	if(objdiv)

	{

		objdiv.style.display="block";

		

	}

}

 var ff="ie";



function DefineRequest()

{	

	//开始初始化XMLHttpRequest对象

	var xmlRequest;



    try{

     if(window.ActiveXObject)

     {

      var MSXML = new Array('MSXML2.XMLHTTP','Microsoft.XMLHTTP','MSXML2.XMLHTTP.3.0','MSXML2.XMLHTTP.4.0','MSXML2.XMLHTTP.5.0');

      for(var i=0;i<MSXML.length;i++)

      {

       try

       {  

        xmlRequest = new ActiveXObject(MSXML[i]);

        break;

       }

       catch(e)

       {

        xmlRequest = null;

       } 

      }

     }

     else if(window.XMLHttpRequest)

     {ff="ff";

      xmlRequest = new XMLHttpRequest();

      if(xmlRequest.overrideMimeType)

      {

       xmlRequest.overrideMimeType('text/xml');

      }

     } 

        if(xmlRequest == null)

        { // 异常，创建对象实例失败

        window.alert("不能创建XMLHttpRequest对象实例.");

        return false;

        }

    }

    catch(e){}

    return xmlRequest;

}



var xmlhttp=DefineRequest();



function CheckAll(formdel,str)

{

  for (var i=0;i<document.forms[formdel].elements.length;i++)

  {

    var e = document.forms[formdel].elements[i];

    if (str=="ON")

	   e.checked = true;

	else

		e.checked= false; 

  }

}

function fetch_Property_Div(id,type)

{

	var obj=document.getElementById(id);

	if(obj.value!=0)

	{

			xmlhttp.open("POST","../service/serviceForgetProperty.php?classid="+ obj.value + "&type=" + type,true);

	        xmlhttp.onreadystatechange=function(){sth_getProperty()};

            xmlhttp.send(null);

	}

}



function sth_getProperty()

{

 if(xmlhttp.readyState==4)

		   if(xmlhttp.status==200)

		      {   

	              document.getElementById("propertyDiv").innerHTML=xmlhttp.responseText;

		       }

}

function asCallJsSubmitFormData(str)

{

	//alert(str);

	document.getElementById("pic").value=str;

	document.getElementById("formadd").submit();

}





function changeImage(path)

{

	document.getElementById("imgupload").src=path;

}



function removeproducttrresult(id)

{

	$('#producttr'+id).remove();

}



function removeproduct(id)

{

	includeJsFile("script_fresh","../service/serviceForcircle.php?id="+id) ;

}



function getRemoteData(classid,classname)

{

	$.get("../service/serviceForgetTag.php", {action:"get",classid:classid}, function (data){

$('#tagdiv').html(data);

});

}



function changeDisp(id,disp)

{

	if($("#"+id+"_disp_"+disp).attr("src")=="images/disp_uncheck.jpg")

	   $("#"+id+"_disp_"+disp).attr("src","images/disp_check.jpg");

	else

	   $("#"+id+"_disp_"+disp).attr("src","images/disp_uncheck.jpg");

	var sumdisp=0;

	$("."+id+"_disp").each(function(index){

	    if($(this).attr("src")=="images/disp_check.jpg")

		{

			sumdisp+=Math.pow(2,index);

		}

	});

	//alert(sumdisp);

	$.ajax({

	   type: "GET",

	   url: "../service/serviceForDisp.php",

	   data: "table=@@@product&disp="+sumdisp+"&id="+id,

	   success: function(msg){

		 //alert( "Data Saved: " + msg );

	   }

	}); 

}

</script>



<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >

  <tr  bgcolor="#F2F4F6">

    <td    ><a href="a_product.php">商品列表</a><span class="fontpadding"><a href="a_circle.php">仓库列表</a></span> <span class="fontpadding add">[ <a href="?action=add">添加单个商品</a> | <a  href="?action=p_add">批量添加商品</a>  ]</span></td>

  </tr>

</table><br />

<?php

isAuthorize($group[2]);

$action=getQuery("action");

$u1=new unlimClass("@@@productclass");

$proot=$u1->create("产品分类");

$u2=new unlimClass("@@@brandclass");

$broot=$u2->create("品牌分类");

switch($action)

{

case "add":

	addItem();

	break;

case "editstate":

	editstate();

	break;

case "editstate_save":

	editstate_save();

	break;

case "p_add":

	p_add();

	break;

case "p_add_save":

	p_add_save();

	break;

case "edit":

	editItem();

	break;

case "p_edit_save":

	p_edit_save();

	break;

case "add_save":

	add_save();

	break;

case "p_add_ftp":

	p_add_ftp();

	break;

case "delete_save":

	delete_save();

	break;

case "edit_save":

	edit_save();

	break;

case "p_handl":

	if( getRequest("do")=="deletepage" )

	{

		p_delete_save(0);

	}

	elseif ( getRequest("do")=="deleteall" )

	{

		p_delete_save(1);

	}

	elseif ( getRequest("do")=="editall" )

	{

		p_editItem(1);

	}

	elseif ( getRequest("do")=="editpage" )

	{

		p_editItem(0);

	}

	else

		showItem();

	break;

default:

	showItem();

	break;

}

?>



<?

function showItem()

{

global $cfg;

global $proot;

global $broot;

global $config;

$condition="where state>0" ;

$pageurl="1=1" ;

$class=fetchAllClass("@@@productclass");

$classid=getRequestInt("classid",$proot);



if($classid!=$proot)

{

	//$tree=fetchValue("select tree as v from @@@productclass where id=$classid",0);

	$tree=get_id_tree($class,$classid);

	$condition .=  " and classid in (" . $tree . ")" ;

	$pageurl .= "&classid=" . $classid ;

}



if(getRequest("name")!="")

{

	$condition .=  " and (name like '%" . filterSQL(getRequest("name")) . "%' or itemno='" . filterSQL(getRequest("name")) . "')" ;

	$pageurl .= "&name=" . getRequest("name") ;

}



if(getRequest("disp")!="")

{

	$condition .=  " and disp & " . getRequest("disp") . " = " . getRequest("disp") ;

	$pageurl .= "&disp=" . getRequest("disp") ;

}





if( count(getRequest("disp")) != 0 && is_array(getRequest("disp")))

{

	$condition.= " and (disp & " . strtoint( getRequest("disp") ) . ")<>0" ;

	$pageurl.= "&disp=" . join( ',' , (array)getRequest("disp") ) ;

}



$pageurl.= "&orderfield=" . getRequest("orderfield") ;

$pageurl.= "&order=" . getRequest("order") ;





$orderby=" order by " . getRequestDefault("orderfield","id") . " " . getRequestDefault("order","desc");



$pagenow=getQueryInt("page");

$pagesize=getRequestDefault("size",20);

$pageurl.= "&size=" . getRequest("size") ;

$rs=createPage("*","@@@product",$condition,$orderby,$pagesize,$pagenow,$pagetotal,$recordcount);

?> 

<form name="form2" method="get" action="a_product.php">

<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">

  <tr>

    <td bgcolor="#F2F4F6" class="a_title"><strong>商品搜索条件</strong></td>

  </tr>

  <tr bgcolor="#FFFFFF">

   

      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="68" align="left" style=" padding:0px; margin:0px;letter-spacing:1px;">选中分类：

	    <input id="classname" style="display:none;" type="text" readonly="" value="<?=fetchValue("select name as v from @@@productclass where id=$classid","分类已被删除")?>" />

      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>

    <td style=" padding:0px; margin:0px;letter-spacing:1px;"><? classRelation($classid,8,"@@@productclass"); ?></td>

    </tr>

</table>      </td>

    </tr> 

	<tr bgcolor="#FFFFFF">

    <td  >

	  产品搜索：

      <input name="name" type="text" id="keyword" value="<?=getRequest("name")?>" size="40">

		 <span class="fontpadding hide">品牌搜索：

        <select name="brandid" id="brandid">

		<option value="">请选择品牌</option>

		<?

		$sql="select id as v,name as k from @@@brandclass where level=1";

		writeSelect($sql);

		?>

        </select>

        <script > EnterSelect("brandid","<?=getRequest("brandid")?>"); </script>

		</span>

        

        <span class="fontpadding">显示类型：

        <select name="disp" id="disp">

		<option value="">请选择类型</option>        

		<?

        $sql = "select * from @@@productdisp order by value asc";

        $d_rs = query($sql);

        while($d_rows=fetch($d_rs))

        {

        ?>    

	     <option value="<?=$d_rows["value"]?>"><?=$d_rows["name"]?> </option>

        <?

        }

        ?>        

    </select>

    <script > EnterSelect("disp","<?=getRequest("disp")?>"); </script>

    </span>

	

	<input type="submit" name="Submit4" value="提交"  class="button" >	</td>

  </tr>

	<tr bgcolor="#FFFFFF">

	  <td  >每页显示： 

        <select id="size" name="size"><option value="">20个</option><option value="40">40个</option><option value="50">50个</option><option value="60">60个</option></select><script > EnterSelect("size","<?=getRequest("size")?>"); </script><span class="fontpadding">排序： 

      <select id="orderfield" name="orderfield">

	<option value="">添加时间</option>

	<option value="addtime">修改时间</option>

	<option value="hits">访问量</option>

	<option value="sort">排序</option>

	</select> 

	<script > EnterSelect("orderfield","<?=getRequest("orderfield")?>"); </script></span>

        <select name="order" id="order">

		<option value="">降序</option>

		<option value="asc">升序</option>

        </select>

		<script > EnterSelect("order","<?=getRequest("order")?>"); </script></td>

    </tr>

</table>

</form>

<br>

<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">

  <tr>

    <td colspan="10" bgcolor="#F2F4F6"><strong>商品列表</strong><span class="fontpadding2">带 <img src="images/qianbi.gif"  align="absmiddle"> 的列可<span class="red weight">"直接点击格子修改"</span></span></td>

  </tr>

  <tr align="center" bgcolor="#FFFFE9">

  <td width="5%" align="center" >选择</td>

    <td width="8%"  align="center"  >商品图片</td>

    <td width="21%"  align="center" >名称<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>

    <td width="12%"  align="center"  >分类</td>

    <td width="8%"  align="center"  >价格(<?=getCoinChar($config,0)?>)<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>

    <td width="10%" align="center"  >重量(KG)<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>

    <td width="5%" align="center"  >点击量</td>

    <td width="5%" align="center"  >排序<img src="images/qianbi.gif"  hspace="4" align="absmiddle"></td>

    <td width="14%"  align="center"  >便捷推荐</td>

    <td width="9%"  align="center"  >操作</td>

  </tr>



<form name="formdel" method="post" action="?action=p_handl">

<?

$dsql = "select * from @@@productdisp";

$drs = query($dsql);

while($rows=fetch($drs))

{

	$disp_rows[] = $rows ;

}



$class=fetchAllClass("@@@productclass");

emptyList($rs,8);

while($rows=fetch($rs))

{

?>

  <tr id="producttr<?=$rows["id"]?>" align="center"  bgcolor="#FFFFFF" >

   <td align="center"   class="a_fen">

      <input name="cbid[]" type="checkbox" id="id" value="<?=$rows["id"]?>"></td>

    <td align="center"  class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>"><img style="margin-bottom:4px; border:1px #cccccc solid" src="<?=getImageURL($rows["pic"],3,"uploadImage/",IMAGE)?>" border="0"></a><br>

<a href="a_image.php?pid=<?=$rows["id"]?>">细节图片(<?=fetchValue("select count(*) as v from @@@otherimage where pid=" . $rows["id"] , 0 );?>)</a></td>

    <td  align="center" class="point a_fen" id="name<?=$rows["id"]?>" ><?=$rows["name"]?></td>

    <td align="center"  class="a_fen"><?=fetchClassValue($class,$rows["classid"])?></td>

    <td align="center" class="a_fen point" id="price1<?=$rows["id"]?>" ><?=$rows["price1"]?></td> 

    <td align="center"  class="a_fen point" id="weight<?=$rows["id"]?>"><?=$rows["weight"]?></td>

    <td align="center"  class="a_fen point" id="hits<?=$rows["id"]?>"><?=$rows["hits"]?></td>

    <td align="center"  class="a_fen point" id="sort<?=$rows["id"]?>"><?=$rows["sort"]?></td>

    <td align="left"  class="a_fen">

<?

    for($index=0;$index<count($disp_rows);$index++)

	{

		if(($rows["disp"] & $disp_rows[$index]["value"])==$disp_rows[$index]["value"] )

	 	echo "<div onclick=\"changeDisp('".$rows["id"]."','".$disp_rows[$index]["value"]."');\" style='line-height:20px;height:20px;cursor:pointer;'><img align='absmiddle'  id='".$rows["id"]."_disp_".$disp_rows[$index]["value"]."' class='".$rows["id"]."_disp' hspace='3' src='images/disp_check.jpg'><span style='font-size:11px'>".$disp_rows[$index]["name"]."</span></div>";

		else

	 	echo "<div onclick=\"changeDisp('".$rows["id"]."','".$disp_rows[$index]["value"]."');\" style='line-height:20px;height:20px;cursor:pointer;'><img  align='absmiddle' id='".$rows["id"]."_disp_".$disp_rows[$index]["value"]."' class='".$rows["id"]."_disp' hspace='3' src='images/disp_uncheck.jpg'><span style='font-size:11px'>".$disp_rows[$index]["name"]."</span></div>";

	}

	?>

    

    </td>

    <td align="center" class="a_fen"><a class="red"  href="javascript:if(confirm('确定下架到仓库吗？'))removeproduct(<?=$rows["id"]?>)">下架仓库</a><br>

      <a href="?action=edit&id=<?=$rows["id"]?>">信息编辑</a><br>

  <a  href="javascript:freshProduct(<?=$rows["id"]?>)">推荐置顶</a><br>

  <a href="a_timeproduct.php?pid=<?=$rows["id"]?>">访问报表</a></td>

  </tr>

   <script language="javascript">

  $("#name<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@product','name',<?=$rows["id"]?>,0,30)}); 

  $("#price1<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@product','price1',<?=$rows["id"]?>,1)}); 

  $("#weight<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@product','weight',<?=$rows["id"]?>,1)}); 

  $("#sort<?=$rows["id"]?>").bind("click",function(){getValueHTML('@@@product','sort',<?=$rows["id"]?>,1)}); 

  </script>

<?

}

?>

  <tr bgcolor="#FFFFFF">

    <td colspan="10" class="a_fen">选择：<a  href="javascript:CheckAll('formdel','ON')">全选</a> 

      -

  <a href="javascript:CheckAll('formdel','OFF')">取消</a>

	   <span class="fontpadding delete">

  批量下架：

      <a href="javascript:submit_onClick('formdel','deletepage')">当前所选</a> <? if($condition!="where stock>=0" or true) { ?>- 

	  <a href="javascript:submit_onClick('formdel','deleteall')" class="red">搜索到的<?=$recordcount?>个结果</a><? } ?>

	  </span>

	    <span class="fontpadding edit">

  批量编辑：

      <a href="javascript:submit_onClick('formdel','editpage')" >当前所选</a><? if($condition!="where stock>=0" or true) { ?> - 

	  <a href="javascript:submit_onClick('formdel','editall')"  class="red">搜索到的<?=$recordcount?>个结果</a> <? } ?>

	  </span>

      <input id="do" name="do" type="hidden" value="editpage" />

      <input type="hidden" name="condition" id="condition" value="<?=$condition?>" /></td>

	</tr>

</form>

  <tr bgcolor="#FFFFE9">

    <td colspan="10" align="right" ><? require("php_page.php")?></td>

  </tr>

</table>

<script>

function submit_onClick(formdel,strdo)

{

	if(strdo=="editpage"||strdo=="deletepage")

	{

		var inps=document.getElementsByName("cbid[]");

		var count=0;

		for(var i=0; i<inps.length;i++)

		{

			if(inps[i].checked==true)

			count++;

		}

		if(count<=0)

		{

			alert("请至少选择一项");

			return;

		}

	}

	document.getElementById("do").value=strdo;

	if(confirm("确定执行该操作吗?"))

	{

		document.forms[formdel].submit();

	}

}

</script>

<?

}

?>

<?

function addItem()

{

global $cfg;

global $proot;

global $broot;

global $glo;

$config=$glo["config"];

$classid = getQueryInt("classid",$proot);

$brandid = getQueryInt("brandid",$broot);

?>



<form action="?action=add_save" method="post" enctype="application/x-www-form-urlencoded" name="formadd">

<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">

  <tr>

    <td  bgcolor="#F2F4F6" colspan="2"><strong>商品添加</strong></td>

    </tr>

  <tr    bgcolor="#FFFFFF">

    <td>选择分类：</td>

    <td><? classRelation($classid,8,"@@@productclass",""); ?></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>选中分类：</td>

    <td><input id="classname" style="width:250px" type="text" readonly="" value="<?=fetchValue("select name as v from @@@productclass where id=$classid","分类已被删除")?>" />

      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">

     <td>上架下架：</td>

     <td>

     <input type="radio" checked="checked" name="pstate" value="1">

     上架到列表 

     <input type="radio" name="pstate" value="-1">

     下架到仓库</td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">

    <td width="18%">商品名称：</td>

    <td width="82%"><input name="name" type="text" id="name" size="90" /><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px"><strong>!</strong>留空将使用图片名作为产品名</span></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td>商品编号：</td>

    <td><input name="itemno" type="text"  size="30" /></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)"  class=""  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

     <td>材料：</td>

     <td><input name="store" type="text"  size="30" /></td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>商品图片：</td>

    <td><img src="images/noimg.gif"  border="0" vspace="4" id="imgupload"><br>

<input name="pic" type="text" id="pic"   size="60" /></td>

  </tr>



   <tr   bgcolor="#FFFFFF">

    <td>&nbsp;</td>

    <td>

	 <script language="javascript">

	 function asCallOnePic(pic,filename,uploadfolder)

	 {

	 	//alert(pic);

		document.getElementById("pic").value = pic ;

		if( document.getElementById("name").value=="" )

		{

			arr = filename.split('.');

			document.getElementById("name").value = arr[0] ;

		}

		document.getElementById("imgupload").src = "<?=REMOTE?>image.php?pic=" + escape(pic) + "&style=1&folder=" + escape(uploadfolder);

	 }

	 </script>

	 <object id="uploadsystem" name="uploadsystem"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">

	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=uploadImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" />

			<param name="quality" value="high" />

			<param name='allowScriptAccess'  value='always' />

			<param name='allowNetworking' value='all' />

			<param name="bgcolor" value="#869ca7" />

			<param name="wmode" value="opaque">

			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=strftime("%Y-%m-%d-%H",time())?>&callfun=asCallOnePic&filepath=uploadImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>

	</object></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>购买价格：</td>

    <td> <?=getCoinChar($config,0)?>  <input  onKeyUp="document.getElementById('pifaprice0').value=this.value" name="price1" type="text"  value="0" size="8" maxlength="8" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="">

    <td> 市场价格：</td>

    <td> <?=getCoinChar($config,0)?>  

      <input name="price2" type="text" value="0" size="8" maxlength="8" /></td></tr>

  

    <tr class="hide"    bgcolor="#FFFFFF"  >

      <td valign="top">批发价格：</td>

      <td>

	  <div style="width:700px; padding:2px; line-height:30px; height:30px;">

	  <div style="width:690px">最小订购量:

	    <input name="minnum" type="text" value="0" onKeyUp="document.getElementById('pnumpre0').value=this.value" style="width:100px"  />

	    &nbsp;不需要将数量为0      </div>

	  </div>

	  <div style="background-color:#F2F4F6; border:1px #E3E6EB dotted; width:700px; padding-top:3px;">

	  <? 

	  $pnumpre=array();

	  $pnumpre[0] = 0 ;

	  for($index=0;$index<$cfg["product"]["pnum"];$index++)

	  {

	  ?>

	  <div id="pifadiv<?=$index?>" <? if($index>=1) { ?> class="hide" <? } ?> style=" padding:2px; line-height:30px;width:690px; height:30px;">

	  <div style="float:left; width:120px"> ＞:

	    <input id="pnumpre<?=$index?>"   class="readonly"  readonly="" value="<?=$pnumpre[$index]?>" type="text" style="width:70px"   />

      </div>

	  <div style="float:left; width:120px"> ≤:

	    <input name="pifanum<?=$index?>" value="<?=$pifanum[$index]?>"   onKeyUp="changeNextValue(<?=$index+1?>,this)" type="text" style="width:70px; border:1px #CC0033 solid"   />

      </div>

	   

	  <div style="float:left;  ">

        折扣:  

        <input name="pifaprice<?=$index?>" id="pifaprice<?=$index?>" onKeyUp="changeLastPrice(this)" style="width:70px"   type="text" />

        % 备注： 

        <input name="pifaremark<?=$index?>" id="pifaremark<?=$index?>"  style="width:240px"   type="text" /></div> 

      </div>

	  <div style="font-size:0px; line-height:0px; height:1px; clear:both"></div>

	  <?

	  }

	  ?>

	  <div style="width:700px; padding:2px; line-height:30px; height:30px;">

	  <div style="float:left; width:120px">&nbsp;</div><div style="float:left; width:120px"><span class="impc">超过以上区间:</span></div>

	  <div style="float:left; ">折扣:   

	    <input name="lastprice" id="lastprice" style="width:70px"  type="text"  value="0"  />

	    % 备注： 

	    <input name="lastremark" id="lastremark"  style="width:240px"   type="text" /></div>

      </div></div></td>

    </tr>

    <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">

    <td>显示类型：</td>

    <td> 

    <?

    $sql = "select * from @@@productdisp order by value asc";

	$d_rs = query($sql);

	while($d_rows=fetch($d_rs))

	{

	?>

    <input name='disp[]' type='checkbox' value='<?=$d_rows["value"]?>' /> <?=$d_rows["name"]?>

    <?

	}

	?>

    	</td>

  </tr>

    <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">

    <td>显示小图标：</td>

    <td> 

      <input type="radio" name="showicon" value="0" checked="checked" />no

      <input type="radio" name="showicon" value="1" />Hot

      <input type="radio" name="showicon" value="2" />New

      <script language="javascript">

	 EnterRadio("showicon","<?=$rows["showicon"]?>")

	 </script>

    </td>

  </tr>

      

    <tr class="hide" bgcolor="#FFFFFF">

      <td valign="top">Size Chart：</td>

      <td><select id="sizechartid" name="sizechartid" style="width:200px" >

      <option value="0">请选择Size Chart</option>

		<?

		$sql="select id as v,name as k from @@@infoclass where father=102";

		writeSelect($sql);

		?>

        </select></td>

    </tr>

    <tr   bgcolor="#FFFFFF">

    <td valign="top">商品属性：</td>

    <td><table width="572" border="0" cellpadding="1" cellspacing="1">

      <tr>

        <td width="159">选择属性模板</td>

        <td width="406">

		

		<select id="sltProperty" name="propertyid"  onChange="fetch_Property_Div(this.id,0)" >

		<?

		$sql="select id as v,name as k from @@@propertyclass where level=1 order by sort asc";

		writeSelect($sql);

		?>

        </select>

		<script>

			fetch_Property_Div("sltProperty",0);

		</script>		</td>

      </tr>

    </table>

	<div id="propertyDiv"></div></td>

  </tr>

   <tr   bgcolor="#FFFFFF">

    <td>商品重量：</td>

    <td> <input name="weight" type="text" value="0" size="8" maxlength="8" /> KG</td>

  </tr>

  

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" class=""  bgcolor="#FFFFFF">

    <td> 运费设置：</td>

    <td>

     <input type="radio" checked="checked" name="freeshipping" value="0">

     需要运费 

     <input type="radio" name="freeshipping" value="1">

     免运费</td>

  </tr>

  <tr    bgcolor="#FFFFFF" class="hide">

    <td>选择品牌：</td>

    <td><? classbrandRelation($brandid,8,"@@@brandclass"); ?></td>

  </tr>

   <tr class="hide" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>当前品牌：</td>

    <td><input id="brandname"  style="width:250px" type="text" readonly="" value="<?=fetchValue("select name as v from @@@brandclass where id=$brandid","分类已被删除")?>" />

      <input name="brandid" type="hidden" id="brandid" value="<?=$brandid?>" /></td>

  </tr>

  

 

  

  <tr  bgcolor="#FFFFFF">

    <td>商品细节图片上传：<br>

<span id="spanotherimage" class="red" style="font-weight:bold; display:none">细节图片上传成功！</span></td>

    <td><div style="color:#FF0000">若批量上传（其他细节图片）模块不能正常工作!请更新 FLASH for IE版本 到 10  <a target="_blank" href="http://www.skycn.com/soft/5671.html">更新</a></div>

	<object  id="uploadsystem3" name="uploadsystem3" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="219" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">

	<param name="movie" value="uploadsystem3.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&callfun=asCallJsSubmitFormData2&filepath=otherImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" />

			<param name="quality" value="high" />

			<param name='allowScriptAccess'  value='always' />

			<param name='allowNetworking' value='all' />

			<param name="bgcolor" value="#869ca7" />

			<param name="wmode" value="opaque">

			<embed   id="uploadsystem3" name="uploadsystem3" src="uploadsystem3.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&callfun=asCallJsSubmitFormData2&filepath=otherImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="219" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>

	</object>

      <input type="hidden" id="otherpic" name="otherpic" />

	  <script language="javascript">function asCallJsSubmitFormData2(str)

{

	document.getElementById("otherpic").value=str;

	if( str=="")

	{

		document.getElementById("spanotherimage").style.display="none";

	}

	else

	{

		document.getElementById("spanotherimage").style.display="block";

	}

}

</script></td>

  </tr>

<tr onMouseMove="tr_onMouseOver(this)" h="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">

    <td>商品数量：</td>

    <td><input name="stock" type="text"   value="0" size="4" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top">商品点击数：</td>

    <td><input name="hits" type="text"   value="0" size="4" /></td>

  </tr>

  

  <tr onMouseMove="tr_onMouseOver(this)" class="hide" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td valign="top">Tag标签：</td>

    <td><input name="tag" id="tag" type="text"   size="80" />

      用英文 , 隔开且不含有特殊字符</td>

  </tr>

  <tr   bgcolor="#FFFFFF"  class="hide">

    <td valign="top">&nbsp;</td>

    <td>

	<div style="width:700px"><script language="javascript">

	 function checkcss(obj)

	 {

	 	$('#tag').val(getCheckBoxValue('cbtagname[]'));

		if(obj.checked)

			$(obj).parent().addClass("oncheck");

		else

			$(obj).parent().removeClass("oncheck");

	 }

	</script>

     <?

	$sql="select * from @@@ptaglist where type=0";

	$rs=query($sql);

	$tag_type[-1] = array("name"=>"未分配","type"=>-1);

	while($trows=fetch($rs))

	{

		$tag_type[$trows["id"]] = $trows; 

	}

	

   foreach ($tag_type as $key => $value)

	{

		$sql="select * from @@@ptaglist where type=" . $key ;

		$rs = query($sql);

	?>

    <div style="font-size:14px; font-weight:bold">标签类型: <?=$value["name"]?></div>

    <div>

    <?

    	while($trows=fetch($rs))

		{

	?>

    	<div class="countryspan"><input  onClick="checkcss(this)" name="cbtagname[]" type="checkbox" value="<?=$trows["name"]?>"> <?=$trows["name"]?></div>

    <?

		}

	?>

    </div><div class="clear"></div>

    <?

	}

	?>

    <script language="javascript">

	EnterCheckBox("cbtagname[]","<?=join(',',$arrtag)?>");

	</script>

   </div>

    </td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top">SEO(标题Title)：</td>

    <td><textarea name="title" style="width:700px; height:70px" id="title"></textarea>

      <br />

      (商品页的标题,适当使用关键字,建议40-60英文之间)</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top">SEO(关键字Keywords)：</td>

    <td><textarea name="keywords" style="width:700px; height:70px" id="keywords"></textarea>

      <br />

      (商品的关键字,重点突出若干个相关关键字，避免使用不相关的，不超过20个)</td>

  </tr><tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top">SEO(描述Descript)：</td>

    <td><textarea name="descript"style="width:700px; height:70px" id="descript"></textarea>

      <br />

      (简要的描述商品介绍,适当使用关键字造句(避免过度频繁使用),建议250英文之内)</td>

  </tr>

  <tr    bgcolor="#FFFFFF">

    <td valign="top">商品说明：</td>

    <td><?

		$oFCKeditor = $glo["fck"] ;

		$oFCKeditor->Value = '' ;

		$oFCKeditor->Create() ;

		?></td>

  </tr>

 <tr  class="add"   bgcolor="#FFFFE9">

    <td>&nbsp;</td>

    <td><input type="submit" name="Submit5"  onClick="showtips(this)" class="button"  value="提交" /></td>

  </tr>

</table>



</form>

<?

}

?>

<?

function p_add()

{

global $cfg;

global $proot;

global $broot;

global $glo;

$config=$glo["config"];

$classid = getQueryInt("classid",$proot);

?>

<form action="?action=p_add_save" method="post" enctype="application/x-www-form-urlencoded" id="formadd" name="formadd">

<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">

  <tr>

    <td  bgcolor="#F2F4F6" colspan="2"><strong>商品批量添加</strong><span class="fontpadding" style="font-weight:bold"><a target="_blank" href="http://open.35zh.com/download/download_p_upload.rar" class="red weight"><img src="images/shipin.gif" hspace="4" align="absmiddle"> 强烈建议下载3分钟的视频教程</a></span></td>

    </tr>

  <tr   bgcolor="#FFFFFF">

    <td width="18%">选择分类：</td>

    <td width="82%"><? classRelation($classid,8,"@@@productclass",""); ?></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>选中分类：</td>

    <td><input id="classname" style="width:250px" type="text" readonly="" value="<?=fetchValue("select name as v from @@@productclass where id=$classid","分类已被删除")?>" />

      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>

  </tr><tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">

     <td>上架下架：</td>

     <td>

     <input type="radio" checked="checked" name="pstate" value="1">

     上架到列表 

     <input type="radio" name="pstate" value="-1">

     下架到仓库</td>

   </tr>

 <tr  bgcolor="#FFFFFF">

    <td>商品名称：</td>

    <td><span style="background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px"><input name="type" onClick="showorhide(this)" type="checkbox" value="1"> 

    图片名作为<span style="color:#FF0000">产品名称</span></span><script language="javascript">

	function showorhide(obj)

	{

		if(obj.checked)

			document.getElementById("tr_name").style.display="none";

		else

			document.getElementById("tr_name").style.display="";

	}

	</script></td>

  </tr>

  <tr id="tr_name"  bgcolor="#FFFFFF">

    <td>&nbsp;</td>

    <td><input name="name" type="text" size="90" />

      （<input name="nstart" type="text" size="10" />        

        <span style="color:#FF0000; font-weight:bold">种子数</span>）<br>

1. 种子起始：必须为数字,可以留空,递增的第一个数; 格式类似 : 0001<br>

2. 第一个框：可以使用 <a target="_blank" href="a_replacewords.php">优化词库</a> ， 例如输入{1} {2} .  那么{x}将在 优化词库里面去查询ID=x的词库内容进行随机替换!<br>

使用 优化词库，产品名称将不在单一，更有利于SEO优化。</td>

  </tr>



  <tr onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td>商品编号：</td>

    <td><span style="background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px"> <input  onClick="showorhide2(1)" name="itemnotype" type="radio"  value="1">

    图片名作为<span style="color:#FF0000">产品编号</span></span><input name="itemnotype" type="radio" onClick="showorhide2(0)" checked="checked" value="0"> 自定义  <input name="itemnotype" onClick="showorhide2(2)" type="radio" value="2"> 与ID同步

    <script language="javascript">

	function showorhide2(value)

	{

		//itemnotype

		if(value==0)

			document.getElementById("tr_itemno").style.display="";

		else

			document.getElementById("tr_itemno").style.display="none";

	}

	</script></td>

  </tr>

  <tr  id="tr_itemno" onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td>&nbsp;</td>

    <td><input name="itemno" type="text" size="30" /> 

    （

        <input name="istart" type="text" size="10" />        

        <span style="color:#FF0000; font-weight:bold">种子数</span>,可留空 ; 递增的第一个数; 格式类似 : 0001 

      ）</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  class=""  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

     <td>材料：</td>

     <td><input name="store" type="text" value="<?=$rows["store"]?>"  size="30" /></td>

   </tr>

  

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>购买价格：</td>

    <td> <?=getCoinChar($config,0)?> <input name="price1"  onKeyUp="document.getElementById('pifaprice0').value=this.value" type="text"  value="0" size="8" maxlength="8" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="">

    <td>市场价格：</td>

    <td> <?=getCoinChar($config,0)?>  <input name="price2" type="text" value="0" size="8" maxlength="8" /></td>

  </tr>

   <tr    class="hide"    bgcolor="#FFFFFF" >

      <td valign="top">批发价格：</td>

      <td>

	 <div style=" padding:2px; line-height:30px; height:30px;">

	  <div style="width:400px">最小订购量:

	    <input name="minnum" type="text" value="0" onKeyUp="document.getElementById('pnumpre0').value=this.value" style="width:100px"  />

	    &nbsp;不需要将数量为0      </div>

	  </div>

	  <div style="background-color:#F2F4F6; border:1px #E3E6EB dotted; width:700px; padding-top:3px ">

	  <? 

	  $pnumpre=array();

	  $pnumpre[0] = 0 ;

	  for($index=0;$index<$cfg["product"]["pnum"];$index++)

	  {

	  ?>

	  <div id="pifadiv<?=$index?>" <? if($index>=1) { ?> class="hide" <? } ?> style=" padding:2px; line-height:30px; height:30px;">

	  <div style="float:left; width:120px"> ＞:

	    <input id="pnumpre<?=$index?>"   class="readonly"  readonly="" value="<?=$pnumpre[$index]?>" type="text" style="width:70px"   />

      </div>

	  <div style="float:left; width:120px"> ≤:

	    <input name="pifanum<?=$index?>" value="<?=$pifanum[$index]?>"   onKeyUp="changeNextValue(<?=$index+1?>,this)" type="text" style="width:70px; border:1px #CC0033 solid"   />

      </div>

	   

	  <div style="float:left;  ">折扣:

	    <input name="pifaprice<?=$index?>" id="pifaprice<?=$index?>" onKeyUp="changeLastPrice(this)" style="width:70px"   type="text" />

        % 备注： 

        <input name="pifaremark<?=$index?>" id="pifaremark<?=$index?>"  style="width:240px"   type="text" /></div> 

      </div>

	  <?

	  }

	  ?>

	  <div style="width:700px; padding:2px; line-height:30px; height:30px;">

	  <div style="float:left; width:120px"></div><div style="float:left; width:120px"><span class="impc">超过以上区间:</span></div>

	  <div style="float:left; ">折扣: 

	    <input name="lastprice" id="lastprice" style="width:70px"  type="text"  value="0"  /> 

	    % 备注： 

	    <input name="lastremark" id="lastremark"  style="width:240px"   type="text" /></div>

      </div>

	  </div></td>

    </tr>

    <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">

    <td>显示类型：</td>

    <td> <?

    $sql = "select * from @@@productdisp order by value asc";

	$d_rs = query($sql);

	while($d_rows=fetch($d_rs))

	{

	?>

    <input name='disp[]' type='checkbox' value='<?=$d_rows["value"]?>' /> <?=$d_rows["name"]?>

    <?

	}

	?></td>

  </tr>

    <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">

    <td>显示小图标：</td>

    <td> 

      <input type="radio" name="showicon" value="0" checked="checked" />no

      <input type="radio" name="showicon" value="1" />Hot

      <input type="radio" name="showicon" value="2" />New

      <script language="javascript">

	 EnterRadio("showicon","<?=$rows["showicon"]?>")

	 </script>

    </td>

  </tr>

      

  <tr class="hide" bgcolor="#FFFFFF">

      <td valign="top">Size Chart：</td>

      <td><select id="sizechartid" name="sizechartid" style="width:200px" >

      <option value="0">请选择Size Chart</option>

		<?

		$sql="select id as v,name as k from @@@infoclass where father=102";

		writeSelect($sql);

		?>

        </select></td>

    </tr>

    <tr    bgcolor="#FFFFFF" >

    <td valign="top">商品属性：</td>

    <td><table width="572" border="0" cellpadding="1" cellspacing="1">

      <tr>

        <td width="159">选择属性模板</td>

        <td width="406">

		

		<select id="sltProperty" name="propertyid" onChange="fetch_Property_Div(this.id,0)" >

		<?

		$sql="select id as v,name as k from @@@propertyclass where level=1 order by sort asc";

		writeSelect($sql);

		?>

        </select>

		<script>

			fetch_Property_Div("sltProperty",0);

		</script>		</td>

      </tr>

    </table>

	<div id="propertyDiv"></div>	</td>

  </tr>

    <tr   bgcolor="#FFFFFF">

    <td>商品重量：</td>

    <td> <input name="weight" type="text" value="0" size="8" maxlength="8" /> KG</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  class=""  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td> 运费设置：</td>

    <td>

     <input type="radio" checked="checked" name="freeshipping" value="0">

     需要运费 

     <input type="radio" name="freeshipping" value="1">

     免运费</td>

  </tr>

  <tr   class="hide"  bgcolor="#FFFFFF">

    <td>选择品牌：</td>

    <td><? classbrandRelation($broot,8,"@@@brandclass"); ?></td>

  </tr>

   <tr class="hide" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>当前品牌：</td>

    <td><input id="brandname"  style="width:250px" type="text" readonly="" value="<?=fetchValue("select name as v from @@@brandclass where id=$broot","分类已被删除")?>" />

      <input name="brandid" type="hidden" id="brandid" value="<?=$brandid?>" /></td>

  </tr>

  

  

<tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">

    <td>商品数量：</td>

    <td><input name="stock" type="text"   value="0" size="4" /></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top">商品点击数：</td>

    <td><input name="hits" type="text"   value="0" size="4" /></td>

  </tr> <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td valign="top">Tag标签：</td>

    <td><input name="tag" id="tag" type="text"   size="80" />

      用英文 , 隔开且不含有特殊字符</td>

  </tr>

  <tr   bgcolor="#FFFFFF"  class="hide">

    <td valign="top">&nbsp;</td>

    <td><div style="width:700px"><script language="javascript">

	 function checkcss(obj)

	 {

	 	$('#tag').val(getCheckBoxValue('cbtagname[]'));

		if(obj.checked)

			$(obj).parent().addClass("oncheck");

		else

			$(obj).parent().removeClass("oncheck");

	 }

	</script>

         <?

	$sql="select * from @@@ptaglist where type=0";

	$rs=query($sql);

	$tag_type[-1] = array("name"=>"未分配","type"=>-1);

	while($trows=fetch($rs))

	{

		$tag_type[$trows["id"]] = $trows; 

	}

	

   foreach ($tag_type as $key => $value)

	{

		$sql="select * from @@@ptaglist where type=" . $key ;

		$rs = query($sql);

	?>

    <div style="font-size:14px; font-weight:bold">标签类型: <?=$value["name"]?></div>

    <div>

    <?

    	while($trows=fetch($rs))

		{

	?>

    	<div class="countryspan"><input  onClick="checkcss(this)" name="cbtagname[]" type="checkbox" value="<?=$trows["name"]?>"> <?=$trows["name"]?></div>

    <?

		}

	?>

    </div><div class="clear"></div>

    <?

	}

	?>

    <script language="javascript">

	EnterCheckBox("cbtagname[]","<?=join(',',$arrtag)?>");

	</script>

   </div> </td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top">SEO(标题Title)：</td>

    <td><textarea name="textarea" style="width:700px; height:70px" id="textarea"></textarea>

      <br />

      (商品页的标题,适当使用关键字,建议40-60英文之间)</td></tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top">SEO(关键字Keywords)：</td>

    <td><textarea name="keywords" style="width:700px; height:70px" id="keywords"></textarea>

      <br />

      (商品的关键字,重点突出若干个相关关键字，避免使用不相关的，不超过20个)</td>

  </tr><tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top">SEO(描述Descript)：</td>

    <td><textarea name="descript" style="width:700px; height:70px" id="descript"></textarea>

      <br />

      (简要的描述商品介绍,适当使用关键字造句(避免过度频繁使用),建议250英文之内) </td>

  </tr>

  

  <tr    bgcolor="#FFFFFF">

    <td valign="top">商品说明：</td>

    <td>

	<?

		$oFCKeditor = $glo["fck"] ;

		$oFCKeditor->Value = '' ;

		$oFCKeditor->Create() ;

		?>	</td>

  </tr>

  <tr    bgcolor="#FFFFFF">

    <td valign="top">批量上传：</td>

    <td>

	<div style="color:#FF0000">若批量上传模块不能正常工作!请更新 FLASH for IE版本 到 9  <a target="_blank" href="http://www.skycn.com/soft/5671.html">更新</a></div>

	<object  id="uploadsystem" name="uploadsystem" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="450" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">

	<param name="movie" value="uploadsystem1.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&filepath=uploadImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&server=<?=urlencode(CGIBIN)?>&<?=REMOTECOMMAND?>" />

			<param name="quality" value="high" />

			<param name='allowScriptAccess'  value='always' />

			<param name='allowNetworking' value='all' />

			<param name="bgcolor" value="#869ca7" />

			<param name="wmode" value="opaque">

			<embed   id="uploadsystem" name="uploadsystem" src="uploadsystem1.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&maxsize=<?=$cfg["upload_maxsize"]*1024?>&filepath=uploadImage&server=<?=urlencode(CGIBIN)?>&<?=REMOTECOMMAND?>" quality="high" bgcolor="#869ca7" width="700" height="450" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>

	</object>

      <input type="hidden" id="pic" name="pic" /></td>

  </tr>

  

 <tr  class="add hide" bgcolor="#FFFFE9">

    <td>&nbsp;</td>

    <td><input type="submit"  class="button"  onClick="showtips(this)"  value="提交" /></td>

 </tr>

</table>



</form>

<?

}

?>



<?

function editItem()

{

global $glo;

$config=$glo["config"];

global $cfg;

$id=getQuerySQL("id");

$sql="select * from @@@product where id=$id";

$rs=query($sql);

isItemNotExist($rs);

$rows=fetch($rs);

$classid=$rows["classid"];

$brandid=$rows["brandid"];

?>

<form action="?action=edit_save&id=<?=$id?>" method="post" enctype="application/x-www-form-urlencoded" id="formadd" name="formadd">





<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">

  <tr>

    <td  bgcolor="#F2F4F6" colspan="2"><strong>商品编辑</strong><? if($rows["remoteurl"]!="" ) { ?><span class="fontpadding"><a target="_blank" href="a_caiji.php?action=step_edit&id=<?=$id?>">采集修改</a><? } ?></span></td>

    </tr>

 

  <tr    bgcolor="#FFFFFF">

    <td>选择分类：</td>

    <td><? classRelation($classid,8,"@@@productclass",""); ?></td>

  </tr>

  <tr    bgcolor="#ffffff">

    <td>选中分类：</td>

    <td><input id="classname"  style="width:250px" type="text" readonly="" value="<?=fetchValue("select name as v from @@@productclass where id=$classid","分类已被删除")?>" />

      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>

  </tr>

  

 

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="18%">商品名称：</td>

    <td width="82%"><input name="name" type="text" id="tbName" value="<?=$rows["name"]?>" size="90" /></td>

  </tr>

  <tr  onmousemove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF" >

    <td>商品编号：</td>

    <td><input name="itemno"  type="text" id="tbNO" value="<?=$rows["itemno"]?>" size="30" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  class=""  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

     <td>材料：</td>

     <td><input name="store" value="<?=$rows["store"]?>" type="text"  size="30" /></td>

   </tr>

    <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td>购买价格：</td>

    <td> <?=getCoinChar($config,0)?> <input name="price1" type="text"    onKeyUp="document.getElementById('pifaprice0').value=this.value" size="8" value="<?=$rows["price1"]?>" maxlength="8" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="">

    <td>市场价格：</td>

    <td> <?=getCoinChar($config,0)?> <input name="price2" type="text"  value="<?=$rows["price2"]?>" size="8" maxlength="8" /></td>

  </tr>

  	

	<tr  class="hide"    bgcolor="#ffffff"   >

      <td valign="top">批发价格：</td>

      <td>

	  <div style="width:700px; padding:2px; line-height:30px; height:30px;">

	  <div style="width:400px">最小订购量:

	    <input name="minnum" type="text"  onKeyUp="document.getElementById('pnumpre0').value=this.value" value="<?=$rows["minnum"]?>" style="width:100px"  />

	    &nbsp;不需要将数量为0      </div>

	  </div><div style="background-color:#F2F4F6; border:1px #E3E6EB dotted; width:700px; padding-top:3px ">

	  <?

	  $pifanum=split($cfg["split"],$rows["pnum"]);

	  $pifaprice=split($cfg["split"],$rows["pprice"]);

	  $pifaremark=split($cfg["split"],$rows["premark"]);

	  array_pad($pifanum,20,"");

	  array_pad($pifaprice,20,"");

	  array_pad($pifaremark,20,"");

	  for($index=0;$index<$cfg["product"]["pnum"];$index++)

	  {

	  if( $index==0 )

	  	$pnumpress = $rows["minnum"] ;

	  else

	  	$pnumpress = $pifanum[$index-1]

	  ?>

	  

	  <div id="pifadiv<?=$index?>" <? if($index>=1 && $pifanum[$index-1]=="") { ?> class="hide" <? } ?> style="width:700px; padding:2px; line-height:30px; height:30px;">

	  <div style="float:left; width:120px"> ＞:

	    <input id="pnumpre<?=$index?>"   class="readonly"  readonly="" value="<?=$pnumpress?>" type="text" style="width:70px"   />

      </div>

	  <div style="float:left; width:120px"> ≤:

	    <input name="pifanum<?=$index?>" value="<?=$pifanum[$index]?>"   onKeyUp="changeNextValue(<?=$index+1?>,this)" type="text" style="width:70px; border:1px #CC0033 solid"   />

      </div>

	   

	  <div style="float:left;  ">折扣:  

        <input name="pifaprice<?=$index?>"  value="<?=$pifaprice[$index]?>"  id="pifaprice<?=$index?>" onKeyUp="changeLastPrice(this)" style="width:70px"   type="text" />

        % 备注： 

        <input name="pifaremark<?=$index?>" id="pifaremark<?=$index?>"  value="<?=$pifaremark[$index]?>" style="width:240px"   type="text" /></div> 

      </div>

	  

	  <?

	  }

	  ?>

	   <div style="width:700px; padding:2px; line-height:30px; height:30px;">

	  <div style="float:left; width:120px">&nbsp;</div><div style="float:left; width:120px"><span class="impc">超过以上区间:</span></div>

	  <div style="float:left; ">折扣 :   <input name="lastprice" id="lastprice" style="width:70px"  type="text"   value="<?=$rows["lastprice"]?>" /> 

	    % 备注： 

	      <input name="lastremark" value="<?=$rows["lastremark"]?>" id="lastremark"  style="width:240px"   type="text" /></div>

      </div>

	  </div>	 </td>

    </tr>

	

    <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>显示类型：</td>

    <td> <?

    $sql = "select * from @@@productdisp order by value asc";

	$d_rs = query($sql);

	while($d_rows=fetch($d_rs))

	{

	?>

    <input name='disp[]' type='checkbox' value='<?=$d_rows["value"]?>' /> <?=$d_rows["name"]?>

    <?

	}

	?>

	<script language="javascript">

		EnterCheckBox("disp[]","<?=c2tostr(decbin($rows["disp"]))?>");

	</script>	</td>

  </tr>

    <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">

    <td>显示小图标：</td>

    <td> 

      <input type="radio" name="showicon" value="0" checked="checked" />no

      <input type="radio" name="showicon" value="1" />Hot

      <input type="radio" name="showicon" value="2" />New

      <script language="javascript">

	 EnterRadio("showicon","<?=$rows["showicon"]?>")

	 </script>

    </td>

  </tr>

   

  <tr class="hide"  bgcolor="#FFFFFF">

      <td valign="top">Size Chart：</td>

      <td><select id="sizechartid" name="sizechartid" style="width:200px" >

      <option value="0">请选择Size Chart</option>

		<?

		$sql="select id as v,name as k from @@@infoclass where father=102";

		writeSelect($sql);

		?>

        </select><script language="javascript">

		EnterSelect("sizechartid","<?=$rows["sizechartid"]?>");

		</script></td>

    </tr>

    <tr    bgcolor="#FFFFFF">

    <td valign="top">商品属性：</td>

    <td>

	<table width="572" border="0" cellpadding="1" cellspacing="1">

      <tr>

        <td width="159">选择属性模板</td>

        <td width="406">

		

		<select id="sltProperty"  name="propertyid" onChange="fetch_Property_Div(this.id,0)" >

		<option value="0">请选择模板</option>

		<?

		$sql="select id as v,name as k from @@@propertyclass where level=1 order by sort asc";

		writeSelect($sql);

		?>

        </select>

		<script language="javascript">

		EnterSelect("sltProperty","<?=$rows["propertyid"]?>");

		</script>		</td>

      </tr>

    </table>

	<div id="propertyDiv">

	<div class="hide">

	<table width="700" border="0" cellspacing="1" cellpadding="1"  class="tbtitle">

  <tr  bgcolor="#EDF9D5" align="center">

    <td colspan="2" bgcolor="#F2F4F6">商品属性</td>

  </tr>

	

	<?

	$pkey=split($cfg["split"],$rows["pkey"]);

	$pvalue=split($cfg["split"],$rows["pvalue"]);

	removeSplitEmpty($pkey);

	for($index=0;$index<count($pkey);$index++)

	{

	$arrpair =split(':',$pkey[$index]);

	?>

	  

  <tr bgcolor="#FFFFFF" align="center">

    <td width="166"><?=$arrpair[0]?><input name="pkey<?=$index+1?>" type="hidden" value="<?=$arrpair[0]?>"></td>

    <td align="left"><? fetch_HTML(0,$arrpair[1],$index+1,"pvalue"); ?></td>

  </tr>

  <?

  }

  ?>

  </table>

  <input name="pnum" type="hidden" value="<?=count($pkey)?>" />

<br /></div>

<table width="700" border="0" cellspacing="1" cellpadding="1"  class="tbtitle">

  <tr  bgcolor="#EDF9D5" align="center">

    <td colspan="2" bgcolor="#F2F4F6">购物属性</td>

  </tr>

  <?

	$ckey=split($cfg["split"],$rows["ckey"]);

	$cvalue=split($cfg["split"],$rows["cvalue"]);

	$ctype=split($cfg["split"],$rows["ctype"]);

	$cprice=split($cfg["split"],$rows["cprice"]);

	removeSplitEmpty($ckey);

	for($index=0;$index<count($ckey);$index++)

	{

	if( $ctype[$index]==10 )

		$stmp = 4 ;

	else

		$stmp = 1 ;

?>

  

   <tr bgcolor="#FFFFFF" align="center">

    <td width="99"><?=$ckey[$index]?>

      <input name="ckey<?=$index+1?>" type="hidden" value="<?=$ckey[$index]?>"></td>

    <td width="594" align="left"><? fetch_HTML($stmp,$cvalue[$index],$index+1,"cvalue"); ?>

    <input type="hidden" name="ctype<?=$index+1?>" value="<?=$ctype[$index]?>" />

	<textarea name="cprice<?=$index+1?>" <? if( $cprice[$index]==""  ) { ?> class="hide" <? } ?> style='width:280px; height:60px;'><?=$cprice[$index]?></textarea>	</td>

  </tr>

  

  <?

  }

  ?>

  </table>

<input name="cnum" type="hidden" value="<?=count($ckey)?>" />

<br />

	</div>	</td>

  </tr>

    <tr    bgcolor="#FFFFFF">

    <td>商品重量：</td>

    <td> <input name="weight" type="text" value="<?=$rows["weight"]?>" size="8" maxlength="8" /> KG</td>

  </tr>

    

  <tr onMouseMove="tr_onMouseOver(this)"  class=""  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td> 运费设置：</td>

    <td>

     <input type="radio" checked="checked" name="freeshipping" value="0">

     需要运费 

     <input type="radio" name="freeshipping" value="1">

     免运费 <script language="javascript">

	 EnterRadio("freeshipping","<?=$rows["freeshipping"]?>")

	 </script></td>

  </tr>

    <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF"  class="hide">

      <td>商品排序：</td>

      <td><input name="sort" type="text" id="tbsort" value="<?=$rows["sort"]?>" /></td>

    </tr>

    <tr   class="hide"  bgcolor="#FFFFFF">

    <td>选择品牌：</td>

    <td><? classbrandRelation($brandid,8,"@@@brandclass"); ?></td>

  </tr>

   <tr class="hide" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>当前品牌：</td>

    <td><input id="brandname"  style="width:250px" type="text" readonly="" value="<?=fetchValue("select name as v from @@@brandclass where id=$brandid","分类已被删除")?>" />

      <input name="brandid" type="hidden" id="brandid" value="<?=$brandid?>" /></td>

  </tr>

  

   



 

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>商品主图片：</td>

    <td><img src="<?=getImageURL($rows["pic"],1,"uploadImage/",IMAGE)?>" id="imgupload" vspace="4" border="0"><br>

<input name="pic" id="pic"  type="text"  class="readonly"  value="<?=$rows["pic"]?>" size="60" /></td>

  </tr>

  <tr   bgcolor="#ffffff">

    <td>&nbsp;<? $path_parts = pathinfo( $rows["pic"] );

	$todir = $path_parts["dirname"] ; 

	$todir = dataDefault("",strftime("%Y-%m-%d-%H",time()));

	?></td>

    <td> 

	 <script language="javascript">

	 function asCallOnePic(pic,filename,uploadfolder)

	 {

	 	//alert(pic);

		document.getElementById("pic").value = pic ;

		document.getElementById("imgupload").src = "<?=REMOTE?>image.php?pic=" + escape(pic) + "&style=1&folder=" + escape(uploadfolder);

	 }

	 </script>

	<object id="uploadsystem" name="uploadsystem"  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  width="700" height="65" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">

	<param name="movie" value="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic&filepath=uploadImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" />

			<param name="quality" value="high" />

			<param name='allowScriptAccess'  value='always' />

			<param name='allowNetworking' value='all' />

			<param name="bgcolor" value="#869ca7" />

			<param name="wmode" value="opaque">

			<embed   id="uploadsystem" name="uploadsystem" src="fileupload.swf?dns=<?=$_SERVER["SERVER_NAME"]?>&folder=<?=$todir?>&callfun=asCallOnePic&filepath=uploadImage&maxsize=<?=$cfg["upload_maxsize"]*1024?>&<?=REMOTECOMMAND?>&server=<?=urlencode(CGIBIN)?>" quality="high" bgcolor="#869ca7" width="700" height="65" align="middle" play="true" loop="false" quality="high"  allowScriptAccess='always' allowNetworking='all'  type="application/x-shockwave-flash" pluginspage "http://www.adobe.com/go/getflashplayer"></embed>

	</object></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">

    <td>商品数量：</td>

    <td><input name="stock" type="text"  value="<?=$rows["stock"]?>"  id="tbStock" size="4" /></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top">商品点击数：</td>

    <td><input name="hits" type="text"   value="<?=$rows["hits"]?>" size="4" /></td>

  </tr> 

  <?

  $sql="select * from @@@ptag where pid=" . $rows["id"];

  $rs2 = query($sql);

  $arrtag = array();

  while($trows = fetch($rs2) )

  {

  	$arrtag[] = $trows["name"] ;

  }

  free($rs2);

  ?>

  <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"   bgcolor="#FFFFFF"  >

    <td valign="top">Tag标签：</td>

    <td><input name="tag" id="tag" type="text" value="<?=join(',',$arrtag)?>"   size="80" />

      用英文 , 隔开!不存在的将创建</td>

  </tr>

  <tr   bgcolor="#FFFFFF"  class="hide">

    <td valign="top">&nbsp;</td>

    <td><div style="width:700px"><script language="javascript">

	 function checkcss(obj)

	 {

	 	$('#tag').val(getCheckBoxValue('cbtagname[]'));

		if(obj.checked)

			$(obj).parent().addClass("oncheck");

		else

			$(obj).parent().removeClass("oncheck");

	 }

	</script>

        <?

	$sql="select * from @@@ptaglist where type=0";

	$rs=query($sql);

	$tag_type[-1] = array("name"=>"未分配","type"=>-1);

	while($trows=fetch($rs))

	{

		$tag_type[$trows["id"]] = $trows; 

	}

	

   foreach ($tag_type as $key => $value)

	{

		$sql="select * from @@@ptaglist where type=" . $key ;

		$rs = query($sql);

	?>

    <div style="font-size:14px; font-weight:bold">标签类型: <?=$value["name"]?></div>

    <div>

    <?

    	while($trows=fetch($rs))

		{

	?>

    	<div class="countryspan"><input  onClick="checkcss(this)" name="cbtagname[]" type="checkbox" value="<?=$trows["name"]?>"> <?=$trows["name"]?></div>

    <?

		}

	?>

    </div><div class="clear"></div>

    <?

	}

	?>

    <script language="javascript">

	EnterCheckBox("cbtagname[]","<?=join(',',$arrtag)?>");

	</script>

   </div> </td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top">SEO(标题Title)：</td>

    <td><textarea name="title"  style="width:700px; height:70px"  id="title"><?=$rows["title"]?></textarea>

      <br />

      (商品页的标题,适当使用关键字,建议40-60英文之间)</td>

  </tr>

    <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top">SEO(关键字Keywords)：</td>

    <td><textarea name="keywords"  style="width:700px; height:70px"  id="keywords"><?=$rows["keywords"]?></textarea>

      <br />

      (商品的关键字,重点突出若干个相关关键字，避免使用不相关的，不超过20个)</td>

  </tr><tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="" >

    <td valign="top">SEO(描述Descript)：</td>

    <td><textarea name="descript"  style="width:700px; height:70px"  id="description"><?=$rows["descript"]?></textarea>

      <br />

      (简要的描述商品介绍,适当使用关键字造句(避免过度频繁使用),建议250英文之内)</td>

  </tr>

  

  <tr   bgcolor="#FFFFFF">

    <td valign="top">商品说明：</td>

    <td>

	<?

		$oFCKeditor = $glo["fck"] ;

		$oFCKeditor->Value = $rows["content"] ;

		$oFCKeditor->Create() ;

		?>	</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide">

      <td>是否更新时间：</td>

      <td><input type="radio" value="1"  name="update"  />

        是

          <input type="radio" value="0" checked="checked" name="update"  />

          否</td>

    </tr>



 <tr  class="edit"  bgcolor="#FFFFE9">

    <td>&nbsp;</td>

    <td><input type="submit"  class="button"  name="Submit5" value="修改" onClick="showtips(this)" /></td>

  </tr>

</table>

</form>

<?

}

?>

<?

function editstate()

{

global $glo;

$config=$glo["config"];

global $cfg;

global $proot;

$id=getQuerySQL("id");

$sql="select * from @@@product where id=$id";

$rs=query($sql);

isItemNotExist($rs);

$rows=fetch($rs);

$classid=$rows["classid"];

$brandid=$rows["brandid"];

?>

<form action="?action=editstate_save&id=<?=$id?>" method="post" enctype="application/x-www-form-urlencoded" name="formadd">

<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">

  <tr>

    <td  bgcolor="#F2F4F6" colspan="2"><strong>商品顺序修改</strong></td>

    </tr>

  

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="18%">商品名称：</td>

    <td width="82%"><?=$rows["name"]?></td>

  </tr>

  <tr  onmousemove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF" >

    <td>商品编号：</td>

    <td><?=$rows["itemno"]?></td>

  </tr>

  <tr  bgcolor="#FFFFFF">

    <td>商品图片：</td>

    <td><img src="<?=getImageURL($rows["pic"],1,"uploadImage/",IMAGE)?>" id="imgupload" vspace="4" border="0"></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

      <td>推荐排序：</td>

      <td>

	  <span style="display:inline-block; width:220px"><input type="radio" value="1"  name="dispupdate"  />

        排到首位

          <input type="radio" value="0" checked="checked" name="dispupdate"  />

          保持原位</span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">例如:如果有推荐的话， 将排到类似 新产品 等的首位</span>

	  </td>

    </tr>

<tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

      <td>列表排序：</td>

      <td><div style="margin-bottom:4px">

	  <span style="display:inline-block; width:220px"><input type="radio" checked="checked" value="-2"  name="classstateupdate"  /> 保持原位</span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">保持在当前的位置不变</span></div>

		  

		<div style="margin-bottom:4px"><span style="display:inline-block; width:220px"><input type="radio" value="-1"  name="classstateupdate"  /> 恢复到原来的位置</span><span style="margin-left:30px; background-color:#FFFFE6; border:1px #FEDF63 dotted; line-height:20px; height:20px; display:inline-block; padding:0px 5px 0px 5px">恢复到产品上传时候的位置</span></div>

		<?

		$strurl = fetchValue("select url as v from `@@@productclass` where id=".$rows["classid"],0);

		$sql = "select id,name,tree from `@@@productclass` where id in ($strurl) order by level desc";

		$rs = query($sql);

		while($orows=fetch($rs))

		{

		if( $orows["id"] == $proot )

			$tpaixu = fetchValue("select count(id) as v from `@@@product` where  state>".$rows["state"],0);

		else

			$tpaixu = fetchValue("select count(id) as v  from `@@@product` where classid in(".$orows["tree"].") and state>".$rows["state"],0);

		

		?>

		<div style="margin-bottom:4px"><input type="radio" value="<?=$orows["id"]?>"  name="classstateupdate"  /> 排名：<?=$tpaixu+1?> , 排到 <span class="red"><?=$orows["name"]?></span> 的首位</div>

		<?

		}

		?>

	  </td>

    </tr>

 <tr  class="edit"  bgcolor="#FFFFE9">

    <td>&nbsp;</td>

    <td><input type="submit"  class="button"  name="Submit5" value="修改" onClick="showtips(this)" /></td>

  </tr>



</table>

</form>

<?

}

?>

<?

function p_editItem($flag)

{

global $cfg;

global $proot;

global $broot;

global $glo;

$config=$glo["config"];

$classid = getQueryInt("classid",$proot);

if( $flag==0 )

{

	$id=getRequestStr("cbid",0,0);

	$condition="where id in ($id)";

}

else

{

	$condition=$_POST["condition"];

}

$num=fetchCount("@@@product",$condition);

?>



<form action="?action=p_edit_save" method="post" enctype="application/x-www-form-urlencoded" name="formadd">

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#CC0000;">

  <tr  bgcolor="#FFD0D0">

    <td  >

提示：批量修改中，如果不勾选前面的<span class="red weight">

<input name="checkbox2" type="checkbox" value="checkbox">

</span>则保留商品原来的值！</td>

  </tr>

</table>

<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >

  <tr  bgcolor="#F2F4F6">

    <td >

    总共选择了 <span class="STYLE1" ><?=$num?>

    </span> <input type="hidden" name="condition" value="<?=$condition?>" />

    件商品！需要修改某字段请勾选前面的"<span class="red weight">

    <input name="checkbox" type="checkbox" value="checkbox" checked>

    </span>"并输入修改的内容！</td>

  </tr>

</table>

<br />



<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">

  <tr>

    <td  bgcolor="#F2F4F6" colspan="2"><strong>批量修改商品</strong></td>

    </tr>

  <tr    bgcolor="#FFFFFF">

    <td><input type="checkbox" name="cbclassid" value="1">

      选择分类：</td>

    <td>

  <? classRelation($classid,8,"@@@productclass",""); ?></td></tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;选中分类：</td>

    <td><input id="classname" style="width:250px"  type="text" readonly="" value="<?=fetchValue("select name as v from @@@productclass where id=$classid","分类已被删除")?>" />

      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>

   </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">

    <td width="18%"><input type="checkbox" name="cbname" value="1">

      商品名称：</td>

    <td width="82%"><input name="name" type="text" id="tbName" size="30" /> （

        <input name="nstart" type="text" size="10" /> 

        该框必须填入 <span style="color:#FF0000; font-weight:bold">数字</span>,可留空 ; 开始递增的第一个数 ; 格式类似 : 0001 或者 1000 

      ）</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td><input type="checkbox" name="cbitemno" value="1">

      商品编号：</td>

    <td><input name="itemno" type="text" id="tbNO" size="30" /> （

        <input name="istart" type="text" size="10" /> 

        该框必须填入 <span style="color:#FF0000; font-weight:bold">数字</span>,可留空 ; 开始递增的第一个数 ; 格式类似 : 0001 或者 1000 

      ）</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  class=""   bgcolor="#FFFFFF">

     <td><input type="checkbox" name="cbstore" value="1"> 材料：</td>

     <td><input name="store" type="text"  size="30" /></td>

   </tr>

  

  <tr bgcolor="#FFFFFF" >

    <td valign="top"><input type="checkbox" name="cbprice1" value="1">

      购买价格：</td>

    <td> <?=getCoinChar($config,0)?> <input name="price1" type="text" id="price1" size="40"  /> <span style="color:#CC0000">支持公式计算<br>

	1.  留空则不修改<br>

	2.  输入数字则统一修改为 该数字<br>

	3.  输入 @price1 + 3  , 则所有商品在各自价格都加上 3 <br>

	4.  输入 @price1 - 3  , 则所有商品在各自价格都减去 3 <br>

	5.  输入 @price1 * 0.9  , 则所有商品在各自价格上都乘以0.9</span></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td><input type="checkbox" name="cbprice2" value="1">

      市场价格：</td>

    <td> <?=getCoinChar($config,0)?> 

      <input name="price2" type="text" id="tbprice2"  onKeyUp="document.getElementById('pifaprice0').value=this.value" size="8" maxlength="8" /></td></tr>

  

    <tr   class="hide"    bgcolor="#FFFFFF"  >

      <td valign="top"><input type="checkbox" name="cbpifaprice" value="1">

      批发价格：</td>

      <td>

	 <div style="width:700px; padding:2px; line-height:30px; height:30px;">

	  <div style="width:400px">最小订购量:

	    <input name="minnum" type="text" value="0" onKeyUp="document.getElementById('pnumpre0').value=this.value" style="width:100px"  />

	    &nbsp;不需要将数量为0      </div>

	  </div><div style="background-color:#F2F4F6; border:1px #E3E6EB dotted; width:700px; padding-top:3px ">

	  <? 

	  $pnumpre=array();

	  $pnumpre[0] = 0 ;

	  for($index=0;$index<$cfg["product"]["pnum"];$index++)

	  {

	  ?>

	  <div id="pifadiv<?=$index?>" <? if($index>=1) { ?> class="hide" <? } ?> style="width:700px; padding:2px; line-height:30px; height:30px;">

	  <div style="float:left; width:120px"> ＞:

	    <input id="pnumpre<?=$index?>"   class="readonly"  readonly="" value="<?=$pnumpre[$index]?>" type="text" style="width:70px"   />

      </div>

	  <div style="float:left; width:120px"> ≤:

	    <input name="pifanum<?=$index?>" value="<?=$pifanum[$index]?>"   onKeyUp="changeNextValue(<?=$index+1?>,this)" type="text" style="width:70px; border:1px #CC0033 solid"   />

      </div>

	   

	  <div style="float:left;  ">折扣:  

        <input name="pifaprice<?=$index?>" id="pifaprice<?=$index?>" onKeyUp="changeLastPrice(this)" style="width:70px"   type="text" />

        % 备注： 

        <input name="pifaremark<?=$index?>" id="pifaremark<?=$index?>"  style="width:240px"   type="text" /></div> 

      </div>

	  <?

	  }

	  ?>

	  <div style="width:700px; padding:2px; line-height:30px; height:30px;">

	  <div style="float:left; width:120px">&nbsp;</div><div style="float:left; width:120px"><span class="impc">超过以上区间:</span></div>

	  <div style="float:left; ">折扣:   <input name="lastprice" id="lastprice" style="width:70px"  type="text"  value="0"  /> 

	  % 备注： 

	    <input name="lastremark" id="lastremark"  style="width:240px"   type="text" /></div>

	

      </div></div></td>

    </tr>

    <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">

    <td><input type="checkbox" name="cbdisp" value="1">

      显示类型：</td>

    <td>

		 <?

    $sql = "select * from @@@productdisp order by value asc";

	$d_rs = query($sql);

	while($d_rows=fetch($d_rs))

	{

	?>

    <input name='disp[]' type='checkbox' value='<?=$d_rows["value"]?>' /> <?=$d_rows["name"]?>

    <?

	}

	?>	</td>

  </tr>

    <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">

    <td><input type="checkbox" name="cbshowicon" value="1">显示小图标：</td>

    <td> 

      <input type="radio" name="showicon" value="0" checked="checked" />no

      <input type="radio" name="showicon" value="1" />Hot

      <input type="radio" name="showicon" value="2" />New

      <script language="javascript">

	 EnterRadio("showicon","<?=$rows["showicon"]?>")

	 </script>

    </td>

  </tr>

      

      

  <tr class="hide"  bgcolor="#FFFFFF">

      <td valign="top"><input type="checkbox" name="cbsizechartid" value="checkbox"> Size Chart：</td>

      <td><select id="sizechartid" name="sizechartid" style="width:200px" >

      <option value="0">请选择Size Chart</option>

		<?

		$sql="select id as v,name as k from @@@infoclass where father=102";

		writeSelect($sql);

		?>

        </select></td>

    </tr>

    <tr   bgcolor="#FFFFFF">

    <td valign="top"><input type="checkbox" name="cbproperty" value="checkbox">

      商品属性：</td>

    <td>

	<table width="572" border="0" cellpadding="1" cellspacing="1">

      <tr>

        <td width="159">选择属性模板</td>

        <td width="406">

		

		<select id="sltProperty" name="propertyid"  onChange="fetch_Property_Div(this.id,0)" >

		<?

		$sql="select id as v,name as k from @@@propertyclass where level=1 order by sort asc";

		writeSelect($sql);

		?>

        </select>  

		<script>

			fetch_Property_Div("sltProperty",0);

		</script></td>

      </tr>

    </table>

	<div id="propertyDiv"></div></td>

  </tr>

  

    <tr   bgcolor="#FFFFFF">

    <td><input type="checkbox" name="cbweight" value="1">

      商品重量：</td>

    <td> <input name="weight" type="text" value="" size="8" maxlength="8" /> KG</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  class=""  bgcolor="#FFFFFF">

    <td><input type="checkbox" name="cbfreeshipping" value="1"> 运费设置：</td>

    <td>

     <input type="radio" checked="checked" name="freeshipping" value="0">

     需要运费

     <input type="radio" name="freeshipping" value="1">

     免运费</td>

  </tr>

  <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF"  class="hide">

      <td><input type="checkbox" name="cbsort" value="1">

      商品排序：</td>

      <td><input name="sort" type="text" id="tbsort" /></td>

    </tr>

 <tr   class="hide"  bgcolor="#FFFFFF">

    <td><input type="checkbox" name="cbbrandid" value="1">

      选择品牌：</td>

    <td>更新该字段

   <? classbrandRelation($broot,8,"@@@brandclass"); ?></td>

  </tr>

   <tr class="hide" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td><input type="checkbox" disabled="disabled" name="checkbox13" value="checkbox">

      当前品牌：</td>

    <td><input id="brandname"  style="width:250px" type="text" readonly="" value="<?=fetchValue("select name as v from @@@brandclass where id=$broot","分类已被删除")?>" />

      <input name="brandid" type="hidden" id="brandid" value="<?=$broot?>" /></td>

  </tr>

  

<tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">

    <td><input type="checkbox" name="cbstock" value="1">

      商品数量：</td>

    <td><input name="stock" type="text" id="tbStock" size="4" /></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top"><input type="checkbox" name="cbhits" value="1">

      商品点击数：</td>

    <td><input name="hits" type="text"   value="" size="4" /></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td valign="top"><input type="checkbox" name="cbtag" value="1"> Tag标签：</td>

    <td><input name="tag" type="text" id="tag"   size="80" />

    用英文 , 隔开且不含有特殊字符 </td>

  </tr><tr   bgcolor="#FFFFFF"  class="hide">

    <td valign="top">&nbsp;</td>

    <td><div style="width:700px"><script language="javascript">

	 function checkcss(obj)

	 {

	 	$('#tag').val(getCheckBoxValue('cbtagname[]'));

		if(obj.checked)

			$(obj).parent().addClass("oncheck");

		else

			$(obj).parent().removeClass("oncheck");

	 }

	</script>

         <?

	$sql="select * from @@@ptaglist where type=0";

	$rs=query($sql);

	$tag_type[-1] = array("name"=>"未分配","type"=>-1);

	while($trows=fetch($rs))

	{

		$tag_type[$trows["id"]] = $trows; 

	}

	

   foreach ($tag_type as $key => $value)

	{

		$sql="select * from @@@ptaglist where type=" . $key ;

		$rs = query($sql);

	?>

    <div style="font-size:14px; font-weight:bold">标签类型: <?=$value["name"]?></div>

    <div>

    <?

    	while($trows=fetch($rs))

		{

	?>

    	<div class="countryspan"><input  onClick="checkcss(this)" name="cbtagname[]" type="checkbox" value="<?=$trows["name"]?>"> <?=$trows["name"]?></div>

    <?

		}

	?>

    </div><div class="clear"></div>

    <?

	}

	?>

    <script language="javascript">

	EnterCheckBox("cbtagname[]","<?=join(',',$arrtag)?>");

	</script>

   </div> </td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top"><input type="checkbox" name="cbtitle" value="1">

      SEO(标题Title)：</td>

    <td><textarea name="title" style="width:700px; height:70px" id="title"></textarea>

      <br />

      (商品页的标题,适当使用关键字,建议40-60英文之间)</td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top"><input type="checkbox" name="cbkeywords" value="1">

      SEO(关键字Keywords)：</td>

    <td><textarea name="keywords" style="width:700px; height:70px" id="keywords"></textarea>

      <br />

(商品的关键字,重点突出若干个相关关键字，避免使用不相关的，不超过20个)</td>

  </tr><tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="">

    <td valign="top"><input type="checkbox" name="cbdescript" value="1">

      SEO(描述Descript)：</td>

    <td><textarea name="descript" style="width:700px; height:70px" ></textarea>

      <br />

      (简要的描述商品介绍,适当使用关键字造句(避免过度频繁使用),建议250英文之内)</td>

  </tr>

  <tr    bgcolor="#FFFFFF">

    <td valign="top"><input type="checkbox" name="cbcontent" value="1">

      商品说明：</td>

    <td>

	<?

		$oFCKeditor = $glo["fck"] ;

		$oFCKeditor->Value = '' ;

		$oFCKeditor->Create() ;

		?>	</td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide">

      <td><input type="checkbox" disabled="disabled" name="checkbox20" value="checkbox">

      是否更新：</td>

      <td><input type="radio" value="1" name="tupdate"  />

        是

          <input type="radio" value="" checked="checked"  name="tupdate"  />

          否</td>

    </tr>

 <tr    bgcolor="#FFFFE9">

    <td>&nbsp;</td>

    <td><input type="submit"  class="button"  name="Submit5" value="修改所选择的<?=$num?>个产品"  onClick="showtips(this)"/></td>

  </tr>

</table>



</form>

<?

}

?>



<?

function delete_save()

{

	$id=getQuerySQL("id");

	$param["state"]="@state*-1";

	$condition=" where id=$id";

	$sql=updateSQL($param,"@@@product",$condition);

	query($sql);

	pageRedirect("2","a_product.php");

}



function p_add_save()

{

	global $cfg;

	global $proot;

	global $broot;

	

	if(getQuery("picdata")!="")

	{

		$pic = array();

		$startpic =  getForm("startpic") ; 

		$endpic =  getForm("endpic") ; 

		for($index=0;$index <= $endpic - $startpic ; $index++)

		{

			if( substr(getForm("folder"),-1)!="/")

				$strfolder = getForm("folder") . "/" ;

			else

				$strfolder = getForm("folder") ;

			$pic[$index] = $strfolder  . getForm("picname") . str_pad((int)$startpic+$index,strlen($startpic),0,STR_PAD_LEFT) . getForm("ext") ;

			

		}

	}

	else

		$pic=split('\|',getForm("pic"));

	//--  词库功能

	$arr_words = array();

	$arr_replace_keyid = array();

	if(preg_match_all("/{([0-9]*)}/",getFormUntrim("name"),$arrmatches))

	{

		$temp_replace_id = $arrmatches[1] ;

		$arr_replace_keyid = $arrmatches[0] ;

		for($index=0;$index<count($temp_replace_id);$index++)

		{

			$strcontent = fetchValue("select content as v from @@@replacewords where id=" . $temp_replace_id[$index],"");

			$arr_words[$temp_replace_id[$index]] =  split(',',$strcontent);

		}

	}

	for($index=0;$index<count($pic);$index++)

	{

		$param=array();

		if( getForm("nstart")!=""  )

		{

			$strid=getForm("nstart");

			$strname = str_pad((int)$strid+$index,strlen($strid),0,STR_PAD_LEFT);

		}

		if( getForm("istart")!=""  )

		{

			$strid=getForm("istart");

			$stritemno = str_pad((int)$strid+$index,strlen($strid),0,STR_PAD_LEFT);

		}

		

		$arrcontent=split( '\^',$pic[$index] );

		$tempname= explode("." , $arrcontent[1]);

		$param["pic"]=trim(clear_php_bom($arrcontent[0]));

		if( getForm("type")=="" )

		{

			$strreplacename = getFormUntrim("name") ;

			if( count($temp_replace_id)!=0 )

			{

				$arr_replace_name = array();

				for($indexj=0;$indexj<count($temp_replace_id);$indexj++)

				{

					

					$tmpcontentid  = array_rand($arr_words[$temp_replace_id[$indexj]],1) ;

					$arr_replace_name[$indexj] = $arr_words[$temp_replace_id[$indexj]][$tmpcontentid] ;

				}

				$strreplacename = str_replace($arr_replace_keyid,$arr_replace_name,getFormUntrim("name"));

			}

			$param["name"]= $strreplacename . $strname ;

			//debug($arr_replace_name);

		}

		else

		{

			$param["name"]=trim(clear_php_bom($tempname[0]));

		}

		if( getForm("itemnotype")=="0" )

		{

			$param["itemno"]=getFormUntrim("itemno") . $stritemno ;

		}

		elseif( getForm("itemnotype")=="1" )

		{

			$param["itemno"]=trim(clear_php_bom($tempname[0]));

		}

		$param["hits"]=getFormInt("hits",1);

		$param["stock"]=getFormInt("stock",1);

		$param["disp"] = strtoint( getForm("disp") );

		$param["classid"]=getFormInt("classid",$proot);

		$param["brandid"]=getFormInt("brandid",$broot);

		$param["propertyid"]=getFormInt("propertyid",0);

		$param["sizechartid"]=getFormInt("sizechartid",0);

		$param["minnum"]=getFormInt("minnum",0);

		$param["disp"]=strtoint( getForm("disp") );

		$param["showicon"]=getFormInt("showicon",0);

		$arrprice=array();

		$arrnum=array();

		$arrremark=array();

		for($indexI=0;$indexI<50;$indexI++)

		{

			$arrprice[$indexI]=getForm("pifaprice$indexI");

			$arrnum[$indexI]=getForm("pifanum$indexI");

			$arrremark[$indexI]=getForm("pifaremark$indexI");

		}

		

		$arrpkey=array();

		$arrpvalue=array();

		for($indexI=1;$indexI<=getFormInt("pnum",0);$indexI++)

		{

			$arrpkey[$indexI-1]=getForm("pkey$indexI");

			$arrpkey[$indexI-1]=getForm("pkey$indexI").":".getFormStr("pvalue$indexI");

			$arrpvalue[$indexI-1]=getFormStr("pvalue$indexI");

		}

		$param["pkey"]=join( $cfg["split"] , $arrpkey ) ;

		$param["pvalue"]=join( $cfg["split"] , $arrpvalue ) ;

		

		$arrckey=array();

		$arrcvalue=array();

		$arrctype=array();

		$arrcprice=array();

		for($indexI=1;$indexI<=(int)getFormInt("cnum",0);$indexI++)

		{

			$arrckey[$indexI-1]=getForm("ckey$indexI");

			$arrcvalue[$indexI-1]=getFormStr("cvalue$indexI");

			$arrctype[$indexI-1]=getForm("ctype$indexI");

			$arrcprice[$indexI-1]=getForm("cprice$indexI");

		}

		$param["ckey"]=join( $cfg["split"] , $arrckey ) ;

		$param["cvalue"]=join( $cfg["split"] , $arrcvalue ) ;

		$param["ctype"]=join( $cfg["split"] , $arrctype ) ;

		$param["cprice"]=join( $cfg["split"] , $arrcprice ) ;

		

		$param["pprice"]=join( $cfg["split"] , $arrprice ) ;

		$param["pnum"]=join( $cfg["split"] , $arrnum ) ;

		$param["premark"]=join( $cfg["split"] , $arrremark ) ;

		$param["lastremark"]=getForm("lastremark");

		

		$param["price1"]=getFormInt("price1",0,false);

		$param["price2"]=getFormInt("price2",0,false);

		$param["lastprice"]=getFormInt("lastprice",0,false);

		$param["weight"]=getFormInt("weight",0,false);

		$param["freeshipping"]=getFormInt("freeshipping",0);

		$param["store"]=getForm("store");

		$param["content"]=getHTML("content");

		$param["title"]=getForm("title");

		$param["descript"]=getForm("descript");

		$param["keywords"]=getForm("keywords");

		

		$param["addtime"]=formatDateTime(time()+$index);

		$sql=insertSQL($param,"@@@product");

		query($sql);

		$param=array();

		$id = mysql_insert_id() ;

		$condition = "where id=" . $id;

		$param["sort"]="@id";

		$param["state"]="@id*50*(". getFormInt("pstate",1).")";

		if( getForm("itemnotype")=="2" )

			$param["itemno"]="@id";

		$sql=updateSQL($param,"@@@product",$condition);

		query($sql);

		

		$strtemp = "";

		if(getForm("cbpropertytotag")!="")

		{

			for($index=1;$index<=10;$index++)

			{

				$strtemp.= getFormStr("cvalue$index") . ",";	

			}

		}

		$arrinsert = split(',' , $strtemp . getForm("tag") );

		$arrinsert = array_unique($arrinsert);

		$arrinsert = array_filter($arrinsert);

		removeSplitEmpty($arrinsert);

		$arrinsert = array_map( "strtolower" , $arrinsert ) ;

		foreach ($arrinsert as $insertvalue)

		{

			if($insertvalue=="")

				continue ;

			$param =  array();

			$insertvalue = mysql_escape_string( $insertvalue ) ;

			$param["name"] =  $insertvalue ;

			$param["count"] =  "@count+1" ;

			$param["addtime"] = formatDateTime(time());

			$condition = "where name like '$insertvalue'";

			$sql=replaceSQL($param,"@@@ptaglist",$condition);

			query($sql);

			

			$tid =  fetchValue("select id as v from @@@ptaglist where name  like '$insertvalue'",0) ;

			$param =  array();

			$param["name"] =  $insertvalue ;

			$param["tid"] = $tid ;

			$param["pid"] = $id ;

			$sql=insertSQL($param,"@@@ptag");

			query($sql);

		}

		

	}

	pageRedirect("0","a_product.php");

}



function add_save()

{

	global $cfg;

	global $proot;

	global $broot;

	$param["name"]=getForm("name");

	

	$param["minnum"]=getFormInt("minnum",0);

	$param["hits"]=getFormInt("hits",1);

	$param["stock"]=getFormInt("stock",1);

	$param["disp"] = strtoint( getForm("disp") );

	$param["classid"]=getFormInt("classid",$proot);

	$param["brandid"]=getFormInt("brandid",$broot);

	$param["disp"]=strtoint( getForm("disp") );

		$param["showicon"]=getFormInt("showicon",0);

	$arrprice=array();

	$arrnum=array();

	$arrremark=array();

	for($indexI=0;$indexI<50;$indexI++)

	{

		$arrprice[$indexI]=getForm("pifaprice$indexI");

		$arrnum[$indexI]=getForm("pifanum$indexI");

		$arrremark[$indexI]=getForm("pifaremark$indexI");

	}

	

	$arrpkey=array();

	$arrpvalue=array();

	for($indexI=1;$indexI<=getFormInt("pnum",0);$indexI++)

	{

		//$arrpkey[$indexI-1]=getForm("pkey$indexI");

		$arrpkey[$indexI-1]=getForm("pkey$indexI").":".getFormStr("pvalue$indexI");

		$arrpvalue[$indexI-1]=getFormStr("pvalue$indexI");

	}

	$param["pkey"]=join( $cfg["split"] , $arrpkey ) ;

	$param["pvalue"]=join( $cfg["split"] , $arrpvalue ) ;

	

	$arrckey=array();

	$arrcvalue=array();

	$arrctype=array();

	$arrcprice=array();

	for($indexI=1;$indexI<=(int)getFormInt("cnum",0);$indexI++)

	{

		$arrckey[$indexI-1]=getForm("ckey$indexI");

		$arrcvalue[$indexI-1]=getFormStr("cvalue$indexI");

		$arrctype[$indexI-1]=getForm("ctype$indexI");

		$arrcprice[$indexI-1]=getForm("cprice$indexI");

	}

	$param["ckey"]=join( $cfg["split"] , $arrckey ) ;

	$param["cvalue"]=join( $cfg["split"] , $arrcvalue ) ;

	$param["ctype"]=join( $cfg["split"] , $arrctype ) ;

	$param["cprice"]=join( $cfg["split"] , $arrcprice ) ;

	

	$param["pprice"]=join( $cfg["split"] , $arrprice ) ;

	$param["pnum"]=join( $cfg["split"] , $arrnum ) ;

	$param["premark"]=join( $cfg["split"] , $arrremark ) ;

	$param["lastremark"]=getForm("lastremark");

	

	$param["price1"]=getFormInt("price1",0,false);

	$param["price2"]=getFormInt("price2",0,false);

	$param["lastprice"]=getFormInt("lastprice",0,false);

	$param["weight"]=getFormInt("weight",0,false);

	$param["freeshipping"]=getFormInt("freeshipping",0);

	$param["itemno"]=getForm("itemno");

	$param["store"]=getForm("store");

	$param["propertyid"]=getFormInt("propertyid",0);

	$param["sizechartid"]=getFormInt("sizechartid",0);

	$param["content"]=getHTML("content");

	$param["title"]=getForm("title");

	$param["descript"]=getForm("descript");

	$param["keywords"]=getForm("keywords");

	$param["pic"]=getForm("pic");

	$param["addtime"]=formatDateTime(time());

	$sql=insertSQL($param,"@@@product");

	query($sql);

	

	$newinsertid = mysql_insert_id() ;

	

	$param=array();

	$param["sort"]="@id";

	$param["state"]="@id*50*(". getFormInt("pstate",1).")";

	$id = mysql_insert_id();

	$condition = "where id=" . $id;

	

	$sql=updateSQL($param,"@@@product",$condition);

	query($sql);

	

	$strtemp = "";

	if(getForm("cbpropertytotag")!="")

	{

		for($index=1;$index<=10;$index++)

		{

			$strtemp.= getFormStr("cvalue$index") . ",";	

		}

	}

	$arrinsert = split(',' , $strtemp . getForm("tag") );

	$arrinsert = array_unique($arrinsert);

	$arrinsert = array_filter($arrinsert);

	removeSplitEmpty($arrinsert);

	$arrinsert = array_map( "strtolower" , $arrinsert ) ;

	foreach ($arrinsert as $insertvalue)

	{

		if($insertvalue=="")

			continue ;

		$param =  array();

		$insertvalue = mysql_escape_string( $insertvalue ) ;

		$param["name"] =  $insertvalue ;

		$param["count"] =  "@count+1" ;

		$param["addtime"] = formatDateTime(time());

		$condition = "where name like '$insertvalue'";

		$sql=replaceSQL($param,"@@@ptaglist",$condition);

		query($sql);

		

		$tid =  fetchValue("select id as v from @@@ptaglist where name  like '$insertvalue'",0) ;

		$param =  array();

		$param["name"] =  $insertvalue ;

		$param["tid"] = $tid ;

		$param["pid"] = $id ;

		$sql=insertSQL($param,"@@@ptag");

		query($sql);

	}

	

	if( getForm("otherpic")!="" )

	{

		$otherpic=split('\|',getForm("otherpic"));

		for($index=0;$index<count($otherpic);$index++)

		{

			$param=array();

			$param["pic"]=trim(clear_php_bom($otherpic[$index]));

			$param["cid"]=0;

			$param["pid"]=getFormInt("pid",$newinsertid);

			$param["type"]=0;

			$sql=insertSQL($param,"@@@otherimage");

			query($sql);

			$param=array();

			$param["sort"]="@id";

			$condition = "where id=" . mysql_insert_id();

			$sql=updateSQL($param,"@@@otherimage",$condition);

			query($sql);

		}

	}

	

	pageRedirect("0","a_product.php");

}



function edit_save()

{

	global $proot;

	global $broot;

	global $cfg;

	$id=getQuerySQL("id");

	

	//--  保存 url-item 

	

	$condition="where id=$id";

	$param["name"]=getForm("name");

	$param["sort"]=getFormInt("sort",1);

	$param["hits"]=getFormInt("hits",1);

	$param["stock"]=getFormInt("stock",1);

	$param["minnum"]=getFormInt("minnum",0);

	$param["store"]=getForm("store");

	$param["itemno"]=getForm("itemno");

	$param["disp"] = strtoint( getForm("disp") );

	$param["classid"]=getFormInt("classid",$proot);

	$param["propertyid"]=getFormInt("propertyid",0);

	$param["sizechartid"]=getFormInt("sizechartid",0);

	$param["brandid"]=getFormInt("brandid",$broot);

	$param["disp"]=strtoint( getForm("disp") );

		$param["showicon"]=getFormInt("showicon",0);

	$arrprice=array();

	$arrnum=array();

	$arrremark=array();

	for($indexI=0;$indexI<50;$indexI++)

	{

		$arrprice[$indexI]=getForm("pifaprice$indexI");

		$arrnum[$indexI]=getForm("pifanum$indexI");

		$arrremark[$indexI]=getForm("pifaremark$indexI");

	}

	$param["pprice"]=join( $cfg["split"] , $arrprice ) ;

	$param["pnum"]=join( $cfg["split"] , $arrnum ) ;

	$param["premark"]=join( $cfg["split"] , $arrremark ) ;

	$param["lastremark"]=getForm("lastremark");

	

	$arrpkey=array();

	$arrpvalue=array();

	for($indexI=1;$indexI<=(int)getFormInt("pnum",0);$indexI++)

	{

		//$arrpkey[$indexI-1]=getForm("pkey$indexI");

		$arrpkey[$indexI-1]=getForm("pkey$indexI").":".getFormStr("pvalue$indexI");

		$arrpvalue[$indexI-1]=getFormStr("pvalue$indexI");

	}

	$param["pkey"]=join( $cfg["split"] , $arrpkey ) ;

	$param["pvalue"]=join( $cfg["split"] , $arrpvalue ) ;

	

	$arrckey=array();

	$arrcvalue=array();

	$arrctype=array();

	$arrcprice=array();

	for($indexI=1;$indexI<=(int)getFormInt("cnum",0);$indexI++)

	{

		$arrckey[$indexI-1]=getForm("ckey$indexI");

		$arrcvalue[$indexI-1]=getFormStr("cvalue$indexI");

		$arrctype[$indexI-1]=getForm("ctype$indexI");

		$arrcprice[$indexI-1]=getForm("cprice$indexI");

	}

	$param["ckey"]=join( $cfg["split"] , $arrckey ) ;

	$param["cvalue"]=join( $cfg["split"] , $arrcvalue ) ;

	$param["ctype"]=join( $cfg["split"] , $arrctype ) ;

	$param["cprice"]=join( $cfg["split"] , $arrcprice ) ;

	

	$param["price1"]=getFormInt("price1",0,false);

	$param["price2"]=getFormInt("price2",0,false);

	$param["lastprice"]=getFormInt("lastprice",0,false);

	$param["weight"]=getFormInt("weight",0,false);

	

	$param["freeshipping"]=getFormInt("freeshipping",0);

	$param["content"]=getHTML("content");

	$param["title"]=getForm("title");

	$param["descript"]=getForm("descript");

	$param["keywords"]=getForm("keywords");

	

	$oldpic = fetchPic("@@@product",$id);

	if( $oldpic != getForm("pic") )

	{

		$arr=$cfg["deleteImage"];

		deleteImage( $oldpic , $arr , "../uploadImage/",IMAGE );

	}

	

	$param["pic"]=getForm("pic");

	if ( getForm("update") !="1" )

	{

		$param["addtime"]=formatDateTime(time());

	}

	$sql=updateSQL($param,"@@@product",$condition);

	query($sql);

	

	$sql="select * from @@@ptag where pid=" . $id;

  	$rs = query($sql);

  	$arroldtag = array();

	$arrnewtag = array();

  	while($rows = fetch($rs) )

  	{

  		 array_push( $arroldtag , $rows["name"]);

  	}

	//debug($arroldtag);

	

	$strtemp = "";

	if(getForm("cbpropertytotag")!="")

	{

		for($index=1;$index<=10;$index++)

		{

			$strtemp.= getFormStr("cvalue$index") . ",";	

		}

	}

	//debug($strtemp);

	$arrnewtag = split(',' , $strtemp . getForm("tag") );

	array_unique($arrnewtag);

	array_unique($arroldtag);

	array_remove_empty($arrnewtag);

	array_remove_empty($arroldtag);

	$arrdelete = array_diff( $arroldtag , $arrnewtag );

	$arrinsert = array_diff( $arrnewtag , $arroldtag );

	$arrdelete = array_unique($arrdelete);

	$arrinsert = array_unique($arrinsert);

	$arrdelete = array_filter($arrdelete);

	$arrinsert = array_filter($arrinsert);

	removeSplitEmpty($arrdelete);

	removeSplitEmpty($arrinsert);

	$arrdelete = array_map( "strtolower" , $arrdelete ) ;

	$arrinsert = array_map( "strtolower" , $arrinsert ) ;

	foreach ($arrinsert as $insertvalue)

	{

		if($insertvalue=="")

			continue ;

		$param =  array();

		$insertvalue = mysql_escape_string( $insertvalue ) ;

		$param["name"] =  $insertvalue ;

		$param["count"] =  "@count+1" ;

		$param["addtime"] = formatDateTime(time());

		$condition = "where name like '$insertvalue'";

		$sql=replaceSQL($param,"@@@ptaglist",$condition);

		query($sql);

		

		$tid =  fetchValue("select id as v from @@@ptaglist where name  like '$insertvalue'",0) ;

		$param =  array();

		$param["name"] =  $insertvalue ;

		$param["tid"] = $tid ;

		$param["pid"] = $id ;

		$sql=insertSQL($param,"@@@ptag");

		query($sql);

	}

	foreach ($arrdelete as $deletevalue)

	{

		$param =  array();

		$deletevalue = mysql_escape_string( $deletevalue ) ;

		$param["count"] =  "@count-1" ;

		$param["name"] =  $deletevalue ;

		$condition = "where name='$deletevalue'";

		$sql=updateSQL($param,"@@@ptaglist",$condition);

		query($sql);

		$condition = "where count<=0 and name like '$deletevalue'";

		deleteRecord("@@@ptaglist",$condition);

		

		$condition = "where pid=$id and name like '$deletevalue'";

		deleteRecord("@@@ptag",$condition);

	}

	pageRedirect("1",$_SERVER['HTTP_REFERER']);

}



function p_edit_save()

{

	$condition=$_POST["condition"];

	global $proot;

	global $broot;

	global $cfg;

	$sql=  "select id from @@@product " . $condition ;

	$rs = query($sql);

	$arrid = array();

	while($rows=fetch($rs))

	{

		$arrid[]=$rows["id"] ; 

	}

	free($rs);

	for($index=0;$index<count($arrid);$index++)

	{

		if( getForm("nstart")!=""  )

		{

			$strid=getForm("nstart");

			$strname = str_pad((int)$strid+$index,strlen($strid),0,STR_PAD_LEFT);

		}

		if( getForm("istart")!=""  )

		{

			$strid=getForm("istart");

			$stritemno = str_pad((int)$strid+$index,strlen($strid),0,STR_PAD_LEFT);

		}

		if( getForm("cbname")!="" )

			$param["name"]=getFormUntrim("name") . $strname;

		if( getForm("cbsort")!="" )

			$param["sort"]=getFormInt("sort",1);

		if( getForm("cbhits")!="" )

			$param["hits"]=getFormInt("hits",1);

		if( getForm("cbstock")!="" )

			$param["stock"]=getFormInt("stock",1);

		if( getForm("cbitemno")!="" )

			$param["itemno"]=getFormUntrim("itemno") . $stritemno;

		

		if( getForm("cbtitle")!="" )

			$param["title"]=getForm("title");

		if( getForm("cbdescript")!="" )

			$param["descript"]=getForm("descript");

		if( getForm("cbkeywords")!="" )

			$param["keywords"]=getForm("keywords");

		

		if( getForm("cbstore")!="" )

			$param["store"]=getForm("store");

			

			

		if( getForm("cbprice1")!="" )

			$param["price1"]=getForm("price1");

		if( getForm("cbprice2")!="" )

			$param["price2"]=getFormInt("price2",0,false);

		

		if( getForm("cbweight")!="" )

			$param["weight"]=getFormInt("weight",0,false);

		if( getForm("cbfreeshipping")!="" )

			$param["freeshipping"]=getFormInt("freeshipping",0);

		if( getForm("cbcontent")!="" )

			$param["content"]=getHTML("content");

		

		if( getForm("cbdisp")!="" )

			$param["disp"] = strtoint( getForm("disp") );

		if( getForm("cbclassid")!="" )

			$param["classid"]=getFormInt("classid",$proot);

		if( getForm("cbbrandid")!="" )

			$param["brandid"]=getFormInt("brandid",$broot);

		if( getForm("cbshowicon")!="" )

		   $param["showicon"]=getFormInt("showicon",0);

		

		if( getForm("cbpifaprice")!="" )

		{

			if( getForm("minnum")!="" )

				$param["minnum"]=getFormInt("minnum",0,false);

			if( getForm("lastprice")!="" )

				$param["lastprice"]=getFormInt("lastprice",0,false);

			$arrprice=array();

			$arrnum=array();

			$arrremark=array();

			for($indexI=0;$indexI<50;$indexI++)

			{

				$arrprice[$indexI]=getForm("pifaprice$indexI");

				$arrnum[$indexI]=getForm("pifanum$indexI");

				$arrremark[$indexI]=getForm("pifaremark$indexI");

			}

			$param["pprice"]=join( $cfg["split"] , $arrprice ) ;

			$param["pnum"]=join( $cfg["split"] , $arrnum ) ;

			$param["premark"]=join( $cfg["split"] , $arrremark ) ;

			$param["lastremark"]=getForm("lastremark");

		}

		if( getForm("cbproperty")!="" )

		{

			$arrpkey=array();

			$arrpvalue=array();

			for($indexI=1;$indexI<=getFormInt("pnum",0);$indexI++)

			{

				$arrpkey[$indexI-1]=getForm("pkey$indexI").":".getFormStr("pvalue$indexI");

				

				$arrpvalue[$indexI-1]=getFormStr("pvalue$indexI");

			}

			$param["pkey"]=join( $cfg["split"] , $arrpkey ) ;

			$param["pvalue"]=join( $cfg["split"] , $arrpvalue ) ;

	

			$arrckey=array();

			$arrcvalue=array();

			$arrctype=array();

			$arrcprice=array();

			for($indexI=1;$indexI<=getFormInt("cnum",0);$indexI++)

			{

				$arrckey[$indexI-1]=getForm("ckey$indexI");

				$arrcvalue[$indexI-1]=getFormStr("cvalue$indexI");

				$arrctype[$indexI-1]=getForm("ctype$indexI");

				$arrcprice[$indexI-1]=getForm("cprice$indexI");

			}

			$param["ckey"]=join( $cfg["split"] , $arrckey ) ;

			$param["cvalue"]=join( $cfg["split"] , $arrcvalue ) ;

			$param["ctype"]=join( $cfg["split"] , $arrctype ) ;

			$param["cprice"]=join( $cfg["split"] , $arrcprice ) ;

			if( getForm("propertyid")!="" )

				$param["propertyid"]=getFormInt("propertyid",0);

		}

		if( getForm("cbsizechartid")!="" )

			$param["sizechartid"]=getFormInt("sizechartid",0);

		

		if ( getForm("tupdate") !="" )

		{

			$param["addtime"]=formatDateTime(time());

		}

		$condition = "where id = " .  $arrid[$index]; 

		$sql=updateSQL($param,"@@@product",$condition);

		query($sql);

		if ( getForm("cbtag") !="" )

		{

			$id = $arrid[$index] ;

			$sql="select * from @@@ptag where pid=" . $id;

			$rs = query($sql);

			$arroldtag = array();

			$arrnewtag = array();

			while($rows = fetch($rs) )

			{

				 array_push( $arroldtag , $rows["name"]);

			}

			

			$strtemp = "";

			if(getForm("cbpropertytotag")!="")

			{

				for($index=1;$index<=10;$index++)

				{

					$strtemp.= getFormStr("cvalue$index") . ",";	

				}

			}

			$arrnewtag = split(',' , $strtemp . getForm("tag") );

			array_unique($arrnewtag);

			array_unique($arroldtag);

			$arrdelete = array_diff( $arroldtag , $arrnewtag );

			$arrinsert = array_diff( $arrnewtag , $arroldtag );

			$arrdelete = array_unique($arrdelete);

			$arrinsert = array_unique($arrinsert);

			$arrdelete = array_filter($arrdelete);

			$arrinsert = array_filter($arrinsert);

			removeSplitEmpty($arrdelete);

			removeSplitEmpty($arrinsert);

			$arrdelete = array_map( "strtolower" , $arrdelete ) ;

			$arrinsert = array_map( "strtolower" , $arrinsert ) ;

			

			foreach ($arrinsert as $insertvalue)

			{

				if($insertvalue=="")

				continue ;

				

				$insertvalue = mysql_escape_string( $insertvalue ) ;

				$param =  array();

				$param["name"] =  $insertvalue ;

				$param["count"] =  "@count+1" ;

				$param["addtime"] = formatDateTime(time());

				$condition = "where name like '$insertvalue'";

				$sql=replaceSQL($param,"@@@ptaglist",$condition);

				query($sql);

				

				$tid =  fetchValue("select id as v from @@@ptaglist where name  like '$insertvalue'",0) ;

				$param =  array();

				$param["name"] =  $insertvalue ;

				$param["tid"] = $tid ;

				$param["pid"] = $id ;

				$sql=insertSQL($param,"@@@ptag");

				query($sql);

			}

			foreach ($arrdelete as $deletevalue)

			{

				$param =  array();

				$deletevalue = mysql_escape_string( $deletevalue ) ;

				$param["count"] =  "@count-1" ;

				$param["name"] =  $deletevalue ;

				$condition = "where name='$deletevalue'";

				$sql=updateSQL($param,"@@@ptaglist",$condition);

				query($sql);

				$condition = "where count<=0 and name like '$deletevalue'";

				deleteRecord("@@@ptaglist",$condition);

				

				$condition = "where pid=$id and name like '$deletevalue'";

				deleteRecord("@@@ptag",$condition);

			}

		}

	}

	pageRedirect("1","a_product.php");

}



function editstate_save()

{

	global $proot;

	global $broot;

	global $cfg;

	$id=getQuerySQL("id");

	

	if( getFormInt("dispupdate",0)==1 )

	{

		$condition="where id=$id";

		$param=array();

		$param["addtime"]=formatDateTime(time());

		$sql=updateSQL($param,"@@@product",$condition);

	}

	

	$classstateupdate = getFormInt("classstateupdate",-2) ;

	if( $classstateupdate ==-1 )

	{

		$condition="where id=$id";

		$param=array();

		$param["state"]="@id*50";

		$sql=updateSQL($param,"@@@product",$condition);

		query($sql);

	}

	else if( $classstateupdate>=0 )

	{

		if( $classstateupdate==$proot )

		{

			$maxstate = fetchValue("select max(state) as v from `@@@product`",0);

		}

		else

		{

			$treeid = fetchValue("select tree as v from `@@@productclass` where id=".$classstateupdate,0);

			$maxstate = fetchValue("select max(state) as v from `@@@product` where classid in ($treeid)",0);

		}

			$condition="where id=$id";

			$param=array();

			$param["state"]=$maxstate+1;

			$sql=updateSQL($param,"@@@product",$condition);

			query($sql);

	}

	

	pageRedirect("1",($_SERVER['HTTP_REFERER']));

}



function p_delete_save($flag)

{

	if( $flag==0 )

	{

		$id=getRequestStr("cbid",0,0);

		$condition="where id in ($id)";

	}

	else

	{

		$condition=getForm("condition");

	}

	$param["state"]="@state*-1";

	$sql=updateSQL($param,"@@@product",$condition);

	query($sql);

	pageRedirect("2","a_product.php");

}

?>

<? require("php_bottom.php");?>

</body>

</html>

