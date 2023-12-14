<?php

namespace App\RMVC\Route;

class Route
{
    private static array $routesGet = [];
    private static array $routesPost = [];

    /**
     * @return array
     */
    public static function getRoutesPost(): array
    {
        return self::$routesPost;
    }

    /**
     * @return array
     */
    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }
    public static function get(string $route, array $controller): RouteConfiguration
    {
        $route_configuration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesGet[] = $route_configuration;
        return $route_configuration;
    }

    public static function post(string $route, array $controller): RouteConfiguration
    {
        $route_configuration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesPost[] = $route_configuration;
        return $route_configuration;
    }

    public static function redirect($url)
    {
        header('Location: ' . $url);
    }
}