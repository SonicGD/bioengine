<?php
/**
 * Created by PhpStorm.
 * User: Георгий
 * Date: 10.12.2014
 * Time: 18:59
 */

namespace bioengine\backend\assets;


class BootstrapPluginAsset extends \yii\bootstrap\BootstrapPluginAsset
{
    public $sourcePath = '@appBower/bootstrap/dist';
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
    ];
}