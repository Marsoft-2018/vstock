<?php
require('../Conexiones/Conect.php');

class Abono extends Conectar{
    function cargar($tabla,$id){
        $sql='';
        $persona;
        $descuento=0;
        if($tabla=='cliente'){
            $sql="SELECT * FROM facturasv WHERE idCliente='$id' AND tipo='credito' AND estado='Por Pagar' ORDER BY FACTURA;";
            $persona="clientes";
        }else{
            $sql="SELECT * FROM facturasc WHERE idProveedor='$id' AND tipo='credito' AND estado='Por Pagar' ORDER BY FACTURA;";
            $persona="Proveedores";
        }
        $buscar=mysql_query($sql);
        $datosPersona=mysql_query("SELECT * FROM $persona WHERE id ='$id';");
        
        echo "<div>";
        echo    "<table class='table'>";
        while($dt=mysql_fetch_array($datosPersona)){
            echo    "<tr>";
            echo        "<td><label>Id. $tabla</label><br>$dt[0]</td>";
            echo        "<td><label>Nombre</label><br>$dt[1]</td>";
            echo        "<td><label>Teléfono</label><br>$dt[3]</td>";
            echo        "<td><label>Dirección</label><br>$dt[2]</td>";
            echo        "<td><label>Correo</label><br>$dt[5]</td>";
            echo    "</tr>";            
        }        
        echo    "</table>";        
        echo "</div>";
        echo "<h3>CRÉDITOS RELACIONADOS</h3>";
        echo "<table class='table table-striped table-hover dataTable no-footer'>";
        echo    "<tr style='background-color:#A09B40;'>";
        echo        "<th>Id. Crédito</th>";
        if($persona=='Proveedores'){
            echo    "<th>No. Factura</th>";
        }
        
        echo        "<th>Forma de Pago</th>";
        echo        "<th>Fecha</th>";
        echo        "<th>Valor del Crédito</th>";
        echo        "<th>Saldo a la fecha</th>";
        echo        "<th></th>";
        echo        "<th></th>";
        echo    "</tr>";
        
        while($cr=mysql_fetch_array($buscar)){
            echo "<tr style='font-weight: bold;'>";
            echo    "<td>$cr[1]</td>";
            if($persona=='Proveedores'){
                echo    "<td>$cr[7]</td>";
            }
            
            echo    "<td>$cr[5]</td>";
            echo    "<td>$cr[2]</td>";
            echo    "<td> $ ".number_format($cr[3], 0, ',', '.')."</td>";
            if($persona=='clientes'){
                $sqlTotalAbonos=mysql_query("SELECT SUM(ValorAbono) AS total FROM abonos WHERE idCredito='$cr[1]';");
            }elseif($persona=='Proveedores'){
                $sqlTotalAbonos=mysql_query("SELECT SUM(Valor_Abono) AS total FROM abonosproveedores WHERE idCompra='$cr[1]';");
                $sqlDescuentos=mysql_query("SELECT SUM(TOTAL) AS total FROM descuentocompras WHERE FACTURA='$cr[1]'");
                while ($d=mysql_fetch_array($sqlDescuentos)) {
                    $descuento =$d[0];
                }

            }
            while($tA=mysql_fetch_array($sqlTotalAbonos)){
                $saldo=0;
                $saldo= $cr[3] - $tA[0] - $descuento;
                echo "<td><div id='saldo$cr[1]'>$ ".number_format($saldo, 0, ',', '.')."</div></td>";
            }          
            echo    "<td>
                        <button class='btn btn-info' id='$cr[0]' name='$cr[1]' value='$tabla' onclick='listaDePagos(this.id,this.name,this.value)'><i class='fa fa-search'></i> Ver Pagos</button>
                    </td>";

            if($persona=='Proveedores'){
                echo "<td>
                        <button class='btn btn-success' id='$cr[0]' name='$cr[1]' value='$tabla' onclick='ventanaDescuento(this.name)' title='Registrar descuestos sobre el crédito'><i class='fa fa-ticket'></i> Descuento</button>
                    </td>";
            }        
            echo "</tr>";
            echo "<tr>";
            echo    "<td colspan='8'>";
            echo        "<div id='pagos$cr[1]' style='width:100%;border:1px solid rgba(47, 104, 148,0.1);padding:5px;background-color:rgba(51, 61, 69,0.1);box-shadow:3px 2px 5px rgba(51, 61, 69,0.5);'>";            
            echo            "<div id='marcoDescuento' style='width:100%;'>";
            //echo                "<input type='text' id='valorDescuento' value=''><input type='text' id='DetalleDescuento' value=''>";
            /*echo                "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
            echo                    "<div ></div>";*/
            echo            "</div>";
            echo        "</div>";            
            echo    "</td>";
            echo "</tr>";
        }        
        echo "</table>";        
    }
    
