<?php

namespace bioengine\common;

use yii\web\Application;

class BioEngine extends Application
{
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