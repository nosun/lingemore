<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品管理</title>
</head>

<body>
<?php require("php_top.php");?>
<?
$edit=true;
$delete=true;
$add=true;
$view=true;
$tmp_name="";
$tmp_classroot="newsclass";
$tmp_table="newsclass";
$tmp_maxlevel=5;
$tmp_redirect="";
?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">仓库管理</div>
</div>
</td></tr></table>
<br />
<script language="javascript">
   var xmlhttp;
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")

function CheckAll(formdel,str)
{
  for (var i=0;i<document.forms[formdel].elements.length;i++)
  {
    var e = document.forms[formdel].elements[i];
    if (str=="ON")
	   e.checked = true;
	else
		e.checked= false; 
  }
}
function fetch_Property_Div(id,type)
{
	var obj=document.getElementById(id);
	if(obj.value!=0)
	{
			xmlhttp.open("POST","../Service/ServiceForgetProperty.php?classid="+ obj.value + "&type=" + type,true);
	        xmlhttp.onreadystatechange=function(){sth_getProperty()};
            xmlhttp.send(null);
	}
}

function sth_getProperty()
{
 if(xmlhttp.readystate==4)
		   if(xmlhttp.status==200)
		      {   
	              document.getElementById("propertyDiv").innerHTML=xmlhttp.responseText;
		       }
}
function asCallJsSubmitFormData(str)
{
	document.getElementById("pic").value=str;
	document.getElementById("formadd").submit();
}


function changeImage(path)
{
	document.getElementById("imgadd").src="../image.asp?style=1&url=" + path;
}

function removeproducttrresult(id)
{
	$('#producttr'+id).remove();
}

function removeproduct(id)
{
	includeJsFile("script_fresh","../service/serviceForcircle.php?id="+id) ;
}

</script>

<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >
  <tr  bgcolor="#F2F4F6">
    <td    ><a href="a_product.php">商品列表</a><span class="fontpadding"><a href="?">仓库列表</a></span></td>
  </tr>
</table><br />
<?php
isAuthorize($group[2]);
$action=getQuery("action");

$u1=new unlimClass("@@@productclass");
$proot=$u1->create("产品分类");
$u2=new unlimClass("@@@brandclass");
$broot=$u2->create("品牌分类");

switch($action)
{

case "p_handl":
	if( getRequest("do")=="deletepage" )
	{
		p_delete_save(0);
	}
	elseif ( getRequest("do")=="deleteall" )
	{
		p_delete_save(1);
	}
	elseif ( getRequest("do")=="editall" )
	{
		p_edit_save(1);
	}
	elseif ( getRequest("do")=="editpage" )
	{
		p_edit_save(0);
	}
	else
		showItem();
	break;
default:
	showItem();
	break;
}
?>

