<?
require("php_admin_include.php");
require("../inc/PHPExcel.php");
require("../inc/PHPExcel/Writer/Excel5.php");
isAuthorize($group[3]);


$id=getQuerySQL("id");
$sql="select * from `@@@order` where id=$id";
$rs=query($sql);
isItemNotExist($rs);
$order=fetch($rs);
$coin=$order["coin"];
$discount=$order["discount"];
$itemno = $order["itemno"];
$execl = new PHPExcel();
$write = new PHPExcel_Writer_Excel5($execl) ;

$execl->getProperties()->setLastModifiedBy("Admin"); //最后修改人
$execl->getProperties()->setTitle("Order Excel"); //标题
$execl->getProperties()->setSubject("Order Excel"); //题目
$execl->getProperties()->setDescription("Order Excel");//
$execl->getProperties()->setKeywords("Order Excel");//
$execl->getProperties()->setCategory("Order Excel");//
$sheet=$execl->setActiveSheetIndex(0);
$sheet->setTitle('Order Excel');

$totalprice=0;
$sheet->setCellValue("A1", "Product pic" );
$sheet->setCellValue("B1", "Product name/style" );
$sheet->setCellValue("C1", "Item NO." );
$sheet->setCellValue("D1", "Price" );
$sheet->setCellValue("E1", "Weight" );
$sheet->setCellValue("F1", "Quantity" );
$sheet->setCellValue("G1", "Sub price" );
$sheet->setCellValue("H1", "Sub Weight" );
$sheet->setCellValue("I1", "Remark");
$sheet->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet->getStyle("B1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
$sheet->getStyle("C1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet->getStyle("D1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet->getStyle("E1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet->getStyle("F1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet->getStyle("G1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
$sheet->getStyle("H1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
$sheet->getStyle("I1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
$index=2;
$sql="select * from @@@orderproduct where orderid=$id";
$ors=query($sql);
while($rows=fetch($ors))
{
	
	$draw = new PHPExcel_Worksheet_Drawing();
	$draw->setCoordinates("A".$index);
	if( IMAGE==1 )
	{
		
		if( GrabImage( getImageURL($rows["ppic"],-1,"uploadImage/",1) , ROOT . FOLDER ."excelImage/" . $rows["ppic"] ) )
		{	
			$draw->setPath( ROOT . FOLDER . "tempfile/" . $rows["ppic"] , true);
			$arrresizeimage = getImageResize(ROOT . FOLDER . "tempfile/" . $rows["ppic"],150,150) ;
			$draw->setHeight( 0.138 * $arrresizeimage[0] );
			$draw->setWidth( 0.75 * $arrresizeimage[1] );
			//$filearray = getimagesize (  ROOT . FOLDER . "excelImage/" . $rows["ppic"] );
			//$draw->setOffsetX( (42 - $filearray["width"]/2)*11.29/42 );
			//$draw->setOffsetY( (40 - $filearray["height"]/2)*4.5/10 );
		}
	}
	else
	{
		if( file_exists( ROOT . FOLDER . "uploadImage/" . $rows["ppic"]  ) )
		{
			$draw->setPath( ROOT . FOLDER . "uploadImage/" . $rows["ppic"] );
			$arrresizeimage = getImageResize(ROOT . FOLDER . "uploadImage/" . $rows["ppic"],150,150) ;
			//debug($arrresizeimage   );
			$draw->setHeight(  $arrresizeimage[0] );
			$draw->setWidth(  $arrresizeimage[1] );
		}
	}
		//debug(  getImageURL($rows["ppic"],3,"uploadImage/") );
		
		
		//debug( (40 - $filearray["width"]/2) );
	$itemweight = $rows["pweight"] * $rows["pnum"] ;
	$itemprice = $rows["pnum"] * $rows["pprice"] ;
	r2n($itemprice);
	$totalprice += $itemprice;
	$totalweight += $itemweight;
	$totalnum += $rows["pnum"];
	$draw->setWorksheet($execl->getActiveSheet());
	$sheet->setCellValue("B".$index, $rows["pname"] . "\r\n" . str_replace("<br />","\r\n" , $rows["pstyle"]) );
	$sheet->setCellValue("C".$index, $rows["pitemno"] );
	$sheet->setCellValue("D".$index, $order["coin"] . " "  . $rows["pprice"]);
	$sheet->setCellValue("E".$index, $rows["pweight"] . " KG");
	$sheet->setCellValue("F".$index, $rows["pnum"]);
	$sheet->setCellValue("G".$index, $order["coin"] . " " . $itemprice);
	$sheet->setCellValue("H".$index, $itemweight . " KG" );
	$sheet->setCellValue("I".$index, "\"".$rows["premark"]."\""  );
	
	
	$sheet->getColumnDimension('A')->setWidth(22);
	$sheet->getColumnDimension('B')->setWidth(60);
	$sheet->getColumnDimension('C')->setWidth(15);
	$sheet->getColumnDimension('D')->setWidth(15);
	$sheet->getColumnDimension('E')->setWidth(15);
	$sheet->getColumnDimension('F')->setWidth(15);
	$sheet->getColumnDimension('G')->setWidth(15);
	$sheet->getColumnDimension('H')->setWidth(15);
	$sheet->getColumnDimension('I')->setWidth(15);
	$sheet->getRowDimension($index)->setRowHeight(170);
	$sheet->getStyle("A$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle("A$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$sheet->getStyle("B$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
	$sheet->getStyle("B$index")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$sheet->getStyle("B$index")->getAlignment()->setWrapText(true);
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
	$index++;
}
$sheet->getStyle("F$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet->getStyle("G$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet->getStyle("H$index")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet->setCellValue("F".$index, $totalnum);
$sheet->setCellValue("G".$index, $order["coin"] . " " . $totalprice);
$sheet->setCellValue("H".$index, $totalweight . " KG");


$sheet->setCellValue("A".($index+1), "Order NO.");
$sheet->setCellValue("B".($index+1), "".$order["itemno"]."");
$sheet->setCellValue("A".($index+2), "Product Price");
$sheet->setCellValue("B".($index+2), $order["coin"]. " "  . $totalprice);
$sheet->setCellValue("A".($index+3), "Shipping price");
$sheet->setCellValue("B".($index+3), $order["coin"]. " "  . $order["sub1"] ." (" . $order["express"].")");
$sheet->setCellValue("A".($index+4), "Payment price");
$sheet->setCellValue("B".($index+4), $order["coin"]. " "  . $order["sub2"] ." (" . $order["payment"].")");
$sheet->setCellValue("A".($index+5), "Manual discount");
$sheet->setCellValue("B".($index+5), $order["coin"]. " "  . $order["sub3"] );
$sheet->setCellValue("A".($index+6), "System discount");
$sheet->setCellValue("B".($index+6), $order["coin"]. " "  . $order["sub4"] );
$sheet->setCellValue("A".($index+7), "Total Price");
$sheet->setCellValue("B".($index+7), $order["coin"] . " " . ($totalprice+$order["sub1"]+$order["sub2"]+$order["sub3"]+$order["sub4"]) );

$sheet->setCellValue("A".($index+8), "Shipping Address");
$sheet->setCellValue("B".($index+8), str_replace($cfg["split"] , "  " , $order["address"] ));
$sheet->setCellValue("A".($index+9), "Shipping NO.");
$sheet->setCellValue("B".($index+9), $order["shipno"] );
$sheet->setCellValue("A".($index+10), "Order Remark");
$sheet->setCellValue("B".($index+10), $order["content"]);
$sheet->setCellValue("A".($index+11), "Order Addtime");
$sheet->setCellValue("B".($index+11), $order["addtime"]);

$randfile = rand(1000000,999999);
@unlink("../tempfile/{$randfile}.xls");
$write->save("../tempfile/{$randfile}.xls");
header("Content-Type: application/force-download"); 
header("Content-Type: application/octet-stream"); 
header("Content-Type: application/download"); 
header("Content-Disposition:attachment;filename=\"".$itemno.".xls\""); 
header("Content-Transfer-Encoding: binary"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Pragma: no-cache"); 
readfile(ROOT.FOLDER."tempfile/{$randfile}.xls");
@unlink("../tempfile/{$randfile}.xls");
exit;
?>