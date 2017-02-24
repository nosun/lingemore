<?
$rows["payonline"]["yourspay"]["MD5key"] = $config[36];	
$rows["payonline"]["yourspay"]["MerNo"]  = $config[35];	
$rows["payonline"]["yourspay"]["BillNo"] = $rows["itemno"] ;
$rows["payonline"]["yourspay"]["Amount"] = $rows["totalprices"];
$rows["payonline"]["yourspay"]["Currency"] = "15" ;
$rows["payonline"]["yourspay"]["Language"] = "2" ;
$rows["payonline"]["yourspay"]["actionUrl"] = "https://security.credit-pay.com/sslpayment/Interface" ;
$rows["payonline"]["yourspay"]["ReturnURL"] = urlencode( "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=yourspay" );
$rows["payonline"]["yourspay"]["Remark"] = $rows["content"] ;
$rows["payonline"]["yourspay"]["shipCountry"] = $rows["arraddress"][5];
$rows["payonline"]["yourspay"]["shipState"] = $rows["arraddress"][4];
$rows["payonline"]["yourspay"]["shipCity"] = $rows["arraddress"][3];
$rows["payonline"]["yourspay"]["shipAddress"] = $rows["arraddress"][1];
$rows["payonline"]["yourspay"]["GoodsName"] = $rows["itemno"];
$rows["payonline"]["yourspay"]["CurrencyCode"] = "USD" ;
$md5src = $rows["payonline"]["yourspay"]["MerNo"].$rows["payonline"]["yourspay"]["BillNo"].$rows["payonline"]["yourspay"]["Currency"].$rows["payonline"]["yourspay"]["CurrencyCode"].$rows["payonline"]["yourspay"]["Amount"].$rows["payonline"]["yourspay"]["Language"].$rows["payonline"]["yourspay"]["ReturnURL"].$rows["payonline"]["yourspay"]["MD5key"];
$rows["payonline"]["yourspay"]["MD5info"] = strtoupper(md5($md5src));	
			
?>