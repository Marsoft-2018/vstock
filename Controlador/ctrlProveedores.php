<?php
    require('../Modelo/proveedor.php');
    
    $accion = "";
    if(isset($_POST['accion'])){
        $accion = $_POST['accion'];
    }

    if($accion=="cargarListaProveedores"){
        $objE = new manejoProveedor();
        $objE->cargarLista(); 
    }
    
    if($accion=='agregarProveedor'){
        $idProveedor = $_POST['idProveedor'];
        $nombre = $_POST['nombre'];
        $dir = $_POST['DIR'];
        $tel = $_POST['TEL'];
        $ciudad = $_POST['ciudad'];
        $correo = $_POST['correo'];
       $objProveedor = new manejoProveedor();
       $objProveedor->agregar($idProveedor,$nombre,$dir,$tel,$ciudad,$correo);
    }        

    if($accion=='eliminarProveedor'){
        $idProveedor = $_POST['idProveedor'];
        $objProveedor = new manejoProveedor();
        $objProveedor->eliminar($idProveedor);
    }

    if($accion=='cargarNuevo'){
        //echo "<script>alertify.success('Llego el dato del proveedor al controlador $idProveedor');</script>";
        $objProveedor = new manejoProveedor();
        $objProveedor->cargarNuevo();
    }

    if($accion=='cargarProveedor'){

        $idProveedor = $_POST['idProveedor'];

        //echo "<script>alertify.success('Llego el dato del proveedor al controlador $idProveedor');</script>";
        $objProveedor = new manejoProveedor();
        $objProveedor->cargarProveedor($idProveedor);
    }
    
    if($accion=='actualizarProveedor'){
        $idProveedor = $_POST['idProveedor'];
        $nombre = $_POST['nombre'];
        $dir = $_POST['DIR'];
        $tel = $_POST['TEL'];
        $ciudad = $_POST['ciudad'];
        $correo = $_POST['correo'];
        $antIdProveedor=$_POST['anteriorId'];
        //echo "<script>alertify.success('Llegaron los datos del proveedor al controlador $idProveedor, $nombre, $nombre2, $apellido1, $apellido2, $dir, $tel, $cargo, $salario');</script>";
        $objProveedor = new manejoProveedor();
        $objProveedor->actualizar($antIdProveedor,$idProveedor,$nombre,$dir,$tel,$ciudad,$correo);
    }

    if($accion=='cargarPagos'){
        $idProveedor = $_POST['idProveedor'];
        //echo "<script>alertify.success('Llego el dato del proveedor al controlador $idProveedor');</script>";
        $objProveedor = new manejoProveedor();
        $objProveedor->cargarPagos($idProveedor);
    }

    if($accion=='cargarEditarPagos'){
        $idProveedor = $_POST['idProveedor'];
        $idRecibo = $_POST['idRecibo'];

        //echo "<script>alertify.success('Llego el dato del proveedor al controlador $idProveedor');</script>";
        $objProveedor = new manejoProveedor();
        $objProveedor->cargarEditarPago($idProveedor,$idRecibo);
    }

    if($accion=='cargarListaPagos'){
        $idProveedor = $_POST['idProveedor'];        
        $objProveedor = new manejoProveedor();
        $objProveedor->cargarListaPagos($idProveedor);
    }

    if($accion=='agregarPago'){
        $idProveedor = $_POST['idProveedor'];
        $valorPago=$_POST['valorPago'];
        $fechaPago=$_POST['fechaPago'];
        //echo "<script>alertify.success('Llego el dato del proveedor al controlador $idProveedor');</script>";
        $objProveedor = new manejoProveedor();
        $objProveedor->agregarPago($idProveedor,$valorPago,$fechaPago);
    }

    if($accion=='eliminarPago'){
        $idPago = $_POST['idPago'];
        $idProveedor = $_POST['idProveedor'];
        //echo "<script>alertify.success('Llego el dato del proveedor al controlador $idProveedor');</script>";
        $objProveedor = new manejoProveedor();
        $objProveedor->eliminarPago($idPago,$idProveedor);
    }

    if($accion=='modificarPago'){
        $idPago = $_POST['idPago'];
        $idProveedor = $_POST['idProveedor'];
        $valorPago = $_POST['valorPago'];
        $fechaPago = $_POST['fechaPago'];        
        //echo "<script>alertify.success('Llego el dato del proveedor al controlador $idProveedor');</script>";
        $objProveedor = new manejoProveedor();
        $objProveedor->modificarPago($idPago,$idProveedor,$valorPago,$fechaPago);
    }

?>