<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/9/15
 * Time: 12:10 PM
 */

namespace bioengine\backend\assets;


use yii\web\JqueryAsset;

class PhoenixAsset extends JqueryAsset
{
    public $sourcePath = '@appBower/phoenix';
    public $js = [
        'jquery.phoenix.min.js',
    ];
}