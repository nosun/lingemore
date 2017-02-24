<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>限制访问</title>
<style>
#payment_td img{ float:left}
.countryspan{ display:inline; width:240px; float:left; height:23px; margin-bottom:1px;  margin-right:1px; overflow:hidden; border:1px #FFFFFF dotted}
.oncheck{ border:1px #FEDF63 dotted; background-color:#FFFFE6}
.clear{ clear:both; font-size:0px; line-height:1px; height:1px}
</style>
</head>

<body>
<script language="javascript">
function changeImage(path)
{
	document.getElementById("imgupload").src=path;
}
 function showPaymentAccount(obj)
	 {
	 //	document.getElementById("span_" + obj.value).style.display = "block";
		$("#payment_account span").css("display","none")
		$("#span_" + obj.value).css("display","inline-block");
	 }
	 
	 function checkcss(obj)
	 {
	 	if(obj.checked)
			$(obj).parent().addClass("oncheck");
		else
			$(obj).parent().removeClass("oncheck");
	 }
</script>
<?php require("php_top.php")?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">限制访问</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="?">限制访问</a></td>
  </tr>
</table><br /><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">
  <tr  bgcolor="#FFFFE6">
    <td >注意：当您没有选择任何国家的时候，将默认屏蔽 "中国大陆" 地区!</td>
  </tr>
</table><br>
<?php
isAuthorize($group[1]);
$action=getQuery("action");
switch($action)
{
case "edit_save":
	edit_save();
	break;
default:
	showItem("");
	break;
}
?>
<?
function showItem()
{
global $config ;
$cdnserver= "http://open.35zh.com";
?>
 <form name="formedit" action="?action=edit_save" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>亚洲的国家与地区</strong></td>
  </tr>


        <tr align="center" bgcolor="#FFFFFF">
      <td align="left">
	  <div style="margin-bottom:2px; margin-left:2px"><strong>华语地区</strong></div>
	  
	  	<div class="countryspan" title="China"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CN">  
	  	<img src="<?=$cdnserver?>/pic/country/CN.gif" align="absmiddle"/> China (中国大陆) </div>  	
	  	<div class="countryspan" title="Hong Kong"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="HK">  <img src="<?=$cdnserver?>/pic/country/HK.gif" align="absmiddle"/> Hong Kong </div> 	<div class="countryspan" title="Taiwan"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TW">  <img src="<?=$cdnserver?>/pic/country/TW.gif" align="absmiddle"/> Taiwan </div> 
	  	<div class="countryspan" title="Macao"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MO">  <img src="<?=$cdnserver?>/pic/country/MO.gif" align="absmiddle"/> Macao </div>
	  
	  	<div class="countryspan" title="Singapore"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SG">  <img src="<?=$cdnserver?>/pic/country/SG.gif" align="absmiddle"/> Singapore </div>
	  
	  	<div class="countryspan" title="Malaysia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MY">  <img src="<?=$cdnserver?>/pic/country/MY.gif" align="absmiddle"/> Malaysia </div>
	  
	  	<div class="countryspan" title="Philippines"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="PH">  <img src="<?=$cdnserver?>/pic/country/PH.gif" align="absmiddle"/> Philippines </div>
	  
	  <div class="countryspan" title="Indonesia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="ID">  <img src="<?=$cdnserver?>/pic/country/ID.gif" align="absmiddle"/> Indonesia </div>
	  <div class="clear" style=" border-bottom:1px #cccccc dotted"></div>
	  	<div class="countryspan" title="AFGHANISTAN"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AF">  <img src="<?=$cdnserver?>/pic/country/AF.gif" align="absmiddle"/> AFGHANISTAN </div>
	  
	  	<div class="countryspan" title="Armenia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AM">  <img src="<?=$cdnserver?>/pic/country/AM.gif" align="absmiddle"/> Armenia </div>
	  
	  	<div class="countryspan" title="Azerbaijan"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AZ">  <img src="<?=$cdnserver?>/pic/country/AZ.gif" align="absmiddle"/> Azerbaijan </div>
	  
	  	<div class="countryspan" title="Bahrain"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BH">  <img src="<?=$cdnserver?>/pic/country/BH.gif" align="absmiddle"/> Bahrain </div>
	  
	  	<div class="countryspan" title="Bangladesh"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BD">  <img src="<?=$cdnserver?>/pic/country/BD.gif" align="absmiddle"/> Bangladesh </div>
	  
	  	<div class="countryspan" title="Bhutan"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BT">  <img src="<?=$cdnserver?>/pic/country/BT.gif" align="absmiddle"/> Bhutan </div>
	  
	  	<div class="countryspan" title="Brunei Darussalam"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BN">  <img src="<?=$cdnserver?>/pic/country/BN.gif" align="absmiddle"/> Brunei Darussalam </div>
	  
	  	<div class="countryspan" title="Cambodia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="KH">  <img src="<?=$cdnserver?>/pic/country/KH.gif" align="absmiddle"/> Cambodia </div>
	  
	  
	  	<div class="countryspan" title="Cyprus"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CY">  <img src="<?=$cdnserver?>/pic/country/CY.gif" align="absmiddle"/> Cyprus </div>
	  
	  	<div class="countryspan" title="Georgia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GE">  <img src="<?=$cdnserver?>/pic/country/GE.gif" align="absmiddle"/> Georgia </div>
	  
	  
	  
	  	<div class="countryspan" title="India"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="IN">  <img src="<?=$cdnserver?>/pic/country/IN.gif" align="absmiddle"/> India </div>
	  
	  	
	  
	  	<div class="countryspan" title="Iran"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="IR">  <img src="<?=$cdnserver?>/pic/country/IR.gif" align="absmiddle"/> Iran </div>
	  
	  	<div class="countryspan" title="Iraq"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="IQ">  <img src="<?=$cdnserver?>/pic/country/IQ.gif" align="absmiddle"/> Iraq </div>
	  
	  	<div class="countryspan" title="Israel"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="IL">  <img src="<?=$cdnserver?>/pic/country/IL.gif" align="absmiddle"/> Israel </div>
	  
	  	<div class="countryspan" title="Japan"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="JP">  <img src="<?=$cdnserver?>/pic/country/JP.gif" align="absmiddle"/> Japan </div>
	  
	  	<div class="countryspan" title="Jordan"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="JO">  <img src="<?=$cdnserver?>/pic/country/JO.gif" align="absmiddle"/> Jordan </div>
	  
	  	<div class="countryspan" title="Kazakhstan"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="KZ">  <img src="<?=$cdnserver?>/pic/country/KZ.gif" align="absmiddle"/> Kazakhstan </div>
	  
	  	<div class="countryspan" title="Korea"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="KR">  <img src="<?=$cdnserver?>/pic/country/KR.gif" align="absmiddle"/> Korea </div>
	  
	  	<div class="countryspan" title="Kuwait"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="KW">  <img src="<?=$cdnserver?>/pic/country/KW.gif" align="absmiddle"/> Kuwait </div>
	  
	  	<div class="countryspan" title="Kyrgyzstan"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="KG">  <img src="<?=$cdnserver?>/pic/country/KG.gif" align="absmiddle"/> Kyrgyzstan </div>
	  
	  	<div class="countryspan" title="Lao People's Democratic Republic"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="LA">  <img src="<?=$cdnserver?>/pic/country/LA.gif" align="absmiddle"/> Lao People's Democratic Republic </div>
	  
	  	<div class="countryspan" title="Lebanon"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="LB">  <img src="<?=$cdnserver?>/pic/country/LB.gif" align="absmiddle"/> Lebanon </div>
	  
	  	<div class="countryspan" title="Libyan Arab Jamahiriya"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="LY">  <img src="<?=$cdnserver?>/pic/country/LY.gif" align="absmiddle"/> Libyan Arab Jamahiriya </div>
	  
	  
	  
	  
	  	<div class="countryspan" title="Maldives"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MV">  <img src="<?=$cdnserver?>/pic/country/MV.gif" align="absmiddle"/> Maldives </div>
	  
	  	<div class="countryspan" title="Mongolia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MN">  <img src="<?=$cdnserver?>/pic/country/MN.gif" align="absmiddle"/> Mongolia </div>
	  
	  	<div class="countryspan" title="Myanmar"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MM">  <img src="<?=$cdnserver?>/pic/country/MM.gif" align="absmiddle"/> Myanmar </div>
	  
	  	<div class="countryspan" title="Nepal"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="NP">  <img src="<?=$cdnserver?>/pic/country/NP.gif" align="absmiddle"/> Nepal </div>
	  
	  	<div class="countryspan" title="Oman"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="OM">  <img src="<?=$cdnserver?>/pic/country/OM.gif" align="absmiddle"/> Oman </div>
	  
	  	<div class="countryspan" title="Pakistan"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="PK">  <img src="<?=$cdnserver?>/pic/country/PK.gif" align="absmiddle"/> Pakistan </div>
	  
	  	<div class="countryspan" title="Palestinian Territory"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="PS">  <img src="<?=$cdnserver?>/pic/country/PS.gif" align="absmiddle"/> Palestinian Territory </div>
	  
	  
	  
	  	<div class="countryspan" title="Qatar"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="QA">  <img src="<?=$cdnserver?>/pic/country/QA.gif" align="absmiddle"/> Qatar </div>
	  
	  	<div class="countryspan" title="Saudi Arabia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SA">  <img src="<?=$cdnserver?>/pic/country/SA.gif" align="absmiddle"/> Saudi Arabia </div>
	  
	  
	  
	  	<div class="countryspan" title="Sri Lanka"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="LK">  <img src="<?=$cdnserver?>/pic/country/LK.gif" align="absmiddle"/> Sri Lanka </div>
	  
	  	<div class="countryspan" title="Syrian Arab Republic"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SY">  <img src="<?=$cdnserver?>/pic/country/SY.gif" align="absmiddle"/> Syrian Arab Republic </div>
	  
	  
	  
	  	<div class="countryspan" title="Tajikistan"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TJ">  <img src="<?=$cdnserver?>/pic/country/TJ.gif" align="absmiddle"/> Tajikistan </div>
	  
	  	<div class="countryspan" title="Thailand"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TH">  <img src="<?=$cdnserver?>/pic/country/TH.gif" align="absmiddle"/> Thailand </div>
	  
	  	<div class="countryspan" title="Turkey"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TR">  <img src="<?=$cdnserver?>/pic/country/TR.gif" align="absmiddle"/> Turkey </div>
	  
	  	<div class="countryspan" title="Turkmenistan"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TM">  <img src="<?=$cdnserver?>/pic/country/TM.gif" align="absmiddle"/> Turkmenistan </div>
	  
	  	<div class="countryspan" title="United Arab Emirates"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AE">  <img src="<?=$cdnserver?>/pic/country/AE.gif" align="absmiddle"/> United Arab Emirates </div>
	  
	  	<div class="countryspan" title="Uzbekistan"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="UZ">  <img src="<?=$cdnserver?>/pic/country/UZ.gif" align="absmiddle"/> Uzbekistan </div>
	  
	  	<div class="countryspan" title="Viet Nam"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="VN">  <img src="<?=$cdnserver?>/pic/country/VN.gif" align="absmiddle"/> Viet Nam </div>
	  
	  	<div class="countryspan" title="Yemen"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="YE">  <img src="<?=$cdnserver?>/pic/country/YE.gif" align="absmiddle"/> Yemen </div>
	  
	  	  </td> 
  </tr>
</table>



 
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>欧洲的国家与地区</strong></td>
  </tr>


        <tr align="center" bgcolor="#FFFFFF">
      <td align="left">
	  	<div class="countryspan" title="Aland Islands"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AX">  <img src="<?=$cdnserver?>/pic/country/AX.gif" align="absmiddle"/> Aland Islands </div>
	  
	  	<div class="countryspan" title="Albania"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AL">  <img src="<?=$cdnserver?>/pic/country/AL.gif" align="absmiddle"/> Albania </div>
	  
	  	<div class="countryspan" title="Andorra"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AD">  <img src="<?=$cdnserver?>/pic/country/AD.gif" align="absmiddle"/> Andorra </div>
	  
	  	<div class="countryspan" title="Austria"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AT">  <img src="<?=$cdnserver?>/pic/country/AT.gif" align="absmiddle"/> Austria </div>
	  
	  	<div class="countryspan" title="Belarus"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BY">  <img src="<?=$cdnserver?>/pic/country/BY.gif" align="absmiddle"/> Belarus </div>
	  
	  	<div class="countryspan" title="Belgium"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BE">  <img src="<?=$cdnserver?>/pic/country/BE.gif" align="absmiddle"/> Belgium </div>
	  
	  	<div class="countryspan" title="Bosnia And Herzegovina"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BA">  <img src="<?=$cdnserver?>/pic/country/BA.gif" align="absmiddle"/> Bosnia And Herzegovina </div>
	  
	  	<div class="countryspan" title="British Indian Ocean Territory"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="IO">  <img src="<?=$cdnserver?>/pic/country/IO.gif" align="absmiddle"/> British Indian Ocean Territory </div>
	  
	  	<div class="countryspan" title="Bulgaria"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BG">  <img src="<?=$cdnserver?>/pic/country/BG.gif" align="absmiddle"/> Bulgaria </div>
	  
	  	<div class="countryspan" title="Croatia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="HR">  <img src="<?=$cdnserver?>/pic/country/HR.gif" align="absmiddle"/> Croatia </div>
	  
	  	<div class="countryspan" title="Czech Republic"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CZ">  <img src="<?=$cdnserver?>/pic/country/CZ.gif" align="absmiddle"/> Czech Republic </div>
	  
	  	<div class="countryspan" title="Denmark"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="DK">  <img src="<?=$cdnserver?>/pic/country/DK.gif" align="absmiddle"/> Denmark </div>
	  
	  	<div class="countryspan" title="Estonia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="EE">  <img src="<?=$cdnserver?>/pic/country/EE.gif" align="absmiddle"/> Estonia </div>
	  
	  	<div class="countryspan" title="Faroe Islands"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="FO">  <img src="<?=$cdnserver?>/pic/country/FO.gif" align="absmiddle"/> Faroe Islands </div>
	  
	  	<div class="countryspan" title="Finland"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="FI">  <img src="<?=$cdnserver?>/pic/country/FI.gif" align="absmiddle"/> Finland </div>
	  
	  	<div class="countryspan" title="France"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="FR">  <img src="<?=$cdnserver?>/pic/country/FR.gif" align="absmiddle"/> France </div>
	  
	  	<div class="countryspan" title="Germany"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="DE">  <img src="<?=$cdnserver?>/pic/country/DE.gif" align="absmiddle"/> Germany </div>
	  
	  	<div class="countryspan" title="Gibraltar"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GI">  <img src="<?=$cdnserver?>/pic/country/GI.gif" align="absmiddle"/> Gibraltar </div>
	  
	  	<div class="countryspan" title="Greece"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GR">  <img src="<?=$cdnserver?>/pic/country/GR.gif" align="absmiddle"/> Greece </div>
	  
	  	<div class="countryspan" title="Holy See (vatican City State)"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="VA">  <img src="<?=$cdnserver?>/pic/country/VA.gif" align="absmiddle"/> Holy See (vatican City State) </div>
	  
	  	<div class="countryspan" title="Hungary"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="HU">  <img src="<?=$cdnserver?>/pic/country/HU.gif" align="absmiddle"/> Hungary </div>
	  
	  	<div class="countryspan" title="Iceland"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="IS">  <img src="<?=$cdnserver?>/pic/country/IS.gif" align="absmiddle"/> Iceland </div>
	  
	  	<div class="countryspan" title="Ireland"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="IE">  <img src="<?=$cdnserver?>/pic/country/IE.gif" align="absmiddle"/> Ireland </div>
	  
	  	<div class="countryspan" title="Isle Of Man"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="IM">  <img src="<?=$cdnserver?>/pic/country/IM.gif" align="absmiddle"/> Isle Of Man </div>
	  
	  	<div class="countryspan" title="Italy"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="IT">  <img src="<?=$cdnserver?>/pic/country/IT.gif" align="absmiddle"/> Italy </div>
	  
	  	<div class="countryspan" title="Latvia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="LV">  <img src="<?=$cdnserver?>/pic/country/LV.gif" align="absmiddle"/> Latvia </div>
	  
	  	<div class="countryspan" title="Liechtenstein"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="LI">  <img src="<?=$cdnserver?>/pic/country/LI.gif" align="absmiddle"/> Liechtenstein </div>
	  
	  	<div class="countryspan" title="Lithuania"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="LT">  <img src="<?=$cdnserver?>/pic/country/LT.gif" align="absmiddle"/> Lithuania </div>
	  
	  	<div class="countryspan" title="Luxembourg"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="LU">  <img src="<?=$cdnserver?>/pic/country/LU.gif" align="absmiddle"/> Luxembourg </div>
	  
	  	<div class="countryspan" title="Macedonia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MK">  <img src="<?=$cdnserver?>/pic/country/MK.gif" align="absmiddle"/> Macedonia </div>
	  
	  	<div class="countryspan" title="Malta"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MT">  <img src="<?=$cdnserver?>/pic/country/MT.gif" align="absmiddle"/> Malta </div>
	  
	  	<div class="countryspan" title="Moldova"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MD">  <img src="<?=$cdnserver?>/pic/country/MD.gif" align="absmiddle"/> Moldova </div>
	  
	  	<div class="countryspan" title="Monaco"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MC">  <img src="<?=$cdnserver?>/pic/country/MC.gif" align="absmiddle"/> Monaco </div>
	  
	  	<div class="countryspan" title="Montenegro"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="ME">  <img src="<?=$cdnserver?>/pic/country/ME.gif" align="absmiddle"/> Montenegro </div>
	  
	  	<div class="countryspan" title="Netherlands"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="NL">  <img src="<?=$cdnserver?>/pic/country/NL.gif" align="absmiddle"/> Netherlands </div>
	  
	  	<div class="countryspan" title="Norway"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="NO">  <img src="<?=$cdnserver?>/pic/country/NO.gif" align="absmiddle"/> Norway </div>
	  
	  	<div class="countryspan" title="Poland"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="PL">  <img src="<?=$cdnserver?>/pic/country/PL.gif" align="absmiddle"/> Poland </div>
	  
	  	<div class="countryspan" title="Portugal"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="PT">  <img src="<?=$cdnserver?>/pic/country/PT.gif" align="absmiddle"/> Portugal </div>
	  
	  	<div class="countryspan" title="Romania"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="RO">  <img src="<?=$cdnserver?>/pic/country/RO.gif" align="absmiddle"/> Romania </div>
	  
	  	<div class="countryspan" title="Russian Federation"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="RU">  <img src="<?=$cdnserver?>/pic/country/RU.gif" align="absmiddle"/> Russian Federation </div>
	  
	  	<div class="countryspan" title="San Marino"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SM">  <img src="<?=$cdnserver?>/pic/country/SM.gif" align="absmiddle"/> San Marino </div>
	  
	  	<div class="countryspan" title="Serbia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="RS">  <img src="<?=$cdnserver?>/pic/country/RS.gif" align="absmiddle"/> Serbia </div>
	  
	  	<div class="countryspan" title="Slovakia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SK">  <img src="<?=$cdnserver?>/pic/country/SK.gif" align="absmiddle"/> Slovakia </div>
	  
	  	<div class="countryspan" title="Slovenia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SI">  <img src="<?=$cdnserver?>/pic/country/SI.gif" align="absmiddle"/> Slovenia </div>
	  
	  	<div class="countryspan" title="Spain"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="ES">  <img src="<?=$cdnserver?>/pic/country/ES.gif" align="absmiddle"/> Spain </div>
	  
	  	<div class="countryspan" title="Sweden"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SE">  <img src="<?=$cdnserver?>/pic/country/SE.gif" align="absmiddle"/> Sweden </div>
	  
	  	<div class="countryspan" title="Ukraine"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="UA">  <img src="<?=$cdnserver?>/pic/country/UA.gif" align="absmiddle"/> Ukraine </div>
	  
	  	<div class="countryspan" title="United Kingdom"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="JE">  <img src="<?=$cdnserver?>/pic/country/JE.gif" align="absmiddle"/> United Kingdom </div>
	  
	  	<div class="countryspan" title="Yugoslavia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="YU">  <img src="<?=$cdnserver?>/pic/country/YU.gif" align="absmiddle"/> Yugoslavia </div>
	  
	  	  </td> 
  </tr>
</table>



 
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>大洋洲的国家与地区</strong></td>
  </tr>


        <tr align="center" bgcolor="#FFFFFF">
      <td align="left">
	  	<div class="countryspan" title="American Samoa"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AS">  <img src="<?=$cdnserver?>/pic/country/AS.gif" align="absmiddle"/> American Samoa </div>
	  
	  	<div class="countryspan" title="Anguilla"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AI">  <img src="<?=$cdnserver?>/pic/country/AI.gif" align="absmiddle"/> Anguilla </div>
	  
	  	<div class="countryspan" title="Australia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AU">  <img src="<?=$cdnserver?>/pic/country/AU.gif" align="absmiddle"/> Australia </div>
	  
	  	<div class="countryspan" title="Cook Islands"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CK">  <img src="<?=$cdnserver?>/pic/country/CK.gif" align="absmiddle"/> Cook Islands </div>
	  
	  	<div class="countryspan" title="Fiji"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="FJ">  <img src="<?=$cdnserver?>/pic/country/FJ.gif" align="absmiddle"/> Fiji </div>
	  
	  	<div class="countryspan" title="French Polynesia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="PF">  <img src="<?=$cdnserver?>/pic/country/PF.gif" align="absmiddle"/> French Polynesia </div>
	  
	  	<div class="countryspan" title="Guam"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GU">  <img src="<?=$cdnserver?>/pic/country/GU.gif" align="absmiddle"/> Guam </div>
	  
	  	<div class="countryspan" title="Kiribati"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="KI">  <img src="<?=$cdnserver?>/pic/country/KI.gif" align="absmiddle"/> Kiribati </div>
	  
	  	<div class="countryspan" title="Marshall Islands"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MH">  <img src="<?=$cdnserver?>/pic/country/MH.gif" align="absmiddle"/> Marshall Islands </div>
	  
	  	<div class="countryspan" title="Micronesia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="FM">  <img src="<?=$cdnserver?>/pic/country/FM.gif" align="absmiddle"/> Micronesia </div>
	  
	  	<div class="countryspan" title="Nauru"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="NR">  <img src="<?=$cdnserver?>/pic/country/NR.gif" align="absmiddle"/> Nauru </div>
	  
	  	<div class="countryspan" title="New Caledonia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="NC">  <img src="<?=$cdnserver?>/pic/country/NC.gif" align="absmiddle"/> New Caledonia </div>
	  
	  	<div class="countryspan" title="New Zealand"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="NZ">  <img src="<?=$cdnserver?>/pic/country/NZ.gif" align="absmiddle"/> New Zealand </div>
	  
	  	<div class="countryspan" title="Niue"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="NU">  <img src="<?=$cdnserver?>/pic/country/NU.gif" align="absmiddle"/> Niue </div>
	  
	  	<div class="countryspan" title="Palau"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="PW">  <img src="<?=$cdnserver?>/pic/country/PW.gif" align="absmiddle"/> Palau </div>
	  
	  	<div class="countryspan" title="Papua New Guinea"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="PG">  <img src="<?=$cdnserver?>/pic/country/PG.gif" align="absmiddle"/> Papua New Guinea </div>
	  
	  	<div class="countryspan" title="Samoa"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="WS">  <img src="<?=$cdnserver?>/pic/country/WS.gif" align="absmiddle"/> Samoa </div>
	  
	  	<div class="countryspan" title="Solomon Islands"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SB">  <img src="<?=$cdnserver?>/pic/country/SB.gif" align="absmiddle"/> Solomon Islands </div>
	  
	  	<div class="countryspan" title="Tokelau"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TK">  <img src="<?=$cdnserver?>/pic/country/TK.gif" align="absmiddle"/> Tokelau </div>
	  
	  	<div class="countryspan" title="Tonga"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TO">  <img src="<?=$cdnserver?>/pic/country/TO.gif" align="absmiddle"/> Tonga </div>
	  
	  	<div class="countryspan" title="Tuvalu"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TV">  <img src="<?=$cdnserver?>/pic/country/TV.gif" align="absmiddle"/> Tuvalu </div>
	  
	  	<div class="countryspan" title="Vanuatu"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="VU">  <img src="<?=$cdnserver?>/pic/country/VU.gif" align="absmiddle"/> Vanuatu </div>
	  
	  	  </td> 
  </tr>
</table>



 
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>北美洲的国家与地区</strong></td>
  </tr>


        <tr align="center" bgcolor="#FFFFFF">
      <td align="left">
	  	<div class="countryspan" title="Antigua And Barbuda"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AG">  <img src="<?=$cdnserver?>/pic/country/AG.gif" align="absmiddle"/> Antigua And Barbuda </div>
	  
	  	<div class="countryspan" title="Aruba"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AW">  <img src="<?=$cdnserver?>/pic/country/AW.gif" align="absmiddle"/> Aruba </div>
	  
	  	<div class="countryspan" title="Bahamas"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BS">  <img src="<?=$cdnserver?>/pic/country/BS.gif" align="absmiddle"/> Bahamas </div>
	  
	  	<div class="countryspan" title="Barbados"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BB">  <img src="<?=$cdnserver?>/pic/country/BB.gif" align="absmiddle"/> Barbados </div>
	  
	  	<div class="countryspan" title="Belize"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BZ">  <img src="<?=$cdnserver?>/pic/country/BZ.gif" align="absmiddle"/> Belize </div>
	  
	  	<div class="countryspan" title="Bermuda"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BM">  <img src="<?=$cdnserver?>/pic/country/BM.gif" align="absmiddle"/> Bermuda </div>
	  
	  	<div class="countryspan" title="Canada"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CA">  <img src="<?=$cdnserver?>/pic/country/CA.gif" align="absmiddle"/> Canada </div>
	  
	  	<div class="countryspan" title="Cayman Islands"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="KY">  <img src="<?=$cdnserver?>/pic/country/KY.gif" align="absmiddle"/> Cayman Islands </div>
	  
	  	<div class="countryspan" title="Costa Rica"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CR">  <img src="<?=$cdnserver?>/pic/country/CR.gif" align="absmiddle"/> Costa Rica </div>
	  
	  	<div class="countryspan" title="Cuba"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CU">  <img src="<?=$cdnserver?>/pic/country/CU.gif" align="absmiddle"/> Cuba </div>
	  
	  	<div class="countryspan" title="Dominica"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="DM">  <img src="<?=$cdnserver?>/pic/country/DM.gif" align="absmiddle"/> Dominica </div>
	  
	  	<div class="countryspan" title="Dominican Republic"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="DO">  <img src="<?=$cdnserver?>/pic/country/DO.gif" align="absmiddle"/> Dominican Republic </div>
	  
	  	<div class="countryspan" title="El Salvador"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SV">  <img src="<?=$cdnserver?>/pic/country/SV.gif" align="absmiddle"/> El Salvador </div>
	  
	  	<div class="countryspan" title="Greenland"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GL">  <img src="<?=$cdnserver?>/pic/country/GL.gif" align="absmiddle"/> Greenland </div>
	  
	  	<div class="countryspan" title="Grenada"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GD">  <img src="<?=$cdnserver?>/pic/country/GD.gif" align="absmiddle"/> Grenada </div>
	  
	  	<div class="countryspan" title="Guadeloupe"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GP">  <img src="<?=$cdnserver?>/pic/country/GP.gif" align="absmiddle"/> Guadeloupe </div>
	  
	  	<div class="countryspan" title="Guatemala"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GT">  <img src="<?=$cdnserver?>/pic/country/GT.gif" align="absmiddle"/> Guatemala </div>
	  
	  	<div class="countryspan" title="Haiti"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="HT">  <img src="<?=$cdnserver?>/pic/country/HT.gif" align="absmiddle"/> Haiti </div>
	  
	  	<div class="countryspan" title="Honduras"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="HN">  <img src="<?=$cdnserver?>/pic/country/HN.gif" align="absmiddle"/> Honduras </div>
	  
	  	<div class="countryspan" title="Jamaica"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="JM">  <img src="<?=$cdnserver?>/pic/country/JM.gif" align="absmiddle"/> Jamaica </div>
	  
	  	<div class="countryspan" title="Martinique"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MQ">  <img src="<?=$cdnserver?>/pic/country/MQ.gif" align="absmiddle"/> Martinique </div>
	  
	  	<div class="countryspan" title="Mexico"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MX">  <img src="<?=$cdnserver?>/pic/country/MX.gif" align="absmiddle"/> Mexico </div>
	  
	  	<div class="countryspan" title="Montserrat"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MS">  <img src="<?=$cdnserver?>/pic/country/MS.gif" align="absmiddle"/> Montserrat </div>
	  
	  	<div class="countryspan" title="Netherlands Antilles"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AN">  <img src="<?=$cdnserver?>/pic/country/AN.gif" align="absmiddle"/> Netherlands Antilles </div>
	  
	  	<div class="countryspan" title="Nicaragua"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="NI">  <img src="<?=$cdnserver?>/pic/country/NI.gif" align="absmiddle"/> Nicaragua </div>
	  
	  	<div class="countryspan" title="Norfolk Island"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="NF">  <img src="<?=$cdnserver?>/pic/country/NF.gif" align="absmiddle"/> Norfolk Island </div>
	  
	  	<div class="countryspan" title="Panama"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="PA">  <img src="<?=$cdnserver?>/pic/country/PA.gif" align="absmiddle"/> Panama </div>
	  
	  	<div class="countryspan" title="Puerto Rico"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="PR">  <img src="<?=$cdnserver?>/pic/country/PR.gif" align="absmiddle"/> Puerto Rico </div>
	  
	  	<div class="countryspan" title="Saint Kitts And Nevis"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="KN">  <img src="<?=$cdnserver?>/pic/country/KN.gif" align="absmiddle"/> Saint Kitts And Nevis </div>
	  
	  	<div class="countryspan" title="Saint Lucia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="LC">  <img src="<?=$cdnserver?>/pic/country/LC.gif" align="absmiddle"/> Saint Lucia </div>
	  
	  	<div class="countryspan" title="Saint Vincent And The Grenadines"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="VC">  <img src="<?=$cdnserver?>/pic/country/VC.gif" align="absmiddle"/> Saint Vincent And The Grenadines </div>
	  
	  	<div class="countryspan" title="Trinidad And Tobago"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TT">  <img src="<?=$cdnserver?>/pic/country/TT.gif" align="absmiddle"/> Trinidad And Tobago </div>
	  
	  	<div class="countryspan" title="Turks And Caicos Islands"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TC">  <img src="<?=$cdnserver?>/pic/country/TC.gif" align="absmiddle"/> Turks And Caicos Islands </div>
	  
	  	<div class="countryspan" title="United States"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="US">  <img src="<?=$cdnserver?>/pic/country/US.gif" align="absmiddle"/> United States </div>
	  
	  	<div class="countryspan" title="Virgin Islands"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="VI">  <img src="<?=$cdnserver?>/pic/country/VI.gif" align="absmiddle"/> Virgin Islands </div>
	  
	  	  </td> 
  </tr>
</table>



 
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>南美洲的国家与地区</strong></td>
  </tr>


        <tr align="center" bgcolor="#FFFFFF">
      <td align="left">
	  	<div class="countryspan" title="Argentina"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AR">  <img src="<?=$cdnserver?>/pic/country/AR.gif" align="absmiddle"/> Argentina </div>
	  
	  	<div class="countryspan" title="Bolivia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BO">  <img src="<?=$cdnserver?>/pic/country/BO.gif" align="absmiddle"/> Bolivia </div>
	  
	  	<div class="countryspan" title="Brazil"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BR">  <img src="<?=$cdnserver?>/pic/country/BR.gif" align="absmiddle"/> Brazil </div>
	  
	  	<div class="countryspan" title="Chile"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CL">  <img src="<?=$cdnserver?>/pic/country/CL.gif" align="absmiddle"/> Chile </div>
	  
	  	<div class="countryspan" title="Colombia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CO">  <img src="<?=$cdnserver?>/pic/country/CO.gif" align="absmiddle"/> Colombia </div>
	  
	  	<div class="countryspan" title="Ecuador"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="EC">  <img src="<?=$cdnserver?>/pic/country/EC.gif" align="absmiddle"/> Ecuador </div>
	  
	  	<div class="countryspan" title="Falkland Islands (malvinas)"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="FK">  <img src="<?=$cdnserver?>/pic/country/FK.gif" align="absmiddle"/> Falkland Islands (malvinas) </div>
	  
	  	<div class="countryspan" title="French Guiana"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GF">  <img src="<?=$cdnserver?>/pic/country/GF.gif" align="absmiddle"/> French Guiana </div>
	  
	  	<div class="countryspan" title="Guyana"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GY">  <img src="<?=$cdnserver?>/pic/country/GY.gif" align="absmiddle"/> Guyana </div>
	  
	  	<div class="countryspan" title="Paraguay"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="PY">  <img src="<?=$cdnserver?>/pic/country/PY.gif" align="absmiddle"/> Paraguay </div>
	  
	  	<div class="countryspan" title="Peru"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="PE">  <img src="<?=$cdnserver?>/pic/country/PE.gif" align="absmiddle"/> Peru </div>
	  
	  	<div class="countryspan" title="Suriname"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SR">  <img src="<?=$cdnserver?>/pic/country/SR.gif" align="absmiddle"/> Suriname </div>
	  
	  	<div class="countryspan" title="Uruguay"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="UY">  <img src="<?=$cdnserver?>/pic/country/UY.gif" align="absmiddle"/> Uruguay </div>
	  
	  	<div class="countryspan" title="Venezuela"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="VE">  <img src="<?=$cdnserver?>/pic/country/VE.gif" align="absmiddle"/> Venezuela </div>
	  
	  	  </td> 
  </tr>
</table>



 
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>非洲的国家与地区</strong></td>
  </tr>


        <tr align="center" bgcolor="#FFFFFF">
      <td align="left">
	  	<div class="countryspan" title="Algeria"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="DZ">  <img src="<?=$cdnserver?>/pic/country/DZ.gif" align="absmiddle"/> Algeria </div>
	  
	  	<div class="countryspan" title="Angola"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AO">  <img src="<?=$cdnserver?>/pic/country/AO.gif" align="absmiddle"/> Angola </div>
	  
	  	<div class="countryspan" title="Benin"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BJ">  <img src="<?=$cdnserver?>/pic/country/BJ.gif" align="absmiddle"/> Benin </div>
	  
	  	<div class="countryspan" title="Botswana"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BW">  <img src="<?=$cdnserver?>/pic/country/BW.gif" align="absmiddle"/> Botswana </div>
	  
	  	<div class="countryspan" title="Burkina Faso"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BF">  <img src="<?=$cdnserver?>/pic/country/BF.gif" align="absmiddle"/> Burkina Faso </div>
	  
	  	<div class="countryspan" title="Burundi"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="BI">  <img src="<?=$cdnserver?>/pic/country/BI.gif" align="absmiddle"/> Burundi </div>
	  
	  	<div class="countryspan" title="Cameroon"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CM">  <img src="<?=$cdnserver?>/pic/country/CM.gif" align="absmiddle"/> Cameroon </div>
	  
	  	<div class="countryspan" title="Cape Verde"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CV">  <img src="<?=$cdnserver?>/pic/country/CV.gif" align="absmiddle"/> Cape Verde </div>
	  
	  	<div class="countryspan" title="Central African Republic"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CF">  <img src="<?=$cdnserver?>/pic/country/CF.gif" align="absmiddle"/> Central African Republic </div>
	  
	  	<div class="countryspan" title="Chad"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TD">  <img src="<?=$cdnserver?>/pic/country/TD.gif" align="absmiddle"/> Chad </div>
	  
	  	<div class="countryspan" title="Comoros"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="KM">  <img src="<?=$cdnserver?>/pic/country/KM.gif" align="absmiddle"/> Comoros </div>
	  
	  	<div class="countryspan" title="Congo"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CG">  <img src="<?=$cdnserver?>/pic/country/CG.gif" align="absmiddle"/> Congo </div>
	  
	  	<div class="countryspan" title="Cote D'ivoire"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CI">  <img src="<?=$cdnserver?>/pic/country/CI.gif" align="absmiddle"/> Cote D'ivoire </div>
	  
	  	<div class="countryspan" title="Djibouti"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="DJ">  <img src="<?=$cdnserver?>/pic/country/DJ.gif" align="absmiddle"/> Djibouti </div>
	  
	  	<div class="countryspan" title="Egypt"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="EG">  <img src="<?=$cdnserver?>/pic/country/EG.gif" align="absmiddle"/> Egypt </div>
	  
	  	<div class="countryspan" title="Equatorial Guinea"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GQ">  <img src="<?=$cdnserver?>/pic/country/GQ.gif" align="absmiddle"/> Equatorial Guinea </div>
	  
	  	<div class="countryspan" title="Eritrea"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="ER">  <img src="<?=$cdnserver?>/pic/country/ER.gif" align="absmiddle"/> Eritrea </div>
	  
	  	<div class="countryspan" title="Ethiopia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="ET">  <img src="<?=$cdnserver?>/pic/country/ET.gif" align="absmiddle"/> Ethiopia </div>
	  
	  	<div class="countryspan" title="Gabon"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GA">  <img src="<?=$cdnserver?>/pic/country/GA.gif" align="absmiddle"/> Gabon </div>
	  
	  	<div class="countryspan" title="Gambia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GM">  <img src="<?=$cdnserver?>/pic/country/GM.gif" align="absmiddle"/> Gambia </div>
	  
	  	<div class="countryspan" title="Ghana"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GH">  <img src="<?=$cdnserver?>/pic/country/GH.gif" align="absmiddle"/> Ghana </div>
	  
	  	<div class="countryspan" title="Guinea"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GN">  <img src="<?=$cdnserver?>/pic/country/GN.gif" align="absmiddle"/> Guinea </div>
	  
	  	<div class="countryspan" title="Guinea-bissau"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GW">  <img src="<?=$cdnserver?>/pic/country/GW.gif" align="absmiddle"/> Guinea-bissau </div>
	  
	  	<div class="countryspan" title="Kenya"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="KE">  <img src="<?=$cdnserver?>/pic/country/KE.gif" align="absmiddle"/> Kenya </div>
	  
	  	<div class="countryspan" title="Lesotho"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="LS">  <img src="<?=$cdnserver?>/pic/country/LS.gif" align="absmiddle"/> Lesotho </div>
	  
	  	<div class="countryspan" title="Liberia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="LR">  <img src="<?=$cdnserver?>/pic/country/LR.gif" align="absmiddle"/> Liberia </div>
	  
	  	<div class="countryspan" title="Madagascar"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MG">  <img src="<?=$cdnserver?>/pic/country/MG.gif" align="absmiddle"/> Madagascar </div>
	  
	  	<div class="countryspan" title="Malawi"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MW">  <img src="<?=$cdnserver?>/pic/country/MW.gif" align="absmiddle"/> Malawi </div>
	  
	  	<div class="countryspan" title="Mali"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="ML">  <img src="<?=$cdnserver?>/pic/country/ML.gif" align="absmiddle"/> Mali </div>
	  
	  	<div class="countryspan" title="Mauritania"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MR">  <img src="<?=$cdnserver?>/pic/country/MR.gif" align="absmiddle"/> Mauritania </div>
	  
	  	<div class="countryspan" title="Mauritius"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MU">  <img src="<?=$cdnserver?>/pic/country/MU.gif" align="absmiddle"/> Mauritius </div>
	  
	  	<div class="countryspan" title="Mayotte"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="YT">  <img src="<?=$cdnserver?>/pic/country/YT.gif" align="absmiddle"/> Mayotte </div>
	  
	  	<div class="countryspan" title="Morocco"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MA">  <img src="<?=$cdnserver?>/pic/country/MA.gif" align="absmiddle"/> Morocco </div>
	  
	  	<div class="countryspan" title="Mozambique"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MZ">  <img src="<?=$cdnserver?>/pic/country/MZ.gif" align="absmiddle"/> Mozambique </div>
	  
	  	<div class="countryspan" title="Namibia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="NA">  <img src="<?=$cdnserver?>/pic/country/NA.gif" align="absmiddle"/> Namibia </div>
	  
	  	<div class="countryspan" title="Niger"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="NE">  <img src="<?=$cdnserver?>/pic/country/NE.gif" align="absmiddle"/> Niger </div>
	  
	  	<div class="countryspan" title="Nigeria"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="NG">  <img src="<?=$cdnserver?>/pic/country/NG.gif" align="absmiddle"/> Nigeria </div>
	  
	  	<div class="countryspan" title="Reunion"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="RE">  <img src="<?=$cdnserver?>/pic/country/RE.gif" align="absmiddle"/> Reunion </div>
	  
	  	<div class="countryspan" title="Rwanda"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="RW">  <img src="<?=$cdnserver?>/pic/country/RW.gif" align="absmiddle"/> Rwanda </div>
	  
	  	<div class="countryspan" title="Sao Tome And Principe"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="ST">  <img src="<?=$cdnserver?>/pic/country/ST.gif" align="absmiddle"/> Sao Tome And Principe </div>
	  
	  	<div class="countryspan" title="Senegal"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SN">  <img src="<?=$cdnserver?>/pic/country/SN.gif" align="absmiddle"/> Senegal </div>
	  
	  	<div class="countryspan" title="Seychelles"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SC">  <img src="<?=$cdnserver?>/pic/country/SC.gif" align="absmiddle"/> Seychelles </div>
	  
	  	<div class="countryspan" title="Sierra Leone"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SL">  <img src="<?=$cdnserver?>/pic/country/SL.gif" align="absmiddle"/> Sierra Leone </div>
	  
	  	<div class="countryspan" title="Somalia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SO">  <img src="<?=$cdnserver?>/pic/country/SO.gif" align="absmiddle"/> Somalia </div>
	  
	  	<div class="countryspan" title="South Africa"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="ZA">  <img src="<?=$cdnserver?>/pic/country/ZA.gif" align="absmiddle"/> South Africa </div>
	  
	  	<div class="countryspan" title="Sudan"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SD">  <img src="<?=$cdnserver?>/pic/country/SD.gif" align="absmiddle"/> Sudan </div>
	  
	  	<div class="countryspan" title="Swaziland"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="SZ">  <img src="<?=$cdnserver?>/pic/country/SZ.gif" align="absmiddle"/> Swaziland </div>
	  
	  	<div class="countryspan" title="Switzerland"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="CH">  <img src="<?=$cdnserver?>/pic/country/CH.gif" align="absmiddle"/> Switzerland </div>
	  
	  	<div class="countryspan" title="Tanzania"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TZ">  <img src="<?=$cdnserver?>/pic/country/TZ.gif" align="absmiddle"/> Tanzania </div>
	  
	  	<div class="countryspan" title="Togo"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TG">  <img src="<?=$cdnserver?>/pic/country/TG.gif" align="absmiddle"/> Togo </div>
	  
	  	<div class="countryspan" title="Tunisia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TN">  <img src="<?=$cdnserver?>/pic/country/TN.gif" align="absmiddle"/> Tunisia </div>
	  
	  	<div class="countryspan" title="Uganda"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="UG">  <img src="<?=$cdnserver?>/pic/country/UG.gif" align="absmiddle"/> Uganda </div>
	  
	  	<div class="countryspan" title="Zambia"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="ZM">  <img src="<?=$cdnserver?>/pic/country/ZM.gif" align="absmiddle"/> Zambia </div>
	  
	  	<div class="countryspan" title="Zimbabwe"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="ZW">  <img src="<?=$cdnserver?>/pic/country/ZW.gif" align="absmiddle"/> Zimbabwe </div>
	  
	  	  </td> 
  </tr>
</table>



 
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="margin-bottom:10px">
  <tr>
    <td colspan="2"  bgcolor="#F2F4F6"><strong>其他国家与地区</strong></td>
  </tr>


        <tr align="center" bgcolor="#FFFFFF">
      <td align="left">
	  	<div class="countryspan" title="French Southern Territories"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="TF">  <img src="<?=$cdnserver?>/pic/country/TF.gif" align="absmiddle"/> French Southern Territories </div>
	  
	  	<div class="countryspan" title="Northern Mariana Islands"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="MP">  <img src="<?=$cdnserver?>/pic/country/MP.gif" align="absmiddle"/> Northern Mariana Islands </div>
	  
	  	<div class="countryspan" title="South Georgia And The South Sandwich Islands"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="GS">  <img src="<?=$cdnserver?>/pic/country/GS.gif" align="absmiddle"/> South Georgia And The South Sandwich Islands </div>
	  
	  <div class="countryspan" title="Antarctica"><input onClick="checkcss(this)" name="cbcountry[]" type="checkbox" value="AQ">  <img src="<?=$cdnserver?>/pic/country/AQ.gif" align="absmiddle"/> Antarctica </div>
	  	  </td> 
  </tr>
</table>
<script language="javascript">
EnterCheckBox("cbcountry[]","<?=$config[67]?>")
</script>
<table  width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" > <tr class="edit" bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td width="84%" ><input  class="button"  onClick="showtips(this)" name="button2" type="submit" value="修改" /></td>
  </tr></table>
  
  </form>
 <?
 }
 ?>
<?
function edit_save()
{
	global $cfg;
	global $config;
	$param=array();
	$condition="where id=1";
	for($indexI=0;$indexI<250;$indexI++)
	{
		$config[$indexI]=$config[$indexI];
	}
	$config[67] = getFormStr("cbcountry");
	ksort($config);
	$param["content"]=join( $cfg["split"] , $config ) ;
	$sql=updateSQL( $param,"@@@config",$condition );
	//debug($config);
	query($sql);
	pageRedirect("1","a_bandcountry.php");
}
?>
<?php require("php_bottom.php")?>
</body>
</html>
