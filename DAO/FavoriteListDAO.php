<?php

require_once './config.php';

class FavoriteListDAO{
    private $dsn = 'mysql:host=' . HOST . ';dbname=' . DB_NAME;
    private $username = USER_ID;
    private $password = PASSWORD;
    private $db;

    public function __construct() {
        $this->db = new PDO($this->dsn, $this->username, $this->password);
    }

    /**
     * お気に入り登録されているレストランidを取得する
     */
    public function get_restrant_id($mail){
        $sql = "SELECT * FROM member WHERE mail = :mail";

        try{
            //member_idを取得する
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $member_id = $result['id'];

            $sql = "SELECT * FROM favorite_list WHERE member_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $member_id);
            $stmt->execute();
            $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }
        catch (PDOException $e) {
            print('Error:' . $e->getMessage());
            die();
        }
    }
}

?>