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

                <h3>¿Desea Cambiar la contraseña?</h3>
                        
                <div class="col-8">
                    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">          
                        <div>
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="************" disabled readonly>
                        </div>

                        <div class="my-5">
                            <button type="submit" class="btn btn-primary" name="bot_passw" id="bot_passw" >Aceptar</button>
                        </div>    
                    </form>
                </div>
                <div class="col-2">
                                
            </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>