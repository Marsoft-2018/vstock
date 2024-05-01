<?php   
    require('../Modelo/Conect.php');
    $data = json_decode(file_get_contents("php://input"));
    $accion = $data->accion;
    if(isset($_REQUEST['accion'])){
        $accion=$_REQUEST['accion'];
    }
   
?>