<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <?php 
    
    $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
    
    $consulta2="SELECT COUNT(TEmpleado_id) FROM t_empleado ";

    $Resultados2=mysqli_query($conexion,$consulta2);

    $row = mysqli_fetch_array($Resultados2);

    $total = $row[0];

    echo $total;
    
    ?>
</body>
</html>