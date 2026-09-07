<?php 
   // configuracion acceso a la BD
   define('DB_HOST','localhost');
   define('DB_USER','root');
   define('DB_PASSWORD','');
   define('DB_NAME','db_tareas');

   // Ruta de la aplicación
   define('RUTA_APP', dirname(dirname(__FILE__)));
   // Ruta url

   define('RUTA_URL','http://localhost/proyecto_tareas');

   // Ruta de los recursos públicos
   

   // Rutas que se usan para guardar imágenes
   define('RUTA_AVATAR','/proyecto_tareas/public/img/avatar/');
   define('NOMBRESITIO','Administrador de tareas');
?>