<?
class History
{
	public $pid;
	public $length;
	private $web;
	private $type;
	public function History($web,$type)
	{
		$this->web=$web;
		$this->type=$type;
		$this->pid=explode ("|" , $_COOKIE[$web . "_" . $type ."_pid"] );
		removeSplitEmpty($this->pid);		
		$this->length=count($this->pid );
	}
	
	public function add($id)
	{
		$index=$this->isInCart($id);
		if( $index==-1)
		{
			array_unshift( $this->pid , $id );
			$this->length=count($this->pid ); 
		}
		else
		{
			array_splice( $this->pid , $index , 1);
			array_unshift( $this->pid , $id );
		}
	}
	
	private function isInCart($id)
	{
		for($index=0;$index<$this->length;$index++)
		{
			if( (int)$this->pid[$index]==(int)$id  )
				return $index;
		}
		return -1;
	}
	
	public function save()
	{
		$web=$this->web;
		$type=$this->type;
		setcookie( $web . "_" . $type . "_pid" , join('|',$this->pid) , time()+60*60 ,'/' );
	}
	
 
}
?>