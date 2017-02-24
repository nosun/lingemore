<?php
function formatDate($str)
{
	return strftime("%Y-%m-%d",$str);
}

function formatDatetime($str)
{
	return strftime("%Y-%m-%d %H:%M:%S",$str);
}

function isItemNotExist($rs)
{
	if(mysql_num_rows($rs)==0)
	{
		errorPage(1);
	}
}

function isItemExist($rs)
{
	if(mysql_num_rows($rs)!=0)
	{
		errorPage(0);
	}
}

function dataDefault($a,$b)
{
	if(empty($a))
		return $b;
	else
		return $a;
}

function DataFormatInt($tmp,$default=0,$isInt=true)
{
	if(  is_numeric($tmp) )
		if( $isInt )
			return (int)$tmp;
		else
			return $tmp;
	else
		return $default;
}

function errorPage($id)
{
	echo "<script>";
	echo "location.href='a_error.php?id=$id';";
	echo "</script>";
	die();
}

function goPage($url)
{
	header("Location: $url"); 
	exit();
}

function redirect($url)
{
	echo "<script>";
	echo "location.href='$url';";
	echo "</script>";
	exit();
}

function pageRedirect($msg,$url,$action="ok")
{
	echo "<script>";
	echo "location.href='a_error.php?id=$msg&action=$action&page=' + escape('$url');";
	echo "</script>";
	exit();
}

function parentAlertRedirect($msg,$url)
{
	echo "<script>";
	echo "alert('$msg');";
	echo "parent.location.href='$url';";
	echo "</script>";
	exit();
}

function alertRedirect($msg,$url,$ishref="")
{
	echo "<script>";
	echo "alert('$msg');";
	if($ishref=="")
		echo "location.href='$url';";
	echo "</script>";
	exit();
}
function c2tostr($str)
{
	$tmp="";
	$arr=str_split($str);
	for($indexI=count($arr)-1;$indexI>=0;$indexI--)
	{
		if( (int)$arr[count($arr)-$indexI-1] == 1 )
			$tmp=$tmp.pow(2,$indexI).",";
	}
	return $tmp."0";
}

function strtoint($arr)
{
	$tmp=0;
	for($indexI=0;$indexI<count($arr);$indexI++)
	{
		$tmp=$tmp + (int)$arr[$indexI];
	}
	return $tmp;
}

function debug($str="")
{
	print_r( $str );
	echo "</br>---------------COOKIE------------------</br>";
	print_r($_COOKIE);
	echo "</br>---------------SESSION------------------</br>";
	print_r($_SESSION);
	echo "</br>---------------FORM------------------</br>";
	print_r($_POST);
	echo "</br>---------------FORM------------------</br>";
	print_r($_REQUEST);
	die();
}

function timing_start ($name = 'default') 
{
      global $start_time;
      $start_time[$name] = explode(' ', microtime());
}

function timing_stop ($name = 'default') {
      global $end_time;
      $end_time[$name] = explode(' ', microtime());
}

function timing_current ($name = 'default') {
      global $start_time, $end_time;
      if (!isset($start_time[$name])) {
          return 0;
      }
      if (!isset($end_time[$name])) {
          $stop_time = explode(' ', microtime());
      }
      else {
          $stop_time = $end_time[$name];
      }
      // do the big numbers first so the small ones aren't lost
      $current = $stop_time[1] - $start_time[$name][1];
      $current += $stop_time[0] - $start_time[$name][0];
      return $current;
}

function formatNumber($str,$num=4)
{
	return sprintf("%01.$num"."f", $str);
}

function getRandomname($millsec=true)
{
	$str="";
	if($millsec)
	{
		list($usec, $sec) = explode(" ",microtime()); 
		$ms = (int)((float)$usec*1000); 
	}
	$str=strftime("%Y%m%d%H%M%S",time());
	return $str . $ms .rand(1,100000);
}

function emptyList($rs,$str)
{
	if( mysql_num_rows($rs)==0 )
		echo "<tr  align='center'  bgcolor='#FFFFFF'  onMouseOver='tr_onMouseOver(this)' onMouseOut='tr_onMouseOut(this)' ><td colspan='20' align='center'>对不起,尚未有相关数据</td></tr>";
}

