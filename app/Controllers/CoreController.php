<?php

namespace oFramework\Controllers;

class CoreController
{
    /**
     * @var AltoRouter
     */
    protected $router;

    /**
     * @param AltoRouter $router
     */
    public function __construct(\AltoRouter $router)
    {
        $this->router = $router;
    }

    /**
     * @param string $viewName Le nom de la vue
     * @param array $viewVars La liste des données à envoyer à la vue
     *
     * @return void
     */
    protected function show(string $viewName, array $viewVars = [])
    {
        $router = $this->router;

        include __DIR__ . '/../Views/' . $viewName . '.view.php';
    }
}
