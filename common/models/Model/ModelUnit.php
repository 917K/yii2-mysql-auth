<?php

namespace common\models\Model;

class ModelUnit extends ModelBase
{

    /**
     * {@inheritdoc}
     */
    public function isVehicle()
    {
        return false;
    }
}