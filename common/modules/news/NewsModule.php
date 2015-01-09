<?php

namespace bioengine\common\modules\news;

use bioengine\common\components\BioModule;
use bioengine\common\components\MenuBuilder;

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

    protected function registerMenu()
    {
        $items = [];
        $items[] = MenuBuilder::createMenuItem(
            'news/index',
            [],
            'Список новостей'
        );
        $items[] = MenuBuilder::createMenuItem(
            'news/index/create',
            [],
            'Добавить новость'
        );
        MenuBuilder::registerMenu(
            'news',
            'Новости',
            $items,
            20,
            'fa-newspaper-o'
        );
    }
}
