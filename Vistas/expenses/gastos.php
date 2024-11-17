<?php include('../estiloscss/estilo1.css'); ?>
<form method='POST' name='Devoluciones_modulo' action='Devoluciones.php'>
    <h2 style="text-align:center;text-shadow:2px 2px 3px rgba(46,46,48,0.5);">MODULO DE GASTOS Y/O SERVICIOS</h2>
    <div id='Contenedor' class='container'>       
        <div class="panel panel-warning clase3">
            <div class="panel-heading clase3"><h4>DATOS RELACIONADOS</h4></div>
            <div class="panel-body clase3" id='vacciones'>
            <div class="row">
                <div class="col-md-9">
                    <?php
				        require("../Conexiones/Conect.php");
                        $con = new Conectar();                                    
							
				    ?>
                   <div class='panel panel-primary'>
                       <div class="panel-heading">
                        <h4>Listado de los tipos de gastos registrados</h4>
                       </div>
                       <div class="panel-body" id='listaGastos'>
                           <?php
                                require('../Modelo/gastos.php');
                                $objGasto = new Gasto();
                                $objGasto->cargar();
                           ?>
                       </div>
                        
                    </div>
                </div>  
                <div class='col-md-3'>
                    <div class='panel panel-primary'>
                       <div class="panel-heading">
                           <h4>Acciones</h4>
                       </div>
                       <div class="panel-body">                            
                            <input type='button' name='BOTON' value="Agregar Nuevo" class="btn btn-primary" title="Activa la ventana para registrar un nuevo tipo de gasto" onclick="ventanaGastosNuevo()">
                       </div>  
                       <div class="panel-footer" id='mensajeAct'></div>                      
                    </div>
                </div>              
            </div>
            </div>
        </div>
    </div>                        
</form>

<script>
  

</script>
