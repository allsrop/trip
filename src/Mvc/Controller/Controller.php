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
    private $action = 'insertPlan';
    // 建構函式
    // 初始化要執行的動作以及物件
    public function __construct()
    {
        $this->Model = new Model();
        $this->gtPost = $this->getPost();
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
        if (isset($tripData)) {
            return $tripData;
        }else{
            $sql_query = "select * from plan";
            var_dump($sql_query);
            $result = mysql_query($sql_query) or die('MySQL query error');
            return $result;
        }
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
        $this->Model->delPlan($this->gtPost);
        $this->uniquePlanLists();
        //View::editPlan('index.php');
    }
    //*刪除plan資料
    public function delPlan(){
        $this->Model->delPlan($this->gtPost);
        $this->planLists();
        //View::delPlan('index.php');
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
    //*單一計畫總覽
    public function browsePlan(){
        $PlanItemId = $this->Model->uniquePlanItemLists();
        var_dump($this->Model->uniquePlanItemLists());
        var_dump($PlanItemId);
        View::browsePlan($PlanItemId);
    }
}