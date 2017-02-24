<?
ignore_user_abort(true);
require("inc/php_inc.php");
$action = getQuery("action") ;
$type = getQuery("type") ;
if( $action=="stat" )
{
	switch( $type )
	{
		case "category":
			$id = getQueryInt("id",0);
			$categoryname = fetchValue("select name as v from @@@productclass where id=$id","");
			if( $categoryname!="" )
			{
				$param = array();
				$param["name"] = $categoryname;
				$param["classid"] = $id;
				$param["addtime"]=formatDateTime(time()); 
				$sql=insertSQL($param,"@@@categorylog");
				query($sql);
			}
			break;
		case "product":
			$id = getQueryInt("id",0);
			$pname = fetchValue("select name as v from @@@product where id=$id","");
			if( $pname!="" )
			{
				$param = array();
				$param["name"] = $pname;
				$param["pid"] = $id;
				$param["addtime"]=formatDateTime(time()); 
				$sql=insertSQL($param,"@@@productlog");
				query($sql);
			}
			$condition="where id=$id";
			$param=array();
			$param["hits"]="@hits+1";
			$sql=updateSQL($param,"@@@product",$condition);
			query($sql);
			break;
		case "searchkey":
			$searchname = filterSQL(getQuery("name"));
			if( $searchname!="" )
			{
				$param = array();
				$param["name"] = $searchname;
				$param["addtime"]=formatDateTime(time()); 
				$sql=insertSQL($param,"@@@searchlog");
				query($sql);
			}
			break;
	}
}
die("//");
?>
