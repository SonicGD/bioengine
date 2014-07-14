<?php

namespace bioengine\common\modules\files;

use bioengine\common\components\BioModule;

/**
 * Class FilesModule
 * @package bioengine\common\modules\files
 */
class FilesModule extends BioModule
{
    public $controllerNamespace = 'bioengine\common\modules\files\controllers\backend';

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

    protected function registerMenu()
    {
        // TODO: Implement registerMenu() method.
    }
}
