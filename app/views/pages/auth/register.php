<?php require RUTA_APP . "/views/layout/landing/header.php";?>

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Crea tu cuenta</h1>
                        </div>

                        <form class="user" action="<?php echo RUTA_URL; ?>/AuthController/registrarUsuario/"
                            method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input name="nombre" type="text" class="form-control form-control-user"
                                        id="exampleFirstName" placeholder="Nombre">
                                </div>
                                <div class="col-sm-6">
                                    <input name="apellido" type="text" class="form-control form-control-user"
                                        id="exampleLastName" placeholder="Apellido">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formFile" class="form-label ">Avatar</label>
                                <input name="avatar" class="form-control" type="file" id="formFile">
                            </div>
                            <?php 
                                if ($data['error_tipo']!=''){
                                    echo $data['error_tipo'];
                                }
                            ?>
                            <?php 
                                if ($data['error_megas']!=''){
                                    echo $data['error_megas'];
                                }
                            ?>
                            <div class="form-group">
                                <input name="email" type="email" class="form-control form-control-user"
                                    id="exampleInputEmail" placeholder="Email">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input name="password" type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password">
                                </div>
                                <div class="col-sm-6">
                                    <input name="password2" type="password" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="Repetir Password">
                                </div>
                            </div>
                            <?php 
                                if ($data['error_pass']!=''){
                                    echo $data['error_pass'];
                                }
                            ?>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Guardar
                            </button>

                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?php echo RUTA_URL;?>/AuthController/resetPassword">Olvidé mi comntraseña</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?php echo RUTA_URL;?>/AuthController/login">Ya tenés cuenta?
                                Ingresá</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require RUTA_APP . "/views/layout/landing/footer.php";?>