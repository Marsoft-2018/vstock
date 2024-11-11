<?php   
    require('../Modelo/Conect.php');
    //var_dump($_REQUEST);
    $data = json_decode(file_get_contents("php://input"));
    $accion = "";
    if(isset($data->accion)){
        $accion = $data->accion;
    }
    if(isset($_REQUEST['accion'])){
        $accion=$_REQUEST['accion'];
    }
   
?>