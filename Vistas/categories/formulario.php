<?php 
  session_start(); 
  $id = "";
  $name = "";
  $description = "";
  $status = 1;
  $readonly =  "";
  if($accion == "edit"){
    $readonly = "readonly";
  }
if(isset($objCategory)){
  foreach ($objCategory->load() as $category) {
    $id = $category['id'];
    $name = $category['name'];
    $description = $category['description'];
    $status = $category['status'];
  }
}
?>
<form id="formCategory" method="post" onsubmit="return prepareCategory('<?php echo $_SESSION['idNegocio']; ?>','<?php echo $accion; ?>')">
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
    <label for="description" class="col-sm-2 col-form-label">Descripción</label>
    <div class="col-sm-10">
      <input type="text" value="<?php echo $description; ?>" name="description" class="form-control" id="description">
    </div>
  </div>  
  <div class="row mb-3">
    <div class="col-sm-10">
        <button type="submit" class="btn btn-primary btn-lg" data-bs-dismiss="modal" aria-label="Close">Guardar</button>
        <button type="button" class="btn btn-secondary  btn-lg mr-4" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
    </div>
  </div>
</form>