<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- En caso de que no haya ningun registro se va a ocultar el select -->
    <?php

        $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
        
        $consulta2="SELECT COUNT(TPerfil_id) FROM tperfil";

        $Resultados2=mysqli_query($conexion,$consulta2);

        $row = mysqli_fetch_array($Resultados2);

        $total = $row[0];


        $consulta="SELECT COUNT(TVenta_id) FROM tventa";

        $Resultados=mysqli_query($conexion,$consulta);

        $row2 = mysqli_fetch_array($Resultados);

        $total2 = $row2[0];


        $consulta3="SELECT COUNT(t_tipogranel_id) FROM t_tipogranel";

        $Resultados3=mysqli_query($conexion,$consulta3);

        $row3 = mysqli_fetch_array($Resultados3);

        $total3 = $row3[0];

    ?>

    <?php 

    //OJO CAMBIAR EL NUM CARACTERES PASSWORD XQ SINO VA A DAR ERROR, LA CADENA QUE SE GENERA ES MUY LARGA
 
    $usuario=$_POST["login"];
    $password=$_POST["password"];
    $apellido=$_POST["ape"];
    $nombre = $_POST["name"];
    $perfil = "1";

    $pass_cifrado=password_hash($password,PASSWORD_DEFAULT, array("cost"=>12));

       try {
        
            include("conexion.php");

            if($total==0){

                //control del perfil para evitar el error
                $Admin = "Administrador";
                $Empleado = "Empleado";
                $sql3 = "INSERT INTO tperfil(TPerfil_id, nombre) VALUES (:id, :nom)";

                $resultado3=$base->prepare($sql3);

                $resultado3->execute(array(":id"=>1, ":nom"=>$Admin));

                ////////////////////////////////////////////////////////////////////////////////////////////
                $sql4 = "INSERT INTO tperfil(TPerfil_id, nombre) VALUES (:id, :nom)";

                $resultado4=$base->prepare($sql4);

                $resultado4->execute(array(":id"=>2, ":nom"=>$Empleado));

            }

            /////////////////////////////////////////////////////////////////////////////////////////////

            #evitar que se ingresen datos nulos del formulario
            if ($usuario != null and $password != null and $apellido != null and $nombre != null) {

                $sql="INSERT INTO t_empleado(TPerfil_id, nombre, apellidos, nombre_usuario, passwordd) VALUES (:perf, :nom, :ape, :user, :passwd)";

                $resultado=$base->prepare($sql);

                $resultado->execute(array(":perf"=>$perfil, ":nom"=>$nombre, ":ape"=>$apellido, ":user"=>$usuario, ":passwd"=>$pass_cifrado));

                $resultado->closeCursor();

                header("Location:../index.php");

            }else{

                include("error.php");

            }

            //se va a insertar este registro para evitar un error en el punto de venta

            if($total2 == 0 ){

                $sql2 = "INSERT INTO tventa(TVenta_id, TEmpleado_id, fecha, total, TCaja_id) VALUES (:hist, :emp, :fecha, :total, :caja)";

                $resultado2=$base->prepare($sql2);

                $resultado2->execute(array(":hist"=>0, ":emp"=>null, ":fecha"=>null, ":total"=>null, ":caja"=>null));

            }

            //Llenado del tipo de granel que hay en la tienda si no hay ningun registro

            if($total3==0){

                $sql6 = "INSERT INTO t_tipogranel(descripcion) VALUES (:descrip)";

                $resultado6=$base->prepare($sql6);

                $resultado6->execute(array(":descrip"=>"Kg"));


                $sql7 = "INSERT INTO t_tipogranel(descripcion) VALUES (:descrip)";

                $resultado7=$base->prepare($sql7);

                $resultado7->execute(array(":descrip"=>"Mazo"));

            }

           // echo "Registro nuevo";

        } catch (Exception $e) {
            echo "Linea del error: " . $e->getLine();
            echo "Error: " . $e->getMessage();
        }
    
    ?>
</body>
</html>