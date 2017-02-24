<?

error_reporting($cfg["error_reporting"]);
set_time_limit($cfg["time_limit"]);
session_start(); //--设置session


$conn=mysql_connect($cfg["db_server"],$cfg["db_username"],$cfg["db_userpwd"]);
mysql_select_db($cfg["db_name"]);
query("set names " . $cfg["db_charset"] ) . "";
if( $cfg["mysql_debug"] )
{
	query("set profiling = 1");
}
$glo["conn"]=$conn;


timing_start();  //--计算运行时间
//session_cache_expire( $cfg["session"] );

//----读取数据库config配置
$sql="select * from @@@config where name='config'";
$rs=query($sql);
$rows=fetch($rs);
$config=split( $cfg["split"] , $rows["content"] );
$config=array_filter($config);
$glo["configid"] = $rows["id"] ;
$glo["config"] = $config ;
mysql_free_result($rs);

 //--设置时区
date_default_timezone_set(datadefault($config[172],"RPC"));

$cfg["imageMod"] = $config[45];
$cfg["remoteServer"] = split(';' , $config[56] );
define("SERVER" , $config[56] );
define("IMAGE" , $config[45] );
define("NUMBER" , $config[45] );
$urltype = $config[45] ;
define("FLOAT",$config[39] ) ;
define("URLDIYNAME",makeRewrite($config[293]) );
define("CURLTYPE",datadefault($config[294],0) );
define("PURLTYPE",datadefault($config[295],0) );
define("URLSTART",datadefault($config[301],1) );
?>