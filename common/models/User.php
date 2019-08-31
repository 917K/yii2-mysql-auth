<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use backend\models\UserAdmin;
use common\models\UserRole;
use common\models\UserStatus;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $last_login_at
 * @property integer $role_id
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{

    public $role;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
}

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email'], 'required'],
            ['status_id', 'default', 'value' => UserStatus::USER_STATUS_ACTIVE],
            ['role_id', 'default', 'value' => UserRole::USER_ROLE_BASE],
            ['role_id', 'exist', 'targetClass' => UserRole::className(), 'targetAttribute' => ['role_id' => 'id']],
            ['status_id', 'exist', 'targetClass' => UserStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            ['role', 'default', 'value' => null],
            ['role', 'each', 'rule' => ['exist', 'targetClass' => Auth\AuthItem::className(), 'targetAttribute' => ['role' => 'name']]],
            ['role', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterLogin($event)
    {
        $event->identity->updateAttributes([
            'last_login_at' => time(),
            'status_id' => UserStatus::USER_STATUS_ACTIVE,
            'last_login_ip' => Yii::$app->request->getUserIP(),
        ]);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        return $this->updateRoles();
    }

    public function updateRoles() {
        $transaction = Auth\AuthAssignment::getDb()->beginTransaction();
        try {
            Auth\AuthAssignment::deleteAll(['user_id' => $this->id]);

            if (null !== $this->role) {
                $auth = Yii::$app->authManager;
                $roles = Auth\AuthItem::findAll($this->role);
                foreach ($roles as $role) {
                    $auth->assign($role, $this->id);
                }
            }

            $transaction->commit();
            return true;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username, $fromAdminPanel = false)
    {
        $user = static::findOne(['username' => $username]);
        /* check is admin */
        if ($fromAdminPanel && $user && !UserAdmin::findByUserId($user->id)) {
            return null;
        }
        return $user;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status_id' => UserStatus::USER_STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(UserStatus::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getRole()
    {
        return $this->hasOne(UserRole::className(), ['id' => 'role_id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Auth\AuthAssignment::className(), ['user_id' => 'id'])/*->select('item_name')*/;
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password hash',
            'password_reset_token' => 'Password reset token',
            'email' => 'Email',
            'auth_key' => 'Auth key',
            'status_id' => 'Status',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
            'last_login_at' => 'Last login at',
            'role_id' => 'Role',
            'password' => 'Password',
            'last_login_ip' => 'Last IP',
        ];
    }
}
