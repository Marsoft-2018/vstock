<?php
    include("header.php");
    require('../Modelo/categoria.php');
    require('../Modelo/medida.php');
    require('../Modelo/producto.php');
    
    switch ($accion) {
        case 'add':
            
           
            break;
        case 'edit':
                        
            break;
        case 'update':
            
            break;
        case 'delete':
            $objProducto = new Producto();
            $objProducto->id = $data->id;
            $objProducto->bussines_id = $data->bussines_id;
            $objProducto->eliminar();         
            break;
        case 'new':
            $bussines_id = $data->bussines_id;
            include("../Vistas/movimientos/ventas/formulario.php");     
            break;
    }


?>