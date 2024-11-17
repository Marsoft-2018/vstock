function cargarInventario(bussines_id) {
  var seccion_modulo = document.querySelector("#parte1");
  const data = {
    accion: "index",
    bussines_id: bussines_id,
  };
  axios
    .post("Controlador/ctrlProducts.php", data)
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

function newProduct(bussines_id) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "Nuevo Articulo o Producto");
  const data = {
    accion: "new",
    bussines_id: bussines_id,
  };
  axios
    .post("Controlador/ctrlProducts.php", data)
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

function loadProduct(id, bussines_id) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "Editar Articulo o Producto");
  var data = {
    accion: "load",
    bussines_id: bussines_id,
    id: id,
  };

  axios
    .post("Controlador/ctrlProducts.php", data)
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

function prepareProduct(bussines_id, accion) {
  switch (accion) {
    case "new":
      addProduct(bussines_id);
      break;
    case "edit":
      updateProduct(bussines_id);
      break;
  }
  return false;
}
function addProduct(bussines_id) {
  var formulario = document.querySelector("#formProduct");
  var data = new FormData(formulario);
  data.append("accion", "add");
  data.append("bussines_id", bussines_id);

  axios
    .post("Controlador/ctrlProducts.php", data)
    .then(function (res) {
      console.log(res.data);
      if (res.status == 200) {
        Swal.fire({
          position: "bottom-end",
          icon: "success",
          title: res.data,
          showConfirmButton: false,
          timer: 1500,
        });
        cargarInventario(bussines_id);
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
  return false;
}

function editProduct(id, bussines_id) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "Editar Product");
  var data = {
    accion: "edit",
    bussines_id: bussines_id,
    id: id,
  };

  axios
    .post("Controlador/ctrlProducts.php", data)
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

function updateProduct(bussines_id) {
  var formulario = document.querySelector("#formProduct");
  var data = new FormData(formulario);
  data.append("accion", "update");
  data.append("bussines_id", bussines_id);

  axios
    .post("Controlador/ctrlProducts.php", data)
    .then(function (res) {
      console.log(res.data);
      if (res.status == 200) {
        Swal.fire({
          position: "bottom-end",
          icon: "success",
          title: res.data,
          showConfirmButton: false,
          timer: 1500,
        });
        cargarInventario(bussines_id);
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
  return false;
}

function deleteProduct(id, bussines_id) {
  Swal.fire({
    title: "¿Está seguro de eliminar este Articulo?",
    text: "\nPara eliminar los datos del registro preciona el botón SI, recuerde que al eliminar este product del inventario se eliminaran los datos relacionados con los movientos de compra y venta que se hallan hecho del mismo.",
    showDenyButton: true,
    confirmButtonText: "Si",
    denyButtonText: `No`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      const data = {
        accion: "delete",
        id: id,
        bussines_id: bussines_id,
      };
      axios
        .post("Controlador/ctrlProducts.php", data)
        .then(function (res) {
          //res = JSON.parse(res);
          console.log(res.data);
          //console.log('Mensaje: '+res.data["mensaje"]);
          // respuesta = respuesta.trim();
          // console.log(respuesta);
          if (res.status == 200) {
            Swal.fire({
              position: "bottom-end",
              icon: "success",
              title: res.data,
              showConfirmButton: false,
              timer: 1500,
            });
            cargarInventario(bussines_id);
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
    } else if (result.isDenied) {
      //Swal.fire("Changes are not saved", "", "info");
    }
  });
}

function quantityStock(bussines_id) {
  var seccion_modulo = document.querySelector("#verificacionArticulo");
  var product_id = document.getElementById("productSelect").value;
  var data = {
    accion: "quantity_stock",
    product_id: product_id,
    bussines_id: bussines_id
  };

  axios
    .post("Controlador/ctrlProducts.php", data)
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

function ayudaMenu(mensaje, x) {
  if (x == 1) {
    $("#textoMenu").display = "block";
    $("#textoMenu").slideDown("fast");
    document.getElementById("textoMenu").innerHTML = " " + mensaje;
  } else {
    $("#textoMenu").display = "none";
    $("#textoMenu").slideDown("fast");
    document.getElementById("textoMenu").innerHTML = " ";
  }
}

function limpiar(id) {
  document.getElementById("" + id).value = "";
}

function AgregarAR(modulo) {
  //var nuevo=document.getElementById('esNuevo').value;
  nuevo = document.getElementById("registrado").value;
  var factura = document.getElementById("txtFact").value;
  var cant = document.getElementById("txt_cantidad").value;
  var id = document.getElementById("cbo_product").value;
  var idNegocio = document.getElementById("negNum").value;
  var accion = "Agregar";
  //alertify.alert("Esta en la funcion agregar articulo, la variable nuevo es: "+nuevo);

  if (nuevo == "Nuevo") {
    //$('#Bingresar').css('display','none');

    //Proceso de ingreso del articulo en el inventario
    var nombreArticulo = document.getElementById("nombreNuevoArticulo").value;
    var referencia = document.getElementById("referenciaNuevoArticulo").value;
    var categoria = document.getElementById("categoriaNuevoArticulo").value;
    var medida = $("#medida").val();
    var precioCompra = document.getElementById(
      "precioDeCompraNuevoArticulo"
    ).value;
    var precioVenta = document.getElementById(
      "precioDeVentaNuevoArticulo"
    ).value;
    if (cant == "") {
      alertify.error("Por favor ingrese la cantidad");
    } else if (
      nombreArticulo == "" ||
      referencia == "" ||
      categoria == "" ||
      precioCompra == "" ||
      precioVenta == ""
    ) {
      alertify.alert(
        "Los datos del nuevo articulo son necesarios para agregarlo al inventario, complete estos datos para poder continuar"
      );
    } else {
      //alertify.alert("Los valores de las variables son: Articulo: "+nombreArticulo+" referencia: "+referencia+" cantidad: "+cant+" categoria: "+categoria+" P. Compra: "+precioCompra+" P. Venta: "+precioVenta+" Factura: "+factura+" Negocio: "+idNegocio);
      //para registrar el nuevo articulo en el inventario
      $("#verificacionArticulo").load(
        "listaProd.php",
        {
          Nfact: factura,
          idNegocio: idNegocio,
          idProd: id,
          nombreArticulo: nombreArticulo,
          referencia: referencia,
          categoria: categoria,
          precioCompra: precioCompra,
          precioVenta: precioVenta,
          Cantidad: 0,
          accion: "Nuevo",
          medida: medida,
        },
        function () {
          $("#listadoDeArticulos").load("listaProd.php", {
            Nfact: factura,
            idProd: id,
            Cantidad: cant,
            accion: accion,
            modulo: modulo,
          });
          $("#verificacionArticulo").fadeOut("slow", function () {
            alertify.success(
              "El Articulo: " +
                nombreArticulo +
                " Ref: " +
                referencia +
                " cantidad: " +
                cant +
                "\n Fue Agregado al inventario"
            );
          });
        }
      );
    }
  } else {
    if (id == "") {
      alertify.error("Por favor seleccione un product de la lista");
    } else if (cant == "") {
      alertify.error("Por favor ingrese la cantidad");
    } else {
      $("#listadoDeArticulos").load("listaProd.php", {
        Nfact: factura,
        idProd: id,
        Cantidad: cant,
        accion: accion,
        modulo: modulo,
      });
    }
  }
}

function pasarAcantidad(e) {
  tecla = document.all ? e.keyCode : e.which;
  if (tecla == 13) {
    //alert ('Has pulsado enter');
    document.getElementById("txt_cantidad").focus();
  }
}

$("#cargaClientes").change(function () {
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
});

function actualizarDato(campo, clave, valor) {
  var modulo = document.getElementById("Modulo").value;
  var accion = "Actualizar";

  $("#resultadoActualizacion").load(
    "CargarCliente.php",
    {
      modulo: modulo,
      accion: accion,
      campo: campo,
      clave: clave,
      valor: valor,
    },
    function () {
      alertify.success("Dato Actualizado Con éxito");
    }
  );
}

function editarPerfil(usuario) {
  //alert("Funcion editar perfil: "+usuario);
  $("#parte1").load("EditarPerfil.php", { usuario: usuario });
}

function agregarCategoriaDirecta() {
  var negNum = document.getElementById("negNum").value;
  var nombreCategoria = document.getElementById("categoriaNuevoArticulo").value;
  if (nombreCategoria == "") {
    alertify.error("Por favor ingrese un nombre válido para la categoria");
  } else {
    $("#registrarCategorias").load(
      "Controlador/ctrlCategorias.php",
      {
        accion: "AgregarCategoriaArticuloNuevo",
        idneg: negNum,
        nombreCategoria: nombreCategoria,
      },
      function () {
        //alertify.success("Se encuentra el la funcion agregar categoria, variables: Negocio"+negNum+" categoria: "+nombreCategoria);
      }
    );
  }
}

function cargarRegistroDeventas() {
  $("#parte1").load("Vistas/registroDeVentas.php", { modulo: "VENTA" });
}

function cargarRegistroDeCompras() {
  $("#parte1").load("Vistas/registroDeVentas.php", { modulo: "COMPRA" });
}

function cargarRegistroDeAgotados() {
  $("#parte1").load("Controlador/ctrlReportes.php", { modulo: "AGOTADOS" });
}

function cargarReporteInventario() {
  $("#parte1").load("Controlador/ctrlReportes.php", { modulo: "INVENTARIO" });
}

function cargarReportes() {
  var dia = document.getElementById("dia").value;
  var mes = document.getElementById("mes").value;
  var anho = document.getElementById("anho").value;
  var modulo = document.getElementById("moduloRep").value;

  //alertify.success("Los valores son:  dia: "+dia+" mes: "+mes+" año: "+anho+" modulo: "+modulo);

  if (dia != "" && mes != "" && anho != "") {
    $("#resultadoReporte").load(
      "Controlador/ctrlReportes.php",
      { modulo: modulo, dia: dia, mes: mes, anho: anho, accion: "dia" },
      function () {
        alertify.success("Reporte diario cargado con éxito");
      }
    );
  }

  if (dia == "" && mes != "" && anho != "") {
    $("#resultadoReporte").load(
      "Controlador/ctrlReportes.php",
      { modulo: modulo, mes: mes, anho: anho, accion: "mes" },
      function () {
        alertify.success("Reporte Mensual cargado con éxito");
      }
    );
  }

  if (dia == "" && mes == "" && anho != "") {
    $("#resultadoReporte").load(
      "Controlador/ctrlReportes.php",
      { modulo: modulo, anho: anho, accion: "anho" },
      function () {
        alertify.success("Reporte Anual cargado con éxito");
      }
    );
  }
}

function cargarResumen() {
  var mes = document.getElementById("mes").value;
  var anho = document.getElementById("anho").value;
  var modulo = document.getElementById("moduloRep").value;

  if (anho != "") {
    $("#resultadoResumen").load(
      "Controlador/ctrlReportes.php",
      { modulo: modulo, mes: mes, anho: anho, accion: "resumen" },
      function () {
        alertify.success("Resumen Anual cargado con éxito");
      }
    );
  } else {
    alertify.error("Por favor digite un año para poder realizar la consulta");
  }
}
