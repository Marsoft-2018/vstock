
function cargarinventario(){
    $("#parte1").load('inventario.php');					
}

function cargarinventario2(idNegocio){
    $("#bloquear").fadeIn();
    $('#parte1').html("");
    $.ajax({
        type: "POST",
        url: "Vistas/productos/inventario.php",
        data: {"idNegocio":idNegocio},
        success: function(data){
            $('#parte1').html(data);
            $("#bloquear").fadeOut();
        },
        error: function(err){
            console.log("Error: "+err);
            $("#bloquear").fadeOut();
        }
    });				
}	

function cargarventas(){
    $("#parte1").load('Movimientos.php',{modulo:'VENTA'},function(){
        $("#factSig").load('Controlador/ctrlFactura.php',{modulo:'VENTA',accion:'facturaSiguiente'});
        $("#contFactura").load('Controlador/ctrlFactura.php',{modulo:'VENTA', accion:'facturaRealSig'});
    });
    
}	

function cargarcompras(){
    $("#parte1").load('Movimientos.php',{modulo:'COMPRA'},function(){
        $("#factSig").load('Controlador/ctrlFactura.php',{modulo:'COMPRA', accion:'facturaSiguiente'}); 
        $("#contFactura").load('Controlador/ctrlFactura.php',{modulo:'COMPRA', accion:'facturaRealSig'});
    });	    			
}	

function cargarEmpleados(){
    var negNum =document.getElementById("negNum").value;
    $("#parte1").load('Vistas/empleados.php',{idneg:negNum});
}

function cargarProveedores(){
    var negNum =document.getElementById("negNum").value;
    $("#parte1").load('Vistas/proveedores.php',{idneg:negNum});
}

function cargarClientes(){
    var negNum =document.getElementById("negNum").value;
    $("#parte1").load('Vistas/clientes.php',{idneg:negNum});
}

function cargarGastos(){
    var negNum =document.getElementById("negNum").value;
    $("#parte1").load('Vistas/gastos.php',{idneg:negNum});
}

function cargardevoluciones(){
    $("#parte1").load('Vistas/devoluciones.php');	
    //mensaje();				
}

function cargarAbonosc(){
    $("#parte1").load('Abonos.php',{modulo:'cliente'});					
}

function cargarAbonosp(){
    $("#parte1").load('Abonos.php',{modulo:'proveedor'});					
}

function cargarNegocio(){
    var negNum =document.getElementById("negNum").value;
    $("#parte1").load('datosNegocio.php',{modulo:'dtNegocio',idneg:negNum});					
}

function cargarCategorias(){
    var negNum =document.getElementById("negNum").value;
    $("#parte1").load('Controlador/ctrlCategorias.php',{accion:'Buscar',idneg:negNum});
}

function agregarCategoria(){
    var negNum =document.getElementById("negNum").value;
    var nombreCategoria = document.getElementById('nombreCategoriaNuevo').value;
    $("#parte1").load('Controlador/ctrlCategorias.php',{accion:'Agregar',idneg:negNum,nombreCategoria:nombreCategoria});
}

function eliminarCategoria(id){
    alertify.defaults.transition = "flipy";
    alertify.defaults.theme.ok = "btn btn-primary";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";
    alertify.confirm(
        '<div class="panel-heading" style="background-color:#902015;color:#fff;"><i class="fa fa-times-circle"> Eliminar Categoria</i></div>', 
        'Señor usuario tenga encuenta esta advertencia cuado desee eliminar una de las categorias registradas; verifique que no existan articulos relacionados con la categoría ya que estos también se eliminarán una vez confirme el procedimiento.', 
        function()
        { 
            var negNum =document.getElementById("negNum").value;
                    $("#parte1").load('Controlador/ctrlCategorias.php',{accion:'Eliminar',idneg:negNum,idCategoria:id},function(){alertify.success('Categoria Eliminada con éxito')});  
        }, 
        function()
        { 
            //alertify.error('Cancel')
        }
    );
}

function actualizarCategoria(campo,clave,valor){
    var negNum =document.getElementById("negNum").value;
    $("#parte1").load('Controlador/ctrlCategorias.php',{accion:'actualizar',idNeg:negNum,campo:campo,clave:clave,valor:valor});
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
            "\nPara eliminar los datos del registro preciona el botón SI, recuerde que al eliminar este producto del inventario se eliminaran los datos relacionados con los movientos de compra y venta que se hallan hecho del mismo.",
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
    var id=document.getElementById('cbo_producto').value;
    if(id!=""){
        acciones(id,1,2);
    }
}

