<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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

    <!-- Menu (azul) -->
    <div id="wrapper">

        <!-- Parte Inicial -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Icono - Tipo de usuario -->
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

            <?php 
            
            ?>

            <li class="nav-item">
                <a  class="nav-link collapsed" href="inventario.php"
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
        <!-- Fin Menu -->
<!-- // ---------------------------------------------------------------------------------------------------------------------------- -->
        <!-- Nombre de Usuario e imagen -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    
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
                <!-- Fin esta parte / inicio de la sig -->

                <div class="container-fluid">
                
                    <?php 

                        include("conexion.php");

                        //si no has pulsado boton actualizar
                        if (!isset($_POST["bot_actualizar"])) {
                            # code...

                            $Id=$_GET["Id"];
                            $Prov=$_GET["prov"];
                            $Categ = $_GET["categ"];
                            $Nombre = $_GET["nombre"];
                            $Costo = $_GET["cost"];

                            include("conexion.php");

                            $sql="SELECT * FROM tproductos INNER JOIN tinventario WHERE tproductos.TProductos_id = ?";

                            $resultado = array($Id);
                            $stmt = $base->prepare($sql);
                            $stmt->execute($resultado);

                            if($prod=$stmt->fetch(PDO::FETCH_ASSOC)){

                                $codigo=$prod['codigo_Barras'];
                                $compra=$prod['precio_Compra'];
                                $minimo=$prod['stock_minimo'];
                                $Imagen=$prod['Imagen'];
                            }

                            $sql2="SELECT * FROM tgranel INNER JOIN t_tipogranel WHERE tgranel.T_TipoGranel_id = t_tipogranel.T_TipoGranel_id AND  tgranel.TProductos_id = ?";

                            $resultado2 = array($Id);
                            $stmt2 = $base->prepare($sql2);
                            $stmt2->execute($resultado2);

                            if($grn=$stmt2->fetch(PDO::FETCH_ASSOC)){

                                $idGranel=$grn['T_TipoGranel_id'];
                                
                            }



                            include("form_2Granel.php");

                        }else{
                            //guardando los datos del formulario
                            $Id=$_POST["id"];

                            include("conexion.php");

                            $sql="SELECT * FROM tproductos WHERE TProductos_id = ?";

                            $resultado = array($Id);
                            $stmt = $base->prepare($sql);
                            $stmt->execute($resultado);

                            if($prod=$stmt->fetch(PDO::FETCH_ASSOC)){  
                                $Imagen=$prod['Imagen']; 
                            }
                            
                            /////////////////////////////////////////////////////////////////////////////

                            $proveedor = $_POST["prov"];
                            $categoria = $_POST["categ"];
                            $nombre = $_POST["nombre"];
                            $nuevoCosto = $_POST["nuevoCosto"];
                            $precio_Compra = $_POST["precio"];
                            $cod = $_POST["cod"];
                            $min = $_POST["min"];
                            $granel = $_POST["granel"];

                            $contador=0;

                            $tipoError1 = "";
                            $tipoError2 = "";
                            $tipoError3 = "";
                            $tipoError4 = "";
                            $carpeta_Destino = '../../venta/nuevaVenta/img/prod/';

                            if($_FILES['imagen']['name'] != ""){

                                //si es diferente de nulo: comprobamos tamanio, eliminamos la otra del servidor

                                $imagen_Nombre = $_FILES['imagen']['name'];
                                $imagen_Tipo = $_FILES['imagen']['type'];
                                $imagen_Size = $_FILES['imagen']['size'];

                                $old_Image = $_POST['old_Image'];

                                if($imagen_Size > 1000000){

                                    $contador = $contador + 1;
                                    $tipoError2 = "El tamaño de la imagen es demasiado grande";

                                }

                                if($imagen_Tipo == "image/jpg" || $imagen_Tipo == "image/jpeg" || $imagen_Tipo == "image/png" || $imagen_Tipo == "image/webp" ){

                                    if(file_exists($carpeta_Destino.$imagen_Nombre)){
                                        $contador = $contador + 1;
                                        $tipoError4 = "Ya existe un archivo con el mismo nombre. ";
                                    }

                                }else{

                                    $contador=$contador + 1;

                                    $tipoError3 = "Solo se pueden subir imagenes jpg, jpeg, png, y webp";   

                                }

                            }else{

                                $imagen_Nombre = $_POST["old_Image"];
                            }

                            if (empty($Id) || empty($proveedor) || empty($categoria) || empty($nombre) || empty($nuevoCosto) || empty($precio_Compra) || empty($cod) || empty($min) || empty($granel)) {

                                $contador = $contador + 1;

                                $tipoError1 =  "No dejar espacios en blanco. ";
                            } 

                            /*if (preg_match("/^[[a-zA-Z áéíóúÁÉÍÓÚñÑ]{4,30}$/i", trim($nombre)) !== 1) {
                                $contador = $contador + 1;
                                $tipoError2 = "El nombre es incorrecto, solo letras. ";
                            }*/
                                
                            if($contador > 0){

                                //$errorFinal = $tipoError1 . $tipoError2;

                                ?>

                                <script>

                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Corregir los siguientes errores: ',
                                    html: '<?php echo "<div>$tipoError1<br>$tipoError2<br>$tipoError3<br></div>" ?>',
                                    })

                                </script>