function showDisp($arr)
{
	for($index=0;$index<count($arr);$index++)
		echo "<input name='disp[]' type='checkbox' value='" . pow(2,$index) . "' /> " . $arr[$index] . " ";
}

function getCoinChar($cfg,$index)
{
	return $cfg[90+$index];
}

function getIP()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP']))  
     {  
         $ip=$_SERVER['HTTP_CLIENT_IP'];  
     }  
     elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
     {  
         $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
    else 
    {  
        $ip=$_SERVER['REMOTE_ADDR'];  
   }  
	return $ip;
}

function fetch_HTML($stype,$svalue,$indexM,$str,$sprice,$sp1,$sp2)
{
	switch($stype)
	{
		case 0:
			echo "<input name='" . $str . $indexM . "' style='width:400px' type='text' value='$svalue'>";
			break;
		case 1:
			echo "<textarea name='" . $str . $indexM . "'  style='width:280px; height:60px;' >$svalue</textarea>";
			break;
		case 2:
			echo "<select name='" . $str . $indexM . "'>";
			$arr=split("," , $svalue );
			for($index=0;$index<count($arr);$index++)
			{
				echo "<option value='" . $arr[$index] . "'>" . $arr[$index] . "</option>";
			}
			echo "</select>";
			break;
		case 3:
			$arr=split(',' , $svalue );
			for($index=0;$index<count($arr);$index++)
			{
				echo "<input name='" . $str . $indexM . "[]' type='checkbox' value='" . $arr[$index] . "' /> " . $arr[$index] . " ";
			}
			break;
		case 4:
			echo "<input name='" . $str . $indexM . "' type='hidden' value='' /> 无需要填写默认值，系统将自动关联到产品的 <strong>细节图片</strong>";
			break;
	}
}

function fetch_sc_HTML($stype,$svalue,$indexM,$strkey,$sprice,$sp1,$sp2)
{
	global $cfg; 
	switch($stype)
	{
		case 0:
			return "<input id='style$indexM'  style='width:250px' name='style". $indexM . "'  type='text' value='$svalue'>";
			break;
		case 2:
			$str="";
			$str.= "<select id='style$indexM' name='style" . $indexM . "'>";
			$str.="<option value=''>{$cfg['lg']['please_select']} $strkey</option>";
			$arr=split("," , $svalue );
			for($index=0;$index<count($arr);$index++)
			{
				$str.= "<option value='" . $arr[$index] . "'>" . $arr[$index] . "</option>";
			}
			$str.= "</select>";
			return $str;
			break;
		case 3:
			$arr=split(',' , $svalue );
			for($index=0;$index<count($arr);$index++)
			{
				$str.="<input id='style$indexM'  name='style" . $indexM . "[]' type='checkbox' value='" . $arr[$index] . "' /> " . $arr[$index] . " ";
			}
			return $str;
			break;
		case 4:
			$arr=split(',' , $svalue );
			for($index=0;$index<count($arr);$index++)
			{
				$str.="<input id='property$index' name='property$index' type='checkbox' value='" . $arr[$index] . "' /> <input name='num$index' type='text' value='1' size='4' maxlength='4' /> "  . $arr[$index] . "<br />";
			}
			$str.="<input name='paddtocart' id='paddtocart' type='hidden' value='1' />";
			return $str;
			break;
		case 5:
			$arr=split(',' , $svalue );
			for($index=0;$index<count($arr);$index++)
			{
				if($index==0)
					$stre = "checked='checked'";
				else
					$stre = "";
				$str.="<input $stre id='style$indexM' name='style$indexM'  type='radio' value='" . $arr[$index] . "' />"  . $arr[$index] . "<br />";
			}
			return $str;
			break;
		case 6:
			$str.="<input id='style$indexM' name='style$indexM'  type='hidden' value='" . $svalue . "' />"  . $svalue;
			return $str;
			break;
		case 7:
			$arr=split(',' , $svalue );
			for($index=0;$index<count($arr);$index++)
			{
				$str.="<span id='span_style_" . $indexM . "_" . $index . "' onclick=\"span_style_chekck(this,'" . $arr[$index] . "','$indexM'," . count($arr) . ")\" class='span_bg'> " . $arr[$index] . "</span>";
			}
			$str.="<input id='style$indexM' name='style$indexM' type='hidden'/>";
			return $str;
			break;
		case 8:
			$str="";
			$str.= "<select id='style$indexM' name='style" . $indexM . "'>";
			$str.="<option value=''>---Please $strkey---</option>";
			$arr=split("," , $svalue );
			$arrprice=split("," , $sprice );
			for($index=0;$index<count($arr);$index++)
			{
				$str.= "<option value='" . $arr[$index] . "'>" . $arr[$index] . "&nbsp;&nbsp;+$sp1" . $arrprice[$index] . "</option>";
			}
			$str.= "</select>";
			return $str;
			break;
		case 9:
			$arr=split(',' , $svalue );
			$arrprice=split("," , $sprice );
			$str="";
			for($index=0;$index<count($arr);$index++)
			{
				$str.="<input id='style$indexM'  name='style" . $indexM . "[]' type='checkbox' value='" . $arr[$index] . "' /> " . $arr[$index] . "&nbsp;&nbsp;+<span class='red'>$sp1" . $arrprice[$index] . "</span><br />";
			}
			return $str;
			break;
		case 10:
			$arr=split(',' , $svalue );
			$arrprice=split("," , $sprice );
			for($index=0;$index<count($arr);$index++)
			{
				$tmp = split( '\|' , $arrprice[$index]);
				$str.="<span id='span_style_" . $indexM . "_" . $index . "' onclick=\"span_style_chekck2(this,'" . $arr[$index] . "','$indexM'," . count($arr) . ",'" . $tmp[1] . "')\" class='span_bg' style='background:url(" . $tmp[0] . ") no-repeat center #FFFFFF;'></span>";
			}
			$str.="<input id='style$indexM' name='style$indexM' type='hidden'/>";
			return $str;
			break;
	}
}

