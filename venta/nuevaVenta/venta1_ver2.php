
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css/estilo.css">

  <!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
  <script src="java.js"></script>

  <style>

.button {
  outline:none;
  border: none;

}


  </style>

</head>

<body>
    
<?php 

session_start();
if (!isset($_SESSION["usuario"])) {
header("location:../../index.php");
}
?> 

<?php 
            
    $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
    //en caso de que no exista ningun registro
    $consulta="SELECT IFNULL(MAX(TVenta_id),0) FROM tventa";
        
    $Resultados=mysqli_query($conexion,$consulta);
        
    $row = mysqli_fetch_array($Resultados);
        
    $max = $row[0];
    //ultima venta efectuada
    $max = $max + 1;
                        
?>

<?php

    Function VentaId (&$valorId){

        $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
        //en caso de que no exista ningun registro
        $consulta="SELECT IFNULL(MAX(TListaVenta_id),0) FROM tlista_venta";
            
        $Resultados=mysqli_query($conexion,$consulta);
            
        $row = mysqli_fetch_array($Resultados);
            
        $max = $row[0];
        //ultima venta efectuada
        $valorId = $max + 1;

        return $valorId;

    }

?>
    
<?php 
date_default_timezone_set('America/Mexico_City');
$fechaActual = date('d/m/Y');
$fechaGuardar = date('Y-m-d');
?>
    
<?php 
                        
include("conexion.php");
    
?>

<header>
<div class="Top-Bar">
    <div class="Drop-Bar">
    <form class="user" action="../../comprobar_login2.php" method = "post">
        <input type="hidden" name="user" value=<?php echo $_SESSION["usuario"] ?>>
        <input type="hidden" name="password" value=<?php echo $_SESSION["contra"] ?>>
                
        <button type="submit" class="button" name="enviar"><img src="img/volver.jpg" width=40 height=40></button>
    </form>
    </div>
    <div class="Tienda">
        <h1 class="NombreTienda">"San Juan Pablo II"</h1>
    </div>
    <div class="Fecha">
        <h3 class="FechaTienda"><?php echo $fechaActual ?></h3>
    </div>
    <div>
        <h6> Le atiende <?php echo $_SESSION["usuario"]; ?></h6>
    </div>
