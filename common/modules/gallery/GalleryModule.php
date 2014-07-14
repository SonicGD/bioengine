<?php

namespace bioengine\common\modules\gallery;

use bioengine\common\components\BioModule;

/**
 * Class GalleryModule
 * @package bioengine\common\modules\gallery
 */
class GalleryModule extends BioModule
{
    public $controllerNamespace = 'bioengine\common\modules\gallery\controllers\backend';

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
