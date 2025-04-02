function logear() {
  var form = document.querySelector("#login");
  var data = new FormData(form);
  axios
    .post("Controlador/ctrlValidacion.php", data)
    .then(function (res) {
      //res = JSON.parse(res);
      //console.log(res.data['mensaje']);
      //console.log('Mensaje: '+res.data["mensaje"]);
      // respuesta = respuesta.trim();
      // console.log(respuesta);
      if (res.data["estado"] == 1) {
        let timerInterval;
        Swal.fire({
          title: "Login",
          icon: "success",
          html: "Sesión iniciada",
          timer: 1500,
          position: "top-end",
          showConfirmButton: false,
          timerProgressBar: false,
          didOpen: () => {
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
              timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
          },
          willClose: () => {
            clearInterval(timerInterval);
          },
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            window.location = "main.php";
          }
        });
      } else if (res.data["estado"] == 2) {
        Swal.fire({
          position: "bottom-end",
          icon: "warning",
          title: "Your work has been saved",
          showConfirmButton: false,
          timer: 1500,
        });
      } else if (res["estado"] == 3) {
        if (res["mensaje"] != "") {
        } else {
          window.location = "inicio.php";
        }
      } else if (res["estado"] == 4) {
      } else {
        Swal.fire({
          position: "bottom-start",
          icon: "error",
          title: res.data["mensaje"],
          showConfirmButton: false,
          timer: 1500,
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
  return false;
}

function salir() {
  top.location.href = "http://";
}

function limpiarAreaDeTrabajo() {
  document.getElementById("tablaPlanilla").innerHTML = "";
  //document.getElementById("tablaObservaciones").innerHTML='';
}

function loadProfile(userId){  
  var seccion_modulo = document.querySelector("#parte1");
  const data = {
    accion: "profile",
    id: userId
  };
  axios
    .post("Controlador/ctrlUsers.php", data)
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


function contrasena(usuario, rol) {
  alertify.defaults.transition = "flipy";
  alertify.defaults.theme.ok = "btn btn-primary";
  alertify.defaults.theme.cancel = "btn btn-danger";
  alertify.defaults.theme.input = "form-control";
  alertify
    .confirm(
      '<div class="alert" style="background-color:#098689; color:#fff; padding: 10px 10px;"><h3 style="padding: 0px; margin:0px;" ><i class="fa fa-user"> Cambiar Contraseña</i></h3></div>',
      '<form name="formulario" method="post" id="frmLogin" target="_self" class="animated zoomIn">' +
        "<label>Nueva contraseña</label>" +
        '<div class="input-group">' +
        '<span class="input-group-addon"><i class="fa fa-key"></i></span>' +
        '<input type="password" value="" class="form-control" placeholder="Nueva Contraseña" id="contrasena1" required="required">' +
        "</div>" +
        "<hr>" +
        "<label>Confirmar contraseña</label>" +
        '<div class="input-group">' +
        '<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>' +
        '<input type="password" value=""  class="form-control" placeholder="Confirmar Contraseña" id="contrasena2" required="required">' +
        "</div>" +
        "</form>",
      function () {
        var contrasena1 = document.getElementById("contrasena1").value;
        var contrasena2 = document.getElementById("contrasena2").value;
        var accion = "modificar";
        if (contrasena1 == contrasena2) {
          $.ajax({
            type: "POST",
            url: "Controlador/ctrlContrasenas.php",
            res: {
              accion: accion,
              usuario: usuario,
              contrasena: contrasena1,
              rol: rol,
            },
            success: function (respuesta) {
              alertify.success(respuesta);
              $("#contrasena").val(contrasena1);
            },
            error: function (respuesta) {
              console.log("test: " + respuesta);
            },
          });
        } else {
          alertify.error("Las contraseñas no coinciden");
          exit;
        }
      },
      function () {
        //alertify.error('Cancel')
      }
    )
    .set("closable", false);
}

function cambiarContrasenha(usuario, rol) {
  console.log("Rol: " + rol + " | Usuario: " + usuario);
  var accion = "modificar";
  let contrasena = $("#contrasena").val();
  let contrasena2 = $("#contrasena2").val();
  if (contrasena == contrasena2) {
    $.ajax({
      type: "POST",
      url: "Controlador/ctrlContrasenas.php",
      res: {
        accion: accion,
        usuario: usuario,
        rol: rol,
        contrasena: contrasena,
      },
      success: function (res) {
        alertify.success(res);
      },
    });
  } else {
    alertify.error(
      "<i class='fa fa-exclamation-circle'></i> Por favor verifique:<br>Las contraseñas deben ser iguales"
    );
  }
}


function newUser() {
  const seccion_titulo = (document.querySelector(
    "#staticBackdropLabel"
  ).innerHTML = "Nuevo usuario");
  const data = {
    accion: "new"
  };
  axios
    .post("Controlador/ctrlUsers.php", data)
    .then(function (res) {
      var seccion_modulo = document.querySelector("#staticBackdropBody");
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

function prepareUser(accion) {
  switch (accion) {
    case "add":
      addUser();
      break;
    case "update":
      updateUser();
      break;
  }
  return false;
}

function addUser() {
  var formulario = document.querySelector("#formUser");
  var data = new FormData(formulario);
  data.append("accion", "add"); 

  axios
    .post("Controlador/ctrlUsers.php", data)
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

function editUser(id) {
  const seccion_titulo = (document.querySelector(
    "#staticBackdropLabel"
  ).innerHTML = "Editar usuario");
  var data = {
    accion: "edit",
    id: id
  };

  axios
    .post("Controlador/ctrlUsers.php", data)
    .then(function (res) {        
      var seccion_modulo = document.querySelector("#staticBackdropBody");
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

function updateUser() {
  var formulario = document.querySelector("#formUser");
  var data = new FormData(formulario);
  data.append("accion", "update");

  axios
    .post("Controlador/ctrlUsers.php", data)
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

function deleteUser(id) {
  Swal.fire({
    title: "¿Está seguro de eliminar este usuario?",
    showDenyButton: true,
    confirmButtonText: "Si",
    denyButtonText: `No`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      const data = {
        accion: "delete",
        id: id
      };
      axios
        .post("Controlador/ctrlUsers.php", data)
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
            indexUsers();
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

function loadUserData(){
  var id = document.querySelector("#UserSelect").value;
  const data = {
    accion: "load",
    id: id
  };
  axios
    .post("Controlador/ctrlUsers.php", data)
    .then(function (res) {
      //console.log(res.data);
      if (res.status == 200) {
        console.log(res.data);
        Users = res.data
        if (Users.length > 0) {
          Users.forEach(User => {
            document.querySelector("#User_id").value = User.id;
            document.querySelector("#name").value = User.name;
            document.querySelector("#phone").value = User.phone;
            document.querySelector("#email").value = User.email;          
            document.querySelector("#address").value = User.address;
            document.querySelector("#city").value = User.city;
          });          
        }else{
          document.querySelector("#User_id").value = id;
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

