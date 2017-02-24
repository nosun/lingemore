<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$template_file = "lay_comment.html";

//--读取产品列表
$var["str_url"]="<a  href='".FOLDER."'><span class='daoa' >Home</span></a> " . $cfg["split_uri"] . " Comment";
$var["str_url_2"]="Comment";
$var["title"] =  "Comment - " . $var["title"];
//-------Feedback。。。
$cid=getQueryInt("cid",0);
$pid=getQueryInt("pid",0);
$var["cid"]=$cid;
$var["pid"]=$pid;
$var["pname"]=getQuery("name");
$condition =  " where  cid=$cid";
$pageurl="comment.php?cid=$cid";
if($pid)
{
$condition .=" and pid=$pid"; 
$pageurl .="&pid=$pid";
}

$pagenow=getQueryInt("page",1);
$pagesize=$config[83];
$rs=createPage("*","@@@message",$condition," order by id desc",$pagesize,$pagenow,$pagetotal,$recordcount);
loadPage($pagenow,$pagetotal,$pagesize,$recordcount,$var);
$var["pageurl"]=$pageurl;
while($rows=fetch($rs))
{
	$rows["content"]=nl2br($rows["content"]);
	$rows["addtime"] = date("M j,Y",strtotime($rows["addtime"]));
	$rs_comment[]=$rows;
}
free($rs);
$var["rs_comment"]=$rs_comment;

require("uio_bomdata.php");
?>