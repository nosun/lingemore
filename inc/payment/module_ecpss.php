<?
$rows["payonline"]["ecpss"]["Currency"] = 1 ;
$rows["payonline"]["ecpss"]["MerNo"] = $config[70] ;
$rows["payonline"]["ecpss"]["BillNo"] = $rows["itemno"] ;
$rows["payonline"]["ecpss"]["Amount"] = $rows["totalprices"]  ;
$rows["payonline"]["ecpss"]["ReturnURL"] = "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=ecpss" ;
$rows["payonline"]["ecpss"]["Language"] = 2 ;
$ecpssmd5src = $rows["payonline"]["ecpss"]["MerNo"].$rows["payonline"]["ecpss"]["BillNo"].$rows["payonline"]["ecpss"]["Currency"].$rows["payonline"]["ecpss"]["Amount"].$rows["payonline"]["ecpss"]["Language"].$rows["payonline"]["ecpss"]["ReturnURL"].$config[71];
$rows["payonline"]["ecpss"]["MD5info"] = strtoupper(md5($ecpssmd5src)) ;
$rows["payonline"]["ecpss"]["Remark"] = "" ;
$rows["payonline"]["ecpss"]["shippingFirstName"] = $rows["arraddress"][0] ;
$rows["payonline"]["ecpss"]["shippingLastName"] = $rows["arraddress"][8] ;
$rows["payonline"]["ecpss"]["shippingEmail"] = $rows["arraddress"][7] ;
$rows["payonline"]["ecpss"]["shippingPhone"] = $rows["arraddress"][6] ;
$rows["payonline"]["ecpss"]["shippingZipcode"] = $rows["arraddress"][2] ;
$rows["payonline"]["ecpss"]["shippingAddress"] = $rows["arraddress"][1] ;
$rows["payonline"]["ecpss"]["shippingCity"] = $rows["arraddress"][3] ;
$rows["payonline"]["ecpss"]["shippingSstate"] = $rows["arraddress"][4] ;
$rows["payonline"]["ecpss"]["shippingCountry"] = $rows["arraddress"][5] ;
$rows["payonline"]["ecpss"]["products"] = "products info" ;
?>