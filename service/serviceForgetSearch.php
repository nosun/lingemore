<?
require("../inc/php_inc.php");
$q = filterSQL(getQuery("q"));
$arr = array();
$sql = "select name  from @@@searchlog where name like '" . $q . "%' group by name";
$rs = query($sql);
while($rows=fetch($rs))
{
	$arrkeyword = split(' ' , $rows["name"] );
	for($index=0;$index<count($arrkeyword);$index++)
	{
		$arrstr[]="name like '%" . $arrkeyword[$index] . "%'";
	}
	$searchcondition =  " state >=0 and ((" . join(' and ' ,$arrstr ) . ") or itemno ='".$rows["name"]."')" ;
	//print_r($searchcondition);
	$counts = fetchValue("select count(*) as v from @@@product where $searchcondition",0) ;
	//if( $counts!=0 )
	$arr[]=array("name"=>$rows["name"],"counts"=>$counts);
}
echo json_encode($arr);
?>