<?
function makethumb($srcFile,$dstFile,$dstW,$dstH,$rate=100,$markwords=null,$markimage=null) 
{
	$data = getimagesize($srcFile); 

	switch($data[2]) 
	{ 
	case 1: 
		$im=@ImageCreateFromGIF($srcFile); 
		break; 
	case 2: 
		$im=@ImageCreateFromJPEG($srcFile); 
		break; 
	case 3: 
		$im=@ImageCreateFromPNG($srcFile); 
		break; 
	} 
	if(!$im) return false; 
	$srcW=ImageSX($im); 
	$srcH=ImageSY($im); 
	$dstX=0; 
	$dstY=0; 
	//图像比例——宽高计算
	$resize_ratio=$dstW/$dstH;
	$ratio=$srcW/$srcH;
	if($ratio>=$resize_ratio)
	{
		$dstH=$dstW/$ratio;
	}
	else
	{
		$dstW=$dstH*$ratio;
	}
	//
	if ($srcW*$dstH>$srcH*$dstW) 
	{ 
	$fdstH = round($srcH*$dstW/$srcW); 
	$dstY = floor(($dstH-$fdstH)/2); 
	$fdstW = $dstW; 
	} 
	else 
	{ 
	$fdstW = round($srcW*$dstH/$srcH); 
	$dstX = floor(($dstW-$fdstW)/2); 
	$fdstH = $dstH; 
	} 
	$ni=ImageCreateTrueColor($dstW,$dstH); 
	$dstX=($dstX<0)?0:$dstX; 
	$dstY=($dstX<0)?0:$dstY; 
	$dstX=($dstX>($dstW/2))?floor($dstW/2):$dstX; 
	$dstY=($dstY>($dstH/2))?floor($dstH/s):$dstY; 
	$white = ImageColorAllocate($ni,255,255,255); 
	$black = ImageColorAllocate($ni,0,0,0); 
	imagefilledrectangle($ni,0,0,$dstW,$dstH,$white);// 填充背景色 
	imagecopyresampled($ni,$im,$dstX,$dstY,0,0,$fdstW,$fdstH,$srcW,$srcH); 
	if($markwords!=null) 
	{ 
		$markwords=iconv("gb2312","UTF-8",$markwords); 
		//转换文字编码 
		ImageTTFText($ni,20,30,450,560,$black,"simhei.ttf",$markwords); //写入文字水印 
		//参数依次为，文字大小|偏转度|横坐标|纵坐标|文字颜色|文字类型|文字内容 
	} 
	elseif($markimage!=null) 
	{ 
		$wimage_data = GetImageSize($markimage); 
		switch($wimage_data[2]) 
		{ 
			case 1: 
				$wimage=@ImageCreateFromGIF($markimage); 
				break; 
			case 2: 
				$wimage=@ImageCreateFromJPEG($markimage); 
				break; 
			case 3: 
				$wimage=@ImageCreateFromPNG($markimage); 
				break; 
		} 
		imagecopy($ni,$wimage,500,560,0,0,88,31); //写入图片水印,水印图片大小默认为88*31 
		imagedestroy($wimage); 
	} 
	ImageJpeg($ni,$dstFile,$rate); 
	imagedestroy($ni); 

}


function getImageURL($file,$style,$folder="uploadImage/",$urltype=0)
{
	global $imagestyle;
	if($urltype==1)
	{
		$arrlist = split(';',SERVER) ;
		$httpserver = "http://" . $arrlist[ rand(0,count($arrlist)-1 ) ] ;
		$imageurl = $httpserver . FOLDER . "image.php?pic=" . urlencode($file) . "&style=" . $style . "&folder=" . urlencode($folder);
		//$httpparam = "-". urlencode($folder) ."-". $imagestyle[$style][2] ."-". $imagestyle[$style][0]  . "-" . $imagestyle[$style][1];
		//$imageurl = $httpserver . FOLDER . "img-" . str_replace(".", $httpparam . "." , $file ); ;
	}
	elseif($urltype==2 )
	{ 
		$imageurl = FOLDER . "image.php?pic=" . urlencode($file) . "&style=" . $style . "&folder=" . urlencode($folder) ;
	}
	elseif($urltype==0)
	{
		
		$source =  FOLDER . $folder . trim($file) ;
		$imageurl =  FOLDER .  "smallImage/" . $imagestyle[$style][2] . "/" . trim($file) ;
		$height = $imagestyle[$style][0] ;
		$width = $imagestyle[$style][1] ;
		$to = FOLDER .  "smallImage/" . $imagestyle[$style][2] . "/" . trim($file) ;
		if( trim($file)=="" )
			return FOLDER .  "systemImage/"  . "noimg.gif";
		if ( ! file_exists( ROOT . $to ) )
		{
			if ( !file_exists( ROOT . $source ) )
				return FOLDER .  "systemImage/"  . "noimg.gif";
			if ( $style==-1 )
				return FOLDER .  $folder  . trim($file) ;
			$path_parts = pathinfo( ROOT . $to );
			$todir = $path_parts["dirname"] ;
			if( !file_exists($todir) )
			{
				makedir($todir);
			}
			//$resizeimage=new resizeimage( ROOT .$source,$height,$width,"0", ROOT . $to);
			//print_r(formatNumber(timing_current()*1000));
			makethumb(ROOT .$source,ROOT .$to,$height,$width);
			//if(!$resizeimage->save())
				//$imageurl = $source ;
		}
		else
		{
			
		}
	}
	return str_replace('#','%23',($imageurl));
}

function getImageResize($path,$maxwidth,$maxheight)
{
	$resize_ratio = $maxwidth / $maxheight ;
	$filearray = getimagesize (  $path );
	$ratio = $filearray[0] / $filearray[1] ;
	if( $ratio >= $resize_ratio)
	{
		return array( $maxwidth , ( $filearray[1] * $maxwidth ) / $filearray[0] ) ;
	}
	else
	{
		return array( ( $filearray[0] * $maxheight ) / $filearray[1] , $maxheight ) ;
	}
}

function deleteImage($file,$arr,$folder="../uploadImage/",$urlstyle=0)
{
	if($file=="")
		return ;
	if($urlstyle!=1)
	{
		$pic2 = $folder . $file ;
		if ( file_exists( $pic2 ) )
		{
			unlink( $pic2 ) ;
		}
		for($index=1;$index<count($arr);$index++)
		{
			$pic = "../smallImage/" . $arr[$index] . "/" . $file ;
			if ( file_exists( $pic ) )
			{
				unlink( $pic ) ;
			}
		}
		return true;
	}
	else
	{
		//debug(DELETECDN);
		if( DELETECDN == 1 )
		{
			$http = CGIBIN . "serviceFordeletepimage.php?" . "file=" . urlencode($file) . "&arr=" . urlencode( join('|',$arr) ) . "&folder=" . urlencode($folder) . "&" . REMOTECOMMAND ;
			$text =  file_get_contents( $http ) ;
		}
		//debug($http);
		//debug($text . $http );
	}
}


?>