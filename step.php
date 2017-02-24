<?

require("inc/php_inc.php");

require("inc/Smarty-2.6.26/libs/Smarty.class.php");

require("uio_pubdata.php");



$template_file = "lay_step.html";



$action=getQuery("action");

if( $userid==-1 && $action=="")

{

	redirect(FOLDER."register.php?redirectURL=" . urlencode(FOLDER."step.php?action=step_1") ); //--验证游客

}

if( $userid!=-1 && $action=="" )

	$action="step_1";

			switch($action)

			{

				case "step_0":

					if($sc->length==0)

						redirect("".FOLDER."shopcart.php");

					break;

				case "step_1":

					header("Cache-control: private");

					if($sc->length==0)

						redirect("".FOLDER."shopcart.php");

					$str_url="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['checkout']} " . $cfg["split_uri"] . " {$cfg['lg']['delivery_information']}";

					$str_url_2="{$cfg['lg']['delivery_information']}";

					$var["title"]="Step 1 of 4 - {$cfg['lg']['delivery_information']}";

					$minorder = $config[52]*$rate ;

					r2n($minorder);

					if($var["totalprice"]< $minorder && $config[52]>0)

					{

						Alertredirect("The amount $coin " . $minorder . " for each order is requested",FOLDER . "shopcart.php");

					}

					$totalnum=array_sum($sc->pnum);

					$var["totalnum"]=$totalnum;

					$var["rs_sc"]=$rs_sc;

					$sql="select * from @@@address where userid>0 and userid=" . $userid ;

					$rs=query($sql);

					$str="";

					if( BOF($rs) )

						$str="block";

					$bln=true;

					while( $rows=fetch($rs) )

					{ 

						$rows["address"]=str_replace( $cfg["split"] , " " ,$rows["content"] );

						$rows["arraddress"]=split( $cfg["split"]  ,$rows["content"] ) ;

						$rs_address[]=$rows;

					}

					$var["rs_address"]=$rs_address;

					$var["str"]=$str;

					$sql="select * from @@@express  where sort >=0 order by sort asc";

					$rs=query($sql);

					while( $rows=fetch($rs) )

					{ 



						if( $rows["type"] ==0 )

						{

							$rows["eprice"] = getExpressPrice($shippingnum,0,$rows["pnum"],$rows["pprice"],$rows["price1"],$rows["price2"],$rows["firstweight"]) * $rate ;

						}

						else if( $rows["type"] ==1 )

						{

							$rows["eprice"] = getExpressPrice($shippingweight,1,$rows["pnum"],$rows["pprice"],$rows["price1"],$rows["price2"],$rows["firstweight"]) * $rate ;

						}

						else if( $rows["type"] ==2 )

						{

							$eprice = 0;

							eval( $rows["function"] );

							$rows["eprice"] = $eprice ;

						}

						$rows["eprice"] *= $rows["discount"]/100;

						r2n( $rows["eprice"] );

						

						if(  $shippingnum==0 )

						{

							$rows["eprice"] = 0 ;

						}

						

						if( $totalprice >= $config[54] * $rate && $config[54]>0 )

							$rows["eprice"] = 0 ;

						if( $totalnum >= $config[53] && $config[53]>0 )

							$rows["eprice"] = 0 ;

						

						$rows["realpic"] = getImageURL($rows["pic"],-1,"systemImage/",0);

						$rs_express[]=$rows;

						

					}

					$var["rs_express"]=$rs_express;

					free($rs);

					//-- 读取会员优惠券

					$sql="select * from @@@coupon  where userid>0 and userid=$userid and state=1";

					$rs=query($sql);

					while( $rows=fetch($rs) )

					{ 

						$endtime = strtotime($rows["endtime"]);

						if($endtime>0 && time()>=$endtime)

							continue;

						$rows["price"] = $rows["price"] * $rate;

						$var["rs_coupon"][]=$rows;

					}

					//step_1(); //-- 显示订单内容

					break;

				case "step_confirm":

					$var["title"]="Step 2 of 4 - {$cfg['lg']['confirm_information']}";

					$str_url_2="{$cfg['lg']['confirm_information']}";

					$str_url="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['checkout']} " . $cfg["split_uri"] . " {$cfg['lg']['confirm_information']}";

					//step_confirm();  //----确认页面。。。

					if($sc->length==0)

						redirect(FOLDER."shopcart.php");

					$sql="select * from @@@address where id=" . getFormDefault("address",0) ;

					$var["addressid"]= getFormDefault("address",0);

					$rs=query($sql);

					if( BOF($rs) )

					{

						for($index=0;$index<=10;$index++)

						{

							$address[$index]=getFormSafe("address$index");

							if($address[$index]=="")

							{

								switch($index)

								{

									case 0:

									     die( "<script> alert('{$cfg['lg']['msg_firstname_null']}') ;history.back(); </script>");

										 break;

									case 1:

									      die( "<script> alert('{$cfg['lg']['msg_lastname_null']}') ;history.back(); </script>");

										 break;

									case 2:

									      die( "<script> alert('{$cfg['lg']['msg_address_null']}') ;history.back(); </script>");

										 break;

									case 3:

									     die( "<script> alert('{$cfg['lg']['msg_zipcode_null']}') ;history.back(); </script>");

										 break;

									case 4:

									     die( "<script> alert('{$cfg['lg']['msg_city_null']}') ;history.back(); </script>");

										 break;

									case 6:

									     die( "<script> alert('{$cfg['lg']['msg_country_null']}') ;history.back(); </script>");

										 break;

									case 7:

									     die( "<script> alert('{$cfg['lg']['msg_tel_null']}') ;history.back(); </script>");

										 break;

									case 8:

									     die( "<script> alert('{$cfg['lg']['msg_email_null']}') ;history.back(); </script>");

										 break;

									default:

									    // AlertRedirect("Info can not be empty",$_SERVER['HTTP_REFERER']);

										 break;

								}

							}

						}

					}

					else

					{

						$rows=fetch($rs);

						$address=split( $cfg["split"] , $rows["content"] );

					}

					$var["address"]=$address;

					$var["addressupdate"] = getForm("addressupdate");

					$var["content"]=getFormSafe("content");

					$var["sub1"]=getFormDefault("sub1",0);

					

					$var["sub_coupon"]=getFormDefault("sub_coupon",0,false,0);

					if($var["sub_coupon"]!=0)

						$var["coupon_code"]=getForm("coupon_code");

					r2n( $var["sub1"] );

					$var["express"]=getFormSafe("express");

					free($rs);

					break;    

				case "step_2":

					if($sc->length==0)

						redirect("".FOLDER."shopcart.php");

					step_2(); //-- 保存订单信息

					break;

				case "step_3":

					//step_3(); //-- 选择订单支付方式

					$var["title"]="Step 3 of 4 - {$cfg['lg']['payment_information']}";

					$str_url_2="{$cfg['lg']['payment_information']}";

					$str_url="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['checkout']} " . $cfg["split_uri"] . " {$cfg['lg']['payment_information']}";

					$itemno=filterSQL(getQuery("itemno"));

					$sql="select * from `@@@order` where itemno='$itemno'";

					$rs=query($sql);

					if( BOF($rs) )

						alertRedirect("Sorry,No Exists the Order",FOLDER);

					$rows=fetch($rs);

					free($rs);

					$orderid = $rows["id"] ;

					

					

					$sql="select pprice,pnum from @@@orderproduct where orderid=" . $rows["id"];

					$rss=query($sql);

					$totalprices=0;

					while($rows1=fetch($rss))

					{

						$totalprices += $rows1["pnum"]*$rows1["pprice"] ;

					}

					

					$totalprices += $rows["sub1"] + $rows["sub3"] + $rows["sub4"];;

					$rows["totalprices"]=$totalprices;

					r2n( $rows["totalprices"] );

					free($rss);

					

					$var["order"]=$rows;

					$var["sms"]="New order by " . $rows["username"] . ":" . $rows["itemno"] . ",Total Price:" . $rows["coin"] . $totalprice;

					$sql="select * from @@@payment  where sort >=0  order by sort asc";

					$rs=query($sql);

					while( $rows=fetch($rs) )

					{ 

						if( $totalprices<=$rows["minprice"] || ($totalprices>=$rows["maxprice"]&&$rows["maxprice"]>0) )

							continue;

						$rows["pprice"] =  $rows["fee"] * $totalprices / 100;

						r2n( $rows["pprice"] );

						$rows["realpic"] = getImageURL($rows["pic"],-1,"systemImage/",0);

						$var["rs_payment"][]=$rows;

					}

					

					//sort_rows($var["rs_payment"],"pprice",SORT_ASC);

					

					//---  读取优惠券系统产生的

					if(getQuery("show_code")!="" && $var["order"]["create_coupon_code"]!="")

					{

						$coupon_save_price = fetchValue("select price as v from @@@coupon where name='".$var["order"]["create_coupon_code"]."'",0) * $rate;

						r2n($coupon_save_price);

						$cfg["lg"]["msg_coupon_system"] = str_replace("{0}",$var["order"]["create_coupon_code"],$cfg["lg"]["msg_coupon_system"]);

						$cfg["lg"]["msg_coupon_system"] = str_replace("{1}",$coin . " " . $coupon_save_price,$cfg["lg"]["msg_coupon_system"]);

					}

					break;

				case "step_4":

				

					step_4(); //-- 保存订单支付手续费

					break;

				case "paypaloff_save":

					step_paypaloff_save();

					break;

				case "step_5":

					//step_5(); //--显示 paypal 项

					$var["title"]="Step 3 of 4 - {$cfg['lg']['online_payment']}";

					$str_url_2="{$cfg['lg']['online_payment']}";

					$str_url="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['checkout']} " . $cfg["split_uri"] . " {$cfg['lg']['online_payment']}";

					$itemno=filterSQL(getQuery("itemno"));

					$sql="select * from `@@@order` where itemno='$itemno'";

					$rs=query($sql);

					if( BOF($rs) )

						redirect("".FOLDER."error.php?id=1");

					$rows=fetch($rs);

					$var["order"]=$rows;

					$var["paymenttype"] = getQuery("type");

					free($rs);

					$var["payment_content"] = fetchValue("select content as v from @@@payment where interface='" . getQuery("type") . "'","");

					$sql="select pprice,pnum,pname from @@@orderproduct where orderid=" . $rows["id"];

					$rss=query($sql);

					$totalprices=0;

					$productsname=array();

					while($rows1=fetch($rss))

					{

						$totalprices += $rows1["pnum"]*$rows1["pprice"] ;

						if(count($productsname)<10)

						{

							$productsname[]=$rows1["pname"];

						}

					}

					$rows["products"]=join(",",$productsname);

					$totalprices += $rows["sub1"]+$rows["sub2"]+$rows["sub3"] + $rows["sub4"];

					$totalprices = $totalprices / $rows["rate"] ;

					$totalprices = $totalprices * $config[100+$config[305]] ;

					$rows["coin"]  = $config[250+$config[305]];

					$rows["totalprices"]=$totalprices;

					$rows["arraddress"] = split( $cfg["split"] ,  $rows["address"]) ;

					r2n( $rows["totalprices"] );

					free($rss);

					//----读取paypal

					require("inc/payment/module_paypal.php") ;

					//---读取moneybookers 

					require("inc/payment/module_moneybookers.php") ;

					//---读取95EPAY

					require("inc/payment/module_95epay.php") ;

					//----读取GSPAY

					require("inc/payment/module_gspay.php") ;

					//----读取ctopay

					require("inc/payment/module_ctopay.php") ;

					//----读取payease

					require("inc/payment/module_payease.php") ;

					//--------读取 ips 环迅

					require("inc/payment/module_ips.php") ;

					//----读取ecpss

    				require("inc/payment/module_ecpss.php") ;

					//----读取ttopay

    				require("inc/payment/module_ttopay.php") ;

					//----读取yourspay

    				require("inc/payment/module_yourspay.php") ;

					//----读取fashionpay

    				require("inc/payment/module_fashionpay.php") ;

					//----读取fashionpay

    				require("inc/payment/module_rppay.php") ;

					

					require("inc/payment/module_wedopay.php") ;

					$var["order"]=$rows;

					

					

					

					break;

				case "step_6":

					//step_5(); //--显示 paypal 项

					$var["title"]="Step 4 of 4 - {$cfg['lg']['order_complete']}";

					$str_url_2="{$cfg['lg']['order_complete']}";

					$str_url="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['checkout']} " . $cfg["split_uri"] . " {$cfg['lg']['order_complete']}";

					$itemno=filterSQL(getQuery("itemno"));

					$sql="select * from `@@@order` where itemno='$itemno'";

					$rs=query($sql);

					if( BOF($rs) )

						redirect("".FOLDER."error.php?id=1");

					$rows=fetch($rs);

					$var["order"]=$rows;

					$var["paymenttype"] = $rows["payment"];

					free($rs);

					$sql="select pprice,pnum from @@@orderproduct where orderid=" . $rows["id"];

					$rss=query($sql);

					$totalprices=0;

					while($rows1=fetch($rss))

					{

						$totalprices += $rows1["pnum"]*$rows1["pprice"] ;

					}

					$totalprices += $rows["sub1"]+$rows["sub2"]+$rows["sub3"] + $rows["sub4"];

					$rows["totalprices"]=$totalprices;

					$rows["arraddress"] = split( $cfg["split"] ,  $rows["address"]) ;

					r2n( $rows["totalprices"] );

					$var["payment_content"] = fetchValue("select content as v from @@@payment where name='{$var['paymenttype']}'","");

					//$var["payment_content"] = getInfo(97,"");

					$var["order"]=$rows;

					

					free($rss);

					break;

				case "step_return":

					$var["title"]="Step 4 of 4 -  {$cfg['lg']['return_status']}";

					$str_url_2="{$cfg['lg']['papal_payment_status']}";

					$str_url="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['checkout']} " . $cfg["split_uri"] . " {$cfg['lg']['return_status']}";

					$var["payment_content"] = fetchValue("select content as v from @@@payment where interface='" . getQuery("type") . "'","");

					$payment_type = getForm('payment_type');
                    			$payment_result = getForm('payment_status');
                    			if (isset($payment_type) && isset($payment_result) && strcasecmp($payment_type, 'instant') == 0 && strcasecmp($payment_result, 'Completed') == 0) {
					    $itemno = getForm('item_number');
                   			    $sql = updateSQL(array('paymentstate' => 5, 'state' => 3), "@@@order", " where itemno='" . $itemno . "'");
                        		    query($sql);
                    			}

					$info[] = 100;

					break;		

					case "step_paypalto":

					

					$var["title"]="Step 3 of 4 - {$cfg['lg']['online_payment']}";

					$str_url_2="{$cfg['lg']['online_payment']}";

					$str_url="<a  href='".FOLDER."'><span class='daoa' >{$cfg['lg']['home']}</span></a> " . $cfg["split_uri"] . " {$cfg['lg']['checkout']} " . $cfg["split_uri"] . " {$cfg['lg']['online_payment']}";

					if(getQuery("itemno")=="")

						redirect("".FOLDER."error.php?id=1");

					$rows["totalprices"] = getQuery("amount");

					$rows["itemno"] = getQuery("itemno");

					$rows["payonline"]["paypal"]["business"] = base64_decode(getQuery("param")) ;

					$rows["payonline"]["paypal"]["item_name"] = getQuery("itemno") ;

					$rows["payonline"]["paypal"]["currency_code"] = "USD" ;

					$rows["payonline"]["paypal"]["return"] =  "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=paypal"  ;

					$rows["payonline"]["paypal"]["amount"] = getQuery("amount") ;

					$var["order"] = $rows ;

					break;		

			}

