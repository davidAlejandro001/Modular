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
</head>
<body id="page-top">

    <?php 

      session_start();
    //hay algo almacenado ahi?
    if (!isset($_SESSION["usuario"])) {
       header("location:../../index.php");
  }
    ?> 

    <!-- Menu -->
    <div id="wrapper">

        <!-- Parte inicial -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Icono - tipo Usuario -->
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
                Control de Proveedores
            </div>

            <li class="nav-item">
                <a  class="nav-link collapsed" href="proveedores.php"
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

                <!-- Barra -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
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
                <!-- Fin barra -->

                <div class="container-fluid">
                    
                    <?php 
                        include("conexion.php");
                        //si no has pulsado boton actualizar
                        if (!isset($_POST["bot_actualizar"])) {
                            # code...

                            $Id=$_GET["Id"];
                            $Empresa=$_GET["Empresa"];
                            $Nom=$_GET["Nombre"];
                            $Ape=$_GET["Apellido"];
                            $Tel=$_GET["Telefono"];
                            //$visit=$_GET["Visita"];   <------- daba error en algunas partes
                            //$Dia_Visita = explode(", ", $visit);
                            //separando el arreglo
                            
                            include("conexion.php");

                            $sql="SELECT * FROM tproveedor WHERE TProveedor_id = ?";

                            $resultado = array($Id);
                            $stmt = $base->prepare($sql);
                            $stmt->execute($resultado);

                            if($prv=$stmt->fetch(PDO::FETCH_ASSOC)){

                                $visit= $prv['dias_visita'];
                                $Dia_Visita = explode(", ", $visit);

                            }
                            
                            include_once("modify_Form.php");

                        }else{
                            //guardando los datos del formulario
                            $id=$_POST["id"];
                            $empresa = $_POST["empresa"];
                            $name = $_POST["name"];
                            $ape = $_POST["ape"];
                            $phone=$_POST["phone"];
                            $visita=$_POST["visita"];

                            
                            if($empresa != null and $name != null and $ape != null and $phone != null and $visita != null){

                                //separando los datos del arreglo
                                $dias_visita = implode(", " ,$visita);

                                $sql="UPDATE tproveedor SET empresa = :empr, nombre_Repartidor = :nom, apellidos = :ape, telefono = :tel, dias_visita = :dia  WHERE TProveedor_id=:miId";
                                $resultado=$base->prepare($sql);

                                $resultado->execute(array(":miId"=>$id, ":empr"=>$empresa, ":nom"=>$name, ":ape"=>$ape, ":tel"=> $phone, ":dia"=>$dias_visita));
                            
                                echo "<p class='fw-semibold font-monospace'>Registro actualizado con exito</p>";

                            }else{

                                echo "<p class='fw-semibold font-monospace'>Error, no dejes espacios en blanco</p>";

                            }
                            
                            
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