<?php
    require('../Modelo/devolucion.php');
    
    $accion = "";
    if(isset($_POST['accion'])){
        $accion = $_POST['accion'];
    }
    
    if($accion=='cargarFactura'){
        $modulo = $_POST['modulo'];
        $objFact= new devolucion();
        $objFact->facturas($modulo);
    }
    
    if($accion=='cargarDetalle'){
        $modulo = $_POST['modulo'];
        $factura = $_POST['factura'];
        $objFact= new devolucion();
        $objFact->detallesFacturas($modulo,$factura);
    }
    
    if($accion=='cargarDatosPersona'){
        $modulo = $_POST['modulo'];
        $factura = $_POST['factura'];
        $objFact= new devolucion();
        $objFact->datosPersona($modulo,$factura);
    }

    if($accion=='ingresarDevolucion'){
        $modulo = $_POST['modulo'];
        $factura = $_POST['factura'];
        $product=$_POST['product'];
        $cantidad=$_POST['cantidad'];
        $cantidadFactura=$_POST['cantidadFactura'];
        $fecha=$_POST['fecha'];
        $objFact= new devolucion();
        $objFact->ingresarDevolucion($modulo,$factura,$product,$cantidad,$fecha,$cantidadFactura);
        //echo "Respuesta desde el controlador<br>";
    }

    if($accion=="datosArticulo"){
        $product=$_POST['idProd'];
        $objFact= new devolucion();
        $objFact->datosArticulo($product);        
    }

    if($accion=="cambiarArticulo"){
        $modulo = $_POST['modulo'];
        $factura = $_POST['factura'];
        $productACambiar=$_POST['productACambiar'];
        $productReemplazo=$_POST['productReemplazo'];
        $cantidad=$_POST['cantidad'];
        $objFact= new devolucion();
        $objFact->ingresarCambioProduct($modulo,$factura,$productACambiar,$productReemplazo,$cantidad);
        echo    "Respuesta desde el controlador";
    }


?>