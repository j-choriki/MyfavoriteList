<?php
session_start();

//半径のセレクトボックスに代入する配列を生成
$radius_ary = [
    '99' => '選択してください',
    '1' => '300m',
    '2' => '500m',
    '3' => '1000m',
    '4' => '2000m',
    '5' => '3000m'
];

if(isset($_GET['send']) && $_GET['send'] =='logout'){
    $_SESSION = [];
}


//ログイン状態か確認
$user_mail= '';
if(isset($_SESSION['mail'])){
    $user_mail = $_SESSION['mail'];
}








//viewの読み込み
require_once './tpl/index_v.php';
?>