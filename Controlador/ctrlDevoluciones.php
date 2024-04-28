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
        $producto=$_POST['producto'];
        $cantidad=$_POST['cantidad'];
        $cantidadFactura=$_POST['cantidadFactura'];
        $fecha=$_POST['fecha'];
        $objFact= new devolucion();
        $objFact->ingresarDevolucion($modulo,$factura,$producto,$cantidad,$fecha,$cantidadFactura);
        //echo "Respuesta desde el controlador<br>";
    }

    if($accion=="datosArticulo"){
        $producto=$_POST['idProd'];
        $objFact= new devolucion();
        $objFact->datosArticulo($producto);        
    }

    if($accion=="cambiarArticulo"){
        $modulo = $_POST['modulo'];
        $factura = $_POST['factura'];
        $productoACambiar=$_POST['productoACambiar'];
        $productoReemplazo=$_POST['productoReemplazo'];
        $cantidad=$_POST['cantidad'];
        $objFact= new devolucion();
        $objFact->ingresarCambioProducto($modulo,$factura,$productoACambiar,$productoReemplazo,$cantidad);
        echo    "Respuesta desde el controlador";
    }


?>