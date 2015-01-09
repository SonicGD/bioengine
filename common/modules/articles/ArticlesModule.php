<?php

namespace bioengine\common\modules\articles;

use bioengine\common\components\BioModule;
use bioengine\common\components\MenuBuilder;

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
        $items = [];
        $items[] = MenuBuilder::createMenuItem(
            'articles/index',
            [],
            'Список статей'
        );
        $items[] = MenuBuilder::createMenuItem(
            'articles/index/create',
            [],
            'Добавить статью'
        );
        $items[] = MenuBuilder::createMenuItem(
            'articles/cats',
            [],
            'Список категорий'
        );
        $items[] = MenuBuilder::createMenuItem(
            'articles/cats/create',
            [],
            'Добавить категорию'
        );
        MenuBuilder::registerMenu(
            'articles',
            'Статьи',
            $items,
            20,
            'fa-list'
        );
    }
}
