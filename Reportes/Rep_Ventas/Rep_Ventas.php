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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../css/sb-admin-2.css" rel="stylesheet">
    <link href="../../css/sb-admin-2.css" rel="stylesheet">-->
    <link href="../../css/sb-inventario.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<body id="page-top">

    <?php 

      session_start();
    //Control de los usuarios
    if (!isset($_SESSION["usuario"])) {
       header("location:../../index.php");
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
                    
                    <button type="submit" class="button" name="enviar">Menu Principal</button>
                    
                </form>
            </li>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider">

            <!-- Administracion -->
            <div class="sidebar-heading">
                Reportes
            </div>

            <!-- Icono y enlaces -->
            <li class="nav-item">
                <!-- Nota: cambiar el nombre #collapsetwo por uno diferente sino se van a abrir dos -->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRep"
                    aria-expanded="true" aria-controls="collapseRep">
                    <i class='fas fa-clipboard-list'></i>
                    <span>Tipos de reportes</span>
                </a>
                <!-- Enlaces para acceder -->
                <div id="collapseRep" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../Gastos/Gastos.php">Gastos</a>
                        <a class="collapse-item" href="../Mermas/Mermas.php">Mermas</a>
                        <a class="collapse-item" href="Rep_Ventas.php">Ventas</a>
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

                    <div style="text-align: right;">

                    <?php
                    //boton de descarga solo va a aparecer si encuentra alguna coincidencia
                    if(isset($_POST["enviar"])){

                        //funcion para acomodar la fecha en el formato d-m-Y
                        $fechaIni = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
                        $fecha_Fin  = date("Y-m-d", strtotime($_POST['fechaFin']));
                        
                        include("conexion.php");
                        $sql2="SELECT * FROM tventa WHERE fecha BETWEEN ? AND ? ORDER BY fecha ASC";

                        $resultado2 = array($fechaIni ,$fecha_Fin);
                        $stmt2 = $base->prepare($sql2);
                        $stmt2->execute($resultado2);

                        //rowCount = devuelve 0 o 1 si hay o no un usuario
                        $num_registro2=$stmt2->rowCount();

                        if ($num_registro2!=0) {

                            ?>
                            <!--<form action="descargar.php" method="post" accept-charset="utf-8">
                                <input type="hidden" name="fecha_ingreso" value="<?php //echo $fechaIni ?>">
                                <input type="hidden" name="fechaFin" value="<?php //echo $fecha_Fin ?>">
                                <button class="btn btn-danger" type="submit">Descargar</button>
                            </form>-->

                            <form action="descargar_PDF.php" method="POST" target="_blank">
                                <input type="hidden" name="fecha_ingreso" value="<?php echo $fechaIni ?>">
                                <input type="hidden" name="fechaFin" value="<?php echo $fecha_Fin ?>">
                                <input type="submit" role="button" class="btn btn-danger" value="Descargar Reporte" name="enviar">

                            </form>

                            <?php

                        }    

                    }

                    ?>

                    </div>

                    <hr>
                    <!-- Inicio de la tabla -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Reportes de Ventas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive resultadoFiltro">

                                <?php 

                                    if(isset($_POST["enviar"])){

                                    //funcion para acomodar la fecha en el formato d-m-Y
                                    $fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
                                    $fechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));

                                    include("conexion.php");
                                    //$sql="SELECT * FROM tventa WHERE fecha BETWEEN ? AND ? ORDER BY fecha ASC";
                                    $sql="SELECT * FROM tventa INNER JOIN t_empleado WHERE tventa.TEmpleado_id = t_empleado.TEmpleado_id AND fecha BETWEEN ? AND ? ORDER BY fecha ASC";
                                    
                                    $resultado = array($fechaInit ,$fechaFin);
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