<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <style>

    .button {
        background-color: #4e73df; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 4px;
 
    }

    </style>

    <title>Proyecto</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template
    <link href="css/sb-admin-2 copy.css" rel="stylesheet">-->
    <link href="css/sb-inventario.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    
</head>
<body id="page-top">
        <?php 

            //Control del inicio de sesion
            if (!isset($_SESSION["usuario"])) {
                header("location:index.php");
            }
        ?> 

    <!-- Inicio del menu -->

    <div id="wrapper">

        <!-- parte inicial -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- icono y tipo de usuario-->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <!-- Icono -->
                <div class="sidebar-brand-icon ">
                    <i class="fas fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION["perfil"] ?></div>
            </a>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider my-0">

            <!-- Barra divisoria -->
            <hr class="sidebar-divider">

            <!-- Barra divisoria -->
            <div class="sidebar-heading">
                Administración
            </div>
            
            <li class="nav-item">
                <!-- icono -->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa fa-cubes"></i>
                    <span>Control de..</span>
                </a>
                <!-- Enlaces para acceder -->
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"></h6>
                        <a class="collapse-item" href="Administrar/empleados/empleados.php">Empleados</a>
                        <a class="collapse-item" href="Administrar/Inventario/inventario.php">Inventario</a>
                        <a class="collapse-item" href="Administrar/prov/proveedores.php">Proveedores</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <!-- Filtro para buscar articulos -->
            <div class="sidebar-heading">
                Caja
            </div>

            <li class="nav-item">
                <!-- Nota: cambiar el nombre #collapsetwo por uno diferente sino se van a abrir dos -->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCaja"
                    aria-expanded="true" aria-controls="collapseCaja">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>opciones: </span>
                </a>
                <!-- Enlaces para acceder -->
                <div id="collapseCaja" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="Caja/Entrada/Entrada.php">Entrada</a>
                        <a class="collapse-item" href="Caja/Salida/Egresos.php">Gastos</a>
                        <a class="collapse-item" href="Caja/Corte/CorteCaja.php">Corte de caja</a>
                    </div>
                </div>
            </li>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider">

            <!-- Punto de Venta -->
            <div class="sidebar-heading">
                Servicio
            </div>
            <!-- icono -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-calculator"></i>
                    <span>Venta</span>
                </a>
                <!-- Enlace -->
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="venta/nuevaVenta/venta1.php">Nueva Venta</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <!-- Filtro para buscar articulos -->
            <div class="sidebar-heading">
                Reportes
            </div>

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
                        <a class="collapse-item" href="Reportes/Gastos/Gastos.php">Gastos</a>
                        <a class="collapse-item" href="Reportes/Mermas/Mermas.php">Mermas</a>
                        <a class="collapse-item" href="Reportes/Rep_Ventas/Rep_Ventas.php">Ventas</a>
                    </div>
                </div>
            </li>

            <!-- Barra divisoria -->

        </ul>
        <!-- Fin del Menu -->
<!-- // ---------------------------------------------------------------------------------------------------------------------------- -->
        <!-- Contenedor de la barra para salir de la sesion (login) -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php //echo Pagina Principal?></h1>
                    </div>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nombre del usuario e imagen -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $_SESSION["usuario"]?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/admin.webp">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="Usuario/modify.php" >
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Gestionar tu cuenta
                                </a>

                                <a class="dropdown-item" href="cierre.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesion
                                </a>
                                
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- fin barra de login -->

                <!-- Inicio del menu informativo (blanco) -->
                <div class="container-fluid">
<!-- // ---------------------------------------------------------------------------------------------------------------------------- -->
                    <hr>
                    <!-- todavia falta actualizar esto -->
                    <!-- Contenido de los cuadros informativos del menu principal -->

                    <div class="row">
                        <div class="col-xl-1 col-md-7 mb-4">
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Caja</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Historial de ventas (Al dia) /c empleado</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php include("Recursos/totalVentas.php") ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Personal</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php include("Recursos/personal.php") ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Page Heading 
                    <div class="row">-->

                        <!-- Cantidad total del personal de la tienda 
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Personal</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php include("Recursos/personal.php") ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        <!-- Historial de ventas realizadas al dia (general) 
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Historial de ventas (Al dia) /c empleado</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php include("Recursos/totalVentas.php") ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        <!-- Caja 
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Caja</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                    <!--</div>-->

                     <!-- Fin de los cuadros informativos --> 

                    <!-- grafica -->

                    <div class="row">
                        <div class="col-xl-1 col-md-7 mb-4">
                        </div>

                        <div class="col-xl-10 col-lg-5">
                            <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Abarrotes "San Juan Pablo II"</h6>
                                </div>
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between col-8">
                                    <?php include("Recursos/ejemplo.php") ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-1 col-md-6 mb-4">
                        </div>
                    </div>

                    <!--

                    <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Abarrotes "San Juan Pablo II"</h6>
                                </div>
                                <div class="card-body">
                                    <div class="center">
                                    <?php include("Recursos/ejemplo.php") ?>
                                    </div>
                                </div>
                            </div>
                    </div>
                    -->

                </div>
                <!-- Fin del contenedor -->

            </div>
            <!-- Fin del contenido principal -->

            <!-- Pie de pagina 
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;</span>
                    </div>
                </div
            </footer>-->
            <!-- Fin del pie de pagina -->

        </div>

    </div>
    <!-- Control del cuadro de dialogo al dar clic en cerrar sesion -->

    <!-- Boton para volver arriba -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Cerrar sesion -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Seguro que desea cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Si desea cerrar sesion pulse el botón "cerrar sesión".</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="cierre.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery/jquery.min.js"></script>
    

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins 
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>-->

    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>
</html>

<!-- para los iconos: https://fontawesomeicons.com/laugh-wink -->