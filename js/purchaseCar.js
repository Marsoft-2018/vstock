function indexPurchases(bussines_id) {
    cart = [];
    totalPrice = 0;
    var seccion_modulo = document.querySelector("#parte1");
    var data = {
        accion: "new",
        bussines_id: bussines_id,
    };

    axios.post("Controlador/ctrlPurchases.php", data).then(function (res) {
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

function preparePurchaseInvoice(bussines_id, accion) {
  switch (accion) {
    case "new":
      addPurchase(bussines_id);
      break;
    case "edit":
      //updatePurchase(bussines_id);
      break;
  }
  return false;
}

// Finaliza la compra y envía los datos del carrito a la base de datos
async function addPurchase(bussines_id) {    
    // Obtener el formulario y capturar sus datos
    const form = document.getElementById("formPurchaseInvoice");
    const formData = new FormData(form); // Captura el contenido del formulario
    const formObject = Object.fromEntries(formData.entries()); // Convierte a un objeto

  // Combina los datos del carrito y el formulario en un solo objeto
    const payload = {
        accion: "add",
        bussines_id: bussines_id,
        amount: totalPrice,
        cart: cart,
        invoiceDetails: formObject // Agrega los detalles de facturación del formulario
    };

    try {
        const response = await axios.post('Controlador/ctrlPurchases.php', payload, {
            headers: { 'Content-Type': 'application/json' }
        });

        if(response.data.success) {
            Swal.fire({
                position: "bottom-end",
                icon: "success",
                title: response.data.message,
                showConfirmButton: false,
                timer: 1500,
            });
            cart = []; // Vaciar carrito
            displayCart();
            form.reset(); // Opcional: Resetear el formulario tras la compra           
        } else {
            alert("Error al procesar la compra");
        }
    } catch (error) {
        console.error("Error al finalizar compra:", error);
    }
    return false;
}
