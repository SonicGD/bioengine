<?php

namespace bioengine\common\components;


use yii\db\ActiveRecord;

class BioActiveRecord extends ActiveRecord
{
    public function getPublicUrl($absolute = false)
    {
        return $absolute;
    }
} 