function loadBussines(bussines_id){
  var seccion_modulo = document.querySelector("#parte1");
  const data = {
    accion: "load",
    id: bussines_id,
  };
  axios
    .post("Controlador/ctrlBussines.php", data)
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


function updateBussines(bussines_id) {
  var formulario = document.querySelector("#formBussines");
  var data = new FormData(formulario);
  data.append("accion", "update");
  data.append("bussines_id", bussines_id);

  axios
    .post("Controlador/ctrlBussines.php", data)
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
        loadBussines(bussines_id);
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

//Funcion para previsualizar las fotos de los profesores -- codigo tomado de http://jsfiddle.net/LvsYc/-  Adaptado por mi//
function previsualizar(input) {
  var archivo = document.getElementById("LogoNegocio").files;
  var imagenAnterior = document.getElementById("fotoAnterior").value;

  var tamanho = archivo[0].size;
  var tipo = archivo[0].type;
  var nombre = archivo[0].name;
  if (tamanho > 1024 * 1024) {
    alertify.error(
      "El archivo supera el limite del tamaño máximo permitido de 1Mb"
    );
    $("#fotoUs").attr("src", "img/" + imagenAnterior);
    archivo.wrap("<form>").closest("formProfe").get(0).reset();
    archivo.unwrap();
  } else if (
    tipo != "image/jpg" &&
    tipo != "image/jpeg" &&
    tipo != "image/png"
  ) {
    alertify.error("Este tipo de archivo no es permitido");
    archivo.wrap("<form>").closest("formProfe").get(0).reset();
    archivo.unwrap();
    $("#fotoUs").attr("src", "img/" + imagenAnterior);
  } else {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#fotoUs").attr("src", e.target.result);
        $("#guardarIMG").fadeIn();
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
}

function cambiarLogo() {
  var datosFormulario = new FormData(document.getElementById("cambioLogo"));
  datosFormulario.append("accion", "cambiarLogo");
  $.ajax({
    url: "Controlador/ctrlNegocio.php",
    type: "post",
    data: datosFormulario,
    cahe: false,
    contentType: false,
    processData: false,
  }).done(function (respuesta) {
    $("#mostrarMensajeImagen").html(respuesta);
  });
}

$("#fotoVistaPrevia").hover(
  function () {
    $(this).find("a").fadeIn();
  },
  function () {
    $(this).find("a").fadeOut();
  }
);
$("#elegirIMG").on("click", function (e) {
  e.preventDefault();
  $("#LogoNegocio").click();
});
$("#guardarIMG").click(function () {
  $("#guardarIMG").fadeOut();
});
