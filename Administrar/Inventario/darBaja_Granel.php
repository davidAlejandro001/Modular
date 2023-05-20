<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../css/sb-admin-2.css" rel="stylesheet">--> 
    <link href="../../css/sb-inventario.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body id="page-top">

    <?php 

      session_start();
    //Control de los usuarios
    if (!isset($_SESSION["usuario"])) {
       header("location:../../index.php");
  }
    ?> 

    <!-- Menu (azul) -->
    <div id="wrapper">

        <!-- Parte inicial -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Icono - Tipo Usuario -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION["perfil"] ?></div>
            </a>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider my-0">

            <!-- Barra divisoria -->
            <hr class="sidebar-divider">

            <!-- volver a admin prov -->
            <div class="sidebar-heading">
                Control del Inventario
            </div>

            <li class="nav-item">
                <a  class="nav-link collapsed" href="inventario.php"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa fa-reply"></i>
                    <span>Volver</span>
                </a>
            </li>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- Fin Menu -->
<!-- // ---------------------------------------------------------------------------------------------------------------------------- -->
        <!-- Nombre Usuario e imagen -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nombre del Usuario -->
                        
                        <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $_SESSION["usuario"]?></span>
                                    <img class="img-profile rounded-circle"
                                        src="../../img/admin.webp">
                                </a>
                        </li>
                        
                    </ul>

                </nav>
                <!-- fin esta parte -->

                <div class="container-fluid">

                    <?php 

                        include("conexion.php");

                        //si no has pulsado boton actualizar
                        if (!isset($_POST["bot_actualizar"])) {
                            # code...

                            $Id=$_GET["Id"];
                            $Stock=$_GET["cant"];

                            include_once("formBaja_Granel.php");
 
                        }else{
                            //guardando los datos del formulario
                            $Id=$_POST["id"];
                            $cantidad=$_POST["cantidad"];
                            $Stock = $_POST["stock"];
                            $descripcion = $_POST["des"];
                            $contador=0;

                            $tipoError1="";
                            $tipoError2="";
                            $tipoError3="";

                            if(empty($Id) || empty($cantidad) || empty($Stock) || empty($descripcion)){

                                $tipoError1="No puedes dejar espacios en blanco.";
                                $contador = $contador + 1;
                            }

                            if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]{7,100}$/i", trim($descripcion)) !== 1) {
                                $contador = $contador + 1;
                                $tipoError2 =  'solo letras. '; 
                            }

                            if($cantidad > $Stock){
                                $contador = $contador + 1;
                                $tipoError3 = "No hay suficientes articulos en el inventario";
                            }

                            if($contador > 0){
                                ?>
                                <script>

                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Corregir los siguientes errores: ',
                                        html: '<?php echo "<div>$tipoError1<br>$tipoError2<br>$tipoError3</div>" ?>',
                                        })

                                </script>
                                <?php

                                include("formBaja_Granel.php");

                            }else{

                                $stocks = $Stock - $cantidad;

                                date_default_timezone_set('America/Mexico_City');
                                $fechaGuardar = date('Y-m-d');

                                $sql="UPDATE tinventario SET stock=:stk WHERE TProductos_id=:miId";
                                $resultado=$base->prepare($sql);

                                $resultado->execute(array(":miId"=>$Id, ":stk"=>$stocks));

                                $sql2="INSERT INTO t_merma(TProductos_id, cantidad, descripcion, fecha) VALUES (:miId, :cant, :descripcion, :fecha)";
                                $resultado2=$base->prepare($sql2);

                                $resultado2->execute(array(":miId"=>$Id, ":cant"=>$cantidad, ":descripcion"=>$descripcion, ":fecha"=>$fechaGuardar));
                                        
                                echo "<p class='fw-semibold font-monospace'>Registro actualizado con exito</p>";
                                
                            }
                            
                        }
                        
                        ?>

                </div>

            </div>

            <!-- Pie de Pagina -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;</span>
                    </div>
                </div>
            </footer>
            <!-- Fin pie de pagina -->

        </div>

    </div>

    <!-- Boton para volver a esta parte -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/chart-area-demo.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>

</body>
</html>