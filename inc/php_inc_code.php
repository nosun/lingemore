<?
Header("Content-type:image/gif");
session_start();
$authnum =""; 
$str = 'abcdefghjkmnpqrstuvwxyz234567890'; 
$l = strlen($str);
for($i=1;$i<5;$i++)
{
$num=rand(0,$l-1); 
$authnum .= $str[$num]; 
}
$_SESSION["code"] = $authnum;
srand((double)microtime()*1000000);
$im = imagecreate(50,20);
//$black = imagecolorallocate($im, 0,0,0); 
$white = imagecolorallocate($im, rand(127,255),rand(127,255),rand(127,255)); 
$gray = imagecolorallocate($im, rand(0,127),rand(0,127),rand(0,127)); 
imagefill($im,50,20,$white); 
imagestring($im, 5, 8, 3, $authnum, $gray);
for($i=0;$i<90;$i++)
{
	imagesetpixel($im, rand()%70 , rand()%30 , $gray);
}
imagepng($im);
ImageDestroy($im);
?>