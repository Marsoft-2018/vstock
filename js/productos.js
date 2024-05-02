
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

function nuevoProducto(bussines_id){
    var seccion_modulo =document.querySelector('#modalBody');
    const seccion_titulo = document.querySelector('#exampleModalCenterTitle').innerHTML = "Nuevo Producto";
    const data = {
        "accion": "new",
        "bussines_id": bussines_id
    }
    axios.post('Controlador/ctrlProductos.php', data)
        .then(function(res) {
           //console.log(res.data);
            if(res.status == 200) {
                seccion_modulo.innerHTML = res.data;                
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
}

function addProduct(bussines_id){
    var formulario =document.querySelector('#formProduct');
    var data = new FormData(formulario); 
    data.append('accion', 'add');
    data.append('bussines_id', bussines_id);
    
    axios.post('Controlador/ctrlProductos.php', data)
        .then(function(res) {
            console.log(res.data);
            if(res.status == 200) {                
                Swal.fire(res.data, "", "success");
                cargarinventario2(bussines_id);            
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
    return false;  
}



function editarProducto(){
    var id=document.getElementById('cbo_producto').value;
    if(id!=""){
        acciones(id,1,2);
    }
}

	
function modificarProducto(acciones,tabla){
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
    Swal.fire({
        title: "¿Está seguro de eliminar este Articulo?",
        text: "\nPara eliminar los datos del registro preciona el botón SI, recuerde que al eliminar este producto del inventario se eliminaran los datos relacionados con los movientos de compra y venta que se hallan hecho del mismo.",
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: `No`
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            
            const data = {
                "accion": "delete",
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
                        Swal.fire(res.data, "", "success");
                        cargarinventario2(bussines_id);
                        
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
        } else if (result.isDenied) {
          //Swal.fire("Changes are not saved", "", "info");
        }
      });
    
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
