<?

ignore_user_abort(true);

set_time_limit(0);

require("inc/php_inc.php");

require("inc/class.phpmailer.php");

require("inc/Smarty-2.6.26/libs/Smarty.class.php");



$queueid = getQueryInt("queueid",0);

$sql = "select * from @@@mailqueue where id=" . $queueid ;

$rs = query($sql);

if(BOF($rs))

	die("Queue Null");

$qrows = fetch($rs);

$mailvar = json_decode($qrows["var"],TRUE);

$action = $mailvar["action"];

$mail = new PHPMailer(); //建立邮件发送类

$mail->IsSMTP(); // 使用SMTP方式发送

$mail->CharSet = "UTF-8"; // 设置字符集编码，GB2312 GBK

$mail->Encoding = "base64";//设置文本编码方式

$mail->Host = $config[25]; // 您的企业邮局域名

$mail->SMTPAuth = true; // 启用SMTP验证功能

$mail->Username = $config[27]; // 邮局用户名(请填写完整的email地址)

$mail->Password = $config[29]; // 邮局密码

$mail->Port = $config[28];

$mail->From = $config[26]; //邮件发送者email地址

$mail->FromName = $config[87];

$mail->SMTPDebug = false;

$mail->SMTPSecure = "ssl";

$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式

$esmarty = new Smarty();

$esmarty->template_dir = 'skin/' . $cfg["skin"] . '/templates/'; 

$esmarty->compile_dir = 'skin/'. $cfg["skin"] .'/templates_c/'; 

$esmarty->config_dir = 'skin/'. $cfg["skin"] .'/configs/'; 

$esmarty->cache_dir = 'skin/'. $cfg["skin"] .'/cache/'; 

$esmarty->left_delimiter = "{{";

$esmarty->right_delimiter = "}}";

$esmarty->assign("httpdomain", "http://" . $_SERVER['SERVER_NAME'] . FOLDER );

$esmarty->assign("domain", $_SERVER['SERVER_NAME'] );

$arr_contact["email"] = $config[310];

$arr_contact["fax"] = $config[11];

$arr_contact["msn"] = $config[308];

$arr_contact["address"] = $config[309];

$arr_contact["zip"] = $config[20];

$arr_contact["tel"] = $config[10];



$esmarty->assign("contact",$arr_contact);



switch( $action )

