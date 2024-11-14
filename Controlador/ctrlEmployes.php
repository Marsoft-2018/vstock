<?php
    include("header.php");
    require('../Modelo/employe.php');
    require('../Modelo/employe_payment.php');
    
    switch ($accion) {
        case 'add':
            add_or_set_Employe($accion);           
            break;
        case 'edit':
            $objEmploye = new Employe();
            //$objEmploye->bussines_id = $data['bussines_id'];
            $objEmploye->id = $data['id'];
            include("../Vistas/employes/formulario.php");  
            
            break;
        case 'update':
            add_or_set_Employe($accion);        
            break;
        case 'delete':
            $objEmploye = new Employe();
            $objEmploye->id = $data['id'];
            $objEmploye->bussines_id = $data['bussines_id'];
            $objEmploye->delete();         
            break;
        case 'new':
            include("../Vistas/employes/formulario.php");     
            break;
        case 'index':              
            $bussines_id = $data['bussines_id'];       
            include("../Vistas/employes/index.php");     
            break;
    }

    function add_or_set_Employe($tipo){
        $objEmploye = new Employe();
        $objEmploye->id = $_POST['id'];
        $objEmploye->first_name = $_POST['first_name'];
        $objEmploye->second_name = $_POST['second_name'];
        $objEmploye->first_last_name = $_POST['first_last_name'];
        $objEmploye->second_last_name = $_POST['second_last_name'];
        $objEmploye->address = $_POST['address'];
        $objEmploye->phone = $_POST['phone'];
        $objEmploye->job = $_POST['job'];
        $objEmploye->income = $_POST['income'];
        $objEmploye->bussines_id = $_POST['bussines_id'];
        switch ($tipo) {
            case 'add':
                $objEmploye->add();
                break;
            case 'update':
                $objEmploye->update();          
                break;
        }
    }

?>