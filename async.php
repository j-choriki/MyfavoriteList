<?php 

const API_KEY = 'df4f4aa3c83a7002';
header('Access-Control-Allow-Origin: *');
header("Content-type: application/xml; charset=UTF-8");

//送信されてきたデータの受け取り
$request = json_decode(file_get_contents('php://input'),true);

$lat = $request['lat'];     //緯度
$lng = $request['lng'];     //経度
$range = $request['range']; //検索範囲


//非同期するurlの生成
$HotPepperAPI = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/';
$HotPepperAPI .= '?key='.API_KEY;
$HotPepperAPI .= '&lat=' . $lat;
$HotPepperAPI .= '&lng=' . $lng;
$HotPepperAPI .= '&range=' . $range;



$xml = file_get_contents($HotPepperAPI);
echo $xml;
exit;


?>