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
                    
                    <button type="submit" class="button" name="enviar">Menu Principal</button>
                    
                </form>
            </li>

            <!-- Barra divisoria -->
            <hr class="sidebar-divider">

            <!-- Administracion -->
            <div class="sidebar-heading">
                Administración
            </div>

            <!-- Icono y enlaces -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <!-- Icono -->
                    <i class="fa fa-cubes"></i>
                    <span>Control de..</span>
                </a>
                <!-- Enlaces -->
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"></h6>
                        <a class="collapse-item" href="empleados.php">Empleados</a>
                        <a class="collapse-item" href="../Inventario/inventario.php">Inventario</a>
                        <a class="collapse-item" href="../prov/proveedores.php">Proveedores</a>
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
                <?php 
    
                $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
                
                $consulta2="SELECT COUNT(TEmpleado_id) FROM t_empleado";

                $Resultados2=mysqli_query($conexion,$consulta2);

                $row = mysqli_fetch_array($Resultados2);

                $total = $row[0];

                if ($total>1) {
                    # code.
                
                ?>


                    <?php 
                    
                    include("conexion.php");

                    ?>
                    <!-- Buscar un empleado en especifico -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                    action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="input-group">

                                <select name="nombre" id="nombre" class="form-control bg-light border-0 small" 
                                aria-label="Search" aria-describedby="basic-addon2">
                                <?php 
                                    //Solo va a mostrar usuarios de tipo empleado
                                    $registros2=$base->query("SELECT * FROM t_empleado WHERE TPerfil_id=2")->fetchAll(PDO::FETCH_OBJ);

                                    foreach ($registros2 as $Templeado):
                                    ?>  
                                            <option value="<?php echo $Templeado->TEmpleado_id; ?>"><?php echo $Templeado->nombre_usuario; ?></option>
                                    <?php 
                                        endforeach;
                                ?>
                                </select>
 
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
                    
                    <!-- Nombre del Usuario e Imagen -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- usuario -->
                         
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
                <!-- Fin de esta parte -->

                <div class="container-fluid">
                    
                    <!-- boton para insertar un nuevo empleado -->
                    <div style="text-align: right;">
                              <a href="insert.php" role="button" class="btn btn-success">Insertar</a>
                    </div> 
                    
                    <hr>
                    <!-- Inicio de la tabla -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Control de Empleados</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                    <?php 

                        //empieza al dar clic boton
                        if (isset($_POST["enviar"])) {
                            # code...

                            try{

                                include("conexion.php");

                                $sql="SELECT * FROM t_empleado WHERE TEmpleado_id = :nom";

                                $resultado=$base->prepare($sql);

                                    //addslashes = evitar inyeccion sql
                                $nom=htmlentities(addslashes($_POST["nombre"]));

                                $resultado->bindValue(":nom",$nom);

                                $resultado->execute(array(":nom"=>$nom));
                                //rowCount = devuelve 0 o 1 si hay o no un usuario
                                $num_registro=$resultado->rowCount();

                                if ($num_registro!=0) {

                                    while($empleado=$resultado->fetch(PDO::FETCH_ASSOC)){

                                        ?>

                                        <div class="container">
                                            <div class="row">

                                            <div class="col-2">
                                                
                                            </div>

                                            <div class="col-8">

                                                <form name="form1" method="post">

                                                    <!-- -------------------------------------------------  Nombre -------------------------------------------------------- -->
                                                    <td>
                                                    <div class="my-3">
                                                        
                                                        <input type="hidden" class="form-control" name="codigo" id="codigo" disabled readonly value="<?php
                                                        
                                                        
                                                            echo $empleado['TEmpleado_id']
                                                        
                                                        ?>">
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div class="my-3">
                                                        <label for="">Nombre</label>
                                                        <input type="text" class="form-control text-capitalize" name="nombre" id="nombre" disabled readonly value="<?php 
                                                        
                                                        echo $empleado['nombre']
                                                        
                                                        ?>">
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div class="my-3">
                                                        <label for="">Apellidos</label>
                                                        <input type="text" class="form-control text-capitalize" name="ape" id="ape" disabled readonly value="<?php 
                                                        
                                                        echo $empleado['apellidos']
                                                        
                                                        ?>">
                                                    </div>
                                                    </td>

                                                    <div class="my-3">
                                                        <label for="">Nombre de Usuario</label>
                                                        <input type="text" class="form-control text-capitalize" name="compra" id="compra" disabled readonly value="<?php 
                                                        
                                                        echo $empleado['nombre_usuario']
                                                        
                                                        ?>">
                                                    </div>

                                                    <!-- -----------------------------------------------------------------------------------------------------------------  -->
                                                    
                                                    <div class="my-3">
                                                        <label for="">Acciones</label>
                                                        <br>
                                                        <td>

                                                        <a class="btn btn-light deleteBtn" onclick="alertaEliminar(<?php echo $empleado['TEmpleado_id'] ?>)"><img src="../../css/borrar.png" width=40 height=40></a>

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

                                }else {
                                    echo "<p class='fw-semibold font-monospace'>Error no existe el registro que estas buscando</p>";
                                }

                            }catch(Exception $e){
                                echo "Error";
                            }
                        }else{

                            include("conexion.php");

                            //-------------------------------------------------------------------- paginacion-----------------------

                            $pagina = 1;
                            if(isset($_GET['pagina'])) {
                                $pagina = $_GET['pagina'];
                            }

                            $sql_total="SELECT * FROM t_empleado";

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

                            $registros=$base->query("SELECT * FROM t_empleado WHERE TPerfil_id=2 ORDER BY nombre ASC LIMIT $empezar_desde, $tamanio_pags")->fetchAll(PDO::FETCH_ASSOC);

                            echo "
                                    
                                    <table class='table table-bordered table table-hover' id='dataTable' width='100%' cellspacing='0'>
                                        <thead class='thead-dark'>
                                        <tr>
                                            <th></th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Nombre Usuario</th>
                                            <th>Acciones</th>
                                        </tr>
                                        <thead>
                                        <tbody>
                                    ";

                                    foreach($registros as $empleado){

                                        echo "

                                        <tr class='table-light text-dark'>
                                            <td><input type='hidden' value=$empleado[TEmpleado_id]> </td>
                                            <td> " . $empleado['nombre'] . "</td>
                                            <td class='text-capitalize'> " . $empleado['apellidos'] . "</td>
                                            <td class='text-capitalize'> " . $empleado['nombre_usuario'] . "</td>
                                            <td> 
                                                "   ?>
                                                       <button class="btn btn-light deleteBtn" onclick="alertaEliminar(<?php echo $empleado['TEmpleado_id'] ?>)"><img src="../../css/borrar.png" width=40 height=40></button>
                                                    <?php
                                                " 
                                            </td>
                                        </tr>

                                        ";
                                    }
                                    echo "
                                       </tbody>
                                    </table>";

                                    //-----------------------  PAGINACION -----------------------
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


    <!-- Funcion para Eliminar  $('#Nom').val(data[1]);-->
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