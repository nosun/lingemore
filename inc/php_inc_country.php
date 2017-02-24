<SELECT id="<?=$country?>" class="input001" name="<?=$country?>">
<?
if($scountry!="")
writeSelect("select name as k,shortname as v from @@@country order by sort asc");
else
writeSelect("select name as k,name as v from @@@country order by sort asc");
?>
</SELECT>