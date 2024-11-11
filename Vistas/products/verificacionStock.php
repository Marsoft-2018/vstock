<?php
    require('Conexiones/Conect.php');
    $modulo=$_POST['modulo'];
    $idprod=$_POST['IDprod'];
    $accion=$_POST['accion'];
    if($accion=='mensaje'){
        $objExistencias=new verificaExistencias();
        $existencias=$objExistencias->verificar($idprod,$modulo);
    }

    if($accion=='valor'){
        $objExistencias=new verificaExistencias();
        $existencias=$objExistencias->esNuevo($idprod);
    }
?>