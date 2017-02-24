<?
require("../inc/php_inc.php");
require("php_checkadmin.php");
$action = getQuery("action");
if($action=="")
	die("alert('发生错误')");
switch( $action )
{
	case "test_config":
		$vartmp = array();
		$vartmp["action"] = "test_config";
		addToMailQueue($vartmp);
		break;
	case "email_order_admin":
		$vartmp = array();
		$vartmp["action"] = "email_order_admin";
		$vartmp["id"] = getQueryInt("id",0);
		addToMailQueue($vartmp);
		break;
	case "email_order_user":
		$vartmp = array();
		$vartmp["action"] = "email_order_user";
		$vartmp["id"] = getQueryInt("id",0);
		$vartmp["html"] = getQuery("html") ;
		addToMailQueue($vartmp);
		break;
	case "trigger":
		$mailid = getQueryInt("id",0);
		$str_url = "http://".$_SERVER['SERVER_NAME'] .  FOLDER . "service/serviceForTriggerMail.php?id=" . $mailid ;
		getRemoteData($str_url,"","",2);
		break;
	default:
		break;
}
die("alert('加入队列成功!具体发送情况请于10秒后到 邮件队列 里查看')");
?>