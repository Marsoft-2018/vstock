<script language=javascript>
function Relleno()
{
    var datos=new Array();
    var a;
    datos=document.Devoluciones_modulo.articulo.value.split("Ç");
    document.Devoluciones_modulo.ID.value=datos[0];
    document.Devoluciones_modulo.articulo1.value=datos[1];
    document.Devoluciones_modulo.ref.value=datos[2];
    document.Devoluciones_modulo.Pre_compra.value=datos[3];
    document.Devoluciones_modulo.Pre_venta.value=datos[4];
    document.Devoluciones_modulo.CANTIDAD2.value=datos[8];
    document.Devoluciones_modulo.Cant_final.value=datos[9];
    document.Devoluciones_modulo.V_UNIT.value= document.Devoluciones_modulo.Pre_venta.value;
    a=datos[9];
    parseInt(a);
     if(a<5)
     {
     window.alert("La cantidad de existencias de este articulo esta llegando a un nivel mínimo");
     }
}
function valorunitario()
{
	document.Devoluciones_modulo.V_UNIT.value=parseInt(document.Devoluciones_modulo.Pre_compra.value);
}

function multiplica()
{
	var a=parseInt(document.Devoluciones_modulo.V_UNIT.value);
	var b=parseInt(document.Devoluciones_modulo.CANTIDAD.value);
	var cant2=parseInt(document.Devoluciones_modulo.CANTIDAD2.value);
	var c_final=parseInt(document.Devoluciones_modulo.Cant_final.value);	
	var P_VENTA=parseInt(document.Devoluciones_modulo.Pre_venta.value);
	var P_COMPRA=parseInt(document.Devoluciones_modulo.Pre_compra.value);
	var vtotal;
	 document.Devoluciones_modulo.Cant_final.value=(c_final+b);
	if(c_final=0){
	  document.Devoluciones_modulo.CANTIDAD.value=0;
	}
	else{
	 vtotal=(a*b);
	 document.Devoluciones_modulo.V_TOTAL.value=-(parseInt(vtotal));
	 document.Devoluciones_modulo.CANTIDAD2.value =(cant2+b);
	 document.Devoluciones_modulo.GANANCIA.value =-(P_VENTA-P_COMPRA)*b;
	 }
}


</script>


<h2 style="text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);">MODULO DE DEVOLUCIONES</h2>
<div>       
    <div class="panel panel-warning">
        <div class="panel-heading clase3">
            <h4>DATOS DE LA DEVOLUCI&Oacute;N</h4>
        </div>
        <div class="panel-body clase3" id='vacciones'>
            <label for="">Tipo de devolución</label>
                                        <select name="modulo" id="modulo" class="form form-control">
                                            <option value="0">Seleccione..</option>
                                            <option value="devolucionCompra">En Compra</option>
                                            <option value="devolucionVenta">En Venta</option>
                                        </select>
                
        </div>
    </div>                   		