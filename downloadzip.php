<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_downloadzip.html";

//--读取产品列表

$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['download']}";
$var["str_url_2"]="{$cfg['lg']['download']}";
$var["title"] = "{$cfg['lg']['download']} - " . $var["title"];
$arr_son=array_filter(split( ',' , $class[$proot]["son"] ),callback_empty);

$sql = "select * from @@@productdisp order by value asc";
$d_rs = query($sql);
while($rows=fetch($d_rs))
{
	$disp = $rows["id"];
	$name = $rows["name"] ;
	$rows["download"] = "download/".makeRewrite($name)."-s$disp".".zip" ;
	$rows["rartime"] = formatDate(filemtime("download/".makeRewrite($name)."-s$disp".".zip"));
	$rows["name"] = $name ;
	$rows["rewrite"] =  getRewrite($rows["name"],$rows["id"],7) ;
	$var["rs_zip"][]=$rows;
}

for($index=0;$index<count($arr_son);$index++)
{
	$rows=array();
	$rows["id"]=$arr_son[$index];
	if( $class[$arr_son[$index]]["state"]==0 )
		continue;
	$rows["name"] = $class[$arr_son[$index]]["name"] ;
	$rows["download"] = "download/".makeRewrite($rows["name"])."-c".$rows["id"].".zip" ;
	$rows["rartime"] = formatDate(filemtime("download/".makeRewrite($rows["name"])."-c".$rows["id"].".zip"));
	
	$arr_son2=array_filter(split( ',' , $class[$rows["id"]]["son"] ),callback_empty);
	if( !count($arr_son2) )
	{
		$rows["rewrite"] =  getRewrite($class[$arr_son[$index]]["name"],$arr_son[$index],3,$cfg["rewrite"]);
	}
	else
	{
		$rows["rewrite"] = "javascript:showdownloadidv('downloadidv".$rows["id"]."')";
	}
	for($indexj=0;$indexj<count($arr_son2);$indexj++)
	{
		if( $class[$arr_son2[$index]]["state"]==0 )
			continue;
		$rows2=array();
		$rows2["id"]=$arr_son2[$indexj];
		$rows2["name"] = $class[$arr_son2[$indexj]]["name"] ;
		$rows2["rewrite"] =  getRewrite($class[$arr_son2[$indexj]]["name"],$arr_son2[$indexj],3,$cfg["rewrite"]);
		$rows2["rartime"] = formatDate(filemtime("download/".makeRewrite($rows2["name"])."-c".$rows2["id"].".zip"));
		$rows2["download"] = "download/".makeRewrite($rows2["name"])."-c".$rows2["id"].".zip" ;
		$rows["arrson"][]=$rows2;
	}
	$var["rs_zip"][]=$rows;
}



require("uio_bomdata.php");
?>