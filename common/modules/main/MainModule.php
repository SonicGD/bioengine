<?php

namespace bioengine\common\modules\main;

use bioengine\common\components\BioModule;
use bioengine\common\components\MenuBuilder;

/**
 * Class ArticlesModule
 * @package bioengine\common\modules\main
 */
class MainModule extends BioModule
{
    public $controllerNamespace = 'bioengine\common\modules\main\controllers\backend';

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
        //devs
        $items = [];
        $items[] = MenuBuilder::createMenuItem(
            'main/developers',
            [],
            'Список разработчиков'
        );
        $items[] = MenuBuilder::createMenuItem(
            'main/developers/create',
            [],
            'Добавить разработчика'
        );
        MenuBuilder::registerMenu(
            'developers',
            'Разработчики',
            $items,
            10,
            'fa-group'
        );
        //games
        $items = [];
        $items[] = MenuBuilder::createMenuItem(
            'main/games',
            [],
            'Список игр'
        );
        $items[] = MenuBuilder::createMenuItem(
            'main/games/create',
            [],
            'Добавить игру'
        );
        MenuBuilder::registerMenu(
            'games',
            'Игры',
            $items,
            11,
            'fa-gamepad'
        );
    }
}
