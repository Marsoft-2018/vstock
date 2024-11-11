<?php
	//require_once ("Conect.php");
	class Customer extends ConectarPDO{
		public $id;
		public $bussines_id;
        public $name;
		public $address;
		public $phone;
		public $city;
		public $email;
		public $status;
		public $reg_date;
		private $sql;

        
        public function list(){
            $this->sql="SELECT * FROM customers ORDER BY `name` ASC";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los products. ".$e;
			}

        }
        
        public function load(){
            $this->sql="SELECT * FROM customers WHERE `id`=? ";  
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los products. ".$e;
			}
        }
              
        public function add(){ 
			$this->sql = "INSERT INTO customers(`id`,`name`,`address`,`phone`,`city`,`email`) VALUES(?,?,?,?,?,?)";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->bindParam(2, $this->name);
				$stm->bindParam(3, $this->address);
				$stm->bindParam(4, $this->phone);
				$stm->bindParam(5, $this->city);
				$stm->bindParam(6, $this->email);
				if($stm->execute()){
				    echo "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el product. ".$e;
			}   
        }        
               
        public function update(){
            $this->sql = "UPDATE customers SET `name` =?,`address` =?,`phone` =?,`city` =?,`email`=? WHERE id = ?";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->name);
				$stm->bindParam(2, $this->address);
				$stm->bindParam(3, $this->phone);
				$stm->bindParam(4, $this->city);
				$stm->bindParam(5, $this->email);
				$stm->bindParam(6, $this->id);
				if($stm->execute()){
				    echo "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el cliente. ".$e;
			}
        }
        
        public function delete(){        
            $this->sql="DELETE FROM customers WHERE id=? "; 
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				if($stm->execute()){
					echo "Registro eliminado con éxito";
				}else{
					echo "No se pudo eliminar el registro";
				}
			} catch (Exception $e) {
				echo "Ocurrió un Error al eliminar el registro. ".$e;
			}
        }
  

	}
?>