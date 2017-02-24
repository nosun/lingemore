<?
$MD5key = $config[86]; 
$rows["payonline"]["wedopay"]["MerNo"] = $config[68]; 
$rows["payonline"]["wedopay"]["Currency"] = 1 ;
$rows["payonline"]["wedopay"]["BillNo"] = $rows["itemno"];
$rows["payonline"]["wedopay"]["Amount"] = $rows["totalprices"] ;
$rows["payonline"]["wedopay"]["ReturnURL"]  = "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=wedopay" ;
$rows["payonline"]["wedopay"]["Language"] = 2 ;
$md5src = $rows["payonline"]["wedopay"]["MerNo"].$rows["payonline"]["wedopay"]["BillNo"].$rows["payonline"]["wedopay"]["Currency"].$rows["payonline"]["wedopay"]["Amount"].$rows["payonline"]["wedopay"]["Language"].$rows["payonline"]["wedopay"]["ReturnURL"].$MD5key;
$rows["payonline"]["wedopay"]["MD5info"] = strtoupper(md5($md5src));
$rows["payonline"]["wedopay"]["Remark"]  = $rows["remark"];
$rows["payonline"]["wedopay"]["shippingFirstName"] = $rows["arraddress"][0] ;
$rows["payonline"]["wedopay"]["shippingLastName"]  = $rows["arraddress"][8] ;
$rows["payonline"]["wedopay"]["shippingEmail"]  = $rows["arraddress"][7] ;
$rows["payonline"]["wedopay"]["shippingPhone"]  = $rows["arraddress"][6] ;
$rows["payonline"]["wedopay"]["shippingZipcode"]  = $rows["arraddress"][2] ;
$rows["payonline"]["wedopay"]["shippingAddress"]  = $rows["arraddress"][1] ;
$rows["payonline"]["wedopay"]["shippingCity"]  = $rows["arraddress"][3] ;
$rows["payonline"]["wedopay"]["shippingSstate"]  = $rows["arraddress"][4] ;
$rows["payonline"]["wedopay"]["shippingCountry"]  = $rows["arraddress"][5] ;
$rows["payonline"]["wedopay"]["products"]  = $rows["itemno"];
?>
