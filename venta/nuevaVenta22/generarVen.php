<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../css/sb-admin-2.css" rel="stylesheet">-->
    <link href="../../css/sb-inventario.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ///////////////////////////////////////////////////////////////////////////// -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script src="java.js"></script>

</head>
<body id="page-top">


                <?php 

                    if(isset($_POST["ventaFinal"])){

                        $numVenta = $_POST["numVenta"];
                        $total=$_POST["total"];
                        $empleado = $_POST["numEmpleado"];
                        $fecha=$_POST["fecha"];
                        $cambio=$_POST["cambio"];

                        $contador=0;
                        if (empty($cambio) || $cambio=="NaN") {
                            $contador=$contador+1;
                            ?>
                                <script>

                                    Swal.fire({
                                    icon: 'error',
                                    title: 'No puedes dejar espacios en blanco ',
                                    text: "<?php echo "vuelve a intentarlo" ?>"
                                    })

                                </script>

                            
                            <?php
                            //include("venta1.php");
                            header("Location:venta1.php");
                            echo $contador;
                        }else{

                        
                            
                            include("conexion.php");
                        
                            //generando la venta
                            $sql="INSERT INTO tventa( TVenta_id, TEmpleado_id, total, fecha) VALUES (:id,:emp,:total, :fecha)";
                            $resultado=$base->prepare($sql);

                            $resultado->execute(array(":id"=>$numVenta,":emp"=>$empleado, ":total"=>$total, ":fecha"=>$fecha));

                            $sql2 = "UPDATE tlista_venta SET TVenta_id=:num WHERE TVenta_id=0";
                            $resultado2=$base->prepare($sql2);
                                    
                            $resultado2->execute(array(":num"=>$numVenta));

                            //echo "venta realizada con exito";
                            header("Location:venta1.php");

                        

                        }
                    }else{
                        header("Location:venta1.php");
                    }
                    
                ?>


    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/chart-area-demo.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>
</body>
</html>
