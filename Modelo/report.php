<?php
	//require_once ("Conect.php");
	class Report extends ConectarPDO{
		public $id;      
		public $bussines_id;      
        public $customer_id;
        public $date_at;
        public $amount;
        public $type;
        public $form_pay;
        public $status;
        public $reg_date;
		public $dataInvoice;
		public $cart; //datos del carrito
		private $sql;
        
        public function journal(){
            $this->sql="SELECT fvd.product_id,inv.name,inv.reference,SUM(fvd.quantity) AS 'quantity',fvd.`unit_value`,sum(fvd.`subtotal_amount`) as 'subtotal_amount',fv.date_at
                 from sale_invoice_details fvd 
                 inner join products inv on inv.`id`=fvd.`product_id`
                 inner join sales_invoices fv on fv.`id` = fvd.`invoice_id`
                 WHERE DAY(fv.`date_at`)= ? AND MONTH(fv.`date_at`)= ? AND YEAR(fv.`date_at`)= ?
                GROUP BY fv.`date_at`,fvd.`product_id` ORDER BY fv.`date_at` DESC";
            if($this->modulo=='COMPRA'){
                $this->sql="SELECT fcd.product_id,inv.name,inv.reference,SUM(fcd.quantity) AS 'quantity',fcd.`unit_value`,sum(fcd.`subtotal_amount`) as 'subtotal_amount',fc.date_at
                 from purchase_invoice_details fcd 
                 inner join products inv on inv.`id`=fcd.`product_id`
                 inner join purchase_invoices fc on fc.`id` = fcd.`invoice_id`
                 WHERE DAY(fc.`date_at`)=? AND MONTH(fc.`date_at`)=? AND YEAR(fc.`date_at`)= ?
                GROUP BY fc.`date_at`,fcd.`product_id` ORDER BY fc.`date_at` DESC";
            }

			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->day);
				$stm->bindParam(2, $this->month);
				$stm->bindParam(3, $this->year);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los products. ".$e;
			}

        }
        
        public function monthly(){
            $this->sql="SELECT fvd.product_id,inv.name,inv.reference,SUM(fvd.quantity) AS 'quantity',fvd.`unit_value`,sum(fvd.`subtotal_amount`) as 'subtotal_amount',fv.date_at
                 from sale_invoice_details fvd 
                 inner join products inv on inv.`id`=fvd.`product_id`
                 inner join sales_invoices fv on fv.`id` = fvd.`invoice_id`
                 WHERE MONTH(fv.`date_at`)= ? AND YEAR(fv.`date_at`)= ?
                GROUP BY fv.`date_at`,fvd.`product_id` ORDER BY fv.`date_at` DESC";
            if($this->modulo=='COMPRA'){
                $this->sql="SELECT fcd.product_id,inv.name,inv.reference,SUM(fcd.quantity) AS 'quantity',fcd.`unit_value`,sum(fcd.`subtotal_amount`) as 'subtotal_amount',fc.date_at
                 from purchase_invoice_details fcd 
                 inner join products inv on inv.`id`=fcd.`product_id`
                 inner join purchase_invoices fc on fc.`id` = fcd.`invoice_id`
                 WHERE MONTH(fc.`date_at`)=? AND YEAR(fc.`date_at`)= ?
                GROUP BY fc.`date_at`,fcd.`product_id` ORDER BY fc.`date_at` DESC";
            }

			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->month);
				$stm->bindParam(2, $this->year);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los products. ".$e;
			}
        }

		public function yearly(){
            $this->sql="SELECT fvd.product_id,inv.name,inv.reference,SUM(fvd.quantity) AS 'quantity',fvd.`unit_value`,sum(fvd.`subtotal_amount`) as 'subtotal_amount',fv.date_at
                    from sale_invoice_details fvd 
                    inner join products inv on inv.`id`=fvd.`product_id`
                    inner join sales_invoices fv on fv.`id` = fvd.`invoice_id`
                    WHERE YEAR(fv.`date_at`)= ?
                GROUP BY fv.`date_at`,fvd.`product_id` ORDER BY fv.`date_at` DESC";
            if($this->modulo=='COMPRA'){
                $this->sql="SELECT fcd.product_id,inv.name,inv.reference,SUM(fcd.quantity) AS 'quantity',fcd.`unit_value`,sum(fcd.`subtotal_amount`) as 'subtotal_amount',fc.date_at
                    from purchase_invoice_details fcd 
                    inner join products inv on inv.`id`=fcd.`product_id`
                    inner join purchase_invoices fc on fc.`id` = fcd.`invoice_id`
                    WHERE YEAR(fc.`date_at`)= ?
                GROUP BY fc.`date_at`,fcd.`product_id` ORDER BY fc.`date_at` DESC";
            }

            try {
                $stm = $this->Conexion->prepare($this->sql);
                $stm->bindParam(1, $this->year);
                $stm->execute();
                $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                
                return $data;
            } catch (Exception $e) {
                echo "Ocurrió un Error al cargar los products. ".$e;
            }

        }
         
        public function totales(){
            $this->sql="SELECT SUM(initial_quantity) as initial_quantity, SUM(purchases) as purchases, SUM(sales) as sales, SUM(stock_returns) as stock_returns, SUM(stock) as stock  FROM sales_invoices WHERE bussines_id = ?"; 
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
            $this->sql="DELETE FROM sales_invoices WHERE id=? AND bussines_id=?"; 
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