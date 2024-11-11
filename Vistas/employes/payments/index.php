<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Site Metas --><!-- Bootstrap 5 CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
-->


    <link rel="stylesheet" type="text/css" href="../DataTables/datatables.css">
    <script type="text/javascript" charset="utf8" src="../DataTables/datatables.js"></script>
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
    <h3>Módulo Para seguimiento al pago de Empleados</h3>
    <hr>
    <?php 
        $empleado = "";
        foreach ($objEmploye->load() as $employe) {
            $empleado = $employe['first_name']." ".$employe['second_name']." ".$employe['first_last_name']." ".$employe['second_last_name'];
        }
    ?>
    <h4><i><?php echo $empleado; ?></i></h4>
    <hr>
    <div style="display: flex; justify-content:  space-between;">
        <button class='btn btn-primary mb-3' style='width: 30%;'  data-bs-toggle="modal" data-bs-target=".exampleModalCenter"  onclick='newEmployePayment(<?php echo $bussines_id ?>, <?php echo $employe_id ?>)'>
            <i class='fa fa-plus'> </i> Nuevo
        </button>
        <button class='btn btn-secondary mb-3' style='width: 30%;' onclick="indexEmployes('<?php echo $bussines_id; ?>')">
            <i class='fa fa-arrow-left'> </i> Regresar
        </button>
    </div>
    <?php        
        $bussines_id = $data->bussines_id;
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