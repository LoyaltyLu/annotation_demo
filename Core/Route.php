<?php


namespace Core;

use Annotation\Mapping\Bean;

/**
 * Class Route
 * @Bean("route")
 */
class Route
{
    /**
     * 路由属性
     * object=object
     * action=index
     * prefix=test
     * path=abc
     * */
    protected static $Routes;

    /**
     * 收集路由
     *
     * @param $prefix
     * @param $path
     * @param $handler
     * @param $action
     */
    public static function addRoute($prefix, $path, $handler, $action)
    {
        self::$Routes[] = [
            'uri' => $prefix . $path,
            'handler' => $handler,
            'action' => $action
        ];
    }

    /**
     * 路由分发
     *
     * @param $url
     *
     * @return string
     */
    public static function dispatch($url)
    {
        foreach (self::$Routes as $path) {
            if ($path['uri'] === $url) {
                //调用控制器
                $action = $path['action'];
                return $path['handler']->$action();
            }

        }
        return '';
    }

    /**
     * 获取所有路由
     * @return mixed
     */
    public static function all()
    {
        return self::$Routes;
    }
}