<?php
//----Query相关
function getQuery($str)
{
	$tmp=filter($_GET[$str]);
	return $tmp;
}	

function getQuerySQL($str)
{
	$tmp=filter($_GET[$str]);
	if(  is_numeric($tmp) )
		return (int)$tmp;
	else
		errorPage(2);
}

function getQueryDefault($str,$default)
{
	$tmp=filter($_GET[$str]);
	if( $tmp=="" )
		return $default;
	else
		return $tmp;
}

function getQueryInt($str,$default=0,$isInt=true)
{
	$tmp=filter($_GET[$str]);
	if(  is_numeric($tmp) )
		if( $isInt )
			return (int)$tmp;
		else
			return $tmp;
	else
		return $default;
}

function getQueryUntrim($str)
{
	$tmp=filter($_GET[$str],false);
	return $tmp;
}
//----Form相关
function getForm($str)
{
	$tmp=filter($_POST[$str]);
	return $tmp;
}

function getFormStr($str,$default="")
{
	$str=filter($_POST[$str]);
	if( is_array($str) )
	{
		if( count($str)==0 )
			return $default;
		else
			return  join(',',$str);
	}
	else
		return  $str;
}

function getFormDefault($str,$default)
{
	$tmp=filter($_POST[$str]);
	if( $tmp=="" )
		return $default;
	else
		return $tmp;
}

function getFormSQL($str)
{
	$tmp=filter($_POST[$str]);
	if(  is_numeric($tmp) )
		return (int)$tmp;
	else
		errorPage(2);
}

function getFormInt($str,$default=0,$isInt=true)
{
	$tmp=filter($_POST[$str]);
	if(  is_numeric($tmp) )
		if( $isInt )
			return (int)$tmp;
		else
			return $tmp;
	else
		return $default;
}

function getFormUntrim($str)
{
	$tmp=filter($_POST[$str],false);
	return $tmp;
}

//---Request相关
function getRequest($str)
{
	$tmp=filter($_REQUEST[$str]);
	return $tmp;
}

function getRequestDefault($str,$default)
{
	$tmp=filter($_REQUEST[$str]);
	if( $tmp=="" )
		return $default;
	else
		return $tmp;
}

function getRequestSQL($str)
{
	$tmp=filter($_REQUEST[$str]);
	if( is_numeric($tmp) )
		return (int)$tmp;
	else
		errorPage(2);
}

function getRequestInt($str,$default=0,$isInt=true)
{
	$tmp=filter($_REQUEST[$str]);
	if(  is_numeric($tmp) )
		if( $isInt )
			return (int)$tmp;
		else
			return $tmp;
	else
		return $default;
}

function getRequestUntrim($str)
{
	$tmp=filter($_REQUEST[$str],false);
	return $tmp;
}

function getRequestStr($str,$arrdefault="",$strdefault="")
{
	$str=filter($_REQUEST[$str]);
	if( is_array($str) )
	{
		if( count($str)==0 )
			return $arrdefault;
		else
			return  join(',',$str);
	}
	else
	{
		if($str=="")
			return  $strdefault;
		else
			return $str;
	}
}

function getHTML($str)
{
	$strhtml = $_REQUEST[$str];
	if (get_magic_quotes_gpc()) 
	{
      	return stripslashes( $strhtml);
   	}
	else
		return $strhtml;
}

function getFormSafe($str)
{
	$strhtml = $_REQUEST[$str];
	if (get_magic_quotes_gpc()) 
	{
      	$strhtml = stripslashes( $strhtml);
   	}
	return htmlspecialchars( $strhtml ) ;
}
function filterSQL($str)
{
	return mysql_escape_string($str) ;
}

//----filteSQL
function filter($str,$needtrim=true)
{
	
	if( !is_array($str) )
	{
		if( $needtrim )
			$str = trim ( $str) ;
		else
			$str =  ( $str) ;
		if (get_magic_quotes_gpc()) 
		{
      		 $str = stripslashes($str);
   		}

		//$tmpname = str_replace(array("'"),array("\'"),$tmpname);
		return ($str."");
	}
	else
		return $str;
}

?>