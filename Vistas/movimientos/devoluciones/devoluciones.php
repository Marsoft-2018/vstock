<?php include('../estiloscss/estilo1.css'); ?>

  <br>  
    <div id='Contenedor' class='container'>       
        <div class="panel panel-danger clase3 some-class">
            <div class="panel-heading clase3"><h2 style="text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);">MODULO DE DEVOLUCIONES</h2></div>
            <div class="panel-body clase3" id='vacciones'>
            <div class="row">
                <div class="col-md-12">                    
                   <div class='panel panel-warning'>
                       <div class="panel-heading">
                          Opciones para la devolución
                       </div>
                       <div class="panel-body" id='listaGastos'>
                        <div class="row">
                          <div class="col-md-3">
                            <label for="">Tipo de devolución</label>
                            <select name="modulo" id="moduloDevolucion" class="form form-control" onchange="cargarFacturas(this.value)">
                                <option value="0">Seleccione..</option>
                                <option value="devolucionCompra">En Compra</option>
                                <option value="devolucionVenta">En Venta</option>
                            </select>
                          </div>
                          <div class="col-md-3" name="modulo"  >
                            <label for="">Factura</label>
                            <select class="form form-control" id="modulofacturasDevolucion">
                                <option value="0">Seleccione..</option>
                            </select>
                            <!--<input type='text' value='' name='cbo_product' id="modulofacturasDevolucion" class='form-control clase3' list='listadeProducts' onchange='cargarDatosArticulo(this.value)' ondblclick='limpiar(this.id)'> -->     

                          </div>
                          <div class="col-md-3"><br>
                            <button class="btn btn-primary" onclick='cargarDetallesFactura()'><i class='fa fa-search'> Continuar</i></button>
                          </div>
                        </div>
                           
                       </div>
                        
                    </div>
                </div>          
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading" style="color: #312536;font-weight: bold; ">DETALLES DE LA FACTURA</div>
                  <div class="panel-body">
                    <div class="dataTable_wrapper">  
                        <div id='datosPersona'>
                          
                        </div>  
                        <div id="resultadoDevolucion">
                          
                        </div>
                        <div  >                            
                        <!-- Aqui va la tabla -->
                         <table id="" class="display table table-striped table-hover dataTable no-footer" cellspacing="0" width="100%">
                            <thead>
                                <tr style="font-size:12px;text-align: center;">
                                    <th  style="text-align: center;">Código</th>
                                    <th  style="text-align: center;">Nombre del Articulo</th>
                                    <th  style="text-align: center;">Cantidad</th>
                                    <th style="text-align: right;">Precio de venta</th>
                                    <th  style="text-align: right;">Sub Total</th>
                                    <th  style="text-align: center;"></th>
                                    <th  style="text-align: center;"></th>
                                </tr>
                            </thead>     
                            <tbody id='detalleFacturas'>
                                
                            </tbody>
                            <tfoot>
                                <tr style="font-size:12px;text-align: left;background-color: rgba(49, 80, 119,0.5);color:#000;">
                                    
                                </tr>
                            </tfoot>
                        </table>
                      </div>
                  </div>                  
                </div>
              </div>
            </div>
            </div>
        </div>
    </div> 

<script>
  function cargarFacturas(modulo){
    //alertify.log("El modulo a cargar es: "+modulo);
    $("#modulofacturasDevolucion").load("Controlador/ctrlDevoluciones.php",{accion:'cargarFactura',modulo:modulo});
  }

  function cargarDetallesFactura(){
    var moduloF = document.getElementById("moduloDevolucion").value;
    var factura = document.getElementById("modulofacturasDevolucion").value;
    $("#detalleFacturas").load("Controlador/ctrlDevoluciones.php",{accion:'cargarDetalle',modulo:moduloF,factura:factura},function(){
      cargarDatosPersona(moduloF,factura);
    });    
  }

  function cargarDatosPersona(modulo,factura){
    $("#datosPersona").load("Controlador/ctrlDevoluciones.php",{accion:'cargarDatosPersona',modulo:modulo,factura:factura});
  }

  function ventanaDevolucion(product,cantidad,factura){
    var moduloF = document.getElementById("moduloDevolucion").value;
    //var factura = document.getElementById("modulofacturasDevolucion").value;
    
    swal({
      title: "Ventana Devoluciones",
              text: "",
              html: "<div class='alert alert-dimissable alert-info' style='font-size:9px;'>"+
                      "Señor usuario tenga encuenta que el proceso de devolución afecta las cantidades en el inventario y en las facturas de ventas o compras segun el caso"+
                      "</div>"+
                      "<div>"+
                      "<label>Cantidad a Devolver</label>"+
                      "<input type='number' id='cantDevuelta' value='0' class='form form-control' onchange='verificaCantidad(this.value,"+cantidad+")' onkeyup='verificaCantidad(this.value,"+cantidad+")'>"+
                      "<label>Fecha Devolucion</label>"+
                      "<input type='date' id='fechaDevolucion' value='' class='form form-control' >"+
                      "</div>",
              showCancelButton: true,
              confirmButtonColor: "#216F21",
              cancelButtonColor: "#FF0a55",
              confirmButtonText: "Aceptar",
              cancelButtonText: "Cancelar", 
              closeOnConfirm: false,
              closeOnCancel: true 
    }).then(function () {
      var fecha = document.getElementById("fechaDevolucion").value;
      var cantidadDevuelta = document.getElementById("cantDevuelta").value;
      $("#resultadoDevolucion").load("Controlador/ctrlDevoluciones.php",
        {
          accion:'ingresarDevolucion',
          modulo:moduloF,
          factura:factura,
          product:product,
          cantidad:cantidadDevuelta,
          cantidadFactura:cantidad,
          fecha:fecha
        },function()
          {
            cargarDetallesFactura();
          }
        )   
    }, function (dismiss) {
      
    })
  }

  function verificaCantidad(cant1,cantMax){
    if(cant1>cantMax){
      alert("Corrija la cantidad devuelta, está exediendo a la cantidad en la factura");
    }else if(cant1<0){
      alert("Corrija la cantidad devuelta, tiene un valor negativo");
    }
  }

  function ventanaCambiarArticulos(product){
    var moduloF = document.getElementById("moduloDevolucion").value;
    var factura = document.getElementById("modulofacturasDevolucion").value;
    $("#capa").slideDown("fast");
    $("#capa").load("vistas/ventanaCambios.php",{modulo:moduloF,factura:factura,productACambiar:product});
  }

</script>
