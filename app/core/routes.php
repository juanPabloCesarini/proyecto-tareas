<?php 

/**
 * Routes
 * Router centralizado para APIs RESTful y despachador de SPA layout.
 */
class Routes {
    private array $routes = [];

    public function post(string $path, array $handler): void {
        $this->addRoute('POST', $path, $handler);
    }

    public function get(string $path, array $handler): void {
        $this->addRoute('GET', $path, $handler);
    }

    public function put(string $path, array $handler): void {
        $this->addRoute('PUT', $path, $handler);
    }

    public function delete(string $path, array $handler): void {
        $this->addRoute('DELETE', $path, $handler);
    }

    private function addRoute(string $method, string $path, array $handler): void {
        $this->routes[] = [
            'method'  => $method,
            'path'    => $path,
            'class'   => $handler[0],
            'action'  => $handler[1]
        ];
    }

    public function dispatch(): void {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remover subcarpeta base del proyecto si existe
        $basePath = '/proyecto-tareas';
        if (strpos($requestUri, $basePath) === 0) {
            $requestUri = substr($requestUri, strlen($basePath));
        }
        $requestUri = rtrim($requestUri, '/') ?: '/';

        // 1. Coincidencia con endpoints definidos
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['path'] === $requestUri) {
                $controllerClass = $route['class'];
                $action = $route['action'];

                $controllerFile = '../app/controllers/' . $controllerClass . '.php';
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                    $controller = new $controllerClass();

                    if (method_exists($controller, $action)) {
                        $controller->$action();
                        exit(); // Corta ejecución para NO cargar HTML
                    }
                }
            }
        }

        // 2. Si la petición arranca con /api/ y no se encontró
        if (strpos($requestUri, '/api/') === 0) {
            if (ob_get_length()) ob_clean();
            header('Content-Type: application/json; charset=utf-8', true, 404);
            echo json_encode(['success' => false, 'message' => 'Endpoint API no encontrado']);
            exit();
        }

        // 3. Para cualquier otra ruta (ej: /login, /dashboard, /) cargamos la SPA
        require_once '../app/controllers/HomePageController.php';
        $home = new HomePageController();
        $home->index();
    }
}