<?

$rows["payonline"]["ttopay"]["MD5key"] = $config[32];	
$rows["payonline"]["ttopay"]["MerNo"]  = $config[31];	
$rows["payonline"]["ttopay"]["BillNo"] = $rows["itemno"] ;
$rows["payonline"]["ttopay"]["Amount"] = $rows["totalprices"];
$rows["payonline"]["ttopay"]["Currency"] = "15" ;
$rows["payonline"]["ttopay"]["Language"] = "2" ;
$rows["payonline"]["ttopay"]["actionUrl"] = "https://payment.ttopay.com/payment/Interface" ;
$rows["payonline"]["ttopay"]["ReturnURL"] = ( "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=ttopay" );
$rows["payonline"]["ttopay"]["Remark"] = $rows["itemno"] ;
						
$md5src = $rows["payonline"]["ttopay"]["MerNo"].$rows["payonline"]["ttopay"]["BillNo"].$rows["payonline"]["ttopay"]["Currency"].$rows["payonline"]["ttopay"]["Amount"].$rows["payonline"]["ttopay"]["Language"].$rows["payonline"]["ttopay"]["ReturnURL"].$rows["payonline"]["ttopay"]["MD5key"];
$rows["payonline"]["ttopay"]["MD5info"] = strtoupper(md5($md5src));	
			
?>