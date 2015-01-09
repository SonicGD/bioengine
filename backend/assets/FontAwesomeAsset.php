<?php

namespace bioengine\backend\assets;


use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@appBower/components-font-awesome';
    public $css = [
        'css/font-awesome.min.css',
    ];
}