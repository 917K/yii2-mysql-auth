<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $newPasswordRepeat;
    protected $_identity;


    public function __construct($config = [])
    {
        $this->_identity = Yii::$app->getUser()->getIdentity();
        parent::__construct($config);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['oldPassword', 'required'],
            ['oldPassword', 'validateOldPassword'],

            ['newPassword', 'required'],
            ['newPassword', 'string', 'min' => 6],
            ['newPassword', 'compare', 'compareAttribute' => 'oldPassword', 'operator' => '!='],

            ['newPasswordRepeat', 'required'],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    public function changePassword()
    {
        $user = $this->getIdentity();
        $user->setPassword($this->newPassword);
        $user->removePasswordResetToken();

        return $user->save(false);
    }

    public function getIdentity()
    {
        return $this->_identity;
    }

    public function validateOldPassword($attribute, $params)
    {
        if(!$this->getIdentity()->validatePassword($this->$attribute)) {
            $this->addError($attribute, 'Current password is incorrect.');
        }
    }
}
