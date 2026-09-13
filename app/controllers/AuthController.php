<?php

class AuthController extends BaseController {

    private $authModel;
    private $tareaModel;

    public function __construct() {
        $this->authModel = $this->model('AuthModel');
        $this->tareaModel = $this->model('TareaModel');
    }

    /**
     * POST /AuthController/login
     * Autentica credenciales y crea la sesión.
     */
    public function login() {
        $datos = $this->getJsonBody();

        $email = trim($datos['email'] ?? '');
        $password = trim($datos['password'] ?? '');

        if (empty($email) || empty($password)) {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'Por favor, ingrese email y contraseña.'
            ], 400);
        }

        $usuario = $this->authModel->buscar_por_mail(['email' => $email]);

        if ($usuario && $password === $usuario->pass) {
            $_SESSION['id'] = $usuario->id;
            $_SESSION['nombre'] = $usuario->nombre;
            $_SESSION['avatar'] = $usuario->avatar;

            // Tareas vencidas a estado correspondiente al ingresar
            $this->tareaModel->expirarTareas();

            $this->jsonResponse([
                'ok' => true,
                'mensaje' => 'Inicio de sesión exitoso.',
                'usuario' => [
                    'id' => $usuario->id,
                    'nombre' => $usuario->nombre,
                    'avatar' => $usuario->avatar
                ]
            ]);
        } else {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'Usuario o contraseña incorrectos.'
            ], 401);
        }
    }

    /**
     * POST /AuthController/resetPassword
     * Solicita envío de nueva contraseña por mail.
     */
    public function resetPassword() {
        $datos = $this->getJsonBody();
        $email = trim($datos['email'] ?? '');

        if (empty($email)) {
            $this->jsonResponse(['ok' => false, 'mensaje' => 'Por favor ingrese un correo válido.'], 400);
        }

        $usuario = $this->authModel->buscar_por_mail(['email' => $email]);

        if ($usuario) {
            $_POST['email'] = $email; // Mantiene compatibilidad con el template de mail

            try {
                include(RUTA_APP . "/mails/mail_pass.php");
                $this->jsonResponse([
                    'ok' => true,
                    'mensaje' => 'Se ha enviado una nueva contraseña a tu correo.'
                ]);
            } catch (Exception $e) {
                $this->jsonResponse([
                    'ok' => false,
                    'mensaje' => 'Error al enviar el correo: ' . $e->getMessage()
                ], 500);
            }
        } else {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'El correo ingresado no se encuentra registrado.'
            ], 44);
        }
    }

    /**
     * PUT /AuthController/updatePassword
     * Actualiza la clave de un usuario.
     */
    public function updatePassword() {
        $datos = $this->getJsonBody();

        $email = trim($datos['email'] ?? '');
        $passNueva = trim($datos['pass_nueva'] ?? '');
        $passNueva2 = trim($datos['pass_nueva2'] ?? '');

        if (empty($passNueva) || $passNueva !== $passNueva2) {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'Las contraseñas no coinciden o están vacías.'
            ], 400);
        }

        if ($this->authModel->change_pass($passNueva, $email)) {
            $this->jsonResponse([
                'ok' => true,
                'mensaje' => 'Contraseña actualizada correctamente.'
            ]);
        } else {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'No se pudo actualizar la contraseña.'
            ], 500);
        }
    }

    /**
     * POST /AuthController/logout
     * Destruye la sesión activa.
     */
    public function logout() {
        session_unset();
        session_destroy();
        $this->jsonResponse(['ok' => true, 'mensaje' => 'Sesión cerrada exitosamente.']);
    }

    /**
     * GET /AuthController/checkSession
     * Endpoint utilitario para que el Router de JS verifique si el usuario está logueado.
     */
    public function checkSession() {
        if (isset($_SESSION['id'])) {
            $this->jsonResponse([
                'authenticated' => true,
                'usuario' => [
                    'id' => $_SESSION['id'],
                    'nombre' => $_SESSION['nombre'],
                    'avatar' => $_SESSION['avatar']
                ]
            ]);
        } else {
            $this->jsonResponse(['authenticated' => false]);
        }
    }
}