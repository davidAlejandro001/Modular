<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

    .button {
        background-color: blue; /* Green */
        border: none;
        color: white;
        padding: 5px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 3px;

    }

    </style>

    <title>Document</title>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet">-->
    <link href="../css/sb-inventario.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body id="page-top">

    <?php 

      session_start();
    //Control del usuario
    if (!isset($_SESSION["usuario"])) {
       header("location:../index.php");
  }
    ?> 

    <!-- menu -->
    <div id="wrapper">

        <!-- Inicio del menu Principal -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Icono y tipo de Usuario -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION["perfil"] ?></div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Boton para volver al menu principal -->
            <li class="nav-item active">
                <i class="nav-link"></i>
                <form class="user" action="../comprobar_login2.php" method = "post">

                    <input type="hidden" name="user" value=<?php echo $_SESSION["usuario"] ?>>
                    <input type="hidden" name="password" value=<?php echo $_SESSION["contra"] ?>>
                    
                    <button type="submit" class="button" name="enviar">Menu Principal</button>
                    
                </form>
            </li>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider">

            <!-- Buscar un articulo -->
            <div class="sidebar-heading">
                Historial
            </div>

            <li class="nav-item">
                <!-- icono -->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Acerca de</span>
                </a>
                <!-- Enlaces para acceder -->
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"></h6>
                        <a class="collapse-item" href="Historial.php">Historial de ventas</a>
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
        <!-- Barra para buscar x proveedor y nombre de usuario -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- En caso de que no haya ningun registro se va a ocultar el select -->

                    <?php 
                    
                    include("conexion.php");

                    ?>
                    <!-- Buscar un registro en especifico -->
                    
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="input-group">
                            <div class="col">
                                <input type="date" name="fecha_ingreso" class="form-control"  placeholder="Fecha de Inicio" required>
                            </div>
                            <div class="col">
                                <input type="date" name="fechaFin" class="form-control" placeholder="Fecha Final" required>
                            </div>

                            <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" name="enviar">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                    
                                </div>
                            </div>
                        </form>

                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nombre de usuario e imagen -->
                        
                        <?php 

                            if($_SESSION['perfil'] == "Empleado"){

                        ?>
                        
                        <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $_SESSION["usuario"]?></span>
                                    <img class="img-profile rounded-circle"
                                        src="../img/undraw_profile.svg">
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
                                            src="../img/admin.webp">
                                    </a>
                                </li>
                                
                                <?php
                            }
                        

                        ?>
                    </ul>

                </nav>
                <!-- Fin de la barra -->

                <div class="container-fluid">
                    
                    <hr>
 
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Historial de Ventas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                            <?php 

                                if(isset($_POST["enviar"])){

                                //funcion para acomodar la fecha en el formato d-m-Y
                                $fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
                                $fechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));

                                include("conexion.php");
                               
                                $sql="SELECT * FROM tventa INNER JOIN t_empleado WHERE tventa.TEmpleado_id = t_empleado.TEmpleado_id AND tventa.TEmpleado_id = ? AND tventa.fecha BETWEEN ? AND ? ORDER BY tventa.fecha ASC";

                                $resultado = array($_SESSION['empleadoID'],$fechaInit ,$fechaFin);
                                $stmt = $base->prepare($sql);
                                $stmt->execute($resultado);

                                //rowCount = devuelve 0 o 1 si hay o no un usuario     thead-dark  table-light text-dark
                                $num_registro=$stmt->rowCount();

                                if ($num_registro!=0) {

                                ?> 
                                    <table class="table table-striped table table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No. Venta</th>
                                                <th>Fecha</th>
                                                <th>Empleado</th>
                                                <th>Productos</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php

                                    while($dataRow=$stmt->fetch(PDO::FETCH_ASSOC)){

                                        /*$empleado_id=$dataRow['TEmpleado_id'];
                                        
                                        $resultado2=$base->query("SELECT * FROM t_empleado WHERE TEmpleado_id=$empleado_id")->fetchAll(PDO::FETCH_OBJ);

                                        foreach($resultado2 as $registro){
                                            $nombre = $registro->nombre;
                                            $ape = $registro->apellidos;
                                        }*/
                                        

                                        ?>
                                        
                                        <tr class=''>
                                            <td><?php echo $dataRow['TVenta_id'] ?></td>
                                            <td><?php echo $dataRow['fecha']; ?></td>
                                            <td><?php echo $dataRow['nombre'] . " " . $dataRow['apellidos'] ?></td>
                                            <td><?php echo $dataRow['productos_Venta'] ?></td>
                                            <td><?php echo $dataRow['total']; ?></td>
                                        </tr>

                                    <?php

                                    }

                                    ?>
                                        </tbody>
                                        </table>
                                    <?php

                                    

                                }else{
                                    //echo "error";
                                    ?>
                                        <script>
                                            Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'No existe ningun registro',
                                        })
                                        </script>
                                    <?php
                                }



                                }

                                ?>    

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- Fin de esta parte -->

            <!-- Pie de Pagina -->
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

    <!-- boton para volver parte superior-->
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