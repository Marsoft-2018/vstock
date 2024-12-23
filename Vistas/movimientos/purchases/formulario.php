<div>
    <h2>MODULO DE COMPRAS</h2>
    <hr>
    <form id="formPurchaseInvoice" method="post" onsubmit="return preparePurchaseInvoice(event,'<?php echo $data['bussines_id']; ?>','<?php echo $accion; ?>')">
        <div id='Contenedor' class='container'>       
            <div class="panel panel-">
                <div class="panel-heading ">
                    <h4>Datos Iniciales de la Factura</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Factura No.</label>
                            <div class="input-group mb-3">
                                <input type="text" class='form-control' name="id" id="id" value="<?php echo $objInvoice->maxId(); ?>">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2"  data-bs-toggle="modal" data-bs-target=".exampleModalCenter" onclick="findInvoice('purchase','<?php echo $bussines_id; ?>','modalBody')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Fecha:</label>
                            <input type='date' class='form-control' value='<?php echo date("Y-m-d") ?>' name='date_at' id='date_at'/>
                        </div>
                        <div class="col-md-5">
                            <label>Elija el proveedor</label>
                            <div class="input-group mb-3">
                                <input type='text' value='' name='supplierSelect' id='supplierSelect' class='col-md-2 form-control' list='suppliersList' ondblclick='limpiar(this.id)' onchange="loadSupplierData()">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2"  data-bs-toggle="modal" data-bs-target=".exampleModalCenter" onclick="loadSupplierData()"><i class="fa fa-search"></i></button>
                            
                                <datalist id='suppliersList' style="width: 100%">
                                    <?php
                                        foreach ($objSupplier->list() as $supplier) {
                                    ?>
                                        <option value="<?php echo $supplier['id'] ?>"> <?php echo $supplier['name'] ?>
                                    <?php
                                        }
                                    ?>
                                </datalist>
                            </div>                                  
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <h4>Datos Básicos del Proveedor </h4>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="id" class="col-form-label">No. Documento</label>
                        <input type="text" value="1" name="supplier_id" class="form-control" id="supplier_id" onFocus='limpiar(this.id)'>
                    </div>
                    <div class="col-sm-3">
                        <label for="name" class="col-form-label">Nombre</label>
                        <input type="text" value="Proveedor default" name="name" class="form-control" id="name" onFocus='limpiar(this.id)'>
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
            </div>
            <div class="panel panel-">
                <div class="panel-heading ">
                    <h4>Datos relacionados con el movimiento</h4>
                </div>
                <div class="panel-body">
                    <div class='row'>   
                        <div class='col-md-2'>
                            <label>Tipo de ventas: </label>
                                <select name='type' id='tipoVenta' class='col-md-2 form-control' onchange="loadPayForm(this.value)">
                                    <option value='contado'>Contado</option>
                                    <option value='credito'>Cr&eacute;dito</option>
                                </select> 
                        </div>
                        <div class='col-md-2'>
                            <label>Forma de pago: </label>
                                <select name="form_pay" id='tipoPago' class='form form-control'>
                                    <option value='Efectivo'>Efectivo</option>
                                    <option value='Cheque'>Cheque</option>
                                    <option value='Tarjeta'>Tarjeta</option>
                                    <option value='otra'>Otra...</option>
                                </select>				
                        </div>
                        <div class="col-md-2">	
                            <div class="row">
                                <label for="cbo_product">Buscar product</label>
                                <input type='text' value='' name='productSelect' id='productSelect' class='col-md-2 form-control' list='listProduct' onchange='quantityStock(<?php echo $bussines_id; ?>)' oninput="findProduct(this.value,<?php echo $bussines_id; ?>,'listProduct')"  ondblclick='limpiar(this.id)' onkeypress='pasarAcantidad(event)'>
                                <datalist id='listProduct'>
                                    <?php
                                        $objProduct = new Product();
                                        $objProduct->bussines_id = $bussines_id;
                                        $objProduct->text = "";
                                        foreach ($objProduct->find() as $product) {
                                    ?>
                                        <option value="<?php echo $product['id'] ?>"> <?php echo $product['name'] ?>
                                    <?php
                                        }
                                    ?>
                                </datalist>
                            </div>    
                        </div>
                        <div class="col-md-1" style="margin: 0px;" id="divNewProduct">
                            <label for="">Nuevo</label>
                            <span>
                                <button  style="margin: 0px;"  class='btn btn-primary' type='button' aria-current="page" href="#" data-bs-toggle="modal" data-bs-target=".exampleModalCenter" onclick="newProduct('<?php echo $data['bussines_id']; ?>','purchase')">
                                    <i class='fa fa-plus'></i>
                                </button>
                            </span>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <label>Cantidad:</label>
                                <input id="productQuantity" name="productQuantity" type="number" step="any" value="1" class="col-md-2 form-control" placeholder="Ingrese cantidad" autocomplete="off" ondblclick='limpiar(this.id)'/>
                            </div>
                        </div>
                        <div class="col mt-4">
                            <button style="margin: 0px;" type='button' class='btn btn-success btn-agregar-product' id='btnSelectedProduct' onclick="addSelectedProduct('purchase')">
                                <i class='fa fa-list-ul'></i> Agregar a la lista
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span id='verificacionArticulo' style='text-align:center;'></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <hr>
                    <h5 >LISTA DE ARTICULOS AGREGADOS</h5>
                <hr>
                <div id="listadoDeArticulos">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Producto</th>
                                <th style="text-align: center;">Cantidad</th>
                                <th style="text-align: right;">Precio</th>
                                <th style="text-align: right;">Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cartBody">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <td colspan="4">TOTAL</td>
                            <td style="text-align: right;"><div id='total-price'></div></td>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer">
                    <button class='btn btn-primary'  id='Bingresar' type="submit" >FINALIZAR COMPRA</button>
                </div>
            </div>
        </div>
    </div>      
    </form> 
</div>      

<?php 
    $modulo = 'purchase';
    include("../Vistas/movimientos/editPrice.php");
?>   
<div class="modal fade exampleModalCenter" id="exampleModalCenter2" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="exampleModalCenterTitle"></h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalBody">
        
        </div>
    </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#supplier_id').select2();
    });
</script>

