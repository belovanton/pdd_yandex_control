<?php
/**
 * php pdd_delete.php YOUR_TOKEN YOUR_DOMAIN SUBDOMAIN_FOR_ADDING CNAME_VALUE
 *  
 **/

$pdd_token= $argv[1];

$url = 'https://pddimp.yandex.ru//api2/admin/dns/add';
$header[] = "PddToken: $pdd_token";
$domain=$argv[2];
$opts=explode('&', $argv[3]);
$type=$opts[1];
$fields = array(
	'domain'=>urlencode($domain),
	'type'=>urlencode($type),
	'subdomain'=>urlencode($opts[0]),
	'content'=>urlencode($opts[2])
);
$fields_string='';
//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);
echo "create domain $domain";
var_dump ($result);
