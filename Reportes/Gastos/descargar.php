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
                            
                            $sql="SELECT * FROM tgastos WHERE fecha BETWEEN ? AND ? ORDER BY fecha ASC";

                            $resultado = array($fechaInit ,$fechaFin);
                            $stmt = $base->prepare($sql);
                            $stmt->execute($resultado);

                            //rowCount = devuelve 0 o 1 si hay o no un usuario
                            $num_registro=$stmt->rowCount();

                                if ($num_registro!=0) {

                                ?> 
                                    <table class="table table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Importe</th>
                                                <th>Descripcion</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php

                                    while($dataRow=$stmt->fetch(PDO::FETCH_ASSOC)){

                                        ?>
                                        
                                        <tr class='table-light text-dark'>
                                            <td><?php echo $dataRow['Importe'] ?></td>
                                            <td><?php echo $dataRow['Descripcion']; ?></td>
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