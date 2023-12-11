<?php
require_once './config.php';

class AysyncDAO{
    private $dsn = 'mysql:host=' . HOST . ';dbname=' . DB_NAME;
    private $username = USER_ID;
    private $password = PASSWORD;
    private $db;

    public function __construct() {
        $this->db = new PDO($this->dsn, $this->username, $this->password);
    }
    /**
     * お気に入り情報の登録
     * 
     * @param $mail メールアドレス
     * @param $restrant_id hot pepperのレストランid
     */
    public function insertHeart($mail, $restrant_id){
        $sql = "SELECT id FROM member WHERE mail = :mail";
        try{
            //member_idを取得する
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $member_id = $result['id'];

            //いいねボタンの状況を登録する
            $sql = "INSERT INTO favorite_list (restrant_id, member_id) VALUES(:restrant_id, :member_id)";
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':restrant_id', $restrant_id);
            $stmt->bindParam(':member_id', $member_id);
            $stmt->execute();
        }
        catch (PDOException $e) {
            $error = array('error' => 'SQLエラー: ' . $e->getMessage());
            $json = json_encode($error, JSON_UNESCAPED_UNICODE);
            header('Content-Type: application/json; charset=UTF-8');
            echo $json;
            exit;
        }
    }

    /**
     * お気に入り情報削除
     * @param $mail メールアドレス
     * @param $restrant_id hot pepperのレストランid
     */

    public function deleteHeart($mail, $restrant_id){
        $sql = "SELECT id FROM member WHERE mail = :mail";
        try{
            $this->db->beginTransaction();

            //member_idを取得する
            $stmt = $this->db->prepare($sql);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $member_id = $result['id'];
            
            //いいねの情報を削除
            $sql ="DELETE FROM favorite_list  WHERE restrant_id = :restrant_id AND member_id = :member_id";
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':restrant_id', $restrant_id);
            $stmt->bindParam(':member_id', $member_id);
            $stmt->execute();

            // トランザクションをコミット
            $this->db->commit();
        }
        catch (PDOException $e) {
            // エラーハンドリング
            $this->db->rollBack();
            $error = array('error' => 'SQLエラー: ' . $e->getMessage());
            $json = json_encode($error, JSON_UNESCAPED_UNICODE);
            header('Content-Type: application/json; charset=UTF-8');
            echo $json;
            exit;
        }
    }

}
?>