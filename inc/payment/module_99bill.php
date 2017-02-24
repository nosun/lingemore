<?
function appendParam($signMsgVal,$paramId,$paramValue){
    if ($signMsgVal != "")
    {
        if($paramValue !=''){
            $signMsgVal .= "&" .$paramId . "=" .$paramValue;
        }
        
    }
    else
    {
        if($paramValue !=''){
           $signMsgVal = $paramId . "=" . $paramValue;
        }
        
    }
    return $signMsgVal;
}


		//字符集
        ///固定选择值：1、2、3
        ///1 代表UTF-8; 2代表GBK; 3 代表GB2312   默认值为1 根据页面编码选择
        $Quick99bill_inputCharset = "1";

        //接受支付结果的页面地址
        ///需要是绝对地址，与bgUrl 不能同时为空 前台页面通知
        ///当bgUrl 为空时，快钱直接将支付结果get 到pageUrl 当bgUrl 不为空时，按照bgUrl的方式返回
        $Quick99bill_pageUrl = "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=99bill";

        //服务器接受支付结果的后台地址
        ///需要是绝对地址，与pageUrl 不能同时为空  后台服务器通知
        ///快钱将支付结果发送到bgUrl 对应的地址，并且获取商户按照约定格式输出的地址，显示页面给用户
        $Quick99bill_bgUrl = "";

        //网关版本
        ///固定值：v1.0
        $Quick99bill_version="v1.0";

        //网关页面显示语言种类
        ///固定值：2  2 代表英文显示
        $Quick99bill_language = "2";

        //签名类型
        ///固定值：1
        ///1 代表SHA-1 签名
        $Quick99bill_signType = "1";

        //外卡账户
        ///接收款项的商户外卡账户编号 不同于快钱帐号
        $Quick99bill_merchantAcctId = $config[296];//"104110045110203";

        //终端编号
        ///帐号开通后有个跟外卡帐号对应的终端编号
        $Quick99bill_termId = $config[297];//"00000203";//"00000259";

        //持卡人 First Name
        ///中国名指姓氏，
        $Quick99bill_firstName = "";

        //持卡人 Last Name
        ///中国名指名字
        $Quick99bill_lastName = "";

        //持卡人 Full Name
        ///中国名指全名
        $Quick99bill_fullName = "";

        //发卡银
        ///发卡银行银，支付卡所属银行
        $Quick99bill_issuingBank="";

        //发卡国家
        ///发卡国家,卡所属国家
        $Quick99bill_issuingCountry="";

        //持卡人电子邮件地址
        ///持卡人电子邮件地址
        $Quick99bill_email = "";

        //持卡人联系电话
        ///持卡人联系电话
        $Quick99bill_phoneNumber = "";

        //billing address 对应的zip code
        ///账单地的邮政编码
        $Quick99bill_zipCode = "";

        //shipping Address 对应的zip code
        ///商品的邮寄地址
        $Quick99bill_shippingAddress = "";

        //billing address
        ///账单邮寄详细地址
        $Quick99bill_billingAddress = "";

        //billing City
        ///账单城市
        $Quick99bill_billingCity ="";

        //billing State
        ///账单洲
        $Quick99bill_billingState="";

        //billing Country
        ///账单国家
        $Quick99bill_billingCountry = "";

        //商户订单号
        ///只允许使用字母、数字、- 、_,并以字母或数字开头
        ///每商户提交的订单号，必须在自身账户交易中唯一
        $Quick99bill_orderId = $rows["itemno"];

        //订单报价币别
        ///货币符号，如USD、EUR 等
        ///货币符号  币别
        ///CNY  人民币
        ///USD  美元
        ///HKD  港元
        ///GBP  英镑
        ///JPY  日元
        ///EUR  欧元
        ///TWD  新台币
        $Quick99bill_pricingCurrency = "USD";

        //订单报价金额
        ///金额乘以100。例如，美元298.30，提交时金额应为29830
        $Quick99bill_pricingAmount = $rows["totalprices"]*100;

        //订单扣款币别
        ///货币符号，如USD、EUR 等
        ///订单扣款 视情况而 货币符号请参考货币符号。
        ///货币符号  币别
        ///CNY  人民币
        ///USD  美元
        ///HKD  港元
        ///GBP  英镑
        ///JPY  日元
        ///EUR  欧元
        ///TWD  新台币
        ///如果参数exchangeRateFlag为0，则为空，快钱按扣款币别为人民币处理。
        ///如果参数exchangeRateFlag为1，则由商户提供，不能为 空。
        $Quick99bill_billingCurrency ="";

        //订单扣款金额
        ///金额乘以100。例如，美元298.30，提交时金额应为29830
        ///如果参数exchangeRateFlag为0，则为空，快钱按照统一汇率换算成人民币。
        ///如果参数exchangeRateFlag为1，则由商户提供，不能为空。
        $Quick99bill_billingAmount="";

        //汇率提供标志
        ///0 由快钱统一提供汇率
        ///1 由商户提交交易时提供
        $Quick99bill_exchangeRateFlag="0";

        //汇率方向
        ///0 报价币别/扣款币别
        ///1 扣款币别/报价币别
        $Quick99bill_exchangeRateDirection="0";

        //汇率
        ///如果参数exchangeRateFlag为0，则为空
        ///如果参数exchangeRateFlag为1，则不能为空
        $Quick99bill_exchangeRate="";

        //商户订单提交时间
        ///格式为：年[4 位]月[2 位]日[2 位]时[2 位]分[2 位]秒[2 位]
        ///例如：20071117020101
        $Quick99bill_orderTime = date("YmdHis");//date("YmdHis");//'20071117020101'; 

        //商品名称
        ///英文字符串
        $Quick99bill_productName = "";

        //商品数量
        ///整型数字，只标识该订单的商品数量，默认填1
        $Quick99bill_productNum="1";

        //商品代码
        ///字母、数字或 - 、_ 的组合,并以字母或数字开头
        ///商户自定义
        $Quick99bill_productId="";

        //商品描述
        ///英文字符串
        $Quick99bill_productDesc = "SaudiArabia";

        //支付方式
        ///固定值 20
        ///20：外卡支付网关保留专用
        $Quick99bill_payType="20";

        //银行代码
        ///用户在实际支付时所使用的银行代码
        ///扩展字段
        $Quick99bill_bankId="";

        //固定选择值： 1、0
        ///默认为0
        ///1 代表同一订单号只允许提交1 次；
        ///0 表示同一订单号在没有支付成功的前提下可重复提交多次。
        ///建议实物购物车结算类商户采用 0；虚拟产品类商户采用1；
        $Quick99bill_redoFlag="0";

        //合作伙伴在快钱的用户编号
        ///用户登录快钱首页后可查询到。仅适用于快钱合作伙伴中系统及平台提供商。
        ///扩展字段
        $Quick99bill_pid = "";
		
		//用户信用卡上的全名
        $Quick99bill_fullName= "";
		//发送地址
        $Quick99bill_shippingAddress= "";
		
		//收货人信息
        $Quick99bill_recipEmail= $rows["arraddress"][7];
        $Quick99bill_recipPhone= $rows["arraddress"][6];
        $Quick99bill_recipFullname= $rows["arraddress"][0]." ".$rows["arraddress"][8];
        $Quick99bill_recipCountry= $rows["arraddress"][5];
        $Quick99bill_recipCity= $rows["arraddress"][3];
        $Quick99bill_recipAddress= $rows["arraddress"][1] ;
        $Quick99bill_recipZipCode= $rows["arraddress"][2];
        //扩展字段一
        ///支付完成后，按照原样返回给商户
        $Quick99bill_ext1="";

        //扩展字段二
        ///支付完成后，按照原样返回给商户
        $Quick99bill_ext2="";

        $Quick99bill_signMsgVal=""; //将非空的参数组成字符串
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "inputCharset", $Quick99bill_inputCharset);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "pageUrl", $Quick99bill_pageUrl);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "bgUrl", $Quick99bill_bgUrl);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "version", $Quick99bill_version);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "language", $Quick99bill_language);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "signType", $Quick99bill_signType);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "merchantAcctId", $Quick99bill_merchantAcctId);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "termId", $Quick99bill_termId);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "email", $Quick99bill_email);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "phoneNumber", $Quick99bill_phoneNumber);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "zipCode", $Quick99bill_zipCode);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "orderId", $Quick99bill_orderId);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "pricingCurrency", $Quick99bill_pricingCurrency);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "pricingAmount", $Quick99bill_pricingAmount);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "billingCurrency", $Quick99bill_billingCurrency);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "billingAmount", $Quick99bill_billingAmount);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "exchangeRateFlag", $Quick99bill_exchangeRateFlag);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "exchangeRateDirection", $Quick99bill_exchangeRateDirection);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "exchangeRate", $Quick99bill_exchangeRate);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "orderTime", $Quick99bill_orderTime);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "productNum", $Quick99bill_productNum);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "productId", $Quick99bill_productId);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "payType", $Quick99bill_payType);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "bankId", $Quick99bill_bankId);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "redoFlag", $Quick99bill_redoFlag);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "pid", $Quick99bill_pid);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "ext1", $Quick99bill_ext1);
        $Quick99bill_signMsgVal = appendParam($Quick99bill_signMsgVal, "ext2", $Quick99bill_ext2);
        //echo $Quick99bill_signMsgVal;
        //echo '<HR>'.$Quick99bill_signMsgVal.'<BR>';
        // fetch private key from file and ready it
