<? require("php_admin_include.php");?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>网站配置</title>

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

	<div class="bodytitletxt">网站配置</div>

</div>

</td></tr></table>

<br />



<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >

  <tr  bgcolor="#F2F4F6">

    <td    ><a href="a_config.php">网站配置</a><span class="fontpadding"><a href="a_ip.php">黑名单设置</a></span></td>

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

  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom hide">

  <tr>

    <td colspan="2" bgcolor="#F2F4F6"><strong>网站SEO配置</strong></td>

  </tr>

  <tr class="hide" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">网站标题 Title：</td>

    <td width="80%"><textarea name="config0" cols="60" rows="5"><?=$config[0]?></textarea></td>

  </tr>

  <tr  class="hide"  onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>关键字 Keyword：</td>

    <td><textarea name="config1" cols="60" rows="5"><?=$config[1]?></textarea></td>

  </tr>

   <tr  class="hide"  onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>网站说明 Description：</td>

    <td><textarea name="config2" cols="60" rows="5"><?=$config[2]?></textarea></td>

  </tr> <tr    onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td  width="20%">SEO模板设置：</td>

    <td width="80%">从这里进入&gt;&gt; <a href="a_seo.php">SEO模板设置</a></td>

  </tr>

</table>





 <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">

 <tr>

    <td colspan="2" bgcolor="#F2F4F6"><strong>网站安全验证</strong></td>

  </tr>

  <tr bgcolor="#FFFFFF">

    <td width="20%">前台访问限制：</td>

    <td width="80%"><table width="600" border="0" cellpadding="1" cellspacing="1" class="tbtitle">

	 <tr align="center" bgcolor="FFFFE9">

	   <td >所有人</td>

	   <td bgcolor="FFFFE9" >中文语言</td>

	   <td ><a href="javascript:alert('请开通付费版的限制模块')">IP限制</a></td>

            <td ><a href="a_ip.php">黑名单IP</a></td>

          </tr>

          <tr align="center" bgcolor="#FFFFFF">

            <td ><input name="config3" type="checkbox" value="1">

            限制</td>

            <td ><input name="config5" type="checkbox" value="1">

            限制</td>

            <td ><input name="config6" type="checkbox" value="1">

            限制</td>

            <td ><input name="config44" type="checkbox" value="1">

            限制</td>

          </tr>

         <script language="javascript">

		 EnterCheckBox("config3","<?=$config[3]?>");

	EnterCheckBox("config5","<?=$config[5]?>");

	EnterCheckBox("config6","<?=$config[6]?>");

	EnterCheckBox("config44","<?=$config[44]?>");

	EnterCheckBox("config55","<?=$config[55]?>");

   </script>

      </table>

IP限制只能屏蔽中国大陆的IP，如果需要增值的（选择性屏蔽全球200多个国家），<a href="http://open.35zh.com/images/bandcountry.png" target="_blank">请使用付费版的</a></td>

  </tr>

  <tr bgcolor="#FFFFFF">

    <td width="20%">前台访问限制转到页：</td>

    <td><table width="600" border="0" cellpadding="1" cellspacing="1" class="tbtitle">

        <tr>

          <td width="133" bgcolor="#FFFFFF"><input type="radio" checked="checked" name="config7" id="radio" value="1">

            登入页：</td>

          <td bgcolor="#FFFFFF">

            <table width="100%" border="0" cellpadding="1" cellspacing="1" class="tbtitle">

              <tr>

                <td bgcolor="#FFFFE9">用户名：</td>

                <td bgcolor="#FFFFE9">密码：</td>

              </tr>

              <tr>

                <td bgcolor="#FFFFFF"><input name="config8" type="text" id="config22" value="<?=$config[8]?>" size="30" /> </td>

                <td bgcolor="#FFFFFF"><input name="config9" type="text" id="config23" value="<?=$config[9]?>" size="30" /></td>

              </tr>

            </table></td>

        </tr>

        <tr>

          <td bgcolor="#FFFFFF"><input type="radio" name="config7" id="radio" value="2">

            文字说明页：</td>

          <td bgcolor="#FFFFFF"><textarea name="config4" rows="5" style="width:440px;"><?=$config[4]?></textarea></td>

        </tr>

        <tr>

          <td bgcolor="#FFFFFF"><input type="radio" name="config7" id="radio" value="3">

            自定义页：</td>

          <td bgcolor="#FFFFFF"><input name="config60" type="text"  value="<?=$config[60]?>"  style="width:440px;" /></td>

        </tr>

      </table>

	  <script language="javascript">

	  EnterRadio("config7","<?=$config[7]?>");

	  </script>

	  </td>

  </tr>

   <tr  bgcolor="#FFFFFF" class="hide">

    <td width="20%">前台验证码开关：</td>

    <td><table width="600" cellpadding="1" cellspacing="1" border="0" class="tbtitle">

	 <tr align="center" bgcolor="FFFFE9">

	   <td >屏蔽登入验证</td>

	   <td >注册页面</td>

            <td >会员登陆</td>

            <td >发表留言</td>

          </tr>

          <tr align="center" bgcolor="#FFFFFF">

            <td ><input name="config40" type="checkbox" value="1">启用</td>

            <td ><input name="config41" type="checkbox" value="1">启用</td>

            <td ><input name="config42" type="checkbox" value="1">启用</td>

            <td ><input name="config43" type="checkbox" value="1">启用</td>

          </tr>

         

        </table>

     <script language="javascript">

	EnterCheckBox("config40","<?=$config[40]?>");

	EnterCheckBox("config41","<?=$config[41]?>");

	EnterCheckBox("config42","<?=$config[42]?>");

	EnterCheckBox("config43","<?=$config[43]?>");

   </script>

		 * 强烈建议启用所有验证码!将非常有效的<span class="red"><strong>避免各种灌水机,肉机以保证网站的安全</strong></span></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" class="hide" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">前台网页安全：</td>

    <td>

<table width="266" cellpadding="1" cellspacing="1" border="0" class="tbtitle">

	 <tr align="center" bgcolor="FFFFE9">

	   <td width="133" >禁止右键功能</td>

	   <td width="133" >禁止复制功能</td>

          </tr>

          <tr align="center" bgcolor="#FFFFFF">

            <td ><input name="config48" type="checkbox" value="1">启用</td>

            <td ><input name="config49" type="checkbox" value="1">启用</td>

          </tr>

        </table> <script language="javascript">

	EnterCheckBox("config48","<?=$config[48]?>");

	EnterCheckBox("config49","<?=$config[49]?>");

   </script></td>

  </tr>

  

  </table>

  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom hide">

  <tr>

    <td colspan="2" bgcolor="#F2F4F6"><strong>网站联系方式</strong></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" > 

    <td width="20%">电话：</td>

    <td width="80%"><input name="config10" type="text" value="<?=$config[10]?>" size="30" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">传真：</td>

    <td><input name="config11" type="text"  value="<?=$config[11]?>" size="30" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">邮编：</td>

    <td><input name="config20" type="text" value="<?=$config[20]?>" size="30" /></td> 

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>MSN：</td>

    <td><input name="config308" type="text" value="<?=$config[308]?>" size="50" />

      只用于邮件转发模板中的</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>地址：</td>

    <td><input name="config309" type="text" value="<?=$config[309]?>" size="90" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>邮箱：</td>

    <td><input name="config310" type="text" value="<?=$config[310]?>" size="50" />

      只用于邮件转发模板中的</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">网站前台邮箱：</td>

    <td><input name="config12" type="text" value="<?=$config[12]?>" size="90" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">网站前台MSN：</td>

    <td><input name="config13" type="text"  value="<?=$config[13]?>" size="90" />

