function indexCustomers(bussines_id) {
  var seccion_modulo = document.querySelector("#parte1");
  const data = {
    accion: "index"
  };
  axios
    .post("Controlador/ctrlCustomers.php", data)
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
    .post("Controlador/ctrlCustomers.php", data)
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

function newCustomer(bussines_id) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "Nuevo Cliente");
  const data = {
    accion: "new",
    bussines_id: bussines_id,
  };
  axios
    .post("Controlador/ctrlCustomers.php", data)
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

function prepareCustomer(bussines_id, accion) {
  switch (accion) {
    case "new":
      addCustomer(bussines_id);
      break;
    case "edit":
      updateCustomer(bussines_id);
      break;
  }
  return false;
}

function addCustomer(bussines_id) {
  var formulario = document.querySelector("#formCustomer");
  var data = new FormData(formulario);
  data.append("accion", "add");
  data.append("bussines_id", bussines_id);

  axios
    .post("Controlador/ctrlCustomers.php", data)
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
        indexCustomers();
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

function editCustomer(id, bussines_id) {
  var seccion_modulo = document.querySelector("#modalBody");
  const seccion_titulo = (document.querySelector(
    "#exampleModalCenterTitle"
  ).innerHTML = "Editar Cliente");
  var data = {
    accion: "edit",
    bussines_id: bussines_id,
    id: id,
  };

  axios
    .post("Controlador/ctrlCustomers.php", data)
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

function updateCustomer(bussines_id) {
  var formulario = document.querySelector("#formCustomer");
  var data = new FormData(formulario);
  data.append("accion", "update");
  data.append("bussines_id", bussines_id);

  axios
    .post("Controlador/ctrlCustomers.php", data)
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
        indexCustomers();
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

function deleteCustomer(id, bussines_id) {
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
        .post("Controlador/ctrlCustomers.php", data)
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
            indexCustomers();
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

function loadCustomerData(){
  var id = document.querySelector("#customerSelect").value;
  const data = {
    accion: "load",
    id: id
  };
  axios
    .post("Controlador/ctrlCustomers.php", data)
    .then(function (res) {
      //console.log(res.data);
      if (res.status == 200) {
        console.log(res.data);
        customers = res.data
        if (customers.length > 0) {
          customers.forEach(customer => {
            document.querySelector("#id").value = customer.id;
            document.querySelector("#name").value = customer.name;
            document.querySelector("#phone").value = customer.phone;
            document.querySelector("#email").value = customer.email;          
            document.querySelector("#address").value = customer.address;
            document.querySelector("#city").value = customer.city;
          });          
        }else{
          document.querySelector("#id").value = id;
            document.querySelector("#name").value = "";
            document.querySelector("#phone").value = "";
            document.querySelector("#email").value = "";          
            document.querySelector("#address").value = "";
            document.querySelector("#city").value = "";
        }
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

