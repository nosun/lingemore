<?
function classOption($id,$class)
{
  $name=$class[$id]["name"];
  $son=$class[$id]["son"];
  $level=(int)$class[$id]["level"];
  $state=$class[$id]["state"];
  $sort=$class[$id]["sort"];
  echo "<option value='$id'>" . str_repeat("　",$level) . "$name</option>";
    if($son!="")
	{
		$arrson=split(',',$son);
		for($index=0;$index<count($arrson);$index++)
		{
			classOption($arrson[$index],$class);
		}
	}
}

function classOptionNoRoot($id,$class,$rootid)
{
  $name=$class[$id]["name"];
  $son=$class[$id]["son"];
  $level=(int)$class[$id]["level"];
  $state=$class[$id]["state"];
  $sort=$class[$id]["sort"];
  if( (int)$id != (int) $rootid )
  		echo "<option value='$id'>" . str_repeat('　',$level-1) . "$name</option>";
  if($son!="")
	{
		$arrson=split(',',$son);
		for($index=0;$index<count($arrson);$index++)
		{
			classOptionNoRoot($arrson[$index],$class);
		}
	}
}

function classOptionCut($id,$class,$cutid)
{
  if( (int)$id==(int)$cutid )
  	return;
  $name=$class[$id]["name"];
  $son=$class[$id]["son"];
  $level=(int)$class[$id]["level"];
  $state=$class[$id]["state"];
  $sort=$class[$id]["sort"];
  echo "<option value='$id'>" . str_repeat("　",$level) . "$name</option>";
    if($son!="")
	{
		$arrson=split(',',$son);
		for($index=0;$index<count($arrson);$index++)
		{
			classOptionCut($arrson[$index],$class,$cutid);
		}
	}
}

function classRelation($classid,$maxlevel,$table,$function="")
{
$u=new unlimClass($table);
$root=$u->create("root");
?><script language="javascript">
	function extendRelationFunction(a,b)
	{
		 <? if($function!="") echo($function."(a,b)"); ?>
	}
   function getSon(obj,td_id)
   { 
       if(obj.value==0)
	   {   
	      var td_n;
		  var i=td_id;
			 var td_n;
		  for(i=td_id;i<=<?=$maxlevel?>;i++)
         {
		   try{
			   td_n="td" + i;
			   document.getElementById(td_n).innerHTML="";
			}
			catch(e)
			{};
		 }
		   //alert(td_n)
	      var preselect=document.getElementById("select"+(td_id-2))
		  if(preselect==null) 
		     {
			     document.getElementById("classid").value="<?=$root?>";
				 document.getElementById("classname").value="Default";
				 extendRelationFunction($('#classid').val(),$('#classname').val());
			  }
		  else 
		      { document.getElementById("classid").value=preselect.value;
			    document.getElementById("classname").value=preselect.options[preselect.selectedIndex].text;
				extendRelationFunction($('#classid').val(),$('#classname').val());
			   }
	    
		}
	   
	   else 
	  { 
	 
	      var td_n;
		  for(i=td_id;i<=<?=$maxlevel?>;i++)
         {
		   try{
		   td_n="td" + i;
	       document.getElementById(td_n).innerHTML="";
		   }
		   catch(e){};
		 }
		 document.getElementById("classid").value=obj.value;
		 document.getElementById("classname").value=obj.options[obj.selectedIndex].text
		 extendRelationFunction($('#classid').val(),$('#classname').val());
		 if(td_id<=<?=$maxlevel?>)
		 {  
	        xmlhttp.open("POST","../service/serviceForgetSon.php?id="+ obj.value +"&table=<?=$table?>",true);
	        xmlhttp.onreadystatechange=function(){dosomething(td_id)};
            xmlhttp.send(null);
		  }
	   }
	}
	function dosomething(i)
	{
	    if(xmlhttp.readyState==4)
		   if(xmlhttp.status==200)
		      {   
			      
				  var html=xmlhttp.responseText;
				  var td_n="td" + i;
		   		  var temp=document.getElementById(td_n);
	              document.getElementById(td_n).innerHTML=html;
		       }
}
</script><?
	$index=0;
	echo "<table border=0  cellspacing=0 cellpadding=0><tr>";
	$sql="select * from $table where id=$classid";
	$rs=query($sql);
	if ( mysql_num_rows($rs)!=0 )
	{
		
		$rows=fetch($rs);
		$level=$rows["level"];
		$url=$rows["url"];
		$arr=split(',',$url);
		if ( ((int)$arr[0] == $root) && count($arr)!=1)
		{
			for($index=0;$index<=count($arr)-2;$index++)
			{
				echo "<td  class='relativetable'  id='td" . ($index+1) . "'>";
				if(!classSonSelect($arr[$index],$arr[$index+1],$table))
					break;
				echo "</td>";
			}
			
		}
		else
		{
			echo "<td class='relativetable'  id='td1'>";
			classSonSelect($root,0,$table);
			echo "</td>";
			$index=1;
		}
		
		mysql_free_result($rs);
	}
	else
	{
		echo "<td class='relativetable' id='td1'>";
		classSonSelect($root,0,$table);
		echo "</td>";
		$index=1;
	}
	for(;$index<=$maxlevel;$index++)
	{
		echo "<td  class='relativetable'  id='td" . ($index+1) . "'>";
		echo "</td>";
	}
	echo "</tr></table>";
}

