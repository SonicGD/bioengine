<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/11/15
 * Time: 2:54 PM
 */

namespace bioengine\backend\assets;


use yii\web\AssetBundle;

class ELFinderAsset extends AssetBundle
{
    public $sourcePath = '@appVendor/studio-42/elfinder/build';
    public $css = [
        'css/elfinder.min.css',
        'css/theme.css',
    ];

    public $js = [
        "js/elfinder.full.js",
        "js/i18n/elfinder.ru.js",
    ];

    public $depends = [
        JqueryUIAsset::class
    ];
}