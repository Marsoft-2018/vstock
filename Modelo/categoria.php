<?php
   
    class Categoria extends ConectarPDO{
        public $id;
        public $bussines_id;
        public $name;
        public $description;
        public $status;
        private $sql;
        private $data;

        function listar(){
            $this->sql = "SELECT * FROM categorias WHERE bussines_id = ?";
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

        function cargar(){
            $this->sql = "SELECT * FROM categorias WHERE bussines_id = ? AND id= ? ";
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
        function agregar($idNegocio,$nombre){
            mysql_query("INSERT INTO categorias(idNegocio,Categorias) VALUES('$idNegocio','$nombre')");
        }
        function eliminar($idNegocio,$id){            
            try {
                mysql_query("DELETE FROM `categorias` WHERE `Id_categoria` = '$id';");
            } catch (Exception $e) {
                echo 'Error al eliminar: ',  $e->getMessage(), "\n";
            }
        }
        function actualizar($idNeg,$campo,$clave,$valor){
            mysql_query("UPDATE categorias SET `$campo`='$valor' WHERE `Id_categoria`='$clave' AND `idNegocio`='$idNeg';");
            echo   "<script type='text/javascript'> alertify.success('Actualizado con éxito'); </script>";
        }
        function agregarDirecta($idNegocio,$nombre){
            mysql_query("INSERT INTO categorias(idNegocio,Categorias) VALUES('$idNegocio','$nombre')");
            echo "<input type='text' id='categoriaNuevoArticulo'  value='' class='form-control' list='listaCategoriasExistentes'>";
            echo   "<span class='input-group-btn'>
                        <buttton class ='btn btn-primary' onclick='agregarCategoriaDirecta()' title='Agregar la categoria al listado'>
                            <i class='fa fa-plus'></i>
                        </button>
                    </span>";
            echo "<datalist id='listaCategoriasExistentes'>";
            
            $sqlCategorias=mysql_query("select * from categorias");
            while ($cat=mysql_fetch_array($sqlCategorias)){
                echo "<option value='$cat[1]'>$cat[2]";
            }
            echo "</datalist>";
             echo "<script> alertify.success('La categoria: $nombre ya esta en lista'); </script>";
        }
    }

?>