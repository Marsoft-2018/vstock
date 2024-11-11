<?php
	//require_once ("Conect.php");
	class employePayment extends ConectarPDO{
		public $id;
   		public $employe_id;
   		public $payment_value;
   		public $date_at;
   		public $receipt;
        private $sql;

        
        public function list(){
            $this->sql="SELECT * FROM employe_payments WHERE employe_id= ? ORDER BY `date_at` DESC";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->employe_id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los products. ".$e;
			}

        }
        
        public function load(){
            $this->sql="SELECT * FROM employe_payments WHERE `id`=? ";  
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
			$this->sql = "INSERT INTO employe_payments(`employe_id`,`payment_value`,`date_at`,`receipt`) VALUES(?,?,?,?)";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->employe_id);
				$stm->bindParam(2, $this->payment_value);
				$stm->bindParam(3, $this->date_at);
				$stm->bindParam(4, $this->receipt);
				if($stm->execute()){
				    echo "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el product. ".$e;
			}   
        }        
               
        public function update(){
            $this->sql = "UPDATE employe_payments SET `employe_id` = ?,`payment_value` = ?,`date_at` = ?,`receipt` = ? WHERE id = ?";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->employe_id);
				$stm->bindParam(2, $this->payment_value);
				$stm->bindParam(3, $this->date_at);
				$stm->bindParam(4, $this->receipt);
				$stm->bindParam(5, $this->id);
				if($stm->execute()){
				    echo "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el cliente. ".$e;
			}
        }
        
        public function delete(){        
            $this->sql="DELETE FROM employe_payments WHERE id=? "; 
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