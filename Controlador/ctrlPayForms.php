<?php
    include("header.php");
    require('../Modelo/pay_form.php');
    
    switch ($accion) {
        case 'load':
            $objPayForm = new PayForm();
            $objPayForm->id =  $data['id'];
            echo json_encode($objPayForm->load());        
            break;
        case 'listAll':
            $objPayForm = new PayForm();
            echo json_encode($objPayForm->listAll());        
            break;
        case 'listFilter':
            $objPayForm = new PayForm();
            $objPayForm->type_sale = $data['type_sale'];
            echo json_encode($objPayForm->listFilter());        
            break;
        case 'add':
            add_or_set_PayForm($accion);           
            break;
        case 'edit':
            $objPayForm = new PayForm();
            $objPayForm->id = $data['id'];
            include("../Vistas/PayForms/formulario.php");  
            
            break;
        case 'update':
            add_or_set_PayForm($accion);        
            break;
        case 'delete':
            $objPayForm = new PayForm();
            $objPayForm->id = $data['id'];
            $objPayForm->delete();         
            break;
        case 'new':
            include("../Vistas/PayForms/formulario.php");     
            break;
        case 'index':
            include("../Vistas/PayForms/index.php");     
            break;
    }

    function add_or_set_PayForm($tipo){
        $objPayForm = new PayForm();
        $objPayForm->name = $_POST['name'];
        $objPayForm->type_sale = $_POST['type_sale'];
        $objPayForm->description = $_POST['description'];
        switch ($tipo) {
            case 'add':
                $objPayForm->add();
                break;
            case 'update':
                $objPayForm->id = $_POST['id'];
                $objPayForm->update();          
                break;
        }
    }

?>