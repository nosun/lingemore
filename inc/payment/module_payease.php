<?
function hmac ($key, $data)
{
// 创建 md5的HMAC

$b = 64; // md5加密字节长度
if (strlen($key) > $b) {
$key = pack("H*",md5($key));
}
$key  = str_pad($key, $b, chr(0x00));
$ipad = str_pad('', $b, chr(0x36));
$opad = str_pad('', $b, chr(0x5c));
$k_ipad = $key ^ $ipad;
$k_opad = $key ^ $opad;

return md5($k_opad  . pack("H*",md5($k_ipad . $data)));
}

$rows["payonline"]["payease"]["v_mid"] =  $config[72];
$rows["payonline"]["payease"]["v_oid"] = date("Ymd"). "-" . $config[72] . "-" . $rows["itemno"] ;
$rows["payonline"]["payease"]["v_rcvname"] = $config[72] ;
$rows["payonline"]["payease"]["v_rcvaddr"] = $config[72] ;
$rows["payonline"]["payease"]["v_rcvtel"] = $config[72] ;
$rows["payonline"]["payease"]["v_rcvpost"] = $config[72] ;
$rows["payonline"]["payease"]["v_amount"] = $rows["totalprices"] ;
$rows["payonline"]["payease"]["v_ymd"] = date("Ymd") ;
$rows["payonline"]["payease"]["v_orderstatus"] = 1 ;
$rows["payonline"]["payease"]["v_ordername"] = $config[72] ;
$rows["payonline"]["payease"]["v_moneytype"] = 1 ;
$rows["payonline"]["payease"]["v_url"] = "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&oid=l&type=payease" ;
$rows["payonline"]["payease"]["v_md5chuan"] = "1" . $rows["payonline"]["payease"]["v_ymd"] . $rows["payonline"]["payease"]["v_amount"]  . $rows["payonline"]["payease"]["v_mid"] .  $rows["payonline"]["payease"]["v_oid"] . $rows["payonline"]["payease"]["v_mid"] . $rows["payonline"]["payease"]["v_url"] ;
$rows["payonline"]["payease"]["v_md5info"] =  hmac(  $config[73] ,$rows["payonline"]["payease"]["v_md5chuan"] )  ;
$rows["payonline"]["payease"]["v_shipstreet"] = $rows["arraddress"][1] ;
$rows["payonline"]["payease"]["v_shipcity"] = $rows["arraddress"][3] ;
$rows["payonline"]["payease"]["v_shipstate"] = $rows["arraddress"][4] ;
$rows["payonline"]["payease"]["v_shippost"] = $rows["arraddress"][2] ;
$rows["payonline"]["payease"]["v_shipcountry"] = 156 ;
$rows["payonline"]["payease"]["v_shipphone"] = $rows["arraddress"][6] ;
$rows["payonline"]["payease"]["v_shipemail"] = $rows["arraddress"][7] ;
?>