    function listaDePagos($tabla,$idPersona,$idCredito){
        $sql='';
        
        if($tabla=='cliente'){
            $sql="SELECT * FROM abonos WHERE idCredito='$idCredito'";
        }elseif($tabla=='proveedor'){
            $sql="SELECT * FROM abonosproveedores WHERE idCompra='$idCredito';";
        }

        $buscar=mysql_query($sql);
        
        $numReg=mysql_num_rows($buscar);  
        
        $descuento=0;
        $detalle =0;
            //Voy a ingresar una tabla para mostrar el descuento realizado despues de esto hacer el formulario para registrar el descuento....
            $sqlDescuentos=mysql_query("SELECT SUM(TOTAL) AS total, Detalle, idDescuento FROM descuentocompras WHERE FACTURA='$idCredito'");
            while ($d=mysql_fetch_array($sqlDescuentos)) {
                $descuento =$d[0];
                $detalle = $d[1];
            }

            if($descuento>0){
                echo "<div id='marcoDescuento' style='width:100%;'>";
                echo "<table class='table' style='border-collapse:collapse;border: 1px solid rgba(240,240,240,0.4);'>";
                echo    "<tr style='background-color:rgba(229, 185, 62,0.5)'>";
                echo        "<th>";
                echo        "</th>";
                echo        "<th>";
                echo            "Valor";
                echo        "</th>";
                echo        "<th>";
                echo            "Descripcion";
                echo        "</th>";
                echo        "<th>";
                echo        "</th>";
                echo    "</tr>";
                echo    "<tr>";
                echo        "<td>";
                echo            "Descuento Realizado";
                echo        "</td>";
                echo        "<td>";
                echo            "$ ".number_format($descuento, 0, ',', '.');
                echo        "</td>";
                echo        "<td>";
                echo            $detalle;
                echo        "</td>";
                echo        "<td>";
                echo            "<button class='btn btn-danger' id='$idCredito' onclick='eliminarDescuento(this.id)' title='Eliminar registro del descuento'><i class='fa fa-trash'> </i></button>";
                echo        "</td>";
                echo    "</tr>";
                echo "</table>";
                echo "</div>";
            }
        
        if($numReg>0){    
            //echo "datos recibidos: Tabla: $tabla, Persona: $idPersona, Factura: $idCredito, el id del contenedor es pagos$idCredito <br>";

            echo "<h3>Lista de Pagos</h3>";
            echo "<table class='table table-striped table-hover dataTable no-footer'>";
            echo    "<tr>";
            echo        "<th>Id. Crédito</th>";
            echo        "<th>No. de Cuotas Abonadas</th>";
            echo        "<th style='text-align:right'>Valor Abonado</th>";
            echo        "<th>Fecha</th>";
            echo        "<th></th>";
            echo    "</tr>";
            while($cr=mysql_fetch_array($buscar)){
                echo "<tr>";
                echo    "<td>$cr[0]</td>";
                echo    "<td>$cr[1]</td>";
                echo    "<td style='text-align:right'>$ ".number_format($cr[2], 0, ',', '.')."</td>";
                echo    "<td>$cr[3]</td>";
                echo    "<td>";
                echo        "<button class='btn btn-danger' id='$cr[4]' value='$cr[0]' name='$idPersona' onclick='eliminarAbono(this.id,this.value,this.title,this.name)' title='$tabla'>";
                echo            "<i class='fa fa-trash-o'> </i> ";
                echo        "</button>";
                echo    "</td>";  
                echo "</tr>";
            }
            echo "</table>"; 
        }else{
            /*echo "<div class='alert alert-warning alert-dimissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>No existe información de pagos registrados sobre este crédito</div>";*/

            echo "<script> alertify.log('No existe información de pagos registrados sobre este crédito');</script>";
        }
        
        echo "<table class='table'>"; 
        echo "<tr>";
            echo    "<td>";
            echo        "<label>Cant. de Cuotas</label>";
            echo        "<input type='number' class='form form-control' id='cantCuotas".$idCredito."' value='1' name='$idPersona' placeholder='Numero de cuotas'>
                    </td>";
            echo    "<td>
                        <label>Valor del Abono</label>
                        <input type='number' class='form form-control' id='valorCuota".$idCredito."' name='$idPersona' value='0' placeholder='Ingrese el valor del abono' title='Por favor ingrese el valor del abono sin puntos ni comas'   >
                    </td>";    
            echo    "<td><label>Fecha de Pago</label><input type='date' class='form form-control' id='fechaAbono".$idCredito."' value='".date("Y-m-d")."' placeholder=''></td>";
            echo    "<td><br><button class='btn btn-success' id='$idCredito' value='$tabla' name='$idPersona' onclick='agregarCuota(this.id,this.value,this.name)'><i class='fa fa-plus'></i> Ingresar Cuota</button></td>";
            echo "</tr>";
        echo "</table>";        
    }
    