function modificarArticulo(campo,clave,valor){
    //var modulo=document.getElementById('Modulo').value;
    var accion="Modificar";

    $("#resultadoModificacionArticulo").load('Controlador/ctrlArticulo.php', {            
            accion:accion,
            campo:campo,
            clave:clave,
            valor:valor
        },function(){
            alertify.success("Dato Actualizado Con éxito");
        });         
}
	
function modificar(acciones,tabla){
    if (acciones==1) {
        acciones='modificar';
    }else if (acciones==2) {
        acciones='agregar';
    }

    if (tabla==1){

        //var idArticulo=document.getElementById('ide').value;
        var idArticulo=document.getElementById('articuloID').value;
        var NombreArticulo=document.getElementById('articuloED').value;			
        var Referencia=document.getElementById('referenciaED').value;
        var catId=document.getElementById('categoriaNuevoArticulo').value;
        var precioCompra=document.getElementById('preciodecompraED').value;	
        var precioVenta=document.getElementById('preciodeventaED').value;
        var cantInicial=document.getElementById('cantinicialED').value;
        var compras=document.getElementById('comprasED').value;
        var ventas=document.getElementById('ventasED').value;
        var devoluciones=document.getElementById('devolucionesED').value;
        var cantFinal=document.getElementById('cantfinalED').value;
        var cantMinima=document.getElementById('cantminimaED').value;
        var NegocioID=document.getElementById('ideNeg').value;
        var medida = $("#medida").val();
        //console.log('test: '+medida);
        //alertify.alert('La variable tabla: '+tabla+"Accion: "+acciones+"\n : "+idArticulo+"\n Nombre Articulo: "+NombreArticulo+"\n Referencia: "+Referencia+"\n catId: "+catId+"\n precioCompra: "+precioCompra+"\n precioVenta: "+precioVenta+"\n cantInicial: "+cantInicial+"\n compras: "+compras+"\n ventas: "+ventas+"\n devoluciones: "+devoluciones+"\n cantFinal: "+cantFinal+"\n cantMinima: "+cantMinima+"\n NegocioID: "+NegocioID);
        $("#aplicarAcciones").load("AplicarAcciones.php", {
                Edtabla:tabla,
                accion:acciones,
                idArticulo:idArticulo,
                NombreArticulo:NombreArticulo,
                Referencia:Referencia,
                precioCompra:precioCompra,
                precioVenta:precioVenta,
                cantInicial:cantInicial,
                compras:compras,
                ventas:ventas,
                devoluciones:devoluciones,
                cantFinal:cantFinal,
                cantMinima:cantMinima,
                NegocioID:NegocioID,
                catId:catId,
                medida:medida
            },
            function(){
                // $("#parte1").load("inventario.php",
                //     function(){
                //         document.getElementById('articuloID').value='';
                //         document.getElementById('articuloED').value='';			
                //         document.getElementById('referenciaED').value='';
                //         document.getElementById('categoriaNuevoArticulo').value='';
                //         document.getElementById('preciodecompraED').value='';	
                //         document.getElementById('preciodeventaED').value='';
                //         document.getElementById('cantinicialED').value='';
                //         document.getElementById('comprasED').value='';
                //         document.getElementById('ventasED').value='';
                //         document.getElementById('devolucionesED').value='';
                //         document.getElementById('cantfinalED').value='';
                //         document.getElementById('cantminimaED').value='';
                //         document.getElementById('ideNeg').value='';
                //     });
            }			
        );
    }else if(tabla==2){
    }else if(tabla==3){
    }
}


