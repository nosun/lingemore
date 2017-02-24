<?
class shopCartCookie
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
	public function shopCartCookie($web,$type)
	{
		$this->web=$web;
		$this->type=$type;
		$this->pid=explode ("|" , $_COOKIE[$web . "_" . $type ."_pid"] );
		$this->pstyle=explode ('|', $_COOKIE[$web . "_" . $type ."_pstyle"] );
		$this->pnum=explode ('|', $_COOKIE[$web . "_" . $type ."_pnum"] );
		$this->pcontent=explode ('|', $_COOKIE[$web . "_" . $type ."_pcontent"] );
		$this->psub=explode ('|', $_COOKIE[$web . "_" . $type ."_psub"] );
		removeSplitEmpty($this->pid);
		removeSplitEmpty($this->pnum);
		removeSplitEmpty($this->pstyle);
		removeSplitEmpty($this->pcontent);
		removeSplitEmpty($this->psub);
		$this->length=count($this->pid );
		array_pad($this->pnum,$this->length,1);
		array_pad($this->pstyle,$this->length,"");
		array_pad($this->pcontent,$this->length,"");
		array_pad($this->psub,$this->length,"");
	}
	
	public function add($id,$num,$style,$content,$sub)
	{
		if($num<=0)
			$num=1;
		$index=$this->isInCart($id,$style);
		if( $index==-1)
		{
			$this->pid[$this->length] = $id;
			$this->pnum[$this->length] = $num;
			$this->pcontent[$this->length] = $content;
			$this->pstyle[$this->length] = $style;
			$this->psub[$this->length] = $sub;
			$this->length=(int)$this->length + 1; 
		}
		else
		{
			$this->pnum[$index] = (int) $this->pnum[$index] + (int) $num;
		}
	}
	
	public function delete($index)
	{
	
		$index=(int)$index;
		if($index>=0 && $index<=$this->length-1)
		{
			array_splice( $this->pid , $index , 1);
			array_splice( $this->pnum , $index , 1);
			array_splice( $this->pcontent , $index , 1);
			array_splice( $this->pstyle , $index , 1);
			array_splice( $this->psub , $index , 1);
			$this->length--;
		}
	}
	
	public function edit($index,$num,$content)
	{
		if($num<=0)
			$num=1;
		if($index>=0 && $index<=($this->length-1))
		{
			$this->pnum[$index]=$num;
			$this->pcontent[$index]=$content;
		}
	}
	
	public function clean()
	{
		$this->pid=array();
		$this->pnum=array();
		$this->pstyle=array();
		$this->pcontent=array();
		$this->psub=array();
		$this->length=0;
	}
	
	public function indexID($index)
	{
		return $index;
	}
	
	public function fetch()
	{
		
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
		$web=$this->web;
		$type=$this->type;
		setcookie( $web . "_" . $type . "_pid" , join('|',$this->pid) );
		setcookie( $web . "_" . $type . "_pnum" , join('|',$this->pnum) );
		setcookie( $web . "_" . $type . "_pstyle" , join('|',$this->pstyle) );
		setcookie( $web . "_" . $type . "_pcontent" , join('|',$this->pcontent) );
		setcookie( $web . "_" . $type . "_psub" , join('|',$this->psub) );
	}
	
 
}
?>