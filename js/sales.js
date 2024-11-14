


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

