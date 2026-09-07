<?php

class EstadoModel {
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

		
}
?>