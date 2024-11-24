<style>   
    @media print {
        body * { visibility: hidden; }
        #exampleModalCenter2{position: absolute; top: -50%; width: 100%; padding:0px; }
        /* #exampleModalCenter2 * { visibility: hidden; } */
        #capaPagina{ visibility: hidden}
        #facturaImp * { visibility: visible; }
        #facturaImp { position: absolute; top: 10px; left: 0px;height: auto; width: 100%;} 
    }
</style>
<div class='facturaImp' style='width:98%;border:1px solid #cecece;padding:5px;' id="facturaImp">
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
            <div style='width:100%;text-align:center;margin-bottom:10px;'>
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
    <div style='width:100%;text-align:left;margin-top:10px;'>
        <strong>FACTURA No.</strong><?php echo $invoice['id'] ?>
    </div>
    <div style='width:100%;text-align:left;margin-top:5px;'>
        Fecha compra:<?php echo $invoice['date_at'] ?>
    </div>
        <?php
            //Datos del cliente
            $objSupplier = new Supplier();
            $objSupplier->id = $invoice['supplier_id'];
            foreach ($objSupplier->load() as $supplier) {
            ?>
                <div style='width:100%;text-align:left;margin-top:5px;'>
                    <strong>Proveedor: </strong> <?php echo $supplier['name'] ?>
                </div>
                <div style='width:100%;text-align:left;margin-top:5px;'>
                    <strong>CC/NIT: </strong> <?php echo $supplier['id'] ?>
                </div>
            <?php  
            }
            ?>
            <div style='width:100%;text-align:left;margin-top:5px;'>
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
                            <td style='text-align:right;' colspan='4'><strong>TOTAL:</strong></td>
                            <td><h5 style='text-align:right;'>$ <?php echo number_format($total, 0, ',', '.') ?></h5></td>
                        </tr>
                    </tfoot>                        
                </table>
            </div>
            <div style='width:100%;text-align:center;margin-top:5px;'><strong>Gracias por su compra!</strong> </div>  
        </div>
    </div>
</div>
<br>
<button class="btn btn-primary fa fa-eyes" onclick="javascript:window.print()" value="Ver Resultado"><i class="fa fa-print"></i>Imprimir</button>
                    
<?php } ?>
