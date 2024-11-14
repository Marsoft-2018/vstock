<?php
	//require_once ("Conect.php");
	class PurchaseInvoice extends ConectarPDO{
		public $id;      
		public $bussines_id;      
        public $supplier_id;
        public $date_at;
        public $amount;
        public $type;
        public $form_pay;
        public $status;
        public $reg_date;
		public $dataInvoice;
		public $cart; //datos del carrito
		private $sql;
        
        public function add(){  
            $this->sql = "INSERT INTO purchase_invoices(`id`,`supplier_id`,date_at,amount,`type`,form_pay,`status`) VALUES(?,?,?,?,?,?,?)";
          
			try {		
				// Iniciar una transacción
				$this->Conexion->beginTransaction();
		
				// Insertar los datos de la factura
				$stmt = $this->Conexion->prepare($this->sql);
				$stmt->execute(
					[$this->dataInvoice['id'],
					$this->dataInvoice['supplier_id'],
					$this->dataInvoice['date_at'],
					$this->amount,
					$this->dataInvoice['type'],
					$this->dataInvoice['form_pay'],
					$this->status
				]);
		
				// Obtener el ID de la factura recién creada
				$invoiceId = $this->Conexion->lastInsertId();
		
				// Insertar cada producto del carrito en la tabla de detalles de la factura
				 $stmt = $this->Conexion->prepare("INSERT INTO purchase_invoice_details(`invoice_id`,product_id,`quantity`,unit_value,`subtotal_amount`) VALUES(?,?,?,?,?)");
		
				foreach ($this->cart as $item) {
					$cantComprada = 0;
					$stock = 0;
					$subtotal_amount = $item['quantity'] * $item['0']['purchase_price'];
					$stmt->execute([$invoiceId, $item['0']['id'], $item['quantity'], $item['0']['purchase_price'],$subtotal_amount]);
					$cantComprada= $item['0']['purchases'] + $item['quantity'];
                    $stock= $item['0']['stock'] + $item['quantity'];
					$stm2 = $this->Conexion->prepare("UPDATE products set purchases = ?, stock = ? WHERE id= ?");
					$stm2->execute([$cantComprada, $stock,$item['0']['id']]);		
				}
				/**/
				// Confirmar la transacción
				$this->Conexion->commit();
		
				// Respuesta de éxito
				echo json_encode(['success' => true, 'message' => 'Factura guardada exitosamente']);
		
			} catch (Exception $e) {
				// Si hay un error, deshacer la transacción
				$this->Conexion->rollBack();
				echo json_encode(['success' => false, 'message' => 'Error al guardar la factura', 'error' => $e->getMessage()]);
			}

        }  

		public function addDetail(){ 
            $this->sql = "INSERT INTO sales_invoice_details(`invoice_id`,product_id,`description`,`quantity`,unit_value,`subtotal_amount`) VALUES(?,?,?,?,?,?)";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->objProduct->invoice_id);
				$stm->bindParam(2, $this->objProduct->product_id);
				$stm->bindParam(3, $this->objProduct->description);
				$stm->bindParam(4, $this->objProduct->quantity);
				$stm->bindParam(5, $this->objProduct->unit_value);
				$stm->bindParam(6, $this->objProduct->subtotal_amount);
				$stm->execute();
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el product. ".$e;
			}   
        }  

        public function list(){
           
        }
        
        public function load(){
            $this->sql="SELECT * FROM purchase_invoices WHERE `id`=? AND bussines_id  = ?";  
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->bindParam(2, $this->bussines_id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los products. ".$e;
			}
        }

		public function maxId(){
			$max = 0;
            $this->sql="SELECT MAX(id) AS id FROM purchase_invoices";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach($data as $reg){
					if($reg['id'] != null){
						$max = $reg['id'] + 1;
					}else{
						$max = 1;
					}
				}
				return $max;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los products. ".$e;
			}

        }
         
        public function totales(){
            $this->sql="SELECT SUM(initial_quantity) as initial_quantity, SUM(purchases) as purchases, SUM(sales) as sales, SUM(stock_returns) as stock_returns, SUM(stock) as stock  FROM purchase_invoices WHERE bussines_id = ?"; 
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->bussines_id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los products. ".$e;
			}
        }
           
               
        public function modificar(){
            
        }
        
        public function eliminar(){        
            $this->sql="DELETE FROM purchase_invoices WHERE id=? AND bussines_id=?"; 
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->bindParam(2, $this->bussines_id);
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
// 	include ("../Controladores/encript.php");	
// 	 $objUsu = new Usuario();
// 	 $objUsu->setDatos('Admin','123456');
// 	 $objUsu->login();

// 	$objUsu->validarActivacion();
// ?>