<?php

/**
 * Routes
 * Mapea la URL enviada por el navegador o fetch API:
 * 1 - Controlador
 * 2 - Método
 * 3 - Parámetros
 */
class Routes {
    protected $actualController = 'HomePageController';
    protected $actualMethod = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();

        // Verificar y instanciar Controlador
        if (isset($url[0])) {
            $controllerName = ucwords($url[0]) . 'Controller';
            
            if (file_exists('../app/controllers/' . $controllerName . '.php')) {
                $this->actualController = $controllerName;
                unset($url[0]);
            }
        }

        require_once '../app/controllers/' . $this->actualController . '.php';
        $this->actualController = new $this->actualController();

        // Verificar Método
        if (isset($url[1])) {
            if (method_exists($this->actualController, $url[1])) {
                $this->actualMethod = $url[1];
                unset($url[1]);
            }
        }

        // Obtener Parámetros restantes
        $this->params = $url ? array_values($url) : [];

        // Ejecutar controlador/método con los parámetros pasados
        call_user_func_array([$this->actualController, $this->actualMethod], $this->params);
    }

    public function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}