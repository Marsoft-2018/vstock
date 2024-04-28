<?php
    require('../Conexiones/Usuarios.php');
    $accion=$_POST['accion'];
    if($accion=='cambiarContrasena'){
        
        $clave=$_POST['clave'];
        $valor=$_POST['valor'];
        $contrasenaActual=$_POST['contrasenaActual'];
        $perfil=new Usuario();
        $contra=$perfil->contrasena($clave);            
        if($contrasenaActual==$contra){                
            $perfil->modificarContrasena($clave,$valor);
        }else{
            echo "<div class='alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        No coinciden los datos, contraseña no actualizada.
                    </div>";
        }
                
    }

    if($accion=='modificarPerfil'){        
        $campo=$_POST['campo'];
        $clave=$_POST['clave'];
        $valor=$_POST['valor'];
        //echo "esta en las acciones de la tabla administrar y se reciben la variables<br>Campo: $campo<br>Clave: $clave<br>Valor: $valor";
        $perfil=new Usuario();
        $perfil->modificar($clave,$campo,$valor);               
    }
?>