let cart = [];

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
       /* var data = {
            accion: "load",
            bussines_id: 1,
            id: productId,
          };
        
          const product = "";
          axios.post("Controlador/ctrlProducts.php", data).then(function (res) {
              //console.log(res.data);
              if (res.status == 200) {
                product = res.data;
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
*/
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

// Muestra los productos en el carrito y calcula el total
// function displayCart() {
//     console.log(cart);
    
//     const cartDiv = document.getElementById("cart");
//     cartDiv.innerHTML = "";
//     let totalPrice = 0;
//     cart.forEach(item => {
//         totalPrice += item[0].price * item.quantity;
//         const itemDiv = document.createElement("<tr>");
//         itemDiv.appendChild = `<td>${item[0].id} </td><td>${item[0].name} </td><td> ${item.quantity} </td><td> $${item[0].selling_price}</td><td> $${(item[0].selling_price * item.quantity).toFixed(2)}</td>`;
//         cartDiv.appendChild(itemDiv);
//     });
//     document.getElementById("total-price").innerText = `Total: $${totalPrice.toFixed(2)}`;
// }

// Muestra los productos en el carrito en el tbody y calcula el total
function displayCart() {
    console.log(cart);
    const cartBody = document.getElementById("cartBody");
    cartBody.innerHTML = ""; // Limpiar contenido previo
    let totalPrice = 0;
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

// Finaliza la compra y envía los datos del carrito a la base de datos
async function finalizarCompra() {
    try {
        const response = await fetch('guardarFactura.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(cart),
        });
        const result = await response.json();
        if (result.success) {
            alert("Compra realizada exitosamente");
            cart = []; // Vaciar carrito
            displayCart();
        } else {
            alert("Error al procesar la compra");
        }
    } catch (error) {
        console.error("Error al finalizar compra:", error);
    }
}

// Cargar productos al inicio
//loadProducts();
