<?

$rows["payonline"]["rppay"]["order_sn"] = $rows["itemno"];	
$rows["payonline"]["rppay"]["siteid"]  = $config[65];
$rows["payonline"]["rppay"]["MD5key"] = $config[66];
$rows["payonline"]["rppay"]["verifyCode"] = $rows["itemno"] ;
$rows["payonline"]["rppay"]["ShippingFee"] = 0 ;
$rows["payonline"]["rppay"]["currency"] = "USD" ;
$rows["payonline"]["rppay"]["backurl"] = "http://" . $_SERVER['SERVER_NAME'] . FOLDER ;
$rows["payonline"]["rppay"]["returnUrl"] =  "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=rppay" ;
$rows["payonline"]["rppay"]["product_name"] = $rows["itemno"] ;
$rows["payonline"]["rppay"]["price_unit"] = $rows["totalprices"] ;
$rows["payonline"]["rppay"]["quantity"] = 1 ;				
$md5src = $rows["payonline"]["rppay"]["siteid"].$rows["payonline"]["rppay"]["order_sn"].$rows["payonline"]["rppay"]["price_unit"].$rows["payonline"]["rppay"]["returnUrl"].$rows["payonline"]["rppay"]["MD5key"];
$rows["payonline"]["rppay"]["verifyCode"] = strtoupper(md5($md5src));
$rows["payonline"]["rppay"]["submit_url"] = "https://www.realypay-checkout.com/payment/index.cgi" ;
$rows["payonline"]["rppay"]["email"] = $rows["arraddress"][7] ;
$rows["payonline"]["rppay"]["customername"] = $rows["arraddress"][0] . " " . $rows["arraddress"][8] ;
$rows["payonline"]["rppay"]["state"] = $rows["arraddress"][4] ;
$rows["payonline"]["rppay"]["city"] = $rows["arraddress"][3] ;
$rows["payonline"]["rppay"]["address"] = $rows["arraddress"][1] ;
$rows["payonline"]["rppay"]["postcode"] = $rows["arraddress"][2] ;
$rows["payonline"]["rppay"]["country"] = $rows["arraddress"][5] ;
$rows["payonline"]["rppay"]["tel"] = $rows["arraddress"][6] ;
$rows["payonline"]["rppay"]["mobile"]  = $rows["arraddress"][6] ;



?>
