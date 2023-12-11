<?php
session_start();
$mail = '';
if(isset($_SESSION['mail'])){
    $mail = $_SESSION['mail'];
}

//viewの表示
require_once './tpl/shop_v.php';
?>