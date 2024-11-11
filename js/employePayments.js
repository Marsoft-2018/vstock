
function indexEmployePayments(bussines_id, employe_id){
  var seccion_modulo = document.querySelector("#parte1");
  const data = {
    accion: "index",
    bussines_id : bussines_id,
    employe_id : employe_id
  };
  axios
    .post("Controlador/ctrlEmployePayments.php", data)
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

function listEmployePayments() {
  var seccion_modulo = document.querySelector("#parte1");
  const data = {
    accion: "listar"
  };
  axios
    .post("Controlador/ctrlEmployePayments.php", data)
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

function newEmployePayment(bussines_id,employe_id) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "Nuevo pago");
  const data = {
    accion: "new",
    bussines_id: bussines_id,
    employe_id: employe_id
  };
  axios
    .post("Controlador/ctrlEmployePayments.php", data)
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

function prepareEmployePayment(bussines_id,employe_id, accion) {
  console.log("Preparando el pago: "+bussines_id+" "+employe_id+" "+accion);
  switch (accion) {
    case "new":
      addEmployePayment(bussines_id, employe_id);
      break;
    case "edit":
      updateEmployePayment(bussines_id, employe_id);
      break;
  }
  return false;
}

function addEmployePayment(bussines_id, employe_id) {
  var formulario = document.querySelector("#formEmployePayment");
  var data = new FormData(formulario);
  data.append("accion", "add");
  data.append("bussines_id", bussines_id);
  data.append("employe_id", employe_id);

  axios
    .post("Controlador/ctrlEmployePayments.php", data)
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
        indexEmployePayments(bussines_id, employe_id);
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

function editEmployePayment(bussines_id, employe_id, id) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "Editar Pago");
  var data = {
    accion: "edit",
    bussines_id: bussines_id,
    employe_id: employe_id,
    id: id
  };

  axios
    .post("Controlador/ctrlEmployePayments.php", data)
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

function updateEmployePayment(bussines_id, employe_id) {
  var formulario = document.querySelector("#formEmployePayment");
  var data = new FormData(formulario);
  data.append("accion", "update");
  data.append("bussines_id", bussines_id);
  data.append("employe_id", employe_id);

  axios
    .post("Controlador/ctrlEmployePayments.php", data)
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
        indexEmployePayments(bussines_id, employe_id);
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

function deleteEmployePayment(bussines_id, employe_id, id) {
  Swal.fire({
    title: "¿Está seguro de eliminar este pago?",
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
        employe_id: employe_id
      };
      axios
        .post("Controlador/ctrlEmployePayments.php", data)
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
            indexEmployePayments(bussines_id, employe_id);
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

