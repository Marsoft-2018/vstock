
$("#devoluciones").click(cargardevoluciones);
$("#gastos").click(cargarGastos); 



function cargarcompras(){
    $("#parte1").load('Movimientos.php',{modulo:'COMPRA'},function(){
        $("#factSig").load('Controlador/ctrlFactura.php',{modulo:'COMPRA', accion:'facturaSiguiente'}); 
        $("#contFactura").load('Controlador/ctrlFactura.php',{modulo:'COMPRA', accion:'facturaRealSig'});
    });	    			
}	

function cargarGastos(){
    var negNum =document.getElementById("negNum").value;
    $("#parte1").load('Vistas/gastos.php',{idneg:negNum});
}

function cargardevoluciones(){
    $("#parte1").load('Vistas/devoluciones.php');	
    //mensaje();				
}


function acciones(id,accion,quien){
    if(accion==2 & quien==1){//Si la accion a ejecutar es la No 2 que corresponde a eliminar el registro seleccionado
        accion='eliminar';
        
        alertify.defaults.transition = "flipy";
        alertify.defaults.theme.ok = "btn btn-primary";
        alertify.defaults.theme.cancel = "btn btn-danger";
        alertify.defaults.theme.input = "form-control";
        alertify.confirm(
            '<div class="panel-heading" style="background-color:#901025;color:#fff;"><i class="fa fa-trash"> Eliminar Articulo</i></div>', 
            '¿Está seguro de eliminar este Articulo?\n'+
            "\nPara eliminar los datos del registro preciona el botón SI, recuerde que al eliminar este product del inventario se eliminaran los datos relacionados con los movientos de compra y venta que se hallan hecho del mismo.",
            function()
            { 
                var idArticulo=id;    
                    var NegocioID=document.getElementById('negNum').value;
                    $("#capa").load("AplicarAcciones.php", {accion:accion,Edtabla:quien,idArticulo:idArticulo,NegocioID:NegocioID},
                        function(){
                            $("#parte1").load("inventario.php",
                                function()
                                {
                                    $('#capa').slideUp('slow');
                                    alertify.success('Se ha eliminado el articulo del inventario');
                                }
                            );
                        }           
                    );
            }, 
            function()
            { 
                $('#capa').slideUp('fast');
            }
        );
    }else{
        var y=$(document).ready(function(e) {
            var negNum =document.getElementById("negNum").value;
            $('#capa').slideDown('fast');
            $('#capa').load('editar.php',{Edparte:quien,Edid:id,accion:accion,idNeg:negNum},function(){
                $('#vacciones').draggable();
            });                     
        });   
    }
}
	
function cancelar(modulo){
    if(modulo==1){
        var y=$(document).ready(function(e) {
            //$('#capa').css('display','none');
            $("#capa").slideUp("fast");
        });
        $("#parte1").load("inventario.php",function(){$('#capa').slideUp('slow');alertify.success('Se ha actualizado el articulo en el inventario');});        
    }else{
        var y=$(document).ready(function(e) {
            //$('#capa').css('display','none');
            $("#capa").slideUp("fast");
        });
    }
}

function editarArticuloEnMovimiento(){
    var id=document.getElementById('cbo_product').value;
    if(id!=""){
        acciones(id,1,2);
    }
}

function ayudaMenu(mensaje,x){
    if (x==1){
        $("#textoMenu").display="block";
        $("#textoMenu").slideDown("fast");
        document.getElementById("textoMenu").innerHTML=" "+mensaje;         
    }else{
        $("#textoMenu").display="none";
        $("#textoMenu").slideDown("fast");
        document.getElementById("textoMenu").innerHTML=" "; 
    }
}

function limpiar(id){
    document.getElementById(""+id).value='';
}

function pasarAcantidad(e){
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13) {
        //alert ('Has pulsado enter');
        document.getElementById('txt_cantidad').focus();
    }
    
}


$('#tipoVenta').change(function(){
    var tipo=document.getElementById('tipoVenta').value;
    $('#tipoPago').load('formasdePago.php',{tipo:tipo});
});