function eliminarProducto(id,bussines_id){
    accion='eliminar';
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        title: "Eliminar Articulo",
        text: "¿Está seguro de eliminar este Articulo?\n"+
        "\nPara eliminar los datos del registro preciona el botón SI, recuerde que al eliminar este producto del inventario se eliminaran los datos relacionados con los movientos de compra y venta que se hallan hecho del mismo.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si",
        cancelButtonText: "No",
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
        //   swalWithBootstrapButtons.fire({
        //     title: "Deleted!",
        //     text: "Your file has been deleted.",
        //     icon: "success"
        //   });
        const data = {
            "accion": accion,
            "id": id,
            "bussines_id": bussines_id
        }
            axios.post('Controlador/ctrlProductos.php', data)
                .then(function(res) {
                    //res = JSON.parse(res);
                    console.log(res.data);
                    //console.log('Mensaje: '+res.data["mensaje"]);
                    // respuesta = respuesta.trim();
                    // console.log(respuesta);
                    if(res.status == 200) {
                        let timerInterval;
                        Swal.fire({
                            title: res.data,
                            icon: "success",
                            timer: 1500,
                            position: "bottom-end",
                            showConfirmButton: false,
                            timerProgressBar: false,
                            didOpen: () => {
                                const timer = Swal.getPopup().querySelector("b");
                                timerInterval = setInterval(() => {
                                timer.textContent = `${Swal.getTimerLeft()}`;
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                            }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                cargarinventario2(bussines_id);
                            }
                        });
                    }
                })
                .catch(function(err) {
                    Swal.fire({
                        position: "left-end",
                        icon: 'error',
                        title: 'Error',
                        text: err
                    });
                }
            );
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire({
            title: "Cancelled",
            text: "Your imaginary file is safe :)",
            icon: "error"
          });
        }
    });
    
    // alertify.defaults.transition = "flipy";
    // alertify.defaults.theme.ok = "btn btn-primary";
    // alertify.defaults.theme.cancel = "btn btn-danger";
    // alertify.defaults.theme.input = "form-control";
    // alertify.confirm(
    //     '<div class="panel-heading" style="background-color:#901025;color:#fff;"><i class="fa fa-trash"> Eliminar Articulo</i></div>', 
    //     '¿Está seguro de eliminar este Articulo?\n'+
    //     "\nPara eliminar los datos del registro preciona el botón SI, recuerde que al eliminar este producto del inventario se eliminaran los datos relacionados con los movientos de compra y venta que se hallan hecho del mismo.",
    //     function()
    //     { 
    //         var idArticulo=id;    
    //             var NegocioID=document.getElementById('negNum').value;
    //             $("#capa").load("AplicarAcciones.php", {accion:accion,Edtabla:quien,idArticulo:idArticulo,NegocioID:NegocioID},
    //                 function(){
    //                     $("#parte1").load("inventario.php",
    //                         function()
    //                         {
    //                             $('#capa').slideUp('slow');
    //                             alertify.success('Se ha eliminado el articulo del inventario');
    //                         }
    //                     );
    //                 }           
    //             );
    //     }, 
    //     function()
    //     { 
    //         $('#capa').slideUp('fast');
    //     }
    //);
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

function AgregarAR(modulo){

    //var nuevo=document.getElementById('esNuevo').value;
    nuevo =document.getElementById('registrado').value;
    var factura=document.getElementById('txtFact').value;
    var cant=document.getElementById('txt_cantidad').value;
    var id=document.getElementById('cbo_producto').value;
    var idNegocio=document.getElementById('negNum').value;
    var accion='Agregar';
    //alertify.alert("Esta en la funcion agregar articulo, la variable nuevo es: "+nuevo);

    if (nuevo=="Nuevo"){
        //$('#Bingresar').css('display','none');

        //Proceso de ingreso del articulo en el inventario
        var nombreArticulo = document.getElementById('nombreNuevoArticulo').value;
        var referencia = document.getElementById('referenciaNuevoArticulo').value;
        var categoria = document.getElementById('categoriaNuevoArticulo').value;
        var medida = $("#medida").val();
        var precioCompra = document.getElementById('precioDeCompraNuevoArticulo').value;
        var precioVenta = document.getElementById('precioDeVentaNuevoArticulo').value;
        if(cant==''){
            alertify.error('Por favor ingrese la cantidad');
        }else if(nombreArticulo=='' || referencia=='' || categoria=='' || precioCompra=='' || precioVenta==''){
            alertify.alert('Los datos del nuevo articulo son necesarios para agregarlo al inventario, complete estos datos para poder continuar');    
        }else{
            //alertify.alert("Los valores de las variables son: Articulo: "+nombreArticulo+" referencia: "+referencia+" cantidad: "+cant+" categoria: "+categoria+" P. Compra: "+precioCompra+" P. Venta: "+precioVenta+" Factura: "+factura+" Negocio: "+idNegocio);
            //para registrar el nuevo articulo en el inventario
            $("#verificacionArticulo").load('listaProd.php', {Nfact:factura,idNegocio:idNegocio,idProd:id,nombreArticulo:nombreArticulo,referencia:referencia,categoria:categoria,precioCompra:precioCompra,precioVenta:precioVenta,Cantidad:0,accion:"Nuevo",medida:medida},
                function(){
                    $("#listadoDeArticulos").load('listaProd.php', {Nfact:factura,idProd:id,Cantidad:cant,accion:accion,modulo:modulo});
                    $('#verificacionArticulo').fadeOut('slow',
                        function(){
                            alertify.success("El Articulo: "+nombreArticulo+" Ref: "+referencia+" cantidad: "+cant+"\n Fue Agregado al inventario");
                        });                   
                });
        }
    }else{            
        if(id==""){
            alertify.error('Por favor seleccione un producto de la lista');
        }else if(cant==''){
            alertify.error('Por favor ingrese la cantidad');
        }else{
            $("#listadoDeArticulos").load('listaProd.php', {Nfact:factura,idProd:id,Cantidad:cant,accion:accion,modulo:modulo});
        }            
    }
}

