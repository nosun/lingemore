<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_news_view.html";
//--读取产品列表
$pid=getQueryInt("id",0);
$sql="select * from @@@news where id=$pid";
$rs=query($sql);
if( BOF($rs) )
	redirect(FOLDER."error.php?id=1");
$rows=fetch($rs);
$var["title"] = $rows["name"] . " - " . $var["title"];
//--生成HTML模块

//--------------
$nclassid=$rows["classid"];
$str_disp = (string)decbin($rows["disp"]) ;
$rows["showComment"] = substr( $str_disp , 1 ,1) ;
$rows["addComment"] = substr( $str_disp , 0 ,1) ;

free($rs);
$arr_url=split( ',' , $nclass[$nclassid]["url"] );
$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a>";
for($index=0;$index<count($arr_url);$index++)
{
	$var["str_url"] .= " " . $cfg["split_uri"] . " <a href='" .  getRewrite($nclass[$arr_url[$index]]["name"],$arr_url[$index],4,$cfg["rewrite"]) . "'><span class='daoa'>" . $nclass[$arr_url[$index]]["name"] . "</span></a>" ;
}
$var["str_url"] .= " " . $cfg["split_uri"] . " " . $rows["name"] ;
$var["str_url_2"]=$rows["name"];
$arrcontent = explode("<div style=\"page-break-after: always\"><span style=\"display: none\">&nbsp;</span></div>",$rows["content"]);

$var["rewriteurl"]= getRewritePre() . makeRewrite($rows["name"]) . "-n$pid" ;
$var["pageurl"] = "news-view.php?id=$pid";
$pagenow = getQueryInt("page",1);
$recordcount = count( $arrcontent );
$pagetotal = count( $arrcontent );
$pagenow = $pagenow >$pagetotal?  $pagetotal :  $pagenow;
$pagenow = $pagenow <1? 1 :  $pagenow;
if($pagenow>=2)
	$rows["name"] .= " ($pagenow) " ;
loadPage($pagenow,$pagetotal,1,$recordcount,$var) ;
$rows["pagecontent"] = $arrcontent[$pagenow-1] ; 
$var["n"]=$rows;
$var["pid"]=$pid;

$condition="where id=$pid";
$param=array();
$param["hits"]="@hits+1";
$sql=updateSQL($param,"@@@news",$condition);
query($sql);

//--- 读取分类的SEO模板
$sql = "select * from `@@@seo` where id=5";
$rs = query($sql);
while($seorows=fetch($rs))
{
	$tpl_seo_title = $seorows["title"];
	$tpl_seo_keywords = $seorows["keywords"];
	$tpl_seo_descript = $seorows["descript"];
}
$arr_seo_key[0] = "{VAR_shopname}"; $arr_seo_value[0] = $config[63] ;
$arr_seo_key[1] = "{VAR_ncatename}"; $arr_seo_value[1] = $nclass[$nclassid]["name"] ;
$arr_seo_key[3] = "{VAR_nname}"; $arr_seo_value[3] = $rows["name"] ;
$arr_seo_key[2] = "{VAR_ncatepath}";
for($index=0;$index<count($arr_url);$index++)
{ 
	$arr_seo_value[2] .= $nclass[$arr_url[$index]]["name"] . "," ;
}
$arr_seo_value[2] = substr($arr_seo_value[2],0,strlen($arr_seo_value[2])-1);
$var["title"] = ($rows["title"]!="") ? $rows["title"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_title) ;
$var["keywords"] = ($rows["keywords"]!="") ? $rows["keywords"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_keywords) ;
$var["descript"] = ($rows["descript"]!="") ? $rows["descript"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_descript) ;


require("uio_bomdata.php");
?>