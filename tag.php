<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_ptag.html";

//--- 读取标题
$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >Home</span></a> " . $cfg["split_uri"] . " Tag";
$var["str_url_2"]="Tag";

$maxptag = fetchValue("select max(count) as v from @@@ptaglist",1);
$minptag = fetchValue("select min(count) as v from @@@ptaglist",1);

$sql = "select * from @@@ptaglist order by id desc";
$rs = query($sql);
while( $rows = fetch( $rs ) )
{
	$rows["font"] = (int) ( ($rows["count"]-$minptag)*10/($maxptag-$minptag) + 8 ) ;
	$rows["rewrite"] = getRewrite($rows["name"],$rows["id"],6  );
	$var["rs_tag"][] = $rows; 
}

require("uio_bomdata.php");
?>

