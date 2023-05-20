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
    //Control Usuarios
    if (!isset($_SESSION["usuario"])) {
       header("location:../../index.php");
  }
    ?> 

    <!-- Menu (azul) -->
    <div id="wrapper">

        <!-- Parte inicial -->
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
        <!-- Nombre de Usuario e Imagen -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

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
                <!-- Fin esta parte -->

                <div class="container-fluid">

                    <?php 

                        include("conexion.php");

                        if (!isset($_POST["bot_insertar"])) {

                            include_once("form3.php");

                        }else{

                            //guardando los datos del formulario

                            try {

                                $contador = 0;
                                $tipoError1 = "";
                                $tipoError2 = "";
                                $tipoError3 = "";

                                $nombre = $_POST["nombre"];
                                $stock = $_POST["stock"];
                                $precio = $_POST["precio"];
                                $categoria = $_POST["categ"];
                                $proveedor = $_POST["prov"];
                                $codigoBarras = $_POST["cod"];
                                $compra = $_POST["compra"];
                                $minimo = $_POST["min"];
                                $granel = $_POST["granel"];
                                $granelTipo = $_POST["granelTipo"];

                                $imagen_Nombre = $_FILES['imagen']['name'];
                                $imagen_Tipo = $_FILES['imagen']['type'];
                                $imagen_Size = $_FILES['imagen']['size'];

                                if($imagen_Size > 1000000){

                                    $contador = $contador + 1;
                                    $tipoError2 = "El tamaño de la imagen es demasiado grande";

                                }

                                if($imagen_Tipo == "image/jpg" || $imagen_Tipo == "image/jpeg" || $imagen_Tipo == "image/png" || $imagen_Tipo == "image/webp" ){

                                }else{

                                    $contador=$contador + 1;

                                    $tipoError3 = "Solo se pueden subir imagenes jpg, jpeg, png, y webp";   

                                }

                                if ($nombre == null || $stock == null || $precio == null || $categoria == null || $proveedor == null || $compra == null || $codigoBarras == null || $minimo == null || $granel == null ) {

                                    $contador = $contador + 1;

                                    $tipoError1 =  "No dejar espacios en blanco. ";
                                } 

                                /*if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]{4,30}$/i", trim($nombre)) !== 1) {
                                    $contador = $contador + 1;
                                    $tipoError2 = "El nombre es incorrecto, solo letras. ";
                                }*/
                                
                                if($contador > 0){

                                    //$errorFinal = $tipoError1 . $tipoError2;

                                    ?>

                                    <script>

                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Corregir los siguientes errores: ',
                                        html: '<?php echo "<div>$tipoError1<br>$tipoError2<br>$tipoError3</div>" ?>',
                                        })

                                    </script>

                                    <?php

                                    include("form3.php");

                                }else{

                                    //ruta carpeta destino
                                    $carpeta_Destino = '../../venta/nuevaVenta/img/prod/';

                                    //movemos la imagen del directorio temporal al directorio escogido

                                    move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_Destino.$imagen_Nombre);

                                    if($granel != "No"){

                                        $sql="INSERT INTO tproductos( TCategoria_id, TProveedor_id, nombre_Articulo, codigo_Barras, precio, precio_Compra, granel, Imagen) VALUES (:categ,:prov,:nom,:cod,:costo, :compra, :granel, :img)";
                                        $resultado=$base->prepare($sql);

                                        $resultado->execute(array(":categ"=>$categoria, ":prov"=>$proveedor, ":nom"=>$nombre, ":cod"=>$codigoBarras, ":costo"=>$precio, ":compra"=>$compra, ":granel"=>$granel, ":img"=>$imagen_Nombre));
                                        $lastId = $base->lastInsertId();

                                        $sql2="INSERT INTO tinventario( TProductos_id, stock, stock_minimo) VALUES (:miId, :stock, :min)";
                                        $resultado2=$base->prepare($sql2);

                                        $resultado2->execute(array(":miId"=>$lastId, ":stock"=>$stock, ":min"=>$minimo));

                                        $sql3="INSERT INTO tgranel( TProductos_id, T_TipoGranel_id) VALUES (:miId, :tipoGra)";
                                        $resultado3=$base->prepare($sql3);

                                        $resultado3->execute(array(":miId"=>$lastId, ":tipoGra"=>$granelTipo));
                                    
                                        echo "<p class='fw-semibold font-monospace'>Nuevos Registros Agregados Correctamente</p>";

                                    }else{
                                
                                        $sql="INSERT INTO tproductos( TCategoria_id, TProveedor_id, nombre_Articulo, codigo_Barras, precio, precio_Compra, granel, Imagen) VALUES (:categ,:prov,:nom,:cod,:costo, :compra, :granel, :img)";
                                        $resultado=$base->prepare($sql);

                                        $resultado->execute(array(":categ"=>$categoria, ":prov"=>$proveedor, ":nom"=>$nombre, ":cod"=>$codigoBarras, ":costo"=>$precio, ":compra"=>$compra, ":granel"=>$granel, ":img"=>$imagen_Nombre));
                                        $lastId = $base->lastInsertId();

                                        $sql2="INSERT INTO tinventario( TProductos_id, stock, stock_minimo) VALUES (:miId, :stock, :min)";
                                        $resultado2=$base->prepare($sql2);

                                        $resultado2->execute(array(":miId"=>$lastId, ":stock"=>$stock, ":min"=>$minimo));
                                    
                                        echo "<p class='fw-semibold font-monospace'>Nuevos Registros Agregados Correctamente</p>";

                                    }

                                }

                            } catch (Exception $th) {
                                
                               //die('Error' . $th->getMessage());
                               //echo "Linea del error " . $th->getLine();
                               echo "Error, favor de llenar todos los campos";
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

</body>
</html>