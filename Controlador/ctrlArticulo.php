<?php
    require('../Conexiones/Conect.php');

    if(isset($_POST['accion'])){
        $accion=$_POST['accion'];
    }
    
    if($accion=='Agregar'){
           
    }

    if($accion=='Modificar'){
        $campo=$_POST['campo'];
        $clave=$_POST['clave'];
        $valor=$_POST['valor'];

        $objArt = new inventario();
        $objArt->modificar($campo,$clave,$valor);        
    }

    if($accion=='Eliminar'){
    
        
    }

    if($accion=='Nuevo'){
                  
    }


?>