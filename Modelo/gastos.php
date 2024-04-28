<?php
    //require ("../Conexiones/Conect.php");

    class Gasto extends Conectar{
        private $sqlNegocio;
        private $sqlLogo;
        public function cargar(){
            //---------- CONSULTA LISTADO DE GASTOS ------------------------>
			
            $sqlGasto=mysql_query("SELECT * FROM gastos WHERE Activo='Si' ORDER BY idGasto ASC");
            
            echo    "<table class='table table-striped'>";
            echo        "<thead>";
            echo            "<tr>";
            echo                "<th>Id</th>";
            echo                "<th>Tipo</th>";
            echo                "<th>Nombre</th>";
            echo                "<th colspan='2'></th>";
            echo            "</tr>";
            echo        "</thead>";
            echo        "<tbody>";
            while ($g=mysql_fetch_array($sqlGasto)){
                echo "<tr>";
                echo    "<td><input type='text' class='form form-control' readOnly='true' value='$g[0]'/></td>";
                echo    "<td><input type='text' name='tipo' value='$g[1]' id='$g[0]' onchange='editarGasto(this.name,this.id,this.value)' class='form form-control'></td>";
                echo    "<td><input type='text' name='nombre'  value='$g[2]' id='$g[0]' onchange='editarGasto(this.name,this.id,this.value)' class='form form-control'></td>";
                echo    "<td><a href='#' id='$g[0]' onclick='ventanaPagos(this.id)' class='btn btn-success' title='Ingresar pagos'><i class='fa fa-dollar'> </i></td>";
                echo    "<td><a href='#' id='$g[0]' onclick='mensaje()' class='btn btn-info' title='Ver los pagos realizados(Esta pendiente hacer el modulo con el reporte)'><i class='fa fa-eye'> </i></td>";

                echo    "<td><a href='#' id='$g[0]' onclick='eliminarGasto(this.id)' class='btn btn-danger' title='Eliminar Gasto'><i class='fa fa-trash'> </i></td>";
                echo "</tr>";
            }
                                   
            echo        "</tbody>";
            echo    "</table>"; 
            
            //echo "Voy por la parte del modelo, para empezar a crear las acciones de agregar, eliminar y actualizar, agregar el tipo en la ventana emergente.";
        }
        
        function agregarTipo($tipo,$nombre,$idNegocio){
            $sql1 = "INSERT INTO gastos (`tipo`,`nombre`,`idNegocio`) VALUES ('$tipo','$nombre','$idNegocio')";
            $result = mysql_query($sql1);
            echo "<script> alertify.success('Gasto agregado con éxito'); </script>";
        }

        function actualizarTipo($campo,$valor,$idGasto){
            $modifica="UPDATE gastos SET `$campo`='$valor' where `idGasto`='$idGasto';";
            $result=mysql_query($modifica);
            echo "<script> alertify.success('Gasto actualizado con éxito'); </script>";
        }

        function eliminarTipo($idGasto){
            $modifica="UPDATE gastos SET `Activo`='No' where `idGasto`='$idGasto';";
            $result=mysql_query($modifica);
            echo "<script> alertify.success('Gasto eliminado con éxito'); </script>";
        }

        function ingresarPago($idNegocio,$idGasto,$recibo,$pago,$fecha){
            $sql1 = "INSERT INTO `egresos` (`VALOR`,`FECHA`,`idGasto`,`RECIBO`) VALUES ('$pago','$fecha','$idGasto','$recibo')";
            $result = mysql_query($sql1);
            echo "<script> alertify.success('Elpago fue registrado con éxito'); </script>";
        }       
    }
?>
