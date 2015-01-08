<?php

namespace bioengine\common\helpers;

/**
 * Class ArrayHelper
 * @package bioengine\common\helpers
 */
class ArrayHelper extends \yii\helpers\ArrayHelper
{
    /**
     * @param $arr
     * @param $key
     * @param $val
     */
    public static function unShiftAssoc(&$arr, $key, $val)
    {
        $arr = array_reverse($arr, true);
        $arr[$key] = $val;
        $arr = array_reverse($arr, true);
    }

}