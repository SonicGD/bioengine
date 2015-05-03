<?php

namespace bioengine\common;

use bioengine\common\modules\main\models\Developer;
use bioengine\common\modules\main\models\Game;
use bioengine\common\modules\main\models\Topic;
use yii\web\Application;

class BioEngine extends Application
{
    /**
     * @var Game[]
     */
    public static $games = [];
    /**
     * @var Developer[]
     */
    public static $developers = [];
    /**
     * @var Topic[]
     */
    public static $topics = [];

    public function createControllerByID($id)
    {
        $controller = parent::createControllerByID($id);
        if (!$controller) {
            $this->controllerNamespace = \Yii::$app->params['baseControllerNamespace'];
            $controller = parent::createControllerByID($id);
        }

        return $controller;
    }

    /**
     * @return BioEngine
     */
    public static function getInstance()
    {
        return \Yii::$app;
    }

    /**
     * @param $parentUrl
     * @return Game|Developer|Topic|null
     */
    public static function getParentByUrl($parentUrl)
    {
        if (array_key_exists($parentUrl, self::$games)) {
            return self::$games[$parentUrl];
        }
        if (array_key_exists($parentUrl, self::$developers)) {
            return self::$developers[$parentUrl];
        }
        if (array_key_exists($parentUrl, self::$topics)) {
            return self::$topics[$parentUrl];
        }

        return null;
    }

    public function setGames(array $games)
    {
        self::$games = $games;
    }

    public function setDevelopers(array $developers)
    {
        self::$developers = $developers;
    }

    public function setTopics(array $topics)
    {
        self::$topics = $topics;
    }

} 