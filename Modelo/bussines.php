<?php
	//require_once ("Conect.php");
	class Bussines extends ConectarPDO{
		public $id;
        public $name;
        public $nit;
        public $address;
        public $town;
        public $city;
        public $tel;
        public $email;
        public $logo;
        public $propietary;
        public $status;
        public $date_at;
		private $sql;
        
        public function listar($id){
            $this->sql="";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los registro. ".$e;
			}

        }
        
        public function load(){
            $this->sql="SELECT * FROM bussines WHERE id=?";  
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar el negocio. ".$e;
			}
        }
        function list(){
            $this->sql = "SELECT * FROM bussines WHERE id = ?";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los registros. ".$e;
			}
  
        } 

        function add(){
            $this->sql = "INSERT INTO bussines(id,`name`,`description`) VALUES(?,?,?)";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->bindParam(2, $this->name);
				$stm->bindParam(3, $this->description);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);			
				
				echo "Registro guardado con éxito. ";
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el registro. ".$e;
			}
        }

        function delete(){             
            $this->sql = "DELETE FROM `bussines` WHERE id = ?";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);			
				
				echo "Registro eliminado con éxito. ";
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el registro. ".$e;
			}
        }

        function update(){  
            $this->sql = "UPDATE bussines SET `name` = ?, `nit`=?, `address` = ?, town = ?, city = ?, tel = ?, email = ?, logo = ?, propietary = ? WHERE id = ?";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->name );
				$stm->bindParam(2,$this->nit);
				$stm->bindParam(3,$this->address);
				$stm->bindParam(4,$this->town);
				$stm->bindParam(5,$this->city);
				$stm->bindParam(6,$this->tel);
				$stm->bindParam(7,$this->email);
				$stm->bindParam(8,$this->logo);
				$stm->bindParam(9,$this->propietary);
				$stm->bindParam(10,$this->id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				echo "Registro guardado con éxito. ";
			} catch (Exception $e) {
				echo "Ocurrió un Error al actualizar el registro. ".$e;
			}
        }
		

	}
// ?>