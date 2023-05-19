<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

    .button {
        background-color: blue;/*#4e73df; Green */
        border: none;
        color: white;
        padding: 5px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 3px;

    }

    </style>


    <title>Document</title>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet">-->
    <link href="../css/sb-inventario.css" rel="stylesheet">

</head>
<body id="page-top">

    <?php 

      session_start();
    //Control de los usuarios
    if (!isset($_SESSION["usuario"])) {
       header("location:../index.php");
  }
    ?> 

    <!-- Menu (azul) -->
    <div id="wrapper">

        <!-- Parte inicial -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- icono - Tipo de Usuario -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION["perfil"] ?></div>
            </a>
            <!-- Volver al menu principal -->
            <li class="nav-item active">
                <i class="nav-link"></i>
                <form class="user" action="../comprobar_login2.php" method = "post">

                    <input type="hidden" name="user" value=<?php echo $_SESSION["usuario"] ?>>
                    <input type="hidden" name="password" value=<?php echo $_SESSION["contra"] ?>>
                    
                    <button type="submit" class="button" name="enviar">Menu Principal</button>
                    
                </form>
            </li>
        
            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- Fin del menu principal -->
<!-- // ---------------------------------------------------------------------------------------------------------------------------- -->
        <!-- Nombre de Usuario -->
        <div id="content-wrapper" class="d-flex flex-column">
        
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nombre Usuario -->
                        
                        <?php 

                            if($_SESSION['perfil'] == "Empleado"){

                        ?>
                        
                        <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $_SESSION["usuario"]?></span>
                                    <img class="img-profile rounded-circle"
                                        src="../img/undraw_profile.svg">
                                </a>
                        </li>

                        <?php 

                            }else {
                                ?> 
                                
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $_SESSION["usuario"]?></span>
                                        <img class="img-profile rounded-circle"
                                            src="../img/admin.webp">
                                    </a>
                                </li>
                                
                                <?php
                            }
                        

                        ?>
                        
                    </ul>

                </nav>
                <!-- Fin esta parte -->

                <div class="container-fluid">
                   
                    <?php 

                    include("conexion.php");
                    
                    //mientras no se seleccione alguno de los sig botones va a aparecer lo siguiente
                    if (!isset($_POST["bot_actualizar"]) and !isset($_POST["bot_passw"]) and !isset($_POST["nuevoNombre"])) {
                    
                        //datos recolectados de comprobar_login2.php
                        $id = $_SESSION["empleadoID"];
                        $usuario = $_SESSION["usuario"];
                        $nombre = $_SESSION["nombre"];
                        $apellidos = $_SESSION["apellidos"];
                        $passwordd = $_SESSION["contra"];

                        ?>
                            <div class="">
                            <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8">
                        <?php

                        include_once("form.php");
                        include_once("formPass.php");

                        ?>
                            </div>
                            <div class="col-2"></div>
                            </div>
                            </div>
                        <?php
 
                    }
                    //al dar clic btn actualizar
                    else if(isset($_POST["bot_actualizar"])){
                        ?>
                        <form method="post" action="nuevoNombre.php">          
                        <div>
                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $_SESSION["empleadoID"] ?>">
                        </div>
                            
                        <div >
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $_SESSION["nombre"] ?>">
                        </div>

                        <div >
                            <label class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="ape" id="ape" value="<?php echo $_SESSION["apellidos"] ?>">
                        </div>

                        <div>
                            <label class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" name="usu" id="usu" value="<?php echo $_SESSION["usuario"] ?>">
                        </div>

                        <div class="my-5">
                            <button type="submit" class="btn btn-primary" name="enviar" id="enviar" >Aceptar</button>
                        </div>    
                    </form>
                        <?php
                    }
                    else if(isset($_POST["bot_passw"])){

                        ?>
                        <div class="col-6">
                        <form method="post" action="nuevoPass.php">    
                                
                            <div >
                                <label class="form-label">Ingresa tu Contraseña actual</label>
                                <input type="password" class="form-control" name="pass" id="pass" placeholder="PASSWORD">
                                <input type="hidden" name="pass_real" id="pass_real" value="<?php echo $_SESSION["contra"] ?>">
                                <input type="hidden" name="Id" id="Id" value="<?php echo $_SESSION["empleadoID"]; ?>">
                            </div>

                            <div class="my-5">
                                <button type="submit" class="btn btn-primary" name="enviar" id="enviar" >Aceptar</button>
                            </div>    
                        </form>
                        </div>
                        <?php

                    }
                
                    ?>

                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
        

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>
</html>