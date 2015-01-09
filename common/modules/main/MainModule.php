<?php

namespace bioengine\common\modules\main;

use bioengine\common\components\BioModule;
use bioengine\common\components\MenuBuilder;
use yii\i18n\PhpMessageSource;

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
        \Yii::setAlias('@mainModule', dirname(__FILE__));
        \Yii::$app->i18n->translations['main*'] = [
            'class'            => PhpMessageSource::className(),
            'basePath'         => '@mainModule/messages',
            'forceTranslation' => true,
            'sourceLanguage'   => 'ru',
            'fileMap'          => [
                'main/developers' => 'developers.php',
            ],
        ];
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
        //topics
        $items = [];
        $items[] = MenuBuilder::createMenuItem(
            'main/topics',
            [],
            'Список тем'
        );
        $items[] = MenuBuilder::createMenuItem(
            'main/topics/create',
            [],
            'Добавить тему'
        );
        MenuBuilder::registerMenu(
            'topics',
            'Темы',
            $items,
            11,
            'fa-comments'
        );
    }
}
