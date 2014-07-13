<?php

namespace bioengine\common\components;

use bioengine\common\helpers\UrlHelper;
use yii\base\BootstrapInterface;
use yii\base\Module;
use yii\web\Application;

/**
 * Class CGModule
 *
 * @package common\components
 */
abstract class BioModule extends Module implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        //if ($app instanceof Application) {
        $path = $this->getRulesPath();
        if (file_exists($path)) {
            $rules = require_once($path);
            UrlHelper::addRules($rules);
        }
        //}

        //TODO: register menu

    }

    abstract protected function getRulesPath();
}
