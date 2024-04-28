<?php
	require('../Conexiones/Conect.php');
	class devolucion extends conectar{
		function facturas($modulo){
			if($modulo=='devolucionCompra'){
				echo "<option value=''>Seleccione...</option>";
				$sql=mysql_query("SELECT FACTURA,factRegistro FROM facturasc ORDER BY factRegistro");
				while($ft=mysql_fetch_array($sql)){
					echo "<option value='$ft[0]'>$ft[1]</option>";
				}
				/*
					$sql=mysql_query("SELECT FACTURA,factRegistro FROM facturasc");
                    echo "<datalist id='listadeProductos'>";
                    while ($row=mysql_fetch_array($sql)){
                      echo "<option value='".$row[0]."'> )- ".$row[1];
                    }
                    echo "</datalist>";*/


			}

			if($modulo=='devolucionVenta'){
				echo "<option value=''>Seleccione...</option>";
				$sql=mysql_query("SELECT FACTURA FROM facturasv");
				while($ft=mysql_fetch_array($sql)){
					echo "<option value='$ft[0]'>$ft[0]</option>";
				}
			}
		}

		function datosPersona($tabla,$idFactura){
			$sql='';
	        $persona;
	        $descuento=0;
	        if($tabla=='devolucionVenta'){	 
	            $datosPersona=mysql_query("SELECT cl.* FROM clientes cl INNER JOIN facturasv fv ON fv.idCliente=cl.idCliente WHERE fv.FACTURA='$idFactura';");
	            $persona="Cliente";
	        }else{	            
	            $datosPersona=mysql_query("SELECT pr.* FROM proveedores pr INNER JOIN facturasc fc ON fc.idProveedor=pr.idProveedor WHERE fc.FACTURA='$idFactura';");
	            $persona="Proveedor";
	        }

	        
	        
	        echo "<div>";
	        echo    "<table class='table table-striped table-hover dataTable no-footer'>";
	        while($dt=mysql_fetch_array($datosPersona)){
	            echo    "<tr>";
	            echo        "<td><label>Id. $persona</label><br>$dt[0]</td>";
	            echo        "<td><label>Nombre</label><br>$dt[1]</td>";
	            echo        "<td><label>Teléfono</label><br>$dt[3]</td>";
	            echo        "<td><label>Dirección</label><br>$dt[2]</td>";
	            echo        "<td><label>Correo</label><br>$dt[5]</td>";
	            echo    "</tr>";            
	        }        
	        echo    "</table>";        
	        echo "</div>";
		}

		function detallesFacturas($tabla,$idFactura){
			if($tabla=='devolucionVenta'){	 
	            $sqlDetalle=mysql_query("SELECT * FROM facturasventasdes WHERE FACTURA='$idFactura';");
	        }else{	            
	            $sqlDetalle=mysql_query("SELECT * FROM facturascomprasdes WHERE FACTURA='$idFactura';");	            
	        }

			

			while ($df=mysql_fetch_array($sqlDetalle)) {
				echo "<tr style='font-size:12px;text-align: center;'>";
                echo    "<td  style='text-align: center;'>$df[1]</th>";
                echo 	"<td  style='text-align: left;'>$df[2]</td>";
                echo 	"<td  style='text-align: center;'>$df[3]</td>";
                echo 	"<td style='text-align: right;'>$ ".number_format($df[4],0,',','.')."</td>";
                echo 	"<td  style='text-align: right;'>$ ".number_format($df[5],0,',','.')."</td>";
                echo 	"<td  style='text-align: center;padding:1px;'>";
                echo 		"<button class='btn btn-warning' id='$df[1]' value='$df[3]' name='$df[6]' title='Devolución del articulo' onclick='ventanaDevolucion(this.id,this.value,this.name)'>";
                echo  			"<i class='fa fa-sign-out'> </i>";
            	echo		"</button>";
                echo	"</td>";
                echo 	"<td  style='text-align: center;padding:1px;'>";
               /* echo 		"<button class='btn btn-info' id='$df[1]' onclick='ventanaCambiarArticulos(this.id)' title='Cambio del articulo'>";
                echo 			"<i class='fa fa-refresh'> </i>";
                echo 		"</button>"; */
                echo 	"</td>";
                echo "</tr>";
			}

		}

		function ingresarDevolucion($tabla,$factura,$producto,$cantidad,$fecha,$cantidadFactura){
			echo "<div class='alert alert-info alert-dismissable'>";
            echo 	"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
            echo 	"Se realizó el registro de la devolucion del Producto: $producto, Cantidad: $cantidad, Fecha: $fecha";
            echo "</div>";
			
			$subTotal=0;
			$ventas=0;
			$compras=0;
			$devoluciones=0;
			$cantFinal=0;
			$sqlInventario=mysql_query("SELECT VENTAS,COMPRAS,DEVOLUCIONES,CANT_FINAL FROM inventario WHERE ID_Prod='$producto';");
			while($i=mysql_fetch_array($sqlInventario)){
				$ventas=$i[0];
				$compras=$i[1];
				$devoluciones=$i[2];
				$cantFinal=$i[3];
			}

			if($tabla=='devolucionVenta'){	 
	            $sqlInsertar=mysql_query("INSERT INTO `devolucionventas` (`idVenta`,`Cantidad`,`fecha`) VALUES('$factura','$cantidad','$fecha');");
	            $sqlDetalle=mysql_query("SELECT `ValorUnit` FROM facturasventasdes WHERE idVenta='$factura';");
	            while($pr=mysql_fetch_array($sqlDetalle)){
	            	//$subTotal=($cantidadFactura-$cantidad) * $pr[0];
	            	//$sqlActualizarDetalle=mysql_query("UPDATE facturasventasdes SET CANT='".($cantidadFactura-$cantidad)."', subTotal='$subTotal' WHERE idVenta='$factura' AND id_prod='$producto';");

            		$sqlActualizarInventario=mysql_query("UPDATE inventario SET VENTAS='".($ventas-$cantidad)."', DEVOLUCIONES='".($devoluciones+$cantidad)."', CANT_FINAL='".($cantFinal+$cantidad)."' WHERE ID_Prod='$producto';");
	            }           	
	        }else{	            
	            $sqlDetalle=mysql_query("SELECT `ValorUnit` FROM facturascomprasdes WHERE idCompra='$factura';");
	            $sqlInsertar=mysql_query("INSERT INTO `devolucioncompra` (`idCompra`,`Cantidad`,`fecha`) VALUES('$factura','$cantidad','$fecha');");	            
	            
	            while($pr=mysql_fetch_array($sqlDetalle)){
	            	//$subTotal=($cantidadFactura-$cantidad) * $pr[0];
	            	//$sqlActualizarDetalle=mysql_query("UPDATE facturascomprasdes SET CANT='".($cantidadFactura-$cantidad)."', subTotal='$subTotal' WHERE idCompra='$factura' AND id_prod='$producto';");

	            	$sqlActualizarInventario=mysql_query("UPDATE inventario SET COMPRAS='".($compras-$cantidad)."', DEVOLUCIONES='".($devoluciones+$cantidad)."', CANT_FINAL='".($cantFinal-$cantidad)."' WHERE ID_Prod='$producto';");
	            }	            
	        }
		}

		function ingresarCambioProducto($modulo,$factura,$productoACambiar,$productoReemplazo,$cantidad){
			echo "No funciona aun la actualizacion<br>";
			echo "<div class='alert alert-info alert-dismissable'>";
            echo 	"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
            echo "Respuesta desde el Modelo<br>";
            echo " <button class='btn btn-warning' onclick='cerrarCapa()' style='padding: 10px;margin:10px;width: 150px;'><i> Cancelar</i></button>";
            echo 	"Se realizó el registro del cambio, Tabla: ".$modulo.", Producto a cambiar: ".$productoACambiar.", Cantidad: ".$cantidad.", Factura: ".$factura.", Producto de reemplazo: ".$productoReemplazo;
            echo "</div>";
			
			
			$subTotal=0;
			$ventas=0;
			$compras=0;
			$devoluciones=0;
			$cantAnterior=0;			
			$cantFinal=0;

			if($modulo=='devolucionVenta'){	 
				$sqlProductosFacturas=mysql_query("SELECT * FROM facturasventasdes WHERE id_prod='$productoACambiar' AND  FACTURA='$factura'");
				$sqlRes=mysql_num_rows($sqlProductosFacturas);

				if($sqlRes > 0){
					while($can=mysql_fetch_array($sqlProductosFacturas)){
						$cantAnterior=$can[3];
						$cantFinal=$cantAnterior-$cantidad;
						$subtotal= $cantFinal * $can[4];
					}
					
					$sqlActualizar=mysql_query("UPDATE facturasventasdes SET CANT='$cantFinal', SubTotal='$subtotal' WHERE id_prod='$productoACambiar' AND  FACTURA='$factura'");


				}

				$sqlProductosFacturas2=mysql_query("SELECT * FROM facturasventasdes WHERE id_prod='$productoReemplazo' AND  FACTURA='$factura'");
				$sqlRes=mysql_num_rows($sqlProductosFacturas2);

				if($sqlRes > 0){
					while($can=mysql_fetch_array($sqlProductosFacturas2)){
						$cantAnterior=$can[3];
						$cantFinal=$cantAnterior+$cantidad;
						$subtotal= $cantFinal * $can[4];
					}
					$sqlActualizar=mysql_query("UPDATE facturasventasdes SET CANT='$cantFinal', SubTotal='$subtotal' WHERE id_prod='$productoReemplazo' AND  FACTURA='$factura'");
				}
			}
			/*

			$sqlInventario=mysql_query("SELECT VENTAS,COMPRAS,DEVOLUCIONES,CANT_FINAL FROM inventario WHERE ID_Prod='$producto';");

	            $sqlInsertar=mysql_query("INSERT INTO `devolucionventas` (`idVenta`,`Cantidad`,`fecha`) VALUES('$factura','$cantidad','$fecha');");
	            $sqlDetalle=mysql_query("SELECT `ValorUnit` FROM facturasventasdes WHERE idVenta='$factura';");
	            while($pr=mysql_fetch_array($sqlDetalle)){
	            	$subTotal=($cantidadFactura-$cantidad) * $pr[0];
	            	$sqlActualizarDetalle=mysql_query("UPDATE facturasventasdes SET CANT='".($cantidadFactura-$cantidad)."', subTotal='$subTotal' WHERE idVenta='$factura' AND id_prod='$producto';");

            		$sqlActualizarInventario=mysql_query("UPDATE inventario SET VENTAS='".($ventas-$cantidad)."', DEVOLUCIONES='".($devoluciones+$cantidad)."', CANT_FINAL='".($cantFinal+$cantidad)."' WHERE ID_Prod='$producto';");
	            }           	
	        }else{	            
	            $sqlDetalle=mysql_query("SELECT `ValorUnit` FROM facturascomprasdes WHERE idCompra='$factura';");
	            $sqlInsertar=mysql_query("INSERT INTO `devolucioncompra` (`idCompra`,`Cantidad`,`fecha`) VALUES('$factura','$cantidad','$fecha');");	            
	            
	            while($pr=mysql_fetch_array($sqlDetalle)){
	            	$subTotal=($cantidadFactura-$cantidad) * $pr[0];
	            	$sqlActualizarDetalle=mysql_query("UPDATE facturascomprasdes SET CANT='".($cantidadFactura-$cantidad)."', subTotal='$subTotal' WHERE idCompra='$factura' AND id_prod='$producto';");

	            	$sqlActualizarInventario=mysql_query("UPDATE inventario SET COMPRAS='".($compras-$cantidad)."', DEVOLUCIONES='".($devoluciones+$cantidad)."', CANT_FINAL='".($cantFinal-$cantidad)."' WHERE ID_Prod='$producto';");
	            }	            
	        }*/
		}

		function datosArticulo($producto){

			$sqlArti=mysql_query("SELECT `ARTICULO`,`REFERENCIA`,`PRECIO_COMPRA`,`PRECIO_VENTA` FROM inventario WHERE `ID_Prod`='$producto' AND `CANT_FINAL`<>0");
			while($ar=mysql_fetch_array($sqlArti)){
				$nombre=$ar[0];
				$referencia=$ar[1];
				$precioVenta=$ar[3];
				$precioCompra=$ar[2];
			}
			echo "<div class='alert alert-info alert-dismissable' style='margin:5px;padding:6px;'>";
            echo 	"<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
            echo 	"<h4>Datos del Articulo</h4>";
            echo 	"<p style='text-align:center;font-size:11px;'>";
            echo 		"<strong>Código:</strong> $producto, ";
            echo 		"<strong>Nombre:</strong> $nombre, ";
            echo 		"<strong>Referencia:</strong> $referencia<br>";            
            echo 	"</p>";
            echo 	"<table class='table'>";
            echo 		"<tr>";
            echo 			"<td>";
            echo 				"<strong>Precio de Venta:</strong> $ ".number_format($precioVenta, 0, ',', '.')." <br>";
            echo 			"</td>";
            echo 			"<td>";
            echo 				"<strong>Precio de Compra:</strong> $ ".number_format($precioCompra, 0, ',', '.')." <br>";
            echo 			"</td>";
            echo 		"</tr>";
            echo 	"</table>";
            echo "</div>";

		}		
	}
?>