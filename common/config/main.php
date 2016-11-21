<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'right-menu', //'left-menu', //'top-menu', //'@app/views/layouts/user_login',
            'mainLayout' => '@app/views/layouts/main.php',
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['admin/user/login'],
        ],
    ],
];