function classbrandRelation($classid,$maxlevel,$table)
{
$u=new unlimClass($table);
$root=$u->create("root");
?><script language="javascript">
   function getbrandSon(obj,td_id)
   { 
       if(obj.value==0)
	   {   
	      var td_n;
		  var i=td_id;
			 var td_n;
		  for(i=td_id;i<=<?=$maxlevel?>;i++)
         {
		   try{
			   td_n="tdbrand" + i;
			   document.getElementById(td_n).innerHTML="";
			}
			catch(e)
			{};
		 }
		   //alert(td_n)
	      var preselect=document.getElementById("selectbrand"+(td_id-2))
		  if(preselect==null) 
		     {
			     document.getElementById("brandid").value="<?=$root?>";
				 document.getElementById("brandname").value="ALL";
			  }
		  else 
		      { document.getElementById("brandid").value=preselect.value;
			    document.getElementById("brandname").value=preselect.options[preselect.selectedIndex].text;
			   }
	    
		}
	   
	   else 
	  { 
	 
	      var td_n;
		  for(i=td_id;i<=<?=$maxlevel?>;i++)
         {
		   try{
		   td_n="tdbrand" + i;
	       document.getElementById(td_n).innerText="";
		   }
		   catch(e){};
		 }
		 document.getElementById("brandid").value=obj.value;
		 document.getElementById("brandname").value=obj.options[obj.selectedIndex].text
		 if(td_id<=<?=$maxlevel?>)
		 {  
	        xmlhttp.open("POST","../service/serviceForgetbrandSon.php?id="+ obj.value +"&table=<?=$table?>",true);
	        xmlhttp.onreadystatechange=function(){dobrandsomething(td_id)};
            xmlhttp.send(null);
		  }
	   }
	}
	function dobrandsomething(i)
	{
	    if(xmlhttp.readyState==4)
		   if(xmlhttp.status==200)
		      {   			      
				  var html=xmlhttp.responseText;
				  var td_n="tdbrand" + i;
		   		  var temp=document.getElementById(td_n);
	              document.getElementById(td_n).innerHTML=html;
		       }
}
</script><?
	$index=0;
	echo "<table border=0 cellspacing=0 cellpadding=0><tr>";
	$sql="select * from $table where id=$classid";
	$rs=query($sql);
	if ( mysql_num_rows($rs)!=0 )
	{
		$rows=fetch($rs);
		$level=$rows["level"];
		$url=$rows["url"];
		$arr=split(',',$url);
		if ( ((int)$arr[0] == $root) && count($arr)!=1)
		{
			for($index=0;$index<=count($arr)-2;$index++)
			{
				echo "<td  id='tdbrand" . ($index+1) . "'>";
				if(!classSonSelect($arr[$index],$arr[$index+1],$table,"brand"))
					break;
				echo "</td>";
			}
			
		}
		else
		{
			echo "<td id='tdbrand1'>";
			classSonSelect($root,0,$table,"brand");
			echo "</td>";
			$index=1;
		}
		
		free($rs);
	}
	else
	{
		echo "<td id='tdbrand1'>";
		classSonSelect($root,0,$table,"brand");
		echo "</td>";
		$index=1;
	}
	for(;$index<=$maxlevel;$index++)
	{
		echo "<td  id='tdbrand" . ($index+1) . "'>";
		echo "</td>";
	}
	echo "</tr></table>";
}

