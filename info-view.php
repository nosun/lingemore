<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_info_view.html";

$id=getQueryInt("id",0);
$sql="select * from @@@infoclass where id=$id";
$rs=query($sql);
if( BOF($rs) )
	redirect(FOLDER."error.php?id=1");
$rows=fetch($rs);
//--生成HTML模块
free($rs);
$arrcontent = explode("<div style=\"page-break-after: always\"><span style=\"display: none\">&nbsp;</span></div>",$rows["content"]);
$var["rewriteurl"]=FOLDER . "?" . makeRewrite($rows["name"]) . "-i$id" ;
$var["pageurl"] = "info-view.php?id=$id";
$pagenow = getQueryInt("page",1);
$recordcount = count( $arrcontent );
$pagetotal = count( $arrcontent );
$pagenow = $pagenow >$pagetotal?  $pagetotal :  $pagenow;
$pagenow = $pagenow <1? 1 :  $pagenow;
if($pagenow>=2)
	$rows["name"] .= " ($pagenow) " ;
loadPage($pagenow,$pagetotal,1,$recordcount,$var) ;
$rows["pagecontent"] = $arrcontent[$pagenow-1] ; 
$var["i"]=$rows;

$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " " . $rows["name"];
$var["str_url_2"]=$rows["name"];
$var["title"] = $rows["name"] . " - " . $var["title"];



require("uio_bomdata.php");
?>