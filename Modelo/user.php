<?php
	//require_once ("Conect.php");
	class User extends ConectarPDO{
		private $usuario;
        private $password;
        public $Rol;
        public $IdNegocio;
        public $primerNombre;
        public $segundoNombre;
        public $primerApellido;
        public $segundoApellido;
        public $email;
        public $estado;
		private $sql;
		

		public function login() {
			$con = 0;
			$datos = array();
			$this->sql = "SELECT us.*,CONCAT(us.`primerNombre`,' ',us.`segundoNombre`,' ',us.`primerApellido`,' ',us.`segundoApellido`) AS userFullName,ng.`name` AS nombreNegocio,ng.`logo` AS logoNegocio 
			FROM users us
			INNER JOIN bussines ng ON ng.`id` = us.`IdNegocio` Where us.Usuario= ? AND us.Password= ? AND us.estado='Activo'";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->usuario);
				$stm->bindParam(2,$this->password);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data as $key => $reg) {
				    
					$_SESSION['idNegocio'] = $reg['IdNegocio'];
					$_SESSION['nombreNegocio'] = $reg['nombreNegocio'];
					$_SESSION['logoNegocio'] = $reg['logoNegocio'];
					$_SESSION['Usuario'] = $reg['Usuario'];
					$_SESSION['rol'] = $reg['Rol'];
					$_SESSION['userFullName'] = $reg['userFullName'];
					$_SESSION['email'] = $reg['email'];
					$_SESSION['estado'] = $reg['estado'];
					$con = 1;
				}
				if($con == 1){	
				    $men = "Todo Ok";
                    $datos['mensaje'] = [$men];
                    $datos['estado'] = [1];				
					$con = $datos;
				}else{
					$men = "Datos de Usuario no válido";
                    $datos['mensaje'] = [$men];
                    $datos['estado'] = [0];				
					$con = $datos;
				}
				return $con;
			} catch (Exception $e) {
				echo "Error en la validacion. ".$e;
			}

			if($con == 0){
				return false;
			}
		}

		public function agregar(){
			$this->sql ="INSERT INTO users(`Usuario`,`Password`,`Rol`,`IdNegocio`,`primerNombre`,`segundoNombre`,`primerApellido`,`segundoApellido`,`email`,`estado`) VALUES(?,?,?,?,?,?,?,?,?,?)";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1,$this->usuario);
                $stm->bindParam(2,$this->password);
                $stm->bindParam(3,$this->Rol);
                $stm->bindParam(4,$this->IdNegocio);
                $stm->bindParam(5,$this->primerNombre);
                $stm->bindParam(6,$this->segundoNombre);
                $stm->bindParam(7,$this->primerApellido);
                $stm->bindParam(8,$this->segundoApellido);
                $stm->bindParam(9,$this->email);
                $stm->bindParam(10,$this->estado);
				$stm->execute();
			} catch (Exception $e) {
				echo "error al guardar los datos: ".$e;
			}
		}

		public function actualizar(){
			
		}

		public function desactivar(){
			$this->sql ="UPDATE users SET estado = 2 WHERE Usuario = ? ";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1,$this->usuario);
				$stm->execute();
			} catch (Exception $e) {
				echo "error al guardar los datos: ".$e;
			}
		}

		public function eliminar(){
			$this->sql ="DELETE FROM users WHERE idUsuario= ?";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1,$this->usuario);
				$stm->execute();
			} catch (Exception $e) {
				echo "error al guardar los datos: ".$e;
			}
		}

		public function setDatos($us, $pass){
			$this->usuario = $us;
			$this->password = $pass;
			//$this->password = SED::encryption($pass);
		}

		public function validarActivacion(){
			require ("negocio.php");
			$obj = new Negocio();
			//return $obj->validarActivacion($_SESSION['rol']);
		}

	}
// 	include ("../Controladores/encript.php");	
// 	 $objUsu = new Usuario();
// 	 $objUsu->setDatos('Admin','123456');
// 	 $objUsu->login();

// 	$objUsu->validarActivacion();
// ?>