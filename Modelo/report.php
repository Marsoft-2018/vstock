<?php
	//require_once ("Conect.php");
	class Report extends ConectarPDO{
		public $id;      
		public $day;      
        public $month;
        public $year;
        public $modulo;
        public $type;
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
         
        public function overview(){
            $data = [];
            $sqlTotal;
            $sqlMes;
            $total;
            try {
                if($this->month != ""){
                    $sqlTotal = "SELECT SUM(fv.amount) AS 'amount' FROM sales_invoices fv 
                    WHERE  MONTH(fv.`date_at`)= ? AND YEAR(fv.`date_at`)= ? GROUP BY MONTH(fv.`date_at`)"; 
                    
                    $sqlMes="SELECT DAY(fv.`date_at`) AS 'day',SUM(fv.`amount`) AS 'amount' FROM sales_invoices fv 
                    WHERE MONTH(fv.`date_at`)= ? AND YEAR(fv.`date_at`)= ?
                    GROUP BY DAY(fv.`date_at`) ORDER BY DAY(fv.`date_at`) ASC";

                    $stm = $this->Conexion->prepare($sqlTotal);
                    $stm->execute([ $this->month, $this->year]);
                    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $register) {
                        $data[0]=$register['amount'];
                    }
                    
                    $stm = $this->Conexion->prepare($sqlMes);
                    $stm->execute([ $this->month, $this->year]);
                    $data[1] = $stm->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                }else{
                    $sqlTotal = "SELECT SUM(fv.amount) AS 'amount' FROM sales_invoices fv 
                                WHERE  YEAR(fv.`date_at`) = ? GROUP BY YEAR(fv.`date_at`)";

                    $sqlMes = "SELECT MONTH(fv.`date_at`) AS 'month',SUM(fv.amount) AS 'amount' FROM sales_invoices fv 
                    WHERE  YEAR(fv.`date_at`)= ? GROUP BY MONTH(fv.`date_at`) ORDER BY MONTH(fv.`date_at`) ASC";

                    $stm = $this->Conexion->prepare($sqlTotal);
                    $stm->execute([$this->year]);
                    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $register) {
                        $data[0]=$register['amount'];
                    }

                    $stm = $this->Conexion->prepare($sqlMes);
                    $stm->execute([$this->year]);
                    $data[1] = $stm->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                }  
                
                if($this->modulo=='COMPRA'){
                    if($this->month != ""){
                        $sqlTotal = "SELECT SUM(fc.amount) AS 'amount' FROM purchase_invoices fc 
                                    WHERE  MONTH(fc.`date_at`)= ? AND YEAR(fc.`date_at`)= ? GROUP BY MONTH(fc.`date_at`)";
                        
                        $sqlMes = "SELECT DAY(fc.`date_at`) AS 'day',SUM(fc.`amount`) AS 'amount' FROM purchase_invoices fc 
                                    WHERE MONTH(fc.`date_at`)= ? AND YEAR(fc.`date_at`)= ? 
                                    GROUP BY DAY(fc.`date_at`) ORDER BY DAY(fc.`date_at`) ASC";                        
                        
                        $stm = $this->Conexion->prepare($sqlTotal);
                        $stm->execute([ $this->month, $this->year]);
                        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($result as $register) {
                            $data[0]=$register['amount'];
                        }
                        
                        $stm = $this->Conexion->prepare($sqlMes);
                        $stm->execute([ $this->month, $this->year]);
                        $data[1] = $stm->fetchAll(PDO::FETCH_ASSOC);
                        return $data;
                    }else{
                    
                        $sqlTotal = "SELECT SUM(fc.`amount`) AS 'amount' FROM purchase_invoices fc  WHERE  YEAR(fc.`date_at`)='$anho' GROUP BY YEAR(fc.`date_at`)";

                        $sqlMes = "SELECT MONTH(fc.`date_at`) AS 'month',SUM(fc.`amount`) AS 'amount' FROM purchase_invoices fc 
                        WHERE YEAR(fc.`date_at`)= ? GROUP BY MONTH(fc.`date_at`) ORDER BY MONTH(fc.`date_at`) ASC";
                        
                        $stm = $this->Conexion->prepare($sqlTotal);
                        $stm->execute([$this->year]);
                        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($result as $register) {
                            $data[0]=$register['amount'];
                        }
                        
                        $stm = $this->Conexion->prepare($sqlMes);
                        $stm->execute([$this->year]);
                        $data[1] = $stm->fetchAll(PDO::FETCH_ASSOC);
                        return $data;
                    }
                }           
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