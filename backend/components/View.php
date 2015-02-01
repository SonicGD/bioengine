<?php

namespace bioengine\components;

use bioengine\common\components\BackendController;

/**
 * Class View
 * @package bioengine\components
 */
class View extends \yii\web\View
{
    /**
     * @var BackendController
     */
    public $context;
}