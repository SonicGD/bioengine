<?php

namespace bioengine\backend\assets;


use yii\jui\JuiAsset;
use yii\web\AssetBundle;

class ElFinderAsset extends AssetBundle
{
    public $sourcePath = '@vendor/nao-pon/elfinder-nightly';
    public $css = [
        'css/elfinder.min.css',
        'css/theme.css'
    ];

    public $js = [
        'js/elfinder.min.js'
    ];
    public $depends = [
        JuiAsset::class
    ];
}