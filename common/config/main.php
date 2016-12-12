<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['debug'],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'right-menu', //'left-menu', //'top-menu',
            'mainLayout' => '@vendor/mdmsoft/yii2-admin/views/layouts/main.php',
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'loginUrl' => ['admin/user/login'],
            //'loginUrl' => ['site/login'],
        ],
    ],
];