    function agregarPago($tabla,$idCredito,$cuotas,$valor,$fecha){
        if($tabla=='cliente'){
            mysql_query("INSERT INTO `cuentas`.`abonos` (`idCredito`, `cuotasAbonadas`, `valorAbono`,`fechaAbono`) VALUES ('$idCredito', '$cuotas', '$valor','$fecha'); ");            
        }else{            
            mysql_query("INSERT INTO `cuentas`.`abonosproveedores` (`idCompra`, `cuotasAbonadas`, `valor_Abono`,`fecha_Abono`) VALUES ('$idCredito', '$cuotas', '$valor','$fecha'); ");
        }
        
        $this->SaldarDeuda($idCredito,$tabla);
        
    }
    
    function eliminarAbono($idAbono,$idCredito,$tabla){
        if($tabla=='cliente'){
            mysql_query("DELETE FROM abonos WHERE idAbono='$idAbono' AND idCredito='$idCredito';");
        }else{
            mysql_query("DELETE FROM abonosproveedores WHERE recibo='$idAbono' AND idCompra='$idCredito';");
        }        
    }
    
    function SaldarDeuda($idCredito,$tabla){
        //consultar la suma total de los abonos
        $saldo;
        $idPersona;
        if($tabla=='cliente'){
            //Consulta el total del credito
            $sqlTotal=mysql_query("SELECT TOTAL,idCliente FROM facturasv WHERE FACTURA='$idCredito';");
            while($tc=mysql_fetch_array($sqlTotal)){
                $sqlTotalAbonos=mysql_query("SELECT SUM(ValorAbono) AS total FROM abonos WHERE idCredito='$idCredito';");
                while($tA=mysql_fetch_array($sqlTotalAbonos)){                    
                    $saldo= $tc[0] - $tA[0];
                }
                $idPersona=$tc[1];
            } 
            //compara el saldo resultante
            if($saldo<=0){
                //actualizo el estado del crédito;
                mysql_query("UPDATE facturasv SET estado='Cancelada' WHERE FACTURA='$idCredito';");
                echo "<script>";
                echo    "cuentaSaldada('$tabla','$idPersona');";
                echo "</script>";
            }else{
                mysql_query("UPDATE facturasv SET estado='Por Pagar' WHERE FACTURA='$idCredito';");
            }
        }else{
            //para los proveedores
            //Consulta el total del credito
            $sqlTotal=mysql_query("SELECT TOTAL,idProveedor FROM facturasc WHERE FACTURA='$idCredito';");
            while($tc=mysql_fetch_array($sqlTotal)){
                $sqlTotalAbonos=mysql_query("SELECT SUM(Valor_Abono) AS total FROM abonosproveedores WHERE idCompra='$idCredito';");
                while($tA=mysql_fetch_array($sqlTotalAbonos)){                    
                    $saldo= $tc[0] - $tA[0];
                }
                $idPersona=$tc[1];
            } 
            //compara el saldo resultante
            if($saldo<=0){
                //actualizo el estado del crédito;
                mysql_query("UPDATE facturasc SET estado='Cancelada' WHERE FACTURA='$idCredito';");
                echo "<script>";
                echo    "cuentaSaldada('$tabla','$idPersona');";
                echo "</script>";
            }else{
                mysql_query("UPDATE facturasc SET estado='Por Pagar' WHERE FACTURA='$idCredito';");
            }
        } 
    }
    
