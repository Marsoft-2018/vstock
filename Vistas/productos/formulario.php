<?php session_start(); ?>
<form id="formProduct" method="post" onsubmit="return addProduct('<?php echo $_SESSION['idNegocio']; ?>')">
  <div class="row mb-3">
    <label for="id" class="col-sm-2 col-form-label">Código</label>
    <div class="col-sm-10">
      <input type="text" name="id" class="form-control" id="id">
    </div>
  </div>
  <div class="row mb-3">
    <label for="name" class="col-sm-2 col-form-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" id="name">
    </div>
  </div>
  <div class="row mb-3">
    <label for="reference" class="col-sm-2 col-form-label">Referencia</label>
    <div class="col-sm-10">
      <input type="text" name="reference" class="form-control" id="reference">
    </div>
  </div>
  <div class="row mb-3">
    
    <label for="category_id" class="col-sm-2 col-form-label">Categoria</label>
    <div class="col-sm-10">
        <div class="input-group">
            <select name="category_id" class="form-select" id="category_id" aria-label="Default select example" required>
                <option selected>Seleccione...</option>
                <?php
                foreach ($objCategoria->listar() as $categoria) {
                ?>
                    <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['name'] ?></option> 
                <?php
                }
                ?>
            </select>
            <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
        </div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="measure_id" class="col-sm-2 col-form-label">Unidad de medida</label>
    <div class="col-sm-10">
        <div class="input-group">
            <select name="measure_id" class="form-select" id="measure_id" aria-label="Default select example" required>
                <option selected>Seleccione...</option>
                <?php
                foreach ($objMedida->listar() as $medida) {
                ?>
                    <option value="<?php echo $medida['id'] ?>"><?php echo $medida['name'] ?></option> 
                <?php
                }
                ?>
            </select>
            <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
        </div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="purchase_price" class="col-sm-2 col-form-label">Precio de compra</label>
    <div class="col-sm-10">
      <input type="number"  step="any" name="purchase_price" class="form-control" id="purchase_price">
    </div>
  </div>
  <div class="row mb-3">
    <label for="selling_price" class="col-sm-2 col-form-label">Precio de venta</label>
    <div class="col-sm-10">
      <input type="number"  step="any" name="selling_price" class="form-control" id="selling_price">
    </div>
  </div>
  <div class="row mb-3">
    <label for="initial_quantity" class="col-sm-2 col-form-label">Cant. Inicial</label>
    <div class="col-sm-10">
      <input type="number"  step="any" name="initial_quantity" class="form-control" id="initial_quantity">
    </div>
  </div>
  <div class="row mb-3">
    <label for="stock" class="col-sm-2 col-form-label">Existencias</label>
    <div class="col-sm-10">
      <input type="number"  step="any" name="stock" class="form-control" id="stock">
    </div>
  </div>
  <div class="row mb-3">
    <label for="min_quantity" class="col-sm-2 col-form-label">Cant. Mínima</label>
    <div class="col-sm-10">
      <input type="number"  step="any" name="min_quantity" class="form-control" id="min_quantity">
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-sm-10">
        <button type="submit" class="btn btn-primary btn-lg" data-bs-dismiss="modal" aria-label="Close">Guardar</button>
        <button type="button" class="btn btn-secondary  btn-lg mr-4" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
    </div>
  </div>
</form>