```php
<?php require RUTA_APP . "/views/layout/landing/header.php"; ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">

                <div class="card-body p-0">

                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

                        <div class="col-lg-6">

                            <div class="p-5">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Ingresar</h1>
                                </div>

                                <form
                                    id="formLogin"
                                    class="user"
                                    action="<?php echo RUTA_URL; ?>/AuthController/loginUsuario/"
                                    method="POST"
                                >

                                    <div class="form-group">
                                        <input
                                            name="email"
                                            type="email"
                                            class="form-control form-control-user"
                                            id="exampleInputEmail"
                                            aria-describedby="emailHelp"
                                            placeholder="Email"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <input
                                            name="password"
                                            type="password"
                                            class="form-control form-control-user"
                                            id="exampleInputPassword"
                                            placeholder="Password"
                                        >
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">

                                            <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="customCheck"
                                            >

                                            <label
                                                class="custom-control-label"
                                                for="customCheck"
                                            >
                                                Recordame
                                            </label>

                                        </div>
                                    </div>

                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-user btn-block"
                                    >
                                        Login
                                    </button>

                                </form>

                                <hr>

                                <div class="text-center">
                                    <a
                                        class="small"
                                        href="<?php echo RUTA_URL; ?>/AuthController/resetPassword"
                                    >
                                        Olvidé mi contraseña
                                    </a>
                                </div>

                                <div class="text-center">
                                    <a
                                        class="small"
                                        href="<?php echo RUTA_URL; ?>/AuthController/register"
                                    >
                                        Soy Nuevo
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require RUTA_APP . "/views/layout/landing/footer.php"; ?>
```