<?
function showItem()
{
global $cfg;
global $proot;
global $broot;
global $config;
$condition="where state<=0" ;
$pageurl="1=1" ;

$class=fetchAllClass("@@@productclass");
$classid=getRequestInt("classid",$proot);

if($classid!=$proot)
{
	$tree=get_id_tree($class,$classid);
	$condition .=  " and classid in (" . $tree . ")" ;
	$pageurl .= "&classid=" . $classid ;
}

if(getRequest("name")!="")
{
	$condition .=  " and name  like '%" . getRequest("name") . "%'" ;
	$pageurl .= "&name=" . getRequest("name") ;
}

if( count(getRequest("disp")) != 0 && is_array(getRequest("disp")))
{
	$condition.= " and (disp & " . strtoint( getRequest("disp") ) . ")<>0" ;
	$pageurl.= "&disp=" . join( ',' , (array)getRequest("disp") ) ;
}

$orderby=" order by " . getRequestDefault("orderfield","id") . " " . getRequestDefault("order","desc");

$pagenow=getRequestInt("page");
$pagesize=getRequestInt("size",20);
$rs=createPage("*","@@@product",$condition,$orderby,$pagesize,$pagenow,$pagetotal,$recordcount);
?> 
<form name="form2" method="get" action="a_circle.php">
<table border="0" align="center" width="96%" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td bgcolor="#F2F4F6" class="a_title"><strong>仓库搜索条件</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
   
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="68" align="left" style=" padding:0px; margin:0px;letter-spacing:1px;">当前分类：
	    <input id="classname" style="display:none;" type="text" readonly="" value="<?=fetchValue("select name as v from @@@productclass where id=$classid","分类已被删除")?>" />
      <input name="classid" type="hidden" id="classid" value="<?=$classid?>" /></td>
    <td style=" padding:0px; margin:0px;letter-spacing:1px;"><? classRelation($classid,8,"@@@productclass"); ?></td>
    </tr>
</table>      </td>
    </tr> 
	<tr bgcolor="#FFFFFF">
    <td  >
	  产品搜索：
      <input name="name" type="text" id="keyword" value="<?=getRequest("name")?>" size="40">
		 <span class="fontpadding hide">品牌搜索：
        <select name="brandid" id="brandid">
		<option value="">请选择品牌</option>
		<?
		$sql="select id as v,name as k from @@@brandclass where level=1";
		writeSelect($sql);
		?>
        </select>
        <script > EnterSelect("brandid","<?=getRequest("brandid")?>"); </script>
		</span>
        
        <span class="fontpadding">显示类型：
        <select name="disp" id="disp">
		<option value="">请选择类型</option>
	<?
	for($index=0;$index<count($cfg["product"]["disp"]);$index++)
	{
	?>
	<option value="<?=pow(2,$index)?>"><?=$cfg["product"]["disp"][$index]?></option>
	<?
	}
	?>
    </select>
    <script > EnterSelect("disp","<?=getRequest("disp")?>"); </script>
    </span>
	
	<input type="submit" name="Submit4" value="提交"  class="button" >	</td>
  </tr>
	<tr bgcolor="#FFFFFF">
	  <td  >每页显示： 
        <select id="size" name="size"><option value="">20个</option><option value="40">40个</option><option value="50">50个</option><option value="60">60个</option></select><script > EnterSelect("size","<?=getRequest("size")?>"); </script><span class="fontpadding">排序： 
      <select id="orderfield" name="orderfield">
	<option value="">ID</option>
	<option value="addtime">时间</option>
	<option value="hits">访问量</option>
	<option value="sort">排序</option>
	</select> 
	<script > EnterSelect("orderfield","<?=getRequest("orderfield")?>"); </script></span>
        <select name="order" id="order">
		<option value="">降序</option>
		<option value="asc">升序</option>
        </select>
		<script > EnterSelect("order","<?=getRequest("order")?>"); </script></td>
    </tr>
</table>
</form>
<br>
<table border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
  <tr>
    <td colspan="7" bgcolor="#F2F4F6"><strong>仓库列表</strong></td>
  </tr>
  <tr align="center" bgcolor="#FFFFE9">
  <td width="7%" >选择</td>
    <td width="14%"  >商品图片</td>
    <td width="18%"  align="left" >名称</td>
    <td width="14%"  >分类</td>
    <td width="10%"  >访问量</td>
    <td width="19%"  >商品相关</td>
    <td width="18%"  >操作</td>
    
  </tr>

<form name="formdel" method="post" action="?action=p_handl">
<?
$class=fetchAllClass("@@@productclass");
emptyList($rs,7);
while($rows=mysql_fetch_array($rs))
{
?>
  <tr  id="producttr<?=$rows["id"]?>"  align="center"  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">
   <td   class="a_fen">
      <input name="cbid[]" type="checkbox" id="id" value="<?=$rows["id"]?>"></td>
    <td  class="a_fen"><a href="a_product.php?action=edit&id=<?=$rows["id"]?>"><img src="<?=getImageURL($rows["pic"],3,"uploadImage/",IMAGE)?>" border="0"></a></td>
    <td  align="left" class="a_fen"><a href="?action=edit&id=<?=$rows["id"]?>"></a><?=$rows["name"]?></td>
    <td  class="a_fen"><?=fetchClassValue($class,$rows["classid"])?></td>
    <td class="a_fen"><?=$rows["hits"]?></td>
    <td  class="a_fen">
    <a href="a_image.php?pid=<?=$rows["id"]?>">其他图片</a></td>
    <td class="a_fen"><a class="edit" href="javascript:removeproduct(<?=$rows["id"]?>)">上架商品</a> <a class="delete red" onClick="return confirm('确定删除吗')"  href="?action=p_handl&do=deletepage&cbid[]=<?=$rows["id"]?>">删除商品</a>
</td>
   
  </tr>
<?
}
?>
  <tr bgcolor="#FFFFFF">
    <td colspan="7" class="a_fen">选择：<a  href="javascript:CheckAll('formdel','ON')">全选</a> 
      -
  <a href="javascript:CheckAll('formdel','OFF')">取消</a>
  
  <span class="fontpadding edit">
  批量上架：
      <a href="javascript:submit_onClick('formdel','editpage')" >当前所选</a> - 
	  <a href="javascript:submit_onClick('formdel','editall')" >所有<?=$recordcount?>个结果</a>
	  </span>
	   <span class="fontpadding delete">
  批量删除：
      <a href="javascript:submit_onClick('formdel','deletepage')" class="red" >当前所选</a> - 
	  <a href="javascript:submit_onClick('formdel','deleteall')" class="red">搜索到的<?=$recordcount?>个结果</a>
	  </span>
	    
      <input id="do" name="do" type="hidden" value="editpage" />
      <input type="hidden" name="condition" id="condition" value="<?=$condition?>" /></td>
	</tr>
</form>
  <tr bgcolor="#FFFFE9">
    <td colspan="7" align="right" ><? require("php_page.php")?></td>
  </tr>
</table>
<script>
function submit_onClick(formdel,strdo)
{
	document.getElementById("do").value=strdo;
	if(confirm("确定执行该操作吗?"))
	{
		document.forms[formdel].submit();
	}
}
</script>

<?
}
?>
<?

