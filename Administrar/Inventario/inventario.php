<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>

    .button {
        background-color: blue; /* Green #4e73df*/
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

    <link href="../../css/sb-inventario.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="java.js"></script>


</head>
<body id="page-top">

    <?php 

      session_start();
    //Control de los usuarios
    if (!isset($_SESSION["usuario"])) {
       header("location:../../index.php");
  }
    ?> 

    <!-- Menu (Azul) -->
    <div id="wrapper">

        <!-- Parte inicial -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Icono - Tipo Usuario -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION["perfil"] ?></div>
            </a>

            <!-- Boton para volver menu principal -->
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

            <!-- Admin -->
            <div class="sidebar-heading">
                Admin.
            </div>

            <!-- Icono -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-cubes"></i>
                    <span>Control de..</span>
                </a>
                <!-- Enlaces -->
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"></h6>
                        <a class="collapse-item" href="../empleados/empleados.php">Empleados</a>
                        <a class="collapse-item" href="../prov/proveedores.php">Proveedores</a>
                    </div>
                </div>
            </li>

             <!-- Barra divisoria -->
             <hr class="sidebar-divider">

            <!-- Barra divisoria -->
            <div class="sidebar-heading">
                Inventario
            </div>

            <li class="nav-item">
                <!-- icono -->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-search"></i>
                    <span>Buscar por</span>
                </a>
                <!-- Enlaces para acceder -->
                <div id="collapsePages" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"></h6>
                        <a class="collapse-item" href="Inv_categoria.php">Categoria</a>
                        <a class="collapse-item" href="inventario.php">Codigo o Nombre</a>
                        <a class="collapse-item" href="Inv_prov.php">Proveedores</a>
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
        <!-- Buscar x categoria -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <?php 
                    
                    $conexion2=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
                    
                    $consulta3="SELECT COUNT(TProductos_id) FROM tproductos";

                    $Resultados3=mysqli_query($conexion2,$consulta3);

                    $row3 = mysqli_fetch_array($Resultados3);

                    $total3 = $row3[0];

                    if ($total3 > 0) {
                        # code...

                    ?>

                    <?php 
                    
                    include("conexion.php");

                    ?>
                    <!-- Buscar articulo -->

                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                    action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="input-group">
                        <input class="typeahead form-control" type="text" placeholder="Buscar por codigo barras o nombre..." name="cod">
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
                <!-- Fin esta parte / inicio de la tabla-->

                <div class="container-fluid">

                    <!-- Se va a mostrar el boton "Insertar" solo cuando ya exista por lo menos un proveedor y 1 categoria en la base -->

                    <div style="text-align: right;">

                    <?php 
    
                        $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
                            
                        $consulta2="SELECT COUNT(TCategoria_id) FROM tcategoria";

                        $Resultados2=mysqli_query($conexion,$consulta2);

                        $row = mysqli_fetch_array($Resultados2);

                        $total = $row[0];

                            
                        $consulta="SELECT COUNT(TProveedor_id) FROM tproveedor";

                        $Resultados=mysqli_query($conexion,$consulta);

                        $row2 = mysqli_fetch_array($Resultados);

                        $total2 = $row2[0];

                        if ($total!=0 and $total2!=0) {
                                # code...

                    ?>
                    
                          <a href="insert.php" role="button" class="btn btn-success">Insertar</a>
                           <a href="granel/granel.php" role="button" class="btn btn-info">Tipo Granel</a>

                        <?php 
                        }
                        ?>
                          <a href="categoria/categoria.php" role="button" class="btn btn-warning">Categorias (config)</a>

                          <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i>Descargar Inventario</a>-->
                    </div>  

                        <hr>
 
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Control del Inventario</h6>
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

                                /*$sql="SELECT * FROM tproductos WHERE codigo_Barras = ?";

                                //$resultado = array($codigo ,"%$codigo%");
                                $resultado = array($codigo);
                                $stmt = $base->prepare($sql);
                                $stmt->execute($resultado);

                                //rowCount = devuelve 0 o 1 si hay o no un usuario
                                $num_registro=$stmt->rowCount();*/

                                $sql2="SELECT * FROM tproductos WHERE codigo_Barras = ? or nombre_Articulo LIKE ?";

                                $resultado2 = array($codigo, "%$codigo%");
                                $stmt2 = $base->prepare($sql2);
                                $stmt2->execute($resultado2);

                                //rowCount = devuelve 0 o 1 si hay o no un usuario
                                $num_registro2=$stmt2->rowCount();

                                if ($num_registro2!=0) {
                                    
                                    ?>

                                    <table class="table table-bordered table table-hover"  width='100%' cellspacing='1' >
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Descripcion</th>
                                                <th>Precio Compra</th>
                                                <th>Precio Venta</th>
                                                <th>Stock</th>
                                                <th>Stock Minimo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                    <?php

                                    while($productos=$stmt2->fetch(PDO::FETCH_ASSOC)){

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
                                            <td><?php echo "$" . $productos['precio_Compra'] . " MXN" ?></td>
                                            <td><?php echo "$" . $productos['precio'] . "  MXN" ?></td>
                                            <td><?php echo $InventarioTotal; ?></td>
                                            <td><?php echo $Minimo; ?></td>
                                            <td>
                                                <a class="btn btn-primary" role="button" href="Add.php?Id=<?php echo $productos['TProductos_id']?> & 
                                                            cant=<?php echo $InventarioTotal?>">
                                                            <?php echo "(+)" ?> Stock</a>
                                                <a class="btn btn-danger" role="button" href="darBaja.php?Id=<?php echo $productos['TProductos_id']?> & 
                                                                        cant=<?php echo $InventarioTotal?>">
                                                                        Dar Baja</a>
                                                <a href="modify.php?Id=<?php echo $productos['TProductos_id']?> & 
                                                                        prov=<?php echo $productos['TProveedor_id']?> & 
                                                                        categ=<?php echo $productos['TCategoria_id']?> &
                                                                        nombre=<?php echo $productos['nombre_Articulo']?> &
                                                                        cost=<?php echo $productos['precio']?>"><img src="../../css/modificar.png" width=40 height=40></a>
                                                <a class="btn btn-light deleteBtn" role="button" onclick="alertaEliminar(<?php echo $productos['TProductos_id'] ?>)"><img src="../../css/borrar.png" width=40 height=40></a>
                                            </td>
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
                                                <td><?php echo "$" . $productos['precio_Compra'] . " MXN" ?></td>
                                                <td><?php echo "$" . $productos['precio'] . "  MXN" ?></td>
                                                <td><?php echo $InventarioTotal . "(" . $Tipo_Granel . ")"; ?></td>
                                                <td><?php echo $Minimo . "(" . $Tipo_Granel . ")"; ?></td>
                                                <td>
                                                <a class="btn btn-primary" role="button" href="Add_Granel.php?Id=<?php echo $productos['TProductos_id']?> & 
                                                            cant=<?php echo $InventarioTotal?>">
                                                            <?php echo "(+)" ?> Stock</a>
                                                <a class="btn btn-danger" role="button" href="darBaja_Granel.php?Id=<?php echo $productos['TProductos_id']?> & 
                                                                        cant=<?php echo $InventarioTotal?>">
                                                                        Dar Baja</a>
                                                <a href="modify_Granel.php?Id=<?php echo $productos['TProductos_id']?> & 
                                                                        prov=<?php echo $productos['TProveedor_id']?> & 
                                                                        categ=<?php echo $productos['TCategoria_id']?> &
                                                                        nombre=<?php echo $productos['nombre_Articulo']?> &
                                                                        cost=<?php echo $productos['precio']?>"><img src="../../css/modificar.png" width=40 height=40></a>
                                                <a class="btn btn-light deleteBtn" role="button" onclick="alertaEliminar(<?php echo $productos['TProductos_id'] ?>)"><img src="../../css/borrar.png" width=40 height=40></a>
                                            </td>
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

                        } else {
                            
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
                                            <th>Precio Compra</th>
                                            <th>Precio Venta</th>
                                            <th>Stock</th>
                                            <th>Stock Minimo</th>
                                            <th>Acciones</th>
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
                                            <td><?php echo "$" . $productos['precio_Compra'] . " MXN" ?></td>
                                            <td><?php echo "$" . $productos['precio'] . "  MXN" ?></td>
                                            <td><?php echo $InventarioTotal ?></td>
                                            <td><?php echo $Minimo ?></td>
                                            <td>
                                                <a class="btn btn-primary" role="button" href="Add.php?Id=<?php echo $productos['TProductos_id']?> & 
                                                            cant=<?php echo $InventarioTotal?>">
                                                            <?php echo "(+)" ?> Stock</a>
                                                <a class="btn btn-danger" role="button" href="darBaja.php?Id=<?php echo $productos['TProductos_id']?> & 
                                                                        cant=<?php echo $InventarioTotal?>">
                                                                        Dar Baja</a>
                                                <a href="modify.php?Id=<?php echo $productos['TProductos_id']?> & 
                                                                        prov=<?php echo $productos['TProveedor_id']?> & 
                                                                        categ=<?php echo $productos['TCategoria_id']?> &
                                                                        nombre=<?php echo $productos['nombre_Articulo']?> &
                                                                        cost=<?php echo $productos['precio']?>"><img src="../../css/modificar.png" width=40 height=40></a>
                                                <a class="btn btn-light deleteBtn" role="button" onclick="alertaEliminar(<?php echo $productos['TProductos_id'] ?>)"><img src="../../css/borrar.png" width=40 height=40></a>
                                            </td>
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
                                                <td><?php echo "$" . $productos['precio_Compra'] . " MXN" ?></td>
                                                <td><?php echo "$" . $productos['precio'] . "  MXN" ?></td>
                                                <td><?php echo $InventarioTotal . "(" . $Tipo_Granel . ")"; ?></td>
                                                <td><?php echo $Minimo . "(" . $Tipo_Granel . ")"; ?></td>
                                                <td>
                                                    <a class="btn btn-primary" role="button" href="Add_Granel.php?Id=<?php echo $productos['TProductos_id']?> & 
                                                                cant=<?php echo $InventarioTotal?>">
                                                                <?php echo "(+)" ?> Stock</a>
                                                    <a class="btn btn-danger" role="button" href="darBaja_Granel.php?Id=<?php echo $productos['TProductos_id']?> & 
                                                                            cant=<?php echo $InventarioTotal?>">
                                                                            Dar Baja</a>
                                                    <a href="modify_Granel.php?Id=<?php echo $productos['TProductos_id']?> & 
                                                                            prov=<?php echo $productos['TProveedor_id']?> & 
                                                                            categ=<?php echo $productos['TCategoria_id']?> &
                                                                            nombre=<?php echo $productos['nombre_Articulo']?> &
                                                                            cost=<?php echo $productos['precio']?>"><img src="../../css/modificar.png" width=40 height=40></a>
                                                    <a class="btn btn-light deleteBtn" role="button" onclick="alertaEliminar(<?php echo $productos['TProductos_id'] ?>)"><img src="../../css/borrar.png" width=40 height=40></a>
                                                </td>
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

    <!-- boton para volver al principio-->
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
                
        })
    }


    </script>

    <!-- Bootstrap core JavaScript-->
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