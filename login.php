<?php
require_once './DAO/LoginDAO.php';


$msg = '';
//登録ボタンが押されたときの処理
if(isset($_POST['btn']) && $_POST['btn'] == 'login'){
    //値の受け取り
    $mail = htmlspecialchars($_POST['mail'], ENT_QUOTES, 'UTF-8');
    $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');
    //アカウントチェック
    $login_dao = new LoginDAO();
    $check = $login_dao->checkAcount($mail, $pass);
    if($check){
        //sessionの有効時間の延長
        ini_set('session.gc_maxlifetime', 7200);    //２時間
        ini_set('session.cookie_lifetime', 7200);   //２時間
        //セッションにメールを登録し、ログイン状態とする
        session_start();
        $_SESSION['mail'] = $mail;
        // セッションの終了
        session_write_close();
        //登録処理後はログイン状態でindexへ画面遷移
        header('location:./index.php?send=login');
        exit;
    }
    else{
        $msg = 'メールアドレスまたはパスワードが間違っています';
    }

}

//viewの読み込み
require_once './tpl/login_v.php';
?>