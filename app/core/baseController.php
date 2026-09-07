<?php 

// Clase controlador principal
// Se encarga de poder cargar los models, views y respuestas JSON

class BaseController{

    // Cargar model
    public function model($model){

        // carga
        require_once '../app/models/'. $model.'.php';

        // instanciar el model
        return new $model();
    }

    // Cargar view 
    public function view($view, $data =[]){

        // chequear si existe el archivo view
        if (file_exists('../app/views/'.$view.'.php')){

            require_once '../app/views/'.$view.'.php';

        }else{

            // Si el archivo de la vista no existe
            die("La vista no existe");
        }
    }

    // Responder en formato JSON
    public function jsonResponse($data, $status = 200){

        http_response_code($status);

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode($data);

        exit;
    }
}

?>