</div>
</header>
<main>
<div class="Punto-Venta">
    <div class="Buscador">
        <form class="Search_Bar" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input class="typeahead form-control" type="text" placeholder="Buscar por codigo barras" name="codigo">
            <button type="submit" name="enviar">Buscar</button>
        </form>
    </div>

    <?php 

        //empieza al dar clic boton
        if (isset($_POST["enviar"])) {
            # code...

            try{
                
                $codigo = $_POST["codigo"];

                include("conexion.php");

                $sql="SELECT * FROM tproductos WHERE codigo_Barras = ?";

                $resultado = array($codigo);
                $stmt = $base->prepare($sql);
                $stmt->execute($resultado);

                //rowCount = devuelve 0 o 1 si hay o no un usuario
                $num_registro=$stmt->rowCount();




                $sql2="SELECT * FROM tproductos WHERE nombre_Articulo LIKE ?";

                $resultado2 = array("%$codigo%");
                $stmt2 = $base->prepare($sql2);
                $stmt2->execute($resultado2);

                //rowCount = devuelve 0 o 1 si hay o no un usuario
                $num_registro2=$stmt2->rowCount();

                ?>
                
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="FrmVenta" name="FrmVenta" method="post">

                            <?php 

                        if ($num_registro!=0 Or $num_registro2 !=0) {

                            if($num_registro !=0){
                            
                                if($productos=$stmt->fetch(PDO::FETCH_ASSOC)){

                                    $id_Producto = $productos['TProductos_id'];
                                    $granel = $productos["granel"];

                                        $resultado2=$base->query("SELECT * FROM tinventario WHERE TProductos_id=$id_Producto")->fetchAll(PDO::FETCH_OBJ);

                                        foreach($resultado2 as $registro){
                                            $InventarioTotal = $registro->stock;
                                            $Inv_Minimo = $registro->stock_minimo;
                                            //$codigoBarras = $registro->codigo_Barras;
                                        }

                                        $resultado4=$base->query("SELECT * FROM tgranel WHERE TProductos_id=$id_Producto")->fetchAll(PDO::FETCH_OBJ);

                                        foreach($resultado4 as $registro2){
                                            $Id_Granel = $registro2->T_TipoGranel_id;
                                            
                                            $resultado5=$base->query("SELECT * FROM t_tipogranel WHERE T_TipoGranel_id=$Id_Granel")->fetchAll(PDO::FETCH_OBJ);

                                            foreach($resultado5 as $registro3){
                                                $Tipo_Granel = $registro3->descripcion;
                                            }

                                        }
                                        //si es un producto de tipo granel
                                        if($granel == "Si"){

                                            //si es de granel, va a aparecer la sig ventana

                                            echo '<script type="text/javascript">'
                                                . '$( document ).ready(function() {'
                                                . '$("#insertModal").modal("show");'
                                                . '});'
                                                . '</script>';

                                        //si no lo es
                                        }else{

                                            $productoID = $productos['TProductos_id'];
                                            //Se le pone el numero de venta al inicio si es que no se ha finalizado con la transaccion
                                            $numeroVenta = 0;
                                            //$fecha = $fechaGuardar;
                                            $inventario = $InventarioTotal;
                                            (int) $cantidad = 1;
                                            (double)$total = $productos['precio'];

                                            if ($cantidad <= $inventario) {
                                                # code...
                
                                                $restante = $inventario - $cantidad;
                
                                                $sql2 = "UPDATE tinventario SET stock=:cant WHERE TProductos_id=:miId";
                                                $resultado2=$base->prepare($sql2);
                                                $resultado2->execute(array("miId"=>$productoID, ":cant"=>$restante));
                
                                                //verificando si ya se ha vendido el mismo producto

                                                $sql4="SELECT * FROM tlista_venta WHERE TProductos_id = ? and TVenta_id = 0";

                                                $resultado4 = array($productoID);
                                                $stmt4 = $base->prepare($sql4);
                                                $stmt4->execute($resultado4);

                                                if($ven=$stmt4->fetch(PDO::FETCH_ASSOC)){

                                                    $cantidad_Actual= $ven['cantidad'];
                                                    $precio_Actual = $ven['total_x_Unidad'];

                                                    $nueva_Cantidad = $cantidad_Actual + $cantidad;
                                                    $nuevo_Precio = $precio_Actual + $total;

                                                    $sql = "UPDATE tlista_venta SET cantidad=:cant, total_x_Unidad=:total WHERE TProductos_id=:miId";
                                                    $resultado=$base->prepare($sql);
                                                    $resultado->execute(array("miId"=>$productoID, ":cant"=>$nueva_Cantidad, ":total"=>$nuevo_Precio));

                                                    //echo "<p class='fw-semibold font-monospace'>Nuevo Registro Agregado Correctamente</p>";

                                                }else{
                                                
                                                    $idVenta;

                                                    (VentaId($idVenta));
                                                
                                                    $sql="INSERT INTO tlista_venta(TListaVenta_id, TProductos_id,  cantidad, total_x_Unidad, TVenta_id) VALUES (:miId,:prod,:cant,:total, :num)";
                                                    $resultado=$base->prepare($sql);

                                                    $resultado->execute(array(":miId"=>$idVenta,":prod"=>$productoID, ":cant"=>$cantidad, ":total"=>$total, ":num"=>$numeroVenta));
                                                    
                                                    //
                                                    //echo "<p class='fw-semibold font-monospace'>Nuevo Registro Agregado Correctamente</p>";
                                                    
                                                }
                                                
                
                                            }else{
                
                                                //echo "<p class='fw-semibold font-monospace'>Error no hay suficientes articulos en el inventario</p>";
                                                    ?>
                                                        <script>
                                                        Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error',
                                                        text: 'No hay suficientes articulos en el inventario!',
                                                        })
                                                        </script>
                                                    <?php
                                            }

                                        }
                                }
                            
                            }else if($num_registro2 != 0){
                                
                                if($productos=$stmt2->fetch(PDO::FETCH_ASSOC)){

                                    $id_Producto = $productos['TProductos_id'];
                                        $granel = $productos["granel"];

                                            $resultado2=$base->query("SELECT * FROM tinventario WHERE TProductos_id=$id_Producto")->fetchAll(PDO::FETCH_OBJ);
    
                                            foreach($resultado2 as $registro){
                                                $InventarioTotal = $registro->stock;
                                                $Inv_Minimo = $registro->stock_minimo;
                                                //$codigoBarras = $registro->codigo_Barras;
                                            }

                                            //include_once("form2.php");

                                            $resultado4=$base->query("SELECT * FROM tgranel WHERE TProductos_id=$id_Producto")->fetchAll(PDO::FETCH_OBJ);

                                            foreach($resultado4 as $registro2){
                                                $Id_Granel = $registro2->T_TipoGranel_id;
                                                
                                                $resultado5=$base->query("SELECT * FROM t_tipogranel WHERE T_TipoGranel_id=$Id_Granel")->fetchAll(PDO::FETCH_OBJ);

                                                foreach($resultado5 as $registro3){
                                                    $Tipo_Granel = $registro3->descripcion;
                                                }

                                            }

                                            //include_once("form.php");
                                            if($granel == "Si"){

                                                echo '<script type="text/javascript">'
                                                    . '$( document ).ready(function() {'
                                                    . '$("#insertModal").modal("show");'
                                                    . '});'
                                                    . '</script>';

                                            //si no lo es
                                            }else {

                                                echo '<script type="text/javascript">'
                                                    . '$( document ).ready(function() {'
                                                    . '$("#insertModal2").modal("show");'
                                                    . '});'
                                                    . '</script>';
                                            }


                                    }

                            } 

                        }else{

                            //echo "<p class='fw-semibold font-monospace'>Error no existe el registro que estas buscando</p>";
                            ?>
                            <script>
                                Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No existe el articulo que estas buscando',
                                })
                            </script>
                            <?php
                        }
                        
                            
                            ?>

                        </form>
                   

                    <?php

                

            }catch(Exception $e){
                die("Error " . $e->getMessage());
            }

        }

        ?>

        <?php 

        if(isset($_POST["agregar"]) || isset($_POST["agregar2"])) {

            if(isset($_POST["agregar2"])){

                include("conexion.php");

                $productoID = $_POST["codigo"];
                //Se le pone el numero de venta al inicio si es que no se ha finalizado con la transaccion
                $numeroVenta = 0;
                //$fecha = $fechaGuardar;
                $inventario = (float)$_POST["inventario"];
                $cantidad = (float)$_POST["cantidad"];
                (double)$precio = (double)$_POST["precio"];
                $total = $cantidad * $precio;

                if($cantidad != null){

                    if ($cantidad <= $inventario) {
                        # code...

                        $restante = $inventario - $cantidad;

                        $sql2 = "UPDATE tinventario SET stock=:cant WHERE TProductos_id=:miId";
                        $resultado2=$base->prepare($sql2);
                        $resultado2->execute(array("miId"=>$productoID, ":cant"=>$restante));

                        //verificando si ya se ha vendido el mismo producto
                        $sql4="SELECT * FROM tlista_venta WHERE TProductos_id = ? and TVenta_id = 0";

                        $resultado4 = array($productoID);
                        $stmt4 = $base->prepare($sql4);
                        $stmt4->execute($resultado4);

                        if($ven=$stmt4->fetch(PDO::FETCH_ASSOC)){

                            $cantidad_Actual= $ven['cantidad'];
                            $precio_Actual = $ven['total_x_Unidad'];

                            $nueva_Cantidad = $cantidad_Actual + $cantidad;
                            $nuevo_Precio = $precio_Actual + $total;

                            $sql = "UPDATE tlista_venta SET cantidad=:cant, total_x_Unidad=:total WHERE TProductos_id=:miId";
                            $resultado=$base->prepare($sql);
                            $resultado->execute(array("miId"=>$productoID, ":cant"=>$nueva_Cantidad, ":total"=>$nuevo_Precio));

                            //echo "<p class='fw-semibold font-monospace'>Nuevo Registro Agregado Correctamente</p>";

                        }else{

                            $idVenta;

                            (VentaId($idVenta));
                        
                            $sql="INSERT INTO tlista_venta(TListaVenta_id, TProductos_id,  cantidad, total_x_Unidad, TVenta_id) VALUES (:miId,:prod,:cant,:total, :num)";
                            $resultado=$base->prepare($sql);

                            $resultado->execute(array(":miId"=>$idVenta,":prod"=>$productoID, ":cant"=>$cantidad, ":total"=>$total, ":num"=>$numeroVenta));
                        
                        }

                    }else{

                        ?>
                            <script>
                                Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No hay suficientes articulos en el inventario!',
                            })
                            </script>
                        <?php

                    }

                }else{
                    ?>
                            <script>
                                Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No dejar espacios en blanco',
                            })
                            </script>
                    <?php
                }

            
            }    
            
            if(isset($_POST["agregar"])){

                include("conexion.php");

                        $productoID = $_POST["codigo"];
                        //Se le pone el numero de venta al inicio si es que no se ha finalizado con la transaccion
                        $numeroVenta = 0;
                        //$fecha = $fechaGuardar;
                        $inventario = (int)$_POST["inventario"];
                        (int) $cantidad = (int)$_POST["cantidad"];
                        (double)$precio = (double)$_POST["precio"];
                        $total = $cantidad * $precio;

                        if($cantidad != null){

                            if ($cantidad <= $inventario) {
                                # code...

                                $restante = $inventario - $cantidad;

                                $sql2 = "UPDATE tinventario SET stock=:cant WHERE TProductos_id=:miId";
                                $resultado2=$base->prepare($sql2);
                                $resultado2->execute(array("miId"=>$productoID, ":cant"=>$restante));

                                //verificando si ya se ha vendido el mismo producto
                                $sql4="SELECT * FROM tlista_venta WHERE TProductos_id = ? and TVenta_id = 0";

                                $resultado4 = array($productoID);
                                $stmt4 = $base->prepare($sql4);
                                $stmt4->execute($resultado4);

                                if($ven=$stmt4->fetch(PDO::FETCH_ASSOC)){

                                    $cantidad_Actual= $ven['cantidad'];
                                    $precio_Actual = $ven['total_x_Unidad'];

                                    $nueva_Cantidad = $cantidad_Actual + $cantidad;
                                    $nuevo_Precio = $precio_Actual + $total;

                                    $sql = "UPDATE tlista_venta SET cantidad=:cant, total_x_Unidad=:total WHERE TProductos_id=:miId";
                                    $resultado=$base->prepare($sql);
                                    $resultado->execute(array("miId"=>$productoID, ":cant"=>$nueva_Cantidad, ":total"=>$nuevo_Precio));

                                    //echo "<p class='fw-semibold font-monospace'>Nuevo Registro Agregado Correctamente</p>";

                                }else{

                                    $idVenta;

                                    (VentaId($idVenta));
                                
                                    $sql="INSERT INTO tlista_venta(TListaVenta_id, TProductos_id,  cantidad, total_x_Unidad, TVenta_id) VALUES (:miId,:prod,:cant,:total, :num)";
                                    $resultado=$base->prepare($sql);

                                    $resultado->execute(array(":miId"=>$idVenta,":prod"=>$productoID, ":cant"=>$cantidad, ":total"=>$total, ":num"=>$numeroVenta));
                            
                                    //echo "<p class='fw-semibold font-monospace'>Nuevo Registro Agregado Correctamente</p>";
                                
                                }

                            }else{

                                //echo "<p class='fw-semibold font-monospace'>Error no hay suficientes articulos en el inventario</p>";
                                ?>
                                <script>
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'No hay suficientes articulos en el inventario!',
                                })
                                </script>
                                <?php
                            }

                        }else{
                            ?>
                                    <script>
                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'No dejar espacios en blanco',
                                    })
                                    </script>
                            <?php
                        }

                }

            }

        

        ?>

    <?php 

        include("conexion.php");

        $registros=$base->query("SELECT * FROM tlista_venta WHERE TVenta_id =0")->fetchAll(PDO::FETCH_OBJ);
    ?>
    
    <div class="ListaProductos">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table class="TablaVenta">
            <tr>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Costo</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
            <tr class="ListaVenta">
            
            <?php  foreach ($registros as $Tventa):    ?> 

                <?php
                    $id = $Tventa->TProductos_id;

                    include("conexion.php");

                    $sql="SELECT nombre_Articulo FROM tproductos WHERE TProductos_id= :id";
                    $resultado=$base->prepare($sql);

                    $resultado->execute(array(":id"=>$id));

                    while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {

                        $nombre =  $registro['nombre_Articulo'];
                    }
                ?>

                <td class="Nombre"><?php echo $nombre ?></td>
                <td class="Nombre"><?php echo $Tventa->cantidad ?></td>
                <td class="Precio"><?php echo "$" . $Tventa->total_x_Unidad . " MXN"?></td>

                <?php
                    $id = $Tventa->TProductos_id;

                    include("conexion.php");

                    $sql="SELECT * FROM tinventario WHERE TProductos_id= :id";
                    $resultado=$base->prepare($sql);

                    $resultado->execute(array(":id"=>$id));
                    
                    while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {

                        if($registro['stock'] > $registro['stock_minimo']){

                        ?>
                        
                            <td class="TotalProducto"><strong><?php echo "(" . $registro['stock'] . ") Restante";?></strong></td><?php

                        }else{

                           ?><td class="TotalProducto"><strong><?php echo "(" . $registro['stock'] . ") restante";?></strong></td><?php

                        }
                    }
                    ?>

                    <td><a role="button" class="deleteBtn" onclick="alertaEliminar(<?php echo $Tventa->TListaVenta_id ?>)"><img src="img/borrar.png" width=40 height=40></a></td>
            </tr>

            <?php  endforeach; ?>

        </table>
        </form>

        <?php 

            $total = 0;

            $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");

            $consulta="SELECT sum(total_x_Unidad) FROM tlista_venta where TVenta_id=0";

            $Resultados=mysqli_query($conexion,$consulta);

            $row = mysqli_fetch_array($Resultados);

            $total = $row[0];

        ?>
        
        <?php 
        //mostrando el boton solo si se ha agregado algun articulo
        if($total > 0) { ?>

                       
                            <h3><strong>TOTAL = $ <?php echo $total ?> MXN</strong></h3>
                            <a role="button" class="btn btn-success generarBtn" onclick="VentaFinal()">generar Venta</a>


        <?php } ?>

    </div>
