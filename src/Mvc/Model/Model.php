<?php
namespace Mvc\Model;

class Model
{

    private static $db = null;

    protected $status = false;

    public function __construct()
    {
        try {
            $conn = new \PDO('mysql:host=127.0.0.1;dbname=trip', 'root', '1234');
            //*錯誤處理,方式為拋出異常
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            //* 轉型utf8
            $conn->query('set character set utf8');
            self::$db = $conn;
            $this->status = true;
        } catch (PDOException $e) {
            $this->status = false;
            return;
        }
    }
    //*寫入新計畫
    public function newPlan($gtPost)
    {
        if ($this->status !== true) {
            return 'error in create!';
        }
        try{
            $this->tripData = array();
            $_title = $gtPost['title'];
            $_introduction = $gtPost['introduction'];
            $_nop = $gtPost['nop'];
            $_startDate = $gtPost['startDate'];
            $_endDate = $gtPost['endDate'];
            $_description = $gtPost['description'];
            $sql = self::$db->prepare("INSERT INTO plan (title, introduction, nop, startDate, endDate, description)
            VALUES (:title, :introduction, :nop, :startDate, :endDate, :description)");
            $sql->bindvalue (':title', $_title);
            $sql->bindvalue (':introduction', $_introduction);
            $sql->bindvalue (':nop', $_nop);
            $sql->bindvalue (':startDate', $_startDate);
            $sql->bindvalue (':endDate', $_endDate);
            $sql->bindvalue (':description', $_description);
            $this->triprData = $sql;
            return ($sql->execute()) ? '成功' : '失敗';
        }catch(PDOException $e){
            return 'error in create!';
        }
    }
}