function isAuthorize($perm)
{
	if(!$perm)
		pageRedirect(11,"a_index_body.php","");
}

function permview($perm,$index)
{
	if( ! $perm[$index][0] )
		pageRedirect(7,"a_index_body.php","");
}

function permedit($perm,$index)
{
	if( ! $perm[$index][1] )
		pageRedirect(8,"a_index_body.php","");
}

function permadd($perm,$index)
{
	if( ! $perm[$index][2] )
		pageRedirect(9,"a_index_body.php","");
}

function permdel($perm,$index)
{
	if( ! $perm[$index][3] )
		pageRedirect(10,"a_index_body.php","");
}

function fetchPic($table,$id)
{
	$sql="select pic from $table where id=$id";
	$rs=query($sql);
	if( mysql_num_rows($rs)==0 )
	{
		mysql_free_result($rs);
		return "";
	}
	else
	{
		$rows=mysql_fetch_array($rs);
		$pic=$rows["pic"];
		mysql_free_result($rs);
		return $pic;
	}
}

function deletePpic($table,$condition,$arr,$folder)
{
	$sql="select pic from `$table` $condition";
	$rs=query($sql);
	while( $rows=mysql_fetch_array( $rs ) )
	{
		deleteImage( $rows["pic"] , $arr , $folder );
	}
	mysql_free_result($rs);
}

function getInfo($id,$default="")
{
	$sql="select content from @@@infoclass where id=$id";
	$rss=query($sql);
	if( mysql_num_rows( $rss ) == 0 )
	{
		mysql_free_result($rss);
		return $default;
	}
	else
	{
		$rows=mysql_fetch_array($rss);
		return $rows["content"];
	}
}

function array_remove_empty(& $arr, $trim = true)
{ 
	foreach ($arr as $key => $value) 
	{ 
		if (is_array($value)) 
		{ 
			array_remove_empty($arr[$key]); 
		} 
		else 
		{ 
			$value = trim($value); 
			if ($value == '') 
			{ 
				unset($arr[$key]); 
			} 
			elseif ($trim) 
			{ 
				$arr[$key] = $value; 
			} 
		} 
	} 
} 

