<?php

namespace frontend\controllers;

use yii\filters\AccessControl;
use Yii;
use frontend\models\ChangePasswordForm;
use frontend\models\Auth;

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

    public function actionProfile($username)
    {
        return $this->render('profile');
    }

    public function actionSettings()
    {
        $this->checkAccess();
        $userAccounts = Auth::findByUserId(Yii::$app->user->identity->id);
        $activeSocials = Yii::$app->components['authClientCollection']['clients'];

        foreach ($userAccounts as $userAccount) {
            if (isset($activeSocials[$userAccount->source])) {
                unset($activeSocials[$userAccount->source]);
            }
        }

        $tzlist = array();
        for($i = -12; $i<= 12;) {
            $tzlist[2 * $i] = $i;
            $i = $i + 0.5;
        }

        $request = Yii::$app->request;
        $changePasswordModel = new ChangePasswordForm();
        $changePasswordFormName = $changePasswordModel->formName();
        if($request->isPost) {
            if ($request->post($changePasswordFormName)) {
                if ($changePasswordModel->load($request->post()) && $changePasswordModel->validate() && $changePasswordModel->changePassword()) {
                    Yii::$app->session->setFlash('success', 'New password was saved.');
                }
            }
        }
        return $this->render('settings', [
            'timezones' => $tzlist,
            'changePasswordModel' => $changePasswordModel,
            'changePasswordFormName' => $changePasswordFormName,
            'activeSocials' => $activeSocials,
        ]);
    }
}
