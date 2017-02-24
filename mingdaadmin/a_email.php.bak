<? require("php_admin_include.php");?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>邮件转发</title>

</head>



<body>



<?php require("php_top.php");?>

<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >

<tr >

    <td  >

<div class="bodytitle">

	<div class="bodytitleleft"></div>

	<div class="bodytitletxt">邮件转发</div>

</div>

</td></tr></table>

<br />



<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle"  >

  <tr  bgcolor="#F2F4F6">

    <td    ><a href="?">邮件内容管理</a> <span class="fontpadding"><a href="?action=show_config">邮箱参数配置</a></span></td>

  </tr>

</table><br />

<?php

$action=getQuery("action");

isAuthorize($group[1]);

switch($action)

{

case "add":

	//addItem();

	break;

case "edit":

	editItem();

	break;

case "add_save":

	//add_save();

	break;

case "show_config":

	show_config();

	break;

case "config_save":

	config_save();

	break;

case "delete_save":

	delete_save();

	break;

case "edit_save":

	//edit_save();

	break;

	

default:

	showItem();

	break;

}

?>



<?

function showItem()

{

?>



<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">

  <tr>

    <td colspan="3"  bgcolor="#F2F4F6"><strong>系统邮件模板</strong>

      <span class="fontpadding"><a class="hide" href="?action=add&cid=1">新加系统邮件模板</a></span></td>

  </tr>



  <tr align="center" bgcolor="#FFFFE9">

    <td width="7%" align="center">ID</td>

    <td width="77%" align="left">名称</td>

    <td width="16%">操作</td>

  </tr>

  <?

  $sql="select * from @@@email";

  $rs=query($sql);

  emptyList($rs,4);

  while($rows=fetch($rs))

  {

  ?>

    <tr align="center" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">

      <td align="center"><?=$rows["id"]?></td>

      <td align="left"><a href="?action=edit&id=<?=$rows["id"]?>"><?=$rows["name"]?></a></td>

    <td><a href="?action=edit&id=<?=$rows["id"]?>">编辑</a> <a class="delete red hide" onClick="return confirm('确定要删除吗？')"  href="?action=delete_save&id=<?=$rows["id"]?>">删除</a> </td>

  </tr>

 <?

 }

 free($rs);

 ?>

</table>

<?

}

?>

<?

function show_config()

