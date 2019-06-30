<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
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
    ],
];
