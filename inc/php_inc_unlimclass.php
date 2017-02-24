<?
class unlimClass
{
	var $conn;
	var $table;
	public function unlimClass($tablename)
	{
		$this->table=$tablename;
	}
	
	public function connect($link)
	{
		$this->conn=$link;
	}
	
	public function add($father,$name,$sort,$state,$content,$pic)
	{
		//----------获取父亲节点信息
		$sql="select * from ".$this->table." where id=$father";
		$rs=query($sql);
		if( mysql_num_rows( $rs ) ==0 )
		{
			mysql_free_result( $rs );
			return ;
		}
		$rows=mysql_fetch_array($rs);
		$fatherID=$rows["id"];
		$fatherLevel=$rows["level"];
		$fatherURL=$rows["url"];
		$fatherson=trim($rows["son"]);
		//-----------添加节点
		$parm=array();
		$parm["father"]=$father;
		$parm["name"]=$name;
		$parm["sort"]=$sort;
		$parm["state"]=$state;
		$parm["content"]=$content;
		$parm["pic"]=$pic;
		$parm["level"]=$fatherLevel+1;
		//---------------------------------------------
		//扩展区域
		//---------------------------------------------
		
		$sql=insertSQL($parm,$this->table);
		query($sql);
		if($this->conn=="")
			$newid=mysql_insert_id();
		else
			$newid=mysql_insert_id($this->conn);
		$parm=array();
		$parm["tree"]=$newid;
		$parm["url"]=$fatherURL . "," . $newid;
		$condition="where id=$newid";
		$sql=updateSQL($parm,$this->table,$condition);
		query($sql);
		//-----------更新祖宗节点
		$parm=array();
		$parm["tree"]="@CONCAT(tree,',$newid')";
		$condition="where id in ($fatherURL)";
		$sql=updateSQL($parm,$this->table,$condition);
		query($sql);
		//----------更新父亲节点
		$parm=array();
		if ( $fatherson=="" )
			$parm["son"]="$newid";
		else
			$parm["son"]="@CONCAT(son,',$newid')";
		$condition="where id=$father";
		$sql=updateSQL($parm,$this->table,$condition);
		query($sql);
		$this->sort($father);
		return $newid;
	}
	
	public function edit($id,$name,$sort,$state,$content,$pic,$isdigui=true)
	{
		$sql="select * from ".$this->table." where id=$id";
		$rs=query($sql);
		if( mysql_num_rows( $rs ) ==0 )
		{
			mysql_free_result( $rs );
			return ;
		}
		$rows=mysql_fetch_array($rs);
		$father=$rows["father"];
		$oldpic=$rows["father"];
		//更新节点
		$parm=array();
		$parm["name"]=$name;
		$parm["sort"]=$sort;
		if($state!="!")
			$parm["state"]=$state;
		if($content!="!")
			$parm["content"]=$content;
		$parm["pic"]=$pic;
		$condition="where id=$id";
		$sql=updateSQL($parm,$this->table,$condition);
		query($sql);
		$this->sort($father);
		if($isdigui)
			$this->state($id,$state);
		
		if( $oldpic != getForm("pic") )
		{
			$arr=array("","mid_","small_","_big");
			deleteImage( $oldpic , $arr , "../systemImage/" );
		}
	}
	
	public function delete($id)
	{
		$sql="select * from ".$this->table." where id=$id";
		$rs=query($sql);
		if( mysql_num_rows( $rs ) ==0 )
		{
			mysql_free_result( $rs );
			return ;
		}
		$rows=mysql_fetch_array($rs);
		$tree=$rows["tree"];
		$url=$rows["url"];
		$father=$rows["father"];
		
		//更新子孙状态
		deletePpic( $this->table," where id in ($tree)" , array("","mid_","small_","_big"),"../systemImage/" );
		$sql="delete from " . $this->table . " where id in ($tree)";
		//debug($sql);	
		query($sql);
		//更新祖宗状态
		$sql="select * from ".$this->table." where id in ($url)";
		$rs=query($sql);
		$arrtree = split(',' , $rows["tree"] );
		while($rows=mysql_fetch_array($rs))
		{
			$arrtmp=explode(',',trim($rows["tree"]));
			$newtreetmp=array_diff($arrtmp,$arrtree);
			$parm=array();
			$parm["tree"]= join(',',$newtreetmp);
			if($rows["id"]==$father)
			{
				$arrson=split(',' , $rows["son"] );
				$tmpson=array($id);
				$newarrtmp=array_diff($arrson,$tmpson);
				$parm["son"]= join(',',$newarrtmp) ;
			}
			
			$condition="where id=".$rows["id"];
			$sql=updateSQL($parm,$this->table,$condition) . ";";
			query($sql);
		}
	}
	
