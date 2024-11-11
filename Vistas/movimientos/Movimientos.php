<style type="text/css">
    .facturaImp{
        display: none;
    }
    @media print
    {
        body * { visibility: hidden; }
        #capaPagina{ visibility: hidden}
        #facturaImprimir * { visibility: visible; }
        #facturaImprimir { position: absolute; top: 10px; left: 0px;height: auto; width: 90%;}   
        
        .facturaImp{
            display: block;
            visibility:visible;
        }
    }

    .precioProd{
        padding: 2px;
        margin: 0px;
        text-align: right;
        border: 0px;
    }
    .cantProd{
        padding: 2px;
        margin: 0px;
        text-align: center;
        border: 0px;
        width: 50px;
    }
</style>
<?php
	require("Conexiones/Conect.php");
	$modulo=$_POST['modulo'];
	$persona;
	$resultSQL;
    $color1=0;
    $color2=0;
    $color3=0;
    $fondo1;
    $fondo2;
    $f=new FacturaSiguiente();
	if ($modulo=='VENTA'){
		$persona='CLIENTE';
        $color1='info';
        $color2='primary';
        $fondo1="fondoTitulo1";
        $fondo2="fondoTitulo2";
	}else if($modulo=='COMPRA'){
		$persona='PROVEEDOR';
        $color1='primary';
        $color2='info';
        $fondo1="fondoTitulo2";
        $fondo2="fondoTitulo1";
	}

    echo "<input type='hidden' value='$modulo' id='Modulo'/>";
 ?>
 <div id="contFactura"><?php  $fs=$f->real($modulo); ?></div>
 <h2 style="text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);">MODULO DE <?php echo $modulo; ?>S</h2>
 <div id='Contenedor' class='container' style="width: 95%;">       
        <div class="panel panel-<?php echo $color1; ?> clase3">
            <div class="panel-heading clase3 <?php echo $fondo1; ?>"><h4>Datos Iniciales de la Factura</h4></div>
            <div class="panel-body clase3">
                <div class="row">
                    <div class="col-md-4">
                        <label>Factura No.</label>
                        <div id='factSig'><?php $fs=$f->mascara($modulo); ?></div>
                    </div>
                    <div class="col-md-3">
                       <label>Fecha:</label>
                       <input type='date' class='form-control clase3' value='<?php echo date("Y-m-d") ?>' id='fechaFactura'/>
                    </div>
                    <div class="col-md-5">
                       <label><?php echo "Elija el $persona:"; ?></label>
                       <?php
                            if($persona=="CLIENTE"){
                                $sqlCliente=new Cliente();
                                $resultSQL=$sqlCliente->Buscar();
                            }elseif ($persona=="PROVEEDOR"){
                                $sqlProv=new Proveedor();
                                $resultSQL=$sqlProv->Buscar();
                            }

                            echo "<input type='text' id='cargaClientes' value='' class='form-control clase3' list='listaClientes' onFocus='limpiar(this.id)' onkeyup='buscar()' onchange='buscar()'>";
                            echo "<datalist id='listaClientes'>";
                            echo "<option value=''>Seleccione...";
                                while ($fila=mysql_fetch_array($resultSQL)){
                                    echo "<option value='".$fila[0]."'>".$fila[1];
                                }
                            echo "</datalist>";
                        ?>                 
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-<?php echo $color1; ?> clase3">
            <div class="panel-heading clase3 <?php echo $fondo1; ?>"><h4>Datos Básicos del 
                <?php
                    if($modulo=='VENTA'){
                        echo "Cliente";
                        $idCampo = "Cliente";
                    }elseif($modulo=='COMPRA'){
                        echo "Proveedor";
                        $idCampo = "Proveedor";
                    }
                ?>
                </h4>
            </div>
            <div class="panel-body clase3" id="datosCliente">
               <table class="table">
                   <tr>
                       <td><label>No. Documento</label><input type="text" class="form-control clase3" id="id<?php echo $idCampo ?>" value="1" onFocus='limpiar(this.id)'></td>
                       <td colspan="2"><label>Nombre</label><input type="text" class="form-control clase3" id="Nombre" value="<?php 
                           if($modulo=='VENTA'){
                               echo "CLIENTE POR MOSTRADOR"; 
                           }elseif($modulo=='COMPRA'){
                               echo "Proveedor por Mostrador"; 
                           }
                        ?>" onFocus='limpiar(this.id)'></td>
                       <td><label for="">Teléfono</label><input type="text" class="col-md-2 form-control clase3" id="TEL" onFocus='limpiar(this.id)'></td>
                       <td colspan="2"><label>Correo</label><input type="text" class="col-md-2 form-control clase3" id="correo" onFocus='limpiar(this.id)'></td>
                   </tr>
                   <tr>
                        <td><label>Dirección</label><input type="text" class="col-md-2 form-control clase3" id="Dir" onFocus='limpiar(this.id)'></td>
                        <td>
                            <label>Ciudad</label>
                            <input type="text" class="col-md-2 form-control clase3" id="Ciudad" value="EL CARMEN DE BOLIVAR" onFocus='limpiar(this.id)'>
                        </td>
                       <td colspan="5"></td>
                   </tr>
               </table>      
            </div>
        <div class="panel panel-<?php echo $color1; ?> clase3">
           <div class="panel-heading clase3 <?php echo $fondo1; ?>"><h4>Datos relacionados con el movimiento</h4></div>
            <div class="panel-body clase3">
                <div class='row'>   
                <div class='col-md-2'>
                    <label>Tipo de <?php echo  $modulo; ?>: </label>
						<select id='tipoVenta' class='col-md-2 form-control clase3'>
							<option value='contado'>Contado</option>
							<option value='credito'>Cr&eacute;dito</option>
						</select> 
                </div>
				<div class='col-md-2'>
                    <label>Forma de pago: </label>
						<select id='tipoPago' class='col-md-2 form-control clase3'>
							<option value='Efectivo'>Efectivo</option>
							<option value='Cheque'>Cheque</option>
							<option value='Tarjeta'>Tarjeta</option>
							<option value='otra'>Otra...</option>
						</select>				
				</div>
                <div class="col-md-2">	
                    <div class="row">
                                                            
				        <?php
                            if($modulo=='VENTA'){
                               echo "<div class='col-md-10'><label>Product:</label>";
                                //-----------CONSULTA PARA EL INVENTARIO.-------------------------------------------->
                                $sqlInv=new Inventario();
                                $resultInv=$sqlInv->Products();

                                echo "<input type='text' value='' name='cbo_product' id='cbo_product' class='col-md-2 form-control clase3' list='listadeProducts' onchange='buscarProd()' ondblclick='limpiar(this.id)' onkeypress='pasarAcantidad(event)'>";
                                echo "<datalist id='listadeProducts'>";
                                while ($row=mysql_fetch_array($resultInv)){
                                    echo "<option value='".$row[0]."'> - ".$row[1]." - ".$row[2];
                                }
                                echo "</datalist>";
                                echo "</div>"; 
                            }elseif($modulo=='COMPRA'){
                                
                                echo "<div class='col-md-10'>
                                        <label>Cód. Product:</label>";
                                //-----------CONSULTA PARA EL INVENTARIO.-------------------------------------------->
                                echo "<input type='text' value='' id='cbo_product' class='form-control' onkeyup='buscarProd()' ondblclick='limpiar(this.id)' onkeypress='pasarAcantidad(event)'/>";
                                echo "</div>";
                            }                            
                        ?>
                        
                    </div>    
                </div>
                <div class="col-md-1" style="margin: 0px;">
                    <label for="">Editar</label>
                    <span id='btnEditar'>
                        <button class='btn btn-primary' type='button' onclick='editarArticuloEnMovimiento()'><i class='fa fa-pencil'></i></button>
                    </span>
                </div>
                <div class="col-md-2">
                    <div><label>Cantidad:</label>
                      <input id="txt_cantidad" name="txt_cantidad" type="text" class="col-md-2 form-control clase3" placeholder="Ingrese cantidad" autocomplete="off" ondblclick='limpiar(this.id)'/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div style="margin-top: 19px;">
                    <span id='resultadoVerificacion'>
                        <input type="hidden" class="for-control" id="registrado" value='' >
                    </span>
                    <button type='button' class='btn btn-success btn-agregar-product' id='<?php echo $modulo ?>' onclick="AgregarAR(this.id)"><i class='fa fa-list-ul'></i> Agregar a la lista</button>
                    </div>
                </div>
		    </div>
           <div class="row">
               <div class="col-md-12">
                   <span id='verificacionArticulo' style='text-align:center;'></span>
               </div>
           </div>
            </div>
        </div>
        <div class='jumbotron' style="padding: 5px;text-align: center;margin: 2px;"> 
        <div class="panel panel-<?php echo $color2; ?>" style="width:99%;">
            <div class="panel-heading <?php echo $fondo2; ?>">LISTADO PREVIO DE ARTICULOS PARA LA <?php echo $modulo ?> </div>
               <div class="panel-body detalle-product" id="listadoDeArticulos">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Product</th>
                                <th style="text-align: center;">Cant</th>
                                <th style="text-align: right;">Precio</th>
                                <th style="text-align: right;">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <td><div id='totalFactura'></div></td>
                        </tfoot>
                    </table>
                </div>
                
                <div class="panel-footer">
                    <input type='button' id='Bingresar' value='INGRESAR<?php echo " ".$modulo?>' style='top:10px;left:10px;cursor:pointer;margin:0px auto;' class='btn btn-info' onclick='facturar()'>
        </div>
                </div>      
                
        <footer id='apoyo'>
        
        </footer>
    </div> 
    <div id="contenidoImprimir">
        
    </div>               
</div>