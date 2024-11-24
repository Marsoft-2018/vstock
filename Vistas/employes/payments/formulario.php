<?php 
  session_start(); 
  $id = "";
  $payment_value = "";
  $date_at = "";
  $receipt = "";
  $readonly = "readonly";

  if(isset($objEmployePayment)){
    foreach ($objEmployePayment->load() as $payment) {
      $id = $payment['id'];
      $employe_id = $payment['employe_id'];
      $payment_value = $payment['payment_value'];
      $date_at = $payment['date_at'];
      $receipt = $payment['receipt'];
    }
  }
?>
<form id="formEmployePayment" method="post" onsubmit="return prepareEmployePayment('<?php echo $data['bussines_id']; ?>','<?php echo $employe_id ?>','<?php echo $accion; ?>')">
  <div class="mb-3">
    <label for="id" class="form-label"><span style="color:#F00;">*</span> Id</label>
    <input type="text" class="form-control" id="id" name="id" value="<?php echo $id;?>" required <?php echo $readonly;?>>    
  </div>
  <div class="mb-3">
    <label for="payment_value" class="form-label"><span style="color:#F00;">*</span> Valor</label>
    <input type="number" class="form-control" id="payment_value" name="payment_value" value="<?php echo $payment_value;?>" required>    
  </div>
  <div class="mb-3">
    <label for="date_at" class="form-label">Fecha</label>
    <input type="date" class="form-control" id="date_at" name="date_at" value="<?php echo $date_at;?>" required>    
  </div>
  <div class="mb-3">
    <label for="receipt" class="form-label"><span style="color:#F00;">*</span> Recibo</label>
    <input type="text" class="form-control" id="receipt" name="receipt" value="<?php echo $receipt;?>" required>    
  </div>
  <button type="submit" class="btn btn-primary btn-lg mt-3" data-bs-dismiss="modal" aria-label="Close">Guardar</button>
</form>