function pasarAcantidad(e){
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13) {
        //alert ('Has pulsado enter');
        document.getElementById('txt_cantidad').focus();
    }
    
}

$('#cargaClientes').change(function(){
    var documento=document.getElementById('cargaClientes').value;
    var modulo=document.getElementById('Modulo').value;
    var accion="Cargar";        
    if(documento!=""){
        $("#datosCliente").load('CargarCliente.php', {documento:documento,modulo:modulo,accion:accion}); 
    }
});   


function actualizarDato(campo,clave,valor){
    var modulo=document.getElementById('Modulo').value;
    var accion="Actualizar";

    $("#resultadoActualizacion").load('CargarCliente.php', {
            modulo:modulo,
            accion:accion,
            campo:campo,
            clave:clave,
            valor:valor
        },function(){
            alertify.success("Dato Actualizado Con éxito");
        });         
}

function buscar(){
    var documento=document.getElementById('cargaClientes').value;
    var modulo=document.getElementById('Modulo').value;
    var accion="Cargar";        
    if(documento!=""){
        $("#datosCliente").load('CargarCliente.php', {
            documento:documento,
            modulo:modulo,
            accion:accion
        }); 
    }
}

$('#tipoVenta').change(function(){
    var tipo=document.getElementById('tipoVenta').value;
    $('#tipoPago').load('formasdePago.php',{tipo:tipo});
});

function facturar(){                        
    var factura=document.getElementById('txtFact').value;
    var cant=document.getElementById('txt_cantidad').value;
    var modulo=document.getElementById('Modulo').value;
    var tipo=document.getElementById('tipoVenta').value;
    var fechaFac=document.getElementById('fechaFactura').value;
    var formaPago=document.getElementById('tipoPago').value;
   
    var documento;
    var factRegistro=0;
    if(modulo=='VENTA'){
        documento=document.getElementById('idCliente').value;
    }else if(modulo=='COMPRA'){
        documento=document.getElementById('idProveedor').value;
        factRegistro=document.getElementById('factRegistro').value;
    }

    //++++++ datos de la persona +++//
    
    var Nombre1=document.getElementById('Nombre').value;
    var Direccion=document.getElementById('Dir').value;
    var Telefono=document.getElementById('TEL').value;
    var Ciudad=document.getElementById('Ciudad').value;
    var Correo=document.getElementById('correo').value;

    //alert("Los valores son: factura: "+factura+" Cantidad")

    if(documento=="" || Nombre1==''){
        alertify.alert('El documento y el nombre de la persona son datos obligatorios, Por favor seleccione o digite estos datos para poder continuar');
    }else if(cant==''){
        alertify.error('Por favor ingrese la cantidad');
    }else{
        $("#facturaImprimir").load('Facturar.php', {
            numFact:factura,
            factRegistro:factRegistro,
            modulo:modulo,
            tipo:tipo,
            fechaFac:fechaFac,
            formaPago:formaPago,
            documento:documento,
            Nombre1:Nombre1,
            Direccion:Direccion,
            Telefono:Telefono,
            Ciudad:Ciudad,
            Correo:Correo
        });

        if(modulo=='VENTA'){
            //document.getElementById("facturaImprimir").print();
            //window.print();
            cargarventas();
            alertify.success('Factura guardada satisfactoriamente');
        }else{
            cargarcompras();
            alertify.success('Factura guardada satisfactoriamente');

        }
    }
}

