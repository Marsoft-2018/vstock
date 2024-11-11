function indexSales(bussines_id) {
  cart = [];
  var seccion_modulo = document.querySelector("#parte1");
  var data = {
    accion: "new",
    bussines_id: bussines_id,
  };

  axios
    .post("Controlador/ctrlSales.php", data)
    .then(function (res) {
      //console.log(res.data);
      if (res.status == 200) {
        seccion_modulo.innerHTML = res.data;
      }
    })
    .catch(function (err) {
      Swal.fire({
        position: "left-end",
        icon: "error",
        title: "Error",
        text: err,
      });
    });
}


function buscar() {
  var documento = document.getElementById("cargaClientes").value;
  var modulo = document.getElementById("Modulo").value;
  var accion = "Cargar";
  if (documento != "") {
    $("#datosCliente").load("CargarCliente.php", {
      documento: documento,
      modulo: modulo,
      accion: accion,
    });
  }
}

$("#tipoVenta").change(function () {
  var tipo = document.getElementById("tipoVenta").value;
  $("#tipoPago").load("formasdePago.php", { tipo: tipo });
});

function facturar() {
  var factura = document.getElementById("txtFact").value;
  var cant = document.getElementById("txt_cantidad").value;
  var modulo = document.getElementById("Modulo").value;
  var tipo = document.getElementById("tipoVenta").value;
  var fechaFac = document.getElementById("fechaFactura").value;
  var formaPago = document.getElementById("tipoPago").value;

  var documento;
  var factRegistro = 0;
  if (modulo == "VENTA") {
    documento = document.getElementById("idCliente").value;
  } else if (modulo == "COMPRA") {
    documento = document.getElementById("idProveedor").value;
    factRegistro = document.getElementById("factRegistro").value;
  }

  //++++++ datos de la persona +++//

  var Nombre1 = document.getElementById("Nombre").value;
  var Direccion = document.getElementById("Dir").value;
  var Telefono = document.getElementById("TEL").value;
  var Ciudad = document.getElementById("Ciudad").value;
  var Correo = document.getElementById("correo").value;

  //alert("Los valores son: factura: "+factura+" Cantidad")

  if (documento == "" || Nombre1 == "") {
    alertify.alert(
      "El documento y el nombre de la persona son datos obligatorios, Por favor seleccione o digite estos datos para poder continuar"
    );
  } else if (cant == "") {
    alertify.error("Por favor ingrese la cantidad");
  } else {
    $("#facturaImprimir").load("Facturar.php", {
      numFact: factura,
      factRegistro: factRegistro,
      modulo: modulo,
      tipo: tipo,
      fechaFac: fechaFac,
      formaPago: formaPago,
      documento: documento,
      Nombre1: Nombre1,
      Direccion: Direccion,
      Telefono: Telefono,
      Ciudad: Ciudad,
      Correo: Correo,
    });

    if (modulo == "VENTA") {
      //document.getElementById("facturaImprimir").print();
      //window.print();
      cargarSales();
      alertify.success("Factura guardada satisfactoriamente");
    } else {
      cargarcompras();
      alertify.success("Factura guardada satisfactoriamente");
    }
  }
}

function cambiarPrecio(id, precio) {
  var accion = "CambiarPrecio";
  var factura = document.getElementById("txtFact").value;
  if (id == "") {
    alertify.alert("No se tiene Id del product");
  } else {
    $("#subTotal" + id).load(
      "listaProd.php",
      { accion: accion, idProd: id, Nfact: factura, precio: precio },
      function () {
        $("#totalFactura").load("listaProd.php", {
          accion: "TotalFactura",
          Nfact: factura,
        });
      }
    );
  }
}

