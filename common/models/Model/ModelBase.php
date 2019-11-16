<?php

namespace common\models\Model;

abstract class ModelBase extends \yii\db\ActiveRecord
{
    /**
     * @desc модель высшего уровня, которая показывается в выдаче Марки
     */
    const LEVEL_1 = 1;
    
    /**
     * @desc модель, которая показывается в выдаче Семейства моделей
     */
    const LEVEL_2 = 2;
    
    /**
     * @desc модель низшего уровня, которая показывается в выдаче Поколения модели
     */
    const LEVEL_3 = 3;

    /**
     * @desc Модель двигателя
     */
    const TYPE_ENGINE = 1;

    /**
     * @desc Модель коробки передач
     */
    const TYPE_GEARBOX = 2;

    /**
     * @desc Модель легкового автомобиля
     */
    const TYPE_CAR = 3;

    /**
     * @desc черновик модели
     */
    const RECORD_STATUS_DRAFT = 1;

    /**
     * @desc новая опубликованная модель без голосов
     */
    const RECORD_STATUS_NEEDS_VOTE = 2;

    /**
     * @desc требуются небольшие изменения
     */
    const RECORD_STATUS_NEEDS_MINOR_CHANGES = 3;

    /**
     * @desc требуются значительные изменения
     */
    const RECORD_STATUS_NEEDS_MAJOR_CHANGES = 4;

    /**
     * @desc требуются значительные изменения
     */
    const RECORD_STATUS_ENTIRELY_INCORRECT = 5;

    /**
     * @var int
     * @desc уровень вложенности модели
     */
    protected $nested_level;

    /**
     * @var int
     * @desc тип модели
     */
    protected $type;

    /**
     * @var int
     */
    protected $model_id;

    /**
     * @var int
     * @desc год начала производства
     */
    protected $start_year;

    /**
     * @var string
     * @desc дата начала производства в формате yyyy-mm-dd
     */
    protected $start_date;

    /**
     * @var int
     * @desc год конца производства
     */
    protected $end_year;

    /**
     * @var string
     * @desc дата конца производства в формате yyyy-mm-dd
     */
    protected $end_date;

    /**
     * @var int
     * @desc статус модели
     */
    protected $record_status;

    /**
     * @var string
     * @desc название модели
     */
    protected $name;

    /**
     * @var int
     * @desc id Поколения
     */
    protected $generation_id;

    /**
     * @var int
     * @desc id Семейства
     */
    protected $family_id;


    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            $this->nested_level = static::LEVEL_1;
            $this->record_status = static::RECORD_STATUS_DRAFT;
        }

        return true;
    }

    /**
     * @return bool
     * @desc транспортное средство?
     */
    abstract public function isVehicle();

    /**
     * @return int
     * @desc тип модели
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     * @desc статус модели
     */
    public function getRecordStatus()
    {
        return $this->record_status;
    }

    /**
     * @return int
     * @desc название модели
     */
    public function getName()
    {
        return $this->name;
    }
}
