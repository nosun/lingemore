<?php

require("inc/php_inc.php");
require("inc/Smarty-2.6.26/libs/Smarty.class.php");
require("uio_pubdata.php");

$str_url = "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "service/serviceForTriggerMail.php?id=1044";
//echo $str_url;exit;
getRemoteData($str_url,"","",2);





?>