$Quick99bill_fp = fopen(dirname(__FILE__)."/81244005661000190.pem", "r");//dirname(__FILE__).
$Quick99bill_priv_key = fread($Quick99bill_fp, 8192);
fclose($Quick99bill_fp);
$Quick99bill_pkeyid = openssl_get_privatekey($Quick99bill_priv_key);

// compute signature
openssl_sign($Quick99bill_signMsgVal, $Quick99bill_signMsg, $Quick99bill_pkeyid,OPENSSL_ALGO_SHA1);

// free the key from memory
openssl_free_key($Quick99bill_pkeyid);

$Quick99bill_signMsg = base64_encode($Quick99bill_signMsg);


$rows["payonline"]["99bill"]["inputCharset"]=$Quick99bill_inputCharset;
$rows["payonline"]["99bill"]["pageUrl"]=$Quick99bill_pageUrl;
$rows["payonline"]["99bill"]["bgUrl"]=$Quick99bill_bgUrl;
$rows["payonline"]["99bill"]["version"]=$Quick99bill_version;	
$rows["payonline"]["99bill"]["language"]=$Quick99bill_language;	
$rows["payonline"]["99bill"]["signType"]=$Quick99bill_signType;	
$rows["payonline"]["99bill"]["merchantAcctId"]=$Quick99bill_merchantAcctId;	
$rows["payonline"]["99bill"]["termId"]=$Quick99bill_termId;		
$rows["payonline"]["99bill"]["firstName"]=$Quick99bill_firstName;		
$rows["payonline"]["99bill"]["lastName"]=$Quick99bill_lastName;		
$rows["payonline"]["99bill"]["issuingBank"]=$Quick99bill_issuingBank;	
$rows["payonline"]["99bill"]["issuingCountry"]=$Quick99bill_issuingCountry;	
$rows["payonline"]["99bill"]["email"]=$Quick99bill_email;
$rows["payonline"]["99bill"]["phoneNumber"]=$Quick99bill_phoneNumber;	
$rows["payonline"]["99bill"]["zipCode"]=$Quick99bill_zipCode;		
$rows["payonline"]["99bill"]["billingAddress"]=$Quick99bill_billingAddress;		
$rows["payonline"]["99bill"]["billingCity"]=$Quick99bill_billingCity;		
$rows["payonline"]["99bill"]["billingState"]=$Quick99bill_billingState;	
$rows["payonline"]["99bill"]["billingCountry"]=$Quick99bill_billingCountry;
$rows["payonline"]["99bill"]["orderId"]=$Quick99bill_orderId;	
$rows["payonline"]["99bill"]["pricingCurrency"]=$Quick99bill_pricingCurrency;	
$rows["payonline"]["99bill"]["pricingAmount"]=$Quick99bill_pricingAmount;
$rows["payonline"]["99bill"]["billingCurrency"]=$Quick99bill_billingCurrency;
$rows["payonline"]["99bill"]["billingAmount"]=$Quick99bill_billingAmount;
$rows["payonline"]["99bill"]["exchangeRateFlag"]=$Quick99bill_exchangeRateFlag;
$rows["payonline"]["99bill"]["exchangeRateDirection"]=$Quick99bill_exchangeRateDirection;
$rows["payonline"]["99bill"]["exchangeRate"]=$Quick99bill_exchangeRate;
$rows["payonline"]["99bill"]["orderTime"]=$Quick99bill_orderTime;
$rows["payonline"]["99bill"]["productName"]=$Quick99bill_productName;
$rows["payonline"]["99bill"]["productNum"]=$Quick99bill_productNum;
$rows["payonline"]["99bill"]["productId"]=$Quick99bill_productId;
$rows["payonline"]["99bill"]["productDesc"]=$Quick99bill_productDesc;
$rows["payonline"]["99bill"]["payType"]=$Quick99bill_payType;
$rows["payonline"]["99bill"]["bankId"]=$Quick99bill_bankId;
$rows["payonline"]["99bill"]["redoFlag"]=$Quick99bill_redoFlag;
$rows["payonline"]["99bill"]["pid"]=$Quick99bill_pid;
$rows["payonline"]["99bill"]["fullName"]=$Quick99bill_fullName;
$rows["payonline"]["99bill"]["shippingAddress"]=$Quick99bill_shippingAddress;
$rows["payonline"]["99bill"]["recipEmail"]=$Quick99bill_recipEmail;
$rows["payonline"]["99bill"]["recipPhone"]=$Quick99bill_recipPhone;
$rows["payonline"]["99bill"]["recipFullname"]=$Quick99bill_recipFullname;
$rows["payonline"]["99bill"]["recipCountry"]=$Quick99bill_recipCountry;
$rows["payonline"]["99bill"]["recipCity"]=$Quick99bill_recipCity;
$rows["payonline"]["99bill"]["recipAddress"]=$Quick99bill_recipAddress;
$rows["payonline"]["99bill"]["recipZipCode"]=$Quick99bill_recipZipCode;
$rows["payonline"]["99bill"]["ext1"]=$Quick99bill_ext1;
$rows["payonline"]["99bill"]["ext2"]=$Quick99bill_ext2;
$rows["payonline"]["99bill"]["signMsg"]=$Quick99bill_signMsg;

?>