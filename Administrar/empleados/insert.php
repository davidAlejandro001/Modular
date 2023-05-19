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

      session_start();
    //hay algo almacenado ahi?
    if (!isset($_SESSION["usuario"])) {
       header("location:../../index.php");
  }
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
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION["perfil"] ?></div>
            </a>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider">

            <!-- admin empleados -->
            <div class="sidebar-heading">
                Administracion
            </div>
            
            <li class="nav-item">
                <a  class="nav-link collapsed" href="empleados.php"
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
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $_SESSION["usuario"]?></span>
                                    <img class="img-profile rounded-circle"
                                        src="../../img/admin.webp">
                                </a>
                        </li>
                    </ul>

                </nav>
                <!-- Fin esta Parte -->

                <div class="container-fluid">

                    <?php 

                        include("conexion.php");

                        if (!isset($_POST["enviar"])) {

                            include_once("Registrar.php");

                        }else{

                            //guardando los datos del formulario

                            try {
                                //contador para deteccion de errores
                                $contador=0;

                                $usuario=$_POST["login"];
                                $password=$_POST["password"];
                                $password2=$_POST["password2"];
                                $perfil=$_POST["perfil"];
                                $nombre = $_POST["name"];
                                $apellido=$_POST["ape"];

                                $tipoError1="";
                                $tipoError2="";
                                $tipoError3="";
                                $tipoError4="";
                                $tipoError5="";
                                $tipoError6="";

                                if (empty($usuario) || empty($password) || empty($perfil) || empty($nombre) || empty($apellido)) {
                                 
                                    $tipoError1 = 'Error, no puedes dejar espacios vacios. ';
                                    $contador=$contador+1;

                                }

                                if($password != $password2 and $password != null){

                                    $contador = $contador + 1;
                                    $tipoError2 =  'No coincide la contraseña. ';

                                }
                                
                                if(preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", trim($password)) !== 1) {
                                    $contador = $contador + 1;
                                    $tipoError3 = 'La longitud minima es de 8 y contener al menos una letra mayuscula y minuscula. ';
                                }

                                //verificando que tenga al menos una mayuscula

                                if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]{4,30}$/i", trim($nombre)) !== 1) {
                                    $contador = $contador + 1;
                                    $tipoError4 =  'El nombre es incorrecto, solo letras. '; 
                                }

                                if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]{4,50}$/i", trim($apellido)) !== 1) {
                                    $contador = $contador + 1;
                                    $tipoError5 =  'El apellido es incorrecto, solo letras. ';
                                }

                                if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]{4,30}$/i", trim($usuario)) !== 1)
                                {
                                    $contador = $contador + 1;
                                    $tipoError6 = 'Caracteres no validos en el nombre de Usuario. ';
                                }

                                //mostrando otra vez la ventana de ingreso de datos
                                if($contador>0){

                                   // $errorFinal = $tipoError1 . $tipoError2 . $tipoError3 . $tipoError4 . $tipoError5 . $tipoError6;
                                    //$errorFinal = $tipoError1 . "" .  $tipoError2
                                    //text: "<?php echo "soy una linea\t yo otra"

                                    

                                    ?>
                                    
                                    <script>

                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Corregir los siguientes errores: ',
                                        html: '<?php echo "<div>$tipoError1<br>$tipoError2<br>$tipoError3<br>$tipoError4<br>$tipoError5<br>$tipoError6<br></div>" ?>',
                                        })

                                    </script>

                                    <?php
                                    
                                    include_once("Registrar.php");

                                    
                                }else{

                                    $pass_cifrado=password_hash($password,PASSWORD_DEFAULT, array("cost"=>12));

                                    include("conexion.php");

                                    $sql="INSERT INTO t_empleado(TPerfil_id, nombre, apellidos, nombre_usuario, passwordd) VALUES (:perf,:nom, :ape, :user, :passwd)";

                                    $resultado=$base->prepare($sql);

                                    $resultado->execute(array(":user"=>$usuario, ":passwd"=>$pass_cifrado, ":perf"=>$perfil, ":nom"=>$nombre, ":ape"=>$apellido));

                                    echo "Nuevo Registro creado correctamente";

                                    $resultado->closeCursor();

                                }

                            //OJO CAMBIAR EL NUM CARACTERES PASSWORD XQ SINO VA A DAR ERROR, LA CADENA QUE SE GENERA ES MUY LARGA
                        
                                /*$usuario=$_POST["login"];
                                $password=$_POST["password"];
                                $perfil=$_POST["perfil"];
                                $nombre = $_POST["name"];
                                $apellido=$_POST["ape"];

                                if ($usuario != null and $password != null and $perfil != null and $nombre != null and $apellido != null) {
                                    # code...

                                    $pass_cifrado=password_hash($password,PASSWORD_DEFAULT, array("cost"=>12));

                                    include("conexion.php");

                                    $sql="INSERT INTO t_empleado(TPerfil_id, nombre, apellidos, nombre_usuario, passwordd) VALUES (:perf,:nom, :ape, :user, :passwd)";

                                    $resultado=$base->prepare($sql);

                                    $resultado->execute(array(":user"=>$usuario, ":passwd"=>$pass_cifrado, ":perf"=>$perfil, ":nom"=>$nombre, ":ape"=>$apellido));

                                    echo "Nuevo Registro creado correctamente";

                                    $resultado->closeCursor();

                                }else{

                                    echo "Favor de llenar todos los campos";

                                }*/

                            } catch (Exception $th) {
                                //
                                //die('Error' . $th->getMessage());
                               // echo "Linea del error " . $th->getLine();
                               echo "Error favor de llenar todos los campos";
                    
                            }

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