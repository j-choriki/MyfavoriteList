<?php
require_once './config.php';

class LoginDAO{
    private $dsn = 'mysql:host=' . HOST . ';dbname=' . DB_NAME;
    private $username = USER_ID;
    private $password = PASSWORD;
    private $db;

    public function __construct() {
        $this->db = new PDO($this->dsn, $this->username, $this->password);
    }

    /**
     * データベースにメールとパスワードが存在しているかチェック
     * 
     * @param $mail メールアドレス
     * @param $pass パスワード
     * 
     * @return $check_result trueまたはfalse
     */

    public function checkAcount($mail,$pass){
        $sql = "SELECT EXISTS(SELECT * FROM member WHERE mail = :mail) AS customer_check;";
        $check_result = true;
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $check_num = $result['customer_check'];
            if($check_num == '1'){
                $sql = 'SELECT pass FROM member WHERE mail = ?';
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(1, $mail);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $save_pass = $result['pass'];
            }else{
                $chehck_result = false;
                return $chehck_result;
            }

            //パスワードチェック
            if(password_verify($pass, $save_pass)){
                return $check_result;
            }else{
                $check_result = false;
                return $check_result;
            }
            
        } catch (PDOException $e) {
            print('Error:' . $e->getMessage());
            die();
        }
    }
}

?>