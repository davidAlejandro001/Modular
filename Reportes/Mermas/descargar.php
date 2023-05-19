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
   

$sql="SELECT * FROM t_merma WHERE fecha BETWEEN ? AND ? ORDER BY fecha ASC";

$resultado = array($fechaInit ,$fechaFin);
$stmt = $base->prepare($sql);
$stmt->execute($resultado);

//rowCount = devuelve 0 o 1 si hay o no un usuario
$num_registro=$stmt->rowCount();

if ($num_registro!=0) {

    ?> 
        <table style="text-align: center;" border='1' cellpadding=1>
            <thead style="background: #D0CDCD;">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
    <?php

    while($dataRow=$stmt->fetch(PDO::FETCH_ASSOC)){

        $producto_id=$dataRow['TProductos_id'];
        
        $resultado3=$base->query("SELECT * FROM tproductos WHERE TProductos_id=$producto_id")->fetchAll(PDO::FETCH_OBJ);

        foreach($resultado3 as $registro){
            $producto = $registro->nombre_Articulo;
        }
        

        ?>
        
        <tr class='table-light text-dark'>
            <td><?php echo $producto ?></td>
            <td><?php echo $dataRow['cantidad']; ?></td>
            <td><?php echo $dataRow['descripcion'] ?></td>
            <td><?php echo $dataRow['fecha']; ?></td>
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