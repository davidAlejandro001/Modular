<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../../css/sb-admin-2.css" rel="stylesheet">-->
    <link href="../../../css/sb-inventario.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body id="page-top">

    <?php 

      session_start();
    //Control de Usuarios
    if (!isset($_SESSION["usuario"])) {
       header("location:../../../login.php");
  }
    ?> 

    <!-- Menu -->
    <div id="wrapper">

        <!-- Parte Inicial -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Icono - Tipo de Usuario -->
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
                <a  class="nav-link collapsed" href="categoria.php"
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
        <!-- Nombre de Usuario -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nombre de Usuario -->
                        
                        <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $_SESSION["usuario"]?></span>
                                    <img class="img-profile rounded-circle"
                                        src="../../../img/admin.webp">
                                </a>
                        </li>
                        
                    </ul>

                </nav>
                <!-- Fin esta parte -->

                <div class="container-fluid">

                    <?php 

                        include("conexion.php");

                        if (!isset($_POST["enviar"])) {

                            include_once("registrar.php");

                        }else{

                            //guardando los datos del formulario

                            try {
                        
                                $name=$_POST["name"];
                                $contador=0;
                                $tipoError1="";
                                $tipoError2="";

                                if(empty($name)){

                                    $contador = $contador + 1;
                                    //echo "Error no dejes ningun espacio en blanco. ";
                                    $tipoError1 = "No dejes ningun espacio en blanco. ";
                                }

                                if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]{4,29}$/i", trim($name)) !== 1) {
                                    $contador = $contador + 1;
                                    //echo "El nombre es incorrecto, solo letras. ";
                                    $tipoError2 = "El nombre es incorrecto, solo letras. ";
                                    
                                }

                                if($contador > 0){

                                   // $ErrorFinal = $tipoError . $tipoError2

                                    ?>

                                    <script>

                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Corregir los siguientes errores',
                                        html: '<?php echo "<div>$tipoError1<br>$tipoError2<br></div>" ?>',
                                        })

                                    </script>

                                    <?php

                                    include_once("registrar.php");

                                }else{

                                    include("conexion.php");

                                    $sql="INSERT INTO tcategoria (nombre) VALUES (:nom)";

                                    $resultado=$base->prepare($sql);

                                    $resultado->execute(array(":nom"=>$name));

                                    echo "<p class='fw-semibold font-monospace'>Nuevo Registro creado correctamente</p>";
                                    
                                    $resultado->closeCursor();

                                }

                                /*
                                if ($name != null) {

                                    include("conexion.php");

                                    $sql="INSERT INTO tcategoria (nombre) VALUES (:nom)";

                                    $resultado=$base->prepare($sql);

                                    $resultado->execute(array(":nom"=>$name));

                                    echo "<p class='fw-semibold font-monospace'>Nuevo Registro creado correctamente</p>";
                                    
                                    $resultado->closeCursor();

                                }else{
                                    echo "Favor de llenar todos los campos";
                                }
                                */
                                
                            } catch (Exception $th) {
                                
                               echo "<p class='fw-semibold font-monospace'>Error favor de llenar todos los campos</p>";
                    
                            }

                        }

                        ?>

                </div>

                

            </div>
            <!-- Fin de esta parte -->

            <!-- Pie de pagina -->
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

    <!-- boton para volver parte superior -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../../js/demo/chart-area-demo.js"></script>
    <script src="../../../js/demo/chart-pie-demo.js"></script>

</body>
</html>