<?php require RUTA_APP . "/views/layout/admin/header.php";?>

<!-- Page Wrapper -->
<div id="wrapper">

<?php require RUTA_APP . "/views/layout/admin/menu.php";?>
    
    <!-- Content Wrapper -->
    <div class="d-flex flex-column flex-grow-1">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

          
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

            

                  

                   

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombre'];?></span>
                            <img  class="avatar" src="<?php echo RUTA_AVATAR.$_SESSION['avatar'];?>" alt="">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Perfil
                            </a>
                            
                            
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Cerrar Sesión
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Tus tareas </h1> 
                    <a href="<?php echo RUTA_URL;?>/TareaController/NuevaTarea/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-plus-circle fa-sm text-white-50"></i> Nueva</a>
                </div>

                <!-- Content Row -->
                <div class="row">
                
                
                <div class="card shadow mb-4">
                   <!--      <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Descripción</th>
                                            <th>Fecha de Alta</th>
                                            <th>Vencimiento</th>
                                            <th>Estado</th>
                                            <th class="text-center" colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                               
                                    <tbody>
                                        <?php if (!empty($data['tareas'])):?>
                                        <?php foreach($data['tareas'] as $tarea):?>
                                        <tr>
                                            <td><?php echo $tarea->titulo;?></td>
                                            <td><?php echo $tarea->descripcion;?></td>
                                            <td><?php echo date('d/m/Y',strtotime($tarea->created_at));?></td>
                                            <td><?php echo date('d/m/Y',strtotime($tarea->expired_at));?></td>
                                            <td style="color:<?php echo $tarea->color;?>"><strong><?php echo $tarea->tipoEstado;?></strong></td>
                                            <td><span class="text-info"><a
                                                        href="<?php echo RUTA_URL;?>/TareaController/editarTarea/<?php echo $tarea->id_tarea;?>"
                                                        class="btn btn-outline-success btn-sm"><i
                                                            class="fas fa-pen mr-2"></i>
                                                        Editar</a></span></td>
                                            <td><span class="text-danger"><a
                                                        href="<?php echo RUTA_URL;?>/TareaController/borrarTarea/<?php echo $tarea->id_tarea;?>"
                                                        class="btn btn-outline-danger btn-sm "><i
                                                            class="fas fa-trash-alt mr-2"></i>Eliminar</a></span></td>
                                        </tr>
                                        <?php endforeach;?>
                                        <?php else:?>
                                        <tr><h4 class="text-secondary">NO HAY TAREAS CARGADAS</h4></tr>
                                        <?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                   
                </div>

          

           
            </div>
            <!-- /.container-fluid -->
            
        </div>
        
        <!-- End of Main Content -->
        <?php require RUTA_APP . "/views/layout/admin/footer.php";?>