{

global $config;

?><form name="formadd" action="?action=config_save" enctype="application/x-www-form-urlencoded" method="post">

<table  border="0" width="96%" align="center" cellpadding="1" cellspacing="1" class="tbtitle marginbottom">

  <tr>

    <td colspan="2" bgcolor="#F2F4F6"><strong>网站邮箱配置</strong></td>

  </tr>

   <tr  bgcolor="#FFFFFF">

     <td width="20%">邮件启用：</td>

     <td width="80%"><table width="600" cellpadding="1" cellspacing="1" border="0" class="tbtitle">

	 <tr align="center" bgcolor="FFFFE9">

	   <td ></td>

            <td >注册通知</td>

            <td >订单通知</td>

            <td >在线留言</td>

        </tr>

          <tr align="center" bgcolor="#FFFFFF">

            <td >发给管理员</td>

            <td ><input name="config130" type="checkbox" value="1">启用</td>

            <td ><input name="config131" type="checkbox" value="1">启用</td>

            <td ><input name="config133" type="checkbox" value="1">启用</td>

          </tr>

         <tr align="center" bgcolor="#FFFFFF">

		 <td >发给游客</td>

         <td ><input name="config140" type="checkbox" value="1">启用</td>

         <td ><input name="config141" type="checkbox" value="1">启用</td>

         <td >&nbsp;</td>

         </tr>

        </table></td>

   </tr>

   <script language="javascript">

	EnterCheckBox("config130","<?=$config[130]?>");

	EnterCheckBox("config131","<?=$config[131]?>");

	EnterCheckBox("config132","<?=$config[132]?>");

	EnterCheckBox("config133","<?=$config[133]?>");

	EnterCheckBox("config134","<?=$config[134]?>");

	

	EnterCheckBox("config140","<?=$config[140]?>");

	EnterCheckBox("config141","<?=$config[141]?>");

	EnterCheckBox("config142","<?=$config[142]?>");

	EnterCheckBox("config143","<?=$config[143]?>");

	EnterCheckBox("config144","<?=$config[144]?>");

   </script>

   <tr onMouseMove="tr_onMouseOver(this)"  onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

     <td>转发收取邮箱：</td>

     <td><input name="config24" type="text"  value="<?=$config[24]?>" size="30" /></td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)"    onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td  width="20%">邮箱SMTP服务器：</td>

    <td><input name="config25" type="text"  value="<?=$config[25]?>" size="30" /> 

    * 企业邮局域名解析需要做 <strong>A记录 </strong>跟 <strong>MX记录</strong></td>

  </tr>

   <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

     <td>邮箱发送账号：</td>

     <td><input name="config26" type="text"  value="<?=$config[26]?>" size="30" /> </td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)"    onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td>邮箱用户名：</td>

    <td><input name="config27" type="text"  value="<?=$config[27]?>" size="30" /> 

    * 

      <a onClick="includeJsFile('Ajax_change','../service/serviceForAddtoMailQueue.php?action=test_config')" href="#">测试邮件发送配置</a> 请先提交保存再点击测试 (长时间无反应证明配置错误)</td>

  </tr>



   <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

     <td>发件人昵称：</td>

     <td><input name="config87" type="text"  value="<?=$config[87]?>" size="30" /></td>

   </tr>

   <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td>邮箱密码：</td>

    <td><input name="config29" type="password" value="<?=$config[29]?>"  size="30"  />  

    * 如果不修改请留空</td>

  </tr>

  

 <tr onMouseMove="tr_onMouseOver(this)"   onMouseOut="tr_onMouseOut(this)"  bgcolor="#FFFFFF" >

    <td>邮箱端口：</td>

    <td><input name="config28" type="text" value="<?=$config[28]?>" size="30" /> 

    * 默认端口25  <a href="a_smtp.php" target="_blank">(最新最全的国内外各大邮箱域名及POP3/SMTP/IMAP)</a></td>

  </tr>

   <tr  bgcolor="#FFFFE9">

    <td  align="left">&nbsp;</td>

    <td  ><input type="submit"  class="button"  name="button" id="button" value="提交" onClick="showtips(this)" /></td>

  </tr>

  </table></form>

<?

}

?>

<?

function addItem()

{

global $glo;

$cid=(int)getQueryInt("cid",0);

?>

<form name="formadd" action="?action=add_save" enctype="application/x-www-form-urlencoded" method="post">

<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">

  <tr>

    <td colspan="2"  bgcolor="#F2F4F6"><strong>添加邮件模板</strong></td>

  </tr>

  

  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">

    <td width="16%" align="left">名称：</td>

    <td width="84%" >

      <input name="name" type="text" id="textfield" size="40" /> <input type="hidden" name="cid" value="<?=$cid?>"  />  </td>

  </tr>

   <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">

    <td align="left">邮件使用标题：</td>

    <td ><input name="title"  type="text" size="80"/></td>

  </tr>

  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">

    <td align="left">文件名：</td>

    <td ><input name="file"  type="text"  size="40"/></td>

  </tr>

      <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">

    <td width="16%" align="left">排序：</td>

    <td width="84%" ><input name="sort" type="text"  value="0" size="6" maxlength="6"/>    </td>

  </tr>

      <tr bgcolor="#FFFFFF">

        <td align="left" valign="top">内容：</td>

        <td >

		<?

		$oFCKeditor = $glo["fck"] ;

		$oFCKeditor->Value = '' ;

		$oFCKeditor->Create() ;

		?>

		</td>

      </tr>

      <tr  bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">

        <td align="left">变量描述：</td>

        <td ><textarea name="descript"   id="descript" cols="60" rows="20"></textarea></td>

    </tr>

    <tr class="add" bgcolor="#FFFFE9">

    <td width="16%" align="left">&nbsp;</td>

    <td width="84%" ><input type="submit"  class="button"  name="button" id="button" value="提交" onClick="showtips(this)" /></td>

  </tr>

</table>

</form>

<?

}

?>



<?

function editItem()

