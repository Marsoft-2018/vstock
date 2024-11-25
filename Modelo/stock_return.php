<?php
	class StockReturn extends ConectarPDO{
		public $id;      
		public $bussines_id;  
        public $invoice_data;
        public $type;
        public $quantity;
        public $amount;
        public $details;
        public $subtotal_amount;
        public $stock;
        public $stocks_returns;
        public $description;
        public $date_at;
        
		private $sql;
        
        public function addSaleCreditNote(){  
            $this->sql = "INSERT INTO sales_credit_notes(`invoice_id`,`amount`,`description`,date_at) VALUES(?,?,?,?)";
          
			try {		
				// Iniciar una transacción
				$this->Conexion->beginTransaction();
		
				// Insertar los datos de la factura
				$stmt = $this->Conexion->prepare($this->sql);
				$stmt->execute(
					[$this->dataInvoice['invoice_id'],
					$this->amount,
					$this->description,
					$this->date_at
				]);
		
				// Obtener el ID de la factura recién creada
				$credit_note_id = $this->Conexion->lastInsertId();
		
				// Insertar cada producto del carrito en la tabla de detalles de la factura
				 $stmt = $this->Conexion->prepare("INSERT INTO sales_credit_note_details(`credit_note_id`,product_id,`quantity`,unit_value,`subtotal_amount`) VALUES(?,?,?,?,?)");
		
				foreach ($this->description as $item) { 
                    $current_stocks = 0;
                    $current_stocks_return = 0;	
                    
                    // Obtener el stock del inventario		
                    
                    $sqlStock ="SELECT stock_return, stock FROM products WHERE id = ?"; 
                    $stmtProduct = $this->Conexion->prepare($sqlStock);
                    $stmtProduct->execute([$this->product_id]);
                    $data = $stmtProduct->fetchAll(PDO::FETCH_ASSOC); 
                    foreach ($data as $product) {
                        $current_stocks = $product['stock'];
                        $current_stocks_return = $product['stock_returns'];
                    }
					
                    $subtotal_amount = $item['quantity'] * $item['0']['price'];
					$stmt->execute([$invoiceId, $item['0']['id'], $item['quantity'], $item['0']['price'],$subtotal_amount]);
					
                    $this->stocks_returns = $current_stocks_return + $item['quantity'];
                    $this->stock= $current_stocks + $item['quantity'];
                    
					$stm2 = $this->Conexion->prepare("UPDATE products set stock_return = ?, stock = ? WHERE id= ?");
					$stm2->execute([$this->stocks_returns, $this->stock,$item['0']['id']]);		
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


        public function addPurchaseCreditNote(){  
            $this->sql = "INSERT INTO purchases_credit_notes(`invoice_id`,`amount`,`description`,date_at) VALUES(?,?,?,?)";
          
			try {		
				// Iniciar una transacción
				$this->Conexion->beginTransaction();
		
				// Insertar los datos de la factura
				$stmt = $this->Conexion->prepare($this->sql);
				$stmt->execute(
					[$this->dataInvoice['invoice_id'],
					$this->amount,
					$this->description,
					$this->date_at
				]);
		
				// Obtener el ID de la factura recién creada
				$credit_note_id = $this->Conexion->lastInsertId();
		
				// Insertar cada producto del carrito en la tabla de detalles de la factura
				 $stmt = $this->Conexion->prepare("INSERT INTO purchases_credit_note_details(`credit_note_id`,product_id,`quantity`,unit_value,`subtotal_amount`) VALUES(?,?,?,?,?)");
		
				foreach ($this->description as $item) { 
                    $current_stocks = 0;
                    $current_stocks_return = 0;	
                    
                    // Obtener el stock del inventario		
                    
                    $sqlStock ="SELECT stock_return, stock FROM products WHERE id = ?"; 
                    $stmtProduct = $this->Conexion->prepare($sqlStock);
                    $stmtProduct->execute([$this->product_id]);
                    $data = $stmtProduct->fetchAll(PDO::FETCH_ASSOC); 
                    foreach ($data as $product) {
                        $current_stocks = $product['stock'];
                        $current_stocks_return = $product['stock_returns'];
                    }
					
                    $subtotal_amount = $item['quantity'] * $item['0']['price'];
					$stmt->execute([$invoiceId, $item['0']['id'], $item['quantity'], $item['0']['price'],$subtotal_amount]);
					
                    $this->stocks_returns = $current_stocks_return + $item['quantity'];
                    $this->stock= $current_stocks + $item['quantity'];
                    
					$stm2 = $this->Conexion->prepare("UPDATE products set stock_return = ?, stock = ? WHERE id= ?");
					$stm2->execute([$this->stocks_returns, $this->stock,$item['0']['id']]);		
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

        public function loadCreditNote(){
            $this->sql="SELECT * FROM sales_credit_notes WHERE `id`=?";  
            if($this->type == 'purchase'){
                $this->sql="SELECT * FROM purchases_credit_notes WHERE `id`=?";  
            }
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

		public function loadCreditNoteDetails(){ 
            $this->sql = "SELECT product_id,`quantity`,unit_value,`subtotal_amount` FROM sales_credit_note_details WHERE credit_note_id = ?";
            if($this->type == 'purchase'){
                $this->sql="SELECT product_id,`quantity`,unit_value,`subtotal_amount` FROM purchases_credit_note_details WHERE credit_note_id = ?";  
            }
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->invoice_detail_id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el product. ".$e;
			}   
        }  

        public function delete(){        
            
        }
	}
?>