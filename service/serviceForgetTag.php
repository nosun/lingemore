<?
require("../inc/php_inc.php");
require("php_checkadmin.php");

$classid = getQueryInt("classid",0);
$filterGroup = fetchValue("select filtergroup as v from @@@productclass where id=".$classid,"");
if($filterGroup=="")
{
	for($index=0;$index<count($cfg["product"]["tagtype"]);$index++)
		$arr[] = $index;
}
else
{
	$arr = split(',',$filterGroup);
}
   for($index=0;$index<=count($arr)-1;$index++)
	{
		$sql="select * from @@@ptaglist where type=" . $arr[$index] ;
		$rs = query($sql);
	?>
    <div style="font-size:14px; font-weight:bold">标签类型: <?=$cfg["product"]["tagtype"][$arr[$index]]?></div>
    <div>
    <?
    	while($trows=fetch($rs))
		{
	?>
    	<div class="countryspan"><input  onClick="checkcss(this)" name="cbtagname[]" type="checkbox" value="<?=$trows["name"]?>"> <?=$trows["name"]?></div>
    <?
		}
	?>
    </div><div class="clear"></div>
    <?
	}
	?>