
<h2>Reporte Detallado</h2> 

<table id='' class='display table table-striped table-hover dataTable no-footer' width='100%'>
    <thead>
            <tr>
                <th>FECHA</th>
                <th>FACTURA #</th>
                <th style="text-align: center">CANTIDAD </th>
                <th style="text-align: right">SUB TOTAL</th>
                <!-- <th></th> -->
            </tr>
    </thead>
    <tbody>
        <?php
        $sumaTotal=0;    
        foreach ($registerData as $register) {
        ?> 
            <tr>
                <td > <?php echo $register['date_at'] ?></td>
                <td><?php echo $register['id'] ?></td>
                <td style="text-align: center"> <?php echo $register['quantity'] ?></td>
                <td style="text-align: right">$ <?php echo number_format($register['subtotal_amount'], 0, ',', '.') ?></td>
                <td><button class="btn btn-info"  aria-current="page" href="#" data-bs-toggle="modal" data-bs-target=".exampleModalCenter" onclick="loadInvoice('<?php echo $modulo ?>','<?php echo $register['id'] ?>','1','modalBody')"><i class="fa fa-eye"></i></button></td>
            </tr>
        <?php
            $sumaTotal=$sumaTotal+$register['subtotal_amount'];
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
        <td colspan='3' style="text-align: right"><h4>TOTAL <?php echo $modulo ?>S:</h4></td>
        <td><h4 style='text-align:right;'>$ <?php echo number_format($sumaTotal, 0, ',', '.') ?></h4></td>    
        </tr>    
    </tfoot>
</table>
       
<div class="modal fade exampleModalCenter" id="exampleModalCenter2" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="exampleModalCenterTitle"></h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalBody">
        
        </div>
    </div>
    </div>
</div>