<?php

namespace frontend\controllers;

use yii\filters\AccessControl;
use Yii;

class UserController extends \yii\web\Controller
{
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }*/
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            return Yii::$app->user->loginRequired();
        }

        if (!parent::beforeAction($action)) {
            return false;
        }

        // other custom code here

        return true; // or false to not run the action
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionProfile()
    {
        return $this->render('profile');
    }

    public function actionSettings()
    {
        return $this->render('settings');
    }
}
