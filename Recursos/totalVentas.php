<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <?php 

        date_default_timezone_set('America/Mexico_City');
        $fechaGuardar = date('Y-m-d');
    
        $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");

        $consulta2="SELECT COUNT(TVenta_id) FROM tventa where fecha='$fechaGuardar'";

        $Resultados2=mysqli_query($conexion,$consulta2);

        $row = mysqli_fetch_array($Resultados2);

        $total = $row[0];

        echo $total;
    
    ?>
</body>
</html>