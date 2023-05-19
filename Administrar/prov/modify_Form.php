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

    <h2>Modificar</h2>

    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">
        <div class="mb-3">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $Id?>">
        </div>

        <div class="mb-3">
            <label  class="form-label">Nombre Empresa</label>
            <input type="text" class="form-control" name="empresa" placeholder="Empresa" value="<?php echo $Empresa?>">
        </div>
                                        
        <div class="mb-3">
            <label  class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" placeholder="Nombre Proveedor" value="<?php echo $Nom?>">
        </div>

        <div class="mb-3">
            <label  class="form-label">Apellidos</label>
            <input type="text" class="form-control" name="ape" placeholder="Apellidos" value="<?php echo $Ape?>">
        </div>

        <!-- -------------------------------------------------  Telefono -------------------------------------------------------- -->

        <div>
            <label for="">Numero de telefono</label>
        </div>
        
        <div class="form-floating mb-3">
            <input type="tel" class="form-control" 
                pattern="\([0-9]{3}\) [0-9]{3}[ -][0-9]{4}" id="phone" name="phone" value="<?php echo $Tel?>">
            <label for="floatingInput">Formato: (ddd) ddd-dddd</label>
        </div>

        <!-- Dias de Visita -->

            <div>
              <label for="">Dias de Visita</label>
            </div>

            <div class="mb-3">
              
              <div class="form-check form-check-inline">
              <input type="hidden" name="visita">
                <input class="form-check-input" type="checkbox" name="visita[]" value="Lunes"
                <?php 

                  if (in_array("Lunes", $Dia_Visita)) {
                    echo "checked";
                  }
                
                ?>
                >
                <label class="form-check-label" for="inlineCheckbox1">Lunes</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="visita[]" value="Martes"
                <?php 

                  if (in_array("Martes", $Dia_Visita)) {
                    echo "checked";
                  }
                
                ?>
                >
                <label class="form-check-label" for="inlineCheckbox2">Martes</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="visita[]" value="Miercoles"
                <?php 
                  
                  if (in_array("Miercoles", $Dia_Visita)) {
                    echo "checked";
                  }
                ?>
                >
                <label class="form-check-label" for="inlineCheckbox2">Miercoles</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="visita[]" value="Jueves"
                <?php 

                  if (in_array("Jueves", $Dia_Visita)) {
                    echo "checked";
                  }
                
                ?>
                >
                <label class="form-check-label" for="inlineCheckbox2">Jueves</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="visita[]" value="Viernes"
                <?php 
                
                  if (in_array("Viernes", $Dia_Visita)) {
                    echo "checked";
                  }
                
                ?>
                >
                <label class="form-check-label" for="inlineCheckbox2">Viernes</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="visita[]" value="Sabado"
                <?php 
                
                  if (in_array("Sabado", $Dia_Visita) and $visit != null) {
                    echo "checked";
                  }
                
                ?>
                >
                <label class="form-check-label" for="inlineCheckbox2">Sabado</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="visita[]" value="Domingo"
                <?php 
                
                  if (in_array("Domingo", $Dia_Visita) and $visit != null) {
                    echo "checked";
                  }
                
                ?>
                >
                <label class="form-check-label" for="inlineCheckbox2">Domingo</label>
              </div>

            </div>
        
        <button type="submit" class="btn btn-primary" name="bot_actualizar" id="bot_actualizar">Aceptar</button>
        </form>
    </div>
<div class="col-2">
         
</div>
</div></div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>