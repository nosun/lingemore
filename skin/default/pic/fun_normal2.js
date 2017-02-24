function cTrim(sInputString,iType)
{
var sTmpStr = ' '
var i = -1

if(iType == 0 || iType == 1)
{
 while(sTmpStr == ' ')
  {
   ++i
   sTmpStr = sInputString.substr(i,1)
  }
 sInputString = sInputString.substring(i)
}

if(iType == 0 || iType == 2)
{
  sTmpStr = ' '
  i = sInputString.length
  while(sTmpStr == ' ')
   {
    --i
    sTmpStr = sInputString.substr(i,1)
   }
  sInputString = sInputString.substring(0,i+1)
}
 return sInputString
}

function trimAll(text)
{
	return text.replace(/(^\s*)|(\s*$)/g, "");
}

function emptyFun()
{

}
function $2(id)
{
	return document.getElementById(id);	
}
function hideSub(obj)
{
	obj.style.visibility='hidden';	
}
function tr_onMouseOver(obj)
{ obj.style.background="#F3F3F3";
}
function tr_onMouseOut(obj)
{
obj.style.background="#ffffff";
}
function EnterSelect(id,svalue)
{    
var slt=document.getElementById(id)
var strempty="";
if(slt!=null)
   for(var i=0;i<=slt.childNodes.length-1;i++)
       if((slt.childNodes[i].value+strempty)==svalue.trim() )
          { 
             slt.childNodes[i].selected=true;
             break;
          }
}
function EnterSelectIndex(id,sindex)
{    
var slt=document.getElementById(id)
if(slt!=null)
     slt.selectedIndex=sindex;

}


String.prototype.trim = function() {	return this.replace(/^\s+|\s+$/g,"");}

function EnterCheckBox(name,svalue)
{
var str=""
var slt=document.getElementsByName(name)
var arr=svalue.split(",")
for(var indexI=0;indexI<=slt.length-1;indexI++)
   for(var indexJ=0;indexJ<=arr.length-1;indexJ++)
   {
	  if((slt[indexI].value+"")==(arr[indexJ]+""))
	       slt[indexI].checked=true;
   }
}

function EnterRadio(name,svalue)
{
var str="";
var slt=document.getElementsByName(name);
for(var indexI=0;indexI<=slt.length-1;indexI++)
   if((slt[indexI].value+str)==(svalue+str))
	{
	  try{
	    slt[indexI].checked=true;
	    slt[indexI].onclick();
	  }
	  catch(e){}
		break;
	 }
}


function EnterRadioIndex(name,indexI)
{
	var str="";
	//alert(name);
var slt=document.getElementsByName(name);
	  try{
	    slt[indexI].checked=true;
	    slt[indexI].onclick();
	  }
	  catch(e){}
}

