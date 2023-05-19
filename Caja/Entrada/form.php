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
        <div class="col-1">
         
        </div>
        <div class="col-10">
        <h1 class="my-5">Entrada de dinero a la Caja</h1>

        <form class="my-5" action="Entrada_Dinero.php" method="post">

            <div class="mb-3">
                <label class="form-label">Cantidad de dinero a guardar</label>
                <input  type="number" step="0.01" min="0" class="form-control"  name="cant" id="cant" placeholder="Cantidad de dinero a guardar" value="<?php if(isset($cant)) echo $cant ?>">
            </div>

            <div class="my-5">
            <button type="submit" class="btn btn-primary" name="enviar">Aceptar</button>
            </div>
  
            
        </form>

        </div>
        <div class="col-1">
          
        </div>
      </div>
    </div>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>