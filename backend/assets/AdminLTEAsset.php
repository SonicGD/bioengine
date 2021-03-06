<?php

namespace bioengine\backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since  2.0
 */
class AdminLTEAsset extends AssetBundle
{
    public $sourcePath = '@appVendor/almasaeed2010/adminlte';
    public $css = [
        'css/ionicons.css', // THIS CHANGE
        'css/morris/morris.css', // THIS CHANGE
        'css/daterangepicker/daterangepicker-bs3.css', // THIS CHANGE
        'css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css', // THIS CHANGE
        'css/AdminLTE.css', // THIS CHANGE
    ];
    public $js = [
        'js/plugins/daterangepicker/daterangepicker.js', // THIS CHANGE
        'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js', // THIS CHANGE
        'js/plugins/iCheck/icheck.min.js', // THIS CHANGE
        'js/AdminLTE/app.js' // THIS CHANGE
    ];
    public $depends = [
        BootstrapPluginAsset::class,
        FontAwesomeAsset::class,
        ElFinderAsset::class
    ];
}