{

global $glo;

$id=getQuerySQL("id");

$sql="select * from @@@email where id=$id";

$rs=query($sql);

isItemNotExist($rs);

$rows=fetch($rs);

?><table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" style="background:#FEDF63;">

  <tr  bgcolor="#FFFFE6">

    <td  >注意：若想在栏目里面 插入图片 ！ 请记得使用 <strong>"带HTTP 的绝对URL路径"</strong>

  </td>

  </tr>

</table>

<br>

<form name="formedit" action="?action=edit_save&id=<?=$id?>" enctype="application/x-www-form-urlencoded" method="post">

<table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">

  <tr>

    <td colspan="2"  bgcolor="#F2F4F6"><strong>编辑邮件模板</strong></td>

  </tr>

  <tr class="hide" bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">

    <td width="16%" align="left">名称：</td>

    <td width="84%" ><input name="name" type="text" value="<?=$rows["name"]?>" size="40"/>    </td>

  </tr>

  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">

    <td align="left">邮件发送使用标题：</td>

    <td ><input name="title"  type="text" value="<?=$rows["title"]?>" size="80"/></td>

  </tr>

  <tr bgcolor="#FFFFFF" class="hide" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">

    <td align="left">文件名：</td>

    <td ><input name="file"  type="text" value="<?=$rows["file"]?>" size="40"/></td>

  </tr>

  <tr bgcolor="#FFFFFF" onMouseMove="tr_onMouseOver(this)" onMouseOut="tr_onMouseOut(this)">

    <td width="16%" align="left">排序：</td>

    <td width="84%" ><input name="sort" type="text"  value="<?=$rows["sort"]?>" size="6" maxlength="6"/></td>

  </tr>

      <tr bgcolor="#FFFFFF">

        <td align="left" valign="top">&nbsp;</td>

        <td >邮件里的联系方式在 <strong>杂项配置-&gt;网站联系方式里</strong> 修改</td>

      </tr>

      <tr bgcolor="#FFFFFF">

        <td align="left" valign="top">内容</td>

        <td >

		<?

		$oFCKeditor = $glo["fck"] ;

		$oFCKeditor->Value = file_get_contents("../skin/default/templates/" . $rows["file"])  ;

		$oFCKeditor->Create() ;

		?>		</td>

      </tr>

<tr class="edit" bgcolor="#FFFFE9">

    <td width="16%" align="left">&nbsp;</td>

    <td width="84%" ><input name="button2"  class="button"  type="submit" value="修改"  onClick="showtips(this)"/></td>

  </tr>

</table>

</form>

<?

free($rs);

}

?>



<?

function delete_save()

{

	$id=getQuerySQL("id");

	$sql="delete from @@@email where id=$id";

	query($sql);

	pageRedirect("2","a_email.php");

}



function add_save()

{

	$param["name"]=getForm("name");

	$param["sort"]=getForm("sort");

	$param["cid"]=getForm("cid");

	$param["file"]=getForm("file");

	$param["title"]=getForm("title");

	$param["content"]=getHTML("content");

	$param["descript"]=getForm("descript");

	$sql=insertSQL($param,"@@@email");

	query($sql);

	file_put_contents("../skin/default/templates/" . getForm("file") , getHTML("content") );

	pageRedirect("0","a_email.php");

}



function edit_save()

{

	$id=getQuerySQL("id");

	$condition="where id=$id";

	$param["name"]=getForm("name");

	$param["sort"]=getForm("sort");

	$param["file"]=getForm("file");

	$param["title"]=getForm("title");

	$param["content"]=getHTML("content");

	$param["descript"]=getForm("descript");

	file_put_contents("../skin/default/templates/" . getForm("file") , getHTML("content") );

	$sql=updateSQL($param,"@@@email",$condition);

	query($sql);

	pageRedirect("1","a_email.php");

}



function config_save()

{

	global $cfg;

	global $config;

	//-------账号

	$param=array();

	$condition="where id=1";

	for($indexI=0;$indexI<1023;$indexI++)

	{

		$config[$indexI]=$config[$indexI];

	}

	

	$arraccount=array(130,131,133,140,141,24,25,26,27,28,87);

	for($index=0;$index<count($arraccount);$index++)

	{

		$config[$arraccount[$index]] = getForm("config".$arraccount[$index]);

		//print_r($config[$arraccount[$index]]);

	}



	$config[29] = getForm("config29") ;

	ksort($config);

	$param["content"]=join( $cfg["split"] , $config ) ;

	$sql=updateSQL( $param,"@@@config",$condition );

	//debug($config);

	query($sql);

	pageRedirect("1","a_email.php?action=show_config");

}

?>

<?php require("php_bottom.php");?>



</body>

</html>

