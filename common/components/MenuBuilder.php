<?php
/**
 * Created by PhpStorm.
 * User: Георгий
 * Date: 14.07.2014
 * Time: 23:47
 */

namespace bioengine\common\components;


use yii\helpers\ArrayHelper;

class MenuBuilder
{

    private static $menu = [];

    public static function registerMenu($name, $title, $items, $pos, $icon)
    {
        self::$menu[$name] = [
            'title'    => $title,
            'items'    => $items,
            'position' => $pos,
            'icon'     => $icon
        ];
    }

    /**
     * @return array
     */
    public static function getMenu()
    {
        ArrayHelper::multisort(self::$menu, "position", SORT_ASC);
        foreach (self::$menu as $name => $menuItem) {
            foreach ($menuItem['items'] as $key => $item) {
                self::$menu[$name]['active'] = self::$menu[$name]['items'][$key]['active'] = \Yii::$app->requestedRoute == $item['route'];
            }
        }
        return self::$menu;
    }

    /**
     * @param $route
     * @param $params
     * @param $title
     * @return array
     */
    public static function createMenuItem($route, $params, $title)
    {
        return [
            'title'  => $title,
            'route'  => $route,
            'params' => $params,
            'url'    => \Yii::$app->urlManager->createUrl([$route] + $params),
            'active' => false
        ];
    }
} 