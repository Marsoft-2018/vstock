<?php
	//require_once ("Conect.php");
	class PayForm extends ConectarPDO{
		public $id;
        public $name;
        public $description;
        public $type_sale;
		private $sql;
        
        public function listAll(){
            $this->sql="SELECT  type_sale, id, name, description FROM pay_forms WHERE `type_sale`=? ORDER BY `name` ASC";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->type_sale);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los registros. ".$e;
			}

        }

        public function listFilter(){
            $this->sql="SELECT  type_sale, id, name, description FROM pay_forms WHERE `type_sale`=? ORDER BY `id` ASC";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->type_sale);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los registros. ".$e;
			}

        }
        
        public function load(){
            $this->sql="SELECT * FROM pay_forms WHERE `id`=?";  
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los registros. ".$e;
			}
        }
      
        public function add(){ 
            $this->sql = "INSERT INTO pay_forms(id,type_sale,`name`,`description`) VALUES(?,?,?,?)";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->bindParam(2, $this->type_sale);
				$stm->bindParam(3, $this->name);
				$stm->bindParam(4, $this->description);
				if($stm->execute()){
				    echo "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el ct. ".$e;
			}   
        }        
               
        public function update(){
            $this->sql = "UPDATE pay_forms SET `name` = ?, `description` = ?, type_sale = ? WHERE id = ?";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->name);
				$stm->bindParam(2, $this->description);
				$stm->bindParam(3, $this->type_sale);
				$stm->bindParam(4, $this->id);
				if($stm->execute()){
				    echo "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el ct. ".$e;
			}
        }
        
        public function delete(){        
            $this->sql="DELETE FROM pay_forms WHERE id=?"; 
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