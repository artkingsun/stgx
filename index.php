<?php
header ( "Content-type:text/html;charset=utf-8" );
define('APP_PATH','./stgx/');
require('./ThinkPHP/ThinkPHP.php');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);