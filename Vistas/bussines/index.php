<?php 
  session_start(); 
  $id = "";
  $name = "";
  $nit = "";
  $address = "";
  $town = "";
  $city = "";
  $tel = "";
  $email = "";
  $logo = "";
  $propietary = "";
  $readonly =  "";
  if($accion == "edit"){
    $readonly = "readonly";
  }
if(isset($objBussines)){
  foreach ($objBussines->load() as $bussines) {
    $id = $bussines['id'];
    $name = $bussines['name'];
    $nit = $bussines['nit'];
    $address = $bussines['address'];
    $town = $bussines["town"];
    $city = $bussines["city"];
    $tel = $bussines["tel"];
    $email =$bussines["email"];
    $logo = $bussines["logo"];
    $propietary = $bussines["propietary"];
  }
}
?>
<style>
#fotoVistaPrevia {
    position: relative;
}
#fotoVistaPrevia a {
    position: absolute;
    bottom: 5px;
    left: 5px;
    right: 5px;
    display: none;
    margin:1px;
    width:98%;
    
}
#LogoNegocio {
    margin:1px;
    width:98%;
    height: 100px;
    position: absolute;
	visibility: hidden;	
	z-index: -9999;
}
</style>

<div class='container'> 
    <div class="panel panel-success ">
        <div class="panel-heading ">
            <h3>DATOS DE LA EMPRESA O NEGOCIO</h3>
            <hr>
        </div>
        <div class="panel-body ">
            <form id="formBussines" method="post" onsubmit="return updateBussines('<?php echo $_SESSION['idNegocio']; ?>','<?php echo $accion; ?>')">

                <div class="row mt-3">                
                    <div class="col-md-8">                   
                        <div class="row">
                            <div class="col-md-12">
                                <input type='hidden' class='form form-control' name="id" id='id' value='<?php echo $id; ?>' required >
                                <label for="name">Nombre de la Empresa:	</label>
                                <input type='Text' class='form form-control' name="name" id='name' value='<?php echo $name; ?>' required >
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="nit">nit:</label>
                                <input type='Text' class='form form-control' name="nit" id='nit' required  value='<?php echo $nit; ?>' >
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                            <label for="propietary">Propietario y/o Administrador</label>
                                <input type='Text' class='form form-control' required name="propietary" id='propietary' value='<?php echo $propietary; ?>' >
                                
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="address">Dirección</label>
                                <input type='Text' class='form form-control' name="address" id='address' required value='<?php echo $address; ?>' >
                            </div>
                        </div>
                    </div>
                    <div class="col well" style="border:1px solid #cecece;">
                        <h5>Logo</h5>
                        <div  style="display: flex; justify-content:center; align-items: center; width:250px; height: 250px; background-color:F00;">                                    
                            <img src='img/<?php echo $logo; ?>' class="img-fluid rounded" name="logo" id='logo' >
                        </div>   
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="town">Barrio</label>
                        <input type='Text' class='form form-control' name="town" id='town' value='<?php echo $town; ?>' >
                    </div>
                    <div class="col-md-6">
                        <label for="city">Ciudad</label>
                        <input type='Text' class='form form-control' required  name="city" id='city' value='<?php echo $city; ?>' >
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="tel">Teléfono</label>
                        <input type='Text' class='form form-control' required name="tel" id='tel' value='<?php echo $tel; ?>' >
                    </div>
                    <div class="col">
                        <label for="email">Correo</label>
                        <input type='Text' class='form form-control' name="email" id='email'  value='<?php echo $email; ?>' >
                    </div>
                </div> 
                <div class="row mb-3 mt-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-lg" aria-label="Close">Guardar</button>
                    </div>
                </div>
            </form>
        </div> 
    </div>
      
</div>

<script type="text/javascript">
   
               
</script>  