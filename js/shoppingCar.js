let cart = [];
let totalPrice = 0;

function indexSales(bussines_id) {
    cart = [];
    totalPrice = 0;
    var seccion_modulo = document.querySelector("#parte1");
    loading("parte1");
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
async function addSelectedProduct(process) {
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
        displayCart(process);
    } catch (error) {
        console.error("Error al agregar producto al carrito:", error);
    }
}

// Muestra los productos en el carrito en el tbody y calcula el total
function displayCart(process) {
    
    const cartBody = document.getElementById("cartBody");
    cartBody.innerHTML = ""; // Limpiar contenido previo
    let total = 0;
    cart.forEach((item, index) => {
        let price = item[0].selling_price;
        let subtotal = item[0].selling_price * item.quantity;
        if(process == "purchase"){
            subtotal = item[0].purchase_price * item.quantity;
            price = item[0].purchase_price;
        }
        total += subtotal;

        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${item[0].id} </td>
            <td>${item[0].name}</td>
            <td style="text-align: center;"> ${item.quantity} </td>
            <td style="text-align: right;"> $ ${price}</td>
            <td style="text-align: right;">$ ${subtotal}</td>
            <td><button type='button' class="btn btn-outline-warning btn-sm" onclick="openEditPriceModal('${item[0].id}','${process}')"><i class="fa fa-edit"></i></button></td>
            <td><button class="btn btn-outline-danger btn-sm" onclick="removeFromCart(${index})"><i class="fa fa-trash" ></i></button></td>
            
        `;
        cartBody.appendChild(row);
    });
    document.getElementById("total-price").innerText = `$ ${total}`;
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
async function addSale(bussines_id){    
    // Obtener el formulario y capturar sus datos
    const form = document.getElementById("formInvoice");
    const formData = new FormData(form); // Captura el contenido del formulario
    const formObject = Object.fromEntries(formData.entries()); // Convierte a un objeto
    const invoiceId = document.getElementById("id").value;
  // Combina los datos del carrito y el formulario en un solo objeto
    const payload = {
        accion: "add",
        bussines_id: bussines_id,
        amount: totalPrice,
        cart: cart,
        invoiceDetails: formObject // Agrega los detalles de facturación del formulario
    };
    if (!cart.length > 0) {
        Swal.fire({
            position: "top-end",
            icon: "info",
            title: "No existen productos en la factura, por favor agregalos para poder continuar",
            showConfirmButton: false,
            timer: 5000,
        });
        return false;
    }
    try {
        const response = await axios.post('Controlador/ctrlSales.php', payload, {
            headers: { 'Content-Type': 'application/json' }
        });

        if(response.data.success) {
            cart = []; // Vaciar carrito
            displayCart('sale');
            form.reset(); // Opcional: Resetear el formulario tras la compra
            loadInvoice("VENTA",invoiceId,bussines_id,'modalBody');
            Swal.fire({
                position: "bottom-end",
                icon: "success",
                title: response.data.message,
                showConfirmButton: false,
                timer: 1500,
            });
            loadMaxId('sale');
           
        } else {
            Swal.fire({
                position: "bottom-end",
                icon: "error",
                title: "Error al procesar la compra",
                showConfirmButton: false,
                timer: 1500,
            });
        }
    } catch (error) {
        Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: error,
            showConfirmButton: false,
            timer: 1500,
        });
        console.error("Error al finalizar compra:", error);
    }
    return false;
}

async function loadMaxId(section){
    console.log(section);
    
    let url = 'Controlador/ctrlSales.php';
    if (section == "purchase") {
        url = 'Controlador/ctrlPurchases.php';
    }
    const data = {
        accion: "loadMaxId"
    };

    try {
        const response = await axios.post(url, data, {
            headers: { 'Content-Type': 'application/json' }
        });
        if (response.status == 200) {
            document.getElementById("id").value =  response.data;
        }
    } catch (error) {
        console.error("Error al cargar proxima factura:", error);
    }
}

// Función para guardar los cambios del precio
function saveEditedPrice(process) {
    // Obtén los valores del formulario
    const productId = document.getElementById('editProductId').value;
    const newPrice = parseFloat(document.getElementById('editProductPrice').value);

    if (isNaN(newPrice) || newPrice <= 0) {
        Swal.fire({
            position: "bottom-end",
            icon: "error",
            text: 'Por favor, ingrese un precio válido.',
            showConfirmButton: false,
            timer: 1500,
        });
        return;
    }

    // Encuentra el producto en el carrito y actualiza su precio
    const product = cart.find(item => item[0].id === productId);
    if (product) {
        if(process == 'purchase'){
            product[0].purchase_price = newPrice;
        }else{
            product[0].selling_price = newPrice;
        }
        Swal.fire({
            position: "bottom-end",
            icon: "success",
            title:'Precio actualizado',
            text: `El precio del producto ${product[0].name} en esta factura se actualizó a ${newPrice}.`,
            showConfirmButton: false,
            timer: 3000,
        });
    } else {
        Swal.fire({
            position: "bottom-end",
            icon: "error",
            text: 'Producto no encontrado.',
            showConfirmButton: false,
            timer: 1500,
        });
    }

    // Oculta el modal y actualiza la tabla del carrito
    closeModal();
    displayCart(process); // Esta función actualiza la tabla del carrito
}

// Función para abrir el modal y cargar los datos del producto
function openEditPriceModal(productId,process) {
    // Busca el producto en el carrito
    const product = cart.find(item => item[0].id === productId);
    if (!product) {
        Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: 'Producto no encontrado.',
            showConfirmButton: false,
            timer: 1500,
        });
        return;
    }
    price = product[0].selling_price;
    if(process == 'purchase'){
        price = product[0].purchase_price;
    }
    // Rellena el modal con los datos del producto
    document.getElementById('editProductId').value = productId;
    document.getElementById('editProductName').value = product[0].name;
    document.getElementById('editProductPrice').value = price;

    // Muestra el modal
    document.getElementById('editPriceModal').style.display = 'block';
}

// Función para cerrar el modal
function closeModal() {
    document.getElementById('editPriceModal').style.display = 'none';
}