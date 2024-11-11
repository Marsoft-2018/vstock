
function loadCategories(bussines_id){
    /*var negNum =document.getElementById("negNum").value;
    $("#parte1").load('Controlador/ctrlCategorias.php',{accion:'Buscar',idneg:negNum});*/

    var seccion_modulo = document.querySelector("#parte1");
    const data = {
    accion: "list",
    bussines_id: bussines_id,
  };
  axios
    .post("Controlador/ctrlCategories.php", data)
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

function newCategory(bussines_id) {
    var seccion_modulo = document.querySelector("#modalBody");
    const seccion_titulo = (document.querySelector(
      "#exampleModalCenterTitle"
    ).innerHTML = "Nueva categoria");
    const data = {
      accion: "new",
      bussines_id: bussines_id,
    };
    axios
      .post("Controlador/ctrlCategories.php", data)
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

  
function editCategory(id, bussines_id) {
    var seccion_modulo = document.querySelector("#modalBody");
    const seccion_titulo = (document.querySelector(
      "#exampleModalCenterTitle"
    ).innerHTML = "Editar Categoria");
    var data = {
      accion: "edit",
      bussines_id: bussines_id,
      id: id,
    };
  
    axios
      .post("Controlador/ctrlCategories.php", data)
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

function prepareCategory(bussines_id, accion) {
    switch (accion) {
      case "new":
        addCategory(bussines_id);
        break;
      case "edit":
        updateCategory(bussines_id);
        break;
    }
    return false;
}

function addCategory(bussines_id) {
    var formulario = document.querySelector("#formCategory");
    var data = new FormData(formulario);
    data.append("accion", "add");
    data.append("bussines_id", bussines_id);
  
    axios
      .post("Controlador/ctrlCategories.php", data)
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
          loadCategories(bussines_id);
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
  

function updateCategory(bussines_id) {
    var formulario = document.querySelector("#formCategory");
    var data = new FormData(formulario);
    data.append("accion", "update");
    data.append("bussines_id", bussines_id);
  
    axios
      .post("Controlador/ctrlCategories.php", data)
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
          loadCategories(bussines_id);
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
  
  function deleteCategory(id, bussines_id) {
    Swal.fire({
      title: "¿Está seguro de eliminar esta Categoria?",
      text: "\nPara eliminar los datos del registro preciona el botón SI, recuerde que al eliminar esta Categoria del inventario se eliminaran los datos relacionados con los movientos de compra y venta que se hallan hecho del mismo.",
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
          .post("Controlador/ctrlCategories.php", data)
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
              loadCategories(bussines_id);
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
  
