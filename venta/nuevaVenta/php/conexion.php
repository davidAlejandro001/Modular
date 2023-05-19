<?php

$servidor="localhost";
$usuario= "root";
$password="Thewalkingdead_01";
$db= "sistematiendasjii";

if (!$conexion=mysqli_connect("$servidor","$usuario","$password","$db")) 
{
   die("Hubo un Fallo en la Conexion");
}

?>