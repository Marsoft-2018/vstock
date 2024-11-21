<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <!-- Modal para Editar Precio -->
    <div id="editPriceModal" style="display: none;">
        <div class="modal-content" >
            <h3>Editar Precio del Producto</h3>
            <form id="editPriceForm">
                <div class="row mt-2">
                    <div class="col">
                        <input type="hidden" id="editProductId" />
                        <label for="editProductName">Producto:</label>
                        <input class="form form-control" type="text" id="editProductName" readonly />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="editProductPrice">Nuevo Precio:</label>
                        <input class="form form-control" type="number" id="editProductPrice" step="0.01" required />
                    </div>
                </div>
            <div class="row mt-3">
                <div class="col">
                    <button class="btn btn-success btn-md btn-full" type="button" onclick="saveEditedPrice('<?php echo $modulo ?>')">Hecho</button>
                </div>
                <div class="col">
                    <button class="btn btn-secondary btn-md btn-full" type="button" onclick="closeModal()">Cancelar</button>
                </div>
            </div>
            </form>
        </div>
    </div>    
</body>
</html>