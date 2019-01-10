<?php

namespace oFramework;

use \AltoRouter;

class Application
{
    /**
     * @var Application
     */
    private static $instance;

    /**
     * @var AltoRouter
     */
    private $router;

    /**
     * @var boolean
     */
    private $hasRun = false;

    /**
     * @return Application
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Application;
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->router = new AltoRouter;
        $this->router->setBasePath($_SERVER['BASE_URI']);

        // Déclarer les routes
        $this->mapRoutes();
    }

    /**
     * @return void
     */
    private function mapRoutes()
    {
        $this->router->map(
            'GET',
            '/',
            'MainController#home',
            'home'
        );

        $this->router->map(
            'POST',
            '/lists',
            'ListController#createList',
            'list_create'
        );
    }

    public function run()
    {
        // Dispatcher vers le bon contrôleur / méthode
        if (!$this->hasRun) {
            $this->dispatch();

            $this->hasRun = true;
        }
    }

    private function dispatch()
    {
        $match = $this->router->match();

        if (!$match) {
            $controllerName = 'ErrorController';
            $methodName = 'page404';

            $urlParameters = [];
        } else {
            // http://php.net/list
            list($controllerName, $methodName) = explode('#', $match['target']);

            $urlParameters = $match['params'];
        }

        $controllerName = __NAMESPACE__ . '\\Controllers\\' . $controllerName;

        $controller = new $controllerName($this->router);

        //$controller->$methodName($match['params']);

        // http://php.net/call_user_func_array
        // http://php.net/manual/fr/language.types.callable.php
        call_user_func_array(
            [$controller, $methodName],
            $urlParameters
        );
    }
}
