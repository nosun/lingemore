<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");


$template_file = getQueryDefault("file","lay_sitemap.html");

//--读取产品列表

$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['sitemap']}";
$var["str_url_2"]="{$cfg['lg']['sitemap']}";
$var["title"] = "{$cfg['lg']['sitemap']} - " . $var["title"];
$arr_son=array_filter(split( ',' , $class[$proot]["son"] ),callback_empty);
for($index=0;$index<count($arr_son);$index++)
{
	$rows=array();
	$rows["id"]=$arr_son[$index];
	if( $class[$arr_son[$index]]["state"]==0 )
		continue;
	$rows["name"] = $class[$arr_son[$index]]["name"] ;
	$rows["rewrite"] =  getRewrite($class[$arr_son[$index]]["name"],$arr_son[$index],3,$cfg["rewrite"]);
	$arr_son2=array_filter(split( ',' , $class[$rows["id"]]["son"] ),callback_empty);
	for($indexj=0;$indexj<count($arr_son2);$indexj++)
	{
		if( $class[$arr_son2[$index]]["state"]==0 )
			continue;
		$rows2=array();
		$rows2["id"]=$arr_son2[$indexj];
		$rows2["name"] = $class[$arr_son2[$indexj]]["name"] ;
		$rows2["rewrite"] =  getRewrite($class[$arr_son2[$indexj]]["name"],$arr_son2[$indexj],3,$cfg["rewrite"]);
		$rows["arrson"][]=$rows2;
	}
	$var["rs_index"][]=$rows;
}
$sql ="select name,id from @@@productclass order by id desc";
$rs = query($sql);
while($rows=fetch($rs))
{
	$rows["rewrite"] =  getRewrite($rows["name"],$rows["id"],3,$cfg["rewrite"]);
	$var["rs_map"][]=$rows;
}

$var["lastmod"] = formatDate(time());

$sql = "select * from @@@productdisp order by value asc";
$d_rs = query($sql);
while($rows=fetch($d_rs))
{
	$rows["rewrite"] =  getRewrite($rows["name"],$rows["id"],7) ;
	$var["rs_disp"][]=$rows;
}
$sql ="select name,id from @@@product order by id desc";

$rs = query($sql);

while($rows=fetch($rs))

{

	$rows["rewrite"] =  getRewrite($rows["name"],$rows["id"],0,$cfg["rewrite"]);

	$var["rs_p"][]=$rows;

}

$sql ="select name,id from @@@news order by id desc";

$rs = query($sql);

while($rows=fetch($rs))

{

	$rows["rewrite"] =  getRewrite($rows["name"],$rows["id"],1,$cfg["rewrite"]);

	$var["rs_n"][]=$rows;

}


require("uio_bomdata.php");
?>

