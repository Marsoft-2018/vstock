let cart = [];
let totalPrice = 0;

function indexSales(bussines_id) {
    cart = [];
    totalPrice = 0;
    var seccion_modulo = document.querySelector("#parte1");
    var data = {
        accion: "new",
        bussines_id: bussines_id,
    };

    axios.post("Controlador/ctrlSales.php", data).then(function (res) {
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
// Función para cargar los productos en el select desde la base de datos
async function loadProducts() {
    try {
        const response = await fetch('ctrlProducts.php'); // Controlador PHP para obtener productos
        const products = await response.json();
        const productSelect = document.getElementById("productSelect");

        // Agregar opciones al select
        products.forEach(product => {
            const option = document.createElement("option");
            option.value = product.id;
            option.textContent = `${product.name} - $${product.price.toFixed(2)}`;
            productSelect.appendChild(option);
        });
    } catch (error) {
        console.error("Error al cargar productos:", error);
    }
}

// Llama a esta función cuando se haga clic en "Agregar al Carrito"
async function addSelectedProduct() {
    const productId = document.getElementById("productSelect").value;
    const quantity = parseInt(document.getElementById("productQuantity").value) || 1; // Capturar la cantidad especificada
    try {
    const response = await fetch(`Controlador/ctrlProducts.php?id=${productId}&bussines_id=1&accion=load`);
    const product = await response.json();
        // Añadir el producto al carrito con la cantidad especificada
        const existingProduct = cart.find(item => item[0].id === product[0].id);
        if (existingProduct) {
            existingProduct.quantity += quantity; // Sumar la cantidad nueva
        } else {
            cart.push({ ...product, quantity }); // Agregar como un nuevo item
        }
        displayCart();
    } catch (error) {
        console.error("Error al agregar producto al carrito:", error);
    }
}

// Muestra los productos en el carrito en el tbody y calcula el total
function displayCart() {
    
    const cartBody = document.getElementById("cartBody");
    cartBody.innerHTML = ""; // Limpiar contenido previo
    totalPrice = 0;
    cart.forEach((item, index) => {
        const subtotal = item[0].selling_price * item.quantity;
        totalPrice += subtotal;

        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${item[0].id} </td>
            <td>${item[0].name}</td>
            <td style="text-align: center;"> ${item.quantity} </td>
            <td style="text-align: right;"> $ ${item[0].selling_price}</td>
            <td style="text-align: right;">$ ${subtotal}</td>
            <td><button class="btn btn-outline-danger btn-sm" onclick="removeFromCart(${index})"><i class="fa fa-trash" ></i></button></td>
        `;
        cartBody.appendChild(row);
    });
    document.getElementById("total-price").innerText = `$ ${totalPrice}`;
}

// Función para eliminar un producto del carrito por su índice
function removeFromCart(index) {
    cart.splice(index, 1); // Elimina el producto del array usando su índice
    displayCart(); // Actualiza la vista del carrito
}

function prepareInvoice(bussines_id, accion) {
  switch (accion) {
    case "new":
      addSale(bussines_id);
      break;
    case "edit":
      //updateSale(bussines_id);
      break;
  }
  return false;
}

// Finaliza la compra y envía los datos del carrito a la base de datos
async function addSale(bussines_id) {    
    // Obtener el formulario y capturar sus datos
    const form = document.getElementById("formInvoice");
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
        const response = await axios.post('Controlador/ctrlSales.php', payload, {
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
            loadMaxId();
           
        } else {
            alert("Error al procesar la compra");
        }
    } catch (error) {
        console.error("Error al finalizar compra:", error);
    }
    return false;
}

async function loadMaxId(){
    const data = {
        accion: "loadMaxId"
    };

    try {
        const response = await axios.post('Controlador/ctrlSales.php', data, {
            headers: { 'Content-Type': 'application/json' }
        });
        if (response.status == 200) {
            document.getElementById("id").value =  response.data;
        }
    } catch (error) {
        console.error("Error al cargar proxima factura:", error);
    }
}

// Cargar productos al inicio
//loadProducts();
