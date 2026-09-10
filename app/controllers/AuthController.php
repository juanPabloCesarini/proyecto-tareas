<?php

class AuthController extends BaseController
{
      private $authModel;
    private $tareaModel;
    private $estadoModel;
    public function __construct()
    {
        $this->authModel = $this->model('AuthModel');
        $this->tareaModel = $this->model('TareaModel');
        $this->estadoModel = $this->model('EstadoModel');
    }

    /*
     * ============================
     * LOGIN
     * ============================
     */

    // Muestra la vista de login
    public function login()   {
        $data = [
            'error_login' => '',
        ];

        $this->view('pages/auth/login', $data);
    }

    // Procesa el login
 public function login()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->jsonResponse([
            'ok' => false,
            'mensaje' => 'Método no permitido.'
        ], 405);
    }

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $this->jsonResponse([
            'ok' => false,
            'mensaje' => 'Completá email y contraseña.'
        ], 400);
    }

    $data = [
        'email' => $email
    ];

    $usuario = $this->authModel->buscar_por_mail($data);

    if (!$usuario) {
        $this->jsonResponse([
            'ok' => false,
            'mensaje' => 'Usuario o contraseña incorrectos.'
        ], 401);
    }

    if ($password !== $usuario->pass) {
        $this->jsonResponse([
            'ok' => false,
            'mensaje' => 'Usuario o contraseña incorrectos.'
        ], 401);
    }

    $_SESSION['id'] = $usuario->id;
    $_SESSION['nombre'] = $usuario->nombre;
    $_SESSION['avatar'] = $usuario->avatar;

    $this->tareaModel->expirarTareas();

    $this->jsonResponse([
        'ok' => true,
        'mensaje' => 'Login correcto.',
        'redirect' => RUTA_URL . '/TareaController/listarTarea/0'
    ]);
}


    /*
     * ============================
     * REGISTRO
     * ============================
     */

    // Muestra la vista de registro
    public function register()
    {
        $data = [
            'error_tipo' => '',
            'error_megas' => '',
            'error_pass' => '',
        ];

        $this->view('pages/auth/register', $data);
    }

    // Procesa el registro
    public function registrarUsuario()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'Método no permitido.'
            ], 405);
        }

        $nombre = $_POST['nombre'] ?? '';
        $apellido = $_POST['apellido'] ?? '';
        $email = $_POST['email'] ?? '';
        $pass = $_POST['password'] ?? '';
        $pass2 = $_POST['password2'] ?? '';

        /*
         * Avatar
         */
        $avatar = 'img_default.png';

        if (
            isset($_FILES['avatar']) &&
            $_FILES['avatar']['error'] !== UPLOAD_ERR_NO_FILE
        ) {

            if ($_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
                $this->jsonResponse([
                    'ok' => false,
                    'mensaje' => 'No se pudo cargar la imagen.'
                ], 400);
            }

            $nombreAvatar = $_FILES['avatar']['name'];
            $tipoImagen = $_FILES['avatar']['type'];
            $tamanoImagen = $_FILES['avatar']['size'];

            /*
             * Máximo: 10 MB
             */
            if ($tamanoImagen > 10000000) {
                $this->jsonResponse([
                    'ok' => false,
                    'mensaje' => 'El tamaño de la imagen es demasiado grande.'
                ], 400);
            }

            /*
             * Tipos permitidos
             */
            if (
                $tipoImagen !== 'image/jpg' &&
                $tipoImagen !== 'image/jpeg' &&
                $tipoImagen !== 'image/png'
            ) {
                $this->jsonResponse([
                    'ok' => false,
                    'mensaje' => 'El tipo de imagen debe ser jpg, jpeg o png.'
                ], 400);
            }

            $ubicacion = $_SERVER['DOCUMENT_ROOT'] . RUTA_AVATAR;

            if (!move_uploaded_file(
                $_FILES['avatar']['tmp_name'],
                $ubicacion . $nombreAvatar
            )) {
                $this->jsonResponse([
                    'ok' => false,
                    'mensaje' => 'No se pudo guardar la imagen.'
                ], 500);
            }

            $avatar = $nombreAvatar;
        }

        /*
         * Validación de contraseña
         */
        if ($pass !== $pass2) {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'Las contraseñas no coinciden.'
            ], 400);
        }

        /*
         * Buscamos si ya existe el email
         */
        $data = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'avatar' => $avatar,
            'email' => $email,
            'pass' => $pass,
            'pass2' => $pass2
        ];

        $usuario = $this->authModel->buscar_por_mail($data);

        if (!empty($usuario)) {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'Ya existe una cuenta creada con ese email.'
            ], 409);
        }

        /*
         * Creamos el usuario
         */
        if ($this->authModel->crear_usuario($data)) {

            $this->jsonResponse([
                'ok' => true,
                'mensaje' => 'La cuenta fue creada correctamente.',
                'redirect' => RUTA_URL . '/AuthController/login'
            ]);
        }

        $this->jsonResponse([
            'ok' => false,
            'mensaje' => 'No se pudo crear el usuario.'
        ], 500);
    }


    /*
     * ============================
     * RECUPERACIÓN DE CONTRASEÑA
     * ============================
     */

    // Muestra la vista de recuperación
    public function resetPassword()
    {
        $data = [
            'mail' => '',
            'error_mail' => '',
        ];

        $this->view('pages/auth/forgot-password', $data);
    }

    // Envía una nueva contraseña por email
    public function enviar_password()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'Método no permitido.'
            ], 405);
        }

        $email = $_POST['email'] ?? '';

        if (empty($email)) {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'Ingresá tu email.'
            ], 400);
        }

        $data = [
            'email' => $email
        ];

        $usuario = $this->authModel->buscar_por_mail($data);

        if (empty($usuario)) {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'No existe una cuenta asociada a ese email.'
            ], 404);
        }

        /*
         * La variable $where es utilizada
         * por mail_pass.php.
         */
        $where = 'new_pass';

        /*
         * El archivo se encarga de:
         * - generar la contraseña
         * - actualizarla
         * - enviar el email
         */
        include(RUTA_APP . '/mails/mail_pass.php');

        /*
         * mail_pass.php actualmente genera
         * la respuesta del envío.
         *
         * Esta línea queda como respaldo si
         * el archivo termina correctamente.
         */
        $this->jsonResponse([
            'ok' => true,
            'mensaje' => 'Te llegará una nueva contraseña por mail.'
        ]);
    }


    /*
     * ============================
     * CAMBIO DE CONTRASEÑA
     * ============================
     */

    // Muestra la vista para cambiar contraseña
    public function update_pass()
    {
        $data = [
            'mail' => '',
            'error_mail' => '',
            'error_pass' => '',
        ];

        $this->view('pages/auth/updated-password', $data);
    }

    // Procesa el cambio de contraseña
    public function actualizar_password()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'Método no permitido.'
            ], 405);
        }

        $email = $_POST['email'] ?? '';
        $passActual = $_POST['pass_actual'] ?? '';
        $passNueva = $_POST['pass_nueva'] ?? '';
        $passNueva2 = $_POST['pass_nueva2'] ?? '';

        if (
            empty($email) ||
            empty($passActual) ||
            empty($passNueva) ||
            empty($passNueva2)
        ) {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'Completá todos los campos.'
            ], 400);
        }

        /*
         * Verificamos que las nuevas contraseñas coincidan.
         */
        if ($passNueva !== $passNueva2) {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'Las contraseñas nuevas no coinciden.'
            ], 400);
        }

        /*
         * Buscamos al usuario para verificar
         * la contraseña actual.
         */
        $data = [
            'email' => $email
        ];

        $usuario = $this->authModel->buscar_por_mail($data);

        if (empty($usuario)) {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'No existe una cuenta asociada a ese email.'
            ], 404);
        }

        /*
         * Verificamos contraseña actual.
         */
        if ($passActual !== $usuario->pass) {
            $this->jsonResponse([
                'ok' => false,
                'mensaje' => 'La contraseña actual es incorrecta.'
            ], 401);
        }

        /*
         * Actualizamos contraseña.
         */
        if ($this->authModel->change_pass($passNueva, $email)) {

            $this->jsonResponse([
                'ok' => true,
                'mensaje' => 'La contraseña fue actualizada correctamente.',
                'redirect' => RUTA_URL . '/AuthController/login'
            ]);
        }

        $this->jsonResponse([
            'ok' => false,
            'mensaje' => 'No se pudo actualizar la contraseña.'
        ], 500);
    }


    /*
     * ============================
     * LOGOUT
     * ============================
     */

    public function logout()
    {
        session_unset();
        session_destroy();

        $this->jsonResponse([
            'ok' => true,
            'mensaje' => 'Sesión cerrada correctamente.',
            'redirect' => RUTA_URL . '/'
        ]);
    }
}