<div style="display:none">格式为：名称1:帐号1;名称2:帐号2;  例如：技术支持:tech@35zh.com;技术支持1:tech@35zh.com;</div></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">网站前台QQ：</td>

    <td><input name="config14" type="text" value="<?=$config[14]?>" size="90" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  class="hide"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">网站前台Skype：</td>

    <td><input name="config15" type="text" value="<?=$config[15]?>" size="90" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">网站前台Yahoo：</td>

    <td><input name="config16" type="text" value="<?=$config[16]?>" size="90" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">Alibaba：</td>

    <td><input name="config17" type="text" value="<?=$config[17]?>" size="30" /></td>

  </tr>

  

   

  <tr onMouseMove="tr_onMouseOver(this)"  class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">热门搜索词：</td>

    <td><textarea name="config19" cols="60" rows="3"><?=$config[19]?></textarea></td>

  </tr>

  

  </table>

  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom hide">

  <tr>

    <td colspan="2" bgcolor="#F2F4F6"><strong>支付接口设置</strong></td>

  </tr>

  

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">PayPal帐号：</td>

    <td><input name="config18" type="text" value="<?=$config[18]?>" size="30" /></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)" class="hide"    onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">Gs-pay SiteID：</td>

    <td><input name="config59" type="text" value="<?=$config[59]?>" size="30" /></td>

  </tr>

 <tr class="hide" onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">Payease 商户：</td>

    <td><input name="config72" type="text" value="<?=$config[72]?>" size="30" /></td>

  </tr>

   <tr class="hide" onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">Payease Key：</td>

    <td><input name="config73" type="text" value="<?=$config[73]?>" size="30" /></td>

  </tr>

   <tr class="hide" onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">95Epay 商户：</td>

    <td><input name="config74" type="text" value="<?=$config[74]?>" size="30" /></td>

  </tr>

   <tr class="hide" onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">95Epay Key：</td>

    <td><input name="config75" type="text" value="<?=$config[75]?>" size="30" /></td>

  </tr>

   <tr class="hide" onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">Ctopay 商户：</td>

    <td><input name="config76" type="text" value="<?=$config[76]?>" size="30" /></td>

  </tr>

   <tr class="hide" onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">Ctopay Key：</td>

    <td><input name="config77" type="text" value="<?=$config[77]?>" size="30" /></td>

  </tr>

   <tr class="hide" onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">MoneyBookers：</td>

    <td><input name="config78" type="text" value="<?=$config[78]?>" size="30" /></td>

  </tr>

   <tr  onMouseMove="tr_onMouseOver(this)" class="hide"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">Ips环迅：</td>

    <td><input name="config79" type="text" value="<?=$config[79]?>" size="30" /></td>

  </tr>

   <tr  onMouseMove="tr_onMouseOver(this)"  class="hide"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">Ips环迅 Key：</td>

    <td><input name="config69" type="text" value="<?=$config[69]?>" size="40" /></td>

  </tr>

   <tr  onMouseMove="tr_onMouseOver(this)"    onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">ecpss-E汇通账号：</td>

    <td><input name="config70" type="text" value="<?=$config[70]?>" size="40" /></td>

  </tr>

   <tr  onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">ecpss-E汇通Key：</td>

    <td><input name="config71" type="text" value="<?=$config[71]?>" size="40" /></td>

  </tr>

   <tr  onMouseMove="tr_onMouseOver(this)"    onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">ttopay 商户：</td>

    <td><input name="config31" type="text" value="<?=$config[31]?>" size="40" /></td>

  </tr>

   <tr  onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">ttopay KEY：</td>

    <td><input name="config32" type="text" value="<?=$config[32]?>" size="40" /></td>

  </tr>

    <tr  onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td width="20%">Paypal跳转的页面：</td>

    <td><input name="config33" type="text" value="<?=$config[33]?>" size="40" /> <input name="config34" type="text" value="<?=$config[34]?>" size="40" /></td>

  </tr>

  <tr  onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)" class="hide"  bgcolor="#FFFFFF">

    <td width="20%">Yourspay商户：</td>

    <td><input name="config35" type="text" value="<?=$config[35]?>" size="40" /> Key<input name="config36" type="text" value="<?=$config[36]?>" size="40" /></td>

  </tr>

  <tr  onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)" class="hide"  bgcolor="#FFFFFF">

    <td width="20%">Fashion商户：</td>

    <td><input name="config170" type="text" value="<?=$config[170]?>" size="40" /> Key<input name="config171" type="text" value="<?=$config[171]?>" size="40" /></td>

  </tr>

  </table>

<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">

  <tr>

    <td colspan="2" bgcolor="#F2F4F6"><strong>网站高级配置</strong></td>

  </tr>

  <tr class="hide" bgcolor="#FFFFFF">

    <td>市场价默认：</td>

    <td>

    = 产品原价 <select  id="config299" name="config299">

    <option value="+">加上 +</option>

	<option value="*">乘上 ×</option>

	

</select> <script>  EnterSelect("config299","<?=$config[299]?>")</script>

<input name="config300" style="width:60px" type="text" value="<?=$config[300]?>">