function classSonSelect($id,$son,$table,$str="")
{
	$sql="select * from $table where id=$id";
	$rs=query($sql);
	if ( mysql_num_rows( $rs )==0 )
		return false;
	$rows=fetch( $rs );
	$level=$rows["level"];
	free($rs);
	$sql="select * from $table where father=$id order by sort asc";
	$rs=query($sql);
	if ( mysql_num_rows( $rs )==0)
	{
		if($level==0)
		{
			echo "<select onchange='get" . $str . "Son(this," . ($level + 2) . ")' name='select$str" . ($level+1) . "' id='select$str" . ($level+1) . "'>";
			echo "<option value='$id'>默认总分类</option>";
			echo "</select>";
			return true;
		}
		return false;
	}	
	echo "<select onchange='get" . $str . "Son(this," . ($level + 2) . ")' name='select$str" . ($level+1) . "' id='select$str" . ($level+1) . "'>";
	echo "<option value='0'>请选择分类</option>";
	while( $rows=fetch($rs) )
	{
		$id=$rows["id"];
		$name=$rows["name"];
		echo "<option value='$id'>$name</option>";
	}
	echo "</select>";
	echo "<script> EnterSelect('select$str" . ($level+1) . "','$son'); </script>";
	return true;
}

function fetchAllClass($table,$filder="",$default="*")
{
	$sql="select * from `$table` order by id asc";
  	$rs=query ( $sql );
	$class=array();
  	while( $rows=fetch( $rs  ) )
  	{
		$class[$rows["id"]]=$rows;
 	 }
  	free( $rs );
	return $class;
	
}

function fetchTreeNum($id,&$class,$table)
{
	$son=$class[$id]["son"];
	
	$class[$id]["item"] = fetchValue("select count(*) as v from $table where classid = $id and state>0" , 0 );
	if($son!="")
	{
		$arrson=split(',',$son);
		for($index=0;$index<count($arrson);$index++)
		{
			$class[$id]["item"]+=fetchTreeNum($arrson[$index],$class,$table);
		}
	}
	return $class[$id]["item"] ;
}

function fetchClassValue($class,$id,$index=0)
{
	if( array_key_exists( $id,$class) )
		return $class[$id]["name"];
	else 
		return "分类已被删除";
}

function get_id_tree($allclass,$id)
{
	$tree = $id ; 
	$son = $allclass[$id]["son"] ; 
	if( $son!="" )
	{
		$arrson=split(',',$son);
		for($index=0;$index<count($arrson);$index++)
		{
			$tree .= ",". get_id_tree($allclass,$arrson[$index]);
		}
	}
	return $tree;
}

function get_class_html($id,$class,&$html,$show)
{
  $name=$class[$id]["name"];
  $son=$class[$id]["son"];
  $level=(int)$class[$id]["level"];
  $state=$class[$id]["state"];
  if($state==0)
  	return ;
  $sort=$class[$id]["sort"];
  if( $show )
  		$html.="<option value='$id'>" . str_repeat('　',$level) . "$name</option>";
  if($son!="")
	{
		$arrson=split(',',$son);
		for($index=0;$index<count($arrson);$index++)
		{
			get_class_html($arrson[$index],$class,$html,true);
		}
	}
}

