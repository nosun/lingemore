<?php
require("php_admin_include.php");
isAuthorize($group[3]);

$tplid=getQuerySQL("tplid");
$sql="select * from `@@@expresstpl` where id=$tplid";
$rs=query($sql);
isItemNotExist($rs);
$tpl=fetch($rs);


$orderid=getQuerySQL("orderid");
$sql="select * from `@@@order` where id=$orderid";
$rs=query($sql);
isItemNotExist($rs);
$order=fetch($rs);
$itemno = $order["itemno"];

$order["address"]=explode($cfg["split"] ,$order["address"] );


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>打印订单</title>
<script type="text/javascript" src="JSFile/jquery.min.js"></script>
<script type="text/javascript" src="JSFile/jquery.dynamic3.ycomp.js"></script>
<script>
$(function(){
 $('.printinfo').draggable().resizable();
 $('.printinfo').hover(
   function(){$(this).css("border","2px solid #333");},
   function(){$(this).css("border","0px solid #333");}
 );
});
</script>
<style>
body{ font-size:12pt;font-family:Tahoma,Arial, Helvetica, sans-serif; padding:0px; margin:0px }
.printinfo{cursor:move;border:0px solid #333;}
</style>
</head>

<body onLoad="SetPrintSettings()" onbeforeprint="bodyOnBeforePrint();" onafterprint="bodyOnAfterPrint();">
<div style="position:absolute; width:794px; overflow:hidden;"><img id="template_img" style=" display:block" src="<?=getImageURL($tpl["pic"],-1,"systemImage/",0)?>"  /></div> 
<div class="printinfo" id="print_address" style="position:absolute; z-index:20; left: 479px; top: 176px; width: 295px; height: 56px;"><?="Street:{$order['address'][1]}    Location:{$order['address'][3]} {$order['address'][4]} {$order['address'][2]}"?></div>
<div class="printinfo" id="print_orderitem" style="position:absolute; z-index:20; left: 71px; top: 345px;"><?=$order["itemno"]?></div>
<div class="printinfo" id="print_country" style="position:absolute; z-index:20; left: 645px; top: 109px;"><?=$order["address"][5]?></div>
<div class="printinfo" id="print_address3" style="position:absolute; z-index:20; left: 511px; top: 245px;"><?=$order["address"][6]?></div>
<div class="printinfo" id="print_country" style="position:absolute; z-index:20; left: 645px; top: 109px;"><?=$order["address"][5]?></div>
<div style="position:absolute; top:600px">
<div style="display:none">
	<object id="secmgr" style="DISPLAY: none" codeBase="ScriptX/smsx.cab#VVersion=6,6,440,26" classid="clsid:5445be81-b796-11d2-b931-002018654e2e" viewastext> 
	<param name="GUID" value="{4a1e15be-bcef-4a1a-a6ad-f5985a23f4ca}">
	<param name="REVISION" value="0" >
	<param name="PerUser" value="true" > 
	</object> 
	
	<!-- MeadCo ScriptX Factory Component -->
	<object id="factory" classid="clsid:1663ed61-23eb-11d2-b92f-008048fdd814" codeBase="smsx.cab#VVersion=6,6,440,26" viewastext>
	</object>
</div>
<script> 
function bodyOnBeforePrint()
{
	tipsdiv.style.display="none";
	document.getElementById("template_img").style.display="none";
}

function bodyOnAfterPrint()
{
	tipsdiv.style.display="block";	
	document.getElementById("template_img").style.display="block";
}

function toPreview(){
//SetPrintSettings();
	if(factory.object)
		factory.printing.Preview();
	else
		alert("对不起!现在不支持!");
}  
      function   SetPrintSettings()   {   
			if(document.all.factory.printing!=null)   
			  {   
				//	alert(document.all.factory.printing);   
			  } else   
			  {     
			 //navigate("smsx.exe");   
			  return;   
			  } 

		  factory.printing.header = "" ;   
		  factory.printing.footer = "";   
		  factory.printing.portrait = true;   
		  factory.printing.leftMargin =0;   
		  factory.printing.topMargin =0;   
		  factory.printing.rightMargin =0;   
		  factory.printing.bottomMargin =0;   
　　} 
</script>
<div id="tipsdiv">
<input   type=button   value= "打印订单"   onclick= "toPreview()">   
<a href="ScriptX/ScriptXClientKit.rar" >下载控件安装</a></div>
</div>
</body>
</html>