function removeSplitEmpty( & $arr)
{
	foreach ($arr as $tmp)
	{
		;
	}
	if(empty($tmp) && count($arr)==1)
		$arr=array();
}

function getCoin($config,$index)
{
	return (float)$config[100+$index];
}

function getDiscount($config,$index)
{
	return (float)$config[120+$index];
}

function getPrice($num,$price1,$wholesalenum,$wholesalediscount,$lastdiscount,$cfg)
{
	$tmp=str_replace( $cfg["split"] , "" , $wholesalenum );
	if( trim($tmp)!="" )
	{
		$arrnum = split( $cfg["split"] , $wholesalenum );
		$arrdiscount = split( $cfg["split"] , $wholesalediscount );
		
		for( $index = 0 ; $index<count($arrnum) ; $index++ )
		{
			if( (int)$num <= (int)$arrnum[$index] )
			{
				return (float)($arrdiscount[$index]*$price1/100);
			}
		}
		return (float)($lastdiscount*$price1/100);
	}
	else
	{
		return (float)$price1;
	}
}

function formatAddress($cfg,$address)
{
	return $address;
}

function remove_dw_comments($tpl_source, &$smarty)
{
	$tpl_source=str_replace("<link type=\"text/css\" href=\"../pic/style.css\" rel=\"stylesheet\">","",$tpl_source);
	$tpl_source=str_replace("lazy_data_src",LAZY,$tpl_source);
	if(LAZY=="src")
	{
		$tpl_source=str_replace("src=\"../pic/blankpic.gif\"","",$tpl_source);
	}
	return str_replace("../pic/", FOLDER . "skin/" . SKIN . "/pic/",$tpl_source);				
}

function loadPage($pagenow,$pagetotal,$pagesize,$recordcount,&$var)
{
	$pagetmp =  ceil ( $pagenow/10) -1;
	$pagemaxnum = ceil ( $pagetotal/10 ) -1;
	if ( $pagetmp < $pagemaxnum)
	{
		$maxpagenum = 10 ;
	}
	else
	{
		if (  $pagetotal % 10 == 0 )
			$maxpagenum = 10;
		else
			$maxpagenum = $pagetotal % 10 ;
	}
	if ($pagetotal==0)
	{
		$maxpagenum = 0;
	}
	$var["maxpagenum"]=$maxpagenum;
	$var["pagemaxnum"]=$pagemaxnum;
	$var["pagenow"]=$pagenow;
	$var["pagetmp"]=$pagetmp;
	$var["pagetotal"]=$pagetotal;
	$var["recordcount"]=$recordcount;
	
	$var["recordend"]=($pagenow)*$pagesize;
	$var["recordstart"]=($pagenow-1)*$pagesize+1;
	$var["pagenext"]=$pagenow+1;
	$var["pagepre"]=$pagenow-1;
}

function callback_empty($str)
{
	if($str=="")
		return false;
	return true;
}

function makeHtml($url,$filename)
{
	
	$str = file_get_contents($url);
	file_put_contents ( $filename ,$str );
	
}

function makeRewrite($name)
{
	$arr_check = array('&','"',"'",'-','`','.',',','(',')','+','#','/',":");
	$arr_replace = array_fill ( 0 , count( $arr_check ) , ' ');
	$tmp=str_replace($arr_check,$arr_replace,$name);
	$tmp=clear_space($tmp);
	$tmp=urlencode(str_replace(" ","-",(trim($tmp))));
	return $tmp;
}

function getURIname($arr,$class,$level)
{
	$str=FOLDER;
	if(REWRITE==0)
		return  FOLDER ;
	if(LONGURL!="")
		return FOLDER;
	for($index=0;$index<=$level-1;$index++)
	{
		$str.= makeRewrite(($class[$arr[$index]]["name"])) . "/" ;
	}
	return $str;
}

