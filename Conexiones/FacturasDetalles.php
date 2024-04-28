<?php
require ("Conect.php");
    class detallesProd extends Conectar{
        private $factura;
        public function __construct($fac){
            parent::__construct();
            $this->factura=$fac;         
        }
        public function cargarProducto(){
             $sql=mysql_query("SELECT *  FROM facturasTemp ORDER BY ID_Prod;");
            while($p=mysql_fetch_array($sql)){
             echo "
                 <tr>
                    <td>$p[1]</td>
                    <td align='left'>$p[2]</td>
                    <td align='center'><input type='text' value='$p[3]' id='cantidad$p[1]' class='cantProd' readonly='true'></td>
                    <td align='right'>
                        <input type='text' value='$p[4]' name='' id='$p[1]' onchange='cambiarPrecio(this.id,this.value)' class='precioProd'>
                    </td>
                    <td align='right'>
                        <div id='subTotal$p[1]'>
                            <input type='text' value='$ ".number_format($p[5],0,',','.')."' name='' id='subTotal$p[1]' onchange='' class='precioProd' readonly='true'>
                        </div>
                    </td>
                    <td><button type='button' class='btn btn-sm btn-danger eliminar-producto fa fa-trash' id='$p[1]' title='Eliminar Producto de la lista' onclick='eliminarArticuloTemp(this.id)'></button></td>
                </tr>             
             ";
            }         
        }
        public function agregarProducto($modulo,$id,$cant){
            $precioU;
            $descripcion;
            $subTotal;
            $sqlLimpiarProd=mysql_query("DELETE FROM facturasTemp WHERE Id_prod='$id'");
            if($modulo=='VENTA'){
                $sqlPrecio=mysql_query("SELECT PRECIO_VENTA,ARTICULO,REFERENCIA FROM inventario WHERE ID_Prod='$id'");
            }elseif ($modulo=='COMPRA') {
                $sqlPrecio=mysql_query("SELECT PRECIO_COMPRA,ARTICULO,REFERENCIA FROM inventario WHERE ID_Prod='$id'");
            }
            while($pc=mysql_fetch_array($sqlPrecio)){
                $precioU=$pc[0];
                $descripcion=$pc[1]." - ".$pc[2];
            }
            $subTotal=($cant*$precioU);
            $sqlAgregar=mysql_query("INSERT INTO facturasTemp values('".$this->factura."','$id','$descripcion','$cant',$precioU,$subTotal)");
        } 

        public function eliminarProducto($id){
            $sqlLimpiarProd=mysql_query("DELETE FROM facturasTemp WHERE Id_prod='$id'");            
        }

        public function actualizarPrecioTemp($id,$precio){
            $sqlLimpiarProd=mysql_query("UPDATE facturasTemp SET `ValorUnit`=$precio, `SubTotal`=(CANT*`ValorUnit`) WHERE Id_prod='$id'"); 
            $sqlPrecio=mysql_query("SELECT `SubTotal` FROM facturasTemp WHERE Id_prod='$id'");
            while($p=mysql_fetch_array($sqlPrecio)){
                echo "<input type='text' value='$ ".number_format($p[0],0,',','.')."' name='' id='subTotal$id' class='precioProd' readonly='true'>";
            }
        }
        
        public function TotalFac(){
            $Total=mysql_query("select SUM(SubTotal) from facturasTemp;") or die ("");
            while($pc=mysql_fetch_array($Total)){
                echo "$ ".number_format($pc[0],0,',','.');
            }
        }
    }

    class Facturar extends Conectar{
        public function Enviar($numFac,$modulo,$idcliente,$tipo,$fecFactura,$formaPago,$factRegistro){
            $estado='';
            if($tipo=='credito'){
                $estado='Por Pagar';
            }else{
                $estado='Cancelada';
            }
            if($modulo=="VENTA"){                              
                $sqlTotal=mysql_query("select SUM(SubTotal) from facturasTemp;") or die ("");
                $sqlCargarDetalle=mysql_query("SELECT *  FROM facturasTemp ");
                $total;
                $cantVendida;
                $cantRestante;
                
                while($tf=mysql_fetch_array($sqlTotal)){
                    $total=$tf[0];
                }
                
                $sql1=mysql_query("INSERT INTO facturasv Values($idcliente,$numFac,'$fecFactura',$total,'$tipo','$formaPago','$estado')");                
                
                while($dt=mysql_fetch_array($sqlCargarDetalle)){
                    //Conforme se leen los registros de la tabla temporal se llena la tabla de detalles de la venta (facturasventasdes)
                    $sql2=mysql_query("INSERT INTO facturasventasdes (`FACTURA`, `id_prod`, `descripcion`, `CANT`, `ValorUnit`, `SubTotal`) Values($dt[0],'$dt[1]','$dt[2]','$dt[3]',$dt[4],$dt[5])"); 
                    
                    //Ticket1 de la factura 
                    /*
                    echo "<div class='facturaImp' style='width:199px;border:1px solid #cecece;padding:5px;'>";
                        $datosEncabezado=mysql_query("select * from negocio Where IdNegocio='1'");
                        $nombreNegocio;
                        $logo;
                        $nit;
                        $direccion;
                        $tel;
                        $ciudad;
                       // $total=0;
                        while($n=mysql_fetch_array($datosEncabezado)){
                            $nombreNegocio=$n[1];
                            $logo=$n[8];
                            $nit=$n[2];
                            $direccion=$n[3]." Barrio ".$n[4];
                            $tel=$n[6];
                            $ciudad=$n[5];
                        }

                        echo "<header style='width:100%;'>
                                    <div style='width:100%;text-align:center;margin-top:20px;margin-bottom:10px;'>
                                        <img src='img/$logo' style='width:105px;margin:0 auto;'>
                                    </div>
                                    <div style='width:100%;font-size:9px;text-align:center;border-bottom:1px dotted #cecece;'>
                                        <span><h5 style='margin:0px;padding:0px;'>$nombreNegocio</h5></span>
                                        <span>Nit: $nit</span><br>
                                        <span>$direccion. Teléfono: $tel</span><br>
                                        <span>$ciudad</span>
                                    </div>
                            </header>";
                        echo "<div style='width:100%;text-align:left;margin-top:10px;font-size:9px;'><strong>FACTURA No.</strong> 0001 </div>";
                        echo "<div style='width:100%;text-align:left;margin-top:5px;font-size:9px;'>Fecha Venta: 25/06/2017 </div>";
                        //Datos del cliente
                        $sqlC=mysql_query("SELECT * FROM clientes WHERE idCliente='1' ORDER BY Nombre");
                        while($c=mysql_fetch_array($sqlC)){
                            echo "<div style='width:100%;text-align:left;margin-top:5px;font-size:9px;'><strong>Cliente: </strong> $c[1]</div>";
                            echo "<div style='width:100%;text-align:left;margin-top:5px;font-size:9px;'><strong>CC/NIT: </strong> $c[0]</div>";
                        }
                        echo "<div style='width:100%;text-align:left;margin-top:5px;font-size:9px;'>";
                        echo    "<table style='width:100%;'>
                                   <thead>
                                        <tr>
                                            <th>Cod.</th>
                                            <th style='text-align:center'>Descripción</th>
                                            <th style='text-align:center'>Cant</th>
                                            <th style='text-align:center'>Valor</th>
                                        </tr>
                                   </thead>
                                    <tbody>";
                                    $sqlArt=mysql_query("SELECT fvd.id_prod,fvd.descripcion,fvd.CANT,fvd.ValorUnit,fvd.SubTotal FROM facturasventasdes fvd WHERE fvd.FACTURA='1';");
                                    while($ar=mysql_fetch_array($sqlArt)){
                                        echo "<tr>";
                                        echo   "<td>$ar[0]</td>";
                                        echo   "<td>$ar[1]</td>";
                                        echo   "<td style='text-align:center'>$ar[2]</td>";
                                        echo   "<td style='text-align:right;'>$ ".number_format($ar[4], 0, ',', '.')."</td>";
                                        echo "</tr>";
                                        //$total=$total+$ar[4];
                                    }
                           echo    "</tbody>
                                    <tfoot>
                                        <tr>
                                            <td align='right' colspan='3'><strong>TOTAL:</strong></td>
                                            <td><h5 style='text-align:right;'>$ ".number_format($total, 0, ',', '.')."</h5></td>
                                        </tr>
                                    </tfoot>                        
                                </table>";
                        echo "</div>";
                        echo "<div style='width:100%;text-align:center;margin-top:5px;font-size:9px;'><strong>Gracias por su compra!</strong> </div>";  
                echo "</div>";

                */
            
            //Ticket de la factura 2
                   
                    echo "<div class='facturaImp' style='width:98%;border:1px solid #cecece;padding:5px;'>";
                        $datosEncabezado=mysql_query("select * from negocio Where IdNegocio='1'");
                        $nombreNegocio;
                        $logo;
                        $nit;
                        $direccion;
                        $tel;
                        $ciudad;
                        while($n=mysql_fetch_array($datosEncabezado)){
                            $nombreNegocio=$n[1];
                            $logo=$n[8];
                            $nit=$n[2];
                            $direccion=$n[3]." Barrio ".$n[4];
                            $tel=$n[6];
                            $ciudad=$n[5];
                        }

                        echo "<header style='width:100%;'>
                                    <div style='width:100%;text-align:center;margin-top:20px;margin-bottom:10px;'>
                                        <img src='img/$logo' style='width:105px;margin:0 auto;'>
                                    </div>
                                    <div style='width:100%;font-size:9px;text-align:center;border-bottom:1px dotted #cecece;'>
                                        <span><h5 style='margin:0px;padding:0px;'>$nombreNegocio</h5></span>
                                        <span>Nit: $nit</span><br>
                                        <span>$direccion. Teléfono: $tel</span><br>
                                        <span>$ciudad</span>
                                    </div>
                            </header>";
                        echo "<div style='width:100%;text-align:left;margin-top:10px;font-size:9px;'><strong>FACTURA No.</strong> $numFac </div>";
                        echo "<div style='width:100%;text-align:left;margin-top:5px;font-size:9px;'>Fecha Venta: $fecFactura </div>";
                        //Datos del cliente
                        $sqlC=mysql_query("SELECT * FROM clientes WHERE idCliente='1' ORDER BY Nombre");
                        while($c=mysql_fetch_array($sqlC)){
                            echo "<div style='width:100%;text-align:left;margin-top:5px;font-size:9px;'><strong>Cliente: </strong> $c[1]</div>";
                            echo "<div style='width:100%;text-align:left;margin-top:5px;font-size:9px;'><strong>CC/NIT: </strong> $c[0]</div>";
                        }
                        echo "<div style='width:100%;text-align:left;margin-top:5px;font-size:9px;'>";
                        echo    "<table style='width:100%;'>
                                   <thead>
                                        <tr>
                                            <th>Cod.</th>
                                            <th style='text-align:center'>Descripción</th>
                                            <th style='text-align:center'>Cant</th>
                                            <th style='text-align:center'>VUnit</th>
                                            <th style='text-align:center'>Valor</th>
                                        </tr>
                                   </thead>
                                    <tbody>";
                                    $sqlArt=mysql_query("SELECT fvd.id_prod,fvd.descripcion,fvd.CANT,fvd.ValorUnit,fvd.SubTotal FROM facturasventasdes fvd WHERE fvd.FACTURA='$numFac';");
                                    while($ar=mysql_fetch_array($sqlArt)){
                                        echo "<tr>";
                                        echo   "<td>$ar[0]</td>";
                                        echo   "<td>$ar[1]</td>";
                                        echo   "<td style='text-align:center'>$ar[2]</td>";
                                        echo   "<td style='text-align:right;'>$ ".number_format($ar[3], 0, ',', '.')."</td>";
                                        echo   "<td style='text-align:right;'>$ ".number_format($ar[4], 0, ',', '.')."</td>";
                                        echo "</tr>";
                                    }
                           echo    "</tbody>
                                    <tfoot>
                                        <tr>
                                            <td align='right' colspan='4'><strong>TOTAL:</strong></td>
                                            <td><h5 style='text-align:right;'>$ ".number_format($total, 0, ',', '.')."</h5></td>
                                        </tr>
                                    </tfoot>                        
                                </table>";
                        echo "</div>";
                        echo "<div style='width:100%;text-align:center;margin-top:5px;font-size:9px;'><strong>Gracias por su compra!</strong> </div>";  
                echo "</div>";
                    
                    //se carga del inventario las cantidades almacenadas en los campos Ventas y Cant Final
                    $sqlCantidadesInventario=mysql_query("SELECT VENTAS,CANT_FINAL FROM inventario WHERE ID_Prod='$dt[1]' ");  
                    while($cinv=mysql_fetch_array($sqlCantidadesInventario)){
                        $cantVendida=$cinv[0];
                        $cantRestante=$cinv[1];
                    }
                    
                    //se actualiza el inventario con las nuevas cantidades
                    $cantVendida=$cantVendida+$dt[3];
                    $cantRestante=$cantRestante-$dt[3];
                    $sqlActualizaInventario=mysql_query("UPDATE inventario SET VENTAS=$cantVendida, CANT_FINAL=$cantRestante WHERE ID_Prod='$dt[1]' ");
                } 
                
                $sql3=mysql_query("TRUNCATE TABLE facturasTemp");
                
                //echo "<script>window.print(); </script>";
            }
            
            if($modulo=="COMPRA"){                              
                $sqlTotal=mysql_query("SELECT SUM(SubTotal) FROM facturasTemp;") or die ("");
                $sqlCargarDetalle=mysql_query("SELECT *  FROM facturasTemp ");
                $total;
                $cantVendida;
                $cantRestante;
                
                while($tf=mysql_fetch_array($sqlTotal)){
                    $total=$tf[0];
                }
                
                //echo " los valores para la factura son: .$idcliente,$numFac,$fecFactura,$total,$tipo,$formaPago,$estado ";
                
                /*
                `idProveedor`, `FACTURA`, `FECHA`, `TOTAL`, `tipo`, `formaDePago`, `estado`
                */
                
                               
                
                while($dt=mysql_fetch_array($sqlCargarDetalle)){
                    //Conforme se leenlos registros de la tabla temporal se llena la tabla de detalles de la venta (facturasventasdes)
                    $sql1=mysql_query("INSERT INTO facturasc Values('$idcliente','$numFac','$fecFactura','$total','$tipo','$formaPago','$estado','$factRegistro')");

                    $sql2=mysql_query("INSERT INTO `facturascomprasdes` (`FACTURA`, `id_prod`, `descripcion`, `CANT`, `ValorUnit`, `SubTotal`) VALUES ('$dt[0]','$dt[1]','$dt[2]','$dt[3]','$dt[4]','$dt[5]')"); 
                     
                    //se carga del inventario las cantidades almacenadas en los campos Ventas y Cant Final
                    $sqlCantidadesInventario=mysql_query("SELECT COMPRAS,CANT_FINAL FROM inventario WHERE ID_Prod='$dt[1]' ");  
                    while($cinv=mysql_fetch_array($sqlCantidadesInventario)){
                        $cantComprada=$cinv[0];
                        $cantRestante=$cinv[1];
                    }
                    
                    //se actualiza el inventario con las nuevas cantidades
                    $cantComprada=$cantComprada+$dt[3];
                    $cantRestante=$cantRestante+$dt[3];
                    $sqlActualizaInventario=mysql_query("UPDATE inventario SET COMPRAS=$cantComprada, CANT_FINAL=$cantRestante WHERE ID_Prod='$dt[1]' ");
                } 
                
                $sql3=mysql_query("TRUNCATE TABLE facturasTemp");
            }
        }
    }

?>