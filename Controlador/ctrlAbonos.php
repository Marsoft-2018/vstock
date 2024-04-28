<?php
    require("../Modelo/abonos.php");
    $accion=$_POST['accion'];
    if($accion=='cargar'){
        $id=$_POST['idPersona'];
        $tabla=$_POST['tabla'];
        $objAbono = new Abono();
        $objAbono->Cargar($tabla,$id); 
    }

    if($accion=='listaPagos'){
        $id=$_POST['idPersona'];
        $tabla=$_POST['tabla'];
        $idCredito=$_POST['factura'];
        $objAbono = new Abono();
        $objAbono->listaDePagos($tabla,$id,$idCredito); 
    }

    if($accion=='agregarCuota'){        
        $idPersona=$_POST['idPersona'];
        $tabla=$_POST['tabla'];
        $idCredito=$_POST['idCredito'];
        $cuotas=$_POST['cuotas'];
        $valorCuota=$_POST['valorCuota'];
        $fecha=$_POST['fecha'];        
        $objAbono = new Abono();
        $objAbono->agregarPago($tabla,$idCredito,$cuotas,$valorCuota,$fecha);
        $objAbono->listaDePagos($tabla,$idPersona,$idCredito); 
        //echo "<script> alert('Mensaje desde el controlador Las variables son IdPersona: $IdPersona, tabla: $tabla, idCredito: $idCredito');</script>";
    }

//echo "<script> alert('Mensaje desde el controlador La accion es $accion ');</script>";
                
    if($accion=='eliminarAbono'){
        $idPersona=$_POST['idPersona'];
        $tabla=$_POST['tabla'];
        $idCredito=$_POST['idCredito'];
        $idAbono=$_POST['idAbono'];
        $objAbono = new Abono();
        $objAbono->eliminarAbono($idAbono,$idCredito,$tabla);
        $objAbono->listaDePagos($tabla,$idPersona,$idCredito);
        //echo "<script> alert('Mensaje desde el controlador Las variables son ');</script>";
    }

    if($accion=='agregarDescuento'){
        
        $credito=$_POST['credito'];
        $valor=$_POST['valor'];
        $detalle=$_POST['detalle'];
        /*
            echo "Respuesta del controlador a la accion agregarDescuento<br>";
            echo "Variables credito: $credito, valor: $valor, detalle: $detalle";
        */

        $objAbono = new Abono();
        $objAbono->agregarDescuento($credito,$valor,$detalle);
        $objAbono->cargarDescuento($credito);
    }

    if($accion=='cargarNuevoSaldo'){
        $credito=$_POST['credito'];
        $objAbono = new Abono();
        $objAbono->cargarNuevoSaldo($credito);
    }

    if($accion=='eliminarDescuento'){
        $credito=$_POST['credito'];
        $objAbono = new Abono();
        $objAbono->eliminarDescuento($credito);
    }

    

?>