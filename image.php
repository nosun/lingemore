<?
ob_start();
require("inc/php_inc_config.php");
require("inc/php_inc_image.php");
function makedir($mkpath)
{
    return is_dir($mkpath) or (makedir(dirname($mkpath)) and mkdir($mkpath));
}


$pic = $_GET["pic"];
$style = $_GET["style"];
$folder = $_GET["folder"];
$imageurl = getImageURL($pic,$style,$folder,0) ;
if(strpos(strtolower($pic),".jpg")!==false)
	header("Content-type: image/jpg");
else if(strpos(strtolower($url),".png")!==false)
	header("Content-type: image/png");
else if(strpos(strtolower($url),".gif")!==false)
	header("Content-type: image/gif");
else if(strpos(strtolower($url),".jpeg")!==false)
	header("Content-type: image/jpeg");
header("Content-Disposition: inline; filename=image.jpg"); 
readfile(ROOT.$imageurl); 
exit;
?>