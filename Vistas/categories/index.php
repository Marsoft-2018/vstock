<!DOCTYPE html>
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
                "zeroRecords": "<div class='alert alert-danger'>No se encuentra el category buscado</div>",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de los registros totales de _MAX_)"
            }
        });
    });
    </script>
</head>

<body oncontextmenu="return false">
    <h3>Módulo control de categorias</h3>
    <hr>
    <a class="nav-link btn btn-primary btn-lg" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target=".exampleModalCenter"  onclick="newCategory('<?php echo $data['bussines_id']; ?>')">
        <i class="fa fa-plus-circle"></i> Agregar
    </a>
    <div class="col-lg-12 mt-3" style="border:  width: 100%;">
        <div class="panel panel-primary">
            <div class="panel-heading">
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper" style="overflow: auto;">
                    <!-- Aqui va la tabla -->
                    <table id="productsTable" class="display table table-striped table-hover dataTable no-footer" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr style="font-size:12px;text-align: center;">
                                <th style="text-align: center;">Id</th>
                                <th style="text-align: center;">Nombre</th>
                                <th style="text-align: center;">Descripción</th>
                                <th style="text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($objCategory->list() as $category){ ?>
                                    <tr>
                                        <td title='Código: <?php echo $category['id']; ?>' >
                                            <?php echo $category['id']; ?>
                                        </td>
                                        <td title='Nombre'>
                                            <?php echo $category['name']; ?>
                                        </td>
                                        <td title='Descripción'>
                                            <?php echo $category['description']; ?>
                                        </td>                                        
                                        <td style='text-align: center; padding:1px;'>                                                                
                                            <div class="btn-acciones">
                                                <button class="btn btn-outline-warning btn-sm" id='<?php echo $category['id']; ?>' title='Editar articulo <?php echo $category['id']; ?>'  data-bs-toggle="modal" data-bs-target=".exampleModalCenter"  onclick="editCategory(this.id,'<?php echo $data['bussines_id']; ?>')">
                                                    <i class="fa fa-pencil-alt" ></i>
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm" id='<?php echo $category['id']; ?>' title='Eliminar articulo <?php echo $category['id']; ?>' onclick="deleteCategory(this.id,'<?php echo $data['bussines_id']; ?>')">
                                                    <i class="fa fa-trash" ></i>
                                                </button>
                                            </div>
                                        </td>   
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