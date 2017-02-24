<?
// --  载入语言包到模板。
$var["lg"] = $cfg["lg"] ;
// --  读取不可删除栏目的变量
$sql="select content,id from @@@infoclass where id in ("  . dataDefault(join(',',$info),0) . ")" ;
$rs=query($sql);
while($rows=fetch($rs))
{
	$var["content_" . $rows["id"] ] = $rows["content"];
}
free($rs);

//--  更新缓存
$app->update();

//--  调试MYSQL
if( $cfg["mysql_debug"] )
{
	$rs = query("show profiles");
	while($rows = fetch($rs))                                      
	{
		$var["queryHTML"] .= " <br />Duration: " . $rows['Duration']*1000 . " ms , Query= {$rows['Query']}" ;
	}
	free($rs);
	query("set profiling = 0");
}


mysql_close($conn);


//-----------------------------
$var["process"]=formatNumber(timing_current()*1000);
$var["memry"]=formatNumber(memory_get_usage()/1024);
timing_stop();
//----加载SMARTY模块------------
foreach ($var as $key=>$value)
{
	$smarty->assign($key,$value);
}
unset($var);
$smarty->register_outputfilter('remove_dw_comments');
$smarty->debugging = false;
$smarty->display($template_file);
die();
?>