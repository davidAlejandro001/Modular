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

    <!-- /////////////////////////////////////////////////////////////////////////////////////////////// -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script src="java.js"></script>

</head>
<body id="page-top">

    <?php 

      session_start();
    //Control de los usuarios
    if (!isset($_SESSION["usuario"])) {
       header("location:../index.php");
  }
    ?> 

    <!-- Menu (azul)-->
    <div id="wrapper">

        <!-- Inicio del menu -->
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
                Catalogo de Artículos
            </div>

            <!-- Icono -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-search"></i>
                    <span>Buscar por..</span>
                </a>
                <!-- Enlaces -->
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Buscar un articulo:</h6>
                        <a class="collapse-item" href="buscarCategoria.php">Categoria</a>
                        <a class="collapse-item" href="buscarArticulo.php">Código o nombre</a>
                        <a class="collapse-item" href="buscarProveedor.php">Proveedor</a>
                    </div>
                </div>
            </li>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- Fin menu (azul) -->
<!-- // ---------------------------------------------------------------------------------------------------------------------------- -->
        <!-- Barra para buscar x categoria y nombre de usuario -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Codigo para esconder la barra de busqueda en caso de que no se haya registrado ningun articulo -->
                    <?php 
    
                    $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
                    
                    $consulta2="SELECT COUNT(TProductos_id) FROM tproductos";

                    $Resultados2=mysqli_query($conexion,$consulta2);

                    $row = mysqli_fetch_array($Resultados2);

                    $total = $row[0];

                    if ($total>0) {
                        # code...

                    ?>

                    <!-- Buscar un articulo x codigo de barras o nombre -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                    action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="input-group">
                        <input class="typeahead form-control" type="text" placeholder="Ingresa el codigo o nombre del producto" name="cod">
                        <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="enviar">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <?php
                    }
                    ?>

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
                            <h6 class="m-0 font-weight-bold text-primary">Buscando Articulos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                    <?php 

                        //empieza al dar clic boton
                        if (isset($_POST["enviar"]) and $_POST["cod"] != null) {
                            # code...

                            try{
                                $codigo = $_POST["cod"];

                                include("conexion.php");

                                $sql="SELECT * FROM tproductos WHERE codigo_Barras = ? or nombre_Articulo LIKE ?";

                                $resultado = array($codigo ,"%$codigo%");
                                $stmt = $base->prepare($sql);
                                $stmt->execute($resultado);

                                //rowCount = devuelve 0 o 1 si hay o no un usuario
                                $num_registro=$stmt->rowCount();

                                if ($num_registro!=0) {

                                    ?>

                                    <table class="table table-bordered table table-hover"  width='100%' cellspacing='1' >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descripcion</th>
                                                <th>Stock</th>
                                                <th>Costo</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                    <?php

                                    while($productos=$stmt->fetch(PDO::FETCH_ASSOC)){

                                        //stock total de cada producto
                                        $id_Producto = $productos['TProductos_id'];

                                        $granel = $productos["granel"];
        
                                        $resultado2=$base->query("SELECT * FROM tinventario WHERE TProductos_id=$id_Producto")->fetchAll(PDO::FETCH_OBJ);

                                        foreach($resultado2 as $registro){
                                            $InventarioTotal = $registro->stock;
                                            $Minimo = $registro->stock_minimo;
                                        }

                                        $resultado4=$base->query("SELECT * FROM tgranel WHERE TProductos_id=$id_Producto")->fetchAll(PDO::FETCH_OBJ);

                                            foreach($resultado4 as $registro2){
                                                $Id_Granel = $registro2->T_TipoGranel_id;
                                                
                                                $resultado5=$base->query("SELECT * FROM t_tipogranel WHERE T_TipoGranel_id=$Id_Granel")->fetchAll(PDO::FETCH_OBJ);

                                                foreach($resultado5 as $registro3){
                                                    $Tipo_Granel = $registro3->descripcion;
                                                }

                                            }

                                        if($granel == "No"){
                                    
                                    ?>

                                        <tr class='table-light text-dark'>
                                            <td> <input type='hidden' value=$productos[TProductos_id]><?php echo $productos['codigo_Barras'];?></td>
                                            <td class='text-capitalize'><?php echo $productos['nombre_Articulo']?></td>
                                            <td><?php echo $InventarioTotal ?></td>
                                            <td><?php echo "$" . $productos['precio'] . "  MXN" ?></td>
                                        </tr>

                                    <?php

                                    }else{

                                        ?>

                                            <tr class='table-light text-dark'>
                                                <td> <input type='hidden' value=$productos[TProductos_id]>
                                                <?php 
                                                    echo $productos['codigo_Barras'];
                                                ?>
                                                </td>
                                                <td class='text-capitalize'><?php echo $productos['nombre_Articulo']?></td>
                                                <td><?php echo $InventarioTotal . "(" . $Tipo_Granel . ")"; ?></td>
                                                <td><?php echo "$" . $productos['precio'] . "  MXN" ?></td>
                                            </tr>

                                        <?php

                                    }

                                }

                                    ?>

                                    </tbody>
                                </table>

                                    <?php

                                }else{
                                    ?>

                                    <p class="font-monospace fw-semibold">Error no existe el articulo que estas buscando</p>

                                    <?php
                                }

                            }catch(Exception $e){
                                die("Error " . $e->getMessage());
                            }

                        }else {
                            
                            //-------------------------------------------------------------------- paginacion-----------------------
                            //se va a ejecutar isset al dar clic en el link

                            //mostrar la pagina en la que estamos

                            include("conexion.php");
                            $pagina = 1;
                            if(isset($_GET['pagina'])) {
                                $pagina = $_GET['pagina'];
                            }

                            $sql_total="SELECT * FROM tproductos";

                            //cuantas pags tendra
                            $tamanio_pags=8;
                            
                            $empezar_desde=($pagina-1)* $tamanio_pags;

                            $resultado=$base->prepare($sql_total);

                            $resultado->execute(array());
                            //CUANTA FILAS DEVUELVE LA CONSULTA, para eso usamos la primera funcion sql, 
                            $num_registros=$resultado->rowCount();
                            //ceil(redondea resultado);
                            $total_pags=ceil($num_registros/$tamanio_pags);
                    

                            //--------------------------------------------------------------------------------------

                            include("conexion.php");

                            $registros=$base->query("SELECT * FROM tproductos ORDER BY nombre_Articulo ASC LIMIT $empezar_desde, $tamanio_pags")->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                                    <table class='table table-bordered table table-hover' id='dataTable' width='100%' cellspacing='0'>
                                        <thead class='thead-dark'>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Descripcion</th>
                                            <th>Stock</th>
                                            <th>precio Venta</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    <?php

                                    foreach($registros as $productos){
                                        
                                        $id_Producto = $productos['TProductos_id'];

                                        $granel = $productos["granel"];

                                        $resultado2=$base->query("SELECT * FROM tinventario WHERE TProductos_id=$id_Producto")->fetchAll(PDO::FETCH_OBJ);

                                        foreach($resultado2 as $registro){
                                            $InventarioTotal = $registro->stock;
                                            $Minimo = $registro->stock_minimo;
                                        }

                                        $resultado4=$base->query("SELECT * FROM tgranel WHERE TProductos_id=$id_Producto")->fetchAll(PDO::FETCH_OBJ);

                                            foreach($resultado4 as $registro2){
                                                $Id_Granel = $registro2->T_TipoGranel_id;
                                                
                                                $resultado5=$base->query("SELECT * FROM t_tipogranel WHERE T_TipoGranel_id=$Id_Granel")->fetchAll(PDO::FETCH_OBJ);

                                                foreach($resultado5 as $registro3){
                                                    $Tipo_Granel = $registro3->descripcion;
                                                }

                                            }

                                        if($granel == "No"){
                                         
                                        ?>

                                        <tr class='table-light text-dark'>
                                            <td> <input type='hidden' value=$productos[TProductos_id]>
                                            <?php 
                                            
                                                echo $productos['codigo_Barras'];
                                            
                                            ?>
                                        </td>
                                        <td class='text-capitalize'><?php echo $productos['nombre_Articulo']?></td>
                                            <td><?php echo $InventarioTotal ?></td>
                                            <td><?php echo "$" . $productos['precio'] . "  MXN" ?></td>
                                        </tr>

                                        <?php

                                        }else{

                                            ?>

                                            <tr class='table-light text-dark'>
                                                <td> <input type='hidden' value=$productos[TProductos_id]>
                                                <?php 
                                                
                                                    echo $productos['codigo_Barras'];
                                                
                                                ?>
                                            </td>
                                            <td class='text-capitalize'><?php echo $productos['nombre_Articulo']?></td>
                                                <td><?php echo $InventarioTotal . "(" . $Tipo_Granel . ")"; ?></td>
                                                <td><?php echo "$" . $productos['precio'] . "  MXN" ?></td>
                                            </tr>

                                            <?php

                                        }

                                    }
                                    ?>
                                    </tbody>
                                    </table>
                                    <?php

                                    //-------------------------------------------     PAGINACION
                                
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
            <!-- Fin pie de pagina -->

        </div>

    </div>

    <!-- boton para subir-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    
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