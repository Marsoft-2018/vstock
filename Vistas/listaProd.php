<?php
    require('Conexiones/FacturasDetalles.php');

    if(isset($_POST['accion'])){
        $accion=$_POST['accion'];
    }
    if(isset($_POST['idProd'])){
        $idProd=$_POST['idProd'];
    }
    if(isset($_POST['Nfact'])){
        $Nfact=$_POST['Nfact'];
    }
    if(isset($_POST['Cantidad'])){
        $Cantidad=$_POST['Cantidad'];
    }
    
    
    
    $tipoDeProduct=0;


    if($accion=='Agregar'){
        $modulo=$_POST['modulo'];
        echo "<table class='table'>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Product</th>
                    <th style='text-align: center;'>Cant</th>
                    <th style='text-align: right;'>Precio</th>
                    <th style='text-align: right;'>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>";

                    $detalle=new detallesProd($Nfact);
                    $llenar=$detalle->agregarProduct($modulo,$idProd,$Cantidad);
                    $Mostar=$detalle->cargarProduct();

        echo "</tbody>
            <tfoot>
               <tr>
                   <td colspan='4' align='right'><label >TOTAL</label></td>
                   <td style='text-align:right;font-size:20px;'>
                    <div id='totalFactura'>
                   ";

                        $Mostar=$detalle->TotalFac();

         echo "         </div>
                    </td>
               </tr>

            </tfoot>
        </table>";    
    }

    if($accion=='Eliminar'){
    
        echo "<table class='table'>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Product</th>
                    <th align='center'>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>";

                    $detalle=new detallesProd($Nfact);
                    $llenar=$detalle->eliminarProduct($idProd);
                    $Mostar=$detalle->cargarProduct();

        echo "</tbody>
            <tfoot>
               <tr>
                   <td colspan='4' align='right'><label >TOTAL</label></td>
                   <td style='text-align:right;font-size:20px;'>";

                        $Mostar=$detalle->TotalFac();

         echo "    </td>
               </tr>

            </tfoot>
        </table>"; 
    }

    if($accion=='Nuevo'){
        //Voy por aqui falta el nombre de las variables post
        
        $idProd=$_POST['idProd'];
        $nombreProd=$_POST['nombreArticulo'];
        $referencia=$_POST['referencia'];
        $precioCompra=$_POST['precioCompra'];
        $precioVenta=$_POST['precioVenta'];
        $categoria=$_POST['categoria'];
        $idNegocio=$_POST['idNegocio'];
        $Cantidad=$_POST['Cantidad'];
        $objNuevo=new Inventario();
                                //$id_prod,$ARTICULO,$REFERENCIA,$PRECIO_COMPRA,$PRECIO_VENTA,$catidadCompra,$CANTIDAD_MIN,$idNegocio,$id_categoria
        $objNuevo->nuevoPorCompra($idProd,$nombreProd,$referencia,$precioCompra,$precioVenta,$Cantidad,1,$idNegocio,$categoria);
        //$Mostar=$detalle->cargarProduct();           
    }

    if($accion=="CambiarPrecio"){
        $precio=$_POST['precio'];
        $detalle=new detallesProd($Nfact);
        $Mostar=$detalle->actualizarPrecioTemp($idProd,$precio);
    }

    if($accion=="TotalFactura"){
        $objTotal= new detallesProd($Nfact);
        $Mostar=$objTotal->TotalFac();
    }


?>