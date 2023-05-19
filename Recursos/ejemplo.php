<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>

    <div class="container">
        <div class="row">

            <div>
                <canvas id="myChart" width="500" height="400"></canvas>
            </div>
        </div>

        <?php 

            date_default_timezone_set('America/Mexico_City');
            $fechaGuardar = date('Y-m-d');

        ?>
    </div>
    <script>

    //let labels1 = ['YES', 'YES BUT IN GREEN'];
    //let data1 = [69, 31];
    //let colors1 = ['#49A9EA', '#36CAAB'];

    let myDoughnutChart = document.getElementById("myChart").getContext('2d');

    let chart1 = new Chart(myDoughnutChart, {
        type: 'doughnut',
        data: {
            labels: [<?php  
                
                $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
                                                
                $consulta="SELECT * FROM t_empleado";
    
                $Resultados=mysqli_query($conexion,$consulta);
    
                while (($fila=mysqli_fetch_array($Resultados,MYSQLI_ASSOC))) {
                ?>
                    '<?php echo $fila['nombre_usuario'] ?>',
                <?php
                }
                
            ?>],
            datasets: [ {
                data: [<?php  
                
                $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
                                                
                $consulta="SELECT * FROM t_empleado";
    
                $Resultados=mysqli_query($conexion,$consulta);
    
                while (($fila=mysqli_fetch_array($Resultados,MYSQLI_ASSOC))) {

                    $empleado = $fila['TEmpleado_id'];

                    $consulta2="SELECT COUNT(TVenta_id) FROM tventa where TEmpleado_id=$empleado and fecha='$fechaGuardar'";

                    $Resultados2=mysqli_query($conexion,$consulta2);
          
                    $row = mysqli_fetch_array($Resultados2);
          
                    $total = $row[0];

                ?>
                    <?php echo $total ?>,
                <?php
                }
                
            ?>],
                backgroundColor: ['#49A9EA', '#E8C533', '#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', 
		  '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D',
		  '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', 
		  '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',
		  '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', 
		  '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',
		  '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680', 
		  '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933',
		  '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3', 
		  '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF']
            }]
        },
        options: {
            title: {
                text: "Ventas Totales Realizadas",
                display: true
            }
        }
    });


    </script>
  </body>
</html>