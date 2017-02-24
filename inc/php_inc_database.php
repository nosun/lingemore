<?php
function updateSQL($obj,$table,$condition)
	{
		$arr=array();
		foreach($obj as $key => $value)
		{
			if(substr($value,0,1)=="@")
			{
				$str="$key=".substr($value,1);
			}
			else
			{
				$str="$key='" . mysql_escape_string($value) . "'";
			}
			array_push($arr,$str);
		}
		
		return "UPDATE `$table` SET ".join(',',$arr)." $condition";
	}

function replaceIntoSQL($obj,$table)
{
	$arr=array();
	foreach($obj as $key => $value)
	{
		if(substr($value,0,1)=="@")
		{
			$str="$key=".substr($value,1);
		}
		else
		{
			$str="$key='" . mysql_escape_string($value) . "'";
		}
		array_push($arr,$str);
	}
		
	return "replace into `$table` SET ".join(',',$arr)." $condition";	
}
function replaceSQL($obj,$table,$condition)
{
	$rs=query("select * from `$table` $condition");
	if( BOF($rs) )
	{
		free($rs);
		return insertSQL($obj,$table );
	}
	else
	{
		free($rs);
		return updateSQL($obj,$table,$condition);
	}
}

function insertSQL($obj,$table)
	{
		$arrvalue=array();
		$arrkey=array();
		foreach($obj as $key => $value)
		{
			if(substr($value,0,1)=="@")
			{
				$str=substr($value,1);
			}
			else
			{
				$str="'" . mysql_escape_string($value) . "'";
			}
			array_push($arrkey,$key);
			array_push($arrvalue,$str);
		}
		return "INSERT `$table`(".join(',',$arrkey).") values (".join(',',$arrvalue).")";
	}

function createPage($field,$table,$condition,$ordersql,$pagesize,&$pagenow,&$pagetotal,&$recordcount)
{
	$sql="select count(*) as t from `$table`  $condition";
	$rss=query($sql);
	if( mysql_num_rows( $rss ) == 0 )
	{
		$pagetotal=0;
		$recordcount=0;
		mysql_free_result($rss);
		return query( "select $field  from `$table` $condtion" ) ;
	}
	$rows=fetch( $rss );
	$recordcount = $rows["t"];
	$pagenow = (int) $pagenow ;
	$pagetotal = ceil( $recordcount / $pagesize );
	if( $pagenow < 1 )
		$pagenow = 1 ; 
	if ( $pagenow > $pagetotal && $pagetotal>0)
		$pagenow = $pagetotal ;
	$startid = ( (int)$pagenow - 1 ) * $pagesize ;
	$sql="select $field from `$table` $condition $ordersql limit $startid,$pagesize";
	return query($sql);
}

function createGroupPage($field,$table,$condition,$ordersql,$pagesize,&$pagenow,&$pagetotal,&$recordcount)
{
	$sql="select $field from `$table`  $condition";
	$rss=query($sql);
	if( mysql_num_rows( $rss ) == 0 )
	{
		$pagetotal=0;
		$recordcount=0;
		mysql_free_result($rss);
		//return query( "select $field  from `$table` where id=-2" ) ;
	}
	$recordcount = mysql_num_rows( $rss );
	$pagenow = (int) $pagenow ;
	$pagetotal = ceil( $recordcount / $pagesize );
	if( $pagenow < 1 )
		$pagenow = 1 ; 
	if ( $pagenow > $pagetotal && $pagetotal>0)
		$pagenow = $pagetotal ;
	$startid = ( (int)$pagenow - 1 ) * $pagesize ;
	$sql="select $field from `$table` $condition $ordersql limit $startid,$pagesize";
	return query($sql);
}

