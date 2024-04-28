<!DOCTYPE html>
<?php
    //session_start();
    ///require("Conexiones/Conect.php");
    require("../../Modelo/Conect.php");
    require("../../Modelo/producto.php");
?>
<html>

<head>
     <!-- Site Metas --><!-- Bootstrap 5 CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
-->
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
    <script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script>

    <style>
    div.dataTables_wrapper {
        margin-bottom: 3em;
    }
    </style>

    <script>
    $(document).ready(function() {
        $('table.display').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "<div class='alert alert-danger'>No se encuentra el producto buscado</div>",
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
                    <table id="" class="display table table-striped table-hover dataTable no-footer" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr style="font-size:12px;text-align: center;">
                                <th style="text-align: center;">Código</th>
                                <th style="text-align: center;">Nombre del Articulo</th>
                                <th style="text-align: center;">Refrencia</th>
                                <th style="text-align: center;">Categoria</th>
                                <!-- <th  style="text-align: center;">Medida</th> -->
                                <th style="text-align: center;">Pecio de Compra</th>
                                <th style="text-align: center;">Precio de venta</th>
                                <th style="text-align: center;">Cant Inicial</th>
                                <th style="text-align: center;">Compras</th>
                                <th style="text-align: center;">Ventas</th>
                                <th style="text-align: center;">Cant Mín</th>
                                <th style="text-align: center;">Devo</th>
                                <th style="text-align: center;">Cant Final</th>
                                <th style="text-align: center;"></th>
                                <th style="text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $objInventario = new Producto();
                                $objInventario->bussines_id = $_POST['idNegocio'];
                                foreach($objInventario->listar() as $producto){ ?>
                                    <tr style='font-size:10px;text-align: left;'>
                                        <td title='Código: <?php echo $producto['id']; ?>' ><?php echo $producto['id']; ?></td>
                                        <td title='Nombre del Articulo'><?php echo $producto['name']; ?></td>
                                        <td title='Referencia'><?php echo $producto['reference']; ?></td>
                                        <td title='Categoria'><?php echo $producto['Categorias']; ?></td>
                                        <!--<td title='Medida'>$producto['12']</td>-->
                                        <td style='text-align: right;' title='Precio de Compra'>$ <?php echo number_format( $producto['purchase_price'], 0, ',', '.'); ?></td>
                                        <td style='text-align: right;' title='Precio de Venta'>$ <?php echo number_format( $producto['selling_price'], 0, ',', '.'); ?></td>
                                        <td style='text-align: right;' title='Cantidad Inicial'><?php echo $producto['initial_quantity']; ?></td>
                                        <td style='text-align: right;' title='Cantidad Comprada'><?php echo $producto['purchases']; ?></td>
                                        <td style='text-align: right;' title='Cantidad Vendida'><?php echo $producto['sales']; ?></td>
                                        <td style='text-align: right;' title='Cantidad mínima en stok'><?php echo $producto['min_quantity']; ?></td>
                                        <td style='text-align: right;' title='Cantidad de Devoluciones del articulo'><?php echo $producto['stock_returns']; ?></td>
                                       <?php               
                                            if ($producto['stock'] <= $producto['min_quantity']) { ?>
                                                <td style='text-align: right;' title='Cantidad Final en el inventario' style='background:rgba(255,0,0,0.4);'><?php echo $producto['stock']; ?></td>
                                       <?php
                                            }else{ 
                                        ?>
                                                <td style='text-align: right;' title='Cantidad Final en el inventario' ><?php echo $producto['stock']; ?></td>
                                        <?php     
                                            }
                                        ?>
                                            <td class='celda1' style='text-align: center;'>
                                                <img src='Tools/Iconos/editar1.png' id='<?php echo $producto['id']; ?>' width='15' height='15' title='Editar articulo <?php echo $producto['id']; ?>' class='iconosAcciones' onclick='acciones(this.id,1,1)'></img>
                                            </td>
                                            <td class='celda1' style='text-align: center;'>
                                                <!--<a href='#' id='$producto['0']'  onclick='acciones(this.id,2,1)' ><i class='fa fa-trash' title='Eliminar articulo ".$producto['0']."' > -->
                                                
                                                <img src='Tools/Iconos/eliminar.png' id='<?php echo $producto['id']; ?>' width='15' height='15' title='Eliminar articulo <?php echo $producto['id']; ?>' class='iconosAcciones' onclick='acciones(this.id,2,1)'></img>
                                            </td>   
                                        </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr style="font-size:12px;text-align: left;background-color: rgba(49, 80, 119,0.5);color:#000;">
                                <?php foreach($objInventario->totales() as $total){ ?>
                                    <td style='text-align: left;border: 1px solid #fff;' colspan='6'>CANTIDADES TOTALES DE PRODUCTOS</td>
                                    <td style='text-align: right;border: 1px solid #fff;'><?php echo $total['initial_quantity']; ?></td>
                                    <td style='text-align: right;border: 1px solid #fff;'><?php echo $total['purchases']; ?></td>
                                    <td style='text-align: right;border: 1px solid #fff;'><?php echo $total['sales']; ?></td>
                                    <td style='text-align: right;border: 1px solid #fff;'>--</td>
                                    <td style='text-align: right;border: 1px solid #fff;'><?php echo $total['stock_returns']; ?></td>
                                    <td style='text-align: right;border: 1px solid #fff;'><?php echo $total['stock']; ?></td>
                                    <td class='celda1' style='text-align: center;border: 1px solid #fff;' colspan='2'>
                                        <a class="nav-link btn btn-primary" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target=".exampleModalCenter"  onclick='acciones(this.id,3,1)'>
                                            <i class="fa fa-plus-circle"></i> Agregar
                                        </a><!--
                                        <button class='btn btn-primary' id='nuevo' title='Agregar un nuevo articulo'><i class='fa fa-plus-circle'> Agregar</i> </button>  -->                                                          
                                    </td>
                                <?php
                                    }
                                ?>
                            </tr>
                        </tfoot>
                    </table>
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
              <h2 class="modal-title" id="exampleModalCenterTitle">Productos</h2>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
            </div>
          </div>
        </div>
      </div>

    <div class="row"></div>
   <!-- Option 1: Bootstrap Bundle with Popper
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>-->
    <script src="js/productos.js"></script>
</body>

</html>