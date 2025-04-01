<?php 
	
    include("header.php");
    require('../Modelo/user.php');
    
    switch ($accion) {
        case 'add':
            add_or_set_User($accion);           
            break;
        case 'edit':
            $objUser = new User();
            //$objUser->bussines_id = $data->bussines_id;
            $objUser->id = $data['id'];
            include("../vistas/Users/formulario.php");              
        break;
        
        case 'load':
            $objUser = new User();
            $objUser->id = $data['id'];
            echo json_encode($objUser->load());    
        break;

        case 'update':
            add_or_set_User($accion);        
        break;
        
        case 'delete':
            $objUser = new User();
            $objUser->id = $data->id;
            $objUser->bussines_id = $data->bussines_id;
            $objUser->delete();         
        break;

        case 'new':
            include("../vistas/Users/formulario.php");     
        break;

        case 'profile':        
            $objUser = new User();    
            $objUser->id = $data['id'];         
            include("../vistas/Users/profile.php");     
        break;

        case 'index':                     
            include("../vistas/Users/index.php");     
        break;
    }

    function add_or_set_User($tipo){
        $objUser = new User();
        $objUser->id = $_POST['id'];
        $objUser->name = $_POST['name'];
        $objUser->address = $_POST['address'];
        $objUser->phone = $_POST['phone'];
        $objUser->city = $_POST['city'];
        $objUser->email = $_POST['email'];
        switch ($tipo) {
            case 'add':
                $objUser->add();
                break;
            case 'update':
                $objUser->update();          
                break;
        }
    }
?>