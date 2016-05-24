<?php
/**
 * php pdd_delete.php YOUR_TOKEN YOUR_DOMAIN SUBDOMAIN_FOR_DELETE
 *  
 **/
$pdd_token=$argv[1];
$url = "https://pddimp.yandex.ru/api2/admin/dns/list?domain=".$argv[2];
$header[] = "PddToken: $pdd_token";

//open connection
$ch = curl_init();


//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);

$del=$argv[3];
//execute post
$result = curl_exec($ch);
$result=json_decode($result);
$record_id=0;
foreach ($result->records as $value) {
	if($value->subdomain==$del)
	{
		$record_id=$value->record_id;
	}
}
//close connection
curl_close($ch);








$url = 'https://pddimp.yandex.ru/api2/admin/dns/del';

$fields = array(
	'domain'=>urlencode('kt-team.de'),
	'record_id'=>urlencode($record_id)
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

var_dump ($result);

