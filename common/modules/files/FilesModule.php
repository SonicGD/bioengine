<?php

namespace bioengine\common\modules\files;

use bioengine\common\components\BioModule;
use bioengine\common\components\MenuBuilder;

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
        $items = [];
        $items[] = MenuBuilder::createMenuItem(
            'files/index',
            [],
            'Список файлов'
        );
        $items[] = MenuBuilder::createMenuItem(
            'files/index/create',
            [],
            'Добавить файл'
        );
        $items[] = MenuBuilder::createMenuItem(
            'files/cats',
            [],
            'Список категорий'
        );
        $items[] = MenuBuilder::createMenuItem(
            'files/cats/create',
            [],
            'Добавить категорию'
        );
        MenuBuilder::registerMenu(
            'files',
            'Файлы',
            $items,
            20,
            'fa-file'
        );
    }
}
