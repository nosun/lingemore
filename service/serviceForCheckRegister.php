<?
require("../inc/php_inc.php");
if( getQuery("action")=="check" )
{
	$name= filterSQL(strtolower(getForm("name")));
	
	$sql="select * from @@@user where name like '$name'";
	$rs=query($sql);
	if(!BOF($rs))
		die("false");
	else
		die("true");
}
else
{
	die("false");
}
?>