<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Libreria necesaria para el boton de elimminar, tiene que estar al inicio, no al final -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../../css/sb-admin-2.css" rel="stylesheet">-->
    <link href="../../../css/sb-inventario.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<body id="page-top">

    <?php 

      session_start();
    //Control de los usuarios
    if (!isset($_SESSION["usuario"])) {
       header("location:../../../index.php");
  }
    ?> 

    <!-- Menu(azul) -->
    <div id="wrapper">

        <!-- Parte Inicial -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Icono - Tipo Usuario -->
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
                <a  class="nav-link collapsed" href="../inventario.php"
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
        <!-- Fin del Menu -->
<!-- // ---------------------------------------------------------------------------------------------------------------------------- -->
        <!-- Nombre Usuario -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nombre de usuario e imagen -->
                        
                        <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $_SESSION["usuario"]?></span>
                                    <img class="img-profile rounded-circle"
                                        src="../../../img/admin.webp">
                                </a>
                        </li>
                        
                    </ul>

                </nav>
                <!-- Fin de esta parte / Inicio Tabla -->

                <div class="container-fluid">

                    <div style="text-align: right;">
                        <a href="insertar.php" role="button" class="btn btn-success">Insertar</a>
                    </div> 
                    
                    <hr>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Categorias</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                    <?php 

                    include("conexion.php");

                    //-------------------------------------------------------------------- paginacion-----------------------

                    $pagina = 1;
                            if(isset($_GET['pagina'])) {
                                $pagina = $_GET['pagina'];
                            }

                            $sql_total="SELECT * FROM tcategoria";

                            //cuantas pags tendra
                            $tamanio_pags=10;
                            
                            $empezar_desde=($pagina-1)* $tamanio_pags;

                            $resultado=$base->prepare($sql_total);

                            $resultado->execute(array());
                            //CUANTA FILAS DEVUELVE LA CONSULTA, para eso usamos la primera funcion sql, 
                            $num_registros=$resultado->rowCount();
                            //ceil(redondea resultado);
                            $total_pags=ceil($num_registros/$tamanio_pags);
                    

                            //--------------------------------------------------------------------------------------

                    $registros=$base->query("SELECT * FROM tcategoria ORDER BY nombre ASC LIMIT $empezar_desde, $tamanio_pags")->fetchAll(PDO::FETCH_OBJ);

                    ?>
                                
                        <table class='table table-bordered table table-hover' id='dataTable' width='100%' cellspacing='0'>
                            <thead class='thead-dark'>
                            <tr>
                                <th></th>
                                <th>Nombre</ht>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <?php
                            foreach ($registros as $cate):?>

                            <tr class='table-light text-dark'>
                                <td><input type='hidden' value= "<?php echo $cate->TCategoria_id ?>"></td>
                                <td class='text-capitalize'><?php echo $cate->nombre?></td>

                                <td><a href="modify.php?Id=<?php echo $cate->TCategoria_id?> & 
                                                Nom=<?php echo $cate->nombre?>"><img src="../../../css/modificar.png" width=40 height=40></a>
                                                
                                    <a class="deleteBtn" role="button" onclick="alertaEliminar(<?php echo $cate->TCategoria_id ?>)"><img src="../../../css/borrar.png" width=40 height=40></a></td>
                            </tr>
                            <?php endforeach;   ?>
                        </table>
                                        
                    <?php
                    //-------------------------  paginacion -----------------------
                    ?>

                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">

                                            <?php 
                                            
                                            for ($i=1; $i <=$total_pags ; $i++) { 

                                                echo "<li class='page-item'><a class='page-link' href = '?pagina=$i' >$i</a><li> ";
                                
                                            }
                                            
                                            ?>

                                        </ul>
                                    </nav>

                    </div>
                    </div>
                    </div>
                </form>
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

     <!-- Boton de Eliminar -->
     <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="delete.php" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
               
                <div class="form-group">
                    <h5 class="modal-title" id="exampleModalLabel">Desea Eliminar el Registro?</h5>
                    <hr>
                    <input type="text" id="Nom" name="Nom" class="form-control" readonly>
                </div>
                <input type="hidden" id="Id" name="Id">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Una vez hecho, no podra revertirlo.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="deleteData" class="btn btn-primary">Eliminar</button>
                </div>
            </div>
        </div>
        </form>
    </div>


    <!-- Funcion para Eliminar -->
    <script>

        function alertaEliminar(codigo){
        $('.deleteBtn').on('click',function(){
            $('#deleteModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                $('#Id').val(codigo);
                $('#Nom').val(data[1]);
        })
    }
    </script>



    <!-- Bootstrap core JavaScript-->
    <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../../js/demo/chart-area-demo.js"></script>
    <script src="../../../js/demo/chart-pie-demo.js"></script>

</body>
</html>