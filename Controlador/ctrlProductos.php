<?php
    include("header.php");
    require('../Modelo/categoria.php');
    require('../Modelo/medida.php');
    require('../Modelo/producto.php');
    
    switch ($accion) {
        case 'add':
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
            $objProducto->agregar(); 
           
            break;
        case 'update':
            $objProducto = new Producto();
            $objProducto->id = $data->id;
            $objProducto->name = $data->name;
            $objProducto->reference = $data->reference;
            $objProducto->purchase_price = $data->purchase_price;
            $objProducto->selling_price = $data->selling_price;
            $objProducto->initial_quantity = $data->initial_quantity;
            $objProducto->stock = $data->stock;
            $objProducto->min_quantity = $data->min_quantity;
            $objProducto->bussines_id = $data->bussines_id;
            $objProducto->category_id = $data->category_id;
            $objProducto->measure = $data->measure;
            $objProducto->modificar();          
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
    }


?>