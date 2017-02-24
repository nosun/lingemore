<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

//if member
if($userid!=-1)
	redirect("profile.php?action=leave_message");

$template_file = "lay_feedback.html";
//--读取产品列表
$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['feedback']}";
$var["str_url_2"]="{$cfg['lg']['feedback']}";
$var["title"] = "{$cfg['lg']['feedback']} - " . $var["title"];
//-------Feedback。。。
/*
$condition .=  " where cid=3";
$pageurl="1=1";
$pagenow=getQueryInt("page",1);
$pagesize=$config[84];
$rs=createPage("*","@@@message",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
loadPage($pagenow,$pagetotal,$pagesize,$recordcount,$var);
$var["pageurl"]=$pageurl;
while($rows=fetch($rs))
{
	$rs_f[]=$rows;
}
free($rs);
$var["rs_f"]=$rs_f;
*/
$info[] = 98 ;

require("uio_bomdata.php");
?>