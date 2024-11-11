<div class="dataTable_wrapper" style="overflow: auto;">
                    <!-- Aqui va la tabla -->
                    
    
    <table id="customersTable" class="display table table-striped table-hover dataTable no-footer mt-3" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>id</th>
                <th>No. Recibo</th>
                <th>Valor</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($objEmployePayment->list() as $payment) {
            ?>
            <tr style="text-transform: uppercase;">
                <td style='padding:1px;'><?php echo $payment['id'] ?></td>
                <td style='padding:1px;'><?php echo $payment['receipt']; ?></td>
                <td style='padding:1px;'>$ <?php echo $payment['payment_value'] ?></td>
                <td style='padding:1px;'><?php echo $payment['date_at'] ?></td>
                <td style='padding:1px;'>
                    <div class="btn-acciones">
                        <button id='<?php echo $payment['id'] ?>' class='btn btn-outline-warning btn-sm' title='Editar empleado'   data-bs-toggle="modal" data-bs-target=".exampleModalCenter" onclick='editEmployePayment(<?php echo $bussines_id ?>, <?php echo $employe_id ?>, this.id)'>
                            <i class='fa fa-pencil-alt'> </i>
                        </button>
                        <button id='<?php echo $payment['id'] ?>' class='btn btn-outline-danger btn-sm' title='Ver pagos al Empleado' onclick='deleteEmployePayment(<?php echo $bussines_id ?>, <?php echo $employe_id ?>, this.id)'>
                            <i class='fa fa-trash'> </i>
                        </button>
                    </div>            
                </td>	
            </tr>                                
        <?php } ?>                                
        </tbody>
    </table>
</div>