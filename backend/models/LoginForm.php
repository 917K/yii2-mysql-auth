<?php
namespace backend\models;

use Yii;
use common\models\User;

/**
 * Admin Login form
 */
class LoginForm extends \frontend\models\LoginForm
{
    public $fromAdminPanel = true;
    public $reCaptcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(
            [
                [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => Yii::$app->params['googleRecaptchaSecret']],
                ['reCaptcha', 'required'],
            ],
            parent::rules()
        );
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username, $this->fromAdminPanel);
        }

        return $this->_user;
    }
}
