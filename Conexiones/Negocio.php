<?php
    //require ("Conect.php");

    class Negocio extends Conectar{
        private $sqlNegocio;
        private $sqlLogo;
        public function Buscar($idNeg){
            $this->sqlNegocio=mysql_query("select * from negocio Where IdNegocio='$idNeg'");
            return $this->sqlNegocio;
        }
        
        function cargarLogo($Usuario,$Contrasena){
            $this->sqlLogo=mysql_query("SELECT ng.LOGO FROM negocio ng INNER JOIN user1 us ON ng.IdNegocio=us.IdNegocio
WHERE us.Usuario='$Usuario' AND us.Password='$Contrasena';");
            return $this->sqlLogo;
        }
        
        public function modificarDato($clave,$campo,$valor){
            $sql_modificar=mysql_query("UPDATE negocio SET $campo='$valor' WHERE idNegocio='$clave';");
            echo "
                <div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <i class='fa fa-check-circle alert alert-success'> </i>Dato modificado con éxito.
                </div>
            ";
        }
        
        public function cambiarLogo($idNegocio,$fotoAnterior,$archivo,$nombreIMG,$tipo,$nombreTemp,$tamanho,$destino){             
            if($tipo!="image/jpg" && $tipo!="image/jpeg" && $tipo!="image/png"){
                echo "El archivo no es del tipo permitido, por favor seleccione otro";
            }elseif($tamanho>1024*1024){
                echo "Error: la imagén excede el tamaño máximo permitido de 1Mb";
            }else{
                $extension = end(explode(".", $nombreIMG));//con esta linea guardo la extension de la imagen                                                  
            }
            $nombreAnterior="LogoNegocio".$fotoAnterior.".".$extension;        
            $nuevoNombre="LogoNegocio".$idNegocio.".".$extension;
            //elimino la imagen anterior para depues reemplazarla con la nueva
            if ($fotoAnterior!=0){ 
                @unlink($destino.$nombreAnterior);
                //mysql_query("DELETE FROM fotoprofesores WHERE idFoto='$fotoAnterior'");
            } 
            $resultado = @move_uploaded_file($nombreTemp, $destino.$nuevoNombre);
            
            if ($resultado){                    
                mysql_query("UPDATE negocio SET LOGO='$nuevoNombre' WHERE idNegocio='$idNegocio';");                
                echo '<div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Se actualizó con éxito.
                    </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Ocurrio un error al subir la imágen al servidor.
                    </div>';
            }            
        }
    }

?>
