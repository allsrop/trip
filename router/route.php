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
$mux->post('/create', ['Mvc\Controller\Controller', 'create']);

$mux->post('/write', ['Mvc\Controller\Controller', 'write']);
return $mux;
