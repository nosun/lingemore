<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>优惠活动</title><script language="javascript" type="text/javascript"   charset='gb2312' src="JSFile/DateJs.js"></script>
</head>

<body>
<style>
.marginbottom{ margin-bottom:15px}
</style>
<?php require("php_top.php");?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">优惠活动</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="a_config.php">优惠活动</a></td>
  </tr>
</table><br />
<?
isAuthorize($group[1]);
$action=getQuery("action");
switch($action)
{
	case "edit_save":
		edit_save();
		break;
	case "clean":
		clean();
		break;
	default:
		showItem();
		break;
}
?>

<?
function showItem()
{
global $glo;
$config=$glo["config"];
?>


<form name="myform" method="post" action="?action=edit_save&id=<?=$glo["configid"]?>">
  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>订单配置</strong></td>
  </tr>
   <tr  bgcolor="#FFFFFF">
     <td width="20%">最小订单价格：</td>
     <td width="80%">当订单总价&lt;= <?=$config[90]?> <input name="config52" type="text" value="<?=$config[52]?>" size="10" /> , 将不能下单</td>
    </tr>
	  <tr  bgcolor="#FFFFFF">
     <td width="20%">订单附加值：</td>
     <td width="80%">当订单总价&lt;= <?=$config[90]?> <input name="config47" type="text" value="<?=$config[47]?>" size="10" /> , 订单价格自动累加
       <?=$config[90]?> <input name="config46" type="text" value="<?=$config[46]?>" size="10" />  
     </td> 
	  </tr>
  </table>

  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>免运费配置</strong></td>
  </tr>
   <tr  bgcolor="#FFFFFF">
     <td width="20%">产品总价：</td>
     <td width="80%">总价&gt;= <?=$config[90]?> <input name="config54" type="text" value="<?=$config[54]?>" size="10" /> 
     ; 运费为 0 </td>
    </tr>
	  <tr  bgcolor="#FFFFFF">
     <td width="20%">产品数量：</td>
     <td width="80%">总数量&gt;=  <input name="config53" type="text" value="<?=$config[53]?>" size="10" /> 
     ; 运费为 0 </td> 
	  </tr>
  </table><table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom hide">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>批发打折</strong> 输入90 为 打9折扣</td>
  </tr>
	 <tr  bgcolor="#FFFFFF">
     <td width="20%">打折配置：</td>
     <td width="80%">
    <div style="padding:2px;">  产品总价 &gt;=  <?=$config[90]?>
        <input name="config180" type="text" value="<?=$config[180]?>" size="10" />  
       折扣= 
      <input name="config200" type="text" value="<?=$config[200]?>" size="10" />  % </div>
    <div style="padding:2px;">  产品总价 &gt;=  <?=$config[90]?> 
<input name="config181" type="text" value="<?=$config[181]?>" size="10" />  
       折扣= 
      <input name="config201" type="text" value="<?=$config[201]?>" size="10" />  % </div>
     <div style="padding:2px;"> 产品总价 &gt;=  <?=$config[90]?>
       <input name="config182" type="text" value="<?=$config[182]?>" size="10" />  
       折扣= 
      <input name="config202" type="text" value="<?=$config[202]?>" size="10" />  % </div>
    <div style="padding:2px;">  产品总价 &gt;=  <?=$config[90]?>
       <input name="config183" type="text" value="<?=$config[183]?>" size="10" />  
       折扣= 
      <input name="config203" type="text" value="<?=$config[203]?>" size="10" />  % </div>
    <div style="padding:2px;">  产品总价 &gt;=  <?=$config[90]?>
       <input name="config184" type="text" value="<?=$config[184]?>" size="10" />  
       折扣= 
      <input name="config204" type="text" value="<?=$config[204]?>" size="10" />  % </div>
     <div style="padding:2px;"> 产品总价 &gt;=  <?=$config[90]?>
       <input name="config185" type="text" value="<?=$config[185]?>" size="10" />  
       折扣= 
      <input name="config205" type="text" value="<?=$config[205]?>" size="10" />  % </div>
    <div style="padding:2px;">  产品总价 &gt;=  <?=$config[90]?>
       <input name="config186" type="text" value="<?=$config[186]?>" size="10" />  
       折扣= 
      <input name="config206" type="text" value="<?=$config[206]?>" size="10" />  % </div>
     <div style="padding:2px;"> 产品总价 &gt;=  <?=$config[90]?>
       <input name="config187" type="text" value="<?=$config[187]?>" size="10" />  
       折扣= 
      <input name="config207" type="text" value="<?=$config[207]?>" size="10" />  % </div>
     <div style="padding:2px;"> 产品总价 &gt;=  <?=$config[90]?>
       <input name="config188" type="text" value="<?=$config[188]?>" size="10" />  
       折扣= 
      <input name="config208" type="text" value="<?=$config[208]?>" size="10" />  % </div>
     <div style="padding:2px;"> 产品总价 &gt;=  <?=$config[90]?>
       <input name="config189" type="text" value="<?=$config[189]?>" size="10" />  
       折扣= 
      <input name="config209" type="text" value="<?=$config[209]?>" size="10" />  % </div>
     </td>
	 </tr>
  </table><table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom hide">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>会员等级策略</strong></td>
  </tr>
   <tr  bgcolor="#FFFFFF">
     <td>相关说明：</td>
     <td>当会员订单为‘订单完成’,订单金额将列入真实消费，当真实消费到达[等级所需]的金额时，会员将自动升级</td>
   </tr>
   <tr  bgcolor="#FFFFFF">
     <td width="20%">会员等级：</td>
     <td width="80%"><input name="config110" type="text" value="<?=$config[110]?>" size="10" />
		<input name="config111" type="text" value="<?=$config[111]?>" size="10" />
		<input name="config112" type="text" value="<?=$config[112]?>" size="10" />
		<input name="config113" type="text" value="<?=$config[113]?>" size="10" />
		<input name="config114" type="text" value="<?=$config[114]?>" size="10" />
		<input name="config115" type="text" value="<?=$config[115]?>" size="10" />
		</td>
    </tr>
	  <tr  bgcolor="#FFFFFF">
     <td width="20%">对应折扣：(<span class="red weight">%</span>)</td>
     <td width="80%"><input name="config120" type="text" value="<?=$config[120]?>" size="10" />
		<input name="config121" type="text" value="<?=$config[121]?>" size="10" />
		<input name="config122" type="text" value="<?=$config[122]?>" size="10" />
		<input name="config123" type="text" value="<?=$config[123]?>" size="10" />
		<input name="config124" type="text" value="<?=$config[124]?>" size="10" />
		<input name="config125" type="text" value="<?=$config[125]?>" size="10" /> （100为不打折,95为打9.5折）</td> 
	  </tr>
	   <tr  bgcolor="#FFFFFF">
     <td width="20%">等级所需：</td>
     <td width="80%"><input name="config240" type="text" style="visibility:hidden" value="<?=$config[240]?>" size="10" />
		<input name="config241" type="text" style="visibility:hidden" value="<?=$config[241]?>" size="10" />
		<input name="config242" type="text" value="<?=$config[242]?>" size="10" />
		<input name="config243" type="text" value="<?=$config[243]?>" size="10" />
		<input name="config244" type="text" value="<?=$config[244]?>" size="10" />
		<input name="config245" type="text" value="<?=$config[245]?>" size="10" /> （以<?=$config[90]?>为基准）</td> 
	  </tr>
  </table>
  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">
  <tr>
    <td colspan="2" bgcolor="#F2F4F6"><strong>优惠券策略</strong></td>
  </tr>
   <tr  bgcolor="#FFFFFF">
     <td>相关说明：</td>
     <td>优惠券在下定单时候生成但状态为未激活，在订单状态为“已付款”时候，激活该优惠券，有效期留空则默认有效期为7天</td>
   </tr>
   <tr  bgcolor="#FFFFFF">
     <td width="20%">优惠券设置：</td>
     <td width="80%">
      <div style="padding:2px;">订单消费 &gt;=  <?=$config[90]?>
       <input  name="config260" id="config260" type="text"  value="<?=$config[260]?>" size="10" />  
       ，生成优惠券：节省
       <?=$config[90]?>
       <input  name="config270" id="config270" type="text"  value="<?=$config[270]?>" size="10" />
     ,有效期 <input  size="10" name="config280" id="config280"  value="<?=$config[280]?>" type="text" >
     天
      </div>
     
     <div style="padding:2px;">订单消费 &gt;=  <?=$config[90]?>
       <input name="config261" type="text" id="config261" value="<?=$config[261]?>"  size="10" />  
       ，生成优惠券：节省
       <?=$config[90]?>
       <input name="config271" id="config271"  value="<?=$config[271]?>" type="text"  size="10" />
     ,有效期 <input size="10" id="config281" name="config281"  value="<?=$config[281]?>" type="text" >
     天 </div>
      
       <div style="padding:2px;">订单消费 &gt;=  <?=$config[90]?>
       <input name="config262" id="config262"  value="<?=$config[262]?>" type="text"  size="10" />  
       ，生成优惠券：节省
       <?=$config[90]?>
       <input  name="config272" id="config272"  value="<?=$config[272]?>" type="text"  size="10" />
     ,有效期 <input size="10" name="config282" id="config282"   value="<?=$config[282]?>" type="text" >
     天 </div>
     
       <div style="padding:2px;">订单消费 &gt;=  <?=$config[90]?>
       <input  name="config263" id="config263" type="text"  value="<?=$config[263]?>" size="10" />  
       ，生成优惠券：节省
       <?=$config[90]?>
       <input  name="config273" id="config273" type="text"  value="<?=$config[273]?>" size="10" />
     ,有效期 <input size="10" name="config283" id="config283"    value="<?=$config[283]?>" type="text" >
     天 </div>
     
       <div style="padding:2px;">订单消费 &gt;=  <?=$config[90]?>
       <input  name="config264" id="config264" type="text" value="<?=$config[264]?>"  size="10" />  
       ，生成优惠券：节省
       <?=$config[90]?>
       <input  name="config274" id="config274" type="text"  value="<?=$config[274]?>" size="10" />
     ,有效期 <input size="10"   name="config284" id="config284"  value="<?=$config[284]?>" type="text" >
     天 </div>
    
     
     </td>
   </tr>
    <tr  bgcolor="#FFFFFF">
     <td>注册自动分配：</td>
     <td><input id="config290"  name="config290" type="checkbox" value="1"> 
       启用注册自动生成优惠券：节省<script language="javascript">
	   EnterCheckBox("config290","<?=$config[290]?>");
	   </script>
       <?=$config[90]?>
       <input  name="config291" id="config291" type="text"  value="<?=$config[291]?>" size="10" />
     ,有效期 <input size="10" name="config292" id="config292"  value="<?=$config[292]?>" type="text" >
     <span style="padding:2px;">天 </span></td>
   </tr>
  </table>
  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr class="edit"   bgcolor="#FFFFE9">
    <td width="20%">&nbsp;</td>
    <td><input type="submit" class="button" onClick="showtips(this)"  name="Submit4" value="提交" /></td>
  </tr>
</table>
</form>
<script language="javascript">

function testEmail()
{
	var src="../service/serviceForcheckEmailConfig.php";
	includeJsFile("Ajax_change",src) 
}
</script>
<?
}
?>

