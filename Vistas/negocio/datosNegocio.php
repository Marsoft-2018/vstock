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
<h2 style="text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);">MODULO CONFIGURACION DE LA EMPRESA</h2>
<div id='Contenedor' class='container'> 
    <?php
        session_start();
        require("Modelo/Conect.php");
        require('Modelo/negocio.php');
        $objNegocio = new Negocio();
        $objNegocio->IdNegocio =$_SESSION['idNegocio'];
    ?>
        <div class="panel panel-success clase3">
            <div class="panel-heading clase3"><h4>DATOS DE LA EMPRESA O NEGOCIO</h4></div>
            <div class="panel-body clase3" id='vacciones'>
            <form action="" method="post"></form>
            <?php
                
            ?>
            <div class="row">                
                <div class="col-md-7">                   
                    <div class="row">
                        <div class="col-md-12">
                            <label>Nombre de la Empresa:	</label>
							<input type='Text' class='form form-control' id='NOMBRE' value='<?php echo $NOMBRE; ?>' required onchange='modificarDato(this.id,this.value,this.name)'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Nit:</label>
						    <input type='Text' class='form form-control' id='NIT' required  value='<?php echo $NIT; ?>' onchange='modificarDato(this.id,this.value,this.name)'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                           <label>Propietario y/o Administrador</label>
						    <input type='Text' class='form form-control' required id='PROPIETARIO' value='<?php echo $PROPIETARIO; ?>' onchange='modificarDato(this.id,this.value,this.name)'>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-5 well" style="border:1px solid #cecece;width:390px;height:210px;">
                    <label for="fotoUs">Logo</label>
                    <form id='cambioLogo' enctype='multipart/form-data' method='post' target='resultadoEnvio' onsubmit='cambiarLogo()'>
                        <div id='fotoVistaPrevia' >                                    
                            <a href='#' id='elegirIMG' class='btn btn-default' onclick='elegirIMG(this)'>Cambiar Imágen</a>
                            <?php
                                if($LOGO == "0"){
                               echo "<img src='img/Marsoft2017.png' id='fotoUs' style='margin:0px;height:130px;width:100px;box-shadow: 2px 5px 5px rgba(153,153,153,1);background-color:#ffffff;border-radius:10px;'>";
                                echo "<input type='hidden' value='0' name='fotoAnterior'>";
                            }else{
                                echo "<input type='hidden' value='$IdNegocio' name='fotoAnterior'>";
                                echo "<input type='hidden' value='$LOGO' id='fotoAnterior'>";
                                echo "<img src='img/$LOGO' id='fotoUs' style='margin:1px;width:100%;height:130px;'>";
                            }       
                            ?>
                        <input type='file' id='LogoNegocio' name='LogoNegocio' onchange='previsualizar(this)' />
                        </div>                            
                        <iframe name='resultadoEnvio' style='display:none;'></iframe>
                        <div id='mostrarMensajeImagen'></div>
                        <input type='hidden' value='<?php echo $IdNegocio; ?>' name='idNegocio'>
                        <input type='submit' value='Guardar Imágen' id='guardarIMG' class='btn btn-primary' style='margin-top:5px;display:none;width:98%;'>
                    </form>
                    
                    
                    <div style='width:99%;text-align:center;'>
                        <!--<img src='img/<?php echo $registro[8]; ?>' id='fotoUs' style='margin:1px;width:100%;'>-->
                    </div>
                    <!--<input id='botonMod' type='button' value='Guardar Cambios' style='padding:5px;margin:5px;' class='btn btn-primary' onclick='modificar(1)'>-->   
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>Dirección</label>
     				<input type='Text' class='form form-control' id='DIRECCION' required value='<?php echo $DIRECCION; ?>' onchange='modificarDato(this.id,this.value,this.name)'>
               </div>
                <div class="col-md-4">
                    <label>Barrio</label>
				    <input type='Text' class='form form-control' id='BARRIO' value='<?php echo $BARRIO; ?>' onchange='modificarDato(this.id,this.value,this.name)'>
                </div>
                <div class="col-md-4">
                    <label>Ciudad</label>
				    <input type='Text' class='form form-control' required  id='CIUDAD' value='<?php echo $CIUDAD; ?>' onchange='modificarDato(this.id,this.value,this.name)'>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>Teléfono</label>
				    <input type='Text' class='form form-control' required id='TEL' value='<?php echo $TEL; ?>' onchange='modificarDato(this.id,this.value,this.name)'></div>
                <div class="col-md-4">
                    <label>Correo</label>
				    <input type='Text' class='form form-control' required id='correo'  value='<?php echo $correo; ?>' onchange='modificarDato(this.id,this.value,this.name)'>
                </div>
                <div class="col-md-4">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="resultados">
                    <div class="alert alert-info alert-dimissable">
                        Señor Usuario los cambios que realice en los campos del formulario seran guardados atomaticamente.
                    </div>
                </div>
            </div> 
      </div>
     </form>
      
</div>

<script type="text/javascript">
   
               
</script>  