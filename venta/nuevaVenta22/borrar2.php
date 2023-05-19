<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Libreria necesaria para el boton de elimminar, tiene que estar al inicio, no al final -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



</head>
<body>
    <?php 
    
        include("conexion.php");

        $Id=$_POST["Id"];

        $sql="SELECT * FROM tlista_venta WHERE TListaVenta_id = ?";

        $resultado = array($Id);
        $stmt = $base->prepare($sql);
        $stmt->execute($resultado);

        if($venta=$stmt->fetch(PDO::FETCH_ASSOC)){

            $cantidad= $venta['cantidad'];
            $codProduct=$venta['TProductos_id'];
        

            //obteniendo la cantidad total en el inventario

            $sql="SELECT stock FROM tinventario WHERE TProductos_id= :idProd";
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":idProd"=>$codProduct));

            while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
                $inventario = $registro['stock'];

                $inventario = $inventario + $cantidad;

                include("conexion.php");

                $sql2 = "UPDATE tinventario SET stock=:cant WHERE TProductos_id=:miId";
                $resultado2=$base->prepare($sql2);
                $resultado2->execute(array("miId"=>$codProduct, ":cant"=>$inventario));
                
                
            }
            include("conexion.php");
            $base->query("DELETE FROM tlista_venta WHERE TListaVenta_id='$Id'");

            header("Location:venta1.php");

        }
    
    ?>
</body>
</html>