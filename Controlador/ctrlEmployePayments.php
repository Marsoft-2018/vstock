<?php
    include("header.php");
    require('../Modelo/employe.php');
    require('../Modelo/employe_payment.php');
    
    switch ($accion) {
        case 'add':
            add_or_set_EmployePayment($accion);           
            break;
            
        case 'edit':
            $objEmployePayment = new EmployePayment();
            $objEmployePayment->id = $data->id;
            $bussines_id = $data->bussines_id;
            $employe_id = $data->employe_id;
            include("../Vistas/employes/payments/formulario.php");              
            break;

        case 'update':
            add_or_set_EmployePayment($accion);        
            break;

        case 'delete':
            $objEmployePayment = new EmployePayment();
            $objEmployePayment->id = $data->id;
            $objEmployePayment->bussines_id = $data->bussines_id;
            $objEmployePayment->employe_id = $data->employe_id;
            $objEmployePayment->delete();         
            break;

        case 'new':
            $bussines_id = $data->bussines_id;
            $employe_id = $data->employe_id;
            include("../Vistas/employes/payments/formulario.php");     
            break;

        case 'index':  
            $objEmploye = new Employe();
            $objEmploye->id = $data->employe_id;

            $objEmployePayment = new employePayment();
            $objEmployePayment->employe_id = $data->employe_id;
            
            $bussines_id = $data->bussines_id;
            $employe_id = $data->employe_id;

            include("../Vistas/employes/payments/index.php"); 
        break;
    }

    function add_or_set_EmployePayment($tipo){
        $objEmployePayment = new EmployePayment();
        $objEmployePayment->employe_id = $_POST['employe_id'];
        $objEmployePayment->payment_value = $_POST['payment_value'];
        $objEmployePayment->date_at = $_POST['date_at'];
        $objEmployePayment->receipt = $_POST['receipt'];
        switch ($tipo) {
            case 'add':
                $objEmployePayment->add();
                break;
            case 'update':
                $objEmployePayment->id = $_POST['id'];
                $objEmployePayment->update();          
                break;
        }
    }

?>