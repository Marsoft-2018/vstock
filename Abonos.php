
<?php
	require("Conexiones/Conect.php");
	$modulo=$_POST['modulo'];
	    
    $conexion =  new Conectar();
    
	/*echo "el modulo es: ".$modulo;
	echo "La persona es: ".$persona;*/
?>
<h2 style="text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);">MODULO DE ABONOS</h2>
<div id='Contenedor' class='container'>       
    <div class="panel panel-success clase3" style="width: 100%;">
        <div class="panel-heading clase3"><h4>DATOS RELACIONADOS CON LA CUOTA/ABONO</h4></div>
        <div class="panel-body clase3" id='vacciones'>
            <div class="row">
                <div class="col-md-5">				
                <?php     
                 echo "<label>Digite o elija el id del $modulo:</label>";
                        $sql='';
                        if($modulo=='cliente'){
                            $sql="SELECT DISTINCT cl.*  FROM clientes cl 
                            INNER JOIN facturasv fv ON cl.`idCliente`=fv.`idCliente`
                            WHERE fv.`tipo`='credito' AND fv.`estado`='Por Pagar'
                            GROUP BY cl.`idCliente`
                            ORDER BY cl.`Nombre`"; 
                        }else{
                            $sql="SELECT DISTINCT pv.*  FROM proveedores pv
                            INNER JOIN facturasc fc ON pv.idProveedor =fc.`idProveedor`
                            WHERE fc.`tipo`='credito' AND fc.`estado`='Por Pagar'
                            GROUP BY pv.idProveedor
                            ORDER BY pv.nombre";     
                        }
                       
                        $res=mysql_query($sql);
                        
                        $nRes=mysql_num_rows($res);                    
                        
                        if($nRes>=1){
                            echo "<input type='text' id='cargarPersona' value='' class='form-control clase3' list='listaPersona' placeholder='Digite o elija el id del $modulo' name='$modulo' onkeyup='cargarDatosCredito(this.name,this.value)' onchange='cargarDatosCredito(this.name,this.value)' onFocus='limpiar(this.id)'>";
                            echo "<datalist id='listaPersona'>";
                            echo "<option value=''>Seleccione...";
                                while ($fila=mysql_fetch_array($res)){
                                    echo "<option value='".$fila[0]."'>".$fila[1];
                                }
                            echo "</datalist>";
                        }else{
                            echo "<div class='alert alert-warning alert-dimissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                    No existen créditos activos en la base de datos
                                  </div>";
                        }
                 ?>	
                </div>	
            </div>			
            <div class='row'>
              <div class="col-md-12">                 
                  <div class="panel panel-info" style="width: 100%;">
                   <div class="panel-body" id="contenidoCredito">
                       
                   </div>
               </div>
              </div>
               
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function limpiar(id){
        document.getElementById(''+id).value='';
    }
    function cargarDatosCredito(tabla,id){  
        $("#contenidoCredito").load("Controlador/ctrlAbonos.php",{accion:'cargar',tabla:tabla,idPersona:id});
    }
    
    function listaDePagos(id,factura,tabla){
        $("#marcoPagos").fadeIn();
        $("#pagos"+factura).load("Controlador/ctrlAbonos.php",{accion:'listaPagos',tabla:tabla,idPersona:id,factura:factura});
    }
    
    function agregarCuota(idCredito,tabla,idPersona){
        var cuotas = parseInt(document.getElementById('cantCuotas'+idCredito).value);
        var valorCuota=parseInt(document.getElementById('valorCuota'+idCredito).value);
        var fecha = document.getElementById('fechaAbono'+idCredito).value;
        //alertify.alert("Se ejecuto la funcion agregarCuota(idCredito: "+idCredito+", Tabla: "+tabla+", Id Persona:"+idPersona+")-- No. cuotas "+cuotas+" Valor Cuota: "+valorCuota+" fecha: "+fecha+". Apunta al contenedor: pagos"+idCredito);
        
        if(cuotas==0 || valorCuota==0 || fecha==''){
            alertify.error("Por favor complete los datos del abono para poder continuar");
        }else{
            
            $("#pagos"+idCredito).load("Controlador/ctrlAbonos.php",{
                accion:'agregarCuota',
                tabla:tabla,
                idPersona:idPersona,
                idCredito:idCredito,
                cuotas:cuotas,
                valorCuota:valorCuota,
                fecha:fecha
            },function(){
                $("#contenidoCredito").load("Controlador/ctrlAbonos.php",{accion:'cargar',tabla:tabla,idPersona:idPersona},function(){
                    $("#marcoPagos").fadeIn();
                    listaDePagos(idPersona,idCredito,tabla);
                    //$("#pagos"+idCredito).load("Controlador/ctrlAbonos.php",{accion:'listaPagos',tabla:tabla,idPersona:idPersona,factura:idCredito});
                });
            });            
        }
    }
    
    function eliminarAbono(idAbono,idCredito,tabla,idPersona){ 
    //alertify.alert("Se ejecuto la funcion eliminarAbono(idAbono: "+idAbono+", idCredito: "+idCredito+", Tabla: "+tabla+", Id Persona:"+idPersona+"). Apunta al contenedor: pagos"+idCredito);       
        $("#pagos"+idCredito).load("Controlador/ctrlAbonos.php",{
                accion:'eliminarAbono',
                tabla:tabla,
                idPersona:idPersona,
                idCredito:idCredito,
                idAbono:idAbono
            },function(){
                $("#contenidoCredito").load("Controlador/ctrlAbonos.php",{accion:'cargar',tabla:tabla,idPersona:idPersona},function(){
                    $("#marcoPagos").fadeIn();
                    listaDePagos(idPersona,idCredito,tabla);
                    //$("#pagos"+idCredito).load("Controlador/ctrlAbonos.php",{accion:'listaPagos',tabla:tabla,idPersona:idPersona,factura:idCredito});
                });
            });
    }//ok
    
    function cuentaSaldada(tabla,idPersona){
        swal({
          title: 'Listo',
          text: 'Este crédito ha sido saldado!',
          timer: 2500
        }).then(
          function () {}
        );
    }

    function ventanaDescuento(idCredito){
        swal({
          title: "Registrar Descuento",
          html: '<br>' +
                    '<div style="text-align:left;font-size:14px;line-height: 3em;padding:10px;width:95%;">'+
                    '<label>Valor</label><input type="number" value="" id="valorDescuento" class="form form-control">'+
                    '<br>'+
                    '<label>Detalle</label><input type="text" id="DetalleDescuento" value="" class="form form-control" />' +
                    '</div>',      
          imageWidth: 400,
          imageHeight: 200,
          animation: true,
          showCloseButton: true,
          showCancelButton: true, 
          confirmButtonColor: "#216F21",
          cancelButtonColor: "#DD6B55",
          confirmButtonText: "Agregar",
          cancelButtonText: "Cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
        }).then(function () {
               agregarDescuento(idCredito);
        }, function (dismiss) {

        });

    }

    function agregarDescuento(credito){
        var valor = document.getElementById('valorDescuento').value;
        var detalle = document.getElementById('DetalleDescuento').value;

        alert ("Credito "+credito+", valor: "+valor+", Detalle: "+detalle);
        $("#marcoDescuento").load("Controlador/ctrlAbonos.php",{accion:'agregarDescuento',credito:credito,valor:valor,detalle:detalle},
            function(){
                //$("#saldo"+credito).load("Controlador/ctrlAbonos.php",{accion:'cargarNuevoSaldo',credito:credito});
                cargarNuevoSaldo(credito);
            }
        );
    }

    function cargarNuevoSaldo(credito){
        $("#saldo"+credito).load("Controlador/ctrlAbonos.php",{accion:'cargarNuevoSaldo',credito:credito});
    }

    function eliminarDescuento(credito){
        $("#marcoDescuento").load("Controlador/ctrlAbonos.php",{accion:'eliminarDescuento',credito:credito},function(){
            cargarNuevoSaldo(credito);
        });
    }
</script>