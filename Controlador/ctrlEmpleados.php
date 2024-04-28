<?php
    require('../Modelo/empleado.php');
    
    $accion = "";
    if(isset($_POST['accion'])){
        $accion = $_POST['accion'];
    }

    if($accion=="cargarListaEmpleados"){
    	$objE = new empleado();
        $objE->cargarLista(); 
    }
    
    if($accion=='agregarEmpleado'){
    	$idEmpleado = $_POST['idEmpleado'];
        $nombre1 = $_POST['nombre1'];
        $nombre2 = $_POST['nombre2'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $dir = $_POST['dir'];
        $tel = $_POST['tel'];
        $cargo = $_POST['cargo'];
        $salario = $_POST['salario'];
        $idNegocio = $_POST['idNegocio'];
       $objEmpleado = new empleado();
       $objEmpleado->agregar($idEmpleado,$nombre1,$nombre2,$apellido1,$apellido2,$dir,$tel,$cargo,$salario,$idNegocio);
    }        

    if($accion=='eliminarEmpleado'){
		$idEmpleado = $_POST['idEmpleado'];
		$idNegocio = $_POST['idNegocio'];
		$objEmpleado = new empleado();
		$objEmpleado->eliminar($idEmpleado,$idNegocio);
    }

    if($accion=='cargarNuevo'){
        //echo "<script>alertify.success('Llego el dato del empleado al controlador $idEmpleado');</script>";
        $objEmpleado = new empleado();
        $objEmpleado->cargarNuevo();
    }

    if($accion=='cargarEmpleado'){

		$idEmpleado = $_POST['idEmpleado'];

		//echo "<script>alertify.success('Llego el dato del empleado al controlador $idEmpleado');</script>";
		$objEmpleado = new empleado();
		$objEmpleado->cargarEmpleado($idEmpleado);
    }
    
    if($accion=='actualizarEmpleado'){
		$idEmpleado = $_POST['ID_EMPLEADO'];
		$nombre1 = $_POST['NOMBRE1'];
		$nombre2 = $_POST['NOMBRE2'];
        $apellido1 = $_POST['APELLIDO1'];
        $apellido2 = $_POST['APELLIDO2'];
        $dir = $_POST['DIR'];
        $tel = $_POST['TEL'];
        $cargo = $_POST['CARGO'];
        $salario = $_POST['SALARIO'];
        $antIdEmpleado=$_POST['anteriorId'];
        //echo "<script>alertify.success('Llegaron los datos del empleado al controlador $idEmpleado, $nombre1, $nombre2, $apellido1, $apellido2, $dir, $tel, $cargo, $salario');</script>";
		$objEmpleado = new empleado();
		$objEmpleado->actualizar($antIdEmpleado,$idEmpleado,$nombre1,$nombre2,$apellido1,$apellido2,$dir,$tel,$cargo,$salario);
    }

    if($accion=='cargarPagos'){
		$idEmpleado = $_POST['idEmpleado'];
		//echo "<script>alertify.success('Llego el dato del empleado al controlador $idEmpleado');</script>";
		$objEmpleado = new empleado();
		$objEmpleado->cargarPagos($idEmpleado);
    }

    if($accion=='cargarEditarPagos'){
        $idEmpleado = $_POST['idEmpleado'];
        $idRecibo = $_POST['idRecibo'];

        //echo "<script>alertify.success('Llego el dato del empleado al controlador $idEmpleado');</script>";
        $objEmpleado = new empleado();
        $objEmpleado->cargarEditarPago($idEmpleado,$idRecibo);
    }

    if($accion=='cargarListaPagos'){
		$idEmpleado = $_POST['idEmpleado'];
		//echo "<script>alertify.success('Llego el dato del empleado al controlador $idEmpleado');</script>";
		$objEmpleado = new empleado();
		$objEmpleado->cargarListaPagos($idEmpleado);
    }

    if($accion=='agregarPago'){
        $idEmpleado = $_POST['idEmpleado'];
        $valorPago=$_POST['valorPago'];
        $fechaPago=$_POST['fechaPago'];
        //echo "<script>alertify.success('Llego el dato del empleado al controlador $idEmpleado');</script>";
        $objEmpleado = new empleado();
        $objEmpleado->agregarPago($idEmpleado,$valorPago,$fechaPago);
    }

    if($accion=='eliminarPago'){
        $idPago = $_POST['idPago'];
        $idEmpleado = $_POST['idEmpleado'];
        //echo "<script>alertify.success('Llego el dato del empleado al controlador $idEmpleado');</script>";
        $objEmpleado = new empleado();
        $objEmpleado->eliminarPago($idPago,$idEmpleado);
    }

    if($accion=='modificarPago'){
        $idPago = $_POST['idPago'];
        $idEmpleado = $_POST['idEmpleado'];
        $valorPago = $_POST['valorPago'];
        $fechaPago = $_POST['fechaPago'];        
        //echo "<script>alertify.success('Llego el dato del empleado al controlador $idEmpleado');</script>";
        $objEmpleado = new empleado();
        $objEmpleado->modificarPago($idPago,$idEmpleado,$valorPago,$fechaPago);
    }

?>