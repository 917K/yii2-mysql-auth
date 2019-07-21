<?php
return [
    'components' => [
        'db' => [
            'dsn' => '<db_vendor>:host=<host>;dbname=<dbname>',
            'username' => '',
            'password' => '',
        ],
        'authClientCollection' => [
            'clients' => [
                /*'google' => [
                    'clientId' => 'clientId',
                    'clientSecret' => 'clientSecret',
                ],*/
                'facebook' => [
                    'clientId' => 'clientId',
                    'clientSecret' => 'clientSecret',
                ],
                /*'vkontakte' => [
                    'clientId' => 'clientId',
                    'clientSecret' => 'clientSecret',
                ],*/
            ],
        ],
    ],
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
        ],
    ],
];
