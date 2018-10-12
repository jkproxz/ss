<?php
$t = urlencode(urldecode($_GET['tsd']));
if ($t) {
if ($_GET['pg'])
$pp = '&start=10';
function userAgent() {
    $userAgent = 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)';
    return $userAgent;
}
/*--------------------

https://github.com/jkproxz/ss

$agent = "Mozilla/5.0(compatible; MSIE 5.01; Windows NT 5.0)";
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL,'http://www.google.com.vn/m?lr=lang_vi&cr=countryVN&tbs=ctr:countryVN,lr:lang_1vi&q='.$t.''.$pp);
curl_setopt($ch,CURLOPT_USERAGENT,$agent);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_VERBOSE,false);
curl_setopt($ch,CURLOPT_TIMEOUT,10);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
curl_setopt($ch, CURLOPT_HEADER, 1);
--------location-thi-tu-direct----curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);---------------------
$page = curl_exec($ch);
curl_close($ch);
---------------------*/
function cut($url,$cookie='',$user_agent='',$header='') {

	$matches = parse_url($url);
	$host = $matches['host'];
	$link = (isset($matches['path'])?$matches['path']:'/').(isset($matches['query'])?'?'.$matches['query']:'').(isset($matches['fragment'])?'#'.$matches['fragment']:'');
	$port = !empty($matches['port']) ? $matches['port'] : 80;
	$fp=@fsockopen($host,$port,$errno,$errval,30);
	if (!$fp) {
		$html = "$errval ($errno)<br />\n";
	} else {
		$rand_ip = rand(1,254).".".rand(1,254).".".rand(1,254).".".rand(1,254);
		$out  = "GET $link HTTP/1.1\r\n";
		$out .= "Host: $host\r\n";
		$out .= "Referer: http://www.google.com.vn\r\n";
		if($cookie) $out .= "Cookie: $cookie\r\n";
		if($user_agent) $out .= "User-Agent: ".$user_agent."\r\n";
		else $out .= "User-Agent: ".userAgent()."\r\n";
		$out .= "X-Forwarded-For: $rand_ip\r\n";
		$out .= "Via: CB-Prx\r\n";
		$out .= "Connection: Close\r\n\r\n";
		fwrite($fp,$out);
		while (!feof($fp)) {
			$html .= fgets($fp,4096);
		}
		fclose($fp);
		}
$html = html_entity_decode($html, ENT_QUOTES,'UTF-8');
return $html;
	}
	$page = cut('http://www.google.com.vn/m?lr=lang_vi&tbs=ctr:countryVN,lr:lang_1vi&q='.$t.''.$pp);
echo html_entity_decode($page, ENT_QUOTES,'UTF-8');

} else {
header("HTTP/1.1 301 Moved Permanently");
header("Cache-Control: private");
header("Content-Type: text/html");
header("Connection: Close");
exit;
}

?>
