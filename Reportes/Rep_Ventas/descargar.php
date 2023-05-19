<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <!--Importante--->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar</title>
    <style>
    .color{
        background-color: #9BB;  
    }
</style>
</head>
<body>
    
<?php
include('conexion.php');
date_default_timezone_set('America/Mexico_City');
$fecha = date("d_m_Y");


/**PARA FORZAR LA DESCARGA DEL EXCEL */
header("Content-Type: text/html;charset=utf-8");
header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
$filename = "ReporteExcel_" .$fecha. ".xls";
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=" . $filename . "");

/***RECIBIENDO LAS VARIABLE DE LA FECHA */
$fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
$fechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));


/*
$sqlTrabajadores = ("select * from trabajadores where (fecha_ingreso>='$fechaInit' and fecha_ingreso<='$fechaFin') order by fecha_ingreso desc");
$sqlTrabajadores = ("SELECT * FROM trabajadores WHERE fecha_ingreso BETWEEN '$fechaInit' AND '$fechaFin' order by fecha_ingreso desc
$sqlTrabajadores = ("SELECT * FROM `trabajadores` WHERE fecha_ingreso BETWEEN '$fechaInit' AND '$fechaFin'
$sqlTrabajadores = ("select * from trabajadores where fecha_ingreso >= '$fechaInit' and fecha_ingreso < '$fechaFin';
$sqlTrabajadores = ("SELECT * FROM trabajadores WHERE fecha_ingreso BETWEEN '$fechaInit' AND '$fecha2' ORDER BY fecha_ingreso DESC
*/     

$sql="SELECT * FROM tventa WHERE fecha BETWEEN ? AND ? ORDER BY fecha ASC";

$resultado = array($fechaInit ,$fechaFin);
$stmt = $base->prepare($sql);
$stmt->execute($resultado);

//rowCount = devuelve 0 o 1 si hay o no un usuario
$num_registro=$stmt->rowCount();

if ($num_registro!=0) {

    ?>
        <table style="text-align: center;" border='1' cellpadding=1 cellspacing=1>
             <thead style="background: #D0CDCD;">
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Empleado</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
        <?php

            while($dataRow=$stmt->fetch(PDO::FETCH_ASSOC)){

                $empleado_id=$dataRow['TEmpleado_id'];
                
                $resultado2=$base->query("SELECT * FROM t_empleado WHERE TEmpleado_id=$empleado_id")->fetchAll(PDO::FETCH_OBJ);

                foreach($resultado2 as $registro){
                    $nombre = $registro->nombre;
                    $ape = $registro->apellidos;
                }
                

                ?>
                
                <tr class='table-light text-dark'>
                    <td><?php echo $dataRow['TVenta_id'] ?></td>
                    <td><?php echo $dataRow['fecha']; ?></td>
                    <td><?php echo $nombre . " " . $ape ?></td>
                    <td><?php echo $dataRow['total']; ?></td>
                </tr>

            <?php

            }

            ?>
                </tbody>
                </table>
            <?php

}

?>

</body>
</html>