<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet">-->
    <link href="../css/sb-inventario.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body id="page-top">

    <?php 
/*
session_start();
if (!isset($_SESSION["usuario"])) {
   header("location:../index.php");
}*/

    ?> 
 
    <!-- Menu -->
    <div id="wrapper">

        <!-- Parte inicial -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- icono - tipo Usuario -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php //echo $_SESSION["perfil"] ?></div>
            </a>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider my-0">

            <!-- Barra divisoria -->
            <hr class="sidebar-divider my-0">

            <!-- Barra divisoria -->
            <hr class="sidebar-divider">

            <!-- volver a admin prov -->
            <div class="sidebar-heading">
                Ajustes
            </div>

            <li class="nav-item">
                <a  class="nav-link collapsed" href="modify.php"
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

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>
                        
                    </ul>

                </nav>
                <!-- Fin esta parte -->

                <div class="container-fluid">
                
                <?php 
                        try {
                            include("conexion.php");
                 
                            $id=$_POST["id"];
                            $nom=$_POST["nom"];
                            $usu=$_POST["usu"];
                            $ape=$_POST["ape"];

                            $contador = 0;
                            $tipoError1 = "";
                            $tipoError2 = "";
                            $tipoError3 = "";
                            $tipoError4 = "";

                            if (empty($nom) || empty($usu) || empty($ape)) {
                                # code...
                                $contador = $contador + 1;
                                $tipoError1 =  "Error, no puedes dejar espacios vacios. ";
                            }

                            if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]{4,30}$/i", trim($nom)) !== 1) {
                                $contador = $contador + 1;
                                $tipoError2 =  "El nombre es incorrecto, solo letras. ";
                            }

                            if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]{4,50}$/i", trim($ape)) !== 1) {
                                $contador = $contador + 1;
                                $tipoError3 =  "El apellido es incorrecto, solo letras. ";
                            }

                            if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]{4,30}$/i", trim($usu)) !== 1)
                            {
                                $contador = $contador + 1;
                                $tipoError4 = 'Caracteres no validos en el nombre de Usuario. ';
                            }

                            if ($contador > 0) {

                                //$errorFinal = $tipoError1 . $tipoError2 . $tipoError3 . $tipoError4;
                                
                                ?>

                                <script>

                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Corregir los siguientes errores: ',
                                    html: '<?php echo "<div>$tipoError1<br>$tipoError2<br>$tipoError3<br>$tipoError4<br></div>" ?>',
                                    })

                                </script>

                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">          
                                    <div>
                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php 
                                        
                                        if (isset($id)) {
                                            echo $id;
                                        }
                                        
                                        //echo $_SESSION["empleadoID"] ?>">
                                    </div>
                                        
                                    <div >
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="nom" id="nom" value="<?php 
                                        
                                        if (isset($nom)) {
                                            echo $nom;
                                        }
                                        
                                        //echo $_SESSION["nombre"] ?>">
                                    </div>

                                    <div >
                                        <label class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" name="ape" id="ape" value="<?php 
                                        
                                        if (isset($ape)) {
                                            echo $ape;
                                        }
                                        
                                        //echo $_SESSION["apellidos"] ?>">
                                    </div>

                                    <div>
                                        <label class="form-label">Nombre de Usuario</label>
                                        <input type="text" class="form-control" name="usu" id="usu" value="<?php 
                                        
                                        if (isset($usu)) {
                                            echo $usu;
                                        }

                                        //echo $_SESSION["usuario"] ?>">
                                    </div>

                                    <div class="my-5">
                                        <button type="submit" class="btn btn-primary" name="enviar" id="enviar" >Aceptar</button>
                                    </div>    
                                </form>

                                <?php

                            }else{

                                $sql="UPDATE t_empleado SET nombre=:nom, nombre_usuario=:usu, apellidos=:ape WHERE TEmpleado_id=:miId";
                                $resultado=$base->prepare($sql);

                                $resultado->execute(array(":miId"=>$id, ":nom"=>$nom, ":usu"=>$usu, ":ape"=>$ape));
                            
                                echo "Registro actualizado con exito";

                                header("Location:../index.php");

                            }

                        } catch (Exception $th) {
                            echo "error";
                        }
                
                ?>
              
                </div>   
            <!-- Fin esta parte -->

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

    <!-- Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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