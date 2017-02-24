<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据导入</title>
</head>

<body>
<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">数据导入</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td><a href="a_data.php?action=p_ftp_add" class="red">分类文件夹上传</a></td>
  </tr>
</table><br />
<?php
isAuthorize($group[2]);
$action=getQuery("action");
$u1=new unlimClass("@@@productclass");
$proot=$u1->create("产品分类");
switch($action)
{
case "load_excel":
	load_excel();
	break;
case "excel":
	action_excel();
	break;
case "load_dir":
	load_dir();
	break;
case "p_ftp_add":
	p_ftp_add();
	break;
case "dir":
	action_dir();
	break;
case "p_ftp_save":
	p_ftp_save();
	break;
case "ftp":
	action_ftp();
	break;
default:
	p_ftp_add();
	break;
}
?>

<?
function action_excel()
{
global $proot;
$classid = getQueryInt("classid",$proot)
?> <table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >
      <p><span class="red">第一步</span> :
        整理一下EXCEL文档, 依次按照规范填写好各个参数。<br>
        <span class="red">第二步</span> :
      使用FTP软件(<a href="http://www.duote.com/soft/11584.html" target="_blank">FlashFXP点击下载</a>),将图片上传到FTP上的uploadImage/文件夹下。<br>
     <span class="red"> 第三步</span> : 将要导入的excel用FTP传到 FTP上的 root_excel/unloaded。<br>
     <span class="red"> 第四步</span> : 新建产品分类,并选中下面的分类<br>
      name,itemno,pic: 名称,产品编号,产品主图片<br>
price1,price2,weight: 购买价格,市场价格,产品重量<br>
title,keywords,descript,content: seo标题,seo关键字,seo描述,产品详细描述      <br>
otherpic: 产品的细节图片, 用英文的 , 逗号隔开 比如:  shoes/1.jpg,shoes/2.jpg 并上传到otherImage/下
<br>
        <span class="red"> 第五步</span> : 选择所有导入的EXCEL文档。<br>
    <span class="red"><strong>注意 : 已经导入的EXCEL 将会从 root_excel/unloaded 转移到 root_excel/loaded</strong></span></td>
  </tr>
</table><br>
<script language="javascript">
function CheckForm()
  { 
if(!CheckIsNull("form2","excelname","Excel文档")) return false;
}
</script>
<script language="javascript">

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



</script>
<form name="form2" method="post" onSubmit="return CheckForm()" action="?action=load_excel">
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6" class="a_title"><strong>Excel表格导入</strong></td>
  </tr>
 
  <tr   bgcolor="#FFFFFF">
    <td>Excel格式：</td>
    <td><a target="_blank" href="excelTemplate.xls">点击下载</a> ，产品数据格式请严格按照EXCEL格式里面来填写。</td>
  </tr>
 <tr   bgcolor="#FFFFFF">
    <td width="18%">选择分类：</td>
    <td width="82%"><? classRelation($classid,8,"@@@productclass"); ?></td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>选中分类：</td>
    <td><input id="classname" style="width:200px" type="text" readonly="" value="<?=fetchValue("select name as v from @@@productclass where id=$classid","分类已被删除")?>" />
      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>
  </tr>
  <tr   bgcolor="#FFFFFF">
    <td width="18%">选择Excel：</td>
    <td width="82%"><select name="excelname" id="excelname">
	 <option value="">请选择EXCEL文档</option>
	 <?
	 $dir="../root_excel/unloaded";
	 $redir=opendir($dir);
	 while($filename=readdir($redir))
	 {
		 if($filename!="." && $filename!="..")
		 {
	 ?>
       <option value="<?=$filename?>"><?=$filename?></option>
	  <?
	 	 }
	 }
	 ?></select>
    
    </td></tr>
   
	<tr bgcolor="#FFFFFF">
	  <td></td>
	  <td  >已经导入的EXCEL将移动到root_excel/loaded文件夹下</td>
    </tr>
	<tr bgcolor="#FFFFFF">
    <td></td>
    <td  ><input type="submit" name="Submit"   class="button"  value="确定Excel导入"></td>
  </tr>
</table>
</form>
<script>
function submit_onClick(formdel,strdo)
{
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
function p_ftp_add()
{
global $cfg;
global $glo;
$config=$glo["config"];
$u1=new unlimClass("@@@productclass");
$proot=$u1->create("产品分类");
$u2=new unlimClass("@@@brandclass");
$broot=$u2->create("品牌分类");
$classid = getQueryInt("classid",$proot);
?>
<script language="javascript">
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

</script><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >
      <span class="red">第一步</span> :
      整理电脑本地图片, 用分类名称做有文件夹名称,文件夹下放产品图片。<br>
       <span class="red">第二步</span> :
      使用FTP软件(<a href="http://www.duote.com/soft/11584.html" target="_blank">FlashFXP点击下载</a>),将本地文件夹上传到服务器上的root_products文件夹下!<br>
      <span class="red"> 第三步</span> : 如果FTP，<strong>上传完毕后</strong>,在进行如下操作<br>
<span class="red">请注意</span> : FTP目录或者产品图片名称不能带有 # $ @ ! &lt; &gt; ? \ / ( ) %等特殊字符
</td>
  </tr>
</table><br>

<form action="?action=p_ftp_save" method="post" enctype="application/x-www-form-urlencoded" id="formadd" name="formadd">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td  bgcolor="#F2F4F6" colspan="2"><strong>商品FTP大批量数据添加</strong><a target="_blank" href="http://open.35zh.com/download/download_p_ftp_import.rar" class="red weight"><img src="images/shipin.gif" hspace="4" align="absmiddle"> 强烈建议下载2分钟的视频教程</a></span></td>
    </tr>
  <tr   bgcolor="#FFFFFF">
    <td width="18%">选择FTP目录：</td>
    <td width="82%"><script language="javascript">
   function getSon(obj,td_id)
   { 
       if(obj.value=="")
	   {   
	      var td_n;
		  var i=td_id;
			 var td_n;
		  for(i=td_id;i<=8;i++)
         {
		   try{
			   td_n="td" + i;
			   document.getElementById(td_n).innerHTML="";
			}
			catch(e)
			{};
		 }
		   //alert(td_n)
	      var preselect=document.getElementById("select"+(td_id-2))
		  if(preselect==null) 
		     {
			     document.getElementById("folrderurl").value="";
				 document.getElementById("classname").value="没有选择目录";
			  }
		  else 
		      { document.getElementById("folrderurl").value=preselect.value;
			    document.getElementById("classname").value=preselect.options[preselect.selectedIndex].text;
				 $('#tbname').val($('#classname').val());
			   }
	    
		}
	   
	   else 
	  { 
	 
	      var td_n;
		 // alert(3);
		  for(i=td_id;i<=8;i++)
         {
		   try{
		   td_n="td" + i;
	       document.getElementById(td_n).innerHTML="";
		   }
		   catch(e){};
		 }
		 document.getElementById("folrderurl").value=obj.value;
		 document.getElementById("classname").value=obj.options[obj.selectedIndex].text
		 $('#tbname').val($('#classname').val());
		 if(td_id<=8)
		 {  
	        xmlhttp.open("POST","../service/serviceForgetFolderSon.php",true);
			//document.write("../service/serviceForgetFolderSon.php?folder="+ escape(obj.value));
			xmlhttp.setRequestHeader("CONTENT-TYPE","application/x-www-form-urlencoded");
	        xmlhttp.onreadystatechange=function(){dosomething(td_id)};
            xmlhttp.send("folder="+URLEncode(obj.value));
			
		  }
	   }
	}
	function dosomething(i)
	{
	    if(xmlhttp.readyState==4)
		   if(xmlhttp.status==200)
		      {   
				  var html=xmlhttp.responseText;
				 ///alert(html);
				  var td_n="td" + i;
		   		  var temp=document.getElementById(td_n);
	              document.getElementById(td_n).innerHTML=html;
		       }
}

function URLEncode (clearString) {
  var output = '';
  var x = 0;
  clearString = clearString.toString();
  var regex = /(^[a-zA-Z0-9_.]*)/;
  while (x < clearString.length) {
    var match = regex.exec(clearString.substr(x));
    if (match != null && match.length > 1 && match[1] != '') {
    	output += match[1];
      x += match[1].length;
    } else {
      if (clearString[x] == ' ')
        output += '+';
      else {
        var charCode = clearString.charCodeAt(x);
        var hexVal = charCode.toString(16);
        output += '%' + ( hexVal.length < 2 ? '0' : '' ) + hexVal.toUpperCase();
      }
      x++;
    }
  }
  return output;
}


</script><table border=0 cellspacing=0 cellpadding=0><tr><td  class='relativetable' id='td1'><select onchange='getSon(this,2)' name='select1' id='select1'><option value=''>请选择目录</option>
<?
$handle = opendir( ROOT . FOLDER . "root_products/" ); 
$filenum = 0 ;
while ( $file = readdir($handle) )
{ 
	$bdir = "../root_products/" .$file;
	if ($file <> '.' && $file <> '..' && is_dir($bdir)) 
	{ 
	?>
	<option value="<?=$file?>/"><?=$file?></option>
	<?
	}
}
	?>
</select></td><td  class='relativetable' id='td2'></td><td  class='relativetable' id='td3'></td><td  class='relativetable' id='td4'></td><td  class='relativetable' id='td5'></td><td  class='relativetable' id='td6'></td><td  class='relativetable' id='td7'></td><td  class='relativetable' id='td8'></td><td  class='relativetable' id='td9'></td></tr></table></td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>当前FTP目录：</td>
    <td><input id="classname" type="text" readonly="" style="width:250px" value="<?=fetchValue("select name as v from @@@productclass where id=$classid","分类已被删除")?>" />
      <input name="folrderurl" type="hidden" id="folrderurl" value="<?=$classid?>" /> </td>
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
  <tr id="tr_name" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td>&nbsp;</td>
    <td><input name="name" id="tbname" type="text" size="30" />
      （
        <input name="nstart" type="text" size="10" /> 
        该框必须填入 <span style="color:#FF0000; font-weight:bold">数字</span>,可留空 ; 开始递增的第一个数; 格式类似 : 0001 或者 10 
      ）</td>
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
        该框必须填入 <span style="color:#FF0000; font-weight:bold">数字</span>,可留空 ; 开始递增的第一个数; 格式类似 : 0001 或者 10
      ）</td>
  </tr>
  
   <tr onMouseMove="tr_onMouseOver(this)" class="hide" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
     <td>商品档口：</td>
     <td><input name="store" type="text"  size="30" /></td>
   </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
    <td>购买价格：</td>
    <td> <?=getCoinChar($config,0)?> <input name="price1"  onKeyUp="document.getElementById('pifaprice0').value=this.value" type="text"  value="0" size="8" maxlength="8" /></td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide">
    <td>市场价格：</td>
    <td> <?=getCoinChar($config,0)?>  <input name="price2" type="text" value="0" size="8" maxlength="8" /></td>
  </tr>
   <tr   class="hide"   bgcolor="#FFFFFF" >
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
        %&nbsp;备注： 
        <input name="pifaremark<?=$index?>" id="pifaremark<?=$index?>"  style="width:240px"   type="text" /></div> 
      </div>
	  <?
	  }
	  ?>
	  <div style="width:700px; padding:2px; line-height:30px; height:30px;">
	  <div style="float:left; width:120px">&nbsp;</div><div style="float:left; width:120px"><span class="impc">超过以上区间:</span></div>
	  <div style="float:left; "><span style="float:left;  ">折扣</span>:   <input name="lastprice" id="lastprice" style="width:70px"  type="text"  value="0"  />  %&nbsp;备注： <input name="lastremark" id="lastremark"  style="width:240px"   type="text" /></div>
      </div>
	  </div></td>
    </tr>
    <tr  onmousemove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)" bgcolor="#FFFFFF">
    <td>显示类型：</td>
    <td><? showDisp($cfg["product"]["disp"])?></td>
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
    <tr    class="hide"   bgcolor="#FFFFFF">
    <td>商品重量：</td>
    <td> <input name="weight" type="text" value="0" size="8" maxlength="8" /> KG</td>
  </tr>
  <tr onMouseMove="tr_onMouseOver(this)"  class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">
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
    <td><input id="brandname" type="text" readonly="" value="<?=fetchValue("select name as v from @@@brandclass where id=$broot","分类已被删除")?>" />
      <input name="brandid" type="hidden" id="brandid" value="<?=$brandid?>" /></td>
  </tr>
  
  
<tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
    <td>商品数量：</td>
    <td><input name="stock" type="text"   value="0" size="4" /></td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
    <td valign="top">商品点击数：</td>
    <td><input name="hits" type="text"   value="0" size="4" /></td>
  </tr> <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >
    <td valign="top">Tag标签：</td>
    <td><input name="tag" type="text"   size="60" />
      用英文 , 隔开 ！单个标签不含有特殊字符 </td>
  </tr><tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
    <td valign="top">SEO(标题Title)：</td>
    <td><textarea name="title"  style="width:700px; height:70px"  id="title"></textarea>
      <br />
      (商品页的标题,适当使用关键字,建议40-60英文之间)</td>
  </tr>
   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
    <td valign="top">SEO(关键字Keywords)：</td>
    <td><textarea name="keywords"  style="width:700px; height:70px"  id="keywords"></textarea>
      <br />
      (商品的关键字,重点突出若干个相关关键字，避免使用不相关的，不超过20个)</td>
  </tr><tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  class="hide">
    <td valign="top">SEO(描述Descript)：</td>
    <td><textarea name="descript"  style="width:700px; height:70px"  id="descript"></textarea>
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
  
  
 <tr  bgcolor="#FFFFE9">
    <td>&nbsp;</td>
    <td><input type="submit"  class="button"  onClick="showtips(this)"  value="提交" /></td>
 </tr>
</table>

</form>
<?
}
?>
<?
function action_dir()
{

?> 
<form name="form2" method="post" action="?action=load_dir">
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>文件夹数据导入(支持续传)---<span class="red weight">点击一下,轻松上传数万张图片</span></strong></td>
  </tr>
 
  <tr bgcolor="#FFFFFF">
    <td  >注意:在使用本功能之前,请整理产品的图片结构,上传到root_products , <span class="red"><strong>产品目录或者产品图片不区分大小写</strong></span><br>
      <span class="red">第一步</span>:
      整理电脑本地图片, 产品分类用文件夹建立(文件夹的名称为产品分类名),文件夹下放产品图片(图片名称为产品名称) ,若产品数量比较多,建议使用批量更名软件(<a href="http://www.greendown.cn/soft/11635.html" target="_blank">ACDSEE点击下载</a>)<br>
       <span class="red">第二步</span>:
      使用FTP软件(<a href="http://www.greendown.cn/soft/478.html" target="_blank">FlashFXP点击下载</a>),将本地文件夹上传到服务器上的root_products文件夹下!<br>
      <span class="red"> 第三步</span>: 如果FTP，<strong>上传完毕后</strong>,在进行如下操作<br>
      <br>
      <br>
      1.本地文件夹如果服务器没有,将自动建立分类,已经存在的分类将不会再建立<br>
      2.生成产品数据的时候，各文件夹的图片讲自动移到Uploadimage下,因为如果生成完毕后,服务器上root_products将只剩下一个分类的结构!
      <br>
      3.<strong>若中途网络断线,那么可以再次进行续传</strong>,已生成的数据,将不会再重复生成<br>
      4.强烈建议下载<a  href="http://ts.uio.cc/download/download_folder.rar" target="_blank"><span style="font-size:16px" class="red"><img src="images/shipin.gif" hspace="4" align="absmiddle">4分钟的视频教程(点击下载)</span></a><br>
	  5.最后点击下面确定文件夹导入
      <br>
	  6.若还需要对产品进行其他的数据库的修改,建议使用 <strong>批量修改</strong> 功能
</td>
  </tr>
   
	<tr bgcolor="#FFFFFF">
    <td  ><input type="submit" name="Submit"  class="button"  value="确定文件夹导入  / &nbsp; 产品图片续传"> <strong>(若产品图片比较多,那么生成数据库可能比较久,所以请耐心等待)</strong></td>
  </tr>
</table>
</form>
<script>
function submit_onClick(formdel,strdo)
{
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
function action_ftp()
{

?> 
<form name="form2" method="post" action="?action=load_excel">
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>ftp导入</strong></td>
  </tr>
 
  <tr bgcolor="#FFFFFF">
    <td  >&nbsp;</td>
  </tr>
   
	<tr bgcolor="#FFFFFF">
    <td  >&nbsp;</td>
  </tr>
</table>
</form>
<script>
function submit_onClick(formdel,strdo)
{
	document.getElementById("do").value=strdo;
	if(confirm("确定执行该操作吗?"))
	{
		document.forms[formdel].submit();
	}
}
</script>
<?
}
?><?
function load_dir()
{
?>
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>文件夹数据导入(支持续传)</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td  >
<?
	$pulim=new unlimClass("@@@productclass");
	$proot=$pulim->create("产品分类");
	$class=fetchAllClass("@@@productclass");
	//debug($class);
	set_time_limit(0);
	read_dir("root_products/",$proot,$pulim,1,$class);

?>
</td>
  </tr>
</table>
<?
}
?>
<?
function load_excel()
{
	set_time_limit(0);
	$excelname = getForm("excelname");
	if( $excelname=="" || !file_exists("../root_excel/unloaded/" . $excelname) )
	{
		die("Error");
	}
	require("../inc/PHPExcel.php");
	require("../inc/PHPExcel/Writer/Excel5.php");
	require("../inc/PHPExcel/IOFactory.php"); 
	$reader = PHPExcel_IOFactory::createReader('Excel5'); // 讀取 excel 檔案  
	$excel = $reader->load("../root_excel/unloaded/" . $excelname); // 檔案名稱 
	$sheet = $excel->getSheet(0);
	$row = $sheet->getHighestRow(); // 取得总行数  
	$col = $sheet->getHighestColumn(); // 取得总列数
	//$key = array( "classid" ,"name" , "pic" , "price1" , "content" ,  "title",  "keywords","descript") ;
	$value = array();
	for ($index = 2; $index <= $row; $index++) 
	{  
   		$param=array();
		$param["classid"] = getFormInt("classid",0); 
		$param["name"] = $sheet->getCellByColumnAndRow( 0 , $index)->getValue(); 
		$param["itemno"] = $sheet->getCellByColumnAndRow( 1 , $index)->getValue(); 
		$param["pic"] = $sheet->getCellByColumnAndRow( 2 , $index)->getValue(); 
		$param["price1"] = DataFormatInt($sheet->getCellByColumnAndRow( 3 , $index)->getValue(),0,false); 
		$param["price2"] = DataFormatInt($sheet->getCellByColumnAndRow( 4 , $index)->getValue(),0,false); 
		$param["weight"] = DataFormatInt($sheet->getCellByColumnAndRow( 5 , $index)->getValue(),0,false); 
		$param["content"] = nl2br( $sheet->getCellByColumnAndRow( 6 , $index)->getValue() ); 
		$param["title"] = $sheet->getCellByColumnAndRow( 7 , $index)->getValue();
		$param["keywords"] = $sheet->getCellByColumnAndRow(8 , $index)->getValue(); 
		$param["descript"] = $sheet->getCellByColumnAndRow( 9 , $index)->getValue(); 
		$sql=insertSQL($param,"@@@product");
		query($sql);
		$pid = mysql_insert_id();
		$param=array();
		$param["sort"]="@id";
		$param["state"]="@id";
		$condition = "where id=" . $pid;
		$sql=updateSQL($param,"@@@product",$condition);
		query($sql);
		
		$otherpic = $sheet->getCellByColumnAndRow( 10 , $index)->getValue() ;
		if(trim($otherpic)!="")
		{
			$arrpic = split(',',$otherpic);
			for ($indexj = 0; $indexj <count($arrpic); $indexj++)
			{
				$param=array();
				$param["cid"] = 0;
				$param["pid"] = $pid;
				$param["pic"] = $arrpic[$indexj];
				$sql=insertSQL($param,"@@@otherimage");
				query($sql);
			}
		}
    }   
	copy("../root_excel/unloaded/" . $excelname,"../root_excel/loaded/" . $excelname);
	unlink("../root_excel/unloaded/" . $excelname);
	pageRedirect("0","a_product.php");
}



//--------------
function p_ftp_save()
{
	global $cfg;
	$folder = getForm("folrderurl") ;
	if($folder!="")
	{
		$handle = opendir( ROOT . FOLDER . "root_products/" . $folder ); 
		while ( $file = readdir($handle) )
		{ 
			if ($file != '.' && $file != '..' ) 
			{ 
				$bdir = "../root_products/" . $folder  .$file . "/" ;
				if( !is_dir($bdir) )
					$pic[] = $folder.$file . "^" . $file ;
			}
		}
	}
	else
		AlertRedirect("没有选择目录","a_data.php");
	$class=fetchAllClass("@@@productclass");
	$u1=new unlimClass("@@@productclass");
	$proot=$u1->create("产品分类");
	$u2=new unlimClass("@@@brandclass");
	$broot=$u2->create("品牌分类");
	$arrfolder = explode('/',$folder);
	$tempfolderurl = "";
	$arrclass=fetchAllClass("@@@productclass");
	$classid = $proot;
	$tempfolderurl = "";
	for($index=0;$index<count($arrfolder)-1;$index++)
	{
		$filenow = $arrfolder[$index] ;
		$sql = "select id from @@@productclass where  name like '" . filterSQL(strtolower($filenow)) . "'";
		$rs = query($sql) ;  
		$tempfolderurl .= $filenow . "/" ;
		$newid = 0 ;
		while($rows=fetch($rs))
		{
			$arrurl = split(',',$arrclass[$rows["id"]]["url"] );	
			$strurlname = "";
			for($indexj=1;$indexj<count($arrurl);$indexj++)
			{
				$strurlname .= $arrclass[$arrurl[$indexj]]["name"] . "/" ;
			}
			//debug($strurlname);
			if( strtolower($tempfolderurl) == strtolower($strurlname) )
			{
				$newid = $rows["id"] ;
				$classid = $newid ;
			}
		}
		if( $newid == 0 )
		{
			$classid = $u1->add($classid,$filenow,$index*10,1,"","");
		}
	}
	//debug($classid);
	sort($pic);
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
			$param["name"]=getFormUntrim("name") . $strname ;
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
		$param["classid"]=$classid;
		$param["brandid"]=getFormInt("brandid",$broot);
		$param["propertyid"]=getFormInt("propertyid",0);
		$param["minnum"]=getFormInt("minnum",0);
		$param["disp"]=strtoint( getForm("disp") );
		$arrprice=array();
		$arrnum=array();
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
		$param["store"]=getForm("store");
		$param["price1"]=getFormInt("price1",0,false);
		$param["price2"]=getFormInt("price2",0,false);
		$param["lastprice"]=getFormInt("lastprice",0,false);
		$param["weight"]=getFormInt("weight",0,false);
		$param["freeshipping"]=getFormInt("freeshipping");
		$param["content"]=getHTML("content");
		$param["title"]=getForm("title");
		$param["descript"]=getForm("descript");
		$param["keywords"]=getForm("keywords");
		$param["addtime"]=formatDateTime(time()+$index);
		$sql=insertSQL($param,"@@@product");
		query($sql);
		//debug($sql);
		$param=array();
		$id = mysql_insert_id() ;
		$condition = "where id=" . $id;
		$param["sort"]="@id";
		$param["state"]="@id";
		if( getForm("itemnotype")=="2" )
			$param["itemno"]="@id";
		$sql=updateSQL($param,"@@@product",$condition);
		query($sql);
		$source = ROOT . FOLDER . "root_products/"  . $arrcontent[0] ;
		$tofile = ROOT . FOLDER . "uploadImage/"  . $arrcontent[0] ;
		if( !file_exists(ROOT . FOLDER . "uploadImage/" . $folder) )
		{
			makedir(ROOT . FOLDER . "uploadImage/" . $folder);
		}
		copy( $source , $tofile);
		unlink($source);
		
	}
	//removeDir( ROOT . FOLDER . "root_products/" . $folder );
	pageRedirect("0","a_data.php");
}


function read_dir($directory,$id,$class,$level,$arrclass)
{ 
	static $tzIndex=1;
	$handle = opendir( ROOT . FOLDER . $directory ); 
	$tmpdir = array();
	$filenum = 0 ;
	while ( $file = readdir($handle) )
	{ 
		$bdir = "../" . $directory . '' .$file;
		if ($file <> '.' && $file <> '..' && is_dir($bdir)) 
		{ 
			
			ob_flush();
			$tmpdir[] = $file ;
		} 
		else if( $file <> '.' && $file <> '..') 
		{ 
			$tzIndex++;
			$source = ROOT . FOLDER . $directory . '' . $file ;
			$path_parts = pathinfo( $source );
			$ext = $path_parts["extension"] ;
			$productname = basename ($source,"." . $ext); 
			$filename = getRandomname() . $tzIndex . "." . $ext ;
			$filename = $path_parts["basename"] ;
			$todir = ROOT . FOLDER . 'uploadimage/' . str_replace("root_products/","",$directory)  ;
			if( !file_exists($todir) )
			{
				makedir($todir);
			}
			
			$param=array();
			$param["name"] = $productname ;
			$param["classid"] = $id ;
			$param["pic"] =str_replace("root_products/","",$directory) . $filename ;
			//copy( $source , $todir . $filename );
			//unlink($source);
			rename($source,$todir . $filename);
			$sql=insertSQL($param,"@@@product");
			query($sql);
			$param=array();
			$param["sort"]="@id";
			$param["state"]="@id";
			$condition = "where id=" . mysql_insert_id();
			$sql=updateSQL($param,"@@@product",$condition);
			query($sql);
			$filenum++ ;
			
		} 
	}
	if( $filenum!=0 )
	{
		echo " 成功的添加了 " . $arrclass[$id]["name"] . "  <Span class='weight red'>" . $filenum . "</span> 件商品!<br>";
	}
	ob_flush();
	for($index=0;$index<count($tmpdir);$index++)
	{
		$filenow = $tmpdir[$index] ;
		$sql = "select id from @@@productclass where  name like '" . filterSQL(strtolower($filenow)) . "'";
		$rs = query($sql) ;  
		$strfolder = str_replace("root_products/","",$directory) . $filenow . '/' ;
		$newid = 0;
		while($rows=fetch($rs))
		{
			//$newid = 0;
			$arrurl = split(',',$arrclass[$rows["id"]]["url"] );
			
			$strurlname = "";
			for($indexj=1;$indexj<count($arrurl);$indexj++)
			{
				$strurlname .= $arrclass[$arrurl[$indexj]]["name"] . "/" ;
			}
			//debug($strurlname);
			//echo strtolower($strfolder) . "444" . strtolower($strurlname) . "<br>";
			if( strtolower($strfolder) == strtolower($strurlname) )
			{
				$newid = $rows["id"] ;
				break;
			}
		}
		if($newid== 0 )
		{
			echo "<br /> " . str_repeat("----" , $level ) . "成功创建了分类 ".$filenow;
			$newid = $class->add($id,$filenow,$index*10,1,"","");
		}
		
		read_dir( $directory . $filenow . '/' , $newid ,$class , $level+1,$arrclass);
	}
	closedir( $handle ); //关闭目录
}


?>
<? require("php_bottom.php");?>
</body>
</html>