</div>
        <div class="Productos">
            <div class="Categorias">
                <div class="CardCategoria">
                    <h1>Panaderia</h1>
                </div>
                <div class="CardCategoria">
                    
                </div>
                <div class="CardCategoria">
                    
                </div>
            </div>
            <div class="Buscador">
                <form action="#" class="Search_Bar">
                <input type="text" placeholder="Buscar por Nombre" name="nombre_Prod">
                    <button class="Search_btn" type="Submit" name="buscar_Nombre">Buscar</button>
                </form>
            </div>
            <div class="container_cards">
                <div class="Cards_Row">
                    <?php 

                        require("php/conexion.php");
                        $consulta = mysqli_query($conexion, "SELECT tproductos.TProductos_id, nombre_Articulo, precio, granel, codigo_Barras, Imagen, tinventario.stock
                        FROM tproductos inner join tinventario where tproductos.TProductos_id = tinventario.TProductos_id AND granel = 'Si' ORDER BY nombre_Articulo ASC;");
                        if (mysqli_num_rows($consulta) > 0) { 
                            while ($fila = $consulta -> fetch_assoc()) { ?> 
                                <div class="Card_Producto">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <button type="submit" class="btn_add" name="add_PLista">
                                        <img src="img/prod/<?php echo $fila['Imagen'] ?>" alt="" srcset="">
                                        <div class="detalles_card">
                                            <h2 class="nombre_producto"><?php echo $fila['nombre_Articulo'] ?></h2>
                                            <p class="precio_producto">$<?php echo $fila['precio']?></p>
                                            <input type="hidden" name="hidden_id" value="<?php echo $fila['TProductos_id'] ?>">
                                            <input type="hidden" name="hidden_Nombre" value="<?php echo $fila['nombre_Articulo']?>">
                                            <input type="hidden" name="hidden_Precio" value="<?php echo $fila['precio']?>">
                                            <input type="hidden" name="hidden_Granel" value="<?php echo $fila['granel']?>">
                                            <input type="hidden" name="hidden_Stock" value="<?php echo $fila['stock']?>">
                                            <input type="hidden" name="hidden_Codigo" value="<?php echo $fila['codigo_Barras'] ?>">
                                        </div>
                                        </button>
                                    </form>
                                </div> 
                         <?php   } 
                         } 

                         

                        include("php/addLista.php");

                    ?>
                </div>
            </div>
        </div>
</main>

<!-- Boton de Eliminar -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<form action="borrar2.php" method="post">
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

<!-- Boton de generar Venta -->
<div class="modal fade" id="generarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<form action="generarVenta.php" method="post" class="my-5">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <div class="form-group">
                <h4>TOTAL = <?php echo "$" .  $total . " MXN" ?></h4>
            </div>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">

            <div> 
                <td><input type="hidden" id="numVenta" name="numVenta" value="<?php echo $max ?>"></td>
                <td><input type="hidden" id="total" name="total" value="<?php echo $total?>"></td>
                <td><input type="hidden" id="numEmpleado" name="numEmpleado" value="<?php echo $_SESSION['empleadoID']?>"></td>
                <td><input type="hidden" id="fecha" name="fecha" value="<?php echo $fechaGuardar?>"></td>                            
            </div> 

            <!-- formulario -->

            <input type="hidden" name="total_Pagar" id="total_Pagar" value="<?php echo $total ?>">

            <div class="form-group">
                <label  class="col-form-label">El cliente pago con: </label><br>
                <input type="number" step="0.01" name="pago" id="pago" min="<?php echo $total ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label  class="col-form-label">Cambio: </label><br>
                <input type="text" name="cambio" id="cambio" readonly class="form-control">
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="ventaFinal" class="btn btn-primary">Aceptar</button>
        </div>
    </div>
</div>
</form>
</div>

<!-- Boton para insertar articulo de granel -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="my-5">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <div class="form-group">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $productos['nombre_Articulo'] ?></h5>
                
            </div>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">

            <!-- formulario -->

            <input type="hidden" name="codigo" id="codigo" value="<?php echo $productos['TProductos_id'] ?>">
            <input type="hidden" name="bar" id="bar" value="<?php echo $productos['codigo_Barras'] ?>">
            <input type="hidden" id="nom" name="nom" value="<?php echo $productos['nombre_Articulo'] ?>">
            <input type="hidden" id="precio" name="precio" value="<?php echo $productos['precio'] ?>">
            <input type="hidden" id="inventario" name="inventario" value="<?php echo $InventarioTotal ?>">

            <div class="form-group">
                <label  class="col-form-label">Precio</label><br>
                <input type="text" class="form-control" readonly value="<?php echo  "$" . $productos['precio'] . "  MXN" ?>">
            </div>

            <div class="form-group">
                <label  class="col-form-label">Stock</label><br>
                <input type="text" class="form-control" readonly value="<?php echo $InventarioTotal . "(" .  $Tipo_Granel . ")"; ?>">
            </div>

            <div class="form-group">
                <label  class="col-form-label">Cantidad</label><br>
                <input type="number" class="form-control" step="0.01" class="form-group" id="cantidad" name="cantidad" value="1" max="<?php echo $InventarioTotal ?>" min="0">
            </div>

        </div>

        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="agregar2" id="agregar2" class="btn btn-primary">Aceptar</button>
        </div>
    </div>
</div>
</form>
</div>

<!-- Boton para insertar articulo -->
<div class="modal fade" id="insertModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="my-5">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <div class="form-group">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $productos['nombre_Articulo'] ?></h5>
                
            </div>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">

            <!-- formulario -->

            <input type="hidden" name="codigo" id="codigo" value="<?php echo $productos['TProductos_id'] ?>">
            <input type="hidden" name="bar" id="bar" value="<?php echo $productos['codigo_Barras'] ?>">
            <input type="hidden" id="nom" name="nom" value="<?php echo $productos['nombre_Articulo'] ?>">
            <input type="hidden" id="precio" name="precio" value="<?php echo $productos['precio'] ?>">
            <input type="hidden" id="inventario" name="inventario" value="<?php echo $InventarioTotal ?>">

            <div class="form-group">
                <label  class="col-form-label">Precio</label><br>
                <input type="text" class="form-control" readonly value="<?php echo  "$" . $productos['precio'] . "  MXN" ?>">
            </div>

            <div class="form-group">
                <label  class="col-form-label">Stock</label><br>
                <input type="text" class="form-control" readonly value="<?php echo $InventarioTotal ?>">
            </div>

            <div class="form-group">
                <label  class="col-form-label">Cantidad</label><br>
                <input type="number" class="form-control" step="0.01" class="form-group" id="cantidad" name="cantidad" value="1" max="<?php echo $InventarioTotal ?>" min="0">
            </div>

        </div>

        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="agregar" id="agregar" class="btn btn-primary">Aceptar</button>
        </div>
    </div>
</div>
</form>
</div>

<!-- Boton para insertar articulo de granel -->
<div class="modal fade" id="insertModal_Granel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="my-5">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <div class="form-group">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $nombre ?></h5>
                
            </div>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">

            <!-- formulario -->

            <input type="hidden" name="codigo" id="codigo" value="<?php echo $idProd ?>">
            <input type="hidden" name="bar" id="bar" value="<?php echo $codigo ?>">
            <input type="hidden" id="nom" name="nom" value="<?php echo $nombre ?>">
            <input type="hidden" id="precio" name="precio" value="<?php echo $precio ?>">
            <input type="hidden" id="inventario" name="inventario" value="<?php echo $InventarioTotal ?>">

            <div class="form-group">
                <label  class="col-form-label">Precio</label><br>
                <input type="text" class="form-control" readonly value="<?php echo  "$" . $precio . "  MXN" ?>">
            </div>

            <div class="form-group">
                <label  class="col-form-label">Stock</label><br>
                <input type="text" class="form-control" readonly value="<?php echo $InventarioTotal . "(" .  $Tipo_Granel . ")"; ?>">
            </div>

            <div class="form-group">
                <label  class="col-form-label">Cantidad</label><br>
                <input type="number" class="form-control" step="0.01" class="form-group" id="cantidad" name="cantidad" value="1" max="<?php echo $InventarioTotal ?>" min="0">
            </div>

        </div>

        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="agregar2" id="agregar2" class="btn btn-primary">Aceptar</button>
        </div>
    </div>
</div>
</form>
</div>

<!-- javascript funciones para eliminar y generarVenta -->
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
            $('#Nom').val(data[0]);
    })
    }
    
    function VentaFinal(){
    $('.generarBtn').on('click',function(){
        $('#generarModal').modal('show');
    
    })
    }
</script>

<script>
    //para cuando se genera la venta, se muestre el cambio
let precio1 = document.getElementById("total_Pagar")
let precio2 = document.getElementById("pago")
let precio3 = document.getElementById("cambio")

precio2.addEventListener("change", () => {
    precio3.value = parseFloat(precio2.value) - parseFloat(precio1.value)

})
</script>


</body>
</html>
