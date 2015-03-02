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
            return 'error in insert!';
        }
    }
    //*計畫清單
    public function planLists(){
        if ($this->status !== true) {
            return 'error';
        }
        try {
            $this->tripList = array();
            $sql = self::$db->prepare("SELECT * FROM plan");
            if ($sql->execute()) {
                $this->tripList=$sql;
                return $sql->fetchAll(\PDO::FETCH_ASSOC);
            }else{
                return 'error in lists!';
            }
        }catch(\PDOException $e){
            return 'error in lists!';
        }
    }
    public function planListss(){
        if ($this->status !== true) {
            return 'error';
        }
        try {
            $this->tripList = array();
            $sql = self::$db->prepare("SELECT * FROM plan");
            if ($sql->execute()) {
                $this->tripList=$sql;
                return $sql->fetchAll(\PDO::FETCH_ASSOC);
            }else{
                return 'error in lists!';
            }
        }catch(\PDOException $e){
            return 'error in lists!';
        }
    }
    //*單一計畫清單
    public function uniquePlanLists($title){
        if ($this->status !== true) {
            return 'error';
        }
        try {
            $this->tripList = array();
            $sql = self::$db->prepare("SELECT * FROM plan where title='".$title."'");
            if ($sql->execute()) {
                $this->tripList=$sql;
                return $sql->fetchAll(\PDO::FETCH_ASSOC);
            }else{
                return 'error in lists1!';
            }
        }catch(\PDOException $e){
            return 'error in lists2!';
        }
    }
    //*檢查建立資料是否已存在
    public function  insertPlanCheck($gtPost){
        $sql = self::$db->query("SELECT title FROM plan
        where title='".$gtPost['title']."'");
        if ($sql->fetch()) {
            return $gtPost['title'];
        } else {
            return false;
        }
    }
    //*edit
    public function editPlan($gtPost)
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
            $sql = self::$db->prepare("UPDATE trip SET title = ':title',
                                                       introduction = ':introduction',
                                                       nop = ':nop',
                                                       startDate = ':startDate',
                                                       endDate = ':endDate',
                                                       description = ':description'
                                                       WHERE title = '$_title'");
            $sql->bindvalue (':title', $_title);
            $sql->bindvalue (':introduction', $_introduction);
            $sql->bindvalue (':nop', $_nop);
            $sql->bindvalue (':startDate', $_startDate);
            $sql->bindvalue (':endDate', $_endDate);
            $sql->bindvalue (':description', $_description);
            $this->triprData = $sql;
            return ($sql->execute()) ? '成功' : '失敗';
        }catch(PDOException $e){
            return 'error in editPlan!';
        }
    }
    //del
    public function delPlan($gtPost)
    {
        if ($this->status !== true) {
            return 'error';
        }
        try{
            $this->tripData = array();
            $_title = $gtPost['title'];
            var_dump($_title);
            $sql = self::$db->prepare("DELETE FROM plan WHERE title = '$_title' ");
            $sql->bindvalue (':title', $_title);
            $this->triprData = $sql;
            return ($sql->execute()) ? '成功' : '失敗';
        }catch(PDOException $e){
            return 'error in delPlan!';
        }
    }
    //*單一計畫項目清單
    public function uniquePlanItemLists()
    {
        if ($this->status !== true) {
            return 'error';
        }
        try {
            $sql = self::$db->prepare("SELECT * FROM planitem");
            if ($sql->execute()) {
                return $sql->fetchAll(\PDO::FETCH_ASSOC);
                var_dump($sql->fetchAll(\PDO::FETCH_ASSOC));
            }else{
                return 'error in uniquePlanItemLists1!';
            }
        }catch(\PDOException $e){
            return 'error in uniquePlanItemLists2!';
        }
    }
}
