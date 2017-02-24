<?
class shopCartDatabase
{
	public $pid;
	public $pstyle;
	public $pcontent;
	public $psub;
	public $pnum;
	public $length;
	private $web;
	private $type;
	private $sid;
	public function shopCartDatabase($userid)
	{
		$this->web=$userid;
		$this->type=$type;
		$this->pid=array();
		$this->pnum=array();
		$this->pstyle=array();
		$this->pcontent=array();
		$this->psub=array();
		$this->sid=array();
		$this->length=0;
	}
	
	public function fetch()
	{
		$this->pid=array();
		$this->pnum=array();
		$this->pstyle=array();
		$this->pcontent=array();
		$this->psub=array();
		$this->sid=array();
		$this->length=0;
		$sql="select * from @@@shopcart where userid=" . $this->web;
		$rs = query($sql);
		while( $rows=fetch($rs) )
		{
			$this->pid[]=$rows["pid"];
			$this->pnum[]=$rows["pnum"];
			$this->pstyle[]=$rows["pstyle"];
			$this->pcontent[]=$rows["pcontent"];
			$this->psub[]=$rows["psub"];
			$this->sid[]=$rows["id"];
			$this->length++;
		}
		
	}
	
	public function indexID($index)
	{
		//debug($this->sid);
		return $this->sid[$index];
	}
	
	public function add($id,$num,$style,$content,$sub)
	{
		if( $this->web<=0 )
			return ;
		$sql="select * from @@@shopcart where pid=$id and pstyle='$style' and userid=" . $this->web;
		$rs = query($sql);
		if( BOF($rs) )
		{
			$param=array();
			$param["pid"]= $id  ;
			$param["pstyle"]= $style ;
			$param["pnum"] = $num ;
			$param["psub"]= $sub;
			$param["userid"]= $this->web;
			$sql=insertSQL($param,"@@@shopcart");
			//debug($sql);
			query($sql);
		}
		else
		{
			$rows=fetch($rs);
			$this->edit($rows["id"],$num+$rows["pnum"],$content);
			free($rs);
		}
	}
	
	public function delete($sid=0)
	{
		$sql="delete from @@@shopcart where id=$sid and userid=" . $this->web;
		query($sql);
	}
	
	public function edit($index,$num,$content)
	{

		$param=array();
		$param["pcontent"]= $content ;
		$param["pnum"] = $num ;
		$condition="where id=$index and userid=" . $this->web;
		$sql=updateSQL($param,"@@@shopcart",$condition);
		query($sql);
	}
	
	public function clean()
	{
		$sql="delete from @@@shopcart where userid=" . $this->web;
		query($sql);
	}
	
	private function isInCart($id,$style)
	{
		for($index=0;$index<$this->length;$index++)
		{
			if( (int)$this->pid[$index]==(int)$id && (string)$this->pstyle[$index]==(string)$style )
				return $index;
		}
		return -1;
	}
	
	public function getIDnum($id)
	{
		$temp=0;
		for($index=0;$index<$this->length;$index++)
		{
			if( (int)$this->pid[$index]==(int)$id  )
				$temp+=(int)$this->pnum[$index] ;
		}
		return $temp;
	}
	
	public function save()
	{
		
	}
	
 
}
?>