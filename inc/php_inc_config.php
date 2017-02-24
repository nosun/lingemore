<?


//数据库连接配置
$cfg["db_server"]="localhost";
$cfg["db_username"]="lingeriemoreuser";
$cfg["db_userpwd"]="lingeriemorepassword";
$cfg["db_name"]="lingeriemore";
$cfg["db_charset"]="UTF8";
$cfg["db_table_pre"] = "";
define("TABLE_PRE",$cfg["db_table_pre"] ) ;

define("CDNKEY","b84b7c20dce4a9a258d30d36bb27ea51");

//模板配置
$cfg["smarty"]["left_delimiter"] = "<{" ;
$cfg["smarty"]["right_delimiter"] =  "}>" ;
$cfg["smarty"]["cache"] =  false ;
$cfg["smarty"]["cache_time"] =  600 ;
$cfg["smarty"]["compile_check"] = true;
//系统杂项配置
$cfg["webname"] = "sexylingerie606" ;
$cfg["website"] = "sexylingerie606";
$cfg["domain"] = "";
$cfg["folder"] = "/";


$cfg["rootpath"] = str_replace('inc','',str_replace('\\','/',dirname(__FILE__))) ;
define("FOLDER",$cfg["folder"] ) ;
define("ROOT",str_replace("\\","/",$_SERVER["DOCUMENT_ROOT"]));


$cfg["split"]="卐";
$cfg["split2"]="卍";
$cfg["split_uri"]="::";
$cfg["split_uri2"]="<span class='daoa3'>&gt;</span>";
$cfg["language"]="en";  // 默认语种
$cfg["timezone"]="Asia/Shanghai";
$cfg["upload_maxsize"] = 60 ; //M
$cfg["time_limit"]=600;
$cfg["upload_imageType"]=array("jpg","png","gif");
$cfg["upload_fileType"]=array("bmp","doc","csv","flv","gif","jpeg","jpg","ppt","png","rar","zip","rtf","xls","pdf");


$cfg["skin"]="default";
$cfg["rewrite"]= 1 ; //1为伪静态路径
$cfg["html"] = false ; //是否生成静态页
$cfg["morecountryexpress"] = false ; 
$cfg["html_cache"] = 5 ;

//----程序调试配置
$cfg["error_reporting"]=E_ERROR | E_PARSE; //E_ERROR | E_PARSE
$cfg["mysql_debug"]= false;

$cfg["session"]=60*60;


$cfg["cache_time"]=3600*24*100; //--app 缓存的时间
$cfg["pcart"]=1;
$cfg["Gimage"]["type"] = 0 ;  //0不加水印 1 加字 2加图片
$cfg["Gimage"]["text"] = "php.35zh.com";
$cfg["Gimage"]["pic"] = "systemImage/water.gif";

$cfg["image"][0]=array(56,56,"small");
$cfg["image"][1]=array(126,165,"mid");
$cfg["image"][2]=array(400,600,"big");
$cfg["image"][3]=array(90,90,"order");
$cfg["image"][4]=array(240,240,"zoom");
$cfg["image"][5]=array(35,25,"css");
$cfg["image"][6]=array(35,25,"wat");
$cfg["image"][7]=array(225,225,"larger");
$cfg["image"][8]=array(120,60,"scroll");

$imagestyle = $cfg["image"] ;

$cfg["deleteImage"]=array("","small","mid","big","zoom","css","wat");
$cfg["deleteImageAll"]=array("","small","mid","big","zoom","order","css","wat");
//产品配置
$cfg["productclass"]["rootname"]="productclass";
$cfg["productclass"]["maxlevel"]=5;
$cfg["productclass"]["page"]="a_productclass.php";
$cfg["productclass"]["p_add"]=10;
$cfg["productclass"]["disp"]=array("推荐首页","推荐顶部"); 
$cfg["product"]["disp"]=array("Best Margin Wholesale Products","Featured Wholesale Products","Recommended Factory Sellers","Hot Wholesale Products"); /// 没用了
$cfg["product"]["tagtype"] = array("未归类","Tags","Price","Colors"); /// 没用了
$cfg["product"]["pnum"]=10; /// 没用了
$cfg["image"]["num"]=10; /// 没用了
//新闻配置
$cfg["news"]["disp"]=array("首页");
//                           1  ,   2  ,  4

if( $cfg["folder"]=="/" )
{
	$temprequire = $cfg["webname"];
}
else
{
	$temprequire = "/" ;
}
//fckedit配置
$cfg["fckedit"]["width"]=700;
$cfg["fckedit"]["height"]=400;
$cfg["fckedit"]["basepath"]="/" . $cfg["webname"] . "/a9b69ea30751c484cde34rfvbgt56yhnmj/";
$cfg["fckedit"]["require"]="../sexylingerie606/a9b69ea30751c484cde34rfvbgt56yhnmj/fckeditor.php";
//image配置

//--  权限设置
$cfg["admin"]["group"] = array("账户设置组","网站维护组","信息管理组","业务管理组","数据分析组");
?>
