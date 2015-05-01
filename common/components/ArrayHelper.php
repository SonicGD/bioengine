<?php

namespace bioengine\common\components;

/**
 * Class ArrayHelper
 * @package bioengine\common\components
 */
class ArrayHelper
{
    /**
     * @param $arr
     * @param $key
     * @param $val
     */
    public static function arrayUnShiftAssoc(&$arr, $key, $val)
    {
        $arr = array_reverse($arr, true);
        $arr[$key] = $val;
        $arr = array_reverse($arr, true);
    }
}
