<?php

namespace common\models\Model;

class Family extends \yii\db\ActiveRecord
{

    const LEVEL = 1;

    /**
     * @var int
     */
    protected $family_id;

    /**
     * @var string
     * @desc название Семейства
     */
    protected $name;

    /**
     * @var int
     * @desc порядковый номер / сортировка Поколения
     */
    protected $order;
}
