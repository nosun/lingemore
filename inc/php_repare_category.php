<?php
require("php_inc.php");
$class=fetchAllClass("productclass");
$u1=new unlimClass("productclass");
$proot=$u1->create("产品分类");

function getTree($allclass,$sonid)
{
	$tree = $sonid ; 
	$son = $allclass[$sonid]["son"] ; 
	if( $son!="" )
	{
		$arrson=split(',',$son);
		for($index=0;$index<count($arrson);$index++)
		{
			$tree .= ",". getTree($allclass,$arrson[$index]);
		}
	}
	$sql = "update productclass set tree='" . $tree . "' where id=$sonid";
	print_r($sql . "<br>");
	return $tree;
}

getTree($class,$proot);
?>