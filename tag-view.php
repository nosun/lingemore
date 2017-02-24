<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");


$template_file = "lay_ptag_view.html";

$var["str_url_2"]="Tag";

$id = getQueryInt("id",0);
$sql="select * from @@@ptaglist where id=$id";
$rs=query($sql);
if( BOF($rs) )
	redirect(FOLDER."error.php?id=1");
$rows=fetch($rs);

//--- 读取标签的SEO模板
$sql = "select * from `@@@seo` where id=6";
$rs = query($sql);
while($seorows=fetch($rs))
{
	$tpl_seo_title = $seorows["title"];
	$tpl_seo_keywords = $seorows["keywords"];
	$tpl_seo_descript = $seorows["descript"];
}
$arr_seo_key[0] = "{VAR_shopname}"; $arr_seo_value[0] = $config[63] ;
$arr_seo_key[1] = "{VAR_tname}"; $arr_seo_value[1] = $rows["name"] ;
$var["title"] = ($rows["title"]!="") ? $rows["title"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_title) ;
$var["keywords"] = ($rows["keywords"]!="") ? $rows["keywords"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_keywords) ;
$var["descript"] = ($rows["descript"]!="") ? $rows["descript"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_descript) ;

$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> "   . $cfg["split_uri"] . " Tag " . $cfg["split_uri"] ." " . $rows["name"];
$var["str_url_2"] = $rows["name"];

$tagname = $rows["name"] ;
free($rs);



$condition =  " where tid =" . $id  ;
$pageurl = "&id=" . $id ;
$var["pagename"]="tag-view.php";

$pagenow=getQueryInt("page",1);
$pagesize=20;
$var["pagesize"] = $pagesize;

$rs=createPage("*","@@@ptag",$condition," order by id desc"  ,$pagesize,$pagenow,$pagetotal,$recordcount);
loadPage($pagenow,$pagetotal,$pagesize,$recordcount,$var);
$var["pageurl"]=$pageurl;
$tmpid=array();
while($rows=fetch($rs))
{
	$tmpid[] = $rows["pid"];
}
$var["rewriteurl"] = getRewritePre()  .  makeRewrite( $tagname  ) . "-ptag{$id}" ;

$sql = "select * from @@@product where id in (" . DataDefault( join(',',$tmpid) ,0 ) . ")";
$rs = query( $sql );
while ( $rows = fetch($rs) )
{
	$rows["rewrite"]=getRewrite($rows["name"],$rows["id"],0,$cfg["rewrite"]);
	$rows["realpic"]=getImageURL($rows["pic"],1,"uploadImage/",$urltype);
	$rows["price"]=getPrice(1,$rows["price1"],$rows["pnum"],$rows["pprice"],$rows["lastprice"],$cfg) * $discount * $rate;
	r2n( $rows["price"] );
	$sql = "select * from @@@ptag where pid=" . $rows["id"] . " order by id asc";
	$trs = query($sql);
	while( $trows = fetch( $trs ) )
	{
		$trows["rewrite"] = getRewrite($trows["name"],$trows["tid"],6  );
		$rows["tag"][] = $trows; 
	}
	$var["rs_p"][]=$rows;
}
free($rs);


require("uio_bomdata.php");

?>