<?
function edit_save()
{
	global $cfg;
	global $config;
	//-------账号
	$param=array();
	$condition="where id=1";
	for($indexI=0;$indexI<1023;$indexI++)
	{
		$config[$indexI]=$config[$indexI];
	}
	
	$arraccount=array(52,53,54,46,47,290,291,292);
	for($index=180;$index<=189;$index++)
		$arraccount[] = $index ;
	for($index=200;$index<=209;$index++)
		$arraccount[] = $index ;
	for($index=110;$index<=115;$index++)
		$arraccount[] = $index ;
	for($index=120;$index<=125;$index++)
		$arraccount[] = $index ;
	for($index=240;$index<=245;$index++)
		$arraccount[] = $index ;
	for($index=260;$index<=289;$index++)
		$arraccount[] = $index ;
	for($index=0;$index<count($arraccount);$index++)
	{
		$config[$arraccount[$index]] = getForm("config".$arraccount[$index]);
		//print_r($config[$arraccount[$index]]);
	}
	if( $config[29]=="" )
		$config[29] = getForm("config29") ;
	ksort($config);
	$param["content"]=join( $cfg["split"] , $config ) ;
	$sql=updateSQL( $param,"@@@config",$condition );
	//debug($config);
	query($sql);
	pageRedirect("1","a_discount.php");
}

?>

<?php require("php_bottom.php");?>
</body>
</html>