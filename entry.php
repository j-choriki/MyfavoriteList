<?php
require_once './class/EntryClass.php';
require_once './DAO/EntryDAO.php';

$mail_msg = '';
$pass_msg = '';
$entry_dao = new EntryDAO();


if(isset($_POST['btn']) && $_POST['btn'] == 'conf'){
    //値の受け取り
    $mail = htmlspecialchars($_POST['mail'], ENT_QUOTES, 'UTF-8');
    $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');

    $entry = new Entry($mail, $pass);

    $insert_flag = true;
    //メールアドレスチェック
    if(!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $mail)){
        $mail_msg = 'メールアドレスが正しくありません';
        $insert_flag = false;
    }elseif($entry_dao->checkMail($mail) == '1'){
        $mail_msg = 'すでにメールアドレスの登録があります';
        $insert_flag = false;
    }

    //パスワードチェック
    $min_length = 4;
    $max_length = 10;
    if(!ctype_alnum($pass)){
        $pass_msg = 'パスワードを英数字で入力してください';
        $insert_flag = false;
    }elseif(strlen($pass) <= $min_length || strlen($pass) >= $max_length){
        $pass_msg = '4~10字以内で入力してください';
        $insert_flag = false;
    }

    //メールチェックがOKの時
    if($insert_flag){
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $entry_dao->insert_member($entry->getMail(), $entry->getPass());
        
        //sessionの有効時間の延長
        ini_set('session.gc_maxlifetime', 7200);    //２時間
        ini_set('session.cookie_lifetime', 7200);   //２時間
        //セッションにメールを登録し、ログイン状態とする
        session_start();
        $_SESSION['mail'] = $entry->getMail();
        // セッションの終了
        session_write_close();
        //登録処理後はログイン状態でindexへ画面遷移
        header('location:./index.php?send=entry');
        exit;
    }

}

// viewの読み込み
require_once './tpl/entry_v.php';
?>