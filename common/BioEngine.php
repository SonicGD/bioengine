<?php

namespace bioengine\common;

use bioengine\common\modules\main\models\Game;
use yii\web\Application;

class BioEngine extends Application
{
    /**
     * @var Gamse[]
     */
    public $games = [];

    public function createControllerByID($id)
    {
        $controller = parent::createControllerByID($id);
        if (!$controller) {
            $this->controllerNamespace = \Yii::$app->params['baseControllerNamespace'];
            $controller = parent::createControllerByID($id);
        }

        return $controller;
    }

} 