<div>
    <form name='passwordForm' method='post' action='' onsubmit="return passwordChange('<?php echo $data['id'] ?>')" id='frmLogin' target="_self" class="animated zoomIn">
        <div class="col-md-12 col-sm-12  form-group has-feedback">
            <label for="passwordOld" class="mt-2">Contraseña actual</label>
            <input type="password" class="form-control has-feedback-left" placeholder="Contraseña actual" id="passwordOld" name="passwordOld" required="required">
            <div class="input-group">
            </div>
        </div>
        <div class="col-md-12 col-sm-12  form-group has-feedback">
            <label for="passwordNew1" class="mt-2">Nueva contraseña</label>
            <input type="password" class="form-control has-feedback-left" placeholder="Nueva Contraseña" id="passwordNew1" name="passwordNew1" required="required">        
        </div>
        <div class="col-md-12 col-sm-12  form-group has-feedback">
            <label for="passwordNew2" class="mt-2">Confirmar contraseña</label>
            <input type="password" class="form-control has-feedback-left" placeholder="Confirmar Contraseña" id="passwordNew2" name="passwordNew2" required="required">
        </div>                                 
        <input type="submit" value="Guardar" name='boton' id='enviar' class="btn btn-success btn-lg boton mt-4" >
    </form>
</div>
      