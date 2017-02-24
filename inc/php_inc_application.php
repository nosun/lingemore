<?

class application

{

	var $data;

	var $CACHE;

	var $CACHE_TIME;

	var $key;
	
	var $skey;
	
	var $_UPDATED;

	var $_UPDATED2;

	var $bigdata;

	public function application()

	{

		$this->conn=$conn;

		$this->CACHE=false;

		$this->CACHE_TIME=3600;

		$this->_UPDATED=false;

		$this->_UPDATED2=false;

		$this->bigdata = array();

		$this->skey=array();

		$sql="select * from @@@config where name='app'";

		$rs=query($sql);

		$rows=fetch($rs);

		$this->data = json_decode( $rows["content"] , TRUE );

		$this->data = (array) $this->data ;

		$this->data["verson"]=1;

	}

	

	public function load()

	{

		$sql="select content,name from @@@config where name !='app'";

		$rs= query($sql);

		while($rows=fetch($rs))

		{

			$this->bigdata[ $rows["name"] ] = $rows["content"] ;

		}


		free($rs);

	}

	

	public function get2($key)

	{

		if( array_key_exists("$key",$this->bigdata) && $this->bigdata[$key]!="" )

		{

			return true ;

		}

		else

		{

			$this->_UPDATED2=true;
			$this->skey[] = $key;
			return false ;

		}

	}

	

	public function get($key)

	{

		$tmp= array_key_exists("$key",$this->data)  ;

		//debug($this->data);

		if(!$tmp)

		{

			$this->_UPDATED=true ;

		}

		return $tmp;

	}

	

	public function set($key,&$value)

	{

		$this->data[$key]=$value;

	}

	

	public function update()

	{

		if(  $this->_UPDATED )

		{

			$this->data["cache_time"] = time() + $this->CACHE_TIME ;

			$param=array();

			$condition="where name='app'";

			$param["content"] = json_encode( $this->data );

			$sql=updateSQL( $param,"@@@config",$condition );

			query($sql);

		}

		if( $this->_UPDATED2 )

		{

			for($index=0;$index<count($this->skey);$index++)

			{

				$condition = "where name='" . $this->skey[$index] ."'";

				$param["name"] = $this->skey[$index] ;

				$param["content"] = $this->bigdata[ $this->skey[$index]  ] ;

				$sql = replaceSQL( $param , "@@@config" , $condition );

				query($sql);

			}

		}

	}

}

?>