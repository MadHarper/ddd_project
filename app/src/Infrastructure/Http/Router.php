<?php declare(strict_types=1);

namespace App\Infrastructure\Http;

class Router
{
    /** @var AbstractAction[]  */
    private static $routes =[];

    private function __construct() {}
    private function __clone() {}

    public static function route($pattern, AbstractAction $action)
    {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        self::$routes[$pattern] = $action;
    }

    public static function execute(Request $request): Response
    {
        foreach (self::$routes as $pattern => $action)
        {
            if (preg_match($pattern, $request->getUri(), $params))
            {
                array_shift($params);

                return $action->handle($request);
            }
        }

        return (new Response('', 404));
    }
}