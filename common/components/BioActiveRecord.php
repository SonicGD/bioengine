<?php

namespace bioengine\common\components;


use sitkoru\cache\ar\ActiveRecordTrait;
use yii\db\ActiveRecord;

class BioActiveRecord extends ActiveRecord
{
    use ActiveRecordTrait;

    public function getPublicUrl($absolute = false)
    {
        return $absolute;
    }
} 