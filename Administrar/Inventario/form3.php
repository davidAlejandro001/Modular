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

    <h2>Insertar un nuevo Articulo</h2>

    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>" enctype="multipart/form-data">

        <!-- -------------------------------------------------  Nombre -------------------------------------------------------- -->

        <div class="my-3">
            <label for="">Nombre del Producto</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre del articulo"
            value="<?php if(isset($nombre)) echo $nombre ?>"
            >
        </div>

        <div class="my-3">
            <label for="">Es de tipo Granel?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="granel" id="hide" value="No" checked>
                <!-- En caso de que se elija "No" -->
                <input type="hidden" name="granelTipo" value="nulo">
                <label class="form-check-label" for="flexRadioDefault1">
                    No
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="granel" id="show" value="Si">
                <label class="form-check-label" for="flexRadioDefault2">
                    Si
                </label>
            </div>

        </div>

        <div class="mb-3" id="box">
            <label class="form-label">Tipo de Granel</label>
            <select name="granelTipo" id="granelTipo" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <?php 
  
                                    $registros3=$base->query("SELECT * FROM t_tipogranel")->fetchAll(PDO::FETCH_OBJ);

                                    foreach ($registros3 as $TGranel):

                                            echo '<option value="'.$TGranel->T_TipoGranel_id.'">'.$TGranel->descripcion.'</option>';
                                        
                                    ?>    
                                    <?php 
                                        endforeach;
                                    ?>
            </select>
        </div>
        <div class="form-row"> 
        <div class="form-group col-md-4">
            <label for="">Stock Inicial</label>
            <input type="number" step="0.01" min="0" class="form-control" name="stock" id="stock" placeholder="Ingresa la cantidad total"

            <?php if(!isset($stock)) {?>

                value="1"

            <?php }else if(isset($stock)){ ?>

                value="<?php  echo $stock ?>"

            <?php } ?>

            >
        </div>

        <div class="form-group col-md-4">
            <label for="">stock minimo</label>
            <input type="number" step="0.01" min="0" class="form-control" name="min" id="min" placeholder="Ingresa la cantidad total"
            
            <?php if(!isset($minimo)) {?>

                value="1"

                <?php }else if(isset($minimo)){ ?>

                value="<?php  echo $minimo ?>"

            <?php } ?>

            >
        </div>

        <div class="form-group col-md-4">
            <label for="">Ganancia %</label>
            <input type="number" min="0" max="100" value="30" class="form-control" name="ganancia" id="ganancia" placeholder="Ingresa la cantidad total"
            
            >
        </div>      

        </div>
        <div class="my-3">
            <label for="">Precio de Compra</label>
            <input type="number" step="0.01" min="0" class="form-control" name="compra" id="compra" placeholder="Ingresa el precio del articulo x unidad"
            value="<?php if(isset($compra)) echo $compra ?>"
            >
        </div>

        <div class="my-3">
            <label for="">Precio de Venta</label>
            <input type="number" step="0.01" min="0" class="form-control" name="precio" id="precio" placeholder="Ingresa el precio del articulo x unidad"
            value="<?php if(isset($precio)) echo $precio ?>"
            >
        </div>

        <div class="my-3">
            <label for="">Codigo de Barras</label>
            <input type="text" class="form-control" name="cod" id="cod" placeholder="Ingresa el codigo de barras del articulo"
            value="<?php if(isset($codigoBarras)) echo $codigoBarras ?>"
            >
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
        
        <div class="my-3">
            <label for="imagen">Subir Imagen</label>
            <input type="file" class="form-control" name="imagen" id="imagen">
        </div>

        <button type="submit" class="btn btn-primary" name="bot_insertar" id="bot_insertar">Aceptar</button>
        </form>
    </div>
<div class="col-2">
         
</div>
</div>
</div>

<script>
    //para cuando se genera la venta, se muestre el cambio
let precio1 = document.getElementById("ganancia")
let precio2 = document.getElementById("compra")
let precio3 = document.getElementById("precio")

precio2.addEventListener("change", () => {
    precio3.value = (parseFloat(precio2.value) * (parseFloat(precio1.value)/100)) + parseFloat(precio2.value)

})
</script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="granel.js"></script>
</body>
</html>