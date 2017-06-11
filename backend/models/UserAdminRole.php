<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_admin_role".
 *
 * @property integer $id
 * @property string $role
 *
 * @property UserAdmin[] $userAdmins
 */
class UserAdminRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_admin_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role'], 'required'],
            [['role'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAdmins()
    {
        return $this->hasMany(UserAdmin::className(), ['role_id' => 'id']);
    }
}