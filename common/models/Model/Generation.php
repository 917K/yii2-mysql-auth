<?php

namespace common\models\Model;

class Generation extends \yii\db\ActiveRecord
{

    const LEVEL = 2;
    /**
     * @var int
     */
    protected $generation_id;

    /**
     * @var string
     * @desc название Поколения
     */
    protected $name;

    /**
     * @var int
     * @desc порядковый номер / сортировка Поколения
     */
    protected $order;

    /**
     * @var int
     */
    protected $family_id;
}
