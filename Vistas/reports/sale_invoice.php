<div class='facturaImp' style='width:98%;border:1px solid #cecece;padding:5px;'>
<?php
    $objBussines = new Bussines();
    $objBussines->id = $data['bussines_id'];

    $nombreNegocio;
    $logo;
    $nit;
    $direccion;
    $tel;
    $ciudad;
    foreach ($objBussines->load() as $bussines) {
        $nombreNegocio=$bussines['name'];
        $logo=$bussines['logo'];
        $nit=$bussines['nit'];
        $direccion=$bussines['address']." Barrio ".$bussines['town'];
        $tel=$bussines['tel'];
        $ciudad=$bussines['city'];
    }
?>
    <header style='width:100%;'>
            <div style='width:100%;text-align:center;margin-top:20px;margin-bottom:10px;'>
                <img src='img/<?php echo $logo ?>' style='width:105px;margin:0 auto;'>
            </div>
            <div style='width:100%;font-size:9px;text-align:center;border-bottom:1px dotted #cecece;'>
                <span><h5 style='margin:0px;padding:0px;'><?php echo $nombreNegocio ?></h5></span>
                <span>Nit: <?php echo $nit ?></span><br>
                <span><?php echo $direccion ?> Teléfono: <?php echo $tel ?></span><br>
                <span><?php echo $ciudad ?></span>
            </div>
    </header>
<?php 
    foreach ($objInvoice->load() as $invoice) {
        $total = 0;
    ?>
    <div style='width:100%;text-align:left;margin-top:10px;font-size:9px;'><strong>FACTURA No.</strong><?php echo $invoice['id'] ?></div>
        <div style='width:100%;text-align:left;margin-top:5px;font-size:9px;'>Fecha Venta:<?php echo $invoice['date_at'] ?></div>
        <?php
            //Datos del cliente
            $objCustomer = new Customer();
            $objCustomer->id = $invoice['customer_id'];
            foreach ($objCustomer->load() as $customer) {
            ?>
                <div style='width:100%;text-align:left;margin-top:5px;font-size:9px;'><strong>Cliente: </strong> <?php echo $customer['name'] ?></div>
                <div style='width:100%;text-align:left;margin-top:5px;font-size:9px;'><strong>CC/NIT: </strong> <?php echo $customer['id'] ?></div>
            <?php  
            }
            ?>
            <div style='width:100%;text-align:left;margin-top:5px;font-size:9px;'>
                <table style='width:100%;'>
                    <thead>
                        <tr>
                            <th>Cod.</th>
                            <th style='text-align:center'>Descripción</th>
                            <th style='text-align:center'>Cant</th>
                            <th style='text-align:center'>V. Unit</th>
                            <th style='text-align:center'>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($objInvoice->loadDetails() as $detail) {
                            $objProduct = new Product();
                            $objProduct->id = $detail['product_id'];
                            $objProduct->bussines_id = $data['bussines_id'];
                            $total += $detail['subtotal_amount'];
                        ?>
                            <tr>
                                <td><?php echo $detail['product_id'] ?>
                                </td>
                                <td>
                                    <?php 
                                        foreach($objProduct->load() as $product){
                                            echo $product['name'];
                                        }
                                    ?>
                                </td>
                                <td style='text-align:center'><?php echo $detail['quantity'] ?></td>
                                <td style='text-align:right;'>$ <?php echo number_format($detail['unit_value'], 0, ',', '.') ?></td>
                                <td style='text-align:right;'>$ <?php echo number_format($detail['subtotal_amount'], 0, ',', '.') ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td align='right' colspan='4'><strong>TOTAL:</strong></td>
                            <td><h5 style='text-align:right;'>$ <?php echo number_format($total, 0, ',', '.') ?></h5></td>
                        </tr>
                    </tfoot>                        
                </table>
            </div>
            <div style='width:100%;text-align:center;margin-top:5px;font-size:9px;'><strong>Gracias por su compra!</strong> </div>  
        </div>
    </div>
</div>
<?php } ?>
