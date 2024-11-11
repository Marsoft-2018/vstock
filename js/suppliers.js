function indexSuppliers(bussines_id) {
  var seccion_modulo = document.querySelector("#parte1");
  const data = {
    accion: "index"
  };
  axios
    .post("Controlador/ctrlSuppliers.php", data)
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

function listarClientes() {
  var seccion_modulo = document.querySelector("#parte1");
  const data = {
    accion: "listar"
  };
  axios
    .post("Controlador/ctrlSuppliers.php", data)
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

function newSupplier(bussines_id) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "Nuevo Proveedor");
  const data = {
    accion: "new",
    bussines_id: bussines_id,
  };
  axios
    .post("Controlador/ctrlSuppliers.php", data)
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
function prepareSupplier(bussines_id, accion) {
  switch (accion) {
    case "new":
      addSupplier(bussines_id);
      break;
    case "edit":
      updateSupplier(bussines_id);
      break;
  }
  return false;
}
function addSupplier(bussines_id) {
  var formulario = document.querySelector("#formSupplier");
  var data = new FormData(formulario);
  data.append("accion", "add");
  data.append("bussines_id", bussines_id);

  axios
    .post("Controlador/ctrlSuppliers.php", data)
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
        indexSuppliers();
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

function editSupplier(id, bussines_id) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "Editar Proveedor");
  var data = {
    accion: "edit",
    bussines_id: bussines_id,
    id: id,
  };

  axios
    .post("Controlador/ctrlSuppliers.php", data)
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

function updateSupplier(bussines_id) {
  var formulario = document.querySelector("#formSupplier");
  var data = new FormData(formulario);
  data.append("accion", "update");
  data.append("bussines_id", bussines_id);

  axios
    .post("Controlador/ctrlSuppliers.php", data)
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
        indexSuppliers();
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

function deleteSupplier(id, bussines_id) {
  Swal.fire({
    title: "¿Está seguro de eliminar este cliente?",
    text: "\nPara eliminar los datos del registro preciona el botón SI, recuerde que al eliminar este Cliente  se eliminaran los datos relacionados con los movientos de compra y venta que se hallan hecho del mismo.",
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
        .post("Controlador/ctrlSuppliers.php", data)
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
            indexSuppliers();
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

