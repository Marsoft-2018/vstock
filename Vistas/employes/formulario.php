<?php 
  session_start(); 
  $id = "";
  $first_name = "";
  $second_name = "";
  $first_last_name = "";
  $second_last_name = "";
  $address = "";
  $phone = "";
  $job = "";
  $income = "";
  $status = "";
  $readonly =  "";
  if($accion == "edit"){
    $readonly = "readonly";
  }
if(isset($objEmploye)){
  foreach ($objEmploye->load() as $employe) {
    $id = $employe['id'];
    $first_name = $employe['first_name'];
    $second_name = $employe['second_name'];
    $first_last_name = $employe['first_last_name'];
    $second_last_name = $employe['second_last_name'];
    $address = $employe['address'];
    $phone = $employe['phone'];
    $job = $employe['job'];
    $income = $employe['income'];
  }
}
?>
<form id="formEmploye" method="post" onsubmit="return prepareEmploye('<?php echo $_SESSION['idNegocio']; ?>','<?php echo $accion; ?>')">
  <div class="mb-3">
    <label for="id" class="form-label"><span style="color:#F00;">*</span> Documento</label>
    <input type="text" class="form-control" id="id" name="id" value="<?php echo $id;?>" required <?php echo $readonly;?>>    
  </div>
  <div class="mb-3">
    <label for="first_name" class="form-label"><span style="color:#F00;">*</span> Primer Nombre</label>
    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name;?>" required>    
  </div>
  <div class="mb-3">
    <label for="second_name" class="form-label">Segundo Nombre</label>
    <input type="text" class="form-control" id="second_name" name="second_name" value="<?php echo $second_name;?>">    
  </div>
  <div class="mb-3">
    <label for="first_last_name" class="form-label"><span style="color:#F00;">*</span> Primer Apellido</label>
    <input type="text" class="form-control" id="first_last_name" name="first_last_name" value="<?php echo $first_last_name;?>" required>    
  </div>
  <div class="mb-3">
    <label for="second_last_name" class="form-label">Segundo Apellido</label>
    <input type="text" class="form-control" id="second_last_name" name="second_last_name" value="<?php echo $second_last_name;?>">    
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
    <label for="job" class="form-label">Cargo</label>
    <input type="text" class="form-control" id="job" name="job" value="<?php echo $job;?>" aria-describedby="">    
  </div>
  <div class="mb-3">
    <label for="income" class="form-label">Salario/Honorarios</label>
    <input type="income" class="form-control" id="income" name="income" value="<?php echo $income;?>">
  </div>
  <button type="submit" class="btn btn-primary btn-lg mt-3" data-bs-dismiss="modal" aria-label="Close">Guardar</button>
</form>