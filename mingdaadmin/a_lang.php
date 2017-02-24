<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>多语言管理</title>
</head>

<body>
<?php require("php_top.php")?>
<style type="text/css">
.tabbox{margin:auto; overflow:hidden; height:38px; }
.tabitem{height:38px; float:left; margin-right:5px; background:url(images/langtabbar_bg.jpg) repeat-x bottom; cursor:pointer;}
.tabitem .tabitemleft{width:8px; height:38px; background:url(images/langtabbar_left.jpg) no-repeat bottom; float:left;}
.tabitem .tabitemright{width:8px; height:38px; background:url(images/langtabbar_right.jpg) no-repeat bottom; float:left;}
.tabitem .tabitemmid{height:23px; float:left; padding-top:15px;}
.tabitem_cur{ background:url(images/langtabbar_bg_cur.jpg) repeat-x bottom; cursor:default;}
.tabitem_cur .tabitemleft{width:8px; height:38px; background:url(images/langtabbar_left_cur.jpg) no-repeat bottom; float:left;}
.tabitem_cur .tabitemright{width:8px; height:38px; background:url(images/langtabbar_right_cur.jpg) no-repeat bottom; float:left;}
.tabitem_cur .tabitemmid{height:23px; float:left; padding-top:15px;}
</style>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">多语言管理</div>
</div>
</td></tr></table>
<br />

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="a_langlist.php">多语言设置</a></td>
  </tr>
</table><br />


<?php
isAuthorize($group[1]);
$action=getQuery("action");
switch($action)
{
case "edit":
	editItem();
	break;
case "edit_save":
	edit_save();
	break;
default:
	editItem();
	break;
}
?>

<?
function editItem()
{
global $glo;
global $cfg;
$tblid=getQuerySQL("tblid");
$tblname=getQuery("tblname");
$sql="select * from $tblname where id=$tblid";
$rs=query($sql);
isItemNotExist($rs);
$rows=fetch($rs);

?>
<form name="formedit" action="?action=edit_save&tblid=<?=$tblid?>&tblname=<?=$tblname?>" enctype="application/x-www-form-urlencoded" method="post">
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" class=""  >
 <tr>
  <td>
<div class="tabbox">
<?
   $sql="select * from @@@langlist";
  $rs=query($sql);
  emptyList($rs,4);
  $index=0;
  $langarr=array();
  while($lrows=fetch($rs))
  {
	  $langarr[]=$lrows;
?>
  <div class="tabitem <? if($index==0){?>tabitem_cur<? }?>">
     <div class="tabitemleft"></div>
     <div class="tabitemmid">
        <img src="http://open.35zh.com/pic/country/<?=$lrows["scountry"]?>.gif" align="absmiddle"/> <?=$lrows["name"]?>
     </div>
     <div class="tabitemright"></div>
  </div>
<?	    
     $index++;
  }
?>
</div>
    </td>
  </tr>
</table>
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0" style="">
  <tr>
    <td>
       <?
       for($index=0;$index<count($langarr);$index++)
	   {
		   $sql="select * from @@@lang where tblid=$tblid and langid=".$langarr[$index]["id"];
           $rs=query($sql);
		   if( BOF($rs) )
		   {
			   $langrows=$rows;
		   }
		   else
		   {
			   $langrows=fetch($rs);
		   }
	   ?>
       <div id="langedit<?=$index?>" class="langeditbox" style=" <? if($index>0){?> display:none;<? }?>">
       <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle" style="padding-top:0px;">
         <tr>
           <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑多语言-<?=$langarr[$index]["name"]?></strong></td>
         </tr>
          <tr   bgcolor="#FFFFFF">
            <td>外文名称</td>
            <td><input  size="40"  name="name<?=$langarr[$index]["id"]?>" type="text"  value="<?=$langrows["name"]?>" /></td>
          </tr>
          <tr  bgcolor="#FFFFFF"  class="">
            <td valign="top">SEO(标题Title)：</td>
            <td><textarea name="title<?=$langarr[$index]["id"]?>" style="width:700px; height:70px" id="title"><?=$langrows["title"]?></textarea>
              <br />
              (商品页的标题,适当使用关键字,建议40-60英文之间)</td>
          </tr>
          <tr   bgcolor="#FFFFFF"  class="">
            <td valign="top">SEO(关键字Keywords)：</td>
            <td><textarea name="keywords<?=$langarr[$index]["id"]?>" style="width:700px; height:70px" id="keywords"><?=$langrows["keywords"]?></textarea>
              <br />
              (商品的关键字,重点突出若干个相关关键字，避免使用不相关的，不超过20个)</td>
          </tr><tr   bgcolor="#FFFFFF"  class="">
            <td valign="top">SEO(描述Descript)：</td>
            <td><textarea name="descript<?=$langarr[$index]["id"]?>"style="width:700px; height:70px" id="descript"><?=$langrows["descript"]?></textarea>
              <br />
              (简要的描述商品介绍,适当使用关键字造句(避免过度频繁使用),建议250英文之内)</td>
          </tr>
          <tr    bgcolor="#FFFFFF">
            <td valign="top">详细说明：</td>
            <td><?
			
				$oFCKeditor = new FCKeditor('content'.$langarr[$index]["id"]) ;
				$oFCKeditor->BasePath = $cfg["fckedit"]["basepath"] ;
				$oFCKeditor->Width = $cfg["fckedit"]["width"] ;
				$oFCKeditor->Height = $cfg["fckedit"]["height"] ;
                $oFCKeditor->Value = $langrows["content"] ;
                $oFCKeditor->Create() ;
                ?></td>
          </tr>
       </table>
       </div>
       <?
	   }
	   ?>
    </td>
  </tr>
</table>
<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class=""> 
  <tr class="edit" bgcolor="#FFFFE9">
    <td width="16%" align="left">&nbsp;</td>
    <td align="center"><input  class="button"  onClick="showtips(this)" name="button2" type="submit" value="修改" /></td>
  </tr>
</table>
</form>

<script type="text/javascript">
$(".tabitem").each(function(index){
   $(this).click(function(){
       $(".tabitem").removeClass("tabitem_cur");
	   $(this).addClass("tabitem_cur");
	   $(".langeditbox").css("display","none");
	   $("#langedit"+index).css("display","");
   });
});
</script>
<?
free($rs);
}
?>

<?
function edit_save()
{
	$tblid=getQuerySQL("tblid");
	$tblname=getQuery("tblname");
    $sql="select * from @@@langlist";
	$rs=query($sql);
	isItemNotExist($rs);
	$index=0;
	$langarr=array();
	while($lrows=fetch($rs))
	{
		$param=array();
		$param["name"]=getForm("name".$lrows["id"]);
		$param["title"]=getForm("title".$lrows["id"]);
		$param["keywords"]=getForm("keywords".$lrows["id"]);
		$param["descript"]=getForm("descript".$lrows["id"]);
	    $param["content"]=getHTML("content".$lrows["id"]);	
	    $param["tblid"]=$tblid;		
	    $param["tblname"]=str_replace("@@@", TABLE_PRE, $tblname) ;	
	    $param["lang"]=$lrows["name"];			
	    $param["langid"]=$lrows["id"];		
	    $condition="where langid=".$lrows["id"]." and tblid=$tblid and tblname='$tblname'";
		$sql=replaceSQL($param,"@@@lang",$condition);
		query($sql);
	}
	pageRedirect("1","a_lang.php?action=edit&tblid=$tblid&tblname=$tblname");
}
?>
<?php require("php_bottom.php")?>
</body>
</html>
