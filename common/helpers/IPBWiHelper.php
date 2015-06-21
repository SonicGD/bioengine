<?php

namespace bioengine\common\helpers;

use IPBWI\ipbwi;

class IPBWiHelper
{
    private static $ipbwi;

    /**
     * @return ipbwi
     */
    public static function getIpbWI()
    {
        if (!self::$ipbwi) {
            self::$ipbwi = new ipbwi();
        }
        return self::$ipbwi;
    }
}