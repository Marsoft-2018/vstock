<?php
	//require_once ("Conect.php");
	class Producto extends ConectarPDO{
		public $id;
        public $name;
        public $reference;
        public $purchase_price;
        public $selling_price;
        public $initial_quantity;
        public $purchases;
        public $sales;
        public $stock_returns;
        public $stock;
        public $min_quantity;
        public $bussines_id;
        public $category_id;
        public $measure_id;
		private $sql;
        
        public function listar(){
            $this->sql="SELECT inv.id, inv.name, inv.reference, inv.purchase_price, inv.selling_price, inv.initial_quantity, inv.purchases, inv.sales, inv.stock_returns, inv.stock, inv.min_quantity, inv.bussines_id, inv.category_id, med.short_name as measure, cat.`name` as Categorias
            FROM inventario inv
            INNER JOIN categorias cat ON inv.category_id = cat.`id`
			INNER JOIN medidas med ON inv.measure_id = med.`id`
            WHERE inv.bussines_id = ?
            ORDER BY inv.`name` ASC";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->bussines_id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los productos. ".$e;
			}

        }
        
        public function cargar(){
            $this->sql="SELECT * FROM inventario WHERE `id`=? AND bussines_id  = ?";  
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->bindParam(2, $this->bussines_id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los productos. ".$e;
			}
        }
        
        public function totales(){
            $this->sql="SELECT SUM(initial_quantity) as initial_quantity, SUM(purchases) as purchases, SUM(sales) as sales, SUM(stock_returns) as stock_returns, SUM(stock) as stock  FROM inventario WHERE bussines_id = ?"; 
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->bussines_id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los productos. ".$e;
			}
        }
      
        public function agregar(){ 
            $this->sql = "INSERT INTO inventario(id,`name`,reference,purchase_price,selling_price,initial_quantity,stock,min_quantity,bussines_id,category_id,measure_id) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->bindParam(2, $this->name);
				$stm->bindParam(3, $this->reference);
				$stm->bindParam(4, $this->purchase_price);
				$stm->bindParam(5, $this->selling_price);
				$stm->bindParam(6, $this->initial_quantity);
				$stm->bindParam(7, $this->stock);
				$stm->bindParam(8, $this->min_quantity);
				$stm->bindParam(9, $this->bussines_id);
				$stm->bindParam(10, $this->category_id);
				$stm->bindParam(11, $this->measure_id);
				if($stm->execute()){
				    echo "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el producto. ".$e;
			}   
        }        
               
        public function modificar(){
            $this->sql = "UPDATE inventario SET `name` = ?,reference = ?,purchase_price = ?,selling_price = ?,initial_quantity = ?,stock = ?,min_quantity = ?,category_id = ?,measure_id = ? WHERE id = ? AND bussines_id = ?";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->name);
				$stm->bindParam(2, $this->reference);
				$stm->bindParam(3, $this->purchase_price);
				$stm->bindParam(4, $this->selling_price);
				$stm->bindParam(5, $this->initial_quantity);
				$stm->bindParam(6, $this->stock);
				$stm->bindParam(7, $this->min_quantity);
				$stm->bindParam(8, $this->category_id);
				$stm->bindParam(9, $this->measure_id);
				$stm->bindParam(10, $this->id);
				$stm->bindParam(11, $this->bussines_id);
				if($stm->execute()){
				    echo "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el producto. ".$e;
			}
        }
        
        public function eliminar(){        
            $this->sql="DELETE FROM inventario WHERE id=? AND bussines_id=?"; 
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
  
        
        public function agotados(){
            $this->sql="SELECT inv.id FROM inventario inv WHERE inv.`stock`<=inv.`min_quantity` AND bussines_id = ?"; 
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->bussines_id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los productos. ".$e;
			}
        }
        
        public function nuevoPorCompra($id, $name, $reference, $purchase_price, $selling_price, $cantidadCompra, $min_quantity, $bussines_id, $category_id, $measure){
            $this->sql = "INSERT INTO inventario(id,name,reference,purchase_price,selling_price,initial_quantity,purchases,sales,stock_returns,stock,min_quantity,bussines_id,category_id,measure) VALUES('$id','$name','$reference',$purchase_price,$selling_price,0,$cantidadCompra,0,0,$cantidadCompra,$min_quantity,$bussines_id,$category_id,'$measure')";
            return $this->sql;
        }

		

	}
// 	include ("../Controladores/encript.php");	
// 	 $objUsu = new Usuario();
// 	 $objUsu->setDatos('Admin','123456');
// 	 $objUsu->login();

// 	$objUsu->validarActivacion();
// ?>