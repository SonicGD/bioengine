<?php
/**
 * Created by PhpStorm.
 * User: Георгий
 * Date: 10.12.2014
 * Time: 16:05
 */

namespace bioengine\backend\assets;


class YiiAsset extends \yii\web\YiiAsset {
    public $depends = [
        JqueryAsset::class
    ];
}