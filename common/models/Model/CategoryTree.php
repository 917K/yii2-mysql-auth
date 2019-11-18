<?php

namespace common\models\Model;

class CategoryTree extends \yii\db\ActiveRecord
{

    /**
     * @var int
     * @desc тип элемента (Модель, Семейство, Поколение)
     */
    protected $item_type;

    /**
     * @var int
     * @desc уровень вложенности элемента
     */
    protected $item_level;

    /**
     * @var int
     * @desc id элемента
     */
    protected $item_id;
}
