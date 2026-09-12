<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-body p-4 p-sm-5">
                    
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900 fw-bold">¿Olvidaste la contraseña?</h1>
                        <p class="text-muted small mb-0">Ingresá tu email y te enviaremos las instrucciones para generar una nueva.</p>
                    </div>

                    <form id="formForgotPassword" class="user" novalidate>
                        <div class="mb-4">
                            <label for="inputEmail" class="form-label small text-muted">Correo Electrónico</label>
                            <input 
                                name="email" 
                                type="email" 
                                class="form-control form-control-user" 
                                id="inputEmail" 
                                placeholder="tu@email.com"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                            Enviar Instrucciones
                        </button>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <a class="small text-decoration-none" href="<?php echo RUTA_URL; ?>/AuthController/login">
                            ¿Te acordaste? Volver al Login
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require RUTA_APP . "/views/layout/landing/footer.php"; ?>