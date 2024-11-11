<?php
	//require_once ("Conect.php");
	class Employe extends ConectarPDO{
		public $id;
   		public $first_name;
   		public $second_name;
   		public $first_last_name;
   		public $second_last_name;
   		public $address;
   		public $phone;
   		public $job;
   		public $income;
   		public $status;
   		public $bussines_id;
		private $sql;

        
        public function list(){
            $this->sql="SELECT * FROM employes ORDER BY `first_last_name`,`second_last_name`,`first_name`,`second_name` ASC";
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
            $this->sql="SELECT * FROM employes WHERE `id`=? ";  
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
			$this->sql = "INSERT INTO employes(`id`,`first_name`,`second_name`,`first_last_name`,`second_last_name`,`address`,`phone`,`job`,`income`,`bussines_id`) VALUES(?,?,?,?,?,?,?,?,?,?)";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->bindParam(2, $this->first_name);
				$stm->bindParam(3, $this->second_name);
				$stm->bindParam(4, $this->first_last_name);
				$stm->bindParam(5, $this->second_last_name);
				$stm->bindParam(6, $this->address);
				$stm->bindParam(7, $this->phone);
				$stm->bindParam(8, $this->job);
				$stm->bindParam(9, $this->income);
				$stm->bindParam(10, $this->bussines_id);
				if($stm->execute()){
				    echo "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el product. ".$e;
			}   
        }        
               
        public function update(){
            $this->sql = "UPDATE employes SET `first_name` = ?,`second_name` = ?,`first_last_name` = ?,`second_last_name` = ?,`address` = ?,`phone` = ?,`job` = ?,`income` = ? WHERE id = ?";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->first_name);
				$stm->bindParam(2, $this->second_name);
				$stm->bindParam(3, $this->first_last_name);
				$stm->bindParam(4, $this->second_last_name);
				$stm->bindParam(5, $this->address);
				$stm->bindParam(6, $this->phone);
				$stm->bindParam(7, $this->job);
				$stm->bindParam(8, $this->income);
				$stm->bindParam(9, $this->id);
				if($stm->execute()){
				    echo "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el cliente. ".$e;
			}
        }
        
        public function delete(){        
            $this->sql="DELETE FROM employes WHERE id=? "; 
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