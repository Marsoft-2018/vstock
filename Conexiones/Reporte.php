<?php
    class Reporte extends Conectar{
        function diario($modulo,$dia,$mes,$anho){
            if($modulo=='VENTA'){
                $campos=mysql_query("SELECT fvd.id_prod,inv.ARTICULO,inv.REFERENCIA,SUM(fvd.CANT) AS 'Cantidad',fvd.`ValorUnit`,sum(fvd.`SubTotal`) as 'Total',fv.Fec_Venta
                 from facturasventasdes fvd 
                 inner join inventario inv on inv.`ID_Prod`=fvd.`id_prod`
                 inner join facturasv fv on fv.`FACTURA` = fvd.`FACTURA`
                 WHERE DAY(fv.`Fec_Venta`)='$dia' AND MONTH(fv.`Fec_Venta`)='$mes' AND YEAR(fv.`Fec_Venta`)='$anho'
                GROUP BY fv.`Fec_Venta`,fvd.`id_prod` ORDER BY fv.`Fec_Venta` DESC;");
            }elseif($modulo=='COMPRA'){
                $campos=mysql_query("SELECT fcd.id_prod,inv.ARTICULO,inv.REFERENCIA,SUM(fcd.CANT) AS 'Cantidad',fcd.`ValorUnit`,sum(fcd.`SubTotal`) as 'Total',fc.FECHA
                 from facturascomprasdes fcd 
                 inner join inventario inv on inv.`ID_Prod`=fcd.`id_prod`
                 inner join facturasc fc on fc.`FACTURA` = fcd.`FACTURA`
                 WHERE DAY(fc.`FECHA`)='$dia' AND MONTH(fc.`FECHA`)='$mes' AND YEAR(fc.`FECHA`)='$anho'
                GROUP BY fc.`FECHA`,fcd.`id_prod` ORDER BY fc.`FECHA` DESC;");
            }

            echo "<h2>Reporte Detallado</h2>";   
            echo "<table id='' class='display table table-striped table-hover dataTable no-footer' width='100%'>";
            //echo "<table class='table table-striped' id='tablaReportes1' style='border:1px solid; padding:0px;'>";
            echo    "<thead>";
            echo        "<tr>";
            echo    "    <th>ID</th>";
            echo    "    <th>ARTICULO</th>";
            echo    "    <th>REFERENCIA</th>";
            echo    "    <th align='center'>CANTIDAD </th>";
            echo    "    <th align='right'>VAL. UNITARIO</th>";
            echo    "    <th align='right'>SUB TOTAL</th>";
            echo    "    <th>FECHA</th>";
            echo    "</tr>";
        echo    "</thead>";
        echo    "<tbody>"; 
            $sumaTotal=0;    
            while($reg=mysql_fetch_array($campos)){ 
                echo "<tr>";
                    echo "<td>$reg[0]</td>";
                    echo "<td>$reg[1]</td>";
                    echo "<td>$reg[2]</td>";
                    echo "<td align='center'> $reg[3]</td>";
                    echo "<td align='right'>$ ".number_format($reg[4], 0, ',', '.')."</td>";
                    echo "<td align='right'>$ ".number_format($reg[5], 0, ',', '.')." </td>";
                    $sumaTotal=$sumaTotal+$reg[5];
                    echo "<td > $reg[6]</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        echo    "<tfoot>";
        echo        "<tr>";
        echo        "<td colspan='5' align='right'><h4>TOTAL ".$modulo."S:</h4></td>";
        echo        "<td><h4 style='text-align:right;'>$ ".number_format($sumaTotal, 0, ',', '.')."</h4></td>";    
        echo        "</tr>";    
        echo    "</tfoot>";
        echo    "</table>";
        echo "</div>";
        }
        
        function mensual($modulo,$mes,$anho){
            if($modulo=='VENTA'){
                $campos=mysql_query("SELECT fvd.id_prod,inv.ARTICULO,inv.REFERENCIA,SUM(fvd.CANT) AS 'Cantidad',fvd.`ValorUnit`,sum(fvd.`SubTotal`) as 'Total',fv.Fec_Venta
                 from facturasventasdes fvd 
                 inner join inventario inv on inv.`ID_Prod`=fvd.`id_prod`
                 inner join facturasv fv on fv.`FACTURA` = fvd.`FACTURA`
                 WHERE MONTH(fv.`Fec_Venta`)='$mes' AND YEAR(fv.`Fec_Venta`)='$anho'
                GROUP BY fv.`Fec_Venta`,fvd.`id_prod` ORDER BY fv.`Fec_Venta` DESC;");
            }elseif($modulo=='COMPRA'){
                $campos=mysql_query("SELECT fcd.id_prod,inv.ARTICULO,inv.REFERENCIA,SUM(fcd.CANT) AS 'Cantidad',fcd.`ValorUnit`,sum(fcd.`SubTotal`) as 'Total',fc.FECHA
                 from facturascomprasdes fcd 
                 inner join inventario inv on inv.`ID_Prod`=fcd.`id_prod`
                 inner join facturasc fc on fc.`FACTURA` = fcd.`FACTURA`
                 WHERE MONTH(fc.`FECHA`)='$mes' AND YEAR(fc.`FECHA`)='$anho'
                GROUP BY fc.`FECHA`,fcd.`id_prod` ORDER BY fc.`FECHA` DESC;");
            }
            echo "<h2>Reporte Detallado</h2>";
            echo "<table id='' class='display table table-striped table-hover dataTable no-footer' width='100%'>";
           //echo "<table class='table table-striped' id='tablaReportes1' style='border:1px solid; padding:0px;'>";
            echo    "<thead>";
            echo        "<tr>";
            echo    "    <th>ID</th>";
            echo    "    <th>ARTICULO</th>";
            echo    "    <th>REFERENCIA</th>";
            echo    "    <th align='center'>CANTIDAD </th>";
            echo    "    <th align='right'>VAL. UNITARIO</th>";
            echo    "    <th align='right'>SUB TOTAL</th>";
            echo    "    <th>FECHA</th>";
            echo    "</tr>";
        echo    "</thead>";
        echo    "<tbody>"; 
            $sumaTotal=0;    
            while($reg=mysql_fetch_array($campos)){ 
                echo "<tr>";
                    echo "<td>$reg[0]</td>";
                    echo "<td>$reg[1]</td>";
                    echo "<td>$reg[2]</td>";
                    echo "<td align='center'> $reg[3]</td>";
                    echo "<td align='right'>$ ".number_format($reg[4], 0, ',', '.')."</td>";
                    echo "<td align='right'>$ ".number_format($reg[5], 0, ',', '.')." </td>";
                    $sumaTotal=$sumaTotal+$reg[5];
                    echo "<td > $reg[6]</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        echo    "<tfoot>";
        echo        "<tr>";
        echo        "<td colspan='5' align='right'><h4>TOTAL ".$modulo."S:</h4></td>";
        echo        "<td><h4 style='text-align:right;'>$ ".number_format($sumaTotal, 0, ',', '.')."</h4></td>";    
        echo        "</tr>";    
        echo    "</tfoot>";
        echo    "</table>";
        }
        
        function anual($modulo,$anho){
            if($modulo=='VENTA'){
                $campos=mysql_query("SELECT fvd.id_prod,inv.ARTICULO,inv.REFERENCIA,SUM(fvd.CANT) AS 'Cantidad',fvd.`ValorUnit`,sum(fvd.`SubTotal`) as 'Total',fv.Fec_Venta
                 from facturasventasdes fvd 
                 inner join inventario inv on inv.`ID_Prod`=fvd.`id_prod`
                 inner join facturasv fv on fv.`FACTURA` = fvd.`FACTURA`
                 WHERE YEAR(fv.`Fec_Venta`)='$anho'
                GROUP BY fv.`Fec_Venta`,fvd.`id_prod` ORDER BY fv.`Fec_Venta` DESC;");
            }elseif($modulo=='COMPRA'){
                $campos=mysql_query("SELECT fcd.id_prod,inv.ARTICULO,inv.REFERENCIA,SUM(fcd.CANT) AS 'Cantidad',fcd.`ValorUnit`,sum(fcd.`SubTotal`) as 'Total',fc.FECHA
                 from facturascomprasdes fcd 
                 inner join inventario inv on inv.`ID_Prod`=fcd.`id_prod`
                 inner join facturasc fc on fc.`FACTURA` = fcd.`FACTURA`
                 WHERE YEAR(fc.`FECHA`)='$anho'
                GROUP BY fc.`FECHA`,fcd.`id_prod` ORDER BY fc.`FECHA` DESC;");
            }
            echo "<h2>Reporte Detallado</h2>";
            echo "<table id='' class='display table table-striped table-hover dataTable no-footer' width='100%'>";
           //echo "<table class='table table-striped' id='tablaReportes1' style='border:1px solid; padding:0px;'>";
            echo    "<thead>";
            echo        "<tr>";
            echo    "    <th>ID</th>";
            echo    "    <th>ARTICULO</th>";
            echo    "    <th>REFERENCIA</th>";
            echo    "    <th align='center'>CANTIDAD </th>";
            echo    "    <th align='right'>VAL. UNITARIO</th>";
            echo    "    <th align='right'>SUB TOTAL</th>";
            echo    "    <th>FECHA</th>";
            echo    "</tr>";
        echo    "</thead>";
        echo    "<tbody>"; 
            $sumaTotal=0;    
            while($reg=mysql_fetch_array($campos)){ 
                echo "<tr>";
                    echo "<td>$reg[0]</td>";
                    echo "<td>$reg[1]</td>";
                    echo "<td>$reg[2]</td>";
                    echo "<td align='center'> $reg[3]</td>";
                    echo "<td align='right'>$ ".number_format($reg[4], 0, ',', '.')."</td>";
                    echo "<td align='right'>$ ".number_format($reg[5], 0, ',', '.')." </td>";
                    $sumaTotal=$sumaTotal+$reg[5];
                    echo "<td > $reg[6]</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        echo    "<tfoot>";
        echo        "<tr>";
        echo        "<td colspan='5' align='right'><h4>TOTAL ".$modulo."S:</h4></td>";
        echo        "<td><h4 style='text-align:right;'>$ ".number_format($sumaTotal, 0, ',', '.')."</h4></td>";    
        echo        "</tr>";    
        echo    "</tfoot>";
        echo    "</table>";
        }   
        
        function resumen($modulo,$mes,$anho){
            $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $semaforo=array("danger","warning","info","success");
            
            $sqlTotal;
            $sqlMes;
            $total;
            
            if($modulo=='VENTA'){
                if($mes!=""){
                    $sqlTotal=mysql_query("SELECT SUM(fv.TOTAL) AS 'TOTAL' FROM facturasv fv 
                    WHERE  MONTH(fv.`Fec_Venta`)='$mes' AND YEAR(fv.`Fec_Venta`)='$anho' GROUP BY MONTH(fv.`Fec_Venta`);");
                    
                    $sqlMes=mysql_query("SELECT DAY(fv.`Fec_Venta`) AS 'DIA',SUM(fv.`TOTAL`) AS 'TOTAL' FROM facturasv fv 
                    WHERE MONTH(fv.`Fec_Venta`)='$mes' AND YEAR(fv.`Fec_Venta`)='$anho'
                    GROUP BY DAY(fv.`Fec_Venta`) ORDER BY DAY(fv.`Fec_Venta`) ASC;");
                    
                    while($t=mysql_fetch_array($sqlTotal)){
                        $total=$t[0];
                    }
                }else{
                    $sqlTotal=mysql_query("SELECT SUM(fv.TOTAL) AS 'TOTAL' FROM facturasv fv 
                    WHERE  YEAR(fv.`Fec_Venta`)='$anho' GROUP BY YEAR(fv.`Fec_Venta`);");

                    while($t=mysql_fetch_array($sqlTotal)){
                        $total=$t[0];
                    }

                    $sqlMes=mysql_query("SELECT MONTH(fv.`Fec_Venta`) AS 'MES',SUM(fv.TOTAL) AS 'TOTAL' FROM facturasv fv 
                    WHERE  YEAR(fv.`Fec_Venta`)='$anho' GROUP BY MONTH(fv.`Fec_Venta`) ORDER BY MONTH(fv.`Fec_Venta`) ASC;");
                }
                
            }
            
            if($modulo=='COMPRA'){
                if($mes!=""){
                    $sqlTotal=mysql_query("SELECT SUM(fc.TOTAL) AS 'TOTAL' FROM facturasc fc WHERE  MONTH(fc.`FECHA`)='$mes' AND YEAR(fc.`FECHA`)='$anho' GROUP BY MONTH(fc.`FECHA`);");
                    
                    $sqlMes=mysql_query("SELECT DAY(fc.`FECHA`) AS 'DIA',SUM(fc.`TOTAL`) AS 'TOTAL' FROM facturasc fc WHERE MONTH(fc.`FECHA`)='$mes' AND YEAR(fc.`FECHA`)='$anho' GROUP BY DAY(fc.`FECHA`) ORDER BY DAY(fc.`FECHA`) ASC;");
                    
                    while($t=mysql_fetch_array($sqlTotal)){
                        $total=$t[0];
                    }
                }else{
                
                    $sqlTotal=mysql_query("SELECT SUM(fc.`TOTAL`) AS 'TOTAL' FROM facturasc fc  WHERE  YEAR(fc.`FECHA`)='$anho' GROUP BY YEAR(fc.`FECHA`);");

                    while($t=mysql_fetch_array($sqlTotal)){
                        $total=$t[0];
                    }
                
                    $sqlMes=mysql_query("SELECT MONTH(fc.`FECHA`) AS 'MES',SUM(fc.`TOTAL`) AS 'TOTAL' FROM facturasc fc WHERE  YEAR(fc.`FECHA`)='$anho' GROUP BY MONTH(fc.`FECHA`) ORDER BY MONTH(fc.`FECHA`) ASC;");
                }
            }
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
            
            echo "<header id='encabezado' style='width:90%;visibility:hidden;'>
                    <div style='width:99%;height:80px;'>
                        <div style='width:40%;'>
                            <img src='img/$logo' style='width:225px;margin:0px;float:left;'>
                        </div>
                        <div style='margin-left:10px;width:55%;font-size:12px;float:left;'>
                            <span><h4 style='margin:0px;padding:0px;'>$nombreNegocio</h4></span>
                            <span>Nit: $nit</span><br>
                            <span>Direccion: $direccion. Teléfono: $tel</span><br>
                            <span>Ciudad: $ciudad</span>
                        </div>
                    </div>
                </header>";
            echo "<h2>Reporte Consolidado de ".$modulo."S </h2>";
            echo "<br>";
            echo "<table class='table table-striped' width='99%' style='border:1px solid; padding:0px;'>";
                echo "<thead>";
                    echo "<tr >";
                        if($mes!=""){
                            echo "<th class='columna3'>Mes</th>";
                            echo "<th class='columna1'>Día</th>";
                        }else{
                            echo "<th class='columna1'>Año</th>";
                            echo "<th class='columna3'>Mes</th>";
                        }
            
            
                        echo "<th class='columna3' style='text-align:right;padding-right:30px;'>Total $modulo</th>";
                        echo "<th>Porcentaje logrado</th>";
                    echo "</tr>";
                echo "</thead>";     
                echo "<tbody>";                    
                
                while ($m=mysql_fetch_array($sqlMes)){
                    echo "<tr style='padding:0px;height:20px;'>";
                    if($mes!=""){
                        echo    "<td style='padding:1px;height:20px;'>$mes</td>";
                        echo    "<td style='padding:1px;height:20px;'>".$m[0]."</td>";
                        echo    "<td style='padding:1px;height:20px;text-align:right;padding-right:30px;'>$ ".number_format($m[1], 0, ',', '.')."</td>";
                    }else{
                        echo    "<td style='padding:1px;height:20px;'>$anho</td>";
                        echo    "<td style='padding:1px;height:20px;'>".$meses[($m[0]-1)]."</td>";
                        echo   "<td style='padding:1px;height:20px;text-align:right;padding-right:30px;'>$ ".number_format($m[1], 0, ',', '.')."</td>";
                    }
                    echo   "<td style='padding:1px;height:20px;width:600px;'>";
                            $porcentaje=($m[1]*100)/$total;
                            $color=0;

                            switch($porcentaje){
                                case ($porcentaje <= 20):
                                    $color=0;
                                    break;
                                case ($porcentaje<=50):
                                    $color=1;
                                    break;
                                case ($porcentaje<=80):
                                    $color=2;
                                    break;
                                case ($porcentaje<=100):
                                    $color=3;
                                    break;                            
                            }                    
                            //barra de progreso
                            echo "<div class='progress' style='margin:2px;'>";
                            echo    "<div class='progress-bar progress-bar-$semaforo[$color]' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: ".$porcentaje."%'><span>".round($porcentaje,1)."% </span>";
                            echo    "</div>";
                            echo "</div>";  
                    echo   "</td>";  
                    echo "</tr>";
                }
                    
                echo    "</tbody>";
                echo    "<tfoot>";
                echo        "<tr>";
                echo            "<td colspan='2' style='padding:1px;height:20px;'>";
                echo                "<h5>TOTAL $modulo</h5>";
                echo            "</td>";
                echo            "<td>";
                echo                "$ ".number_format($total, 0, ',', '.');
                echo            "</td>"; 
                echo            "<td style='padding:1px;height:20px;'>";
                                    echo "<div class='progress' style='margin:2px;'>";
                                    echo    "<div class='progress-bar progress-bar-$semaforo[3]' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width: 100%'><span>100% </span>";
                                    echo    "</div>";
                                    echo "</div>";
                echo            "</td>";
                echo        "</tr>";
                echo    "</tfoot>";
            echo    "</table>";
            
        }
        
        function agotados(){
            $sql1=mysql_query("SELECT inv.id_prod,inv.`ARTICULO`,inv.`REFERENCIA`,cat.`Categorias`,inv.`PRECIO_COMPRA`,inv.`PRECIO_VENTA`,inv.CANT_INICIAL,
            inv.COMPRAS,inv.VENTAS,inv.DEVOLUCIONES,inv.CANTIDAD_MIN,inv.CANT_FINAL
            FROM inventario inv
            INNER JOIN categorias cat
            ON inv.`id_categoria`=cat.`Id_categoria`
            WHERE inv.`CANT_FINAL`<=inv.`CANTIDAD_MIN`
            ORDER BY inv.`ARTICULO` ASC;");
            
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
            echo "<div id='contenidoImprimir'>";
            echo "<header id='encabezado' style='width:90%;visibility:hidden;'>
                    <div style='width:99%;height:80px;'>
                        <div style='width:40%;'>
                            <img src='img/$logo' style='width:225px;margin:0px;float:left;'>
                        </div>
                        <div style='margin-left:10px;width:55%;font-size:12px;float:left;'>
                            <span><h4 style='margin:0px;padding:0px;'>$nombreNegocio</h4></span>
                            <span>Nit: $nit</span><br>
                            <span>Direccion: $direccion. Teléfono: $tel</span><br>
                            <span>Ciudad: $ciudad</span>
                        </div>
                    </div>
                </header>";
            
            echo "<h2>REPORTE DE ARTICULOS AGOTADOS O PROXIMOS A AGOTARSE</h2>";
            echo "<br>";
            echo "<table id='' class='display table table-striped table-hover dataTable no-footer' width='100%'>";
                echo "<thead>";
                    echo "<tr >";
                        echo "<th class='columna1'>ID</th>";
                        echo "<th class='columna3'>Articulo</th>";
                        echo "<th class='columna3'>Referencia</th>";
                        echo "<th class='columna3'>Categoria</th>";
                        echo "<th>Precio de Compra</th>";
                        echo "<th>Precio de Venta</th>";
                        echo "<th width='10'>Cantidad Inicial</th>";
                        echo "<th width='10'>Compras</th>";
                        echo "<th width='10'>Ventas</th>";
                        echo "<th>Devoluciones</th>";	
                        echo "<th>Cantidad Mínima</th>";                        				
                        echo "<th width='10'>Cantidad Final</th>";
                    echo "</tr>";
                echo "</thead>";     
                echo "<tbody>";                    

                while ($row=mysql_fetch_array($sql1)){
                    echo "
                        <tr>
                            <td >$row[0]</td>
                            <td >$row[1]</td>
                            <td >$row[2]</td>
                            <td >$row[3]</td>
                            <td >$row[4]</td>
                            <td >$row[5]</td>
                            <td >$row[6]</td>
                            <td >$row[7]</td>
                            <td >$row[8]</td>
                            <td >$row[9]</td>
                            <td >$row[10]</td>
                            
                        ";               
                            if ($row[11]<=$row[10]) {
                                echo "<td style='background:rgba(255,0,0,0.4);'>$row[11]</td>";
                            }else{
                                echo "<td >$row[11]</td>";
                            }
                        echo "</tr>";
                }
                    
                echo    "</tbody>";
            echo    "</table>";
            echo "</div>";
        }

        function inventario(){
            $sql1=mysql_query("SELECT inv.id_prod,inv.`ARTICULO`,inv.`REFERENCIA`,cat.`Categorias`,inv.`PRECIO_COMPRA`,inv.`PRECIO_VENTA`,inv.CANT_INICIAL,
            inv.COMPRAS,inv.VENTAS,inv.DEVOLUCIONES,inv.CANTIDAD_MIN,inv.CANT_FINAL
            FROM inventario inv
            INNER JOIN categorias cat
            ON inv.`id_categoria`=cat.`Id_categoria`
            WHERE inv.`CANT_FINAL`>0
            ORDER BY inv.`ARTICULO` ASC;");
            
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
            echo "<div id='contenidoImprimir' >";
            echo "<header id='encabezado' style='width:90%;visibility:hidden;'>
                    <div style='width:99%;height:80px;'>
                        <div style='width:40%;'>
                            <img src='img/$logo' style='width:225px;margin:0px;float:left;'>
                        </div>
                        <div style='margin-left:10px;width:55%;font-size:12px;float:left;'>
                            <span><h4 style='margin:0px;padding:0px;'>$nombreNegocio</h4></span>
                            <span>Nit: $nit</span><br>
                            <span>Direccion: $direccion. Teléfono: $tel</span><br>
                            <span>Ciudad: $ciudad</span>
                        </div>
                    </div>
                </header>";
            
            echo "<h2 style='margin-top: 100px;'>REPORTE DE ARTICULOS EN EL INVENTARIO</h2>";
            echo "<br>";
            echo "<table id='' class='display table table-striped table-hover dataTable no-footer' width='100%'>";
                echo "<thead>";
                    echo "<tr >";
                        echo "<th class='columna1'>ID</th>";
                        echo "<th class='columna3'>Articulo</th>";
                        echo "<th class='columna3'>Referencia</th>";
                        echo "<th class='columna3'>Categoria</th>";
                        echo "<th>Precio de Compra</th>";
                        echo "<th>Precio de Venta</th>";
                        echo "<th width='10'>Cantidad Inicial</th>";
                        echo "<th width='10'>Compras</th>";
                        echo "<th width='10'>Ventas</th>";
                        echo "<th>Devoluciones</th>";   
                        echo "<th>Cantidad Mínima</th>";                                        
                        echo "<th width='10'>Cantidad Final</th>";
                    echo "</tr>";
                echo "</thead>";     
                echo "<tbody>";                    

                while ($row=mysql_fetch_array($sql1)){
                    echo "
                        <tr>
                            <td >$row[0]</td>
                            <td >$row[1]</td>
                            <td >$row[2]</td>
                            <td >$row[3]</td>
                            <td >$row[4]</td>
                            <td >$row[5]</td>
                            <td >$row[6]</td>
                            <td >$row[7]</td>
                            <td >$row[8]</td>
                            <td >$row[9]</td>
                            <td >$row[10]</td>
                            
                        ";               
                            if ($row[11]<=$row[10]) {
                                echo "<td style='background:rgba(255,0,0,0.4);'>$row[11]</td>";
                            }else{
                                echo "<td >$row[11]</td>";
                            }
                        echo "</tr>";
                }
                    
                echo    "</tbody>";
            echo    "</table>";
            echo "</div>";
        }

        
    }

?>