<div class="container">
  <div class="row">
<div class="col-2">
    
</div>

  <div class="col-8">

    <h2>Modificar</h2>

    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php
            
            if(isset($Id)){
                echo $Id;
            }
            
            ?>">

            <label class="form-label">Codigo de Barras</label>
            <input type="text" class="form-control" name="cod" value="<?php //echo $codigo 
            
            if(isset($cod)){
                echo $cod;
            }
            
            ?>">

        </div>
 
        <!-- -------------------------------------------------  Descripcion y precio -------------------------------------------------------- -->

        <div class="my-3">
            <label class="form-label">Descripcion</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php //echo $Nombre
            
            if(isset($nombre)){
                echo $nombre;
            }
            
            ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Precio de Compra</label>
            <input  type="number" step="0.01" min="0" class="form-control"  name="precio" id="precio" value="<?php //echo $compra
            
            if(isset($precio_Compra)){
                echo $precio_Compra;
            }
            
            ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Precio de Venta</label>
            <input  type="number" step="0.01" min="0" class="form-control"  name="nuevoCosto" id="nuevoCosto" value="<?php //echo $Costo
            
            if(isset($nuevoCosto)){
                echo $nuevoCosto;
            }
            
            ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Stock Minimo</label>
            <input  type="number" step="0.01" min="0" class="form-control"  name="min" id="min" value="<?php //echo $minimo
            
            if(isset($min)){
                echo $min;
            }
            
            ?>">
        </div>

        <!-- --------------------------------------------------- categoria id ---------------------------------------------------  -->
        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categ" id="categ" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">

                            <?php 
                
                                $registros2=$base->query("SELECT * FROM tcategoria ORDER BY nombre ASC")->fetchAll(PDO::FETCH_OBJ);

                                foreach ($registros2 as $Tcategoria):

                                    if(!isset($categoria)){

                                        echo '<option value="'.$Tcategoria->TCategoria_id.'">'.$Tcategoria->nombre.'</option>';   
                                    
                                    }else{

                                        $producto = $Tcategoria->TCategoria_id;

                                        if ($producto==$categoria) {
                                            echo '<option selected value="'.$Tcategoria->TCategoria_id.'">'.$Tcategoria->nombre.'</option>';
                                        }else{
                                        echo '<option value="'.$Tcategoria->TCategoria_id.'">'.$Tcategoria->nombre.'</option>';    
                                        }

                                    }
                                    
                                ?>    
                                <?php 
                                    endforeach;
                                ?>

            </select>
        </div>

        <!-- -----------------------------------------------------------------------------------------------------------------  -->

        <!-- --------------------------------------------------- proveedor id ---------------------------------------------------  -->

        <div class="mb-3">
            <label class="form-label">Proveedor</label>
            <select name="prov" id="prov" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">

                <?php 
    
                    $registros2=$base->query("SELECT * FROM tproveedor ORDER BY empresa ASC")->fetchAll(PDO::FETCH_OBJ);

                    foreach ($registros2 as $Tprov):

                        if(!isset($proveedor)){

                            echo '<option value="'.$Tprov->TProveedor_id.'">'.$Tprov->empresa.'</option>'; 

                        }else{

                            $producto = $Tprov->TProveedor_id;

                            if ($producto == $proveedor) {
                                echo '<option selected value="'.$Tprov->TProveedor_id.'">'.$Tprov->empresa.'</option>';
                            }else{
                            echo '<option value="'.$Tprov->TProveedor_id.'">'.$Tprov->empresa.'</option>';    
                            }   

                        }
                    
                    ?>  
                        
                    <?php 
                        
                        endforeach;
                    ?>
            </select>
            
        </div>

        <!-- -----------------------------------------------------------------------------------------------------------------  -->

        <!-- --------------------------------------------------- granel tipo id ---------------------------------------------------  -->

        <div class="mb-3">
            <label class="form-label">Tipo de Granel</label>
            <select name="granel" id="granel" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">

                <?php 
    
                    $registros2=$base->query("SELECT * FROM t_tipogranel ORDER BY descripcion ASC")->fetchAll(PDO::FETCH_OBJ);

                    foreach ($registros2 as $TGranel):

                        if(!isset($granel)){

                            echo '<option value="'.$TGranel->T_TipoGranel_id.'">'.$TGranel->descripcion.'</option>'; 

                        }else{

                            $granelTipo = $TGranel->T_TipoGranel_id;

                            if ($granelTipo == $granel) {
                                echo '<option value="'.$TGranel->T_TipoGranel_id.'">'.$TGranel->descripcion.'</option>'; 
                            }else{
                            echo '<option value="'.$TGranel->T_TipoGranel_id.'">'.$TGranel->descripcion.'</option>';    
                            }   

                        }
                    
                    ?>  
                        
                    <?php 
                        
                        endforeach;
                    ?>
            </select>
            
        </div>

        <!-- -----------------------------------------------------------------------------------------------------------------  -->
        
        <div class="my-3">
            <label for="imagen">Subir Nueva Imagen</label>
            <input type="file" class="form-control" name="imagen" id="imagen">
            <input type="hidden" name="old_Image" value="<?php echo $Imagen; ?>">
        </div>

        <button type="submit" class="btn btn-primary" name="bot_actualizar" id="bot_actualizar">Aceptar</button>
        </form>
    </div>
