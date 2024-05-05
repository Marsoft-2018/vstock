<?php
    class Conectar{
        private $Servidor="15.235.82.117";
        private $Usuario="innovos1_titan";
        private $Contrasena="EA%JQ=+GTcIA";
        private $base="innovos1_innovo";
        private $Conexion;
        public function __construct(){
            $this->Conexion= mysql_connect($this->Servidor,$this->Usuario,$this->Contrasena)or die('no se conecto');;        
            mysql_select_db($this->base,$this->Conexion);
            return $this->Conexion; 
        }
        public function cerrarConexion(){
            mysql_close($this->Conexion);
        }
    }
    if ($_POST['Edparte']==1){
		$ParteED='Inventario';
	}
    
    class verificaExistencias extends conectar{//con esta clase se verifica la cantidad de existencias en el inventario
        private $cantidadFinal;
        private $cantidadMin;
        private $resultado;
        private $producto;
        public function verificar($id,$modulo){
            //colocar la consultas para traer de la BDT la cantidad min y la cantidad final
            $sqlCantidades=mysql_query("SELECT CANT_FINAL,CANTIDAD_MIN,ARTICULO,REFERENCIA FROM inventario WHERE `ID_Prod`=".$id.";");  
            while($cant=mysql_fetch_array($sqlCantidades)){
                $this->cantidadFinal=$cant[0];
                $this->cantidadMin=$cant[1];
                $this->producto=$cant[2]." Referencia: ".$cant[3];
            }
            //<input type='hidden' id='esNuevo' value=''/>
             
            $sqlConsultar=mysql_query("SELECT ID_prod FROM inventario WHERE ID_prod='$id'");
            $existe =   mysql_num_rows($sqlConsultar);
            //realizar la comparación para obtener la diferencia entre los datos y si esta muy cerca retornar la advertencia.
            if($existe==0){
                echo "<div class='alert alert-info alert-dismissable' style='font-size:11px;' id='registroNuevoArticulo'>";
                echo    "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";                
                echo    "<div class='panel panel-default'>";
                echo        "<div class='panel-heading' style='color:#000;padding:1px;'>";
                echo            "<h5>Articulo Nuevo - Datos para registrarlo en el inventario</h5>";
                echo        "</div>";
                echo        "<div class='panel-body'>";
                            echo "<div class='col-md-6'>";
                            echo "<label for=''>Nombre del Articulo</label>";
                            echo "<input type='text' class='form form-control' id='nombreNuevoArticulo'>";
                            
                            echo "</div>";

                            echo "<div class='col-md-4'>";
                            echo "<label for=''>Referencia</label>";
                            echo "<input type='text' class='form form-control' id='referenciaNuevoArticulo'>";
                            echo "</div>";
                            echo "<div class='col-md-2'>";
                            echo "<label for=''>Unidad de medida</label>
                                <select id='id_medida' class='form form-control' name='id_medida' onchange='modificarArticulo(this.id,this.name,this.value)'>";
                                    $sqlMedidas=mysql_query("select * from medidas");
                                    while ($medida = mysql_fetch_array($sqlMedidas)){
                                        if($medida[2]==$registro[13]){
                                            echo "<option value='$medida[2]' selected='selected'>$medida[1]</option>";
                                        }else{
                                            echo "<option value='$medida[2]'>$medida[1]</option>";
                                        }
                                        
                                    }
                            echo "</select>
                            </div>";
                            echo "<div class='col-md-3'>";
                            echo    "<label for=''>Categoria</label>";
                            echo    "<div id='registrarCategorias' class='form-group input-group'>";
                            echo        "<input type='text' id='categoriaNuevoArticulo' class='form-control' list='listaCategoriasExistentes' value='' required>";
                            echo        "<span class='input-group-btn'>";
                            echo            "<buttton class ='btn btn-primary' onclick='agregarCategoriaDirecta()' title='Agregar la categoria al listado'>";
                            echo                "<i class='fa fa-plus'></i>";
                            echo            "</button>";
                            echo        "</span>";    
                            echo        "<datalist id='listaCategoriasExistentes'>";
                            
                                        $sqlCategorias=mysql_query("select * from categorias");
                                        while ($cat=mysql_fetch_array($sqlCategorias)){
                                            echo "<option value='$cat[1]'>$cat[2]";
                                        }
                            echo        "</datalist>";
                            echo    "</div>";
                            echo "</div>";

                            echo "<div class='col-md-4'>";
                            echo    "<label for=''>Precio de Compra</label>";
                            echo    "<input type='text' class='form form-control' id='precioDeCompraNuevoArticulo'>";
                            echo "</div>";

                            echo "<div class='col-md-4'>";
                            echo    "<label for=''>Precio de Venta</label>";
                            echo    "<input type='text' class='form form-control' id='precioDeVentaNuevoArticulo'>";
                            echo "</div>";
                echo        "</div>";
                echo   "</div>";
                //echo    "<button class='btn btn-info fa fa-plus-circle' onclick='agregarNuevoArticulo()' id='esNuevo'>Agregar al Inventario</button>";
                echo "</div>";
            }elseif($this->cantidadFinal==0){
               echo "<div class='alert alert-danger alert-dismissable' style='font-size:11px;'>";
               echo     "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
               echo         "El producto ".$this->producto." se encuentra agotado (Existencias = ".$this->cantidadFinal.")";
               echo         "<input type='hidden' id='esNuevo' value='$existe'/>";
               echo "</div>";
            }elseif($this->cantidadFinal==$this->cantidadMin){
               echo "<div class='alert alert-warning alert-dismissable' style='font-size:11px;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>El producto ".$this->producto." se encuentra en su cantidad mínima(Existencias = ".$this->cantidadMin.")<input type='hidden' id='esNuevo' value='$existe'/></div>";
            }elseif($this->cantidadFinal==($this->cantidadMin+2)){
               echo "<div class='alert alert-info alert-dismissable' style='font-size:11px;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>El producto ".$this->producto." se acerca a su cantidad mínima (Existencias = ".($this->cantidadFinal).")<input type='hidden' id='esNuevo' value='$existe'/></div>"; 
            }elseif($this->cantidadFinal<$this->cantidadMin){
               echo "<div class='alert alert-danger alert-dismissable' style='font-size:11px;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>El producto ".$this->producto." se encuentra por debajo de la cantidad mínima (Existencias = ".$this->cantidadFinal.")<input type='hidden' id='esNuevo' value='$existe'/></div>";
            }elseif($this->cantidadFinal==0){
               echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>El producto ".$this->producto." se encuentra agotado (Existencias = ".$this->cantidadFinal.")<input type='hidden' id='esNuevo' value='$existe'/></div>";
            }else{               
                echo "<div class='alert alert-success alert-dismissable' style='font-size:11px;'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        ".$this->producto." (Existencias = ".$this->cantidadFinal.").
                    </div>";
            }            
        }
        
        function esNuevo($id){
            //colocar la consultas para traer de la BDT la cantidad min y la cantidad final
            $sqlCantidades=mysql_query("SELECT CANT_FINAL,CANTIDAD_MIN FROM inventario WHERE `ID_Prod`=".$id.";");  
            while($cant=mysql_fetch_array($sqlCantidades)){
                $this->cantidadFinal=$cant[0];
                $this->cantidadMin=$cant[1];
            }
            //<input type='hidden' id='esNuevo' value=''/>
             
            $sqlConsultar=mysql_query("SELECT ID_prod FROM inventario WHERE ID_prod='$id'");
            $existe =   mysql_num_rows($sqlConsultar);
            //realizar la comparación para obtener la diferencia entre los datos y si esta muy cerca retornar la advertencia.
            if($existe==0){
                $this->resultado='Nuevo';                
            }else{
                $this->resultado='Inventariado';
            }
            echo "<input type='hidden' class='for-control' id='registrado' value='$this->resultado'>";            
        }
    }

    class Cliente extends Conectar{
        private $sqlCliente;
        public function Buscar(){
            $this->sqlCliente=mysql_query("SELECT * FROM clientes ORDER BY Nombre")
                or die ("Error al buscar Clientes");
            return $this->sqlCliente;
        }
        public function Cargar($id){
            $this->sqlCliente=mysql_query("select * from clientes WHERE idCliente='$id'")
            or die ("Error al buscar Clientes");
            return $this->sqlCliente;
        }
        public function agregarCliente($ID_cliente,$Nombre,$Dir,$TEL,$CIUDAD,$correo){
            $sqlAgregar=mysql_query("INSERT INTO clientes VALUES($ID_cliente,'$Nombre','$Dir','$TEL','$CIUDAD','$correo')");
        }

        public function actualizarDatos($campo,$clave,$valor){
            $sqlActualiza=mysql_query("UPDATE clientes SET `$campo`='$valor' WHERE `idCliente`='$clave'");
            /*echo "<div class='alert alert-success alert-dismissable' >";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
            echo "Dato del cliente actualizado con éxito</div>";*/
        }
    }

    class Proveedor extends Conectar{
        private $sqlProveedor;
        public function Buscar(){
            $this->sqlProveedor=mysql_query("SELECT * FROM proveedores ORDER BY Nombre")
                or die ("Error al buscar Proveedores");
            return $this->sqlProveedor;
        }
        public function Cargar($id){
            $this->sqlProveedor=mysql_query("SELECT * FROM Proveedores WHERE idProveedor='$id'")
            or die ("Error al buscar Proveedores");
            return $this->sqlProveedor;
        }
        public function agregarProveedor($ID_proveedor,$Nombre,$Dir,$TEL,$CIUDAD,$correo){
            $sqlAgregar=mysql_query("INSERT INTO proveedores VALUES('$ID_proveedor','$Nombre','$Dir','$TEL','$CIUDAD','$correo')");
        }
        
        public function actualizarDatos($campo,$clave,$valor){
            $sqlActualiza=mysql_query("UPDATE proveedores SET `$campo`='$valor' WHERE `idProveedor`='$clave'");
            /*echo "<div class='alert alert-success alert-dismissable'  >";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
            echo "Dato del proveedor actualizado con éxito</div>"; */
        }
    }

    class FacturaSiguiente extends Conectar{

        public function mascara($modulo){
            $sqlFact;
            if($modulo=="VENTA"){
                $sqlFact=mysql_query("SELECT MAX(factura) AS 'No. Factura' FROM facturasv;");
            }elseif($modulo=="COMPRA"){
                $sqlFact=mysql_query("SELECT MAX(factura) AS 'No. Factura' FROM facturasc;");
            }
            $totalF  =  mysql_num_rows($sqlFact);
            $FactSig;
            if($totalF==0){
                $FactSig=1;
            }else{
                while($f=mysql_fetch_array($sqlFact)){                          
                    $FactSig=$f[0]+1;  
                }
            }                   
            if($FactSig<10){
                echo "<input type='text' class='form-control factura clase3' id='factRegistro' value='0000000".$FactSig."' />";
            }elseif($FactSig<100){
                echo "<input type='text' class='form-control factura clase3' id='factRegistro' value='000000".$FactSig."' />";
            }elseif($FactSig<1000){
                echo "<input type='text' class='form-control factura clase3' id='factRegistro' value='00000".$FactSig."' />";
            }elseif($FactSig<10000){
                echo "<input type='text' class='form-control factura clase3' id='factRegistro' value='0000".$FactSig."' />";
            }elseif($FactSig<100000){
                echo "<input type='text' class='form-control factura clase3' id='factRegistro' value='000".$FactSig."' />";
            }elseif($FactSig<1000000){
                echo "<input type='text' class='form-control factura clase3' id='factRegistro' value='00".$FactSig."' />";
            }elseif($FactSig<10000000){
                echo "<input type='text' class='form-control factura clase3' id='factRegistro' value='0".$FactSig."' />";
            }else{
                echo $FactSig;
            }
        }  
        
        public function real($modulo){
            $sqlFact;
            if($modulo=="VENTA"){
                $sqlFact=mysql_query("SELECT MAX(factura) AS 'No. Factura' FROM facturasv;");
            }elseif($modulo=="COMPRA"){
                $sqlFact=mysql_query("SELECT MAX(factura) AS 'No. Factura' FROM facturasc;");
            }
            
            $totalF  =  mysql_num_rows($sqlFact);
            $FactSig;
            if($totalF==0){
                $FactSig=1;
            }else{
                while($f=mysql_fetch_array($sqlFact)){                          
                    $FactSig=$f[0]+1;  
                }
            }                   
               /*echo "<input type='text' id='txtFact' value='";
        $fs=$f->real($modulo);                      
    echo " ' />";*/
                echo "<input type='hidden' id='txtFact' value='$FactSig' />";
        }      
    }

?>