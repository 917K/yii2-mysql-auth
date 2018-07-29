<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_status".
 *
 * @property integer $id
 * @property string $title
 */
class UserStatus extends \yii\db\ActiveRecord
{
    const USER_STATUS_ACTIVE = 1;
    const USER_STATUS_BANNED = 2;
    const USER_STATUS_INACTIVE = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }
}