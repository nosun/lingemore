<?
require("../inc/php_inc.php");
require("php_checkadmin.php");
$folder=getRequest("folder");
$arrfolder = array();
$tmparr = explode('/',$folder) ;
$level = count($tmparr);

$filenum = 0;
$handle = opendir( ROOT . FOLDER . "root_products/" . $folder ); 
while ( $file = readdir($handle) )
{ 
	if ($file != '.' && $file != '..' ) 
	{ 
		$bdir = "../root_products/" . $folder  .$file . "/" ;
		if( is_dir($bdir) )
			$arrfolder[] = array($folder.$file."/",$file);
		else
			$filenum++;
	}
		
}
if( count($arrfolder)!=0 )
{
	echo "<select onchange='getSon(this,".($level+1).")' name='select{$level}' id='select{$level}'><option value=''>当前FTP目录图片数： {$filenum}</option>";
	for($index=0;$index<count($arrfolder);$index++)
	{
		echo "<option value='{$arrfolder[$index][0]}'>{$arrfolder[$index][1]}</option>";
	}
	echo "</select><script> EnterSelect('select{$level}',''); </script>" ;
}
else
{
	echo "<span style='color:#FF0000; font-size:12px; font-weight:bold'>共{$filenum}张</span>";
}
?>