<div class="col-2">
         
</div>
</div>
</div>

                                <?php


                            }else{

                                if($_FILES['imagen']['name'] == ""){

                                    $sql="UPDATE tproductos SET TCategoria_id=:cat, TProveedor_id=:prv, nombre_Articulo=:nom, precio=:cost, codigo_Barras=:codigo, precio_Compra=:compra, Imagen=:img WHERE TProductos_id=:miId";
                                    $resultado=$base->prepare($sql);

                                    $resultado->execute(array(":miId"=>$Id, ":cat"=>$categoria, ":prv"=>$proveedor, ":nom"=>$nombre, ":cost"=>$nuevoCosto, ":codigo"=>$cod, ":compra"=>$precio_Compra, ":img"=>$imagen_Nombre));
                            
                                    $sql3="UPDATE tinventario SET stock_minimo=:min WHERE TProductos_id=:prodId";
                                    $resultado3=$base->prepare($sql3);
                                    $resultado3->execute(array(":prodId"=>$Id, ":min"=>$min));

                                    $sql5="UPDATE tgranel SET T_TipoGranel_id=:gran WHERE TProductos_id=:prodId";
                                    $resultado5=$base->prepare($sql5);
                                    $resultado5->execute(array(":prodId"=>$Id, ":gran"=>$granel));
                                    
                                    echo "<p class='fw-semibold font-monospace'>Registro actualizado con exito</p>";

                                }else{

                                    //eliminando imagen anterior del servidor
                                    unlink($carpeta_Destino.$old_Image);
                                    //agregando imagen al servidor
                                    move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_Destino.$imagen_Nombre);

                                    $sql="UPDATE tproductos SET TCategoria_id=:cat, TProveedor_id=:prv, nombre_Articulo=:nom, precio=:cost, codigo_Barras=:codigo, precio_Compra=:compra, Imagen=:img WHERE TProductos_id=:miId";
                                    $resultado=$base->prepare($sql);

                                    $resultado->execute(array(":miId"=>$Id, ":cat"=>$categoria, ":prv"=>$proveedor, ":nom"=>$nombre, ":cost"=>$nuevoCosto, ":codigo"=>$cod, ":compra"=>$precio_Compra, ":img"=>$imagen_Nombre));
                            
                                    $sql3="UPDATE tinventario SET stock_minimo=:min WHERE TProductos_id=:prodId";
                                    $resultado3=$base->prepare($sql3);
                                    $resultado3->execute(array(":prodId"=>$Id, ":min"=>$min));

                                    $sql5="UPDATE tgranel SET T_TipoGranel_id=:gran WHERE TProductos_id=:prodId";
                                    $resultado5=$base->prepare($sql5);
                                    $resultado5->execute(array(":prodId"=>$Id, ":gran"=>$granel));
                                    
                                    echo "<p class='fw-semibold font-monospace'>Registro actualizado con exito</p>";

                                }

                            }

                        }

                        ?>

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