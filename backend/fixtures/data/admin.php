<?php

return [
    [
        'username' => 'admin',
        'password_hash' => Yii::$app->security->generatePasswordHash('111111'),
        'email' => 'admin@prepro-test.ilogos-ua.com',
        'status' => 1,
        'auth_key' => Yii::$app->security->generateRandomString(),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]
];