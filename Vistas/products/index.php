<!DOCTYPE html>
<?php
    session_start();
?>
<html>

<head>
     <!-- Site Metas --><!-- Bootstrap 5 CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
-->


    <link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
    <script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script>
<!-- 
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css">
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap5.js"></script>
 -->
    <style>
    div.dataTables_wrapper {
        margin-bottom: 3em;
    }
    </style>

    <script>
      /*  new DataTable('#productsTable');*/
    $(document).ready(function() {
        $('table.display').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "<div class='alert alert-danger'>No se encuentra el product buscado</div>",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de los registros totales de _MAX_)"
            }
        });
    });
    </script>
</head>

<body oncontextmenu="return false" bgcolor="#0066CC">

    <br>
    <br>
    <div class="col-lg-12" style="border:  width: 100%;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5>Reporte de articulos en el inventario</h5>
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
                                <th  style="text-align: center;">Medida</th><!--  -->
                                <th style="text-align: center;">Pecio de Compra</th>
                                <th style="text-align: center;">Precio de venta</th>
                                <th style="text-align: center;">Cant Inicial</th>
                                <th style="text-align: center;">Compras</th>
                                <th style="text-align: center;">Ventas</th>
                                <th style="text-align: center;">Cant Mín</th>
                                <th style="text-align: center;">Devo</th>
                                <th style="text-align: center;">Existencias</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $objInventario = new Product();
                                $objInventario->bussines_id = $bussines_id;
                                foreach($objInventario->listar() as $product){ ?>
                                    <tr style='font-size:10px;text-align: left; text-transform: uppercase; padding:2px;'>
                                        <td title='Código: <?php echo $product['id']; ?>' ><?php echo $product['id']; ?></td>
                                        <td title='Nombre del Articulo'><?php echo $product['name']; ?></td>
                                        <td title='Referencia'><?php echo $product['reference']; ?></td>
                                        <td title='Categoria'><?php echo $product['category']; ?></td>
                                        <td title='Medida'><?php echo $product['measure']; ?></td><!---->
                                        <td style='text-align: right;' title='Precio de Compra'>$ <?php echo number_format( $product['purchase_price'], 0, ',', '.'); ?></td>
                                        <td style='text-align: right;' title='Precio de Venta'>$ <?php echo number_format( $product['selling_price'], 0, ',', '.'); ?></td>
                                        <td style='text-align: right;' title='Cantidad Inicial'><?php echo $product['initial_quantity']; ?></td>
                                        <td style='text-align: right;' title='Cantidad Comprada'><?php echo $product['purchases']; ?></td>
                                        <td style='text-align: right;' title='Cantidad Vendida'><?php echo $product['sales']; ?></td>
                                        <td style='text-align: right;' title='Cantidad mínima en stok'><?php echo $product['min_quantity']; ?></td>
                                        <td style='text-align: right;' title='Cantidad de Devoluciones del articulo'><?php echo $product['stock_returns']; ?></td>
                                        <?php               
                                                if ($product['stock'] <= $product['min_quantity']) { ?>
                                                    <td style='text-align: right;' title='Cantidad Final en el inventario' style='background:rgba(255,0,0,0.4);'><?php echo $product['stock']; ?></td>
                                        <?php
                                                }else{ 
                                            ?>
                                                    <td style='text-align: right;' title='Cantidad Final en el inventario' ><?php echo $product['stock']; ?></td>
                                            <?php     
                                                }
                                            ?>
                                            <td style='text-align: center;padding: 1px;'>
                                                <button class="btn btn-outline-warning btn-sm" id='<?php echo $product['id']; ?>' title='Editar articulo <?php echo $product['id']; ?>'  data-bs-toggle="modal" data-bs-target=".exampleModalCenter"  onclick="editProduct(this.id,'<?php echo $_SESSION['idNegocio']; ?>')">
                                                    <i class="fa fa-pencil-alt" ></i>
                                                </button>
                                            </td>
                                            <td style='text-align: center;padding: 1px;'>
                                                <button class="btn btn-outline-danger btn-sm" id='<?php echo $product['id']; ?>' title='Eliminar articulo <?php echo $product['id']; ?>' onclick="deleteProduct(this.id,'<?php echo $_SESSION['idNegocio']; ?>')">
                                                    <i class="fa fa-trash" ></i>
                                                </button>
                                            </td>   
                                        </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                        <!--<tfoot>
                            <tr style="background-color: #cedece; color:#000;">
                                <?php foreach($objInventario->totales() as $total){ ?>
                                    <td style='text-align: left;'>CANTIDADES TOTALES DE PRODUCTOS</td>
                                    <td style='text-align: right;'><?php echo $total['initial_quantity']; ?></td>
                                    <td style='text-align: right;'><?php echo $total['purchases']; ?></td>
                                    <td style='text-align: right;'><?php echo $total['sales']; ?></td>
                                    <td style='text-align: right;'>--</td>
                                    <td style='text-align: right;'><?php echo $total['stock_returns']; ?></td>
                                    <td style='text-align: right;'><?php echo $total['stock']; ?></td>
                                    <td class='celda1' style='text-align: center;'>
                                        
                                    </td>
                                <?php
                                    }
                                ?>
                            </tr>
                        </tfoot>-->
                    </table>
                    <a class="nav-link btn btn-primary btn-lg" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target=".exampleModalCenter"  onclick="newProduct('<?php echo $_SESSION['idNegocio']; ?>')">
                        <i class="fa fa-plus-circle"></i> Agregar un nuevo articulo
                    </a>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
                         
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
    <div class="row"></div>
</body>

</html>