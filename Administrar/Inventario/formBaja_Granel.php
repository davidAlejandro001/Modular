<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-2">
    
</div>

    <div class="col-8">

        <h2>Dar de baja del inventario</h2>

        <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">
        <div class="mb-3">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $Id?>">
        </div>

        <div class="mb-3">
            <label class="form-label"></label>
            <input type="hidden" class="form-control" name="stock" id="stock" value="<?php echo $Stock ?>">
        </div>

        <!-- -----------------------------------------------------------------------------------------------------------------  -->

        <div class="mb-3">
            <label class="form-label">Cantidad</label>
            <!-- se le agrego un maximo de elementos -->
            <input type="number" step="0.01" class="form-control" name="cantidad" id="cantidad" value="<?php 
            
            if(isset($cantidad)){ 
                echo $cantidad;
            }else{
                echo "0";
            }
            
            ?>" max="<?php echo $Stock ?>" min="0.01">
        </div>

        <div class="mb-3">
            <label for="">Descripcion</label>
            <input type="text" class="form-control" name="des" id="des" value="<?php if(isset($descripcion)) echo $descripcion ?>">
        </div>
        
        <button type="submit" class="btn btn-primary" name="bot_actualizar" id="bot_actualizar">Aceptar</button>
        </form>
    </div>
<div class="col-2">
         
</div>
</div>
</div>   

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>