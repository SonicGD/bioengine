<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/17/15
 * Time: 4:01 PM
 */

namespace bioengine\common\modules\files\controllers\backend;


use elFinder;
use elFinderConnector;
use yii\web\Controller;

class UploadsController extends Controller
{
    public function actionList()
    {
        \Yii::$app->request->enableCsrfValidation = false;
        $opts = array(
            // 'debug' => true,
            'roots' => array(
                array(
                    'driver' => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
                    'path'   => '/var/www/biowareru/files/',         // path to files (REQUIRED)
                    'URL'    => '/', // URL to files (REQUIRED)
                )
            )
        );

// run elFinder
        $connector = new elFinderConnector(new elFinder($opts));
        $connector->run();
    }
}