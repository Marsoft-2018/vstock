<?php
	//require_once ("Conect.php");
	class PersonCredit extends ConectarPDO{
		public $person;
		public $id;
   		public $invoice_id;
   		public $person_id;
   		public $number_paid;
   		public $amount;
   		public $date_at;
        private $sql;

        
        public function index(){
			if($this->person == "Customer"){
            	$this->sql="SELECT iv.id AS invoice_id,ct.id AS person_id,ct.name,iv.`amount`,iv.`date_at`,iv.`status` FROM sales_invoices iv
				INNER JOIN customers ct ON ct.`id` = iv.`customer_id`
				WHERE iv.`type`='credito' AND iv.`status`='Por Pagar' ORDER BY ct.name";
			}else{				
            	$this->sql="SELECT piv.id AS invoice_id, sp.`id` AS person_id, sp.name,piv.`amount`,piv.`date_at`,piv.`status` FROM purchase_invoices piv
				INNER JOIN suppliers sp ON sp.`id` = piv.`supplier_id`
				WHERE piv.`type`='credito' AND piv.`status`='Por Pagar' ORDER BY sp.name";
			}
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los products. ".$e;
			}

        }
        public function list(){
			if($this->person == "Customer"){
           		$this->sql="SELECT * FROM customer_credits WHERE customer_id= ? and invoice_id = ? ORDER BY `date_at` DESC";
			}else{
				$this->sql="SELECT * FROM suppliers_credits WHERE supplier_id= ? and invoice_id = ? ORDER BY `date_at` DESC";
			}
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->person_id);
				$stm->bindParam(2, $this->invoice_id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los products. ".$e;
			}

        }
        
        public function load(){
            $this->sql="SELECT * FROM customer_credits WHERE `id`=? ";  
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
			$this->sql = "INSERT INTO customer_credits(`customer_id`,`invoice_id`,`number_paid`,`amount`,`date_at`) VALUES(?,?,?,?,?)";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->person_id);
				$stm->bindParam(2, $this->invoice_id);
				$stm->bindParam(3, $this->number_paid);
				$stm->bindParam(4, $this->amount);
				$stm->bindParam(5, $this->date_at);
				if($stm->execute()){
				    echo "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el product. ".$e;
			}   
        }        
               
        public function update(){
            $this->sql = "UPDATE customer_credits SET `customer_id` = ?,`amount` = ?,`date_at` = ?,`invoice_id` = ?,`number_paid` = ? WHERE id = ?";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->person_id);
				$stm->bindParam(2, $this->amount);
				$stm->bindParam(3, $this->date_at);
				$stm->bindParam(4, $this->invoice_id);
				$stm->bindParam(5, $this->number_paid);
				$stm->bindParam(6, $this->id);
				if($stm->execute()){
				    echo "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el cliente. ".$e;
			}
        }
        
        public function delete(){        
            $this->sql="DELETE FROM customer_credits WHERE id=? "; 
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