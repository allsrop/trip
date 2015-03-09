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
//*plan建立
$mux->post('/plan/new', ['Mvc\Controller\Controller', 'newPlan']);
//*plan修改
$mux->post('/plan/edit', ['Mvc\Controller\Controller', 'editPlan']);
//*plan刪除
$mux->post('/plan/del', ['Mvc\Controller\Controller', 'delPlan']);
//*plan明細
$mux->get('/plan/lists', ['Mvc\Controller\Controller', 'listsPlan']);
//*plan單一明細
$mux->get('/plan/uniqueLists', ['Mvc\Controller\Controller', 'uniqueListsPlan']);
//*plan建立檢查
$mux->post('/plan/insertCheck', ['Mvc\Controller\Controller', 'insertPlanCheck']);

////*item建立
//$mux->get('/planItem/new', ['Mvc\Controller\Controller', 'newItem']);
////*item瀏覽
//$mux->get('/planItem/lists', ['Mvc\Controller\Controller', 'listsItem']);
////*item修改
//$mux->get('/planItem/edit', ['Mvc\Controller\Controller', 'editItem']);
////*item刪除
//$mux->get('/planItem/del', ['Mvc\Controller\Controller', 'delItem']);
////*item建立檢查
//$mux->post('/plan/insertCheck', ['Mvc\Controller\Controller', 'insertCheckItem']);
//
//$mux->post('/test/plan/new', ['Mvc\Controller\Controller', 'testNewPlan']);
//
//$mux->get('/test/plan/lists', ['Mvc\Controller\Controller', 'testPlanLists']);
//
//$mux->get('/test/plan/edit', ['Mvc\Controller\Controller', 'testPlanEdit']);
//
//$mux->get('/test/plan/del', ['Mvc\Controller\Controller', 'testPlanDel']);

return $mux;