function cambiarPrecio(id,precio){
    var accion='CambiarPrecio';
    var factura=document.getElementById('txtFact').value;
    if(id==""){
        alertify.alert('No se tiene Id del product');
    }else{
        $("#subTotal"+id).load('listaProd.php', {accion:accion,idProd:id,Nfact:factura,precio:precio},
            function(){
                $("#totalFactura").load('listaProd.php', {accion:'TotalFactura',Nfact:factura});
            }
        );
        
    }

    
}

    
function editarPerfil(usuario){
    //alert("Funcion editar perfil: "+usuario);
    $("#parte1").load('EditarPerfil.php',{usuario:usuario});
}

function agregarCategoriaDirecta(){
    var negNum =document.getElementById("negNum").value;
    var nombreCategoria = document.getElementById('categoriaNuevoArticulo').value;
    if(nombreCategoria==''){
        alertify.error("Por favor ingrese un nombre válido para la categoria");
    }else{
        $("#registrarCategorias").load('Controlador/ctrlCategorias.php',{accion:'AgregarCategoriaArticuloNuevo',idneg:negNum,nombreCategoria:nombreCategoria},function(){
            //alertify.success("Se encuentra el la funcion agregar categoria, variables: Negocio"+negNum+" categoria: "+nombreCategoria);
        });
    }       
}

function ventanaGastosNuevo(){
    swal({
      title: "Registrar nuevo tipo de Gasto",
      html: '<br>' +
                '<div style="text-align:left;font-size:14px;line-height: 3em;padding:10px;width:95%;">'+
                '<label>Tipo</label><select id="tipoG" class="form form-control" >' +
                '<option value="">Seleccione...</option>'+                
                '<option value="Arriendo">Arriendo</option>'+
                '<option value="Alimentacion">Alimentacion</option>'+
                '<option value="Mantenimiento/Reparacion">Mantenimiento/Reparacion</option>'+
                '<option value="Servicios">Servicios</option>'+
                '<option value="Otros">Otros</option>'+
                '</select><br>'+
                '<label>Nombre</label><input type="text" placeholder="Por favor ingrese el nombre del gasto" title="Por favor ingrese el nombre que identifica el gasto" id="nombreG" value="" class="form form-control" /></br>' +
                '</div>',
      
      imageWidth: 400,
      imageHeight: 200,
      animation: true,
      showCloseButton: true,
      showCancelButton: true, 
      confirmButtonColor: "#216F21",
      cancelButtonColor: "#DD6B55",
      confirmButtonText: "Listo",
      cancelButtonText: "Cancelar",
      closeOnConfirm: false,
      closeOnCancel: false
    }).then(function () {
           agregarGasto();
    }, function (dismiss) {

    });
}

function agregarGasto(){
    var tipo= document.getElementById("tipoG").value;
    var nombreGasto= document.getElementById("nombreG").value;
    var idNegocio= document.getElementById("negNum").value;
    $("#listaGastos").load("Controlador/ctrlGastos.php",{accion:'Agregar',tipo:tipo,nombreGasto:nombreGasto,idNegocio:idNegocio},
      function(){
        cargarGastos();    
      }
    );    
}

function editarGasto(campo,clave,valor){
    $("#mensajeAct").load("Controlador/ctrlGastos.php",{accion:'Actualizar',campo:campo,idGasto:clave,valor:valor});    
}

function eliminarGasto(idGasto){
    alertify.defaults.transition = "flipy";
    alertify.defaults.theme.ok = "btn btn-primary";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";
    alertify.confirm(
        '<div class="panel-heading" style="background-color:#902015;color:#fff;"><i class="fa fa-times-circle"> Eliminar Gastos</i></div>', 
        '<div class="alert alert-dimissable alert-warning" >Está seguro de eliminar el gasto?; Si existen pagos relacionados con el estos también se eliminarán una vez confirme el procedimiento.</div>', 
        function()
        { 
            $("#listaGastos").load("Controlador/ctrlGastos.php",{accion:'Eliminar',idGasto:idGasto},
              function(){
                cargarGastos();    
              }
            );  
        }, 
        function()
        { 
            //alertify.error('Cancel')
        }
    );

        
}

