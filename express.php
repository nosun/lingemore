<?
require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");
$country = getQuery("country") ;
$countryid = fetchValue("select id as v from @@@country where name like '$country'",0);
$sql = "select * from @@@areacountry where countryid = '$countryid'" ;
$rs = query($sql);
$tmp = array(0);
while( $rows = fetch($rs) )
{
	$tmp[] = $rows["areaid"] ;
}

if(count($tmp)==1)
	$tmp[] = -1 ;

$sql = "select * from @@@express where sort>=0 and  country in (" . dataDefault(join(',',$tmp),0) . ") order by sort asc" ; 
$rs = query($sql);
$index= 0 ;
if(!BOF($rs))
{
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" style=\"background-color:#CCCCCC; \">";
	while($rows = fetch($rs) )
	{
		if( $rows["type"] ==0 )
		{
			$rows["eprice"] = getExpressPrice($shippingnum,0,$rows["pnum"],$rows["pprice"],$rows["price1"],$rows["price2"],$rows["firstweight"]) * $rate ;
		}
		else if( $rows["type"] ==1 )
		{
			$rows["eprice"] = getExpressPrice($shippingweight,1,$rows["pnum"],$rows["pprice"],$rows["price1"],$rows["price2"],$rows["firstweight"]) * $rate ;
		}
		else if( $rows["type"] ==2 )
		{
			$eprice = 0;
			eval( $rows["function"] );
			$rows["eprice"] = $eprice ;
		}
		$rows["eprice"] *= $rows["discount"]/100;
		
		if( $shippingnum==0 )
		{
			$rows["eprice"] = 0 ;
		}
		r2n( $rows["eprice"] );
		if( $totalprice >= $config[54] * $rate && $config[54]>0 )
			$rows["eprice"] = 0 ;
		if( $totalnum >= $config[53] && $config[53]>0 )
			$rows["eprice"] = 0 ;
		$index ++;
		$rs_express[] = $rows ;
	}
	sort_rows($rs_express,"eprice",SORT_ASC);
	for($index=0;$index<count($rs_express);$index++)
	{
		$rows = $rs_express[$index] ; 
?>

  <tr>
    <td width="5%" align="center" bgcolor="#EEEEEE"><input  name="express"  onclick="changeExpressPrice('<?=$rows["eprice"]?>')" value="<?=$rows["name"]?>" type="radio" /></td>
    <td width="95%" bgcolor="#EEEEEE" class="small"><img align="absmiddle" src="<?=$folder?>systemImage/<?=$rows["pic"]?>" />
      <strong><?=$rows["name"]?></strong> 
    (   <?=$cfg["lg"]["shipping_price"]?> : <span class="impc"><?=$coin?> <?=$rows["eprice"]?> )
      </span></td>
  </tr>
   <tr>
    <td colspan="2" bgcolor="#FFFFFF"><div class="linh small"><?=$rows["content"]?></div></td>
    </tr>

<?
	}
	echo "</table><script language=\"javascript\">EnterRadioIndex(\"express\",0); </script>";	
}
else
{
?>
<div style=" background:url(skin/default/pic/warning.gif) 9px 11px #FFFBD1 no-repeat; font-size:11px; color:#000000; border:1px #FDDC9B solid; padding:5px; padding-left:40px">
<?=$cfg["lg"]["step_no_express"]?>
</div>
<script language="javascript">
changeExpressPrice(0);
</script>
<?
}
?>