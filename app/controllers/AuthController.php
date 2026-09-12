<?php
class AuthController extends BaseController {
     
    public function __construct(){
        $this->authModel = $this->model('AuthModel');
        $this->tareaModel = $this->model('TareaModel');
        $this->estadoModel = $this->model('EstadoModel');
    }
    
    // Método auxiliar para obtener datos JSON entrantes
    private function getJsonInput() {
        return json_decode(file_get_contents('php://input'), true) ?? [];
    }

    /* Vistas de renderizado inicial */
    public function login(){
        $this->view('pages/auth/login');
    }

    public function register(){
        $this->view('pages/auth/register');
    }

    public function resetPassword(){
        $this->view('pages/auth/forgot-password');
    }

    public function update_pass(){
        $this->view('pages/auth/updated-password');
    }

    /* Endpoints de API (Devuelven JSON) */
    
    public function loginUsuario(){
        header('Content-Type: application/json');
        $datos = $this->getJsonInput();
        
        $email = $datos['email'] ?? '';
        $password = $datos['password'] ?? '';

        $usuario = $this->authModel->buscar_por_mail(['email' => $email]);

        if($usuario && $password === $usuario->pass){
            $_SESSION['id'] = $usuario->id;
            $_SESSION['nombre'] = $usuario->nombre;
            $_SESSION['avatar'] = $usuario->avatar;
            $this->tareaModel->expirarTareas();

            echo json_encode([
                'ok' => true,
                'mensaje' => 'Inicio de sesión exitoso.',
                'redirect' => RUTA_URL . '/TareaController/index'
            ]);
        } else {
            echo json_encode([
                'ok' => false,
                'mensaje' => 'Usuario o contraseña incorrectos.'
            ]);
        }
        exit;
    }

    public function enviar_password(){
        header('Content-Type: application/json');
        $datos = $this->getJsonInput();
        $email = $datos['email'] ?? '';

        if (empty($email)) {
            echo json_encode(['ok' => false, 'mensaje' => 'Por favor ingrese un correo válido.']);
            exit;
        }

        $usuario = $this->authModel->buscar_por_mail(['email' => $email]);

        if ($usuario) {
            $_POST['email'] = $email; // Mantiene compatibilidad con mail_pass.php
            
            try {
                include(RUTA_APP . "/mails/mail_pass.php");
                echo json_encode([
                    'ok' => true,
                    'mensaje' => 'Se ha enviado una nueva contraseña a tu correo.'
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'ok' => false,
                    'mensaje' => 'Error al enviar el correo: ' . $e->getMessage()
                ]);
            }
        } else {
            echo json_encode([
                'ok' => false,
                'mensaje' => 'El correo ingresado no se encuentra registrado.'
            ]);
        }
        exit;
    }

    public function actualizar_password(){
        header('Content-Type: application/json');
        $datos = $this->getJsonInput();

        $email = $datos['email'] ?? '';
        $passNueva = $datos['pass_nueva'] ?? '';
        $passNueva2 = $datos['pass_nueva2'] ?? '';

        if (empty($passNueva) || $passNueva !== $passNueva2){
            echo json_encode([
                'ok' => false,
                'mensaje' => 'Las contraseñas no coinciden o están vacías.'
            ]);
            exit;
        }

        if($this->authModel->change_pass($passNueva, $email)){
            echo json_encode([
                'ok' => true,
                'mensaje' => 'Contraseña actualizada correctamente.',
                'redirect' => RUTA_URL . '/AuthController/login'
            ]);
        } else {
            echo json_encode([
                'ok' => false,
                'mensaje' => 'No se pudo actualizar la contraseña.'
            ]);
        }
        exit;
    }

    public function logout(){
        session_unset();
        session_destroy();
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'redirect' => RUTA_URL . '/AuthController/login']);
        exit;
    }
}