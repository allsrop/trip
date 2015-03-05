<?php
namespace Mvc\Controller;

session_start();

use Mvc\Model\Model;
use Mvc\View\View;

class Controller
{
    // 共用的物件
    private $Model = NULL;

    private static $tripData = array();
    private $gtPost = NULL;
    private $takePost = NULL;
    // 使用者選擇的動作
    private $action = 'insertPlan';
    // 建構函式
    // 初始化要執行的動作以及物件
    public function __construct()
    {
        $this->takePost = array();
        $this->Model = new Model();
        $this->gtPost = $this->getPost();
        $this->takePost = $this->takePost();
    }

    public final function run()
    {
        $this->{$this->action}();
        $this->planLists();

    }
    //*取得planPOST值
    public function getPost()
    {
        foreach ($_POST as $key => $value)
        {
            $_POST[$key] = trim($value);
        }
        $tripData = array();
        if (isset($_POST['id'])) {
            $tripData['id'] = $_POST['id'];
        }

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
    //*取得planPOST值
    public function takePost()
    {
        $Result = $this->Model->planLists();
        foreach ($Result as $key => $value)
        {
            if (is_string($value)) {
                $Result[$key] = trim($value);
            }
        }
        return $Result[$key]['id'] ;
    }
    //*plan建立檢查
    public function insertPlanCheck(){
        switch ($_POST['submit']) {
            case 'Go':
                if (empty($this->gtPost['title'])) {
                    $this->insertPlan();
                    echo "<h4 style='color:#ff171a'>建立失敗,遊記名稱請勿空白!</h4>";
                } elseif ($this->Model->insertPlanCheck($this->gtPost)) {
                    $_SESSION["title"]=$this->gtPost['title'];
                    $this->insertPlan();
                    echo "<h2 style='color:red'>資料重複,請重新輸入!</h2>";

                } else {
                    $this->Model->newPlan($this->gtPost);
                    echo "<h2>旅遊計畫：</h2>";
                    $this->uniquePlanLists();
                    echo "<h2 style='color:blue'>建立成功!</h2>";
                }
                break;
            case '編輯':
                $this->Model->editPlan($this->gtPost);
                $this->editPlan();
                break;
            case '刪除':
                $this->Model->delPlan($this->gtPost);
                $this->planLists();
                break;
        }
    }
    //*建立plan資料
    public function insertPlan(){
        View::insertPlan('index.php');
    }
    //*修改plan資料
    public function editPlan(){
        switch ($_POST['submit']) {
            case '編輯':
                $this->Model->delPlan($this->gtPost);
                $this->uniquePlanLists();
                View::editPlan('index.php');
                break;
        }
    }
    //*刪除plan資料
    public function delPlan(){
        $this->Model->delPlan($this->gtPost);
        $this->planLists();
        View::delPlan('index.php');
    }
    //*planList計畫總覽
    public function planLists(){
        $Result = $this->Model->planLists();
        View::planLists($Result);
    }
    //*uniquePlanLists單一計畫瀏覽
    public function uniquePlanLists(){
        $title=$this->gtPost['title'];
        $thisResult = $this->Model->uniquePlanLists($title);
        View::uniquePlanLists($thisResult);
    }
    //*單一計畫Item總覽
    public function browsePlan(){
        $PlanId=$this->takePost;
        $Result=$this->Model->uniquePlanItemLists($PlanId);
        var_dump($Result);
        View::browsePlan($Result);
    }
}