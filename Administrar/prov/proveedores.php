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

    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Libreria necesaria para el boton de elimminar, tiene que estar al inicio, no al final -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../css/sb-admin-2.css" rel="stylesheet">--> 
    <link href="../../css/sb-inventario.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script>
        function confirmacion(){
        if (confirm("Desea eliminar este Registro?")) {
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

    <!-- Menu (azul) -->
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

            <!-- Admin -->
            <div class="sidebar-heading">
                Administración
            </div>

            <!-- Icono y Enlaces -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <!-- Icono -->
                    <i class="fas fa-cubes"></i>
                    <span>Control de..</span>
                </a>
                <!-- Enlaces -->
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"></h6>
                        <a class="collapse-item" href="../empleados/empleados.php">Empleados</a>
                        <a class="collapse-item" href="../Inventario/inventario.php">Inventario</a>
                        <a class="collapse-item" href="proveedores.php">Proveedores</a>
                    </div>
                </div>
            </li>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- Fin Menu -->
<!-- // ---------------------------------------------------------------------------------------------------------------------------- -->
        <!-- Barra para buscar proveedor en especifico -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Buscar un registro en especifico -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                    action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Nombre Empresa"
                                aria-label="Search" aria-describedby="basic-addon2" name="prov">
                        <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="enviar">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">                        
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nombre de Usuario -->
                        
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

                <!-- boton insertar nuevo registro -->
                <div style="text-align: right;">
                      <a href="insertar.php" role="button" class="btn btn-success">Insertar</a>
                </div> 
                    
                    
                    <hr>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Proveedores</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                    <?php 

                    if (isset($_POST["enviar"])) {
                        try {
                            
                            $prov=$_POST["prov"];

                            include("conexion.php");

                            $sql="SELECT * FROM tproveedor WHERE  empresa LIKE ?";

                            $resultado = array("%$prov%");
                            $stmt = $base->prepare($sql);
                            $stmt->execute($resultado);

                            //rowCount = devuelve 0 o 1 si hay o no un usuario
                            $num_registro=$stmt->rowCount();

                            if ($num_registro!=0) {

                                        while($proveedor=$stmt->fetch(PDO::FETCH_ASSOC)){

                                            ?>

                                        <div class="container">
                                            <div class="row">

                                            <div class="col-2">
                                                
                                            </div>

                                            <div class="col-8">

                                                <form name="form1" method="post">

                                                    
                                                    <!-- -------------------------------------------------  Nombre -------------------------------------------------------- -->
                                                    <td>
                                                    <div >
                                                        <input type="hidden" value=<?php echo $proveedor['TProveedor_id'] ?>>
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div class="my-3">
                                                        <label for="">Empresa</label>
                                                        <input type="text" class="form-control" name="empresa" id="empresa" disabled readonly value="<?php 
                                                        
                                                        echo $proveedor['empresa']
                                                        
                                                        ?>">
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div class="my-3">
                                                        <label for="">Nombre del Repartidor</label>
                                                        <input type="text" class="form-control" name="nombre" id="nombre" disabled readonly value="<?php 
                                                        
                                                        echo $proveedor['nombre_Repartidor']
                                                        
                                                        ?>">
                                                    </div>
                                                    </td>

                                                    <div class="my-3">
                                                        <label for="">Apellidos</label>
                                                        <input type="text" class="form-control" name="ape" id="ape" disabled readonly value="<?php 
                                                        
                                                        echo $proveedor['apellidos']
                                                         
                                                        ?>">
                                                    </div>
                                                    
                                                    <div class="my-3">
                                                        <label for="">Telefono</label>
                                                        <input type="text" class="form-control" name="tel" id="tel" disabled readonly value="<?php 
                                                        
                                                        echo $proveedor['telefono']
                                                        
                                                        ?>">
                                                    </div>

                                                    <div class="my-3">
                                                        <label for="">Dias de visita</label>
                                                        <input type="text" class="form-control" name="dia" id="dia" disabled readonly value="<?php 
                                                        
                                                        echo $proveedor['dias_visita']
                                                        
                                                        ?>">
                                                    </div>

                                                    <!-- -----------------------------------------------------------------------------------------------------------------  -->
                                                    
                                                    <div class="my-3">
                                                        <label for="">Acciones</label>
                                                        <br>
                                                        <td>

                                                        <a href="modify.php?Id=<?php echo $proveedor['TProveedor_id']?> & 
                                                    Empresa=<?php echo $proveedor['empresa']?> &
                                                    Nombre=<?php echo $proveedor['nombre_Repartidor']?> &
                                                    Apellido=<?php echo $proveedor['apellidos']?> &
                                                    Telefono=<?php echo $proveedor['telefono']?>
                                                    "><img src="../../css/modificar.png" width=40 height=40></a>
                                                
                                                    <a role="button" class="deleteBtn" onclick="alertaEliminar(<?php echo $proveedor['TProveedor_id'] ?>) "><img src="../../css/borrar.png" width=40 height=40></a>

                                                        </td>
                                                        
                                                    </div>
                                                    
                                                    </form>
                                                </div>
                                            <div class="col-2">
                                                    
                                            </div>
                                            </div>
                                            </div>

                                            <?php
                                        }

                                    ?>
                                <?php

                            }
                            
                        } catch (Exception $e) {
                            die("Error " . $e->getMessage());
                        }

                    }else{

                        //-------------------------------------------------------------------- paginacion-----------------------
                            //se va a ejecutar isset al dar clic en el link

                            //mostrar la pagina en la que estamos

                            include("conexion.php");
                            $pagina = 1;
                            if(isset($_GET['pagina'])) {
                                $pagina = $_GET['pagina'];
                            }

                            $sql_total="SELECT * FROM tproveedor";

                            //cuantas pags tendra
                            $tamanio_pags=5;
                            
                            $empezar_desde=($pagina-1)* $tamanio_pags;

                            $resultado=$base->prepare($sql_total);

                            $resultado->execute(array());
                            //CUANTA FILAS DEVUELVE LA CONSULTA, para eso usamos la primera funcion sql, 
                            $num_registros=$resultado->rowCount();
                            //ceil(redondea resultado);
                            $total_pags=ceil($num_registros/$tamanio_pags);
                    

                            //--------------------------------------------------------------------------------------
 
                        include("conexion.php");

                        $registros=$base->query("SELECT * FROM tproveedor ORDER BY empresa ASC LIMIT $empezar_desde, $tamanio_pags")->fetchAll(PDO::FETCH_OBJ);

                        ?>
                                

                        <table class='table table-bordered table table-hover' id='dataTable' width='100%' cellspacing='0'>
                            <thead class='thead-dark'>
                            <tr>
                                <th></th>
                                <th>Empresa</ht>
                                <th>Nombre Repartidor</th>
                                <th>Apellidos</th>
                                <th>Telefono</th>
                                <th>Dias de Visita</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <?php
                            foreach ($registros as $proveedor):?>
                            <tr class='table-light text-dark'>
                                <td><input type="hidden" value=<?php echo $proveedor->TProveedor_id ?>></td>
                                <td class='text-capitalize'><?php echo $proveedor->empresa?></td>
                                <td><?php echo $proveedor->nombre_Repartidor ?></td>
                                <td><?php echo $proveedor->apellidos ?></td>
                                <td><?php echo $proveedor->telefono?></td>
                                <td><?php echo $proveedor->dias_visita?></td>
                                <td><a href="modify.php?Id=<?php echo $proveedor->TProveedor_id?> & 
                                                Empresa=<?php echo $proveedor->empresa?> &
                                                Nombre=<?php echo $proveedor->nombre_Repartidor?> &
                                                Apellido=<?php echo $proveedor->apellidos?> &
                                                Telefono=<?php echo $proveedor->telefono?>
                                                
                                                "><img src="../../css/modificar.png" width=40 height=40></a>
                                                
                                <a class="deleteBtn" role="button" onclick="alertaEliminar(<?php echo $proveedor->TProveedor_id ?>)"><img src="../../css/borrar.png" width=40 height=40></a></td>
                            </tr> 
                            <?php endforeach;   ?>
                        </table>

                    
               
                    <?php  
                    //------------------------PAGINACION-----------------------
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

                    <?php
                
                    }

                    ?>

                    </div>
                    </div>
                    </div>
                </form>
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
            <!-- Fin pie pag -->

        </div>

    </div>

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


    <!-- Funcion para Eliminar $('#Nom').val(data[1]);  -->
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