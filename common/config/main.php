<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'en',
    'sourceLanguage' => 'en-US',
    'timeZone' => 'America/New_York',
    'components' => [
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
        ],
        'mail' => [
            'class' => 'common\components\mail\Mail',
        ],
        'status'=>[
            'class' => 'common\components\status\Status'
        ],
        'encrypt' => [
            'class'=>'common\components\encrypt\Encrypt',
            'secret_key' => 'token'
        ],
    ],
    'as dependency' => [
        'class' => 'common\components\dependency\Dependency',
        'dependency' => [
            'common\components\encrypt\interfaces\EncryptInterface' => 'common\components\encrypt\Encrypt',
            'common\components\mail\interfaces\SendMailInterface' => 'common\components\mail\SendMail',
            'common\components\mail\interfaces\MailReportInterface' => 'common\components\mail\MailReport'
        ]
    ],
];
