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

    <!-- Custom styles for this template -->

    <link href="css/sb-admin-2.css" rel="stylesheet">
</head>
<body> 
    <?php 

            $usuario=htmlentities(addslashes($_POST["user"]));
            $password=htmlentities(addslashes($_POST["password"]));

            $contador=0;

            include("conexion.php");

            $sql="SELECT * FROM t_empleado WHERE nombre_usuario = :user";

            $resultado=$base->prepare($sql);

            $resultado->execute(array(":user"=>$usuario));

            while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $registro['passwordd'])) {
                    $contador++;
                }  
                session_start();
                $_SESSION['perfil']=$registro['TPerfil_id'];
                $_SESSION['empleadoID']=$registro['TEmpleado_id'];
                $_SESSION['nombre']=$registro['nombre'];
                $_SESSION['apellidos']=$registro["apellidos"];
            } 

            if ($contador>0) {
              
              // echo "Usuario Registrado";
                $_SESSION["usuario"]=$_POST["user"];
                $_SESSION["contra"]=$_POST["password"];
               
                $nom =  $_SESSION['perfil'];

                if($nom == "1"){
                    $_SESSION['perfil'] = "Administrador";
                    $perfil = "Administrador";
                }else{
                    $_SESSION['perfil'] = "Empleado";
                    $perfil = "Empleado";
                }

            ?>

            <?php
            
                if ($perfil == "Empleado") {
                   
                    include("user.php");
                }else if($perfil == "Administrador"){
                    
                    include("admin.php");
                }


            }else{
                include("Recursos/error.php");
            }

            $resultado->closeCursor();
        
    ?>
    
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>


</body>
</html>