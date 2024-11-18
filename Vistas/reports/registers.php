
<h2>Reporte Detallado</h2> 

<table id='' class='display table table-striped table-hover dataTable no-footer' width='100%'>
    <thead>
            <tr>
                <th>FECHA</th>
                <th>ID</th>
                <th>ARTICULO</th>
                <th>REFERENCIA</th>
                <th style="text-align: center">CANTIDAD </th>
                <th style="text-align: right">VAL. UNITARIO</th>
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
                <td><?php echo $register['product_id'] ?></td>
                <td><?php echo $register['name'] ?></td>
                <td><?php echo $register['reference'] ?></td>
                <td style="text-align: center"> <?php echo $register['quantity'] ?></td>
                <td style="text-align: right">$ <?php echo number_format($register['unit_value'], 0, ',', '.') ?></td>
                <td style="text-align: right">$ <?php echo number_format($register['subtotal_amount'], 0, ',', '.') ?></td>
                <!-- <td><button class="btn btn-info"  onclick="loadInvoice('modulo = VENTA','invoice_id = 495','bussines_id = 1')"><i class="fa fa-eye"></i></button></td> -->
            </tr>
            <?php
                $sumaTotal=$sumaTotal+$register['subtotal_amount'];
                }
            ?>
        </tbody>
    <tfoot>
        <tr>
        <td colspan='6' style="text-align: right"><h4>TOTAL <?php echo $modulo ?>S:</h4></td>
        <td><h4 style='text-align:right;'>$ <?php echo number_format($sumaTotal, 0, ',', '.') ?></h4></td>    
        </tr>    
    </tfoot>
</table>