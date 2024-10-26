<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*'],
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false, // Опционально, если нужно более строгое соответствие маршрутам
            /*
            'rules' => [
                // Правила для контроллера Languages
                'languages' => 'languages/index',              // Открывает actionIndex контроллера Languages
                'languages/<id:\d+>' => 'languages/view',      // Открывает actionView с параметром id
                'languages/create' => 'languages/create',      // Открывает actionCreate
                'languages/update/<id:\d+>' => 'languages/update', // Открывает actionUpdate с параметром id
                'languages/delete/<id:\d+>' => 'languages/delete', // Открывает actionDelete с параметром id

                // Общие правила для других страниц, если нужно
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
            */
            'rules' => [
                // Общее правило для всех CRUD-действий
                '<controller:\w+>/<action:(index|view|create|update|delete)>/<id:\d*>' => '<controller>/<action>',

                // Правила для RESTful API, если используется (например, чтобы включить пагинацию)
                ['class' => 'yii\rest\UrlRule', 'controller' => ['languages', 'another-controller']],

                // Правило по умолчанию для контроллера и действия
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
