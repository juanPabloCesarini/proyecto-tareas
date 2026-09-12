<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-body p-4 p-sm-5">
                    
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900 fw-bold">Crear una Cuenta</h1>
                        <p class="text-muted small">Completá tus datos para registrarte en el sistema</p>
                    </div>

                    <form id="formRegister" enctype="multipart/form-data" novalidate>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label small text-muted">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellido" class="form-label small text-muted">Apellido</label>
                                <input type="text" name="apellido" class="form-control" id="apellido">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label small text-muted">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label small text-muted">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    <button class="btn btn-outline-secondary btn-toggle-password" type="button" tabindex="-1">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="password2" class="form-label small text-muted">Repetir Contraseña</label>
                                <div class="input-group">
                                    <input type="password" name="password2" class="form-control" id="password2" required>
                                    <button class="btn btn-outline-secondary btn-toggle-password" type="button" tabindex="-1">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="avatar" class="form-label small text-muted">Imagen de Perfil (Opcional)</label>
                            <input type="file" name="avatar" class="form-control" id="avatar" accept="image/png, image/jpeg, image/jpg">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                            Registrarse
                        </button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <a class="small text-decoration-none" href="<?php echo RUTA_URL; ?>/AuthController/login">
                            ¿Ya tenés cuenta? ¡Iniciá sesión!
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require RUTA_APP . "/views/layout/landing/footer.php"; ?>