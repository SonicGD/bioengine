<?php

namespace bioengine\common\helpers;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\web\UrlRule;
use yii\web\UrlRuleInterface;

/**
 * Class UrlHelper
 *
 * @package common\helpers
 */
class UrlHelper
{

    const VERBS = 'GET|HEAD|POST|PUT|PATCH|DELETE|OPTIONS';

    public static function getHost($url)
    {
        $result = parse_url($url);
        $host = isset($result['host']) ? $result['host'] : "";

        return $host;
    }

    public static function getPath($url)
    {
        $result = parse_url($url);
        $path = (isset($result['path']) ? $result['path'] : "/") . (isset($result['query']) ? '?' . $result['query'] : '');

        return $path;
    }

    /**
     * Parse a pattern and create a UrlRule object.
     * Refactored from compileRules().
     *
     * @param $pattern
     * @param $route
     *
     * @throws InvalidConfigException
     * @return UrlRule
     */
    public static function parseRule($pattern, $route)
    {
        if (!is_array($route)) {
            $route = ['route' => $route];
            if (preg_match(
                '/^((?:(' . self::VERBS . '),)*(' . self::VERBS . '))\\s+(.*)$/',
                $pattern,
                $matches
            )
            ) {
                $route['verb'] = explode(',', $matches[1]);
                $route['mode'] = UrlRule::PARSING_ONLY;
                $pattern = $matches[4];
            }
            $route['pattern'] = $pattern;
        }
        $route = \Yii::createObject(array_merge(\Yii::$app->urlManager->ruleConfig, $route));
        if (!$route instanceof UrlRuleInterface) {
            throw new InvalidConfigException('URL rule class must implement UrlRuleInterface.');
        }

        return $route;
    }

    /**
     * Adds rules to the UrlManager.
     * Refactored from compileRules() to allow simple addition of rules by modules
     * after the configuration has been loaded.
     *
     * @param array $rules
     * @param bool  $addToBottom
     */
    public static function addRules($rules, $addToBottom = false)
    {
        $newRules = [];
        foreach ($rules as $pattern => $rule) {
            $newRules[] = self::parseRule($pattern, $rule);
        }
        if ($addToBottom) {
            \Yii::$app->urlManager->rules = ArrayHelper::merge(\Yii::$app->urlManager->rules, $newRules);
        } else {
            \Yii::$app->urlManager->rules = ArrayHelper::merge($newRules, \Yii::$app->urlManager->rules);
        }
    }

    /**
     * @return string
     */
    public static function getCurrentUrl()
    {
        $route = \Yii::$app->requestedRoute;
        $params = [$route];
        $exclude = ['url', 'app_request', 'firstLoad', 'currentProjectId', 'currentUserId'];
        foreach (\Yii::$app->request->get() as $name => $value) {
            if (!in_array($name, $exclude)) {
                $params[$name] = $value;
            }
        }

        return \Yii::$app->urlManager->createAbsoluteUrl($params);
    }
}