若产品市场价没填写，则默认使用该配置。</td>

  </tr>

  <tr   bgcolor="#FFFFFF" >

    <td>订单编号规则：</td>

    <td><input name="config298" type="text" value="<?=$config[298]?>" style=" width:600px" />

     <table width="600" cellpadding="1" cellspacing="1" border="0" style="margin-top:4px" class="tbtitle">

        <tr>

          <td align="center" bgcolor="#FFFFFF">Year</td>

          <td align="center" bgcolor="#FFFFFF">year</td>

          <td align="center" bgcolor="#FFFFFF">Month</td>

          <td align="center" bgcolor="#FFFFFF">month</td>

          <td align="center" bgcolor="#FFFFFF">Day</td>

          <td align="center" bgcolor="#FFFFFF">day</td>

          <td align="center" bgcolor="#FFFFFF">Hour</td>

          <td align="center" bgcolor="#FFFFFF">hour</td>

          <td align="center" bgcolor="#FFFFFF">Ghour</td>

          <td align="center" bgcolor="#FFFFFF">ghour</td>

          <td align="center" bgcolor="#FFFFFF">Minite</td>

          </tr>

        <tr>

          <td align="center" bgcolor="#FFFFFF">2012</td>

          <td align="center" bgcolor="#FFFFFF">12</td>

          <td align="center" bgcolor="#FFFFFF">00-12</td>

          <td align="center" bgcolor="#FFFFFF">0-12</td>

          <td align="center" bgcolor="#FFFFFF">00-31</td>

          <td align="center" bgcolor="#FFFFFF">0-31</td>

          <td align="center" bgcolor="#FFFFFF">00-23</td>

          <td align="center" bgcolor="#FFFFFF">0-23</td>

          <td align="center" bgcolor="#FFFFFF">00-12</td>

          <td align="center" bgcolor="#FFFFFF">0-12</td>

          <td align="center" bgcolor="#FFFFFF">00-59</td>

          </tr>

        <tr> <td align="center" bgcolor="#FFFFFF">Second</td>

          <td align="center" bgcolor="#FFFFFF">随机数</td>

          <td align="center" bgcolor="#FFFFFF">rand1</td>

          <td align="center" bgcolor="#FFFFFF">....</td>

          <td align="center" bgcolor="#FFFFFF">rand9</td>

          <td align="center" bgcolor="#FFFFFF">orderid</td>

          <td colspan="2" align="center" bgcolor="#FFFFFF">todayorder</td>

          <td align="center" bgcolor="#FFFFFF">&nbsp;</td>

          <td align="center" bgcolor="#FFFFFF">&nbsp;</td>

          <td align="center" bgcolor="#FFFFFF">&nbsp;</td>

         

          </tr>

        <tr>

          <td align="center" bgcolor="#FFFFFF">00-59</td>

          <td align="center" bgcolor="#FFFFFF">位数</td>

          <td align="center" bgcolor="#FFFFFF">1位</td>

          <td align="center" bgcolor="#FFFFFF">....</td>

          <td align="center" bgcolor="#FFFFFF">9位</td>

          <td align="center" bgcolor="#FFFFFF">订单ID</td>

          <td colspan="2" align="center" bgcolor="#FFFFFF">今日第几个</td>

          <td align="center" bgcolor="#FFFFFF">&nbsp;</td>

          <td align="center" bgcolor="#FFFFFF">&nbsp;</td>

          <td align="center" bgcolor="#FFFFFF">&nbsp;</td>

          

          </tr>

      </table></td>

  </tr>

  <tr   bgcolor="#FFFFFF" class="hide">

     <td width="20%">前台默认风格：</td>

     <td width="80%">

     <?

	 $dir="../skin/";

	 $redir=opendir($dir);

	 while($folder=readdir($redir))

	 {

		 if($folder!="." && $folder!="..")

		 {

	 ?>

       <div style="width:140px; height:120px; float:left;"><input type="radio" name="config30" value="<?=$folder?>"> <?=$folder?><br><img  src="../skin/<?=$folder?>/default.jpg"  vspace="5" align="absmiddle" style="border:1px #cccccc solid"></div>

	  <?

	 	 }

	 }

	 ?>

     

	 <script>  EnterRadio("config30","<?=$config[30]?>")</script>	 </td>

   </tr>

   <tr   bgcolor="#FFFFFF" class="e9">

    <td width="20%">前台显示个数：</td>

    <td><table width="600" cellpadding="1" cellspacing="1" border="0" class="tbtitle">

	 <tr align="center" bgcolor="FFFFE9">

            <td>主页产品<br>New Products</td>

            <td>产品列表</td>

            <td class="hide">新闻列表</td>

            <td class="hide">评论个数</td>

            <td class="">主页产品<br>Hot Products</td>

            <td class="">主页产品<br>Best Sellers</td>

          </tr>

          <tr align="center" bgcolor="#FFFFFF">

            <td ><input name="config80" type="text" value="<?=$config[80]?>" size="6" /></td>

            <td ><input name="config81" type="text" value="<?=$config[81]?>" size="6" /></td>

            <td class="hide"><input name="config82" type="text" value="<?=$config[82]?>" size="6" /></td>

            <td class="hide"><input name="config83" type="text" value="<?=$config[83]?>" size="6" /></td>

            <td class=""><input name="config84" type="text" value="<?=$config[84]?>" size="6" /></td>

            <td class=""><input name="config85" type="text" value="<?=$config[85]?>" size="6" /></td>

          </tr>

         

        </table></td>

  </tr>

  

   <tr   bgcolor="#FFFFFF" class="e9">

    <td width="20%">前台显示模式：</td>

    <td>

    <input name="config306" type="text" value="<?=$config[306]?>" size="40"> 以半角","隔开

    </td>

  </tr>

  <tr class="hide" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"  >

     <td width="20%">默认产品排序：</td>

     <td>按字段 <select id="config218" name="config218"><option value="id">ID</option>

	<option value="itemno">Item ID</option>

	<option value="price1">价格</option>

	<option value="sort">排序</option>

	<option value="addtime">更新时间</option>

	<option value="hits">产品访问量</option></select> <select id="config219" name="config219"><option value="desc">降序↓</option><option value="asc">升序↑</option></select>

	<script>EnterSelect("config218","<?=$config[218]?>")</script>

	<script>EnterSelect("config219","<?=$config[219]?>")</script>

	(默认:按照ID,降序，速度最佳)</td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)" class="hide" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"   >

     <td>一级目录排序：</td>

     <td>按字段 <select  id="config220" name="config220"><option value="id">ID</option>

	<option value="itemno">Item ID</option>

	<option value="price1">价格</option>

	<option value="sort">排序</option>

	<option value="addtime">更新时间</option>

	<option value="hits">产品访问量</option></select> <select id="config221" name="config221"><option value="desc">降序↓</option><option value="asc">升序↑</option></select>

	<script>EnterSelect("config220","<?=$config[220]?>")</script>

	<script>EnterSelect("config221","<?=$config[221]?>")</script>

	(默认:按照ID,降序，速度最佳)</td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"   >

     <td>二级目录排序：</td>

     <td>按字段 <select  id="config222" name="config222"><option value="id">ID</option>

	<option value="itemno">Item ID</option>

	<option value="price1">价格</option>

	<option value="sort">排序</option>

	<option value="addtime">更新时间</option>

	<option value="hits">产品访问量</option></select> <select id="config223" name="config223"><option value="desc">降序↓</option><option value="asc">升序↑</option></select>

	<script>EnterSelect("config222","<?=$config[222]?>")</script>

	<script>EnterSelect("config223","<?=$config[223]?>")</script>

	(默认:按照ID,降序，速度最佳)</td>

   </tr>

    <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"   >

     <td>三级目录排序：</td>

     <td>按字段 <select  id="config224" name="config224"><option value="id">ID</option>

	<option value="itemno">Item ID</option>

	<option value="price1">价格</option>

	<option value="sort">排序</option>

	<option value="addtime">更新时间</option>

	<option value="hits">产品访问量</option></select> <select id="config225" name="config225"><option value="desc">降序↓</option><option value="asc">升序↑</option></select>

	<script>EnterSelect("config224","<?=$config[224]?>")</script>

	<script>EnterSelect("config225","<?=$config[225]?>")</script>

	(默认:按照ID,降序，速度最佳)</td>

   </tr>

  <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"   >

     <td>四级目录排序：</td>

     <td>按字段 <select  id="config226" name="config226"><option value="id">ID</option>

	<option value="itemno">Item ID</option>

	<option value="price1">价格</option>

	<option value="sort">排序</option>

	<option value="addtime">更新时间</option>

	<option value="hits">产品访问量</option></select> <select id="config227" name="config227"><option value="desc">降序↓</option><option value="asc">升序↑</option></select>

	<script>EnterSelect("config226","<?=$config[226]?>")</script>

	<script>EnterSelect("config227","<?=$config[227]?>")</script>

	(默认:按照ID,降序，速度最佳)</td>

   </tr>

     <tr onMouseMove="tr_onMouseOver(this)" class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF"   >

     <td>五级目录排序：</td>

     <td>按字段 <select  id="config228" name="config228"><option value="id">ID</option>

	<option value="itemno">Item ID</option>

	<option value="price1">价格</option>

	<option value="sort">排序</option>

	<option value="addtime">更新时间</option>

	<option value="hits">产品访问量</option></select> <select id="config229" name="config229"><option value="desc">降序↓</option><option value="asc">升序↑</option></select>

	<script>EnterSelect("config228","<?=$config[228]?>")</script>

	<script>EnterSelect("config229","<?=$config[229]?>")</script>

	(默认:按照ID,降序，速度最佳)</td>

   </tr>

  

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide"  >

     <td width="20%">前台产品图片延迟载入：</td>

     <td><input name="config51" type="radio" value="src"/>

      否

	<input type="radio" name="config51" value="lazy_src" />

      是 <script>  EnterRadio("config51","<?=$config[51]?>")</script>

	(启用后,可分别下载图片，提高网页打开速度)</td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide">

    <td>网站伪静态开启：</td>

    <td><input name="config38" type="radio" checked="checked" value="0"/>

      否

	<input type="radio" name="config38" value="1" />

      是

	<script>  EnterRadio("config38","<?=$config[38]?>")</script></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  class="hide"   bgcolor="#FFFFFF">

    <td>网站伪静态URL：</td>

    <td><input name="config50" type="radio" checked="checked" value="0"/> URL = 分类名称/产品名称.html <input type="radio" name="config50" value="1" /> URL = 产品名称.html

	<script>  EnterRadio("config50","<?=$config[50]?>")</script></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  class=""  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>URL功能前缀：</td>

    <td>

    <input type="radio" name="config301"  value="3" /> /?wholesale-c23.html  <input type="radio" name="config301"   value="1" /> index.php/wholesale-c23.html  <input type="radio" name="config301"  value="2" /> /wholesale-c23.html

    <script>  EnterRadio("config301","<?=$config[301]?>")</script></td></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  class=""  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>URL自定义名称：</td>

    <td><input name="config293" type="text" value="<?=$config[293]?>"></td>

  </tr>

  <tr  class=""   bgcolor="#FFFFFF">

    <td>分类伪静态地址：</td>

    <td>

      <input type="radio" name="config294"  checked="checked" value="0" /> URL = {分类名称}-c{分类ID}.html<br>

      <input type="radio" name="config294" value="4" />       

      URL = {一级分类}/{二级分类}/..../{最后一级}-c{分类ID}.html<br>

      <input type="radio" name="config294" value="1"/> URL = {分类名称}/{URL自定义名称}-c{分类ID}.html<br>

      <input type="radio" name="config294" value="2" /> URL = {URL自定义名称}-{分类名称}-c{分类ID}.html<br>

      <input type="radio" name="config294" value="3" /> URL = {URL自定义名称}-c{分类ID}.html



	<script>  EnterRadio("config294","<?=$config[294]?>")</script></td>

  </tr>

  <tr   class=""   bgcolor="#FFFFFF">

    <td>产品伪静态地址：</td>

    <td>

      <input type="radio" name="config295"  checked="checked" value="0" /> URL = {产品名称}-p{产品ID}.html<br>

       <input type="radio" name="config295"  value="4" /> URL = {一级分类}/{二级分类}/..../{产品名称}-p{产品ID}.html<br>

      <input type="radio" name="config295" value="1"/> URL =  {最后一级分类名称}/{URL自定义名称}-p{产品ID}.html<br>

      <input type="radio" name="config295" value="2" /> URL = {URL自定义名称}-{产品名称}-p{产品ID}.html<br>

      <input type="radio" name="config295" value="3" /> URL = {URL自定义名称}-p{产品ID}.html



	<script>  EnterRadio("config295","<?=$config[295]?>")</script></td>

  </tr>

  

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide"  >

    <td width="20%">图片地址：</td>

    <td><input name="config45" type="radio" value="0" checked="checked"/>