	public function create($rootname)
	{
		$sql="select  * from " . $this->table . " order by id asc limit 0,1 ";
		$rs=query($sql);
		if( mysql_num_rows($rs)==0 )
		{
			$parm=array();
			$parm["name"]=$rootname;
			$parm["state"]=1;
			$sql=insertSQL($parm,$this->table);
			query($sql);
			if($this->conn=="")
				$id=mysql_insert_id();
			else
				$id=mysql_insert_id($this->conn);
			$parm=array();
			$parm["tree"]=$id;
			$parm["url"]=$id;
			$condition="where id=$id";
			$sql=updateSQL($parm,$this->table,$condition);
			query($sql);
			mysql_free_result($rs);
			return $id;
		}
		else
		{
			$rows=mysql_fetch_array($rs);
			mysql_free_result($rs);
			return $rows["id"];
		}
	}
	
	public function move($from,$to)
	{
		//----------添加节点。。。
		$sql="select id,tree,url,father,level from ".$this->table." where id=$from";
		$rs=query($sql);
		$rows=mysql_fetch_array($rs);
		$atree=$rows["tree"];
		$aurl=$rows["url"];
		$level=$rows["level"];
		$father=$rows["father"];
		$fatherurl=str_replace(",$from","",$rows["url"]);
		$fatherlevel=$level-1;
		$parm=array();
		$parm["father"]= $to;
		$condition="where id=$from";
		$sql=updateSQL($parm,$this->table,$condition);
		query($sql);
		
		//更新祖宗状态
		$sql="select * from ".$this->table." where id in ($fatherurl)";
		$rs=query($sql);
		$arrtree = split(',' , $rows["tree"] );
		while($rows=mysql_fetch_array($rs))
		{
			$arrtmp=explode(',',trim($rows["tree"]));
			$newtreetmp=array_diff($arrtmp,$arrtree);
			$parm=array();
			$parm["tree"]= join(',',$newtreetmp);
			if($rows["id"]==$father)
			{
				$arrson=split(',' , $rows["son"] );
				$tmpson=array($from);
				$newarrtmp=array_diff($arrson,$tmpson);
				$parm["son"]= join(',',$newarrtmp) ;
			}
			
			$condition="where id=".$rows["id"];
			$sql=updateSQL($parm,$this->table,$condition);
			query($sql);
		}
		
		
		//----------黏贴节点。。。
		//------------获取目标节点
		$sql="select * from ".$this->table." where id=$to";
		$rs=query($sql);
		$rows=mysql_fetch_array($rs);
		$burl=$rows["url"];
		$blevel=$rows["level"];
		$bson=$rows["son"];
		//-----------更新祖宗节点
		$parm=array();
		$parm["tree"]="@CONCAT(tree,',$atree')";
		$condition="where id in ($burl)";
		$sql=updateSQL($parm,$this->table,$condition);
		query($sql);
		//----------更新父亲节点
		$parm=array();
		if ( $bson=="" )
			$parm["son"]="$from";
		else
			$parm["son"]="@CONCAT(son,',$from')";
		$condition="where id=$to";
		$sql=updateSQL($parm,$this->table,$condition);
		query($sql);
		//-----------更新子孙列表
		$parm=array();
		$parm["level"]="@level-$fatherlevel+$blevel";
		$parm["url"]="@replace(url,'$fatherurl','$burl')";
		$condition="where id in ($atree)";
		$sql=updateSQL($parm,$this->table,$condition);
		query($sql);
		$this->sort($to);
	}
	
	private function sort($strid)
	{
		if ( (int)$strid ==0 )
			return ;
		$sql="select son from ".$this->table." where id=$strid";
		$rs=query($sql);
		if( mysql_num_rows( $rs ) ==0 )
		{
			mysql_free_result( $rs );
			return ;
		}
		$rows=mysql_fetch_array($rs);
		$treeson=$rows["son"];
		if($treeson!=" " &&  $treeson!="")
		{
			$sql="select id from ".$this->table." where id in ($treeson) order by sort asc,id asc";
			$rs=query($sql);
			$arrtemp=array();
			while($rows=mysql_fetch_array($rs))
			{
				$arrtemp[]=$rows["id"];
			}
			$parm=array();
			$parm["son"]= join(',' , $arrtemp ) ;
			$condition="where id=$strid";
			$sql=updateSQL($parm,$this->table,$condition);
			query($sql);
		}
	}
	
	private function state($strid,$strstate=1)
	{
		$sql="select tree from ".$this->table." where id=$strid";
		$rs=query($sql);
		if( mysql_num_rows( $rs ) ==0 )
		{
			mysql_free_result( $rs );
			return ;
		}
		
		$rows=mysql_fetch_array($rs);
		$treeson=$rows["tree"];
		//更新子孙状态
		$parm=array();
		$parm["state"]=$strstate;
		$condition="where id in ($treeson)";			
		$sql=updateSQL($parm,$this->table,$condition);
		query( $sql );
	}
	
	public function toString()
	{
		
	}
}

?>