<?php
/**
 * 应用入口文件
 *
 * X-wolf
 *
 * 2017/9/21
 */


// 配置本地  线上环境  1－测试　２－正式
define('APP_ENV',$_SERVER['HTTP_HOST'] == 'xingxialove.cn' ? 2 : 1 );


define('DEBUG',true);


// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
