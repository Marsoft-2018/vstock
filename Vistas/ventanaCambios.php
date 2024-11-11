<?php
  require("../Conexiones/Conect.php");
  $idFactura=$_POST['factura'];
  $modulo=$_POST['modulo'];
  $productACambiar=$_POST['productACambiar'];
?>
<div class='container' style="width: 500px;padding:10px; display:block;position:absolute;">       
  <div class="panel panel-info clase3 some-class" id='contenedor' style="display:block;position:absolute;width: 100%;margin:0 auto;left: 300px;top:50px;" >
    <div class="panel-heading clase3">
      <h2 style="text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);">MODULO PARA REEMPLAZOS DE ARTICULOS</h2>
    </div>
    <div class="panel-body clase3" id='vacciones'>
      <div class="row">
        <div class="col-md-12">                    
          <div class='panel panel-warning'>
            <div class="panel-heading">
              Opciones para el reemplazo
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-6">
                  <label for="">Elija el Articulo:</label>
                  <?php                            
                    $sqlInv=new Inventario();
                    $resultInv=$sqlInv->Products();

                    echo "<input type='text' value='' name='cbo_product' id='productReemplazo' class='form-control clase3' list='listadeProducts' onchange='cargarDatosArticulo(this.value)' ondblclick='limpiar(this.id)' onkeypress='cargarDatosArticulo(this.value)'>";
                    echo "<datalist id='listadeProducts'>";
                    while ($row=mysql_fetch_array($resultInv)){
                      echo "<option value='".$row[0]."'> - ".$row[1]." - ".$row[2];
                    }
                    echo "</datalist>";
                  ?> 
                  
                </div>
                <div class="col-md-6">
                  <label for="">Cantidad</label>
                  <input type='number' value='' id='cantCambio' class="form form-control clase3">
                </div>
              </div>
              <div class="row">
                <div id='datosDelArticulo'>

                </div>
                
              </div>
            </div>
            <div class="panel-footer">
              <input type="hidden" id='productACambiar' value='<?php echo $productACambiar ?>'>
              <input type="hidden" id='idFactura' value='<?php echo $idFactura ?>'>
              <input type="hidden" id='modulo' value='<?php echo $modulo ?>'>
              <button class="btn btn-primary" onclick='cambiarArticulo()' style="padding: 10px;margin:10px;width: 150px;"><i> Continuar</i></button>
              <button class="btn btn-warning" onclick='cerrarCapa()' style="padding: 10px;margin:10px;width: 150px;"><i> Cancelar</i></button>
            </div> 
          </div>
        </div>          
      </div>
    </div>
  </div>
</div> 


<script type="text/javascript">
  function cerrarCapa(){
    $("#capa").html("");
    $("#capa").slideUp('fast');
  }

  function cargarDatosArticulo(idProd){
    if (idProd!=0 || idProd!=""){
        $('#datosDelArticulo').fadeIn();
        $('#datosDelArticulo').load("Controlador/ctrlDevoluciones.php",{accion:"datosArticulo",idProd:idProd});
    }      
  }

  function cambiarArticulo(){
    var modulo = document.getElementById('modulo').value;
    var factura = document.getElementById('idFactura').value;
    var productAcambiar  = document.getElementById('productACambiar').value;
    var productReemplazo = document.getElementById('productReemplazo').value;
    var cantidad = document.getElementById("cantCambio").value;

    //alertify.log("product a cambiar: "+productAcambiar+" product de reemplazo "+productReemplazo);

    if(productAcambiar != productReemplazo ){
        $("#capa").load("Controlador/ctrlDevoluciones.php",
          {
            accion:"cambiarArticulo",
            modulo:modulo,
            factura:factura,
            productACambiar:productAcambiar,
            productReemplazo:productReemplazo,
            cantidad:cantidad
          },function(){
            cerrarCapa();
            cargarDetallesFactura();
          }
        );
    }else{
      alert("No es necesario realizar este proceso en el sistema cuando es product a cambiar tiene el mismo código que el product de reemplazo");
      cerrarCapa();
      cargarDetallesFactura();
    }
  }
</script>