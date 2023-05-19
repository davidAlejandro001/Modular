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
        <h1 class="my-5">Registrarse</h1>

        <form class="my-5" action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">

            <!-- ----------------------------------------  nombre ----------------------------------------------------- -->
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="name" placeholder="Nombre"
              value="<?php if(isset($nombre)) echo $nombre ?>">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Apellidos</label>
              <input type="text" class="form-control" name="ape" placeholder="Apellido" value="<?php if (isset($apellido)) echo $apellido ?>">
            </div>

            <!-- ----------------------------------------  nombre de usuario ------------------------------------------- -->
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nombre Usuario</label>
              <input type="text" class="form-control" name="login" placeholder="Nombre de Usuario" value="<?php if(isset($usuario)) echo $usuario ?>">
            </div>
            <!-- --------------------------------------------------    password ------------------------------------------- -->
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?php if(isset($password)) echo $password ?>"
              placeholder="El password debe tener de 8 a 64 caracteres, al menos un número, una Mayúscula, una minuscula">
            </div>

            <div class="mb-3">
              <label class="form-label">Password (vuelve a ingresarlo)</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password2" value="<?php if(isset($password2)) echo $password2 ?>"
              placeholder="El password debe tener de 8 a 64 caracteres, al menos un número, una Mayúscula, una minuscula">
            </div>

            <!-- ----------------------------------------  categoria ------------------------------------------------------- -->

            <div class="mb-3">
              <input type="hidden" class="form-control" name="perfil" value= "2">
            </div>

            <div class="my-5">
            <button type="submit" class="btn btn-primary" name="enviar">Registrarse</button>
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