function getIdURIname($class,$id,$indexurl=0)
{
	$str=FOLDER;
	if(REWRITE==0)
		return FOLDER;
	if(LONGURL!="")
		return FOLDER;
	$arr=split(',',$class[$id]["url"] ) ;
	for($index=0;$index<count($arr)-$indexurl;$index++)
	{
		$str.= makeRewrite($class[$arr[$index]]["name"]) . "/" ;
	}
	return $str;
}

function getRewritePre()
{
	if(URLSTART==1)
		return FOLDER . "index.php" . "/" ;
	else if(URLSTART==2)
		return FOLDER  ;
	else if(URLSTART==3)
		return FOLDER . "?" ;
}

function getRewrite($name,$id,$flag=0,$rewrite=1)
{
		global $class;
		$tmp=makeRewrite($name);
		// 分类的判断
		if($flag==3) 
		{
			if(CURLTYPE==1)
			{
				$tmp=$tmp."/".URLDIYNAME;
			}
			else if(CURLTYPE==2)
			{
				$tmp=URLDIYNAME."-".$tmp;
			}
			else if(CURLTYPE==3)
			{
				$tmp=URLDIYNAME;
			}
			else if(CURLTYPE==4)
			{
				$arr_url = split(',',$class[$id]["url"]);
				for($index=count($arr_url)-2;$index>=1;$index--)
				{
					$tmp = makeRewrite($class[$arr_url[$index]]["name"]) . "/".$tmp;
				}
			}
		}
		// 产品的判断
		if($flag==0)
		{
			if(PURLTYPE==1)
			{
				$classid=fetchValue("select classid as v from @@@product where id=$id",0);
				$catename=$class[$classid]["name"];
				$catename=makeRewrite($catename);
				$tmp=$catename."/".URLDIYNAME;
			}
			else if(PURLTYPE==2)
			{
				$tmp=URLDIYNAME."-".$tmp;
			}
			else if(PURLTYPE==3)
			{
				$tmp=URLDIYNAME;
			}
			else if(PURLTYPE==4)
			{
				$classid=fetchValue("select classid as v from @@@product where id=$id",0);
				$arr_url = split(',',$class[$classid]["url"]);
				for($index=count($arr_url)-1;$index>=1;$index--)
				{
					$tmp = makeRewrite($class[$arr_url[$index]]["name"]) . "/".$tmp;
				}
			}
		}
		//$tmp=urlencode(str_replace(" ","-",(trim(clear_space($tmp)))));
		$arr=array("p","n","i","c","nc","dc","ptag","s");
		return getRewritePre() . $tmp . "-" . $arr[$flag] . $id . ".html";
}
function clear_php_bom($file)
{
	$charset[1] = substr($file, 0, 1);
	$charset[2] = substr($file, 1, 1); 
	$charset[3] = substr($file, 2, 1);
	if ( ord($charset[1]) == 239 && ord($charset[2]) == 187 && ord($charset[3]) == 191) 
	{
		$file = substr($file, 3);
	}
	return $file;
}
function clear_space($str)
{
	return preg_replace("/[\s]{2,}/"," ",$str);
}
function str_replace_cn($a,$b,$str)
{
	mb_regex_encoding('EUC-CN');
	return mb_eregi_replace($a, $b, $str);
}

function r2n(& $number)
{
	if(FLOAT!=-1)
		$number=round($number,FLOAT);
}

function getDirSize($dir,&$totalsize,&$filenum)
     { 
        $handle = opendir($dir);
        while (false!==($FolderOrFile = readdir($handle)))
         { 
            $FolderOrFile = strtolower( $FolderOrFile );
			if($FolderOrFile != "." && $FolderOrFile != ".." && $FolderOrFile!="thumbs.db")  
             { 
                if(is_dir("$dir/$FolderOrFile"))
                 { 
                    getDirSize("$dir/$FolderOrFile",$totalsize,$filenum); 
                 }
                else
                 { 
                    //echo "$dir/$FolderOrFile" ;
					$totalsize += filesize("$dir/$FolderOrFile"); 
					$filenum++;
                 }
             }    
         }
        closedir($handle);
     }
	 
