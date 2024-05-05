<?php
    require('../Modelo/empleado.php');
?>
    <h2 style="text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);">MODULO DE EMPLEADOS</h2>
    
        <div class="panel panel-success clase3">
            <div class="panel-heading"><h4>DATOS NUEVO EMPLEADO</h4></div>
            <div class="panel-body" id="datosEmpleados">
                <?php 
                    $objEmpleado = new empleado();
                    $objEmpleado->cargarNuevo();
                ?>   
            </div>
        </div>      
        <div class="panel panel-info clase3" style="padding:10px;">
            <div class="panel-heading clase3"><h4>REPORTE DE EMPLEADOS</h4></div>
            <div class="panel-body clase3" id='vacciones'>
            <div class="row">
                <div class="col-md-12" >
                    <div style="overflow: scroll;" id="detallesEmpleados">
                        <?php
                            $objE = new empleado();
                            $objE->cargarLista();     
                        ?>
                    </div>                    
                </div>                
            </div>
            </div>
        </div>

    <script>


    </script>