
<h2>Reporte Detallado</h2> 

<table id='' class='display table table-striped table-hover dataTable no-footer' width='100%'>
    <thead>
            <tr>
                <th>ID</th>
                <th>ARTICULO</th>
                <th>REFERENCIA</th>
                <th style="text-align: center">CANTIDAD </th>
                <th style="text-align: right">VAL. UNITARIO</th>
                <th style="text-align: right">SUB TOTAL</th>
                <th>FECHA</th>
            </tr>
    </thead>
    <tbody>
        <?php
        $sumaTotal=0;    
        foreach ($registerData as $register) {
        ?> 
            <tr>
                <td><?php echo $register['product_id'] ?></td>
                <td><?php echo $register['name'] ?></td>
                <td><?php echo $register['reference'] ?></td>
                <td style="text-align: center"> <?php echo $register['quantity'] ?></td>
                <td style="text-align: right">$ <?php echo number_format($register['unit_value'], 0, ',', '.') ?></td>
                <td style="text-align: right">$ <?php echo number_format($register['subtotal_amount'], 0, ',', '.') ?></td>
                <td > <?php echo $register['date_at'] ?></td>
            </tr>
            <?php
                $sumaTotal=$sumaTotal+$register['subtotal_amount'];
                }
            ?>
        </tbody>
    <tfoot>
        <tr>
        <td colspan='5' align='right'><h4>TOTAL <?php echo $modulo ?>S:</h4></td>
        <td><h4 style='text-align:right;'>$ <?php echo number_format($sumaTotal, 0, ',', '.') ?></h4></td>    
        </tr>    
    </tfoot>
</table>