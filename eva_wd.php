<?php
$email = $argv[2];
if($argv[1]=="y") login($email);
echo withdraw($argv[3]);

function login($email){
	@unlink("cookies_eva_wd.txt");
    $c = curl("account/loginconfirm", "email=$email&password=Asdqwe123@");
    return $c;
}

function withdraw($addr){
	$c = curl("panel/withdraw/sendtoken", "wallet=$addr", "redirect_url");
	return $c;
}

function curl($path, $body = false, $rbody = "http_code"){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://evadore.io/carboneva/'.$path);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if($body){
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    }
    $headers = array();
    $headers[] = 'Host: evadore.io';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/116.0';
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8';
    $headers[] = 'Accept-Language: id,en-US;q=0.7,en;q=0.3';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies_eva_wd.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies_eva_wd.txt");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_exec($ch);
    $result = curl_getinfo($ch)["$rbody"];
    return $result;
}