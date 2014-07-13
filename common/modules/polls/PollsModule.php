<?php

namespace bioengine\common\modules\polls;

use bioengine\common\components\BioModule;

/**
 * Class PollsModule
 * @package bioengine\common\modules\polls
 */
class PollsModule extends BioModule
{
    public $controllerNamespace = 'bioengine\common\modules\polls\controllers\backend';

    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    protected function getRulesPath()
    {
        return __DIR__ . "/config/rules.php";
    }
}
