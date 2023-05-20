<?php 
//todo el contenido html, prepararlo para meterlo en una variable
ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Document</title>

    <style>

        tbody tr:nth-child(odd) {
            background-color: #d3d3d3
        }

        table{
            max-width:980px;
            table-layout:fixed;
            margin:auto;
            width:100%;
        }

        th{
            color: white;
            background: black;
        }

        p{
            text-align: right;
        }
    
    </style>

</head>
<body>

        <center>
            <h2 class="titulo">Reportes de Ventas</h2>
        </center>
        <?php 
        
        date_default_timezone_set('America/Mexico_City');
        
        ?>
        <p class="fechas">Fecha: <?php echo date('d/m/Y') ?></p>
        <br>
        <p class="fechas">Hora: <?php echo date('h:i A')?></p>

        <?php 

            try {
                //code...

                if(isset($_POST["enviar"])){
                // require_once('../../vendor/tcpdf/tcpdf.php'); //Llamando a la Libreria TCPDF
                include('conexion.php');
                date_default_timezone_set('America/Mexico_City');

                /***RECIBIENDO LAS VARIABLE DE LA FECHA */
                $fechaInit = date("Y-m-d", strtotime($_POST['fecha_ingreso']));
                $fechaFin  = date("Y-m-d", strtotime($_POST['fechaFin']));

                $sql="SELECT * FROM tventa INNER JOIN t_empleado WHERE tventa.TEmpleado_id = t_empleado.TEmpleado_id AND fecha BETWEEN ? AND ? ORDER BY fecha ASC";

                $resultado = array($fechaInit ,$fechaFin);
                $stmt = $base->prepare($sql);
                $stmt->execute($resultado);

                /* 
                style="text-align: center;" border='1' cellpadding=1 cellspacing=1
                border="1"
                style="background: #D0CDCD;"
                */
                $num_registro=$stmt->rowCount();

                if ($num_registro!=0) {

                    ?>
                    
                <table style="text-align: center;" border='1'>
                 <thead >
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Venta Realizada</th>
                    <th>Productos</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>

                        <?php

                while($dataRow=$stmt->fetch(PDO::FETCH_ASSOC)){
                ?>    
                    <tr>
                        <td><?php echo $dataRow['TVenta_id'] ?></td>
                        <td><?php echo date('d-m-Y', strtotime($dataRow['fecha'])) ?></td>
                        <td><?php echo $dataRow['nombre'] . " " . $dataRow['apellidos'] ?></td>
                        <td><?php echo $dataRow['productos_Venta'] ?></td>
                        <td><?php echo $dataRow['total']; ?></td>
                    </tr>
                <?php
                    }
                    ?>
                        </tbody>
                        </table>
                    <?php
                }
            }

            }catch (Exception $ex) {
                die('Error' . $th->getMessage());
                echo "Linea del error " . $th->getLine();
            }


        ?>

</body>
</html>
<?php 
//todo se fue a una variable
$html = ob_get_clean();
//echo $html;

require_once '../../vendor/dompdf/autoload.inc.php'; //Llamando a la Libreria DOMPDF
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$dompdf->set_base_path("./bootstrap.min.css");
ob_start();
//mostrando el contenido html
$dompdf->loadHtml($html);
$dompdf->setPaper('letter');

$dompdf->render();
//false, no queremos descargarlo
$dompdf->stream("reporteVenta.pdf", array("Attachment" => false));


?>



