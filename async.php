<?php 

//Hotpepper APIKEY
const API_KEY = 'df4f4aa3c83a7002';
header('Access-Control-Allow-Origin: *');
header("Content-type: application/xml; charset=UTF-8");

//送信されてきたデータの受け取り
$request = json_decode(file_get_contents('php://input'),true);

$lat = isset($request['lat']) ? $request['lat'] :null;                  //緯度
$lng =  isset($request['lng']) ? $request['lng'] :null;                 //経度
$range = isset($request['range']) ? $request['range'] :null;            //検索範囲
$pathName = isset($request['pathName']) ? $request['pathName'] :null;   //urlのパス
$id = isset($request['id']) ? $request['id'] : null;                    // お店のID

if($pathName == '/fenriru/'){   //index画面から応答
    //非同期するurlの生成
    $HotPepperAPI = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/';
    $HotPepperAPI .= '?key='. API_KEY;
    $HotPepperAPI .= '&lat=' . $lat;
    $HotPepperAPI .= '&lng=' . $lng;
    $HotPepperAPI .= '&range=' . $range;
}
elseif($pathName == '/fenriru/shop.php'){   //詳細画面からの応答
        //非同期するurlの生成
        $HotPepperAPI = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/';
        $HotPepperAPI .= '?key='. API_KEY;
        $HotPepperAPI .=  '&id='. $id;
}

$xml = file_get_contents($HotPepperAPI);
echo $xml;
exit;


?>