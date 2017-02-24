<?
require("../../php_inc.php");
$MD5key = $config[75];
//支付平台流水号
$TradeNo=$_POST["TradeNo"];//供商户在支付平台查询订单时使用,请合理保存
//支付状态
$PaymentResult = $_POST["PaymentResult"];//返回码: 1 :表示交易成功 ; 0: 表示交易失败
//订单号
$BillNo = $_POST["BillNo"];
$itemno = $_POST["BillNo"];
//币种
$Currency = $_POST["Currency"];
//金额
$Amount = $_POST["Amount"];
//支付状态
$Succeed = $_POST["Succeed"];
//支付结果
$Result = $_POST["Result"];
	//取得的MD5校验信息
$MD5info = $_POST["MD5info"]; 
	//备注
$Remark = $_POST["Remark"];
	//金额单位
$currencyName = $_POST["currencyName"];
		/**
	**判断是哪次返回的数据【顾客支付完立即返回，还是支付处理完以后返回的数据】
	*/
	//服务器返回数据开始
	
	if(isset($TradeNo) && !empty($TradeNo) && isset($PaymentResult) && !empty($PaymentResult))
	{
		//校验源字符串
	  $returnMd5src = $TradeNo.$BillNo.$Currency.$Amount.$PaymentResult.$MD5key;
	  //本地MD5检验结果
	  $param = array();
		$returnMd5sign = strtoupper(md5($returnMd5src));
		if($returnMd5sign==$MD5info)
		{
			if($PaymentResult=='1')
			{
				$param["state"] = 2 ;
			}
			else if($PaymentResult=='0')
			{
				$param["state"] = 1 ;
			}
		}
		$condition=" where itemno='".$itemno."'";
		$param["payresult"] = urldecode($Result) . " " . $Succeed ;
		$sql=updateSQL($param,"order",$condition);
		log_result2($sql);
		query($sql);
		die(); //处理完以后返回的数据.只要根据订单号改变数据库订单状态就可以了。
	}
	//服务器返回数据结束
 	 redirect(FOLDER."step.php?action=step_return&itemno=".$itemno);
?>