<?php
	//require_once ("Conect.php");
	class Negocio extends ConectarPDO{
		public $IdNegocio;
        public $NOMBRE;
        public $NIT;
        public $DIRECCION;
        public $BARRIO;
        public $CIUDAD;
        public $TEL;
        public $correo;
        public $LOGO;
        public $PROPIETARIO;
        public $estado;
        public $fechaReg;
		private $sql;
        
        public function listar($idNegocio){
            $this->sql="";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->IdNegocio);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los registro. ".$e;
			}

        }
        
        public function cargar(){
            $this->sql="SELECT * FROM negocio WHERE IdNegocio=?";  
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->IdNegocio);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar el negocio. ".$e;
			}
        }
        
        public function totales(){
            $this->sql="SELECT SUM(CANT_INICIAL),SUM(COMPRAS),SUM(VENTAS ),SUM(DEVOLUCIONES),SUM(CANT_FINAL) FROM inventario WHERE IdNegocio = ?"; 
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->IdNegocio);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los productos. ".$e;
			}
        }
        
               
        public function modificar($campo,$clave,$valor){
            //Consulta para actualizar los datos del articulo seleccionado
            $this->sqlAccion=mysql_query("UPDATE inventario SET `$campo`='$valor' WHERE `ID_Prod`='$clave' ");
            return $this->sqlAccion;
        }
        
        public function eliminar($idArticulo,$idNegocio){        
            $this->sql="DELETE FROM inventario WHERE ID_Prod=? AND idNegocio=?"; 
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $idArticulo);
				$stm->bindParam(2, $idNegocio);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los productos. ".$e;
			}
        }
        
        public function agregar($id_prod, $ARTICULO, $REFERENCIA, $PRECIO_COMPRA, $PRECIO_VENTA, $CANT_INICIAL, $CANTIDAD_MIN, $idNegocio, $id_categoria, $medida){ 
            $this->sql = "INSERT INTO inventario(ID_Prod,ARTICULO,REFERENCIA,PRECIO_COMPRA,PRECIO_VENTA,CANT_INICIAL,COMPRAS,VENTAS,DEVOLUCIONES,CANT_FINAL,CANTIDAD_MIN,IdNegocio,id_categoria,medida) VALUES('$id_prod','$ARTICULO','$REFERENCIA',$PRECIO_COMPRA,$PRECIO_VENTA,$CANT_INICIAL,0,0,0,$CANT_INICIAL,$CANTIDAD_MIN,$idNegocio,$id_categoria,'$medida')";
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->IdNegocio);
				if($stm->execute()){
				    return "Registro guardado con éxito";
				}
				
			} catch (Exception $e) {
				echo "Ocurrió un Error al guardar el producto. ".$e;
			}     
            
        }
        
        public function agotados(){
            $this->sql="SELECT inv.id_prod FROM inventario inv WHERE inv.`CANT_FINAL`<=inv.`CANTIDAD_MIN` AND IdNegocio = ?"; 
            try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindParam(1, $this->IdNegocio);
				$stm->execute();
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
				
				return $data;
			} catch (Exception $e) {
				echo "Ocurrió un Error al cargar los productos. ".$e;
			}
        }
        
        public function nuevoPorCompra($id_prod, $ARTICULO, $REFERENCIA, $PRECIO_COMPRA, $PRECIO_VENTA, $cantidadCompra, $CANTIDAD_MIN, $idNegocio, $id_categoria, $medida){
            $this->sql = "INSERT INTO inventario(ID_Prod,ARTICULO,REFERENCIA,PRECIO_COMPRA,PRECIO_VENTA,CANT_INICIAL,COMPRAS,VENTAS,DEVOLUCIONES,CANT_FINAL,CANTIDAD_MIN,IdNegocio,id_categoria,medida) VALUES('$id_prod','$ARTICULO','$REFERENCIA',$PRECIO_COMPRA,$PRECIO_VENTA,0,$cantidadCompra,0,0,$cantidadCompra,$CANTIDAD_MIN,$idNegocio,$id_categoria,'$medida')";
            return $this->sqlAccion;
        }

		

	}
// 	include ("../Controladores/encript.php");	
// 	 $objUsu = new Usuario();
// 	 $objUsu->setDatos('Admin','123456');
// 	 $objUsu->login();

// 	$objUsu->validarActivacion();
// ?>