<?php
namespace bioengine\common\helpers;


use bioengine\common\modules\ipb\models\IpbMember;

/**
 * Class UserHelper
 * @package bioengine\common\helpers
 */
class UserHelper
{

    /**
     * @return IpbMember
     */
    public static function getUser()
    {
        return \Yii::$app->user->identity;
    }

    /**
     * @return int
     */
    public static function getSessionId()
    {
        return (int)\Yii::$app->request->cookies['session_id'];
    }
}