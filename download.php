<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_download.html";

//--读取产品列表
$dclassid=getRequestInt("dclassid",$droot);
$pageurl="1=1";
$condition="where 1=1";

$arr_url=split( ',' , $dclass[$dclassid]["url"] );
$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a>";
$var["str_url_2"]=$dclass[$arr_url[count($arr_url)-1]]["name"];
$var["title"] = "{$cfg['lg']['download']} - " . $var["title"];
for($index=0;$index<count($arr_url);$index++)
{
	$var["str_url"] .= " " . $cfg["split_uri"] . " <a href='download.php?dclassid=" . $arr_url[$index] . "'><span class='daoa' >" . $dclass[$arr_url[$index]]["name"] . "</span></a>" ;
}

if($dclassid!=$droot)
{
	if( getRequestStr("sub","","") !="" )
	{
		$tree=fetchValue("select tree as v from @@@downclass where id=$dclassid",0);
		$condition .=  " and classid in (" . $tree . ")" ;
		$pageurl .= "&dclassid=" . $dclassid ;
		$pageurl .= "&sub=" . getRequestStr("sub","","") ;
	}
	else
	{
		$condition .=  " and classid=" . $dclassid ;
		$pageurl .= "&dclassid=" . $dclassid ;
	}
}

$pagenow=getQueryInt("page",1);
$pagesize=$config[82];
$rs=createPage("*","@@@download",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
loadPage($pagenow,$pagetotal,$pagesize,$recordcount,$var);
$var["pageurl"]=$pageurl;
while($rows=fetch($rs))
{
	$rows["addtime"]=formatDate( strtotime( $rows["addtime"] ) );
	if(substr($rows["path"],0,1)!="#")
		$rows["path"]="download/" . $rows["path"];
	else
		$rows["path"]=substr($rows["path"],1);
	$var["rs_d"][]=$rows;
}
free($rs);

require("uio_bomdata.php");
?>