function showUnlim($class,$id,$rootid,$maxlevel,&$class_html,$url,$rewrite=1,$treemaxlevel,$firstlevelid,$classid)  //-------------无限极分类，点击展开
{
		$name=$class[$id]["name"];
		$son=trim($class[$id]["son"]);
		$level=(int)$class[$id]["level"];
		$state=$class[$id]["state"];
		$item=$class[$id]["item"];
		$css=$class[$id]["css"];
		if($state==0)
			return ;
		$arr_url= split(',' , $class[$id]["url"] );
		if($url==0)
		{
			$strurl="<a href='" .  getRewrite($name,$id,3,$rewrite) . "' class='a$level {$css}'>$name</a>";
		}
		else if($url==1)
		{
			$strurl="<a href='"  .  getRewrite($name,$id,4,$rewrite) . "' class='a$level {$css}'>$name</a>";
		}
		else if($url==2)
		{
			$strurl="<a href='"  .  getRewrite($name,$id,5,$rewrite) . "' class='a$level {$css}'>$name</a>";
		}
		if($id!=$rootid )
		{
			//if( $son=="" )
				$class_html .="<div class='c$level' id='title$id'>$strurl</div>";
			//else
				//$class_html .="<div class='c$level' id='title$id'><a href=javascript:cshow('sc$id') class='a$level {$css}'>$name($item)</a></div>";
		}
		//0级直接列出，1级($firstlevelid)相同并且分类级别要小于等于点进来分类的级别($treemaxlevel)才往下递归
		if( $son!="" )//&& ($level<=0 || $arr_url[1]==$firstlevelid) && $level<=$treemaxlevel
		{		    
		    //$arrson_url=split(',',$class[$classid]["url"]);
			//大于1级是判断是否在url数组里面，并且分类id不等于当前点进来的$classid
			//if($level>=2 && in_array($id,$arrson_url)==false && $id!=$classid)
			//{
			  // return;
			//}
			$arrson=split(',',$son);
			//if($level>=1)
				//$str=" style='display:none' ";
			$class_html .="<div id='sc$id' $str>";
			for($index=0;$index<count($arrson);$index++)
			{
				showUnlim($class,$arrson[$index],$rootid,$maxlevel,$class_html,$url,$rewrite,$treemaxlevel,$firstlevelid,$classid);
			}	
			$class_html .="</div>";
		}
}
function extendsUnlim($class,$id,$rootid,&$html)
{
	if($id!=$rootid)
	{
		$html .="<script>";
		$arr_classURL=split(",",$class[$id]["url"]);
		for($index=2;$index<count($arr_classURL)-1;$index++)
		{
			$html .="cshow('sc" . $arr_classURL[$index] . "');";	
		}
		$html .="</script>";
	}
}

//0 为 产品url  1 新闻  2 下载分类
function showUnlimHeng($class,$id,$rootid,$maxlevel,&$class_html,$url,$rewrite)  //-------------无限极分类，移动横拉打开
{
		
		static $tzIndex=1000;
		$tzIndex--;
		$name=$class[$id]["name"];
		//$item=$class[$id]["item"];
		$css=$class[$id]["css"];
		$son=trim($class[$id]["son"]);
		$level=(int)$class[$id]["level"]-(int)$class[$rootid]["level"];
		$state=$class[$id]["state"];
		if($state==0)
			return ;
		$zIndex=100*$level+$tzIndex;
		$arr_url= split(',' , $class[$id]["url"] );
		if($url==0)
		{
			$strurl="<a href='" .  getRewrite($name,$id,3,$rewrite) . "' class='a$level {$css}'>$name</a>";
		}
		else if($url==1)
		{
			$strurl="<a href='"  .  getRewrite($name,$id,4,$rewrite) . "' class='a$level {$css}'>$name</a>";
		}
		else if($url==2)
		{
			$strurl="<a href='"  .  getRewrite($name,$id,5,$rewrite) . "' class='a$level {$css}'>$name</a>";
		}
		if( $id!=$rootid )
			$class_html.="<li class='aulli$level' style='z-index : $zIndex'>$strurl";
		if( $son!="" )
		{
			if($id!=$rootid )
				$class_html.="<ul class='aliul$level' style='z-index : $zIndex'>";
			$arrson=split(',',$son);
			for($index=0;$index<count($arrson);$index++)
			{
				showUnlimHeng($class,$arrson[$index],$rootid,$maxlevel,$class_html,$url,$rewrite);
			}
			if($id!=$rootid )	
				$class_html .="</ul>";
		}
		if($id!=$rootid  )
			$class_html .= "</li>";
}

?>