<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_admin".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $role_id
 * @property integer $created_at
 *
 * @property UserAdminRole $role
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
    public function rules()
    {
        return [
            [['user_id', 'role_id', 'created_at'], 'required'],
            [['user_id', 'role_id', 'created_at'], 'integer'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserAdminRole::className(), 'targetAttribute' => ['role_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'role_id' => 'Role ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(UserAdminRole::className(), ['id' => 'role_id']);
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