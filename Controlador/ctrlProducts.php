<?php
    include("header.php");
    require('../Modelo/category.php');
    require('../Modelo/measurement.php');
    require('../Modelo/product.php');
    
    switch ($accion) {
        case 'load':
            $objProduct = new Product();
            $objProduct->bussines_id = $_REQUEST['bussines_id'];
            $objProduct->id = $_REQUEST['id'];
            echo json_encode($objProduct->load());        
        break;

        
        case 'find':
            $objProduct = new Product();
            $objProduct->bussines_id = $data['bussines_id'];
            $objProduct->text = $data['text'];
            echo json_encode($objProduct->find());        
        break;

        case 'add':
            add_or_set_product($accion);           
            break;
        case 'edit':
            $objProduct = new Product();
            $objProduct->bussines_id = $data['bussines_id'];
            $objProduct->id = $data['id'];
            $objCategory = new Category();
            $objCategory->bussines_id = $data['bussines_id'];
            $objMedida = new Medida();
            $objMedida->bussines_id = $data['bussines_id'];
            include("../Vistas/products/formulario.php");  
            
            break;
        case 'update':
            add_or_set_product($accion);        
            break;
        case 'delete':
            $objProduct = new Product();
            $objProduct->id = $data['id'];
            $objProduct->bussines_id = $data['bussines_id'];
            $objProduct->delete();         
            break;
        case 'new':
            $bussines_id = $data['bussines_id'];
            include("../Vistas/products/formulario.php");     
            break;
        case 'index':
            // $objCategory = new Category();
            // $objCategory->bussines_id = $data['bussines_id'];
            // $objMedida = new Medida();
            // $objMedida->bussines_id = $data['bussines_id'];
            $bussines_id = $data['bussines_id'];
            include("../Vistas/products/index.php");     
        break;
        
        case 'indexStockReturn':
            // $objCategory = new Category();
            // $objCategory->bussines_id = $data['bussines_id'];
            // $objMedida = new Medida();
            // $objMedida->bussines_id = $data['bussines_id'];
            $bussines_id = $data['bussines_id'];
            include("../Vistas/products/stock_returns.php");     
        break;


        case 'quantity_stock':
            $objProduct = new Product();
            $objProduct->id = $data['product_id'];
            $objProduct->bussines_id = $data['bussines_id'];
            ;   
            foreach($objProduct->load() as $product){
                if($product['stock'] <= $product['min_quantity']){
                    echo '
                    <div class="alert alert-danger mt-3" role="alert">
                        La cantidad actual en el inventario es baja:'.$product['stock'].
                    '</div>';
                }else{
                    echo '
                    <div class="alert alert-primary mt-3" role="alert">
                        Cantidad actual en el inventario: '.$product['stock'].
                    '</div>';
                }
            }      
            break;
    }

    function add_or_set_product($tipo){
        $objProduct = new Product();
        $objProduct->id = $_POST['id'];
        $objProduct->name = $_POST['name'];
        $objProduct->reference = $_POST['reference'];
        $objProduct->purchase_price = $_POST['purchase_price'];
        $objProduct->selling_price = $_POST['selling_price'];
        $objProduct->initial_quantity = $_POST['initial_quantity'];
        $objProduct->stock = $_POST['stock'];
        $objProduct->min_quantity = $_POST['min_quantity'];
        $objProduct->bussines_id = $_POST['bussines_id'];
        $objProduct->category_id = $_POST['category_id'];
        $objProduct->measure_id = $_POST['measure_id'];
        switch ($tipo) {
            case 'add':
                $objProduct->add();
                break;
            case 'update':
                $objProduct->update();          
                break;
        }
    }

?>