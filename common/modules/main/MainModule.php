<?php

namespace bioengine\common\modules\main;

use bioengine\common\BioEngine;
use bioengine\common\components\BioModule;
use bioengine\common\components\MenuBuilder;
use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\Topic;
use yii\i18n\PhpMessageSource;

/**
 * Class ArticlesModule
 * @package bioengine\common\modules\main
 */
class MainModule extends BioModule
{
    public $controllerNamespace = 'bioengine\common\modules\main\controllers\backend';

    public function bootstrap($app)
    {
        parent::bootstrap($app);
        $games = Game::find()->indexBy('url')->all();
        $developers = Developer::find()->indexBy('url')->all();
        $topics = Topic::find()->indexBy('url')->all();
        BioEngine::getInstance()->setGames($games);
        BioEngine::getInstance()->setDevelopers($developers);
        BioEngine::getInstance()->setTopics($topics);
    }

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