//--------------------------表单验证
//验证长度的函数，首先调用验证是否为空的函数
function CheckIsNull(Inform,Inputname,msg){ 
   var Form=Inform+"." 
   eval("Temp=document."+Form+Inputname+".value;"); 
    Temp = trimAll(Temp);
   if(Temp=="")
   { 
      alert(msg); 
      //eval(Form+Inputname+".focus();"); 
      return false; 
   }
   else
   { 
    return true; 
   } 
}
//2个文本框是否是一样的
function CheckIsSame(Inform,Inputname1,Inputname2,Inputvalue1,Inputvalue2,msg){
if (!CheckIsNull(Inform,Inputname1,Inputvalue1)) 
   return false;
else if(!CheckIsNull(Inform,Inputname2,Inputvalue2)) 
   return false; 
else
{
var Form=Inform+".";
eval("Temp1=document."+Form+Inputname1+".value;");
eval("Temp2=document."+Form+Inputname2+".value;");
if(Temp1!=Temp2)
{
alert(msg);
return false;
}
else
  return true;
}
}
//验证长度函长度介于a,b
function CheckLength(Inform,Inputname,Inputvalue,InputMinSize,InputMaxSize){
//验证是否为空！
if (!CheckIsNull(Inform,Inputname,Inputvalue)) 
   return false;
else
{
var Form=Inform+"." 
eval("Temp=document."+Form+Inputname+".value;"); 
if (Temp.length<parseInt(InputMinSize)||Temp.length>parseInt(InputMaxSize))
{
alert("Sorry,the length of " + Inputvalue+" must be "+InputMinSize+" and "+InputMaxSize+"!");
 //eval(Form+Inputname+".focus();"); 
return false;}
else{ 
    return true; 
} 
}
}
//验证长度函数二，该函数主要判断当不要求是否为空、只要求最大长度的时候使用
function CheckLengthMax(Inform,Inputname,Inputvalue,InputMaxSize){
var Form=Inform+"." 
eval("Temp=document."+Form+Inputname+".value;"); 
if (Temp.length>parseInt(InputMaxSize)){
alert("Sorry:the length of " +Inputvalue+" must be less than "+InputMaxSize+"!");
 //eval(Form+Inputname+".focus();"); 
return false;}
else{ 
    return true; 
}
}
//验证是否为合法HTTP的函数
function CheckIsHTTP(Inform,Inputname,Http){
 if (!CheckIsNull(Inform,Inputname,Http))return false; 
   else{ 
      var Form=Inform+"." 
         eval("Temp=document."+Form+Inputname+".value;"); 
      if(Temp.search(/^http:\/\//)==-1) 
          { alert("Sorry:format of "+Http+" not correct!"); 
           // eval(Form+Inputname+".focus();"); 
            return false; 
             } 
   else{ 
            return true; 
       } 
      }	
}
//验证是否为合法IP的函数
function CheckIsIP(Inform,Inputname,IP){
 if (!CheckIsNull(Inform,Inputname,IP))return false; 
   else{ 
      var Form=Inform+"." 
         eval("Temp=document."+Form+Inputname+".value;"); 
      if(Temp.search(/(\d+)\.(\d+)\.(\d+)\.(\d+)/g)==-1) 
          { alert("Sorry:format of "+IP+" not correct!"); 
            //eval(Form+Inputname+".focus();"); 
            return false; 
             } 
   else{ 
            return true; 
       } 
      }
}
//验证是否为合法email的函数
function CheckIsEmail(Inform,Inputname,msg){ 
   if (!CheckIsNull(Inform,Inputname,msg))return false; 
   else{ 
      var Form=Inform+"." 
         eval("Temp=document."+Form+Inputname+".value;"); 
      if(Temp.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)==-1) 
          { alert(msg); 
           // eval(Form+Inputname+".focus();"); 
            return false; 
             } 
   else{ 
            return true; 
       } 
      }   
} 
//验证是否是数字
function CheckIsNum(Inform,Inputname,Num){ 
   if (!CheckIsNull(Inform,Inputname,Num))return false; 
else{ 
         var Form=Inform+"." 
         eval("Temp=document."+Form+Inputname+".value;"); 
      if(isNaN(Temp)){ 
                    alert("Sorry:"+Num+" must be a number!"); 
                   // eval(Form+Inputname+".focus();"); 
                    return false; 
                     } 
   else{ 
           return true; 
          } 
    } 
} 
//验证是否为手机号码
function CheckIsMobile(Inform,Inputname,Mobile){ 
   if (!CheckIsNull(Inform,Inputname,Mobile))return false; 
   else{ 
  var Form=Inform+"." 
  eval("Temp=document."+Form+Inputname+".value;"); 
  if(Temp.search(/^1[3|5]\d{9}$/)==-1) 
  {   alert("Sorry:format of "+Mobile+" not correct!"); 
   //eval(Form+Inputname+".focus();"); 
   return false; 
  } 
  else{ 
              return true; 
       } 
 } 
} 
//验证是否为日期  文本框中输入的。 
function CheckIsDate(Inform,Inputname,date){
//.先判断是否为空，如果为空，直接返回false
 if(!CheckIsNull(Inform,Inputname,date)) return false;
 else{
var Form=Inform+".";
 //.再判断是否为日期格式
 eval("DateValue="+Form+Inputname+".value;");
 //.如果是数字的话,返回false
 if(DateValue.substring(4,5)!="-"||isNaN(DateValue.substring(0,4))||DateValue.substring(0,1)=="0"){
 alert(date+"格式不正确,格式:yyyy-mm-dd,且年份第一位不能为0,不能包含字母！");
 //eval(Form+Inputname+".focus();");
 return false;
 }else{//.总体判断月开始
  if(DateValue.indexOf("-")==DateValue.lastIndexOf("-")||isNaN(DateValue.substring(5,DateValue.lastIndexOf("-")))||DateValue.substring(5,DateValue.lastIndexOf("-")).length>2||DateValue.substring(5,DateValue.lastIndexOf("-"))>12){
  alert(date+"格式不正确,格式:yyyy-mm-dd，且月份不能大于12,不能包含字母！");
  //eval(Form+Inputname+".focus();");
  return false;
  }else{//.总体判断日期开始
   if(DateValue.substring(DateValue.lastIndexOf("-")+1).length>2||DateValue.substring(DateValue.lastIndexOf("-")+1)>31||isNaN(DateValue.substring(DateValue.lastIndexOf("-")+1)) ){
   alert(date+"格式不正确,格式:yyyy-mm-dd，且日期不能大于31,不能包含字母！");
   //eval(Form+Inputname+".focus();");
   return false;
   }else{//.开始判断月份的大小
   var year=DateValue.substring(0,4);
   var month=DateValue.substring(5,DateValue.lastIndexOf("-"));
   var day=DateValue.substring(DateValue.lastIndexOf("-")+1);
     if(parseInt(month)==2){//..判断二月的情况
  if (year%4==0 && year%100 !=0 ||year%400 ==0 ){
    if(day>29){
     alert(date+"不正确,"+year+"年的二月最多只有29天！");
        //eval(Form+Inputname+".focus();");
        return false;
    }
  }else{
   if(day>28){
     alert(date+"不正确,"+year+"年的二月最多只有28天！");
        //eval(Form+Inputname+".focus();");
        return false;
    } 
  }
  }//.判断二月结束
  else if(parseInt(month)==1||parseInt(month)==3||parseInt(month)==7||parseInt(month)==8||month==10||month==12){//.判断有31天月份开始
     if(day>31){
  alert(date+"不正确,"+parseInt(month)+"月最多只有31天！");
      //  eval(Form+Inputname+".focus();");
        return false;
  }
 }//.判断有31的函数结束。
  else{//.有30天的情况
     if(day>30){
  alert(date+"不正确,"+parseInt(month)+"月最多只有30天！");
       // eval(Form+Inputname+".focus();");
        return false;
  }
   } //.判断日期为30天结束    
   }  //.判断月份结束
  }//.总体判断日期结束
 }//..总体判断月结束
return true;
}
}
//验证是否选中单选框
function CheckRadio(Inputform,Inputname,Inputvalue){
var Form=Inputform+".";
var InputName=Inputname;
var flag=false;
eval("len="+Form+InputName+".length"); 
for (i=0;i<parseInt(len);i++){
eval("val="+Form+InputName+"["+i+"]"+".checked");
if(val){
flag=true;
}
}
if (flag==false){
alert("Sorry:"+Inputvalue+" must be chosen");
return false;

}else{
              return true;
}
}
//判断复选框是否被选中
function CheckCheckbox(Inputform,Inputname,Inputvalue){
       var Form=Inputform+"."; 
 var InputName=Inputname;  
 var flag=false;        
       eval("len0="+Form+InputName+".length;");
 eval("len="+parseInt(len0));
       for(i=0;i<len;i++){
  eval("val="+Form+InputName+"["+i+"].checked");
           if (val){
     flag=true;
  }
       }
if(flag==true){
    return true;
 }
else
{
    alert("Sorry:"+Inputvalue+" must be chosen!");
    return false;
}
}
//验证下拉列表框是否选定！
function CheckSelect(Inputform,Inputname,Inputvalue){
     var Form=Inputform+"."; 
  var InputName=Inputname; 
  eval("val="+Form+InputName+".value;");
  if (val==""){
     alert("Sorry:"+Inputvalue+" must be chosen");
  return false;
  }else{return true;}
}
//判断指定表单中是否有特殊字符的判断.(本处特殊字符验证只是验证了数字,字母以及下划线)
function CheckIsChar(Inputform,Inputname,Inputvalue){
if (!CheckIsNull(Inputform,Inputname,Inputvalue))return false; 
var Form=Inputform+".";
var Name=Inputname;
eval("Value=document."+Form+Name+".value;");
eval("Len=document."+Form+Name+".value.length;");
for(var i=0;i<Len;++i)
     {
       tkey=Value.charAt(i);
    var str_val=tkey.charCodeAt(0);
       if(str_val>=48&&str_val<=57||str_val>=65&&str_val<=90||str_val>=97&&str_val<=122||str_val==95)
       {
    }
    else
    {
    alert("Sorry:"+Inputvalue+" can only contain english letters , number or underline!");
     //  eval(Form+Inputname+".focus();");
    return false;
    }
     }
  return true;}
//.汉字的判断
function CheckIsChinese(Inputform,Inputname,Inputvalue){
if (!CheckIsNull(Inputform,Inputname,Inputvalue))return false; 
var Form=Inputform+".";
var Name=Inputname;
eval("Value="+Form+Name+".value;");
eval("Len="+Form+Name+".value.length;");
for(i=0;i<Len;i++){ 
char=Value.charCodeAt(i); 
if(!(char>255)){ 
    alert("Sorry:"+Inputvalue+" must be only characters!"); 
    //eval(Form+Inputname+".focus();");
return false; 
} 
} 
return true;
}
function SetHome(obj){
var url="http://" + window.location.host;
try{
obj.style.behavior='url(#default#homepage)';obj.setHomePage(url);
}
catch(e){
if(window.netscape) {
try {
netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
}
catch (e) {
}
var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
prefs.setCharPref('browser.startup.homepage',url);
}
}
}
//添加到收藏夹
function AddFavorite(sURL, sTitle)

{

    try

    {

        window.external.addFavorite(sURL, sTitle);

    }

    catch (e)

    {

        try

        {

            window.sidebar.addPanel(sTitle, sURL, "");

        }

        catch (e)

        {

           // alert("加入收藏失败，请使用Ctrl+D进行添加");

        }

    }

}


function includeJsFile(id,src)
{
	var scriptTag = document.getElementById( id ); 
    var oHead = document.getElementsByTagName('HEAD')[0];
    while (tempScript = document.getElementById(id)) 
	{
		tempScript.parentNode.removeChild(tempScript);
		for (var prop in tempScript) 
		{
		  try
		  {
		  	delete tempScript[prop];
		  }
		  catch(e)
		  {
		  
		  }
		}
    }
    var oScript= document.createElement("script");
	oScript.id = id;
	oScript.charset='utf-8';
    oScript.type = "text/javascript"; 
    oScript.src=src;
    oHead.appendChild( oScript);
}
function setInnerHTML(el, htmlCode) 
{ 
el.innerHTML = htmlCode;
var regExp=/<script.*>(.*)<\/script>/gi;
if(regExp.test(htmlCode)){
eval(RegExp.$1);
} 
}

function executeScript(html)
{
    var reg = /<script[^>]*>([^\x00]+)$/i;
    //对整段HTML片段按<\/script>拆分
    var htmlBlock = html.split("<\/script>");
    for (var i in htmlBlock) 
    {
        var blocks;//匹配正则表达式的内容数组，blocks[1]就是真正的一段脚本内容，因为前面reg定义我们用了括号进行了捕获分组
        if (blocks = htmlBlock[i].match(reg)) 
        {
            //清除可能存在的注释标记，对于注释结尾-->可以忽略处理，eval一样能正常工作
            var code = blocks[1].replace(/<!--/, '');
            try 
            {
                eval(code) //执行脚本
            } 
            catch (e) 
            {
            }
        }
    }
}

function Ajax(sUrl,sQueryString,oResultFunc,oFailFunc) 
{
	this.Url = sUrl;
	this.QueryString = sQueryString;
	this.XmlHttp = this.createXMLHttpRequest();
	if (this.XmlHttp == null) 
	{
		alert("erro");
		return;
	}
	var objfun;
	if(!oFailFunc)
	{
		objfun=emptyFun;
	}
	else
		objfun=oFailFunc;
	var objxml = this.XmlHttp;
	objxml.onreadystatechange = function (){Ajax.handleStateChange(objxml,oResultFunc,objfun)};
}

Ajax.prototype.createXMLHttpRequest = function()
 {
try { return new ActiveXObject("Msxml2.XMLHTTP"); } catch(e) {}
try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {}
try { return new XMLHttpRequest(); } catch(e) {}
return null;
}

Ajax.prototype.createQueryString = function () {
var queryString = this.QueryString;
return queryString;
}

Ajax.prototype.get = function () {
sUrl = this.Url;
var queryString = sUrl+"?timeStamp=" + new Date().getTime() + "&" + this.createQueryString();
this.XmlHttp.open("GET",queryString,true);
this.XmlHttp.send(null);
}

Ajax.prototype.post = function() {
sUrl = this.Url;
var sUrl = sUrl + "?timeStamp=" + new Date().getTime();
var queryString = this.createQueryString();
this.XmlHttp.open("POST",sUrl,true);
this.XmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
this.XmlHttp.send(queryString);
}

Ajax.handleStateChange = function (XmlHttp,oResultFunc,oFailFunc) 
{
	if (XmlHttp.readyState == 4) 
	{
		if (XmlHttp.status == 200) 
		{
			oResultFunc(XmlHttp);
		} 
		else 
		{
			oFailFunc(XmlHttp);
		}
	}
}