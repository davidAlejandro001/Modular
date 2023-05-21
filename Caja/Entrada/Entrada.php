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
    <script>
        function confirmacion(){
            
            if (confirm("Desea eliminar este Usuario")) {
            return true;
        }return false;

        }

    </script>

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
                        <a class="collapse-item" href="../Salida/Egresos.php">Gastos</a>
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

                <!-- Funcion para esconder el select en caso de que solo exista un usuario, Admin -->
                    
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

                            <div class="container">
      <div class="row">
        <div class="col-1">
         
        </div>
        <div class="col-10">
        <h1 class="my-5">Entrada de dinero a la Caja</h1>

        <form class="my-5" action="Entrada_Dinero.php" method="post">

            <div class="mb-3">
                <label class="form-label">Cantidad de dinero a guardar</label>
                <input  type="number" step="0.01" min="0" class="form-control"  name="cant" id="cant" placeholder="Cantidad de dinero a guardar">
            </div>

            <div class="my-5">
            <button type="submit" class="btn btn-primary" name="enviar">Aceptar</button>
            </div>
  
            
        </form>

        </div>
        <div class="col-1">
          
        </div>
      </div>
    </div>

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