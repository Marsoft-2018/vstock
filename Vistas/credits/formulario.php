<?php 
  $id = "";
  $amount = "";
  $date_at = "";
  $number_paid = "";
  $readonly = "readonly";

  if(isset($PersonCredit)){
    foreach ($PersonCredit->load() as $credit) {
      $id = $credit['id'];
      $employe_id = $credit['employe_id'];
      $amount = $credit['amount'];
      $date_at = $credit['date_at'];
      $number_paid = $credit['number_paid'];
    }
  }
?>
<form id="formCredit" method="post" onsubmit="return preparePersonCredit('<?php echo $person; ?>','<?php echo $invoice_id; ?>','<?php echo $person_id ?>','<?php echo $accion; ?>')">
  <div class="mb-3">
    <label for="id" class="form-label"><span style="color:#F00;">*</span> Id</label>
    <input type="text" class="form-control" id="id" name="id" value="<?php echo $id;?>" required <?php echo $readonly;?>>    
  </div>
  <div class="mb-3">
    <label for="number_paid" class="form-label"><span style="color:#F00;">*</span> Numero de cuotas</label>
    <input type="text" class="form-control" id="number_paid" name="number_paid" value="<?php echo $number_paid;?>" required>    
  </div>
  <div class="mb-3">
    <label for="amount" class="form-label"><span style="color:#F00;">*</span> Valor</label>
    <input type="number" class="form-control" id="amount" name="amount" value="<?php echo $amount;?>" required>    
  </div>
  <div class="mb-3">
    <label for="date_at" class="form-label">Fecha</label>
    <input type="date" class="form-control" id="date_at" name="date_at" value="<?php echo $date_at;?>" required>    
  </div>
  <button type="submit" class="btn btn-primary btn-lg mt-3" data-bs-dismiss="modal" aria-label="Close">Guardar</button>
</form>