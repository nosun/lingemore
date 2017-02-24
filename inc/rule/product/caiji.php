<?

function preg_p_name($html)
{
	$pattern="/<h2>(.*)<\/h2>/i";
	preg_match($pattern,$html,$matches);
	return $matches[1];
}

function preg_p_itemno($html)
{
	$pattern="/<b class=\"ics\">(.*)<\/b>/i";
	preg_match($pattern,$html,$matches);
	$Pitemno=$matches[1];
	$itemnoarr=split(':',$Pitemno);
	$Pitemno=trim($itemnoarr[1]);
	return $Pitemno;
}

function preg_p_price1($html)
{
	return 0;
	$pattern="/<span class=\"market_price\" id=\"market_price\" >(.*)<\/span>/i";
	preg_match($pattern,$html,$matches);
	
	//--  确保 $matches[1] 的内容 含有 价格就足够了。。
	$strtemp = str_replace(",","",$matches[1]);
	preg_match("/([\d]+(\.)+[\d]+)/i",$strtemp,$matches_final);
	return $matches_final[1];
}

function preg_p_price2($html)
{
	return 0;
	//--  确保 $matches[1] 的内容 含有 价格就足够了。。
	$strtemp = str_replace(",","",$html);
	preg_match("/([\d]+(\.)+[\d]+)/i",$strtemp,$matches_final);
	return $matches_final[1];
}

function preg_p_weight($html)
{
	return "0";
}

function preg_p_pic($html)
{
	$urlpic = str_replace(" ","%20",$urlpic);
	return "http://s.tidebuy.com/images/product/0/253/253316_1.jpg";
}

function preg_p_otherpic($html)
{
	if(true)	
		return array("http://s.tidebuy.com/images/product/0/253/253316_1.jpg","http://s.tidebuy.com/images/product/0/253/253316_1.jpg");
	else
		return array();
	
	$urlpic = str_replace(" ","%20",$urlpic);
}

function preg_p_content($html)
{
	return "asdfasdf";
	
	$strhtml1=preg_replace("/\r/i","",$html);
	$strhtml1=preg_replace("/\n/i","",$strhtml1);
	$strhtml1=preg_replace("/\t/i","",$strhtml1);
	// 文本规则
	$pattern="";
	// 远程图片规则
	$patternpic="/<img[^>]+src\s*=\s*[\"|\']?([^>\"]*)[^>]+>/i"; 
	// ###################
	preg_match($pattern,$strhtml1,$matches);
	preg_match_all($patternpic,$matches[1],$matchespic);
	
	//保留的部分----远程采集图片
	
	preg_match($pattern,$strhtml1,$matches);
	preg_match_all($patternpic,$matches[1],$matchespic);
	$cpicarr=$matchespic[1];
	for($index=0;$index<count($cpicarr);$index++)
	{
		// 调试的时候，，这一块可以直接BREAK;
		//break;
		$cpicarr[$index] = str_replace(" ","%20",$cpicarr[$index]);
		if(strpos($cpicarr[$index],"http")===false)
			$cpicarr[$index]=FOLDER."articleimage/".GrabRemoteImage("http://域名/".$cpicarr[$index],"../articleimage/");
		else
			$cpicarr[$index]=FOLDER."articleimage/".GrabRemoteImage($cpicarr[$index],"../articleimage/");
		
	}
	$content=str_replace($matchespic[1],$cpicarr,$matches[1]);
	//
	$content=preg_replace("/<a[^>]+>/i","",$content);
 	$content=preg_replace("/<\/a>/i","",$content);
	return $content;

}

/*
$str = file_get_contents("../p_template.html");
echo "name:" . preg_p_name($str) . "<br />";
echo "itemno:" . preg_p_itemno($str) . "<br />";
echo "price1:" . preg_p_price1($str) . "<br />";
echo "price2:" . preg_p_price2($str) . "<br />";
echo "weight:" . preg_p_weight($str) . "<br />";
echo "Pic:" . preg_p_pic($str) . "<br />";
echo "Other:" ;
print_r(preg_p_otherpic($str)) ;
echo "<br />";
echo "Content:" . preg_p_content($str) . "<br />";
*/

?>