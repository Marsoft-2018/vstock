<?php 
    // $id = "";
    // $name = "";
    // $address = "";
    // $phone = "";
    // $city = "";
    // $email = "";
    // $readonly =  "";
    // if($accion == "edit"){
    //     $readonly = "readonly";
    // }

    // if(isset($objCustomer)){
    //     foreach ($objCustomer->load() as $customer) {
    //         $id = $customer['id'];
    //         $name = $customer['name'];
    //         $address = $customer['address'];
    //         $phone = $customer['phone'];
    //         $city = $customer['city'];
    //         $email = $customer['email'];
    //     }
    // }
?>
<h2>MODULO DE VENTAS</h2>
<hr>
<div>
    <form id="formInvoice" method="post" onsubmit="return prepareInvoice('<?php echo $data['bussines_id']; ?>','<?php echo $accion; ?>')">
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
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2"  data-bs-toggle="modal" data-bs-target=".exampleModalCenter" onclick="findInvoice('sale','<?php echo $bussines_id; ?>','modalBody')"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Fecha:</label>
                            <input type='date' class='form-control' value='<?php echo date("Y-m-d") ?>' name='date_at' id='date_at'/>
                        </div>
                        <div class="col-md-5">
                            <label>Elija el cliente</label>
                            <div class="input-group mb-3">
                                <input type='text' value='' name='customerSelect' id='customerSelect' class='col-md-2 form-control' list='customersList' ondblclick='limpiar(this.id)' onchange="loadCustomerData()">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2"  data-bs-toggle="modal" data-bs-target=".exampleModalCenter" onclick="loadCustomerData()">
                                    <i class="fa fa-search"></i>
                                </button>
                            
                                <datalist id='customersList' style="width: 100%">
                                    <?php
                                        foreach ($objCustomer->list() as $customer) {
                                    ?>
                                        <option value="<?php echo $customer['id'] ?>"> <?php echo $customer['name'] ?>
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
                <h4>Datos Básicos del cliente </h4>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="id" class="col-form-label">No. Documento</label>
                        <input type="text" value="1" name="customer_id" class="form-control" id="customer_id" onFocus='limpiar(this.id)'>
                    </div>
                    <div class="col-sm-3">
                        <label for="name" class="col-form-label">Nombre</label>
                        <input type="text" value="Consumidor final" name="name" class="form-control" id="name" onFocus='limpiar(this.id)'>
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
                            <select name="form_pay" id='tipoPago' class='col-md-2 form-control'>
                                <option value='Efectivo'>Efectivo</option>
                                <option value='Cheque'>Cheque</option>
                                <option value='Tarjeta'>Tarjeta</option>
                                <option value='otra'>Otra...</option>
                            </select>				
                        </div>
                        <div class="col-md-3">	
                            <label for="cbo_product">Buscar producto</label>
                            <input type='text' value='' name='productSelect' id='productSelect' class='col-md-2 form-control' list='listProduct' oninput="findProduct(this.value,<?php echo $bussines_id; ?>,'listProduct')"  onchange='quantityStock(<?php echo $bussines_id; ?>)' ondblclick='limpiar(this.id)' onkeypress='pasarAcantidad(event)'>
                            <datalist id='listProduct'>
                                <?php
                                    foreach ($objProduct->list() as $product) {
                                ?>
                                    <option value="<?php echo $product['id'] ?>"> <?php echo $product['name'] ?>
                                <?php
                                    }
                                ?>
                            </datalist>
                        </div> 
                        <div class="col-md-2">
                            <label>Cantidad:</label>
                            <input id="productQuantity" name="productQuantity" type="number" step='any' value="1" class="col-md-2 form-control" placeholder="Ingrese cantidad" autocomplete="off" ondblclick='limpiar(this.id)'/>                            
                        </div>
                        <div class="col mt-3">
                            <button type='button' class='btn btn-success btn-agregar-product' id='btnSelectedProduct' onclick="addSelectedProduct('sale')"><i class='fa fa-list-ul'></i> Agregar a la lista</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span id='verificacionArticulo' style='text-align:center;'></span>
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
                    <button class='btn btn-info'  id='Bingresar' type="submit"  data-bs-toggle="modal" data-bs-target=".exampleModalCenter">INGRESAR VENTAS</button>
                </div>
            </div>            
        </div>  
    </form>             
</div>
<?php 
    $modulo = 'sale';
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
        $('#customer_id').select2();
    });
</script>

