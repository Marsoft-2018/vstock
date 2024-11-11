<?php 
  session_start(); 
  $id = "";
  $name = "";
  $reference = "";
  $purchase_price = "";
  $selling_price = "";
  $initial_quantity = "";
  $purchases = "";
  $sales = "";
  $stock_returns = "";
  $stock = "";
  $min_quantity = "";
  $bussines_id = "";
  $category_id = "";
  $measure_id = "";
  $readonly =  "";
  if($accion == "edit"){
    $readonly = "readonly";
  }
if(isset($objProduct)){
  foreach ($objProduct->load() as $product) {
    $id = $product['id'];
    $name = $product['name'];
    $reference = $product['reference'];
    $purchase_price = $product['purchase_price'];
    $selling_price = $product['selling_price'];
    $initial_quantity = $product['initial_quantity'];
    $stock = $product['stock'];
    $min_quantity = $product['min_quantity'];
    $bussines_id = $product['bussines_id'];
    $category_id = $product['category_id'];
    $measure_id = $product['measure_id'];
  }
}
?>
<form id="formProduct" method="post" onsubmit="return prepareProduct('<?php echo $_SESSION['idNegocio']; ?>','<?php echo $accion; ?>')">
  <div class="row mb-3">
    <label for="id" class="col-sm-2 col-form-label">Código</label>
    <div class="col-sm-10">
      <input type="text" value="<?php echo $id; ?>" name="id" class="form-control" id="id" <?php echo $readonly; ?> >
    </div>
  </div>
  <div class="row mb-3">
    <label for="name" class="col-sm-2 col-form-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" value="<?php echo $name; ?>" name="name" class="form-control" id="name">
    </div>
  </div>
  <div class="row mb-3">
    <label for="reference" class="col-sm-2 col-form-label">Referencia</label>
    <div class="col-sm-10">
      <input type="text" value="<?php echo $reference; ?>" name="reference" class="form-control" id="reference">
    </div>
  </div>
  <div class="row mb-3">
    
    <label for="category_id" class="col-sm-2 col-form-label">Categoria</label>
    <div class="col-sm-10">
        <div class="input-group">
            <select name="category_id" class="form-select" id="category_id" aria-label="Default select example" required>
                <option selected>Seleccione...</option>
                <?php
                foreach ($objCategory->list() as $categoria) {
                  $selected = "";
                  if($categoria['id'] == $category_id){
                    $selected = "selected";
                  }
                ?>
                    <option value="<?php echo $categoria['id'] ?>" <?php echo $selected ?>><?php echo $categoria['name'] ?></option> 
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
                  $selected = "";
                  if($medida['id'] == $measure_id){
                    $selected = "selected";
                  }
                ?>
                    <option value="<?php echo $medida['id'] ?>" <?php echo $selected; ?>><?php echo $medida['name'] ?></option> 
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
      <input type="number"  step="any" value="<?php echo $purchase_price; ?>" name="purchase_price" class="form-control" id="purchase_price">
    </div>
  </div>
  <div class="row mb-3">
    <label for="selling_price" class="col-sm-2 col-form-label">Precio de venta</label>
    <div class="col-sm-10">
      <input type="number"  step="any" value="<?php echo $selling_price; ?>" name="selling_price" class="form-control" id="selling_price">
    </div>
  </div>
  <div class="row mb-3">
    <label for="initial_quantity" class="col-sm-2 col-form-label">Cant. Inicial</label>
    <div class="col-sm-10">
      <input type="number"  step="any" value="<?php echo $initial_quantity; ?>" name="initial_quantity" class="form-control" id="initial_quantity">
    </div>
  </div>
  <div class="row mb-3">
    <label for="stock" class="col-sm-2 col-form-label">Existencias</label>
    <div class="col-sm-10">
      <input type="number"  step="any" value="<?php echo $stock; ?>" name="stock" class="form-control" id="stock">
    </div>
  </div>
  <div class="row mb-3">
    <label for="min_quantity" class="col-sm-2 col-form-label">Cant. Mínima</label>
    <div class="col-sm-10">
      <input type="number"  step="any" value="<?php echo $min_quantity; ?>" name="min_quantity" class="form-control" id="min_quantity">
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-sm-10">
        <button type="submit" class="btn btn-primary btn-lg" data-bs-dismiss="modal" aria-label="Close">Guardar</button>
        <button type="button" class="btn btn-secondary  btn-lg mr-4" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
    </div>
  </div>
</form>