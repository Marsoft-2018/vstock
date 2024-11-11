<div class="dataTable_wrapper" style="overflow: auto;">
    <div style="display: flex; justify-content:space-between; width: 100%">
        <div>
            <h3>FACTURA No. <?php echo $objPersonCredit->invoice_id; ?></h3>    
        </div>
        <div>
            <h4>Valor crédito: <strong>$ <?php echo  number_format($amount,0,',','.'); ?></strong></h4>
            <p><?php echo  $valorEnLetras ?></p>
        </div> 
    </div>
    <table id="customersTable" class="display table table-striped table-hover dataTable no-footer mt-3" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Cuotas</th>
                <th>Valor</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $total = 0;
                foreach ($objPersonCredit->list() as $credit) {
                    $total += $credit['amount'];
            ?>
            <tr style="text-transform: uppercase;">
                <td style='padding:1px;'><?php echo $credit['number_paid']; ?></td>
                <td style='padding:1px; text-align: right;'>$ <?php echo number_format($credit['amount'],0,',','.') ?></td>
                <td style='padding:1px; text-align: center;'><?php echo $credit['date_at'] ?></td>
                <td style='padding:1px;'>
                    <div class="btn-acciones">
                        <button id='<?php echo $credit['id'] ?>' class='btn btn-outline-warning btn-sm' title='Editar pago'   data-bs-toggle="modal" data-bs-target=".exampleModalCenter" onclick='editEmployePayment(<?php echo $bussines_id ?>, <?php echo $employe_id ?>, this.id)'>
                            <i class='fa fa-credit-card'> </i>
                        </button>
                        <button id='<?php echo $credit['id'] ?>' class='btn btn-outline-danger btn-sm' title='Eliminar pago' onclick='deleteEmployePayment(<?php echo $bussines_id ?>, <?php echo $employe_id ?>, this.id)'>
                            <i class='fa fa-trash'> </i>
                        </button>
                    </div>            
                </td>	
            </tr>                                
        <?php } ?>                                
        </tbody>
        <tfoot>
            <tr>
                <td style='padding:1px;'>Total abonado</td>
                <td style='padding:1px; font-size: 1.5em; text-align: right;'>$ <?php echo  number_format($total,0,',','.') ?></td>
            </tr>
            <tr>
                <td style='padding:1px;'>Saldo actual</td>
                <td style='padding:1px; font-size: 1.5em; text-align: right;'>$ <?php echo  number_format(($amount - $total),0,',','.')  ?></td>
                <td>                                                                                                                                              
                    <button class='btn btn-outline-warning btn-md' title='Abonar'  data-bs-target=".exampleModalCenter" onclick="newPersonCredit('<?php echo $objPersonCredit->person; ?>',<?php echo $objPersonCredit->invoice_id ?>, <?php echo $objPersonCredit->person_id ?>,'Abono')">
                        <i class='fa fa-money-check-alt'> Abonar </i>
                    </button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>