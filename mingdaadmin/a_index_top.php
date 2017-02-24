<?
require("../inc/php_inc.php");
if( $_SESSION["admin"]=="" )
{
	parentAlertRedirect("您尚未登录","index.php?redirect_url=");
}
else
{
	$supper= fetchValue("select supper as v from `@@@admin` where id=".$_SESSION["admin"],8);
}
?>
<? if( $supper==9 ) { ?><style>.hide{ }</style>
<? }else{ ?>
<style>.hide{ display:none}</style>
<? } ?>
<style>
span { margin:0; padding:0;}
.topsub{position:absolute; width:136px; margin-top:-10px; z-index:1000; border:1px #0060B1 solid; border-top:3px #0060B1 solid; border-right:3px #0060B1 solid; background:#FFF;}
.topsubul{list-style:none; padding:0px; margin:0px;}
.topsubul li{list-style:none; padding:0px; margin:0px; height:24px; line-height:24px; background:#F6F7F9; border-bottom:1px #D7D7D7 solid; font-size:12px;vertical-align: bottom; position:relative;}
.topsubul li.hbg{list-style:none; padding:0px; margin:0px; height:24px; line-height:24px; background:url(images/topsublibg_1.jpg) right no-repeat #F6F7F9; border-bottom:1px #D7D7D7 solid; font-size:12px;vertical-align: bottom; position:relative;}
.topsubul li.cur{list-style:none; padding:0px; margin:0px; height:24px; line-height:24px; background:#FEFBCE; border-bottom:1px #D7D7D7 solid;font-size:12px}
.topsubul li.curhbg{list-style:none; padding:0px; margin:0px; height:24px; line-height:24px; background:url(images/topsublibg_2.jpg) right no-repeat #FEFBCE; border-bottom:1px #D7D7D7 solid;font-size:12px}
a.topa{color:#333; text-decoration:none; display:block; line-height:24px; padding-left:8px;}
a.topa:hover{color:#0061B0; text-decoration:none; display:block; line-height:24px;}


.topthird{position:absolute; width:136px; margin-top:-3px; z-index:1000; border:1px #0060B1 solid; border-top:3px #0060B1 solid; border-right:3px #0060B1 solid;border-bottom:3px #0060B1 solid; background:#FFF; left:136px; top:0px;}
.topthirdul{list-style:none; padding:0px; margin:0px;}
.topthirdul li{list-style:none; padding:0px; margin:0px; height:24px; line-height:24px; background:#F6F7F9; border-bottom:1px #D7D7D7 solid; font-size:12px;vertical-align: bottom;}
.topthirdul li.hbg{list-style:none; padding:0px; margin:0px; height:24px; line-height:24px; background:url(images/topsublibg_1.jpg) right no-repeat #F6F7F9; border-bottom:1px #D7D7D7 solid; font-size:12px;vertical-align: bottom;}
.topthirdul li.cur{list-style:none; padding:0px; margin:0px; height:24px; line-height:24px; background:#FEFBCE; border-bottom:1px #D7D7D7 solid;font-size:12px}
.topthirdul li.curhbg{list-style:none; padding:0px; margin:0px; height:24px; line-height:24px; background:url(images/topsublibg_2.jpg) right no-repeat #FEFBCE; border-bottom:1px #D7D7D7 solid;font-size:12px}
a.topa2{color:#333; text-decoration:none; display:block; line-height:24px; padding-left:8px;}
a.topa2:hover{color:#0061B0; text-decoration:none; display:block; line-height:24px;}
</style>
<script language='javascript'>

function $Nav(){
	if(window.navigator.userAgent.indexOf("MSIE")>=1) return 'IE';
  else if(window.navigator.userAgent.indexOf("Firefox")>=1) return 'FF';
  else return "OT";
}

var preID = 0;

function OpenMenu(cid,lurl,rurl,bid){
   if($Nav()=='IE'){
     if(rurl!='') top.document.frames.main.location = rurl;
     if(cid > -1) top.document.frames.menu.location = 'index_menu.php?c='+cid;
     else if(lurl!='') top.document.frames.menu.location = lurl;
     if(bid>0) document.getElementById("d"+bid).className = 'thisclass';
     if(preID>0 && preID!=bid) document.getElementById("d"+preID).className = '';
     preID = bid;
   }else{
     if(rurl!='') top.document.getElementById("main").src = rurl;
     if(cid > -1) top.document.getElementById("menu").src = 'index_menu.php?c='+cid;
     else if(lurl!='') top.document.getElementById("menu").src = lurl;
     if(bid>0 && bid!=9) document.getElementById("d"+bid).className = 'thisclass';
     if(preID>0) document.getElementById("d"+preID).className = '';
     preID = bid;
   }
}

var preFrameW = '160,*';
var FrameHide = 0;
function ChangeMenu(way){
	var addwidth = 10;
	var fcol = top.document.all.bodyFrame.cols;
	if(way==1) addwidth = 10;
	else if(way==-1) addwidth = -10;
	else if(way==0){
		if(FrameHide == 0){
			preFrameW = top.document.all.bodyFrame.cols;
			top.document.all.bodyFrame.cols = '0,*';
			FrameHide = 1;
			return;
		}else{
			top.document.all.bodyFrame.cols = preFrameW;
			FrameHide = 0;
			return;
		}
	}
	fcols = fcol.split(',');
	fcols[0] = parseInt(fcols[0]) + addwidth;
	top.document.all.bodyFrame.cols = fcols[0]+',*';
}

function resetBT(){
	if(preID>0) document.getElementById("d"+preID).className = 'bdd';
	preID = 0;
}


$(document).ready(function(){
   $(".topfisrt").hover(
	  function(){
	     $(this).find(".topsub").css("display","");
	  },	
	  function(){
	     $(this).find(".topsub").css("display","none");
	  }							
   );
   $(".topsubul li").hover(
	  function(){
		if($(this).find("div").html())
		{
		    $(this).addClass("curhbg");
		}
		else
		{
	        $(this).addClass("cur");
		}
	    $(this).find(".topthird").css("display","");
	  },
	  function(){
		if($(this).find("div").html())
		{
			$(this).removeClass("curhbg");
		}
		else
		{
	        $(this).removeClass("cur");
		}
	    $(this).find(".topthird").css("display","none");
	 }
   );
});

</script>

<div style="height:26px; line-height:26px">
<div style="float:left; margin-left:5px">
欢迎使用中恒天下网站管理系统
</div>
<div style="float:right; margin-right:5px"><a target="_blank" href="../">网站首页</a> | <a href="a_exit.php">注销登陆</a></div>
<div style="height:25px; padding-top:1px;line-height:25px;float:right; padding-right:15px;">
</span>
</div>
</div>
<div style="clear:both"></div>

<div style="height:60px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
<div style="float:left; padding-left:15px">
<a target="_blank" href="http://35zh.com/" title="中恒天下">
<img border="0" src="images/admin_tlogo.jpg" />
</a>
</div>
<div style="float:left; width:40px;  height:60px; background:url(images/tt1.jpg) no-repeat center">
</div>

<div class="topfisrt" style="float:left; padding-left:45px; line-height:60px;width:85px; font-size:14px; height:60px; background:url(images/tt2.jpg) no-repeat center left">
  <div><a href="a_daohang.php" target="main" style="color:#FFFFFF">系统配置</a></div>
  <div class="topsub" style="display:none;">
    <ul class="topsubul">
      <li  class="hbg"><a class="topa" href="a_admin.php" target="main">账户管理</a>
       <div class="topthird" style="display:none;">
            <ul class="topthirdul">
              <li><a class="topa2" href="a_password.php" target="main">修改密码</a></li>
              <li><a class="topa2" href="a_log.php" target="main">登录日志</a></li>
            </ul>
         </div>
      </li>
      
      <li class="hbg"><a class="topa" href="a_advertisement.php" target="main">Logo 广告</a>
         <div class="topthird" style="display:none;">
            <ul class="topthirdul">
              <li><a class="topa2" href="a_advertisement.php" target="main">广告 Banner</a></li>
              <li><a class="topa2" href="a_advertisement.php?action=editad&id=2" target="main">修改 Logo</a></li>
              <li><a class="topa2" href="a_advertisement.php?action=edit_favicon" target="main">上传 ICO 图标</a></li>
            </ul>
         </div>
      </li>
      <li class="hbg"><a class="topa" href="a_seo.php" target="main">SEO 设置</a>
       <div class="topthird" style="display:none;">
            <ul class="topthirdul">
              <li><a class="topa2" href="a_seo.php?action=sitemap" target="main">Sitemap与404</a></li>
              <li><a class="topa2" href="a_seo.php?action=robots" target="main">屏蔽收录</a></li>
               <li><a class="topa2" href="a_seo.php?action=submit_url" target="main">网站提交</a></li>
            </ul>
         </div>
      </li>
      
      
      <li class=""><a class="topa"  href="a_blog.php" target="main">站内Blog</a></li>
      <li><a class="topa" href="a_config.php" target="main">杂项配置</a></li>
      <li><a class="topa" href="a_ip.php" target="main">屏蔽 IP</a></li>
      <li><a class="topa" href="a_infoclass.php" target="main">页面设置</a></li>
      <li><a class="topa" href="a_payment.php" target="main">支付管理</a></li>
      <li><a class="topa" href="a_express.php" target="main">配送管理</a></li>
      <li><a class="topa" href="a_deliveryarea.php" target="main">配送区域</a></li>
      <li class=""><a class="topa" href="a_email.php" target="main">邮件转发</a>
       <li class=""><a class="topa" href="a_mailqueue.php" target="main">邮件发送队列</a>
      </li>
      <li><a class="topa" href="a_country.php" target="main">国家管理</a></li>
      <li class="hide"><a class="topa" href="a_discount.php" target="main">优惠活动</a></li>
      <li class="hide"><a class="topa" href="a_coupon.php" target="main">优惠券码</a></li>
    </ul>
  </div>
</div>



<div class="topfisrt" style="float:left; padding-left:45px; line-height:60px;width:85px; font-size:14px; height:60px; background:url(images/tt4.jpg) no-repeat center left">
  <div><a href="#" style="color:#FFFFFF">信息管理</a></div>
  <div class="topsub" style="display:none;">
    <ul class="topsubul">
     <li><a class="topa" href="a_productclass.php" target="main">商品分类</a></li>
      <li class="hbg"><a class="topa" href="a_product.php" target="main">商品管理</a>
        <div class="topthird" style="display:none;">
            <ul class="topthirdul">
             
              <li><a class="topa2" href="a_product.php?action=add" target="main">添加单个</a></li>
              <li><a class="topa2" href="a_product.php?action=p_add" target="main">批量添加</a></li>
              <li class="hide"><a class="topa2" href="a_data.php" target="main">数据导入</a></li>
            </ul>
         </div>
      </li>
      <li><a class="topa" href="a_circle.php" target="main">仓库管理</a></li>
      <li><a class="topa" href="a_propertyclass.php" target="main">商品属性</a></li>
       <li class="hide"><a class="topa" href="a_productdisp.php" target="main">商品扩展</a></li>
              <li class="hide"><a class="topa" href="a_message.php?cid=1" target="main">商品评论</a></li>
              <li class="hide"><a class="topa" href="a_tag.php" target="main">商品标签</a></li>
              <li class="hide"><a class="topa" href="a_replacewords.php" target="main">商品优化词库</a></li>
      
      <li><a class="topa" href="a_news.php" target="main">新闻管理</a></li>
    <li class="hide"><a class="topa" href="a_newsclass.php" target="main">新闻分类</a></li>
    	 
    </ul>
  </div>
</div>

<div class="topfisrt" style="float:left; padding-left:50px; line-height:60px;width:85px; font-size:14px; height:60px; background:url(images/tt7.jpg) no-repeat center left">
  <div><a href="#" style="color:#FFFFFF">业务管理</a></div>
  <div class="topsub" style="display:none;">
    <ul class="topsubul">
      <li><a class="topa" href="a_order.php" target="main">订单管理</a></li>
      <li><a class="topa" href="a_user.php" target="main">会员管理</a></li>
      <li><a class="topa" href="a_shopcart.php" target="main">会员购物车</a></li>
      <li><a class="topa" href="a_message.php" target="main">留言管理</a></li>
      <li><a class="topa" href="a_newsletter.php" target="main">订阅邮件</a></li>
    </ul>
  </div>
</div>

<div class="topfisrt" style="float:left; padding-left:45px; line-height:60px;width:85px; font-size:14px; height:60px; background:url(images/tt3.jpg) no-repeat center left">
   <div><a href="a_shujuwajue.php" target="main" style="color:#FFFFFF">数据分析</a></div>
  <div class="topsub" style="display:none;">
    <ul class="topsubul">
      <li><a class="topa" href="a_orderproduct.php" target="main">销售排行</a></li>
      <li><a class="topa" href="a_searchlog.php" target="main">搜索关注</a></li>
      <li><a class="topa" href="a_categorylog.php" target="main">分类统计</a></li>
      <li><a class="topa" href="a_productlog.php" target="main">产品关注</a></li>
      <li><a class="topa" href="a_favoritereport.php" target="main">收藏报表</a></li>
      <li><a class="topa" href="a_tjorder.php" target="main">市场分析</a></li>
      <li><a class="topa" href="a_timeorder.php" target="main">营销统计</a></li>
      <li><a class="topa" href="a_cleanreport.php" target="main">报表管理</a></li>
    </ul>
  </div>
  
  </div>

<div style="float:left; padding-left:45px; line-height:60px;width:85px; font-size:14px; height:60px;background:url(images/tt6.jpg) no-repeat center left">
  <a href="a_config.php?action=clean&redirect_page=a_index_body.php" target="main" title="当修改过分类或者商品推荐的时候，退出时候进行更新"  style="color:#FFFFFF">清空缓存</a></div>

<script>
function showMenu(itm)
{
	for(var index=1;index<=4;index++)
	{
		if(itm==index)
		{
			parent.document.frames["menu"].document.getElementById("items"+index).style.display="block";
		}
		else
		{
			parent.document.frames["menu"].document.getElementById("items"+index).style.display="none";
		}
	}
}
</script>
   </td>
   <td valign="top">
<div style="float:right;height:50px; width:250px; background-color:#EDF5FE; border:1px #1D82DC solid; margin:5px 5px 0px;">
<IFRAME ID="uppic" SRC="http://oa.uio.cc/notic.asp" FRAMEBORDER="0" SCROLLING="no" WIDTH="100%" HEIGHT="50"></IFRAME>
</div>
   </td>
 </tr>
</table>
</div>


<script>
function refreshSession()
{
	var obj=document.getElementById("cb");
	if(obj.checked==true)
	{
		location.href="a_index_top.php?action=refresh"
	}
}
var nMS =1200000;
function GetRTime(){
//var EndTime= new Date(2006,5,10,0,0); //截止时间:2006年6月10日0时0分
//var NowTime = new Date();
//var nMS =EndTime.getTime() - NowTime.getTime();
nMS-=1000;
var nD =Math.floor(nMS/(1000 * 60 * 60 * 24));
var nH=Math.floor(nMS/(1000*60*60)) % 24;
var nM=Math.floor(nMS/(1000*60)) % 60;
var nS=Math.floor(nMS/1000) % 60;
if(nH>= 0){
// document.getElementById("RemainD").innerHTML=nD;
 //document.getElementById("RemainH").innerHTML=nH;
 document.getElementById("RemainM").innerHTML=nM;
 document.getElementById("RemainS").innerHTML=nS;
 setTimeout("GetRTime()",1000);
}
else {
 document.getElementById("CountMsg").innerHTML="您已经退出后台系统！";
}

}

//window.onload=GetRTime;

//window.setInterval("refreshSession()",600000);
</script>