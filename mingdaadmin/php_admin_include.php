<?php

ob_start();

header('Content-Type: text/html; charset=utf-8');

require("../inc/php_inc.php");

require($cfg["fckedit"]["require"]);

$cfg["domain"] = getShortDomain();

if( $_COOKIE["admin_name"]=="" ||  $_COOKIE["admin_pwd"]=="")

{

	setcookie("admin_name","", time() - 3600);

	setcookie("admin_pwd","", time() - 3600);

	parentAlertRedirect("您尚未登录","index.php?redirect_url=".urlencode($_SERVER['REQUEST_URI']));

}

$sql="select * from @@@admin where name='" . filterSQL($_COOKIE["admin_name"]) . "' and pwd='" . filterSQL($_COOKIE["admin_pwd"]) . "' limit 1";

$rs=query($sql);

if( mysql_num_rows( $rs ) == 0 )

	parentAlertRedirect("您尚未登录","index.php?redirect_url=".urlencode($_SERVER['REQUEST_URI']));



//query($sql);

$rows=mysql_fetch_array( $rs );

$_SESSION["imageuser"]="ok";

$_SESSION["admin"] = $rows["id"];

$adminid = $rows["id"];

$adminname = $rows["name"];

$adminpwd = $rows["pwd"] ;

$adminnickname = $rows["nickname"] ;

$ip= $rows["ip"];

$lasttime= $rows["lasttime"];

$supper = $rows["supper"];

if( $supper==9 )

	$issupper=1;

$arrperm = split( $cfg["split"] , $rows["perm"] );

array_pad ( $arrperm , 50 , 0 );



//-------------------------

$group = array() ;

$strgroup = decbin($rows["groupid"]) + "";

for($index=0;$index<strlen($strgroup);$index++)

{

	if( substr($strgroup,strlen($strgroup)-$index-1,1)=="1" )

		$group[$index] = true ;

	else

		$group[$index] = false ;

}



mysql_free_result ( $rs );



$oFCKeditor = new FCKeditor('content') ;

$oFCKeditor->BasePath = $cfg["fckedit"]["basepath"] ;

$oFCKeditor->Width = $cfg["fckedit"]["width"] ;

$oFCKeditor->Height = $cfg["fckedit"]["height"] ;



$glo["fck"] = $oFCKeditor ;

$glo["supper"]=$supper;



if(IMAGE==1)

{

	$remotecgi =  ( "http://" . $cfg["remoteServer"][0]  . FOLDER . "cgi-bin/" );

	$remoteupload = $remotecgi . "php_upload.php" ;

	$remoteserver = "http://" . $cfg["remoteServer"][0]. FOLDER ;

}

else

{

	$remoteupload = "php_upload.php";

	$remotecgi = "";

	$remoteserver = FOLDER;

}

define("DELETECDN",$config[57]) ;

define("CGIBIN",($remotecgi));

define("LOCALCGIBIN",(""));

define("REMOTE",$remoteserver);

define("REMOTEUPLOAD",$remoteupload);

define("REMOTECOMMAND","name=" . $config[58] . "&pwd=" . $adminpwd . "&securitykey=" . $config[88] );

define("IMAGEMOD",$cfg["imageMod"]);

?>