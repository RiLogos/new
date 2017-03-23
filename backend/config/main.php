<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['logs','rbac'],
    'language' => 'en',
    'sourceLanguage' => 'en-US',
    'timeZone' => 'America/New_York',
    'modules' => [
        'logs' => [
            'class' => 'logs\Module',
        ],
        'rbac' => [
            'class' => 'rbac\Module',
            'userClass' => 'backend\models\admin\Admin'
        ],
    ],
    //connect check access roles
//    'as access' => [
//        'class' => 'backend\modules\rbacAdmin\components\AccessControl',
//        'allowActions' => [
//            'site/*',
//            'site/signup',
//            'debug/*'
//        ]
//    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\admin\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['Admin'],
            'db'=>'db_admin'
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<_c:[\w\-]+>/page/<page:\d+>' => '<_c>/index',
                '<_c:[\w\-]+>' => '<_c>/index',
                '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w\-]+>/<_a:update|delete>/<id:\d+>' => '<_c>/<_a>',
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => ['@app/themes/prepro/views',],
                    '@app/widgets' => ['@app/themes/prepro/widgets']
                ],
                'basePath' => '@webroot/themes/prepro',
                'baseUrl' => '@web/themes/prepro',
            ],
        ],
        'db_admin' => require(__DIR__ . '/db-local.php'),
    ],
    'params' => $params,
];
