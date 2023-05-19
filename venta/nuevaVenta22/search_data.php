<?php

    
    $conexion=mysqli_connect("localhost","root","Thewalkingdead_01","sistematiendasjii");
    $sql = "SELECT nombre_Articulo FROM tproductos WHERE nombre_Articulo LIKE '%".$_GET['query']."%' LIMIT 20";
    $Resultados=mysqli_query($conexion,$sql);
    $json = array();
    while( $rows = mysqli_fetch_assoc($Resultados) ) {
    $json[] = $rows["nombre_Articulo"];
    }
    echo json_encode($json); 
    

?>