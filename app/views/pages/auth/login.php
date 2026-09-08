<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>

<main class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-md-8 col-lg-6 col-xl-5">

            <div class="card border-0 shadow">

                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">

                        <h1 class="h3 fw-bold mb-2">
                            Ingresar
                        </h1>

                        <p class="text-body-secondary mb-0">
                            Ingresá a tu cuenta para administrar tus tareas.
                        </p>

                    </div>

                    <form
                        id="formLogin"
                        action="<?php echo RUTA_URL; ?>/AuthController/loginUsuario/"
                        method="POST"
                    >

                        <div class="mb-3">

                            <label
                                for="exampleInputEmail"
                                class="form-label"
                            >
                                Email
                            </label>

                            <input
                                name="email"
                                type="email"
                                class="form-control"
                                id="exampleInputEmail"
                                placeholder="tu@email.com"
                                autocomplete="email"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label
                                for="exampleInputPassword"
                                class="form-label"
                            >
                                Contraseña
                            </label>

                            <input
                                name="password"
                                type="password"
                                class="form-control"
                                id="exampleInputPassword"
                                placeholder="Ingresá tu contraseña"
                                autocomplete="current-password"
                                required
                            >

                        </div>

                        <div class="form-check mb-4">

                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="customCheck"
                            >

                            <label
                                class="form-check-label"
                                for="customCheck"
                            >
                                Recordame
                            </label>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Ingresar
                        </button>

                    </form>

                    <hr class="my-4">

                    <div class="text-center mb-2">

                        <a
                            href="<?php echo RUTA_URL; ?>/AuthController/resetPassword"
                            class="text-decoration-none"
                        >
                            ¿Olvidaste tu contraseña?
                        </a>

                    </div>

                    <div class="text-center">

                        <span class="text-body-secondary">
                            ¿Todavía no tenés una cuenta?
                        </span>

                        <a
                            href="<?php echo RUTA_URL; ?>/AuthController/register"
                            class="text-decoration-none fw-semibold"
                        >
                            Registrate
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

<?php require RUTA_APP . "/views/layout/landing/footer.php"; ?>