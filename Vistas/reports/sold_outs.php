
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Reporte de articulos agotados o próximos a agotrase en el inventario</h3>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="dataTable_wrapper" style="overflow: auto;">
            <!-- Aqui va la tabla -->
            <table id="productsTable" class="display table table-striped table-hover dataTable no-footer" cellspacing="0"
                width="100%">
                <thead>
                    <tr style="font-size:12px;text-align: center;">
                        <th style="text-align: center;">Código</th>
                        <th style="text-align: center;">Nombre del Articulo</th>
                        <th style="text-align: center;">Refrencia</th>
                        <th style="text-align: center;">Categoria</th>
                        <th style="text-align: center;">Pecio de Compra</th>
                        <th style="text-align: center;">Precio de venta</th>
                        <th style="text-align: center;">Cant Inicial</th>
                        <th style="text-align: center;">Compras</th>
                        <th style="text-align: center;">Ventas</th>
                        <th style="text-align: center;">Cant Mín</th>
                        <th style="text-align: center;">Devo</th>
                        <th style="text-align: center;">Existencias</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($objProduct->soldOuts() as $product){ ?>
                            <tr style='font-size:10px;text-align: left; text-transform: uppercase; padding:2px;'>
                                <td title='Código: <?php echo $product['id']; ?>' ><?php echo $product['id']; ?></td>
                                <td title='Nombre del Articulo'><?php echo $product['name']; ?></td>
                                <td title='Referencia'><?php echo $product['reference']; ?></td>
                                <td title='Categoria'><?php echo $product['category']; ?></td>
                                <td style='text-align: right;' title='Precio de Compra'>$ <?php echo number_format( $product['purchase_price'], 0, ',', '.'); ?></td>
                                <td style='text-align: right;' title='Precio de Venta'>$ <?php echo number_format( $product['selling_price'], 0, ',', '.'); ?></td>
                                <td style='text-align: right;' title='Cantidad Inicial'><?php echo $product['initial_quantity']; ?></td>
                                <td style='text-align: right;' title='Cantidad Comprada'><?php echo $product['purchases']; ?></td>
                                <td style='text-align: right;' title='Cantidad Vendida'><?php echo $product['sales']; ?></td>
                                <td style='text-align: right;' title='Cantidad mínima en stok'><?php echo $product['min_quantity']; ?></td>
                                <td style='text-align: right;' title='Cantidad de Devoluciones del articulo'><?php echo $product['stock_returns']; ?></td>
                                <?php               
                                if ($product['stock'] <= $product['min_quantity']) { ?>
                                    <td style='text-align: right; background:rgba(255,0,0,0.4);' title='Cantidad Final en el inventario'>
                                        <div style='display: flex; justify-content: center; background:rgba(255,0,0,0.4); width:100%; padding: 5px; font-size: 1.2em; color: #000;' >
                                            <?php echo $product['stock']; ?>
                                        </div>
                                    </td>
                                <?php
                                }
                                ?>
                                </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.panel-body -->
</div>