
 <h2>MODULO DE VENTAS</h2>
 <hr>
 <div id='Contenedor' class='container'>       
        <div class="panel panel-">
            <div class="panel-heading "><h4>Datos Iniciales de la Factura</h4></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Factura No.</label>
                        <input type="text" class='form-control' name="" id="" readonly>
                    </div>
                    <div class="col-md-3">
                       <label>Fecha:</label>
                       <input type='date' class='form-control' value='<?php echo date("Y-m-d") ?>' id='fechaFactura'/>
                    </div>
                    <div class="col-md-5">
                       <label>Elija el cliente</label>
                       <div class="mb-3">
                            <select class="form-select" id="single-select-field" data-placeholder="Choose one thing">
                                <option></option>
                                <option>Reactive</option>
                                <option>Solution</option>
                                <option>Conglomeration</option>
                                <option>Algoritm</option>
                                <option>Holistic</option>
                            </select>
                        </div>
                       <?php
                            /*    $sqlCliente=new Cliente();
                                $resultSQL=$sqlCliente->Buscar();
                            

                            echo "<input type='text' id='cargaClientes' value='' class='form-control' list='listaClientes' onFocus='limpiar(this.id)' onkeyup='buscar()' onchange='buscar()'>";
                            echo "<datalist id='listaClientes'>";
                            echo "<option value=''>Seleccione...";
                                while ($fila=mysql_fetch_array($resultSQL)){
                                    echo "<option value='".$fila[0]."'>".$fila[1];
                                }
                            echo "</datalist>";/** */
                        ?>                 
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <h4>Datos Básicos del cliente </h4>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <label for="id" class="col-form-label">No. Documento</label>
                    <input type="text" value="1" name="id" class="form-control" id="id" onFocus='limpiar(this.id)'>
                </div>
                <div class="col-sm-3">
                    <label for="name" class="col-form-label">Nombre</label>
                    <input type="text" value="CLIENTE POR MOSTRADOR" name="name" class="form-control" id="name" onFocus='limpiar(this.id)'>
                </div>
                <div class="col-sm-3">
                    <label for="phone" class="col-form-label">Teléfono</label>
                    <input type="text" value="" name="phone" class="form-control" id="phone"  onFocus='limpiar(this.id)'>
                </div>
                <div class="col-sm-3">
                    <label for="email" class="col-form-label">Correo</label>
                    <input type="email" value="" name="email" class="form-control" id="email"  onFocus='limpiar(this.id)'>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="address" class="col-form-label">Dirección</label>
                    <input type="text" value="" name="address" class="form-control" id="address" onFocus='limpiar(this.id)'>
                </div>
                <div class="col-sm-6">
                    <label for="city" class="col-form-label">Ciudad</label>
                    <input type="text" value="EL CARMEN DE BOLIVAR" name="city" class="form-control" id="city" onFocus='limpiar(this.id)'>
                </div>
            </div>
        <div class="panel panel-">
           <div class="panel-heading "><h4>Datos relacionados con el movimiento</h4></div>
            <div class="panel-body">
                <div class='row'>   
                <div class='col-md-2'>
                    <label>Tipo de ventas: </label>
						<select id='tipoVenta' class='col-md-2 form-control'>
							<option value='contado'>Contado</option>
							<option value='credito'>Cr&eacute;dito</option>
						</select> 
                </div>
				<div class='col-md-2'>
                    <label>Forma de pago: </label>
						<select id='tipoPago' class='col-md-2 form-control'>
							<option value='Efectivo'>Efectivo</option>
							<option value='Cheque'>Cheque</option>
							<option value='Tarjeta'>Tarjeta</option>
							<option value='otra'>Otra...</option>
						</select>				
				</div>
                <div class="col-md-2">	
                    <div class="row">
                                                            
				        <?php
                        /*
                            if($modulo=='VENTA'){
                               echo "<div class='col-md-10'><label>Producto:</label>";
                                //-----------CONSULTA PARA EL INVENTARIO.-------------------------------------------->
                                $sqlInv=new Inventario();
                                $resultInv=$sqlInv->Productos();

                                echo "<input type='text' value='' name='cbo_producto' id='cbo_producto' class='col-md-2 form-control' list='listadeProductos' onchange='buscarProd()' ondblclick='limpiar(this.id)' onkeypress='pasarAcantidad(event)'>";
                                echo "<datalist id='listadeProductos'>";
                                while ($row=mysql_fetch_array($resultInv)){
                                    echo "<option value='".$row[0]."'> - ".$row[1]." - ".$row[2];
                                }
                                echo "</datalist>";
                                echo "</div>"; 
                            }elseif($modulo=='COMPRA'){
                                
                                echo "<div class='col-md-10'>
                                        <label>Cód. Producto:</label>";
                                //-----------CONSULTA PARA EL INVENTARIO.-------------------------------------------->
                                echo "<input type='text' value='' id='cbo_producto' class='form-control' onkeyup='buscarProd()' ondblclick='limpiar(this.id)' onkeypress='pasarAcantidad(event)'/>";
                                echo "</div>";
                            }   */                         
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
                      <input id="txt_cantidad" name="txt_cantidad" type="text" class="col-md-2 form-control" placeholder="Ingrese cantidad" autocomplete="off" ondblclick='limpiar(this.id)'/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div style="margin-top: 19px;">
                    <span id='resultadoVerificacion'>
                        <input type="hidden" class="for-control" id="registrado" value='' >
                    </span>
                    <button type='button' class='btn btn-success btn-agregar-producto' id='VENTAS' onclick="AgregarAR(this.id)"><i class='fa fa-list-ul'></i> Agregar a la lista</button>
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
        <div class="panel panel-" style="width:99%;">
            <div class="panel-heading">LISTADO PREVIO DE ARTICULOS PARA LA VENTA </div>
               <div class="panel-body detalle-producto" id="listadoDeArticulos">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Producto</th>
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
                    <input type='button' id='Bingresar' value='INGRESAR VENTAS' style='top:10px;left:10px;cursor:pointer;margin:0px auto;' class='btn btn-info' onclick='facturar()'>
        </div>
                </div>      
                
        <footer id='apoyo'>
        
        </footer>
    </div> 
    <div id="contenidoImprimir">
        
    </div>               
</div>
<!--CDN Select2 - usa jquery -->
      <!-- Styles -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
      <!-- Or for RTL support -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

      <!-- Scripts -->
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $( '#single-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
} );
</script>