function eliminarArticuloTemp(id){
    var accion='Eliminar';
    var factura=document.getElementById('txtFact').value;
    if(id==""){
        alertify.alert('No se tiene Id del producto');
    }else{
        $("#listadoDeArticulos").load('listaProd.php', {accion:accion,idProd:id,Nfact:factura});
        alertify.success('Articulo eliminado');
    }
}

function cambiarPrecio(id,precio){
    var accion='CambiarPrecio';
    var factura=document.getElementById('txtFact').value;
    if(id==""){
        alertify.alert('No se tiene Id del producto');
    }else{
        $("#subTotal"+id).load('listaProd.php', {accion:accion,idProd:id,Nfact:factura,precio:precio},
            function(){
                $("#totalFactura").load('listaProd.php', {accion:'TotalFactura',Nfact:factura});
            }
        );
        
    }

    
}

function buscarProd(){
    var prodSelect = document.getElementById('cbo_producto').value;
    var modulo=document.getElementById('Modulo').value;
    if (prodSelect!=0 || prodSelect!=""){
        $('#verificacionArticulo').fadeIn();
        $('#verificacionArticulo').load("verificacionStock.php",{accion:"mensaje",modulo:modulo,IDprod:prodSelect});
        $('#resultadoVerificacion').load("verificacionStock.php",{accion:"valor",modulo:modulo,IDprod:prodSelect});
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

function cargarRegistroDeventas(){
    $("#parte1").load('Vistas/registroDeVentas.php',{modulo:'VENTA'});					
}

function cargarRegistroDeCompras(){
    $("#parte1").load('Vistas/registroDeVentas.php',{modulo:'COMPRA'});					
}

function cargarRegistroDeAgotados(){
    $("#parte1").load('Controlador/ctrlReportes.php',{modulo:'AGOTADOS'});					
}

function cargarReporteInventario(){
    $("#parte1").load('Controlador/ctrlReportes.php',{modulo:'INVENTARIO'});                    
}


function cargarReportes(){
        var dia = document.getElementById('dia').value;
        var mes = document.getElementById('mes').value;
        var anho = document.getElementById('anho').value;        
        var modulo=document.getElementById('moduloRep').value;
        
        //alertify.success("Los valores son:  dia: "+dia+" mes: "+mes+" año: "+anho+" modulo: "+modulo);
        
        if(dia!='' && mes!='' && anho!=''){
            $("#resultadoReporte").load("Controlador/ctrlReportes.php",{modulo:modulo,dia:dia,mes:mes,anho:anho,accion:"dia"},function(){
                alertify.success("Reporte diario cargado con éxito");
            });
            
        }
        
        if(dia=='' && mes!='' && anho!=''){
            $("#resultadoReporte").load("Controlador/ctrlReportes.php",{modulo:modulo,mes:mes,anho:anho,accion:"mes"},function(){
                alertify.success("Reporte Mensual cargado con éxito");
            });
            
        }
        
        if(dia=='' && mes=='' && anho!=''){
            $("#resultadoReporte").load("Controlador/ctrlReportes.php",{modulo:modulo,anho:anho,accion:"anho"},function(){
                alertify.success("Reporte Anual cargado con éxito"); 
            });
           
        }
        
}

function cargarResumen(){
    var mes = document.getElementById('mes').value;
    var anho = document.getElementById('anho').value;       
    var modulo=document.getElementById('moduloRep').value;
            
    if(anho!=''){
        $("#resultadoResumen").load("Controlador/ctrlReportes.php",{modulo:modulo,mes:mes,anho:anho,accion:"resumen"},function(){
            alertify.success("Resumen Anual cargado con éxito"); 
        });           
    }else{
        alertify.error("Por favor digite un año para poder realizar la consulta"); 
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

function cargarNuevoEmpleado(){
    $("#datosEmpleados").load("Controlador/ctrlEmpleados.php",{accion:'cargarNuevo'});
}

function addEmpleado(){           
    var idEmpleado  = document.getElementById("idEmpleado").value;
    var nombre1 = document.getElementById("nombre1").value;
    var nombre2 = document.getElementById("nombre2").value;
    var apellido1 = document.getElementById("apellido1").value;
    var apellido2 = document.getElementById("apellido2").value;
   var dir = document.getElementById("dir").value;
    var tel = document.getElementById("tel").value;
    var cargo = document.getElementById("cargo").value;
    var salario = document.getElementById("salario").value;
    var idNegocio = document.getElementById("negNum").value;
    $("#detallesEmpleados").load("Controlador/ctrlEmpleados.php",
        {
            accion:'agregarEmpleado',
            idEmpleado:idEmpleado,
            nombre1:nombre1,
            nombre2:nombre2,
            apellido1:apellido1,
            apellido2:apellido2,
            dir:dir,
            tel:tel,
            cargo:cargo,
            salario:salario,
            idNegocio:idNegocio
        },function(){
            cargarNuevoEmpleado();
        }
    );
}

function cargarEmpleado(idEmpleado){
    //alert("Esta en la funcion cargar el empleado: "+idEmpleado);
    alertify.message("Entró a la función para editar empleado");
    $("#datosEmpleados").load("Controlador/ctrlEmpleados.php",
        {
            accion:'cargarEmpleado',
            idEmpleado:idEmpleado
        }
    );
}

function cargarListaEmpleados(){
    $("#detallesEmpleados").load("Controlador/ctrlEmpleados.php",
        {
            accion:'cargarListaEmpleados'
        }
    );
}

function eliminarEmpleado(idEmpleado){
    var idNegocio = document.getElementById("negNum").value;

    alertify.defaults.transition = "flipy";
    alertify.defaults.theme.ok = "btn btn-primary";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";
    alertify.confirm(
        '<div class="panel-heading" style="background-color:#902015;color:#fff;"><i class="fa fa-times-circle"> Despedir/Eliminar Empleado</i></div>', 
        'Si desea continuar con la eliminacion del Empleado(a) presione el boton OK? .', 
        function()
        { 
            $("#detallesEmpleados").load("Controlador/ctrlEmpleados.php",
                {
                    accion:'eliminarEmpleado',
                    idEmpleado:idEmpleado,
                    idNegocio:idNegocio
                },function(){alertify.success('Empleado(a) Eliminada con éxito')}
            );
        }, 
        function()
        { 
            //alertify.error('Cancel')
        }
    );            
}

function actualizarEmpleado(antIdEmpleado){
    var ID_EMPLEADO = document.getElementById("ID_EMPLEADO").value;
    var NOMBRE1 = document.getElementById("NOMBRE1").value;
    var NOMBRE2 = document.getElementById("NOMBRE2").value;
    var APELLIDO1 = document.getElementById("APELLIDO1").value;
    var APELLIDO2 = document.getElementById("APELLIDO2").value;
    var DIR = document.getElementById("DIR").value;
    var TEL = document.getElementById("TEL").value;
    var CARGO = document.getElementById("CARGO").value;
    var SALARIO = document.getElementById("SALARIO").value;           

    $("#detallesEmpleados").load("Controlador/ctrlEmpleados.php",
        {
            accion:'actualizarEmpleado',
            anteriorId:antIdEmpleado,
            ID_EMPLEADO:ID_EMPLEADO,
            NOMBRE1:NOMBRE1,
            NOMBRE2:NOMBRE2,
            APELLIDO1:APELLIDO1,
            APELLIDO2:APELLIDO2,
            DIR:DIR,
            TEL:TEL,
            CARGO:CARGO,
            SALARIO:SALARIO
        },function(){
            cargarNuevoEmpleado();
        }
    );
}

function cargarPagos(idEmpleado){            
    $("#detallesEmpleados").load("Controlador/ctrlEmpleados.php",
        {
            accion:'cargarPagos',
            idEmpleado:idEmpleado
        }
    );
}

function cargarEditarPago(idEmpleado,idRecibo){ 
    $("#datoPagoEmpleado").load("Controlador/ctrlEmpleados.php",
        {
            accion:'cargarEditarPagos',
            idEmpleado:idEmpleado,
            idRecibo:idRecibo
        },function(){
            alertify.message("Entro a la funcion editar pago");
        }
    );
}

function cargarListaPagos(idEmpleado){
    $("#detallesEmpleados").load("Controlador/ctrlEmpleados.php",
        {
            accion:'cargarListaPagos',
            idEmpleado:idEmpleado
        }
    );
}

function agregarPagoEmpleado(idEmpleado){
    var valorPago = document.getElementById("VALOR_PAGO").value;
    var fechaPago = document.getElementById("FECHA_PAGO").value;
    /*
    alertify.message("Los valores a pasar son: Empleado "+idEmpleado+" Valor: "+valorPago+" fechaPago "+fechaPago);
    return;*/
    $("#listaPagos").load("Controlador/ctrlEmpleados.php",
        {
            accion:'agregarPago',
            idEmpleado:idEmpleado,
            valorPago:valorPago,
            fechaPago:fechaPago
        }
    );
}

function eliminarPagoEmpleado(idPago,idEmpleado){           

    alertify.defaults.transition = "flipy";
    alertify.defaults.theme.ok = "btn btn-primary";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";
    alertify.confirm(
        '<div class="panel-heading" style="background-color:#902015;color:#fff;"><i class="fa fa-times-circle"> Eliminar pago al Empleado</i></div>', 
        'Si desea continuar con la eliminacion del pago al Empleado(a) presione el boton OK? .', 
        function()
        { 
            $("#listaPagos").load("Controlador/ctrlEmpleados.php",
                {
                    accion:'eliminarPago',
                    idPago:idPago,
                    idEmpleado:idEmpleado
                }
            );
        }, 
        function()
        { 
            //alertify.error('Cancel')
        }
    ); 
    
}

function modificarPagoEmpleado(idPago,idEmpleado){
    var valorPago = document.getElementById("VALOR_PAGO").value;
    var fechaPago = document.getElementById("FECHA_PAGO").value;
    $("#datoPagoEmpleado").load("Controlador/ctrlEmpleados.php",
        {
            accion:'modificarPago',
            idEmpleado:idEmpleado,
            idPago:idPago,
            valorPago :valorPago,
             fechaPago: fechaPago
        });
}

//Funciones para el proveedor

function cargarNuevoProveedor(){
    $("#datosProveedores").load("Controlador/ctrlProveedores.php",{accion:'cargarNuevo'});
}

function addProveedor(){ 
    var idProveedor = document.getElementById("idProveedor").value;
    var nombre = document.getElementById("nombre").value;
    var DIR = document.getElementById("dir").value;
    var TEL = document.getElementById("tel").value;
    var ciudad = document.getElementById("ciudad").value;
    var correo = document.getElementById("correo").value; 
    $("#detallesProveedores").load("Controlador/ctrlProveedores.php",
        {
            accion:'agregarProveedor',
            idProveedor:idProveedor,
            nombre:nombre,
            DIR:DIR,
            TEL:TEL,
            ciudad:ciudad,
            correo:correo
        },function(){
            cargarNuevoProveedor();
        }
    );
}

function cargarProveedor(idProveedor){
    //alert("Esta en la funcion cargar el proveedor: "+idProveedor);
    alertify.message("Entró a la función para editar Proveedor");
    $("#datosProveedores").load("Controlador/ctrlProveedores.php",
        {
            accion:'cargarProveedor',
            idProveedor:idProveedor
        }
    );
}

function cargarListaProveedores(){
    $("#detallesProveedores").load("Controlador/ctrlProveedores.php",
        {
            accion:'cargarListaProveedores'
        }
    );
}

function eliminarProveedor(idProveedor){
    var idNegocio = document.getElementById("negNum").value;

    alertify.defaults.transition = "flipy";
    alertify.defaults.theme.ok = "btn btn-primary";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";
    alertify.confirm(
        '<div class="panel-heading" style="background-color:#902015;color:#fff;"><i class="fa fa-times-circle"> Eliminar Proveedor</i></div>', 
        'Si desea continuar con la eliminacion del Proveedor(a) presione el boton OK? .', 
        function()
        { 
            $("#detallesProveedores").load("Controlador/ctrlProveedores.php",
                {
                    accion:'eliminarProveedor',
                    idProveedor:idProveedor
                },function(){alertify.success('Proveedor(a) Eliminado con éxito')}
            );
        }, 
        function()
        { 
            //alertify.error('Cancel')
        }
    );            
}

function actualizarProveedor(antIdProveedor){
    var idProveedor = document.getElementById("idProveedor").value;
    var nombre = document.getElementById("nombre").value;
    var DIR = document.getElementById("dir").value;
    var TEL = document.getElementById("tel").value;
    var ciudad = document.getElementById("ciudad").value;
    var correo = document.getElementById("correo").value;           

    $("#detallesProveedores").load("Controlador/ctrlProveedores.php",
        {
            accion:'actualizarProveedor',
            anteriorId:antIdProveedor,
            idProveedor:idProveedor,
            nombre:nombre,
            DIR:DIR,
            TEL:TEL,
            ciudad:ciudad,
            correo:correo
        },function(){
            cargarNuevoProveedor();
        }
    );
}

function cargarListaPagosProveedor(idProveedor){
    //alert("Esta en la funcion cargar lista de pago al proveedor: "+idProveedor);
    $("#detallesProveedores").load("Controlador/ctrlProveedores.php",
        {
            accion:'cargarListaPagos',
            idProveedor:idProveedor
        }
    );
}

//Funciones para el cliente

function cargarNuevoCliente(){
    $("#datosClientes").load("Controlador/ctrlClientes.php",{accion:'cargarNuevo'});
}

function addCliente(){ 
    var idCliente = document.getElementById("idCliente").value;
    var nombre = document.getElementById("nombre").value;
    var DIR = document.getElementById("dir").value;
    var TEL = document.getElementById("tel").value;
    var ciudad = document.getElementById("ciudad").value;
    var correo = document.getElementById("correo").value; 
    $("#detallesClientes").load("Controlador/ctrlClientes.php",
        {
            accion:'agregarCliente',
            idCliente:idCliente,
            nombre:nombre,
            DIR:DIR,
            TEL:TEL,
            ciudad:ciudad,
            correo:correo
        },function(){
            cargarNuevoCliente();
        }
    );
}

function cargarCliente(idCliente){
    //alert("Esta en la funcion cargar el cliente: "+idCliente);
    alertify.message("Entró a la función para editar Cliente");
    $("#datosClientes").load("Controlador/ctrlClientes.php",
        {
            accion:'cargarCliente',
            idCliente:idCliente
        }
    );
}

function cargarListaClientes(){
    $("#detallesClientes").load("Controlador/ctrlClientes.php",
        {
            accion:'cargarListaClientes'
        }
    );
}

function eliminarCliente(idCliente){
    alertify.defaults.transition = "flipy";
    alertify.defaults.theme.ok = "btn btn-primary";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";
    alertify.confirm(
        '<div class="panel-heading" style="background-color:#902015;color:#fff;"><i class="fa fa-times-circle"> Eliminar Cliente</i></div>', 
        'Si desea continuar con la eliminacion del Cliente(a) presione el boton OK? .', 
        function()
        { 
            $("#detallesClientes").load("Controlador/ctrlClientes.php",
                {
                    accion:'eliminarCliente',
                    idCliente:idCliente
                },function(){alertify.success('Cliente(a) Eliminado con éxito')}
            );
        }, 
        function()
        { 
            //alertify.error('Cancel')
        }
    );            
}

function actualizarCliente(antIdCliente){
    var idCliente = document.getElementById("idCliente").value;
    var nombre = document.getElementById("nombre").value;
    var DIR = document.getElementById("dir").value;
    var TEL = document.getElementById("tel").value;
    var ciudad = document.getElementById("ciudad").value;
    var correo = document.getElementById("correo").value;           

    $("#detallesClientes").load("Controlador/ctrlClientes.php",
        {
            accion:'actualizarCliente',
            anteriorId:antIdCliente,
            idCliente:idCliente,
            nombre:nombre,
            DIR:DIR,
            TEL:TEL,
            ciudad:ciudad,
            correo:correo
        },function(){
            cargarNuevoCliente();
        }
    );
}

function cargarListaPagosCliente(idCliente){
    //alert("Esta en la funcion cargar lista de pago al cliente: "+idCliente);
    $("#detallesClientes").load("Controlador/ctrlClientes.php",
        {
            accion:'cargarListaPagos',
            idCliente:idCliente
        }
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