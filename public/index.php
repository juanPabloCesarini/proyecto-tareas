<?php
   // Carga inicializador

   require_once "../app/init.php";
   $router = new Routes();

   // Definición de Rutas API REST
   $router->post('/api/auth/login', ['AuthController', 'login']);
   $router->post('/api/auth/register', ['AuthController', 'register']);
   $router->post('/api/auth/reset-password', ['AuthController', 'resetPassword']);
   $router->put('/api/auth/update-password', ['AuthController', 'updatePassword']);
   $router->get('/api/auth/check-session', ['AuthController', 'checkSession']);
   $router->post('/api/auth/logout', ['AuthController', 'logout']);

   // Despachar la solicitud
   $router->dispatch();
?>