<?php
    $tipo=$_POST['tipo'];

    if($tipo=="contado"){
        echo "<option value='Efectivo'>Efectivo</option>";
        echo "<option value='Cheque'>Cheque</option>";
        echo "<option value='Tarjeta'>Tarjeta</option>";
        echo "<option value='otra'>Otra...</option>";
    }elseif($tipo=="credito"){
        echo "<option value='semanal'>Semanal</option>";
        echo "<option value='quincenal'>Quincenal</option>";
        echo "<option value='mensual'>Mensual</option>";
        echo "<option value='otra'>Otra...</option>";
    }    
?>