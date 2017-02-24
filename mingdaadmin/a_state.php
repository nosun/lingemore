<? require("php_admin_include.php");?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎使用中恒天下网站管理系统</title></head>
<style>
.style2{ color:#FF0000; font-weight:bold}
</style>
<body>
<?php 
require("php_top.php") ;
isAuthorize($group[1]);
set_time_limit(0);
$type = getQueryDefault("type","ftp");
?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center"  >
<tr >
    <td  >
<div class="bodytitle">
	<div class="bodytitleleft"></div>
	<div class="bodytitletxt">空间和数据库使用情况</div>
</div>
</td></tr></table>
<br />
<table width="96%" border="0" cellspacing="1" cellpadding="1" align="center" class="tbtitle" >
  <tr  bgcolor="#F2F4F6">
    <td >
	  <a href="a_index_body.php">网站状态</a><span class="fontpadding"><a class="red" href="a_state.php?type=ftp">FTP空间使用情况</a></span><span class="fontpadding"><a class="red" href="a_state.php?type=mysql">数据库使用情况</a></span><span class="fontpadding"><a href="a_gimage.php">缩略图管理</a></span></td>
  </tr>
</table>
<br>


		
  
   <?
  if( $type=="mysql" )
  {
  	$dbsize = 0;
	$tables = query("SHOW TABLE STATUS");
	while($table=fetch($tables))
	{
		$dbsize += $table['Data_length'] + $table['Index_length'];
	}
	$dbsize = round($dbsize/(1024*1024) , 3);
  ?><table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
		<tr>
				<td width="78%" bgcolor="#F2F4F6"><strong>Mysql数据库</strong></td>
		</tr>
  <tr>
		  <td bgcolor="#FFFFFF" >MySQL 版本：<?=mysql_get_server_info(); ?></td>
  </tr>
  <tr>
		  <td bgcolor="#FFFFFF"  >已使用MySQL数据库大小：<span class="red weight"><?=$dbsize?></span> M</td>
  </tr>
  </table>
   <?
  }
  ?>
  
  <?
  if( $type=="ftp" )
  {
  getDirSize("../uploadImage/" , $filesize1 , $filenum1 ) ;
  getDirSize("../otherimage/" , $filesize2 , $filenum2 ) ;
  getDirSize("../smallimage/" , $filesize3 , $filenum3 ) ;
  ?>
  <table width="96%" border="0" align="center" cellpadding="1" cellspacing="1" class="tbtitle">
		<tr>
				<td colspan="2" bgcolor="#F2F4F6"><strong>Ftp使用情况</strong></td>
		</tr>
        <tr>
          <td width="20%" bgcolor="#FFFFFF"  >网站程序文件：</td>
          <td width="78%" bgcolor="#FFFFFF"  >约 10 M </td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF"  >产品主图占用：</td>
          <td bgcolor="#FFFFFF"  >约 <span class="red weight"><?=round($filesize1/(1024*1024),2)?></span> M , 共 <?=$filenum1?> 张</td>
        </tr>
    <tr>
		  <td  bgcolor="#FFFFFF"  >  产品细节图片占用 ： </td>
          <td bgcolor="#FFFFFF"  >约 <span class="red weight"><?=round($filesize2/(1024*1024),2)?></span> M , 共 <?=$filenum2?> 张</td>
   </tr>
   <tr>
		  <td  bgcolor="#FFFFFF"  >  总缩略图占用 ： </td>
          <td bgcolor="#FFFFFF"  >约 <span class="red weight"><?=round($filesize3/(1024*1024),2)?></span> M , 共 <?=$filenum3?> 张 , <a href="a_gimage.php?folder=otherimage">查看详细缩略图</a></td>
   </tr>
</table> <?
  }
  ?>
<?php require("php_bottom.php")?></body>
</html>
