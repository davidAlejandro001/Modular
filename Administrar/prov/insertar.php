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
    //hay algo almacenado ahi?
    if (!isset($_SESSION["usuario"])) {
       header("location:../../index.php");
  }
    ?> 

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION["perfil"] ?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- volver a admin prov -->
            <div class="sidebar-heading">
                Control de Proveedores
            </div>

            <li class="nav-item">
                <a  class="nav-link collapsed" href="proveedores.php"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa fa-reply"></i>
                    <span>Volver</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
<!-- // ---------------------------------------------------------------------------------------------------------------------------- -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

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
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $_SESSION["usuario"]?></span>
                                    <img class="img-profile rounded-circle"
                                        src="../../img/admin.webp">
                                </a>
                        </li>
                        
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">

                    <?php 

                    try {
                            //code...
                        

                        if (!isset($_POST["enviar"])) {

                            include("Registrar.php");

                        }else{

                            //guardando los datos del formulario

                            try {
                         
                                $empresa=$_POST["empresa"];
                                $name=$_POST["name"];
                                $ape=$_POST["ape"];
                                $phone=$_POST["phone"];
                                $visita=$_POST["visita"];

                                $tipoError1="";
                                $tipoError2="";
                                $tipoError3="";

                                $contador = 0;

                                if(empty($visita) || empty($empresa) || empty($name) || empty($ape) || empty($phone)){

                                    $contador = $contador + 1;
                                    $tipoError1 =  "Error, no puedes dejar espacios en blanco. ";

                                }

                                if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]{4,30}$/i", trim($name)) !== 1) {
                                    $contador = $contador + 1;
                                    $tipoError2 = "El nombre es incorrecto, solo letras. ";
                                }

                                if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]{4,50}$/i", trim($ape)) !== 1) {
                                    $contador = $contador + 1;
                                    $tipoError3 = "El apellido es incorrecto, solo letras. ";
                                }

                                if($visita != null){
                                    $dias_visita = implode(", " ,$visita);
                                    $Dias = explode(", ", $dias_visita);
                                }

                                if($contador > 0){

                                    //$errorFinal = $tipoError1 . $tipoError2 . $tipoError3;

                                    ?>

                                    <script>

                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Corregir los siguientes errores: ',
                                        html: '<?php echo "<div>$tipoError1<br>$tipoError2<br>$tipoError3<br></div>" ?>',
                                        })

                                    </script>

                                    <?php

                                    include_once("Registrar.php");

                                }else{

                                    $dias_visita = implode(", " ,$visita);

                                    include("conexion.php");

                                    $sql="INSERT INTO tproveedor (empresa, nombre_Repartidor, apellidos, telefono, dias_visita) VALUES (:empr, :nom, :ape, :tel, :dias)";

                                    $resultado=$base->prepare($sql);

                                    $resultado->execute(array(":empr"=>$empresa ,":nom"=>$name, ":ape"=>$ape, ":tel"=>$phone, ":dias"=>$dias_visita));

                                    echo "<p class='fw-semibold font-monospace'>Nuevo Registro creado correctamente</p>";
                                
                                    $resultado->closeCursor();
                                    
                                }

                                /*
                                

                                if($visita != null and $empresa != null and $name != null and $ape != null and $phone != null){

                                    $dias_visita = implode(", " ,$visita);

                                    include("conexion.php");

                                    $sql="INSERT INTO tproveedor (empresa, nombre_Repartidor, apellidos, telefono, dias_visita) VALUES (:empr, :nom, :ape, :tel, :dias)";

                                    $resultado=$base->prepare($sql);

                                    $resultado->execute(array(":empr"=>$empresa ,":nom"=>$name, ":ape"=>$ape, ":tel"=>$phone, ":dias"=>$dias_visita));

                                    echo "<p class='fw-semibold font-monospace'>Nuevo Registro creado correctamente</p>";
                                
                                    $resultado->closeCursor();
                                }else{
                                    echo "Error favor de llenar todos los campos";
                                }
                                */
                                
                            } catch (Exception $th) {
                                
                               echo "<p class='fw-semibold font-monospace'>Error favor de llenar todos los campos</p>";
                    
                            }                          

                        }

                    } catch (Exception $th) {
                        echo "Error";
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

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>