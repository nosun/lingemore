<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_news.html";
//--读取产品列表
$nclassid=getRequestInt("nclassid",$nroot);
$pageurl="news.php?1=1";
$condition="where 1=1";

$arr_url=split( ',' , $nclass[$nclassid]["url"] );
$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a>";
$var["str_url_2"]=$nclass[$arr_url[count($arr_url)-1]]["name"];
$var["title"] = $var["str_url_2"] . " - " . $var["title"];
$sql="select title,keywords,descript from @@@newsclass where id=$nclassid";
$rs=query($sql);
$rows=fetch($rs);

//--- 读取新闻分类的SEO模板
$sql = "select * from `@@@seo` where id=4";
$rs = query($sql);
while($seorows=fetch($rs))
{
	$tpl_seo_title = $seorows["title"];
	$tpl_seo_keywords = $seorows["keywords"];
	$tpl_seo_descript = $seorows["descript"];
}
$arr_seo_key[0] = "{VAR_shopname}"; $arr_seo_value[0] = $config[63] ;
$arr_seo_key[1] = "{VAR_ncatename}"; $arr_seo_value[1] = $nclass[$nclassid]["name"] ;
$arr_seo_key[2] = "{VAR_ncateparent}"; $arr_seo_value[2] = $nclass[$nclass[$nclassid]["father"]]["name"] ;
$arr_seo_key[3] = "{VAR_ncatepath}";
for($index=0;$index<count($arr_url);$index++)
{
	$arr_seo_value[3] .= $nclass[$arr_url[$index]]["name"] . "," ;
}
$arr_seo_value[3] = substr($arr_seo_value[3],0,strlen($arr_seo_value[3])-1);
$var["title"] = ($rows["title"]!="") ? $rows["title"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_title) ;
$var["keywords"] = ($rows["keywords"]!="") ? $rows["keywords"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_keywords) ;
$var["descript"] = ($rows["descript"]!="") ? $rows["descript"] : str_replace($arr_seo_key,$arr_seo_value,$tpl_seo_descript) ;


"/$1/news\.php\?nclassid=$3&disp=$4&name=$5&pid=$6&p1=$7&p2=$8&page=$14&p3=$9&p4=$10&p5=$11&p6=$12&p7=$13";
$arrQuery = split( '-' , getQuery("query") );
$sql_param["nclassid"]  = getRequestInt("nclassid",$nroot) ;
$sql_param["disp"]    	= dataDefault($arrQuery[0],getRequest("disp")) ;
$sql_param["name"]   	= dataDefault($arrQuery[1],getRequest("name"));
$sql_param["pid"]		= dataDefault($arrQuery[2],getRequest("pid"));
$sql_param["p1"]  		= dataDefault($arrQuery[3],getRequest("p1"));
$sql_param["p2"]     	= dataDefault($arrQuery[4],getRequest("p2"));
$sql_param["p3"] 		= dataDefault($arrQuery[5],getRequest("p3"));
$sql_param["p4"] 		= dataDefault($arrQuery[6],getRequest("p4"));
$sql_param["p5"] 		= dataDefault($arrQuery[7],getRequest("p5"));
$sql_param["p6"] 		= dataDefault($arrQuery[8],getRequest("p6"));
$sql_param["p7"] 		= dataDefault($arrQuery[9],getRequest("p7"));

for($index=0;$index<count($arr_url);$index++)
{
	$var["str_url"] .= " " . $cfg["split_uri"] . " <a href='" .  getRewrite($nclass[$arr_url[$index]]["name"],$arr_url[$index],4,$cfg["rewrite"]) . "'><span class='daoa' >" . $nclass[$arr_url[$index]]["name"] . "</span></a>" ;
}

if( $sql_param["pid"] )
{
	$condition .=  " and pid = " . $sql_param["pid"] ;
	$pageurl .= "&pid=" . $sql_param["pid"] ;
}	

if( $sql_param["name"] )
{
	$condition .=  " and name  like '%" . $sql_param["name"] . "%'" ;
	$pageurl .= "&name=" . $sql_param["name"] ;
}

if($nclassid!=$nroot)
{
	$p1=$sql_param["p1"];
	if(empty($p1))
	{
		$tree=get_id_tree($nclass,$nclassid);
		$condition .=  " and classid in (" . $tree . ")" ;
		$pageurl .= "&nclassid=" . $nclassid ;
	}
	else
	{
		$condition .=  " and nclassid=" . $nclassid ;
		$pageurl .= "&nclassid=" . $nclassid ;
		$pageurl .= "&p1=" . $p1 ;
	}
}
$var["rewriteurl"] = getRewritePre() . makeRewrite($var["str_url_2"]) . "-nc$nclassid-" . $sql_param["disp"] . "-" . urlencode($sql_param["name"]) . "-" . $sql_param["pid"] . "-" . $sql_param["p1"] . "-" . $sql_param["p2"] . "-" . $sql_param["p3"] . "-" . $sql_param["p4"] . "-" . $sql_param["p5"] . "-" . $sql_param["p6"] . "-" . $sql_param["p7"] ;

if( !$sql_param["disp"] && !$sql_param["name"] && !$sql_param["brandid"] && !$sql_param["pfrom"]  && !$sql_param["pto"]  && !$sql_param["p1"] && !$sql_param["p2"] && !$sql_param["p3"] && !$sql_param["p4"] && !$sql_param["p5"] )
{
	$var["rewriteurl"] = getRewritePre(). makeRewrite($var["str_url_2"]) . "-nc$nclassid" ;
}

$pagenow=getQueryInt("page",1);
$pagesize=$config[82];
$rs=createPage("*","@@@news",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
loadPage($pagenow,$pagetotal,$pagesize,$recordcount,$var);
$var["pageurl"]=$pageurl;
while($rows=fetch($rs))
{
	$rows['monthsTime'] = date("m",strtotime($rows["addtime"]));
	$rows['monthsNumTime'] = date("n",strtotime($rows["addtime"]));
	$rows['dayTime'] = date("d",strtotime($rows["addtime"]));
	$rows["addtime"]=formatDate( strtotime( $rows["addtime"] ) );
	$rows["rewrite"]= getRewrite($rows["name"],$rows["id"],1,$cfg["rewrite"]);
	$rows["s_content"] = substr( strip_tags($rows["content"]) , 0 , 300 ) . "...";
	$var["rs_n"][]=$rows;
}
free($rs);

$condition="where id=$pid";
$param=array();
$param["hits"]="@hits+1";
$sql=updateSQL($param,"@@@news",$condition);
query($sql);

require("uio_bomdata.php");
?>