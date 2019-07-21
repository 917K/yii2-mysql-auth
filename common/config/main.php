<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'dsn',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'on afterLogin' => function($event)
            {
                Yii::$app->user->identity->afterLogin($event);
            }
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                /*'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => 'clientId',
                    'clientSecret' => 'clientSecret',
                ],*/
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => 'clientId',
                    'clientSecret' => 'clientSecret',
                ],
                /*'vkontakte' => [
                    'class' => 'yii\authclient\clients\VKontakte',
                    'clientId' => 'clientId',
                    'clientSecret' => 'clientSecret',
                ],*/
            ],
        ],
    ],
];
