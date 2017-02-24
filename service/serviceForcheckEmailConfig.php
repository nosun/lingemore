<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>邮箱配置</title>
</head>
<body>
<?
require("../inc/php_inc.php");
require("../inc/class.phpmailer.php");
require("php_checkadmin.php");
mysql_close();
$mail = new PHPMailer(); //建立邮件发送类
$mail->IsSMTP(); // 使用SMTP方式发送
$mail->Host = $config[25]; // 您的企业邮局域名
$mail->CharSet = "UTF-8"; // 设置字符集编码，GB2312 GBK
$mail->Encoding = "base64";//设置文本编码方式
$mail->SMTPAuth = true; // 启用SMTP验证功能
$mail->Username = $config[27]; // 邮局用户名(请填写完整的email地址)
$mail->Password = $config[29]; // 邮局密码
$mail->Port = $config[28];
$mail->From = $config[26]; //邮件发送者email地址
$mail->FromName = $config[87];
$mail->AddAddress($config[24], "");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
$mail->Subject = "测试邮件配置"; //邮件标题
$mail->Body = "测试邮件配置"; //邮件内容
$mail->do_debug = false;
$mail->SMTPDebug = false;
if(!$mail->Send())
{
	echo "邮件发送失败,原因:" . $mail->ErrorInfo;
}
else
{
	echo "邮件发送成功";
}
?>
</body>
</html>