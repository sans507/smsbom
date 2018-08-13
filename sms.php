<?php
// Copyright : 2k18 YarzCode
$config['header'] = explode("\n", "Host: sms.payuterus.biz
Origin: http://sms.payuterus.biz
Upgrade-Insecure-Requests: 1
Content-Type: application/x-www-form-urlencoded
User-Agent: Mozilla/5.0 (Linux; Android 7.0; Redmi Note 4 Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/67.0.3396.87 Mobile Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8
Referer: http://sms.payuterus.biz/alpha/
Accept-Language: id-ID,en-US;q=0.9
Cookie: __cfduid=da2029e6a4a3ba028bf61bad55a29135f1534156282; PHPSESSID=tcbj1q98176fo8m638qdiuinv0; _ga=GA1.2.1296921885.1534156286; _gid=GA1.2.766660894.1534156286; _gat=1
X-Requested-With: com.smsGratisSeluruhIndonesia64");

function curl($url, $strPost=0)
{
	global $config;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);

	 curl_setopt($ch, CURLOPT_HTTPHEADER, $config['header']);
	if(isset($strPost))
	{
	     curl_setopt($ch, CURLOPT_POST, 1);
	     curl_setopt($ch, CURLOPT_POSTFIELDS, $strPost);
	}
	$a = curl_exec($ch);
	curl_close($ch);

	return $a;
}
function getStr($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
$nope = 'Nomer-Target';
$set_msg = 'Dengan Menyebut Nama Allah yang maha pengasih dan penyayang';
$curl = curl("http://sms.payuterus.biz/alpha/index.php");
$ambilStr = getStr($curl,"<span>","</span>");
$strRep = str_replace(array(" ", "="), array("",""), $ambilStr);
$Captcha = $strRep[0]+$strRep[2];
$addPost = http_build_query(array("nohp" => $nope, "pesan" => $set_msg, "captcha" => $Captcha));

echo curl("http://sms.payuterus.biz/alpha/send.php", $addPost);
