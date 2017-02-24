<?
$rows["payonline"]["paypal"]["business"] = $config[18] ;
$rows["payonline"]["paypal"]["item_name"] = $rows["itemno"] ;
$rows["payonline"]["paypal"]["currency_code"] = "USD" ;
$rows["payonline"]["paypal"]["return"] =  "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=paypal"  ;
$rows["payonline"]["paypal"]["amount"] = $rows["totalprices"] ;
?>
