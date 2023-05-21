
<?php

    if(isset($_POST["add_PLista"])){

        $idProd = $_POST['hidden_id'];
        $nombre = $_POST["hidden_Nombre"];
        $precio = $_POST["hidden_Precio"];
        $InventarioTotal = $_POST["hidden_Stock"];
        $granel = $_POST["hidden_Granel"];
        $codigo = $_POST["hidden_Codigo"];

        include("conexion.php");

        $resultado4=$base->query("SELECT * FROM tgranel WHERE TProductos_id=$idProd")->fetchAll(PDO::FETCH_OBJ);

        foreach($resultado4 as $registro2){
            $Id_Granel = $registro2->T_TipoGranel_id;
                                              
            $resultado5=$base->query("SELECT * FROM t_tipogranel WHERE T_TipoGranel_id=$Id_Granel")->fetchAll(PDO::FETCH_OBJ);

            foreach($resultado5 as $registro3){
                $Tipo_Granel = $registro3->descripcion;
            }

        }

        if($granel="Si"){
        
        echo '<script type="text/javascript">'
            . '$( document ).ready(function() {'
            . '$("#insertModal_Granel").modal("show");'
            . '});'
            . '</script>';
            
        }

    }

?>

<?php

    if(isset($_POST["add_PLista2"])){

        $idProd = $_POST['hidden_id'];
        $nombre = $_POST["hidden_Nombre"];
        $precio = $_POST["hidden_Precio"];
        $granel = $_POST["hidden_Granel"];
        $InventarioTotal = $_POST["hidden_Stock"];
        $codigo = $_POST["hidden_Codigo"];

        include("conexion.php");

        $resultado4=$base->query("SELECT * FROM tgranel WHERE TProductos_id=$idProd")->fetchAll(PDO::FETCH_OBJ);

        foreach($resultado4 as $registro2){
            $Id_Granel = $registro2->T_TipoGranel_id;
                                              
            $resultado5=$base->query("SELECT * FROM t_tipogranel WHERE T_TipoGranel_id=$Id_Granel")->fetchAll(PDO::FETCH_OBJ);

            foreach($resultado5 as $registro3){
                $Tipo_Granel = $registro3->descripcion;
            }

        }

        
        
        echo '<script type="text/javascript">'
            . '$( document ).ready(function() {'
            . '$("#insertModal_Prod").modal("show");'
            . '});'
            . '</script>';
            
        

    }

?>


