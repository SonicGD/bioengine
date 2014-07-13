<?php

namespace bioengine\common\modules\ipb;

use bioengine\common\components\BioModule;

/**
 * Class IpbModule
 * @package bioengine\common\modules\ipb
 */
class IpbModule extends BioModule
{
    public $controllerNamespace = 'bioengine\common\modules\ipb\controllers\backend';

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
