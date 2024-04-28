<?php
	require('../Conexiones/Conect.php');
	class manejoProveedor extends conectar{
		/*
			CREATE TABLE `proveedores` (
			  `idProveedor` char(50) NOT NULL DEFAULT '0',
			  `Nombre` char(250) NOT NULL,
			  `Dir` char(150) DEFAULT NULL,
			  `TEL` char(20) DEFAULT NULL,
			  `CIUDAD` char(50) DEFAULT NULL,
			  `Correo` char(250) DEFAULT NULL,
			  PRIMARY KEY (`idProveedor`),
			  KEY `NewIndex1` (`idProveedor`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1

		*/

		public function cargarNuevo(){
			echo "<div class='row'>";
            echo "    <div class='col-md-2'><label>Nit/Documento</label><input type='text' class='form form-control' id='idProveedor' value=''></div>";
            echo "    <div class='col-md-4'><label>Nombre</label><input type='text' class='form form-control' id='nombre' value=''></div>";            
            echo "    <div class='col-md-4'><label>Dirección</label><input type='text' class='form form-control' id='dir' value=''></div>";
            echo "    <div class='col-md-2'><label>Teléfono</label><input type='text' class='form form-control' id='tel' value=''></div>";
            echo "</div>";
            echo "<div class='row'>";
            echo "    <div class='col-md-3'><label>Ciudad</label><input type='text' class='form form-control' id='ciudad' value=''></div>";
            echo "    <div class='col-md-3'><label>Correo</label><input type='text' class='form form-control' id='correo' value=''></div>";
                    
            echo "    <div class='col-md-3'>";
            echo "        <br>";
            echo "        <button class='btn btn-primary' style='width: 100%;' onclick='addProveedor()'>";
            echo "            <i class='fa fa-plus'> </i> Agregar";
            echo "        </button>                        ";
            echo "    </div>";
            //echo "    <div class='col-md-8'></div>";            
            echo "</div> ";
		}

		function cargarLista(){
			$sqlEmp=mysql_query("SELECT * FROM proveedores ORDER BY nombre");
                        
	        echo "<table class='display table table-striped table-hover dataTable no-footer'>";
	            echo "<thead>";
	                echo "<tr>";
	                    echo "<th>Nit/Documento</th>";
	                    echo "<th>Nombre</th>";
	                    echo "<th>Dirección</th>";
	                    echo "<th>Teléfono</th>";
	                    echo "<th>Ciudad</th>";
	                    echo "<th>Correo</th>";
	                    echo "<th colspan='3'>Acciones</th>";
	                echo "</tr>";
	            echo "</thead>";
	            echo "<tbody>";
	            while($pro=mysql_fetch_array($sqlEmp)){
	                echo "<tr style='font-size:10px;'>";
	                    echo "<td style='padding:2px;'>$pro[0]</td>";
	                    echo "<td style='padding:2px;'>$pro[1]</td>";
	                    echo "<td style='padding:2px;'>$pro[2]</td>";
	                    echo "<td style='padding:2px;'>$pro[3]</td>";
	                    echo "<td style='padding:2px;'>$pro[4]</td>";
	                    echo "<td style='padding:2px;'>$pro[5]</td>";
	                    /*
	                    echo "<td style='padding:2px;'>
	                    		<button id='$pro[0]' class='btn btn-success' style='padding:1px;height:20px;width:20px;' title='Editar proveedor' onclick='cargarProveedor(this.id)'>
	                    			<i class='fa fa-pencil'> </i>
	                    		</button>
	                    	 </td>";
	                    echo "<td style='padding:2px;'>
	                    		<button id='$pro[0]' class='btn btn-danger' style='padding:1px;height:20px;width:20px;' title='Eliminar Proveedor' onclick='eliminarProveedor(this.id)'>
	                    			<i class='fa fa-trash'> </i>
	                    		</button>
	                    	 </td>";
	                    echo "<td style='padding:2px;'>
	                    		<button id='$pro[0]' class='btn btn-info' style='padding:1px;height:20px;width:20px;' title='Ver pagos al Proveedor' onclick='cargarListaPagosProveedor(this.id)'>
	                    			<i class='fa fa-money'> </i>
	                    		</button>
	                    </td>";*/
	                    echo "<td style='padding:2px;font-size:15px;text-shadow:0px 1px 2px rgba(80,80,100,0.6);'>
	                    		<a id='$pro[0]' style='padding:1px;height:20px;width:20px;color:#1CB526;' title='Editar proveedor' onclick='cargarProveedor(this.id)'>
	                    			<i class='fa fa-pencil'> </i>
	                    		</a>";
	                    echo "</td>";	
	                    echo "<td style='padding:2px;font-size:15px;text-shadow:0px 1px 2px rgba(80,80,100,0.6);'>
	                    		<a id='$pro[0]' style='padding:1px;height:20px;width:20px;color:#F00;' title='Eliminar Proveedor' onclick='eliminarProveedor(this.id)'>
	                    			<i class='fa fa-trash'> </i>
	                    		</a>";
	                    echo "</td>";	
	                    echo "<td style='padding:2px;font-size:15px;text-shadow:0px 1px 2px rgba(80,80,100,0.6);'>
	                    		<a id='$pro[0]' style='padding:1px;height:20px;width:20px;color:#00F;' title='Ver pagos al Proveedor' onclick='cargarListaPagosProveedor(this.id)'>
	                    			<i class='fa fa-money'> </i>
	                    		</a>";
	                    echo "</td>";		
	                         echo "</tr>";                                
	            }                                
	            echo "</tbody>";
	        echo "</table>";
		}

		function cargarProveedor($idProveedor){		
			$sqlBuscar=mysql_query("SELECT * FROM proveedores WHERE `idProveedor` = '$idProveedor';");
			//echo "<script>alertify.success('Llego el dato del proveedor al modelo id: $idProveedor; hasta aquí no sé que pasa si sigue mostrando el listado');</script>";
			while($pro=mysql_fetch_array($sqlBuscar)){	
				echo "<div class='row'>";
	            echo "    <div class='col-md-2'><label>Nit/Documento</label><input type='text' class='form form-control' id='idProveedor' value='$pro[0]'></div>";
	            echo "    <div class='col-md-4'><label>Nombre</label><input type='text' class='form form-control' id='nombre' value='$pro[1]'></div>";            
	            echo "    <div class='col-md-4'><label>Dirección</label><input type='text' class='form form-control' id='dir' value='$pro[2]'></div>";
	            echo "    <div class='col-md-2'><label>Teléfono</label><input type='text' class='form form-control' id='tel' value='$pro[3]'></div>";
	            echo "</div>";
	            echo "<div class='row'>";
	            echo "    <div class='col-md-3'><label>Ciudad</label><input type='text' class='form form-control' id='ciudad' value='$pro[4]'></div>";
	            echo "    <div class='col-md-3'><label>Correo</label><input type='text' class='form form-control' id='correo' value='$pro[5]'></div>";	            
			}
            echo "    <div class='col-md-3'>";
            echo "		  <br>";
            echo "        <button class='btn btn-success' id='$idProveedor' style='width: 100%;' onclick='actualizarProveedor(this.id)'>";
            echo "            <i class='fa fa-check'> </i> Listo";
            echo "        </button> ";                       
            echo "    </div>";
            echo "    <div class='col-md-3'>
						<br>";
            echo "        <button class='btn btn-warning' style='width: 100%;' onclick='cargarNuevoProveedor()'>";
            echo "            <i class='fa fa-check'> </i> Cancelar";
            echo "        </button> ";
            echo 	  "</div>";
            
            echo "</div> "; 
		}

		function agregar($idProveedor,$nombre,$direccion,$telefono,$ciudad,$correo){
			$sqlAdd = mysql_query("INSERT INTO proveedores (`idProveedor`,`nombre`, `Dir`, `TEL`,`CIUDAD`, `correo`) VALUES ('$idProveedor','$nombre','$direccion','$telefono','$ciudad','$correo');");
				$this->cargarLista();
		}

		function actualizar($antIdProveedor,$idProveedor,$nombre,$dir,$tel,$ciudad,$correo){
			mysql_query("UPDATE `proveedores` SET `idProveedor` = '$idProveedor' , `nombre` = '$nombre' , `Dir` = '$dir' , `TEL` = '$tel' , `CIUDAD` = '$ciudad' , `correo` = '$correo' WHERE `idProveedor` = '$antIdProveedor';");
			echo "<script>alertify.success('Proveedor(a) Actualizado con éxito');</script>";
			$this->cargarLista();
		}

		function eliminar($idProveedor){
			mysql_query("DELETE FROM `proveedores` WHERE `idProveedor` = '$idProveedor';");
			//mysql_query("UPDATE `proveedores` SET `ACTIVO` = 'NO' WHERE `ID_EMPLEADO` = '$idProveedor' AND `ID_NEGOCIO`='$idNegocio';");
			$this->cargarLista();
		}

		function cargarPagos($idProveedor){		
			$sqlBuscar=mysql_query("SELECT * FROM proveedores WHERE `ID_EMPLEADO` = '$idProveedor';");
			//echo "<script>alertify.success('Llego el dato del proveedor al modelo id: $idProveedor; hasta aquí no sé que pasa si sigue mostrando el listado');</script>";
			while($pro=mysql_fetch_array($sqlBuscar)){	
				echo "<h4 class='alert alert-info' style='text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);'>PAGAR A: $pro[1] $pro[2] $pro[3] $pro[4]</h4>";
				echo "<div class='row' id='datoPagoProveedor'>";
	            echo "   <div class='col-md-2'>
	            			<label>Valor del Salario/pago</label>
	            			<input type='text' class='form form-control' id='VALOR_PAGO' name='$pro[0]' value='$pro[8]' onchange='actualizarProveedor(this.name,this.id,this.value)'>
	            		 </div>";
	            echo "   <div class='col-md-3'>
	            			<label>Fecha para el pago</label>
	            			<input type='date' class='form form-control' id='FECHA_PAGO' name='$pro[0]' value='".date('Y-m-d')."'>
	            		 </div>";
	            /*echo "   <div class='col-md-2'>
	            			<label>Recibo </label>
	            			<input type='text' class='form form-control' id='$pro[0]' name='recibo' value=''>
	            		 </div>";*/
	           
	            echo "   <div class='col-md-2'>";
	            echo "        <br><button class='btn btn-primary' id='$pro[0]' style='width: 100%;' onclick='agregarPagoProveedor(this.id)'>";
            	echo "            <i class='fa fa-plus'> </i> Agregar Pago";
            	echo "        </button> "; 
	            echo	 "</div>"; 
	            echo "   <div class='col-md-2'>";
	            echo "        <br><button class='btn btn-warning' style='width: 100%;' onclick='cargarListaProveedors()'>";
            	echo "            <i class='fa fa-plus'> </i> Regresar";
            	echo "        </button> "; 			
	            echo "	 </div>";
	            echo "</div>";
	            
	            echo "<div class='row'>";
	            echo "   <div class='col-md-12' id='listaPagos'>";
							$this->cargarListaPagos($idProveedor);
	            echo "   </div>";
	            echo "</div>";
			} 
		}

		function cargarEditarPago($idProveedor,$idPago){		
			$sqlBuscar=mysql_query("SELECT * FROM pagos WHERE `ID_EMPLEADO` = '$idProveedor' AND recibo='$idPago';");
			//echo "<script>alertify.success('Llego el dato del proveedor al modelo id: $idProveedor; hasta aquí no sé que pasa si sigue mostrando el listado');</script>";
			while($pro=mysql_fetch_array($sqlBuscar)){	
				
	            echo "   <div class='col-md-2'>
	            			<label>Valor del Salario/pago</label>
	            			<input type='text' class='form form-control' id='VALOR_PAGO' name='$pro[1]' value='$pro[1]' onchange='actualizarProveedor(this.name,this.id,this.value)'>
	            		 </div>";
	            echo "   <div class='col-md-3'>
	            			<label>Fecha para el pago</label>
	            			<input type='date' class='form form-control' id='FECHA_PAGO' name='$pro[2]' value='$pro[2]'>
	            		 </div>";
	            /*echo "   <div class='col-md-2'>
	            			<label>Recibo </label>
	            			<input type='text' class='form form-control' id='$pro[0]' name='recibo' value=''>
	            		 </div>";*/
	           
	            echo "   <div class='col-md-2'>";
	            echo "        <br><button class='btn btn-success' id='$idPago' name='$idProveedor' style='width: 100%;' onclick='modificarPagoProveedor(this.id,this.name)'>";
            	echo "            <i class='fa fa-check'> </i> Listo";
            	echo "        </button> "; 
	            echo	 "</div>"; 
	            echo "   <div class='col-md-2'>";
	            echo "        <br><button class='btn btn-warning' id='$pro[0]' style='width: 100%;' onclick='cargarPagos(this.id)'>";
            	echo "            <i class='fa fa-repeat'> </i> Cancelar";
            	echo "        </button> "; 			
	            echo "	 </div>";
			} 
		}

		function cargarListaPagos($idProveedor){

			$sqlEmp=mysql_query("SELECT fc.factura,fc.factRegistro,fc.TOTAL,SUM(ap.Valor_Abono)AS 'Total Abonos al crédito',(fc.TOTAL-SUM(ap.Valor_Abono)) AS 'Saldo',fc.tipo FROM facturasc fc LEFT JOIN abonosproveedores ap ON ap.idCompra=fc.FACTURA WHERE fc.idProveedor='$idProveedor' GROUP BY fc.FACTURA;");
			echo "<div class='panel panel-default>";
			echo 	"<div class='panel-heading'>";
			$sqlProveedor=mysql_query("SELECT nombre FROM proveedores WHERE idProveedor='$idProveedor'");
            while($pr=mysql_fetch_array($sqlProveedor)){
                echo "<h4 class='alert alert-info' style='text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);'>LISTA DE PAGOS REALIZADOS AL PROVEEDOR: $pr[0]</h4>"; 
            }
			echo 	"</div>";
            echo 	"<div class='panel-body'>";   
            echo "<button class='btn btn-warning' onclick='cargarListaProveedores()'><i class='fa fa-repeat'> </i> Regresar</button>";            
	        echo "<table class='table table-striped'>";
	            echo "<thead>";
	                echo "<tr>";
	                    echo "<th>id Proveedor</th>";
	                    echo "<th>Factura</th>";
	                    echo "<th style='text-align:right;'>Total Factura</th>";
	                    echo "<th style='text-align:right;'>Total Abonos <br>al crédito</th>";
	                    echo "<th style='text-align:right;'>Saldo por Pagar</th>";
	                echo "</tr>";
	            echo "</thead>";
	            echo "<tbody>";
	            $rsp=mysql_num_rows($sqlEmp);
	            if($rsp>0){
    	            while($pro=mysql_fetch_array($sqlEmp)){
    	                echo "<tr style='font-size:10px;padding:0px;'>";
    	                    echo "<td style='padding:2px;'>$idProveedor</td>";
    	                    echo "<td style='padding:2px;'>$pro[1]</td>";
    	                    echo "<td style='text-align:right;padding:2px;'>$ ".number_format($pro[2], 0, ',', '.')."</td>";
    	                    if($pro[3]==null){
    	                    	echo "<td style='text-align:right;padding:2px;'>$ 0</td>";
    	                    }else{
    	                    	echo "<td style='text-align:right;padding:2px;'>$ ".number_format($pro[3], 0, ',', '.')."</td>";
    	                    }

    	                    if($pro[4]==null){
    	                    	if($pro[5]=="Credito"){
    	                    		echo "<td style='text-align:right;padding:2px;background-color:#FB6C73;'>$ ".number_format($pro[2], 0, ',', '.')."</td>";
    	                    	}else{
    	                    	   	echo "<td style='text-align:right;padding:2px;background-color:#FB6C73;'>$ ".number_format(0, 0, ',', '.')."</td>";
    	                    	}
    	                    }else{
    	                    	if($pro[4]>0){
    	                    		echo "<td style='text-align:right;padding:2px;background-color:#FB6C73;'>$ ".number_format($pro[4], 0, ',', '.')."</td>";
    	                    	}else{
    	                    		echo "<td style='text-align:right;padding:2px;background-color:#59CE59'>$ ".number_format($pro[4], 0, ',', '.')."</td>";
    	                    	}
    	                    	
    	                    }  
    	                    //echo "<td><button id='$pro[0]' name='$pro[3]' class='btn btn-success' title='Editar Pago' onclick='cargarEditarPago(this.id,this.name)'><i class='fa fa-pencil-square'> </i></button></td>";
    	                    //echo "<td><button id='$pro[3]' name='$pro[0]'class='btn btn-danger' title='Eliminar Pago' onclick='eliminarPagoProveedor(this.id,this.name)'><i class='fa fa-trash'> </i></button></td>";
    	                    
    	                echo "</tr>";                                
    	            }       
	           	}else{
	           		echo "<tr>";
					echo 	"<td colspan='6' style='text-align:center;'>";
					echo 		"<div class='alert alert-warning' >No existen pagos relacionados al proveedor hasta el momento en la base de datos</div>";
					echo 	"</td>";
					echo "</tr>";
	           	}                         
	            echo "</tbody>";
	        echo "</table>";
	        echo 	"</div'>";
	        echo 	"</div'>";
		}

		public function agregarPago($idProveedor,$valor,$fecha){
			$sqlPagar=mysql_query("INSERT INTO pagos(`ID_EMPLEADO`,`VALOR_PAGO`,`FECHA_PAGO`) VALUES('$idProveedor','$valor','$fecha');");
			echo "<script>alertify.success('Se agregó el pago con éxito'); </script>";
			$this->cargarListaPagos($idProveedor);
		}

		public function eliminarPago($idPago,$idProveedor){
			$sqlPagar=mysql_query("DELETE FROM pagos WHERE `ID_EMPLEADO`='$idProveedor' AND `recibo`= $idPago;");
			echo "<script>alertify.success('Se eliminó el pago con éxito'); </script>";
			$this->cargarListaPagos($idProveedor);
		}

		public function modificarPago($idPago,$idProveedor,$valor,$fecha){
			$sqlPagar=mysql_query("UPDATE pagos SET `VALOR_PAGO`='$valor', `FECHA_PAGO`='$fecha' WHERE `ID_EMPLEADO`='$idProveedor' AND `recibo`= $idPago;");
			echo "<script>alertify.success('Se agregó el pago con éxito'); </script>";
			$this->cargarListaPagos($idProveedor);
		}

	}

?>