function makedir($mkpath)
{
    return is_dir($mkpath) or (makedir(dirname($mkpath)) and mkdir($mkpath));
}

function removeDir($dirName) 
{    
	if(! is_dir($dirName))     
	{         
		return false;     
	}    
	$handle = @opendir($dirName);     
	while(($file = @readdir($handle)) !== false)    
	{        
		if($file != '.' && $file != '..')        
		{             
			$dir = $dirName . '/' . $file;             
			is_dir($dir) ? removeDir($dir) : @unlink($dir);        
		}     
	}     
	closedir($handle);          
	return rmdir($dirName) ; 
} 

function getInfoList($father)
{
	$sql="select id,name,isrecord,left(content,500) as content from @@@infoclass where father=$father order by sort asc";
	$rs=query($sql);
	while($rows=fetch($rs))
	{
		if( strpos($rows["content"],"{#url}")===false )
			$rows["url"]=  getRewrite($rows["name"],$rows["id"],2,$cfg["rewrite"]) ;
		else
			{
				if( strpos($rows["content"],"{#url}http")!==false )
					$rows["url"]=str_replace("{#url}","",$rows["content"]);
				else
					$rows["url"]=FOLDER.str_replace("{#url}","",$rows["content"]);
			}
	$tmp[]=$rows;
	}
	free($rs);
	return $tmp;
}

function GrabImage($url,$storename) 
{ 
$a = file_get_contents($url);
if( $a!= "IMAGE_404" && $a!= "IMAGE_EMPTY")
{
	$path_parts = pathinfo(  $storename );
	$todir = $path_parts["dirname"] ;
	if( !file_exists($todir) )
	{
		makedir($todir);
	}
	file_put_contents($storename , $a) ;
	return true;
}
else
	return false;
} 

function getCountryHTML()
{
	$html = "";
	$sql="select * from @@@country where sort>0 order by sort asc";
	$rs = query($sql) ; 
	while($rows = fetch($rs) )
	{
		$html .= "<li  class='opt' title='".$rows["name"]."'><a href='javascript:;' class='selectcountry_".strtolower($rows["shortname"])."' >".$rows["name"]."</a></li>";
		
	}
	return $html ; 
}

function arr_diff($arr1,$arr2)
{
	$tmp = array();
	for($index=0;$index<count($arr1);$index++)
	{
		print_r( $arr1[$index] );
		if( !in_array($arr1[$index],$arr2 ) )
			$tmp[] = $arr1[$index] ;
	}
	return $tmp;
}

function getShortDomain()
{
	$domain = $_SERVER['SERVER_NAME'] ;
	$arrdomain = split("\." , $domain);
	$arrdomaincount = count( $arrdomain );
	return $arrdomain[$arrdomaincount-2] . "." . $arrdomain[$arrdomaincount-1] ;
}

function getExpressPrice($total,$type,$pnum,$pprice,$price1,$price2,$first)
{
	global $cfg;
	$totalprice ; 
	$tmp=str_replace( $cfg["split"] , "" , $pnum );
	if( false )
	{
		if( $type==0 )
		{
			if($total<=$first)
				return $price1;
			else
			{
				//$totalprice = $price1 ;
				//$total -= $first ;
				$arrnum = split( $cfg["split"] , $pnum );
				$arrprice = split( $cfg["split"] , $pprice );
				array_remove_empty($arrnum);
				array_remove_empty($arrprice);
				array_push( $arrnum , 1000000 ) ;
				array_push( $arrprice , $price2 ) ;
				for( $index = 0 ; $index<count($arrnum) ; $index++ )
				{
					if( $total>0 )
					{
						$totalprice += min( $arrnum[$index] - $arrnum[$index-1] , $total ) * $arrprice[$index];
						$total -= $arrnum[$index] ;
					}
					else
						break;
				}
				return $totalprice ;
			}
		}
		else if( $type==1 )
		{
			if($total<=$first)
				return $price1;
			else
			{
				//$totalprice = $price1 ;
				//$total -= $first ;
				$arrnum = split( $cfg["split"] , $pnum );
				$arrprice = split( $cfg["split"] , $pprice );
				array_remove_empty($arrnum);
				array_remove_empty($arrprice);
				//array_push( $arrnum , 1000000 ) ;
				//array_push( $arrprice , $price2 ) ;
				
				for( $index = 0 ; $index<count($arrnum) ; $index++ )
				{
					if( $total>0 )
					{
						$tempweightnum =  ceil( 2*min($arrnum[$index]-$arrnum[$index-1],$total) ) ;
						$totalprice += $tempweightnum * $arrprice[$index];
						$total -= $arrnum[$index-1] ;
						//echo $totalprice;
					}
					else
						break;
				}
				return $totalprice ;
			}
		}
		
	}
	else
	{
		if( $type==0 )
		{
			return $price2 * ($total-1) + $price1 ;
		}
		else if( $type==1 )
		{
			if($total<=$first)
			{
				return $price1 ;
			}
			else
			{
				return  $price2 * ceil(($total-$first)*2) + $price1   ;
			}
		}
	}
	return 0;
}

