
function indexPayForm(){
    var seccion_modulo = document.querySelector("#parte1");
    const data = {
    accion: "index",
  };
  axios
    .post("Controlador/ctrlPayForms.php", data)
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

function loadPayForm(type_sale){
  var select_tipoPago = document.querySelector("#tipoPago");
  select_tipoPago.innerHTML= "";
    const data = {
    accion: "listFilter",
    type_sale: type_sale
  };
  axios
    .post("Controlador/ctrlPayForms.php", data)
    .then(function (res) {
      //console.log(res.data);
      if (res.status == 200) {
        console.log(res.data);
        payForms = res.data
        payForms.forEach(payForm => {
            const option = document.createElement("option");
            option.value = payForm.name;
            option.textContent = `${payForm.name}`;
            select_tipoPago.appendChild(option);
        });
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

function newPayForm() {
    var seccion_modulo = document.querySelector("#modalBody");
    const seccion_titulo = (document.querySelector(
      "#exampleModalCenterTitle"
    ).innerHTML = "Nueva tipo de pago");
    const data = {
      accion: "new",

    };
    axios
      .post("Controlador/ctrlPayForms.php", data)
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

  
function editPayForm(id) {
    var seccion_modulo = document.querySelector("#modalBody");
    const seccion_titulo = (document.querySelector(
      "#exampleModalCenterTitle"
    ).innerHTML = "Editar tipo de pago");
    var data = {
      accion: "edit",
      id: id
    };
  
    axios
      .post("Controlador/ctrlPayForms.php", data)
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

function preparePayForm(accion) {
    switch (accion) {
      case "new":
        addPayForm();
        break;
      case "edit":
        updatePayForm();
        break;
    }
    return false;
}

function addPayForm() {
    var formulario = document.querySelector("#formPayForm");
    var data = new FormData(formulario);
    data.append("accion", "add");  
    axios
      .post("Controlador/ctrlPayForms.php", data)
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
          loadPayForms();
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
  

function updatePayForm() {
    var formulario = document.querySelector("#formPayForm");
    var data = new FormData(formulario);
    data.append("accion", "update");  
    axios
      .post("Controlador/ctrlPayForms.php", data)
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
          loadPayForms();
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
  
  function deletePayForm(id ) {
    Swal.fire({
      title: "¿Está seguro de eliminar esta tipo de pago?",
      showDenyButton: true,
      confirmButtonText: "Si",
      denyButtonText: `No`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        const data = {
          accion: "delete",
          id: id,
    
        };
        axios
          .post("Controlador/ctrlPayForms.php", data)
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
              loadPayForms();
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
  