$var["str_url"]=$str_url;

$var["str_url_2"]=$str_url_2;

$var["action"]=$action;



require("uio_bomdata.php");



?>

<?

function step_2()

{

	global $cfg;

	global $sc;

	global $rs_sc;

	global $coin;

	global $interface_coin;

	global $discount;

	global $config;

	global $rate;

	global $totalprice;

	global $username;

	global $userid;

	global $user;

	global $arr_syscontent;

	$order_price = 0 ;

	if( $sc->length==0 )

		alertRedirect("The ShopCart is Empty",FOLDER."shopcart.php");

	if( (int)getForm("address")==0 )

	{

		$arrconfig=array();

		for($indexI=0;$indexI<20;$indexI++)

		{
						for($index=0;$index<=10;$index++)

						{

							$address[$index]=getFormSafe("address$index");
							if($address[$index]=="")
							{
								switch($index)
								{
									case 0:
									     die( "<script> alert('{$cfg['lg']['msg_firstname_null']}') ;history.back(); </script>");
										 break;
									case 1:
									      die( "<script> alert('{$cfg['lg']['msg_lastname_null']}') ;history.back(); </script>");
										 break;
									case 2:
									      die( "<script> alert('{$cfg['lg']['msg_address_null']}') ;history.back(); </script>");
										 break;
									case 3:
									     die( "<script> alert('{$cfg['lg']['msg_zipcode_null']}') ;history.back(); </script>");
										 break;
									case 4:
									     die( "<script> alert('{$cfg['lg']['msg_city_null']}') ;history.back(); </script>");
										 break;
									case 6:
									     die( "<script> alert('{$cfg['lg']['msg_country_null']}') ;history.back(); </script>");
										 break;
									case 7:
									     die( "<script> alert('{$cfg['lg']['msg_tel_null']}') ;history.back(); </script>");
										 break;
									case 8:
									     die( "<script> alert('{$cfg['lg']['msg_email_null']}') ;history.back(); </script>");
										 break;
									default:
									    // AlertRedirect("Info can not be empty",$_SERVER['HTTP_REFERER']);
										 break;

								}

							}

						}
			$arrconfig[$indexI]=getFormSafe("address$indexI");

		}

		$param["address"]=join( $cfg["split"] , $arrconfig ) ;

		if( getForm("addressupdate")!="" && $userid!=-1)

		{

			$sparam=array();

			//$arrconfig=array();

			$sparam["userid"] = $userid ;

			$sparam["content"]=join( $cfg["split"] , $arrconfig ) ;

			$sql=insertSQL($sparam,"@@@address");

			query($sql);

		}

	}

	else

	{

		$sql="select content as v from @@@address where id=" . getForm("address") ;

		$param["address"]= fetchValue($sql,"");

	}

	$straddress=$param["address"];

	$param["userid"]=$userid;

	if($userid!=-1)

		$param["username"]=$username;

	else

		$param["username"]=getFormSafe("address0") . " " . getFormSafe("address8");

	

	$orderusername = $param["username"] ;

	$param["addtime"]=formatDateTime(time());  ;

	$param["state"]=0;

	$itemno = getRandomname(false) ;

	$param["itemno"] = $itemno ;

	$param["content"]=getFormSafe("content");

	$param["express"]=getFormSafe("express"); 

	$param["country"]=getFormSafe("country"); 

	$param["discount"] = $discount;

	$param["domain"] = $_SERVER['SERVER_NAME'];

	$param["sub1"]=getFormDefault("sub1",0);

	$param["sub2"]=getFormDefault("sub2",0);

	$param["sub3"]=getFormDefault("sub3",0);

	$param["sub4"]=getFormDefault("sub4",0);

	

	$param["coupon_code"]=getForm("coupon_code");

	$param["server"]=$user["server"];

	

	r2n( $param["sub1"] );

	r2n( $param["sub2"] );

	r2n( $param["sub3"] );

	r2n( $param["sub4"] );

	

	$order_price += $param["sub1"] + $param["sub2"] + $param["sub3"] + $param["sub4"] ;

	

	$param["ip"]=getIP();

	$param["coin"]=$coin;

	$param["interfacecoin"]=$interface_coin;

	$param["rate"]=$rate;

	$param["content"]=getFormSafe("content");

	$sql=insertSQL($param,"@@@order");

	query($sql);

	$orderid=mysql_insert_id() ;

	$param=array();

	

	$arrformat1 = array("%orderid%","%todayorder%");

	$todayorder = fetchValue("select count(*) as v from `@@@order` where TO_DAYS(addtime)=TO_DAYS('" . formatDateTime(time()) . "')",0);

	$arrvalue1 = array($orderid,$todayorder);

	$itemno = formatString($config[298],$arrformat1,$arrvalue1);

	//$itemno=strftime("%Y-%m-%d",time()) . "-" .  str_pad(rand(1,9999),4,0,STR_PAD_LEFT) . "-" . $orderid ;

	$param["itemno"]= $itemno;

	$condition=" where id=$orderid" ;

	$sql=updateSQL($param,"@@@order",$condition);

	query($sql);

	

	for($index=0;$index<count($rs_sc);$index++)

	{

			$rows=array();

			$rows=$rs_sc[$index];

			$param=array();

			$param["pid"]= $rows["id"] ;

			$param["pname"]= $rows["name"] ;

			$param["pstyle"]= $rows["pstyle"] ;

			$param["pnum"] = $rows["pnum"] ;

			$param["pprice"] = $rows["price"] ;

			$param["ppic"]= $rows["pic"]; 

			$param["orderid"]= $orderid;

			$param["premark"]= $rows["pcontent"];

			$param["pitemno"]= $rows["itemno"];

			$param["pweight"]= $rows["weight"];

			$sql=insertSQL($param,"@@@orderproduct");

			query($sql);

			

			$order_price += $param["pprice"]*$param["pnum"] ;

	}

	

	//----  冻结优惠券

	if(getForm("coupon_code")!="")

	{

		$param=array();

		$param["state"]= "2" ;

		$param["descript"]= "blocked by Order No.: " . $itemno ;

		$condition=" where name='".getForm("coupon_code")."'" ;

		$sql=updateSQL($param,"@@@coupon",$condition);

		query($sql);

		$arr_syscontent[] = "优惠券码：使用".getForm("coupon_code")." , 优惠:".$config[90].fetchValue("select price as v from @@@coupon $condition",0);

	}

	//------ 系统自动生成优惠码

	r2n($order_price);

	for($index=9;$index>=0;$index--)

	{

		if($order_price>=$config[260+$index] * $rate && $config[260+$index]!="")

		{

			$param=array();

			$param["name"]= getOnlyCode();

			$str_coupon_code = $param["name"];

			$param["state"]= "0" ;

			$param["descript"]= "create by Order No.: " . $itemno . " (unpaid)" ;

			//$param["endtime"]= dataDefault($config[280+$index],"@NULL") ;

			$param["endtime"]= dataDefault($config[280+$index],7) ;

		    $param["endtime"]=date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+$param["endtime"], date("Y")));

			$param["price"] = $config[270+$index] ;

			$param["userid"] = $userid ;

			if($useridf<0)

				$param["username"] = "所有人";

			else

				$param["username"] = $username;

			$sql=insertSQL($param,"@@@coupon");

			query($sql);

			

			$param=array();

			$param["create_coupon_code"] = $str_coupon_code ;

			$condition=" where id=$orderid" ;

			$sql=updateSQL($param,"@@@order",$condition);

			query($sql);

			break; 

		}

	}

	

	if($arr_syscontent)

	{

		$param=array();

		$param["syscontent"]= join( $cfg["split"] , $arr_syscontent );

		$condition=" where id=$orderid" ;

		$sql=updateSQL($param,"@@@order",$condition);

		query($sql);

	}

	

	$sc->clean();

	$sc->save();

	

		if( $config[131]!="" )

		{

			$vartmp = array();

			$vartmp["action"] = "email_order_admin";

			$vartmp["id"] = $orderid ;

			addToMailQueue($vartmp);

		}

		if( $config[141]!="" )

		{

			$vartmp = array();

			$vartmp["action"] = "email_order_user";

			$vartmp["id"] = $orderid ;

			addToMailQueue($vartmp);

		}

	

	//----- 加入最近发生

	redirect(FOLDER."step.php?action=step_3&itemno=$itemno&show_code=1");

}



