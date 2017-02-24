<?php 
require("../inc/php_inc_config.php");
require("../inc/php_inc_request.php");
require("../inc/php_inc_function.php");
set_time_limit(0);
ignore_user_abort(true);
if(  getQuery("name")!="" )
{
	if( getQuery("name")!=CDNKEY)
	{
		die("Reg Error");
	}
}
else
{
	die("Reg Error");
}
$imageurl_str = getQuery("url"); //http://php9.35zh.com/aaalux/uploadImage/03300328/3747.jpg
if($imageurl_str=="")
	die("no");
$imageurl=explode("|",$imageurl_str);
$imagecontent = getRemoteData($imageurl[0].$imageurl[1].$imageurl[2]);
if($imagecontent=="")
	die("no");
else
{
	$dir="../".$imageurl[1].dirname($imageurl[2]);
	if(!is_dir($dir))
	{
		makedir($dir);
	}
	file_put_contents("../".$imageurl[1].$imageurl[2] , $imagecontent) ;
}
echo "yes";
?>