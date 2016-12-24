<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableSession' => false,
            'loginUrl' => null,
            'enableAutoLogin' => false,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'v1/user',
                        'v1/feedback',
                        'v1/dados-avaliacao',
                        'v1/pesagem',
                        'v1/foto-de-progresso',
                        'v1/plano-pessoal'
                    ],
                    'pluralize' => false
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'v1/cliente',
                        'v1/objetivo',
                        'v1/exercicio'
                    ]
                ],
            ],
        ]
    ],
    'params' => $params,
];