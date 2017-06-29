<?php 
//判断手机操作系统
function get_device_type(){
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$type = 'other';
	if(strpos($agent, 'iphone') || strpos($agent, 'ipad')){
		$type = 'ios';
	}
	if(strpos($agent, 'android')){
		$type = 'android';
	}
	return $type;
}
//判断手机电脑访问
function check_wap() { 
if (isset($_SERVER['HTTP_VIA'])) return true; 
if (isset($_SERVER['HTTP_X_NOKIA_CONNECTION_MODE'])) return true; 
if (isset($_SERVER['HTTP_X_UP_CALLING_LINE_ID'])) return true; 
if (strpos(strtoupper($_SERVER['HTTP_ACCEPT']),"VND.WAP.WML") > 0) { 
// Check whether the browser/gateway says it accepts WML. 
$br = "WML"; 
} else { 
$browser = isset($_SERVER['HTTP_USER_AGENT']) ? trim($_SERVER['HTTP_USER_AGENT']) : ''; 
if(empty($browser)) return true; 
$mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ'); 
$mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod'); 
$found_mobile=checkSubstrs($mobile_os_list,$browser) || 
checkSubstrs($mobile_token_list,$browser); 
if($found_mobile) 
$br ="WML"; 
else $br = "WWW"; 
} 
if($br == "WML") { 
return true; 
} else { 
return false; 
} 
}
//配合上一个函数定义，精确判定为手机还是电脑 
function checkSubstrs($list,$str){ 
$flag = false; 
for($i=0;$i<count($list);$i++){ 
if(strpos($str,$list[$i]) > 0){ 
$flag = true; 
break; 
} 
} 
return $flag; 
} 
//函数嵌套调用
if(check_wap()){ 

if(get_device_type()=='ios'){
	header("Location:flow.php?step=checkout");
	exit;
}
if(get_device_type()=='android'){
header("Location:flow.php?step=checkout");
exit;
}

}
else{ 
header("Location:flow.php?step=checkout");
	exit;
} 
?>