{

	case "email_feedback_admin":	

		$param = array();

		$param["name"] = fetchValue("select name as v from @@@email where id=7","");

	

		$id = $mailvar["id"];

		$sql = "select * from @@@message where id= " . $id ;

		$rs = query($sql);

		if( BOF($rs) )

			die("//Message Error");

		$rows = fetch($rs);

		$rows["contact"] = split( $cfg["split"]  , $rows["contact"] );

		$rows["content"] = nl2br($rows["content"]);

		free($rs);

	

		$mail->AddAddress($config[24], "");

		$esmarty->assign("message",$rows);

		$content = $esmarty->fetch( "email_feedback_admin.html" );

		$mail->Subject = fetchValue("select title as v from @@@email where id=7","Feedback Infomation"); //邮件标题

		$mail->Body = $content; //邮件内容

		if(!$mail->Send())

		{

			$param["state"] = 3 ;

			$param["content"] =  $mail->ErrorInfo ;

		}

		else

		{

			$param["state"] = 2 ;

			$param["content"] = "";

		}

		$mail->SmtpClose();

		$param["toemail"] = $config[24] ;

		$param["cid"] = 3;

		$param["pid"] = $id;

		$param["addtime"] = formatDateTime(time());

		$condition = "where id=" . $queueid ;

		$sql=updateSQL($param,"@@@mailqueue",$condition);

		query($sql);

		break;

	case "email_feedback_reply":

		$param = array();

		$param["name"] = fetchValue("select name as v from @@@email where id=10","");

		$id = $mailvar["id"];

		$sql = "select * from @@@message where id= " . $id ;

		$rs = query($sql);

		if( BOF($rs) )

			die("//Message Error");

		$rows = fetch($rs);

		$rows["contact"] = split( $cfg["split"]  , $rows["contact"] );

		$rows["content"] = nl2br($rows["content"]);

		free($rs);

	

		$mail->AddAddress($rows["contact"][0], "");

		$esmarty->assign("message",$rows);

		$content = $esmarty->fetch( "email_feedback_reply.html" );

		$mail->Subject = fetchValue("select title as v from @@@email where id=10","Feedback Reply"); //邮件标题

		$mail->Body = $content; 

		if(!$mail->Send())

		{

			$param["state"] = 3 ;

			$param["content"] =  $mail->ErrorInfo ;

		}

		else

		{

			$param["state"] = 2 ;

			$param["content"] = "";

		}

		$mail->SmtpClose();

		$param["toemail"] = $rows["contact"][0] ;

		$param["cid"] = 3;

		$param["pid"] = $id;

		$param["addtime"]=formatDateTime(time());

		$condition = "where id=" . $queueid ;

		$sql=updateSQL($param,"@@@mailqueue",$condition);

		query($sql);

		break;

	case "email_register_admin":

		$param = array();

		$param["name"] = fetchValue("select name as v from @@@email where id=5","");

		$id = $mailvar["id"];	

		$mail->AddAddress($config[24], "");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")

		$sql = "select * from @@@user where id= $id";

		$rs = query($sql);

		if( BOF($rs) )

			die("//Register Error1");

		$rs = query($sql);

		$rows = fetch($rs);

		$rows["content"] = split( $cfg["split"]  , $rows["content"] );

		free($rs);

		

		$esmarty->assign("user",$rows);

		$content = $esmarty->fetch( "email_register_admin.html" );

		$mail->Subject = fetchValue("select title as v from @@@email where id=5","Register Infomation"); //邮件标题

		$mail->Body = $content; //邮件内容

		if(!$mail->Send())

		{

			$param["state"] = 3 ;

			$param["content"] =  $mail->ErrorInfo ;

		}

		else

		{

			$param["state"] = 2 ;

			$param["content"] = "";

		}

		$mail->SmtpClose();

		$param["toemail"] = $config[24] ;

		$param["cid"] = 1;

		$param["pid"] = $id;

		$param["addtime"]=formatDateTime(time());

		$condition = "where id=" . $queueid ;

		$sql=updateSQL($param,"@@@mailqueue",$condition);

		query($sql);

		break;

	case "email_register_user":

		$param = array();

		$param["name"] = fetchValue("select name as v from @@@email where id=6","");

		$id = $mailvar["id"];

		$sql = "select * from @@@user where id= $id";

		$rs = query($sql);

		if( BOF($rs) )

			die("//Register User Error");

		$rs = query($sql);

		$rows = fetch($rs);

		$rows["content"] = split( $cfg["split"]  , $rows["content"] );

		$mail->AddAddress($rows["name"], "");

		free($rs);

	

		$esmarty->assign("user",$rows);

		$content = $esmarty->fetch( "email_register_user.html" );

		$mail->Subject = fetchValue("select title as v from @@@email where id=6","Register Infomation"); //邮件标题

		$mail->Body = $content; //邮件内容

		if(!$mail->Send())

		{

			$param["state"] = 3 ;

			$param["content"] =  $mail->ErrorInfo ;

		}

		else

		{

			$param["state"] = 2 ;

			$param["content"] = "";

		}

		$mail->SmtpClose();

		$param["toemail"] = $rows["name"] ;

		$param["cid"] = 1;

		$param["pid"] = $id;

		$param["addtime"]=formatDateTime(time());

		$condition = "where id=" . $queueid ;

		$sql=updateSQL($param,"@@@mailqueue",$condition);

		query($sql);

		break;

	case "email_order_admin":

		$param = array();

		$param["name"] = fetchValue("select name as v from @@@email where id=2","");

		$id = $mailvar["id"];

		

		$mail->AddAddress($config[24], "");

		$sql = "select * from `@@@order` where id=$id";

		$rs = query($sql);

		if( BOF($rs) )

			die("//Order Error");

		$rows = fetch($rs);

		$rows["arraddress"] = split( $cfg["split"]  , $rows["address"] );

		$rows["productprice"] = $productprice ;

		free($rs);

		$sql="select * from @@@orderproduct where orderid=" . $id;

		$rs = query($sql);	

		if( IMAGE != 1 )

			$imagedomain = DataDefault($config[61], "http://" . $_SERVER['SERVER_NAME'] ) ;

		else

		{

			$imagedomain = "";

		}

		$rs_o=array();

		while( $orows = fetch($rs) )

		{

			$orows["itemprice"] = $orows["pnum"] * $orows["pprice"] ;

			$orows["realpic"] = $imagedomain . getImageURL($orows["ppic"],3,"uploadImage/",IMAGE);

			$totalprice+=$orows["itemprice"];

			$rows["productnum"] += $orows["pnum"] ;

			$rs_o[] = $orows;

		}

		$rows["productprice"] = $totalprice ;

		$rows["addtime"] = date("M j,Y",strtotime($rows["addtime"]));

		$esmarty->assign("rs_o",$rs_o);

		$esmarty->assign("order",$rows);

				

		$content = $esmarty->fetch( "email_order_admin.html" );

		$mailtitle = fetchValue("select title as v from @@@email where id=2","Order Infomation");

		$mail->Subject = str_replace("{itemno}" , $rows["itemno"],$mailtitle) ; //邮件标题

		$mail->Body = $content; //邮件内容

		if(!$mail->Send())

		{

			$param["state"] = 3 ;

			$param["content"] =  $mail->ErrorInfo ;

		}

		else

		{

			$param["state"] = 2 ;

			$param["content"] = "";

		}

		$mail->SmtpClose();

		$param["toemail"] = $config[24] ;

		$param["cid"] = 2;

		$param["pid"] = $id;

		$param["addtime"]=formatDateTime(time());

		$condition = "where id=" . $queueid ;

		$sql=updateSQL($param,"@@@mailqueue",$condition);

		query($sql);

		break;

	case "email_order_user":

		$param = array();

		$id = $mailvar["id"];

		$sql = "select * from `@@@order` where id=$id";

		$rs = query($sql);

		if( BOF($rs) )

			die("//Order Error");

		$rows = fetch($rs);

		$rows["arraddress"] = split( $cfg["split"]  , $rows["address"] );

		

		$mail->AddAddress($rows["arraddress"][7], "");

		$rows["productprice"] = $productprice ;

		free($rs);

				

		if( IMAGE != 1 )

			$imagedomain = DataDefault($config[61], "http://" . $_SERVER['SERVER_NAME'] ) ;

		else

		{

			$imagedomain = "";

		}

				

		$sql="select * from @@@orderproduct where orderid=" . $id;

		$rs = query($sql);

		$rs_o=array();

		while( $orows = fetch($rs) )

		{

			$orows["itemprice"] = $orows["pnum"] * $orows["pprice"] ;

			$orows["realpic"] = $imagedomain . getImageURL($orows["ppic"],3,"uploadImage/",IMAGE);

			$totalprice+=$orows["itemprice"];

			$rs_o[] = $orows;

		}

		$rows["shipno"] = nl2br($rows["shipno"]);

		$rows["productprice"] = $totalprice ;

		$esmarty->assign("rs_o",$rs_o);

		$esmarty->assign("order",$rows);

		$email_html = dataDefault($mailvar["html"],"email_order_user");

		$content = $esmarty->fetch( "{$email_html}.html" );

		$arr_email=array("email_order_user"=>"4","email_order_shipno_user"=>"11","email_order_pay_user"=>"12","email_order_haspay_user"=>"13");

		$mailtitle = fetchValue("select title as v from @@@email where id=" . $arr_email[$email_html],"Order Infomation");

		$mail->Subject = str_replace("{itemno}" , $rows["itemno"],$mailtitle) ;

		$mail->Body = $content; //邮件内容

				

		$param["name"] = fetchValue("select name as v from @@@email where id=".$arr_email[$email_html],"");

		if(!$mail->Send())

		{

			$param["state"] = 3 ;

			$param["content"] =  $mail->ErrorInfo ;

		}

		else

		{

			$param["state"] = 2 ;

			$param["content"] = "";

		}

		$mail->SmtpClose();

		$param["toemail"] = $rows["arraddress"][7] ;

		$param["cid"] = 2;

		$param["pid"] = $id;

		$param["addtime"]=formatDateTime(time());

		$condition = "where id=" . $queueid ;

		$sql=updateSQL($param,"@@@mailqueue",$condition);

		query($sql);

		break;

	case "email_to":

		

		if( $mailvar["fromemail"]!="" && $mailvar["toemail"]!="" )

		{

			$param = array();

			$param["name"] = fetchValue("select name as v from @@@email where id=14","");

			$emailtitle = fetchValue("select title as v from @@@email where id=14","");

			$rows["from"]  = $mailvar["fromemail"];

			$rows["to"]  = $mailvar["toemail"];

			$rows["content"]  = $mailvar["content"];

			if( IMAGE != 1 )

				$imagedomain = DataDefault($config[61], "http://" . $_SERVER['SERVER_NAME'] ) ;

			else

			{

				$imagedomain = "";

			}

					

			$sql="select * from @@@product where id=" . $mailvar["pid"];

			$rs = query($sql);

			if( !BOF($rs) )

			{

				$orows = fetch($rs);

				$orows["rewrite"] = "http://" . $_SERVER['SERVER_NAME']  . getRewrite($orows["name"],$orows["id"],0,$cfg["rewrite"]);

				$orows["realpic"] = $imagedomain . getImageURL($orows["pic"],3,"uploadImage/",IMAGE);

				$rows["p"] = $orows ;

			}

			$emailtitle = str_replace("{friend}",$mailvar["fromname"],$emailtitle);

			$mail->AddAddress($rows["to"], "");

			$esmarty->assign("rs_s",$rows);

			$content = $esmarty->fetch( "email_share.html" );

			$mail->Subject = dataDefault($emailtitle,"Shareing Infomation"); //邮件标题

			$mail->Body = $content; //邮件内容

			if(!$mail->Send())

			{

				$param["state"] = 3 ;

				$param["content"] =  $mail->ErrorInfo ;

			}

			else

			{

				$param["state"] = 2 ;

				$param["content"] = "";

			}

			$mail->SmtpClose();

			$param["toemail"] = $rows["to"] ;

			$param["cid"] = 4;

			$param["pid"] = $mailvar["pid"];

			$param["addtime"]=formatDateTime(time());

			$condition = "where id=" . $queueid ;

			$sql=updateSQL($param,"@@@mailqueue",$condition);

			query($sql);

			}

		break;

	case "forgetpwd_from_email":

		$param = array();

		$param["name"] = fetchValue("select name as v from @@@email where id=8","");

		$id = $mailvar["id"];

		$sql = "select * from @@@user where id= $id";

		$rs = query($sql);

		if( BOF($rs) )

			die("//PWD Error");

		$rs = query($sql);

		$rows = fetch($rs);

				

		$mail->AddAddress($rows["name"], "");

		free($rs);

		$esmarty->assign("domain", "http://" . $_SERVER['SERVER_NAME'] . FOLDER );

		$esmarty->assign("user",$rows);

		$content = $esmarty->fetch( "email_pwd_user.html" );

		$mail->Subject = fetchValue("select title as v from @@@email where id=8","Get Password"); //邮件标题

		$mail->Body = $content; //邮件内容

		if(!$mail->Send())

		{

			$param["state"] = 3 ;

			$param["content"] =  $mail->ErrorInfo ;

		}

		else

		{

			$param["state"] = 2 ;

			$param["content"] = "";

		}

		$mail->SmtpClose();

		$param["toemail"] = $rows["name"] ;

		$param["cid"] = 1;

		$param["pid"] = $id;

		$param["addtime"]=formatDateTime(time());

		$condition = "where id=" . $queueid ;

		$sql=updateSQL($param,"@@@mailqueue",$condition);

		query($sql);

		break;

	case "test_config":

		$param = array();

		$param["name"] = "测试账户SMTP配置";

		$mail->Subject = "测试SMTP配置,时间:".formatDateTime(time()); 

		$mail->Body = "测试SMTP配置,时间:".formatDateTime(time()); 

		$mail->AddAddress($config[24], "");

		if(!$mail->Send())

		{

			$param["state"] = 3 ;

			$param["content"] =  $mail->ErrorInfo ;

		}

		else

		{

			$param["state"] = 2 ;

			$param["content"] = "";

		}

		$mail->SmtpClose();

		$param["toemail"] = $config[24] ;

		$param["cid"] = 0;

		$param["pid"] = 0;

		$param["addtime"]=formatDateTime(time());

		$condition = "where id=" . $queueid ;

		$sql=updateSQL($param,"@@@mailqueue",$condition);

		query($sql);

		break;

	case "email_invite":

		$param = array();

		$param["name"] = fetchValue("select name as v from @@@email where id=15","");

		$emailtitle = fetchValue("select title as v from @@@email where id=15","");

		

		$id = $mailvar["id"];

		$sql = "select * from @@@invitation where id= $id";

		$rs = query($sql);

		if( BOF($rs) )

			die("//Invitation Error");

		$rs = query($sql);

		$rows = fetch($rs);

		$emailtitle = str_replace("{friend}",$mailvar["username"],$emailtitle);

		$rows["username"] = $mailvar["username"];

		$rows["useremail"] = $mailvar["useremail"];

		$mail->AddAddress($rows["name"], "");

		$esmarty->assign("rs_s",$rows);

		$content = $esmarty->fetch( "email_invite_join.html" );

		$mail->Subject = dataDefault($emailtitle,"Invite Friend to Join"); //邮件标题

		$mail->Body = $content; //邮件内容

		if(!$mail->Send())

		{

			$param["state"] = 3 ;

			$param["content"] =  $mail->ErrorInfo ;

		}

		else

		{

			$param["state"] = 2 ;

			$param["content"] = "";

		}

		$mail->SmtpClose();

		$param["toemail"] = $rows["name"] ;

		$param["cid"] = 0;

		$param["pid"] = 0;

		$param["addtime"]=formatDateTime(time());

		$condition = "where id=" . $queueid ;

		$sql=updateSQL($param,"@@@mailqueue",$condition);

		query($sql);

		break;

	default :

		echo "alert('Error');";

		break;

	}

die("end");

?>

