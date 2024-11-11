<?php
   
    class Category extends ConectarPDO{
        public $id;
        public $bussines_id;
        public $name;
        public $description;
        public $status;
        private $sql;
        private $data;

        function list(){
            $this->sql = "SELECT * FROM categories WHERE bussines_id = ?";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->bussines_id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los registros. ".$e;
			}
  
        } 

        function load(){
            $this->sql = "SELECT * FROM categories WHERE bussines_id = ? AND id= ? ";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->bussines_id);
				$stm->bindParam(2, $this->id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar el registro. ".$e;
			}
  
        } 
        function add(){
            $this->sql = "INSERT INTO categories(bussines_id,`name`,`description`) VALUES(?,?,?)";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->bussines_id);
				$stm->bindParam(2, $this->name);
				$stm->bindParam(3, $this->description);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);			
				
				echo "Registro guardado con éxito. ";
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el registro. ".$e;
			}
        }

        function delete(){             
            $this->sql = "DELETE FROM `categories` WHERE id = ?";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);			
				
				echo "Registro eliminado con éxito. ";
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el registro. ".$e;
			}
        }

        function update(){            
            $this->sql = "UPDATE categories SET `name` = ?, `description`=? WHERE id = ?";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->name );
				$stm->bindParam(2,$this->description);
				$stm->bindParam(3,$this->id);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				echo "Registro guardado con éxito. ";
			} catch (Exception $e) {
				echo "Ocurrió un Error al actualizar el registro. ".$e;
			}
        }

        function agregarDirecta($idNegocio,$nombre){
            mysql_query("INSERT INTO categories(idNegocio,Categories) VALUES('$idNegocio','$nombre')");
            echo "<input type='text' id='categoriaNuevoArticulo'  value='' class='form-control' list='listaCategoriasExistentes'>";
            echo   "<span class='input-group-btn'>
                        <buttton class ='btn btn-primary' onclick='agregarCategoriaDirecta()' title='Agregar la categoria al listado'>
                            <i class='fa fa-plus'></i>
                        </button>
                    </span>";
            echo "<datalist id='listaCategoriasExistentes'>";
            
            $sqlCategories=mysql_query("select * from categories");
            while ($cat=mysql_fetch_array($sqlCategories)){
                echo "<option value='$cat[1]'>$cat[2]";
            }
            echo "</datalist>";
             echo "<script> alertify.success('La categoria: $nombre ya esta en lista'); </script>";
        }
    }

?>