<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template 
    <link rel="stylesheet" href="css/sb-inventario.css">-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
     
    <style>
        .button {
    background-color: blue; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 4px;

    }

    body {
        background-color: blue;
        /*background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);*/
        background-image: linear-gradient(180deg, blue 10%, #C6C3EA 100%);
        background-size: cover;
    }

    </style>

</head>
<!--bg-gradient-primary-->
<body>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                          <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                          
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido</h1>
                                    </div>
                                    <form class="user" action="comprobar_login2.php" method = "post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Ingresa tu Usuario" name="user">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary btn-lg" name="enviar">Enviar</button>

                                        <p><?php echo ""?></p>
                                        
                                    </form>
                                    <hr>
                                    <!-- en caso de que no haya ningun registro de admin, va a aparecer el sig boton -->
                                    <div>
                                        <?php 
        
                                            $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
                                            
                                            $consulta2="SELECT COUNT(TEmpleado_id) FROM t_empleado ";

                                            $Resultados2=mysqli_query($conexion,$consulta2);

                                            $row = mysqli_fetch_array($Resultados2);

                                            $total = $row[0];

                                            if ($total == 0) {
                                                # code...
                                                ?>

                                                <form class="user" action="encriptar/Registrar.php" method = "post">
                                                    <button type="submit" class="btn btn-primary btn-lg" name="enviar">Registrarse</button>
                                                <?php
                                            }
                                        
                                        ?>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>