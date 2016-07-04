<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'LaoHu',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => '/core/default/error',//挪地方了
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
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['Guest'],
        ],
        'formatter' => [
            'dateFormat' => 'php:Y-m-d',
            'datetimeFormat' => 'php:Y-m-d H:i:s',
        ],
    ],
    'params' => $params,
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'defaultRoute' => '/portal/article',
    'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module',
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'idField' => 'user_id',
                    'searchClass' => 'app\models\search\UserSearch',
                ]
            ],
        ],
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/redactor',
            'uploadUrl' => '@web/redactor',
            'imageAllowExtensions' => ['jpg', 'png', 'gif'],
            'widgetClientOptions' => [
                'minHeight' => 300,
                'maxHeight' => 600,
            ],
        ],
        //封装和继承一些代码的地方
        'core' => [
            'class' => 'app\modules\core\Module',
        ],
        //后台
        'manage' => [
            'class' => 'app\modules\manage\Module',
        ],
        //前台用户用到的，比如登录、登出、注册、找回密码、修改密码什么的
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        //前台
        'portal' => [
            'class' => 'app\modules\portal\Module',
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'debug/*',
//            'gii/*',
//            'admin/*',
            'redactor/*',
            'core/*',
            'portal/*',
            'user/*',
        ]
    ],
];

/**
 * TODO 因为后台菜单需要，所以需要把站点根目录设置为/web，apache需要开启rewrite，nginx还没用过，自行解决吧，以后再考虑如何处理这个问题。
 */
$config['components']['urlManager'] = [
    'enablePrettyUrl' => true,
    'showScriptName' => false,

    'rules' => [
        'login' => '/user/default/login',
        'logout' => '/user/default/logout',
        'register' => '/user/default/register',
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => [
            '::1',
            '127.0.0.1',
            '192.168.*.*',
        ],
    ];
    if (isset($_SERVER['HTTP_LaoHu'])) {
        $config['modules']['debug']['allowedIPs'] = ['*.*.*.*'];
    };

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
