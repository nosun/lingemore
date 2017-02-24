<?

require("inc/php_inc.php");

require("inc/Smarty-2.6.26/libs/Smarty.class.php");

require("uio_pubdata.php");



$template_file = "lay_index.html";



//--- 读取首页的SEO模板

$sql = "select * from `@@@seo` where id=1";

$rs = query($sql);

while($seorows=fetch($rs))

{

	$tpl_seo_title = $seorows["title"];

	$tpl_seo_keywords = $seorows["keywords"];

	$tpl_seo_descript = $seorows["descript"];

}

$arr_seo_key[0] = "{VAR_shopname}"; 

$arr_seo_value[0] = $config[63] ;



$var["title"] =  str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_title) ;

$var["keywords"] =  str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_keywords) ;

$var["descript"] =  str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_descript) ;



//--读取产品列表



$var["rs_p_1"] = getDispProduct(1,$config[80],1) ;
$var["rs_p_2"] = getDispProduct(2,$config[84],1) ;

/*$var["rs_p_8"] = getDispProduct(8,$config[80],0) ;*/





require("uio_bomdata.php");

?>