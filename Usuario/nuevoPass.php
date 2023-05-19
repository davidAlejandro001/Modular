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

    <!-- Menu (azul) -->
    <div id="wrapper">

        <!-- Parte inicial -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Icono - Tipo de usuario -->
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
        <!-- End of Sidebar -->
<!-- // ---------------------------------------------------------------------------------------------------------------------------- -->
        <!-- Nombre Usuario -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>
                        
                    </ul>

                </nav>
                <!-- Fin esta Parte -->

                <div class="container-fluid">
                
                <?php 
                    if (isset($_POST["enviar"]) and !isset($_POST["coinciden"])) {
                    
                        include("conexion.php");
                
                        $pass=$_POST["pass"];
                        $pass_real=$_POST["pass_real"];
                        $id = $_POST["Id"];

                        $contador = 0;
                        
                            if ($pass == $pass_real) {

                                ?>

                                <div class="col-8">
                                    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">   

                                        <input type="hidden" name="Id" id="Id" value="<?php echo $id ?>">
                                    
                                        <div>
                                            <label class="form-label">Nueva Contraseña</label>
                                            <input type="password" class="form-control" name="psw1" id="psw1"
                                            placeholder="El password debe tener de 8 a 64 caracteres, al menos un número, una Mayúscula, una minuscula">
                                        </div>

                                        <div>
                                            <label class="form-label">Confirmar Contraseña</label>
                                            <input type="password" class="form-control" name="psw2" id="psw2"
                                            placeholder="El password debe tener de 8 a 64 caracteres, al menos un número, una Mayúscula, una minuscula">
                                        </div>

                                        <div class="my-5">
                                            <button type="submit" class="btn btn-primary" name="coinciden" id="coinciden" >Aceptar</button>
                                        </div>    
                                    </form>
                                </div>

                                <?php

                            }else{

                                ?>

                                <script>

                                Swal.fire({
                                icon: 'error',
                                title: 'Error ',
                                text: "No coincide el password"
                                })

                                </script>
                                <?php
                                ?>

                                <div class="col-8">
                                    <form method="post" action="nuevoPass.php">    
                                    
                                        <div >
                                            <label class="form-label">Ingresa tu Contraseña actual</label>
                                            <input type="password" class="form-control" name="pass" id="pass" placeholder="PASSWORD" value="<?php if(isset($pass)) echo $pass ?>">
                                            <input type="hidden" name="pass_real" id="pass_real" value="<?php echo $pass_real ?>">
                                            <input type="hidden" name="Id" id="Id" value="<?php if(isset($id)) echo $id ?>">
                                        </div>
            
                                        <div class="my-5">
                                            <button type="submit" class="btn btn-primary" name="enviar" id="enviar" >Aceptar</button>
                                        </div>    
                                    </form>
                                </div>

                                <?php
                            }

                        

                    }else if (isset($_POST["coinciden"])) {

                        $pass1=$_POST["psw1"];
                        $pass2=$_POST["psw2"];
                        $Id=$_POST["Id"];

                        $tipoError1 = "";
                        $tipoError2 = "";
                        $tipoError3 = "";


                        $contador=0;

                        if (empty($pass1) || empty($pass2)) {
                            $contador = $contador + 1;
                            $tipoError1 =  "Error, no puedes dejar espacios en blanco. ";
                        }

                        if ($pass1 != $pass2) {
                            $contador = $contador + 1;
                            $tipoError2 =  "No coinciden los passwords. ";

                        }else if(preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", trim($pass1)) !== 1) {
                            
                            $contador = $contador + 1;
                            $tipoError3 = "La longitud minima es de 8 y debe de contener al menos una letra mayuscula y minuscula. ";
                        }

                        if ($contador > 0) {
                            $errorFinal = $tipoError1 . $tipoError2 . $tipoError3;

                            ?>

                            <script>

                                Swal.fire({
                                icon: 'error',
                                title: 'Corregir los siguientes errores: ',
                                html: '<?php echo "<div>$tipoError1<br>$tipoError2<br>$tipoError3<br></div>" ?>',
                                })

                            </script>

                                <div class="col-8">
                                    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">          
                                        
                                        <input type="hidden" name="Id" id="Id" value="<?php if(isset($Id)) echo $Id ?>">
                                    
                                        <div>
                                            <label class="form-label">Nueva Contraseña</label>
                                            <input type="password" class="form-control" name="psw1" id="psw1" value="<?php if(isset($pass1)) echo $pass1 ?>"
                                            placeholder="El password debe tener de 8 a 64 caracteres, al menos un número, una Mayúscula, una minuscula">
                                        </div>

                                        <div>
                                            <label class="form-label">Confirmar Contraseña</label>
                                            <input type="password" class="form-control" name="psw2" id="psw2" value="<?php if(isset($pass2)) echo $pass2 ?>"
                                            placeholder="El password debe tener de 8 a 64 caracteres, al menos un número, una Mayúscula, una minuscula">
                                        </div>

                                        <div class="my-5">
                                            <button type="submit" class="btn btn-primary" name="coinciden" id="coinciden" >Aceptar</button>
                                        </div>    
                                    </form>
                                </div>

                                <?php


                        }else{

                            include("conexion.php");
                        
                            $pass_cifrado=password_hash($pass1,PASSWORD_DEFAULT, array("cost"=>12));

                            $sql="UPDATE t_empleado SET passwordd=:passwd WHERE TEmpleado_id=:miId";
                            $resultado=$base->prepare($sql);

                            $resultado->execute(array(":miId"=>$Id, ":passwd"=>$pass_cifrado));
                        
                            //echo "Registro actualizado con exito " . $pass1;

                            header("Location:../index.php");
                            
                        }



                        //verificando que coincidan los passwords
                        /*if ($pass1==$pass2) {

                            include("conexion.php");

                            //$id = $_SESSION["empleadoID"];
                        
                            $pass_cifrado=password_hash($pass1,PASSWORD_DEFAULT, array("cost"=>12));

                            $sql="UPDATE t_empleado SET passwordd=:passwd WHERE TEmpleado_id=:miId";
                            $resultado=$base->prepare($sql);

                            $resultado->execute(array(":miId"=>$id, ":passwd"=>$pass_cifrado));
                        
                            echo "Registro actualizado con exito";

                            header("Location:../index.php");

                        }else{

                            ?>
                            
                            <hr>
                            <?php

                            echo "no coinciden";
                        }*/


                    }
                
                ?>


                </div>   
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        
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