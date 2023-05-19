<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-2">
    
</div>

    <div class="col-8">

        <h2>Agregar</h2>

        <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">
        <div class="mb-3">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $Id?>">
        </div>

        <!-- --------------------------------------------------- inventario ---------------------------------------------------  -->
        <div class="mb-3">
            <label class="form-label"></label>
            <input type="hidden" class="form-control" name="stock" id="stock"
            
            <?php if(!isset($stocks)) {?>

                value="<?php echo $Stock ?>"

            <?php }else if(isset($stocks)){ ?>

                value="<?php  echo $stocks ?>"

            <?php } ?>
            
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Stock actual</label>
            <input type="text" class="form-control" name="#" id="#" disabled readonly
            
            <?php if(!isset($stocks)) {?>

            placeholder="<?php echo $Stock ?>"

            <?php }else if(isset($stocks)){ ?>

            placeholder="<?php  echo $stocks ?>"

            <?php } ?>
            
            >
        </div>

        <!-- -----------------------------------------------------------------------------------------------------------------  -->

        <div class="mb-3">
            <label class="form-label">Agregar</label>
            <input type="number" min="0" class="form-control"  name="cantidad" id="cantidad" 
            
            <?php if(!isset($cantidad)) {?>

                value="0"

            <?php }else if(isset($cantidad)){ ?>

                value="<?php  echo $cantidad ?>"

            <?php } ?>
            
            >
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