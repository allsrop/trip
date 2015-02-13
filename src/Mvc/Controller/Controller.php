<?php
namespace Mvc\Controller;

session_start();

use Mvc\Model\Model;
use Mvc\View\View;

class Controller
{
    // 共用的物件
    private $Model = NULL;

    private $gtPost = NULL;
    // 使用者選擇的動作
    private $action = 'createPlan';
    // 建構函式
    // 初始化要執行的動作以及物件
    public function __construct()
    {
        $this->Model = new Model();
        $this->gtPost=$this->getPost();
    }
    //取得POST值
    public function getPost()
    {
        foreach ($_POST as $key => $value)
        {
            $_POST[$key] = trim($value);
        }
        $tripData = array();
        if (isset($_POST['title'])) {
            $tripData['title'] = $_POST['title'];
        }
        if (isset($_POST['introduction'])) {
            $tripData['introduction'] = $_POST['introduction'];
        }
        if (isset($_POST['nop'])) {
            $tripData['nop'] = $_POST['nop'];
        }
        if (isset($_POST['startDate'])) {
            $tripData['startDate'] = $_POST['startDate'];
        }
        if (isset($_POST['endDate'])) {
            $tripData['endDate'] = $_POST['endDate'];
        }
        if (isset($_POST['description'])) {
            $tripData['description'] = $_POST['description'];
        }
        return $tripData;
    }
    public final function run()
    {
        $this->{$this->action}();
    }
    //資料建立
    public function createPlan(){
        View::createPlan('index.php');
    }
    //資料寫回
    public function write(){
        switch ($_POST['submit']) {
            case 'Go':
                if ($this->Model->createCheck($this->gtPost)) {
                    $this->createPlan();
                    echo "<h2>註冊失敗,資料重複,請重新輸入!</h2>";
                } elseif (empty($this->gtPost['ctName']) || empty($this->gtPost['ctPwd']) ) {
                    $this->createPlan();
                    echo "<h2>註冊失敗,帳號密碼請勿空白,請重新輸入!</h2>";
                } else {
                    $this->Model->create($this->gtPost);
                    //$this->login();
                }
                break;
        }
    }
}