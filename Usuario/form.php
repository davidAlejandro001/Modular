<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    
            <div class="col-2">
                        
            </div>

                    <h3> ¿Desea modificar alguno de los siguientes campos?</h3>
                        
                <div class="col-8">
                    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">          
                        <div>
                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $id ?>">
                        </div>
                            
                        <div >
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" placeholder="<?php echo $nombre ?>" disabled>
                        </div>

                        <div >
                            <label class="form-label">Apellidos</label>
                            <input type="text" class="form-control" placeholder="<?php echo $apellidos ?>" disabled>
                        </div>

                        <div>
                            <label class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" placeholder="<?php echo $usuario ?>" disabled>
                        </div>

                        <div class="my-5">
                            <button type="submit" class="btn btn-primary" name="bot_actualizar" id="bot_actualizar" >Aceptar</button>
                        </div>    
                    </form>

                    <hr>


                </div>
                <div class="col-2">
                                
                </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>