function createSalePage($field,$table,$joinsql,$condition,$ordersql,$pagesize,&$pagenow,&$pagetotal,&$recordcount)
{
	$sql="select count(*) as t from `$table` $condition";
	$rss=query($sql);
	if( mysql_num_rows( $rss ) == 0 )
	{
		$pagetotal=0;
		$recordcount=0;
		mysql_free_result($rss);
		return query( "select *  from `$table` where -1=0" ) ;
	}
	$rows=fetch( $rss );
	$recordcount = $rows["t"];
	$pagenow = (int) $pagenow ;
	$pagetotal = ceil( $recordcount / $pagesize );
	if( $pagenow < 1 )
		$pagenow = 1 ; 
	if ( $pagenow > $pagetotal && $pagetotal>0)
		$pagenow = $pagetotal ;
	$startid = ( (int)$pagenow - 1 ) * $pagesize ;
	$sql="select $field from `$table` $joinsql $condition $ordersql limit $startid,$pagesize";
	return query($sql);
}

function createJoinPage($field,$table,$joinsql,$condition,$ordersql,$pagesize,&$pagenow,&$pagetotal,&$recordcount)
{
	$sql="select count(*) as t from `$table` $joinsql $condition";
	
	$rss=query($sql);
	if( mysql_num_rows( $rss ) == 0 )
	{
		$pagetotal=0;
		$recordcount=0;
		mysql_free_result($rss);
		return query( "select $field  from `$table` where 1=0" ) ;
	}
	$rows=fetch( $rss );
	$recordcount = $rows["t"];
	$pagenow = (int) $pagenow ;
	$pagetotal = ceil( $recordcount / $pagesize );
	if( $pagenow < 1 )
		$pagenow = 1 ; 
	if ( $pagenow > $pagetotal && $pagetotal>0)
		$pagenow = $pagetotal ;
	$startid = ( (int)$pagenow - 1 ) * $pagesize ;
	$sql="select $field from `$table` $joinsql $condition $ordersql limit $startid,$pagesize";
	
	return query($sql);
}

function checkID($table,$id)
{
	$sql="select id from `$table` where id=$id";
	$rss=query($sql);
	if( mysql_num_rows( $rss ) == 0 )
	{
		mysql_free_result($rss);
		return false;
	}
	else
	{
		mysql_free_result($rss);
		return true;
	}
}

function deleteRecord($table,$condition)
{
	$sql="select * from `$table` $condition";
	$rs=query( $sql );
	$sql="delete from `$table` $condition";
	query( $sql );
	return $rs;
}

function fetchValue($sql,$default)
{
	$rss=query($sql);
	if( mysql_num_rows( $rss ) == 0 )
	{
		mysql_free_result($rss);
		return $default;
	}
	else
	{
		$rows=fetch($rss);
		if($rows["v"]=="")
			return $default;
		else
			return $rows["v"];
	}
}

function fetchRow($sql)
{
	$rss=query($sql);
	if( mysql_num_rows( $rss ) == 0 )
	{
		mysql_free_result($rss);
		return array();
	}
	else
	{
		$rows=fetch($rss);
		return $rows;
	}
}

function fetchValueGroup($sql,$default="0")
{
	$rss=query($sql);
	$arrtmp = array();
	while($rows=fetch($rss))
	{
		$arrtmp[] = "'". $rows["v"] . "'" ;
	}
	$artmpgourp = join(",",$arrtmp);
	if( $artmpgourp=="" )
		return $default ;
	else 
		return $artmpgourp ;
}

function writeSelect($sql)
{
	$rss=query($sql);
	while($rows=fetch($rss))
	{
		$k=$rows["k"];
		$v=$rows["v"];
		echo "<option value='$v'>$k</option>";
	}
}

function fetchCount($table,$condition)
{
	$sql="select count(*) as t from `$table` $condition ";
	$rs=query($sql);
	if( mysql_num_rows($rs)==0 )
	{
		mysql_free_result($rs);
		return 0;
	}
	else
	{
		$rows=fetch($rs);
		$t=$rows["t"];
		mysql_free_result($rs);
		return $t;
	}
}

function BOF($rs)
{
	if( mysql_num_rows( $rs ) == 0 )
	{
		return true;
	}
	else
	{
		return false;
	}
}

function fetch($rs)
{
	return mysql_fetch_array($rs,MYSQL_ASSOC);
}

function query($sql)
{
	global $conn;
	$sql = str_replace("@@@", TABLE_PRE, $sql) ;
	return mysql_query($sql,$conn);
}

function query2($sql,$conn2)
{
	return mysql_query($sql,$conn2);
}

function free($rs)
{
	mysql_free_result($rs);
}
?>