<?php
	//require_once ("Conect.php");
	class Product extends ConectarPDO{
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
        public $text;
		private $sql;
        
        public function list(){
            $this->sql="SELECT prod.id, prod.name, prod.reference, prod.purchase_price, prod.selling_price, prod.initial_quantity, prod.purchases, prod.sales, prod.stock_returns, prod.stock, prod.min_quantity, prod.bussines_id, prod.category_id, med.short_name as measure, cat.`name` as category
            FROM products prod
            INNER JOIN categories cat ON prod.category_id = cat.`id`
			INNER JOIN measurements med ON prod.measure_id = med.`id`
            WHERE prod.bussines_id = ?
            ORDER BY prod.`name` ASC";
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
        
        public function load(){
            $this->sql="SELECT * FROM products WHERE `id`=? AND bussines_id  = ?";  
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

		
        public function find(){
            $this->sql="SELECT id,`name` FROM products WHERE id LIKE('".$this->text."%') AND bussines_id  =  ? LIMIT 10";  
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

        public function totales(){
            $this->sql="SELECT SUM(initial_quantity) as initial_quantity, SUM(purchases) as purchases, SUM(sales) as sales, SUM(stock_returns) as stock_returns, SUM(stock) as stock  FROM products WHERE bussines_id = ?"; 
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
      
        public function add(){ 
            $this->sql = "INSERT INTO products(id,`name`,reference,purchase_price,selling_price,initial_quantity,stock,min_quantity,bussines_id,category_id,measure_id) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
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
				echo "Ocurrió un Error al guardar el product. ".$e;
			}   
        }        
               
        public function update(){
            $this->sql = "UPDATE products SET `name` = ?,reference = ?,purchase_price = ?,selling_price = ?,initial_quantity = ?,stock = ?,min_quantity = ?,category_id = ?,measure_id = ? WHERE id = ? AND bussines_id = ?";
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
				echo "Ocurrió un Error al guardar el product. ".$e;
			}
        }
        
        public function delete(){        
            $this->sql="DELETE FROM products WHERE id=? AND bussines_id=?"; 
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
  
        
        public function soldOuts(){
            $this->sql="SELECT inv.id,inv.`name`,inv.`reference`,cat.`name` as category,inv.`purchase_price`,inv.`selling_price`,inv.initial_quantity,
            inv.purchases,inv.sales,inv.stock_returns,inv.min_quantity,inv.stock
            FROM products inv
            INNER JOIN categories cat
            ON inv.`category_id`=cat.`id`
            WHERE inv.`stock`<=inv.`min_quantity` and inv.bussines_id = ?
            ORDER BY inv.`name` ASC"; 
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
        
        public function nuevoPorCompra($id, $name, $reference, $purchase_price, $selling_price, $cantidadCompra, $min_quantity, $bussines_id, $category_id, $measure){
            $this->sql = "INSERT INTO products(id,name,reference,purchase_price,selling_price,initial_quantity,purchases,sales,stock_returns,stock,min_quantity,bussines_id,category_id,measure) VALUES('$id','$name','$reference',$purchase_price,$selling_price,0,$cantidadCompra,0,0,$cantidadCompra,$min_quantity,$bussines_id,$category_id,'$measure')";
            return $this->sql;
        }

		

	}
// 	include ("../Controladores/encript.php");	
// 	 $objUsu = new Usuario();
// 	 $objUsu->setDatos('Admin','123456');
// 	 $objUsu->login();

// 	$objUsu->validarActivacion();
// ?>