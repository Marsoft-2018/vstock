<?php
    include("header.php");
    require('../Modelo/category.php');
    require('../Modelo/medida.php');
    require('../Modelo/product.php');
    require('../Modelo/customer.php');
    require('../Modelo/saleInvoice.php');

    switch ($accion) {
        case 'add':
            $objInvoice = new SaleInvoice();
            $objCustomer = new Customer();
                /*$objCustomer->id = $_POST['customer_id'];
                if(count($objCustomer->load()) == 0){
                    $objCustomer->name = $_POST['name'];
                    $objCustomer->address = $_POST['address'];
                    $objCustomer->phone = $_POST['phone'];
                    $objCustomer->city = $_POST['city'];
                    $objCustomer->email = $_POST['email'];
                    $objCustomer->add();
                }

                $objInvoice->id = $_POST['id'];      
                $objInvoice->customer_id = $_POST['customer_id'];
                $objInvoice->date_at = $_POST['date_at'];
                $objInvoice->amount = $_POST['amount'];
                $objInvoice->type = $_POST['type']; //contado o a crédito
                $objInvoice->form_pay = $_POST['form_pay'];
                $invoiceStatus = 'pagada';
                if($_POST['type'] != 'contado'){
                    $invoiceStatus = 'por pagar';
                }
                $objInvoice->status = $invoiceStatus;
                $objCar = json_decode($_POST['objCar']);
            */
            echo "Carrito del primer tipo ---";
            var_dump($data['cart']);
            // $objInvoice->objProduct = $_POST['objCar'];
            // foreach ($objCar as $product) {
            //     echo "Codigo: - ".$product['id'];
            //     echo "Nombre: - ".$product['name'];
            //     //echo "----------------- ".$product['subTotalAmount'];
            //     # code...
            // }
            //$objInvoice->add();

            
            
           
            break;
        case 'edit':
                        
            break;
        case 'update':
            
            break;
        case 'delete':
                  
            break;
        case 'new':
            $bussines_id = $data->bussines_id;
            $objCustomer = new Customer();
            $objCustomer->bussines_id = $bussines_id;
            $objInvoice = new SaleInvoice();
            include("../Vistas/movimientos/sales/formulario.php");     
            break;
    }


?>