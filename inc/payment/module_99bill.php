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


		//�ַ���
        ///�̶�ѡ��ֵ��1��2��3
        ///1 ����UTF-8; 2����GBK; 3 ����GB2312   Ĭ��ֵΪ1 ����ҳ�����ѡ��
        $Quick99bill_inputCharset = "1";

        //����֧�������ҳ���ַ
        ///��Ҫ�Ǿ��Ե�ַ����bgUrl ����ͬʱΪ�� ǰ̨ҳ��֪ͨ
        ///��bgUrl Ϊ��ʱ����Ǯֱ�ӽ�֧�����get ��pageUrl ��bgUrl ��Ϊ��ʱ������bgUrl�ķ�ʽ����
        $Quick99bill_pageUrl = "http://" . $_SERVER['SERVER_NAME'] . FOLDER . "step.php?action=step_return&type=99bill";

        //����������֧������ĺ�̨��ַ
        ///��Ҫ�Ǿ��Ե�ַ����pageUrl ����ͬʱΪ��  ��̨������֪ͨ
        ///��Ǯ��֧��������͵�bgUrl ��Ӧ�ĵ�ַ�����һ�ȡ�̻�����Լ����ʽ����ĵ�ַ����ʾҳ����û�
        $Quick99bill_bgUrl = "";

        //���ذ汾
        ///�̶�ֵ��v1.0
        $Quick99bill_version="v1.0";

        //����ҳ����ʾ��������
        ///�̶�ֵ��2  2 ����Ӣ����ʾ
        $Quick99bill_language = "2";

        //ǩ������
        ///�̶�ֵ��1
        ///1 ����SHA-1 ǩ��
        $Quick99bill_signType = "1";

        //�⿨�˻�
        ///���տ�����̻��⿨�˻���� ��ͬ�ڿ�Ǯ�ʺ�
        $Quick99bill_merchantAcctId = $config[296];//"104110045110203";

        //�ն˱��
        ///�ʺſ�ͨ���и����⿨�ʺŶ�Ӧ���ն˱��
        $Quick99bill_termId = $config[297];//"00000203";//"00000259";

        //�ֿ��� First Name
        ///�й���ָ���ϣ�
        $Quick99bill_firstName = "";

        //�ֿ��� Last Name
        ///�й���ָ����
        $Quick99bill_lastName = "";

        //�ֿ��� Full Name
        ///�й���ָȫ��
        $Quick99bill_fullName = "";

        //������
        ///������������֧������������
        $Quick99bill_issuingBank="";

        //��������
        ///��������,����������
        $Quick99bill_issuingCountry="";

        //�ֿ��˵����ʼ���ַ
        ///�ֿ��˵����ʼ���ַ
        $Quick99bill_email = "";

        //�ֿ�����ϵ�绰
        ///�ֿ�����ϵ�绰
        $Quick99bill_phoneNumber = "";

        //billing address ��Ӧ��zip code
        ///�˵��ص���������
        $Quick99bill_zipCode = "";

        //shipping Address ��Ӧ��zip code
        ///��Ʒ���ʼĵ�ַ
        $Quick99bill_shippingAddress = "";

        //billing address
        ///�˵��ʼ���ϸ��ַ
        $Quick99bill_billingAddress = "";

        //billing City
        ///�˵�����
        $Quick99bill_billingCity ="";

        //billing State
        ///�˵���
        $Quick99bill_billingState="";

        //billing Country
        ///�˵�����
        $Quick99bill_billingCountry = "";

        //�̻�������
        ///ֻ����ʹ����ĸ�����֡�- ��_,������ĸ�����ֿ�ͷ
        ///ÿ�̻��ύ�Ķ����ţ������������˻�������Ψһ
        $Quick99bill_orderId = $rows["itemno"];

        //�������۱ұ�
        ///���ҷ��ţ���USD��EUR ��
        ///���ҷ���  �ұ�
        ///CNY  �����
        ///USD  ��Ԫ
        ///HKD  ��Ԫ
        ///GBP  Ӣ��
        ///JPY  ��Ԫ
        ///EUR  ŷԪ
        ///TWD  ��̨��
        $Quick99bill_pricingCurrency = "USD";

        //�������۽��
        ///������100�����磬��Ԫ298.30���ύʱ���ӦΪ29830
        $Quick99bill_pricingAmount = $rows["totalprices"]*100;

        //�����ۿ�ұ�
        ///���ҷ��ţ���USD��EUR ��
        ///�����ۿ� ������� ���ҷ�����ο����ҷ��š�
        ///���ҷ���  �ұ�
        ///CNY  �����
        ///USD  ��Ԫ
        ///HKD  ��Ԫ
        ///GBP  Ӣ��
        ///JPY  ��Ԫ
        ///EUR  ŷԪ
        ///TWD  ��̨��
        ///�������exchangeRateFlagΪ0����Ϊ�գ���Ǯ���ۿ�ұ�Ϊ����Ҵ���
        ///�������exchangeRateFlagΪ1�������̻��ṩ������Ϊ �ա�
        $Quick99bill_billingCurrency ="";

        //�����ۿ���
        ///������100�����磬��Ԫ298.30���ύʱ���ӦΪ29830
        ///�������exchangeRateFlagΪ0����Ϊ�գ���Ǯ����ͳһ���ʻ��������ҡ�
        ///�������exchangeRateFlagΪ1�������̻��ṩ������Ϊ�ա�
        $Quick99bill_billingAmount="";

        //�����ṩ��־
        ///0 �ɿ�Ǯͳһ�ṩ����
        ///1 ���̻��ύ����ʱ�ṩ
        $Quick99bill_exchangeRateFlag="0";

        //���ʷ���
        ///0 ���۱ұ�/�ۿ�ұ�
        ///1 �ۿ�ұ�/���۱ұ�
        $Quick99bill_exchangeRateDirection="0";

        //����
        ///�������exchangeRateFlagΪ0����Ϊ��
        ///�������exchangeRateFlagΪ1������Ϊ��
        $Quick99bill_exchangeRate="";

        //�̻������ύʱ��
        ///��ʽΪ����[4 λ]��[2 λ]��[2 λ]ʱ[2 λ]��[2 λ]��[2 λ]
        ///���磺20071117020101
        $Quick99bill_orderTime = date("YmdHis");//date("YmdHis");//'20071117020101'; 

        //��Ʒ����
        ///Ӣ���ַ���
        $Quick99bill_productName = "";

        //��Ʒ����
        ///�������֣�ֻ��ʶ�ö�������Ʒ������Ĭ����1
        $Quick99bill_productNum="1";

        //��Ʒ����
        ///��ĸ�����ֻ� - ��_ �����,������ĸ�����ֿ�ͷ
        ///�̻��Զ���
        $Quick99bill_productId="";

        //��Ʒ����
        ///Ӣ���ַ���
        $Quick99bill_productDesc = "SaudiArabia";

        //֧����ʽ
        ///�̶�ֵ 20
        ///20���⿨֧�����ر���ר��
        $Quick99bill_payType="20";

        //���д���
        ///�û���ʵ��֧��ʱ��ʹ�õ����д���
        ///��չ�ֶ�
        $Quick99bill_bankId="";

        //�̶�ѡ��ֵ�� 1��0
        ///Ĭ��Ϊ0
        ///1 ����ͬһ������ֻ�����ύ1 �Σ�
        ///0 ��ʾͬһ��������û��֧���ɹ���ǰ���¿��ظ��ύ��Ρ�
        ///����ʵ�ﹺ�ﳵ�������̻����� 0�������Ʒ���̻�����1��
        $Quick99bill_redoFlag="0";

        //��������ڿ�Ǯ���û����
        ///�û���¼��Ǯ��ҳ��ɲ�ѯ�����������ڿ�Ǯ���������ϵͳ��ƽ̨�ṩ�̡�
        ///��չ�ֶ�
        $Quick99bill_pid = "";
		
		//�û����ÿ��ϵ�ȫ��
        $Quick99bill_fullName= "";
		//���͵�ַ
        $Quick99bill_shippingAddress= "";
		
		//�ջ�����Ϣ
        $Quick99bill_recipEmail= $rows["arraddress"][7];
        $Quick99bill_recipPhone= $rows["arraddress"][6];
        $Quick99bill_recipFullname= $rows["arraddress"][0]." ".$rows["arraddress"][8];
        $Quick99bill_recipCountry= $rows["arraddress"][5];
        $Quick99bill_recipCity= $rows["arraddress"][3];
        $Quick99bill_recipAddress= $rows["arraddress"][1] ;
        $Quick99bill_recipZipCode= $rows["arraddress"][2];
        //��չ�ֶ�һ
        ///֧����ɺ󣬰���ԭ�����ظ��̻�
        $Quick99bill_ext1="";

        //��չ�ֶζ�
        ///֧����ɺ󣬰���ԭ�����ظ��̻�
        $Quick99bill_ext2="";

        $Quick99bill_signMsgVal=""; //���ǿյĲ�������ַ���
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