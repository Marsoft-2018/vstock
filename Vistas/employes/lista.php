<div class="dataTable_wrapper" style="overflow: auto;">
                    <!-- Aqui va la tabla -->
                    
    <button class='btn btn-primary mb-3' style='width: 100%;'  data-bs-toggle="modal" data-bs-target=".exampleModalCenter"  onclick='newEmploye()'>
        <i class='fa fa-plus'> </i> Nuevo
    </button>
    <table id="customersTable" class="display table table-striped table-hover dataTable no-footer mt-3" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Cargo</th>
                <th>Salarios<br>Honorarios</th>
                <th>Activo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($objEmploye->list() as $employe) {
            ?>
            <tr style="text-transform: uppercase;">
                <td style='padding:1px;'><?php echo $employe['id'] ?></td>
                <td style='padding:1px;'><?php echo $employe['first_name']." ".$employe['second_name']." ".$employe['first_last_name']." ".$employe['second_last_name'] ?></td>
                <td style='padding:1px;'><?php echo $employe['address'] ?></td>
                <td style='padding:1px;'><?php echo $employe['phone'] ?></td>
                <td style='padding:1px;'><?php echo $employe['job'] ?></td>
                <td  style="text-transform: lowercase;">$ <?php echo $employe['income'] ?></td>
                <td  style="text-transform: lowercase;">
                    <?php 
                        $checked = "checked";
                        if($employe['status'] == "NO"){
                            $checked = "";
                        }                        
                    ?>                                        
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?php echo $checked; ?>>
                    </div>
                </td>
                <td style='padding:1px;'>                    
                    <div class="btn-acciones">
                        <button id='<?php echo $employe['id'] ?>' class='btn btn-outline-success btn-sm' title='Ver pagos al Empleado'   data-bs-toggle="modal" data-bs-target=".exampleModalCenter"  onclick="newEmployePayment(<?php echo $bussines_id ?>, <?php echo $employe['id'] ?>)">
                            <i class="fas fa-money-bill-wave"></i>
                        </button> 
                        <button id='<?php echo $employe['id'] ?>' class='btn btn-outline-info btn-sm' title='Ver pagos al Empleado' onclick='indexEmployePayments(<?php echo $bussines_id; ?>,this.id)'>
                            <i class="fas fa-coins"></i>
                        </button> 
                        <button id='<?php echo $employe['id'] ?>' class='btn btn-outline-warning btn-sm' title='Editar empleado'   data-bs-toggle="modal" data-bs-target=".exampleModalCenter" onclick='editEmploye(this.id)'>
                            <i class='fa fa-pencil-alt'> </i>
                        </button>
                        <button id='<?php echo $employe['id'] ?>' class='btn btn-outline-danger btn-sm' title='Ver pagos al Empleado' onclick='deleteEmploye(this.id,<?php echo $bussines_id; ?>)'>
                            <i class='fa fa-trash'> </i>
                        </button>   
                    </div>           
                </td>	
            </tr>                                
        <?php } ?>                                
        </tbody>
    </table>
</div>