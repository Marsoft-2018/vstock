<div class="dataTable_wrapper" style="overflow: auto;">
                    <!-- Aqui va la tabla -->
                    
    <button class='btn btn-primary mb-3' style='width: 100%;'  data-bs-toggle="modal" data-bs-target=".exampleModalCenter"  onclick='newSupplier()'>
        <i class='fa fa-plus'> </i> Nuevo
    </button>
    <table id="suppliersTable" class="display table table-striped table-hover dataTable no-footer mt-3" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nit/Documento</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Ciudad</th>
                <th>Correo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($objSupplier->list() as $supplier) {
            ?>
            <tr style="text-transform: uppercase;">
                <td style='padding:1px;'><?php echo $supplier['id'] ?></td>
                <td style='padding:1px;'><?php echo $supplier['name'] ?></td>
                <td style='padding:1px;'><?php echo $supplier['address'] ?></td>
                <td style='padding:1px;'><?php echo $supplier['phone'] ?></td>
                <td style='padding:1px;'><?php echo $supplier['city'] ?></td>
                <td  style="text-transform: lowercase;"><?php echo $supplier['email'] ?></td>
                <td style='padding:1px;'>                    
                    <div class="btn-acciones">
                        <button id='<?php echo $supplier['id'] ?>' class='btn btn-outline-info btn-sm' title='Ver pagos al proveedor' onclick='loadPaymentListSupplier(this.id)'>
                            <i class="fas fa-money-bill-wave"></i>
                        </button>
                        <button id='<?php echo $supplier['id'] ?>' class='btn btn-outline-warning btn-sm' title='Editar proveedor'   data-bs-toggle="modal" data-bs-target=".exampleModalCenter" onclick='editSupplier(this.id)'>
                            <i class='fa fa-pencil-alt'> </i>
                        </button>
                        <button id='<?php echo $supplier['id'] ?>' class='btn btn-outline-danger btn-sm' title='Ver pagos al proveedor' onclick='deleteSupplier(this.id)'>
                            <i class='fa fa-trash'> </i>
                        </button>
                    </div>
                </td>		
            </tr>                                
        <?php } ?>                                
        </tbody>
    </table>
</div>