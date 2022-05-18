<?php

namespace Khoatran\CarForRent;

use Khoatran\CarForRent\App\View;
use Khoatran\CarForRent\Request\Request;

class Route
{
    /**
     * @var array
     */
    protected static array $routes = [];

    /**
     * @param  $uri
     * @param  $callback
     * @return void
     */
    public static function get($uri, $callback): void
    {
        self::$routes['GET'][$uri] = $callback;
    }

    public static function post($uri, $callback): void
    {
        self::$routes['POST'][$uri] = $callback;
    }

    /**
     * @return mixed
     */
    public static function handle(): mixed
    {
        $request = new Request();
        $path = $request->getPath();
        $method = $request->getMethod();
        $response = self::$routes[$method][$path] ?? false;
        if (!$response) {
            View::render('_404');
            return null;
        }
        if (is_string($response)) {
            View::render($response);
            return null;
        }
        return call_user_func($response);
    }
}