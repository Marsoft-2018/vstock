<?php
    require('../Conexiones/Conect.php');

    if(isset($_POST['accion'])){
        $accion=$_POST['accion'];
    }else{
        $accion=0;
    }

    //echo "<br>Respuesta desde el controlador: La accion es $accion<br>";

    if($accion=='facturaSiguiente'){    
        $modulo=$_POST['modulo'];
        $objFactura = new FacturaSiguiente();
        $objFactura->mascara($modulo);

        //echo "<br>Respuesta desde el controlador: El modulo es $modulo<br>";
    }
    

    if($accion=='facturaRealSig'){    
        $modulo=$_POST['modulo'];
        $objFactura = new FacturaSiguiente();
        $objFactura->real($modulo);

        //echo "<br>Respuesta desde el controlador: El modulo es $modulo<br>";
    }

?>