function p_edit_save($flag)
{
	if( $flag==0 )
	{
		$id=getRequestStr("cbid",0,0);
		$condition="where id in ($id)";
	}
	else
	{
		$condition=getForm("condition");
	}
	$param["state"]="@state*-1";
	$sql=updateSQL($param,"@@@product",$condition);
	query($sql);
	pageRedirect("1","a_circle.php");
}


function p_delete_save($flag)
{
	global $cfg;
	if( $flag==0 )
	{
		$id=getRequestStr("cbid",0,0);
		$condition="where id in ($id)";
	}
	else
	{
		$condition=getForm("condition");
	}
	//deletePpic( "product",$condition , $cfg["deleteImage"] ,"../uploadImage/" );
	$rs=deleteRecord("@@@product","$condition");
	$arrid = array();
	while($rows=fetch($rs))
	{
		$arrid[]=$rows["id"] ; 
		deleteImage( $rows["pic"] , $cfg["deleteImage"] , "../uploadImage/",IMAGE );
		
		$condition="where pid=" . $rows["id"];
		$rs2 = deleteRecord("@@@ptag",$condition);
		while( $rows2 = fetch($rs2) )
		{
			 $arrdelete[] =  $rows2["name"] ;
		}
		//debug($arroldtag);
		$arrdelete = array_unique($arrdelete);
		$arrdelete = array_filter($arrdelete);
		removeSplitEmpty($arrdelete);
		$arrdelete = array_map( "strtolower" , $arrdelete ) ;
		foreach ($arrdelete as $deletevalue)
		{
			$param =  array();
			$deletevalue = mysql_escape_string( $deletevalue ) ;
			$param["count"] =  "@count-1" ;
			$param["name"] =  $deletevalue ;
			$condition = "where name='$deletevalue'";
			$sql=updateSQL($param,"@@@ptaglist",$condition);
			query($sql);
			$condition = "where count<=0 and name like '$deletevalue'";
			deleteRecord("@@@ptaglist",$condition);
		}
		
	}
	$condition="where pid in (" . dataDefault( join(',',$arrid) ,0) . ")";
	//deletePpic( "otherimage",$condition , $cfg["deleteImage"] ,"../otherimage/" );
	$rs=deleteRecord("@@@otherimage","$condition");
	while($rows=fetch($rs))
	{
		deleteImage( $rows["pic"] , $cfg["deleteImage"] , "../otherimage/",IMAGE );
	}
	pageRedirect("2","a_circle.php");
}
?>
<? require("php_bottom.php");?>
</body>
</html>
