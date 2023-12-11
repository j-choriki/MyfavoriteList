<?php 
require_once './DAO/FavoriteListDAO.php';

$favorite_list_dao = new FavoriteListDAO();

session_start();
$mail = '';
//ログイン状態の確認
if(isset($_SESSION['mail'])){
    $mail = $_SESSION['mail'];

    //お気に入りのレストランリストの情報を取得
    $favorite_lists = $favorite_list_dao->get_restrant_id($mail);

    //restrant_idのみ配列へ格納
    $restrant_ids = [];
    foreach($favorite_lists as $restrant_list){
        $restrant_ids[] = $restrant_list['restrant_id'];
    }
    // データをJSON形式に変換してJSへ
    $jsonData = json_encode($restrant_ids);
    echo "<script>let restrantIds = $jsonData;</script>";
    
}


// viewの読み込み
require_once './tpl/favorite_list_v.php';
?>


