<?php
    include("../Conexiones/Conect.php");
    class ReporteResultado extends Conectar{       
        function diario($dia,$mes,$anho){
            include("reporteResultadoDiario.php");
        }

        function mensual($mes,$anho){
            include("reporteResultadoMensual.php");
        }

        function anual($anho){
            include("reporteResultadoAnual.php");
        }
    }

?>