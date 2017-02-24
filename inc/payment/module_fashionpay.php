<?
$rows["payonline"]["fashionpay"]["MD5key"] = $config[171];	
$rows["payonline"]["fashionpay"]["MerNo"]  = $config[170];	
$rows["payonline"]["fashionpay"]["BillNo"] = $rows["itemno"] ;
$rows["payonline"]["fashionpay"]["Amount"] = $rows["totalprices"];
$rows["payonline"]["fashionpay"]["Currency"] = "1" ;
$rows["payonline"]["fashionpay"]["Language"] = "2" ;
$rows["payonline"]["fashionpay"]["actionUrl"] = "https://payment.ttopay.com/payment/Interface" ;
$rows["payonline"]["fashionpay"]["ReturnURL"] =  ( "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=fashionpay" );
$rows["payonline"]["fashionpay"]["Remark"] = $rows["itemno"] ;
	
$md5src = $rows["payonline"]["fashionpay"]["MerNo"].$rows["payonline"]["fashionpay"]["BillNo"].$rows["payonline"]["fashionpay"]["Currency"].$rows["payonline"]["fashionpay"]["Amount"].$rows["payonline"]["fashionpay"]["Language"].$rows["payonline"]["fashionpay"]["ReturnURL"].$rows["payonline"]["fashionpay"]["MD5key"];
$rows["payonline"]["fashionpay"]["MD5info"] = strtoupper(md5($md5src));	
?>