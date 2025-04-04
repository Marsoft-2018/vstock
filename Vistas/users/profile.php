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
	$accion = "add";

	if (isset($data['id'])) {
		//include("../../models/encript.php");
		$id = $data['id'];
		$accion = "update";
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
			<h3>DATOS DEL PERFIL</h3>
			<hr>
			<div class="x_content">
			<form class="form-label-left input_mask" method="post" id="formUser" onsubmit="return prepareUser('<?php echo $accion; ?>')">
			  <input type="hidden" class="form-control has-feedback-left" id="id" name="id" value="<?php echo $id; ?>" placeholder="código">
			  <div class="col-md-12 col-sm-12  form-group has-feedback">
				<label for="primerNombre" class="mt-2">Primer nombre</label>
			    <input type="text" class="form-control has-feedback-left" id="primerNombre" name="primerNombre" value="<?php echo $primerNombre; ?>" placeholder="Primer nombre">
			  </div>
              <div class="col-md-12 col-sm-12  form-group has-feedback">
			  	<label for="segundoNombre" class="mt-2">Segundo nombre</label>
			    <input type="text" class="form-control has-feedback-left" id="segundoNombre" name="segundoNombre" value="<?php echo $segundoNombre; ?>" placeholder="Segundo nombre">
			  </div>
			  <div class="col-md-12 col-sm-12  form-group has-feedback">
			  	<label for="primerApellido" class="mt-2">Primer Apellido</label>
			    <input type="text" class="form-control has-feedback-left" id="primerApellido" name="primerApellido" value="<?php echo $primerApellido; ?>" placeholder="Primer Apellido">
			  </div>
              <div class="col-md-12 col-sm-12  form-group has-feedback">
			  	<label for="segundoApellido" class="mt-2">Segundo Apellido</label>
			    <input type="text" class="form-control has-feedback-left" id="segundoApellido" name="segundoApellido" value="<?php echo $segundoApellido; ?>" placeholder="Segundo Apellido">
			  </div>
			  <div class="col-md-12 col-sm-12  form-group has-feedback">
			  	<label for="rol" class="mt-2">Rol</label>
			    <select name="rol" id="rol"  title="Perfíl de usuario" class="form-control has-feedback-left" >
			    	<option value="">Seleccione...</option>
			    	<option value="Admin" <?php if($rol == "Admin"){ echo "selected"; } ?>>Administrador</option>
			    	<option value="Usuario" <?php if($rol == "Usuario"){ echo "selected"; } ?>>Empleado</option>
			    </select>
			  </div>

			  <div class="col-md-12 col-sm-12 form-group has-feedback">
			  	<label for="email" class="mt-2">Correo</label>
			    <input type="mail" class="form-control has-feedback-left" id="email" name="email" value="<?php echo $email; ?>" placeholder="Correo">
			  </div>
			  <div class="ln_solid"></div>
			  <div class="form-group row">
			    <div class="col-md-6 col-sm-12 ">
			      <button type="submit" class="btn btn-success btn-lg mt-4">Guardar</button>
			    </div>
			    <div class="col-md-6 col-sm-12 ">
					<a class="nav-link btn btn-primary btn-md" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target=".exampleModalCenter"  onclick="passwordForm('<?php echo $id; ?>')">
                        <i class="fa fa-plus-circle"></i> Cambiar contraseña
                    </a>
			    </div>
			  </div>
			</form>
			</div>
		</div>
	</div>
</div>
                         
<div class="modal fade exampleModalCenter" id="modalPassword" tabindex="-1" aria-labelledby="modalPasswordTitle" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered  modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<h2 class="modal-title" id="modalPasswordTitle"></h2>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body" id="modalPasswordBody">
		
		</div>
	</div>
	</div>
</div>