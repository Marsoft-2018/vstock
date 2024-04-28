<?php
    require('Conexiones/FacturasDetalles.php');

//+++++++++++ Datos para ingreo de un nuevo cliente ++++++++++++//
    $documento=$_POST['documento'];
    $Nombre=$_POST['Nombre1'];
    $Dir=$_POST['Direccion'];
    $TEL=$_POST['Telefono'];
    $CIUDAD=$_POST['Ciudad'];
    $correo=$_POST['Correo'];

//+++++++++ Datos Factura ++++++++++++++++++++++++++++++++++++//
    $numFac=$_POST['numFact'];
    $factRegistro=$_POST['factRegistro'];
    $modulo=$_POST['modulo'];
    //$idcliente=$_POST[''];
    $tipo=$_POST['tipo'];
    $fecFactura=$_POST['fechaFac'];
    $formaPago=$_POST['formaPago'];

//+++++++++ Se instancia los metodos necesarios +++++++++++++//
    if($modulo=='VENTA'){
        $objCliente=new Cliente();
        $actCliente=$objCliente->actualizarDatos($documento,$Nombre,$Dir,$TEL,$CIUDAD,$correo);
        $agrCliente=$objCliente->agregarCliente($documento,$Nombre,$Dir,$TEL,$CIUDAD,$correo);
        $objFactura=new Facturar();
        $agrFactura=$objFactura->Enviar($numFac,$modulo,$documento,$tipo,$fecFactura,$formaPago,$factRegistro);
        /*$f=new FacturaSiguiente();
        $fs=$f->mascara($modulo);*/
    }

    if($modulo=='COMPRA'){
        $objProveedor=new proveedor();
        $agrProveedor=$objProveedor->agregarProveedor($documento,$Nombre,$Dir,$TEL,$CIUDAD,$correo);      
        
        //echo "<script> alert('Esta en el controlador los datos de la factura son '); </script>";
        
        
        $objFactura=new Facturar();
        $agrFactura=$objFactura->Enviar($numFac,$modulo,$documento,$tipo,$fecFactura,$formaPago,$factRegistro);
        /*$f=new FacturaSiguiente();
        $fs=$f->mascara($modulo);*/
    }


?>