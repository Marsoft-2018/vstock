<?php
    require('../Modelo/cliente.php');
    
    $accion = "";
    if(isset($_POST['accion'])){
        $accion = $_POST['accion'];
    }

    if($accion=="cargarListaClientes"){
        $objE = new manejoCliente();
        $objE->cargarLista(); 
    }
    
    if($accion=='agregarCliente'){
        $idCliente = $_POST['idCliente'];
        $nombre = $_POST['nombre'];
        $dir = $_POST['DIR'];
        $tel = $_POST['TEL'];
        $ciudad = $_POST['ciudad'];
        $correo = $_POST['correo'];
       $objCliente = new manejoCliente();
       $objCliente->agregar($idCliente,$nombre,$dir,$tel,$ciudad,$correo);
    }        

    if($accion=='eliminarCliente'){
        $idCliente = $_POST['idCliente'];
        $objCliente = new manejoCliente();
        $objCliente->eliminar($idCliente);
    }

    if($accion=='cargarNuevo'){
        //echo "<script>alertify.success('Llego el dato del cliente al controlador $idCliente');</script>";
        $objCliente = new manejoCliente();
        $objCliente->cargarNuevo();
    }

    if($accion=='cargarCliente'){

        $idCliente = $_POST['idCliente'];

        //echo "<script>alertify.success('Llego el dato del cliente al controlador $idCliente');</script>";
        $objCliente = new manejoCliente();
        $objCliente->cargarCliente($idCliente);
    }
    
    if($accion=='actualizarCliente'){
        $idCliente = $_POST['idCliente'];
        $nombre = $_POST['nombre'];
        $dir = $_POST['DIR'];
        $tel = $_POST['TEL'];
        $ciudad = $_POST['ciudad'];
        $correo = $_POST['correo'];
        $antIdCliente=$_POST['anteriorId'];
        //echo "<script>alertify.success('Llegaron los datos del cliente al controlador $idCliente, $nombre, $nombre2, $apellido1, $apellido2, $dir, $tel, $cargo, $salario');</script>";
        $objCliente = new manejoCliente();
        $objCliente->actualizar($antIdCliente,$idCliente,$nombre,$dir,$tel,$ciudad,$correo);
    }

    if($accion=='cargarPagos'){
        $idCliente = $_POST['idCliente'];
        //echo "<script>alertify.success('Llego el dato del cliente al controlador $idCliente');</script>";
        $objCliente = new manejoCliente();
        $objCliente->cargarPagos($idCliente);
    }

    if($accion=='cargarEditarPagos'){
        $idCliente = $_POST['idCliente'];
        $idRecibo = $_POST['idRecibo'];

        //echo "<script>alertify.success('Llego el dato del cliente al controlador $idCliente');</script>";
        $objCliente = new manejoCliente();
        $objCliente->cargarEditarPago($idCliente,$idRecibo);
    }

    if($accion=='cargarListaPagos'){
        $idCliente = $_POST['idCliente'];        
        $objCliente = new manejoCliente();
        $objCliente->cargarListaPagos($idCliente);
    }

    if($accion=='agregarPago'){
        $idCliente = $_POST['idCliente'];
        $valorPago=$_POST['valorPago'];
        $fechaPago=$_POST['fechaPago'];
        //echo "<script>alertify.success('Llego el dato del cliente al controlador $idCliente');</script>";
        $objCliente = new manejoCliente();
        $objCliente->agregarPago($idCliente,$valorPago,$fechaPago);
    }

    if($accion=='eliminarPago'){
        $idPago = $_POST['idPago'];
        $idCliente = $_POST['idCliente'];
        //echo "<script>alertify.success('Llego el dato del cliente al controlador $idCliente');</script>";
        $objCliente = new manejoCliente();
        $objCliente->eliminarPago($idPago,$idCliente);
    }

    if($accion=='modificarPago'){
        $idPago = $_POST['idPago'];
        $idCliente = $_POST['idCliente'];
        $valorPago = $_POST['valorPago'];
        $fechaPago = $_POST['fechaPago'];        
        //echo "<script>alertify.success('Llego el dato del cliente al controlador $idCliente');</script>";
        $objCliente = new manejoCliente();
        $objCliente->modificarPago($idPago,$idCliente,$valorPago,$fechaPago);
    }

?>