<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
    <div class="container">
      <div class="row">
        <div class="col-1">
         
        </div>
        <div class="col-10">
        <h1 class="my-5">Registrar un nuevo Contacto</h1>

        <form class="my-5" action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">

            <div class="mb-3">
                <label  class="form-label">Nombre Empresa</label>
                <input type="text" class="form-control" name="empresa" placeholder="Empresa" value="<?php if(isset($empresa)) echo $empresa ?>">
            </div>
                                        
            <div class="mb-3">
              <label  class="form-label">Nombre del Repartidor</label>
              <input type="text" class="form-control" name="name" placeholder="Nombre Proveedor" value="<?php if(isset($name)) echo $name ?>">
            </div>

            <div class="mb-3">
              <label  class="form-label">Apellidos</label>
              <input type="text" class="form-control" name="ape" placeholder="Apellidos" value="<?php if(isset($ape)) echo $ape ?>">
            </div>


            <!-- ----------------------------------------  Telefono ----------------------------------------------------- -->
            
            <div>
              <label for="">Nuevo numero de telefono</label>
            </div>
            <div class="form-floating mb-3">
              <input type="tel" class="form-control" placeholder="Formato: (ddd) ddd-dddd" 
              pattern="\([0-9]{3}\) [0-9]{3}[ -][0-9]{4}" id="phone" name="phone" value="<?php if(isset($phone)) echo $phone ?>">
              <label for="floatingInput">Formato: (ddd) ddd-dddd</label>
            </div>

            <div>
              <label for="">Dias de Visita</label>
            </div>

            <div class="mb-3">
              
              <div class="form-check form-check-inline">
                <input type="hidden" type="checkbox" name="visita">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="visita[]" value="Lunes"
                
                <?php 
      
                  if(isset($visita) and $visita != null){
                    if (in_array("Lunes", $Dias)) {
                      echo "checked";
                    }
                  }

                ?>
                
                >
                <label class="form-check-label" for="inlineCheckbox1">Lunes</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="visita[]" value="Martes"
                
                <?php 
      
                  if(isset($visita) and $visita != null){
                    if (in_array("Martes", $Dias)) {
                      echo "checked";
                    }
                  }

                ?>
                
                >
                <label class="form-check-label" for="inlineCheckbox2">Martes</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="visita[]" value="Miercoles"
                
                <?php 
      
                  if(isset($visita) and $visita != null){
                    if (in_array("Miercoles", $Dias)) {
                      echo "checked";
                    }
                  }

                ?>
                
                >
                <label class="form-check-label" for="inlineCheckbox2">Miercoles</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox4" name="visita[]" value="Jueves"
                
                <?php 
      
                  if(isset($visita) and $visita != null){
                    if (in_array("Jueves", $Dias)) {
                      echo "checked";
                    }
                  }

                ?>

                >
                <label class="form-check-label" for="inlineCheckbox2">Jueves</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox5" name="visita[]" value="Viernes"
                
                <?php 
      
                  if(isset($visita) and $visita != null){
                    if (in_array("Viernes", $Dias)) {
                      echo "checked";
                    }
                  }

                ?>
                
                >
                <label class="form-check-label" for="inlineCheckbox2">Viernes</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox6" name="visita[]" value="Sabado"
                
                <?php 
      
                  if(isset($visita) and $visita != null){
                    if (in_array("Sabado", $Dias)) {
                      echo "checked";
                    }
                  }

                ?>
                
                >
                <label class="form-check-label" for="inlineCheckbox2">Sabado</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox7" name="visita[]" value="Domingo"
                
                <?php 
      
                  if(isset($visita) and $visita != null){
                    if (in_array("Domingo", $Dias)) {
                      echo "checked";
                    }
                  }

                ?>
                
                >
                <label class="form-check-label" for="inlineCheckbox2">Domingo</label>
              </div>

            </div>

            
            <div class="my-5">
            <button type="submit" class="btn btn-primary" name="enviar">Registrar</button>
            </div>
  
        </form>

        </div>
        <div class="col-1">
          
        </div>
      </div>
    </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>