本地存储

  <input type="radio"  name="config45" value="2" />

 本地异步路径

  <input type="radio"  name="config45" value="1" />

远程图片服务器

<script>  EnterRadio("config45","<?=$config[45]?>")</script>

CDN</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide">

    <td width="20%">图片服务器域名CDN：</td>

    <td><textarea name="config56" rows="5" style="width:440px;"><?=$config[56]?></textarea>	</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>单模网站图片域名：</td>

    <td><input type="text" name="config61" style="width:440px;"value="<?=$config[61]?>"> 

      * 例如 http://img01.tradeimg.com</td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>远程KEY验证：</td>

    <td><input type="text" name="config58" style="width:440px;" value="<?=$config[58]?>"> </td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

    <td>远程控制图片CDN：</td>

    <td><input name="config57" type="radio" value="1"/>

是(会删除远程CDN的图片)

  <input type="radio"  name="config57" value="2" />

 否(不会删除)<script>  EnterRadio("config57","<?=$config[57]?>")</script>  </td>

  </tr>

  

   <tr onMouseMove="tr_onMouseOver(this)"  class="hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

     <td>中恒API域名：</td>

     <td><input type="text" name="config64" size="40" value="<?=$config[64]?>"> 

      * 例如 http://img01.open.35zh.com</td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)"  class="e8 hide"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td width="20%">网站ID：</td>

    <td><input name="config23" type="text" id="config21" value="<?=$config[23]?>" size="30" /></td>

  </tr>

   <tr  bgcolor="#FFFFFF" class="hide" >

     <td>语言选择：</td>

     <td><SELECT id="config89" name="config89"><?

	 $dir="../inc/language-pack/";

	 $redir=opendir($dir);

	 while($file=readdir($redir))

	 {

		 if($file!="." && $file!="..")

		 {

	 ?>

      <OPTION value="<?=str_replace(".php","",$file)?>"><?=str_replace(".php","",$file)?></OPTION> 

	  <?

	 	 }

	 }

	 ?>

     </SELECT>

	 <script language="javascript">  EnterSelect("config89","<?=$config[89]?>")</script></td>

   </tr>

   <tr   bgcolor="#FFFFFF" >

    <td width="20%">时区选择：</td>

    <td><SELECT id=config172 name="config172">

	<OPTION value="Etc/GMT+12">(标准时-12) 日界线西</OPTION> 

	<OPTION value="Etc/GMT+11">(标准时-11) 中途岛、萨摩亚群岛</OPTION> 

	<OPTION value="Etc/GMT+10">(标准时-10) 夏威夷</OPTION> 

	<OPTION value="Etc/GMT+9">(标准时-9) 阿拉斯加</OPTION>

	<OPTION value="Etc/GMT+8">(标准时-8) 太平洋时间(美国和加拿大)</OPTION> 

	<OPTION value="Etc/GMT+7">(标准时-7) 山地时间(美国和加拿大)</OPTION> 

<OPTION value="Etc/GMT+6">(标准时-6) 中部时间(美国和加拿大)、墨西哥城</OPTION> 

<OPTION value="Etc/GMT+5">(标准时-5) 东部时间(美国和加拿大)、波哥大</OPTION> 

<OPTION value="Etc/GMT+4">(标准时-4) 大西洋时间(加拿大)、加拉加斯</OPTION> 

<OPTION value="Etc/GMT+3">(标准时-3) 巴西、布宜诺斯艾利斯、乔治敦</OPTION> 

<OPTION value="Etc/GMT+2">(标准时-2) 中大西洋</OPTION> 

<OPTION value="Etc/GMT+1">(标准时-1) 亚速尔群岛、佛得角群岛</OPTION> 

<OPTION value="Etc/GMT0">(格林尼治标准时) 西欧时间、伦敦、卡萨布兰卡</OPTION> 

<OPTION value="Etc/GMT-1">(标准时+1) 中欧时间、安哥拉、利比亚</OPTION> 

<OPTION value="Etc/GMT-2">(标准时+2) </OPTION>

<OPTION value="Etc/GMT-3">(标准时+3) 巴格达、科威特、莫斯科</OPTION> 

<OPTION value="Etc/GMT-4">(标准时+4) 阿布扎比、马斯喀特、巴库</OPTION> 

<OPTION value="Etc/GMT-5">(标准时+5) 叶卡捷琳堡、伊斯兰堡、卡拉奇</OPTION> 

<OPTION value="Etc/GMT-6">(标准时+6) 阿拉木图、 达卡、新亚伯利亚</OPTION> 

<OPTION value="Etc/GMT-7">(标准时+7) 曼谷、河内、雅加达</OPTION> 

<OPTION value="Etc/GMT-8" >(北京时间) 北京、重庆、香港、新加坡</OPTION> 

<OPTION value="Etc/GMT-9">(标准时+9) 东京、汉城、大阪、雅库茨克</OPTION> 

<OPTION value="Etc/GMT-10">(标准时+10) 悉尼、关岛</OPTION> 

<OPTION value="Etc/GMT-11">(标准时+11) 马加丹、索罗门群岛</OPTION> 

<OPTION value="Etc/GMT-12">(标准时+12) 奥克兰、惠灵顿、堪察加半岛</OPTION>

</SELECT> 

    (当地时间：<?=formatDateTime(time())?>)

    <script language="javascript">

EnterSelect("config172","<?=$config[172]?>");

