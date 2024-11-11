<!DOCTYPE html>
<html lang="en">

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
                "zeroRecords": "<div class='alert alert-danger'>No se encuentra el registro buscado</div>",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de los registros totales de _MAX_)"
            }
        });
    });
    </script>
</head>
<body>
    <h3>Módulo clientes</h3>
    <hr>
    <?php
        $objCustomer = new Customer();
        include_once("lista.php");
    ?>
                    
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
    
</body>
</html>