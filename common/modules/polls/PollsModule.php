<?php

namespace bioengine\common\modules\polls;

use bioengine\common\components\BioModule;
use bioengine\common\components\MenuBuilder;

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

    protected function registerMenu()
    {
        $items = [];
        $items[] = MenuBuilder::createMenuItem(
            'polls/index',
            [],
            'Список опросов'
        );
        $items[] = MenuBuilder::createMenuItem(
            'polls/index/create',
            [],
            'Добавить опрос'
        );
        MenuBuilder::registerMenu(
            'polls',
            'Опросы',
            $items,
            11,
            'fa-bar-chart '
        );
    }
}