</script></td>

  </tr>

     <tr  bgcolor="#FFFFFF" >

    <td width="20%">客服代码：</td>

    <td><textarea style="width:600px; height:90px;" name="config303"><?=$config[303]?></textarea></td>

  </tr>

     <tr  bgcolor="#FFFFFF" >

    <td width="20%">统计代码(会隐藏起来)：</td>

    <td><textarea style="width:600px; height:90px;" name="config304"><?=$config[304]?></textarea></td>

  </tr>

     <tr  bgcolor="#FFFFFF" >

    <td width="20%">网站公告：</td>

    <td>

    <input name="config307" type="radio" value="">关闭 <input name="config307" type="radio" value="1"> 开启

    <script>  EnterRadio("config307","<?=$config[307]?>")</script>  <span class="fontpadding"><a class="red" href="a_infoclass.php?id=105&action=edit">修改公告</a></span>

    </td>

  </tr>

  </table>

  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom ">

  <tr>

    <td colspan="2" bgcolor="#F2F4F6"><strong>货币配置</strong></td>

  </tr>

    <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

     <td  width="20%">前台价格小数点位数：</td>

     <td><input name="config39" type="text"  value="<?=$config[39]?>" size="5" /> 

     位 * 价格出现小数点时候的位数 ,为 -1 时为默认;不要超过 <span class="red weight">2</span> (四舍五入)</td>

   </tr>

     <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

     <td  width="20%">小数点补0个数：</td>

     <td><input name="config62" type="text"  value="<?=$config[62]?>" size="5" /> 

     小数点补0</td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF">

     <td width="20%">货币文本：</td>

     <td><input name="config150" type="text" value="<?=$config[150]?>" size="6" />

		<input name="config151" type="text" value="<?=$config[151]?>" size="6" />

		<input name="config152" type="text" value="<?=$config[152]?>" size="6" />

		<input name="config153" type="text" value="<?=$config[153]?>" size="6" />

		<input name="config154" type="text" value="<?=$config[154]?>" size="6" />

		<input name="config155" type="text" value="<?=$config[155]?>" size="6" />

		<input name="config156" type="text" value="<?=$config[156]?>" size="6" />

		<input name="config157" type="text" value="<?=$config[157]?>" size="6" />

		<input name="config158" type="text" value="<?=$config[158]?>" size="6" />

		<input name="config159" type="text" value="<?=$config[159]?>" size="6" /> </td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

     <td>三位标准符：</td>

     <td><input name="config250" type="text" value="<?=$config[250]?>" size="6" />

    <input name="config251" type="text" value="<?=$config[251]?>" size="6" />

    <input name="config252" type="text" value="<?=$config[252]?>" size="6" />

    <input name="config253" type="text" value="<?=$config[253]?>" size="6" />

    <input name="config254" type="text" value="<?=$config[254]?>" size="6" />

    <input name="config255" type="text" value="<?=$config[255]?>" size="6" />

    <input name="config256" type="text" value="<?=$config[256]?>" size="6" />

    <input name="config257" type="text" value="<?=$config[257]?>" size="6" />

    <input name="config258" type="text" value="<?=$config[258]?>" size="6" />

    <input name="config259" type="text" value="<?=$config[259]?>" size="6" /></td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td width="20%">货币符号：</td>

    <td><input name="config90" type="text" value="<?=$config[90]?>" size="6" />

		<input name="config91" type="text" value="<?=$config[91]?>" size="6" />

		<input name="config92" type="text" value="<?=$config[92]?>" size="6" />

		<input name="config93" type="text" value="<?=$config[93]?>" size="6" />

		<input name="config94" type="text" value="<?=$config[94]?>" size="6" />

		<input name="config95" type="text" value="<?=$config[95]?>" size="6" />

		<input name="config96" type="text" value="<?=$config[96]?>" size="6" />

		<input name="config97" type="text" value="<?=$config[97]?>" size="6" />

		<input name="config98" type="text" value="<?=$config[98]?>" size="6" />

		<input name="config99" type="text" value="<?=$config[99]?>" size="6" />			</td>

  </tr>

 

  <tr onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td width="20%">货币汇率：</td>

    <td><input name="config100" type="text" value="<?=$config[100]?>" size="6" />

		<input name="config101" type="text" value="<?=$config[101]?>" size="6" />

		<input name="config102" type="text" value="<?=$config[102]?>" size="6" />

		<input name="config103" type="text" value="<?=$config[103]?>" size="6" />

		<input name="config104" type="text" value="<?=$config[104]?>" size="6" />

		<input name="config105" type="text" value="<?=$config[105]?>" size="6" />

		<input name="config106" type="text" value="<?=$config[106]?>" size="6" />

		<input name="config107" type="text" value="<?=$config[107]?>" size="6" />

		<input name="config108" type="text" value="<?=$config[108]?>" size="6" />

		<input name="config109" type="text" value="<?=$config[109]?>" size="6" /> * 相对于<?=$config[150+$index]?>(<?=$config[90+$index]?>)&nbsp;&nbsp;&nbsp;<a href="http://www.baidu.com/s?bs=%BB%E3%C2%CA%BD%D3%BF%DA&f=8&rsv_bp=1&rsv_spt=3&wd=%BB%E3%C2%CA&inputT=343" target="_blank">* 实时汇率查询</a></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td>国旗对映：</td>

    <td><input name="config230" type="text" value="<?=$config[230]?>" size="6" />

    <input name="config231" type="text" value="<?=$config[231]?>" size="6" />

    <input name="config232" type="text" value="<?=$config[232]?>" size="6" />

    <input name="config233" type="text" value="<?=$config[233]?>" size="6" />

    <input name="config234" type="text" value="<?=$config[234]?>" size="6" />

    <input name="config235" type="text" value="<?=$config[235]?>" size="6" />

    <input name="config236" type="text" value="<?=$config[236]?>" size="6" />

    <input name="config237" type="text" value="<?=$config[237]?>" size="6" />

    <input name="config238" type="text" value="<?=$config[238]?>" size="6" />

    <input name="config239" type="text" value="<?=$config[239]?>" size="6" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td width="20%">网站前台默认货币：</td>

    <td><select name="config162">

	<?

	for($index=0;$index<=9;$index++)

	{

		if( $config[90+$index] !="" )

		{

	?>

	<option value="<?=$index?>"><?=$config[150+$index]?>(<?=$config[90+$index]?>)</option>

	<?

		}

	}

	?>

	</select> 

	<script>EnterSelect("config162","<?=$config[162]?>")</script></td>

  </tr>

  <tr class="hide" onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td width="20%">网站最终支付货币：</td>

    <td><select name="config305">

	<?

	for($index=0;$index<=9;$index++)

	{

		if( $config[90+$index] !="" )

		{

	?>

	<option value="<?=$index?>"><?=$config[150+$index]?>(<?=$config[90+$index]?>)</option>

	<?

		}

	}

	?>

	</select> 

	<script>EnterSelect("config305","<?=$config[305]?>")</script></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide" >

    <td width="20%">会员等级：</td>

    <td><input name="config110" type="text" value="<?=$config[110]?>" size="10" />

		<input name="config111" type="text" value="<?=$config[111]?>" size="10" />

		<input name="config112" type="text" value="<?=$config[112]?>" size="10" />

		<input name="config113" type="text" value="<?=$config[113]?>" size="10" />

		<input name="config114" type="text" value="<?=$config[114]?>" size="10" />

		<input name="config115" type="text" value="<?=$config[115]?>" size="10" /></td>

  </tr>

  <tr onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" class="hide"  >

    <td width="20%">价格折扣：</td>

    <td>

	<input name="config120" type="text" value="<?=$config[120]?>" size="10" />

		<input name="config121" type="text" value="<?=$config[121]?>" size="10" />

		<input name="config122" type="text" value="<?=$config[122]?>" size="10" />

		<input name="config123" type="text" value="<?=$config[123]?>" size="10" />

		<input name="config124" type="text" value="<?=$config[124]?>" size="10" />

		<input name="config125" type="text" value="<?=$config[125]?>" size="10" />	</td>

  </tr>

  </table>

  <table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom hide">

  <tr>

    <td colspan="2" bgcolor="#F2F4F6"><strong>批发商配置</strong></td>

  </tr>

   <tr  bgcolor="#FFFFFF">

     <td width="20%">最小订单价格：</td>

     <td width="80%"><?=$config[90]?> <input name="config52" type="text" value="<?=$config[52]?>" size="10" /></td>

    </tr>

	  <tr  bgcolor="#FFFFFF">

     <td width="20%">免运费配置：</td>

     <td width="80%">产品数量&gt;= 

       <input name="config53" type="text" value="<?=$config[53]?>" size="10" />  

       或者 产品总价&gt;= 

      <?=$config[90]?>  <input name="config54" type="text" value="<?=$config[54]?>" size="10" /> ; 运费为0 (若不需要请留空或填0) * 配置 <a href="a_express.php">配送方式</a></td> </tr>

  </table>

  <table  border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom hide">

  <tr>

    <td colspan="2" bgcolor="#F2F4F6"><strong>网站邮箱配置</strong></td>

  </tr>

   <tr  bgcolor="#FFFFFF">

     <td width="20%">邮件启用：</td>

     <td width="80%"><table width="600" cellpadding="1" cellspacing="1" border="0" class="tbtitle">

	 <tr align="center" bgcolor="FFFFE9">

	   <td >*  <a href="a_email.php">修改邮件模板</a></td>

            <td >注册通知</td>

            <td >订单通知</td>

            <td >在线留言</td>

        </tr>

          <tr align="center" bgcolor="#FFFFFF">

            <td >发给管理员</td>

            <td ><input name="config130" type="checkbox" value="1">启用</td>

            <td ><input name="config131" type="checkbox" value="1">启用</td>

            <td ><input name="config133" type="checkbox" value="1">启用</td>

          </tr>

         <tr align="center" bgcolor="#FFFFFF">

		 <td >发给游客</td>

         <td ><input name="config140" type="checkbox" value="1">启用</td>

         <td ><input name="config141" type="checkbox" value="1">启用</td>

         <td >&nbsp;</td>

         </tr>

        </table></td>

   </tr>

   <script language="javascript">

	EnterCheckBox("config130","<?=$config[130]?>");

	EnterCheckBox("config131","<?=$config[131]?>");

	EnterCheckBox("config132","<?=$config[132]?>");

	EnterCheckBox("config133","<?=$config[133]?>");

	EnterCheckBox("config134","<?=$config[134]?>");

	

	EnterCheckBox("config140","<?=$config[140]?>");

	EnterCheckBox("config141","<?=$config[141]?>");

	EnterCheckBox("config142","<?=$config[142]?>");

	EnterCheckBox("config143","<?=$config[143]?>");

	EnterCheckBox("config144","<?=$config[144]?>");

   </script>

   <tr onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

     <td>管理员收取邮箱：</td>

     <td><input name="config24" type="text"  value="<?=$config[24]?>" size="30" /></td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)"    onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td  width="20%">邮箱SMTP服务器：</td>

    <td><input name="config25" type="text"  value="<?=$config[25]?>" size="30" /> 

    * 企业邮局域名解析需要做 <strong>A记录 </strong>跟 <strong>MX记录</strong></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

     <td>后台发送邮箱账号：</td>

     <td><input name="config26" type="text"  value="<?=$config[26]?>" size="30" /> </td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)"    onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td>邮箱用户名：</td>

    <td><input name="config27" type="text"  value="<?=$config[27]?>" size="30" /> 

    * 

      <a target="_blank" href="../service/serviceForcheckEmailConfig.php">测试邮件发送配置</a> 请先提交保存再点击测试 (长时间无反应证明配置错误)</td>

  </tr>



  <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td>邮箱密码：</td>

    <td><input name="config29" type="password" size="30"  />  

    * 如果不修改请留空</td>

  </tr>

  

 <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td>邮箱端口：</td>

    <td><input name="config28" type="text" value="<?=$config[28]?>" size="30" /> 

    * 默认端口25  <a href="a_smtp.php" target="_blank">(最新最全的国内外各大邮箱域名及POP3/SMTP/IMAP)</a></td>

  </tr>

  </table>

