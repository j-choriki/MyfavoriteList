<?php 
require_once './DAO/asyncDAO.php';

session_start();
if(isset($_SESSION['mail'])){
    $mail = $_SESSION['mail'];  //データの登録などで使用
}

//DB情報の操作用
$async = new AysyncDAO();

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
$btnData = isset($request['btnData']) ? $request['btnData'] : null;     //いいねボタン値 
$restrant_ids = isset($request['restrant_data']) ? $request['restrant_data'] : null; //お気に入りリストからのレストランIDの配列
$btnIdData = isset($request['btnIdData']) ? $request['btnIdData'] : null; //favoriteリストから送られてくる削除するID

//ページが読み込まれたときに取得したいAPIデータ
if($pathName == '/fenriru/index.php' || $pathName == '/fenriru/' ){   //index画面から応答
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

//ハートマークが押されたときの処理
if(isset($btnData)){
    if($btnData == '1'){//お気に入りの登録
        $result = $async->insertHeart($mail, $id);
    }else{ //0が渡ってきたらお気に入りの解除
        $result = $async->deleteHeart($mail, $id);
    }
    exit;
}

if(isset($btnIdData)){
    $result = $async->deleteHeart($mail, $btnIdData);
    $json = json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

//favoriteリストで使用
if($restrant_ids){
    //非同期するurlの生成
    $HotPepperAPI = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/';
    $HotPepperAPI .= '?key='. API_KEY;
    //idの数だけURLに追加
    foreach($restrant_ids as $id){
        $HotPepperAPI .= '&id='. $id;
    }
}

$xml = file_get_contents($HotPepperAPI);
echo $xml;
exit;


?>