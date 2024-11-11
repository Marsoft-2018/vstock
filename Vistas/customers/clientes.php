<?php
    require('../Modelo/cliente.php');
?>
    <h2 style="text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);">MODULO DE CLIENTES</h2>
    
        <div class="panel panel-warning clase3">
            <div class="panel-heading"><h4>DATOS NUEVO CLIENTE</h4></div>
            <div class="panel-body" id="datosClientes">
                <?php 
                    $objEmpleado = new manejoCliente();
                    $objEmpleado->cargarNuevo();
                ?>   
            </div>
        </div>      
        <div class="panel panel-default clase3" style="padding:10px;">
            <div class="panel-heading clase3"><h4>REPORTE LISTADO DE CLIENTES</h4></div>
            <div class="panel-body clase3" id='vacciones'>
            <div class="row">
                <div class="col-md-12" >
                    <div style="overflow: scroll;" id="detallesClientes">
                        <?php
                            $objE = new manejoCliente();
                            $objE->cargarLista();     
                        ?>
                    </div>                    
                </div>                
            </div>
            </div>
        </div>

    <script>


    </script>