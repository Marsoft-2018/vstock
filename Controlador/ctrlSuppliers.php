<?php
    include("header.php");
    require('../Modelo/supplier.php');
    
    switch ($accion) {
        case 'add':
            add_or_set_Supplier($accion);           
            break;
        case 'edit':
            $objSupplier = new Supplier();
            //$objSupplier->bussines_id = $data->bussines_id;
            $objSupplier->id = $data->id;
            include("../Vistas/suppliers/formulario.php");  
            
            break;
        case 'update':
            add_or_set_Supplier($accion);        
            break;
        case 'delete':
            $objSupplier = new Supplier();
            $objSupplier->id = $data->id;
            $objSupplier->bussines_id = $data->bussines_id;
            $objSupplier->delete();         
            break;
        case 'new':
            include("../Vistas/suppliers/formulario.php");     
            break;
        case 'index':  
                   
            include("../Vistas/suppliers/index.php");     
            break;
    }

    function add_or_set_Supplier($tipo){
        $objSupplier = new Supplier();
        $objSupplier->id = $_POST['id'];
        $objSupplier->name = $_POST['name'];
        $objSupplier->address = $_POST['address'];
        $objSupplier->phone = $_POST['phone'];
        $objSupplier->city = $_POST['city'];
        $objSupplier->email = $_POST['email'];
        switch ($tipo) {
            case 'add':
                $objSupplier->add();
                break;
            case 'update':
                $objSupplier->update();          
                break;
        }
    }

?>