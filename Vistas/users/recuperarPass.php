<!Doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=yes">
	<!-- Estilos CSS --><!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../complementos/css/animate.css">
    <title>InnovoS | Recuperar Contraseña</title>
    <link rel="icon" href="../../tools/sigest-ico.svg" />  
<style>
    body{
        padding: 0px;
        margin: 0px;
        background-color: rgba(200,206,250,0.9);
    }
.panelExterno{
        display: flex;
        justify-content: center;
        align-items: center;
        height:100%;
        width:90%;
        margin-top:10%;
    
}
 
    .bloqueo{
        position:absolute;
        width:100%;
        height:2500px;
        background-color: rgba(34,44,54,0.8);
        z-index:5;
        display:none;
        margin:0px auto;
        
        padding-top:50px;
        text-align:center;
        /*text-shadow: 0px 1px 5px rgba(153,153,153,1);*/
        vertical-align:central;
    }

    .carga{
        margin-left: 43%;
        margin-top: 15%;
        background-color: #fff;
        border-radius: 50%;
        border: 2px solid rgba(100,154,160,0.5); 
        box-shadow: 0px 0px 20px rgba(255,255,255,0.6);
        padding: 5px;
        width: 170px;
        height: 170px;

    }

    .carga img{
        width: 100%;
    }

    label{
        text-align: left;
    }
</style>
</head>
<body oncontextmenu="return false"  style="background-image: url('../../tools/textu1.png');">
        <div class="bloqueo" id = "bloquear">
          <div class="carga">
            <img alt="Cargando..." src="../../estilosCSS/load.gif" >
          </div>
        </div>
        <div class="container panelExterno">
            <form name='formulario' method='post' action='' onsubmit='return recuperar()' id='frmLogin' target="_self" class="animated zoomIn">
                <div class="card"  style="width: 38rem;">
                  <h5 class="card-header">RECUPERAR CONTRASEÑA</h5>
                  <div class="card-body">
                        <label for="">Usuario</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text" id="btnGroupAddon"><i class="fa fa-user"></i></div>
                            </div>
                            <input type="text" class="form-control" placeholder="Por favor ingrese aquí su Nombre de usuario" id="usuario" aria-describedby="btnGroupAddon" required="required">
                            
                            <p><br>
                                Sus datos de recuperción llegarán siempre y cuando tenga usted registrado el correo electrónico en la plataforma
                            </p>
                        </div>                                 
                  </div>
                  <div class="card-footer text-muted">
                    <div class='row' style="padding:15px;">
                       <div class="alert" id='mensaje' style="display: none;"></div>
                    </div>
                    <input type="submit" value="Continuar" name='boton' id='enviar' class="btn btn-success boton" >    <a href="../../index.php" class="btn btn-warning">Regresar</a>
                  </div>
                </div>
            </form>
        </div>  
	
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
    <script type="text/javascript">
        function recuperar() {
            var usuario = $("#usuario").val();
            var accion = "recuperar";
            $.ajax({
                type:"POST",
                data:{accion:accion, usuario:usuario},
                url:"../../Controlador/ctrlContrasenas.php",
                beforeSend: function(){
                    
            return false;
                    $('#bloquear').slideDown('fast');
                },
                success:function(respuesta){
                    respuesta = JSON.parse(respuesta);
                    console.log('test: '+respuesta.resultado);
            return false;
                    if(respuesta.estado){
                        $("#mensaje").html(""+respuesta.mensaje).removeClass("alert-danger").addClass("alert-success animated zoomIn").show('fast');
                    }else{
                        $("#mensaje").html(""+respuesta.mensaje).removeClass("alert-success").addClass("alert-danger animated zoomIn").show('fast');
                    }
                    //console.log(respuesta);
                    $("#bloquear").slideUp("fast");
                }
            });
            return false;
        }
    </script>
</body>
</html>