<?php
require_once './config.php';

class EntryDAO{
    private $dsn = 'mysql:host=' . HOST . ';dbname=' . DB_NAME;
    private $username = USER_ID;
    private $password = PASSWORD;
    private $db;

    public function __construct() {
        $this->db = new PDO($this->dsn, $this->username, $this->password);
    }

    /**
     * メールが登録されていないかチェック
     * 
     * @param $mail メールアドレス
     * 
     * @return $check 1か０
     */
    public function checkMail($mail){
        $sql = "SELECT EXISTS(SELECT * FROM member WHERE mail = :mail) AS check_mail;";
        try{
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $check = $result['check_mail'];
            return $check;
        }
        catch (PDOException $e) {
            print('Error:' . $e->getMessage());
            die();
        }
    }

    /**
     * メンバー登録を行う
     * 
     * @param $mail メールアドレス
     * @param $pass パスワード
     */

    public function insert_member($mail, $pass){
        $sql = "INSERT INTO member (mail, pass) VALUES(:mail, :pass)";
        try{
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':pass', $pass);
            $stmt->execute();
        }catch(PDOException $e) {
            echo 'エラー: ' . $e->getMessage();
        }
    }
}

?>