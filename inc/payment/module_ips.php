<?
$Version = '2.0.0';
$pMerchantCode = trim($config[79]);
$pMerchantKey = trim($config[69]);
$pMerchantTransactionTime = date('YmdHis') ;
$pMerchantOrderNum = $rows["itemno"];
$pLanguage = "EN"; 
$pOrderCurrency = "RMB";
$pOrderAmount = number_format( $rows["totalprices"] * $config[302] , 2); //金额*汇率(0.10*6.8282)
$pDisplayAmount =  "$".$rows["totalprices"];
$pProductName = $rows["itemno"] ;
$pProductDescription = $rows["itemno"] ;
$pAttach = "";
$pSuccessReturnUrl = "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=ips" ;
$pFailReturnUrl = '';
$pErrorReturnUrl = '';
$pS2SReturnUrl = "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=ips";
$pResHashArithmetic = "11";
$pResType = 1;
$pEnableFraudGuard = "1";
$pICPayReq = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><IPSReqRoot><ICPay><Version><![CDATA[$Version]]></Version><StandardPaymentReq><pMerchantOrderNum><![CDATA[$pMerchantOrderNum]]></pMerchantOrderNum><pOrderAmount><![CDATA[$pOrderAmount]]></pOrderAmount><pDisplayAmount><![CDATA[$pDisplayAmount]]></pDisplayAmount><pMerchantTransactionTime><![CDATA[$pMerchantTransactionTime]]></pMerchantTransactionTime><pOrderCurrency><![CDATA[$pOrderCurrency]]></pOrderCurrency><pLanguage><![CDATA[$pLanguage]]></pLanguage><pSuccessReturnUrl><![CDATA[$pSuccessReturnUrl]]></pSuccessReturnUrl><pFailReturnUrl><![CDATA[$pFailReturnUrl]]></pFailReturnUrl><pErrorReturnUrl><![CDATA[$pErrorReturnUrl]]></pErrorReturnUrl><pS2SReturnUrl><![CDATA[$pS2SReturnUrl]]></pS2SReturnUrl><pResType><![CDATA[$pResType]]></pResType><pResHashArithmetic><![CDATA[$pResHashArithmetic]]></pResHashArithmetic><pProductName><![CDATA[$pProductName]]></pProductName><pProductDescription><![CDATA[$pProductDescription]]></pProductDescription><pAttach><![CDATA[$pAttach]]></pAttach><pEnableFraudGuard><![CDATA[$pEnableFraudGuard]]></pEnableFraudGuard></StandardPaymentReq></ICPay></IPSReqRoot>";
$pICPayReqB64 = base64_encode($pICPayReq);
$pICPayReqHashValue = md5($pICPayReq . $pMerchantKey);
$fVersion = '1.0.0';
$pCheckRuleBaseID = '1';

$pBillFName = $rows["arraddress"][0] ;
$pBillMName = "" ;
$pBillLName = $rows["arraddress"][8] ;
$pBillStreet = $rows["arraddress"][1] ;
$pBillCity = $rows["arraddress"][3] ;
$pBillState = $rows["arraddress"][4] ;
$pBillCountry = "" ;
$pBillZIP = $rows["arraddress"][2] ;
$pBillEmail = $rows["arraddress"][7] ;
$pBillPhone = $rows["arraddress"][6] ;

$pShipFName = $rows["arraddress"][0] ;
$pShipMName = "" ;
$pShipLName = $rows["arraddress"][8] ;
$pShipStreet = $rows["arraddress"][1] ;
$pShipCity = $rows["arraddress"][3] ;
$pShipState = $rows["arraddress"][4] ;
$pShipCountry = "" ;
$pShipZIP = $rows["arraddress"][2] ;
$pShipEmail = $rows["arraddress"][7] ;
$pShipPhone = $rows["arraddress"][6] ;

$pAFSReq = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><IPSReqRoot><AFS><Version><![CDATA[$fVersion]]></Version><cBasicParameters><pCheckRuleBaseID><![CDATA[$pCheckRuleBaseID]]></pCheckRuleBaseID></cBasicParameters><StandardPaymentReq><cBillParameters><pBillFName><![CDATA[$pBillFName]]></pBillFName><pBillMName><![CDATA[$pBillMName]]></pBillMName><pBillLName><![CDATA[$pBillLName]]></pBillLName><pBillStreet><![CDATA[$pBillStreet]]></pBillStreet><pBillCity><![CDATA[$pBillCity]]></pBillCity><pBillState><![CDATA[$pBillState]]></pBillState><pBillCountry><![CDATA[$pBillCountry]]></pBillCountry><pBillZIP><![CDATA[$pBillZIP]]></pBillZIP><pBillEmail><![CDATA[$pBillEmail]]></pBillEmail><pBillPhone><![CDATA[$pBillPhone]]></pBillPhone></cBillParameters><cShipParameters><pShipFName><![CDATA[$pShipFName]]></pShipFName><pShipMName><![CDATA[$pShipMName]]></pShipMName><pShipLName><![CDATA[$pShipLName]]></pShipLName><pShipStreet><![CDATA[$pShipStreet]]></pShipStreet><pShipCity><![CDATA[$pShipCity]]></pShipCity><pShipState><![CDATA[$pShipState]]></pShipState><pShipCountry><![CDATA[$pShipCountry]]></pShipCountry><pShipZIP><![CDATA[$pShipZIP]]></pShipZIP><pShipEmail><![CDATA[$pShipEmail]]></pShipEmail><pShipPhone><![CDATA[$pShipPhone]]></pShipPhone></cShipParameters><cProductParameters><pProductType><![CDATA[$pProductType]]></pProductType><pProductName><![CDATA[$pProductName]]></pProductName><pProductData1><![CDATA[$pProductData1]]></pProductData1><pProductData2><![CDATA[$pProductData2]]></pProductData2><pProductData3><![CDATA[$pProductData3]]></pProductData3><pProductData4><![CDATA[$pProductData4]]></pProductData4><pProductData5><![CDATA[$pProductData5]]></pProductData5><pProductData6><![CDATA[$pProductData6]]></pProductData6></cProductParameters><cAccountParameters><pAccID><![CDATA[$pAccID]]></pAccID><pAccEMail><![CDATA[$pAccEMail]]></pAccEMail><pAccRegisterIP><![CDATA[$pAccRegisterIP]]></pAccRegisterIP><pAccLoginIP><![CDATA[$pAccLoginIP]]></pAccLoginIP><pAccRegisterDate><![CDATA[$pAccRegisterDate]]></pAccRegisterDate><pAccLoginDate><![CDATA[$pAccLoginDate]]></pAccLoginDate><pAccRegisterDevice><![CDATA[$pAccRegisterDevice]]></pAccRegisterDevice><pAccLoginDevice><![CDATA[$pAccLoginDevice]]></pAccLoginDevice></cAccountParameters></StandardPaymentReq></AFS></IPSReqRoot>";
$pAFSReqB64 = base64_encode($pAFSReq);
$pAFSReqHashValue = md5($pAFSReq . $pMerchantKey);
$rows["payonline"]["ips"]["pMerchantCode"] = $config[79] ;
$rows["payonline"]["ips"]["pICPayReq"] = $pICPayReqB64 ;
$rows["payonline"]["ips"]["pICPayReqHashValue"] = $pICPayReqHashValue;
$rows["payonline"]["ips"]["pAFSReq"] = $pAFSReqB64 ;
$rows["payonline"]["ips"]["pAFSReqHashValue"] = $pAFSReqHashValue ;
?>