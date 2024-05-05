<?php
    include("header.php");
    require('../Modelo/categoria.php');
    require('../Modelo/medida.php');
    require('../Modelo/producto.php');
    
    switch ($accion) {
        case 'add':
            add_or_set_product($accion);           
            break;
        case 'edit':
            $objProducto = new Producto();
            $objProducto->bussines_id = $data->bussines_id;
            $objProducto->id = $data->id;
            $objCategoria = new Categoria();
            $objCategoria->bussines_id = $data->bussines_id;
            $objMedida = new Medida();
            $objMedida->bussines_id = $data->bussines_id;
            include("../Vistas/productos/formulario.php");  
            
            break;
        case 'update':
            add_or_set_product($accion);        
            break;
        case 'delete':
            $objProducto = new Producto();
            $objProducto->id = $data->id;
            $objProducto->bussines_id = $data->bussines_id;
            $objProducto->eliminar();         
            break;
        case 'new':
            $objCategoria = new Categoria();
            $objCategoria->bussines_id = $data->bussines_id;
            $objMedida = new Medida();
            $objMedida->bussines_id = $data->bussines_id;
            include("../Vistas/productos/formulario.php");     
            break;
        case 'inventario':
            // $objCategoria = new Categoria();
            // $objCategoria->bussines_id = $data->bussines_id;
            // $objMedida = new Medida();
            // $objMedida->bussines_id = $data->bussines_id;
            $bussines_id = $data->bussines_id;
            include("../Vistas/productos/inventario.php");     
            break;
    }

    function add_or_set_product($tipo){
        $objProducto = new Producto();
        $objProducto->id = $_POST['id'];
        $objProducto->name = $_POST['name'];
        $objProducto->reference = $_POST['reference'];
        $objProducto->purchase_price = $_POST['purchase_price'];
        $objProducto->selling_price = $_POST['selling_price'];
        $objProducto->initial_quantity = $_POST['initial_quantity'];
        $objProducto->stock = $_POST['stock'];
        $objProducto->min_quantity = $_POST['min_quantity'];
        $objProducto->bussines_id = $_POST['bussines_id'];
        $objProducto->category_id = $_POST['category_id'];
        $objProducto->measure_id = $_POST['measure_id'];
        switch ($tipo) {
            case 'add':
                $objProducto->agregar();
                break;
            case 'udpdate':
                $objProducto->modificar();          
                break;
        }
    }

?>