<?php
	require('../Conexiones/Conect.php');
	class empleado extends conectar{
		public function cargarNuevo(){
			echo "<div class='row'>";
            echo "    <div class='col-md-2'><label>Documento</label><input type='text' class='form form-control' id='idEmpleado' value=''></div>";
            echo "    <div class='col-md-3'><label>1er. Nombre</label><input type='text' class='form form-control' id='nombre1' value=''></div>";
            echo "    <div class='col-md-2'><label>2do. Nombre </label><input type='text' class='form form-control' id='nombre2' value=''></div>";
            echo "    <div class='col-md-3'><label>1er. Apellido</label><input type='text' class='form form-control' id='apellido1' value=''></div>";
            echo "    <div class='col-md-2'><label>2do. Apellido</label><input type='text' class='form form-control' id='apellido2' value=''></div>";
            echo "</div>";
            echo "<div class='row'>";
            echo "    <div class='col-md-4'><label>Dirección</label><input type='text' class='form form-control' id='dir' value=''></div>";
            echo "    <div class='col-md-2'><label>Teléfono</label><input type='text' class='form form-control' id='tel' value=''></div>";
            echo "    <div class='col-md-3'><label>Cargo</label><input type='text' class='form form-control' id='cargo' value='Empleado'></div>";
            echo "    <div class='col-md-3'><label>Salario</label><input type='text' class='form form-control' id='salario' value=''></div>";
            echo "</div>";
            echo "<div class='row'>";
            echo "    <div class='col-md-3'>";
            echo "        <br>";
            echo "        <button class='btn btn-primary' style='width: 100%;' onclick='addEmpleado()'>";
            echo "            <i class='fa fa-plus'> </i> Agregar";
            echo "        </button>                        ";
            echo "    </div>";
            echo "    <div class='col-md-8'></div>";            
            echo "</div> ";
		}

		function cargarLista(){
			$sqlEmp=mysql_query("SELECT * FROM empleados WHERE activo='SI' AND ID_NEGOCIO='1' ORDER BY apellido1,apellido2,nombre1,nombre2");
                        
	        echo "<table class='table table-striped'>";
	            echo "<thead>";
	                echo "<tr>";
	                    echo "<th>id Empleado</th>";
	                    echo "<th>1er. Nombre</th>";
	                    echo "<th>2do. Nombre</th>";
	                    echo "<th>1er. Apellido</th>";
	                    echo "<th>2do. Apellido</th>";
	                    echo "<th>Dirección</th>";
	                    echo "<th>Teléfono</th>";
	                    echo "<th>Cargo</th>";
	                    echo "<th>Salarios<br>Honorarios</th>";
	                    echo "<th>Activo</th>";
	                    echo "<th colspan='3'>Acciones</th>";
	                echo "</tr>";
	            echo "</thead>";
	            echo "<tbody>";
	            while($emp=mysql_fetch_array($sqlEmp)){
	                echo "<tr style='font-size:10px;padding:2px;'>";
	                    echo "<td style='font-size:12px;padding:2px;'>$emp[0]</td>";
	                    echo "<td style='font-size:12px;padding:2px;'>$emp[1]</td>";
	                    echo "<td style='font-size:12px;padding:2px;'>$emp[2]</td>";
	                    echo "<td style='font-size:12px;padding:2px;'>$emp[3]</td>";
	                    echo "<td style='font-size:12px;padding:2px;'>$emp[4]</td>";
	                    echo "<td style='font-size:12px;padding:2px;'>$emp[5]</td>";
	                    echo "<td style='font-size:12px;padding:2px;'>$emp[6]</td>";
	                    echo "<td style='font-size:12px;padding:2px;'>$emp[7]</td>";
	                    echo "<td style='font-size:12px;padding:2px;'>$emp[8]</td>";
	                    echo "<td style='font-size:12px;padding:2px;'>$emp[9]</td>";

	                    echo "<td style='padding:2px;font-size:15px;text-shadow:0px 1px 2px rgba(80,80,100,0.6);'>
	                    		<a id='$emp[0]' style='padding:1px;height:20px;width:20px;color:#1CB526;' title='Editar proveedor' onclick='cargarEmpleado(this.id)'>
	                    			<i class='fa fa-pencil'> </i>
	                    		</a>";
	                    echo "</td>";	
	                    echo "<td style='padding:2px;font-size:15px;text-shadow:0px 1px 2px rgba(80,80,100,0.6);'>
	                    		<a id='$emp[0]' style='padding:1px;height:20px;width:20px;color:#F00;' title='Eliminar Proveedor' onclick='eliminarEmpleado(this.id)'>
	                    			<i class='fa fa-trash'> </i>
	                    		</a>";
	                    echo "</td>";	
	                    echo "<td style='padding:2px;font-size:15px;text-shadow:0px 1px 2px rgba(80,80,100,0.6);'>
	                    		<a id='$emp[0]' style='padding:1px;height:20px;width:20px;color:#00F;' title='Ver pagos al Proveedor' onclick='cargarPagos(this.id)'>
	                    			<i class='fa fa-money'> </i>
	                    		</a>";
	                    echo "</td>";
	                    /*
	                    echo "<td style='font-size:12px;padding:2px;'><button id='$emp[0]' class='btn btn-success' title='Editar empleado' onclick='cargarEmpleado(this.id)'><i class='fa fa-pencil'> </i></button></td>";
	                    echo "<td style='font-size:12px;padding:2px;'><button id='$emp[0]' class='btn btn-danger' title='Eliminar o Despedir Empleado' onclick='eliminarEmpleado(this.id)'><i class='fa fa-thumbs-down'> </i></button></td>";
	                    echo "<td style='font-size:12px;padding:2px;'><button id='$emp[0]' class='btn btn-primary' title='Cargar pagos' onclick='cargarPagos(this.id)'><i class='fa fa-dollar'> </i></button></td>";*/
	                echo "</tr>";                                
	            }                                
	            echo "</tbody>";
	        echo "</table>";
		}

		function cargarEmpleado($idEmpleado){		
			$sqlBuscar=mysql_query("SELECT * FROM empleados WHERE `ID_EMPLEADO` = '$idEmpleado';");
			//echo "<script>alertify.success('Llego el dato del empleado al modelo id: $idEmpleado; hasta aquí no sé que pasa si sigue mostrando el listado');</script>";
			while($emp=mysql_fetch_array($sqlBuscar)){	
				echo "<div class='row'>";
	            echo "   <div class='col-md-2'>
	            			<label>Documento</label>
	            			<input type='text' class='form form-control'  id='ID_EMPLEADO' value='$emp[0]'>
	            		 </div>";
	            echo "   <div class='col-md-3'>
	            			<label>1er. Nombre</label>
	            			<input type='text' class='form form-control'  id='NOMBRE1' value='$emp[1]'>
	            		 </div>";
	            echo "   <div class='col-md-2'>
	            			<label>2do. Nombre </label>
	            			<input type='text' class='form form-control'  id='NOMBRE2' value='$emp[2]'>
	            		 </div>";
	            echo "   <div class='col-md-3'>
	            			<label>1er. Apellido</label>
	            			<input type='text' class='form form-control'  id='APELLIDO1' value='$emp[3]'>
	            		 </div>";
	            echo "   <div class='col-md-2'>
	            		 	<label>2do. Apellido</label>
	            		 	<input type='text' class='form form-control'  id='APELLIDO2' value='$emp[4]'>
	            		 </div>";
	            echo "</div>";
	            
	            echo "<div class='row'>";
	            echo "   <div class='col-md-4'>
	            		 	<label>Dirección</label>
	            		 	<input type='text' class='form form-control'  id='DIR' value='$emp[5]'>
	            		 </div>";
	            echo "   <div class='col-md-2'>
	            		 	<label>Teléfono</label>
	            		 	<input type='text' class='form form-control'  id='TEL' value='$emp[6]'>
	            		 </div>";
	            echo "   <div class='col-md-3'>
	            		 	<label>Cargo</label>
	            		 	<input type='text' class='form form-control'  id='CARGO' value='$emp[7]'>
	            		 </div>";
	            echo "   <div class='col-md-3'>
	            		 	<label>Salario</label>
	            		 	<input type='text' class='form form-control'  id='SALARIO' value='$emp[8]'>
	            		 </div>";
	            echo "</div>";
			}
            echo "<div class='row'>";
            echo "    <div class='col-md-3'>";
            echo "		  <br>";
            echo "        <button class='btn btn-success' id='$idEmpleado' style='width: 100%;' onclick='actualizarEmpleado(this.id)'>";
            echo "            <i class='fa fa-check'> </i> Listo";
            echo "        </button> ";                       
            echo "    </div>";
            echo "    <div class='col-md-3'>
						<br>";
            echo "        <button class='btn btn-warning' style='width: 100%;' onclick='cargarNuevoEmpleado()'>";
            echo "            <i class='fa fa-check'> </i> Cancelar";
            echo "        </button> ";
            echo 	  "</div>";
            
            echo "</div> "; 
		}

		function agregar($idEmpleado,$nombre1,$nombre2,$apellido1,$apellido2,$direccion,$telefono,$cargo,$salario,$idNegocio){
			$sqlAdd = mysql_query("INSERT INTO empleados (`ID_EMPLEADO`,`NOMBRE1`, `NOMBRE2`,`APELLIDO1`, `APELLIDO2`,`DIR`, `TEL`,`CARGO`, `SALARIO`,`ACTIVO`, `ID_NEGOCIO`) VALUES ('$idEmpleado','$nombre1','$nombre2','$apellido1','$apellido2','$direccion','$telefono','$cargo','$salario','SI','$idNegocio');");
				$this->cargarLista();
		}

		function actualizar($antIdEmpleado,$idEmpleado,$nombre1,$nombre2,$apellido1,$apellido2,$dir,$tel,$cargo,$salario){
			mysql_query("UPDATE `empleados` SET `ID_EMPLEADO` = '$idEmpleado' , `NOMBRE1` = '$nombre1' , `NOMBRE2` = '$nombre2' , `APELLIDO1` = '$apellido1' , `APELLIDO2` = '$apellido2' , `DIR` = '$dir' , `TEL` = '$tel' , `CARGO` = '$cargo' , `SALARIO` = '$salario' , `ACTIVO` = 'si' WHERE `ID_EMPLEADO` = '$antIdEmpleado';");
			echo "<script>alertify.success('Empleado(a) Actualizado con éxito');</script>";
			$this->cargarLista();
		}

		function eliminar($idEmpleado,$idNegocio){
			//mysql_query("DELETE FROM `empleados` WHERE `ID_EMPLEADO` = '$idEmpleado';");
			mysql_query("UPDATE `empleados` SET `ACTIVO` = 'NO' WHERE `ID_EMPLEADO` = '$idEmpleado' AND `ID_NEGOCIO`='$idNegocio';");
			$this->cargarLista();
		}

		function cargarPagos($idEmpleado){		
			$sqlBuscar=mysql_query("SELECT * FROM empleados WHERE `ID_EMPLEADO` = '$idEmpleado';");
			//echo "<script>alertify.success('Llego el dato del empleado al modelo id: $idEmpleado; hasta aquí no sé que pasa si sigue mostrando el listado');</script>";
			while($emp=mysql_fetch_array($sqlBuscar)){	
				echo "<h4 class='alert alert-info' style='text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);'>PAGAR A: $emp[1] $emp[2] $emp[3] $emp[4]</h4>";
				echo "<div class='row' id='datoPagoEmpleado'>";
	            echo "   <div class='col-md-2'>
	            			<label>Valor del Salario/pago</label>
	            			<input type='text' class='form form-control' id='VALOR_PAGO' name='$emp[0]' value='$emp[8]' onchange='actualizarEmpleado(this.name,this.id,this.value)'>
	            		 </div>";
	            echo "   <div class='col-md-3'>
	            			<label>Fecha para el pago</label>
	            			<input type='date' class='form form-control' id='FECHA_PAGO' name='$emp[0]' value='".date('Y-m-d')."'>
	            		 </div>";
	            /*echo "   <div class='col-md-2'>
	            			<label>Recibo </label>
	            			<input type='text' class='form form-control' id='$emp[0]' name='recibo' value=''>
	            		 </div>";*/
	           
	            echo "   <div class='col-md-2'>";
	            echo "        <br><button class='btn btn-primary' id='$emp[0]' style='width: 100%;' onclick='agregarPagoEmpleado(this.id)'>";
            	echo "            <i class='fa fa-plus'> </i> Agregar Pago";
            	echo "        </button> "; 
	            echo	 "</div>"; 
	            echo "   <div class='col-md-2'>";
	            echo "        <br><button class='btn btn-warning' style='width: 100%;' onclick='cargarListaEmpleados()'>";
            	echo "            <i class='fa fa-plus'> </i> Regresar";
            	echo "        </button> "; 			
	            echo "	 </div>";
	            echo "</div>";
	            
	            echo "<div class='row'>";
	            echo "   <div class='col-md-12' id='listaPagos'>";
							$this->cargarListaPagos($idEmpleado);
	            echo "   </div>";
	            echo "</div>";
			} 
		}

		function cargarEditarPago($idEmpleado,$idPago){		
			$sqlBuscar=mysql_query("SELECT * FROM pagos WHERE `ID_EMPLEADO` = '$idEmpleado' AND recibo='$idPago';");
			//echo "<script>alertify.success('Llego el dato del empleado al modelo id: $idEmpleado; hasta aquí no sé que pasa si sigue mostrando el listado');</script>";
			while($emp=mysql_fetch_array($sqlBuscar)){	
				
	            echo "   <div class='col-md-2'>
	            			<label>Valor del Salario/pago</label>
	            			<input type='text' class='form form-control' id='VALOR_PAGO' name='$emp[1]' value='$emp[1]' onchange='actualizarEmpleado(this.name,this.id,this.value)'>
	            		 </div>";
	            echo "   <div class='col-md-3'>
	            			<label>Fecha para el pago</label>
	            			<input type='date' class='form form-control' id='FECHA_PAGO' name='$emp[2]' value='$emp[2]'>
	            		 </div>";
	            /*echo "   <div class='col-md-2'>
	            			<label>Recibo </label>
	            			<input type='text' class='form form-control' id='$emp[0]' name='recibo' value=''>
	            		 </div>";*/
	           
	            echo "   <div class='col-md-2'>";
	            echo "        <br><button class='btn btn-success' id='$idPago' name='$idEmpleado' style='width: 100%;' onclick='modificarPagoEmpleado(this.id,this.name)'>";
            	echo "            <i class='fa fa-check'> </i> Listo";
            	echo "        </button> "; 
	            echo	 "</div>"; 
	            echo "   <div class='col-md-2'>";
	            echo "        <br><button class='btn btn-warning' id='$emp[0]' style='width: 100%;' onclick='cargarPagos(this.id)'>";
            	echo "            <i class='fa fa-repeat'> </i> Cancelar";
            	echo "        </button> "; 			
	            echo "	 </div>";
			} 
		}

		function cargarListaPagos($idEmpleado){
			$sqlEmp=mysql_query("SELECT * FROM pagos WHERE ID_EMPLEADO='$idEmpleado' ORDER BY FECHA_PAGO ASC");
			echo "<div class='panel panel-default>";
			echo 	"<div class='panel-heading'>";
			echo 	"<h3>LISTA DE PAGOS REALIZADOS AL EMPLEADO</h3>";
			echo 	"</div>";
            echo 	"<div class='panel-body'>";            
	        echo "<table class='table table-striped'>";
	            echo "<thead>";
	                echo "<tr>";
	                    echo "<th>id Empleado</th>";
	                    echo "<th>Valor Pago</th>";
	                    echo "<th>Fecha Pago</th>";
	                    echo "<th>Recibo</th>";
	                    echo "<th colspan='2'>Acciones</th>";
	                echo "</tr>";
	            echo "</thead>";
	            echo "<tbody>";
	            $rsp=mysql_num_rows($sqlEmp);
	            if($rsp>0){
    	            while($emp=mysql_fetch_array($sqlEmp)){
    	                echo "<tr style='font-size:10px;'>";
    	                    echo "<td>$emp[0]</td>";
    	                    echo "<td>$emp[1]</td>";
    	                    echo "<td>$emp[2]</td>";
    	                    echo "<td>$emp[3]</td>";

    	                    echo "<td style='padding:2px;font-size:15px;text-shadow:0px 1px 2px rgba(80,80,100,0.6);'>
	                    		<a id='$emp[0]' name='$emp[3]' style='padding:1px;height:20px;width:20px;color:#1CB526;' title='Editar Pago'  onclick='cargarEditarPago(this.id,this.name)'>
	                    			<i class='fa fa-pencil'> </i>
	                    		</a>";
	                    echo "</td>";	
	                    echo "<td style='padding:2px;font-size:15px;text-shadow:0px 1px 2px rgba(80,80,100,0.6);'>
	                    		<a id='$emp[3]' name='$emp[0]' style='padding:1px;height:20px;width:20px;color:#F00;' title='Eliminar Pago' onclick='eliminarPagoEmpleado(this.id,this.name)'>
	                    			<i class='fa fa-trash'> </i>
	                    		</a>";
	                    echo "</td>";
							/*
    	                    echo "<td><button id='$emp[0]'  class='btn btn-success' title='Editar Pago'><i class='fa fa-pencil-square'> </i></button></td>";
    	                    echo "<td><button id='$emp[3]' class='btn btn-danger' title='Eliminar Pago' ><i class='fa fa-trash'> </i></button></td>";*/
    	                    
    	                echo "</tr>";                                
    	            }       
	           	}else{
	           		echo "<tr>";
					echo 	"<td colspan='6' style='text-align:center;'>";
					echo 		"<div class='alert alert-warning' >No existen pagos relacionados al empleado hasta el momento en la base de datos</div>";
					echo 	"</td>";
					echo "</tr>";
	           	}                         
	            echo "</tbody>";
	        echo "</table>";
	        echo 	"</div'>";
	        echo 	"</div'>";
		}

		public function agregarPago($idEmpleado,$valor,$fecha){
			$sqlPagar=mysql_query("INSERT INTO pagos(`ID_EMPLEADO`,`VALOR_PAGO`,`FECHA_PAGO`) VALUES('$idEmpleado','$valor','$fecha');");
			echo "<script>alertify.success('Se agregó el pago con éxito'); </script>";
			$this->cargarListaPagos($idEmpleado);
		}

		public function eliminarPago($idPago,$idEmpleado){
			$sqlPagar=mysql_query("DELETE FROM pagos WHERE `ID_EMPLEADO`='$idEmpleado' AND `recibo`= $idPago;");
			echo "<script>alertify.success('Se eliminó el pago con éxito'); </script>";
			$this->cargarListaPagos($idEmpleado);
		}

		public function modificarPago($idPago,$idEmpleado,$valor,$fecha){
			$sqlPagar=mysql_query("UPDATE pagos SET `VALOR_PAGO`='$valor', `FECHA_PAGO`='$fecha' WHERE `ID_EMPLEADO`='$idEmpleado' AND `recibo`= $idPago;");
			echo "<script>alertify.success('Se agregó el pago con éxito'); </script>";
			$this->cargarListaPagos($idEmpleado);
		}

	}

?>