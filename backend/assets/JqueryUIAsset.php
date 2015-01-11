<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/11/15
 * Time: 3:40 PM
 */

namespace bioengine\backend\assets;


use yii\web\AssetBundle;

class JqueryUIAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-ui';
    public $css = [
        'themes/ui-lightness/jquery-ui.min.css',
        'themes/ui-lightness/theme.css'
    ];
    public $js = [
        'jquery-ui.min.js'
    ];
}