<?
require("../inc/php_inc.php");
require("php_checkadmin.php");
$classid=getQueryInt("classid",1);
$arr=array("手工输入","多行输入","单选","复选");
?>
<div class="hide">
<table width="700" border="0" cellspacing="1" cellpadding="1"  class="tbtitle">
  <tr  bgcolor="#EDF9D5" align="center">
    <td colspan="2" bgcolor="#F2F4F6">商品属性</td>
  </tr>
	
	<?
	$sql="select * from @@@property where classid=$classid and cart=0 order by sort asc";
	$rs=query($sql);
	$index=0;
	while($rows=mysql_fetch_array($rs))
	{
	$index++;
	?>
	  
  <tr bgcolor="#FFFFFF" align="center">
    <td width="166"><?=$rows["name"]?><input name="pkey<?=$index?>" type="hidden" value="<?=$rows["name"]?>"></td>
    <td align="left"><? fetch_HTML($rows["type1"],$rows["value"],$index,"pvalue"); ?></td>
  </tr>
  <?
  }
  ?>
  
</table>
  <input name="pnum" type="hidden" value="<?=$index?>" />
<br />
</div>
<table width="700" border="0" cellspacing="1" cellpadding="1"  class="tbtitle">
  <tr  bgcolor="#EDF9D5" align="center">
    <td colspan="3" bgcolor="#F2F4F6">购物属性<span class="hide">(<input name="cbpropertytotag" type="checkbox" value="1" />加入到过滤搜索标签)</span></td>
  </tr>
  <?
	$sql="select * from @@@property where classid=$classid and cart=1 order by sort asc";
	$rs=query($sql);
	$index=0;
	while($rows=mysql_fetch_array($rs))
	{
	$index++;
?>
  
   <tr bgcolor="#FFFFFF" align="center">
    <td width="99"><?=$rows["name"]?>
     <input name="ckey<?=$index?>" type="hidden" value="<?=$rows["name"]?>"></td>
    <td width="594" align="left"><? fetch_HTML($rows["type1"],$rows["value"],$index,"cvalue"); ?>
    <input type="hidden" name="ctype<?=$index?>" value="<?=$rows["type2"]?>" /><textarea <? if( $rows["type2"]!=8 && $rows["type2"]!=9 ) { ?> class="hide" <? } ?> name="cprice<?=$index?>" style='width:280px; height:60px;'><?=$rows["price"]?></textarea></td>
  </tr>
  
  <?
  }
  ?>
  </table>
<input name="cnum" type="hidden" value="<?=$index?>" />