<?php

namespace backend\models;

use Yii;
use common\models\User;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user_admin".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $admin_role_id
 * @property string $created_at
 *
 * @property User $user
 */
class UserAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_admin';
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
            [['user_id', 'admin_role_id'], 'required'],
            [['user_id', 'admin_role_id'], 'integer'],
            [['created_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['admin_role_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdminRole::className(), 'targetAttribute' => ['admin_role_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'admin_role_id' => 'Admin Role',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(AdminRole::className(), ['id' => 'admin_role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Finds admin by user_id
     *
     * @param integer $user_id
     * @return static|null
     */
    public static function findByUserId($user_id)
    {
        return static::findOne(['user_id' => $user_id]);
    }
}