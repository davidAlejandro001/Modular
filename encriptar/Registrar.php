<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>

    <style>

        body{
          background-color: #999DF3;
          
        }

    </style>


</head>
<body>
    <div class="container-fluid">

        <hr class="sidebar-divider">

        <div style="text-align: left;">
            <button type="button" class="btn btn-light" ><a href="../index.php">Go back</a></button>
        </div>  
    </div>

    <div class="container">
      <div class="row">
        <div class="col-1">
         
        </div>
        <div class="col-10">
        <h1 class="my-5">Registrarse</h1>

        <form class="my-5" action="encriptar.php" method="post">


            <!-- ----------------------------------------  nombre ----------------------------------------------------- -->
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="name" placeholder="Escribe tu nombre">
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Apellidos</label>
              <input type="text" class="form-control" name="ape" placeholder="Escribe tus apellidos">
            </div>

            <!-- ----------------------------------------  nombre de usuario ------------------------------------------- -->
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nombre de Usuario</label>
              <input type="text" class="form-control" name="login" placeholder="nombre de usuario">
            </div>
            <!-- --------------------------------------------------    password ------------------------------------------- -->
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Ingresa la contraseña">
            </div>

<!--
            <div class="form-check">
            <input class="form-check-input" type="radio" name="perfil" id="perfil" value="Administrador">
            <label class="form-check-label" for="flexRadioDefault1">
                Administrador
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="perfil" value="Usuario" id="perfil" checked>
            <label class="form-check-label" for="flexRadioDefault2">
                Usuario
            </label>
            </div>

                    -->

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