function ventanaPagos(idGasto){
    swal({
      title: "Registrar Pago",
      html: '<br>' +
                '<div style="text-align:left;font-size:14px;line-height: 3em;padding:10px;width:95%;">'+
                '<label>No. Recibo</label><input type="text" id="reciboG" placeholder="Por favor ingrese el No. del recibo de pago" title="Por favor ingrese el No. del recibo o factura de pago" value="" class="form form-control" required/></br>' +
                
                '<label>Valor Pagado</label><input type="text" id="valorG" placeholder="Por favor ingrese el valor total pagado" title="Por favor ingrese el valor total pagado"  value="" class="form form-control" required/></br>' +
                '<label>Fecha del Pago</label><input type="date" id="fechaPago" title="Por favor ingrese la fecha en que realizo el pago formato (aaaa-mm-dd) ejem: 2017-10-13"  value="" class="form form-control" required/></br>' +
                '<label>Id del Gasto</label><input type="text" id="idGasto" placeholder="Código de identificación del gasto no es editable" title="Por favor ingrese el valor total pagado"  value="'+idGasto+'" readonly="true"/>'+
                '</div>',
      
      imageWidth: 400,
      imageHeight: 200,
      animation: true,
      showCloseButton: true,
      showCancelButton: true, 
      confirmButtonColor: "#216F21",
      cancelButtonColor: "#DD6B55",
      confirmButtonText: "Ingresar Pago",
      cancelButtonText: "Cancelar",
      closeOnConfirm: false,
      closeOnCancel: false
    }).then(function () {
           agregarPago();
    }, function (dismiss) {

    });
}

function agregarPago(){
    var recibo= document.getElementById("reciboG").value;
    var valor= document.getElementById("valorG").value;
    var fecha= document.getElementById("fechaPago").value;
    var idNegocio= document.getElementById("negNum").value;
    var idGasto = document.getElementById("idGasto").value;
    $("#listaGastos").load("Controlador/ctrlGastos.php",{accion:'Pagar',idNegocio:idNegocio,idGasto:idGasto,recibo:recibo,valor:valor,fecha:fecha},
      function(){
        cargarGastos();    
      }
    ); 
}

function mensaje(){
    swal({ 
    title: "MENSAJE",
    text: "Modulo no disponible",
    html: "<div class='alert alert-dimissable alert-warning'>"+
            "Señor usuario disculpe la molestia el módulo no se encuentra disponible en este momento, contacte a soporte técnico."+
            "</div>",
    type: "info",
    showCancelButton: false,
    confirmButtonColor: "#216F21",
    cancelButtonColor: "#FF0a55",
    confirmButtonText: "Aceptar",
    closeOnConfirm: false,
    closeOnCancel: true }
    );
}


function cargarRegistroDeResultados(){
    $("#parte1").load('Vistas/reporteResultados.php');
}
   
function  cargarReportesResultados(){
    var dia = document.getElementById('dia').value;
    var mes = document.getElementById('mes').value;
    var anho = document.getElementById('anho').value;
    
    //alertify.success("Los valores son:  dia: "+dia+" mes: "+mes+" año: "+anho+" modulo: ");
    
    if(dia!='' && mes!='' && anho!=''){
        $("#resultadoReporte").load("Controlador/ctrlReporteResultados.php",{dia:dia,mes:mes,anho:anho,accion:"dia"},function(){
            alertify.success("Reporte de resultado diario cargado con éxito");
        });
        
    }
    
    if(dia=='' && mes!='' && anho!=''){
        $("#resultadoReporte").load("Controlador/ctrlReporteResultados.php",{mes:mes,anho:anho,accion:"mes"},function(){
            alertify.success("Reporte de resultado Mensual cargado con éxito");
        });
        
    }
    
    if(dia=='' && mes=='' && anho!=''){
        $("#resultadoReporte").load("Controlador/ctrlReporteResultados.php",{anho:anho,accion:"anho"},function(){
            alertify.success("Reporte de resultado Anual cargado con éxito"); 
        });
       
    }
    
}