function step_4()

{

	global $config;

	$itemno=filterSQL(getQuery("itemno"));

	$sql="select * from `@@@order` where itemno='$itemno'";

	$rs=query($sql);

	if( BOF($rs) )

		redirect(FOLDER."error.php?id=1");

	$rows = fetch($rs);

	$orderid = $rows["id"];

	$subtotal = $rows["sub1"] + getFormInt("sub2",0,false,0) + $rows["sub3"] ;

	$condition=" where itemno='$itemno'";

	$param["sub2"]=getFormInt("sub2",0,false,0);

	r2n( $param["sub2"] );

	$param["payment"]=getFormSafe("payment");

	$sql=updateSQL($param,"@@@order",$condition);

	query($sql);

	$paymentonline = fetchValue("select interface as v from @@@payment where name='" . getForm("payment")  . "'") ;

	if( $paymentonline!="" )

	{

		if( $paymentonline!="paypalto" )

			redirect(FOLDER."step.php?action=step_5&type=$paymentonline&itemno=$itemno");

		else

		{

			$sql="select pprice,pnum from @@@orderproduct where orderid=" . $orderid ;

			$rss=query($sql);

			$totalprices=0;

			while($rows1=fetch($rss))

			{

				$totalprices += $rows1["pnum"]*$rows1["pprice"] ;

			}

			$totalprices += $subtotal;

			redirect($config['33']."&param=".urlencode(base64_encode($config[34]))."&itemno={$itemno}&amount={$totalprices}");

		}

	}

	else

		redirect(FOLDER."step.php?action=step_6&type=".getFormSafe("payment")."&itemno=$itemno");

}



function step_paypaloff_save()

{

	$itemno=filterSQL(getQuery("itemno"));

	$sql="select * from `@@@order` where itemno='$itemno'";

	$rs=query($sql);

	if( BOF($rs) )

		redirect(FOLDER."error.php?id=1");

	$condition=" where itemno='$itemno'";

	$param["paypalaccount"]=getForm("paypalaccount");

	$sql=updateSQL($param,"@@@order",$condition);

	query($sql);

	$paymentonline = fetchValue("select interface as v from @@@payment where name='" . getForm("payment")  . "'") ;

	redirect(FOLDER."step.php?action=step_6&type=".getFormSafe("payment")."&itemno=$itemno");

}

?>
