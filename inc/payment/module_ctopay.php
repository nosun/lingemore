<?
$rows["payonline"]["ctopay"]["MerNo"] = $config[76] ;
$rows["payonline"]["ctopay"]["BillNo"] = $rows["itemno"] ;
$rows["payonline"]["ctopay"]["Amount"] = $rows["totalprices"] ;
$rows["payonline"]["ctopay"]["Currency"] = 15 ;
$rows["payonline"]["ctopay"]["ReturnURL"] = "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=ctopay" ;
$rows["payonline"]["ctopay"]["Language"] = 2 ;
$md5src = $rows["payonline"]["ctopay"]["MerNo"].$rows["payonline"]["ctopay"]["BillNo"].$rows["payonline"]["ctopay"]["Currency"].$rows["payonline"]["ctopay"]["Amount"].$rows["payonline"]["ctopay"]["Language"].$rows["payonline"]["ctopay"]["ReturnURL"].$config[77];
$rows["payonline"]["ctopay"]["MD5info"] = strtoupper(md5($md5src)) ;
?>