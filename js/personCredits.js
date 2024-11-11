
function indexPersonCredits(person){
  var seccion_modulo = document.querySelector("#parte1");
  const data = {
    accion: "index",
    person : person
  };
  axios
    .post("Controlador/ctrlPersonCredits.php", data)
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

function listPersonCredits(person,invoice_id,person_id, amount) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "LISTA DE ABONOS RELACIONADOS");
  const data = {
    accion: "list",
    person: person,
    person_id:person_id,
    invoice_id:invoice_id, 
    amount:amount
  };
  axios
    .post("Controlador/ctrlPersonCredits.php", data)
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

function newPersonCredit(person,invoice_id,person_id,pay_type) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "Nuevo pago");
  const data = {
    accion: "new",
    person: person,
    person_id: person_id,
    invoice_id: invoice_id,
    pay_type: pay_type
  };
  axios
    .post("Controlador/ctrlPersonCredits.php", data)
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

function preparePersonCredit(person,invoice_id,person_id, accion) {
  console.log("Preparando el pago: "+invoice_id+" "+person+" "+accion);
  switch (accion) {
    case "new":
      addPersonCredit(person,invoice_id,person_id);
      break;
    case "edit":
      updatePersonCredit(person,invoice_id,person_id);
      break;
  }
  return false;
}

function addPersonCredit(person,invoice_id,person_id) {
  var formulario = document.querySelector("#formCredit");
  var data = new FormData(formulario);
  data.append("accion", "add");
  data.append("invoice_id", invoice_id);
  data.append("person", person);
  data.append("person_id", person_id);

  axios
    .post("Controlador/ctrlPersonCredits.php", data)
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
        indexPersonCredits(person);
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

function editPersonCredit(person,invoice_id,person_id, id) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "Editar Pago");
  var data = {
    accion: "edit",
    invoice_id: invoice_id,
    person: person,
    person_id: person_id,
    id: id
  };

  axios
    .post("Controlador/ctrlPersonCredits.php", data)
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

function updatePersonCredit(person,invoice_id,person_id) {
  var formulario = document.querySelector("#formCredit");
  var data = new FormData(formulario);
  data.append("accion", "update");
  data.append("invoice_id", invoice_id);
  data.append("person", person);
  data.append("person_id", person_id);

  axios
    .post("Controlador/ctrlPersonCredits.php", data)
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
        indexPersonCredits(person);
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

function deletePersonCredit(bussines_id, person, id) {
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
        person: person
      };
      axios
        .post("Controlador/ctrlPersonCredits.php", data)
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
            indexPersonCredits(person);
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

