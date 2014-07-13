<?php

namespace bioengine\common\modules\news;

use bioengine\common\components\BioModule;

/**
 * Class NewsModule
 * @package bioengine\common\modules\artciles\news
 */
class NewsModule extends BioModule
{
    public $controllerNamespace = 'bioengine\common\modules\news\controllers\backend';

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
