<?
$rows["payonline"]["gspay"]["siteID"] = $config[59] ;
$rows["payonline"]["gspay"]["OrderID"] = $rows["itemno"] ;
$rows["payonline"]["gspay"]["OrderDescription"] = $rows["itemno"] ;
$rows["payonline"]["gspay"]["Amount"] = $rows["totalprices"] ;
$rows["payonline"]["gspay"]["Qty"] = 1 ;
$rows["payonline"]["gspay"]["returnUrl"] = "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=gspay" ;
?>