    function agregarDescuento($idcredito,$valor,$detalle){
        mysql_query("INSERT INTO `descuentocompras` (`FACTURA`,`TOTAL`,`Detalle`) VALUES('$idcredito','$valor','$detalle');");
        echo "<script> alertify.success('Se ingresó el descuento al crédito con éxito');</script>";
    }

    function cargarDescuento($idCredito){
        $sqlDescuentos=mysql_query("SELECT SUM(TOTAL) AS total, Detalle, idDescuento FROM descuentocompras WHERE FACTURA='$idCredito'");
            while ($d=mysql_fetch_array($sqlDescuentos)) {
                $descuento =$d[0];
                $detalle = $d[1];
            }

            if($descuento>0){
                echo "<div id='marcoDescuento' style='width:100%;'>";
                echo "<table class='table' style='border-collapse:collapse;border: 1px solid rgba(240,240,240,0.4);'>";
                echo    "<tr style='background-color:rgba(229, 185, 62,0.5)'>";
                echo        "<th>";
                echo        "</th>";
                echo        "<th>";
                echo            "Valor";
                echo        "</th>";
                echo        "<th>";
                echo            "Descripcion";
                echo        "</th>";
                echo        "<th>";
                echo        "</th>";
                echo    "</tr>";
                echo    "<tr>";
                echo        "<td>";
                echo            "Descuento Realizado";
                echo        "</td>";
                echo        "<td>";
                echo            "$ ".number_format($descuento, 0, ',', '.');
                echo        "</td>";
                echo        "<td>";
                echo            $detalle;
                echo        "</td>";
                echo        "<td>";
                echo            "<button class='btn btn-danger' id='$idCredito' onclick='eliminarDescuento(this.id)' title='Eliminar registro del descuento'><i class='fa fa-trash'> </i></button>";
                echo        "</td>";
                echo    "</tr>";
                echo "</table>";
                echo "</div>";
            }            
    }

    function cargarNuevoSaldo($idCredito){

        $sqlTotal=mysql_query("SELECT TOTAL FROM facturasc WHERE FACTURA='$idCredito' AND tipo='credito' AND estado='Por Pagar' ORDER BY FACTURA;");
        while ($cr=mysql_fetch_array($sqlTotal)) {
            $totalCredito=$cr[0];
        }
            $sqlTotalAbonos=mysql_query("SELECT SUM(Valor_Abono) AS total FROM abonosproveedores WHERE idCompra='$idCredito';");
            $sqlDescuentos=mysql_query("SELECT SUM(TOTAL) AS total FROM descuentocompras WHERE FACTURA='$idCredito'");
            while ($d=mysql_fetch_array($sqlDescuentos)) {
                $descuento =$d[0];
            }

            
            while($tA=mysql_fetch_array($sqlTotalAbonos)){
                $saldo=0;
                $saldo=  $totalCredito - $tA[0] - $descuento;
                echo "$ ".number_format($saldo, 0, ',', '.');
                echo "<script>alertify.success('Saldo actualizado con éxito');</script>";
            }
    }

    function eliminarDescuento($idCredito){
        mysql_query("DELETE FROM `descuentocompras` WHERE `FACTURA`='$idCredito';");
        echo "<script> alertify.success('Se Eliminó el descuento al crédito con éxito');</script>";
    }    

    function __destruct() {
       //$this->name;
    }
}


?>


