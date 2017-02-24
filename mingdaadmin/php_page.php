<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr >
    <td width="479" align="left" style="padding:2">
<?
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

?>显示: <strong><?=($pagenow-1)*$pagesize+1?></strong> 到 <strong><?=($pagenow)*$pagesize?></strong> (共: <strong><?=$pagetotal?></strong>页, <strong><?=$recordcount?></strong> 条记录)</td>
    <td width="584"  style="padding:2"  align="right"> 
翻页:
<? 
if ( $pagenow>=2)
{
?>
	<a class="page"  href="?<?=$pageurl?>&page=<?=$pagenow-1?>">[上一页]</a>
<?
} 
?>

<? 
if ($pagetmp>=1) 
{
?>
<a class="page"  href="?<?=$pageurl?>&page=<?=$pagetmp*10?>">...</a> 
<? } ?>
	
<?
for($index=1;$index<=$maxpagenum;$index++)
{
if ( ($pagetmp*10+$index)!=$pagenow )
{
?>
 <a  class="page"  href="?<?=$pageurl?>&page=<?=$pagetmp*10+$index?>"><?=$pagetmp*10+$index?></a> 
<?
}
else
	echo " ".$pagenow." ";
}
?>
<? 
if ( $pagetmp < $pagemaxnum ) 
{
?>
<a class="page" href="?<?=$pageurl?>&page=<?=($pagetmp+1)*10+1?>">...</a> 
<? } ?>
	
<? if ($pagenow < $pagetotal) 
{
?>
<a class="page"  href="?<?=$pageurl?>&page=<?=$pagenow+1?>">[下一页]</a> 
<? } ?>
<input name="pagenow" value="<?=$pagenow?>" id="tb_page" type="text" size="3" class="pageinput"  /> <input onclick="gotoPage()" class="pagebutton" value="GO" type="button" />
<script language="javascript">
function gotoPage()
{
	var page = $2("tb_page").value ;
	if( isNaN(page) )
	{
		alert("You should enter a number");
		return ;
	}
	location.href = "?<?=$pageurl?>&page=" + parseInt(page);
}
</script>
</td>
  </tr>
</table>