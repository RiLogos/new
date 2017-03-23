<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'rbac', 'logs'],
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'db' => 'db_admin',
            'assignmentTable'=> '{{%auth_assignment}}',
            'itemChildTable'=> '{{%auth_item_child}}',
            'itemTable'=> '{{%auth_item}}',
            'ruleTable'=> '{{%auth_rule}}',
            'defaultRoles' => ['Admin'],
        ],
        'db_admin' => require(__DIR__ . '/db-local.php'),
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'migration_admin',
            'db'=>'db_admin',
        ],
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'backend\fixtures',
        ],
    ],
    'modules' => [
        'logs' => [
            'class' => 'logs\Module',
        ],
        'rbac' => [
            'class' => 'rbac\Module',
            'userClass' => 'backend\models\admin\Admin',
        ],
    ],
    'params' => $params,
];
