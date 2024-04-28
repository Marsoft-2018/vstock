<?php
	//require_once ("Conect.php");
	class Usuario extends ConectarPDO{
		private $Usuario;
        private $Password;
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
			$this->sql = "SELECT us.*,CONCAT(us.`primerNombre`,' ',us.`segundoNombre`,' ',us.`primerApellido`,' ',us.`segundoApellido`) AS userFullName,ng.`NOMBRE` AS nombreNegocio,ng.`LOGO` AS logoNegocio FROM user1 us
				INNER JOIN negocio ng ON ng.`IdNegocio` = us.`IdNegocio` Where us.Usuario= ? AND us.Password= ? AND us.estado='Activo'";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->usuario);
				$stm->bindParam(2,$this->password);
				$stm->execute();
				$num = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach ($num as $key => $value) {
				    
					$_SESSION['idNegocio'] = $value['IdNegocio'];
					$_SESSION['nombreNegocio'] = $value['nombreNegocio'];
					$_SESSION['logoNegocio'] = $value['logoNegocio'];
					$_SESSION['Usuario'] = $value['Usuario'];
					$_SESSION['rol'] = $value['Rol'];
					$_SESSION['userFullName'] = $value['userFullName'];
					$_SESSION['email'] = $value['email'];
					$_SESSION['estado'] = $value['estado'];
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
			$this->sql ="INSERT INTO user1(`Usuario`,`Password`,`Rol`,`IdNegocio`,`primerNombre`,`segundoNombre`,`primerApellido`,`segundoApellido`,`email`,`estado`) VALUES(?,?,?,?,?,?,?,?,?,?)";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1,$this->Usuario);
                $stm->bindParam(2,$this->Password);
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
			$this->sql ="UPDATE user1 SET estado = 2 WHERE Usuario = ? ";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1,$this->Usuario);
				$stm->execute();
			} catch (Exception $e) {
				echo "error al guardar los datos: ".$e;
			}
		}

		public function eliminar(){
			$this->sql ="DELETE FROM user1 WHERE idUsuario= ?";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1,$this->idUsuario);
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
			return $obj->validarActivacion($_SESSION['rol']);
		}

	}
// 	include ("../Controladores/encript.php");	
// 	 $objUsu = new Usuario();
// 	 $objUsu->setDatos('Admin','123456');
// 	 $objUsu->login();

// 	$objUsu->validarActivacion();
// ?>