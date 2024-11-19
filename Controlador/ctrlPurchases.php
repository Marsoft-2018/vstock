<?php
    include("header.php");
    require('../Modelo/category.php');
    require('../Modelo/measurement.php');
    require('../Modelo/product.php');
    require('../Modelo/supplier.php');
    require('../Modelo/purchaseInvoice.php');

    switch ($accion) {
        case 'add':

            $dataInvoice = $data['invoiceDetails'];//datos relacionados con la factura como numero, cliente, tipo y forma de pago.
            $cart = $data['cart'];// datos relacionados con los productos agregados a la factura.

            $objSupplier = new Supplier();
            $objSupplier->id = $dataInvoice['supplier_id'];
            if(count($objSupplier->load()) == 0){
                $objSupplier->name = $dataInvoice['name'];
                $objSupplier->address = $dataInvoice['address'];
                $objSupplier->phone = $dataInvoice['phone'];
                $objSupplier->city = $dataInvoice['city'];
                $objSupplier->email = $dataInvoice['email'];
                $objSupplier->add();
            }

            $invoiceStatus = 'pagada';
            if($dataInvoice['type'] != 'contado'){
                $invoiceStatus = 'por pagar';
            }

            $objInvoice = new PurchaseInvoice();
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
            $objInvoice = new PurchaseInvoice();
            echo $objInvoice->maxId();                          
        break;

        case 'new':
            $bussines_id = $data['bussines_id'];
            $objSupplier = new Supplier();
            $objSupplier->bussines_id = $bussines_id;
            $objInvoice = new PurchaseInvoice();
            include("../Vistas/movimientos/purchases/formulario.php");     
        break;
    }


?>