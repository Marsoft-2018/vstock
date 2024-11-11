<?php
    require ("Conect.php");

    class Usuario extends Conectar{
        private $sqlUsuario;
        private  $contra;
        public function Buscar(){
            $this->sqlUsuario=mysql_query("select usuario from user1 order by usuario") or die ("Error al buscar usuarios");
            return $this->sqlUsuario;
        }
        public function Validar($usu,$pass){
            $this->sqlUsuario=mysql_query("SELECT * FROM user1 Where Usuario='".$usu."' AND Password='".$pass."' AND estado='Activo'"); 
            return $this->sqlUsuario;
        }
        
        public function cargarDatos($usu){
            $this->sqlUsuario=mysql_query("SELECT primerNombre,segundoNombre,primerApellido,segundoApellido FROM user1 Where Usuario='".$usu."' AND estado='Activo'"); 
            while($dt=mysql_fetch_array($this->sqlUsuario)){
                echo $dt[0]." ".$dt[1]." ".$dt[2]." ".$dt[3];
            }
        }       
        
        public function modificar($clave,$campo,$valor){
            $sql_modificar=mysql_query("UPDATE user1 SET $campo='$valor' WHERE usuario='$clave';");
            echo "
                <div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    Se actualizó con éxito el dato en el perfil
                </div>
            ";
        }
        
        public function modificarContrasena($clave,$valor){
            $sql_modificar=mysql_query("UPDATE user1 SET Password='$valor' WHERE usuario='$clave';");
            echo "
                <div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    Se actualizó la contrasena con éxito.
                </div>
            ";
        }
        
        public function contrasena($clave){
           
            
            $sql_comprobarContrasena=mysql_query("SELECT Password FROM user1 WHERE usuario='$clave'");
            
            $rSql=mysql_num_rows($sql_comprobarContrasena);
            if($rSql>0){
                while($cn=mysql_fetch_array($sql_comprobarContrasena)){
                    $this->contra=$cn[0];
                }
            }
            return $this->contra;
        }
        function __destruc(){
            
        }
    }
?>