function DeleteSpaceBR($str) 
{ 
$str = trim($str); 
$str = strip_tags($str,""); 
$str = ereg_replace("\t","",$str); 
$str = ereg_replace("\r\n","",$str); 
$str = ereg_replace("\r","",$str); 
$str = ereg_replace("\n","",$str); 
return trim($str); 
}

function getRemoteData($url,$charsetfrom="",$charsetto="",$timeout=60)
{
	$ch = curl_init(); 
	$url = parseurl($url);
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch,CURLOPT_HEADER,0);   
	curl_setopt($ch,CURLOPT_TIMEOUT,$timeout);   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
	//在需要用户检测的网页里需要增加下面两行 
	//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
	//curl_setopt($ch, CURLOPT_USERPWD, US_NAME.":".US_PWD); 
	$contents = curl_exec($ch); 
	curl_close($ch); 
	if( $charsetfrom!="" && $charsetto!="" )
	{
		$contents = iconv($charsetfrom, $charsetto,$contents);
	}
	return $contents; 

}

function GrabRemoteImage($url,$path="../uploadImage/") 
{
    if($url=="") 
		return "Empty";
	if(strpos(strtolower($url),".jpg")!==false)
		$ext = ".jpg";
	if(strpos(strtolower($url),".png")!==false)
		$ext = ".png";
	if(strpos(strtolower($url),".gif")!==false)
		$ext = ".gif";
	if(strpos(strtolower($url),".jpeg")!==false)
		$ext = ".jpeg";
	if($ext=="")
		return "Error Ext";
	$filename=rand(1,10000).$ext;
	$strdir = date("mdHi")."/";
	$path .= $strdir;
	if(!is_dir($path))
	{
		makedir($path);
	}
	$a = getRemoteData(parseurl($url));
	file_put_contents($path.$filename , $a) ;
	return $strdir.$filename;
}

function  log_result($word,$classname,$classid) 
{
	$fp = fopen("log/log-{$classname}-c{$classid}.txt","a");
	flock($fp, LOCK_EX) ;
	fwrite($fp,$word."\r\n");
	flock($fp, LOCK_UN);
	fclose($fp);
}

//-------------产品相关的函数
function getDispProduct($disp,$pagesize,$picstyle)
{
	global $config;
	global $cfg;
	global $discount;
	global $rate;
	global $app;
	global $urltype;
	$str = "p_disp_" . $disp ; 
	if($app->get("p_disp_$disp"))
		$sql="select * from @@@product where id in (" . dataDefault($app->data[$str],0) . ")  order by addtime desc   limit 0,$pagesize";
	else
	{
		$sql="select * from @@@product where disp & $disp = $disp  and  state>=0 order by addtime desc limit 0,$pagesize";
	}
	$rs=query($sql);
	$tmp=array(0);
	while($rows=fetch($rs))
	{
		$rows["rewrite"]= getRewrite($rows["name"],$rows["id"],0,$cfg["rewrite"]);
		$rows["realpic"]= $config[61] . getImageURL($rows["pic"],$picstyle,"uploadImage/",$urltype);
		//$rows["bigpic"]= $config[61] . getImageURL($rows["pic"],2,"uploadImage/",$urltype);
		$rows["price"]= $rows["price1"] * $discount * $rate;
		r2n( $rows["price"] );
		if(!$rows["price2"] && ($config[117]!="")) 
			eval("\$rows['price2']={$rows['price']} {$config[116]} {$config[117]};");
		$tmp[]=$rows["id"];
		$tmprows[]=$rows;
	}
	free($rs);
	$app->data[$str]=join(',',$tmp);
	return $tmprows;
}



