<?
require("../inc/php_inc.php");
require("php_checkadmin.php");
$table=getQuery("table");
$from=getQueryInt("id",0);
$root=getQueryInt("root",0);
$class=fetchAllClass($table);
echo "<select name='to'>";
classOptionCut($root,$class,$from);
echo "</select>";
?>