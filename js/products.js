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

  axios.post("Controlador/ctrlProducts.php", data)
    .then(
      function (res) {
        //console.log(res.data);
        if (res.status == 200) {
          seccion_modulo.innerHTML = res.data;
        }
      }
    ).catch(function (err) {
      Swal.fire({
        position: "left-end",
        icon: "error",
        title: "Error",
        text: err,
      });
    }
  );
}

async function findProduct(text, bussines_id,section) {
  var data = {
    accion: "find",
    bussines_id: bussines_id,
    text: text,
  };
  
  if (text.length >=3) {
    try {
        const response = await axios.post("Controlador/ctrlProducts.php", data); // Petición con Axios
        const products = response.data; // La respuesta ya está en formato JSON con Axios
        const listProduct = document.getElementById("listProduct");
        listProduct.innerHTML = "";
        // Agregar opciones al select
        products.forEach(product => {
            const option = document.createElement("option");
            option.value = product.id;
            option.textContent = `${product.id} - ${product.name}`;
            listProduct.appendChild(option);
        });
    } catch (error) {
        console.error("Error al cargar productos:", error);
    }    
  }
}

function prepareProduct(event,bussines_id, accion,seccion) {
  event.preventDefault(); // Prevenir el envío predeterminado
  switch (accion) {
    case "new":
      addProduct(bussines_id,seccion);
      break;
    case "edit":
      updateProduct(bussines_id,seccion);
      break;
  }
  return false;
}
function addProduct(bussines_id,seccion) {
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
        if(seccion == "stock"){
          cargarInventario(bussines_id);
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

function updateProduct(bussines_id,seccion) {
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
        if(seccion == "stock"){
          cargarInventario(bussines_id);
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

function limpiar(id) {
  document.getElementById("" + id).value = "";
}


function pasarAcantidad(e) {
  tecla = document.all ? e.keyCode : e.which;
  if (tecla == 13) {
    //alert ('Has pulsado enter');
    document.getElementById("txt_cantidad").focus();
  }
}

function indexStockReturn(bussines_id){
  var seccion_modulo = document.querySelector("#parte1");
  var data = {
    accion: "indexStockReturn",
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
