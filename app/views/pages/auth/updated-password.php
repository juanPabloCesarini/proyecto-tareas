<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-body p-4 p-sm-5">
                    
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900 fw-bold">Actualizar Contraseña</h1>
                        <p class="text-muted small">Ingresá tu clave temporal y definí la nueva</p>
                    </div>

                    <form id="formUpdatePassword" class="user" novalidate>
                        <div class="mb-3">
                            <label for="inputUpdateEmail" class="form-label small text-muted">Correo Electrónico</label>
                            <input 
                                id="inputUpdateEmail"
                                name="email" 
                                type="email" 
                                class="form-control" 
                                placeholder="tu@email.com"
                                value="<?php echo $data['mail'] ?? ''; ?>"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="inputPassActual" class="form-label small text-muted">Contraseña Temporal / Actual</label>
                            <div class="input-group">
                                <input 
                                    id="inputPassActual"
                                    name="pass_actual" 
                                    type="password" 
                                    class="form-control" 
                                    placeholder="••••••••"
                                    required
                                >
                                <button class="btn btn-outline-secondary btn-toggle-password" type="button" tabindex="-1">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="inputPassNueva" class="form-label small text-muted">Nueva Contraseña</label>
                            <div class="input-group">
                                <input 
                                    id="inputPassNueva"
                                    name="pass_nueva" 
                                    type="password" 
                                    class="form-control" 
                                    placeholder="••••••••"
                                    required
                                >
                                <button class="btn btn-outline-secondary btn-toggle-password" type="button" tabindex="-1">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="inputPassNueva2" class="form-label small text-muted">Repetir Nueva Contraseña</label>
                            <div class="input-group">
                                <input 
                                    id="inputPassNueva2"
                                    name="pass_nueva2" 
                                    type="password" 
                                    class="form-control" 
                                    placeholder="••••••••"
                                    required
                                >
                                <button class="btn btn-outline-secondary btn-toggle-password" type="button" tabindex="-1">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                            Guardar Nueva Contraseña
                        </button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <a class="small text-decoration-none" href="<?php echo RUTA_URL; ?>/AuthController/login">
                            Volver al Login
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require RUTA_APP . "/views/layout/landing/footer.php"; ?>