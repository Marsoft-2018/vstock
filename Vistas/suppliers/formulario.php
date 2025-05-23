<?php 
  $id = "";
  $name = "";
  $address = "";
  $phone = "";
  $city = "";
  $email = "";
  $readonly =  "";
  if($accion == "edit"){
    $readonly = "readonly";
  }
if(isset($objSupplier)){
  foreach ($objSupplier->load() as $supplier) {
    $id = $supplier['id'];
    $name = $supplier['name'];
    $address = $supplier['address'];
    $phone = $supplier['phone'];
    $city = $supplier['city'];
    $email = $supplier['email'];
  }
}
?>
<form id="formSupplier" method="post" onsubmit="return prepareSupplier('1','<?php echo $accion; ?>')">
  <div class="mb-3">
    <label for="id" class="form-label">Nit/Documento</label>
    <input type="text" class="form-control" id="id" name="id" value="<?php echo $id;?>" required>    
  </div>
  <div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>" required>    
  </div>
  <div class="mb-3">
    <label for="address" class="form-label">Dirección</label>
    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address;?>" aria-describedby="">    
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Teléfono</label>
    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone;?>" aria-describedby="">    
  </div>
  <div class="mb-3">
    <label for="city" class="form-label">Ciudad</label>
    <input type="text" class="form-control" id="city" name="city" value="<?php echo $city;?>" aria-describedby="">    
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Correo</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>">
  </div>
  <button type="submit" class="btn btn-primary btn-lg mt-3" data-bs-dismiss="modal" aria-label="Close">Guardar</button>
</form>