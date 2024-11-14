<?php
    include("header.php");
    require('../Modelo/customer.php');
    require('../Modelo/supplier.php');
    require('../Modelo/person_credit.php');
    require('../Modelo/numberLetterService.php');
    
    switch ($accion) {

        case 'index':  
            $objPersonCredit = new PersonCredit();
            $objPersonCredit->person = $data['person'];
            include("../Vistas/credits/index.php"); 
        break;

        case 'new':
            $person = $data['person'];
            $pay_type = $data['pay_type'];
            $invoice_id = $data['invoice_id'];
            $person_id = $data['person_id'];
            include("../Vistas/credits/formulario.php");     
        break;

        case 'add':
            add_or_set_PersonCredit($accion);           
        break;
            
        case 'edit':
            $objPersonCredit = new PersonCredit();
            $objPersonCredit->id = $data['id'];
            $invoice_id = $data['invoice_id'];
            $person_id = $data['person_id'];
            include("../Vistas/credits/formulario.php");              
        break;

        case 'update':
            add_or_set_PersonCredit($accion);        
        break;

        case 'delete':
            $objPersonCredit = new PersonCredit();
            $objPersonCredit->id = $data['id'];
            $objPersonCredit->bussines_id = $data['bussines_id'];
            $objPersonCredit->person_id = $data['person_id'];
            $objPersonCredit->delete();         
        break;
        case 'list':  
            $objPersonCredit = new PersonCredit();
            $objPersonCredit->person = $data['person'];
            $objPersonCredit->person_id = $data['person_id'];
            $objPersonCredit->invoice_id = $data['invoice_id'];
            $amount = $data['amount'];
            $objNumeroEnLetra = new NumberLetterService();
            $valorEnLetras = $objNumeroEnLetra->convert($amount);  
            include("../Vistas/credits/lista.php"); 
        break;
    }

    function add_or_set_PersonCredit($tipo){
        $objPersonCredit = new PersonCredit();
        $objPersonCredit->person = $_POST['person'];
        $objPersonCredit->person_id = $_POST['person_id'];
        $objPersonCredit->invoice_id = $_POST['invoice_id'];
        $objPersonCredit->amount = $_POST['amount'];
        $objPersonCredit->date_at = $_POST['date_at'];
        $objPersonCredit->number_paid = $_POST['number_paid'];
        switch ($tipo) {
            case 'add':
                $objPersonCredit->add();
                break;
            case 'update':
                $objPersonCredit->id = $_POST['id'];
                $objPersonCredit->update();          
                break;
        }
    }

?>