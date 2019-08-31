<?php

namespace common\models\Query;

/**
 * This is the ActiveQuery class for [[AuthItem]].
 *
 * @see \app\models\Auth\AuthItem
 */
class AuthItemQuery extends \yii\db\ActiveQuery
{
    public function byType($type)
    {
        return $this->andWhere(['type' => $type]);
    }

    /**
     * @inheritdoc
     * @return AuthItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AuthItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}