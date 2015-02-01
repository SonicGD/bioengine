<?php

namespace bioengine\common\components;


use bioengine\common\helpers\UserHelper;
use bioengine\common\modules\ipb\models\IpbMember;
use yii\helpers\Url;

/**
 * Class BackendController
 * @package bioengine\common\components
 *
 */
class BackendController extends Controller
{

    /**
     * @var IpbMember
     */
    public $user;

    public function init()
    {
        if (\Yii::$app->user->isGuest) {
            $this->redirect(Url::toRoute('/login/index'));
        }

        $this->user = UserHelper::getUser();
    }
} 