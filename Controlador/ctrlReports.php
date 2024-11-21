<?php
    include("header.php");
    require('../Modelo/bussines.php');    
    require('../Modelo/product.php');
    require('../Modelo/report.php');
    require('../Modelo/customer.php');
    require('../Modelo/supplier.php');
    require('../Modelo/saleInvoice.php');
    require('../Modelo/purchaseInvoice.php');
    $modulo;
    if (isset($data['modulo'])) {
        $modulo=$data['modulo'];
        switch ($modulo) {
            case 'sales':
                $modulo ="VENTA";
            break;
            case 'purchases':
                $modulo ="COMPRA";
            break;
            case 'soldOuts':
                $modulo ="AGOTADO";
            break;
        }
    }
   

    switch ($accion) {
        case 'index':
            include("../Vistas/reports/index.php");                           
        break;
        case 'day':
            $objReport = new Report();
            $objReport->modulo = $data['modulo'];
            $objReport->day = $data['day'];
            $objReport->month = $data['month'];
            $objReport->year = $data['year'];
            $registerData = $objReport->journal();   
            loadRegister($registerData,$modulo);                     
        break;
        case 'month':
            $objReport = new Report();
            $objReport->modulo = $data['modulo'];
            $objReport->month = $data['month'];
            $objReport->year = $data['year'];
            $registerData = $objReport->monthly();   
            loadRegister($registerData,$modulo);                     
        break;
        case 'year':
            $objReport = new Report();
            $objReport->modulo = $data['modulo'];
            $objReport->year = $data['year'];
            $registerData = $objReport->yearly(); 
            loadRegister($registerData,$modulo);                     
        break;
        case 'overview':
            $objReport = new Report();
            $objReport->modulo = $data['modulo'];
            $objReport->month = $data['month'];
            $objReport->year = $data['year'];
            $registerData = $objReport->overview(); 
            include("../Vistas/reports/overview.php");                  
        break;
        case 'soldOuts':
            $objProduct = new Product();
            $objProduct->bussines_id = $data['bussines_id'];
            include("../Vistas/reports/sold_outs.php");                  
        break;
        case 'loadInvoice':
            $file = "../Vistas/reports/sale_invoice.php";
            $objInvoice = new SaleInvoice();
            $objInvoice->id = $data['invoice_id'];
            //$objInvoice->bussines_id = $data['bussines_id'];

            if($data['modulo'] == "COMPRA"){
                $objInvoice = new PurchaseInvoice();
                $objInvoice->id = $data['invoice_id'];               
                $file = "../Vistas/reports/purchase_invoice.php";
            }
            include($file);                  
        break;
        
        case 'findInvoice':
            $file = "../Vistas/reports/sale_invoice.php";
            $objInvoice = new SaleInvoice();
            $objInvoice->id = $data['invoice_id'];
            if($data['modulo'] == "purchase"){
                $objInvoice = new PurchaseInvoice();
                $objInvoice->id = $data['invoice_id'];
                $file = "../Vistas/reports/purchase_invoice.php";
            }
            include($file);                  
        break;
        
        case 'loadListInvoiceBySelect':
            if($data['modulo'] == "purchase"){
                $objInvoice = new PurchaseInvoice();            
                $objInvoice->text = $data['text'];
                echo json_encode($objInvoice->find());  
                return;
            }
            $objInvoice = new SaleInvoice();               
            $objInvoice->text = $data['text'];
            echo json_encode($objInvoice->find());  
        break;
        
    }

    function loadRegister($registerData,$modulo){
        include("../Vistas/reports/registers.php");
    }
    // if(isset($data['accion'])){
    //     $accion=$data['accion'];
    //     if($accion=='dia'){
    //         $dia=$data['dia'];
    //         $mes=$data['mes'];
    //         $anho=$data['anho'];
    //         $objReporte = new Reporte();
    //         $objReporte->diario($modulo,$dia,$mes,$anho);
    //     }
    //     if($accion=='mes'){
    //         $mes=$data['mes'];
    //         $anho=$data['anho'];
    //         $objReporte = new Reporte();
    //         $objReporte->mensual($modulo,$mes,$anho);
    //     }
    //     if($accion=='anho'){
    //         $anho=$data['anho'];
    //         $objReporte = new Reporte();
    //         $objReporte->anual($modulo,$anho);
    //     }
        
    //     if($accion=='resumen'){
    //         $anho=$data['anho'];
    //         $mes=$data['mes'];
    //         $objReporte = new Reporte();
    //         $objReporte->resumen($modulo,$mes,$anho);
    //     }
    // }

    // if($modulo=='AGOTADOS'){
    //     $objReporte = new Reporte();
    //     $objReporte->agotados();
    // } 

    // if($modulo=='INVENTARIO'){
    //     $objReporte = new Reporte();
    //     $objReporte->inventario();
    // }    

?>