<?
$rows["payonline"]["moneybookers"]["pay_to_email"] = $config[78] ;
$rows["payonline"]["moneybookers"]["currency"] = "USD" ;
$rows["payonline"]["moneybookers"]["return_url"] =  "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=moneybookers"  ;
$rows["payonline"]["moneybookers"]["language"] = "EN" ;
$rows["payonline"]["moneybookers"]["amount"] = $rows["totalprices"] ;
$rows["payonline"]["moneybookers"]["detail1_description"] = $rows["itemno"] ;
$rows["payonline"]["moneybookers"]["detail1_text"] = $rows["content"] ;
?>