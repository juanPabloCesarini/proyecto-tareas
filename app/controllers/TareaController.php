<?php
class TareaController extends BaseController {

    private $tareaModel;
    private $estadoModel;

    public function __construct() {
        $this->tareaModel = $this->model('TareaModel');
        $this->estadoModel = $this->model('EstadoModel');
    }

    /**
     * GET /TareaController/index/$id_estado
     * Obtiene el listado de tareas filtrado por estado (0 = todas)
     */
    public function index($id_estado = 0) {
        $tareas = $this->tareaModel->buscarTareas($id_estado);
        $this->jsonResponse([
            'ok' => true,
            'tareas' => $tareas
        ]);
    }

    /**
     * GET /TareaController/estados
     * Obtiene la lista de estados disponibles para los select del front
     */
    public function estados() {
        $estados = $this->estadoModel->buscar_estados();
        $this->jsonResponse([
            'ok' => true,
            'estados' => $estados
        ]);
    }

    /**
     * GET /TareaController/show/$id_tarea
     * Obtiene el detalle de una tarea específica
     */
    public function show($id_tarea = null) {
        if (!$id_tarea) {
            $this->jsonResponse(['ok' => false, 'mensaje' => 'ID de tarea no proporcionado.'], 400);
        }

        $tarea = $this->tareaModel->tareaById($id_tarea);
        $this->jsonResponse([
            'ok' => true,
            'tarea' => $tarea
        ]);
    }

    /**
     * POST /TareaController/store
     * Crea una nueva tarea y la asocia al usuario autenticado
     */
    public function store() {
        $datos = $this->getJsonBody();

        $data = [
            'titulo'      => trim($datos['titulo'] ?? ''),
            'descripcion' => trim($datos['descripcion'] ?? ''),
            'expired_at'  => $datos['expired_at'] ?? null,
            'id_estado'   => $datos['id_estado'] ?? 1,
        ];

        if (empty($data['titulo'])) {
            $this->jsonResponse(['ok' => false, 'mensaje' => 'El título es obligatorio.'], 400);
        }

        $creado = $this->tareaModel->altaTarea($data);

        if ($creado) {
            $id_tarea = $this->tareaModel->ultimoId();
            $dataUsuario = [
                'id_usuario' => $_SESSION['id'] ?? $datos['id_usuario'],
                'id_tarea'   => $id_tarea,
            ];
            $this->tareaModel->asignarTareaAlUsuario($dataUsuario);

            $this->jsonResponse([
                'ok' => true,
                'mensaje' => 'Tarea creada exitosamente.'
            ], 201);
        } else {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'No se pudo crear la tarea.'
            ], 500);
        }
    }

    /**
     * PUT /TareaController/update
     * Actualiza los datos de una tarea existente
     */
    public function update() {
        $datos = $this->getJsonBody();

        $data = [
            'titulo'      => trim($datos['titulo'] ?? ''),
            'descripcion' => trim($datos['descripcion'] ?? ''),
            'expired_at'  => $datos['expired_at'] ?? null,
            'id_estado'   => $datos['id_estado'] ?? 1,
            'id_tarea'    => $datos['id_tarea'] ?? null,
        ];

        if (empty($data['id_tarea'])) {
            $this->jsonResponse(['ok' => false, 'mensaje' => 'ID de tarea no válido.'], 400);
        }

        $actualizado = $this->tareaModel->updateTarea($data);

        $this->jsonResponse([
            'ok' => (bool)$actualizado,
            'mensaje' => $actualizado ? 'Tarea actualizada correctamente.' : 'Sin cambios realizados.'
        ]);
    }

    /**
     * DELETE /TareaController/destroy/$id_tarea
     * Elimina (soft-delete) una tarea por su ID
     */
    public function destroy($id_tarea = null) {
        if (!$id_tarea) {
            $this->jsonResponse(['ok' => false, 'mensaje' => 'ID de tarea no provisto.'], 400);
        }

        $eliminado = $this->tareaModel->eliminarTarea($id_tarea);

        $this->jsonResponse([
            'ok' => (bool)$eliminado,
            'mensaje' => $eliminado ? 'Tarea eliminada exitosamente.' : 'Error al intentar eliminar la tarea.'
        ]);
    }
}