<?
function getClientOS()
{
	if(empty($_SERVER['HTTP_USER_AGENT']))
	{
		return 'Unknown';
	}
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$os  = '';
	if(strpos($agent,'win')!==false)
	{
		if(strpos($agent,'nt 5.1')!==false)
	{
		$os = 'Windows XP';
	}
	elseif(strpos($agent,'nt 5.2')!==false)
	{
		$os = 'Windows 2003';
	}
	elseif(strpos($agent,'nt 5.0')!==false)
	{
		$os = 'Windows 2000';
	}
	elseif(strpos($agent,'nt 6.0')!==false)
	{
		$os = 'Windows Vista';
	}
	elseif(strpos($agent,'nt')!==false)
	{
		$os = 'Windows NT';
	}
	elseif(strpos($agent,'win 9x')!==false && strpos($agent,'4.90')!==false)
	{
		$os = 'Windows ME';
	}
	elseif(strpos($agent,'98')!==false)
	{
		$os = 'Windows 98';
	}
	elseif(strpos($agent,'95')!==false)
	{
		$os = 'Windows 95';
	}
	elseif(strpos($agent,'32')!==false)
	{
		$os = 'Windows 32';
	}
		elseif(strpos($agent,'ce')!==false)
	{
		$os = 'Windows CE';
	}
	}
	elseif(strpos($agent,'linux')!==false)
	{
		$os = 'Linux';
	}
	elseif(strpos($agent,'unix')!==false)
	{
		$os = 'Unix';
	}
	elseif(strpos($agent,'sun')!==false && strpos($agent,'os')!==false)
	{
		$os = 'SunOS';
	}
	elseif(strpos($agent,'ibm')!==false && strpos($agent,'os')!==false)
	{
		$os = 'IBM OS/2';
	}
	elseif(strpos($agent,'mac')!==false && strpos($agent,'pc')!==false)
	{
		$os = 'Macintosh';
	}
	elseif(strpos($agent,'powerpc')!==false)
	{
		$os = 'PowerPC';
	}
	elseif(strpos($agent,'aix')!==false)
	{
		$os = 'AIX';
	}
	elseif(strpos($agent,'hpux')!==false)
	{
		$os = 'HPUX';
	}
	elseif(strpos($agent,'netbsd')!==false)
	{
		$os = 'NetBSD';
	}
	elseif (strpos($agent,'bsd')!==false)
	{
		$os = 'BSD';
	}
	elseif (strpos($agent,'osf1')!==false)
	{
		$os = 'OSF1';
	}
	elseif (strpos($agent,'irix')!==false)
	{
		$os = 'IRIX';
	}
	elseif(strpos($agent,'freebsd')!==false)
	{
		$os = 'FreeBSD';
	}
	elseif(strpos($agent,'teleport')!==false)
	{
		$os = 'teleport';
	}
	elseif(strpos($agent,'flashget')!==false)
	{
		$os = 'flashget';
	}
	elseif(strpos($agent,'webzip')!==false)
	{
		$os = 'webzip';
	}
	elseif(strpos($agent,'offline')!==false)
	{
		$os = 'offline';
	}
	else
	{
		$os = 'Unknown';
	}
	return $os;
}


function getClientBrowser()
{
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'Maxthon')) {   
   	 	$browser = 'Maxthon';   
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0')) {   
	   $browser = 'MSIE 8.0';   
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0')) {   
		$browser = 'MSIE 7.0';   
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {   
		$browser = 'MSIE 6.0';   
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'NetCaptor')) {   
	   $browser = 'NetCaptor';   
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape')) {   
		$browser = 'Netscape';   
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Lynx')) {   
		$browser = 'Lynx';   
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera')) {   
		$browser = 'Opera';  
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {   
		$browser = 'Chrome'; 
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Konqueror')) {   
		$browser = 'Konqueror';   
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {   
		$browser = 'Firefox';   
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'],'Safari')) {   
		$browser = 'Safari';   
	} else {   
		$browser = 'Unknown';   
	}   
	return $browser; 
}

?>