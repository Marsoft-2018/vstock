<?php 
  session_start();

  session_unset();

  session_destroy();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio VStock</title>
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Iconos fontawesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- estilos para desarrollo offline -->
     
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="containerCustomer">
        <div class="login-container">
            <div>
                <form name="formulario" method="post"  onsubmit='return logear()' target="_self" id="login">
                <div class="icon" style="display: flex; justify-content: center;">
                    <i class="fas fa-lock"></i>
                </div>
                <div style="display: flex; justify-content: center; padding-bottom: 20px;">
                    <h2>¡Login!</h2>
                </div>

                <div class="form-group">
                    <label for="usuarios">Usuario:</label>
                    <input name="usuario" type="text" value="superdmin" required id="usu" placeholder="Nombre de Usuario">
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input name="contrasena" type="password" value="123456" required id="contrasena"
                        placeholder="Contraseña">
                </div>
                <div class="form-group">
                    <!--<input type="submit" value="Ingresar" name="boton" id="enviar">-->
                    <button type="submit" name='boton' id='enviar' class="btn btn-success btn-ingresar">Ingresar</button>
                </div>
                <h5 style="text-align: right;">
                    <a href="Vistas/usuarios/recuperarPass.php" class="olvide">Olvidé mi Contraseña</a>
                </h5>
            </form>
            </div>
            <div class="panel-footer mensajes">
                <div class='row' style="padding:15px;">
                   <div class="col-md-12"><span ></span></div>
                   <div class="alert alert-danger" id='error' style="display: none;"></div>
                   <div class="alert alert-warning" id='advertencia' style="display: none;"></div>
                   <div class="alert alert-warning" id='mensajes' style="display: none;"></div>

                </div>
            </div>
        </div>
        <div class="info-container">
            <div class="info-content">
                <!--<h2>¡Bienvenido a VStock!</h2>
                
                    <p>Transforma la manera en que gestionas tus proyectos y colaboras con tu equipo. InnovoS te ofrece
                        las
                        herramientas necesarias para alcanzar tus objetivos de manera eficiente.</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> Gestiona proyectos de forma intuitiva.</li>
                        <li><i class="fas fa-check-circle"></i> Organiza tus tareas de manera eficaz.</li>
                        <li><i class="fas fa-check-circle"></i> Colabora en tiempo real con tu equipo.</li>
                        <li><i class="fas fa-check-circle"></i> Aumenta la productividad y logra tus metas.</li>
                    </ul>
                -->
            </div>
        </div>
    </div>
    <!-- bundle de bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <!-- cdn de axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- CDN sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Acciones -->
     
  <!-- Complementos para desarrollo-->
  <script src="complementos/js/bootstrap.min.js"></script>
   <script src="complementos/js/popper.min.js"></script>
   <script src="complementos/js/axios.min.js"></script>
   <script src="complementos/js/sweetalert2@11.js"></script>

    <script src="js/app.js"></script>
    <script type="text/javascript" src="js/users.js"></script>
    
</body>

</html>