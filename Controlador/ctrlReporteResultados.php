<style type="text/css">
     #encabezado {            
            display: none;
    }
    @media print
    {
        body * { visibility: hidden; }
        #capaPagina{ visibility: hidden;}
        #contenidoImprimir * { visibility: visible; }
        #contenidoImprimir { position: absolute; top: 10px; left: 0px;height: auto; width: 95%;}
        
        .clearfix:after {
          content: "";
          
        }

        #encabezado {            
            display: block;
            visibility: visible;
            height: 80px;
            width: 100%;
          clear: both;
        }       
    }
</style>
   

   <?php
    require('../Modelo/reporteResultado.php');
    $accion=0;

    if(isset($_POST['accion'])){
        $accion=$_POST['accion'];
        if($accion=='dia'){
            $dia=$_POST['dia'];
            $mes=$_POST['mes'];
            $anho=$_POST['anho'];
            $objReporte = new ReporteResultado();
            $objReporte->diario($dia,$mes,$anho);
        }
        if($accion=='mes'){
            $mes=$_POST['mes'];
            $anho=$_POST['anho'];
            $objReporte = new ReporteResultado();
            $objReporte->mensual($mes,$anho);
        }
        if($accion=='anho'){
            $anho=$_POST['anho'];
            $objReporte = new ReporteResultado();
            $objReporte->anual($anho);
        }
        
        if($accion=='resumen'){
            $anho=$_POST['anho'];
            $mes=$_POST['mes'];
            $objReporte = new ReporteResultado();
            $objReporte->resumen($mes,$anho);
        }
    }   

?>