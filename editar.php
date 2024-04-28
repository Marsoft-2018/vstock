<?php
	//Se Identifica sobre quien se realiza las acciones;
	if ($_POST['Edparte']==1){
		$ParteED='Inventario';
	}
	if ($_POST['Edparte']==2){
		$ParteED='Inventario';
	}
	if ($_POST['Edparte']==3){
		$ParteED='Usuario';
	}
	//Asigno la accion correspondiente
	if ($_POST['accion']==1){
		$accion='EDITAR';
	}
	if ($_POST['accion']==2){
		$accion='ELIMINAR';
	}
	if ($_POST['accion']==3){
		$accion='AGREGAR';
	}	
	
	//Se aigna el id a modificar
	$parteID=$_POST['Edid'];
	$idNeg=$_POST['idNeg'];
	require_once('Conexiones/Conect.php');
    $sqlInventario=new Inventario();
	
	if ($ParteED=='Inventario'){
		$consulta=$sqlInventario->editarArticulo($parteID);
	}else if($ParteED=='Empleado'){
		$consulta=mysql_query("SELECT * FROM empleados	WHERE `ID_EMPLEADO`='$parteID';");
	}else if($ParteED=='Usuario'){
		$consulta=mysql_query("SELECT * FROM user1	WHERE `Usuario`='$parteID';");
	}
    echo "<div id='Contenedor' style='width:50%;margin-left:160px;'>";     
                echo "<div class='panel panel-info clase3'>";
                    echo "<div class='panel-heading clase3'>";
                        echo "<h4>$accion REGISTRO - ($ParteED: $parteID)</h4>";
                    echo "</div>";
	/*echo "<div class='panel panel-info' id='vacciones'>";
	echo "<h2 class='ui-widget-header ui-corner-all' 
					style='margin:2px;height:25px;padding:3px;font-style:bold;text-align:center;font-size:12px;'>
					$accion REGISTRO - ($ParteED: $parteID)</h2><br>";*/
	echo "<form>";
	echo "<table align='center' style='margin:10px;width:95%;'>";
	if($accion=='EDITAR'){
		if ($ParteED=='Inventario'){
			while ($registro=mysql_fetch_array($consulta)){
				echo "
                <tr>
                 <input type='hidden' id='ideNeg' value='$registro[11]'>
				 <input type='hidden' id='ide' value='$registro[0]'>
				 <td align='left' class='celda1'><label>Código Producto</label></td>
				 <td align='left' class='celda1'>
				 	<input type='text' id='ID_Prod' required value='$registro[0]' class='form form-control' name='$registro[0]' onchange='modificarArticulo(this.id,this.name,this.value)'>
				 </td>  
				</tr>
				<tr>
				  <td align='left' class='celda1'>Nombre del Articulo</td>
				  <td align='left' class='celda1'>
				  	<input type='TEXT' id='ARTICULO' required value='$registro[1]' class='form form-control' name='$registro[0]' onchange='modificarArticulo(this.id,this.name,this.value)'>
				  </td>  
				</tr>
				<tr>
					<td align='left' class='celda1'>Referencia</td>
					<td align='left' class='celda1'>
						<input type='text' id='REFERENCIA' value='$registro[2]' class='form form-control' name='$registro[0]' onchange='modificarArticulo(this.id,this.name,this.value)'>
					</td>
				</tr>
                <tr>
                	<td align='left' class='celda1'>Categoria</td>
                    <td align='left' class='celda1'>
                        <select id='id_categoria' class='form form-control' name='$registro[0]' onchange='modificarArticulo(this.id,this.name,this.value)'>";
                        $sqlCategorias=mysql_query("select * from categorias where idNegocio = $idNeg");
                        while ($cat=mysql_fetch_array($sqlCategorias)){
                        	if($cat[1]==$registro[12]){
                        		echo "<option value='$cat[1]' selected='selected'>$cat[2]</option>";
                        	}else{
                        		echo "<option value='$cat[1]'>$cat[2]</option>";
                        	}
                            
                        }
                echo "
				</select>
                 </td>
				</tr>
                <tr>
                	<td align='left' class='celda1'>Unidad de medida</td>
                    <td align='left' class='celda1'>
                        <select id='id_medida' class='form form-control' name='$registro[0]' onchange='modificarArticulo(this.id,this.name,this.value)'>";
                        $sqlMedidas=mysql_query("select * from medidas");
                        while ($medida = mysql_fetch_array($sqlMedidas)){
                        	if($medida[2]==$registro[13]){
                        		echo "<option value='$medida[2]' selected='selected'>$medida[1]</option>";
                        	}else{
                        		echo "<option value='$medida[2]'>$medida[1]</option>";
                        	}
                            
                        }
                echo "
				</select>
                 </td>
				</tr>
				<tr>
					<td align='left' class='celda1'>Precio de Compra</td>
					<td align='left' class='celda1'>
						<input type='text' id='PRECIO_COMPRA' required value='$registro[3]' class='form form-control' name='$registro[0]' onchange='modificarArticulo(this.id,this.name,this.value)'>
					</td>
				</tr>
				<tr>
				<td align='left' class='celda1'>Precio de Venta</td>
					<td align='left' class='celda1'>
						<input type='text' id='PRECIO_VENTA' required value='$registro[4]' class='form form-control' name='$registro[0]' onchange='modificarArticulo(this.id,this.name,this.value)'>
					</td>
				</tr>
				<tr>
				<td align='left' class='celda1'>Cant. Inicial</td>
				<td align='left' class='celda1'>        	
					<input type='text' id='CANT_INICIAL' placeholder='' value='$registro[5]' class='form form-control' name='$registro[0]' onchange='modificarArticulo(this.id,this.name,this.value)'>
				</td>
				</tr>
				<tr>
					<td align='left' class='celda1'>Compras</td>
					<td align='left' class='celda1'><input type='text' id='comprasED' value='$registro[6]' class='form form-control' readonly></td></tr>
				<tr>
				<td align='left' class='celda1'>Ventas</td>
				<td align='left' class='celda1'><input type='text' id='ventasED' required value='$registro[7]' class='form form-control' readonly></td>
				</tr>
				<tr>
				<td align='left' class='celda1'>Devoluciones</td>
					<td align='left' class='celda1'><input type='text' id='devolucionesED' required value='$registro[8]' class='form form-control' readonly>
					</td>
				</tr>
				<tr>
					<td align='left' class='celda1'>Cant. Final</td>
					<td align='left' class='celda1'><input type='text' id='cantfinalED' required value='$registro[9]' class='form form-control' readonly></td>
				</tr>
				<tr>
					<td align='left' class='celda1'>Cant. Mínima</td>
					<td align='left' class='celda1'><input type='text' id='CANTIDAD_MIN' required value='$registro[10]' class='form form-control' name='$registro[0]' onchange='modificarArticulo(this.id,this.name,this.value)'></td>
				</tr>
				<tr>
					<td colspan='2' align='left' class='resaltar'>
					<br>
					<h3 class='ui-state-highlight ui-corner-all' 
							style='width:100%;text-align: left; font-size:12px;margin: 0px auto;padding:2px;'>
						<span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
						Observaciones: Algunos cambios realizados directamente sobre el inventario necesitan de especial cuidado
					</h3>
					</td>										
				</tr>
				<tr>
					<td colspan='2' align='right'>
                        
                        <br>
					</td>
					<div id='resultadoModificacionArticulo'></div>
				</tr>";
			}
		}else if($ParteED=='Empleado'){
			while ($registro=mysql_fetch_array($consulta)){
				echo "Aqui los datos del empleado a editar";
			}
		}else if($ParteED=='Usuario'){
			while ($registro=mysql_fetch_array($consulta)){
				echo "Aqui los datos del usuario a editar";
			}		
		}		
	}

	
	if($accion=='ELIMINAR'){
		if($ParteED=='Empleado'){
			while ($registro=mysql_fetch_array($consulta)){
				echo "Aqui los datos del empleado a editar";
			}
		}else if($ParteED=='Usuario'){
			while ($registro=mysql_fetch_array($consulta)){
				echo "Aqui los datos del usuario a editar";
			}		
		}		
	}
	
	if($accion=='AGREGAR'){
		if ($ParteED=='Inventario'){
			echo "
				<tr>
                 <input type='hidden' id='ideNeg' value='$idNeg'>                 
				 <td align='left' class='celda1'><label>Código Producto</label></td>
				 <td align='left' class='celda1'><input type='text' id='articuloID' required value='' class='form form-control'></td>  
				</tr>
				<tr>
				  <td align='left' class='celda1'>Nombre del Articulo</td>
				  <td align='left' class='celda1'><input type='TEXT' id='articuloED' required value='' class='form form-control'></td>  
				</tr>
				<tr><td align='left' class='celda1'>Referencia</td>
				    <td align='left' class='celda1'>
                        <input type='text' id='referenciaED' value='' class='form form-control'>
                    </td>
				</tr>
                <tr>
                	<td align='left' class='celda1'>Categoria</td>
                    <td align='left' class='celda1'>
                        <div id='registrarCategorias' class='form-group input-group'>
                            <input type='text' id='categoriaNuevoArticulo' class='form-control' list='listaCategoriasExistentes' value='' required>";
                        echo   "<span class='input-group-btn'>
                                    <buttton class ='btn btn-primary' onclick='agregarCategoriaDirecta()' title='Agregar la categoria al listado'><i class='fa fa-plus'></i>
                                    </button></span>";    
                            echo "<datalist id='listaCategoriasExistentes'>";
                            $sqlCategorias=mysql_query("select * from categorias WHERE idNegocio = $idNeg");
                            while ($cat=mysql_fetch_array($sqlCategorias)){
                                echo "<option value='$cat[1]'>$cat[2]";
                            }
                            echo "</datalist>";
                echo "</div>
                     
                 </td>
				</tr>

                <tr>
                	<td align='left' class='celda1'>Unidad de medida</td>
                    <td align='left' class='celda1'>
                        <select id='medida' class='form form-control' name='medida'>";
                        $sqlMedidas=mysql_query("select * from medidas");
                        while ($medida = mysql_fetch_array($sqlMedidas)){
                        	if($medida[2]==$registro[13]){
                        		echo "<option value='$medida[2]' selected='selected'>$medida[1]</option>";
                        	}else{
                        		echo "<option value='$medida[2]'>$medida[1]</option>";
                        	}
                            
                        }
                echo "
				</select>
                 </td>
				</tr>
				<tr>
				<td align='left' class='celda1'>Precio de Compra</td>
				<td align='left' class='celda1'><input type='text' id='preciodecompraED' required value='' class='form form-control'></td>
				</tr>
				<tr>
				<td align='left' class='celda1'>Precio de Venta</td>
				<td align='left' class='celda1'><input type='text' id='preciodeventaED' required value='' class='form form-control'></td>
				</tr>
                <tr>
					<td align='left' class='celda1'>Compras</td>
					<td align='left' class='celda1'><input type='text' id='comprasED' value='0' readonly class='form form-control'></td></tr>
				<tr>
				<td align='left' class='celda1'>Ventas</td>
				<td align='left' class='celda1'><input type='text' id='ventasED' required value='0' readonly class='form form-control'></td>
				</tr>
				<tr>
				<td align='left' class='celda1'>Devoluciones</td>
					<td align='left' class='celda1'>
                    <input type='text' id='devolucionesED' required value='0' readonly class='form form-control'>
					<input type='hidden' id='cantfinalED' required value='0' readonly class='form form-control'>
                    </td>
				</tr>
				<tr>
				<td align='left' class='celda1'>Cant. Inicial</td>
				<td align='left' class='celda1'>        	
					<input type='text' id='cantinicialED' placeholder='' value='' class='form form-control'>
				</td>
				</tr>	
				<tr>
					<td align='left' class='celda1'>Cant. Mínima</td>
					<td align='left' class='celda1'><input type='text' id='cantminimaED' required value='' class='form form-control'></td>
				</tr>			
				<tr>
					<td colspan='2' align='right'>
						<hr>
						<input id='botonMod' type='button' value='Agregar' style='width:100px;' class='btn btn-primary' onclick='modificar(2,1)'>
                        <input id='botonCan' type='button' value='Finalizar' style='width:100px;' class='btn btn-info' onclick='cancelar(".$_POST['Edparte'].")'>
						<input id='botonCan' type='button' value='Cancelar' style='width:100px;' class='btn btn-default' onclick='cancelar(".$_POST['Edparte'].")'>
                        <br>
                        <br>
                        <div id='aplicarAcciones'></div>
					</td>
				</tr>";			
		}else if($ParteED=='Empleado'){
			while ($registro=mysql_fetch_array($consulta)){
				echo "Aqui los datos del empleado a editar";
			}
		}else if($ParteED=='Usuario'){
			while ($registro=mysql_fetch_array($consulta)){
				echo "Aqui los datos del usuario a editar";
			}		
		}		
	}
   
  echo "</table>
     </form>";
echo "<br>
			<input id='botonCan' type='button' value='Salir' style='width:100px;' class='btn btn-warning' onclick='cancelar(".$_POST['Edparte'].")'>
	  <br>";
echo "</div>";

?>