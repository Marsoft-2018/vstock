<?php
	$id = "";
	$usuario 	= "";
	$primerNombre 	= "";
	$segundoNombre 	= "";
	$primerApellido 	= "";
	$segundoApellido 	= "";
	$email 	= "";
	$rol		= "";
	$password	= "";
	$accion = "guardarUsuario('agregar')";

	if (isset($data['id'])) {
		//include("../../models/encript.php");
		$id = $data['id'];
		$accion = "guardarUsuario('modificar')";
		foreach ($objUser->load() as  $user) {
			$primerNombre 	= $user['primerNombre'];
			$segundoNombre 	= $user['segundoNombre'];
			$primerApellido 	= $user['primerApellido'];
			$segundoApellido 	= $user['segundoApellido'];
			$usuario 	= $user['Usuario'];
			$rol 	= $user['Rol'];	
			$email 	= $user['email'];
		}
	}
?>

<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="x_content">
			<form class="form-label-left input_mask" method="POST" id="formUsuario" onsubmit="return <?php echo $accion; ?>">
			  <input type="hidden" class="form-control has-feedback-left" id="id" name="id" value="<?php echo $id; ?>" placeholder="Nombre Completo">
			  <div class="col-md-12 col-sm-12  form-group has-feedback">
			    <input type="text" class="form-control has-feedback-left" id="primerNombre" name="primerNombre" value="<?php echo $primerNombre; ?>" placeholder="Primer nombre">
			    <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
			  </div>
              <div class="col-md-12 col-sm-12  form-group has-feedback">
			    <input type="text" class="form-control has-feedback-left" id="segundoNombre" name="segundoNombre" value="<?php echo $segundoNombre; ?>" placeholder="Segundo nombre">
			    <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
			  </div>
			  <div class="col-md-12 col-sm-12  form-group has-feedback">
			    <input type="text" class="form-control has-feedback-left" id="primerApellido" name="primerApellido" value="<?php echo $primerApellido; ?>" placeholder="Primer Apellido">
			    <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
			  </div>
              <div class="col-md-12 col-sm-12  form-group has-feedback">
			    <input type="text" class="form-control has-feedback-left" id="segundoApellido" name="segundoApellido" value="<?php echo $segundoApellido; ?>" placeholder="Segundo Apellido">
			    <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
			  </div>
			  <div class="col-md-12 col-sm-12  form-group has-feedback">
			    <span class="fa fa-legal form-control-feedback left" aria-hidden="true"></span>
			    <select name="rol" id="rol"  title="Perfíl de usuario" class="form-control has-feedback-left" >
			    	<option value="">Seleccione...</option>
			    	<option value="Administrador" <?php if($rol == "Administrador"){ echo "selected"; } ?>>Administrador</option>
			    	<option value="Coordinador" <?php if($rol == "Coordinador"){ echo "selected"; } ?>>Coordinador</option>
			    	<option value="Taller" <?php if($rol == "Taller"){ echo "selected"; } ?>>Taller</option>
			    </select>
			  </div>

			  <div class="col-md-12 col-sm-12 form-group has-feedback">
			    <input type="mail" class="form-control has-feedback-left" id="email" name="email" value="<?php echo $email; ?>" placeholder="Correo">
			    <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
			  </div>
			  <div class="ln_solid"></div>
			  <div class="form-group row">
			    <div class="col-md-12 col-sm-12 ">
			      <button type="button" class="btn btn-primary"  data-dismiss="modal">Cerrar</button>
			      <button type="submit" class="btn btn-success">Guardar</button>
			    </div>
			  </div>
			</form>
			</div>
		</div>
	</div>
</div>