<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">

  <tr>

    <td colspan="2" bgcolor="#F2F4F6"><strong>许可验证</strong></td>

  </tr>

   <tr  bgcolor="#FFFFFF">

     <td width="20%">正版KEY：</td>

     <td width="80%"><input name="config88" type="text" style="width:450px" value="<?=$config[88]?>" size="10" /> 请支持正版，多个域名用 | 隔开</td>

    </tr>

  </table>

  <div style="display:none">











<input name="config116" type="hidden" value="<?=$config[116]?>">会员折扣已用

<input name="config117" type="hidden" value="<?=$config[117]?>">会员折扣已用

<input name="config118" type="hidden" value="<?=$config[118]?>"> Blog 状态

<input name="config119" type="hidden" value="<?=$config[119]?>"> Blog 路径

<input name="config126" type="hidden" value="<?=$config[126]?>"> 会员折扣已用

<input name="config127" type="hidden" value="<?=$config[127]?>"> 会员折扣已用

<input name="config128" type="hidden" value="<?=$config[128]?>">

<input name="config129" type="hidden" value="<?=$config[129]?>">

<input name="config132" type="hidden" value="<?=$config[132]?>"> 邮件用

<input name="config134" type="hidden" value="<?=$config[134]?>"> 邮件用

<input name="config135" type="hidden" value="<?=$config[135]?>">

<input name="config136" type="hidden" value="<?=$config[136]?>">

<input name="config137" type="hidden" value="<?=$config[137]?>">

<input name="config138" type="hidden" value="<?=$config[138]?>">

<input name="config139" type="hidden" value="<?=$config[139]?>">

<input name="config142" type="hidden" value="<?=$config[142]?>"> 邮件用

<input name="config143" type="hidden" value="<?=$config[143]?>"> 邮件用

<input name="config144" type="hidden" value="<?=$config[144]?>"> 邮件用

<input name="config145" type="hidden" value="<?=$config[145]?>">

<input name="config146" type="hidden" value="<?=$config[146]?>">

<input name="config147" type="hidden" value="<?=$config[147]?>">

<input name="config148" type="hidden" value="<?=$config[148]?>">

<input name="config149" type="hidden" value="<?=$config[149]?>">

<input name="config163" type="hidden" value="<?=$config[163]?>">

<input name="config164" type="hidden" value="<?=$config[164]?>">

<input name="config165" type="hidden" value="<?=$config[165]?>">

<input name="config166" type="hidden" value="<?=$config[166]?>">

<input name="config167" type="hidden" value="<?=$config[167]?>">

<input name="config168" type="hidden" value="<?=$config[168]?>">

<input name="config169" type="hidden" value="<?=$config[169]?>">

<input name="config173" type="hidden" value="<?=$config[173]?>">

<input name="config174" type="hidden" value="<?=$config[174]?>">

<input name="config175" type="hidden" value="<?=$config[175]?>">

<input name="config176" type="hidden" value="<?=$config[176]?>">

<input name="config177" type="hidden" value="<?=$config[177]?>">

<input name="config178" type="hidden" value="<?=$config[178]?>">

<input name="config179" type="hidden" value="<?=$config[179]?>">

<input name="config240" type="hidden" value="<?=$config[240]?>">

<input name="config296" type="hidden" value="<?=$config[296]?>">

<input name="config297" type="hidden" value="<?=$config[297]?>">



// 用于 订单生成优惠券的模块

<input name="config260" type="hidden" value="<?=$config[260]?>">

<input name="config261" type="hidden" value="<?=$config[261]?>">

<input name="config262" type="hidden" value="<?=$config[262]?>">

<input name="config263" type="hidden" value="<?=$config[263]?>">

<input name="config264" type="hidden" value="<?=$config[264]?>">

<input name="config265" type="hidden" value="<?=$config[265]?>">

<input name="config266" type="hidden" value="<?=$config[266]?>">

<input name="config267" type="hidden" value="<?=$config[267]?>">

<input name="config268" type="hidden" value="<?=$config[268]?>">

<input name="config269" type="hidden" value="<?=$config[269]?>">

<input name="config270" type="hidden" value="<?=$config[270]?>">

<input name="config271" type="hidden" value="<?=$config[271]?>">

<input name="config272" type="hidden" value="<?=$config[272]?>">

<input name="config273" type="hidden" value="<?=$config[273]?>">

<input name="config274" type="hidden" value="<?=$config[274]?>">

<input name="config275" type="hidden" value="<?=$config[275]?>">

<input name="config276" type="hidden" value="<?=$config[276]?>">

<input name="config277" type="hidden" value="<?=$config[277]?>">

<input name="config278" type="hidden" value="<?=$config[278]?>">

<input name="config279" type="hidden" value="<?=$config[279]?>">

<input name="config280" type="hidden" value="<?=$config[280]?>">

<input name="config281" type="hidden" value="<?=$config[281]?>">

<input name="config282" type="hidden" value="<?=$config[282]?>">

<input name="config283" type="hidden" value="<?=$config[283]?>">

<input name="config284" type="hidden" value="<?=$config[284]?>">

<input name="config285" type="hidden" value="<?=$config[285]?>">

<input name="config286" type="hidden" value="<?=$config[286]?>">

<input name="config287" type="hidden" value="<?=$config[287]?>">

<input name="config288" type="hidden" value="<?=$config[288]?>">

<input name="config289" type="hidden" value="<?=$config[289]?>">



//-- 自动生成优惠券

<input name="config290" type="hidden" value="<?=$config[290]?>">

<input name="config291" type="hidden" value="<?=$config[291]?>">

<input name="config292" type="hidden" value="<?=$config[292]?>">



/--- 下面这些还可以用





<input name="config302" type="hidden" value="<?=$config[302]?>">环讯支付汇率 2012.4.24





<input name="config311" type="hidden" value="<?=$config[311]?>">

<input name="config312" type="hidden" value="<?=$config[312]?>">

<input name="config313" type="hidden" value="<?=$config[313]?>">

<input name="config314" type="hidden" value="<?=$config[314]?>">

<input name="config315" type="hidden" value="<?=$config[315]?>">

<input name="config316" type="hidden" value="<?=$config[316]?>">

<input name="config317" type="hidden" value="<?=$config[317]?>">

<input name="config318" type="hidden" value="<?=$config[318]?>">

<input name="config319" type="hidden" value="<?=$config[319]?>">

<input name="config320" type="hidden" value="<?=$config[320]?>">

<input name="config321" type="hidden" value="<?=$config[321]?>">

<input name="config322" type="hidden" value="<?=$config[322]?>">

<input name="config323" type="hidden" value="<?=$config[323]?>">

<input name="config324" type="hidden" value="<?=$config[324]?>">

<input name="config325" type="hidden" value="<?=$config[325]?>">

