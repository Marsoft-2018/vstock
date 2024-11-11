function indexEmployes(bussines_id) {
  var seccion_modulo = document.querySelector("#parte1");
  const data = {
    accion: "index",    
    bussines_id: bussines_id
  };
  axios
    .post("Controlador/ctrlEmployes.php", data)
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

function listEmployes() {
  var seccion_modulo = document.querySelector("#parte1");
  const data = {
    accion: "listar"
  };
  axios
    .post("Controlador/ctrlEmployes.php", data)
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

function newEmploye(bussines_id) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "Nuevo Empleado");
  const data = {
    accion: "new",
    bussines_id: bussines_id,
  };
  axios
    .post("Controlador/ctrlEmployes.php", data)
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

function prepareEmploye(bussines_id, accion) {
  switch (accion) {
    case "new":
      addEmploye(bussines_id);
      break;
    case "edit":
      updateEmploye(bussines_id);
      break;
  }
  return false;
}

function addEmploye(bussines_id) {
  var formulario = document.querySelector("#formEmploye");
  var data = new FormData(formulario);
  data.append("accion", "add");
  data.append("bussines_id", bussines_id);

  axios
    .post("Controlador/ctrlEmployes.php", data)
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
        indexEmployes(bussines_id);
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

function editEmploye(id, bussines_id) {
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
    .post("Controlador/ctrlEmployes.php", data)
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

function updateEmploye(bussines_id) {
  var formulario = document.querySelector("#formEmploye");
  var data = new FormData(formulario);
  data.append("accion", "update");
  data.append("bussines_id", bussines_id);

  axios
    .post("Controlador/ctrlEmployes.php", data)
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
        indexEmployes(bussines_id);
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

function deleteEmploye(id, bussines_id) {
  Swal.fire({
    title: "¿Está seguro de eliminar este empleado?",
    text: "\nPara eliminar los datos del registro preciona el botón SI, recuerde que al eliminar este empleado se eliminaran los datos relacionados con los pagos que se hallan hecho al mismo.",
    showDenyButton: true,
    confirmButtonText: "Si",
    denyButtonText: `No`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      const data = {
        accion: "delete",
        id: id,
        bussines_id: bussines_id
      };
      axios
        .post("Controlador/ctrlEmployes.php", data)
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
            indexEmployes(bussines_id);
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
