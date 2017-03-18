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
    /*public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            return Yii::$app->user->loginRequired();
        }

        if (!parent::beforeAction($action)) {
            return false;
        }

        return true;
    }*/

    public function checkAccess()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->user->setReturnUrl(Yii::$app->controller->route);
            return Yii::$app->user->loginRequired();
        }
    }

    public function actionIndex()
    {
        $this->checkAccess();
        return $this->render('index');
    }

    public function actionProfile()
    {
        return $this->render('profile');
    }

    public function actionSettings()
    {
        $this->checkAccess();
        return $this->render('settings');
    }
}
