<?php
    //require_once ("Conect.php");
    include ("../Controlador/encript.php");
    class Contrasena extends ConectarPDO{
        public $correo;
        public $usuario;
        public $nombre;
        public $token;
        public $rol;
        public $estado;
        private $sql;

        public function validar() {
            $con = false;
            $this->sql = "SELECT email FROM user1 WHERE usuario = ? AND estado = 'Activo'";
            try {
                $stm = $this->Conexion->prepare($this->sql);
                $stm->bindParam(1,$this->usuario);
                $stm->execute();
                $num = $stm->fetchAll(PDO::FETCH_ASSOC);
                foreach ($num as $value) {                    
                    $con = true;
                }                
                return $con;                               
            } catch (Exception $e) {
                echo "Error en la validacion. ".$e;
            }
        }

        public function datosUsuario(){
            $this->sql = "SELECT email,Rol,Usuario FROM user1 u WHERE Usuario = ?";
            try {
                $stm = $this->Conexion->prepare($this->sql);
                $stm->bindParam(1,$this->usuario);
                $stm->execute();
                $datos = $stm->fetchAll(PDO::FETCH_ASSOC);               
                return $datos;
            } catch (Exception $e) {
                echo "Error en la validacion. ".$e;
            }   
        }

        public function generarToken(){
            $this->token = $this->getToken($this->rol,$this->usuario);
            if ($this->token == "") {
                $conjuntoLetras = ["!","#","$","%","&","(",")","*","+",",","-",".","/","0","1","2","3","4","5","6","7","8","9",":",";","<","=",">","?","@","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","[","]","^","_","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];

                $cadena = "";

                for ($i=0; $i < 20 ; $i++) { 
                    $cadena .= $conjuntoLetras[rand(0,85)];
                }
                $this->token = SED::encryption($cadena);    
            }
                    
            if ($this->rol == "Profesor") {
                $this->sql ="UPDATE profesores SET token = '".$this->token."', token_estado = 1 WHERE idUsuario = '".$this->usuario."' AND estado = 'Activo'";
            }elseif($this->rol == "Administrador"){
                $this->sql ="UPDATE t_users SET token = '".$this->token."', token_estado = 1 WHERE usuario = '".$this->usuario."' AND estado = 1";         
            }

            try {
                $stm = $this->Conexion->prepare($this->sql);
                $stm->execute();
                return $this->token;
            } catch (Exception $e) {
                echo "error al guardar los datos: ".$e;
            }
        }

        public function getToken($rol,$usuario){
            $token = "";
            $this->sql ="SELECT token FROM user1 WHERE Usuario = ? AND token_estado = 'Activo' ";         

            try {
                $stm = $this->Conexion->prepare($this->sql);
                $stm->bindParam(1,$this->usuario);
                $stm->execute();
                $Rtoken = $stm->fetchAll(PDO::FETCH_ASSOC);
                foreach ($Rtoken as $value) {
                    $token = $value['token'];
                }
                return $token;
            } catch (Exception $e) {
                echo "error al guardar los datos: ".$e;
            }
        }

        public function reestablecer(){
            $this->contrasena = SED::encryption($this->contrasena);
            $this->sql ="UPDATE user1 SET password = ?, token_estado = 0  WHERE Usuario = ? AND token = ? AND token_estado = 'Activo'";  
            try {
                $stm = $this->Conexion->prepare($this->sql);
                $stm->bindParam(1,$this->contrasena);
                $stm->bindParam(2,$this->usuario);
                $stm->bindParam(3,$this->token);
                $stm->execute();
            } catch (Exception $e) {
                echo "error al guardar los datos: ".$e;
            }
        }

        public function enviarEmail($usuario,$nombre,$correo,$token){
            

            $url = "http://".$_SERVER['SERVER_NAME'].'/Vistas/usuarios/reestablecerPass.php?us='.$usuario.'&tkn='.$token;
            $fecha = date("D-M-y H:i");
            $mensaje = '
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                      <meta name="viewport" content="width=device-width, initial-scale=1" />
                      <title>Confirm Email</title>
                      <link rel="preconnect" href="https://fonts.googleapis.com">
                      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
                        <style>
                            body {
                              font-family: "Roboto", sans-serif;
                                -webkit-font-smoothing:antialiased;
                                -webkit-text-size-adjust:none;
                                width: 100%;
                                height: 100%;
                                color: #37302d;
                                background: #ffffff;
                              }
                            
                              h1, h2, h3 {
                                padding: 0;
                                margin: 0;
                                color: #444444;
                                font-weight: 400;
                                line-height: 110%;
                              }
                
                            .card{
                              width: 18rem;
                              border: 1px solid #cacaca;
                              border-radius: 10px;
                              margin: 0 auto;
                
                            }
                
                            .card img{
                              width: 100%;
                              margin-top: 0px;
                
                            }
                
                            .card-body{
                              background-color: #14468A;
                              color: #fafafa;
                              padding: 10px;              
                            }
                
                            .card-body h5{
                              font-size: 1.2em;
                              text-align: center;
                              padding: 0px;   
                              margin: 0px;
                            }
                
                            .card-body p{
                              text-align: left;
                              line-height: 1.5em;
                            }
                
                            .card-body a{
                              text-decoration: none;
                              display: inline-block;
                              text-align: center;
                              color: #fff;
                            }
                
                            .btn {
                              width: 95%;
                              border: 1px solid #cacaca;
                              border-radius: 5px;
                              margin: 0 auto;
                              padding: 8px;
                            }
                
                            .btn-primary{
                              background-color: #21AD0B;
                              transition: 0.5s ease;
                            }
                
                            .btn-primary:hover{
                              cursor: pointer;
                              background-color: #62BC0C;
                            }
                
                
                        </style>
                    </head>
                    <body>
                        <div class="card">
                          <img src="https://colegiosanrafael.com.co/sigest/tools/sigest-n.svg" class="card-img-top" alt="SIGEST">
                          <h5>INNOVOS</h5>
                          <div class="card-body">
                            <h5 class="card-title"> Hola '.$nombre.'</h5>
                            <p class="card-text">
                            Usted ha solicitado reestablecer su contraseña<br><br>Para continuar con el proceso haga click en el siguiente botón<br><br>
                            </p>            
                            <a class="btn btn-primary" href="'.$url.'">Cambiar contraseña</a>
                          </div>
                        </div>
                    </body>
                </html>';
            require "enviar.php";
            
            $obj = new Enviar();
            $obj->para = $correo;
            
            $obj->url = $url;
            $obj->fecha = date("D-M-y H:i");
            $obj->asunto = "Restablecer contraseña - innovoS";
            $obj->mensaje = $mensaje;
            
            $obj->iniciar();
            
        }

        public function modificar(){
            
            $this->contrasena = SED::encryption($this->contrasena);
            $this->sql = "UPDATE user1 SET Password = ? WHERE usuario = ?";
            
            if ($this->sql != "") {
                try {
                    $stm = $this->Conexion->prepare($this->sql);
                    $stm->bindParam(1,$this->contrasena);
                    $stm->bindParam(2,$this->usuario);
                    $stm->execute();
                    echo "Contraseña modificada con éxito";
                } catch (Exception $e) {
                    echo "error al guardar los datos: ".$e;
                }
            }else{
                echo "Error Consulta vacia:<br> no existe un rol definido<br>";
            }
        }
    }
    
      //$objUsu = new Contrasena();
      //$objUsu->setDatos('Admin','123456');
      //echo $objUsu->generarToken();
?>