<input name="config326" type="hidden" value="<?=$config[326]?>">

<input name="config327" type="hidden" value="<?=$config[327]?>">

<input name="config328" type="hidden" value="<?=$config[328]?>">

<input name="config329" type="hidden" value="<?=$config[329]?>">

<input name="config330" type="hidden" value="<?=$config[330]?>">

<input name="config331" type="hidden" value="<?=$config[331]?>">

<input name="config332" type="hidden" value="<?=$config[332]?>">

<input name="config333" type="hidden" value="<?=$config[333]?>">

<input name="config334" type="hidden" value="<?=$config[334]?>">

<input name="config335" type="hidden" value="<?=$config[335]?>">

<input name="config336" type="hidden" value="<?=$config[336]?>">

<input name="config337" type="hidden" value="<?=$config[337]?>">

<input name="config338" type="hidden" value="<?=$config[338]?>">

<input name="config339" type="hidden" value="<?=$config[339]?>">

<input name="config340" type="hidden" value="<?=$config[340]?>">

<input name="config341" type="hidden" value="<?=$config[341]?>">

<input name="config342" type="hidden" value="<?=$config[342]?>">

<input name="config343" type="hidden" value="<?=$config[343]?>">

<input name="config344" type="hidden" value="<?=$config[344]?>">

<input name="config345" type="hidden" value="<?=$config[345]?>">

<input name="config346" type="hidden" value="<?=$config[346]?>">

<input name="config347" type="hidden" value="<?=$config[347]?>">

<input name="config348" type="hidden" value="<?=$config[348]?>">

<input name="config349" type="hidden" value="<?=$config[349]?>">

<input name="config350" type="hidden" value="<?=$config[350]?>">

<input name="config351" type="hidden" value="<?=$config[351]?>">

<input name="config352" type="hidden" value="<?=$config[352]?>">

<input name="config353" type="hidden" value="<?=$config[353]?>">

<input name="config354" type="hidden" value="<?=$config[354]?>">

<input name="config355" type="hidden" value="<?=$config[355]?>">

<input name="config356" type="hidden" value="<?=$config[356]?>">

<input name="config357" type="hidden" value="<?=$config[357]?>">

<input name="config358" type="hidden" value="<?=$config[358]?>">

<input name="config359" type="hidden" value="<?=$config[359]?>">

<input name="config360" type="hidden" value="<?=$config[360]?>">

<input name="config361" type="hidden" value="<?=$config[361]?>">

<input name="config362" type="hidden" value="<?=$config[362]?>">

<input name="config363" type="hidden" value="<?=$config[363]?>">

<input name="config364" type="hidden" value="<?=$config[364]?>">

<input name="config365" type="hidden" value="<?=$config[365]?>">

<input name="config366" type="hidden" value="<?=$config[366]?>">

<input name="config367" type="hidden" value="<?=$config[367]?>">

<input name="config368" type="hidden" value="<?=$config[368]?>">

<input name="config369" type="hidden" value="<?=$config[369]?>">

<input name="config370" type="hidden" value="<?=$config[370]?>">

<input name="config371" type="hidden" value="<?=$config[371]?>">

<input name="config372" type="hidden" value="<?=$config[372]?>">

<input name="config373" type="hidden" value="<?=$config[373]?>">

<input name="config374" type="hidden" value="<?=$config[374]?>">

<input name="config375" type="hidden" value="<?=$config[375]?>">

<input name="config376" type="hidden" value="<?=$config[376]?>">

<input name="config377" type="hidden" value="<?=$config[377]?>">

<input name="config378" type="hidden" value="<?=$config[378]?>">

<input name="config379" type="hidden" value="<?=$config[379]?>">

<input name="config380" type="hidden" value="<?=$config[380]?>">

<input name="config381" type="hidden" value="<?=$config[381]?>">

<input name="config382" type="hidden" value="<?=$config[382]?>">

<input name="config383" type="hidden" value="<?=$config[383]?>">

<input name="config384" type="hidden" value="<?=$config[384]?>">

<input name="config385" type="hidden" value="<?=$config[385]?>">

<input name="config386" type="hidden" value="<?=$config[386]?>">

<input name="config387" type="hidden" value="<?=$config[387]?>">

<input name="config388" type="hidden" value="<?=$config[388]?>">

<input name="config389" type="hidden" value="<?=$config[389]?>">

<input name="config390" type="hidden" value="<?=$config[390]?>">

<input name="config391" type="hidden" value="<?=$config[391]?>">

<input name="config392" type="hidden" value="<?=$config[392]?>">

<input name="config393" type="hidden" value="<?=$config[393]?>">

<input name="config394" type="hidden" value="<?=$config[394]?>">

<input name="config395" type="hidden" value="<?=$config[395]?>">

<input name="config396" type="hidden" value="<?=$config[396]?>">

<input name="config397" type="hidden" value="<?=$config[397]?>">

<input name="config398" type="hidden" value="<?=$config[398]?>">

<input name="config399" type="hidden" value="<?=$config[399]?>">

<input name="config400" type="hidden" value="<?=$config[400]?>">

<input name="config401" type="hidden" value="<?=$config[401]?>">

<input name="config402" type="hidden" value="<?=$config[402]?>">

<input name="config403" type="hidden" value="<?=$config[403]?>">

<input name="config404" type="hidden" value="<?=$config[404]?>">

<input name="config405" type="hidden" value="<?=$config[405]?>">

<input name="config406" type="hidden" value="<?=$config[406]?>">

<input name="config407" type="hidden" value="<?=$config[407]?>">

<input name="config408" type="hidden" value="<?=$config[408]?>">

<input name="config409" type="hidden" value="<?=$config[409]?>">

<input name="config410" type="hidden" value="<?=$config[410]?>">

<input name="config411" type="hidden" value="<?=$config[411]?>">

<input name="config412" type="hidden" value="<?=$config[412]?>">

<input name="config413" type="hidden" value="<?=$config[413]?>">

<input name="config414" type="hidden" value="<?=$config[414]?>">

<input name="config415" type="hidden" value="<?=$config[415]?>">

<input name="config416" type="hidden" value="<?=$config[416]?>">

<input name="config417" type="hidden" value="<?=$config[417]?>">

<input name="config418" type="hidden" value="<?=$config[418]?>">

<input name="config419" type="hidden" value="<?=$config[419]?>">

<input name="config420" type="hidden" value="<?=$config[420]?>">

<input name="config421" type="hidden" value="<?=$config[421]?>">

<input name="config422" type="hidden" value="<?=$config[422]?>">

<input name="config423" type="hidden" value="<?=$config[423]?>">

<input name="config424" type="hidden" value="<?=$config[424]?>">

<input name="config425" type="hidden" value="<?=$config[425]?>">

<input name="config426" type="hidden" value="<?=$config[426]?>">

<input name="config427" type="hidden" value="<?=$config[427]?>">

<input name="config428" type="hidden" value="<?=$config[428]?>">

<input name="config429" type="hidden" value="<?=$config[429]?>">

<input name="config430" type="hidden" value="<?=$config[430]?>">

<input name="config431" type="hidden" value="<?=$config[431]?>">

<input name="config432" type="hidden" value="<?=$config[432]?>">

<input name="config433" type="hidden" value="<?=$config[433]?>">

<input name="config434" type="hidden" value="<?=$config[434]?>">

<input name="config435" type="hidden" value="<?=$config[435]?>">

<input name="config436" type="hidden" value="<?=$config[436]?>">

<input name="config437" type="hidden" value="<?=$config[437]?>">

<input name="config438" type="hidden" value="<?=$config[438]?>">

<input name="config439" type="hidden" value="<?=$config[439]?>">

<input name="config440" type="hidden" value="<?=$config[440]?>">

<input name="config441" type="hidden" value="<?=$config[441]?>">

<input name="config442" type="hidden" value="<?=$config[442]?>">

<input name="config443" type="hidden" value="<?=$config[443]?>">

<input name="config444" type="hidden" value="<?=$config[444]?>">

<input name="config445" type="hidden" value="<?=$config[445]?>">

<input name="config446" type="hidden" value="<?=$config[446]?>">

<input name="config447" type="hidden" value="<?=$config[447]?>">

<input name="config448" type="hidden" value="<?=$config[448]?>">

<input name="config449" type="hidden" value="<?=$config[449]?>">

<input name="config450" type="hidden" value="<?=$config[450]?>">