function parseurl($url="")
{
	$a = array(" ");
	$b = array("%20");
	$url = str_replace($a, $b, $url);
	return $url;
}

function sort_rows(&$data,$field,$sort_way=SORT_ASC)
{
	foreach ($data as $key => $row)
	{
		$volume[$key]  = $row[$field];
	}
	array_multisort($volume, $sort_way, $data);
	
}

function getOnlyCode()
{
	$str_code = "";
	while($str_code=="")
	{
		$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		$l = strlen($str);
		for($i=1;$i<=8;$i++)
		{
		$num=rand(0,25); 
		$str_code .= $str[$num]; 
		}
		if(fetchCount("@@@coupon","where name like '".$str_code."'")!=0)
			$str_code = "";
	}
	return $str_code ;
}

function MoveDir($source,$target)
{
	if(is_dir($source))
	{
		$dest_name=basename($source);
		if(!mkdir($target.$dest_name))
		{
			return false;
		}
		$d=dir($source);
    	while(($entry=$d->read())!==false)
    	{
			if(is_dir($source.$entry))
			{
				if($entry=="."||$entry=="..")
				{
					continue;
				}
				else
				{
					MoveDir("$source$entry\\","$target$dest_name\\"); 
				}
			}
			else
			{
				if(!copy("$source$entry","$target$dest_name\\$entry"))
				{
					return false;
				}
			}                  
		}          
	}
	else
	{
		if(!copy("$source$entry","$target$dest_name\\"))
		{
			return false;
		}          
	}          
	return true;  
}

function formatString($format,$arr1=array(),$arr2=array())
{
	$strrand = rand(100000000,999999999);
	$arr_check = array('%Year%','%year%','%Month%','%month%','%Day%','%day%','%Hour%','%hour%','%ghour%','%Ghour%','%Minite%','%Second%','%rand1%','%rand2%','%rand3%','%rand4%','%rand5%','%rand6%','%rand7%','%rand8%','%rand9%');
	$arr_rplace = array (date('Y'),date('y'),date('m'),date('n'),date('d'),date('j'),date('H'),date('G'),date('h'),date('g'),date('i'),date('s'),substr($strrand,0,1),substr($strrand,0,2),substr($strrand,0,3),substr($strrand,0,4),substr($strrand,0,5),substr($strrand,0,6),substr($strrand,0,7),substr($strrand,0,8),substr($strrand,0,9));
	$tmp=str_replace($arr_check,$arr_rplace,$format);
	$tmp=str_replace($arr1,$arr2,$tmp);
	return $tmp;
}

function addToMailQueue($vartmp,$is_multi=false)
{
	if($is_multi)
	{
		$arr_var = 	$vartmp;
	}
	else
	{
		$arr_var[0] = 	$vartmp;	
	}
	for($index=0;$index<count($arr_var);$index++)
	{
		$param = array();
		$param["name"] = "加入队列中...";
		$param["state"] = 0 ;
		$param["addtime"]=formatDateTime(time());
		$param["var"] = json_encode($arr_var[$index]);
		$sql=insertSQL($param,"@@@mailqueue");
		query($sql);
		$id[] = mysql_insert_id();
	}
	if(count($id)>0)
	{
		$str_url = "http://".$_SERVER['SERVER_NAME'] .  FOLDER . "service/serviceForTriggerMail.php?id=" . join(',',$id) ;
		getRemoteData($str_url,"","",2);
	}
}

?>