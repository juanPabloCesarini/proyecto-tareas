<?php
    class TareaController extends BaseController{
         
        public function __construct(){
            $this->tareaModel=$this->model('TareaModel');
            $this->estadoModel=$this->model('EstadoModel');
        }
        
        public function listarTarea($id_estado){
            
            $tareas = $this->tareaModel->buscarTareas($id_estado);
            
            $data = [
                'tareas' => $tareas,
                'estados' => $this->estadoModel->buscar_estados(),
            ]; 
         
            $this->view('pages/dashboard/dashboard',$data);
        } 

        public function NuevaTarea(){
            $data = [
                'estados' => $this->estadoModel->buscar_estados(),
            ]; 
            $this->view('pages/tarea/crear_tarea',$data);
        }
        public function GuardarTarea(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $data = [
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'],
                'expired_at' => $_POST['expired_at'],
                'id_estado' => $_POST['id_estado'],
                ];
                $this->tareaModel->altaTarea($data);
                
                $data = [
                    'id_usuario' => $_POST['id_usuario'],
                    'id_tarea' =>$this->tareaModel->ultimoId(),
                ];
                
                $this->tareaModel->asignarTareaAlUsuario($data);

                $tareas = $this->tareaModel->buscarTareas(0);
            
                $data = [
                    'tareas' => $tareas,
                    'estados' => $this->estadoModel->buscar_estados(),
                ]; 
         
                $this->view('pages/dashboard/dashboard',$data);
            }
        }
        public function borrarTarea($id_tarea){
            $this->tareaModel->eliminarTarea($id_tarea);
            $tareas = $this->tareaModel->buscarTareas(0);
            
            $data = [
                'tareas' => $tareas,
                'estados' => $this->estadoModel->buscar_estados(),
            ]; 
     
            $this->view('pages/dashboard/dashboard',$data);
        }

        public function editarTarea($id_tarea){
            $tarea = $this->tareaModel->tareaById($id_tarea);
            $data = [
                'estados' => $this->estadoModel->buscar_estados(),
                'tarea' => $tarea
            ]; 
            $this->view('pages/tarea/editar_tarea',$data);
            
        }
        public function GuardarCambiosTarea(){
            if ($_SERVER['REQUEST_METHOD']=='POST'){
                $data = [
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'],
                'expired_at' => $_POST['expired_at'],
                'id_estado' => $_POST['id_estado'],
                'id_tarea' => $_POST['id_tarea'],
                ];
                $this->tareaModel->updateTarea($data);
                
              

                $tareas = $this->tareaModel->buscarTareas(0);
            
                $data = [
                    'tareas' => $tareas,
                    'estados' => $this->estadoModel->buscar_estados(),
                ]; 
         
                $this->view('pages/dashboard/dashboard',$data);
            }
        }
    }