<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-body p-4 p-sm-5">
                    
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900 fw-bold">Iniciar Sesión</h1>
                        <p class="text-muted small">Ingresá tus credenciales para acceder</p>
                    </div>

                    <form id="formLogin" class="user" novalidate>
                        <div class="mb-3">
                            <label for="exampleInputEmail" class="form-label small text-muted">Correo Electrónico</label>
                            <input
                                name="email"
                                type="email"
                                class="form-control"
                                id="exampleInputEmail"
                                placeholder="ejemplo@correo.com"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword" class="form-label small text-muted">Contraseña</label>
                            <div class="input-group">
                                <input
                                    name="password"
                                    type="password"
                                    class="form-control"
                                    id="exampleInputPassword"
                                    placeholder="••••••••"
                                    required
                                >
                                <button class="btn btn-outline-secondary btn-toggle-password" type="button" tabindex="-1">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="customCheck">
                            <label class="form-check-label small" for="customCheck">Recordame</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                            Ingresar
                        </button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center mb-2">
                        <a class="small text-decoration-none" href="<?php echo RUTA_URL; ?>/AuthController/resetPassword">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                    <div class="text-center">
                        <a class="small text-decoration-none" href="<?php echo RUTA_URL; ?>/AuthController/register">
                            ¿No tenés cuenta? Registrate
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require RUTA_APP . "/views/layout/landing/footer.php"; ?>