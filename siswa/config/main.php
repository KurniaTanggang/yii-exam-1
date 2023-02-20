<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-siswa',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'siswa\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        
        'request' => [
            'csrfParam' => '_csrf-siswa',
            'class' => 'common\components\Request',
            'web' => '/siswa/web',
            'adminUrl' => '/siswa'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-siswa', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the siswa
            'name' => 'advanced-siswa',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
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
            'rules' => [],
        ],

    ],
    'as access' => [
        'class' => '\hscstudio\mimin\components\AccessControl',
        'allowActions' => [
            'gii/*',
            'site/*',
            'debug/*',
            'mimin/*', // only in dev mode
        ],
    ],
    'params' => $params,
];