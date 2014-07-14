<?php

namespace bioengine\common\modules\articles;

use bioengine\common\components\BioModule;

/**
 * Class ArticlesModule
 * @package bioengine\common\modules\articles
 */
class ArticlesModule extends BioModule
{
    public $controllerNamespace = 'bioengine\common\modules\articles\controllers\backend';

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