<input name="config451" type="hidden" value="<?=$config[451]?>">

<input name="config452" type="hidden" value="<?=$config[452]?>">

<input name="config453" type="hidden" value="<?=$config[453]?>">

<input name="config454" type="hidden" value="<?=$config[454]?>">

<input name="config455" type="hidden" value="<?=$config[455]?>">

<input name="config456" type="hidden" value="<?=$config[456]?>">

<input name="config457" type="hidden" value="<?=$config[457]?>">

<input name="config458" type="hidden" value="<?=$config[458]?>">

<input name="config459" type="hidden" value="<?=$config[459]?>">

<input name="config460" type="hidden" value="<?=$config[460]?>">

<input name="config461" type="hidden" value="<?=$config[461]?>">

<input name="config462" type="hidden" value="<?=$config[462]?>">

<input name="config463" type="hidden" value="<?=$config[463]?>">

<input name="config464" type="hidden" value="<?=$config[464]?>">

<input name="config465" type="hidden" value="<?=$config[465]?>">

<input name="config466" type="hidden" value="<?=$config[466]?>">

<input name="config467" type="hidden" value="<?=$config[467]?>">

<input name="config468" type="hidden" value="<?=$config[468]?>">

<input name="config469" type="hidden" value="<?=$config[469]?>">

<input name="config470" type="hidden" value="<?=$config[470]?>">

<input name="config471" type="hidden" value="<?=$config[471]?>">

<input name="config472" type="hidden" value="<?=$config[472]?>">

<input name="config473" type="hidden" value="<?=$config[473]?>">

<input name="config474" type="hidden" value="<?=$config[474]?>">

<input name="config475" type="hidden" value="<?=$config[475]?>">

<input name="config476" type="hidden" value="<?=$config[476]?>">

<input name="config477" type="hidden" value="<?=$config[477]?>">

<input name="config478" type="hidden" value="<?=$config[478]?>">

<input name="config479" type="hidden" value="<?=$config[479]?>">

<input name="config480" type="hidden" value="<?=$config[480]?>">

<input name="config481" type="hidden" value="<?=$config[481]?>">

<input name="config482" type="hidden" value="<?=$config[482]?>">

<input name="config483" type="hidden" value="<?=$config[483]?>">

<input name="config484" type="hidden" value="<?=$config[484]?>">

<input name="config485" type="hidden" value="<?=$config[485]?>">

<input name="config486" type="hidden" value="<?=$config[486]?>">

<input name="config487" type="hidden" value="<?=$config[487]?>">

<input name="config488" type="hidden" value="<?=$config[488]?>">

<input name="config489" type="hidden" value="<?=$config[489]?>">

<input name="config490" type="hidden" value="<?=$config[490]?>">

<input name="config491" type="hidden" value="<?=$config[491]?>">

<input name="config492" type="hidden" value="<?=$config[492]?>">

<input name="config493" type="hidden" value="<?=$config[493]?>">

<input name="config494" type="hidden" value="<?=$config[494]?>">

<input name="config495" type="hidden" value="<?=$config[495]?>">

<input name="config496" type="hidden" value="<?=$config[496]?>">

<input name="config497" type="hidden" value="<?=$config[497]?>">

<input name="config498" type="hidden" value="<?=$config[498]?>">

<input name="config499" type="hidden" value="<?=$config[499]?>">

<input name="config500" type="hidden" value="<?=$config[500]?>">

===================================

================ 一下内容不能再用了。。。

<input name="config87" type="hidden" value="<?=$config[87]?>"> 发件人的姓名

<input name="config67" type="hidden" value="<?=$config[67]?>"> 高级屏蔽的多国家

<input name="config37" type="hidden" value="<?=$config[37]?>">

<input name="config46" type="hidden" value="<?=$config[46]?>"> 折扣配置 当订单总价

<input name="config47" type="hidden" value="<?=$config[47]?>">  折扣配置 当订单总价 累加

<input name="config63" type="hidden" value="<?=$config[63]?>">  商店名称

<input name="config65" type="hidden" value="<?=$config[65]?>"> rppay siteid

<input name="config66" type="hidden" value="<?=$config[66]?>"> rppay key

<input name="config68" type="hidden" value="<?=$config[68]?>"> wedopay

<input name="config86" type="hidden" value="<?=$config[86]?>"> wedopay

--------------- 用于 批量打折

<input name="config180" type="hidden" value="<?=$config[180]?>">

<input name="config181" type="hidden" value="<?=$config[181]?>">

<input name="config182" type="hidden" value="<?=$config[182]?>">

<input name="config183" type="hidden" value="<?=$config[183]?>">

<input name="config184" type="hidden" value="<?=$config[184]?>">

<input name="config185" type="hidden" value="<?=$config[185]?>">

<input name="config186" type="hidden" value="<?=$config[186]?>">

<input name="config187" type="hidden" value="<?=$config[187]?>">

<input name="config188" type="hidden" value="<?=$config[188]?>">

<input name="config189" type="hidden" value="<?=$config[189]?>">

<input name="config190" type="hidden" value="<?=$config[190]?>">

<input name="config191" type="hidden" value="<?=$config[191]?>">

<input name="config192" type="hidden" value="<?=$config[192]?>">

<input name="config193" type="hidden" value="<?=$config[193]?>">

<input name="config194" type="hidden" value="<?=$config[194]?>">

<input name="config195" type="hidden" value="<?=$config[195]?>">

<input name="config196" type="hidden" value="<?=$config[196]?>">

<input name="config197" type="hidden" value="<?=$config[197]?>">

<input name="config198" type="hidden" value="<?=$config[198]?>">

<input name="config199" type="hidden" value="<?=$config[199]?>">

<input name="config200" type="hidden" value="<?=$config[200]?>">

<input name="config201" type="hidden" value="<?=$config[201]?>">

<input name="config202" type="hidden" value="<?=$config[202]?>">

<input name="config203" type="hidden" value="<?=$config[203]?>">

<input name="config204" type="hidden" value="<?=$config[204]?>">

<input name="config205" type="hidden" value="<?=$config[205]?>">

<input name="config206" type="hidden" value="<?=$config[206]?>">

<input name="config207" type="hidden" value="<?=$config[207]?>">

<input name="config208" type="hidden" value="<?=$config[208]?>">

<input name="config209" type="hidden" value="<?=$config[209]?>">

<input name="config210" type="hidden" value="<?=$config[210]?>">

<input name="config211" type="hidden" value="<?=$config[211]?>">

<input name="config212" type="hidden" value="<?=$config[212]?>">

<input name="config213" type="hidden" value="<?=$config[213]?>">

<input name="config214" type="hidden" value="<?=$config[214]?>">

<input name="config215" type="hidden" value="<?=$config[215]?>">

<input name="config216" type="hidden" value="<?=$config[216]?>">

<input name="config217" type="hidden" value="<?=$config[217]?>">





------------ 用户会员等级自动提升

<input name="config241" type="hidden" value="<?=$config[241]?>">

<input name="config242" type="hidden" value="<?=$config[242]?>">

<input name="config243" type="hidden" value="<?=$config[243]?>">

<input name="config244" type="hidden" value="<?=$config[244]?>">

<input name="config245" type="hidden" value="<?=$config[245]?>">

<input name="config246" type="hidden" value="<?=$config[246]?>">

<input name="config247" type="hidden" value="<?=$config[247]?>">

<input name="config248" type="hidden" value="<?=$config[248]?>">

<input name="config249" type="hidden" value="<?=$config[249]?>">

</div>

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

	$id=getQuerySQL("id");

	$condition="where id=$id";

	$arrconfig=array();

	for($indexI=0;$indexI<1023;$indexI++)

	{

		$arrconfig[$indexI]=getForm("config$indexI");

	}

	if( $arrconfig[29]=="" )

		$arrconfig[29] = $config[29] ;

	$param["content"]=join( $cfg["split"] , $arrconfig ) ;

	$sql=updateSQL( $param,"@@@config",$condition );

	query($sql);

	pageRedirect(1,"a_config.php");

}



function clean()

{

	

	$condition="where id>=2";

	$arr["verson"]=1;

	$param["content"]= "" ;

	$sql=updateSQL( $param,"@@@config",$condition );

	query($sql);

	pageRedirect(1,"a_index_body.php");

}

?>



<?php require("php_bottom.php");?>

</body>

</html>