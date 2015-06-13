<?php

namespace bioengine\common\modules\news;

use bioengine\common\components\BioModule;
use bioengine\common\components\MenuBuilder;

/**
 * Class NewsModule
 * @package bioengine\common\modules\artciles\news
 */
class NewsModule extends BioModule
{
//    public $controllerNamespace = 'bioengine\common\modules\news\controllers\backend';

    public function init()
    {
        parent::init();
        $this->controllerNamespace = 'bioengine\common\modules\news\controllers\\' . BIO_ENV;
    }

    /**
     * @return string
     */
    protected function getRulesPath()
    {
        return __DIR__ . "/config/rules.php";
    }

    protected function registerMenu()
    {
        $items = [];
        $items[] = MenuBuilder::createMenuItem(
            'news/index',
            [],
            'Список новостей'
        );
        $items[] = MenuBuilder::createMenuItem(
            'news/index/create',
            [],
            'Добавить новость'
        );
        MenuBuilder::registerMenu(
            'news',
            'Новости',
            $items,
            20,
            'fa-newspaper-o'
        );
    }

    public function createController($route)
    {
        if ($route === '') {
            $route = $this->defaultRoute;
        }

        // double slashes or leading/ending slashes may cause substr problem
        $route = trim($route, ' / ');
        if (strpos($route, '//') !== false) {
            return false;
        }

        if (strpos($route, '/') !== false) {
            list ($id, $route) = explode('/', $route, 2);
        } else {
            $id = $route;
            $route = '';
        }

// module and controller map take precedence
        if (isset($this->controllerMap[$id])) {
            $controller = Yii::createObject($this->controllerMap[$id], [$id, $this]);

            return [$controller, $route];
        }
        $module = $this->getModule($id);
        if ($module !== null) {

            return $module->createController($route);
        }

        if (($pos = strrpos($route, '/')) !== false) {
            $id .= '/' . substr($route, 0, $pos);
            $route = substr($route, $pos + 1);
        }
        $controller = $this->createControllerByID($id);
        if ($controller === null && $route !== '') {
            $controller = $this->createControllerByID($id . '/' . $route);
            $route = '';
        }

        return $controller === null ? false : [$controller, $route];
    }
}
