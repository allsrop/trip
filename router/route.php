<?php
/**
 * Created by PhpStorm.
 * User: cara
 * Date: 2015/1/19
 * Time: 下午 2:29
 */
require_once("vendor/autoload.php");

use Pux\Mux;

$mux = new Mux;

$mux->any('/', ['Mvc\Controller\Controller', 'run']);
//*建立
$mux->post('/insertPlan', ['Mvc\Controller\Controller', 'insertPlan']);
//*瀏覽
$mux->post('/browsePlan', ['Mvc\Controller\Controller', 'browsePlan']);
//*修改
$mux->post('/editPlan', ['Mvc\Controller\Controller', 'editPlan']);
//*刪除
$mux->post('/delPlan', ['Mvc\Controller\Controller', 'delPlan']);
//*ctList
$mux->post('/planLists', ['Mvc\Controller\Controller', 'planLists']);
//*dtList
$mux->post('/uniquePlanLists', ['Mvc\Controller\Controller', 'uniquePlanLists']);
//*檢查
$mux->post('/insertPlanCheck', ['Mvc\Controller\Controller', 'insertPlanCheck']);
return $mux;
