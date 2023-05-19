<?php


if(isset($_POST["buscar_Nombre"]) and $_POST["nombre_Prod"] != null){


    

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $nombre=$_POST["nombre_Prod"];

        include("conexion.php");

        $sql_nom="SELECT * FROM tproductos WHERE nombre_Articulo = ?";

        $resultado_nom = array($nombre);
        $stmt_nom = $base->prepare($sql_nom);
        $stmt_nom->execute($resultado_nom);

        //rowCount = devuelve 0 o 1 si hay o no un usuario
        $registro_nombre=$stmt_nom->rowCount();


        $sql_name="SELECT * FROM tproductos WHERE nombre_Articulo LIKE ?";

        $resultado_name = array("%$nombre%");
        $stmt_name = $base->prepare($sql_name);
        $stmt_name->execute($resultado_name);

        //rowCount = devuelve 0 o 1 si hay o no un usuario
        $registros_name=$stmt_name->rowCount();

        if($registro_nombre != 0 || $registros_name != 0){

        if($registro_nombre != 0){

            ////////////////////////////////////////////////////////////////////////////////////////
            if($productos=$stmt_nom->fetch(PDO::FETCH_ASSOC)){

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

                            $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
                            $consulta = mysqli_query($conexion, "SELECT tproductos.TProductos_id, nombre_Articulo, precio, granel, codigo_Barras, Imagen, tinventario.stock, tgranel.T_TipoGranel_id, t_tipogranel.descripcion
                            FROM tproductos inner join tinventario, tgranel, t_tipogranel
                            where tproductos.TProductos_id = tinventario.TProductos_id and tproductos.TProductos_id = tgranel.TProductos_id and tgranel.T_TipoGranel_id = t_tipogranel.T_TipoGranel_id
                            AND granel = 'Si' AND tproductos.TProductos_id = '$id_Producto' ORDER BY nombre_Articulo ASC;");
                            if (mysqli_num_rows($consulta) > 0) { 
                                while ($fila = $consulta -> fetch_assoc()) { ?> 
                                    <div class="Card_Producto">
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <button type="submit" class="btn_add" name="add_PLista">
                                            <img src="img/prod/<?php echo $fila['Imagen'] ?>" alt="" srcset="">
                                            <div class="detalles_card">
                                                <h2 class="nombre_producto"><?php echo $fila['nombre_Articulo'] ?></h2>
                                                <p class="precio_producto">$<?php echo $fila['precio']?></p>
                                                <p class="modelo_producto"><?php echo $fila['descripcion']?></p>
                                                <input type="hidden" name="hidden_id" value="<?php echo $fila['TProductos_id'] ?>">
                                                <input type="hidden" name="hidden_Nombre" value="<?php echo $fila['nombre_Articulo']?>">
                                                <input type="hidden" name="hidden_Precio" value="<?php echo $fila['precio']?>">
                                                <input type="hidden" name="hidden_Granel" value="<?php echo $fila['granel']?>">
                                                <input type="hidden" name="hidden_Stock" value="<?php echo $fila['stock']?>">
                                                <input type="hidden" name="hidden_Stock" value="<?php echo $fila['T_TipoGranel_id']?>">
                                                <input type="hidden" name="hidden_Codigo" value="<?php echo $fila['codigo_Barras'] ?>">
                                            </div>
                                            </button>
                                        </form>
                                    </div> 
                                <?php   } 
                            } 

                            echo '<script type="text/javascript">'
                                . '$( document ).ready(function() {'
                                . '$("#insertModal").modal("show");'
                                . '});'
                                . '</script>';

                        //si no lo es
                        }else {

                            $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
                            $consulta = mysqli_query($conexion, "SELECT tproductos.TProductos_id, nombre_Articulo, precio, granel, codigo_Barras, Imagen, tinventario.stock
                            FROM tproductos inner join tinventario where tproductos.TProductos_id = tinventario.TProductos_id AND tproductos.TProductos_id = $id_Producto ");
                            if (mysqli_num_rows($consulta) > 0) { 
                                while ($fila = $consulta -> fetch_assoc()) { ?> 
                                    <div class="Card_Producto">
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <button type="submit" class="btn_add" name="add_PLista2">
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

                            echo '<script type="text/javascript">'
                                . '$( document ).ready(function() {'
                                . '$("#insertModal2").modal("show");'
                                . '});'
                                . '</script>';
                        }


                }

        }else if($registros_name != 0){
            
            $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
            $consulta = mysqli_query($conexion, "SELECT tproductos.TProductos_id, nombre_Articulo, precio, granel, codigo_Barras, Imagen, tinventario.stock
            FROM tproductos inner join tinventario where tproductos.TProductos_id = tinventario.TProductos_id AND tproductos.nombre_Articulo LIKE '%$nombre%' ORDER BY nombre_Articulo ASC;");
            if (mysqli_num_rows($consulta) > 0) { 
                while ($fila = $consulta -> fetch_assoc()) { ?>

                    <?php
                    $granel=$fila['granel'];
                    $idProd=$fila['TProductos_id'];
                    if($granel=="No"){
                    ?>
                    
                
                    <div class="Card_Producto">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <button type="submit" class="btn_add" name="add_PLista2">
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

                    <?php 
                    }else{

                        include("conexion.php");

                        $resultado4=$base->query("SELECT * FROM tgranel INNER JOIN t_tipogranel WHERE tgranel.T_TipoGranel_id = t_tipoGranel.T_TipoGranel_id AND tgranel.TProductos_id=$idProd")->fetchAll(PDO::FETCH_OBJ);

                        foreach($resultado4 as $registro2){
                            $Id_Granel = $registro2->T_TipoGranel_id;
                            $descripcion = $registro2->descripcion;
                            
                        }

                    ?>

                                    <div class="Card_Producto">
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <button type="submit" class="btn_add" name="add_PLista">
                                            <img src="img/prod/<?php echo $fila['Imagen'] ?>" alt="" srcset="">
                                            <div class="detalles_card">
                                                <h2 class="nombre_producto"><?php echo $fila['nombre_Articulo'] ?></h2>
                                                <p class="precio_producto">$<?php echo $fila['precio']?></p>
                                                <p class="modelo_producto"><?php echo $descripcion ?></p>
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

                    <?php 
                    }
                    ?>




             <?php   } 
             }        
    
    
            }

    }else{

            $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
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
    }if((isset($_POST["buscar_Nombre"]) and $_POST["nombre_Prod"] == null)){

        $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");

        /*$consulta = mysqli_query($conexion, "SELECT tproductos.TProductos_id, nombre_Articulo, precio, granel, codigo_Barras, Imagen, tinventario.stock, tgranel.T_TipoGranel_id
                        FROM tproductos inner join tinventario, tgranel where tproductos.TProductos_id = tinventario.TProductos_id and tproductos.TProductos_id = tgranel.TProductos_id AND granel = 'Si' ORDER BY nombre_Articulo ASC;");
                        if (mysqli_num_rows($consulta) > 0) { 
                            while ($fila = $consulta -> fetch_assoc()) { ?> 
                                <div class="Card_Producto">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <button type="submit" class="btn_add" name="add_PLista">
                                        <img src="img/prod/<?php echo $fila['Imagen'] ?>" alt="" srcset="">
                                        <div class="detalles_card">
                                            <h2 class="nombre_producto"><?php echo $fila['nombre_Articulo'] ?></h2>
                                            <p class="precio_producto">$<?php echo $fila['precio']?></p>
                                            <p class="modelo_producto"><?php echo $fila['T_TipoGranel_id']?></p>
                                            <input type="hidden" name="hidden_id" value="<?php echo $fila['TProductos_id'] ?>">
                                            <input type="hidden" name="hidden_Nombre" value="<?php echo $fila['nombre_Articulo']?>">
                                            <input type="hidden" name="hidden_Precio" value="<?php echo $fila['precio']?>">
                                            <input type="hidden" name="hidden_Granel" value="<?php echo $fila['granel']?>">
                                            <input type="hidden" name="hidden_Stock" value="<?php echo $fila['stock']?>">
                                            <input type="hidden" name="hidden_Stock" value="<?php echo $fila['T_TipoGranel_id']?>">
                                            <input type="hidden" name="hidden_Codigo" value="<?php echo $fila['codigo_Barras'] ?>">
                                        </div>
                                        </button>
                                    </form>
                                </div> 
                         <?php   } 
                         } 
                         */
            
                         $consulta = mysqli_query($conexion, "SELECT tproductos.TProductos_id, nombre_Articulo, precio, granel, codigo_Barras, Imagen, tinventario.stock, tgranel.T_TipoGranel_id, t_tipogranel.descripcion
                         FROM tproductos inner join tinventario, tgranel, t_tipogranel
                         where tproductos.TProductos_id = tinventario.TProductos_id and tproductos.TProductos_id = tgranel.TProductos_id and tgranel.T_TipoGranel_id = t_tipogranel.T_TipoGranel_id
                         AND granel = 'Si' ORDER BY nombre_Articulo ASC;");
                         if (mysqli_num_rows($consulta) > 0) { 
                             while ($fila = $consulta -> fetch_assoc()) { ?> 
                                 <div class="Card_Producto">
                                     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                         <button type="submit" class="btn_add" name="add_PLista">
                                         <img src="img/prod/<?php echo $fila['Imagen'] ?>" alt="" srcset="">
                                         <div class="detalles_card">
                                             <h2 class="nombre_producto"><?php echo $fila['nombre_Articulo'] ?></h2>
                                             <p class="precio_producto">$<?php echo $fila['precio']?></p>
                                             <p class="modelo_producto"><?php echo $fila['descripcion']?></p>
                                             <input type="hidden" name="hidden_id" value="<?php echo $fila['TProductos_id'] ?>">
                                             <input type="hidden" name="hidden_Nombre" value="<?php echo $fila['nombre_Articulo']?>">
                                             <input type="hidden" name="hidden_Precio" value="<?php echo $fila['precio']?>">
                                             <input type="hidden" name="hidden_Granel" value="<?php echo $fila['granel']?>">
                                             <input type="hidden" name="hidden_Stock" value="<?php echo $fila['stock']?>">
                                             <input type="hidden" name="hidden_Stock" value="<?php echo $fila['T_TipoGranel_id']?>">
                                             <input type="hidden" name="hidden_Codigo" value="<?php echo $fila['codigo_Barras'] ?>">
                                         </div>
                                         </button>
                                     </form>
                                 </div> 
                          <?php   } 
                          } 
    }

    ?>

    