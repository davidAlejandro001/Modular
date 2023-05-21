<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

    .button {
        background-color:  blue;
        border: none;
        color: white;
        padding: 5px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 3px;
        outline:none;
    }

    </style>


    <title>Document</title>
 
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Libreria necesaria para el boton de elimminar, tiene que estar al inicio, no al final -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../css/sb-admin-2.css" rel="stylesheet">
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

<?php

Function ContadorRegistros (&$valorId){

    $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
                
    $consulta2="SELECT COUNT(TCaja_id) FROM tcaja";

    $Resultados2=mysqli_query($conexion,$consulta2);

    $row = mysqli_fetch_array($Resultados2);

    $total = $row[0];

}

Function Caja_Id_valor (&$valorId){

    $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
    //en caso de que no exista ningun registro
    $consulta="SELECT IFNULL(MAX(TCaja_id),0) FROM tcaja";
        
    $Resultados=mysqli_query($conexion,$consulta);
        
    $row = mysqli_fetch_array($Resultados);
        
    $max = $row[0];
    //ultima venta efectuada
    $valorId = $max + 1;

    return $valorId;

}

?>

    <!-- Inicio del menu -->
    <div id="wrapper">

        <!-- Parte inicial -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Icono y tipo de Usuario -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <!-- Icono -->
                    <i class="fas fa-store"></i>
                </div> 
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION["perfil"] ?></div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Boton para volver al menu principal -->

            <li class="nav-item active">
                <i class="nav-link"></i>
                <form class="user" action="../../comprobar_login2.php" method = "post">

                    <input type="hidden" name="user" value=<?php echo $_SESSION["usuario"] ?>>
                    <input type="hidden" name="password" value=<?php echo $_SESSION["contra"] ?>>
                    
                    <button type="submit" class="button" name="enviar">Menu</button>
                    
                </form>
            </li>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider">

            <!-- Administracion -->
            <div class="sidebar-heading">
                Caja
            </div>

            <!-- Icono y enlaces -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <!-- Icono -->
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Opciones de..</span>
                </a>
                <!-- Enlaces -->
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="Entrada.php">Entrada</a>
                        <a class="collapse-item" href="../Egresos.php">Gastos</a>
                        <a class="collapse-item" href="../Corte/CorteCaja.php">Corte de caja</a>
                    </div>
                </div>
            </li>


            <!-- Barra divisoria -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- Fin menu -->
<!-- // ---------------------------------------------------------------------------------------------------------------------------- -->
        <!-- Barra para buscar un empleado en especifico -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    
                    <!-- Nombre del Usuario e Imagen -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <?php 

                            if($_SESSION['perfil'] == "Empleado"){

                        ?>
                        
                        <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $_SESSION["usuario"]?></span>
                                    <img class="img-profile rounded-circle"
                                        src="../../img/undraw_profile.svg">
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
                                            src="../../img/admin.webp">
                                    </a>
                                </li>
                                
                                <?php
                            }
                        

                        ?>
                        
                    </ul>

                </nav>
                <!-- Fin de esta parte -->

                <div class="container-fluid">
                    
                    <hr>
                    <!-- Inicio de la tabla -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Entradas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <?php 

                                include("conexion.php");
                                
                                if(isset($_POST["enviar"])){
                                    $cant=$_POST["cant"];

                                    $contador=0;
                                    $tipoError1="";
                                    $tipoError2="";

                                    if(empty($cant)){

                                        $tipoError1="No puedes dejar espacios en blanco.";
                                        $contador = $contador + 1;
                                    }
        
                                    if($contador > 0){
                                        ?>
                                        <script>
        
                                                Swal.fire({
                                                icon: 'error',
                                                title: 'Corregir los siguientes errores: ',
                                                html: '<?php echo "<div>$tipoError1<br>$tipoError2</div>" ?>',
                                                })
        
                                        </script>
                                        <?php
        
                                        include_once("form.php");
        
                                    }else{
        
                                        $cont;

                                        (ContadorRegistros($cont));

                                        $idCaja;

                                        (Caja_Id_valor($idCaja));

                                        if($cont == 0){

                                            //se va a guardar en Fondo

                                            date_default_timezone_set('America/Mexico_City');

                                            $fechaGuardar = date('Y-m-d');

                                            include("conexion.php");

                                            $sql="INSERT INTO tcaja (TCaja_id ,Fondo_Caja, fecha, entrada, egresos, totalVentas, totalGanancias) VALUES (:id ,:fondo, :fecha, :ent, :egr, :tot, :gan)";

                                            $resultado=$base->prepare($sql);

                                            $resultado->execute(array(":id"=>$idCaja ,":fondo"=>$cant ,":fecha"=>$fechaGuardar, ":ent"=>0, ":egr"=>0, ":tot"=>0, ":gan"=>0));

                                            echo "<p class='fw-semibold font-monospace'>Nuevo Registro creado correctamente</p>";
                                        
                                            $resultado->closeCursor();

                                        }else{

                                            //se va a guardar en Entrada

                                            date_default_timezone_set('America/Mexico_City');

                                            $fechaGuardar = date('Y-m-d');

                                            include("conexion.php");

                                            $sql="SELECT * FROM tcaja WHERE fecha = ?";
                                            
                                            $resultado = array($idCaja, $fechaGuardar);
                                            $stmt = $base->prepare($sql);
                                            $stmt->execute($resultado);

                                            if($caja=$stmt->fetch(PDO::FETCH_ASSOC)){

                                                $entrada= $caja['entrada'];
                                                $id = $caja['TCaja_id'];
                                            }

                                            $nuevaEntrada = $entrada + $cant;

                                            $sql2="UPDATE tcaja SET entrada = :entr  WHERE TCaja_id=:miId and fecha = ?";
                                            $resultado2=$base->prepare($sql2);

                                            $resultado2->execute(array(":miId"=>$id, ":fecha"=>$fechaGuardar, ":entr"=>$nuevaEntrada));
                                



                                        }

                                    }
                                }
                                
                                ?>

                            </div>
                        </div>
                    </div>

                </div>

                

            </div>
            <!-- Fin de la tabla -->

            <!-- Pie de pagina -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;</span>
                    </div>
                </div>
            </footer>
            <!-- Fin del pie de pagina -->

        </div>

    </div>

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