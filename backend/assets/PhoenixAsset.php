<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/9/15
 * Time: 12:10 PM
 */

namespace bioengine\backend\assets;


use yii\web\AssetBundle;

class PhoenixAsset extends AssetBundle
{
    public $sourcePath = '@appBower/phoenix';
    public $js = [
        'jquery.phoenix.min.js',
    ];
}