<?
$rows["payonline"]["95epay"]["MerNo"] = $config[74] ;
$rows["payonline"]["95epay"]["BillNo"] = $rows["itemno"] ;
$rows["payonline"]["95epay"]["Currency"] = "1" ;
$rows["payonline"]["95epay"]["Amount"] = $rows["totalprices"] ;
$rows["payonline"]["95epay"]["Language"] = "2" ;
$rows["payonline"]["95epay"]["MerWebsite"] = "http://" . $_SERVER['SERVER_NAME'] ;
$rows["payonline"]["95epay"]["Remark"] = $rows["content"] ;
$rows["payonline"]["95epay"]["ReturnURL"] = "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "inc/payment/payresult/95epay_result.php"  ;
$md5src = $config[74].$rows["itemno"].$rows["payonline"]["95epay"]["Currency"].$rows["totalprices"].$rows["payonline"]["95epay"]["Language"].$rows["payonline"]["95epay"]["ReturnURL"].$config[75];
$rows["payonline"]["95epay"]["MD5info"] = strtoupper(md5($md5src)) ;
$rows["payonline"]["95epay"]["DeliveryFirstName"] = $rows["arraddress"][0] ;
$rows["payonline"]["95epay"]["DeliveryLastName"] = $rows["arraddress"][8] ;
$rows["payonline"]["95epay"]["DeliveryEmail"] = $rows["arraddress"][7] ;
$rows["payonline"]["95epay"]["DeliveryPhone"] = $rows["arraddress"][6] ;
$rows["payonline"]["95epay"]["DeliveryZipCode"] = $rows["arraddress"][2] ;
$rows["payonline"]["95epay"]["DeliveryAddress"] = $rows["arraddress"][1] ;
$rows["payonline"]["95epay"]["DeliveryCity"] = $rows["arraddress"][3] ;
$rows["payonline"]["95epay"]["DeliveryState"] = $rows["arraddress"][4] ;
$rows["payonline"]["95epay"]["DeliveryCountry"] = $rows["arraddress"][5] ;

$rows["payonline"]["95epay"]["FirstName"] = $rows["arraddress"][0] ;
$rows["payonline"]["95epay"]["LastName"] = $rows["arraddress"][8] ;
$rows["payonline"]["95epay"]["Email"] = $rows["arraddress"][7] ;
$rows["payonline"]["95epay"]["Phone"] = $rows["arraddress"][6] ;
$rows["payonline"]["95epay"]["ZipCode"] = $rows["arraddress"][2] ;
$rows["payonline"]["95epay"]["Address"] = $rows["arraddress"][1] ;
$rows["payonline"]["95epay"]["City"] = $rows["arraddress"][3] ;
$rows["payonline"]["95epay"]["State"] = $rows["arraddress"][4] ;
$rows["payonline"]["95epay"]["Country"] = $rows["arraddress"][5] ;
?>