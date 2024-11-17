<?php 
	include("../Modelo/reporteResultado.php");

?>

<style type="text/css">
    @media print
    {
        body * { visibility: hidden; }
        #capaPagina{ visibility: hidden}
        #contenidoImprimir * { visibility: visible; }
        #contenidoImprimir { position: absolute; top: 10px; left: 0px;height: auto; width: 90%;}   
        
        
    }
</style>
   

<script>
    $('#tablaReportes1').dataTable({
            "info": false,
            "scrollY": "150%",
            "scrollCollapse": true,
            "paging": false     
        }); 
</script>

<h2 style="text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);">REPORTES DE RESULTADOS</h2>	
    <div class="panel panel-info" style='padding:5px;'>
        <div class="panel-heading" style='padding:5px;'>Elija los criterios de la consulta a continuación</div>
            <div class="panel-body" style='padding:2px;'>
                <div class="row">
                    <div class="col-md-2">
                       <label>Día</label> <input class="form-control" placeholder="Día" id='dia' type="text" list='listaDias' onFocus='limpiar(this.id)' value='<?php echo date('d'); ?>'> 
                       <?php                            
                            echo "<datalist id='listaDias'>";                                
                                for($i=1;$i<=31;$i++){
                                    echo "<option value='".$i."'>";
                                } 
                            echo "</datalist>";
                        ?>
                    </div>
                    <div class="col-md-2">
                        <label>Mes</label><input class="form-control" placeholder="Mes" id='mes' type="text" list='listaMeses' onFocus='limpiar(this.id)' value='<?php echo date('m'); ?>'>
                        <?php                            
                            echo "<datalist id='listaMeses'>";                                
                                for($i=1;$i<=12;$i++){
                                    echo "<option value='".$i."'>";
                                } 
                            echo "</datalist>";
                        ?>
                    </div>
                    <div class="col-md-2">
                        <label>Año</label><input class="form-control" placeholder="Año" id='anho' type="text" onFocus='limpiar(this.id)' value='<?php echo date('Y'); ?>'>
                    </div>
                    <div class="col-md-2">
                       <br>
                        <button class="btn btn-success fa fa-eyes" onclick="cargarReportesResultados()" value="Ver Reporte"><i class="fa fa-eye"></i>Ver Reporte</button>
                    </div>
                    <div class="col-md-2">
                       <br>
                        <button class="btn btn-primary fa fa-eyes" onclick="javascript:window.print()" value="Ver Resultado"><i class="fa fa-print"></i>Imprimir</button>
                    </div>
                </div>
            </div>
    </div>
    <div class="panel-footer" style="background-color:rgb(29,32,41);">
        <div style='color:#06090E;padding: 10px; text-align:left;font-size: 11px; float:center;background-color:rgba(255,255,255,1);' id='contenidoImprimir'>
            <div  id="resultadoResumen"></div>
            <div class='' id="resultadoReporte"></div>	
        </div>
    </div>