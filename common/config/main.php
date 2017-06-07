<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'index' => 'site/index',
                'about' => 'site/about',
                'contact' => 'site/contact',
                'login' => 'site/login',
                'logout' => 'site/logout',
                'signup' => 'site/signup',
                'my' => 'user/index',
                'my/<action>' => 'user/<action>',
                'user/<username>' => 'user/profile',
            ],
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'on afterLogin' => function($event)
            {
                Yii::$app->user->identity->afterLogin($event);
            }
        ],
    ],
];
