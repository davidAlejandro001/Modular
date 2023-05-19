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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body id="page-top">

    <?php 
    ?> 

    <!-- Menu (azul) -->
    <div id="wrapper">

        <!-- Parte inicial -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Icono -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php ?></div>
            </a>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Venta
            </div>

            <li class="nav-item">
                <a  class="nav-link collapsed" href="venta1.php"
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
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nombre Usuario -->
                        
                        <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  //echo $_SESSION["usuario"]?></span>
                                    <img class="img-profile rounded-circle"
                                        src="../../img/admin.webp">
                                </a>
                        </li>
                    </ul>

                </nav>
                <!-- Fin esta Parte -->

                <div class="container-fluid">

                <?php 

                    $numVenta = $_POST["numVenta"];
                    $total=$_POST["total"];
                    $empleado = $_POST["numEmpleado"];
                    $fecha=$_POST["fecha"];
                    $cambio=$_POST["cambio"];

                    if (empty($cambio) || $cambio=="NaN") {

                        ?>
                            <script>

                                Swal.fire({
                                icon: 'error',
                                title: 'No puedes dejar espacios en blanco ',
                                text: "<?php echo "vuelve a intentarlo" ?>"
                                })

                            </script>

                        <img src="css/error.jpg" class="img-fluid" alt="No puedes dejar espacios en blanco">
                        <?php

                    }else{

                    
                        
                        include("conexion.php");
                    
                        //generando la venta
                        $sql="INSERT INTO tventa( TVenta_id, TEmpleado_id, total, fecha) VALUES (:id,:emp,:total, :fecha)";
                        $resultado=$base->prepare($sql);

                        $resultado->execute(array(":id"=>$numVenta,":emp"=>$empleado, ":total"=>$total, ":fecha"=>$fecha));

                        $sql2 = "UPDATE tlista_venta SET TVenta_id=:num WHERE TVenta_id=0";
                        $resultado2=$base->prepare($sql2);
                                
                        $resultado2->execute(array(":num"=>$numVenta));

                        //echo "venta realizada con exito";
                        header("Location:venta1.php");

                    

                    }
                    
                    
                ?>

                </div>

                

            </div>
            <!-- Fin tabla -->

            <!-- Pie de pagina -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;</span>
                    </div>
                </div>
            </footer>
            <!-- Fin pie pag -->

        </div>

    </div>

    <!-- Button-->
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