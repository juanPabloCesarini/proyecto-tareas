<?php

class TareaModel {
    public function __construct()
    {
        $this->db = new Database;
    }

   

    	/* Método para buscar los estados posibles de las tareas*/

	public function buscar_estados()
	{
		$this->db->query("SELECT * FROM estado");
		
		
		$result = $this->db->registers();
		return $result;
	}

	public function buscarTareas($id_estado){
		
		if ($id_estado == 0){
			$this->db->query("SELECT tarea.id AS id_tarea,
									 tarea.titulo,
									 tarea.descripcion,
									 tarea.created_at,
									 tarea.expired_at,
									 estado.tipoEstado,
									 estado.color
									  FROM `tarea_usuario` 
								inner join tarea on tarea.id = tarea_usuario.fk_id_tarea
								inner JOIN estado on estado.id = tarea.fk_id_estado
								INNER join usuario on usuario.id = :id_usuario
								where tarea.deleted_at IS NULL
								order by tarea.created_at DESC");
								
			$this->db->bind('id_usuario', $_SESSION['id']);
			$result = $this->db->registers();
			return $result;
		}else{
			$this->db->query("SELECT tarea.id AS id_tarea,
									 tarea.titulo,
									 tarea.descripcion,
									 tarea.created_at,
									 tarea.expired_at,
									 estado.tipoEstado,
									 estado.color
									  FROM `tarea_usuario` 
								inner join tarea on tarea.id = tarea_usuario.fk_id_tarea
								inner JOIN estado on estado.id = tarea.fk_id_estado
								INNER join usuario on usuario.id = :id_usuario
								where estado.id =:id_estado
								and tarea.deleted_at IS NULL
								order by tarea.created_at DESC");
			$this->db->bind('id_usuario', $_SESSION['id']);
			$this->db->bind('id_estado', $id_estado);
			$result = $this->db->registers();
			return $result;
		}
	}

	public function altaTarea($data){
		
		$this->db->query("INSERT INTO tarea
                          (titulo, descripcion, expired_at, fk_id_estado,  created_at) 
						  VALUES 
						  (:titulo, :descripcion, :expired_at, :id_estado, CURRENT_TIMESTAMP)");
        $this->db->bind('titulo', $data['titulo']);
        $this->db->bind('descripcion', $data['descripcion']);
        $this->db->bind('expired_at', $data['expired_at']);                  
		$this->db->bind('id_estado', $data['id_estado']);
	
		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function ultimoId(){
		return $this->db->lastId();
		
	}

	public function asignarTareaAlUsuario($data){
		
		$this->db->query("INSERT INTO tarea_usuario
                          (fk_id_usuario, fk_id_tarea ) 
						  VALUES 
						  (:fk_id_usuario, :fk_id_tarea)");
        $this->db->bind('fk_id_usuario', $data['id_usuario']);
        $this->db->bind('fk_id_tarea', $data['id_tarea']);
        
	
		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function eliminarTarea($id_tarea){
		$this->db->query("UPDATE tarea SET
							deleted_at=CURRENT_TIMESTAMP
						 WHERE tarea.id=:id"
							);
		$this->db->bind('id', $id_tarea);
		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function tareaById($id_tarea){
		$this->db->query("SELECT * FROM `tarea` 
							INNER JOIN estado on estado.id = tarea.fk_id_estado
							WHERE tarea.id=:id");
		$this->db->bind('id', $id_tarea);
		$result = $this->db->register();
		return $result;
	}
	public function updateTarea($data){
		
		$this->db->query("UPDATE tarea SET
                          titulo=:titulo,
						  descripcion=:descripcion,
						  expired_at=:expired_at,
						  fk_id_estado=:id_estado,
						  updated_at=CURRENT_TIMESTAMP
						  WHERE Id=:id_tarea");
        $this->db->bind('titulo', $data['titulo']);
        $this->db->bind('descripcion', $data['descripcion']);
        $this->db->bind('expired_at', $data['expired_at']);                  
		$this->db->bind('id_estado', $data['id_estado']);
		$this->db->bind('id_tarea', $data['id_tarea']);
	
		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}
	public function expirarTareas(){
		$this->db->query("UPDATE tarea SET 
						  fk_id_estado = 4
						  WHERE tarea.expired_at < CURDATE()");
		$result = $this->db->registers();
		return $result;
	}
		
}
?>