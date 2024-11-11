<?php
    require('Conexiones/Conect.php');
    if(isset($_POST['documento'])){
        $documento=$_POST['documento'];
    }
    $modulo=$_POST['modulo'];
    $accion=$_POST['accion'];



if($accion=="Cargar"){
    if($modulo=="VENTA"){
        $ObjCliente=new Cliente();
        $consulta=$ObjCliente->Cargar($documento);
        $persona='Cliente';
    }elseif($modulo=="COMPRA"){
        $ObjProveedor=new Proveedor();
        $consulta=$ObjProveedor->Cargar($documento);
        $persona='Proveedor';
    }    

//$datosCliente=array();
    while($clt=mysql_fetch_array($consulta)){

        echo "<table>";

        echo    "<tr>";
        echo        "<td>";
        echo            "<label>No. Documento</label>";
        echo            "<input type='text' class='form-control clase3' id='id".$persona."' value='$clt[0]' name='$clt[0]' onchange='actualizarDato(this.id,this.name,this.value)'>";
        echo        "</td>";
        echo        "<td colspan='2'>";
        echo            "<label>Nombre</label>";
        echo            "<input type='text' class='form-control clase3' id='Nombre' value='$clt[1]' name='$clt[0]' onchange='actualizarDato(this.id,this.name,this.value)'>";
        echo        "</td>";
        echo        "<td>";
        echo            "<label>Teléfono</label>";
        echo            "<input type='text' class='col-md-1 form-control clase3' id='TEL' value='$clt[3]' name='$clt[0]' onchange='actualizarDato(this.id,this.name,this.value)'>";
        echo        "</td>";
        echo        "<td>";
        echo            "<label>Correo</label>";
        echo            "<input type='text' class='col-md-2 form-control clase3' id='correo' value='$clt[5]' name='$clt[0]' onchange='actualizarDato(this.id,this.name,this.value)'>";
        echo        "</td>";          
        echo    "</tr>";

        echo    "<tr>";
        echo       "<td colspan='2'>";
        echo           "<label>Dirección</label>";
        echo            "<input type='text' class='col-md-2 form-control clase3' id='Dir' value='$clt[2]' name='$clt[0]' onchange='actualizarDato(this.id,this.name,this.value)'>";
        echo       "</td>";
        echo       "<td>";
        echo            "<label>Ciudad</label>";
        echo            "<input type='text' class='col-md-2 form-control clase3' id='Ciudad' value='$clt[4]' name='$clt[0]' onchange='actualizarDato(this.id,this.name,this.value)'>";
        echo       "</td>";
        echo       "<td></td>";
        echo    "</tr>";
        
        /*
        echo    "<tr>";
        echo       "<td colspan='5' style='text-align:center;'>";
        echo           "<button type='button' class='btn btn-success btn-agregar-product actualizarDatos' style='margin:0 auto;width:50%;'>";
        echo               "<i class='fa fa-refresh'></i> Actualizar";
        echo           "</button>";
        echo       "</td>";
        echo    "</tr>";
        */

        echo    "<tr>";
        echo       "<td colspan='5' style='text-align:center;'>";
        echo           "<div style='margin:0 auto;width:50%;' id='resultadoActualizacion'>";
        
        echo           "</div>";
        echo       "</td>";
        echo    "</tr>";

        echo "</table>";        
    }
    
    
}elseif($accion=='Actualizar'){
    /*** ----- Datos del Cliente -----/*/
    $campo=$_POST['campo'];
    $clave=$_POST['clave'];
    $valor=$_POST['valor'];
        
    if($modulo=="VENTA"){
        $ObjCli=new Cliente();
        $actCliente=$ObjCli->actualizarDatos($campo,$clave,$valor);
    }elseif($modulo=="COMPRA"){
        $ObjProveedor=new Proveedor();
        $actProveedor=$ObjProveedor->actualizarDatos($campo,$clave,$valor);
    }      
}

?>


<script>
 
</script>