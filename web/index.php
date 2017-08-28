<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');
// 加入版本号
if(file_exists("e:/book_project_version")){
    define("RELEASE_VERSION",tirm( file_get_contents("e:/book_project_version")));
}else{
    define("RELEASE_VERSION",time());
}
(new yii\web\Application($config))->run();
