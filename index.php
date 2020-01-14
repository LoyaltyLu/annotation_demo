<?php

$loader = require __DIR__ . "/vendor/autoload.php";


Core\Application::init($loader);

#这里借助Swoole提供的http服务，来解析路由
//$server = new  Swoole\Http\Server('0.0.0.0', 9501);

//$server->set([
//    'worker_num' => 1,
//]);
//$server->on('workerStart', function () {
//    var_dump(\Core\Route::dispatch('/index/test'));
//});
//$server->on('request', function ($request, $response) {
//    Core\Application::getBean('route');
//    var_dump(\Core\Route::dispatch($request->server['path_info']));
//});

//$server->start();

var_dump(\Core\Route::dispatch('/index/test'));