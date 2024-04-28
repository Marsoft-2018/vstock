<?php

            $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $semaforo=array("danger","warning","info","success");
            
            $sqlTotal;
            $sqlMes;
            $totalVentasContado=0;
            $totalVentasCredito=0;

            $totalComprasContado=0;
            $totalComprasCredito=0;

            $totalAbonosClientes=0;
            $totalCuentasPorCobrar=0;

            $totalAbonosProveedores=0;
            $totalDescuentosCompras=0;
            $totalCuentasPorPagar=0;

            $totalPagosEmpleados=0;

            echo "<h2 style='padding:1px;text-align:center;'>Reporte de Resultados: $anho</h2>";
            //Ingresos por ventas de contado y a crédito
                if($anho!=""){
                    
                    $sqlVentaContado=mysql_query("SELECT SUM(fv.TOTAL) AS 'TOTAL' FROM facturasv fv 
                    WHERE  YEAR(fv.`Fec_Venta`)='$anho'  AND fv.`tipo`='Contado' GROUP BY YEAR(fv.`Fec_Venta`);");
                    while($tV=mysql_fetch_array($sqlVentaContado)){
                        $totalVentasContado=$tV[0];
                    }

                    $sqlVentaCredito=mysql_query("SELECT SUM(fv.TOTAL) AS 'TOTAL' FROM facturasv fv 
                    WHERE  YEAR(fv.`Fec_Venta`)='$anho'  AND fv.`tipo`='Credito' GROUP BY YEAR(fv.`Fec_Venta`);");

                    while($t=mysql_fetch_array($sqlVentaCredito)){
                        $totalVentasCredito=$t[0];
                    }

                    $sqlCompraContado=mysql_query("SELECT SUM(fc.TOTAL) AS 'TOTAL' FROM facturasc fc WHERE  YEAR(fc.`FECHA`)='$anho' AND fc.`tipo`='Contado' GROUP BY YEAR(fc.`FECHA`);");
                    $resComprasC=mysql_num_rows($sqlCompraContado);
                    while($tC=mysql_fetch_array($sqlCompraContado)){
                        $totalComprasContado=$tC[0];
                    }

                    $sqlCompraCredito=mysql_query("SELECT SUM(fc.TOTAL) AS 'TOTAL' FROM facturasc fc WHERE  YEAR(fc.`FECHA`)='$anho' AND fc.`tipo`='Credito' GROUP BY YEAR(fc.`FECHA`);");

                    /*$resComprasCr=mysql_num_rows($sqlCompraCredito);
                    echo "Total registro compas de credito: ".$resComprasCr;*/

                    while($tCC=mysql_fetch_array($sqlCompraCredito)){
                        $totalComprasCredito=$tCC[0];

                        $sqlTotalDescuentosCompras = mysql_query("SELECT SUM(dc.TOTAL) AS 'TOTAL' FROM descuentocompras dc INNER JOIN facturasc fc ON fc.`FACTURA`=dc.`FACTURA` WHERE  YEAR(fc.`FECHA`)='$anho' AND fc.`tipo`='Credito' GROUP BY YEAR(fc.`FECHA`);");

                        $rsDescuentos=mysql_num_rows($sqlTotalDescuentosCompras);
                        if($rsDescuentos>0){
                            while($tDP=mysql_fetch_array($sqlTotalDescuentosCompras)){
                                $totalDescuentosCompras=$tDP[0];
                            }
                        }                      
                    }

                    $sqlAbonosClientes=mysql_query("SELECT SUM(ac.`valorAbono`) AS 'TOTAL' FROM abonos ac WHERE  YEAR(ac.`fechaAbono`)='$anho' GROUP BY YEAR(ac.`fechaAbono`);");

                    while($tAC=mysql_fetch_array($sqlAbonosClientes)){
                        $totalAbonosClientes=$tAC[0];                        
                    }

                    $totalCuentasPorCobrar = $totalVentasCredito - $totalAbonosClientes;
                    
                    $sqlAbonosProveedores=mysql_query("SELECT SUM(ap.`Valor_Abono`) AS 'TOTAL' FROM abonosproveedores ap WHERE  YEAR(ap.`Fecha_Abono`)='$anho' GROUP BY YEAR(ap.`Fecha_Abono`);");

                    while($tAP=mysql_fetch_array($sqlAbonosProveedores)){
                        $totalAbonosProveedores=$tAP[0];
                        
                    }      

                   $totalCuentasPorPagar=$totalComprasCredito - $totalAbonosProveedores - $totalDescuentosCompras; 
                }
            echo "<div class='row'>";
            echo "<div class='col-lg-6'>";
            echo "<div class='panel panel-success'>";
                        echo "<div class='panel-heading' style='padding:1px;text-align:center;'>";
                        echo "<h4 style='padding:1px;font-size:12px;'><strong>DESCRIPCION DE INGRESOS</strong></h4>";    
                        echo "</div>";
                        echo "<div class='panel-body'>";
                    echo "<div class='panel panel-info'>";
                        echo "<div class='panel-heading' style='padding:1px;text-align:center;'>";
                        echo "<h4 style='padding:1px;font-size:12px;'>Ingresos Netos por Ventas</h4>";    
                        echo "</div>";
                        echo "<div class='panel-body'>";
                        echo "<div class='row'>";
                        echo    "<div class='col-lg-12'>";                                    
                                    echo "<table class='table table-striped' width='99%' style='border:1px solid; padding:0px;'>";
                                        echo "<thead>";
                                            echo "<tr >";                                                
                                                echo "<th class='columna1'></th>";
                                                echo "<th class='columna3' style='padding:1px;height:20px;text-align:right;padding-right:30px;'>TOTAL</th>";
                                            echo "</tr>";
                                        echo "</thead>";     
                                        echo "<tbody>";  
                                        echo    "<tr >";                  
                                        echo        "<td style='padding-left:20px;height:20px;'>De Contado</td>";
                                        echo        "<td style='height:20px;text-align:right;padding-right:30px;'>$ ".number_format($totalVentasContado, 0, ',', '.')."</td>";
                                        echo    "</tr>"; 
                                        echo    "<tr>"; 
                                        echo        "<td style='padding-left:20px;height:20px;'>A Crédito</td>";
                                        echo        "<td style='height:20px;text-align:right;padding-right:30px;'>$ ".number_format($totalVentasCredito, 0, ',', '.')."</td>";                                  
                                        echo    "</tr>";    
                                        echo "</tbody>";
                                        echo "<tfoot>";
                                        
                                        echo "</tfoot>";
                                    echo    "</table>";
                        echo    "</div>";
                        echo "</div>";
                        echo "<div class='row'>";
                        echo    "<div class='col-lg-12'>";
                                echo "<div class='panel panel-info'>";
                                    echo "<div class='panel-heading' style='padding:1px;text-align:center;'>";
                                    echo "<h4 style='padding:1px;font-size:12px;'>Descripción del Crédito</h4>";    
                                    echo "</div>";
                                    echo "<div class='panel-body'>";
                                    echo "<table class='table table-striped' width='99%' style='border:1px solid; padding:0px;'>";
                                        echo "<thead>";
                                            echo "<tr >";
                                                    echo "<th class='columna1'></th>";
                                                    echo "<th class='columna3' style='padding:1px;height:20px;text-align:right;padding-right:30px;'>TOTAL</th>";
                                            echo "</tr>";
                                        echo "</thead>";     
                                        echo "<tbody>";  
                                        echo    "<tr >";                  
                                        echo        "<td style='padding:1px;height:20px;padding-left:10px;'>Abonos Clientes</td>";
                                        echo        "<td style='padding:1px;height:20px;text-align:right;padding-right:30px;'>$ ".number_format($totalAbonosClientes, 0, ',', '.')."</td>";
                                        echo    "</tr>"; 
                                        echo    "<tr>";
                                        echo        "<td style='padding:1px;height:20px;padding-left:10px;'>Cuentas por Cobrar</td>";
                                        if($totalCuentasPorCobrar>0){
                                            echo        "<td style='padding:1px;height:20px;text-align:right;padding-right:30px;font-size:14px;background-color:#D46A6A;'><strong>$ ".number_format($totalCuentasPorCobrar, 0, ',', '.')."</strong></td>"; 
                                        }else{
                                            echo        "<td style='padding:1px;height:20px;text-align:right;padding-right:30px;font-size:14px;'><strong>$ ".number_format($totalCuentasPorCobrar, 0, ',', '.')."</strong></td>";   
                                        }                               
                                        echo    "</tr>";    
                                        echo "</tbody>";
                                        echo "<tfoot>";
                                        
                                        echo "</tfoot>";
                                    echo    "</table>";

                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='panel-footer'>";
                            
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

                echo "<div class='col-lg-6'>";
                echo "<div class='panel panel-danger'>";
                        echo "<div class='panel-heading' style='padding:1px;text-align:center;'>";
                        echo "<h4 style='padding:1px;font-size:12px;'><strong>DESCRIPCION DE EGRESOS</strong></h4>";    
                        echo "</div>";
                        echo "<div class='panel-body'>";
                        echo "<div class='panel panel-warning'>";
                        echo "<div class='panel-heading' style='padding:1px;text-align:center;'>";
                        echo "<h4 style='padding:1px;font-size:12px;'>Egresos Netos por Compras</h4>";    
                        echo "</div>";
                        echo "<div class='panel-body'>";
                        echo "<div class='row'>";
                        echo    "<div class='col-lg-12'>";
                                    echo "<table class='table table-striped' width='99%' style='border:1px solid; padding:0px;'>";
                                        echo "<thead>";
                                            echo "<tr >";
                                                    echo "<th class='columna1'></th>";
                                                    echo "<th class='columna3' style='padding:1px;height:20px;text-align:right;padding-right:30px;'>TOTAL</th>";
                                            echo "</tr>";
                                        echo "</thead>";     
                                        echo "<tbody>";  
                                        echo    "<tr >";                  
                                        echo        "<td style='padding-left:20px;height:20px;'>De Contado</td>";
                                        echo        "<td style='height:20px;text-align:right;padding-right:30px;'>$ ".number_format($totalComprasContado, 0, ',', '.')."</td>";
                                        echo    "</tr>"; 
                                        echo    "<tr>"; 
                                        echo        "<td style='padding-left:20px;height:20px;'>A Crédito</td>";
                                        echo        "<td style='height:20px;text-align:right;padding-right:30px;'>$ ".number_format($totalComprasCredito, 0, ',', '.')."</td>";                                  
                                        echo    "</tr>";    
                                        echo "</tbody>";
                                        echo "<tfoot>";
                                        
                                        echo "</tfoot>";
                                    echo    "</table>";
                        echo    "</div>";
                        echo "</div>";
                        echo "<div class='row'>";
                        echo    "<div class='col-lg-12'>";
                                echo "<div class='panel panel-warning'>";
                                    echo "<div class='panel-heading' style='padding:1px;text-align:center;'>";
                                    echo "<h4 style='padding:1px;font-size:12px;'>Descripción del Crédito</h4>";    
                                    echo "</div>";
                                    echo "<div class='panel-body'>";
                                    echo "<table class='table table-striped' width='99%' style='border:1px solid; padding:0px;'>";
                                        echo "<thead>";
                                            echo "<tr >";
                                                    echo "<th class='columna1'></th>";
                                                    echo "<th class='columna3' style='padding:1px;height:20px;text-align:right;padding-right:30px;'>TOTAL</th>";
                                            echo "</tr>";
                                        echo "</thead>";     
                                        echo "<tbody>";  
                                        echo    "<tr >";                  
                                        echo        "<td style='padding:1px;height:20px;padding-left:10px;'>Abonos Proveedores</td>";
                                        echo        "<td style='padding:1px;height:20px;text-align:right;padding-right:30px;'>$ ".number_format($totalAbonosProveedores, 0, ',', '.')."</td>";
                                        echo    "</tr>"; 
                                        echo    "<tr>";
                                        echo        "<td style='padding:1px;height:20px;padding-left:10px;'>Descuentos en Compras</td>"; 
                                        echo        "<td style='padding:1px;height:20px;text-align:right;padding-right:30px;'>$ ".number_format($totalDescuentosCompras, 0, ',', '.')."</td>";                                  
                                        echo    "</tr>"; 
                                        echo    "<tr>";
                                        echo        "<td style='padding:1px;height:20px;padding-left:10px;'>Cuentas por Pagar</td>"; 
                                        if($totalCuentasPorPagar>0){
                                            echo        "<td style='padding:1px;height:20px;text-align:right;padding-right:30px;font-size:14px;background-color:#D46A6A;'><strong>$ ".number_format($totalCuentasPorPagar, 0, ',', '.')."</strong></td>"; 
                                        }else{
                                            echo        "<td style='padding:1px;height:20px;text-align:right;padding-right:30px;font-size:14px;'><strong>$ ".number_format($totalCuentasPorPagar, 0, ',', '.')."</strong></td>";   
                                        }                                      
                                        echo    "</tr>";  
                                          
                                        echo "</tbody>";
                                        echo "<tfoot>";
                                        
                                        echo "</tfoot>";
                                    echo    "</table>";

                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='panel panel-warning'>";
                        echo "<div class='panel-heading' style='padding:1px;text-align:center;'>";
                        echo "<h4 style='padding:1px;font-size:12px;'>Egresos por Gastos</h4>";    

                        $sqlGastos=mysql_query("SELECT g.tipo,SUM(e.VALOR)AS Total FROM gastos g INNER JOIN egresos e ON g.`idGasto`=e.`idGasto` WHERE  YEAR(e.`FECHA`)='$anho' GROUP BY MONTH(e.`FECHA`);");
                        echo "</div>";
                        echo "<div class='panel-body'>";
                        echo "<div class='row'>";
                        echo    "<div class='col-lg-12'>";
                                    echo "<table class='table table-striped' width='99%' style='border:1px solid; padding:0px;'>";
                                        echo "<thead>";
                                            echo "<tr >";
                                                    echo "<th class='columna1'></th>";
                                                    echo "<th class='columna3' style='padding:1px;height:20px;text-align:right;padding-right:30px;'>TOTAL</th>";
                                            echo "</tr>";
                                        echo "</thead>";     
                                        echo "<tbody>";  
                                        while($gs=mysql_fetch_array($sqlGastos)){
                                            echo    "<tr >";                  
                                            echo        "<td style='padding-left:20px;height:20px;'>$gs[0]</td>";
                                            echo        "<td style='height:20px;text-align:right;padding-right:30px;'>$ ".number_format($gs[1], 0, ',', '.')."</td>";
                                            echo    "</tr>";  
                                        } 
                                        $sqlTotalGastos=mysql_query("SELECT SUM(e.VALOR)AS Total FROM egresos e WHERE  YEAR(e.`FECHA`)='$anho' GROUP BY MONTH(e.`FECHA`);");
                                        while ($gst=mysql_fetch_array($sqlTotalGastos)) {
                                        echo    "<tr >";                  
                                        echo        "<td style='padding-left:20px;height:20px;'>TOTAL GASTOS</td>";
                                        echo        "<td style='height:20px;text-align:right;padding-right:30px;font-size:14px;'><strong>$ ".number_format($gst[0], 0, ',', '.')."</strong></td>";
                                        echo    "</tr>";       
                                        
                                        } 
                                        

                                        echo "</tbody>";
                                        echo "<tfoot>";
                                        
                                        echo "</tfoot>";
                                    echo    "</table>";
                        echo    "</div>";
                        echo "</div>";                        
                        echo "</div>";
                        echo "<div class='row'>";
                        echo    "<div class='col-lg-12'>";
                                echo "<div class='panel panel-warning'>";
                                    echo "<div class='panel-heading' style='padding:1px;text-align:center;'>";
                                    echo "<h4 style='padding:1px;font-size:12px;'>PAGOS DE HONORARIOS A EMPLEADOS</h4>";    
                                    echo "</div>";
                                    echo "<div class='panel-body'>";
                                    echo "<table class='table table-striped' width='99%' style='border:1px solid; padding:0px;'>";
                                        echo "<thead>";
                                            echo "<tr >";
                                                    echo "<th class='columna1'></th>";
                                                    echo "<th class='columna3' style='padding:1px;height:20px;text-align:right;padding-right:30px;'>TOTAL</th>";
                                            echo "</tr>";
                                        echo "</thead>";     
                                        echo "<tbody>";  
                                        $sqlPagosEmpleados=mysql_query("SELECT SUM(pg.VALOR_PAGO)AS Total FROM pagos pg WHERE  YEAR(pg.`FECHA_PAGO`)='$anho' GROUP BY MONTH(pg.`FECHA_PAGO`);");
                                        while($pgE=mysql_fetch_array($sqlPagosEmpleados)){
                                            $totalPagosEmpleados= $pgE[0];
                                        }

                                        $sqlListaPagoEmpleados=mysql_query("SELECT em.`NOMBRE1`,em.`NOMBRE2`,em.`APELLIDO1`,em.`APELLIDO2`,SUM(pg.VALOR_PAGO)AS Total FROM pagos pg INNER JOIN empleados em ON em.`ID_EMPLEADO`=pg.`ID_EMPLEADO` WHERE  YEAR(pg.`FECHA_PAGO`)='$anho' GROUP BY em.`ID_EMPLEADO`");
                                        while($lpg=mysql_fetch_array($sqlListaPagoEmpleados)){
                                            echo    "<tr >";                  
                                            echo        "<td style='padding:1px;height:20px;padding-left:10px;'>$lpg[0] $lpg[1] $lpg[2] $lpg[3]</td>";
                                            echo        "<td style='padding:1px;height:20px;text-align:right;padding-right:30px;'>$ ".number_format($lpg[4], 0, ',', '.')."</td>";
                                            echo    "</tr>";
                                        }
                                        echo    "<tr>";
                                        echo        "<td style='padding:1px;height:20px;padding-left:10px;'>Total Pagos</td>"; 
                                        echo        "<td style='padding:1px;height:20px;text-align:right;padding-right:30px;font-size:14px;'><strong>$ ".number_format($totalPagosEmpleados, 0, ',', '.')."</strong></td>";                                  
                                        echo    "</tr>";  
                                          
                                        echo "</tbody>";
                                        echo "<tfoot>";
                                        
                                        echo "</tfoot>";
                                    echo    "</table>";

                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                echo "</div>";
       
?>