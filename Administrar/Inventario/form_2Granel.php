<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
    #box {
      display: none;
      
      color: black;
    }
  </style>

</head>
<body>

<div class="container">
  <div class="row">
<div class="col-2">
    
</div>

  <div class="col-8">

    <h2>Modificar</h2>

    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">
        <div class="mb-3">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $Id?>">

                <label class="form-label">Codigo de Barras</label>
                <input type="text" class="form-control" name="cod" value="<?php echo $codigo ?>">

        </div>
 
        <!-- -------------------------------------------------  Descripcion y precio -------------------------------------------------------- -->

        <div class="my-3">
            <label class="form-label">Descripcion</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $Nombre?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Precio de Compra</label>
            <input  type="number" step="0.01" min="0" class="form-control"  name="precio" id="precio" value="<?php echo $compra?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Precio de Venta</label>
            <input  type="number" step="0.01" min="0" class="form-control"  name="nuevoCosto" id="nuevoCosto" value="<?php echo $Costo?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Stock Minimo</label>
            <input  type="number" step="0.01" min="0" class="form-control"  name="min" id="min" value="<?php echo $minimo?>">
        </div>

        <!-- --------------------------------------------------- categoria id ---------------------------------------------------  -->
        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categ" id="categ" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <?php 
  
                                    $registros2=$base->query("SELECT * FROM tcategoria ORDER BY nombre ASC")->fetchAll(PDO::FETCH_OBJ);

                                    foreach ($registros2 as $Tcategoria):

                                        $producto = $Tcategoria->TCategoria_id;

                                        if ($producto==$Categ) {
                                            echo '<option selected value="'.$Tcategoria->TCategoria_id.'">'.$Tcategoria->nombre.'</option>';
                                        }else{
                                        echo '<option value="'.$Tcategoria->TCategoria_id.'">'.$Tcategoria->nombre.'</option>';    
                                        }

                                    ?>  
                                        
                                    <?php 
                                        //termina aqui el bucle
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

                                        $producto = $Tprov->TProveedor_id;

                                        if ($producto == $Prov) {
                                            echo '<option selected value="'.$Tprov->TProveedor_id.'">'.$Tprov->empresa.'</option>';
                                        }else{
                                        echo '<option value="'.$Tprov->TProveedor_id.'">'.$Tprov->empresa.'</option>';    
                                        }

                                    ?>  
                                        
                                    <?php 
                                        //termina aqui el bucle
                                        endforeach;
                                ?>
            </select>
            
        </div>

        <!-- -----------------------------------------------------------------------------------------------------------------  -->

        <!-- --------------------------------------------------- Granel ---------------------------------------------------  -->
        <div class="mb-3">
            <label class="form-label">Tipo de Granel</label>
            <select name="granel" id="granel" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <?php 
  
                                    $registros3=$base->query("SELECT * FROM t_tipogranel ORDER BY descripcion ASC")->fetchAll(PDO::FETCH_OBJ);

                                    foreach ($registros3 as $TGranel):

                                        $granel = $TGranel->T_TipoGranel_id;

                                        if ($granel==$idGranel) {
                                            echo '<option selected value="'.$TGranel->T_TipoGranel_id.'">'.$TGranel->descripcion.'</option>';
                                        }else{
                                        echo '<option value="'.$TGranel->T_TipoGranel_id.'">'.$TGranel->descripcion.'</option>';    
                                        }

                                    ?>  
                                        
                                    <?php 
                                        //termina aqui el bucle
                                        endforeach;
                                ?>
            </select>
        </div>

        <!-- -----------------------------------------------------------------------------------------------------------------  -->
        
        <button type="submit" class="btn btn-primary" name="bot_actualizar" id="bot_actualizar">Aceptar</button>
        </form>
    </div>
<div class="col-2">
         
</div>
</div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="granel.js"></script>
</body>
</html>