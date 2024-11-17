<?php
    include("header.php");
    require('../Modelo/report.php');

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