<?php


namespace bioengine\common\modules\ipb\helpers;

/**
 * Class IpbHelper
 * @package bioengine\common\modules\ipb\helpers
 */
class IpbHelper
{
    public static function parseCleanValue($val)
    {
        if (!$val) {
            return '';
        }

        $val = str_replace('&#032;', ' ', $val);

        // As cool as this entity is...

        $val = str_replace('&#8238;', '', $val);

        $val = str_replace('&', '&amp;', $val);
        $val = str_replace('<!--', '&#60;&#33;--', $val);
        $val = str_replace('-->', '--&#62;', $val);
        $val = preg_replace('/<script/i', '&#60;script', $val);
        $val = str_replace('>', '&gt;', $val);
        $val = str_replace('<', '&lt;', $val);
        $val = str_replace('"', '&quot;', $val);
        $val = str_replace("\n", '<br />', $val); // Convert literal newlines
        //$val = str_replace( "$"				, "&#036;"        , $val );
        $val = str_replace("\r", '', $val); // Remove literal carriage returns
        $val = str_replace('!', '&#33;', $val);
        $val = str_replace("'", '&#39;', $val); // IMPORTANT: It helps to increase sql query safety.

        // Ensure unicode chars are OK

        $val = preg_replace('/&amp;#([0-9]+);/s', "&#\\1;", $val);

        //-----------------------------------------
        // Try and fix up HTML entities with missing ;
        //-----------------------------------------

        $val = preg_replace("/&#(\d+?)([^\d;])/i", "&#\\1;\\2", $val);

        return $val;
    }
}