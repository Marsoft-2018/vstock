<?php
    require ("../Conexiones/Conect.php");
    require('../Modelo/gastos.php');
    if(isset($_POST['accion'])){
    	$accion=$_POST['accion'];

    	if($accion=='Agregar'){
	    	$negocio=$_POST['idNegocio'];
	    	$gasto=$_POST['nombreGasto'];
	    	$tipo=$_POST['tipo'];

	    	agregarTipo($tipo,$gasto,$negocio);
	    }
	    
	    if($accion=='Actualizar'){
	    	$campo=$_POST['campo'];
	    	$gasto=$_POST['idGasto'];
	    	$valor=$_POST['valor'];

	    	actualizarTipo($campo,$valor,$gasto);
	    }

	    if($accion=='Eliminar'){
	    	$gasto=$_POST['idGasto'];

	    	eliminarTipo($gasto);
	    }

	    if($accion=='Pagar'){
	    	$negocio=$_POST['idNegocio'];
	    	$gasto=$_POST['idGasto'];
	    	$recibo=$_POST['recibo'];
	    	$valor=$_POST['valor'];
	    	$fecha=$_POST['fecha'];

	    	ingresarPago($negocio,$gasto,$recibo,$valor,$fecha);
	    }
    }else{
    	echo "<div class='alert alert-danger'>No existe accion para ejecutar desde el controlador</div>";
    }

    

	function agregarTipo($tipo,$nombre,$idNegocio){
		//echo "respuesta desde el controlador: Gasto: $gasto";
		$objGasto = new Gasto();
		$objGasto->agregarTipo($tipo,$nombre,$idNegocio);
	}        

	function actualizarTipo($campo,$valor,$idGasto){
		$objGasto = new Gasto();
		$objGasto->actualizarTipo($campo,$valor,$idGasto);
	}

	function eliminarTipo($idGasto){
		$objGasto = new Gasto();
		$objGasto->eliminarTipo($idGasto);
	}

	function ingresarPago($idNegocio,$idGasto,$recibo,$pago,$fecha){
		$objGasto = new Gasto();
		$objGasto->ingresarPago($idNegocio,$idGasto,$recibo,$pago,$fecha);
	}


?>