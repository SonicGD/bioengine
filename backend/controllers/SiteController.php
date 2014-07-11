<?php
namespace bioengine\backend\controllers;

use bioengine\backend\components\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
