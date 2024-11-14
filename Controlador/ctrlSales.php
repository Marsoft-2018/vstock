<?php
    include("header.php");
    require('../Modelo/category.php');
    require('../Modelo/measurement.php');
    require('../Modelo/product.php');
    require('../Modelo/customer.php');
    require('../Modelo/saleInvoice.php');

    switch ($accion) {
        case 'add':

            $dataInvoice = $data['invoiceDetails'];//datos relacionados con la factura como numero, cliente, tipo y forma de pago.
            $cart = $data['cart'];// datos relacionados con los productos agregados a la factura.

            $objCustomer = new Customer();
            $objCustomer->id = $dataInvoice['customer_id'];
            if(count($objCustomer->load()) == 0){
                $objCustomer->name = $dataInvoice['name'];
                $objCustomer->address = $dataInvoice['address'];
                $objCustomer->phone = $dataInvoice['phone'];
                $objCustomer->city = $dataInvoice['city'];
                $objCustomer->email = $dataInvoice['email'];
                $objCustomer->add();
            }

            $invoiceStatus = 'pagada';
            if($dataInvoice['type'] != 'contado'){
                $invoiceStatus = 'por pagar';
            }

            $objInvoice = new SaleInvoice();
            $objInvoice->dataInvoice = $dataInvoice;  
            $objInvoice->cart = $cart;  
            $objInvoice->amount = $data['amount'];  
            $objInvoice->status = $invoiceStatus;
            $objInvoice->add();           
        break;

        case 'edit':
                        
        break;

        case 'update':
            
        break;

        case 'delete':
                  
        break;

        case 'loadMaxId':
            $objInvoice = new SaleInvoice();
            echo $objInvoice->maxId();                          
        break;

        case 'new':
            $bussines_id = $data['bussines_id'];
            $objCustomer = new Customer();
            $objCustomer->bussines_id = $bussines_id;
            $objProduct = new Product();
            $objProduct->bussines_id = $bussines_id;
            $objInvoice = new SaleInvoice();
            include("../Vistas/movimientos/sales/formulario.php");     
        break;
    }


?>