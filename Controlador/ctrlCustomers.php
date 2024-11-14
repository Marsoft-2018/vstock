<?php
    include("header.php");
    require('../Modelo/customer.php');
    
    switch ($accion) {
        
        case 'load':
            $objCustomer = new Customer();
            $objCustomer->id = $data['id'];
            echo json_encode($objCustomer->load());    
        break;

        case 'add':
            add_or_set_Customer($accion);           
        break;

        case 'edit':
            $objCustomer = new Customer();
            //$objCustomer->bussines_id = $data['bussines_id'];
            $objCustomer->id = $data['id'];
            include("../Vistas/customers/formulario.php");             
        break;

        case 'update':
            add_or_set_Customer($accion);        
        break;
        case 'delete':
            $objCustomer = new Customer();
            $objCustomer->id = $data['id'];
            $objCustomer->bussines_id = $data['bussines_id'];
            $objCustomer->delete();         
        break;
        case 'new':
            include("../Vistas/customers/formulario.php");     
        break;
        case 'index':                     
            include("../Vistas/customers/index.php");     
        break;
    }

    function add_or_set_Customer($tipo){
        $objCustomer = new Customer();
        $objCustomer->id = $_POST['id'];
        $objCustomer->name = $_POST['name'];
        $objCustomer->address = $_POST['address'];
        $objCustomer->phone = $_POST['phone'];
        $objCustomer->city = $_POST['city'];
        $objCustomer->email = $_POST['email'];
        switch ($tipo) {
            case 'add':
                $objCustomer->add();
                break;
            case 'update':
                $objCustomer->update();          
                break;
        }
    }

?>