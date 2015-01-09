<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'kinder-menu',
    'language' => 'ru_RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '_ThpicoOqT-2wO_sk5OYknU-5NImGKCA',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'suffix' => '/', 'controller' => 'measure', ],
                ['class' => 'yii\rest\UrlRule', 'suffix' => '/', 'controller' => 'unit', ],
                ['class' => 'yii\rest\UrlRule', 'suffix' => '/', 'controller' => 'ingridient', ],
                ['class' => 'yii\rest\UrlRule', 'suffix' => '/', 'controller' => 'portion', ],
                ['class' => 'yii\rest\UrlRule', 'suffix' => '/', 'controller' => 'consist', ],
                ['class' => 'yii\rest\UrlRule', 'suffix' => '/', 'controller' => 'dish', ],
                ['class' => 'yii\rest\UrlRule', 'suffix' => '/', 'controller' => 'ingestion', ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['192.168.10.*', ],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['192.168.10.*', ],
        ];
}

return $config;
