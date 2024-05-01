<?php
    include("header.php");
    require('../Modelo/producto.php');
    
    switch ($accion) {
        case 'agregar':
            $objProducto = new Producto();
            $objProducto->id = $data->id;
            $obj->Producto->name = $data->name;
            $obj->Producto->reference = $data->reference;
            $obj->Producto->purchase_price = $data->purchase_price;
            $obj->Producto->selling_price = $data->selling_price;
            $obj->Producto->initial_quantity = $data->initial_quantity;
            $obj->Producto->stock = $data->stock;
            $obj->Producto->min_quantity = $data->min_quantity;
            $obj->Producto->bussines_id = $data->bussines_id;
            $obj->Producto->category_id = $data->category_id;
            $obj->Producto->measure = $data->measure;
            $objProducto->agregar(); 
           
            break;
        case 'modificar':
            $objProducto = new Producto();
            $objProducto->id = $data->id;
            $obj->Producto->name = $data->name;
            $obj->Producto->reference = $data->reference;
            $obj->Producto->purchase_price = $data->purchase_price;
            $obj->Producto->selling_price = $data->selling_price;
            $obj->Producto->initial_quantity = $data->initial_quantity;
            $obj->Producto->stock = $data->stock;
            $obj->Producto->min_quantity = $data->min_quantity;
            $obj->Producto->bussines_id = $data->bussines_id;
            $obj->Producto->category_id = $data->category_id;
            $obj->Producto->measure = $data->measure;
            $objProducto->modificar();          
            break;
        case 'eliminar':
            $objProducto = new Producto();
            $objProducto->id = $data->id;
            $objProducto->bussines_id = $data->bussines_id;
            $objProducto->eliminar();         
            break;
    }


?>