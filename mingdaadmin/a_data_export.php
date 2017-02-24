<?php
require("php_admin_include.php");

if(getQuery("type")=="user_txt")
{
	isAuthorize($group[3]);
	$arr_split = array("\r\n","|",";",",");
	header("Content-Type: application/force-download");//
	header("Content-Disposition: attachment; filename=\"userinfo.txt\""); //导出的文件名
	header("Pragma: public"); // required 
    header("Expires: 0"); 
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    header("Cache-Control: private",false); // required for certain browsers 
    header("Content-Transfer-Encoding: binary"); 
	$sql=  "select * from @@@user " . $condition ;
	$rs = query($sql);
	$user_data = array();
	while($rows=fetch($rs))
	{
		$user_data[] =$rows["firstname"].",".$rows["lastname"].",".$rows["name"];
	}
	die(join($arr_split[getFormInt("split",0)],$user_data));
}
if(getQuery("type")=="newsletter")
{
	isAuthorize($group[3]);
	$arr_split = array("\r\n","|",";",",");
	header("Content-Type: application/force-download");//
	header("Content-Disposition: attachment; filename=\"newsletter.txt\""); //导出的文件名
	header("Pragma: public"); // required 
    header("Expires: 0"); 
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    header("Cache-Control: private",false); // required for certain browsers 
    header("Content-Transfer-Encoding: binary"); 
	$sql=  "select * from @@@newsletter " . $condition ;
	$rs = query($sql);
	$user_data = array();
	while($rows=fetch($rs))
	{
		$user_data[] =$rows["name"];
	}
	die(join($arr_split[getFormInt("split",0)],$user_data));
}
else if(getQuery("type")=="user_excel")
{
	isAuthorize($group[3]);
	require("../inc/PHPExcel.php");
	require("../inc/PHPExcel/Writer/Excel5.php");
	$execl = new PHPExcel();
	$write = new PHPExcel_Writer_Excel5($execl) ;
	
	$execl->getProperties()->setLastModifiedBy("Admin"); //最后修改人
	$execl->getProperties()->setTitle("User Info"); //标题
	$execl->getProperties()->setSubject("User Info"); //题目
	$execl->getProperties()->setDescription("User Info");//
	$execl->getProperties()->setKeywords("User Info");//
	$execl->getProperties()->setCategory("User Info");//
	$sheet=$execl->setActiveSheetIndex(0);
	$sheet->setTitle('User Info');
	$sheet->setCellValue("A1", "User Email" );
	$sheet->setCellValue("B1", "Gender" );
	$sheet->setCellValue("C1", "First Name" );
	$sheet->setCellValue("D1", "Last Name" );
	$sheet->setCellValue("E1", "Country" );
	$sheet->setCellValue("F1", "Province" );
	$sheet->setCellValue("G1", "City" );
	$sheet->setCellValue("H1", "Street");
	$sheet->setCellValue("I1", "Postcode");
	$sheet->setCellValue("J1", "MSN");
	$sheet->setCellValue("K1", "Addtime");
	$sheet->setCellValue("L1", "Shipping Address");
	$sheet->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle("B1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle("C1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle("D1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle("E1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle("F1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle("G1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
	$sheet->getStyle("H1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
	$sheet->getStyle("I1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
	$sheet->getStyle("J1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
	$sheet->getStyle("K1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
	$sheet->getStyle("L1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
	$sheet->getColumnDimension('A')->setWidth(25);
	$sheet->getColumnDimension('B')->setWidth(10);
	$sheet->getColumnDimension('C')->setWidth(25);
	$sheet->getColumnDimension('D')->setWidth(25);
	$sheet->getColumnDimension('E')->setWidth(25);
	$sheet->getColumnDimension('F')->setWidth(25);
	$sheet->getColumnDimension('G')->setWidth(25);
	$sheet->getColumnDimension('H')->setWidth(40);
	$sheet->getColumnDimension('I')->setWidth(10);
	$sheet->getColumnDimension('J')->setWidth(35);
	$sheet->getColumnDimension('K')->setWidth(12);
	$sheet->getColumnDimension('L')->setWidth(120);
	$sql=  "select * from @@@user " . $condition ;
	$rs = query($sql);
	$user_data = array();
	$index=2;
	$arr_sex = array("Female","Male");
	while($rows=fetch($rs))
	{
		$sheet->setCellValue("A".$index, $rows["name"] );
		$sheet->setCellValue("B".$index, $arr_sex[$rows["sex"]] );
		$sheet->setCellValue("C".$index, $rows["firstname"] );
		$sheet->setCellValue("D".$index, $rows["lastname"] );
		$sheet->setCellValue("E".$index, $rows["country"] );
		$sheet->setCellValue("F".$index, $rows["province"] );
		$sheet->setCellValue("G".$index, $rows["city"] );
		$sheet->setCellValue("H".$index, $rows["street"] );
		$sheet->setCellValue("I".$index, $rows["postcode"] );
		$sheet->setCellValue("J".$index, $rows["msn"] );
		$sheet->setCellValue("K".$index, formatDate( strtotime($rows["addtime"])) );
		
		$sql = "select * from @@@address where userid=" . $rows["id"];
		$ors = query($sql);
		$xls_address = array();
		while($address_rows = fetch($ors))
		{
			$arr_address = split( $cfg["split"] , $address_rows["content"] ) ;
			$xls_address[] = $arr_address[0] . " " . $arr_address[8] . "    Street:{$arr_address[1]}    Location:{$arr_address[3]} {$arr_address[4]} {$arr_address[2]}    Country:{$arr_address[5]}    Contact:{$arr_address[6]} {$arr_address[7]}" ;
		}
		$sheet->setCellValue("L".$index, join("\n",$xls_address) );
		
		$sheet->getStyle("A$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle("A$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle("B$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
		$sheet->getStyle("B$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle("C$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle("C$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle("D$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle("D$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle("E$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle("E$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle("F$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle("F$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle("G$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle("G$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle("H$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle("H$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle("I$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle("I$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle("J$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle("J$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle("K$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle("K$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		$sheet->getStyle("L$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
		$sheet->getStyle("L$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle("L$index")->getAlignment()->setWrapText(true);
		
		$index++;
	}
	ob_end_clean();	
	header("Content-Type: application/force-download"); 
   	header("Content-Type: application/octet-stream"); 
   	header("Content-Type: application/download"); 
   	header('Content-Disposition:inline;filename="userinfo.xls"'); 
   	header("Content-Transfer-Encoding: binary"); 
   	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
   	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
   	header("Pragma: no-cache"); 
   	$write->save('php://output'); 
}
else if(getQuery("type")=="product_info")
{
	isAuthorize($group[2]);
	require("../inc/PHPExcel.php");
	require("../inc/PHPExcel/Writer/Excel5.php");
	$execl = new PHPExcel();
	$write = new PHPExcel_Writer_Excel5($execl) ;
	
	$execl->getProperties()->setLastModifiedBy("Admin"); //最后修改人
	$execl->getProperties()->setTitle("Product Info"); //标题
	$execl->getProperties()->setSubject("Product Info"); //题目
	$execl->getProperties()->setDescription("Product Info");//
	$execl->getProperties()->setKeywords("Product Info");//
	$execl->getProperties()->setCategory("Product Info");//
	$sheet=$execl->setActiveSheetIndex(0);
	$sheet->setTitle('Product Info');
	$sheet->setCellValue("A1", "name" );
	$sheet->setCellValue("B1", "itemno" );
	$sheet->setCellValue("C1", "classid" );
	$sheet->setCellValue("D1", "weight" );
	$sheet->setCellValue("E1", "price1" );
	$sheet->setCellValue("F1", "price2" );
	$sheet->setCellValue("G1", "pic" );
	$sheet->setCellValue("H1", "title" );
	$sheet->setCellValue("I1", "keywords" );
	$sheet->setCellValue("J1", "descript" );
	$sheet->setCellValue("K1", "content" );
	$sheet->setCellValue("L1", "otherpic" );
	$sheet->setCellValue("M1", "pkey" );
	$sheet->setCellValue("N1", "pvalue" );
	$sheet->setCellValue("O1", "ckey" );
	$sheet->setCellValue("P1", "cvalue" );
	$sheet->setCellValue("Q1", "ctype" );
	$sheet->setCellValue("R1", "cprice" );
	$sheet->setCellValue("S1", "pprice" );
	$sheet->setCellValue("T1", "pnum" );
	$sheet->setCellValue("U1", "premark" );
	$sheet->setCellValue("V1", "lastprice" );
	$sheet->setCellValue("W1", "lastremark" );
	$sheet->setCellValue("X1", "minnum" );
	$sheet->getColumnDimension('A')->setWidth(30);
	$sheet->getColumnDimension('B')->setWidth(12);
	$sheet->getColumnDimension('G')->setWidth(30);
	$sheet->getColumnDimension('H')->setWidth(25);
	$sheet->getColumnDimension('I')->setWidth(25);
	$sheet->getColumnDimension('J')->setWidth(25);
	$sql=  "select * from @@@product where classid=" . getQueryInt("classid",0) ;
	$rs = query($sql);
	$index=2;
	while($rows=fetch($rs))
	{
		
		$sheet->setCellValue("A".$index, $rows["name"] );
		$sheet->setCellValue("B".$index, $rows["itemno"] );
		$sheet->setCellValue("C".$index, $rows["classid"] );
		$sheet->setCellValue("D".$index, $rows["weight"] );
		$sheet->setCellValue("E".$index, $rows["price1"] );
		$sheet->setCellValue("F".$index, $rows["price2"] );
		$sheet->setCellValue("G".$index, $rows["pic"] );
		$sheet->setCellValue("H".$index, $rows["title"] );
		$sheet->setCellValue("I".$index, $rows["keywords"] );
		$sheet->setCellValue("J".$index, $rows["descript"] );
		$sheet->setCellValue("K".$index, $rows["content"] );
		
		$sheet->setCellValue("M".$index, $rows["pkey"] );
		$sheet->setCellValue("N".$index, $rows["pvalue"] );
		$sheet->setCellValue("O".$index, $rows["ckey"] );
		$sheet->setCellValue("P".$index, $rows["cvalue"] );
		$sheet->setCellValue("Q".$index, $rows["ctype"] );
		$sheet->setCellValue("R".$index, $rows["cprice"] );
		$sheet->setCellValue("S".$index, $rows["pprice"] );
		$sheet->setCellValue("T".$index, $rows["pnum"] );
		$sheet->setCellValue("U".$index, $rows["premark"] );
		$sheet->setCellValue("V".$index, $rows["lastprice"] );
		$sheet->setCellValue("W".$index, $rows["lastremark"] );
		$sheet->setCellValue("X".$index, $rows["minnum"] );
		$sql = "select * from @@@otherimage where pid=" . $rows["id"];
		$ors = query($sql);
		$xls_oth = array();
		while($oth_rows = fetch($ors))
		{
			$xls_oth[] = $oth_rows["pic"] ;
		}
		$sheet->setCellValue("L".$index, join(";",$xls_oth) );
		
		$index++;
	}
	ob_end_clean();	
	header("Content-Type: application/force-download"); 
   	header("Content-Type: application/octet-stream"); 
   	header("Content-Type: application/download"); 
   	header('Content-Disposition:inline;filename="productinfo.xls"'); 
   	header("Content-Transfer-Encoding: binary"); 
   	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
   	header("Pragma: no-cache"); 
   	$write->save('php://output'); 
}
?>